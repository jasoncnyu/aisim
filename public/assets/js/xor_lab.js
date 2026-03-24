const dataX = [[0, 0], [0, 1], [1, 0], [1, 1]];
const dataY = [0, 1, 1, 0];

function randn() {
  let u = 0, v = 0;
  while (u === 0) u = Math.random();
  while (v === 0) v = Math.random();
  return Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
}
function sigmoid(x) { return 1 / (1 + Math.exp(-x)); }
function dsigmoid(y) { return y * (1 - y); }
function relu(x) { return x > 0 ? x : 0; }
function drelu(x) { return x > 0 ? 1 : 0; }
function tanhFn(x) { return Math.tanh(x); }
function dtanh(x) { const t = Math.tanh(x); return 1 - t * t; }
function sleep(ms) { return new Promise((r) => setTimeout(r, ms)); }
function fmt(v) { return Number.isFinite(v) ? v.toFixed(3) : "0"; }

let W1, W2, W3, b1, b2, b3, act, lr, step, lossHist, lastFlow;
let auto = false;

function setupHiDPI(cvs) {
  const dpr = window.devicePixelRatio || 1;
  const rect = cvs.getBoundingClientRect();
  cvs.width = Math.max(1, Math.round(rect.width * dpr));
  cvs.height = Math.max(1, Math.round(rect.height * dpr));
  const cx = cvs.getContext("2d");
  cx.setTransform(dpr, 0, 0, dpr, 0, 0);
  return cx;
}

function initModel() {
  lr = parseFloat($("#lr").val());
  act = $("#act").val();
  W1 = Array.from({ length: 2 }, () => Array.from({ length: 4 }, () => randn() * 0.5));
  W2 = Array.from({ length: 4 }, () => Array.from({ length: 2 }, () => randn() * 0.5));
  W3 = Array.from({ length: 2 }, () => [randn() * 0.5]);
  b1 = [0, 0, 0, 0];
  b2 = [0, 0];
  b3 = [0];
  step = 0;
  lossHist = [];
  lastFlow = null;
  updateUI(0);
}

function forward(x) {
  const z1 = W1[0].map((_, j) => x[0] * W1[0][j] + x[1] * W1[1][j] + b1[j]);
  const a1 = z1.map((v) => (act === "tanh" ? tanhFn(v) : relu(v)));

  const z2 = [0, 0];
  for (let j = 0; j < 2; j++) z2[j] = a1.reduce((s, a, i) => s + a * W2[i][j], 0) + b2[j];
  const a2 = z2.map((v) => (act === "tanh" ? tanhFn(v) : relu(v)));

  const z3 = a2.reduce((s, a, i) => s + a * W3[i][0], 0) + b3[0];
  const y = sigmoid(z3);
  return { x, z1, a1, z2, a2, z3, y };
}

function backward(cache, ytrue) {
  const { x, z1, a1, z2, a2, y } = cache;
  const dy = y - ytrue;
  if (!Number.isFinite(dy)) return {};

  const dz3 = dy * dsigmoid(y);
  const w3Old = [W3[0][0], W3[1][0]];
  for (let i = 0; i < 2; i++) W3[i][0] -= lr * dz3 * a2[i];
  b3[0] -= lr * dz3;

  const da2 = [w3Old[0] * dz3, w3Old[1] * dz3];
  const dz2 = da2.map((d, i) => d * (act === "tanh" ? dtanh(z2[i]) : drelu(z2[i])));

  const w2Old = W2.map((r) => [...r]);
  for (let i = 0; i < 4; i++) for (let j = 0; j < 2; j++) W2[i][j] -= lr * dz2[j] * a1[i];
  for (let j = 0; j < 2; j++) b2[j] -= lr * dz2[j];

  const da1 = [0, 0, 0, 0];
  for (let i = 0; i < 4; i++) for (let j = 0; j < 2; j++) da1[i] += dz2[j] * w2Old[i][j];
  const dz1 = da1.map((d, i) => d * (act === "tanh" ? dtanh(z1[i]) : drelu(z1[i])));

  for (let i = 0; i < 2; i++) for (let j = 0; j < 4; j++) W1[i][j] -= lr * dz1[j] * x[i];
  for (let j = 0; j < 4; j++) b1[j] -= lr * dz1[j];

  return { dy, dz3, dz2, dz1 };
}

function trainStep() {
  const idx = Math.floor(Math.random() * 4);
  const x = dataX[idx];
  const ytrue = dataY[idx];
  const f = forward(x);
  const b = backward(f, ytrue);
  step += 1;

  let loss = 0;
  for (let i = 0; i < 4; i++) {
    const p = forward(dataX[i]).y;
    loss += (p - dataY[i]) ** 2;
  }
  loss /= 4;
  lossHist.push(loss);
  if (lossHist.length > 1200) lossHist.shift();

  lastFlow = { ...f, ...b, ytrue, loss };
  updateUI(loss);
}

function drawPred() {
  const c = $("#predChart")[0];
  const ctx = setupHiDPI(c);
  const W = c.getBoundingClientRect().width;
  const H = c.getBoundingClientRect().height;

  ctx.clearRect(0, 0, W, H);
  ctx.strokeStyle = "#cbd5e1";
  ctx.strokeRect(0, 0, W, H);
  ctx.beginPath(); ctx.moveTo(W / 2, 0); ctx.lineTo(W / 2, H); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(0, H / 2); ctx.lineTo(W, H / 2); ctx.stroke();

  ctx.fillStyle = "#64748b";
  ctx.font = "12px sans-serif";
  ctx.fillText("x1=0", W * 0.2, H - 8);
  ctx.fillText("x1=1", W * 0.72, H - 8);
  ctx.fillText("x2=0", 8, H * 0.76);
  ctx.fillText("x2=1", 8, H * 0.28);

  for (let i = 0; i < 4; i++) {
    const x = dataX[i];
    const p = forward(x).y;
    const r = 7 + p * 24;
    const px = W * 0.25 + (W * 0.5) * x[0];
    const py = H * 0.8 - (H * 0.5) * x[1];
    ctx.beginPath();
    ctx.arc(px, py, r, 0, Math.PI * 2);
    ctx.fillStyle = "rgba(59,130,246,0.25)";
    ctx.fill();
    ctx.strokeStyle = "#0f172a";
    ctx.stroke();
    ctx.fillStyle = "#0f172a";
    ctx.fillText(`(${x})`, px - 15, py - r - 6);
  }
}

function drawLoss() {
  const c = $("#lossChart")[0];
  const ctx = setupHiDPI(c);
  const W = c.getBoundingClientRect().width;
  const H = c.getBoundingClientRect().height;

  ctx.clearRect(0, 0, W, H);
  const pad = { l: 40, r: 10, t: 10, b: 20 };
  const chartW = W - pad.l - pad.r;
  const chartH = H - pad.t - pad.b;

  ctx.strokeStyle = "#cbd5e1";
  ctx.beginPath();
  ctx.moveTo(pad.l, pad.t);
  ctx.lineTo(pad.l, H - pad.b);
  ctx.lineTo(W - pad.r, H - pad.b);
  ctx.stroke();

  ctx.fillStyle = "#64748b";
  ctx.font = "12px sans-serif";
  ctx.fillText("Loss", 8, 20);
  ctx.fillText("Step", W - 42, H - 4);

  if (lossHist.length < 2) return;
  const maxL = Math.max(...lossHist);
  const minL = Math.min(...lossHist);
  const span = Math.max(1e-8, maxL - minL);
  ctx.strokeStyle = "#2563eb";
  ctx.beginPath();
  for (let i = 0; i < lossHist.length; i++) {
    const x = pad.l + (i / (lossHist.length - 1)) * chartW;
    const y = pad.t + (1 - (lossHist[i] - minL) / span) * chartH;
    if (i === 0) ctx.moveTo(x, y);
    else ctx.lineTo(x, y);
  }
  ctx.stroke();
}

function updateFlow() {
  if (!lastFlow) return;
  const c = lastFlow;
  const text = `Forward Pass
input x = [${c.x}]

Layer 1
z1 = x*W1 + b1
W1 = ${JSON.stringify(W1.map((r) => r.map(fmt)))}
b1 = [${b1.map(fmt).join(", ")}]
z1 = [${c.z1.map(fmt).join(", ")}]
a1 = f(z1) = [${c.a1.map(fmt).join(", ")}]

Layer 2
z2 = a1*W2 + b2
W2 = ${JSON.stringify(W2.map((r) => r.map(fmt)))}
b2 = [${b2.map(fmt).join(", ")}]
z2 = [${c.z2.map(fmt).join(", ")}]
a2 = f(z2) = [${c.a2.map(fmt).join(", ")}]

Output Layer
z3 = a2*W3 + b3
W3 = ${JSON.stringify(W3.map((r) => r.map(fmt)))}
b3 = [${b3.map(fmt).join(", ")}]
z3 = ${fmt(c.z3)}
y_hat = sigmoid(z3) = ${fmt(c.y)}, target y = ${c.ytrue}
Loss = (y_hat - y)^2 = ${fmt(c.loss)}

Backward Pass
delta3 = (y_hat - y) * sigmoid'(z3) = ${fmt(c.dz3)}
delta2 = (W3*delta3) .* f'(z2) = [${(c.dz2 || []).map(fmt).join(", ")}]
delta1 = (W2*delta2) .* f'(z1) = [${(c.dz1 || []).map(fmt).join(", ")}]
`;
  $("#calcFlow").text(text);
}

function updateUI(loss) {
  $("#step").text(step);
  $("#loss").text(loss.toFixed(4));
  drawPred();
  updateFlow();
  drawLoss();
}

async function autoLoop() {
  while (auto) {
    trainStep();
    const ms = parseInt($("#sleep").val(), 10);
    if (ms > 0) await sleep(ms);
  }
}

$(function () {
  $("#train1").on("click", () => trainStep());
  $("#auto").on("click", () => {
    auto = !auto;
    if (auto) {
      $("#auto").text("Stop");
      autoLoop();
    } else {
      $("#auto").text("Auto Train");
    }
  });
  $("#reset").on("click", () => {
    auto = false;
    $("#auto").text("Auto Train");
    initModel();
    drawPred();
  });
  $("#lr,#act").on("change", () => {
    auto = false;
    $("#auto").text("Auto Train");
    initModel();
    drawPred();
  });
  $(window).on("resize", () => {
    drawPred();
    drawLoss();
  });

  initModel();
  drawPred();
});
