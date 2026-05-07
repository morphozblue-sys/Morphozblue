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
<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-graduation-cap"></i></div>
    <div>
      <h1 class="si-ph-title">Student Management</h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-graduation-cap"></i> Student Management</span>
  </nav>
</section>

<section class="content">
<div class="dash-wrap">

<?php
function stu_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
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

function stu_section($icon, $label, $badge_grad, $count = 0) {
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

  <!-- ═══ STUDENT MANAGEMENT ═══ -->
  <div class="dash-section">
    <?php stu_section('fa-graduation-cap', 'Student Management', 'linear-gradient(135deg,#e8414e,#c0102d)', 8); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_student_registration'])) : ?>
        <?php stu_card('student/student_registration',
          'linear-gradient(135deg,#e8414e,#c0102d)', 'rgba(232,65,78,.45)',
          'fa-user-plus', $language['Registration'], 'New Registration'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_student_registration_list'])) : ?>
        <?php stu_card('student/student_registration_list',
          'linear-gradient(135deg,#2ecc71,#1a9e56)', 'rgba(46,204,113,.45)',
          'fa-list-alt', $language['Registration List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_student_admission_list'])) : ?>
        <?php stu_card('student/student_admission_list',
          'linear-gradient(135deg,#9F2B68,#7B1D4F)', 'rgba(159,43,104,.45)',
          'fa-graduation-cap', $language['Admission List'], 'View Admissions'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_student_action'])) : ?>
        <?php stu_card('student/student_action',
          'linear-gradient(135deg,#34B334,#1f7a1f)', 'rgba(52,179,52,.45)',
          'fa-bolt', $language['One Click'], 'Quick Action'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_profile_update'])) : ?>
        <?php stu_card('student/student_profile_update',
          'linear-gradient(135deg,#1e3a8a,#0f2060)', 'rgba(30,58,138,.45)',
          'fa-user-circle', 'Profile Update', 'Update Profile'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_mapping_data_update'])) : ?>
        <?php stu_card('student/student_mapping_data_update',
          'linear-gradient(135deg,#e05c5c,#b91c1c)', 'rgba(224,92,92,.45)',
          'fa-map-marker', 'Mapping Data Update', 'Update Mapping'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_photo_update'])) : ?>
        <?php stu_card('student/student_photo_update',
          'linear-gradient(135deg,#d97706,#a05a04)', 'rgba(217,119,6,.45)',
          'fa-camera', 'Photo Update', 'Update Photo'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_student_roll_no'])) : ?>
        <?php stu_card('student/student_roll_no',
          'linear-gradient(135deg,#f97316,#c2410c)', 'rgba(249,115,22,.45)',
          'fa-sort-numeric-asc', $language['Roll No Generate'], 'Generate Roll No'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ ID CARDS ═══ -->
  <div class="dash-section">
    <?php stu_section('fa-id-card', 'ID Card Generation', 'linear-gradient(135deg,#804040,#5c2c2c)', 4); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_student_id_card'])) : ?>
        <?php stu_card('student/student_id_card',
          'linear-gradient(135deg,#804040,#5c2c2c)', 'rgba(128,64,64,.45)',
          'fa-id-card', 'Student ' . $language['Id Generate'], 'Generate ID'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_guardian_id_card'])) : ?>
        <?php stu_card('student/guardian_student_id_card',
          'linear-gradient(135deg,#e8622a,#b83a0a)', 'rgba(232,98,42,.45)',
          'fa-id-card', 'Guardian Id Generate', 'Generate ID'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_father_id_card'])) : ?>
        <?php stu_card('student/father_student_id_card',
          'linear-gradient(135deg,#06b6d4,#0284c7)', 'rgba(6,182,212,.45)',
          'fa-id-card', 'Father Id Generate', 'Generate ID'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_mother_id_card'])) : ?>
        <?php stu_card('student/mother_student_id_card',
          'linear-gradient(135deg,#02C87A,#018a52)', 'rgba(2,200,122,.45)',
          'fa-id-card', 'Mother Id Generate', 'Generate ID'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ HEALTH & FITNESS ═══ -->
  <div class="dash-section">
    <?php stu_section('fa-heartbeat', 'Health &amp; Fitness', 'linear-gradient(135deg,#551B8C,#3b1260)', 2); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_health_zone'])) : ?>
        <?php stu_card('student/health_zone',
          'linear-gradient(135deg,#551B8C,#3b1260)', 'rgba(85,27,140,.45)',
          'fa-heartbeat', $language['Medical Fitness'], 'Health Records'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_physical_fitness'])) : ?>
        <?php stu_card('student/physical_fitness',
          'linear-gradient(135deg,#4a7fa8,#2a5f88)', 'rgba(74,127,168,.45)',
          'fa-child', $language['Physical Fitness'], 'Fitness Records'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ REPORTS ═══ -->
  <div class="dash-section">
    <?php stu_section('fa-bar-chart', 'Reports', 'linear-gradient(135deg,#92400e,#451a03)', 6); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['student_sub_panel_student_strength_castwise'])) : ?>
        <?php stu_card('student/report_student_strength_castewise',
          'linear-gradient(135deg,#d4a017,#8a6500)', 'rgba(212,160,23,.45)',
          'fa-bar-chart', 'Strength Castewise', 'View Report'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['student_sub_panel_student_strength_religionwise'])) : ?>
        <?php stu_card('student/report_student_strength_religionwise',
          'linear-gradient(135deg,#4617a0,#2e0d6e)', 'rgba(70,23,160,.45)',
          'fa-bar-chart', 'Strength Religionwise', 'View Report'); ?>
      <?php endif; ?>

      <?php stu_card('student/student_registration_report',
        'linear-gradient(135deg,#64748b,#334155)', 'rgba(100,116,139,.45)',
        'fa-file-text', 'Student Registration', 'View Report'); ?>

      <?php stu_card('student/report_student_strength_agewise',
        'linear-gradient(135deg,#800000,#5a0000)', 'rgba(128,0,0,.45)',
        'fa-bar-chart', 'Agewise Strength-1', 'View Report'); ?>

      <?php stu_card('student/report_student_strength_agewise_total',
        'linear-gradient(135deg,#008000,#005200)', 'rgba(0,128,0,.45)',
        'fa-bar-chart', 'Agewise Strength-2', 'View Report'); ?>

      <?php stu_card('student/report_student_strength_agewise_vertical',
        'linear-gradient(135deg,#1e3a8a,#0f2060)', 'rgba(30,58,138,.45)',
        'fa-bar-chart', 'Agewise Strength-3', 'View Report'); ?>

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
