<?php include("../attachment/session.php");
$qry = "select * from school_info_general";
$rest = mysqli_query($conn73, $qry);
while ($row22 = mysqli_fetch_assoc($rest)) {
    $fees_type     = $row22['fees_type'];
    $fees_category = $row22['fees_category'];
}
?>
<script>window.scrollTo(0, 0);</script>
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

<!-- Page Header — all .si-ph CSS is in attachment/footer.php (global) -->

<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge">
      <i class="fa fa-graduation-cap"></i>
    </div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['School Information Management']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>

  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')">
      <i class="fa fa-home"></i> Home
    </a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('school_info/school_info')">
      <i class="fa fa-university"></i> <?php echo $language['School Info']; ?>
    </a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active">
      <i class="fa fa-th-large"></i> Main Panel
    </span>
  </nav>
</section>

<section class="content">
<div class="dash-wrap">

<?php
function si_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
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

function si_section($icon, $label, $badge_grad, $count = 0) {
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

  <!-- ═══ SCHOOL SETUP ═══ -->
  <div class="dash-section">
    <?php si_section('fa-university', 'School Setup', 'linear-gradient(135deg,#e8414e,#c0102d)', 8); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_school_info_general'])) : ?>
        <?php si_card('school_info/school_info_general',
          'linear-gradient(135deg,#e8414e,#c0102d)', 'rgba(232,65,78,.45)',
          'fa-info-circle', $language['School General Info'], 'Edit Info'); ?>
      <?php endif; ?>

      <?php if (in_array($_SESSION['board_change'], ['State Board','MP Board','Bihar Board','Rajsthan Board','UP Board','CG Board'])) : ?>
        <?php if (!isset($_SESSION['panel_exam_type_add'])) : ?>
          <?php si_card('school_info/exam_type_add',
            'linear-gradient(135deg,#2ecc71,#1a9e56)', 'rgba(46,204,113,.45)',
            'fa-pencil-square', $language['Examination Type'], 'State Board'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($_SESSION['board_change'] == 'CBSE Board') : ?>
        <?php if (!isset($_SESSION['sub_panel_exam_type_add'])) : ?>
          <?php si_card('school_info/exam_type_add_cbse',
            'linear-gradient(135deg,#27ae60,#1a7a42)', 'rgba(39,174,96,.45)',
            'fa-pencil-square', 'Exam Type CBSE', 'CBSE Board'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['school_info_sub_panel_add_exam_type_monthly'])) : ?>
        <?php si_card('school_info/exam_type_add_monthly',
          'linear-gradient(135deg,#f59e0b,#d97706)', 'rgba(245,158,11,.45)',
          'fa-calendar', 'Exam Type Monthly', 'Monthly Exams'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_add_section'])) : ?>
        <?php si_card('school_info/add_section',
          'linear-gradient(135deg,#d97706,#92400e)', 'rgba(217,119,6,.45)',
          'fa-columns', $language['Add Section'], 'Manage Sections'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_add_class_stream'])) : ?>
        <?php si_card('school_info/add_class_stream',
          'linear-gradient(135deg,#3B3B6D,#1a1a3e)', 'rgba(59,59,109,.45)',
          'fa-code-fork', $language['Add Stream'], 'Manage Streams'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_add_stream_group'])) : ?>
        <?php si_card('school_info/add_stream_group',
          'linear-gradient(135deg,#f97316,#c2410c)', 'rgba(249,115,22,.45)',
          'fa-object-group', $language['Add Group'], 'Manage Groups'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_total_list'])) : ?>
        <?php si_card('school_info/total_list',
          'linear-gradient(135deg,#65a30d,#3f6212)', 'rgba(101,163,13,.45)',
          'fa-database', $language['School Data'], 'View Data'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ SUBJECTS & CURRICULUM ═══ -->
  <div class="dash-section">
    <?php si_section('fa-book', 'Subjects &amp; Curriculum', 'linear-gradient(135deg,#804040,#5c2c2c)', 4); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_subject_add'])) : ?>
        <?php si_card('school_info/subject_add',
          'linear-gradient(135deg,#804040,#5c2c2c)', 'rgba(128,64,64,.45)',
          'fa-book', $language['Add Subject'], 'Manage Subjects'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_class_wise_subject'])) : ?>
        <?php si_card('school_info/class_wise_subject',
          'linear-gradient(135deg,#34B334,#1f7a1f)', 'rgba(52,179,52,.45)',
          'fa-list-alt', $language['Class wise Subject'], 'Assign Subjects'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['school_info_sub_panel_syllebus_detail'])) : ?>
        <?php si_card('school_info/student_syllabus_details',
          'linear-gradient(135deg,#334155,#1e293b)', 'rgba(51,65,85,.45)',
          'fa-file-text', 'Syllabus Details', 'View Syllabus'); ?>
      <?php endif; ?>

      <?php if ($_SESSION['software_link'] == 'eagleschoolkhaplu') : ?>
        <?php si_card('school_info/subject_category_add',
          'linear-gradient(135deg,#008800,#005200)', 'rgba(0,136,0,.45)',
          'fa-tags', 'Subject Category Add', 'Manage Categories'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ FEE CONFIGURATION ═══ -->
  <div class="dash-section">
    <?php si_section('fa-money', 'Fee Configuration', 'linear-gradient(135deg,#551B8C,#3b1260)', 4); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_fee_types_add'])) : ?>
        <?php if (($fees_type == 'installmentwise' || $fees_type == 'monthly') && $fees_category == 'new_fees') : ?>
          <?php si_card('school_info/fee_types_add_new_fees',
            'linear-gradient(135deg,#551B8C,#3b1260)', 'rgba(85,27,140,.45)',
            'fa-tag', $language['Add Fee Type'], 'Manage Fee Types'); ?>
        <?php else : ?>
          <?php si_card('school_info/fee_types_add',
            'linear-gradient(135deg,#551B8C,#3b1260)', 'rgba(85,27,140,.45)',
            'fa-tag', $language['Add Fee Type'], 'Manage Fee Types'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_discount_types_add'])) : ?>
        <?php si_card('school_info/discount_types_add',
          'linear-gradient(135deg,#915C83,#6b3a5e)', 'rgba(145,92,131,.45)',
          'fa-minus-circle', $language['Add Discount Type'], 'Manage Discounts'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['school_info_sub_panel_add_fee_category'])) : ?>
        <?php si_card('school_info/fee_category_add',
          'linear-gradient(135deg,#716B70,#4a4548)', 'rgba(113,107,112,.45)',
          'fa-folder', 'Add Fee Category', 'Manage Categories'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['school_info_sub_panel_add_bus_fee_category'])) : ?>
        <?php if (($fees_type == 'installmentwise' || $fees_type == 'monthly') && $fees_category != 'new_fees') : ?>
          <?php si_card('school_info/add_bus_fee_category_monthly_installmentwise',
            'linear-gradient(135deg,#1D8A73,#0e5a4a)', 'rgba(29,138,115,.45)',
            'fa-bus', 'Add Bus Fee Category', 'Monthly/Installment'); ?>
        <?php elseif (($fees_type == 'installmentwise' || $fees_type == 'monthly') && $fees_category == 'new_fees') : ?>
          <?php si_card('school_info/add_bus_fee_category_new_fees',
            'linear-gradient(135deg,#1D8A73,#0e5a4a)', 'rgba(29,138,115,.45)',
            'fa-bus', 'Add Bus Fee Category', 'New Fees'); ?>
        <?php else : ?>
          <?php si_card('school_info/add_bus_fee_category',
            'linear-gradient(135deg,#1D8A73,#0e5a4a)', 'rgba(29,138,115,.45)',
            'fa-bus', 'Add Bus Fee Category', 'Manage Bus Fees'); ?>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ REPORTS & IDENTITY ═══ -->
  <div class="dash-section">
    <?php si_section('fa-calendar', 'Reports &amp; Identity', 'linear-gradient(135deg,#171F63,#0c1240)', 2); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['school_info_sub_panel_std_identity_category'])) : ?>
        <?php si_card('school_info/add_student_identity_category',
          'linear-gradient(135deg,#3B3B6D,#1a1a3e)', 'rgba(59,59,109,.45)',
          'fa-id-card', 'Std. Identity Category', 'Manage Categories'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['add_bus_fee_category_acadmic_calender'])) : ?>
        <?php si_card('school_info/academic_calender',
          'linear-gradient(135deg,#171F63,#0c1240)', 'rgba(23,31,99,.45)',
          'fa-calendar', 'Academic Calender', 'View Calendar'); ?>
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
