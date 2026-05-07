 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/morris.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/jquery-jvectormap.css">
  <!-- Ionicons -->

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo $school_software_path; ?>assests/css/select2.min.css">
     <style>
    .select2-selection { height: auto !important; }
</style>

  <!-- Ionicons -->
	
	  <style>
     .load-bar {
  position: relative;
  margin-top: 0px;
  width: 100%;
  height: 3px;
  background-color: #34fa2c;
}
.bar {
  content: "";
  display: inline;
  position: absolute;
  width: 0;
  height: 100%;
  left: 50%;
  text-align: center;
}
.bar:nth-child(1) {
  background-color: #fa4733;
  animation: loading 1s linear infinite;
}
.bar:nth-child(2) {
  background-color: #3078f7;
  animation: loading 1s linear 300ms infinite;
}
.bar:nth-child(3) {
  background-color: #45fa2c;
  animation: loading 1s linear 500ms infinite;
}
@keyframes loading {
    from {left: 50%; width: 0;z-index:100;}
    33.3333% {left: 0; width: 100%;z-index: 10;}
    to {left: 0; width: 100%;}
}
 </style>
 <style>

.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background: #007bff;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

 </style>
    <script>
        var loader_div_google="<div class='load-bar'><div class='bar'></div><div class='bar'></div><div class='bar'></div></div>";

    loader_div="<div style='width:100%;' ><center><div class='lds-roller' style='margin-top:200px'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center></div>";
function link_verification(cname){
    if(cname=='index_content' || cname=='smartclass/smartclass' || cname=='attendance/attendance' || cname=='enquiry/enquiry' || cname=='staff/staff' || cname=='student/students' || cname=='account/account' || cname=='dues/dues' || cname=='fees/fees' || cname=='fees_monthly/fees' || cname=='fees_yearly/fees' || cname=='fees_installmentwise/fees' || cname=='penalty/penalty' || cname=='certificate/certificate' || cname=='examination/examination' || cname=='homework/homework' || cname=='exam_paper_setter/exam_paper_setter' || cname=='complaint/complaint' || cname=='sms/sms_panel' || cname=='time_table/time_table' || cname=='event_management/event_management' || cname=='holiday/holiday' || cname=='leave/leave' || cname=='sports/sports' || cname=='important/important' || cname=='downloads/downloads' || cname=='recycle_bin/recycle_bin' || cname=='session/session' || cname=='govt_requirement/govt_requirement' || cname=='reminder/reminder' || cname=='school_info/school_info' || cname=='bus/bus' || cname=='hostel/hostel' || cname=='library/library' || cname=='stock/stock' || cname=='android_app/android_app' || cname=='user_right/user_right' || cname=='website_management/Notification' || cname=='gate_pass/gate_pass' || cname=='stock_management/stock_management' || cname=='stock_management_new/stock_management' || cname=='website_management_new/website_management'){
        return true;
    }else{
         return false;
    }
}
        function alert_new(content,color){/* placeholder — overridden by link_js.php */}
	function loader(){
	    $("#get_content").html(loader_div);
	}function loader_with_id(id){
	    $("#"+id).html(loader_div);
	}function loader_with_id_remove(id){
	    $("#"+id).html("");
	}
	
	function setCookie(cname, cvalue, session_id231) {
      
    cname.replace("/", "_");
    cname=session_id231+cname;
  sessionStorage.setItem(cname, cvalue);
  }

function getCookie(cname,session_id231) {
     
    cname.replace("/", "_");
    cname=session_id231+cname;
   var data=sessionStorage.getItem(cname);
   if(data!=null){
     return  data;
   }else{
  return "";
   }
      
}
	
    </script>

<!-- ═══════════════════════════════════════════════════════
     GLOBAL SUB-PANEL UI UPGRADE
     Transforms every AdminLTE small-box panel site-wide.
     No individual panel files need to be touched.
     ═══════════════════════════════════════════════════════ -->
<style>
/* ── Page & content wrapper ── */
.content-wrapper { background: #f0f2f5 !important; }

/* ── Box container ── */
.box {
    border-radius: 16px !important;
    overflow: hidden !important;
    box-shadow: 0 4px 20px rgba(0,0,0,.09) !important;
    border: none !important;
}

/* ── Box header ── */
.box-header.with-border {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
    border-bottom: none !important;
    padding: 14px 20px !important;
    border-radius: 16px 16px 0 0 !important;
}
.box-header.with-border .box-title {
    color: #fff !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    letter-spacing: .3px !important;
}
.box-header.with-border .box-title i   { color: rgba(255,255,255,.8) !important; }
.box-header.with-border h3             { color: #fff !important; }
.box-header.with-border .box-tools > a,
.box-header.with-border .box-tools > button { color: rgba(255,255,255,.75) !important; }

/* ── Box body ── */
.box-body {
    background: #f0f2f5 !important;
    padding: 16px !important;
}
.box-body > [class*="col-"] { padding: 8px !important; margin-bottom: 0 !important; }

/* ── Small-box → modern card ── */
.small-box {
    border-radius: 14px !important;
    overflow: hidden !important;
    cursor: pointer !important;
    margin-bottom: 0 !important;
    box-shadow: 0 4px 18px rgba(0,0,0,.15) !important;
    background-image: linear-gradient(135deg,
        rgba(255,255,255,.12) 0%,
        transparent           45%,
        rgba(0,0,0,.18)      100%) !important;
    transition: transform .25s cubic-bezier(.34,1.56,.64,1),
                box-shadow  .25s ease !important;
    position: relative !important;
    animation: sbCardIn .45s ease both !important;
}
.small-box:hover {
    transform: translateY(-8px) scale(1.025) !important;
    box-shadow: 0 20px 50px rgba(0,0,0,.26) !important;
}
.small-box:active { transform: translateY(-3px) scale(1.01) !important; }

/* shimmer sweep */
.small-box::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background: linear-gradient(120deg,
        transparent 0%, rgba(255,255,255,.15) 50%, transparent 100%) !important;
    transform: translateX(-130%) !important;
    transition: transform .5s ease !important;
    z-index: 2 !important;
    pointer-events: none !important;
}
.small-box:hover::before { transform: translateX(130%) !important; }

/* ── Injected icon pill ── */
/* ── Icon pill — identical spec to .dash-card-icon ── */
.sb-icon {
    width: 52px !important;
    height: 52px !important;
    border-radius: 14px !important;
    background: rgba(255,255,255,.2) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 14px !important;
    flex-shrink: 0 !important;
    box-shadow: 0 0 0 0 rgba(255,255,255,.35) !important;
    transition: box-shadow .3s, transform .3s !important;
}
.sb-icon i {
    font-size: 24px !important;
    color: #fff !important;
}
.small-box:hover .sb-icon {
    box-shadow: 0 0 0 8px rgba(255,255,255,.15) !important;
    transform: scale(1.1) rotate(-4deg) !important;
}

/* ── Card inner content ── */
.small-box .inner {
    padding: 18px 18px 13px !important;
    position: relative !important;
    z-index: 1 !important;
    display: flex !important;
    flex-direction: column !important;
}
.small-box .inner h3 {
    font-size: 14px !important;
    font-weight: 800 !important;
    color: #fff !important;
    margin: 0 0 4px !important;
    line-height: 1.25 !important;
    letter-spacing: .2px !important;
    text-shadow: 0 1px 4px rgba(0,0,0,.25) !important;
    order: 2 !important;
}
.small-box .inner p {
    font-size: 11px !important;
    color: rgba(255,255,255,.72) !important;
    margin: 0 !important;
    line-height: 1.4 !important;
    order: 3 !important;
}

/* hide AdminLTE oversized background icon & stray <br> spacing */
.small-box .icon { display: none !important; }

/* ── Card footer ── */
.small-box-footer {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 9px 16px !important;
    background: rgba(0,0,0,.18) !important;
    color: rgba(255,255,255,.92) !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    border-top: 1px solid rgba(255,255,255,.1) !important;
    position: relative !important;
    z-index: 1 !important;
    transition: background .2s !important;
    text-decoration: none !important;
    letter-spacing: .2px !important;
}
.small-box-footer:hover,
.small-box-footer:focus { color: #fff !important; text-decoration: none !important; }
.small-box:hover .small-box-footer { background: rgba(0,0,0,.28) !important; }
.small-box-footer .fa { font-size: 13px !important; transition: transform .25s !important; }
.small-box:hover .small-box-footer .fa { transform: translateX(6px) !important; }

/* ── Entrance animation ── */
@keyframes sbCardIn {
    from { opacity: 0; transform: translateY(22px) scale(.96); }
    to   { opacity: 1; transform: translateY(0)    scale(1);   }
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .small-box .inner    { padding: 14px 13px 11px !important; }
    .small-box .inner h3 { font-size: 12.5px !important; }
    .sb-icon   { width: 44px !important; height: 44px !important; border-radius: 12px !important; margin-bottom: 12px !important; }
    .sb-icon i { font-size: 20px !important; }
    .box-body > [class*="col-"] { padding: 6px !important; }
}
</style>

<style>
/* ═══════════════════════════════════════════════
   GLOBAL INPUT / SELECT — NEUTRAL BORDER
   Replaces the old green-border defaults.
   ═══════════════════════════════════════════════ */
input,
input[type="text"],
input[type="number"],
input[type="email"],
input[type="password"],
input[type="date"],
input[type="time"],
input[type="tel"],
input[type="search"],
textarea {
    border: 1.5px solid #d0d5e3 !important;
    border-radius: 8px !important;
    color: #1a2540 !important;
    background: #fff !important;
    box-shadow: none !important;
    transition: border-color .2s, box-shadow .2s !important;
    outline: none !important;
}
input:focus,
textarea:focus {
    border-color: #0f3460 !important;
    background-color: #fff !important;
    color: #1a2540 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
}
select {
    border: 1.5px solid #d0d5e3 !important;
    border-radius: 8px !important;
    color: #1a2540 !important;
    background: #fff !important;
    box-shadow: none !important;
    transition: border-color .2s !important;
}
select:focus {
    border-color: #0f3460 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
    outline: none !important;
}
.form-control {
    border: 1.5px solid #d0d5e3 !important;
    border-radius: 8px !important;
    color: #1a2540 !important;
    box-shadow: none !important;
}
.form-control:focus {
    border-color: #0f3460 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
}
.select2-selection--single {
    border: 1.5px solid #d0d5e3 !important;
    border-radius: 8px !important;
}
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #0f3460 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
}

/* ═══════════════════════════════════════════════
   FORM VALIDATION HELPERS
   ═══════════════════════════════════════════════ */
.is-invalid input,
.is-invalid select,
.is-invalid textarea,
input.is-invalid,
select.is-invalid,
textarea.is-invalid,
.form-control.is-invalid {
    border-color: #e74c3c !important;
    box-shadow: 0 0 0 3px rgba(231,76,60,.12) !important;
}
.field-error  { color: #e74c3c; font-size: 11.5px; margin-top: 3px; display: block; }
.field-success{ color: #27ae60; font-size: 11.5px; margin-top: 3px; display: block; }

/* ═══════════════════════════════════════════════
   SI-PH PAGE HEADER COMPONENT (global)
   Defined once here; individual pages need not
   repeat this block.
   ═══════════════════════════════════════════════ */
.si-ph {
    background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%);
    padding: 14px 24px;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 10px;
    border-bottom: 3px solid #b92b27;
    margin-bottom: 0;
}
.si-ph-left   { display: flex; align-items: center; gap: 13px; }
.si-ph-badge  {
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.si-ph-badge i    { color: #fff; font-size: 16px; }
.si-ph-title      { font-size: 14px; font-weight: 800; color: #fff; margin: 0; line-height: 1.2; text-transform: uppercase; letter-spacing: .5px; }
.si-ph-sub        { font-size: 11px; color: rgba(255,255,255,.65); margin: 2px 0 0; }
.si-ph-bc         { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.si-bc-link       { color: rgba(255,255,255,.75); font-size: 11.5px; text-decoration: none; transition: color .2s; }
.si-bc-link:hover { color: #fff; text-decoration: none; }
.si-bc-sep        { color: rgba(255,255,255,.4); font-size: 9px; }
.si-bc-active     { color: rgba(255,255,255,.95); font-size: 11.5px; font-weight: 600; }

/* ═══════════════════════════════════════════════
   LEGACY content-header → modern appearance
   Makes all 600+ old AdminLTE content-header
   sections look like si-ph without editing them.
   ═══════════════════════════════════════════════ */
section.content-header {
    background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%) !important;
    padding: 14px 24px !important;
    display: flex !important; align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important; gap: 10px !important;
    border-bottom: 3px solid #b92b27 !important;
    margin-bottom: 0 !important;
}
section.content-header > h1 {
    font-size: 14px !important; font-weight: 800 !important;
    color: #fff !important; text-transform: uppercase !important;
    letter-spacing: .5px !important; margin: 0 !important;
}
section.content-header > h1 small {
    color: rgba(255,255,255,.65) !important;
    font-size: 11px !important; font-weight: 400 !important;
}
section.content-header .breadcrumb {
    background: transparent !important; margin: 0 !important; padding: 0 !important;
    display: flex !important; align-items: center !important; gap: 6px !important;
}
section.content-header .breadcrumb > li         { color: rgba(255,255,255,.75) !important; font-size: 11.5px !important; }
section.content-header .breadcrumb > li a       { color: rgba(255,255,255,.75) !important; }
section.content-header .breadcrumb > li a:hover { color: #fff !important; }
section.content-header .breadcrumb > li.active  { color: rgba(255,255,255,.95) !important; font-weight: 600 !important; }
section.content-header .breadcrumb > li + li::before { color: rgba(255,255,255,.4) !important; }

/* ═══════════════════════════════════════════════
   GLOBAL FILTER CARD — st-* components
   Shared across all modern student sub-pages.
   ═══════════════════════════════════════════════ */
.st-filter-card {
    background: #fff; border-radius: 14px;
    box-shadow: 0 2px 12px rgba(15,52,96,.07);
    border: 1px solid rgba(15,52,96,.06);
    overflow: hidden; margin-bottom: 18px;
}
.st-filter-hdr {
    background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%);
    padding: 11px 18px; display: flex; align-items: center; gap: 9px;
    border-bottom: 3px solid #b92b27;
}
.st-filter-hdr-icon {
    width: 28px; height: 28px; border-radius: 7px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
}
.st-filter-hdr-icon i  { color: #fff; font-size: 12px; }
.st-filter-hdr-title   { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .8px; color: #fff; }
.st-filter-body        { padding: 16px 18px; }
.st-filter-row         { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
.st-filter-group       { display: flex; flex-direction: column; gap: 4px; flex: 1; min-width: 140px; }
.st-filter-label       { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #6b7a9a; }
.st-filter-group select,
.st-filter-group input {
    height: 36px !important; padding: 0 10px !important; font-size: 13px !important;
    border: 1.5px solid #dce3ef !important; border-radius: 8px !important;
    color: #1a2540 !important; background: #fff !important; box-shadow: none !important;
}
.st-filter-group select:focus,
.st-filter-group input:focus {
    border-color: #0f3460 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
    background: #fff !important;
}
.st-submit-row  { display: flex; justify-content: flex-end; margin-top: 14px; }
.st-submit-btn  {
    background: linear-gradient(135deg,#0f3460,#16213e);
    color: #fff; border: none; border-radius: 9px;
    padding: 9px 28px; font-size: 13px; font-weight: 700; cursor: pointer;
    letter-spacing: .3px; transition: opacity .2s, transform .15s;
    display: inline-flex; align-items: center; gap: 7px;
}
.st-submit-btn:hover  { opacity: .88; transform: translateY(-1px); }
.st-submit-btn:active { transform: translateY(0); }
.st-result-wrap {
    background: #fff; border-radius: 14px;
    box-shadow: 0 2px 12px rgba(15,52,96,.07);
    border: 1px solid rgba(15,52,96,.06);
    overflow: hidden; padding: 16px 18px;
}

/* ═══════════════════════════════════════════════
   GLOBAL TABLE HEADER STYLE
   ═══════════════════════════════════════════════ */
.table > thead > tr > th {
    background: linear-gradient(135deg,#0f3460,#16213e) !important;
    color: #fff !important; font-size: 11px !important; font-weight: 700 !important;
    text-transform: uppercase !important; letter-spacing: .4px !important;
    border-bottom: none !important; white-space: nowrap !important;
}
</style>

<script>
(function () {

    /* ── Icon keyword map (order = priority: specific first) ── */
    var iconMap = [
        /* Student */
        { k: ['student registration','new admission','student add'],    i: 'fa-user-plus' },
        { k: ['registration list','admission list','student list'],     i: 'fa-list-alt' },
        { k: ['profile update','student profile'],                      i: 'fa-pencil-square-o' },
        { k: ['one click','quick action','bulk action'],                i: 'fa-bolt' },
        { k: ['dropped list','left student','inactive'],                i: 'fa-user-times' },
        { k: ['promotion','promoted'],                                  i: 'fa-arrow-up' },
        { k: ['transfer certificate','tc issue'],                       i: 'fa-file-text-o' },
        { k: ['id card','identity card'],                               i: 'fa-id-card-o' },
        { k: ['marksheet','grade card','result card'],                  i: 'fa-file-text' },
        { k: ['student'],                                               i: 'fa-graduation-cap' },

        /* Attendance */
        { k: ['student attendance fill','mark attendance','fill attendance'], i: 'fa-calendar-check-o' },
        { k: ['student attendance list','attendance record'],           i: 'fa-list-alt' },
        { k: ['staff attendance fill','employee attendance fill'],      i: 'fa-calendar-check-o' },
        { k: ['staff attendance list','employee attendance list'],      i: 'fa-users' },
        { k: ['attendance graphical','attendance graph','attendance chart'], i: 'fa-bar-chart' },
        { k: ['attendance report','monthly attendance'],                i: 'fa-calendar-o' },
        { k: ['attendance'],                                            i: 'fa-calendar-check-o' },

        /* Staff / Employee */
        { k: ['employee add','staff add','add employee'],               i: 'fa-user-plus' },
        { k: ['employee list','staff list'],                            i: 'fa-users' },
        { k: ['salary','payroll','pay slip'],                           i: 'fa-money' },
        { k: ['staff duty','duty chart'],                               i: 'fa-calendar' },
        { k: ['employee','staff'],                                      i: 'fa-user-circle' },

        /* Fees / Finance */
        { k: ['add bank account','bank account'],                       i: 'fa-university' },
        { k: ['account list','ledger'],                                 i: 'fa-book' },
        { k: ['income','receipt'],                                      i: 'fa-arrow-down' },
        { k: ['expense','payment','expenditure'],                       i: 'fa-arrow-up' },
        { k: ['fee collection','collect fee'],                          i: 'fa-credit-card' },
        { k: ['fee list','fee record'],                                  i: 'fa-list' },
        { k: ['fee structure','fee category'],                          i: 'fa-tags' },
        { k: ['dues','outstanding','pending fee'],                      i: 'fa-exclamation-triangle' },
        { k: ['penalty','fine','late fee'],                             i: 'fa-gavel' },
        { k: ['refund'],                                                i: 'fa-undo' },
        { k: ['discount','concession'],                                 i: 'fa-percent' },
        { k: ['transport fee','bus fee'],                               i: 'fa-bus' },
        { k: ['account','finance','transaction'],                       i: 'fa-bar-chart' },
        { k: ['fee','fees'],                                            i: 'fa-credit-card' },

        /* Examination / Academics */
        { k: ['examination schedule','exam schedule'],                  i: 'fa-calendar' },
        { k: ['result','marks entry','marks'],                          i: 'fa-trophy' },
        { k: ['set paper','question paper','paper setter'],             i: 'fa-file-text' },
        { k: ['homework','classwork','assignment'],                     i: 'fa-tasks' },
        { k: ['syllabus'],                                              i: 'fa-book' },
        { k: ['examination','exam'],                                    i: 'fa-pencil-square-o' },
        { k: ['certificate'],                                           i: 'fa-certificate' },

        /* Timetable */
        { k: ['time table','timetable','schedule','class routine'],     i: 'fa-clock-o' },

        /* Enquiry */
        { k: ['new enquiry','add enquiry'],                             i: 'fa-plus-circle' },
        { k: ['enquiry list','inquiry list'],                           i: 'fa-list-alt' },
        { k: ['enquiry sms','enquiry message'],                         i: 'fa-comment' },
        { k: ['enquiry','inquiry'],                                     i: 'fa-comments' },

        /* Events / Calendar */
        { k: ['add event','new event'],                                 i: 'fa-calendar-plus-o' },
        { k: ['event list'],                                            i: 'fa-calendar' },
        { k: ['holiday list','add holiday'],                            i: 'fa-umbrella' },
        { k: ['leave request','apply leave','add leave'],               i: 'fa-plane' },
        { k: ['leave list','leave record'],                             i: 'fa-list' },
        { k: ['sports','tournament','game'],                            i: 'fa-trophy' },
        { k: ['event'],                                                 i: 'fa-calendar-plus-o' },

        /* System / Admin */
        { k: ['important','notice','announcement','alert'],             i: 'fa-bullhorn' },
        { k: ['download','downloadable'],                               i: 'fa-download' },
        { k: ['recycle bin','deleted','trash'],                         i: 'fa-trash-o' },
        { k: ['session','academic year'],                               i: 'fa-refresh' },
        { k: ['govt requirement','government requirement'],             i: 'fa-university' },
        { k: ['reminder'],                                              i: 'fa-bell' },
        { k: ['school info','school setting','general setting'],        i: 'fa-cog' },
        { k: ['login details','login log','user log'],                  i: 'fa-key' },
        { k: ['user right','permission','access control'],              i: 'fa-lock' },
        { k: ['gate pass','visitor pass','visitor'],                    i: 'fa-id-card' },

        /* Add-ons */
        { k: ['bus route','add route','route list'],                    i: 'fa-map-marker' },
        { k: ['bus'],                                                   i: 'fa-bus' },
        { k: ['hostel','room allot','dormitory','bed'],                 i: 'fa-building' },
        { k: ['book issue','book return','issue book'],                 i: 'fa-book' },
        { k: ['library'],                                               i: 'fa-book' },
        { k: ['stock management','inventory control'],                  i: 'fa-archive' },
        { k: ['stock','item','inventory'],                              i: 'fa-cubes' },

        /* Reports & misc */
        { k: ['report','graphical','chart','analysis','statistics'],    i: 'fa-bar-chart' },
        { k: ['print'],                                                 i: 'fa-print' },
        { k: ['search','find','filter'],                                i: 'fa-search' },
        { k: ['import','upload'],                                       i: 'fa-upload' },
        { k: ['export'],                                                i: 'fa-download' },
        { k: ['sms','message'],                                         i: 'fa-comment' },
        { k: ['gallery','photo'],                                       i: 'fa-image' },
        { k: ['health','medical','checkup'],                            i: 'fa-heartbeat' },
        { k: ['map','location'],                                        i: 'fa-map-marker' },
        { k: ['class','section','grade','standard'],                    i: 'fa-sitemap' },
        { k: ['subject'],                                               i: 'fa-book' },
        { k: ['add','new','create','generate'],                         i: 'fa-plus-circle' },
        { k: ['list','record','all'],                                   i: 'fa-list-alt' },
        { k: ['setting','configuration'],                               i: 'fa-cog' },
        { k: ['info','detail','about'],                                 i: 'fa-info-circle' },
        { k: ['transfer','migrate'],                                    i: 'fa-exchange' },
        { k: ['delete','remove'],                                       i: 'fa-trash-o' },
        { k: ['password'],                                              i: 'fa-key' },
        { k: ['contact','phone'],                                       i: 'fa-phone' },
    ];

    function resolveIcon(text) {
        var t = text.toLowerCase().trim();
        for (var m = 0; m < iconMap.length; m++) {
            var keys = iconMap[m].k;
            for (var n = 0; n < keys.length; n++) {
                if (t.indexOf(keys[n]) !== -1) return iconMap[m].i;
            }
        }
        return 'fa-th-large'; /* fallback */
    }

    function injectIcons(root) {
        var boxes = (root || document).querySelectorAll('.box-body .small-box');
        boxes.forEach(function (box) {
            if (box.querySelector('.sb-icon')) return; /* already done */

            var inner = box.querySelector('.inner');
            if (!inner) return;

            /* strip leading <br> tags that were just for spacing */
            var node = inner.firstChild;
            while (node && (node.nodeName === 'BR' ||
                   (node.nodeType === 3 && node.textContent.trim() === ''))) {
                var next = node.nextSibling;
                inner.removeChild(node);
                node = next;
            }

            var h3 = inner.querySelector('h3');
            var title = h3 ? h3.textContent.trim() : '';

            /* also look at the href for extra context */
            var anchor = box.closest('a') || box.parentElement.closest('a');
            var href   = anchor ? (anchor.href || '') : '';
            var combined = title + ' ' + href;

            var iconClass = resolveIcon(combined);

            var pill = document.createElement('div');
            pill.className = 'sb-icon';
            pill.innerHTML = '<i class="fa ' + iconClass + '"></i>';
            inner.insertBefore(pill, inner.firstChild);
        });
    }

    function upgradeCards(root) {
        injectIcons(root);
        /* stagger entrance */
        var boxes = (root || document).querySelectorAll('.box-body .small-box');
        boxes.forEach(function (box, i) {
            box.style.animationDelay = (i * 0.07) + 's';
        });
    }

    document.addEventListener('DOMContentLoaded', function () { upgradeCards(); });

    /* re-run on every AJAX panel load */
    var target = document.getElementById('get_content');
    if (target && window.MutationObserver) {
        new MutationObserver(function () { upgradeCards(target); })
            .observe(target, { childList: true });
    }
}());
</script>

