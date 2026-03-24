(function () {
  const el = (id) => document.getElementById(id);
  const rowsEl = el("rows");
  const colsEl = el("cols");
  const densityEl = el("density");
  const densityValEl = el("densityVal");
  const quantModeEl = el("quantMode");
  const bitWidthEl = el("bitWidth");
  const matrixContainer = el("matrixContainer");
  const quantContainer = el("quantContainer");
  const dequantContainer = el("dequantContainer");
  const errorContainer = el("errorContainer");
  const statDim = el("statDim");
  const statRange = el("statRange");
  const statQRange = el("statQRange");
  const statMSE = el("statMSE");
  const statPSNR = el("statPSNR");
  const statErr = el("statErr");
  const statBitrate = el("statBitrate");
  const statStrategy = el("statStrategy");
  const jsonOut = el("jsonOut");

  let matrix = [];
  let Q = [];
  let DQ = [];
  let R = 6;
  let C = 12;

  function clamp(val, min, max) {
    return Math.min(max, Math.max(min, val));
  }

  function formatCell(v) {
    if (v === 0 || v === "0") return "";
    return v;
  }

  function renderMatrix(container, mat, mode) {
    container.innerHTML = "";
    if (!mat.length) return;
    const table = document.createElement("table");
    table.className = "border-collapse text-xs";
    const tbody = document.createElement("tbody");
    const cellW = 44;
    const cellH = 32;
    let maxErr = 0;
    if (mode === "err") {
      for (let i = 0; i < mat.length; i++) {
        for (let j = 0; j < mat[0].length; j++) {
          maxErr = Math.max(maxErr, Math.abs(mat[i][j]));
        }
      }
      maxErr = maxErr || 1e-6;
    }

    for (let i = 0; i < mat.length; i++) {
      const tr = document.createElement("tr");
      for (let j = 0; j < mat[0].length; j++) {
        const v = mat[i][j];
        const td = document.createElement("td");
        td.style.width = `${cellW}px`;
        td.style.height = `${cellH}px`;
        td.style.textAlign = "center";
        td.style.border = "1px solid #e2e8f0";
        td.style.fontWeight = "600";
        td.textContent = formatCell(v);
        if (mode === "err" && v !== 0) {
          const mag = clamp(Math.abs(v) / maxErr, 0, 1);
          const alpha = 0.15 + mag * 0.75;
          const col = v > 0 ? `rgba(239, 68, 68, ${alpha})` : `rgba(59, 130, 246, ${alpha})`;
          td.style.background = col;
          td.style.color = "#0f172a";
        } else if (v !== 0) {
          td.style.background = "#0f172a";
          td.style.color = "#f8fafc";
        } else {
          td.style.background = "#f8fafc";
          td.style.color = "#94a3b8";
          td.style.fontWeight = "500";
        }
        tr.appendChild(td);
      }
      tbody.appendChild(tr);
    }
    table.appendChild(tbody);
    container.appendChild(table);
  }

  function randomMatrix() {
    R = parseInt(rowsEl.value, 10) || 6;
    C = parseInt(colsEl.value, 10) || 12;
    const dens = (parseFloat(densityEl.value) || 100) / 100;
    matrix = Array.from({ length: R }, () => Array(C).fill(0));
    for (let i = 0; i < R; i++) {
      for (let j = 0; j < C; j++) {
        if (Math.random() < dens) {
          const v = Math.random() * 2 - 1;
          matrix[i][j] = Number(v.toFixed(3));
        }
      }
    }
    renderMatrix(matrixContainer, matrix);
    clearResults();
  }

  function clearResults() {
    Q = [];
    DQ = [];
    quantContainer.innerHTML = "";
    dequantContainer.innerHTML = "";
    errorContainer.innerHTML = "";
    statDim.textContent = `${R} x ${C}`;
    statRange.textContent = "-";
    statQRange.textContent = "-";
    statMSE.textContent = "-";
    statPSNR.textContent = "-";
    statErr.textContent = "-";
    statBitrate.textContent = "-";
    statStrategy.textContent = "-";
    jsonOut.textContent = "";
  }

  function flatStats(A) {
    const flat = A.flat();
    let min = Infinity;
    let max = -Infinity;
    let maxAbs = 0;
    for (const v of flat) {
      min = Math.min(min, v);
      max = Math.max(max, v);
      maxAbs = Math.max(maxAbs, Math.abs(v));
    }
    return { min, max, maxAbs };
  }

  function quantize(A, mode, bits) {
    const { min, max, maxAbs } = flatStats(A);
    const qmaxSym = (1 << (bits - 1)) - 1;
    let QM = [];
    let DQM = [];
    let scale = 1;
    let zero = 0;
    let qmin = -qmaxSym;
    let qmax = qmaxSym;

    if (mode === "int8_sym") {
      scale = maxAbs / (qmaxSym || 1);
      if (scale === 0) scale = 1;
      QM = A.map((r) => r.map((v) => Math.round(v / scale)));
      DQM = QM.map((r) => r.map((q) => Number((q * scale).toFixed(3))));
    } else if (mode === "uint8_asym") {
      qmax = (1 << bits) - 1;
      qmin = 0;
      scale = (max - min) / (qmax || 1);
      if (scale === 0) scale = 1;
      zero = Math.round(-min / scale);
      QM = A.map((r) => r.map((v) => Math.round(v / scale) + zero));
      DQM = QM.map((r) => r.map((q) => Number(((q - zero) * scale).toFixed(3))));
    } else if (mode === "row_dynamic") {
      QM = [];
      DQM = [];
      for (const row of A) {
        const rowMax = Math.max(...row.map((v) => Math.abs(v))) || 1;
        const rowScale = rowMax / (qmaxSym || 1);
        const qRow = row.map((v) => Math.round(v / rowScale));
        QM.push(qRow);
        DQM.push(qRow.map((q) => Number((q * rowScale).toFixed(3))));
      }
    } else if (mode === "log") {
      const denom = Math.log2(1 + maxAbs) || 1;
      QM = A.map((r) =>
        r.map((v) => {
          const s = Math.sign(v);
          const q = Math.log2(1 + Math.abs(v)) / denom;
          return s * Math.round(q * qmaxSym);
        })
      );
      DQM = QM.map((r) =>
        r.map((q) => {
          const s = Math.sign(q);
          const mag = Math.abs(q) / (qmaxSym || 1);
          const v = Math.pow(2, mag * denom) - 1;
          return Number((s * v).toFixed(3));
        })
      );
    } else if (mode === "binary") {
      QM = A.map((r) => r.map((v) => (v >= 0 ? 1 : -1)));
      DQM = QM.map((r) => r.map((v) => Number(v.toFixed(3))));
    } else if (mode === "ternary") {
      const th = 0.3 * maxAbs;
      QM = A.map((r) => r.map((v) => (v > th ? 1 : v < -th ? -1 : 0)));
      DQM = QM.map((r) => r.map((v) => Number(v.toFixed(3))));
    }

    return { Q: QM, DQ: DQM, scale, zero, min, max, qmin, qmax };
  }

  function mse(A, B) {
    let s = 0;
    let n = 0;
    for (let i = 0; i < A.length; i++) {
      for (let j = 0; j < A[0].length; j++) {
        const e = A[i][j] - B[i][j];
        s += e * e;
        n++;
      }
    }
    return n ? s / n : 0;
  }

  el("genRandom").addEventListener("click", randomMatrix);
  densityEl.addEventListener("input", () => {
    densityValEl.textContent = `${densityEl.value}%`;
  });

  el("applyQuant").addEventListener("click", () => {
    if (!matrix.length) {
      alert("Generate a matrix first.");
      return;
    }
    const mode = quantModeEl.value;
    const bits = parseInt(bitWidthEl.value, 10) || 4;
    const { Q: QM, DQ: DQM, min, max, qmin, qmax } = quantize(matrix, mode, bits);
    Q = QM;
    DQ = DQM;

    const mseVal = mse(matrix, DQM);
    const avgErr = Math.sqrt(mseVal);
    const maxAbs = Math.max(Math.abs(min), Math.abs(max));
    const psnr = mseVal === 0 ? "∞" : (10 * Math.log10((maxAbs * maxAbs) / mseVal)).toFixed(2);

    renderMatrix(quantContainer, QM);
    renderMatrix(dequantContainer, DQM);
    const ERR = matrix.map((r, i) => r.map((v, j) => Number((DQM[i][j] - v).toFixed(3))));
    renderMatrix(errorContainer, ERR, "err");

    statDim.textContent = `${R} x ${C}`;
    statRange.textContent = `${min.toFixed(3)} ~ ${max.toFixed(3)}`;
    statQRange.textContent = `${qmin} ~ ${qmax}`;
    statMSE.textContent = mseVal.toExponential(3);
    statPSNR.textContent = psnr;
    statErr.textContent = avgErr.toFixed(4);
    statBitrate.textContent = bits;
    statStrategy.textContent = mode;
    jsonOut.textContent = JSON.stringify(
      { meta: { mode, bits }, quantized: Q, dequantized: DQ },
      null,
      2
    );
  });

  el("resetQuant").addEventListener("click", clearResults);

  el("downloadJSON").addEventListener("click", () => {
    const data = { matrix, quantized: Q, dequantized: DQ };
    const blob = new Blob([JSON.stringify(data, null, 2)], { type: "application/json" });
    const a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "quantization_result.json";
    document.body.appendChild(a);
    a.click();
    a.remove();
  });

  densityValEl.textContent = `${densityEl.value}%`;
  setTimeout(() => randomMatrix(), 100);
})();
