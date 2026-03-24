$(function () {
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d", { willReadFrequently: true });

  const GRID_W = 60;
  const GRID_H = 30;

  function setupHiDPI(cvs) {
    const dpr = window.devicePixelRatio || 1;
    const rect = cvs.getBoundingClientRect();
    cvs.width = Math.max(1, Math.round(rect.width * dpr));
    cvs.height = Math.max(1, Math.round(rect.height * dpr));
    const cx = cvs.getContext("2d");
    cx.setTransform(dpr, 0, 0, dpr, 0, 0);
    return cx;
  }
  setupHiDPI(canvas);

  const cw = () => canvas.getBoundingClientRect().width;
  const ch = () => canvas.getBoundingClientRect().height;
  const cellW = () => cw() / GRID_W;
  const cellH = () => ch() / GRID_H;

  function clientToCanvas(x, y) {
    const r = canvas.getBoundingClientRect();
    return { cx: x - r.left, cy: y - r.top };
  }
  function canvasToGrid(cx, cy) {
    return {
      gx: Math.max(0, Math.min(GRID_W - 1, Math.floor(cx / cellW()))),
      gy: Math.max(0, Math.min(GRID_H - 1, Math.floor(cy / cellH()))),
    };
  }
  function gridToCanvas(gx, gy) {
    return { cx: (gx + 0.5) * cellW(), cy: (gy + 0.5) * cellH() };
  }

  let points = [];
  let tree = null;
  let calcLog = [];
  let currentClass = "A";

  $("#btn-classA").on("click", () => {
    currentClass = "A";
    $("#btn-classA").addClass("bg-cyan-100 border-cyan-300 text-cyan-900");
    $("#btn-classB").removeClass("bg-red-100 border-red-300 text-red-900");
  });
  $("#btn-classB").on("click", () => {
    currentClass = "B";
    $("#btn-classB").addClass("bg-red-100 border-red-300 text-red-900");
    $("#btn-classA").removeClass("bg-cyan-100 border-cyan-300 text-cyan-900");
  });
  $("#btn-clear").on("click", () => {
    points = [];
    tree = null;
    $("#treeText").text("");
    $("#calcLog").text("");
    updateCounts();
    render();
  });

  canvas.addEventListener("click", function (e) {
    const { cx, cy } = clientToCanvas(e.clientX, e.clientY);
    const { gx, gy } = canvasToGrid(cx, cy);
    if (points.some((p) => p.gx === gx && p.gy === gy)) return;
    points.push({ gx, gy, label: currentClass });
    updateCounts();
    render();
  });

  $("#btn-demo-load").on("click", function () {
    const type = $("#demoType").val();
    points = [];

    function addGridCluster(gx, gy, label, n, spread) {
      for (let i = 0; i < n; i++) {
        const dx = Math.round((Math.random() * 2 - 1) * spread);
        const dy = Math.round((Math.random() * 2 - 1) * spread);
        const x = Math.max(0, Math.min(GRID_W - 1, gx + dx));
        const y = Math.max(0, Math.min(GRID_H - 1, gy + dy));
        if (!points.some((p) => p.gx === x && p.gy === y)) points.push({ gx: x, gy: y, label });
      }
    }

    const cx = Math.round(GRID_W / 2);
    const cy = Math.round(GRID_H / 2);

    if (type === "xor") {
      addGridCluster(Math.round(GRID_W * 0.2), Math.round(GRID_H * 0.2), "A", 12, 2);
      addGridCluster(Math.round(GRID_W * 0.8), Math.round(GRID_H * 0.8), "A", 12, 2);
      addGridCluster(Math.round(GRID_W * 0.2), Math.round(GRID_H * 0.8), "B", 12, 2);
      addGridCluster(Math.round(GRID_W * 0.8), Math.round(GRID_H * 0.2), "B", 12, 2);
    } else if (type === "concentric") {
      const rInner = Math.max(1, Math.round(Math.min(GRID_W, GRID_H) * 0.1));
      const rOuter = Math.max(2, Math.round(Math.min(GRID_W, GRID_H) * 0.25));
      for (let i = 0; i < 80; i++) {
        const r = Math.random() * rInner;
        const th = Math.random() * Math.PI * 2;
        const gx = Math.round(cx + r * Math.cos(th));
        const gy = Math.round(cy + r * Math.sin(th));
        if (gx >= 0 && gx < GRID_W && gy >= 0 && gy < GRID_H) points.push({ gx, gy, label: "A" });
      }
      for (let i = 0; i < 160; i++) {
        const r = rOuter + Math.random() * Math.max(2, Math.round(rOuter * 0.4));
        const th = Math.random() * Math.PI * 2;
        const gx = Math.round(cx + r * Math.cos(th));
        const gy = Math.round(cy + r * Math.sin(th));
        if (gx >= 0 && gx < GRID_W && gy >= 0 && gy < GRID_H) points.push({ gx, gy, label: "B" });
      }
    } else if (type === "overlap") {
      addGridCluster(cx - Math.round(GRID_W * 0.08), cy - Math.round(GRID_H * 0.08), "A", 30, 3);
      addGridCluster(cx + Math.round(GRID_W * 0.08), cy + Math.round(GRID_H * 0.08), "B", 30, 3);
      addGridCluster(cx, cy, "A", 12, 2);
      addGridCluster(cx, cy, "B", 12, 2);
    } else {
      for (let k = 0; k < 6; k++) {
        const gx = Math.floor(Math.random() * GRID_W);
        const gy = Math.floor(Math.random() * GRID_H);
        const lab = k % 2 === 0 ? "A" : "B";
        addGridCluster(gx, gy, lab, 15, 3);
      }
    }

    tree = null;
    $("#treeText").text("");
    $("#calcLog").text("");
    updateCounts();
    render();
  });

  function gini(arr) {
    if (!arr.length) return 0;
    const n = arr.length;
    const pB = arr.filter((p) => p.label === "B").length / n;
    const pA = 1 - pB;
    return 1 - (pA * pA + pB * pB);
  }

  function bestSplit(data) {
    if (data.length <= 1) return null;
    let best = null;
    calcLog.push(`Evaluating ${data.length} samples`);

    for (let feat = 0; feat < 2; feat++) {
      const featName = feat === 0 ? "x" : "y";
      const vals = Array.from(new Set(data.map((p) => (feat === 0 ? p.gx : p.gy)))).sort((a, b) => a - b);
      if (vals.length <= 1) continue;
      for (let i = 0; i < vals.length - 1; i++) {
        const thr = Math.round((vals[i] + vals[i + 1]) / 2);
        const left = data.filter((p) => (feat === 0 ? p.gx : p.gy) <= thr);
        const right = data.filter((p) => (feat === 0 ? p.gx : p.gy) > thr);
        if (!left.length || !right.length) continue;
        const gL = gini(left);
        const gR = gini(right);
        const imp = (left.length * gL + right.length * gR) / data.length;
        calcLog.push(`  ${featName}<=${thr}: GiniL=${gL.toFixed(3)} GiniR=${gR.toFixed(3)} Weighted=${imp.toFixed(3)}`);
        if (best === null || imp < best.impurity) best = { feature: feat, threshold: thr, impurity: imp, left, right };
      }
    }

    if (best) {
      const fname = best.feature === 0 ? "x" : "y";
      calcLog.push(`Best split: ${fname} <= ${best.threshold} (imp=${best.impurity.toFixed(3)})`);
    } else {
      calcLog.push("No valid split");
    }
    calcLog.push("");
    return best;
  }

  function buildTree(data, depth, maxDepth, minSamples) {
    const n = data.length;
    const pB = data.filter((p) => p.label === "B").length / (n || 1);
    if (depth >= maxDepth || n < minSamples || gini(data) === 0) return { type: "leaf", n, prob: pB, class: pB >= 0.5 ? "B" : "A" };
    const split = bestSplit(data);
    if (!split) return { type: "leaf", n, prob: pB, class: pB >= 0.5 ? "B" : "A" };
    return {
      type: "node",
      feature: split.feature,
      threshold: split.threshold,
      impurity: split.impurity,
      left: buildTree(split.left, depth + 1, maxDepth, minSamples),
      right: buildTree(split.right, depth + 1, maxDepth, minSamples),
    };
  }

  function predictTree(node, gx, gy) {
    if (!node) return 0;
    if (node.type === "leaf") return node.prob;
    const v = node.feature === 0 ? gx : gy;
    return v <= node.threshold ? predictTree(node.left, gx, gy) : predictTree(node.right, gx, gy);
  }

  function treeToText(node, indent = "") {
    if (!node) return `${indent}<empty>\n`;
    if (node.type === "leaf") return `${indent}Leaf: n=${node.n}, p(B)=${node.prob.toFixed(2)}, class=${node.class}\n`;
    const featName = node.feature === 0 ? "x" : "y";
    let s = `${indent}if ${featName} <= ${node.threshold} (imp=${node.impurity.toFixed(3)})\n`;
    s += treeToText(node.left, `${indent}  `);
    s += `${indent}else\n`;
    s += treeToText(node.right, `${indent}  `);
    return s;
  }

  function updateCounts() {
    const aPoints = points.filter((p) => p.label === "A");
    const bPoints = points.filter((p) => p.label === "B");
    $("#countA").text(aPoints.length);
    $("#countB").text(bPoints.length);
    const toText = (arr) => arr.map((p) => `(${p.gx},${p.gy})`).join(" ");
    $("#pointsAList").val(toText(aPoints));
    $("#pointsBList").val(toText(bPoints));
  }

  function drawSplits(node, xmin, xmax, ymin, ymax, depth = 1) {
    if (!node || node.type === "leaf") return;
    const bw = cellW();
    const bh = cellH();
    ctx.save();
    ctx.strokeStyle = "rgba(15,23,42,0.85)";
    ctx.lineWidth = 2;
    ctx.font = `${Math.max(10, Math.round(bh * 0.75))}px sans-serif`;
    ctx.fillStyle = "rgba(15,23,42,0.85)";

    if (node.feature === 0) {
      const boundary = node.threshold + 1;
      const x = boundary * bw;
      ctx.beginPath();
      ctx.moveTo(x, ymin * bh);
      ctx.lineTo(x, ymax * bh);
      ctx.stroke();
      ctx.save();
      ctx.translate(Math.min(cw() - 14, x + 10), Math.max(20, ymin * bh + 24));
      ctx.rotate(-Math.PI / 2);
      ctx.fillText(`(${depth}) x<=${node.threshold}`, 0, 0);
      ctx.restore();
      drawSplits(node.left, xmin, boundary, ymin, ymax, depth + 1);
      drawSplits(node.right, boundary, xmax, ymin, ymax, depth + 1);
    } else {
      const boundary = node.threshold + 1;
      const y = boundary * bh;
      ctx.beginPath();
      ctx.moveTo(xmin * bw, y);
      ctx.lineTo(xmax * bw, y);
      ctx.stroke();
      ctx.fillText(`(${depth}) y<=${node.threshold}`, Math.max(30, xmin * bw + 30), Math.min(ch() - 10, y + 14));
      drawSplits(node.left, xmin, xmax, ymin, boundary, depth + 1);
      drawSplits(node.right, xmin, xmax, boundary, ymax, depth + 1);
    }
    ctx.restore();
  }

  function render() {
    ctx.clearRect(0, 0, cw(), ch());
    if (tree && $("#showRegions").is(":checked")) {
      for (let gx = 0; gx < GRID_W; gx++) {
        for (let gy = 0; gy < GRID_H; gy++) {
          const p = predictTree(tree, gx, gy);
          const r = Math.round(220 * p + 20 * (1 - p));
          const g = Math.round(60 * (1 - p));
          const b = Math.round(220 * (1 - p) + 20 * p);
          ctx.fillStyle = `rgba(${r},${g},${b},0.45)`;
          ctx.fillRect(gx * cellW(), gy * cellH(), cellW(), cellH());
        }
      }
    }

    ctx.strokeStyle = "rgba(15,23,42,0.1)";
    ctx.lineWidth = 1;
    for (let x = 0; x <= GRID_W; x++) {
      const X = x * cellW();
      ctx.beginPath();
      ctx.moveTo(X, 0);
      ctx.lineTo(X, ch());
      ctx.stroke();
    }
    for (let y = 0; y <= GRID_H; y++) {
      const Y = y * cellH();
      ctx.beginPath();
      ctx.moveTo(0, Y);
      ctx.lineTo(cw(), Y);
      ctx.stroke();
    }

    const r0 = Math.max(2, Math.min(cellW(), cellH()) * 0.35);
    for (const p of points) {
      const pos = gridToCanvas(p.gx, p.gy);
      ctx.beginPath();
      ctx.arc(pos.cx, pos.cy, r0, 0, Math.PI * 2);
      ctx.fillStyle = p.label === "A" ? "#06b6d4" : "#ef4444";
      ctx.fill();
      ctx.strokeStyle = "#ffffff";
      ctx.stroke();
    }

    if (tree) drawSplits(tree, 0, GRID_W, 0, GRID_H);
  }

  $("#btn-train").on("click", function () {
    const maxDepth = parseInt($("#maxDepth").val(), 10) || 4;
    const minSamples = parseInt($("#minSamples").val(), 10) || 5;
    if (!points.length) {
      alert("Add samples first.");
      return;
    }
    calcLog = [];
    tree = buildTree(points, 0, maxDepth, minSamples);
    $("#treeText").text(treeToText(tree));
    $("#calcLog").text(calcLog.join("\n"));
    const score = tree && tree.type === "node" && typeof tree.impurity === "number" ? tree.impurity.toFixed(3) : "-";
    $("#score").text(score);
    render();
  });

  $("#showRegions").on("change", render);
  $(window).on("resize", function () {
    setupHiDPI(canvas);
    render();
  });

  updateCounts();
  render();
});
