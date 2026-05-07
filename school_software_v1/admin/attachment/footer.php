<?php
$month  = (int) date('m');
$year   = (int) date('Y');
$year1  = $year + 1;
if ($month >= 1 && $month <= 3) {
    $year--;
    $year1--;
}
$footer_session = $year . '-' . $year1;

$footer_school_name = htmlspecialchars($_SESSION['school_info_school_name5']      ?? '');
$footer_logo        = htmlspecialchars($_SESSION['school_info_logo_name']          ?? '');
$footer_principal   = htmlspecialchars($_SESSION['school_info_principal_name5']    ?? '');
$footer_contact     = htmlspecialchars($_SESSION['school_info_school_contact_no5'] ?? '');
?>

<div id="si-toast-wrap"></div>

<footer class="main-footer ftr">

    <!-- LEFT — school logo + name + copyright -->
    <div class="ftr-left">
        <?php if ($footer_logo) : ?>
        <img src="<?php echo $footer_logo; ?>" alt="Logo" class="ftr-logo"
             onerror="this.style.display='none'">
        <?php endif; ?>

        <div class="ftr-info">
            <?php if ($footer_school_name) : ?>
            <span class="ftr-school"><?php echo $footer_school_name; ?></span>
            <?php endif; ?>
            <span class="ftr-copy">
                &copy; <?php echo $footer_session; ?> &nbsp;&mdash;&nbsp; All rights reserved
            </span>
        </div>
    </div>

    <!-- RIGHT — margin-left:auto pushes to far right in flex context -->
    <div class="ftr-right">
        <span class="ftr-powered">Powered by</span>
        <a href="http://bluemorphoz.in/" target="_blank" class="ftr-brand-pill">
            <span class="ftr-butterfly">&#x1F98B;</span>
            <span class="ftr-brand-text">Bluemorphoz</span>
        </a>
    </div>

</footer>

<style>
    /* ── Footer shell ── */
    .ftr {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%) !important;
        border-top: 3px solid #b92b27 !important;
        color: rgba(255,255,255,.7) !important;
        padding: 0 20px !important;
        min-height: 52px;
        display: flex !important;
        align-items: center !important;
    }

    /* ── Left block ── */
    .ftr-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 0 0 auto;
    }
    .ftr-logo {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: 2px solid rgba(255,255,255,.25);
        object-fit: cover;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,.35);
    }
    .ftr-info {
        display: flex;
        flex-direction: column;
        gap: 1px;
        line-height: 1.3;
    }
    .ftr-school {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        letter-spacing: .3px;
        white-space: nowrap;
    }
    .ftr-copy {
        font-size: 11px;
        color: rgba(255,255,255,.5);
        white-space: nowrap;
    }

    /* ── Right block ── */
    .ftr-right {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: auto;
        flex: 0 0 auto;
    }
    .ftr-powered {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: rgba(255,255,255,.4);
    }
    .ftr-brand-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 20px;
        padding: 4px 12px 4px 8px;
        text-decoration: none !important;
        transition: background .2s, box-shadow .2s;
    }
    .ftr-brand-pill:hover {
        background: rgba(255,255,255,.18);
        box-shadow: 0 2px 10px rgba(0,0,0,.3);
        text-decoration: none !important;
    }
    .ftr-butterfly  { font-size: 17px; line-height: 1; }
    .ftr-brand-text {
        font-size: 13px;
        font-weight: 700;
        color: #fff !important;
        letter-spacing: .4px;
    }

    /* ── Toast Notifications ── */
    #si-toast-wrap {
        position: fixed;
        top: 24px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        pointer-events: none;
        width: 380px;
        max-width: calc(100vw - 32px);
    }
    .si-toast {
        pointer-events: all;
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 38px 14px 16px;
        border-radius: 14px;
        background: rgba(15,20,40,.82);
        backdrop-filter: blur(18px) saturate(1.6);
        -webkit-backdrop-filter: blur(18px) saturate(1.6);
        border: 1px solid rgba(255,255,255,.13);
        box-shadow: 0 8px 32px rgba(0,0,0,.45), 0 0 0 1px rgba(255,255,255,.06) inset;
        overflow: hidden;
        animation: si-toast-in .42s cubic-bezier(.34,1.56,.64,1) both;
        cursor: default;
        min-width: 260px;
    }
    .si-toast.si-toast-out {
        animation: si-toast-out .32s cubic-bezier(.55,0,1,.45) forwards;
    }
    @keyframes si-toast-in {
        from { opacity: 0; transform: translateY(-18px) scale(.92); }
        to   { opacity: 1; transform: translateY(0)     scale(1);   }
    }
    @keyframes si-toast-out {
        from { opacity: 1; transform: translateY(0)     scale(1);   max-height: 120px; margin-bottom: 0; }
        to   { opacity: 0; transform: translateY(-14px) scale(.92); max-height: 0;     margin-bottom: -12px; }
    }

    /* Icon circle */
    .si-toast-ico {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        margin-top: 1px;
    }

    /* Text block */
    .si-toast-body { flex: 1; min-width: 0; }
    .si-toast-title {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 3px;
        line-height: 1.2;
    }
    .si-toast-msg {
        font-size: 13px;
        font-weight: 500;
        color: rgba(255,255,255,.82);
        line-height: 1.45;
        word-break: break-word;
    }

    /* Close button */
    .si-toast-close {
        position: absolute;
        top: 8px;
        right: 10px;
        background: none;
        border: none;
        color: rgba(255,255,255,.4);
        font-size: 16px;
        cursor: pointer;
        line-height: 1;
        padding: 2px 4px;
        border-radius: 4px;
        transition: color .15s, background .15s;
    }
    .si-toast-close:hover { color: #fff; background: rgba(255,255,255,.12); }

    /* Progress bar */
    .si-toast-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        border-radius: 0 0 14px 14px;
        transform-origin: left;
        animation: si-toast-bar linear forwards;
    }
    @keyframes si-toast-bar {
        from { transform: scaleX(1); }
        to   { transform: scaleX(0); }
    }

    /* Type colour tokens */
    .si-toast-success .si-toast-ico  { background: rgba(46,204,113,.22); color: #2ecc71; box-shadow: 0 0 12px rgba(46,204,113,.35); }
    .si-toast-success .si-toast-title { color: #2ecc71; }
    .si-toast-success .si-toast-bar   { background: linear-gradient(90deg,#27ae60,#2ecc71); box-shadow: 0 0 6px rgba(46,204,113,.6); }

    .si-toast-error .si-toast-ico   { background: rgba(231,76,60,.22);  color: #e74c3c; box-shadow: 0 0 12px rgba(231,76,60,.35); }
    .si-toast-error .si-toast-title  { color: #e74c3c; }
    .si-toast-error .si-toast-bar    { background: linear-gradient(90deg,#c0392b,#e74c3c); box-shadow: 0 0 6px rgba(231,76,60,.6); }

    .si-toast-warning .si-toast-ico  { background: rgba(241,196,15,.22); color: #f1c40f; box-shadow: 0 0 12px rgba(241,196,15,.35); }
    .si-toast-warning .si-toast-title{ color: #f1c40f; }
    .si-toast-warning .si-toast-bar  { background: linear-gradient(90deg,#d4ac0d,#f1c40f); box-shadow: 0 0 6px rgba(241,196,15,.6); }

    .si-toast-info .si-toast-ico    { background: rgba(52,152,219,.22); color: #3498db; box-shadow: 0 0 12px rgba(52,152,219,.35); }
    .si-toast-info .si-toast-title   { color: #3498db; }
    .si-toast-info .si-toast-bar     { background: linear-gradient(90deg,#2980b9,#3498db); box-shadow: 0 0 6px rgba(52,152,219,.6); }

    /* Glow border pulse on entry */
    .si-toast-success { border-color: rgba(46,204,113,.35); }
    .si-toast-error   { border-color: rgba(231,76,60,.35);  }
    .si-toast-warning { border-color: rgba(241,196,15,.35); }
    .si-toast-info    { border-color: rgba(52,152,219,.35); }

    @media (max-width: 480px) {
        #si-toast-wrap { top: 10px; width: calc(100vw - 24px); }
        .si-toast { min-width: 0; }
    }
</style>

<script>
    function alert_new(content, color) {
        var DURATION = 5000;

        /* Resolve semantic type from color string or hex */
        var type = 'info';
        var c = (color || '').toLowerCase();
        if (c === 'green'  || c === 'success' || c === '#2ecc71' || c === '#27ae60') type = 'success';
        else if (c === 'red' || c === 'error'  || c === '#e74c3c' || c === '#c0392b') type = 'error';
        else if (c === 'yellow' || c === 'warning' || c === 'orange' || c === '#f1c40f') type = 'warning';

        var meta = {
            success: { title: 'Success', icon: 'fa-check-circle'   },
            error:   { title: 'Error',   icon: 'fa-times-circle'   },
            warning: { title: 'Warning', icon: 'fa-exclamation-triangle' },
            info:    { title: 'Info',    icon: 'fa-info-circle'    }
        };
        var m = meta[type];

        /* Build toast element */
        var t = document.createElement('div');
        t.className = 'si-toast si-toast-' + type;
        t.innerHTML =
            '<div class="si-toast-ico"><i class="fa ' + m.icon + '"></i></div>' +
            '<div class="si-toast-body">' +
              '<div class="si-toast-title">' + m.title + '</div>' +
              '<div class="si-toast-msg">'   + content + '</div>' +
            '</div>' +
            '<button class="si-toast-close" aria-label="Close">&times;</button>' +
            '<div class="si-toast-bar" style="animation-duration:' + DURATION + 'ms"></div>';

        var wrap = document.getElementById('si-toast-wrap');
        wrap.appendChild(t);

        /* Dismiss logic */
        var timer;
        function dismiss() {
            if (t.parentNode) {
                t.classList.add('si-toast-out');
                setTimeout(function () { if (t.parentNode) t.parentNode.removeChild(t); }, 350);
            }
        }
        function start() { timer = setTimeout(dismiss, DURATION); }
        function pause() { clearTimeout(timer); t.querySelector('.si-toast-bar').style.animationPlayState = 'paused'; }
        function resume(){ t.querySelector('.si-toast-bar').style.animationPlayState = 'running'; start(); }

        start();
        t.addEventListener('mouseenter', pause);
        t.addEventListener('mouseleave', resume);
        t.querySelector('.si-toast-close').addEventListener('click', function(e){
            e.stopPropagation(); dismiss();
        });
    }
</script>

<script>
    $(document).ready(function () {
        /* ready hook — keep for compatibility */
    });
</script>

<!-- ═══════════════════════════════════════════════════════
     GLOBAL PAGE HEADER — applies the .si-ph design to every
     old AdminLTE  <section class="content-header"> on the fly.
     CSS uses !important to beat AdminLTE skin/body overrides.
═══════════════════════════════════════════════════════ -->
<style id="si-global-ph-css">
/* ══════════════════════════════════════════════════
   GLOBAL .si-ph  — !important beats AdminLTE/skin CSS
   ══════════════════════════════════════════════════ */

/* ── Shell ── */
section.si-ph,
.si-ph {
    background: linear-gradient(135deg,#0f3460 0%,#16213e 50%,#1a1a2e 100%) !important;
    padding: 18px 24px 16px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    gap: 12px !important;
    position: relative !important;
    overflow: hidden !important;
    border-bottom: 3px solid #b92b27 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    margin: 0 !important;
    float: none !important;
    animation: si-ph-in .5s cubic-bezier(.34,1.56,.64,1) both !important;
}
@keyframes si-ph-in {
    from { opacity:0; transform:translateY(-18px); }
    to   { opacity:1; transform:translateY(0); }
}
section.si-ph::before, .si-ph::before {
    content:'' !important; position:absolute !important;
    top:-40px !important; right:-40px !important;
    width:160px !important; height:160px !important; border-radius:50% !important;
    background:radial-gradient(circle,rgba(185,43,39,.35) 0%,transparent 70%) !important;
    pointer-events:none !important;
}
section.si-ph::after, .si-ph::after {
    content:'' !important; position:absolute !important;
    bottom:-30px !important; left:20% !important;
    width:120px !important; height:120px !important; border-radius:50% !important;
    background:radial-gradient(circle,rgba(67,97,238,.3) 0%,transparent 70%) !important;
    pointer-events:none !important;
}

/* ── Left block ── */
.si-ph-left {
    display:flex !important; align-items:center !important; gap:14px !important;
    position:relative !important; z-index:1 !important;
    animation: si-ph-left-in .55s .1s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes si-ph-left-in {
    from { opacity:0; transform:translateX(-20px); }
    to   { opacity:1; transform:translateX(0); }
}
.si-ph-badge {
    width:48px !important; height:48px !important; border-radius:14px !important;
    background:linear-gradient(135deg,#b92b27,#e74c3c) !important;
    display:flex !important; align-items:center !important; justify-content:center !important;
    box-shadow:0 4px 16px rgba(185,43,39,.5),0 0 0 4px rgba(185,43,39,.18) !important;
    flex-shrink:0 !important;
    animation: si-badge-pulse 3s ease-in-out infinite;
}
@keyframes si-badge-pulse {
    0%,100% { box-shadow:0 4px 16px rgba(185,43,39,.5),0 0 0 4px rgba(185,43,39,.18); }
    50%      { box-shadow:0 4px 24px rgba(185,43,39,.75),0 0 0 8px rgba(185,43,39,.1); }
}
.si-ph-badge i { font-size:22px !important; color:#fff !important; }
.si-ph-title {
    font-size:18px !important; font-weight:800 !important; color:#fff !important;
    margin:0 0 2px !important; letter-spacing:.3px !important;
    text-shadow:0 2px 8px rgba(0,0,0,.3) !important; line-height:1.2 !important;
}
.si-ph-sub {
    font-size:11px !important; font-weight:600 !important;
    color:rgba(255,255,255,.5) !important;
    text-transform:uppercase !important; letter-spacing:1.2px !important; margin:0 !important;
}

/* ── Right breadcrumb ── */
.si-ph-bc {
    display:flex !important; align-items:center !important; gap:4px !important;
    flex-wrap:wrap !important;
    position:relative !important; z-index:1 !important;
    animation: si-ph-bc-in .55s .2s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes si-ph-bc-in {
    from { opacity:0; transform:translateX(20px); }
    to   { opacity:1; transform:translateX(0); }
}
a.si-bc-link, .si-bc-link {
    display:inline-flex !important; align-items:center !important; gap:5px !important;
    padding:5px 12px !important; border-radius:20px !important;
    font-size:12px !important; font-weight:600 !important;
    color:rgba(255,255,255,.7) !important;
    text-decoration:none !important; white-space:nowrap !important;
    transition:background .2s,color .2s,transform .2s !important;
    background:transparent !important;
}
a.si-bc-link:hover, .si-bc-link:hover {
    background:rgba(255,255,255,.12) !important;
    color:#fff !important;
    text-decoration:none !important;
    transform:translateY(-1px) !important;
}
.si-bc-link i { font-size:13px !important; }
.si-bc-sep {
    color:rgba(255,255,255,.3) !important; font-size:10px !important;
    padding:0 2px !important; display:flex !important; align-items:center !important;
}
.si-bc-active {
    display:inline-flex !important; align-items:center !important; gap:6px !important;
    padding:5px 14px !important; border-radius:20px !important;
    font-size:12px !important; font-weight:700 !important; color:#fff !important;
    background:rgba(185,43,39,.45) !important;
    border:1px solid rgba(185,43,39,.6) !important;
    box-shadow:0 2px 10px rgba(185,43,39,.3) !important;
    white-space:nowrap !important; letter-spacing:.3px !important;
    position:relative !important; overflow:hidden !important;
}
.si-bc-active::after {
    content:'' !important; position:absolute !important; inset:0 !important;
    background:linear-gradient(120deg,transparent 0%,rgba(255,255,255,.12) 50%,transparent 100%) !important;
    transform:translateX(-130%) !important;
    animation:si-bc-shimmer 2.5s ease-in-out infinite !important;
}
@keyframes si-bc-shimmer {
    0%       { transform:translateX(-130%); }
    60%,100% { transform:translateX(130%); }
}
.si-bc-active i { font-size:12px !important; }

/* Force hide old AdminLTE breadcrumb styling on page-header h1 inside .si-ph */
.si-ph > h1 { display:none !important; }
.si-ph > ol.breadcrumb { display:none !important; }
/* And any stray content-header that slips through */
section.content-header { display:none !important; }
</style>

<style id="si-global-box-css">
/* ── Global .box modernization ── */
.box {
    border-radius: 14px !important;
    border: 1px solid rgba(0,0,0,.06) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,.08) !important;
    overflow: hidden !important;
}
.box.my_border_top,
.box.box-danger,
.box.box-primary,
.box.box-success,
.box.box-warning,
.box.box-info {
    border-top: 3px solid #b92b27 !important;
}
.box.box-primary  { border-top-color: #3c8dbc !important; }
.box.box-success  { border-top-color: #00a65a !important; }
.box.box-warning  { border-top-color: #f39c12 !important; }
.box.box-info     { border-top-color: #00c0ef !important; }
h3.box-title {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #1a1a2e !important;
    letter-spacing: .3px !important;
}
.box-body { padding: 16px !important; }
.box-footer {
    border-top: 1px solid rgba(0,0,0,.06) !important;
    border-radius: 0 0 14px 14px !important;
}
</style>

<script>
(function () {
    /* Icon map: module folder name → Font Awesome class */
    var iconMap = {
        'index_content'          : 'fa-home',
        'school_info'            : 'fa-graduation-cap',
        'student'                : 'fa-user',
        'staff'                  : 'fa-users',
        'examination'            : 'fa-pencil-square',
        'exam_paper_setter'      : 'fa-file-text-o',
        'fees_monthly'           : 'fa-money',
        'attendance_management'  : 'fa-check-square-o',
        'holiday'                : 'fa-calendar',
        'bus'                    : 'fa-bus',
        'certificate'            : 'fa-certificate',
        'event_management'       : 'fa-calendar-check-o',
        'library'                : 'fa-book',
        'hostel'                 : 'fa-building',
        'time_table'             : 'fa-table',
        'homework'               : 'fa-pencil',
        'gate_pass'              : 'fa-id-card',
        'leave'                  : 'fa-sign-out',
        'account'                : 'fa-calculator',
        'sports'                 : 'fa-trophy',
        'stock'                  : 'fa-cubes',
        'stock_management'       : 'fa-cubes',
        'gallery'                : 'fa-picture-o',
        'user_right'             : 'fa-shield',
        'reminder'               : 'fa-bell',
        'enquiry'                : 'fa-question-circle',
        'govt_requirement'       : 'fa-file-text',
        'downloads'              : 'fa-download',
        'penalty'                : 'fa-gavel',
        'recycle_bin'            : 'fa-trash',
        'utility'                : 'fa-wrench',
        'session'                : 'fa-refresh',
        'dues'                   : 'fa-exclamation-circle'
    };

    function getModuleIcon(bcLinks) {
        /* Try to detect module from the second breadcrumb link's href */
        if (bcLinks.length >= 2) {
            var href = bcLinks[1].getAttribute('href') || '';
            var m = href.match(/get_content\(['"]([^/'"]+)\//);
            if (m && iconMap[m[1]]) return iconMap[m[1]];
            /* fallback: first part of href */
            var m2 = href.match(/get_content\(['"]([^/'"]+)/);
            if (m2 && iconMap[m2[1]]) return iconMap[m2[1]];
        }
        /* Try to detect from existing icon in second breadcrumb */
        if (bcLinks.length >= 2) {
            var iEl = bcLinks[1].querySelector('i');
            if (iEl) {
                var cls = iEl.className.split(' ');
                for (var c = 0; c < cls.length; c++) {
                    if (cls[c].indexOf('fa-') === 0 && cls[c] !== 'fa-dashboard') return cls[c];
                }
            }
        }
        return 'fa-th-large';
    }

    function extractText(el, excludeChild) {
        var txt = '';
        el.childNodes.forEach(function (n) {
            if (n !== excludeChild && n.nodeType === 3) txt += n.textContent;
        });
        return txt.trim();
    }

    function transformHeaders() {
        document.querySelectorAll('section.content-header').forEach(function (header) {
            /* skip if already replaced */
            if (header.dataset.siDone) return;
            header.dataset.siDone = '1';

            /* ── Extract title & subtitle ── */
            var h1 = header.querySelector('h1');
            var small = h1 ? h1.querySelector('small') : null;
            var title = h1 ? extractText(h1, small) : 'Management';
            var subtitle = small ? small.textContent.trim() : 'Control Panel';
            if (!title) title = h1 ? h1.textContent.trim() : 'Management';

            /* ── Build breadcrumb HTML ── */
            var bcItems = Array.from(header.querySelectorAll('.breadcrumb li'));
            var bcLinks = bcItems.map(function (li) { return li.querySelector('a'); });
            var badgeIcon = getModuleIcon(bcLinks);
            var bcHtml = '';

            bcItems.forEach(function (li, idx) {
                var a      = li.querySelector('a');
                var iEl    = li.querySelector('i');
                var isLast = idx === bcItems.length - 1;
                var isFirst= idx === 0;

                /* icon class */
                var iconCls = 'fa fa-circle';
                if (isFirst) {
                    iconCls = 'fa fa-home';
                } else if (iEl) {
                    iconCls = iEl.className.replace('fa-dashboard', 'fa-home').trim();
                }

                /* text */
                var rawText = a ? a.textContent : li.textContent;
                if (iEl) rawText = rawText.replace(iEl.textContent, '');
                var text = rawText.replace(/\s+/g, ' ').trim();
                if (!text) text = isFirst ? 'Home' : 'Page';

                if (!isLast && a) {
                    var href = a.getAttribute('href') || '#';
                    bcHtml += '<a class="si-bc-link" href="' + href + '">'
                            + '<i class="' + iconCls + '"></i> ' + text + '</a>'
                            + '<span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>';
                } else {
                    bcHtml += '<span class="si-bc-active">'
                            + '<i class="' + iconCls + '"></i> ' + text + '</span>';
                }
            });

            /* ── Build new element ── */
            var ph = document.createElement('section');
            ph.className = 'si-ph';
            ph.innerHTML =
                '<div class="si-ph-left">'
                +   '<div class="si-ph-badge"><i class="fa ' + badgeIcon + '"></i></div>'
                +   '<div>'
                +     '<h1 class="si-ph-title">' + title + '</h1>'
                +     '<p class="si-ph-sub">' + subtitle + '</p>'
                +   '</div>'
                + '</div>'
                + '<nav class="si-ph-bc">' + bcHtml + '</nav>';

            header.parentNode.replaceChild(ph, header);
        });
    }

    /* ── Run immediately (catches any headers already in DOM) ── */
    transformHeaders();

    /* ── MutationObserver: fires on every DOM change in #get_content ── */
    var gcEl = document.getElementById('get_content');
    var observeTarget = gcEl || document.body;
    var observer = new MutationObserver(function () {
        /* Run on ANY child change — don't filter, avoids missed nodes */
        transformHeaders();
    });
    observer.observe(observeTarget, { childList: true, subtree: true });

    /* ── jQuery ajaxComplete hook — most reliable trigger for this system ──
       jQuery loads AFTER this script, so we poll until it's ready. */
    (function waitForJQuery() {
        if (window.jQuery) {
            jQuery(document).on('ajaxComplete', function () {
                /* Small delay lets jQuery finish .html() before we query */
                setTimeout(transformHeaders, 30);
            });
        } else {
            setTimeout(waitForJQuery, 80);
        }
    }());
})();
</script>
