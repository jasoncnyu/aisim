$(function () {
  const canvas = $("#cv")[0];
  const lossCanvas = $("#lossChart")[0];

  function setupHiDPI(cvs) {
    const dpr = window.devicePixelRatio || 1;
    const rect = cvs.getBoundingClientRect();
    cvs.width = Math.max(1, Math.round(rect.width * dpr));
    cvs.height = Math.max(1, Math.round(rect.height * dpr));
    const ctx = cvs.getContext("2d");
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    return ctx;
  }

  let ctx = setupHiDPI(canvas);
  let lossCtx = setupHiDPI(lossCanvas);

  const XMIN = -10;
  const XMAX = 10;
  const YMIN = -0.2;
  const YMAX = 1.2;

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;
  const lw = () => lossCanvas.getBoundingClientRect().width;
  const lh = () => lossCanvas.getBoundingClientRect().height;

  const clientToCanvas = (x, y) => {
    const r = canvas.getBoundingClientRect();
    return { cx: x - r.left, cy: y - r.top };
  };
  const canvasToWorld = (cx, cy) => ({
    x: (cx / cw()) * (XMAX - XMIN) + XMIN,
    y: (1 - cy / ch()) * (YMAX - YMIN) + YMIN,
  });
  const worldToCanvas = (x, y) => ({
    cx: ((x - XMIN) / (XMAX - XMIN)) * cw(),
    cy: (1 - (y - YMIN) / (YMAX - YMIN)) * ch(),
  });

  let points = [];
  let m = 0;
  let b = 0;
  let running = false;
  let epoch = 0;
  let lastLoss = Infinity;
  let stableCount = 0;
  let lossHistory = [];
  let testMode = false;

  function setRunButton(active) {
    const btn = $("#btn-run");
    if (active) {
      btn.removeClass("bg-green-700").addClass("bg-red-700").text("Stop");
    } else {
      btn.removeClass("bg-red-700").addClass("bg-green-700").text("Auto Train");
    }
  }

  function setTestButton() {
    const btn = $("#btn-test");
    if (testMode) {
      btn.addClass("test-on bg-amber-100 border-amber-300 text-amber-900");
      btn.find(".label").text("Testing");
    } else {
      btn.removeClass("test-on bg-amber-100 border-amber-300 text-amber-900");
      btn.find(".label").text("Test Mode");
    }
  }

  function sigmoid(z) {
    return 1 / (1 + Math.exp(-z));
  }

  function predict(x) {
    return sigmoid(m * x + b);
  }

  function loss() {
    if (!points.length) return 0;
    let total = 0;
    for (const p of points) {
      const yhat = Math.min(1 - 1e-8, Math.max(1e-8, predict(p.x)));
      total += -(p.label * Math.log(yhat) + (1 - p.label) * Math.log(1 - yhat));
    }
    return total / points.length;
  }

  function grad() {
    if (!points.length) return { dm: 0, db: 0 };
    let dm = 0;
    let db = 0;
    for (const p of points) {
      const err = predict(p.x) - p.label;
      dm += err * p.x;
      db += err;
    }
    return { dm: dm / points.length, db: db / points.length };
  }

  function stepGD(lr) {
    const g = grad();
    m -= lr * g.dm;
    b -= lr * g.db;
    epoch += 1;
    lossHistory.push(loss());
    if (lossHistory.length > 1200) lossHistory.shift();
  }

  function drawLoss() {
    const W = lw();
    const H = lh();
    lossCtx.clearRect(0, 0, W, H);
    if (lossHistory.length < 2) return;

    const pad = { l: 30, r: 10, t: 18, b: 20 };
    const chartW = W - pad.l - pad.r;
    const chartH = H - pad.t - pad.b;
    const maxLoss = Math.max(...lossHistory);
    const minLoss = Math.min(...lossHistory);
    const span = Math.max(1e-8, maxLoss - minLoss);
    const padY = Math.max(span * 0.08, 1e-5);
    const yMin = Math.max(0, minLoss - padY);
    const yMax = maxLoss + padY;
    const ySpan = Math.max(1e-8, yMax - yMin);

    lossCtx.strokeStyle = "#94a3b8";
    lossCtx.beginPath();
    lossCtx.moveTo(pad.l, pad.t);
    lossCtx.lineTo(pad.l, H - pad.b);
    lossCtx.lineTo(W - pad.r, H - pad.b);
    lossCtx.stroke();

    lossCtx.strokeStyle = "#2563eb";
    lossCtx.lineWidth = 1.5;
    lossCtx.beginPath();
    for (let i = 0; i < lossHistory.length; i++) {
      const x = pad.l + (i / (lossHistory.length - 1)) * chartW;
      const y = pad.t + (1 - (lossHistory[i] - yMin) / ySpan) * chartH;
      if (i === 0) lossCtx.moveTo(x, y);
      else lossCtx.lineTo(x, y);
    }
    lossCtx.stroke();

    lossCtx.fillStyle = "#475569";
    lossCtx.font = "12px sans-serif";
    lossCtx.fillText("Loss", 8, 14);
    lossCtx.fillText("Epoch", W - 50, H - 4);
    lossCtx.fillText("0", pad.l - 4, H - 6);
    lossCtx.fillText(String(epoch), W - pad.r - 22, H - 6);
    lossCtx.fillText(`min ${minLoss.toFixed(4)}`, pad.l + 4, H - pad.b - 4);
    lossCtx.fillText(`max ${maxLoss.toFixed(4)}`, pad.l + 4, pad.t + 10);
  }

  function draw() {
    const W = cw();
    const H = ch();

    ctx.clearRect(0, 0, W, H);
    ctx.fillStyle = testMode ? "#fffbeb" : "#ffffff";
    ctx.fillRect(0, 0, W, H);

    ctx.strokeStyle = "#d1d5db";
    ctx.lineWidth = 1;
    const xAxisY = worldToCanvas(0, 0).cy;
    const yAxisX = worldToCanvas(0, 0).cx;
    ctx.beginPath();
    ctx.moveTo(0, xAxisY);
    ctx.lineTo(W, xAxisY);
    ctx.moveTo(yAxisX, 0);
    ctx.lineTo(yAxisX, H);
    ctx.stroke();

    const y0 = worldToCanvas(XMIN, 0).cy;
    const y1 = worldToCanvas(XMIN, 1).cy;
    ctx.strokeStyle = "#94a3b8";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, y0);
    ctx.lineTo(W, y0);
    ctx.moveTo(0, y1);
    ctx.lineTo(W, y1);
    ctx.stroke();
    ctx.lineWidth = 1;

    ctx.fillStyle = "#334155";
    ctx.font = "12px sans-serif";
    ctx.fillText("y=1", yAxisX + 6, y1 - 8);
    ctx.fillText("y=0", yAxisX + 6, y0 - 8);

    for (const p of points) {
      const pos = worldToCanvas(p.x, p.label);
      ctx.beginPath();
      ctx.arc(pos.cx, pos.cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = p.label ? "#ef4444" : "#06b6d4";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.stroke();
    }

    ctx.strokeStyle = "#eab308";
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (let x = XMIN; x <= XMAX; x += 0.05) {
      const y = predict(x);
      const pos = worldToCanvas(x, y);
      if (x === XMIN) ctx.moveTo(pos.cx, pos.cy);
      else ctx.lineTo(pos.cx, pos.cy);
    }
    ctx.stroke();

    const L = loss();
    $("#status").text(`Epoch: ${epoch} | Loss: ${L.toFixed(6)} | Samples: ${points.length}`);
    $("#equation").text(`P(class=1|x) = sigmoid(${m.toFixed(3)}x + ${b.toFixed(3)})`);
    drawLoss();
  }

  function tick() {
    if (!running) return;
    const lr = parseFloat($("#lr").val());
    stepGD(lr);
    const currentLoss = loss();
    if (Math.abs(currentLoss - lastLoss) < 1e-9) stableCount += 1;
    else stableCount = 0;
    lastLoss = currentLoss;
    draw();
    if (stableCount > 240) {
      running = false;
      setRunButton(false);
      return;
    }
    requestAnimationFrame(tick);
  }

  function startRun() {
    running = true;
    setRunButton(true);
    tick();
  }

  function stopRun() {
    running = false;
    setRunButton(false);
  }

  $("#btn-random").on("click", function () {
    const generated = [];
    for (let i = 0; i < 12; i++) {
      generated.push({ x: -3 + (Math.random() - 0.3) * 5, label: 0 });
      generated.push({ x: 3 + (Math.random() - 0.7) * 5, label: 1 });
    }
    points = generated;
    draw();
  });

  $("#btn-run").on("click", function () {
    if (running) stopRun();
    else startRun();
  });

  $("#btn-step").on("click", function () {
    const lr = parseFloat($("#lr").val());
    stepGD(lr);
    draw();
  });

  $("#btn-test").on("click", function () {
    testMode = !testMode;
    setTestButton();
    draw();
  });

  $("#btn-reset").on("click", function () {
    running = false;
    points = [];
    m = 0;
    b = 0;
    epoch = 0;
    stableCount = 0;
    lastLoss = Infinity;
    lossHistory = [];
    setRunButton(false);
    draw();
  });

  let pressTimer = null;
  let longPressTriggered = false;

  function handleCanvasPress(e, isLongPress) {
    const clientX = e.clientX ?? e.touches?.[0]?.clientX;
    const clientY = e.clientY ?? e.touches?.[0]?.clientY;
    const pos = clientToCanvas(clientX, clientY);
    const world = canvasToWorld(pos.cx, pos.cy);

    if (isLongPress) {
      if (!points.length) return;
      let best = -1;
      let bestD = Infinity;
      points.forEach((p, i) => {
        const pc = worldToCanvas(p.x, p.label);
        const d2 = (pc.cx - pos.cx) ** 2 + (pc.cy - pos.cy) ** 2;
        if (d2 < bestD) {
          best = i;
          bestD = d2;
        }
      });
      if (best >= 0) points.splice(best, 1);
      longPressTriggered = true;
      draw();
      return;
    }

    if (testMode) {
      const pred = predict(world.x);
      draw();
      const predPos = worldToCanvas(world.x, pred);
      ctx.setLineDash([6, 4]);
      ctx.beginPath();
      ctx.moveTo(pos.cx, pos.cy);
      ctx.lineTo(predPos.cx, predPos.cy);
      ctx.strokeStyle = "rgba(0,0,0,0.55)";
      ctx.stroke();
      ctx.setLineDash([]);

      ctx.beginPath();
      ctx.arc(pos.cx, pos.cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = "#16a34a";
      ctx.fill();
      ctx.beginPath();
      ctx.arc(predPos.cx, predPos.cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = "#f59e0b";
      ctx.fill();
      $("#status").text(`Test x=${world.x.toFixed(3)} | P(class=1)=${(pred * 100).toFixed(2)}%`);
      return;
    }

    points.push({ x: world.x, label: world.y > 0.5 ? 1 : 0 });
    draw();
  }

  $(canvas)
    .on("mousedown touchstart", function (e) {
      longPressTriggered = false;
      pressTimer = setTimeout(() => handleCanvasPress(e.originalEvent?.touches ? e.originalEvent.touches[0] : e, true), 500);
    })
    .on("mouseup touchend mouseleave", function (e) {
      clearTimeout(pressTimer);
      if (longPressTriggered) e.preventDefault();
    })
    .on("click", function (e) {
      if (!longPressTriggered) handleCanvasPress(e, false);
    });

  $(window).on("resize", function () {
    ctx = setupHiDPI(canvas);
    lossCtx = setupHiDPI(lossCanvas);
    draw();
  });

  setRunButton(false);
  setTestButton();
  draw();
});
