function randn() {
  let u = 0, v = 0;
  while (u === 0) u = Math.random();
  while (v === 0) v = Math.random();
  return Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
}
function softmax(logits, temperature = 1.0) {
  const max = Math.max(...logits);
  const exps = logits.map((z) => Math.exp((z - max) / temperature));
  const sum = exps.reduce((a, b) => a + b, 0);
  return exps.map((e) => e / sum);
}
function sampleFromProbs(probs) {
  const r = Math.random();
  let acc = 0;
  for (let i = 0; i < probs.length; i++) {
    acc += probs[i];
    if (r <= acc) return i;
  }
  return probs.length - 1;
}
function topkSample(probs, k) {
  const pairs = probs.map((p, i) => ({ p, i })).sort((a, b) => b.p - a.p).slice(0, k);
  const s = pairs.reduce((a, b) => a + b.p, 0);
  const norm = pairs.map((x) => ({ i: x.i, p: x.p / s }));
  const r = Math.random();
  let acc = 0;
  for (const x of norm) {
    acc += x.p;
    if (r <= acc) return x.i;
  }
  return norm[norm.length - 1].i;
}

let vocab = [];
let stoi = new Map();
let itos = [];
let E = null;
let W = null;
let b = null;
let lossHistory = [];
let params = { D: 32, K: 4, lr: 0.2, trainEmbeddings: true };
let isTraining = false;
let stopRequested = false;
const demoConfigs = {
  obama: {
    label: "obama.txt",
    path: "/assets/demo/llm_text/obama.txt",
    params: { D: 64, K: 6, epochs: 50, lr: 0.2, prompt: "This is the journey we continue today . " },
  },
  princess: {
    label: "princess.txt",
    path: "/assets/demo/llm_text/princess.txt",
    params: { D: 32, K: 4, epochs: 40, lr: 0.2, prompt: "One evening a terrible storm came on" },
  },
};

function tokenize(text) {
  return text.trim().split(/\s+/).filter((t) => t.length > 0);
}
function buildVocab(tokens) {
  const set = new Set(tokens);
  vocab = Array.from(set);
  stoi = new Map();
  itos = [];
  vocab.forEach((w, i) => { stoi.set(w, i); itos[i] = w; });
}
function encode(tokens) {
  return tokens.map((t) => stoi.get(t)).filter((x) => x !== undefined);
}
function initModel(V, D) {
  E = Array(V);
  for (let i = 0; i < V; i++) {
    E[i] = Array(D);
    for (let j = 0; j < D; j++) E[i][j] = randn() * 0.02;
  }
  W = Array(D);
  for (let d = 0; d < D; d++) {
    W[d] = Array(V);
    for (let v = 0; v < V; v++) W[d][v] = randn() * 0.02;
  }
  b = Array(V).fill(0);
}
function forward(contextIds) {
  const D = params.D;
  const h = Array(D).fill(0);
  const n = contextIds.length || 1;
  for (const id of contextIds) {
    const ei = E[id];
    for (let d = 0; d < D; d++) h[d] += ei[d];
  }
  for (let d = 0; d < D; d++) h[d] /= n;
  return h;
}
function logitsFromH(h) {
  const V = itos.length;
  const D = params.D;
  const z = Array(V).fill(0);
  for (let v = 0; v < V; v++) {
    let s = b[v];
    for (let d = 0; d < D; d++) s += W[d][v] * h[d];
    z[v] = s;
  }
  return z;
}
function trainStep(contextIds, targetId) {
  const D = params.D;
  const V = itos.length;
  const lr = params.lr;
  const h = forward(contextIds);
  const z = logitsFromH(h);
  const p = softmax(z, 1.0);
  const dz = p.slice();
  dz[targetId] -= 1.0;

  let dh = null;
  if (params.trainEmbeddings) {
    dh = Array(D).fill(0);
    for (let d = 0; d < D; d++) {
      let s = 0;
      for (let v = 0; v < V; v++) s += W[d][v] * dz[v];
      dh[d] = s;
    }
  }

  for (let v = 0; v < V; v++) {
    b[v] -= lr * dz[v];
    for (let d = 0; d < D; d++) W[d][v] -= lr * (h[d] * dz[v]);
  }

  if (params.trainEmbeddings && dh) {
    const n = contextIds.length || 1;
    for (const id of contextIds) {
      const ei = E[id];
      for (let d = 0; d < D; d++) ei[d] -= lr * (dh[d] / n);
    }
  }
  return -Math.log(Math.max(p[targetId], 1e-12));
}

function setupHiDPI(cvs) {
  const dpr = window.devicePixelRatio || 1;
  const rect = cvs.getBoundingClientRect();
  cvs.width = Math.max(1, Math.round(rect.width * dpr));
  cvs.height = Math.max(1, Math.round(rect.height * dpr));
  const ctx = cvs.getContext("2d");
  ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  return ctx;
}

function drawLossChart() {
  const canvas = document.getElementById("lossChart");
  const ctx = setupHiDPI(canvas);
  const W = canvas.getBoundingClientRect().width;
  const H = canvas.getBoundingClientRect().height;

  ctx.clearRect(0, 0, W, H);
  if (lossHistory.length < 2) return;

  const pad = { l: 34, r: 12, t: 16, b: 22 };
  const chartW = W - pad.l - pad.r;
  const chartH = H - pad.t - pad.b;

  const minLoss = 0;
  const maxLossRaw = Math.max(...lossHistory);
  const maxLoss = Math.max(1e-6, maxLossRaw * 1.2);
  const span = Math.max(1e-9, maxLoss - minLoss);

  ctx.strokeStyle = "#94a3b8";
  ctx.beginPath();
  ctx.moveTo(pad.l, pad.t);
  ctx.lineTo(pad.l, H - pad.b);
  ctx.lineTo(W - pad.r, H - pad.b);
  ctx.stroke();

  const ticks = 5;
  ctx.fillStyle = "#64748b";
  ctx.font = "11px sans-serif";
  ctx.textAlign = "right";
  ctx.textBaseline = "middle";
  for (let i = 0; i <= ticks; i++) {
    const t = i / ticks;
    const y = pad.t + (1 - t) * chartH;
    const val = minLoss + t * (maxLoss - minLoss);
    ctx.fillText(val.toFixed(2), pad.l - 6, y);
    ctx.strokeStyle = "rgba(148,163,184,0.25)";
    ctx.beginPath();
    ctx.moveTo(pad.l, y);
    ctx.lineTo(W - pad.r, y);
    ctx.stroke();
  }

  ctx.strokeStyle = "#2563eb";
  ctx.lineWidth = 1.8;
  ctx.beginPath();
  for (let i = 0; i < lossHistory.length; i++) {
    const x = pad.l + (i / (lossHistory.length - 1)) * chartW;
    const y = pad.t + (1 - (lossHistory[i] - minLoss) / span) * chartH;
    if (i === 0) ctx.moveTo(x, y);
    else ctx.lineTo(x, y);
  }
  ctx.stroke();

  ctx.fillStyle = "#475569";
  ctx.font = "12px sans-serif";
  ctx.fillText("Loss", 6, 14);
  ctx.fillText("Epoch", W - 50, H - 6);
}

async function trainTiny(text, epochs) {
  const tokens = tokenize(text);
  if (tokens.length < 8) throw new Error("Please provide at least 8 tokens of training text.");

  buildVocab(tokens);
  const ids = encode(tokens);
  const V = itos.length;
  initModel(V, params.D);

  const K = params.K;
  const pairs = [];
  for (let i = 0; i < ids.length; i++) {
    const start = Math.max(0, i - K);
    const ctx = ids.slice(start, i);
    if (ctx.length === 0) continue;
    pairs.push({ ctx, tgt: ids[i] });
  }

  const progress = $("#trainProgress");
  const progressText = $("#trainProgressText");
  const status = $("#trainStatus");
  const logEl = $("#lossLog");
  logEl.text("");
  lossHistory = [];

  let stepTotal = epochs * pairs.length;
  let stepCount = 0;

  for (let e = 1; e <= epochs; e++) {
    if (stopRequested) break;
    let epochLoss = 0;
    for (let i = pairs.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [pairs[i], pairs[j]] = [pairs[j], pairs[i]];
    }
    for (let i = 0; i < pairs.length; i++) {
      if (stopRequested) break;
      const loss = trainStep(pairs[i].ctx, pairs[i].tgt);
      epochLoss += loss;
      stepCount++;
      if (stepCount % 200 === 0) {
        const pct = Math.round((100 * stepCount) / stepTotal);
        progress.css("width", `${pct}%`);
        progressText.text(`${pct}%`);
        status.text(`Training... ${pct}%`);
        await new Promise((r) => setTimeout(r, 0));
      }
    }
    if (!stopRequested) {
      const avgLoss = epochLoss / pairs.length;
      logEl.text(`${logEl.text()}Epoch ${e}/${epochs} - loss: ${avgLoss.toFixed(4)}\n`);
      lossHistory.push(avgLoss);
      drawLossChart();
    }
  }

  if (stopRequested) {
    status.text("Training stopped.");
  } else {
    progress.css("width", "100%");
    progressText.text("100%");
    status.text("Training complete.");
  }
}

function predictNextId(contextIds, temperature, mode, k) {
  const h = forward(contextIds);
  const z = logitsFromH(h);
  const probs = softmax(z, temperature);
  if (mode === "greedy") {
    let best = 0, bi = 0;
    for (let i = 0; i < probs.length; i++) {
      if (probs[i] > best) { best = probs[i]; bi = i; }
    }
    return bi;
  } else if (mode === "sample") {
    return sampleFromProbs(probs);
  }
  return topkSample(probs, k);
}

function generate(prompt, nTokens, temperature, mode, k) {
  if (!E || !W || !b || vocab.length === 0) throw new Error("Train the model first.");
  const ctxTokens = tokenize(prompt);
  const ctxIds = ctxTokens.map((t) => stoi.get(t)).filter((x) => x !== undefined);
  const K = params.K;
  const out = ctxTokens.slice();
  let context = ctxIds.slice(-K);
  for (let i = 0; i < nTokens; i++) {
    if (context.length === 0) context = [0];
    const nextId = predictNextId(context, temperature, mode, k);
    out.push(itos[nextId]);
    context = context.concat([nextId]).slice(-K);
  }
  return out.join(" ");
}

$(function () {
  async function loadDemoText(key) {
    const demo = demoConfigs[key];
    if (!demo) return;
    try {
      const res = await fetch(demo.path, { cache: "no-cache" });
      if (!res.ok) throw new Error(`Failed to load demo (${res.status})`);
      const text = await res.text();
      $("#trainText").val(text.trim());
      $("#embedDim").val(demo.params.D);
      $("#blockSize").val(demo.params.K);
      $("#epochs").val(demo.params.epochs);
      $("#lr").val(demo.params.lr);
      if (demo.params.prompt) $("#prompt").val(demo.params.prompt);
      $("#trainStatus").text(`Demo loaded: ${demo.label}`);
    } catch (e) {
      alert(`Demo load error: ${e.message}`);
    }
  }

  $(".demo-load").on("click", function () {
    const key = $(this).data("demo");
    loadDemoText(key);
  });

  $("#trainBtn").on("click", async function () {
    try {
      if (isTraining) return;
      isTraining = true;
      stopRequested = false;
      params.D = Math.max(4, Math.min(256, parseInt($("#embedDim").val() || 32, 10)));
      params.K = Math.max(1, Math.min(16, parseInt($("#blockSize").val() || 4, 10)));
      params.lr = parseFloat($("#lr").val() || 0.2);
      params.trainEmbeddings = $("#trainEmbeddings").is(":checked");
      const epochs = parseInt($("#epochs").val() || 5, 10);
      $("#trainProgress").css("width", "0%");
      $("#trainProgressText").text("0%");
      $("#trainStatus").text("Preparing data...");
      lossHistory = [];
      drawLossChart();
      await new Promise((r) => setTimeout(r, 0));
      await trainTiny($("#trainText").val(), epochs);
    } catch (e) {
      alert(`Training error: ${e.message}`);
    } finally {
      isTraining = false;
      stopRequested = false;
    }
  });

  $("#trainStopBtn").on("click", function () {
    if (!isTraining) return;
    stopRequested = true;
  });

  function toggleTopkUI() {
    const mode = $("input[name='sampling']:checked").val();
    if (mode === "topk") $("#topkWrap").show();
    else $("#topkWrap").hide();
  }

  $("input[name='sampling']").on("change", toggleTopkUI);
  toggleTopkUI();

  $("#genBtn").on("click", function () {
    try {
      const temperature = parseFloat($("#temperature").val() || 1.0);
      const n = parseInt($("#genTokens").val() || 30, 10);
      const mode = $("input[name='sampling']:checked").val();
      const k = parseInt($("#topkK").val() || 5, 10);
      const text = generate($("#prompt").val(), n, temperature, mode, k);
      $("#genOut").text(text);
    } catch (e) {
      alert(`Generation error: ${e.message}`);
    }
  });
});
