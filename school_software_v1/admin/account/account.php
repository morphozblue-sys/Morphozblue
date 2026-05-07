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
  <h1><?php echo $language['Account Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('account/account')"><i class="fa fa-university"></i> <?php echo $language['Account']; ?></a></li>
    <li class="active">Main Panel</li>
  </ol>
</section>

<section class="content">
<div class="dash-wrap">

<?php
function acc_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
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

function acc_section($icon, $label, $badge_grad, $count = 0) {
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

  <!-- ═══ MAIN PANEL ═══ -->
  <div class="dash-section">
    <?php acc_section('fa-university', 'Main Panel', 'linear-gradient(135deg,#e8414e,#c0102d)', 7); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_add_account'])) : ?>
        <?php acc_card('account/add_account',
          'linear-gradient(135deg,#e8414e,#c0102d)', 'rgba(232,65,78,.45)',
          'fa-university', $language['Add Bank Account'], 'Add Account'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_account_list'])) : ?>
        <?php acc_card('account/account_list',
          'linear-gradient(135deg,#2ecc71,#1a9e56)', 'rgba(46,204,113,.45)',
          'fa-list-alt', $language['Account List'], 'View Accounts'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_add_income_or_expence_info'])) : ?>
        <?php if ($_SESSION['database_name1'] == 'livingstonenagaland') : ?>
          <?php acc_card('account/add_refund_info',
            'linear-gradient(135deg,#9F2B68,#7B1D4F)', 'rgba(159,43,104,.45)',
            'fa-undo', 'Add Refund', 'Add Entry'); ?>
          <?php acc_card('account/refund_info_list',
            'linear-gradient(135deg,#be185d,#9d174d)', 'rgba(190,24,93,.45)',
            'fa-list-alt', 'Refund List', 'View Refunds'); ?>
        <?php endif; ?>
        <?php acc_card('account/add_income_or_expence_info',
          'linear-gradient(135deg,#9333ea,#7e22ce)', 'rgba(147,51,234,.45)',
          'fa-plus-circle', 'Add Income/Expense', 'Add Entry'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_income_or_expence_list'])) : ?>
        <?php acc_card('account/income_or_expence_list',
          'linear-gradient(135deg,#d97706,#92400e)', 'rgba(217,119,6,.45)',
          'fa-exchange', 'Income/Expense List', 'View Entries'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_ledger'])) : ?>
        <?php acc_card('account/ledger',
          'linear-gradient(135deg,#3B3B6D,#1a1a3e)', 'rgba(59,59,109,.45)',
          'fa-book', $language['Ledger Info'], 'View Ledger'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ REPORTS ═══ -->
  <div class="dash-section">
    <?php acc_section('fa-bar-chart', 'Reports', 'linear-gradient(135deg,#92400e,#451a03)', 6); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['account_sub_panel_ledger_report_daily'])) : ?>
        <?php acc_card('account/ledger_report',
          'linear-gradient(135deg,#d4a017,#8a6500)', 'rgba(212,160,23,.45)',
          'fa-bar-chart', 'Ledger Report', 'Daily'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['account_sub_panel_ledger_report_monthly'])) : ?>
        <?php acc_card('account/ledger_report_monthly',
          'linear-gradient(135deg,#68075C,#420038)', 'rgba(104,7,92,.45)',
          'fa-calendar-o', 'Ledger Report', 'Monthly'); ?>
        <?php if (in_array($_SESSION['software_link'], ['eaglemountainschool','lotusvalleyschoolozar','utkarshschooljaruwakhera','gloriousacademykawardha'])) : ?>
          <?php acc_card('account/ledger_report_monthly_new',
            'linear-gradient(135deg,#64748b,#334155)', 'rgba(100,116,139,.45)',
            'fa-calendar', 'Ledger Report New', 'Monthly'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['account_sub_panel_income_expanece_report'])) : ?>
        <?php acc_card('account/income_expense_report',
          'linear-gradient(135deg,#dc3b1e,#a01e00)', 'rgba(220,59,30,.45)',
          'fa-pie-chart', 'Income/Expense Report', 'View Report'); ?>
        <?php acc_card('account/refund_report',
          'linear-gradient(135deg,#b91c1c,#7f1d1d)', 'rgba(185,28,28,.45)',
          'fa-undo', 'Refund Report', 'View Report'); ?>
      <?php endif; ?>

      <?php acc_card('account/ledger_advance_salary_report',
        'linear-gradient(135deg,#806964,#5a4540)', 'rgba(128,105,100,.45)',
        'fa-money', 'Advance Salary', 'Report'); ?>

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
