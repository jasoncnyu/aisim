$(function () {
  const canvas = document.getElementById("kmeansCanvas");
  const chartCanvas = document.getElementById("inertiaChart");

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
  let chartCtx = setupHiDPI(chartCanvas);

  const XMIN = -6;
  const XMAX = 6;
  const YMIN = -6;
  const YMAX = 6;
  const MAX_ITERS = 400;
  const CONVERGENCE_EPS = 1e-4;

  const palette = [
    "#e11d48",
    "#2563eb",
    "#16a34a",
    "#d97706",
    "#7c3aed",
    "#0891b2",
    "#ea580c",
    "#14b8a6",
    "#4f46e5",
    "#be185d",
    "#65a30d",
    "#0ea5e9",
  ];

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;
  const lw = () => chartCanvas.getBoundingClientRect().width;
  const lh = () => chartCanvas.getBoundingClientRect().height;

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

  function hexToRgba(hex, alpha) {
    const h = hex.replace("#", "");
    const n = parseInt(h, 16);
    const r = (n >> 16) & 255;
    const g = (n >> 8) & 255;
    const b = n & 255;
    return `rgba(${r},${g},${b},${alpha})`;
  }

  let points = [];
  let centroids = [];
  let assignments = [];
  let iteration = 0;
  let inertiaHistory = [];
  let runTimer = null;
  let longPressTimer = null;
  let longPressTriggered = false;

  function updateStatus(inertiaValue, shiftValue) {
    $("#countPts").text(points.length);
    $("#curK").text(parseInt($("#kVal").val(), 10) || 3);
    $("#iter").text(iteration);
    $("#inertia").text(Number.isFinite(inertiaValue) ? inertiaValue.toFixed(4) : "-");
    $("#shift").text(Number.isFinite(shiftValue) ? shiftValue.toExponential(2) : "-");
  }

  function resetModelState() {
    centroids = [];
    assignments = [];
    iteration = 0;
    inertiaHistory = [];
    updateStatus(NaN, NaN);
  }

  function addPoint(x, y) {
    points.push({ x: clamp(x, XMIN, XMAX), y: clamp(y, YMIN, YMAX) });
    updateStatus(NaN, NaN);
    render();
  }

  function removeNearestPoint(clientX, clientY) {
    if (!points.length) return;
    const pos = clientToCanvas(clientX, clientY);
    let bestIdx = -1;
    let bestD2 = Infinity;
    points.forEach((p, i) => {
      const cp = worldToCanvas(p.x, p.y);
      const d2 = (cp.cx - pos.cx) ** 2 + (cp.cy - pos.cy) ** 2;
      if (d2 < bestD2) {
        bestD2 = d2;
        bestIdx = i;
      }
    });
    if (bestIdx >= 0) {
      points.splice(bestIdx, 1);
      if (assignments.length > bestIdx) assignments.splice(bestIdx, 1);
      updateStatus(NaN, NaN);
      render();
    }
  }

  function generateDemo() {
    points = [];
    function addCluster(cx, cy, count, spread) {
      for (let i = 0; i < count; i++) {
        addPoint(cx + (Math.random() * 2 - 1) * spread, cy + (Math.random() * 2 - 1) * spread);
      }
    }
    addCluster(-3.2, 2.2, 34, 0.9);
    addCluster(2.8, -1.8, 30, 1.0);
    addCluster(0.8, 3.3, 26, 0.8);
    for (let i = 0; i < 12; i++) {
      addPoint((Math.random() * 2 - 1) * 5.5, (Math.random() * 2 - 1) * 5.5);
    }
    resetModelState();
    render();
  }

  function initCentroids(k, method) {
    stopRun();
    centroids = [];

    if (!points.length) {
      for (let i = 0; i < k; i++) {
        centroids.push({
          x: XMIN + Math.random() * (XMAX - XMIN),
          y: YMIN + Math.random() * (YMAX - YMIN),
          color: palette[i % palette.length],
        });
      }
      assignments = new Array(points.length).fill(-1);
      iteration = 0;
      inertiaHistory = [];
      updateStatus(NaN, NaN);
      render();
      return;
    }

    if (method === "kmeans++") {
      const first = points[Math.floor(Math.random() * points.length)];
      centroids.push({ x: first.x, y: first.y, color: palette[0] });

      while (centroids.length < k) {
        const d2 = points.map((p) => {
          let minD2 = Infinity;
          centroids.forEach((c) => {
            const dx = p.x - c.x;
            const dy = p.y - c.y;
            const v = dx * dx + dy * dy;
            if (v < minD2) minD2 = v;
          });
          return minD2;
        });
        const sum = d2.reduce((s, v) => s + v, 0);
        let r = Math.random() * (sum || 1);
        let idx = 0;
        while (idx < d2.length - 1 && r > d2[idx]) {
          r -= d2[idx];
          idx += 1;
        }
        const chosen = points[idx];
        centroids.push({
          x: chosen.x,
          y: chosen.y,
          color: palette[centroids.length % palette.length],
        });
      }
    } else {
      const shuffled = points.slice();
      for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
      }
      for (let i = 0; i < k; i++) {
        const p = shuffled[i % shuffled.length];
        centroids.push({ x: p.x, y: p.y, color: palette[i % palette.length] });
      }
    }

    assignments = new Array(points.length).fill(-1);
    iteration = 0;
    inertiaHistory = [];
    const inertiaValue = computeInertia();
    if (Number.isFinite(inertiaValue)) inertiaHistory.push(inertiaValue);
    updateStatus(inertiaValue, NaN);
    render();
  }

  function assignPoints() {
    if (!centroids.length) {
      assignments = new Array(points.length).fill(-1);
      return;
    }

    assignments = points.map((p) => {
      let best = -1;
      let bestD2 = Infinity;
      centroids.forEach((c, j) => {
        const dx = p.x - c.x;
        const dy = p.y - c.y;
        const d2 = dx * dx + dy * dy;
        if (d2 < bestD2) {
          bestD2 = d2;
          best = j;
        }
      });
      return best;
    });
  }

  function updateCentroids() {
    if (!centroids.length) return 0;

    const sums = new Array(centroids.length).fill(0).map(() => ({ sx: 0, sy: 0, count: 0 }));
    points.forEach((p, i) => {
      const a = assignments[i];
      if (a >= 0) {
        sums[a].sx += p.x;
        sums[a].sy += p.y;
        sums[a].count += 1;
      }
    });

    let totalShift = 0;
    centroids.forEach((c, j) => {
      const oldX = c.x;
      const oldY = c.y;

      if (sums[j].count === 0) {
        c.x = XMIN + Math.random() * (XMAX - XMIN);
        c.y = YMIN + Math.random() * (YMAX - YMIN);
      } else {
        c.x = sums[j].sx / sums[j].count;
        c.y = sums[j].sy / sums[j].count;
      }

      const dx = c.x - oldX;
      const dy = c.y - oldY;
      totalShift += Math.sqrt(dx * dx + dy * dy);
    });

    return totalShift;
  }

  function computeInertia() {
    if (!centroids.length || !points.length) return NaN;
    let sum = 0;
    points.forEach((p, i) => {
      const a = assignments[i];
      if (a >= 0) {
        const c = centroids[a];
        const dx = p.x - c.x;
        const dy = p.y - c.y;
        sum += dx * dx + dy * dy;
      }
    });
    return sum;
  }

  function kmeansStep() {
    if (!centroids.length) return { ok: false, inertiaValue: NaN, shiftValue: NaN };

    assignPoints();
    const shiftValue = updateCentroids();
    assignPoints();

    iteration += 1;
    const inertiaValue = computeInertia();
    if (Number.isFinite(inertiaValue)) inertiaHistory.push(inertiaValue);

    updateStatus(inertiaValue, shiftValue);
    render();

    return { ok: true, inertiaValue, shiftValue };
  }

  function drawInertiaChart() {
    const W = lw();
    const H = lh();
    chartCtx.clearRect(0, 0, W, H);

    if (inertiaHistory.length < 2) return;

    const pad = { l: 36, r: 10, t: 18, b: 24 };
    const chartW = W - pad.l - pad.r;
    const chartH = H - pad.t - pad.b;
    const minVal = Math.min(...inertiaHistory);
    const maxVal = Math.max(...inertiaHistory);
    const span = Math.max(1e-9, maxVal - minVal);
    const yPad = Math.max(1e-6, span * 0.08);
    const yMin = Math.max(0, minVal - yPad);
    const yMax = maxVal + yPad;
    const ySpan = Math.max(1e-9, yMax - yMin);

    chartCtx.strokeStyle = "#94a3b8";
    chartCtx.beginPath();
    chartCtx.moveTo(pad.l, pad.t);
    chartCtx.lineTo(pad.l, H - pad.b);
    chartCtx.lineTo(W - pad.r, H - pad.b);
    chartCtx.stroke();

    chartCtx.strokeStyle = "#2563eb";
    chartCtx.lineWidth = 1.6;
    chartCtx.beginPath();
    for (let i = 0; i < inertiaHistory.length; i++) {
      const x = pad.l + (i / (inertiaHistory.length - 1)) * chartW;
      const y = pad.t + (1 - (inertiaHistory[i] - yMin) / ySpan) * chartH;
      if (i === 0) chartCtx.moveTo(x, y);
      else chartCtx.lineTo(x, y);
    }
    chartCtx.stroke();

    chartCtx.fillStyle = "#475569";
    chartCtx.font = "12px sans-serif";
    chartCtx.fillText("Inertia", 4, 14);
    chartCtx.fillText("Iteration", W - 62, H - 6);
    chartCtx.fillText("0", pad.l - 10, H - 6);
    chartCtx.fillText(String(Math.max(0, iteration)), W - pad.r - 20, H - 6);
    chartCtx.fillText(`min ${minVal.toFixed(2)}`, pad.l + 4, H - pad.b - 4);
    chartCtx.fillText(`max ${maxVal.toFixed(2)}`, pad.l + 4, pad.t + 10);
  }

  function drawRegions() {
    if (!centroids.length) return;

    const density = clamp(parseInt($("#res").val(), 10) || 120, 40, 300);
    const stepX = cw() / density;
    const stepY = ch() / Math.max(1, Math.round((density * ch()) / cw()));

    for (let x = 0; x < cw(); x += Math.max(1, Math.floor(stepX))) {
      for (let y = 0; y < ch(); y += Math.max(1, Math.floor(stepY))) {
        const w = canvasToWorld(x + 0.5, y + 0.5);
        let best = 0;
        let bestD2 = Infinity;
        centroids.forEach((c, j) => {
          const dx = w.x - c.x;
          const dy = w.y - c.y;
          const d2 = dx * dx + dy * dy;
          if (d2 < bestD2) {
            best = j;
            bestD2 = d2;
          }
        });
        ctx.fillStyle = hexToRgba(centroids[best].color, 0.17);
        ctx.fillRect(x, y, Math.max(1, Math.floor(stepX)), Math.max(1, Math.floor(stepY)));
      }
    }
  }

  function drawAxes() {
    const center = worldToCanvas(0, 0);
    ctx.strokeStyle = "rgba(15, 23, 42, 0.22)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(center.cx, 0);
    ctx.lineTo(center.cx, ch());
    ctx.moveTo(0, center.cy);
    ctx.lineTo(cw(), center.cy);
    ctx.stroke();

    ctx.fillStyle = "#64748b";
    ctx.font = "12px sans-serif";
    ctx.fillText("x", cw() - 14, center.cy - 6);
    ctx.fillText("y", center.cx + 6, 14);
  }

  function drawPointsAndCentroids() {
    points.forEach((p, i) => {
      const pos = worldToCanvas(p.x, p.y);
      const a = assignments[i];
      ctx.beginPath();
      ctx.arc(pos.cx, pos.cy, 4.7, 0, Math.PI * 2);
      ctx.fillStyle = a >= 0 && centroids[a] ? centroids[a].color : "#64748b";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = 1;
      ctx.stroke();
    });

    centroids.forEach((c, j) => {
      const pos = worldToCanvas(c.x, c.y);
      const size = 10;
      ctx.save();
      ctx.translate(pos.cx, pos.cy);
      ctx.rotate(Math.PI / 4);
      ctx.fillStyle = c.color;
      ctx.fillRect(-size / 2, -size / 2, size, size);
      ctx.restore();

      ctx.strokeStyle = "#0f172a";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(pos.cx, pos.cy, 8, 0, Math.PI * 2);
      ctx.stroke();

      ctx.fillStyle = "#0f172a";
      ctx.font = "12px sans-serif";
      ctx.fillText(`C${j}`, pos.cx + 10, pos.cy - 8);
    });
  }

  function renderSummary() {
    if (!centroids.length) {
      $("#clusterText").text("(Initialize centroids to start clustering.)");
      return;
    }

    const counts = new Array(centroids.length).fill(0);
    assignments.forEach((a) => {
      if (a >= 0) counts[a] += 1;
    });

    let text = "";
    centroids.forEach((c, j) => {
      text += `Cluster ${j}\n`;
      text += `  Count: ${counts[j]}\n`;
      text += `  Centroid: (${c.x.toFixed(3)}, ${c.y.toFixed(3)})\n`;
      text += `  Color: ${c.color}\n\n`;
    });

    $("#clusterText").text(text.trim());
  }

  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, cw(), ch());

    drawRegions();
    drawAxes();
    drawPointsAndCentroids();
    drawInertiaChart();
    renderSummary();
  }

  function runLoop() {
    if (runTimer || !centroids.length) return;

    runTimer = setInterval(() => {
      const { ok, shiftValue } = kmeansStep();
      if (!ok) {
        stopRun();
        return;
      }
      if (shiftValue < CONVERGENCE_EPS || iteration >= MAX_ITERS) stopRun();
    }, 180);
  }

  function stopRun() {
    if (runTimer) {
      clearInterval(runTimer);
      runTimer = null;
    }
  }

  function onCanvasClick(evt) {
    if (longPressTriggered) return;
    const clientX = evt.clientX ?? evt.touches?.[0]?.clientX;
    const clientY = evt.clientY ?? evt.touches?.[0]?.clientY;
    if (!Number.isFinite(clientX) || !Number.isFinite(clientY)) return;
    const p = clientToCanvas(clientX, clientY);
    const w = canvasToWorld(p.cx, p.cy);
    addPoint(w.x, w.y);
  }

  canvas.addEventListener("contextmenu", function (e) {
    e.preventDefault();
    removeNearestPoint(e.clientX, e.clientY);
  });

  canvas.addEventListener("mousedown", function (e) {
    longPressTriggered = false;
    longPressTimer = setTimeout(() => {
      longPressTriggered = true;
      removeNearestPoint(e.clientX, e.clientY);
    }, 500);
  });

  canvas.addEventListener("mouseup", function () {
    clearTimeout(longPressTimer);
  });

  canvas.addEventListener("mouseleave", function () {
    clearTimeout(longPressTimer);
  });

  canvas.addEventListener("touchstart", function (e) {
    longPressTriggered = false;
    const t = e.touches?.[0];
    if (!t) return;
    longPressTimer = setTimeout(() => {
      longPressTriggered = true;
      removeNearestPoint(t.clientX, t.clientY);
    }, 500);
  });

  canvas.addEventListener("touchend", function () {
    clearTimeout(longPressTimer);
  });

  canvas.addEventListener("click", onCanvasClick);

  $("#btn-demo").on("click", function () {
    stopRun();
    generateDemo();
  });

  $("#btn-init").on("click", function () {
    const k = clamp(parseInt($("#kVal").val(), 10) || 3, 1, 12);
    const method = $("#initMethod").val();
    initCentroids(k, method);
  });

  $("#btn-step").on("click", function () {
    stopRun();
    kmeansStep();
  });

  $("#btn-run").on("click", function () {
    runLoop();
  });

  $("#btn-stop").on("click", function () {
    stopRun();
  });

  $("#btn-clear").on("click", function () {
    stopRun();
    points = [];
    resetModelState();
    render();
  });

  $("#kVal").on("change", function () {
    const k = clamp(parseInt($(this).val(), 10) || 3, 1, 12);
    $(this).val(k);
    $("#curK").text(k);
  });

  $("#res").on("change", function () {
    const v = clamp(parseInt($(this).val(), 10) || 120, 40, 300);
    $(this).val(v);
    render();
  });

  $(window).on("resize", function () {
    ctx = setupHiDPI(canvas);
    chartCtx = setupHiDPI(chartCanvas);
    render();
  });

  updateStatus(NaN, NaN);
  render();
});
