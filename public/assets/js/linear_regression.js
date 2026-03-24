window.MathJax = {
  tex: { inlineMath: [['$', '$'], ['\\(', '\\)']], displayMath: [['$$', '$$'], ['\\[', '\\]']] },
  svg: { fontCache: 'global' }
};

// ===============================
// UI  (OLS / GD / SGD ?)
// ===============================
$(document).ready(function () {
  function updateUI(method) {
    const isML = (method === 'gd' || method === 'sgd');

    $('#learningParams')[isML ? 'show' : 'hide']();
    $('#btn-step')[isML ? 'show' : 'hide']();
    $('#lossRow')[isML ? 'show' : 'hide']();
    $('#btn-run .btn-label').text(isML ? 'Auto Train' : 'Calculate');

    $('#ex-ols').toggle(method === 'ols');
    $('#ex-gd').toggle(method === 'gd');
    $('#ex-sgd').toggle(method === 'sgd');

    if (window.MathJax?.typesetPromise)
      window.MathJax.typesetPromise([document.getElementById('ex-' + method)]);
  }

  // ?? ???UI 
  const $fitSel = $('#fitMethod');
  updateUI($fitSel.val());
  $fitSel.on('change', function () { updateUI($(this).val()); });
});

// ===============================
// ????? 
// ===============================
$(function () {
  const canvas = $('#plot')[0];
  const lossCanvas = $('#lossChart')[0];

  // DPI ?
  function setupHiDPI(cvs) {
    const dpr = window.devicePixelRatio || 1;
    const rect = cvs.getBoundingClientRect();
    cvs.width = Math.max(1, Math.round(rect.width * dpr));
    cvs.height = Math.max(1, Math.round(rect.height * dpr));
    const ctx = cvs.getContext('2d');
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    return { ctx, dpr };
  }

  const { ctx } = setupHiDPI(canvas);
  const { ctx: lossCtx } = setupHiDPI(lossCanvas);
  const XMIN = -10, XMAX = 10, YMIN = -10, YMAX = 10;

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;
  const cwLoss = () => lossCanvas.getBoundingClientRect().width;
  const chLoss = () => lossCanvas.getBoundingClientRect().height;

  const clientToCanvas = (x, y) => {
    const r = canvas.getBoundingClientRect();
    return { cx: x - r.left, cy: y - r.top };
  };
  const canvasToWorld = (cx, cy) => ({
    x: cx / cw() * (XMAX - XMIN) + XMIN,
    y: (1 - cy / ch()) * (YMAX - YMIN) + YMIN
  });
  const worldToCanvas = (x, y) => ({
    cx: ((x - XMIN) / (XMAX - XMIN)) * cw(),
    cy: (1 - (y - YMIN) / (YMAX - YMIN)) * ch()
  });

  // ===============================
  // ???? ?
  // ===============================
  let points = [];
  let testMode = false;
  let a = 0, b = 0;
  let lossHistory = [];
  let runTimer = null, currentEpoch = 0;

  const updateCounts = () => $('#countPts').text(points.length);

  // ===============================
  // ??
  // ===============================
  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    const center = worldToCanvas(0, 0);

    // === 1 ??? ===
    ctx.strokeStyle = '#ccc';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(center.cx, 0);
    ctx.lineTo(center.cx, ch());
    ctx.moveTo(0, center.cy);
    ctx.lineTo(cw(), center.cy);
    ctx.stroke();

    // ? ? (X, Y)
    ctx.fillStyle = '#666';
    ctx.font = '12px sans-serif';
    ctx.textAlign = 'center';
    for (let x = XMIN; x <= XMAX; x += 2) {
      const p = worldToCanvas(x, 0);
      ctx.fillText(x.toString(), p.cx, center.cy + 14);
      ctx.beginPath();
      ctx.moveTo(p.cx, center.cy - 3);
      ctx.lineTo(p.cx, center.cy + 3);
      ctx.stroke();
    }
    ctx.textAlign = 'right';
    for (let y = YMIN; y <= YMAX; y += 2) {
      const p = worldToCanvas(0, y);
      ctx.fillText(y.toString(), center.cx - 6, p.cy + 4);
      ctx.beginPath();
      ctx.moveTo(center.cx - 3, p.cy);
      ctx.lineTo(center.cx + 3, p.cy);
      ctx.stroke();
    }

    // === 2 ??????===
    points.forEach(p => {
      const { cx, cy } = worldToCanvas(p.x, p.y);
      ctx.beginPath();
      ctx.arc(cx, cy, 5, 0, Math.PI * 2);
      ctx.fillStyle = '#0d6efd';
      ctx.fill();
      ctx.strokeStyle = '#fff';
      ctx.lineWidth = 1;
      ctx.stroke();
    });

    // === 3 ?????? ===
    if (points.length) {
      const p1 = worldToCanvas(XMIN, a * XMIN + b);
      const p2 = worldToCanvas(XMAX, a * XMAX + b);
      ctx.beginPath();
      ctx.moveTo(p1.cx, p1.cy);
      ctx.lineTo(p2.cx, p2.cy);
      ctx.strokeStyle = '#dc3545';
      ctx.lineWidth = 2;
      ctx.stroke();

      // ???
      ctx.strokeStyle = 'rgba(220,53,69,0.4)';
      ctx.lineWidth = 1;
      points.forEach(p => {
        const { cx, cy } = worldToCanvas(p.x, p.y);
        const pred = worldToCanvas(p.x, a * p.x + b);
        ctx.beginPath();
        ctx.moveTo(cx, cy);
        ctx.lineTo(pred.cx, pred.cy);
        ctx.stroke();
      });
    }

    // === 4 ??????? ===
    if (!isNaN(a) && !isNaN(b) && points.length > 1) {
      ctx.fillStyle = '#000';
      ctx.font = '14px sans-serif';
      ctx.textAlign = 'left';
      const aText = (a >= 0 ? `+ ${a.toFixed(2)}` : `- ${Math.abs(a).toFixed(2)}`);
      ctx.fillText(`y = ${aText}x + ${b.toFixed(2)}`, 10, 20);
    }

    drawLoss();
  }

  // ===============================
  // Loss ??(?+ ? ? )
  // ===============================
  function drawLoss() {
    lossCtx.clearRect(0, 0, cwLoss(), chLoss());
    if (!lossHistory.length) return;

    const W = cwLoss();
    const H = chLoss();
    const paddingLeft = 25;
    const paddingBottom = 20;
    const maxL = Math.max(...lossHistory)*(1.5);
    const minL = 0;
    const n = lossHistory.length;

    // ?????????????? ???????????????
    lossCtx.strokeStyle = '#999';
    lossCtx.beginPath();
    lossCtx.moveTo(paddingLeft, 0);
    lossCtx.lineTo(paddingLeft, H - paddingBottom);
    lossCtx.lineTo(W, H - paddingBottom);
    lossCtx.stroke();

    // ?????????????? ????? (Y? ??????????????
    const numTicks = 5;
    lossCtx.fillStyle = '#666';
    lossCtx.font = '11px sans-serif';
    lossCtx.textAlign = 'right';
    lossCtx.textBaseline = 'middle';

    for (let i = 0; i < numTicks; i++) { //  ????? ? ?
      const t = i / numTicks;
      const y = (1 - t) * (H - paddingBottom);
      const value = minL + (maxL - minL) * t;

      // ??? (?
      const intVal = Math.round(value);

      if (intVal === 0 && i !== numTicks - 1) continue;

      lossCtx.fillText(intVal.toString(), paddingLeft - 5, y);

      //  ???
      lossCtx.strokeStyle = 'rgba(0,0,0,0.1)';
      lossCtx.beginPath();
      lossCtx.moveTo(paddingLeft, y);
      lossCtx.lineTo(W, y);
      lossCtx.stroke();
    }

    // ?????????????? ?  ??????????????
    lossCtx.strokeStyle = '#0d6efd';
    lossCtx.lineWidth = 1.8;
    lossCtx.beginPath();
    for (let i = 0; i < n; i++) {
      const x = paddingLeft + (i / Math.max(1, n - 1)) * (W - paddingLeft - 10);
      const scaled = (lossHistory[i] - minL) / (maxL - minL || 1);
      const y = (1 - scaled) * (H - paddingBottom);
      i === 0 ? lossCtx.moveTo(x, y) : lossCtx.lineTo(x, y);
    }
    lossCtx.stroke();

    // ?????????????? X?? (??? ??????????????
    const xTicks = 5;
    lossCtx.textAlign = 'center';
    lossCtx.textBaseline = 'top';
    for (let i = 0; i <= xTicks; i++) {
      const t = i / xTicks;
      const x = paddingLeft + t * (W - paddingLeft - 10);
      const epoch = Math.round(t * (n - 1));
      lossCtx.fillText(epoch, x, H - paddingBottom + 4);
    }

    // ?????????????? ? ??????????????
    lossCtx.save();
    lossCtx.fillStyle = '#444';
    lossCtx.font = '12px sans-serif';
    lossCtx.textAlign = 'center';
    lossCtx.fillText('Epoch', W / 2, H - 2);
    lossCtx.rotate(-Math.PI / 2);
    lossCtx.restore();
  }

  // ===============================
  // ? ?
  // ===============================
  function computeOLS() {
    if (!points.length) return;
    const n = points.length;
    let sx = 0, sy = 0, sxx = 0, sxy = 0;
    points.forEach(p => {
      sx += p.x; sy += p.y; sxx += p.x * p.x; sxy += p.x * p.y;
    });
    const denom = n * sxx - sx * sx;
    if (Math.abs(denom) < 1e-12) { a = 0; b = sy / n; }
    else { a = (n * sxy - sx * sy) / denom; b = (sy - a * sx) / n; }
  }

  const mse = () => points.length
    ? points.reduce((s, p) => s + ((a * p.x + b - p.y) ** 2), 0) / points.length
    : 0;

  const r2 = () => {
    if (!points.length) return 0;
    const meanY = points.reduce((s, p) => s + p.y, 0) / points.length;
    let ssTot = 0, ssRes = 0;
    points.forEach(p => {
      ssTot += (p.y - meanY) ** 2;
      ssRes += (p.y - (a * p.x + b)) ** 2;
    });
    return 1 - ssRes / (ssTot || 1);
  };

  const gdEpoch = lr => {
    if (!points.length) return;
    const n = points.length;
    let da = 0, db = 0;
    points.forEach(p => {
      const err = (a * p.x + b) - p.y;
      da += (2 / n) * err * p.x;
      db += (2 / n) * err;
    });
    a -= lr * da; b -= lr * db;
  };

  const sgdEpoch = lr => {
    if (!points.length) return;
    const idx = [...Array(points.length).keys()];
    for (let i = idx.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [idx[i], idx[j]] = [idx[j], idx[i]];
    }
    idx.forEach(i => {
      const p = points[i];
      const err = (a * p.x + b) - p.y;
      a -= lr * 2 * err * p.x;
      b -= lr * 2 * err;
    });
  };

  // ===============================
  // ? ? (? )
  // ===============================
  let isRunning = false;

  function runSteps(method, lr, epochs) {
    if (method !== 'ols') stopRun();
    isRunning = (method !== 'ols');
    totalEpochs = epochs;
    currentEpoch = 0;
    lossHistory = [];
    $('#lastLoss').text('-');

    // ??OLS ? ?  ? 
    if (method !== 'ols') updateRunButton();

    function stepOnce() {
      if (method === 'ols') computeOLS();
      else if (method === 'gd') gdEpoch(lr);
      else if (method === 'sgd') sgdEpoch(lr);

      const L = mse();
      lossHistory.push(L);
      $('#lastLoss').text(L.toFixed(6));
      $('#slope').text(a.toFixed(6));
      $('#intercept').text(b.toFixed(6));
      $('#r2').text(r2().toFixed(4));
      render();

      if (method !== 'ols') {
        currentEpoch++;
        updateRunButtonProgress(currentEpoch / totalEpochs);

        if (currentEpoch >= totalEpochs) {
          stopRun();
          updateRunButton(true);
        }
      }
    }

    if (method === 'ols') {
      // ? :  ??? ?? ?
      stepOnce();
    } else {
      runTimer = setInterval(stepOnce, 60);
    }
  }

  function stopRun() {
    if (runTimer) clearInterval(runTimer);
    runTimer = null;
    isRunning = false;
    updateRunButton(true);
  }

  // ===============================
  //  ? ??
  // ===============================
  function updateRunButton(reset = false) {
    console.log('updateRunButton called');
    const btn = $('#btn-run');
    const label = btn.find('.btn-label');
    const bg = btn.find('.progress-bg');

    if (reset || !isRunning) {
      label.text('Auto Train');
      btn.removeClass('btn-danger').addClass('btn-success');
      bg.css('width', '0%');
    } else {
      label.text('Stop Training');
      btn.removeClass('btn-success').addClass('btn-danger');
    }
  }

  function updateRunButtonProgress(ratio) {
    const btn = $('#btn-run');
    const bg = btn.find('.progress-bg');
    const label = btn.find('.btn-label');
    const percent = Math.min(100, Math.round(ratio * 100));
    bg.css('width', percent + '%');
    label.text(`Training ${percent}%`);
  }

  // ===============================
  // UI  ???
  // ===============================
  $('#btn-demo').on('click', function () {
    points = [];
    const a_true = 0.8, b_true = -1.5;
    for (let i = 0; i < 70; i++) {
      const x = (Math.random() * 2 - 1) * 8;
      const y = a_true * x + b_true + (Math.random() * 2 - 1) * 2.2;
      points.push({ x, y });
    }
    updateCounts();
    a = b = 0; lossHistory = [];
    $('#slope, #intercept, #r2, #lastLoss').text('-');
    render();
  });

  $('#mode-add').on('click', function () {
    $(this).addClass('active');
    $('#mode-test').removeClass('active');
    testMode = false;
  });

  $('#mode-test').on('click', function () {
    testMode = !testMode;
    const canvasEl = $('#plot');
    const btn = $(this);

    if (testMode) {
      btn.addClass('test-on active');
      btn.find('.label').text('Testing');
      canvasEl.css('background-color', '#fffbe6');
    } else {
      btn.removeClass('test-on active');
      btn.find('.label').text('Test Mode');
      canvasEl.css('background-color', '#fff');
    }
  });

  $('#mode-clear').on('click', function () {
    points = [];
    updateCounts();
    a = b = 0; lossHistory = [];
    $('#slope, #intercept, #r2, #lastLoss').text('-');
    render();
  });

  $('#btn-step').on('click', () => runSteps($('#fitMethod').val(), parseFloat($('#lr').val()), 1));
  $('#btn-run').on('click', function () {
    if (isRunning) {
      stopRun(); // ?? ? ??
    } else {
      const method = $('#fitMethod').val();
      const lr = parseFloat($('#lr').val());
      const epochs = parseInt($('#epochs').val());
      runSteps(method, lr, epochs);
    }
  });

  // ===============================
  // Canvas ?? ( ? ?)
  // ===============================
  let pressTimer = null, pressX = 0, pressY = 0, longPressTriggered = false;
  let tooltip = null; // ? jQuery ? ?
  const LONG_PRESS_MS = 500;

  // Tooltip ? (DOM ? ?)
  function showTooltip(x, y, worldX, worldY) {
    if (!tooltip) {
      tooltip = $('<div>')
        .css({
          position: 'absolute',
          background: 'rgba(255,255,255,0.9)',
          border: '1px solid #ccc',
          padding: '2px 6px',
          'border-radius': '4px',
          'font-size': '12px',
          'pointer-events': 'none',
          'z-index': 10,
        })
        .appendTo('body');
    }
    tooltip
      .text(`(${worldX.toFixed(2)}, ${worldY.toFixed(2)})`)
      .css({ left: x + 12, top: y + 6 })
      .fadeIn(100);
  }
  function hideTooltip() {
    tooltip?.fadeOut(100);
  }

  // handleCanvasPress ?
  function handleCanvasPress(e, isLongPress) {
    const clientX = e.clientX ?? (e.touches?.[0]?.clientX ?? pressX);
    const clientY = e.clientY ?? (e.touches?.[0]?.clientY ?? pressY);
    const { cx, cy } = clientToCanvas(clientX, clientY);
    const { x, y } = canvasToWorld(cx, cy);

    if (testMode) {
      const pred = a * x + b;
      render();
      const pc = worldToCanvas(x, pred);
      const pt = worldToCanvas(x, y);

      // ? ??()
      ctx.beginPath();
      ctx.arc(pt.cx, pt.cy, 6, 0, Math.PI * 2);
      ctx.fillStyle = '#198754';
      ctx.fill();
      ctx.strokeStyle = '#fff';
      ctx.stroke();

      // ? ??(?)
      ctx.beginPath();
      ctx.arc(pc.cx, pc.cy, 6, 0, Math.PI * 2);
      ctx.fillStyle = '#ffc107';
      ctx.fill();
      ctx.strokeStyle = '#000';
      ctx.stroke();

      // ? ?
      ctx.setLineDash([6, 4]);
      ctx.beginPath();
      ctx.moveTo(pt.cx, pt.cy);
      ctx.lineTo(pc.cx, pc.cy);
      ctx.strokeStyle = 'rgba(0,0,0,0.5)';
      ctx.lineWidth = 1.2;
      ctx.stroke();
      ctx.setLineDash([]);

      // ?????
      ctx.fillStyle = '#000';
      ctx.font = '14px sans-serif';
      ctx.fillText(`pred: ${pred.toFixed(3)}`, pc.cx + 10, pc.cy - 10);

      hideTooltip();

      return;
    }

    if (isLongPress) {
      //  ????
      if (!points.length) return;
      let best = -1, bestD = Infinity;
      points.forEach((p, i) => {
        const d2 = (p.x - x) ** 2 + (p.y - y) ** 2;
        if (d2 < bestD) { bestD = d2; best = i; }
      });
      if (best >= 0) {
        points.splice(best, 1);
        updateCounts(); render();
        longPressTriggered = true;
        hideTooltip();
      }
    } else {
      //  ? ????? +  ? ?
      points.push({ x, y });
      updateCounts(); render();
      const rect = canvas.getBoundingClientRect();
      showTooltip(clientX, clientY, x, y);
      setTimeout(hideTooltip, 1500);
    }
  }

  $(canvas)
    .on('mousedown touchstart', e => {
      const t = e.type === 'touchstart' ? e.originalEvent.touches[0] : e;
      pressX = t.clientX; pressY = t.clientY;
      longPressTriggered = false;
      pressTimer = setTimeout(() => handleCanvasPress(e, true), LONG_PRESS_MS);
    })
    .on('mouseup touchend mouseleave', e => {
      clearTimeout(pressTimer);
      if (longPressTriggered) {
        e.preventDefault();
        e.stopImmediatePropagation();
      }
    })
    .on('click', e => {
      if (!longPressTriggered) handleCanvasPress(e, false);
    });

  // ===============================
  // ? ??HiDPI ???
  // ===============================
  $(window).on('resize', function () {
    setupHiDPI(canvas);
    setupHiDPI(lossCanvas);
    render();
  });

  updateCounts();
  render();
});
