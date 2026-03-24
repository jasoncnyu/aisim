$(function () {
  const canvas = document.getElementById("gridCanvas");
  const ctx = canvas.getContext("2d");

  let gridW = parseInt($("#gridW").val(), 10);
  let gridH = parseInt($("#gridH").val(), 10);
  let cellSize = Math.floor(Math.min(canvas.width / gridW, canvas.height / gridH));
  let map = [];
  let start = null;
  let goal = null;

  const actions = [[0, -1], [1, 0], [0, 1], [-1, 0]];
  const A_NAMES = ["↑", "→", "↓", "←"];

  let Q = [];
  let V = [];
  let policy = [];
  let gamma = parseFloat($("#gamma").val());
  let alpha = parseFloat($("#alpha").val());
  let epsilon = parseFloat($("#epsilon").val());

  let runTimer = null;
  let runMode = false;
  let showValues = true;

  function idx(x, y) { return y * gridW + x; }
  function inBounds(x, y) { return x >= 0 && x < gridW && y >= 0 && y < gridH; }

  function resetMapArrays() {
    map = new Array(gridW * gridH).fill(0).map(() => ({ type: "free", reward: parseFloat($("#cellReward").val()) }));
    start = null;
    goal = null;
  }

  function applyGridSize() {
    gridW = parseInt($("#gridW").val(), 10);
    gridH = parseInt($("#gridH").val(), 10);
    cellSize = Math.floor(Math.min(canvas.width / gridW, canvas.height / gridH));
    resetMapArrays();
    initRL();
    showValues = false;
    drawAll();
  }

  function initRL() {
    const S = gridW * gridH;
    Q = Array.from({ length: S }, () => new Array(4).fill(0));
    V = new Array(S).fill(0);
    policy = new Array(S).fill(0);
    gamma = parseFloat($("#gamma").val());
    alpha = parseFloat($("#alpha").val());
    epsilon = parseFloat($("#epsilon").val());
    $("#policyText").text("");
    $("#curEpisode").text(0);
    $("#curStep").text(0);
    $("#lastReturn").text("-");
  }

  function gridToCanvas(gx, gy) {
    return { cx: (gx + 0.5) * cellSize, cy: (gy + 0.5) * cellSize };
  }

  function drawCell(x, y) {
    const s = idx(x, y);
    const cell = map[s];
    const xpx = x * cellSize;
    const ypx = y * cellSize;

    if (cell.type === "wall") ctx.fillStyle = "#1f2937";
    else if (cell.type === "start") ctx.fillStyle = "#c7f2df";
    else if (cell.type === "goal") ctx.fillStyle = "#ffd2c7";
    else ctx.fillStyle = "#cfe8d6";

    ctx.fillRect(xpx, ypx, cellSize, cellSize);
    ctx.strokeStyle = "#94a3b8";
    ctx.strokeRect(xpx, ypx, cellSize, cellSize);

    if (showValues && (cell.type !== "wall")) {
      const val = V[s] || 0;
      const t = Math.tanh(val);
      if (Math.abs(t) > 0.01) {
        const r = Math.round(220 * Math.max(0, t));
        const g = Math.round(200 * (1 - Math.abs(t)));
        const b = Math.round(220 * Math.max(0, -t));
        ctx.fillStyle = `rgba(${r},${g},${b},0.25)`;
        ctx.fillRect(xpx, ypx, cellSize, cellSize);
      }
    }

    if (cell.type === "goal") {
      ctx.fillStyle = "#7a2e1e";
      ctx.font = `${Math.max(14, cellSize * 0.5)}px "Segoe UI Emoji", "Apple Color Emoji", sans-serif`;
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.fillText("🎯", xpx + cellSize * 0.5, ypx + cellSize * 0.55);
      ctx.textAlign = "start";
      ctx.textBaseline = "alphabetic";
    }
    if (cell.type === "start") {
      ctx.fillStyle = "#0f5132";
      ctx.font = `${Math.max(14, cellSize * 0.5)}px "Segoe UI Emoji", "Apple Color Emoji", sans-serif`;
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.fillText("🚩", xpx + cellSize * 0.5, ypx + cellSize * 0.55);
      ctx.textAlign = "start";
      ctx.textBaseline = "alphabetic";
    }

    if (cell.type !== "wall" && cell.type !== "start" && cell.type !== "goal") {
      const a = policy[s] || 0;
      ctx.fillStyle = "#0f172a";
      ctx.font = `${Math.max(10, cellSize / 3)}px sans-serif`;
      ctx.fillText(A_NAMES[a], xpx + cellSize * 0.38, ypx + cellSize * 0.62);
    }
  }

  function drawAll() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    for (let y = 0; y < gridH; y++) {
      for (let x = 0; x < gridW; x++) drawCell(x, y);
    }
  }

  let curTool = "wall";
  function setTool(t) {
    curTool = t;
    const active = {
      wall: $("#tool-wall"),
      start: $("#tool-start"),
      goal: $("#tool-goal"),
    };
    Object.values(active).forEach((el) => el.removeClass("bg-slate-900 text-white border-slate-700"));
    active[t].addClass("bg-slate-900 text-white border-slate-700");
  }
  $("#tool-wall").on("click", () => setTool("wall"));
  $("#tool-start").on("click", () => setTool("start"));
  $("#tool-goal").on("click", () => setTool("goal"));

  canvas.addEventListener("click", function (e) {
    const rect = canvas.getBoundingClientRect();
    const mx = Math.floor((e.clientX - rect.left) / cellSize);
    const my = Math.floor((e.clientY - rect.top) / cellSize);
    if (!inBounds(mx, my)) return;
    const s = idx(mx, my);

    if (curTool === "wall") {
      if (map[s].type === "wall") map[s].type = "free";
      else {
        map[s].type = "wall";
        if (start === s) start = null;
        if (goal === s) goal = null;
      }
    } else if (curTool === "start") {
      if (start !== null) map[start].type = "free";
      map[s].type = "start";
      start = s;
    } else if (curTool === "goal") {
      if (goal !== null) map[goal].type = "free";
      map[s].type = "goal";
      goal = s;
      map[s].reward = parseFloat($("#goalReward").val());
    }
    initRL();
    showValues = false;
    drawAll();
  });

  function applyDemoMap() {
    applyGridSize();
    for (let y = 0; y < gridH; y++) {
      for (let x = 0; x < gridW; x++) {
        const s = idx(x, y);
        map[s].type = "free";
        map[s].reward = parseFloat($("#cellReward").val());
      }
    }
    for (let x = 0; x < gridW; x++) { map[idx(x, 0)].type = "wall"; map[idx(x, gridH - 1)].type = "wall"; }
    for (let y = 0; y < gridH; y++) { map[idx(0, y)].type = "wall"; map[idx(gridW - 1, y)].type = "wall"; }

    const nWalls = Math.max(1, Math.floor(gridW * gridH * 0.12));
    for (let i = 0; i < nWalls; i++) {
      const rx = 1 + Math.floor(Math.random() * (gridW - 2));
      const ry = 1 + Math.floor(Math.random() * (gridH - 2));
      map[idx(rx, ry)].type = "wall";
    }
    map[idx(1, gridH - 2)].type = "start";
    start = idx(1, gridH - 2);
    map[idx(gridW - 2, 1)].type = "goal";
    goal = idx(gridW - 2, 1);
    map[goal].reward = parseFloat($("#goalReward").val());

    initRL();
    showValues = false;
    drawAll();
  }
  $("#btn-randomMap").on("click", applyDemoMap);

  function stepEnvironment(stateIdx, action) {
    const x = stateIdx % gridW;
    const y = Math.floor(stateIdx / gridW);
    const a = actions[action];
    const nx = x + a[0];
    const ny = y + a[1];
    if (!inBounds(nx, ny)) return { next: stateIdx, reward: map[stateIdx].reward, done: false };
    const ns = idx(nx, ny);
    if (map[ns].type === "wall") return { next: stateIdx, reward: map[stateIdx].reward, done: false };
    const r = map[ns].reward !== undefined ? map[ns].reward : parseFloat($("#cellReward").val());
    return { next: ns, reward: r, done: ns === goal };
  }

  function qLearningEpisode(maxSteps) {
    if (start === null || goal === null) return 0;
    let s = start;
    let totalR = 0;
    for (let t = 0; t < maxSteps; t++) {
      let a;
      if (Math.random() < epsilon) a = Math.floor(Math.random() * 4);
      else {
        const qs = Q[s];
        const best = Math.max(...qs);
        const cands = qs.map((v, i) => (v === best ? i : -1)).filter((v) => v >= 0);
        a = cands[Math.floor(Math.random() * cands.length)];
      }
      const { next, reward, done } = stepEnvironment(s, a);
      const maxNext = Math.max(...Q[next]);
      Q[s][a] += alpha * (reward + gamma * maxNext - Q[s][a]);
      totalR += reward;
      s = next;
      if (done) break;
    }
    for (let i = 0; i < gridW * gridH; i++) {
      V[i] = Math.max(...Q[i]);
      policy[i] = Q[i].indexOf(Math.max(...Q[i]));
    }
    return totalR;
  }

  function valueIteration(iterMax = 100, theta = 1e-4) {
    const S = gridW * gridH;
    V = new Array(S).fill(0);
    for (let it = 0; it < iterMax; it++) {
      let delta = 0;
      for (let s = 0; s < S; s++) {
        if (map[s].type === "wall") continue;
        if (s === goal) { V[s] = map[s].reward || parseFloat($("#goalReward").val()); continue; }
        let best = -Infinity;
        for (let a = 0; a < 4; a++) {
          const { next, reward } = stepEnvironment(s, a);
          const val = reward + gamma * V[next];
          if (val > best) best = val;
        }
        delta = Math.max(delta, Math.abs(best - V[s]));
        V[s] = best;
      }
      if (delta < theta) break;
    }
    for (let s = 0; s < S; s++) {
      if (map[s].type === "wall") continue;
      let bestVal = -Infinity, bestA = 0;
      for (let a = 0; a < 4; a++) {
        const { next, reward } = stepEnvironment(s, a);
        const val = reward + gamma * V[next];
        if (val > bestVal) { bestVal = val; bestA = a; }
      }
      policy[s] = bestA;
    }
    drawAll();
  }

  function policyIteration(itMax = 20) {
    const S = gridW * gridH;
    for (let s = 0; s < S; s++) policy[s] = 0;
    for (let iter = 0; iter < itMax; iter++) {
      V = new Array(S).fill(0);
      for (let k = 0; k < 50; k++) {
        let delta = 0;
        for (let s = 0; s < S; s++) {
          if (map[s].type === "wall") continue;
          if (s === goal) { V[s] = map[s].reward || parseFloat($("#goalReward").val()); continue; }
          const a = policy[s];
          const { next, reward } = stepEnvironment(s, a);
          const vNew = reward + gamma * V[next];
          delta = Math.max(delta, Math.abs(vNew - V[s]));
          V[s] = vNew;
        }
        if (delta < 1e-4) break;
      }
      let stable = true;
      for (let s = 0; s < S; s++) {
        if (map[s].type === "wall" || s === goal) continue;
        const oldA = policy[s];
        let bestA = oldA, bestV = -Infinity;
        for (let a = 0; a < 4; a++) {
          const { next, reward } = stepEnvironment(s, a);
          const val = reward + gamma * V[next];
          if (val > bestV) { bestV = val; bestA = a; }
        }
        policy[s] = bestA;
        if (bestA !== oldA) stable = false;
      }
      if (stable) break;
    }
    drawAll();
  }

  function updatePolicyText() {
    let txt = "";
    for (let y = 0; y < gridH; y++) {
      let row = "";
      for (let x = 0; x < gridW; x++) {
        const s = idx(x, y);
        if (map[s].type === "wall") row += " # ";
        else if (map[s].type === "goal") row += " G ";
        else if (map[s].type === "start") row += " S ";
        else row += ` ${A_NAMES[policy[s] || 0]} `;
      }
      txt += `${row}\n`;
    }
    $("#policyText").text(txt);
  }

  $("#btn-applyGrid").on("click", applyGridSize);

  $("#btn-downloadPolicy").on("click", function () {
    const out = { gridW, gridH, map, Q, V, policy };
    const blob = new Blob([JSON.stringify(out)], { type: "application/json" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "grid_policy.json";
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(url);
  });

  $("#btn-loadPolicy").on("click", function () { $("#filePolicy").click(); });
  $("#filePolicy").on("change", function (e) {
    const f = e.target.files[0];
    if (!f) return;
    const r = new FileReader();
    r.onload = () => {
      try {
        const obj = JSON.parse(r.result);
        if (obj.gridW && obj.gridH) {
          $("#gridW").val(obj.gridW);
          $("#gridH").val(obj.gridH);
          applyGridSize();
          if (obj.map) map = obj.map;
          if (obj.Q) Q = obj.Q;
          if (obj.V) V = obj.V;
          if (obj.policy) policy = obj.policy;
          drawAll();
          updatePolicyText();
        } else {
          alert("Invalid policy file");
        }
      } catch {
        alert("Error reading file");
      }
    };
    r.readAsText(f);
  });

  $("#btn-step").on("click", function () {
    const algo = $("#algo").val();
    showValues = true;
    if (algo === "qlearn") {
      const ret = qLearningEpisode(1);
      $("#lastReturn").text(ret.toFixed(3));
      drawAll();
      updatePolicyText();
    } else if (algo === "value_iter") {
      valueIteration(100, 1e-3);
      updatePolicyText();
    } else {
      policyIteration(20);
      updatePolicyText();
    }
  });

  $("#btn-run").on("click", function () {
    if (runMode) {
      runMode = false;
      clearInterval(runTimer);
      $("#btn-run").text("Run").removeClass("bg-red-700").addClass("bg-emerald-700");
      $("#modeLabel").text("Stopped");
      return;
    }
    const algo = $("#algo").val();
    $("#totalEpisodes").text(parseInt($("#episodes").val(), 10));
    runMode = true;
    showValues = true;
    $("#btn-run").text("Stop").removeClass("bg-emerald-700").addClass("bg-red-700");
    $("#modeLabel").text(`Running: ${algo}`);

    if (algo === "qlearn") {
      let ep = 0;
      const total = parseInt($("#episodes").val(), 10);
      runTimer = setInterval(() => {
        if (!runMode || ep >= total) {
          clearInterval(runTimer);
          runMode = false;
          $("#btn-run").text("Run").removeClass("bg-red-700").addClass("bg-emerald-700");
          $("#modeLabel").text("Idle");
          return;
        }
        const ret = qLearningEpisode(1000);
        ep++;
        $("#curEpisode").text(ep);
        $("#lastReturn").text(ret.toFixed(3));
        updatePolicyText();
        drawAll();
      }, parseInt($("#speed").val(), 10));
    } else if (algo === "value_iter") {
      valueIteration(500, 1e-4);
      updatePolicyText();
      runMode = false;
      $("#btn-run").text("Run").removeClass("bg-red-700").addClass("bg-emerald-700");
      $("#modeLabel").text("Idle");
    } else {
      policyIteration(50);
      updatePolicyText();
      runMode = false;
      $("#btn-run").text("Run").removeClass("bg-red-700").addClass("bg-emerald-700");
      $("#modeLabel").text("Idle");
    }
  });

  $("#btn-stop").on("click", function () {
    runMode = false;
    clearInterval(runTimer);
    $("#btn-run").text("Run").removeClass("bg-red-700").addClass("bg-emerald-700");
    $("#modeLabel").text("Stopped");
  });

  $("#btn-export").on("click", function () {
    let csv = "x,y,action,value\n";
    for (let y = 0; y < gridH; y++) {
      for (let x = 0; x < gridW; x++) {
        const s = idx(x, y);
        csv += `${x},${y},${policy[s] || 0},${(V[s] || 0)}\n`;
      }
    }
    const blob = new Blob([csv], { type: "text/csv" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "grid_policy.csv";
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(url);
  });

  applyGridSize();
  applyDemoMap();
  initRL();
  drawAll();
  updatePolicyText();
});
