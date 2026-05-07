<script src="<?php echo $school_software_path; ?>assests/js/jquery.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo $school_software_path; ?>assests/js/bootstrap.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/raphael.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/morris.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/jquery.sparkline.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<!-- DataTables -->
<script src="<?php echo $school_software_path; ?>assests/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/dataTables.bootstrap.min.js"></script>
<!-- datepicker -->
<script src="<?php echo $school_software_path; ?>assests/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $school_software_path; ?>assests/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $school_software_path; ?>assests/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $school_software_path; ?>assests/js/adminlte.min.js"></script>

<script src="<?php echo $school_software_path; ?>assests/js/demo.js"></script>
<script src="<?php echo $school_software_path; ?>assests/js/select2.full.min.js"></script>

<script>
$.extend( true, $.fn.dataTable.defaults, {
  'scrollY':'60vh',
    "pageLength": 50,
     "scrollX": true,
     "autoWidth": false
} );
</script>
<script type="text/javascript">
var timeSinceLastMove = 0;
$(document).mousemove(function() {
timeSinceLastMove = 0;
});
$(document).keyup(function() {
timeSinceLastMove = 0;
});
checkTime();
function checkTime() {
timeSinceLastMove++;
if (timeSinceLastMove > 1 * 60) {
get_content('attachment/logout');
session_destroy();
}
setTimeout(checkTime, 10000);
}
</script>
<script>
/* ── Notification sound synthesizer (Web Audio API, no external files) ── */
var _siAudioCtx = null;
function si_play_sound(type) {
    try {
        if (!_siAudioCtx) _siAudioCtx = new (window.AudioContext || window.webkitAudioContext)();
        var ctx = _siAudioCtx;

        function note(freq, startAt, dur, vol, wave) {
            var osc  = ctx.createOscillator();
            var gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = wave || 'sine';
            osc.frequency.setValueAtTime(freq, ctx.currentTime + startAt);
            gain.gain.setValueAtTime(0.001, ctx.currentTime + startAt);
            gain.gain.linearRampToValueAtTime(vol, ctx.currentTime + startAt + 0.015);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + startAt + dur);
            osc.start(ctx.currentTime + startAt);
            osc.stop(ctx.currentTime + startAt + dur + 0.05);
        }

        if (type === 'success') {
            /* Ascending chime — C5 → E5 → G5 */
            note(523, 0.00, 0.18, 0.28, 'sine');
            note(659, 0.12, 0.18, 0.26, 'sine');
            note(784, 0.24, 0.30, 0.24, 'sine');
        } else if (type === 'error') {
            /* Short descending buzz */
            note(320, 0.00, 0.14, 0.28, 'sawtooth');
            note(220, 0.14, 0.22, 0.22, 'sawtooth');
        } else if (type === 'warning') {
            /* Double cautionary beep */
            note(480, 0.00, 0.10, 0.24, 'triangle');
            note(380, 0.16, 0.14, 0.20, 'triangle');
        } else {
            /* Info — soft single pop */
            note(680, 0.00, 0.14, 0.18, 'sine');
        }
    } catch (e) { /* AudioContext not supported — silent fail */ }
}

/* Futuristic toast — defined last so it wins over any earlier alert_new() */
function alert_new(content, color) {
    var DURATION = 5000;
    var type = 'info';
    var c = (color || '').toLowerCase();
    if (c === 'green'  || c === 'success' || c === '#2ecc71' || c === '#27ae60') type = 'success';
    else if (c === 'red' || c === 'error'  || c === '#e74c3c' || c === '#c0392b') type = 'error';
    else if (c === 'yellow' || c === 'warning' || c === 'orange' || c === '#f1c40f') type = 'warning';
    var meta = {
        success: { title: 'Success', icon: 'fa-check-circle'        },
        error:   { title: 'Error',   icon: 'fa-times-circle'        },
        warning: { title: 'Warning', icon: 'fa-exclamation-triangle' },
        info:    { title: 'Info',    icon: 'fa-info-circle'         }
    };
    var m = meta[type];
    si_play_sound(type);
    var t = document.createElement('div');
    t.className = 'si-toast si-toast-' + type;
    t.innerHTML =
        '<div class="si-toast-ico"><i class="fa ' + m.icon + '"></i></div>' +
        '<div class="si-toast-body">' +
          '<div class="si-toast-title">' + m.title + '</div>' +
          '<div class="si-toast-msg">'   + content  + '</div>' +
        '</div>' +
        '<button class="si-toast-close" aria-label="Close">&times;</button>' +
        '<div class="si-toast-bar" style="animation-duration:' + DURATION + 'ms"></div>';
    var wrap = document.getElementById('si-toast-wrap');
    if (!wrap) return;
    wrap.appendChild(t);
    var timer;
    function dismiss() {
        if (t.parentNode) {
            t.classList.add('si-toast-out');
            setTimeout(function () { if (t.parentNode) t.parentNode.removeChild(t); }, 350);
        }
    }
    function start()  { timer = setTimeout(dismiss, DURATION); }
    function pause()  { clearTimeout(timer); t.querySelector('.si-toast-bar').style.animationPlayState = 'paused'; }
    function resume() { t.querySelector('.si-toast-bar').style.animationPlayState = 'running'; start(); }
    start();
    t.addEventListener('mouseenter', pause);
    t.addEventListener('mouseleave', resume);
    t.querySelector('.si-toast-close').addEventListener('click', function (e) {
        e.stopPropagation(); dismiss();
    });
}
</script>
