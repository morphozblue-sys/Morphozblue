<?php include("../attachment/session.php"); ?>
<style>
/* ── Base ── */
.dash-wrap { padding:16px 20px 40px; font-family:'Source Sans Pro','Helvetica Neue',Arial,sans-serif; background:#f0f2f5; min-height:80vh; }

/* ── Section card ── */
.dash-section { margin-bottom:20px; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.1); opacity:0; transform:translateY(16px); transition:opacity .45s ease,transform .45s ease; }
.dash-section.visible { opacity:1; transform:translateY(0); }

/* ── Section header — dark gradient bar ── */
.dash-section-header { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); display:flex; align-items:center; gap:12px; padding:13px 20px; }
.dash-sec-badge { width:34px; height:34px; border-radius:10px; flex-shrink:0; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,.15); box-shadow:0 2px 6px rgba(0,0,0,.25); }
.dash-sec-badge i { font-size:15px; color:#fff; }
.dash-sec-label { font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:#fff; flex:1; }
.dash-sec-count { display:inline-flex; align-items:center; justify-content:center; width:22px; height:22px; border-radius:50%; background:rgba(255,255,255,.18); font-size:11px; font-weight:700; color:#fff; }

/* ── Grid ── */
.dash-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:16px; padding:16px; background:#f0f2f5; }

/* ── Card ── */
.dash-card { position:relative; border-radius:16px; overflow:hidden; cursor:pointer; text-decoration:none; display:block; box-shadow:0 4px 16px rgba(0,0,0,.1); transition:transform .25s cubic-bezier(.34,1.56,.64,1),box-shadow .25s ease; opacity:0; animation:dashIn .5s ease forwards; }
.dash-card:hover { transform:translateY(-8px) scale(1.02); box-shadow:0 18px 45px var(--glow,rgba(0,0,0,.25)); text-decoration:none; }
.dash-card:active { transform:translateY(-3px) scale(1.01); }

/* card body */
.dash-card-body { padding:22px 18px 16px; position:relative; z-index:1; }

/* icon */
.dash-card-icon { width:52px; height:52px; border-radius:14px; background:rgba(255,255,255,.2); display:flex; align-items:center; justify-content:center; margin-bottom:14px; box-shadow:0 0 0 0 rgba(255,255,255,.35); transition:box-shadow .3s,transform .3s; }
.dash-card:hover .dash-card-icon { box-shadow:0 0 0 8px rgba(255,255,255,.15); transform:scale(1.1) rotate(-4deg); }
.dash-card-icon i { font-size:24px; color:#fff; }

.dash-card-title { font-size:15px; font-weight:800; color:#fff; margin:0 0 3px; line-height:1.25; }
.dash-card-sub   { font-size:11px; color:rgba(255,255,255,.7); margin:0; }

/* card footer */
.dash-card-footer { padding:9px 18px; background:rgba(0,0,0,.18); font-size:11.5px; color:rgba(255,255,255,.9); font-weight:600; display:flex; align-items:center; justify-content:space-between; border-top:1px solid rgba(255,255,255,.08); }
.dash-card-footer .fa { transition:transform .25s; }
.dash-card:hover .dash-card-footer .fa { transform:translateX(5px); }
.dash-card:hover .dash-card-footer { text-decoration:none; }

/* shimmer */
.dash-card::after { content:''; position:absolute; inset:0; z-index:2; pointer-events:none; background:linear-gradient(120deg,transparent 0%,rgba(255,255,255,.13) 50%,transparent 100%); transform:translateX(-120%); transition:transform .45s ease; }
.dash-card:hover::after { transform:translateX(120%); }

/* ripple */
.ripple-circle { position:absolute; border-radius:50%; background:rgba(255,255,255,.28); transform:scale(0); animation:ripple .6s linear; pointer-events:none; z-index:3; }
@keyframes ripple { to { transform:scale(4); opacity:0; } }

/* entrance */
@keyframes dashIn { from{opacity:0;transform:translateY(22px) scale(.96);} to{opacity:1;transform:translateY(0) scale(1);} }
.dash-card:nth-child(1){animation-delay:.03s} .dash-card:nth-child(2){animation-delay:.07s}
.dash-card:nth-child(3){animation-delay:.11s} .dash-card:nth-child(4){animation-delay:.15s}
.dash-card:nth-child(5){animation-delay:.19s} .dash-card:nth-child(6){animation-delay:.23s}
.dash-card:nth-child(7){animation-delay:.27s} .dash-card:nth-child(8){animation-delay:.31s}

@media(max-width:991px){ .dash-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;} }
@media(max-width:600px){ .dash-grid{grid-template-columns:repeat(2,1fr);gap:10px;} }
</style>

<!-- Page Header -->
<section class="content-header">
  <h1><?php echo $language['Employee Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-users"></i> <?php echo $language['Employee']; ?></a></li>
    <li class="active">Main Panel</li>
  </ol>
</section>

<section class="content">
<div class="dash-wrap">

<?php
function stf_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
    echo '<a href="javascript:get_content(\'' . $link . '\')"
            class="dash-card"
            style="--glow:' . $glow . '"
            onclick="dashRipple(event,this)">
            <div class="dash-card-body" style="background:' . $grad . '">
              <div class="dash-card-icon"><i class="fa ' . $icon . '"></i></div>
              <p class="dash-card-title">' . htmlspecialchars($title) . '</p>
              <p class="dash-card-sub">'  . htmlspecialchars($sub)   . '</p>
            </div>
            <div class="dash-card-footer" style="background:' . $grad . '">
              <span>' . htmlspecialchars($sub) . '</span>
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>';
}

function stf_section($icon, $label, $badge_grad, $count = 0) {
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

  <!-- ═══ EMPLOYEE MANAGEMENT ═══ -->
  <div class="dash-section">
    <?php stf_section('fa-users', 'Employee Management', 'linear-gradient(135deg,#e8414e,#c0102d)', 4); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_attendance_employee_add'])) : ?>
        <?php stf_card('staff/employee_add',
          'linear-gradient(135deg,#e8414e,#c0102d)', 'rgba(232,65,78,.45)',
          'fa-user-plus', $language['Employee Add'], 'Add Employee'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_attendance_employee_list'])) : ?>
        <?php stf_card('staff/employee_list',
          'linear-gradient(135deg,#2ecc71,#1a9e56)', 'rgba(46,204,113,.45)',
          'fa-users', $language['Employee List'], 'View All Employees'); ?>

        <?php stf_card('staff/employee_drop_list',
          'linear-gradient(135deg,#0d9488,#0f766e)', 'rgba(13,148,136,.45)',
          'fa-user-times', 'Dropped List', 'Dropped Employees'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['staff_sub_panel_id_generate'])) : ?>
        <?php stf_card('staff/staff_id_card',
          'linear-gradient(135deg,#92400e,#78350f)', 'rgba(146,64,14,.45)',
          'fa-id-card', $language['Id Generate'], 'Generate ID Card'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ ATTENDANCE & PAYROLL ═══ -->
  <div class="dash-section">
    <?php stf_section('fa-calendar-check-o', 'Attendance &amp; Payroll', 'linear-gradient(135deg,#9333ea,#7e22ce)', 4); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_emp_attendance_select'])) : ?>
        <?php if ($_SESSION['software_link'] == 'eagleschoolkhaplu') : ?>
          <?php stf_card('attendance_management/emp_attendance_fill',
            'linear-gradient(135deg,#9333ea,#7e22ce)', 'rgba(147,51,234,.45)',
            'fa-calendar-check-o', $language['Attendance'], 'Mark Attendance'); ?>
        <?php else : ?>
          <?php stf_card('attendance/emp_attendance_select',
            'linear-gradient(135deg,#9333ea,#7e22ce)', 'rgba(147,51,234,.45)',
            'fa-calendar-check-o', $language['Attendance'], 'Mark Attendance'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_emp_salary_list'])) : ?>
        <?php stf_card('staff/emp_salary_list',
          'linear-gradient(135deg,#f59e0b,#d97706)', 'rgba(245,158,11,.45)',
          'fa-money', $language['Salary Details'], 'View Salary'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['staff_sub_panel_attendance_registr'])) : ?>
        <?php stf_card('staff/emp_attendance_register',
          'linear-gradient(135deg,#64748b,#334155)', 'rgba(100,116,139,.45)',
          'fa-book', 'Attendance Register', 'View Register'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['staff_sub_panel_attendance_prority'])) : ?>
        <?php stf_card('staff/emp_attendance_priority',
          'linear-gradient(135deg,#06b6d4,#0284c7)', 'rgba(6,182,212,.45)',
          'fa-sort-amount-asc', 'Attendance Priority', 'Set Priority'); ?>
      <?php endif; ?>

    </div>
  </div>

</div><!-- /.dash-wrap -->
</section>

<script>
function dashRipple(e, card) {
  var r = document.createElement('span');
  r.className = 'ripple-circle';
  var rect = card.getBoundingClientRect();
  var size = Math.max(rect.width, rect.height) * 2;
  r.style.cssText = 'width:'+size+'px;height:'+size+'px;left:'+(e.clientX-rect.left-size/2)+'px;top:'+(e.clientY-rect.top-size/2)+'px;';
  card.appendChild(r);
  setTimeout(function(){ r.remove(); }, 650);
}
var io = new IntersectionObserver(function(entries) {
  entries.forEach(function(en) {
    if (en.isIntersecting) { en.target.classList.add('visible'); io.unobserve(en.target); }
  });
}, { threshold: 0.08 });
document.querySelectorAll('.dash-section').forEach(function(s){ io.observe(s); });
</script>
