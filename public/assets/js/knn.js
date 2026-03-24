$(function () {
  const canvas = document.getElementById("knnCanvas");

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
  let testPoints = [];
  let testMode = false;
  let currentClass = "A";

  function setClassButtons() {
    if (currentClass === "A") {
      $("#btn-classA").addClass("bg-cyan-100 border-cyan-300 text-cyan-900");
      $("#btn-classB").removeClass("bg-red-100 border-red-300 text-red-900");
    } else {
      $("#btn-classB").addClass("bg-red-100 border-red-300 text-red-900");
      $("#btn-classA").removeClass("bg-cyan-100 border-cyan-300 text-cyan-900");
    }
  }

  function setTestModeButton() {
    const btn = $("#btn-testmode");
    if (testMode) {
      btn.text("Test Mode ON").addClass("bg-amber-100 border-amber-300 text-amber-900");
    } else {
      btn.text("Test Mode").removeClass("bg-amber-100 border-amber-300 text-amber-900");
    }
  }

  function updateCounts() {
    $("#countA").text(points.filter((p) => p.label === "A").length);
    $("#countB").text(points.filter((p) => p.label === "B").length);
  }

  function knnPredict(x, y, k, weighted) {
    if (!points.length) return { probB: 0, neighbors: [], classLabel: "A" };

    const dists = points.map((p) => {
      const dx = p.x - x;
      const dy = p.y - y;
      return { p, d2: dx * dx + dy * dy };
    });

    dists.sort((a, b) => a.d2 - b.d2);
    const neighbors = dists.slice(0, k).map((it) => {
      const pos = worldToCanvas(it.p.x, it.p.y);
      return {
        p: it.p,
        d2: it.d2,
        label: it.p.label,
        cx: pos.cx,
        cy: pos.cy,
      };
    });

    let scoreB = 0;
    let weightSum = 0;

    neighbors.forEach((n) => {
      if (weighted) {
        const w = n.d2 === 0 ? 1e9 : 1 / Math.sqrt(n.d2);
        weightSum += w;
        if (n.label === "B") scoreB += w;
      } else {
        weightSum += 1;
        if (n.label === "B") scoreB += 1;
      }
    });

    const probB = weightSum === 0 ? 0 : scoreB / weightSum;
    return { probB, neighbors, classLabel: probB >= 0.5 ? "B" : "A" };
  }

  function handleTestClick(x, y, cx, cy) {
    const k = Math.max(1, parseInt($("#kVal").val(), 10) || 5);
    const weighted = $("#weighted").is(":checked");
    const result = knnPredict(x, y, k, weighted);

    testPoints = [{ x, y, cx, cy, probB: result.probB, neighbors: result.neighbors, classLabel: result.classLabel }];

    let text = "";
    result.neighbors.forEach((n, i) => {
      text += `${i + 1}. (${n.p.x.toFixed(2)}, ${n.p.y.toFixed(2)}) class=${n.label} dist=${Math.sqrt(n.d2).toFixed(3)}\n`;
    });

    $("#neighbors").text(text || "(no neighbors)");
    $("#lastProb").text(`${(result.probB * 100).toFixed(2)}% | class: ${result.classLabel}`);
    render();
  }

  function drawRegions(k, weighted) {
    if (!points.length) return;

    const res = clamp(parseInt($("#res").val(), 10) || 120, 40, 300);
    const stepX = cw() / res;
    const stepY = ch() / Math.max(1, Math.round((res * ch()) / cw()));

    for (let gx = 0; gx < cw(); gx += Math.max(1, Math.floor(stepX))) {
      for (let gy = 0; gy < ch(); gy += Math.max(1, Math.floor(stepY))) {
        const wx = ((gx + 0.5) / cw()) * (XMAX - XMIN) + XMIN;
        const wy = (1 - (gy + 0.5) / ch()) * (YMAX - YMIN) + YMIN;
        const r = knnPredict(wx, wy, k, weighted);
        const prob = r.probB;

        const red = Math.round(220 * prob + 20 * (1 - prob));
        const green = Math.round(60 * (1 - prob));
        const blue = Math.round(220 * (1 - prob) + 20 * prob);
        ctx.fillStyle = `rgba(${red},${green},${blue},0.45)`;
        ctx.fillRect(gx, gy, Math.max(1, Math.floor(stepX)), Math.max(1, Math.floor(stepY)));
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
      ctx.arc(c.cx, c.cy, 5.6, 0, Math.PI * 2);
      ctx.fillStyle = p.label === "A" ? "#06b6d4" : "#ef4444";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = 1;
      ctx.stroke();
    });
  }

  function drawTestPoints() {
    testPoints.forEach((t) => {
      t.neighbors.forEach((n) => {
        ctx.beginPath();
        ctx.moveTo(t.cx, t.cy);
        ctx.lineTo(n.cx, n.cy);
        ctx.strokeStyle = "rgba(15,23,42,0.38)";
        ctx.lineWidth = 1.4;
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(n.cx, n.cy, 8.3, 0, Math.PI * 2);
        ctx.strokeStyle = "#0f172a";
        ctx.lineWidth = 1.3;
        ctx.stroke();
      });

      ctx.beginPath();
      ctx.arc(t.cx, t.cy, 6.8, 0, Math.PI * 2);
      ctx.fillStyle = t.classLabel === "A" ? "#06b6d4" : "#ef4444";
      ctx.fill();
      ctx.strokeStyle = "#0f172a";
      ctx.lineWidth = 1.6;
      ctx.stroke();

      ctx.fillStyle = "#0f172a";
      ctx.font = "12px sans-serif";
      ctx.fillText(`${(t.probB * 100).toFixed(1)}%`, t.cx + 10, t.cy - 10);
    });
  }

  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, cw(), ch());

    const k = Math.max(1, parseInt($("#kVal").val(), 10) || 5);
    const weighted = $("#weighted").is(":checked");

    drawRegions(k, weighted);
    drawAxes();
    drawPoints();
    drawTestPoints();
  }

  function addCluster(cx, cy, label, n, spread) {
    for (let i = 0; i < n; i++) {
      points.push({
        x: cx + (Math.random() * 2 - 1) * spread,
        y: cy + (Math.random() * 2 - 1) * spread,
        label,
      });
    }
  }

  function loadDemo(type) {
    points = [];

    if (type === "vertical") {
      addCluster(-2.5, 1.0, "A", 18, 0.9);
      addCluster(-2.2, -1.0, "A", 12, 0.7);
      addCluster(1.0, 0.0, "A", 6, 0.8);
      addCluster(2.5, 1.0, "B", 18, 0.9);
      addCluster(2.2, -1.0, "B", 12, 0.7);
      addCluster(-0.6, 0.0, "B", 6, 0.8);
    } else if (type === "xor") {
      addCluster(-3.0, 3.0, "A", 14, 0.6);
      addCluster(3.0, -3.0, "A", 14, 0.6);
      addCluster(-3.0, -3.0, "B", 14, 0.6);
      addCluster(3.0, 3.0, "B", 14, 0.6);
      addCluster(0.0, 0.0, "A", 4, 0.8);
      addCluster(0.6, -0.6, "B", 4, 0.6);
    } else if (type === "concentric") {
      for (let i = 0; i < 70; i++) {
        const r = Math.random() * 1.0;
        const th = Math.random() * Math.PI * 2;
        points.push({ x: r * Math.cos(th), y: r * Math.sin(th), label: "A" });
      }
      for (let i = 0; i < 140; i++) {
        const r = 1.6 + Math.random() * 0.6;
        const th = Math.random() * Math.PI * 2;
        points.push({ x: r * Math.cos(th), y: r * Math.sin(th), label: "B" });
      }
    } else if (type === "overlap") {
      addCluster(-1.0, 0.5, "A", 40, 1.2);
      addCluster(1.0, -0.3, "B", 40, 1.2);
      addCluster(0.2, 0.3, "A", 8, 0.6);
      addCluster(-0.4, -0.5, "B", 8, 0.6);
    } else {
      for (let i = 0; i < 6; i++) {
        const cx = (Math.random() * 2 - 1) * 3.5;
        const cy = (Math.random() * 2 - 1) * 3.5;
        addCluster(cx, cy, i % 2 === 0 ? "A" : "B", 12, 0.8 + Math.random() * 0.6);
      }
      for (let i = 0; i < 20; i++) {
        points.push({
          x: (Math.random() * 2 - 1) * 4.8,
          y: (Math.random() * 2 - 1) * 4.8,
          label: Math.random() > 0.5 ? "A" : "B",
        });
      }
    }

    testPoints = [];
    $("#neighbors").text("");
    $("#lastProb").text("-");
    updateCounts();
    render();
  }

  canvas.addEventListener("click", function (e) {
    const p = clientToCanvas(e.clientX, e.clientY);
    const w = canvasToWorld(p.cx, p.cy);

    if (testMode) {
      handleTestClick(w.x, w.y, p.cx, p.cy);
      return;
    }

    points.push({ x: w.x, y: w.y, label: currentClass });
    updateCounts();
    render();
  });

  $("#btn-classA").on("click", function () {
    currentClass = "A";
    setClassButtons();
  });

  $("#btn-classB").on("click", function () {
    currentClass = "B";
    setClassButtons();
  });

  $("#btn-testmode").on("click", function () {
    testMode = !testMode;
    setTestModeButton();
  });

  $("#btn-demo").on("click", function () {
    loadDemo($("#demoType").val());
  });

  $("#btn-refresh").on("click", render);

  $("#btn-clear").on("click", function () {
    points = [];
    testPoints = [];
    $("#neighbors").text("");
    $("#lastProb").text("-");
    updateCounts();
    render();
  });

  $("#kVal").on("change", function () {
    const v = clamp(parseInt($(this).val(), 10) || 5, 1, 99);
    $(this).val(v);
    render();
  });

  $("#res, #weighted").on("change", render);

  $(window).on("resize", function () {
    ctx = setupHiDPI(canvas);
    render();
  });

  setClassButtons();
  setTestModeButton();
  updateCounts();
  render();
});
