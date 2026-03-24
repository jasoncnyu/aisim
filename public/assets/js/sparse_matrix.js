(function () {
  const el = (id) => document.getElementById(id);
  const rowsEl = el("rows");
  const colsEl = el("cols");
  const densityEl = el("density");
  const densityValEl = el("densityVal");
  const valModeEl = el("valMode");
  const matrixContainer = el("matrixContainer");
  const encFormatEl = el("encFormat");
  const encResultsEl = el("encResults");
  const matrixJSONEl = el("matrixJSON");
  const togglePrettyEl = el("togglePretty");
  const statDim = el("statDim");
  const statNNZ = el("statNNZ");
  const statDenseBytes = el("statDenseBytes");
  const statCompressedBytes = el("statCompressedBytes");
  const statRatio = el("statRatio");
  const statRecon = el("statRecon");

  let matrix = [];
  let R = parseInt(rowsEl.value, 10) || 6;
  let C = parseInt(colsEl.value, 10) || 12;
  let isPretty = true;
  let lastEncode = null;

  function estimateSizeDense(r, c) {
    return r * c * 8;
  }
  function estimateSizeCOO(coo) {
    return coo.rows.length * (4 + 4 + 8);
  }
  function estimateSizeCSR(csr) {
    return csr.values.length * 8 + csr.col_idx.length * 4 + csr.row_ptr.length * 4;
  }
  function estimateSizeCSC(csc) {
    return csc.values.length * 8 + csc.row_idx.length * 4 + csc.col_ptr.length * 4;
  }
  function estimateSizeRLE(rle) {
    let s = 0;
    for (const row of rle) s += row.length * (8 + 4);
    return s;
  }
  function estimateSizeDict(dict) {
    let cnt = 0;
    for (const k in dict) cnt += Object.keys(dict[k]).length;
    return cnt * (4 + 8);
  }
  function estimateSizeBitmap(bitmapRes) {
    return bitmapRes.bytes_length;
  }

  function stringifyInline(obj, maxInline) {
    if (Array.isArray(obj)) {
      if (obj.every((v) => v === null || typeof v !== "object") && obj.join(", ").length <= maxInline) {
        return "[" + obj.map((v) => JSON.stringify(v)).join(", ") + "]";
      }
      return "[" + obj.map((v) => stringifyInline(v, maxInline)).join(", ") + "]";
    }
    if (obj && typeof obj === "object") {
      const entries = Object.keys(obj).map(
        (k) => JSON.stringify(k) + ": " + stringifyInline(obj[k], maxInline)
      );
      return "{" + entries.join(", ") + "}";
    }
    return JSON.stringify(obj);
  }

  function updateStats() {
    const nnz = matrix.reduce((s, row) => s + row.filter((v) => v !== 0).length, 0);
    statDim.textContent = `${R} x ${C}`;
    statNNZ.textContent = nnz;
    const denseBytes = estimateSizeDense(R, C);
    statDenseBytes.textContent = denseBytes;

    if (lastEncode && lastEncode.res) {
      const fmt = lastEncode.format;
      let compBytes = 0;
      if (fmt === "coo") compBytes = estimateSizeCOO(lastEncode.res);
      else if (fmt === "csr") compBytes = estimateSizeCSR(lastEncode.res);
      else if (fmt === "csc") compBytes = estimateSizeCSC(lastEncode.res);
      else if (fmt === "rle") compBytes = estimateSizeRLE(lastEncode.res);
      else if (fmt === "dict") compBytes = estimateSizeDict(lastEncode.res);
      else if (fmt === "bitmap") compBytes = estimateSizeBitmap(lastEncode.res);
      statCompressedBytes.textContent = compBytes;
      statRatio.textContent = compBytes ? (denseBytes / compBytes).toFixed(2) + "x" : "-";
    } else {
      statCompressedBytes.textContent = "-";
      statRatio.textContent = "-";
    }

    if (lastEncode && typeof lastEncode.reconOk !== "undefined") {
      statRecon.textContent = lastEncode.reconOk ? "OK" : "Mismatch";
    } else {
      statRecon.textContent = "-";
    }

    try {
      matrixJSONEl.textContent = JSON.stringify(matrix, null, 2);
    } catch (e) {
      matrixJSONEl.textContent = String(matrix);
    }
  }

  function initMatrix(r, c, fill) {
    R = Math.max(1, parseInt(r, 10) || 1);
    C = Math.max(1, parseInt(c, 10) || 1);
    matrix = Array.from({ length: R }, () => new Array(C).fill(fill));
    renderMatrix();
    updateStats();
  }

  function randomMatrix() {
    R = Math.max(1, parseInt(rowsEl.value, 10) || 1);
    C = Math.max(1, parseInt(colsEl.value, 10) || 1);
    const dens = (parseFloat(densityEl.value) || 0) / 100;
    const mode = valModeEl.value;
    matrix = Array.from({ length: R }, () => new Array(C).fill(0));
    for (let i = 0; i < R; i++) {
      for (let j = 0; j < C; j++) {
        if (Math.random() < dens) {
          if (mode === "randInt") matrix[i][j] = Math.floor(1 + Math.random() * 9);
          else matrix[i][j] = Number(Math.random().toFixed(3));
        }
      }
    }
    renderMatrix();
    updateStats();
  }


  function renderMatrix() {
    matrixContainer.innerHTML = "";
    const table = document.createElement("table");
    table.className = "border-collapse text-xs";
    const tbody = document.createElement("tbody");
    const cellWidth = Math.max(36, Math.floor(Math.min(48, 800 / Math.max(8, C))));
    const cellHeight = 34;
    for (let i = 0; i < R; i++) {
      const tr = document.createElement("tr");
      for (let j = 0; j < C; j++) {
        const val = matrix[i][j];
        const td = document.createElement("td");
        td.style.width = `${cellWidth}px`;
        td.style.height = `${cellHeight}px`;
        td.style.textAlign = "center";
        td.style.verticalAlign = "middle";
        td.style.border = "1px solid #e2e8f0";
        td.style.cursor = "pointer";
        td.style.fontWeight = "600";
        td.textContent = val === 0 ? "" : val;
        if (val === 0) {
          td.style.background = "#f8fafc";
          td.style.color = "#64748b";
          td.style.fontWeight = "500";
        } else {
          td.style.background = "#0f172a";
          td.style.color = "#fff";
        }

        td.addEventListener("click", (e) => {
          e.stopPropagation();
          if (td.querySelector("input")) return;
          const input = document.createElement("input");
          input.type = "text";
          input.value = val === 0 ? "" : String(val);
          input.className = "w-full text-center text-xs";
          input.style.height = "28px";
          input.style.border = "1px solid #e2e8f0";
          input.style.borderRadius = "4px";
          td.innerHTML = "";
          td.appendChild(input);
          input.focus();
          input.select();

          function save() {
            const v = input.value.trim();
            if (v === "" || v === "0") {
              matrix[i][j] = 0;
            } else {
              const n = Number(v);
              matrix[i][j] = Number.isFinite(n) ? (Math.abs(n - Math.round(n)) < 1e-9 ? Math.round(n) : n) : 0;
            }
            renderMatrix();
            updateStats();
          }

          input.addEventListener("blur", save);
          input.addEventListener("keydown", (ev) => {
            if (ev.key === "Enter") {
              ev.preventDefault();
              save();
            } else if (ev.key === "Escape") {
              renderMatrix();
            }
          });
        });

        tr.appendChild(td);
      }
      tbody.appendChild(tr);
    }
    table.appendChild(tbody);
    matrixContainer.appendChild(table);
  }

  function encodeCOO(mat) {
    const rows = [];
    const cols = [];
    const vals = [];
    for (let i = 0; i < mat.length; i++) {
      for (let j = 0; j < mat[0].length; j++) {
        const v = mat[i][j];
        if (v !== 0) {
          rows.push(i);
          cols.push(j);
          vals.push(v);
        }
      }
    }
    return { rows, cols, vals };
  }
  function encodeCSR(mat) {
    const values = [];
    const col_idx = [];
    const row_ptr = [0];
    for (let i = 0; i < mat.length; i++) {
      for (let j = 0; j < mat[0].length; j++) {
        const v = mat[i][j];
        if (v !== 0) {
          values.push(v);
          col_idx.push(j);
        }
      }
      row_ptr.push(values.length);
    }
    return { values, col_idx, row_ptr };
  }
  function encodeCSC(mat) {
    const values = [];
    const row_idx = [];
    const col_ptr = [0];
    const RR = mat.length;
    const CC = mat[0].length;
    for (let j = 0; j < CC; j++) {
      for (let i = 0; i < RR; i++) {
        const v = mat[i][j];
        if (v !== 0) {
          values.push(v);
          row_idx.push(i);
        }
      }
      col_ptr.push(values.length);
    }
    return { values, row_idx, col_ptr };
  }
  function encodeRLE(mat) {
    const rows = [];
    for (let i = 0; i < mat.length; i++) {
      const row = [];
      let runVal = mat[i][0];
      let runCnt = 1;
      for (let j = 1; j < mat[0].length; j++) {
        const v = mat[i][j];
        if (v === runVal) runCnt++;
        else {
          row.push([runVal, runCnt]);
          runVal = v;
          runCnt = 1;
        }
      }
      row.push([runVal, runCnt]);
      rows.push(row);
    }
    return rows;
  }
  function encodeDict(mat) {
    const dict = {};
    for (let i = 0; i < mat.length; i++) {
      const rowObj = {};
      for (let j = 0; j < mat[0].length; j++) {
        const v = mat[i][j];
        if (v !== 0) rowObj[j] = v;
      }
      if (Object.keys(rowObj).length > 0) dict[i] = rowObj;
    }
    return dict;
  }
  function encodeBitmap(mat) {
    const RR = mat.length;
    const CC = mat[0].length;
    const bytes = [];
    for (let i = 0; i < RR; i++) {
      let bitCount = 0;
      let byteVal = 0;
      for (let j = 0; j < CC; j++) {
        const bit = mat[i][j] ? 1 : 0;
        byteVal = (byteVal << 1) | bit;
        bitCount++;
        if (bitCount === 8) {
          bytes.push(byteVal & 0xff);
          byteVal = 0;
          bitCount = 0;
        }
      }
      if (bitCount > 0) {
        byteVal = byteVal << (8 - bitCount);
        bytes.push(byteVal & 0xff);
      }
    }
    const hex = bytes.map((b) => ("0" + b.toString(16)).slice(-2)).join("");
    const rows = mat.map((r) => r.map((v) => (v ? "1" : "0")).join(""));
    return { format: "bitmap", R: RR, C: CC, bytes_hex: hex, bytes_length: bytes.length, rows };
  }

  function reconstructFromCOO(coo, r, c) {
    const A = Array.from({ length: r }, () => new Array(c).fill(0));
    for (let k = 0; k < coo.rows.length; k++) {
      A[coo.rows[k]][coo.cols[k]] = coo.vals[k];
    }
    return A;
  }
  function reconstructFromCSR(csr, r, c) {
    const A = Array.from({ length: r }, () => new Array(c).fill(0));
    for (let i = 0; i < r; i++) {
      const start = csr.row_ptr[i];
      const end = csr.row_ptr[i + 1];
      for (let k = start; k < end; k++) {
        const col = csr.col_idx[k];
        const val = csr.values[k];
        A[i][col] = val;
      }
    }
    return A;
  }
  function reconstructFromCSC(csc, r, c) {
    const A = Array.from({ length: r }, () => new Array(c).fill(0));
    for (let j = 0; j < c; j++) {
      const start = csc.col_ptr[j];
      const end = csc.col_ptr[j + 1];
      for (let k = start; k < end; k++) {
        const row = csc.row_idx[k];
        const val = csc.values[k];
        A[row][j] = val;
      }
    }
    return A;
  }
  function reconstructFromRLE(rle, r, c) {
    const A = Array.from({ length: r }, () => new Array(c).fill(0));
    for (let i = 0; i < r; i++) {
      let col = 0;
      for (const pair of rle[i]) {
        const val = pair[0];
        const cnt = pair[1];
        for (let t = 0; t < cnt; t++) {
          if (col < c) A[i][col] = val;
          col++;
        }
      }
    }
    return A;
  }
  function reconstructFromDict(dict, r, c) {
    const A = Array.from({ length: r }, () => new Array(c).fill(0));
    for (const key in dict) {
      const i = parseInt(key, 10);
      for (const cj in dict[key]) {
        const j = parseInt(cj, 10);
        A[i][j] = dict[key][cj];
      }
    }
    return A;
  }

  function compareMatrices(A, B) {
    if (!A || !B) return false;
    if (A.length !== B.length || A[0].length !== B[0].length) return false;
    for (let i = 0; i < A.length; i++) {
      for (let j = 0; j < A[0].length; j++) {
        if (A[i][j] !== B[i][j]) return false;
      }
    }
    return true;
  }

  function renderEncodedResults(res) {
    if (!res) {
      encResultsEl.textContent = "";
      return;
    }
    if (isPretty) {
      encResultsEl.textContent = JSON.stringify(res, null, 2);
      encResultsEl.style.whiteSpace = "pre-wrap";
    } else {
      encResultsEl.textContent = stringifyInline(res, 140);
      encResultsEl.style.whiteSpace = "pre";
    }
    encResultsEl.scrollTop = 0;
  }

  function encode() {
    if (!matrix || matrix.length === 0) {
      encResultsEl.textContent = "Matrix is empty.";
      return;
    }
    const format = encFormatEl.value;
    let res = null;
    if (format === "coo") res = encodeCOO(matrix);
    else if (format === "csr") res = encodeCSR(matrix);
    else if (format === "csc") res = encodeCSC(matrix);
    else if (format === "rle") res = encodeRLE(matrix);
    else if (format === "dict") res = encodeDict(matrix);
    else if (format === "bitmap") res = encodeBitmap(matrix);
    lastEncode = { format, res, R, C };
    renderEncodedResults(res);
    updateStats();
    statRecon.textContent = "-";
  }

  function reconstruct() {
    if (!lastEncode) {
      alert("Encode first.");
      return;
    }
    const fmt = lastEncode.format;
    const res = lastEncode.res;
    let recon = null;
    if (fmt === "coo") recon = reconstructFromCOO(res, R, C);
    else if (fmt === "csr") recon = reconstructFromCSR(res, R, C);
    else if (fmt === "csc") recon = reconstructFromCSC(res, R, C);
    else if (fmt === "rle") recon = reconstructFromRLE(res, R, C);
    else if (fmt === "dict") recon = reconstructFromDict(res, R, C);
    else if (fmt === "bitmap") {
      const rows = res.rows || [];
      recon = Array.from({ length: R }, () => new Array(C).fill(0));
      for (let i = 0; i < Math.min(rows.length, R); i++) {
        const s = rows[i];
        for (let j = 0; j < Math.min(s.length, C); j++) {
          recon[i][j] = s[j] === "1" ? 1 : 0;
        }
      }
    }
    const ok = compareMatrices(matrix, recon);
    lastEncode.reconOk = ok;
    updateStats();
  }

  densityEl.addEventListener("input", () => {
    densityValEl.textContent = `${densityEl.value}%`;
  });
  el("genRandom").addEventListener("click", randomMatrix);
  el("resetMatrix").addEventListener("click", () => initMatrix(rowsEl.value, colsEl.value, 0));
  togglePrettyEl.addEventListener("click", () => {
    isPretty = !isPretty;
    togglePrettyEl.textContent = isPretty ? "Pretty view" : "Compact view";
    if (lastEncode && lastEncode.res) renderEncodedResults(lastEncode.res);
  });

  el("encodeBtn").addEventListener("click", encode);
  el("reconstructBtn").addEventListener("click", reconstruct);
  el("downloadAll").addEventListener("click", () => {
    if (!lastEncode) {
      alert("Encode first.");
      return;
    }
    const data = { meta: { format: lastEncode.format, R, C }, enc: lastEncode.res };
    const blob = new Blob([JSON.stringify(data, null, 2)], { type: "application/json" });
    const a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "sparse_encoding.json";
    document.body.appendChild(a);
    a.click();
    a.remove();
  });

  densityValEl.textContent = `${densityEl.value}%`;
  setTimeout(() => randomMatrix(), 60);
})();

