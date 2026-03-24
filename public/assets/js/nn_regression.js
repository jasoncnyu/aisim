$(function () {
  const canvas = document.getElementById("nnCanvas");
  const lossCanvas = document.getElementById("lossChart");

  const XMIN = -10;
  const XMAX = 10;
  const YMIN = -10;
  const YMAX = 10;

  let points = [];
  let trainIdx = [];
  let valIdx = [];
  let splitSeed = 12345;

  let model = null;
  let historyTrain = [];
  let historyVal = [];
  let epoch = 0;
  let runTimer = null;

  let mode = "add";
  let testMarker = null;

  function setupHiDPI(cvs) {
    const dpr = window.devicePixelRatio || 1;
    const rect = cvs.getBoundingClientRect();
    cvs.width = Math.max(1, Math.round(rect.width * dpr));
    cvs.height = Math.max(1, Math.round(rect.height * dpr));
    const cx = cvs.getContext("2d");
    cx.setTransform(dpr, 0, 0, dpr, 0, 0);
    return cx;
  }

  let ctx = setupHiDPI(canvas);
  let lossCtx = setupHiDPI(lossCanvas);

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;
  const lw = () => lossCanvas.getBoundingClientRect().width;
  const lh = () => lossCanvas.getBoundingClientRect().height;

  function worldToCanvas(x, y) {
    return {
      cx: ((x - XMIN) / (XMAX - XMIN)) * cw(),
      cy: (1 - (y - YMIN) / (YMAX - YMIN)) * ch(),
    };
  }

  function canvasToWorld(cx, cy) {
    return {
      x: (cx / cw()) * (XMAX - XMIN) + XMIN,
      y: (1 - cy / ch()) * (YMAX - YMIN) + YMIN,
    };
  }

  function clientToCanvas(clientX, clientY) {
    const rect = canvas.getBoundingClientRect();
    return { cx: clientX - rect.left, cy: clientY - rect.top };
  }

  function randn() {
    let u = 0;
    let v = 0;
    while (u === 0) u = Math.random();
    while (v === 0) v = Math.random();
    return Math.sqrt(-2 * Math.log(u)) * Math.cos(2 * Math.PI * v);
  }

  function mulberry32(seed) {
    let t = seed >>> 0;
    return function () {
      t += 0x6d2b79f5;
      let x = Math.imul(t ^ (t >>> 15), 1 | t);
      x ^= x + Math.imul(x ^ (x >>> 7), 61 | x);
      return ((x ^ (x >>> 14)) >>> 0) / 4294967296;
    };
  }

  function createMatrix(r, c, scale) {
    const m = new Array(r);
    for (let i = 0; i < r; i++) {
      m[i] = new Float32Array(c);
      for (let j = 0; j < c; j++) m[i][j] = randn() * scale;
    }
    return m;
  }

  function activation(z) {
    const type = $("#activation").val();
    if (type === "relu") return z > 0 ? z : 0;
    return Math.tanh(z);
  }

  function activationDeriv(z) {
    const type = $("#activation").val();
    if (type === "relu") return z > 0 ? 1 : 0;
    const t = Math.tanh(z);
    return 1 - t * t;
  }

  function buildModel() {
    const hiddenLayers = Math.max(1, Math.min(3, parseInt($("#hiddenLayers").val(), 10) || 2));
    const hiddenUnits = Math.max(4, Math.min(128, parseInt($("#hiddenUnits").val(), 10) || 32));

    $("#hiddenLayers").val(hiddenLayers);
    $("#hiddenUnits").val(hiddenUnits);

    const dims = [1];
    for (let i = 0; i < hiddenLayers; i++) dims.push(hiddenUnits);
    dims.push(1);

    const layers = [];
    for (let i = 0; i < dims.length - 1; i++) {
      const inDim = dims[i];
      const outDim = dims[i + 1];
      const scale = i === dims.length - 2 ? 0.08 : 0.12;
      layers.push({
        W: createMatrix(outDim, inDim, scale),
        b: new Float32Array(outDim),
      });
    }

    return { dims, layers };
  }

  function resetTrainingState() {
    epoch = 0;
    historyTrain = [];
    historyVal = [];
    testMarker = null;
    updateStats(null);
    drawLoss();
  }

  function initModel() {
    stopRun();
    model = buildModel();
    resetTrainingState();
    const evalNow = evaluateAll();
    if (evalNow) pushHistory(evalNow);
    render();
  }

  function forwardDetailed(x) {
    const As = [new Float32Array([x])];
    const Zs = [];

    for (let li = 0; li < model.layers.length; li++) {
      const layer = model.layers[li];
      const aPrev = As[li];
      const z = new Float32Array(layer.b.length);

      for (let i = 0; i < layer.b.length; i++) {
        let s = layer.b[i];
        for (let j = 0; j < aPrev.length; j++) s += layer.W[i][j] * aPrev[j];
        z[i] = s;
      }

      Zs.push(z);

      if (li === model.layers.length - 1) {
        As.push(z);
      } else {
        const a = new Float32Array(z.length);
        for (let i = 0; i < z.length; i++) a[i] = activation(z[i]);
        As.push(a);
      }
    }

    return { yhat: As[As.length - 1][0], As, Zs };
  }

  function predict(x) {
    if (!model) return 0;
    return forwardDetailed(x).yhat;
  }

  function evaluateSubset(indices) {
    if (!indices.length || !model) return NaN;
    let loss = 0;
    for (const idx of indices) {
      const p = points[idx];
      const yhat = predict(p.x);
      const err = yhat - p.y;
      loss += err * err;
    }
    return loss / indices.length;
  }

  function evaluateAll() {
    if (!model || !trainIdx.length) return null;
    return {
      train: evaluateSubset(trainIdx),
      val: evaluateSubset(valIdx),
    };
  }

  function createGradBuffer() {
    return model.layers.map((layer) => ({
      dW: layer.W.map((row) => new Float32Array(row.length)),
      db: new Float32Array(layer.b.length),
    }));
  }

  function trainEpoch() {
    if (!model || !trainIdx.length) return null;

    const lr = Math.max(1e-5, parseFloat($("#lr").val()) || 0.01);
    const batch = Math.max(1, parseInt($("#batch").val(), 10) || 16);
    const l2 = Math.max(0, parseFloat($("#l2").val()) || 0);

    const indices = trainIdx.slice();
    for (let i = indices.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [indices[i], indices[j]] = [indices[j], indices[i]];
    }

    for (let start = 0; start < indices.length; start += batch) {
      const bIdx = indices.slice(start, start + batch);
      const grads = createGradBuffer();

      for (const idx of bIdx) {
        const sample = points[idx];
        const fd = forwardDetailed(sample.x);

        let delta = new Float32Array([2 * (fd.yhat - sample.y)]);

        for (let li = model.layers.length - 1; li >= 0; li--) {
          const layer = model.layers[li];
          const g = grads[li];
          const aPrev = fd.As[li];

          for (let i = 0; i < delta.length; i++) {
            g.db[i] += delta[i];
            for (let j = 0; j < aPrev.length; j++) g.dW[i][j] += delta[i] * aPrev[j];
          }

          if (li > 0) {
            const prevDim = model.layers[li - 1].b.length;
            const nextDelta = new Float32Array(prevDim);
            for (let j = 0; j < prevDim; j++) {
              let s = 0;
              for (let i = 0; i < delta.length; i++) s += layer.W[i][j] * delta[i];
              nextDelta[j] = s * activationDeriv(fd.Zs[li - 1][j]);
            }
            delta = nextDelta;
          }
        }
      }

      const bs = bIdx.length;
      for (let li = 0; li < model.layers.length; li++) {
        const layer = model.layers[li];
        const g = grads[li];
        for (let i = 0; i < layer.W.length; i++) {
          for (let j = 0; j < layer.W[i].length; j++) {
            const reg = l2 * layer.W[i][j];
            layer.W[i][j] -= (lr / bs) * (g.dW[i][j] + reg);
          }
          layer.b[i] -= (lr / bs) * g.db[i];
        }
      }
    }

    epoch += 1;
    return evaluateAll();
  }

  function pushHistory(stats) {
    historyTrain.push(stats.train);
    historyVal.push(stats.val);
    updateStats(stats);
    drawLoss();
  }

  function drawLoss() {
    lossCtx.clearRect(0, 0, lw(), lh());
    if (historyTrain.length < 2) return;

    const W = lw();
    const H = lh();
    const pad = { l: 36, r: 14, t: 16, b: 22 };

    const chartW = W - pad.l - pad.r;
    const chartH = H - pad.t - pad.b;

    const allVals = historyTrain.slice();
    historyVal.forEach((v) => {
      if (Number.isFinite(v)) allVals.push(v);
    });

    const minV = Math.min(...allVals);
    const maxV = Math.max(...allVals);
    const span = Math.max(1e-9, maxV - minV);

    lossCtx.strokeStyle = "#94a3b8";
    lossCtx.beginPath();
    lossCtx.moveTo(pad.l, pad.t);
    lossCtx.lineTo(pad.l, H - pad.b);
    lossCtx.lineTo(W - pad.r, H - pad.b);
    lossCtx.stroke();

    function drawSeries(arr, color) {
      lossCtx.strokeStyle = color;
      lossCtx.lineWidth = 1.7;
      lossCtx.beginPath();
      for (let i = 0; i < arr.length; i++) {
        if (!Number.isFinite(arr[i])) continue;
        const x = pad.l + (i / (arr.length - 1)) * chartW;
        const y = pad.t + (1 - (arr[i] - minV) / span) * chartH;
        if (i === 0 || !Number.isFinite(arr[i - 1])) lossCtx.moveTo(x, y);
        else lossCtx.lineTo(x, y);
      }
      lossCtx.stroke();
    }

    drawSeries(historyTrain, "#2563eb");
    drawSeries(historyVal, "#f59e0b");

    lossCtx.fillStyle = "#475569";
    lossCtx.font = "12px sans-serif";
    lossCtx.fillText("Train (blue) / Validation (orange)", 6, 13);
    lossCtx.fillText("Epoch", W - 52, H - 6);
  }

  function drawAxes() {
    const c = worldToCanvas(0, 0);
    ctx.strokeStyle = "#94a3b8";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(c.cx, 0);
    ctx.lineTo(c.cx, ch());
    ctx.moveTo(0, c.cy);
    ctx.lineTo(cw(), c.cy);
    ctx.stroke();
  }

  function drawPoints() {
    for (const idx of valIdx) {
      const p = points[idx];
      const c = worldToCanvas(p.x, p.y);
      ctx.beginPath();
      ctx.arc(c.cx, c.cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = "#f59e0b";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.stroke();
    }

    for (const idx of trainIdx) {
      const p = points[idx];
      const c = worldToCanvas(p.x, p.y);
      ctx.beginPath();
      ctx.arc(c.cx, c.cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = "#2563eb";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.stroke();
    }
  }

  function drawPredictionCurve() {
    if (!model) return;

    ctx.strokeStyle = "#ef4444";
    ctx.lineWidth = 2;
    ctx.beginPath();

    let first = true;
    for (let x = XMIN; x <= XMAX; x += 0.1) {
      const y = predict(x);
      const p = worldToCanvas(x, y);
      if (first) {
        ctx.moveTo(p.cx, p.cy);
        first = false;
      } else {
        ctx.lineTo(p.cx, p.cy);
      }
    }
    ctx.stroke();
  }

  function drawTestMarker() {
    if (!testMarker) return;

    const obs = worldToCanvas(testMarker.x, testMarker.obsY);
    const pred = worldToCanvas(testMarker.x, testMarker.predY);

    ctx.beginPath();
    ctx.arc(obs.cx, obs.cy, 5, 0, Math.PI * 2);
    ctx.fillStyle = "#16a34a";
    ctx.fill();

    ctx.beginPath();
    ctx.arc(pred.cx, pred.cy, 6, 0, Math.PI * 2);
    ctx.fillStyle = "#eab308";
    ctx.fill();
    ctx.strokeStyle = "#0f172a";
    ctx.stroke();

    ctx.setLineDash([6, 4]);
    ctx.beginPath();
    ctx.moveTo(obs.cx, obs.cy);
    ctx.lineTo(pred.cx, pred.cy);
    ctx.strokeStyle = "rgba(15,23,42,0.6)";
    ctx.stroke();
    ctx.setLineDash([]);

    ctx.fillStyle = "#0f172a";
    ctx.font = "12px sans-serif";
    ctx.fillText(`pred=${testMarker.predY.toFixed(3)}`, pred.cx + 10, pred.cy - 10);
  }

  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, cw(), ch());

    drawAxes();
    drawPredictionCurve();
    drawPoints();
    drawTestMarker();
  }

  function updateStats(stats) {
    $("#countPts").text(points.length);
    $("#splitInfo").text(`${trainIdx.length} / ${valIdx.length}`);
    $("#epoch").text(epoch);

    if (!stats) {
      $("#trainLoss").text("-");
      $("#valLoss").text("-");
      return;
    }

    $("#trainLoss").text(Number.isFinite(stats.train) ? stats.train.toFixed(5) : "-");
    $("#valLoss").text(Number.isFinite(stats.val) ? stats.val.toFixed(5) : "-");
  }

  function resplitData(newSeed) {
    const ratio = Math.max(0, Math.min(0.5, parseFloat($("#valRatio").val()) || 0.3));
    $("#valRatio").val(ratio);

    if (newSeed) splitSeed = Math.floor(Math.random() * 1e9);

    trainIdx = [];
    valIdx = [];

    if (!points.length) {
      updateStats(null);
      return;
    }

    const idx = points.map((_, i) => i);
    const rand = mulberry32(splitSeed);
    for (let i = idx.length - 1; i > 0; i--) {
      const j = Math.floor(rand() * (i + 1));
      [idx[i], idx[j]] = [idx[j], idx[i]];
    }

    const valCount = points.length < 3 ? 0 : Math.min(points.length - 1, Math.floor(points.length * ratio));
    valIdx = idx.slice(0, valCount);
    trainIdx = idx.slice(valCount);

    updateStats(null);
  }

  function stopRun() {
    if (runTimer) {
      clearInterval(runTimer);
      runTimer = null;
    }
  }

  function runTraining(epochsToRun) {
    if (!model) initModel();
    if (!trainIdx.length) return;

    let done = 0;
    runTimer = setInterval(function () {
      const stats = trainEpoch();
      if (stats) pushHistory(stats);
      render();

      done += 1;
      if (done >= epochsToRun) stopRun();
    }, 40);
  }

  function loadDemo(type) {
    points = [];
    const n = 96;

    for (let i = 0; i < n; i++) {
      const x = -8 + (16 * i) / (n - 1) + (Math.random() * 2 - 1) * 0.15;
      let y = 0;

      if (type === "cubic") {
        y = 0.04 * x * x * x - 0.45 * x + (Math.random() * 2 - 1) * 0.8;
      } else if (type === "piecewise") {
        y = x < 0 ? -1.5 + 0.55 * x : 1 + 0.25 * x + 1.3 * Math.sin(0.9 * x);
        y += (Math.random() * 2 - 1) * 0.7;
      } else {
        y = 3.1 * Math.sin(0.72 * x) + 0.07 * x + (Math.random() * 2 - 1) * 0.7;
      }

      points.push({ x, y });
    }

    resplitData(true);
    resetTrainingState();
    render();
  }

  canvas.addEventListener("click", function (e) {
    const pos = clientToCanvas(e.clientX, e.clientY);
    const world = canvasToWorld(pos.cx, pos.cy);

    if (mode === "test") {
      const predY = predict(world.x);
      testMarker = { x: world.x, obsY: world.y, predY };
      render();
      return;
    }

    points.push({ x: world.x, y: world.y });
    resplitData(true);
    resetTrainingState();
    render();
  });

  canvas.addEventListener("contextmenu", function (e) {
    e.preventDefault();
    if (!points.length) return;

    const pos = clientToCanvas(e.clientX, e.clientY);
    const world = canvasToWorld(pos.cx, pos.cy);

    let bestIdx = -1;
    let bestD = Infinity;
    points.forEach((p, i) => {
      const d2 = (p.x - world.x) * (p.x - world.x) + (p.y - world.y) * (p.y - world.y);
      if (d2 < bestD) {
        bestD = d2;
        bestIdx = i;
      }
    });

    if (bestIdx >= 0) {
      points.splice(bestIdx, 1);
      resplitData(true);
      resetTrainingState();
      render();
    }
  });

  $("#mode-add").on("click", function () {
    mode = "add";
    $("#mode-add").addClass("bg-slate-900 text-white");
    $("#mode-test").removeClass("bg-amber-100 border-amber-300 text-amber-900");
  });

  $("#mode-test").on("click", function () {
    mode = "test";
    $("#mode-add").removeClass("bg-slate-900 text-white");
    $("#mode-test").addClass("bg-amber-100 border-amber-300 text-amber-900");
  });

  $("#btn-clear").on("click", function () {
    stopRun();
    points = [];
    trainIdx = [];
    valIdx = [];
    model = null;
    resetTrainingState();
    render();
  });

  $("#btn-demo").on("click", function () {
    stopRun();
    loadDemo($("#demoType").val());
  });

  $("#btn-init").on("click", function () {
    initModel();
    render();
  });

  $("#btn-step").on("click", function () {
    stopRun();
    if (!model) initModel();
    const stats = trainEpoch();
    if (stats) pushHistory(stats);
    render();
  });

  $("#btn-run").on("click", function () {
    if (runTimer) return;
    const epochsToRun = Math.max(1, parseInt($("#epochs").val(), 10) || 200);
    runTraining(epochsToRun);
  });

  $("#btn-stop").on("click", stopRun);

  $("#valRatio").on("change", function () {
    resplitData(false);
    resetTrainingState();
    render();
  });

  $("#hiddenLayers, #hiddenUnits, #activation, #l2").on("change", function () {
    stopRun();
    initModel();
    render();
  });

  $(window).on("resize", function () {
    ctx = setupHiDPI(canvas);
    lossCtx = setupHiDPI(lossCanvas);
    render();
    drawLoss();
  });

  resplitData(true);
  initModel();
  loadDemo("sine");
});
