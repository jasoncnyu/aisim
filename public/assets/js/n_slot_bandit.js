$(function () {
  function makeRNG(seedStr) {
    if (!seedStr) return Math.random;
    let h = 2166136261 >>> 0;
    for (let i = 0; i < seedStr.length; i++) h = Math.imul(h ^ seedStr.charCodeAt(i), 16777619) >>> 0;
    return (function () {
      let t = h + 0x6D2B79F5;
      return function () {
        t = Math.imul(t ^ (t >>> 15), t | 1);
        t ^= t + Math.imul(t ^ (t >>> 7), t | 61);
        return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
      };
    })();
  }

  let rng = Math.random;
  let arms = [];
  let N = parseInt($("#nArms").val(), 10);
  let steps = parseInt($("#steps").val(), 10);
  let runs = parseInt($("#runs").val(), 10);
  let epsilon = parseFloat($("#epsilon").val());
  let algorithm = $("#algo").val();

  let runInProgress = false;
  let stopRequested = false;
  let singleRunState = null;
  let resultsAvgReward = [];
  let resultsCumRegret = [];

  const rewardCanvas = document.getElementById("rewardChart");
  const rewardCtx = rewardCanvas.getContext("2d");
  const regretCanvas = document.getElementById("regretChart");
  const regretCtx = regretCanvas.getContext("2d");

  function drawLine(ctx, data, color, label) {
    const W = ctx.canvas.width;
    const H = ctx.canvas.height;
    ctx.clearRect(0, 0, W, H);
    if (!data || data.length === 0) return;
    const maxVal = Math.max(...data, 1e-9);

    ctx.strokeStyle = "#cbd5e1";
    ctx.beginPath();
    ctx.moveTo(40, 10);
    ctx.lineTo(40, H - 20);
    ctx.lineTo(W - 10, H - 20);
    ctx.stroke();

    ctx.beginPath();
    ctx.strokeStyle = color;
    ctx.lineWidth = 2;
    for (let i = 0; i < data.length; i++) {
      const x = 40 + (i / Math.max(1, data.length - 1)) * (W - 50);
      const y = H - 20 - (data[i] / maxVal) * (H - 30);
      if (i === 0) ctx.moveTo(x, y);
      else ctx.lineTo(x, y);
    }
    ctx.stroke();

    ctx.fillStyle = "#334155";
    ctx.font = "12px sans-serif";
    ctx.fillText(label, 8, 14);
  }

  function renderArmsInputs() {
    const c = $("#armsContainer").empty();
    for (let i = 0; i < N; i++) {
      const p = arms[i] !== undefined ? arms[i].toFixed(3) : "0.5";
      const row = $(`
        <div class="mb-1 flex items-center gap-2">
          <div class="w-10 text-sm">#${i}</div>
          <input id="armp_${i}" class="w-24 rounded border border-slate-300 px-2 py-1 text-sm" value="${p}">
          <div class="text-xs text-slate-500">est: <span id="est_${i}">-</span> | pulls: <span id="pull_${i}">0</span></div>
        </div>
      `);
      c.append(row);
    }
  }

  function readArmInputs() {
    for (let i = 0; i < N; i++) {
      const v = parseFloat($(`#armp_${i}`).val());
      arms[i] = Number.isFinite(v) && v >= 0 && v <= 1 ? v : 0.5;
    }
  }

  function randomizeArms() {
    for (let i = 0; i < N; i++) arms[i] = 0.1 + rng() * 0.8;
    renderArmsInputs();
    updateArmTable(new Array(N).fill(0), new Array(N).fill(0));
  }

  function updateArmTable(counts, est) {
    for (let i = 0; i < N; i++) {
      $(`#est_${i}`).text(est[i] === undefined ? "-" : est[i].toFixed(3));
      $(`#pull_${i}`).text(counts[i] || 0);
      if ($(`#armp_${i}`).length) $(`#armp_${i}`).val(arms[i].toFixed(3));
    }
  }

  function initSingleRunState() {
    readArmInputs();
    algorithm = $("#algo").val();
    epsilon = parseFloat($("#epsilon").val());
    const n = arms.length;
    const T = parseInt($("#steps").val(), 10);
    singleRunState = {
      t: 0, T,
      counts: new Array(n).fill(0),
      successes: new Array(n).fill(0),
      est: new Array(n).fill(0),
      alpha: new Array(n).fill(1),
      beta: new Array(n).fill(1),
      totalReward: 0,
      rewards: [],
      regret: [],
    };
    $("#curStep").text(0);
    $("#curRun").text(1);
    $("#totalSteps").text(T);
    updateArmTable(singleRunState.counts, singleRunState.est);
  }

  function selectArm(state) {
    const n = arms.length;
    if (algorithm === "eps") {
      if (rng() < epsilon) return Math.floor(rng() * n);
      let best = -Infinity, cands = [];
      for (let i = 0; i < n; i++) {
        if (state.est[i] > best) { best = state.est[i]; cands = [i]; }
        else if (state.est[i] === best) cands.push(i);
      }
      return cands[Math.floor(rng() * cands.length)];
    }
    if (algorithm === "ucb") {
      const untried = state.counts.findIndex((c) => c === 0);
      if (untried !== -1) return untried;
      let best = -Infinity, cands = [];
      for (let i = 0; i < n; i++) {
        const val = state.est[i] + Math.sqrt((2 * Math.log(Math.max(1, state.t))) / state.counts[i]);
        if (val > best) { best = val; cands = [i]; }
        else if (val === best) cands.push(i);
      }
      return cands[Math.floor(rng() * cands.length)];
    }
    // Thompson Sampling
    const samples = [];
    function sampleGamma(k) { let r = 0; for (let m = 0; m < k; m++) r += -Math.log(rng()); return r; }
    for (let i = 0; i < n; i++) {
      const aI = Math.max(1, Math.floor(state.alpha[i]));
      const bI = Math.max(1, Math.floor(state.beta[i]));
      const x = sampleGamma(aI), y = sampleGamma(bI);
      samples[i] = x / (x + y + 1e-12);
    }
    let best = -Infinity, cands = [];
    for (let i = 0; i < n; i++) {
      if (samples[i] > best) { best = samples[i]; cands = [i]; }
      else if (samples[i] === best) cands.push(i);
    }
    return cands[Math.floor(rng() * cands.length)];
  }

  function stepOnce() {
    if (!singleRunState) initSingleRunState();
    const s = singleRunState;
    if (!s || s.t >= s.T) return;

    const choice = selectArm(s);
    const rwd = rng() < arms[choice] ? 1 : 0;
    s.counts[choice] += 1;
    s.successes[choice] += rwd;
    s.est[choice] += (rwd - s.est[choice]) / s.counts[choice];
    if (algorithm === "ts") { s.alpha[choice] += rwd; s.beta[choice] += (1 - rwd); }
    s.totalReward += rwd;
    s.rewards.push(s.totalReward / (s.t + 1));
    const bestP = Math.max(...arms);
    s.regret.push(bestP * (s.t + 1) - s.totalReward);

    $("#curStep").text(s.t + 1);
    $("#avgReward").text((s.rewards[s.rewards.length - 1] || 0).toFixed(4));
    $("#cumRegret").text((s.regret[s.regret.length - 1] || 0).toFixed(4));
    updateArmTable(s.counts, s.est);
    drawLine(rewardCtx, s.rewards, "#2563eb", "Avg reward (single)");
    drawLine(regretCtx, s.regret, "#dc2626", "Cum regret (single)");

    s.t++;
    if (s.t >= s.T) singleRunState = null;
  }

  function setRunUi(isRunning) {
    $("#btn-run").prop("disabled", isRunning)
      .toggleClass("opacity-60 cursor-not-allowed", isRunning);
    $("#btn-stop").prop("disabled", !isRunning)
      .toggleClass("opacity-60 cursor-not-allowed", !isRunning);
  }

  async function runExperiment() {
    if (runInProgress) return;
    runInProgress = true;
    stopRequested = false;
    setRunUi(true);

    if (!singleRunState) initSingleRunState();
    const tick = async () => {
      if (stopRequested) {
        runInProgress = false;
        stopRequested = false;
        setRunUi(false);
        return;
      }
      stepOnce();
      if (!singleRunState) {
        runInProgress = false;
        setRunUi(false);
        return;
      }
      await new Promise((r) => setTimeout(r, 20));
      if (runInProgress) tick();
    };
    tick();
  }

  $("#btn-random").on("click", function () { rng = makeRNG($("#seed").val()); randomizeArms(); });
  $("#btn-apply").on("click", function () {
    rng = makeRNG($("#seed").val());
    N = parseInt($("#nArms").val(), 10);
    renderArmsInputs();
    readArmInputs();
    $("#totalRuns").text($("#runs").val());
    $("#totalSteps").text($("#steps").val());
    $("#curRun").text(0);
    $("#curStep").text(0);
  });
  $("#btn-run").on("click", runExperiment);
  $("#btn-stop").on("click", function () { stopRequested = true; });
  $("#btn-step").on("click", stepOnce);
  $("#btn-reset").on("click", function () {
    stopRequested = true;
    runInProgress = false;
    singleRunState = null;
    rng = Math.random;
    N = parseInt($("#nArms").val(), 10);
    renderArmsInputs();
    $("#curRun").text(0);
    $("#curStep").text(0);
    resultsAvgReward = [];
    resultsCumRegret = [];
    rewardCtx.clearRect(0, 0, rewardCtx.canvas.width, rewardCtx.canvas.height);
    regretCtx.clearRect(0, 0, regretCtx.canvas.width, regretCtx.canvas.height);
    $("#avgReward").text("-");
    $("#cumRegret").text("-");
    setRunUi(false);
  });
  $("#btn-export").on("click", function () {
    if (!resultsAvgReward.length) { alert("No results to export. Run experiment first."); return; }
    let csv = "step,avg_reward,cum_regret\n";
    for (let t = 0; t < resultsAvgReward.length; t++) csv += `${t + 1},${resultsAvgReward[t]},${resultsCumRegret[t]}\n`;
    const blob = new Blob([csv], { type: "text/csv" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "bandit_results.csv";
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(url);
  });

  $("#algo").on("change", function () {
    $("#epsBox").toggle($(this).val() === "eps");
  });

  renderArmsInputs();
  randomizeArms();
  $("#totalRuns").text($("#runs").val());
  $("#totalSteps").text($("#steps").val());
  $("#epsBox").toggle($("#algo").val() === "eps");
  setRunUi(false);
});
