<?php /* School Info Module — Shared Form Styles & JS Utilities */ ?>
<style>
/* ── SI Cards ── */
.si-card{background:#fff;border-radius:14px;box-shadow:0 4px 24px rgba(0,0,0,.08);margin-bottom:20px;overflow:hidden;}
.si-card-header{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:15px 22px;display:flex;align-items:center;gap:11px;}
.si-card-header .si-hdr-ico{width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.si-card-header .si-hdr-ico i{color:#fff;font-size:15px;}
.si-card-header h4{margin:0;color:#fff;font-size:15px;font-weight:700;letter-spacing:.4px;flex:1;}
.si-card-header p{margin:2px 0 0;color:rgba(255,255,255,.6);font-size:11px;}
.si-card-body{padding:22px 20px;}

/* ── Section dividers ── */
.si-sec{font-size:10.5px;font-weight:800;text-transform:uppercase;letter-spacing:1.2px;color:#94a3b8;margin:18px 0 12px;display:flex;align-items:center;gap:10px;}
.si-sec::before{content:'';width:4px;height:16px;border-radius:2px;background:linear-gradient(#4361ee,#7c3aed);flex-shrink:0;}
.si-sec::after{content:'';flex:1;height:1px;background:#e2e8f0;}

/* ── Form groups ── */
.si-fg{margin-bottom:16px;}
.si-fg>label{display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.6px;margin-bottom:5px;}
.si-fg label .req{color:#e74c3c;margin-left:2px;}
.si-fg label .si-tip{display:inline-block;width:14px;height:14px;border-radius:50%;background:#94a3b8;color:#fff;font-size:9px;font-weight:700;text-align:center;line-height:14px;cursor:help;margin-left:4px;vertical-align:middle;}

/* ── Input wrapper ── */
.si-iw{position:relative;}
.si-iw .ico{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:13px;pointer-events:none;z-index:2;}
.si-iw .ico-ta{position:absolute;left:11px;top:13px;color:#94a3b8;font-size:13px;pointer-events:none;z-index:2;}
.si-ctrl{border:2px solid #e2e8f0;border-radius:8px;padding:9px 11px 9px 34px;font-size:13.5px;color:#1e293b;background:#f8fafc;width:100%;transition:border-color .2s,box-shadow .2s,background .2s;-webkit-appearance:none;box-shadow:none;display:block;}
.si-iw.no-ico .si-ctrl{padding-left:11px;}
.si-ctrl:focus{border-color:#4361ee!important;background:#fff!important;box-shadow:0 0 0 3px rgba(67,97,238,.12)!important;outline:none;}
.si-ctrl.is-valid{border-color:#2ecc71!important;}
.si-ctrl.is-invalid{border-color:#e74c3c!important;}
select.si-ctrl{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2394a3b8' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 11px center;padding-right:30px;cursor:pointer;}
textarea.si-ctrl{min-height:90px;resize:vertical;}
.si-err{font-size:11px;color:#e74c3c;margin-top:3px;display:none;}
.si-err.show{display:block;}
.si-hint{font-size:11px;color:#94a3b8;margin-top:3px;}

/* ── Password toggle ── */
.si-pw-btn{position:absolute;right:11px;top:50%;transform:translateY(-50%);color:#94a3b8;cursor:pointer;z-index:3;font-size:13px;background:none;border:none;padding:2px 4px;}
.si-pw-btn:hover{color:#4361ee;}

/* ── File upload zone ── */
.si-file{border:2px dashed #cbd5e1;border-radius:8px;padding:14px 10px;text-align:center;cursor:pointer;transition:all .2s;background:#f8fafc;position:relative;overflow:hidden;}
.si-file:hover{border-color:#4361ee;background:rgba(67,97,238,.04);}
.si-file input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.si-file .si-file-ico{font-size:20px;color:#94a3b8;display:block;margin-bottom:5px;}
.si-file span{font-size:11.5px;color:#64748b;}

/* ── Image preview ── */
.si-img{width:58px;height:58px;border-radius:8px;object-fit:cover;border:2px solid #e2e8f0;cursor:pointer;transition:transform .2s,box-shadow .2s;display:block;}
.si-img:hover{transform:scale(1.08);box-shadow:0 4px 14px rgba(0,0,0,.15);}

/* ── Buttons ── */
.si-btn{border:none;border-radius:8px;padding:9px 20px;font-size:13.5px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:all .2s;text-decoration:none;line-height:1.4;vertical-align:middle;}
.si-btn-pri{background:linear-gradient(135deg,#4361ee,#3451c7);color:#fff;}
.si-btn-pri:hover,.si-btn-pri:focus{transform:translateY(-2px);box-shadow:0 6px 20px rgba(67,97,238,.38);color:#fff;text-decoration:none;}
.si-btn-ok{background:linear-gradient(135deg,#2ecc71,#1a9e56);color:#fff;}
.si-btn-ok:hover,.si-btn-ok:focus{transform:translateY(-2px);box-shadow:0 6px 20px rgba(46,204,113,.38);color:#fff;text-decoration:none;}
.si-btn-del{background:linear-gradient(135deg,#e74c3c,#c0392b);color:#fff;}
.si-btn-del:hover,.si-btn-del:focus{transform:translateY(-2px);box-shadow:0 6px 20px rgba(231,76,60,.38);color:#fff;text-decoration:none;}
.si-btn-ghost{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;}
.si-btn-ghost:hover{background:#e2e8f0;color:#334155;text-decoration:none;}
.si-btn-lg{padding:11px 28px;font-size:14.5px;}
.si-btn i{font-size:12px;}

/* ── Table ── */
.si-tbl-wrap{overflow-x:auto;border-radius:10px;border:1px solid #e2e8f0;}
.si-tbl{width:100%;border-collapse:collapse;font-size:13px;}
.si-tbl thead th{background:linear-gradient(135deg,#1a1a2e,#0f3460);color:#fff;padding:11px 14px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;text-align:left;white-space:nowrap;}
.si-tbl tbody tr{border-bottom:1px solid #f1f5f9;transition:background .15s;}
.si-tbl tbody tr:hover{background:#f8fafc;}
.si-tbl tbody td{padding:10px 14px;color:#334155;vertical-align:middle;}
.si-tbl tbody tr:last-child td{border-bottom:none;}
.si-tbl td.cen,.si-tbl th.cen{text-align:center;}
.si-sno{display:inline-flex;align-items:center;justify-content:center;width:26px;height:26px;border-radius:50%;background:#f1f5f9;color:#64748b;font-size:12px;font-weight:700;}

/* ── Modal ── */
.si-modal .modal-content{border-radius:16px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.22);overflow:hidden;}
.si-modal .modal-header{background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:15px 20px;border:none;}
.si-modal .modal-title{color:#fff;font-size:15px;font-weight:700;}
.si-modal .modal-header .close{color:rgba(255,255,255,.75);opacity:1;font-size:22px;text-shadow:none;margin-top:-2px;padding:0;}
.si-modal .modal-header .close:hover{color:#fff;}
.si-modal .modal-body{padding:20px 22px;}
.si-modal .modal-footer{border-top:1px solid #f1f5f9;padding:14px 20px;display:flex;gap:8px;justify-content:flex-end;}

/* ── Submit bar ── */
.si-submit-bar{background:#f8fafc;border-top:2px solid #e2e8f0;padding:16px 20px;text-align:center;margin:12px -20px -22px;}

/* ── Badge ── */
.si-badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.si-badge-pri{background:rgba(67,97,238,.12);color:#4361ee;}
.si-badge-ok{background:rgba(46,204,113,.12);color:#1a9e56;}
.si-badge-sec{background:#f1f5f9;color:#64748b;}
.si-badge-warn{background:rgba(243,156,18,.12);color:#b45309;}

/* ── Checkbox ── */
.si-chk{display:flex;align-items:center;gap:7px;}
.si-chk input[type="checkbox"]{width:16px;height:16px;cursor:pointer;accent-color:#4361ee;flex-shrink:0;}
.si-chk label{margin:0;cursor:pointer;font-size:13px!important;text-transform:none!important;letter-spacing:0!important;color:#475569;font-weight:600!important;}

/* ── Document row (file+preview side by side) ── */
.si-doc-row{display:flex;flex-wrap:wrap;gap:20px;}
.si-doc-item{flex:1;min-width:140px;display:flex;flex-direction:column;gap:8px;}
.si-doc-item>span{font-size:11px;color:#64748b;font-weight:700;text-align:center;text-transform:uppercase;letter-spacing:.5px;}

/* ── Responsive ── */
@media(max-width:768px){
  .si-card-body{padding:16px 12px;}
  .si-submit-bar{margin:12px -12px -16px;}
  .si-doc-row{gap:12px;}
  .si-doc-item{min-width:120px;}
}
</style>
<script>
/* SI Form Validation Utility */
function siVal(el) {
  var val = (el.value || '').trim();
  var errEl = document.getElementById(el.id + '_err');
  var ok = true;
  el.classList.remove('is-valid', 'is-invalid');
  if ((el.hasAttribute('required') || el.dataset.req) && val === '') {
    ok = false;
    if (errEl) { errEl.textContent = 'This field is required.'; errEl.classList.add('show'); }
  } else if (el.dataset.email !== undefined && val !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
    ok = false;
    if (errEl) { errEl.textContent = 'Enter a valid email address.'; errEl.classList.add('show'); }
  } else if (el.dataset.tel !== undefined && val !== '' && !/^\+?[\d\s\-()]{6,15}$/.test(val)) {
    ok = false;
    if (errEl) { errEl.textContent = 'Enter a valid phone number.'; errEl.classList.add('show'); }
  } else if (el.dataset.pin !== undefined && val !== '' && !/^\d{4,8}$/.test(val)) {
    ok = false;
    if (errEl) { errEl.textContent = 'Pincode must be 4–8 digits.'; errEl.classList.add('show'); }
  } else if (el.dataset.latlng !== undefined && val !== '' && !/^-?\d+(\.\d+)?$/.test(val)) {
    ok = false;
    if (errEl) { errEl.textContent = 'Enter a valid decimal coordinate.'; errEl.classList.add('show'); }
  }
  if (ok) {
    el.classList.add(val ? 'is-valid' : '');
    if (errEl) { errEl.textContent = ''; errEl.classList.remove('show'); }
  } else {
    el.classList.add('is-invalid');
  }
  return ok;
}

function siPwToggle(id, btn) {
  var inp = document.getElementById(id);
  if (!inp) return;
  if (inp.type === 'password') {
    inp.type = 'text';
    $(btn).find('i').attr('class', 'fa fa-eye-slash');
  } else {
    inp.type = 'password';
    $(btn).find('i').attr('class', 'fa fa-eye');
  }
}

function siFileLabel(input, labelId) {
  var lbl = document.getElementById(labelId);
  if (lbl && input.files && input.files[0]) {
    lbl.textContent = input.files[0].name;
  }
}
</script>
