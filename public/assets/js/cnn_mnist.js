$(function () {
  const INPUT_SIZE = 28;
  const FILTER_SIZE = 3;
  const NUM_CLASSES = 10;

  let CONV_F = 4;
  let HIDDEN = 32;

  let convOutSize = INPUT_SIZE - FILTER_SIZE + 1;
  let convOutLen = convOutSize * convOutSize * CONV_F;

  let convW = [];
  let convB = null;
  let W1 = null;
  let b1 = null;
  let W2 = null;
  let b2 = null;

  let vConvW = [];
  let vConvB = null;
  let vW1 = null;
  let vB1 = null;
  let vW2 = null;
  let vB2 = null;

  let dataset = [];
  let loadedPerClass = 0;
  let epoch = 0;
  let lossHistory = [];
  let accHistory = [];
  let runTimer = null;

  const drawCanvas = document.getElementById("drawCanvas");
  const drawCtx = drawCanvas.getContext("2d");

  function randn() {
    let u = 0;
    let v = 0;
    while (u === 0) u = Math.random();
    while (v === 0) v = Math.random();
    return Math.sqrt(-2 * Math.log(u)) * Math.cos(2 * Math.PI * v);
  }

  function createMatrix(r, c) {
    const m = new Array(r);
    for (let i = 0; i < r; i++) m[i] = new Float32Array(c);
    return m;
  }

  function createFilterBank(fCount, size) {
    const bank = [];
    for (let f = 0; f < fCount; f++) bank.push(createMatrix(size, size));
    return bank;
  }

  function resetDerivedShapes() {
    convOutSize = INPUT_SIZE - FILTER_SIZE + 1;
    convOutLen = convOutSize * convOutSize * CONV_F;
  }

  function initWeights() {
    resetDerivedShapes();

    convW = createFilterBank(CONV_F, FILTER_SIZE);
    convB = new Float32Array(CONV_F);
    for (let f = 0; f < CONV_F; f++) {
      for (let u = 0; u < FILTER_SIZE; u++) {
        for (let v = 0; v < FILTER_SIZE; v++) convW[f][u][v] = randn() * 0.08;
      }
      convB[f] = 0;
    }

    W1 = createMatrix(HIDDEN, convOutLen);
    b1 = new Float32Array(HIDDEN);
    for (let h = 0; h < HIDDEN; h++) {
      for (let j = 0; j < convOutLen; j++) W1[h][j] = randn() * 0.06;
      b1[h] = 0;
    }

    W2 = createMatrix(NUM_CLASSES, HIDDEN);
    b2 = new Float32Array(NUM_CLASSES);
    for (let c = 0; c < NUM_CLASSES; c++) {
      for (let j = 0; j < HIDDEN; j++) W2[c][j] = randn() * 0.06;
      b2[c] = 0;
    }

    vConvW = createFilterBank(CONV_F, FILTER_SIZE);
    vConvB = new Float32Array(CONV_F);
    vW1 = createMatrix(HIDDEN, convOutLen);
    vB1 = new Float32Array(HIDDEN);
    vW2 = createMatrix(NUM_CLASSES, HIDDEN);
    vB2 = new Float32Array(NUM_CLASSES);

    epoch = 0;
    lossHistory = [];
    accHistory = [];
    updateStats();
    drawCurves();
    renderConfusion(new Array(NUM_CLASSES).fill(0).map(() => new Array(NUM_CLASSES).fill(0)));
  }

  function showSpinner(on) {
    const sp = $("#loadingSpinner");
    if (on) sp.addClass("active");
    else sp.removeClass("active");
  }

  function datasetPath(label, idx) {
    return `/assets/demo/cnn_mnist/${label}/${label}_${String(idx).padStart(3, "0")}.png`;
  }

  function updateDatasetMeta() {
    $("#perClass").text(String(loadedPerClass));
    $("#dsSize").text(String(dataset.length));

    const counts = new Array(NUM_CLASSES).fill(0);
    dataset.forEach((d) => {
      counts[d.y] += 1;
    });
    $("#classDist").text(counts.map((v, i) => `${i}:${v}`).join("  "));

    if (loadedPerClass >= 50) $("#btn-add-10").prop("disabled", true).addClass("opacity-60");
    else $("#btn-add-10").prop("disabled", false).removeClass("opacity-60");
  }

  function updateStats(stats) {
    $("#epoch").text(String(epoch));
    $("#dsSize").text(String(dataset.length));

    if (!stats) {
      $("#loss").text("-");
      $("#acc").text("-");
      return;
    }

    $("#loss").text(stats.loss.toFixed(4));
    $("#acc").text(`${(stats.acc * 100).toFixed(1)}%`);
  }

  function setupHiDPI(cvs) {
    const dpr = window.devicePixelRatio || 1;
    const rect = cvs.getBoundingClientRect();
    cvs.width = Math.max(1, Math.round(rect.width * dpr));
    cvs.height = Math.max(1, Math.round(rect.height * dpr));
    const c = cvs.getContext("2d");
    c.setTransform(dpr, 0, 0, dpr, 0, 0);
    return c;
  }

  function drawCurves() {
    const canvas = document.getElementById("lossChart");
    const ctx = setupHiDPI(canvas);
    const W = canvas.getBoundingClientRect().width;
    const H = canvas.getBoundingClientRect().height;

    ctx.clearRect(0, 0, W, H);

    const pad = { l: 34, r: 16, t: 16, b: 24 };
    ctx.strokeStyle = "#94a3b8";
    ctx.beginPath();
    ctx.moveTo(pad.l, pad.t);
    ctx.lineTo(pad.l, H - pad.b);
    ctx.lineTo(W - pad.r, H - pad.b);
    ctx.stroke();

    if (lossHistory.length < 2) return;

    const drawLine = (arr, color, yMin, yMax) => {
      const span = Math.max(1e-9, yMax - yMin);
      const chartW = W - pad.l - pad.r;
      const chartH = H - pad.t - pad.b;
      ctx.strokeStyle = color;
      ctx.lineWidth = 1.6;
      ctx.beginPath();
      for (let i = 0; i < arr.length; i++) {
        const x = pad.l + (i / (arr.length - 1)) * chartW;
        const y = pad.t + (1 - (arr[i] - yMin) / span) * chartH;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
    };

    const maxLoss = Math.max(...lossHistory);
    const minLoss = Math.min(...lossHistory);
    drawLine(lossHistory, "#2563eb", minLoss, maxLoss + 1e-6);

    const maxAcc = Math.max(...accHistory);
    const minAcc = Math.min(...accHistory);
    drawLine(accHistory, "#16a34a", minAcc, maxAcc + 1e-6);

    ctx.fillStyle = "#475569";
    ctx.font = "12px sans-serif";
    ctx.fillText("Loss (blue) / Acc (green)", 6, 13);
    ctx.fillText("Epoch", W - 50, H - 6);
  }

  function renderConfusion(cm) {
    let html = '<table class="min-w-full text-xs border border-slate-200">';
    html += '<thead><tr><th class="border border-slate-200 p-1 bg-slate-50">T\\P</th>';
    for (let c = 0; c < NUM_CLASSES; c++) html += `<th class="border border-slate-200 p-1 bg-slate-50">${c}</th>`;
    html += "</tr></thead><tbody>";

    for (let r = 0; r < NUM_CLASSES; r++) {
      html += `<tr><th class="border border-slate-200 p-1 bg-slate-50">${r}</th>`;
      for (let c = 0; c < NUM_CLASSES; c++) {
        html += `<td class="border border-slate-200 p-1 text-center">${cm[r][c]}</td>`;
      }
      html += "</tr>";
    }
    html += "</tbody></table>";
    $("#confusionWrap").html(html);
  }

  function normalizeVector(grayValues) {
    let mean = 0;
    for (let i = 0; i < grayValues.length; i++) mean += grayValues[i];
    mean /= grayValues.length;
    const invert = mean > 0.5;

    const out = new Float32Array(grayValues.length);
    for (let i = 0; i < grayValues.length; i++) out[i] = invert ? 1 - grayValues[i] : grayValues[i];
    return out;
  }

  async function loadImageVector(src) {
    return new Promise((resolve) => {
      const img = new Image();
      img.crossOrigin = "Anonymous";
      img.onload = function () {
        const c = document.createElement("canvas");
        c.width = INPUT_SIZE;
        c.height = INPUT_SIZE;
        const ctx = c.getContext("2d");
        ctx.drawImage(img, 0, 0, INPUT_SIZE, INPUT_SIZE);
        const data = ctx.getImageData(0, 0, INPUT_SIZE, INPUT_SIZE).data;

        const raw = new Float32Array(INPUT_SIZE * INPUT_SIZE);
        for (let i = 0; i < raw.length; i++) {
          const r = data[i * 4];
          const g = data[i * 4 + 1];
          const b = data[i * 4 + 2];
          raw[i] = (r + g + b) / (3 * 255);
        }

        resolve(normalizeVector(raw));
      };
      img.onerror = function () {
        resolve(null);
      };
      img.src = src;
    });
  }

  function renderSampleGrid() {
    const grid = $("#sampleGrid");
    grid.empty();

    dataset.forEach((item, idx) => {
      const tag = `<div class="text-center"><img src="${item.src}" class="mx-auto h-8 w-8 rounded border border-slate-200 bg-black object-cover"><p class="text-[10px] text-slate-500">${item.y}</p></div>`;
      grid.append(tag);
      if (idx > 499) return false;
      return true;
    });
  }

  async function loadDataRange(start, end) {
    showSpinner(true);

    for (let label = 0; label < NUM_CLASSES; label++) {
      for (let i = start; i <= end; i++) {
        const src = datasetPath(label, i);
        const x = await loadImageVector(src);
        if (!x) continue;
        dataset.push({ x, y: label, src });
      }
    }

    showSpinner(false);
    loadedPerClass = Math.max(loadedPerClass, end);
    updateDatasetMeta();
    renderSampleGrid();
    updateStats();
  }

  async function loadBaseData() {
    stopRun();
    dataset = [];
    loadedPerClass = 0;
    await loadDataRange(1, 10);
  }

  async function addMoreData() {
    if (loadedPerClass >= 50) return;
    const start = loadedPerClass + 1;
    const end = Math.min(50, loadedPerClass + 10);
    await loadDataRange(start, end);
  }

  function forward(x) {
    const convOut = new Array(CONV_F);

    for (let f = 0; f < CONV_F; f++) {
      convOut[f] = createMatrix(convOutSize, convOutSize);
      for (let i = 0; i < convOutSize; i++) {
        for (let j = 0; j < convOutSize; j++) {
          let s = convB[f];
          for (let u = 0; u < FILTER_SIZE; u++) {
            for (let v = 0; v < FILTER_SIZE; v++) s += convW[f][u][v] * x[(i + u) * INPUT_SIZE + (j + v)];
          }
          convOut[f][i][j] = Math.max(0, s);
        }
      }
    }

    const zconv = new Float32Array(convOutLen);
    let k = 0;
    for (let f = 0; f < CONV_F; f++) {
      for (let i = 0; i < convOutSize; i++) {
        for (let j = 0; j < convOutSize; j++) zconv[k++] = convOut[f][i][j];
      }
    }

    const z1 = new Float32Array(HIDDEN);
    const a1 = new Float32Array(HIDDEN);
    for (let h = 0; h < HIDDEN; h++) {
      let s = b1[h];
      for (let j = 0; j < convOutLen; j++) s += W1[h][j] * zconv[j];
      z1[h] = s;
      a1[h] = Math.max(0, s);
    }

    const z2 = new Float32Array(NUM_CLASSES);
    const a2 = new Float32Array(NUM_CLASSES);
    for (let c = 0; c < NUM_CLASSES; c++) {
      let s = b2[c];
      for (let h = 0; h < HIDDEN; h++) s += W2[c][h] * a1[h];
      z2[c] = s;
    }

    const maxz = Math.max(...z2);
    let sum = 0;
    for (let c = 0; c < NUM_CLASSES; c++) {
      a2[c] = Math.exp(z2[c] - maxz);
      sum += a2[c];
    }
    for (let c = 0; c < NUM_CLASSES; c++) a2[c] /= sum;

    return { convOut, zconv, z1, a1, a2 };
  }

  function applyGrad(param, grad, vel, lr, bs, mu, useMomentum) {
    if (useMomentum) {
      const v = mu * vel + (-lr / bs) * grad;
      return [param + v, v];
    }
    return [param - (lr / bs) * grad, vel];
  }

  function trainEpoch() {
    if (!dataset.length) return null;

    const batch = Math.max(1, parseInt($("#batch").val(), 10) || 16);
    const lr = Math.max(1e-5, parseFloat($("#lr").val()) || 0.01);
    const optimizer = $("#optimizer").val();
    const useMomentum = optimizer === "momentum";
    const mu = Math.min(0.99, Math.max(0, parseFloat($("#momentum").val()) || 0.9));

    const idx = dataset.map((_, i) => i);
    for (let i = idx.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [idx[i], idx[j]] = [idx[j], idx[i]];
    }

    for (let start = 0; start < idx.length; start += batch) {
      const b = idx.slice(start, start + batch);

      const dW2 = createMatrix(NUM_CLASSES, HIDDEN);
      const db2 = new Float32Array(NUM_CLASSES);
      const dW1 = createMatrix(HIDDEN, convOutLen);
      const db1 = new Float32Array(HIDDEN);
      const dConvW = createFilterBank(CONV_F, FILTER_SIZE);
      const dConvB = new Float32Array(CONV_F);

      for (const id of b) {
        const sample = dataset[id];
        const { convOut, zconv, z1, a1, a2 } = forward(sample.x);

        const dz2 = new Float32Array(NUM_CLASSES);
        for (let c = 0; c < NUM_CLASSES; c++) dz2[c] = a2[c] - (c === sample.y ? 1 : 0);

        for (let c = 0; c < NUM_CLASSES; c++) {
          db2[c] += dz2[c];
          for (let h = 0; h < HIDDEN; h++) dW2[c][h] += dz2[c] * a1[h];
        }

        const da1 = new Float32Array(HIDDEN);
        for (let h = 0; h < HIDDEN; h++) {
          let s = 0;
          for (let c = 0; c < NUM_CLASSES; c++) s += W2[c][h] * dz2[c];
          da1[h] = s;
        }

        const dz1 = new Float32Array(HIDDEN);
        for (let h = 0; h < HIDDEN; h++) dz1[h] = z1[h] > 0 ? da1[h] : 0;

        for (let h = 0; h < HIDDEN; h++) {
          db1[h] += dz1[h];
          for (let j = 0; j < convOutLen; j++) dW1[h][j] += dz1[h] * zconv[j];
        }

        const dzconv = new Float32Array(convOutLen);
        for (let j = 0; j < convOutLen; j++) {
          let s = 0;
          for (let h = 0; h < HIDDEN; h++) s += W1[h][j] * dz1[h];
          dzconv[j] = s;
        }

        let p = 0;
        const dconv = new Array(CONV_F);
        for (let f = 0; f < CONV_F; f++) {
          dconv[f] = createMatrix(convOutSize, convOutSize);
          for (let i = 0; i < convOutSize; i++) {
            for (let j = 0; j < convOutSize; j++) {
              const g = dzconv[p++];
              dconv[f][i][j] = convOut[f][i][j] > 0 ? g : 0;
            }
          }
        }

        for (let f = 0; f < CONV_F; f++) {
          for (let u = 0; u < FILTER_SIZE; u++) {
            for (let v = 0; v < FILTER_SIZE; v++) {
              let s = 0;
              for (let i = 0; i < convOutSize; i++) {
                for (let j = 0; j < convOutSize; j++) s += dconv[f][i][j] * sample.x[(i + u) * INPUT_SIZE + (j + v)];
              }
              dConvW[f][u][v] += s;
            }
          }

          for (let i = 0; i < convOutSize; i++) {
            for (let j = 0; j < convOutSize; j++) dConvB[f] += dconv[f][i][j];
          }
        }
      }

      const bs = b.length;

      for (let c = 0; c < NUM_CLASSES; c++) {
        for (let h = 0; h < HIDDEN; h++) {
          const out = applyGrad(W2[c][h], dW2[c][h], vW2[c][h], lr, bs, mu, useMomentum);
          W2[c][h] = out[0];
          vW2[c][h] = out[1];
        }
        const outB = applyGrad(b2[c], db2[c], vB2[c], lr, bs, mu, useMomentum);
        b2[c] = outB[0];
        vB2[c] = outB[1];
      }

      for (let h = 0; h < HIDDEN; h++) {
        for (let j = 0; j < convOutLen; j++) {
          const out = applyGrad(W1[h][j], dW1[h][j], vW1[h][j], lr, bs, mu, useMomentum);
          W1[h][j] = out[0];
          vW1[h][j] = out[1];
        }
        const outB = applyGrad(b1[h], db1[h], vB1[h], lr, bs, mu, useMomentum);
        b1[h] = outB[0];
        vB1[h] = outB[1];
      }

      for (let f = 0; f < CONV_F; f++) {
        for (let u = 0; u < FILTER_SIZE; u++) {
          for (let v = 0; v < FILTER_SIZE; v++) {
            const out = applyGrad(convW[f][u][v], dConvW[f][u][v], vConvW[f][u][v], lr, bs, mu, useMomentum);
            convW[f][u][v] = out[0];
            vConvW[f][u][v] = out[1];
          }
        }
        const outB = applyGrad(convB[f], dConvB[f], vConvB[f], lr, bs, mu, useMomentum);
        convB[f] = outB[0];
        vConvB[f] = outB[1];
      }
    }

    epoch += 1;
    return evaluateDataset();
  }

  function evaluateDataset() {
    if (!dataset.length) {
      const empty = new Array(NUM_CLASSES).fill(0).map(() => new Array(NUM_CLASSES).fill(0));
      return { loss: 0, acc: 0, confusion: empty };
    }

    let loss = 0;
    let correct = 0;
    const cm = new Array(NUM_CLASSES).fill(0).map(() => new Array(NUM_CLASSES).fill(0));

    dataset.forEach((item) => {
      const out = forward(item.x).a2;
      loss -= Math.log(Math.max(1e-12, out[item.y]));
      let pred = 0;
      for (let i = 1; i < NUM_CLASSES; i++) if (out[i] > out[pred]) pred = i;
      if (pred === item.y) correct += 1;
      cm[item.y][pred] += 1;
    });

    return { loss: loss / dataset.length, acc: correct / dataset.length, confusion: cm };
  }

  function commitStats(stats) {
    if (!stats) return;
    lossHistory.push(stats.loss);
    accHistory.push(stats.acc);
    updateStats(stats);
    drawCurves();
    renderConfusion(stats.confusion);
  }

  function stopRun() {
    if (runTimer) {
      clearInterval(runTimer);
      runTimer = null;
    }
  }

  function applyArchitecture() {
    stopRun();
    CONV_F = Math.max(2, Math.min(8, parseInt($("#convFilters").val(), 10) || 4));
    HIDDEN = Math.max(8, Math.min(96, parseInt($("#hiddenUnits").val(), 10) || 32));
    $("#convFilters").val(CONV_F);
    $("#hiddenUnits").val(HIDDEN);
    initWeights();
  }

  function clearDrawCanvas() {
    drawCtx.fillStyle = "#000000";
    drawCtx.fillRect(0, 0, drawCanvas.width, drawCanvas.height);
  }

  function setupDrawCanvas() {
    clearDrawCanvas();

    let drawing = false;
    let lastPoint = null;
    const brushRadius = 15;
    const feather = 0.55;

    function posFromEvent(e) {
      const rect = drawCanvas.getBoundingClientRect();
      const clientX = e.clientX ?? e.touches?.[0]?.clientX;
      const clientY = e.clientY ?? e.touches?.[0]?.clientY;
      return { x: clientX - rect.left, y: clientY - rect.top };
    }

    function drawSoftPoint(x, y) {
      const g = drawCtx.createRadialGradient(x, y, brushRadius * feather, x, y, brushRadius);
      g.addColorStop(0, "rgba(255,255,255,0.95)");
      g.addColorStop(1, "rgba(255,255,255,0.08)");
      drawCtx.fillStyle = g;
      drawCtx.beginPath();
      drawCtx.arc(x, y, brushRadius, 0, Math.PI * 2);
      drawCtx.fill();
    }

    function drawStrokeSegment(a, b) {
      const dx = b.x - a.x;
      const dy = b.y - a.y;
      const dist = Math.hypot(dx, dy);
      const step = Math.max(1, brushRadius * 0.22);
      const n = Math.max(1, Math.ceil(dist / step));
      for (let i = 0; i <= n; i++) {
        const t = i / n;
        drawSoftPoint(a.x + dx * t, a.y + dy * t);
      }
    }

    function start(e) {
      drawing = true;
      const p = posFromEvent(e);
      const c = {
        x: p.x * (drawCanvas.width / drawCanvas.getBoundingClientRect().width),
        y: p.y * (drawCanvas.height / drawCanvas.getBoundingClientRect().height),
      };
      drawSoftPoint(c.x, c.y);
      lastPoint = c;
      e.preventDefault();
    }

    function move(e) {
      if (!drawing) return;
      const p = posFromEvent(e);
      const c = {
        x: p.x * (drawCanvas.width / drawCanvas.getBoundingClientRect().width),
        y: p.y * (drawCanvas.height / drawCanvas.getBoundingClientRect().height),
      };
      if (lastPoint) drawStrokeSegment(lastPoint, c);
      else drawSoftPoint(c.x, c.y);
      lastPoint = c;
      e.preventDefault();
    }

    function end() {
      drawing = false;
      lastPoint = null;
    }

    drawCanvas.addEventListener("mousedown", start);
    drawCanvas.addEventListener("mousemove", move);
    window.addEventListener("mouseup", end);
    drawCanvas.addEventListener("touchstart", start, { passive: false });
    drawCanvas.addEventListener("touchmove", move, { passive: false });
    window.addEventListener("touchend", end);
  }

  function vectorFromDrawCanvas() {
    const small = document.createElement("canvas");
    small.width = INPUT_SIZE;
    small.height = INPUT_SIZE;
    const ctx = small.getContext("2d");
    ctx.drawImage(drawCanvas, 0, 0, INPUT_SIZE, INPUT_SIZE);

    const data = ctx.getImageData(0, 0, INPUT_SIZE, INPUT_SIZE).data;
    const vec = new Float32Array(INPUT_SIZE * INPUT_SIZE);
    for (let i = 0; i < vec.length; i++) {
      const r = data[i * 4];
      const g = data[i * 4 + 1];
      const b = data[i * 4 + 2];
      vec[i] = (r + g + b) / (3 * 255);
    }

    return { vec, preview: small.toDataURL() };
  }

  function predictDrawnDigit() {
    if (!dataset.length) {
      $("#drawPred").text("Load data first.");
      return;
    }

    const sample = vectorFromDrawCanvas();
    const out = forward(sample.vec).a2;

    let pred = 0;
    for (let i = 1; i < NUM_CLASSES; i++) if (out[i] > out[pred]) pred = i;

    const ranked = Array.from(out).map((p, i) => ({ i, p })).sort((a, b) => b.p - a.p).slice(0, 3);

    $("#drawPred").text(`Prediction: ${pred}`);
    $("#drawTop3").html(ranked.map((r) => `<li>${r.i}: ${(r.p * 100).toFixed(2)}%</li>`).join(""));
    $("#drawPreview").html(`<img src="${sample.preview}" class="h-20 w-20 rounded border border-slate-200" style="image-rendering:pixelated;">`);
  }

  $("#btn-load-base").on("click", loadBaseData);
  $("#btn-add-10").on("click", addMoreData);
  $("#btn-clear-data").on("click", function () {
    stopRun();
    dataset = [];
    loadedPerClass = 0;
    $("#sampleGrid").empty();
    updateDatasetMeta();
    updateStats();
    renderConfusion(new Array(NUM_CLASSES).fill(0).map(() => new Array(NUM_CLASSES).fill(0)));
  });

  $("#btn-init").on("click", initWeights);
  $("#btn-apply-arch").on("click", applyArchitecture);

  $("#btn-step").on("click", function () {
    const stats = trainEpoch();
    commitStats(stats);
  });

  $("#btn-run").on("click", function () {
    if (runTimer) return;
    const total = Math.max(1, parseInt($("#epochs").val(), 10) || 8);
    let done = 0;

    runTimer = setInterval(function () {
      const stats = trainEpoch();
      commitStats(stats);
      done += 1;
      if (done >= total) stopRun();
    }, 130);
  });

  $("#btn-stop").on("click", stopRun);

  $("#btn-clear-draw").on("click", function () {
    clearDrawCanvas();
    $("#drawPred").text("-");
    $("#drawTop3").empty();
    $("#drawPreview").empty();
  });
  $("#btn-predict-draw").on("click", predictDrawnDigit);

  $(window).on("resize", drawCurves);

  setupDrawCanvas();
  initWeights();
  updateDatasetMeta();
  loadBaseData();
});
