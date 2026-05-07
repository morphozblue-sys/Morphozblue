<?php include("../attachment/session.php"); ?>
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

<!-- Page Header -->
<section class="content-header">
  <h1><?php echo $language['Certificate Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> <?php echo $language['Certificate']; ?></a></li>
    <li class="active">Main Panel</li>
  </ol>
</section>

<section class="content">
<div class="dash-wrap">

<?php
function cert_card($link, $grad, $glow, $icon, $title, $sub = 'Open') {
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

function cert_section($icon, $label, $badge_grad, $count = 0) {
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

  <!-- ═══ CHARACTER, EVENT & SPORTS ═══ -->
  <div class="dash-section">
    <?php cert_section('fa-certificate', 'Character, Event &amp; Sports', 'linear-gradient(135deg,#804040,#5c2c2c)', 6); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['sub_panel_character_certificate_form'])) : ?>
        <?php cert_card('certificate/character_certificate_form',
          'linear-gradient(135deg,#804040,#5c2c2c)', 'rgba(128,64,64,.45)',
          'fa-certificate', $language['Cc Form'], 'Generate CC'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_character_certificate_list'])) : ?>
        <?php cert_card('certificate/character_certificate_list',
          'linear-gradient(135deg,#6b3030,#4a1e1e)', 'rgba(107,48,48,.45)',
          'fa-list-alt', $language['Cc List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_event_certificate_form'])) : ?>
        <?php cert_card('certificate/event_certificate_form',
          'linear-gradient(135deg,#9F2B68,#7B1D4F)', 'rgba(159,43,104,.45)',
          'fa-star', $language['Event'], 'Generate Event Cert'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_event_certificate_list'])) : ?>
        <?php cert_card('certificate/event_certificate_list',
          'linear-gradient(135deg,#be185d,#9d174d)', 'rgba(190,24,93,.45)',
          'fa-list-alt', $language['Event List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_sport_certificate_form'])) : ?>
        <?php cert_card('certificate/sport_certificate_form',
          'linear-gradient(135deg,#e8414e,#c0102d)', 'rgba(232,65,78,.45)',
          'fa-trophy', $language['Sports'], 'Generate Sports Cert'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['sub_panel_sport_certificate_list'])) : ?>
        <?php cert_card('certificate/sport_certificate_list',
          'linear-gradient(135deg,#dc2626,#991b1b)', 'rgba(220,38,38,.45)',
          'fa-list-alt', $language['Sports List'], 'View List'); ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ TRANSFER CERTIFICATE ═══ -->
  <div class="dash-section">
    <?php cert_section('fa-file-text', 'Transfer Certificate (TC)', 'linear-gradient(135deg,#3F7ED0,#1e5aad)', 4); ?>
    <div class="dash-grid">

      <?php if (in_array($_SESSION['board_change'], ['MP Board','State Board','Both',''])) : ?>
        <?php if (!isset($_SESSION['sub_panel_tc_form'])) : ?>
          <?php cert_card('certificate/tc_form',
            'linear-gradient(135deg,#3F7ED0,#1e5aad)', 'rgba(63,126,208,.45)',
            'fa-file-text', $language['Tc Form'], 'State Board'); ?>
        <?php endif; ?>
        <?php if (!isset($_SESSION['sub_panel_tc_list'])) : ?>
          <?php cert_card('certificate/tc_list',
            'linear-gradient(135deg,#2563eb,#1e3a8a)', 'rgba(37,99,235,.45)',
            'fa-list-alt', $language['Tc List'], 'State Board'); ?>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (in_array($_SESSION['board_change'], ['CBSE Board','Both'])) : ?>
        <?php if (!isset($_SESSION['sub_panel_tc_form'])) : ?>
          <?php cert_card('certificate/tc_form_cbse',
            'linear-gradient(135deg,#1d4ed8,#1e3a8a)', 'rgba(29,78,216,.45)',
            'fa-file-text', $language['Tc Form'], 'CBSE Board'); ?>
        <?php endif; ?>
        <?php if (!isset($_SESSION['sub_panel_tc_list'])) : ?>
          <?php cert_card('certificate/tc_list_cbse',
            'linear-gradient(135deg,#1e40af,#172554)', 'rgba(30,64,175,.45)',
            'fa-list-alt', $language['Tc List'], 'CBSE Board'); ?>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>

  <!-- ═══ FEE & LEGAL CERTIFICATES ═══ -->
  <div class="dash-section">
    <?php cert_section('fa-certificate', 'Fee &amp; Legal Certificates', 'linear-gradient(135deg,#138D75,#0a5c4d)', 9); ?>
    <div class="dash-grid">

      <?php if (!isset($_SESSION['certificate_sub_panel_bonafide'])) : ?>
        <?php cert_card('certificate/bonafied_form',
          'linear-gradient(135deg,#138D75,#0a5c4d)', 'rgba(19,141,117,.45)',
          'fa-certificate', $language['Bonafied'], 'Generate Bonafide'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_bonafide_list'])) : ?>
        <?php cert_card('certificate/bonafied_certificate_list',
          'linear-gradient(135deg,#0d7a63,#085244)', 'rgba(13,122,99,.45)',
          'fa-list-alt', $language['Bonafied List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_tue_fee'])) : ?>
        <?php cert_card('certificate/tutionfee_form',
          'linear-gradient(135deg,#f97316,#c2410c)', 'rgba(249,115,22,.45)',
          'fa-money', $language['Tu.Fee Cert.'], 'Generate Certificate'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_tue_fee_list'])) : ?>
        <?php cert_card('certificate/tutionfee_certificate_list',
          'linear-gradient(135deg,#ea6b0a,#b33709)', 'rgba(234,107,10,.45)',
          'fa-list-alt', $language['Tu.Fee Cer.List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_annual_fee'])) : ?>
        <?php cert_card('certificate/annualfee_form',
          'linear-gradient(135deg,#6C3483,#4a2257)', 'rgba(108,52,131,.45)',
          'fa-money', $language['Ann.Fee Cert.'], 'Generate Certificate'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_annual_fee_list'])) : ?>
        <?php cert_card('certificate/annualfee_certificate_list',
          'linear-gradient(135deg,#5c2b72,#3d1a4d)', 'rgba(92,43,114,.45)',
          'fa-list-alt', $language['Ann.Fee Cer.List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_cast_certificate'])) : ?>
        <?php cert_card('certificate/caste_form',
          'linear-gradient(135deg,#64748b,#334155)', 'rgba(100,116,139,.45)',
          'fa-certificate', $language['Caste Cert.'], 'Generate Certificate'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_cast_certificate_list'])) : ?>
        <?php cert_card('certificate/caste_certificate_list',
          'linear-gradient(135deg,#4b5563,#1f2937)', 'rgba(75,85,99,.45)',
          'fa-list-alt', $language['Caste Cer.List'], 'View List'); ?>
      <?php endif; ?>

      <?php if (!isset($_SESSION['certificate_sub_panel_birth_certificate'])) : ?>
        <?php cert_card('certificate/birth_certificate',
          'linear-gradient(135deg,#2ecc71,#1a9e56)', 'rgba(46,204,113,.45)',
          'fa-certificate', 'Birth Certificate', 'Generate Certificate'); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['software_link']) && $_SESSION['software_link'] == 'cityschoolashoknagar') : ?>
        <?php cert_card('certificate/student_form',
          'linear-gradient(135deg,#3c1414,#1e0a0a)', 'rgba(60,20,20,.45)',
          'fa-certificate', 'Student Cert.', 'Generate Certificate'); ?>
        <?php cert_card('certificate/student_certificate_list',
          'linear-gradient(135deg,#2e0f0f,#180707)', 'rgba(46,15,15,.45)',
          'fa-list-alt', 'Student Cer.List', 'View List'); ?>
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
