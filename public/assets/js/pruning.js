(function () {
  const el = (id) => document.getElementById(id);
  const rowsEl = el("rows");
  const colsEl = el("cols");
  const densityEl = el("density");
  const densityValEl = el("densityVal");
  const valModeEl = el("valMode");
  const pruneModeEl = el("pruneMode");
  const matrixContainer = el("matrixContainer");
  const prunedContainer = el("prunedContainer");
  const maskContainer = el("maskContainer");
  const jsonOut = el("jsonOut");
  const togglePretty = el("togglePretty");

  const statDim = el("statDim");
  const statNNZ = el("statNNZ");
  const statSparsity = el("statSparsity");
  const statDenseBytes = el("statDenseBytes");
  const statMaskBits = el("statMaskBits");
  const statStrategy = el("statStrategy");

  const paramThreshold = el("param_threshold");
  const paramTopk = el("param_topk");
  const paramTarget = el("param_target");
  const paramRowk = el("param_rowk");
  const paramColk = el("param_colk");
  const paramRandom = el("param_random");
  const paramIter = el("param_iter");

  const tauEl = el("tau");
  const topkEl = el("topk");
  const targetSparsityEl = el("targetSparsity");
  const rowKEl = el("rowK");
  const colKEl = el("colK");
  const randRatioEl = el("randRatio");
  const iterStepsEl = el("iterSteps");
  const iterScheduleEl = el("iterSchedule");
  const iterFinalSparsityEl = el("iterFinalSparsity");

  let matrix = [];
  let pruned = [];
  let mask = [];
  let R = parseInt(rowsEl.value, 10) || 6;
  let C = parseInt(colsEl.value, 10) || 12;
  let isPretty = true;

  function estimateSizeDense(r, c) {
    return r * c * 8;
  }

  function countNNZ(mat) {
    let s = 0;
    for (const row of mat) {
      for (const v of row) if (v !== 0) s++;
    }
    return s;
  }

  function sparsityPct(mat) {
    const n = mat.length * mat[0].length;
    return n ? (100 * (1 - countNNZ(mat) / n)).toFixed(2) : "0.00";
  }

  function maskBits(m) {
    return m.length * m[0].length;
  }

  function clone2D(A) {
    return A.map((row) => row.slice());
  }

  function renderMatrix(container, mat, palette) {
    container.innerHTML = "";
    if (!mat || !mat.length) return;
    const table = document.createElement("table");
    table.className = "border-collapse text-xs";
    const tbody = document.createElement("tbody");
    const cellWidth = Math.max(36, Math.floor(Math.min(48, 800 / Math.max(8, mat[0].length))));
    const cellHeight = 34;

    for (let i = 0; i < mat.length; i++) {
      const tr = document.createElement("tr");
      for (let j = 0; j < mat[0].length; j++) {
        const v = mat[i][j];
        const td = document.createElement("td");
        td.style.width = `${cellWidth}px`;
        td.style.height = `${cellHeight}px`;
        td.style.textAlign = "center";
        td.style.verticalAlign = "middle";
        td.style.border = "1px solid #e2e8f0";
        td.style.fontWeight = "600";
        td.textContent = v === 0 ? "" : v;
        if (v === 0) {
          td.style.background = "#f8fafc";
          td.style.color = "#64748b";
          td.style.fontWeight = "500";
        } else if (palette === "green") {
          td.style.background = "#16a34a";
          td.style.color = "#fff";
        } else if (palette === "gray") {
          td.style.background = "#475569";
          td.style.color = "#fff";
        } else {
          td.style.background = "#0f172a";
          td.style.color = "#fff";
        }
        tr.appendChild(td);
      }
      tbody.appendChild(tr);
    }
    table.appendChild(tbody);
    container.appendChild(table);
  }

  function renderEditableMatrix() {
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
            pruned = [];
            mask = [];
            renderEditableMatrix();
            renderMatrix(prunedContainer, [], "green");
            renderMatrix(maskContainer, [], "gray");
            updateStats();
            updateJSON();
          }

          input.addEventListener("blur", save);
          input.addEventListener("keydown", (ev) => {
            if (ev.key === "Enter") {
              ev.preventDefault();
              save();
            } else if (ev.key === "Escape") {
              renderEditableMatrix();
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

  function initMatrix(r, c, fill) {
    R = Math.max(1, parseInt(r, 10) || 1);
    C = Math.max(1, parseInt(c, 10) || 1);
    matrix = Array.from({ length: R }, () => new Array(C).fill(fill));
    pruned = [];
    mask = [];
    renderEditableMatrix();
    renderMatrix(prunedContainer, [], "green");
    renderMatrix(maskContainer, [], "gray");
    updateStats();
    updateJSON();
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
          if (mode === "randInt") {
            let v = Math.floor(-9 + Math.random() * 19);
            if (v === 0) v = Math.random() < 0.5 ? -1 : 1;
            matrix[i][j] = v;
          } else {
            let v = Number((Math.random() * 2 - 1).toFixed(3));
            if (Math.abs(v) < 0.05) v = v < 0 ? -0.07 : 0.07;
            matrix[i][j] = v;
          }
        }
      }
    }
    pruned = [];
    mask = [];
    renderEditableMatrix();
    renderMatrix(prunedContainer, [], "green");
    renderMatrix(maskContainer, [], "gray");
    updateStats();
    updateJSON();
  }

  function buildMaskThreshold(A, tau) {
    return A.map((row) => row.map((v) => (Math.abs(v) > tau ? 1 : 0)));
  }

  function buildMaskGlobalTopK(A, K) {
    const flat = [];
    for (let i = 0; i < A.length; i++) {
      for (let j = 0; j < A[0].length; j++) {
        if (A[i][j] !== 0) flat.push({ i, j, mag: Math.abs(A[i][j]) });
      }
    }
    flat.sort((a, b) => b.mag - a.mag);
    const keep = new Set(flat.slice(0, Math.max(0, Math.min(K, flat.length))).map((x) => `${x.i},${x.j}`));
    return A.map((row, i) => row.map((v, j) => (keep.has(`${i},${j}`) ? 1 : 0)));
  }

  function buildMaskTargetSparsity(A, targetPct) {
    const vals = [];
    for (let i = 0; i < A.length; i++) {
      for (let j = 0; j < A[0].length; j++) if (A[i][j] !== 0) vals.push(Math.abs(A[i][j]));
    }
    if (!vals.length) return A.map((r) => r.map(() => 0));
    vals.sort((a, b) => a - b);

    const N = A.length * A[0].length;
    const targetZeros = Math.round((N * targetPct) / 100);
    let lo = 0;
    let hi = vals[vals.length - 1];
    let best = hi;
    for (let iter = 0; iter < 40; iter++) {
      const mid = (lo + hi) / 2;
      let prunedNonZero = 0;
      for (const v of vals) if (v <= mid) prunedNonZero++;
      const currentZero = N - countNNZ(A);
      const totalZeroIfMid = currentZero + prunedNonZero;
      if (totalZeroIfMid >= targetZeros) {
        best = mid;
        hi = mid;
      } else {
        lo = mid;
      }
    }
    return buildMaskThreshold(A, best + 1e-12);
  }

  function buildMaskRowTopK(A, K) {
    const M = A.map((r) => r.map(() => 0));
    for (let i = 0; i < A.length; i++) {
      const row = [];
      for (let j = 0; j < A[0].length; j++) if (A[i][j] !== 0) row.push({ j, mag: Math.abs(A[i][j]) });
      row.sort((a, b) => b.mag - a.mag);
      for (let t = 0; t < Math.min(K, row.length); t++) M[i][row[t].j] = 1;
    }
    return M;
  }

  function buildMaskColTopK(A, K) {
    const M = A.map((r) => r.map(() => 0));
    const RR = A.length;
    const CC = A[0].length;
    for (let j = 0; j < CC; j++) {
      const col = [];
      for (let i = 0; i < RR; i++) if (A[i][j] !== 0) col.push({ i, mag: Math.abs(A[i][j]) });
      col.sort((a, b) => b.mag - a.mag);
      for (let t = 0; t < Math.min(K, col.length); t++) M[col[t].i][j] = 1;
    }
    return M;
  }

  function buildMaskRandom(A, ratioPct) {
    return A.map((r) => r.map((v) => (v === 0 ? 0 : Math.random() * 100 < 100 - ratioPct ? 1 : 0)));
  }

  function applyMask(A, M) {
    const B = Array.from({ length: A.length }, () => new Array(A[0].length).fill(0));
    for (let i = 0; i < A.length; i++) {
      for (let j = 0; j < A[0].length; j++) {
        B[i][j] = M[i][j] ? A[i][j] : 0;
      }
    }
    return B;
  }

  function iterativePrune(A, steps, finalSparsityPct, schedule) {
    let cur = clone2D(A);
    for (let s = 1; s <= steps; s++) {
      const frac = s / steps;
      const target = schedule === "poly3" ? finalSparsityPct * Math.pow(frac, 3) : finalSparsityPct * frac;
      const M = buildMaskTargetSparsity(cur, target);
      cur = applyMask(cur, M);
    }
    const Mlast = buildMaskTargetSparsity(cur, finalSparsityPct);
    return { B: applyMask(cur, Mlast), M: Mlast };
  }

  function updateStats(strategyLabel) {
    if (!matrix.length) {
      statDim.textContent = "-";
      statNNZ.textContent = "-";
      statSparsity.textContent = "-";
      statDenseBytes.textContent = "-";
      statMaskBits.textContent = "-";
      statStrategy.textContent = "-";
      return;
    }
    const nnz0 = countNNZ(matrix);
    const sp0 = sparsityPct(matrix);
    statDim.textContent = `${R} x ${C}`;
    statDenseBytes.textContent = estimateSizeDense(R, C);

    if (pruned.length) {
      const nnz1 = countNNZ(pruned);
      const sp1 = sparsityPct(pruned);
      statNNZ.textContent = `${nnz0} → ${nnz1}`;
      statSparsity.textContent = `${sp0}% → ${sp1}%`;
    } else {
      statNNZ.textContent = `${nnz0}`;
      statSparsity.textContent = `${sp0}%`;
    }
    statMaskBits.textContent = mask.length ? maskBits(mask) : "-";
    statStrategy.textContent = strategyLabel || "-";
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

  function updateJSON() {
    const payload = {
      meta: { R, C, strategy: statStrategy.textContent },
      original: matrix,
      pruned: pruned.length ? pruned : null,
      mask: mask.length ? mask : null,
    };
    if (isPretty) {
      jsonOut.textContent = JSON.stringify(payload, null, 2);
      jsonOut.style.whiteSpace = "pre-wrap";
    } else {
      jsonOut.textContent = stringifyInline(payload, 140);
      jsonOut.style.whiteSpace = "pre";
    }
    jsonOut.scrollTop = 0;
  }

  function setParamVisibility(mode) {
    paramThreshold.classList.add("hidden");
    paramTopk.classList.add("hidden");
    paramTarget.classList.add("hidden");
    paramRowk.classList.add("hidden");
    paramColk.classList.add("hidden");
    paramRandom.classList.add("hidden");
    paramIter.classList.add("hidden");

    if (mode === "threshold") paramThreshold.classList.remove("hidden");
    else if (mode === "global_topk") paramTopk.classList.remove("hidden");
    else if (mode === "target_sparsity") paramTarget.classList.remove("hidden");
    else if (mode === "row_topk") paramRowk.classList.remove("hidden");
    else if (mode === "col_topk") paramColk.classList.remove("hidden");
    else if (mode === "random") paramRandom.classList.remove("hidden");
    else if (mode === "iterative") paramIter.classList.remove("hidden");
  }

  function applyPruning() {
    if (!matrix.length) {
      alert("Generate a matrix first.");
      return;
    }
    const mode = pruneModeEl.value;
    let M = null;
    let B = null;
    let label = "";

    if (mode === "threshold") {
      const tau = parseFloat(tauEl.value) || 0;
      label = `Threshold tau=${tau}`;
      M = buildMaskThreshold(matrix, tau);
      B = applyMask(matrix, M);
    } else if (mode === "global_topk") {
      const K = Math.max(0, parseInt(topkEl.value, 10) || 0);
      label = `Global Top-K keep, K=${K}`;
      M = buildMaskGlobalTopK(matrix, K);
      B = applyMask(matrix, M);
    } else if (mode === "target_sparsity") {
      const tgt = Math.max(0, Math.min(99, parseInt(targetSparsityEl.value, 10) || 0));
      label = `Target sparsity ${tgt}%`;
      M = buildMaskTargetSparsity(matrix, tgt);
      B = applyMask(matrix, M);
    } else if (mode === "row_topk") {
      const K = Math.max(0, parseInt(rowKEl.value, 10) || 0);
      label = `Row Top-K keep, K=${K}`;
      M = buildMaskRowTopK(matrix, K);
      B = applyMask(matrix, M);
    } else if (mode === "col_topk") {
      const K = Math.max(0, parseInt(colKEl.value, 10) || 0);
      label = `Column Top-K keep, K=${K}`;
      M = buildMaskColTopK(matrix, K);
      B = applyMask(matrix, M);
    } else if (mode === "random") {
      const r = Math.max(0, Math.min(100, parseInt(randRatioEl.value, 10) || 0));
      label = `Random prune ratio ${r}%`;
      M = buildMaskRandom(matrix, r);
      B = applyMask(matrix, M);
    } else if (mode === "iterative") {
      const steps = Math.max(1, parseInt(iterStepsEl.value, 10) || 1);
      const finalSp = Math.max(0, Math.min(99, parseInt(iterFinalSparsityEl.value, 10) || 0));
      const sched = iterScheduleEl.value;
      label = `Iterative ${sched}, steps=${steps}, final=${finalSp}%`;
      const res = iterativePrune(matrix, steps, finalSp, sched);
      B = res.B;
      M = res.M;
    }

    if (!B || !M) {
      alert("Pruning failed.");
      return;
    }

    pruned = B;
    mask = M;
    renderMatrix(prunedContainer, pruned, "green");
    renderMatrix(maskContainer, mask, "gray");
    updateStats(label);
    updateJSON();
  }

  densityEl.addEventListener("input", () => {
    densityValEl.textContent = `${densityEl.value}%`;
  });

  el("genRandom").addEventListener("click", randomMatrix);
  el("resetMatrix").addEventListener("click", () => initMatrix(rowsEl.value, colsEl.value, 0));

  pruneModeEl.addEventListener("change", () => setParamVisibility(pruneModeEl.value));
  el("applyPrune").addEventListener("click", applyPruning);
  el("resetPrune").addEventListener("click", () => {
    pruned = [];
    mask = [];
    renderMatrix(prunedContainer, [], "green");
    renderMatrix(maskContainer, [], "gray");
    updateStats();
    updateJSON();
  });

  togglePretty.addEventListener("click", () => {
    isPretty = !isPretty;
    togglePretty.textContent = isPretty ? "Pretty view" : "Compact view";
    updateJSON();
  });

  el("downloadJSON").addEventListener("click", () => {
    const data = {
      meta: { R, C, strategy: statStrategy.textContent },
      original: matrix,
      pruned: pruned.length ? pruned : null,
      mask: mask.length ? mask : null,
    };
    const blob = new Blob([JSON.stringify(data, null, 2)], { type: "application/json" });
    const a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "pruning_result.json";
    document.body.appendChild(a);
    a.click();
    a.remove();
  });

  densityValEl.textContent = `${densityEl.value}%`;
  setParamVisibility(pruneModeEl.value);
  setTimeout(() => randomMatrix(), 60);
})();
