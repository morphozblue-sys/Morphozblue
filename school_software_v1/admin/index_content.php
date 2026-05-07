<?php
include("attachment/session_index.php");
$fees_category = $_SESSION['fees_category'] ?? '';

$hour = (int)date('H');
if ($hour < 12)      { $greeting = 'Good Morning';   $greeting_icon = '🌅'; }
elseif ($hour < 17)  { $greeting = 'Good Afternoon'; $greeting_icon = '☀️'; }
else                 { $greeting = 'Good Evening';   $greeting_icon = '🌙'; }

$welcome_name  = htmlspecialchars($_SESSION['school_info_principal_name5'] ?? $_SESSION['designation'] ?? 'User');
$welcome_school= htmlspecialchars($_SESSION['school_info_school_name5']    ?? 'School Management System');
$welcome_sess  = str_replace('_', '-', $_SESSION['session37'] ?? '');
$designation   = ucfirst(strtolower($_SESSION['designation'] ?? ''));
?>
<style>
/* ── Base ── */
.dash-wrap { padding: 16px 20px 40px; font-family: 'Source Sans Pro','Helvetica Neue',Arial,sans-serif; background: #f0f2f5; min-height: 80vh; }

/* ── Welcome bar ── */
.dash-welcome {
  position: relative; overflow: hidden;
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;
  background: linear-gradient(135deg,#1a1a2e 0%,#16213e 45%,#0f3460 100%);
  border-radius: 20px; padding: 24px 32px; margin-bottom: 28px;
  box-shadow: 0 10px 40px rgba(15,52,96,.4);
}
/* animated orbs */
.dash-welcome::before,.dash-welcome::after {
  content:''; position:absolute; border-radius:50%; opacity:.12; animation: orbFloat 6s ease-in-out infinite alternate;
}
.dash-welcome::before { width:260px;height:260px; background:radial-gradient(circle,#4f8ef7,transparent); top:-80px;right:120px; }
.dash-welcome::after  { width:180px;height:180px; background:radial-gradient(circle,#b92b27,transparent); bottom:-60px;right:30px; animation-delay:2s; }
@keyframes orbFloat { from{transform:translate(0,0) scale(1);} to{transform:translate(20px,-20px) scale(1.08);} }

.dash-welcome-left { position:relative; z-index:1; }
.dash-welcome-left h2 { margin:0; font-size:23px; font-weight:800; color:#fff; letter-spacing:.3px; }
.dash-welcome-left p  { margin:5px 0 0; font-size:13px; color:rgba(255,255,255,.65); }
.dash-badge {
  display:inline-flex; align-items:center; gap:5px;
  background:rgba(255,255,255,.13); border:1px solid rgba(255,255,255,.2);
  border-radius:20px; padding:3px 12px; font-size:11px; font-weight:700;
  color:rgba(255,255,255,.85); text-transform:uppercase; letter-spacing:.6px; margin-top:10px;
}
.dash-badge i { font-size:10px; }

/* clock */
.dash-clock { text-align:right; position:relative; z-index:1; }
.dash-clock-time { font-size:32px; font-weight:900; color:#fff; letter-spacing:3px; font-variant-numeric:tabular-nums; line-height:1; }
.dash-clock-ampm { font-size:14px; font-weight:700; color:rgba(255,255,255,.6); margin-left:4px; vertical-align:super; }
.dash-clock-date { font-size:12px; color:rgba(255,255,255,.55); margin-top:5px; letter-spacing:.3px; }

/* ── Search ── */
.dash-search-wrap { margin-bottom:24px; }
.dash-search-box {
  display:flex; align-items:center; gap:10px;
  background:#fff; border-radius:12px; padding:10px 16px;
  box-shadow:0 2px 12px rgba(0,0,0,.08); border:2px solid transparent;
  transition:border-color .2s, box-shadow .2s;
}
.dash-search-box:focus-within {
  border-color:#4f8ef7; box-shadow:0 4px 20px rgba(79,142,247,.15);
}
.dash-search-box i { color:#aaa; font-size:15px; flex-shrink:0; }
.dash-search-box input {
  border:none; outline:none; background:transparent; font-size:14px; color:#333;
  flex:1; font-family:inherit;
}
.dash-search-box input::placeholder { color:#bbb; }
.dash-search-clear {
  display:none; align-items:center; justify-content:center;
  width:20px; height:20px; border-radius:50%; background:#e0e0e0;
  color:#666; font-size:14px; cursor:pointer; font-weight:700; flex-shrink:0;
  transition:background .15s;
}
.dash-search-clear:hover { background:#ccc; }
#dash-no-results { display:none; text-align:center; padding:40px 0; color:#aaa; font-size:15px; }

/* ── Section — card wrapper ── */
.dash-section {
  margin-bottom: 20px;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,.1);
}
/* ── Section header — full-width dark gradient bar ── */
.dash-section-header {
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 13px 20px;
  margin-bottom: 0;
}
.dash-sec-badge {
  width:34px; height:34px; border-radius:10px; flex-shrink:0;
  display:flex; align-items:center; justify-content:center;
  background: rgba(255,255,255,.15);
  box-shadow:0 2px 6px rgba(0,0,0,.25);
}
.dash-sec-badge i { font-size:15px; color:#fff; }
.dash-sec-label { font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:#fff; flex:1; }
.dash-sec-count {
  display:inline-flex; align-items:center; justify-content:center;
  width:22px; height:22px; border-radius:50%;
  background: rgba(255,255,255,.18);
  font-size:11px; font-weight:700; color:#fff;
}

/* ── Grid — light body inside section card ── */
.dash-grid {
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(190px,1fr));
  gap:16px;
  padding:16px;
  background:#f0f2f5;
}

/* ── Card ── */
.dash-card {
  position:relative; border-radius:16px; overflow:hidden; cursor:pointer;
  text-decoration:none; display:block;
  box-shadow:0 4px 16px rgba(0,0,0,.1);
  transition:transform .25s cubic-bezier(.34,1.56,.64,1), box-shadow .25s ease;
  opacity:0; animation:dashIn .5s ease forwards;
}
.dash-card:hover {
  transform:translateY(-8px) scale(1.02);
  box-shadow:0 18px 45px var(--glow,rgba(0,0,0,.25));
  text-decoration:none;
}
.dash-card:active { transform:translateY(-3px) scale(1.01); }
.dash-card:hover .dash-card-footer { text-decoration:none; }

/* card inner */
.dash-card-body { padding:22px 18px 16px; position:relative; z-index:1; }

/* icon */
.dash-card-icon {
  width:52px; height:52px; border-radius:14px;
  background:rgba(255,255,255,.2);
  display:flex; align-items:center; justify-content:center;
  margin-bottom:14px;
  box-shadow:0 0 0 0 rgba(255,255,255,.35);
  transition:box-shadow .3s, transform .3s;
}
.dash-card:hover .dash-card-icon {
  box-shadow:0 0 0 8px rgba(255,255,255,.15);
  transform:scale(1.1) rotate(-4deg);
}
.dash-card-icon i { font-size:24px; color:#fff; }

.dash-card-title { font-size:15px; font-weight:800; color:#fff; margin:0 0 3px; line-height:1.25; }
.dash-card-sub   { font-size:11px; color:rgba(255,255,255,.7); margin:0; }

/* card footer */
.dash-card-footer {
  padding:9px 18px; background:rgba(0,0,0,.18);
  font-size:11.5px; color:rgba(255,255,255,.9); font-weight:600;
  display:flex; align-items:center; justify-content:space-between;
  border-top:1px solid rgba(255,255,255,.08);
}
.dash-card-footer .fa { transition:transform .25s; }
.dash-card:hover .dash-card-footer .fa { transform:translateX(5px); }

/* shimmer sweep on hover */
.dash-card::after {
  content:''; position:absolute; inset:0; z-index:2; pointer-events:none;
  background:linear-gradient(120deg,transparent 0%,rgba(255,255,255,.13) 50%,transparent 100%);
  transform:translateX(-120%); transition:transform .45s ease;
}
.dash-card:hover::after { transform:translateX(120%); }

/* ripple */
.ripple-circle {
  position:absolute; border-radius:50%; background:rgba(255,255,255,.28);
  transform:scale(0); animation:ripple .6s linear; pointer-events:none; z-index:3;
}
@keyframes ripple { to { transform:scale(4); opacity:0; } }

/* entrance */
@keyframes dashIn {
  from { opacity:0; transform:translateY(22px) scale(.96); }
  to   { opacity:1; transform:translateY(0)    scale(1); }
}
.dash-card:nth-child(1){ animation-delay:.03s } .dash-card:nth-child(2){ animation-delay:.07s }
.dash-card:nth-child(3){ animation-delay:.11s } .dash-card:nth-child(4){ animation-delay:.15s }
.dash-card:nth-child(5){ animation-delay:.19s } .dash-card:nth-child(6){ animation-delay:.23s }
.dash-card:nth-child(7){ animation-delay:.27s } .dash-card:nth-child(8){ animation-delay:.31s }

/* section entrance */
.dash-section { opacity:0; transform:translateY(16px); transition:opacity .45s ease, transform .45s ease; }
.dash-section.visible { opacity:1; transform:translateY(0) !important; }

/* ── Recently Used ── */
.recent-chip {
  display:inline-flex; align-items:center; gap:5px;
  background:#fff; border:1.5px solid #e8eaf0; border-radius:20px;
  padding:5px 14px; font-size:12px; font-weight:600; color:#444;
  cursor:pointer; text-decoration:none;
  transition:border-color .2s, box-shadow .2s, color .2s;
  box-shadow:0 1px 4px rgba(0,0,0,.06);
}
.recent-chip:hover { border-color:#4f8ef7; color:#4f8ef7; box-shadow:0 3px 12px rgba(79,142,247,.15); text-decoration:none; }
.recent-chip i { font-size:11px; }
.recent-chips { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:24px; }
.recent-chips-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.7px; color:#aaa; margin-bottom:8px; }

/* ── Responsive ── */
@media(max-width:991px){ .dash-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;} }
@media(max-width:600px){
  .dash-grid{grid-template-columns:repeat(2,1fr);gap:10px;}
  .dash-welcome{padding:18px 20px;} .dash-welcome-left h2{font-size:18px;}
  .dash-clock-time{font-size:24px;} .dash-search-box{padding:8px 12px;}
}
@media(max-width:360px){ .dash-grid{grid-template-columns:1fr 1fr;gap:8px;} }
</style>

<!-- Page Header -->
<section class="content-header" style="padding-bottom:0;">
  <h1 style="font-size:20px;font-weight:700;">Dashboard <small>Control panel</small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
<div class="dash-wrap">

  <!-- Welcome Bar -->
  <div class="dash-welcome">
    <div class="dash-welcome-left">
      <h2><?php echo $greeting_icon; ?> <?php echo $greeting; ?>, <?php echo $welcome_name; ?>!</h2>
      <p><?php echo $welcome_school; ?> &nbsp;&bull;&nbsp; Session: <strong style="color:rgba(255,255,255,.85);"><?php echo $welcome_sess; ?></strong></p>
      <div class="dash-badge"><i class="fa fa-shield"></i><?php echo $designation; ?></div>
    </div>
    <div class="dash-clock">
      <div>
        <span class="dash-clock-time" id="dash-time">--:--:--</span>
        <span class="dash-clock-ampm" id="dash-ampm"></span>
      </div>
      <div class="dash-clock-date" id="dash-date"></div>
    </div>
  </div>

  <!-- Search -->
  <div class="dash-search-wrap">
    <div class="dash-search-box">
      <i class="fa fa-search"></i>
      <input type="text" id="dash-search" placeholder="Search modules… (e.g. Attendance, Fees, Library)" autocomplete="off">
      <span class="dash-search-clear" id="dash-search-clear" onclick="dashClearSearch()">&#x2715;</span>
    </div>
    <div id="dash-no-results"><i class="fa fa-search" style="font-size:28px;display:block;margin-bottom:8px;"></i>No modules found</div>
  </div>

  <!-- Recently Used (rendered by JS) -->
  <div id="dash-recent-wrap"></div>

<?php
/* ── helpers ── */
function dash_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
    $t = htmlspecialchars($title, ENT_QUOTES);
    $s = htmlspecialchars($sub,   ENT_QUOTES);
    $l = htmlspecialchars($link,  ENT_QUOTES);
    $i = htmlspecialchars($icon,  ENT_QUOTES);
    $g = htmlspecialchars($grad,  ENT_QUOTES);
    echo '<a href="javascript:get_content(\'' . $link . '\')"
            class="dash-card"
            style="--glow:' . $glow . '"
            data-search="' . strtolower($t . ' ' . $s) . '"
            data-link="'   . $l . '"
            data-title="'  . $t . '"
            data-icon="'   . $i . '"
            data-grad="'   . $g . '">
            <div class="dash-card-body" style="background:' . $grad . '">
              <div class="dash-card-icon"><i class="fa ' . $icon . '"></i></div>
              <p class="dash-card-title">' . $title . '</p>
              <p class="dash-card-sub">'  . $sub   . '</p>
            </div>
            <div class="dash-card-footer" style="background:' . $grad . '">
              <span>' . $sub . '</span><i class="fa fa-arrow-right"></i>
            </div>
          </a>';
}

function dash_section($icon, $label, $badge_grad, $count = 0) {
    $cnt = $count > 0 ? '<span class="dash-sec-count">' . $count . '</span>' : '';
    echo '<div class="dash-section-header">
            <div class="dash-sec-badge" style="background:' . $badge_grad . '">
              <i class="fa ' . $icon . '"></i>
            </div>
            <span class="dash-sec-label">' . htmlspecialchars($label) . '</span>
            ' . $cnt . '
          </div>';
}
?>

  <!-- ═══════════ CORE ═══════════ -->
  <?php
  $panels = ['panel_attendance','panel_enquiry','panel_staff','panel_time_table','panel_student'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0, $panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-th-large','Core Modules','linear-gradient(135deg,#e8414e,#c0102d)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_attendance'])): ?>
        <?php dash_card('attendance_management/attendance_management','linear-gradient(135deg,#e8414e,#b91c2a)','rgba(232,65,78,.45)','fa-calendar-check-o',$language['Attendance'],'Mark & View Attendance'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_enquiry'])): ?>
        <?php dash_card('enquiry/enquiry','linear-gradient(135deg,#2ecc71,#1a9e56)','rgba(46,204,113,.45)','fa-comments',$language['Enquiry'],'Manage Enquiries'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_staff'])): ?>
        <?php dash_card('staff/staff','linear-gradient(135deg,#a855f7,#7e22ce)','rgba(168,85,247,.45)','fa-users',$language['Staff'],'Staff Management'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_time_table'])): ?>
        <?php dash_card('time_table/time_table','linear-gradient(135deg,#38bdf8,#0284c7)','rgba(56,189,248,.45)','fa-clock-o',$language['Time Table'],'View Timetable'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_student'])): ?>
        <?php dash_card('student/students','linear-gradient(135deg,#f97316,#c2410c)','rgba(249,115,22,.45)','fa-graduation-cap',$language['Student'],'Student Records'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ FINANCE ═══════════ -->
  <?php
  $fees_link = $fees_category==='monthly'?'fees_monthly/fees':($fees_category==='yearly'?'fees_yearly/fees':($fees_category==='installmentwise'?'fees_installmentwise/fees':''));
  $panels = ['panel_account','panel_dues','panel_penalty'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels)) + (isset($_SESSION['panel_fees'])&&$fees_link?1:0);
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-rupee','Finance','linear-gradient(135deg,#6366f1,#4338ca)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_account'])): ?>
        <?php dash_card('account/account','linear-gradient(135deg,#6366f1,#4338ca)','rgba(99,102,241,.45)','fa-bar-chart',$language['Account'],'Account Ledger'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_dues'])): ?>
        <?php dash_card('dues/dues','linear-gradient(135deg,#fb923c,#c2410c)','rgba(251,146,60,.45)','fa-exclamation-triangle',$language['Dues'],'Due Records'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_fees'])&&$fees_link): ?>
        <?php dash_card($fees_link,'linear-gradient(135deg,#f43f5e,#9f1239)','rgba(244,63,94,.45)','fa-credit-card',$language['Fees'],'Fee Collection'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_penalty'])): ?>
        <?php dash_card('penalty/penalty','linear-gradient(135deg,#10b981,#065f46)','rgba(16,185,129,.45)','fa-gavel',$language['Penalty'],'Penalty Records'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; if($_SESSION['designation']=='admin'): ?>

  <!-- ═══════════ ACADEMICS ═══════════ -->
  <?php
  $panels = ['panel_certificate','panel_examination','panel_homework','panel_exam_paper_setter'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-book','Academics','linear-gradient(135deg,#8b5cf6,#6d28d9)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_certificate'])): ?>
        <?php dash_card('certificate/certificate','linear-gradient(135deg,#8b5cf6,#6d28d9)','rgba(139,92,246,.45)','fa-certificate',$language['Certificate'],'Issue Certificate'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_examination'])): ?>
        <?php dash_card('examination/examination','linear-gradient(135deg,#ec4899,#be185d)','rgba(236,72,153,.45)','fa-pencil-square-o',$language['Examination'],'Exam Records'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_homework'])): ?>
        <?php dash_card('homework/homework','linear-gradient(135deg,#84cc16,#4d7c0f)','rgba(132,204,22,.45)','fa-tasks','Homework / Classwork','Assignments'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_exam_paper_setter'])): ?>
        <?php dash_card('exam_paper_setter/exam_paper_setter','linear-gradient(135deg,#64748b,#334155)','rgba(100,116,139,.45)','fa-file-text',$language['Set Paper'],'Paper Setter'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ MANAGEMENT ═══════════ -->
  <?php
  $panels = ['panel_event_management','panel_holiday','panel_leave','panel_sports'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-bar-chart','Management','linear-gradient(135deg,#f472b6,#db2777)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_event_management'])): ?>
        <?php dash_card('event_management/event_management','linear-gradient(135deg,#f472b6,#db2777)','rgba(244,114,182,.45)','fa-calendar-plus-o',$language['Event'],'Events & Activities'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_holiday'])): ?>
        <?php dash_card('holiday/holiday','linear-gradient(135deg,#ef4444,#b91c1c)','rgba(239,68,68,.45)','fa-umbrella',$language['Holiday'],'Holiday List'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_leave'])): ?>
        <?php dash_card('leave/leave','linear-gradient(135deg,#fbbf24,#d97706)','rgba(251,191,36,.45)','fa-plane',$language['Leave'],'Leave Requests'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_sports'])): ?>
        <?php dash_card('sports/sports','linear-gradient(135deg,#eab308,#a16207)','rgba(234,179,8,.45)','fa-trophy',$language['Sports'],'Sports Records'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ SYSTEM ═══════════ -->
  <?php
  $panels = ['panel_important','panel_downloads','panel_recycle_bin','panel_session'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-database','System','linear-gradient(135deg,#0ea5e9,#0369a1)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_important'])): ?>
        <?php dash_card('important/important','linear-gradient(135deg,#0ea5e9,#0369a1)','rgba(14,165,233,.45)','fa-bullhorn','Important','Notices & Alerts'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_downloads'])): ?>
        <?php dash_card('downloads/downloads','linear-gradient(135deg,#dc2626,#991b1b)','rgba(220,38,38,.45)','fa-download',$language['Downloads'],'Downloadable Files'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_recycle_bin'])): ?>
        <?php dash_card('recycle_bin/recycle_bin','linear-gradient(135deg,#059669,#064e3b)','rgba(5,150,105,.45)','fa-trash-o',$language['Recycle Bin'],'Deleted Items'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_session'])): ?>
        <?php dash_card('session/session','linear-gradient(135deg,#7c3aed,#5b21b6)','rgba(124,58,237,.45)','fa-calendar',$language['Session'],'Academic Session'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ OTHER ═══════════ -->
  <?php
  $panels = ['panel_govt_requirement','panel_reminder','panel_school_info','panel_utility'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-rocket','Other','linear-gradient(135deg,#06b6d4,#0e7490)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_govt_requirement'])): ?>
        <?php dash_card('govt_requirement/govt_requirement','linear-gradient(135deg,#06b6d4,#0e7490)','rgba(6,182,212,.45)','fa-university',$language['Govt. Requir.'],'Govt. Requirements'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_reminder'])): ?>
        <?php dash_card('reminder/reminder','linear-gradient(135deg,#92400e,#451a03)','rgba(146,64,14,.45)','fa-bell',$language['Reminder'],'Reminders'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_school_info'])): ?>
        <?php dash_card('school_info/school_info','linear-gradient(135deg,#9f1239,#4c0519)','rgba(159,18,57,.45)','fa-cog',$language['School Info'],'School Settings'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_utility'])): ?>
        <?php dash_card('utility/login_details','linear-gradient(135deg,#3b82f6,#1d4ed8)','rgba(59,130,246,.45)','fa-key','Login Details','User Login Log'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ ADD ONS ═══════════ -->
  <?php
  $panels = ['panel_bus','panel_hostel','panel_library','panel_stock'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-puzzle-piece','Add Ons','linear-gradient(135deg,#f59e0b,#b45309)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_bus'])): ?>
        <?php dash_card('bus/bus','linear-gradient(135deg,#f59e0b,#b45309)','rgba(245,158,11,.45)','fa-bus',$language['Bus'],'Bus Management'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_hostel'])): ?>
        <?php dash_card('hostel/hostel','linear-gradient(135deg,#a78bfa,#7c3aed)','rgba(167,139,250,.45)','fa-building',$language['Hostel'],'Hostel Records'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_library'])): ?>
        <?php dash_card('library/library','linear-gradient(135deg,#34d399,#059669)','rgba(52,211,153,.45)','fa-book',$language['Library'],'Library Catalog'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_stock'])): ?>
        <?php dash_card('stock/stock','linear-gradient(135deg,#374151,#111827)','rgba(55,65,81,.45)','fa-cubes',$language['Stock'],'Stock Register'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ═══════════ ADMIN & SUPPORT ═══════════ -->
  <?php
  $panels = ['panel_user_right','panel_gate_pass','panel_stock_management'];
  $cnt = array_sum(array_map(fn($p)=>isset($_SESSION[$p])?1:0,$panels));
  if($cnt): ?>
  <div class="dash-section">
    <?php dash_section('fa-shield','Admin & Support','linear-gradient(135deg,#2563eb,#1e3a8a)',$cnt); ?>
    <div class="dash-grid">
      <?php if(isset($_SESSION['panel_user_right'])): ?>
        <?php dash_card('user_right/user_right','linear-gradient(135deg,#2563eb,#1e3a8a)','rgba(37,99,235,.45)','fa-lock',$language['USER RIGHTS'],'User Permissions'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_gate_pass'])): ?>
        <?php dash_card('gate_pass/gate_pass','linear-gradient(135deg,#818cf8,#4f46e5)','rgba(129,140,248,.45)','fa-id-card','Gate Pass','Visitor Pass'); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['panel_stock_management'])): ?>
        <?php dash_card('stock_management/stock_management','linear-gradient(135deg,#0d9488,#134e4a)','rgba(13,148,136,.45)','fa-archive','Stock Management','Inventory Control'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php endif; // end designation==admin ?>

</div><!-- /.dash-wrap -->
</section>

<script>
/* ── Live clock ── */
(function tick() {
  var now    = new Date();
  var hh     = now.getHours();
  var mm     = String(now.getMinutes()).padStart(2,'0');
  var ss     = String(now.getSeconds()).padStart(2,'0');
  var ampm   = hh >= 12 ? 'PM' : 'AM';
  hh = hh % 12 || 12;
  var days   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  var te = document.getElementById('dash-time');
  var ae = document.getElementById('dash-ampm');
  var de = document.getElementById('dash-date');
  if (te) te.textContent = String(hh).padStart(2,'0') + ':' + mm + ':' + ss;
  if (ae) ae.textContent = ampm;
  if (de) de.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
  setTimeout(tick, 1000);
})();

/* ── Ripple ── */
document.addEventListener('click', function(e) {
  var card = e.target.closest('.dash-card');
  if (!card) return;
  var r    = document.createElement('span');
  r.className = 'ripple-circle';
  var rect = card.getBoundingClientRect();
  var size = Math.max(rect.width, rect.height) * 2;
  r.style.cssText = 'width:'+size+'px;height:'+size+'px;left:'+(e.clientX-rect.left-size/2)+'px;top:'+(e.clientY-rect.top-size/2)+'px;';
  card.appendChild(r);
  setTimeout(function(){ r.remove(); }, 650);
  /* save to recently used */
  var link  = card.dataset.link;
  var title = card.dataset.title;
  var icon  = card.dataset.icon;
  var grad  = card.dataset.grad;
  if (link) saveRecent(link, title, icon, grad);
});

/* ── Recently Used ── */
function saveRecent(link, title, icon, grad) {
  var key    = 'dash_recent';
  var recent = JSON.parse(localStorage.getItem(key) || '[]');
  recent     = recent.filter(function(r){ return r.link !== link; });
  recent.unshift({ link:link, title:title, icon:icon, grad:grad });
  recent     = recent.slice(0, 5);
  localStorage.setItem(key, JSON.stringify(recent));
}

function renderRecent() {
  var recent = JSON.parse(localStorage.getItem('dash_recent') || '[]');
  var wrap   = document.getElementById('dash-recent-wrap');
  if (!wrap || recent.length === 0) return;
  var html = '<div class="recent-chips-label"><i class="fa fa-history" style="margin-right:5px;"></i>Recently Used</div><div class="recent-chips">';
  recent.forEach(function(r) {
    html += '<a href="javascript:get_content(\'' + r.link + '\')" class="recent-chip">'
          + '<i class="fa ' + (r.icon||'fa-circle') + '" style="color:#888;"></i>'
          + r.title
          + '</a>';
  });
  html += '</div>';
  wrap.innerHTML = html;
}
renderRecent();

/* ── Search ── */
document.getElementById('dash-search').addEventListener('input', function() {
  var q       = this.value.toLowerCase().trim();
  var cards   = document.querySelectorAll('.dash-card');
  var clear   = document.getElementById('dash-search-clear');
  var noRes   = document.getElementById('dash-no-results');
  clear.style.display = q ? 'flex' : 'none';
  var totalVisible = 0;
  cards.forEach(function(c) {
    var match = !q || (c.dataset.search || '').includes(q);
    c.style.display = match ? '' : 'none';
    if (match) totalVisible++;
  });
  document.querySelectorAll('.dash-section').forEach(function(sec) {
    var vis = sec.querySelectorAll('.dash-card:not([style*="display: none"])').length;
    sec.style.display = (q && vis === 0) ? 'none' : '';
  });
  noRes.style.display = (q && totalVisible === 0) ? 'block' : 'none';
});

function dashClearSearch() {
  var inp = document.getElementById('dash-search');
  inp.value = '';
  inp.dispatchEvent(new Event('input'));
  inp.focus();
}

/* ── Scroll entrance (IntersectionObserver) ── */
var observer = new IntersectionObserver(function(entries) {
  entries.forEach(function(en) {
    if (en.isIntersecting) {
      en.target.classList.add('visible');
      observer.unobserve(en.target);
    }
  });
}, { threshold: 0.08 });
document.querySelectorAll('.dash-section').forEach(function(s){ observer.observe(s); });
</script>
