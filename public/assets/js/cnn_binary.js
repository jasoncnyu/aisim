$(function () {
  const INPUT_SIZE = 32;
  const NUM_CLASSES = 2;
  const CONV_F = 2;
  const FILTER_SIZE = 3;
  const HIDDEN = 16;
  const LR_DEFAULT = 0.01;

  const convOutSize = INPUT_SIZE - FILTER_SIZE + 1;
  const convOutLen = convOutSize * convOutSize * CONV_F;

  let convW = [];
  let convB = [];
  let W1 = null;
  let b1 = null;
  let W2 = null;
  let b2 = null;

  let dataset = [];
  let lossHistory = [];
  let epoch = 0;
  let runTimer = null;

  const demoPaths = {
    0: [
      "/assets/demo/cnn_binary/cat1.jpg",
      "/assets/demo/cnn_binary/cat2.jpg",
      "/assets/demo/cnn_binary/cat3.jpg",
      "/assets/demo/cnn_binary/cat4.jpg",
      "/assets/demo/cnn_binary/cat5.jpg",
    ],
    1: [
      "/assets/demo/cnn_binary/dog1.jpg",
      "/assets/demo/cnn_binary/dog2.jpg",
      "/assets/demo/cnn_binary/dog3.jpg",
      "/assets/demo/cnn_binary/dog4.jpg",
      "/assets/demo/cnn_binary/dog5.jpg",
    ],
  };

  function randn() {
    let u = 0;
    let v = 0;
    while (u === 0) u = Math.random();
    while (v === 0) v = Math.random();
    return Math.sqrt(-2 * Math.log(u)) * Math.cos(2 * Math.PI * v);
  }

  function createMatrix(r, c) {
    const m = new Array(r);
    for (let i = 0; i < r; i++) m[i] = new Float32Array(c);
    return m;
  }

  function showSpinner(on) {
    const spinner = $("#loadingSpinner");
    if (on) spinner.addClass("active");
    else spinner.removeClass("active");
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

  function updateMonitor(stats = { loss: "-", acc: "-" }) {
    $("#epoch").text(epoch);
    $("#dsSize").text(dataset.length);
    $("#loss").text(typeof stats.loss === "number" ? stats.loss.toFixed(4) : "-");
    $("#acc").text(typeof stats.acc === "number" ? `${(stats.acc * 100).toFixed(1)}%` : "-");
  }

  function drawLossChart() {
    const canvas = document.getElementById("lossChart");
    const ctx = setupHiDPI(canvas);
    const W = canvas.getBoundingClientRect().width;
    const H = canvas.getBoundingClientRect().height;

    ctx.clearRect(0, 0, W, H);

    if (lossHistory.length < 2) return;

    const pad = { l: 34, r: 10, t: 18, b: 22 };
    const chartW = W - pad.l - pad.r;
    const chartH = H - pad.t - pad.b;
    const maxLoss = Math.max(...lossHistory);
    const minLoss = Math.min(...lossHistory);
    const span = Math.max(1e-8, maxLoss - minLoss);

    ctx.strokeStyle = "#94a3b8";
    ctx.beginPath();
    ctx.moveTo(pad.l, pad.t);
    ctx.lineTo(pad.l, H - pad.b);
    ctx.lineTo(W - pad.r, H - pad.b);
    ctx.stroke();

    ctx.strokeStyle = "#2563eb";
    ctx.lineWidth = 1.7;
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
    ctx.fillText("Epoch", W - 52, H - 6);
  }

  function renderFilters() {
    const wrap = $("#filterVis");
    wrap.empty();

    for (let f = 0; f < CONV_F; f++) {
      let html = `<div class="rounded border border-slate-200 p-2"><p class="mb-1 text-xs text-slate-500">Filter ${f}</p><table class="text-xs">`;
      for (let u = 0; u < FILTER_SIZE; u++) {
        html += "<tr>";
        for (let v = 0; v < FILTER_SIZE; v++) {
          html += `<td class="border border-slate-200 px-2 py-1 text-right">${convW[f][u][v].toFixed(2)}</td>`;
        }
        html += "</tr>";
      }
      html += "</table></div>";
      wrap.append(html);
    }
  }

  function renderFeatureMaps(convOuts) {
    const wrap = $("#featureVis");
    wrap.empty();
    if (!convOuts || !convOuts.length) return;

    const size = convOuts[0].length;
    for (let f = 0; f < convOuts.length; f++) {
      const canvas = document.createElement("canvas");
      canvas.width = size;
      canvas.height = size;
      canvas.style.width = "96px";
      canvas.style.height = "96px";
      canvas.className = "rounded border border-slate-200";

      const ctx = canvas.getContext("2d");
      const img = ctx.createImageData(size, size);

      let minv = Infinity;
      let maxv = -Infinity;
      for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
          const v = convOuts[f][i][j];
          if (v < minv) minv = v;
          if (v > maxv) maxv = v;
        }
      }
      const range = maxv - minv || 1e-8;

      for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
          const idx = (i * size + j) * 4;
          const gray = Math.floor((255 * (convOuts[f][i][j] - minv)) / range);
          img.data[idx] = gray;
          img.data[idx + 1] = gray;
          img.data[idx + 2] = gray;
          img.data[idx + 3] = 255;
        }
      }
      ctx.putImageData(img, 0, 0);

      const block = document.createElement("div");
      block.className = "text-center";
      block.innerHTML = `<p class="mb-1 text-xs text-slate-500">Feature ${f}</p>`;
      block.appendChild(canvas);
      wrap.append(block);
    }
  }

  function initWeights() {
    convW = [];
    convB = new Float32Array(CONV_F);
    for (let f = 0; f < CONV_F; f++) {
      const filt = createMatrix(FILTER_SIZE, FILTER_SIZE);
      for (let u = 0; u < FILTER_SIZE; u++) {
        for (let v = 0; v < FILTER_SIZE; v++) filt[u][v] = randn() * 0.1;
      }
      convW.push(filt);
      convB[f] = 0;
    }

    W1 = createMatrix(HIDDEN, convOutLen);
    b1 = new Float32Array(HIDDEN);
    for (let i = 0; i < HIDDEN; i++) {
      for (let j = 0; j < convOutLen; j++) W1[i][j] = randn() * 0.1;
    }

    W2 = createMatrix(NUM_CLASSES, HIDDEN);
    b2 = new Float32Array(NUM_CLASSES);
    for (let i = 0; i < NUM_CLASSES; i++) {
      for (let j = 0; j < HIDDEN; j++) W2[i][j] = randn() * 0.1;
    }

    lossHistory = [];
    epoch = 0;
    updateMonitor();
    drawLossChart();
    renderFilters();
    $("#featureVis").empty();
  }

  function forward(x) {
    const convOut = new Array(CONV_F);

    for (let f = 0; f < CONV_F; f++) {
      convOut[f] = createMatrix(convOutSize, convOutSize);
      for (let i = 0; i < convOutSize; i++) {
        for (let j = 0; j < convOutSize; j++) {
          let s = convB[f];
          for (let u = 0; u < FILTER_SIZE; u++) {
            for (let v = 0; v < FILTER_SIZE; v++) s += convW[f][u][v] * x[(i + u) * INPUT_SIZE + (j + v)];
          }
          convOut[f][i][j] = Math.max(0, s);
        }
      }
    }

    const zconv = new Float32Array(convOutLen);
    let idx = 0;
    for (let f = 0; f < CONV_F; f++) {
      for (let i = 0; i < convOutSize; i++) {
        for (let j = 0; j < convOutSize; j++) zconv[idx++] = convOut[f][i][j];
      }
    }

    const z1 = new Float32Array(HIDDEN);
    const a1 = new Float32Array(HIDDEN);
    for (let h = 0; h < HIDDEN; h++) {
      let s = b1[h];
      for (let j = 0; j < convOutLen; j++) s += W1[h][j] * zconv[j];
      z1[h] = s;
      a1[h] = Math.max(0, s);
    }

    const z2 = new Float32Array(NUM_CLASSES);
    const a2 = new Float32Array(NUM_CLASSES);
    for (let c = 0; c < NUM_CLASSES; c++) {
      let s = b2[c];
      for (let j = 0; j < HIDDEN; j++) s += W2[c][j] * a1[j];
      z2[c] = s;
    }

    const maxz = Math.max(...z2);
    let sum = 0;
    for (let c = 0; c < NUM_CLASSES; c++) {
      a2[c] = Math.exp(z2[c] - maxz);
      sum += a2[c];
    }
    for (let c = 0; c < NUM_CLASSES; c++) a2[c] /= sum;

    return { a2, z1, convOut, zconv, a1 };
  }

  function computeLossAndAcc(data) {
    if (!data.length) return { loss: 0, acc: 0 };

    let L = 0;
    let correct = 0;
    data.forEach((item) => {
      const p = forward(item.x).a2;
      L -= Math.log(Math.max(1e-12, p[item.y]));
      const pred = p[0] > p[1] ? 0 : 1;
      if (pred === item.y) correct += 1;
    });

    return { loss: L / data.length, acc: correct / data.length };
  }

  function trainEpoch(batchSize) {
    if (!dataset.length) return { loss: 0, acc: 0 };

    const idx = dataset.map((_, i) => i);
    for (let i = idx.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [idx[i], idx[j]] = [idx[j], idx[i]];
    }

    const lr = parseFloat($("#lr").val()) || LR_DEFAULT;

    for (let start = 0; start < idx.length; start += batchSize) {
      const b = idx.slice(start, start + batchSize);

      const dW2 = createMatrix(NUM_CLASSES, HIDDEN);
      const db2 = new Float32Array(NUM_CLASSES);
      const dW1 = createMatrix(HIDDEN, convOutLen);
      const db1 = new Float32Array(HIDDEN);
      const dConvW = [];
      const dConvB = new Float32Array(CONV_F);
      for (let f = 0; f < CONV_F; f++) dConvW.push(createMatrix(FILTER_SIZE, FILTER_SIZE));

      for (const ii of b) {
        const sample = dataset[ii];
        const y = sample.y;
        const x = sample.x;

        const { a2, z1, convOut, zconv, a1 } = forward(x);

        const dz2 = new Float32Array(NUM_CLASSES);
        for (let c = 0; c < NUM_CLASSES; c++) dz2[c] = a2[c] - (c === y ? 1 : 0);

        for (let c = 0; c < NUM_CLASSES; c++) {
          db2[c] += dz2[c];
          for (let h = 0; h < HIDDEN; h++) dW2[c][h] += dz2[c] * a1[h];
        }

        const da1 = new Float32Array(HIDDEN);
        for (let h = 0; h < HIDDEN; h++) {
          let s = 0;
          for (let c = 0; c < NUM_CLASSES; c++) s += W2[c][h] * dz2[c];
          da1[h] = s;
        }

        const dz1 = new Float32Array(HIDDEN);
        for (let h = 0; h < HIDDEN; h++) dz1[h] = z1[h] > 0 ? da1[h] : 0;

        for (let h = 0; h < HIDDEN; h++) {
          db1[h] += dz1[h];
          for (let j = 0; j < convOutLen; j++) dW1[h][j] += dz1[h] * zconv[j];
        }

        const dzconv = new Float32Array(convOutLen);
        for (let j = 0; j < convOutLen; j++) {
          let s = 0;
          for (let h = 0; h < HIDDEN; h++) s += W1[h][j] * dz1[h];
          dzconv[j] = s;
        }

        let k = 0;
        const dconv = [];
        for (let f = 0; f < CONV_F; f++) {
          dconv[f] = createMatrix(convOutSize, convOutSize);
          for (let i = 0; i < convOutSize; i++) {
            for (let j = 0; j < convOutSize; j++) {
              const g = dzconv[k++];
              dconv[f][i][j] = convOut[f][i][j] > 0 ? g : 0;
            }
          }
        }

        for (let f = 0; f < CONV_F; f++) {
          for (let u = 0; u < FILTER_SIZE; u++) {
            for (let v = 0; v < FILTER_SIZE; v++) {
              let s = 0;
              for (let i = 0; i < convOutSize; i++) {
                for (let j = 0; j < convOutSize; j++) s += dconv[f][i][j] * x[(i + u) * INPUT_SIZE + (j + v)];
              }
              dConvW[f][u][v] += s;
            }
          }

          for (let i = 0; i < convOutSize; i++) {
            for (let j = 0; j < convOutSize; j++) dConvB[f] += dconv[f][i][j];
          }
        }
      }

      const bs = b.length;
      for (let c = 0; c < NUM_CLASSES; c++) {
        for (let h = 0; h < HIDDEN; h++) W2[c][h] -= (lr / bs) * dW2[c][h];
        b2[c] -= (lr / bs) * db2[c];
      }

      for (let h = 0; h < HIDDEN; h++) {
        for (let j = 0; j < convOutLen; j++) W1[h][j] -= (lr / bs) * dW1[h][j];
        b1[h] -= (lr / bs) * db1[h];
      }

      for (let f = 0; f < CONV_F; f++) {
        for (let u = 0; u < FILTER_SIZE; u++) {
          for (let v = 0; v < FILTER_SIZE; v++) convW[f][u][v] -= (lr / bs) * dConvW[f][u][v];
        }
        convB[f] -= (lr / bs) * dConvB[f];
      }
    }

    epoch += 1;
    const stats = computeLossAndAcc(dataset);
    lossHistory.push(stats.loss);
    updateMonitor(stats);
    drawLossChart();
    renderFilters();
    return stats;
  }

  function addThumb(src, labelText) {
    const html = `<div class="rounded border border-slate-200 bg-white p-1 text-center"><img src="${src}" style="width:80px;height:80px;object-fit:cover"><p class="mt-1 text-xs text-slate-600">${labelText}</p></div>`;
    $("#trainImages").append(html);
  }

  function loadAndResizeFromImage(img, label) {
    const c = document.createElement("canvas");
    c.width = INPUT_SIZE;
    c.height = INPUT_SIZE;
    const ctx = c.getContext("2d");
    ctx.drawImage(img, 0, 0, INPUT_SIZE, INPUT_SIZE);

    const imageData = ctx.getImageData(0, 0, INPUT_SIZE, INPUT_SIZE);
    const d = imageData.data;
    const arr = new Float32Array(INPUT_SIZE * INPUT_SIZE);

    for (let i = 0; i < arr.length; i++) {
      const r = d[i * 4];
      const g = d[i * 4 + 1];
      const b = d[i * 4 + 2];
      const gray = (r + g + b) / 3;
      arr[i] = gray / 255;

      d[i * 4] = gray;
      d[i * 4 + 1] = gray;
      d[i * 4 + 2] = gray;
    }

    ctx.putImageData(imageData, 0, 0);
    dataset.push({ x: arr, y: label });
    addThumb(c.toDataURL(), label === 0 ? "Class 1" : "Class 2");
  }

  async function loadImageToDataset(srcOrFile, label, isFile) {
    return new Promise((resolve) => {
      const img = new Image();
      img.crossOrigin = "Anonymous";

      img.onload = function () {
        loadAndResizeFromImage(img, label);
        resolve();
      };

      img.onerror = function () {
        resolve();
      };

      if (isFile) {
        const reader = new FileReader();
        reader.onload = function () {
          img.src = reader.result;
        };
        reader.readAsDataURL(srcOrFile);
      } else {
        img.src = srcOrFile;
      }
    });
  }

  async function loadDemo() {
    showSpinner(true);
    dataset = [];
    $("#trainImages").empty();

    for (let label = 0; label < 2; label++) {
      for (const p of demoPaths[label]) await loadImageToDataset(p, label, false);
    }

    showSpinner(false);
    updateMonitor();
  }

  function predictUploaded() {
    const file = $("#testFile")[0].files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function () {
      const img = new Image();
      img.onload = function () {
        $("#inputPreview").html(`<img src="${reader.result}" class="h-16 w-16 rounded border border-slate-200 object-cover">`);

        const c = document.createElement("canvas");
        c.width = INPUT_SIZE;
        c.height = INPUT_SIZE;
        const ctx = c.getContext("2d");
        ctx.drawImage(img, 0, 0, INPUT_SIZE, INPUT_SIZE);

        const d = ctx.getImageData(0, 0, INPUT_SIZE, INPUT_SIZE).data;
        const x = new Float32Array(INPUT_SIZE * INPUT_SIZE);
        for (let i = 0; i < x.length; i++) {
          const r = d[i * 4];
          const g = d[i * 4 + 1];
          const b = d[i * 4 + 2];
          x[i] = (r + g + b) / (3 * 255);
        }

        const out = forward(x);
        const probs = Array.from(out.a2);
        const pred = probs[0] > probs[1] ? 0 : 1;

        $("#predResult").text(`Prediction: ${pred === 0 ? "Class 1" : "Class 2"}`);
        $("#predList").html(`<li>Class 1: ${(probs[0] * 100).toFixed(2)}%</li><li>Class 2: ${(probs[1] * 100).toFixed(2)}%</li>`);
        renderFeatureMaps(out.convOut);
      };
      img.src = reader.result;
    };
    reader.readAsDataURL(file);
  }

  async function handleUpload(files, label) {
    showSpinner(true);
    for (const f of files) await loadImageToDataset(f, label, true);
    showSpinner(false);
    updateMonitor();
  }

  function stopRun() {
    if (runTimer) {
      clearInterval(runTimer);
      runTimer = null;
    }
  }

  $("#btn-init").on("click", initWeights);
  $("#btn-demo").on("click", loadDemo);
  $("#btn-predict").on("click", predictUploaded);

  $("#btn-reset").on("click", function () {
    stopRun();
    dataset = [];
    lossHistory = [];
    epoch = 0;
    $("#trainImages").empty();
    $("#predResult").text("-");
    $("#predList").empty();
    $("#inputPreview").empty();
    $("#featureVis").empty();
    updateMonitor();
    drawLossChart();
    renderFilters();
  });

  $("#btn-step").on("click", function () {
    const batch = Math.max(1, parseInt($("#batch").val(), 10) || 2);
    trainEpoch(batch);
  });

  $("#btn-run").on("click", function () {
    if (runTimer) return;

    const batch = Math.max(1, parseInt($("#batch").val(), 10) || 2);
    const epochs = Math.max(1, parseInt($("#epochs").val(), 10) || 10);
    let iter = 0;

    runTimer = setInterval(function () {
      trainEpoch(batch);
      iter += 1;
      if (iter >= epochs) stopRun();
    }, 140);
  });

  $("#btn-stop").on("click", stopRun);

  $("#class1Files").on("change", async function (e) {
    await handleUpload(e.target.files, 0);
  });

  $("#class2Files").on("change", async function (e) {
    await handleUpload(e.target.files, 1);
  });

  $(window).on("resize", drawLossChart);

  initWeights();
});
