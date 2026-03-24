$(function () {
  const canvas = document.getElementById("svmCanvas");

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

  const XMIN = -5;
  const XMAX = 5;
  const YMIN = -5;
  const YMAX = 5;

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;

  function clientToCanvas(clientX, clientY) {
    const rect = canvas.getBoundingClientRect();
    return { cx: clientX - rect.left, cy: clientY - rect.top };
  }

  function canvasToWorld(cx, cy) {
    return {
      x: (cx / cw()) * (XMAX - XMIN) + XMIN,
      y: (1 - cy / ch()) * (YMAX - YMIN) + YMIN,
    };
  }

  function worldToCanvas(x, y) {
    return {
      cx: ((x - XMIN) / (XMAX - XMIN)) * cw(),
      cy: (1 - (y - YMIN) / (YMAX - YMIN)) * ch(),
    };
  }

  function clamp(v, lo, hi) {
    return Math.max(lo, Math.min(hi, v));
  }

  let points = [];
  let currentLabel = -1;
  let linearModel = { w: [0, 0], b: 0 };
  let kernelModel = { support: [] };
  let runInterval = null;
  let epochCounter = 0;

  function updateKernelParamsVisibility() {
    const model = $("#modelType").val();
    if (model === "kernel_perceptron") $("#kernelParams").show();
    else $("#kernelParams").hide();
  }

  function setClassButtons() {
    if (currentLabel === -1) {
      $("#btn-classA").addClass("bg-cyan-100 border-cyan-300 text-cyan-900");
      $("#btn-classB").removeClass("bg-red-100 border-red-300 text-red-900");
    } else {
      $("#btn-classB").addClass("bg-red-100 border-red-300 text-red-900");
      $("#btn-classA").removeClass("bg-cyan-100 border-cyan-300 text-cyan-900");
    }
  }

  function updateCounts() {
    $("#countA").text(points.filter((p) => p.label === -1).length);
    $("#countB").text(points.filter((p) => p.label === 1).length);
  }

  function resetLinear() {
    linearModel = { w: [0, 0], b: 0 };
  }

  function resetKernel() {
    kernelModel = { support: [] };
  }

  function resetEpochInfo() {
    epochCounter = 0;
    $("#curEpoch").text("0");
    $("#lastAcc").text("-");
  }

  function kernelRBF(x1, y1, x2, y2, gamma) {
    const dx = x1 - x2;
    const dy = y1 - y2;
    return Math.exp(-gamma * (dx * dx + dy * dy));
  }

  function kernelPoly(x1, y1, x2, y2, degree) {
    const dot = x1 * x2 + y1 * y2;
    return Math.pow(dot + 1, degree);
  }

  function score(x, y, mode) {
    if (mode === "linear") return linearModel.w[0] * x + linearModel.w[1] * y + linearModel.b;

    const kernel = $("#kernel").val();
    const gamma = parseFloat($("#gamma").val()) || 1.0;
    const degree = Math.max(1, parseInt($("#degree").val(), 10) || 3);

    let s = 0;
    kernelModel.support.forEach((sv) => {
      const k = kernel === "rbf"
        ? kernelRBF(sv.x, sv.y, x, y, gamma)
        : kernelPoly(sv.x, sv.y, x, y, degree);
      s += sv.alpha * sv.label * k;
    });
    return s;
  }

  function computeAccuracy(mode) {
    if (!points.length) return 0;
    let correct = 0;
    points.forEach((p) => {
      const pred = score(p.x, p.y, mode) >= 0 ? 1 : -1;
      if (pred === p.label) correct += 1;
    });
    return correct / points.length;
  }

  function linearStep() {
    if (!points.length) return;

    const lambda = Math.max(0, parseFloat($("#lambda").val()) || 0.0001);
    const eta = Math.max(1e-6, parseFloat($("#lr").val()) || 0.5);

    const idx = points.map((_, i) => i);
    for (let i = idx.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [idx[i], idx[j]] = [idx[j], idx[i]];
    }

    idx.forEach((i) => {
      const p = points[i];
      const wxb = linearModel.w[0] * p.x + linearModel.w[1] * p.y + linearModel.b;
      const margin = p.label * wxb;

      linearModel.w[0] *= 1 - eta * lambda;
      linearModel.w[1] *= 1 - eta * lambda;

      if (margin < 1) {
        linearModel.w[0] += eta * p.label * p.x;
        linearModel.w[1] += eta * p.label * p.y;
        linearModel.b += eta * p.label;
      }
    });

    epochCounter += 1;
    const acc = computeAccuracy("linear");
    $("#curEpoch").text(String(epochCounter));
    $("#lastAcc").text(`${(acc * 100).toFixed(1)}%`);
    $("#modelInfo").text(`Linear SVM\nw = [${linearModel.w[0].toFixed(4)}, ${linearModel.w[1].toFixed(4)}]\nb = ${linearModel.b.toFixed(4)}`);
    render();
  }

  function kernelStep() {
    if (!points.length) return;

    const kernel = $("#kernel").val();
    const gamma = parseFloat($("#gamma").val()) || 1.0;
    const degree = Math.max(1, parseInt($("#degree").val(), 10) || 3);

    points.forEach((p) => {
      let s = 0;
      kernelModel.support.forEach((sv) => {
        const k = kernel === "rbf"
          ? kernelRBF(sv.x, sv.y, p.x, p.y, gamma)
          : kernelPoly(sv.x, sv.y, p.x, p.y, degree);
        s += sv.alpha * sv.label * k;
      });
      if (p.label * s <= 0) kernelModel.support.push({ x: p.x, y: p.y, label: p.label, alpha: 1 });
    });

    epochCounter += 1;
    const acc = computeAccuracy("kernel");
    $("#curEpoch").text(String(epochCounter));
    $("#lastAcc").text(`${(acc * 100).toFixed(1)}%`);
    $("#modelInfo").text(`Kernel Perceptron\nKernel: ${kernel}\nSupport vectors: ${kernelModel.support.length}`);
    render();
  }

  function drawRegions(model) {
    const res = 140;
    const stepX = Math.max(1, Math.floor(cw() / res));
    const stepY = Math.max(1, Math.floor(ch() / Math.max(1, Math.round((res * ch()) / cw()))));

    for (let gx = 0; gx < cw(); gx += stepX) {
      for (let gy = 0; gy < ch(); gy += stepY) {
        const w = canvasToWorld(gx + 0.5, gy + 0.5);
        const s = score(w.x, w.y, model);
        const p = 1 / (1 + Math.exp(-s));
        const red = Math.round(220 * p + 50 * (1 - p));
        const green = Math.round(60 * (1 - p));
        const blue = Math.round(220 * (1 - p) + 50 * p);
        ctx.fillStyle = `rgba(${red},${green},${blue},0.30)`;
        ctx.fillRect(gx, gy, stepX, stepY);
      }
    }
  }

  function drawAxes() {
    const center = worldToCanvas(0, 0);
    ctx.strokeStyle = "#94a3b8";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(center.cx, 0);
    ctx.lineTo(center.cx, ch());
    ctx.moveTo(0, center.cy);
    ctx.lineTo(cw(), center.cy);
    ctx.stroke();
  }

  function drawPoints() {
    points.forEach((p) => {
      const c = worldToCanvas(p.x, p.y);
      ctx.beginPath();
      ctx.arc(c.cx, c.cy, 5.8, 0, Math.PI * 2);
      ctx.fillStyle = p.label === 1 ? "#ef4444" : "#06b6d4";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = 1;
      ctx.stroke();
    });
  }

  function lineEndpoints(w0, w1, b0) {
    const pts = [];

    if (Math.abs(w1) > 1e-8) {
      const yAtMinX = (-b0 - w0 * XMIN) / w1;
      const yAtMaxX = (-b0 - w0 * XMAX) / w1;
      if (yAtMinX >= YMIN && yAtMinX <= YMAX) pts.push({ x: XMIN, y: yAtMinX });
      if (yAtMaxX >= YMIN && yAtMaxX <= YMAX) pts.push({ x: XMAX, y: yAtMaxX });
    }

    if (Math.abs(w0) > 1e-8) {
      const xAtMinY = (-b0 - w1 * YMIN) / w0;
      const xAtMaxY = (-b0 - w1 * YMAX) / w0;
      if (xAtMinY >= XMIN && xAtMinY <= XMAX) pts.push({ x: xAtMinY, y: YMIN });
      if (xAtMaxY >= XMIN && xAtMaxY <= XMAX) pts.push({ x: xAtMaxY, y: YMAX });
    }

    const unique = [];
    pts.forEach((p) => {
      const exists = unique.some((u) => Math.abs(u.x - p.x) < 1e-6 && Math.abs(u.y - p.y) < 1e-6);
      if (!exists) unique.push(p);
    });

    if (unique.length < 2) return null;
    return [unique[0], unique[1]];
  }

  function drawLinearModel() {
    const w0 = linearModel.w[0];
    const w1 = linearModel.w[1];
    const b = linearModel.b;

    if (Math.hypot(w0, w1) < 1e-8) return;

    const main = lineEndpoints(w0, w1, b);
    if (main) {
      const p1 = worldToCanvas(main[0].x, main[0].y);
      const p2 = worldToCanvas(main[1].x, main[1].y);
      ctx.beginPath();
      ctx.moveTo(p1.cx, p1.cy);
      ctx.lineTo(p2.cx, p2.cy);
      ctx.strokeStyle = "#0f172a";
      ctx.lineWidth = 2;
      ctx.stroke();
    }

    const m1 = lineEndpoints(w0, w1, b - 1);
    const m2 = lineEndpoints(w0, w1, b + 1);
    ctx.setLineDash([5, 5]);
    ctx.strokeStyle = "rgba(15,23,42,0.45)";
    ctx.lineWidth = 1.4;

    if (m1) {
      const p1 = worldToCanvas(m1[0].x, m1[0].y);
      const p2 = worldToCanvas(m1[1].x, m1[1].y);
      ctx.beginPath();
      ctx.moveTo(p1.cx, p1.cy);
      ctx.lineTo(p2.cx, p2.cy);
      ctx.stroke();
    }
    if (m2) {
      const p1 = worldToCanvas(m2[0].x, m2[0].y);
      const p2 = worldToCanvas(m2[1].x, m2[1].y);
      ctx.beginPath();
      ctx.moveTo(p1.cx, p1.cy);
      ctx.lineTo(p2.cx, p2.cy);
      ctx.stroke();
    }

    ctx.setLineDash([]);
  }

  function drawSupportVectors() {
    kernelModel.support.forEach((sv) => {
      const p = worldToCanvas(sv.x, sv.y);
      ctx.beginPath();
      ctx.arc(p.cx, p.cy, 8.8, 0, Math.PI * 2);
      ctx.strokeStyle = "#0f172a";
      ctx.lineWidth = 1.6;
      ctx.stroke();
    });
  }

  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, cw(), ch());

    const model = $("#modelType").val();

    drawRegions(model === "linear" ? "linear" : "kernel");
    drawAxes();
    drawPoints();
    if (model === "linear") drawLinearModel();
    else drawSupportVectors();
  }

  function gaussian() {
    let u = 0;
    let v = 0;
    while (u === 0) u = Math.random();
    while (v === 0) v = Math.random();
    return Math.sqrt(-2 * Math.log(u)) * Math.cos(2 * Math.PI * v);
  }

  function addCluster(cx, cy, label, n, spread) {
    for (let i = 0; i < n; i++) {
      points.push({
        x: cx + (Math.random() * 2 - 1) * spread + gaussian() * 0.3,
        y: cy + (Math.random() * 2 - 1) * spread + gaussian() * 0.3,
        label,
      });
    }
  }

  function loadDemo() {
    points = [];
    const total = 80;
    const half = Math.floor(total / 2);

    addCluster(-2.2, 0.0, -1, half, 0.9);
    addCluster(2.2, 0.2, 1, total - half, 0.9);
    for (let i = 0; i < 10; i++) {
      points.push({
        x: (Math.random() * 2 - 1) * 0.6,
        y: (Math.random() * 2 - 1) * 1.2,
        label: Math.random() > 0.5 ? 1 : -1,
      });
    }
    addCluster(-1.0, -2.0, -1, 8, 0.4);
    addCluster(1.0, 2.0, 1, 8, 0.4);

    resetLinear();
    resetKernel();
    resetEpochInfo();
    $("#modelInfo").text("");
    updateCounts();
    render();
  }

  function stopRun() {
    if (runInterval) {
      clearInterval(runInterval);
      runInterval = null;
    }
  }

  canvas.addEventListener("click", function (e) {
    const p = clientToCanvas(e.clientX, e.clientY);
    const w = canvasToWorld(p.cx, p.cy);
    points.push({ x: clamp(w.x, XMIN, XMAX), y: clamp(w.y, YMIN, YMAX), label: currentLabel });
    updateCounts();
    render();
  });

  $("#btn-classA").on("click", function () {
    currentLabel = -1;
    setClassButtons();
  });

  $("#btn-classB").on("click", function () {
    currentLabel = 1;
    setClassButtons();
  });

  $("#modelType").on("change", function () {
    updateKernelParamsVisibility();
    render();
  });

  $("#btn-step").on("click", function () {
    const model = $("#modelType").val();
    if (model === "linear") linearStep();
    else kernelStep();
  });

  $("#btn-run").on("click", function () {
    if (runInterval) return;
    const model = $("#modelType").val();
    const epochs = Math.max(1, parseInt($("#epochs").val(), 10) || 5);
    let ran = 0;

    runInterval = setInterval(() => {
      if (model === "linear") linearStep();
      else kernelStep();
      ran += 1;
      if (ran >= epochs) stopRun();
    }, 180);
  });

  $("#btn-stop").on("click", stopRun);

  $("#btn-demo").on("click", function () {
    stopRun();
    loadDemo();
  });

  $("#btn-clear").on("click", function () {
    stopRun();
    points = [];
    resetLinear();
    resetKernel();
    resetEpochInfo();
    $("#modelInfo").text("");
    updateCounts();
    render();
  });

  $("#modelInfo").on("click", function () {
    const model = $("#modelType").val();
    const mode = model === "linear" ? "linear" : "kernel";
    const acc = computeAccuracy(mode);
    $("#lastAcc").text(`${(acc * 100).toFixed(1)}%`);
  });

  $(window).on("resize", function () {
    ctx = setupHiDPI(canvas);
    render();
  });

  updateKernelParamsVisibility();
  setClassButtons();
  resetLinear();
  resetKernel();
  resetEpochInfo();
  updateCounts();
  render();
});
