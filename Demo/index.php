<?php
session_start();
$access_control11 = $_SERVER['SCRIPT_NAME'];
$access_control21 = explode('/', $access_control11);
$_SESSION['software_link'] = $access_control21[1];
$_SESSION['school_software_version'] = 'school_software_v1';
if (!isset($_SESSION['login_count'])) {
    $_SESSION['login_count'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
    <title>Bluemorphoz Pvt Ltd</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../school_software_v1/assets/img/BlueMorpho.png" type="image/x-icon"/>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap%22 rel="stylesheet">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../<?php echo $_SESSION['school_software_version'] ?>/assests/css/dist/css/bootstrap.min.css">
 
    <script src="jquery-3.6.0.min.js"></script>
 
    <!-- ===== Original JS logic (preserved) ===== -->
    <script>
        $(document).ready(function () {
            get_school_detail();
            get_session();
        });
 
        document.addEventListener('keydown', function (event) {
            if (event.which == 13 && !event.shiftKey) {
                event.preventDefault();
                form_submit();
            }
        });
 
        function refresh_captcha() {
            $(".imgcaptcha").attr("src", access_link + "demo_captcha.php?_=" + ((new Date()).getTime()));
        }
    </script>
 
    <script type="text/javascript">
        var access_link = "../school_software_v1/admin/attachment/";
 
        function get_school_detail() {
            $.ajax({
                type: "POST",
                url: access_link + "get_school_detail.php",
                cache: false,
                success: function (detail) {
                    var res = detail.split("|?|");
                    $("#school_name").html(res[1]);
                    var logo = "<img src='" + res[2] + "' class='school-logo-img' alt='School Logo' onerror=\"this.style.display='none';\">";
                    $("#school_logo").html(logo);
                    if (res[3] == 1) {
                        $("#captcha_control").show();
                        $("#captcha_control_yes").val("1");
                    }
                }
            });
        }
 
        function get_session() {
            $('#session').html("<option>Loading....</option>");
            $.ajax({
                type: "POST",
                url: access_link + "get_session.php",
                cache: false,
                success: function (detail) {
                    $("#session").html(detail);
                }
            });
        }
 
        function togglePassword() {
            var pwd = document.getElementById('password');
            var icon = document.getElementById('togglePwdIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
 
        function showSnack(message, type) {
            var x = document.getElementById("snackbar");
            var icon = type === 'success' ? '<i class="fa-solid fa-circle-check"></i>' :
                       type === 'error'   ? '<i class="fa-solid fa-circle-exclamation"></i>' :
                                            '<i class="fa-solid fa-circle-info"></i>';
            x.innerHTML = icon + ' <span>' + message + '</span>';
            x.className = "show " + (type || 'error');
            setTimeout(function () {
                x.className = x.className.replace("show", "").replace(type || 'error', '');
            }, 3000);
        }
 
        function setLoading(state) {
            var btn = document.getElementById('loginBtn');
            var btnText = document.getElementById('loginBtnText');
            var btnSpin = document.getElementById('loginBtnSpin');
            if (state) {
                btn.disabled = true;
                btn.classList.add('loading');
                btnText.style.opacity = '0';
                btnSpin.style.display = 'inline-block';
            } else {
                btn.disabled = false;
                btn.classList.remove('loading');
                btnText.style.opacity = '1';
                btnSpin.style.display = 'none';
            }
        }
 
        // ripple effect on button
        function createRipple(e) {
            var btn = e.currentTarget;
            var circle = document.createElement('span');
            var diameter = Math.max(btn.clientWidth, btn.clientHeight);
            var radius = diameter / 2;
            var rect = btn.getBoundingClientRect();
            circle.style.width = circle.style.height = diameter + 'px';
            circle.style.left = (e.clientX - rect.left - radius) + 'px';
            circle.style.top  = (e.clientY - rect.top  - radius) + 'px';
            circle.classList.add('ripple');
            var old = btn.getElementsByClassName('ripple')[0];
            if (old) old.remove();
            btn.appendChild(circle);
        }
 
        // shake card on error
        function shakeCard() {
            var c = document.getElementById('loginCard');
            c.classList.remove('shake');
            void c.offsetWidth;
            c.classList.add('shake');
        }
 
        function form_submit() {
            var password = document.getElementById('password').value;
            var username = document.getElementById('username').value;
            if (username == '') {
                showSnack("Please enter your User Name", 'error');
                shakeCard();
                return;
            }
            if (password == '') {
                showSnack("Please enter your Password", 'error');
                shakeCard();
                return;
            }
 
            var captcha_ok = 1;
            var captcha_control_yes = document.getElementById("captcha_control_yes").value;
            if (captcha_control_yes == 1) {
                var captcha = $('#captcha').val();
                $.post(access_link + "submit_demo_captcha.php?", { "captcha": captcha }, function (response) {
                    if (response == 1) {
                        captcha_ok = 1;
                    } else {
                        captcha_ok = 0;
                        $("#captcha").val('');
                        showSnack("Wrong captcha code!", 'error');
                        shakeCard();
                        return;
                    }
                });
            }
 
            if (captcha_ok == 1) {
                setLoading(true);
                $.ajax({
                    type: "POST",
                    url: access_link + "get_user_details.php",
                    data: $("#my_form").serialize(),
                    success: function (detail) {
                        var res = detail.split("|?|");
                        if (res[1] == 'success') {
                            showSnack("Login Successful — redirecting...", 'success');
                            document.getElementById('loginCard').classList.add('success-pulse');
                            setTimeout(function () {
                                window.open("main.php", "_self");
                            }, 700);
                        } else {
                            setLoading(false);
                            if (res[3] == 1) {
                                $("#captcha_control").show();
                                $("#captcha_control_yes").val("1");
                                refresh_captcha();
                            }
                            showSnack("Username or Password is incorrect", 'error');
                            shakeCard();
                        }
                    },
                    error: function () {
                        setLoading(false);
                        showSnack("Network error. Please try again.", 'error');
                        shakeCard();
                    }
                });
            }
        }
 
        // Typewriter effect for tagline
        function runTypewriter() {
            var phrases = [
                'Manage your school, effortlessly.',
                'Track attendance in real-time.',
                'Empower every classroom.',
                'Insights that drive growth.'
            ];
            var el = document.getElementById('typewriter');
            if (!el) return;
            var i = 0, j = 0, isDeleting = false;
            function tick() {
                var current = phrases[i];
                if (!isDeleting) {
                    el.textContent = current.substring(0, j + 1);
                    j++;
                    if (j === current.length) { isDeleting = true; setTimeout(tick, 1800); return; }
                } else {
                    el.textContent = current.substring(0, j - 1);
                    j--;
                    if (j === 0) { isDeleting = false; i = (i + 1) % phrases.length; }
                }
                setTimeout(tick, isDeleting ? 30 : 70);
            }
            tick();
        }
 
        // Animated counters
        function runCounters() {
            document.querySelectorAll('.counter').forEach(function (c) {
                var target = parseInt(c.getAttribute('data-target'), 10);
                var duration = 1800;
                var start = performance.now();
                function step(now) {
                    var progress = Math.min((now - start) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    c.textContent = Math.floor(eased * target).toLocaleString();
                    if (progress < 1) requestAnimationFrame(step);
                    else c.textContent = target.toLocaleString() + (c.getAttribute('data-suffix') || '');
                }
                requestAnimationFrame(step);
            });
        }
 
        window.addEventListener('load', function () {
            runTypewriter();
            runCounters();
        });
    </script>
 
    <style>
        :root {
            --brand-1: #1269db;
            --brand-2: #4f8bf0;
            --brand-3: #6d5dfc;
            --brand-4: #00c2ff;
            --bg-deep: #0b1224;
            --text:    #1b2a4e;
            --text-mute:#6b7a99;
            --line:    rgba(18, 105, 219, 0.15);
            --danger:  #e63946;
            --success: #16a34a;
            --shadow-card: 0 30px 80px rgba(7, 14, 35, 0.45),
                           0 8px 22px rgba(7, 14, 35, 0.25);
        }
 
        * { box-sizing: border-box; }
 
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }
 
        body {
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            background: linear-gradient(135deg, #0b1224 0%, #131b34 50%, #1a2347 100%);
            background-size: 400% 400%;
            animation: bgShift 18s ease infinite;
        }
        @keyframes bgShift {
            0%,100% { background-position: 0% 50%; }
            50%     { background-position: 100% 50%; }
        }
 
        /* ===== Animated mesh gradient orbs ===== */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.55;
            z-index: 0;
            pointer-events: none;
            will-change: transform;
        }
        .blob.b1 { width: 500px; height: 500px; background: #6d5dfc; top: -130px; left: -130px;  animation: blobMove1 14s ease-in-out infinite; }
        .blob.b2 { width: 580px; height: 580px; background: #1269db; bottom: -170px; right: -170px; animation: blobMove2 18s ease-in-out infinite; }
        .blob.b3 { width: 340px; height: 340px; background: #00c2ff; top: 45%; left: 55%; animation: blobMove3 22s ease-in-out infinite; opacity: 0.35; }
        .blob.b4 { width: 280px; height: 280px; background: #ff4d9f; top: 15%; right: 20%;  animation: blobMove1 20s ease-in-out infinite reverse; opacity: 0.28; }
 
        @keyframes blobMove1 {
            0%,100% { transform: translate(0,0) scale(1) rotate(0); }
            33%     { transform: translate(60px, 40px) scale(1.08) rotate(60deg); }
            66%     { transform: translate(-30px, 80px) scale(0.96) rotate(-30deg); }
        }
        @keyframes blobMove2 {
            0%,100% { transform: translate(0,0) scale(1) rotate(0); }
            50%     { transform: translate(-60px, -50px) scale(1.1) rotate(-45deg); }
        }
        @keyframes blobMove3 {
            0%,100% { transform: translate(-50%,-50%) scale(1); }
            50%     { transform: translate(-40%,-60%) scale(1.12); }
        }
 
        /* ===== Grid overlay (subtle animated) ===== */
        .grid-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridPan 40s linear infinite;
            mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.6) 0%, transparent 70%);
            -webkit-mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.6) 0%, transparent 70%);
        }
        @keyframes gridPan {
            from { background-position: 0 0; }
            to   { background-position: 60px 60px; }
        }
 
        /* ===== Floating rising particles ===== */
        .particles {
            position: fixed; inset: 0; z-index: 1; overflow: hidden; pointer-events: none;
        }
        .particles span {
            position: absolute;
            display: block;
            border-radius: 50%;
            bottom: -20px;
            background: rgba(255,255,255,0.8);
            animation: rise linear infinite;
            filter: drop-shadow(0 0 6px rgba(255,255,255,0.6));
        }
        @keyframes rise {
            0%   { transform: translateY(0) scale(1); opacity: 0; }
            10%  { opacity: 0.9; }
            50%  { transform: translateY(-55vh) translateX(20px) scale(0.8); }
            100% { transform: translateY(-115vh) translateX(-20px) scale(0.3); opacity: 0; }
        }
 
        /* ===== Shooting stars ===== */
        .shooting-star {
            position: fixed;
            width: 2px; height: 2px;
            background: #fff;
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
            animation: shoot 6s linear infinite;
            filter: drop-shadow(0 0 6px #fff);
        }
        .shooting-star::after {
            content: "";
            position: absolute;
            top: 50%; right: 0;
            width: 120px; height: 1px;
            background: linear-gradient(90deg, transparent, #fff);
            transform: translateY(-50%);
        }
        .shooting-star.s1 { top: 15%;  left: -150px; animation-delay: 0s;  }
        .shooting-star.s2 { top: 40%;  left: -150px; animation-delay: 2.5s;}
        .shooting-star.s3 { top: 70%;  left: -150px; animation-delay: 4.5s;}
        @keyframes shoot {
            0%   { transform: translate(0,0)  rotate(15deg); opacity: 0; }
            5%   { opacity: 1; }
            70%  { opacity: 1; }
            100% { transform: translate(120vw, 300px) rotate(15deg); opacity: 0; }
        }
 
        /* ===== Layout ===== */
        .page {
            position: relative;
            z-index: 3;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            gap: 0;
            padding: 32px;
            align-items: center;
            justify-items: center;
        }
 
        /* ===== Brand panel ===== */
        .brand-panel {
            color: #fff;
            max-width: 560px;
            padding: 24px;
            text-align: left;
            animation: slideInLeft 0.9s cubic-bezier(.2,.9,.25,1) both;
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
 
        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 100px;
            backdrop-filter: blur(10px);
            margin-bottom: 28px;
            font-weight: 600;
            letter-spacing: 0.4px;
            font-size: 13px;
            animation: breathe 3s ease-in-out infinite;
        }
        @keyframes breathe {
            0%,100% { box-shadow: 0 0 0 0 rgba(0,255,163,0.4); }
            50%     { box-shadow: 0 0 0 10px rgba(0,255,163,0); }
        }
        .brand-mark .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #00ffa3; box-shadow: 0 0 14px #00ffa3;
            animation: pulseDot 1.6s ease-in-out infinite;
        }
        @keyframes pulseDot {
            0%,100% { transform: scale(1);   opacity: 1; }
            50%     { transform: scale(1.4); opacity: 0.7; }
        }
 
        .brand-panel h1 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(34px, 4.2vw, 56px);
            line-height: 1.08;
            margin: 0 0 12px 0;
            font-weight: 800;
            background: linear-gradient(120deg, #ffffff 0%, #8aa6ff 35%, #cbd9ff 70%, #ffffff 100%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 5s linear infinite;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }
 
        .typewriter-line {
            color: rgba(255,255,255,0.85);
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 18px;
            min-height: 28px;
        }
        .typewriter-line::after {
            content: '|';
            color: #00c2ff;
            font-weight: 700;
            animation: blink 1s steps(2) infinite;
            margin-left: 2px;
        }
        @keyframes blink { 50% { opacity: 0; } }
 
        .brand-panel p.lead {
            font-size: 16px;
            line-height: 1.65;
            color: rgba(255,255,255,0.72);
            margin: 0 0 26px 0;
            max-width: 480px;
        }
 
        /* Animated stat counters */
        .stats-row {
            display: flex;
            gap: 24px;
            margin: 0 0 28px 0;
            flex-wrap: wrap;
        }
        .stat {
            position: relative;
            padding: 14px 20px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 14px;
            backdrop-filter: blur(8px);
            min-width: 110px;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        .stat:hover { transform: translateY(-4px); background: rgba(255,255,255,0.1); }
        .stat .num {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
            display: inline-block;
        }
        .stat .lbl {
            font-size: 11.5px;
            color: rgba(255,255,255,0.65);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
 
        /* Feature list with staggered entrance */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 12px;
        }
        .feature-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 14.5px;
            color: rgba(255,255,255,0.88);
            opacity: 0;
            transform: translateX(-20px);
            animation: featureIn 0.6s cubic-bezier(.2,.9,.25,1) forwards;
            transition: transform 0.3s ease;
        }
        .feature-list li:hover { transform: translateX(6px); }
        .feature-list li:nth-child(1) { animation-delay: 0.5s; }
        .feature-list li:nth-child(2) { animation-delay: 0.7s; }
        .feature-list li:nth-child(3) { animation-delay: 0.9s; }
        @keyframes featureIn {
            to { opacity: 1; transform: translateX(0); }
        }
        .feature-list .ico {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, rgba(109,93,252,0.4), rgba(18,105,219,0.4));
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            font-size: 15px;
            transition: transform 0.4s cubic-bezier(.4,2,.6,1);
        }
        .feature-list li:hover .ico { transform: rotate(360deg) scale(1.1); }
 
        /* ===== Login card ===== */
        .card-wrap { width: 100%; display: flex; justify-content: center; }
        .login-card {
            width: 100%;
            max-width: 460px;
            background: rgba(255,255,255,0.98);
            border-radius: 24px;
            padding: 44px 38px 36px;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(255,255,255,0.7);
            position: relative;
            overflow: hidden;
            animation: cardIn 0.9s cubic-bezier(.2,.9,.25,1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(30px) scale(0.96) rotateX(6deg); }
            to   { opacity: 1; transform: translateY(0)    scale(1)    rotateX(0); }
        }
 

 
        /* Animated top gradient bar */
        .login-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, #6d5dfc, #1269db, #00c2ff, #1269db, #6d5dfc);
            background-size: 200% 100%;
            animation: barSlide 4s linear infinite;
        }
        @keyframes barSlide {
            from { background-position: 0 0; }
            to   { background-position: 200% 0; }
        }
 
        /* Animated glow border on focus-within */
        .login-card::after {
            content: "";
            position: absolute;
            inset: -2px;
            border-radius: 26px;
            background: linear-gradient(135deg, #6d5dfc, #1269db, #00c2ff);
            opacity: 0;
            z-index: -1;
            filter: blur(16px);
            transition: opacity 0.4s ease;
        }
        .login-card:focus-within::after { opacity: 0.55; }
 
        /* Shake on error */
        .login-card.shake { animation: shake 0.55s cubic-bezier(.36,.07,.19,.97) both; }
        @keyframes shake {
            10%,90% { transform: translateX(-2px); }
            20%,80% { transform: translateX(4px); }
            30%,50%,70% { transform: translateX(-8px); }
            40%,60%     { transform: translateX(8px); }
        }
 
        /* Success pulse */
        .login-card.success-pulse { animation: successPulse 0.7s ease-out; }
        @keyframes successPulse {
            0%   { box-shadow: var(--shadow-card), 0 0 0 0 rgba(22,163,74,0.6); }
            70%  { box-shadow: var(--shadow-card), 0 0 0 30px rgba(22,163,74,0); }
            100% { box-shadow: var(--shadow-card), 0 0 0 0 rgba(22,163,74,0); }
        }
 
        /* ===== Logo with orbit rings ===== */
        .school-head {
            text-align: center;
            margin-bottom: 22px;
            position: relative;
        }
        .logo-stage {
            position: relative;
            width: 140px; height: 140px;
            margin: 0 auto 14px;
            display: grid; place-items: center;
        }
        .orbit {
            position: absolute;
            top: 50%; left: 50%;
            border: 1.5px dashed rgba(18,105,219,0.35);
            border-radius: 50%;
            transform: translate(-50%,-50%);
            animation: orbitSpin linear infinite;
        }
        .orbit.o1 { width: 120px; height: 120px; animation-duration: 12s; }
        .orbit.o2 { width: 140px; height: 140px; animation-duration: 20s; animation-direction: reverse; border-color: rgba(109,93,252,0.3); }
        .orbit::before {
            content: "";
            position: absolute;
            top: -4px; left: 50%;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--brand-1);
            transform: translateX(-50%);
            box-shadow: 0 0 10px var(--brand-1);
        }
        .orbit.o2::before { background: var(--brand-3); box-shadow: 0 0 10px var(--brand-3); }
        @keyframes orbitSpin {
            from { transform: translate(-50%,-50%) rotate(0deg); }
            to   { transform: translate(-50%,-50%) rotate(360deg); }
        }
 
        .logo-ring {
            position: relative;
            width: 92px; height: 92px;
            border-radius: 50%;
            display: grid; place-items: center;
            background: #fff;
            border: 2px solid var(--line);
            box-shadow: 0 10px 30px rgba(18, 105, 219, 0.22);
            overflow: hidden;
            z-index: 2;
            animation: logoFloat 4s ease-in-out infinite;
        }
        @keyframes logoFloat {
            0%,100% { transform: translateY(0); }
            50%     { transform: translateY(-6px); }
        }
        .school-logo-img {
            width: 78px; height: 78px;
            object-fit: contain;
            border-radius: 50%;
        }
        #school_name {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--brand-1);
            display: block;
            line-height: 1.2;
            background: linear-gradient(90deg, var(--brand-3), var(--brand-1), var(--brand-4), var(--brand-1), var(--brand-3));
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleShine 4s linear infinite;
        }
        @keyframes titleShine {
            from { background-position: 0% center; }
            to   { background-position: 200% center; }
        }
        .welcome {
            margin-top: 10px;
            color: var(--text-mute);
            font-size: 14px;
            opacity: 0;
            animation: fadeUp 0.6s 0.4s forwards;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .welcome strong { color: var(--text); font-weight: 600; }
 
        /* ===== Inputs ===== */
        .field {
            position: relative;
            margin-bottom: 16px;
            opacity: 0;
            transform: translateY(10px);
            animation: fieldIn 0.5s cubic-bezier(.2,.9,.25,1) forwards;
        }
        .field:nth-of-type(1) { animation-delay: 0.5s; }
        .field:nth-of-type(2) { animation-delay: 0.62s; }
        .field:nth-of-type(3) { animation-delay: 0.74s; }
        @keyframes fieldIn { to { opacity: 1; transform: translateY(0); } }
 
        .field .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-mute);
            font-size: 15px;
            pointer-events: none;
            transition: color 0.25s, transform 0.3s;
        }
        .field:focus-within .input-icon {
            color: var(--brand-1);
            transform: translateY(-50%) scale(1.15);
        }
        .field .input-suffix {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-mute);
            font-size: 15px;
            cursor: pointer;
            background: transparent;
            border: 0;
            padding: 6px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        .field .input-suffix:hover {
            background: rgba(18,105,219,0.08);
            color: var(--brand-1);
            transform: translateY(-50%) scale(1.1);
        }
 
        .form-input,
        .form-select {
            width: 100%;
            padding: 14px 16px 14px 44px;
            font-size: 14.5px;
            font-family: inherit;
            color: var(--text);
            background: #f4f7fc;
            border: 1.5px solid transparent;
            border-radius: 12px;
            transition: all 0.3s ease;
            outline: none;
            box-shadow: none;
            margin: 0;
            position: relative;
        }
        .form-select {
            padding-left: 44px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%236b7a99' d='M8 11L3 6h10z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 14px;
        }
        .form-input::placeholder { color: #9aa6bf; transition: opacity 0.3s; }
        .form-input:focus::placeholder { opacity: 0.5; }
        .form-input:focus,
        .form-select:focus {
            background: #fff;
            border-color: var(--brand-1);
            box-shadow: 0 0 0 4px rgba(18,105,219,0.14);
            transform: translateY(-1px);
        }
 
        /* Captcha */
        .captcha-row {
            display: grid;
            grid-template-columns: 1fr 130px 44px;
            gap: 10px;
            align-items: stretch;
            margin-bottom: 16px;
        }
        .captcha-row .field { margin-bottom: 0; animation: none; opacity: 1; transform: none; }
        .captcha-img {
            width: 100%;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
            background: #f4f7fc;
            border: 1.5px solid transparent;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .captcha-img:hover { transform: scale(1.03); box-shadow: 0 6px 20px rgba(18,105,219,0.2); }
        .refresh-btn {
            width: 44px; height: 48px;
            border-radius: 12px;
            border: 1.5px solid var(--line);
            background: #f4f7fc;
            color: var(--brand-1);
            display: grid; place-items: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(.4,2,.6,1);
        }
        .refresh-btn:hover { background: var(--brand-1); color: #fff; transform: rotate(180deg) scale(1.08); }
 
        /* ===== Button with ripple + shine ===== */
        .btn-login {
            width: 100%;
            padding: 15px 18px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #fff;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand-3) 0%, var(--brand-1) 50%, var(--brand-4) 100%);
            background-size: 200% 200%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 12px 28px rgba(18, 105, 219, 0.38);
            margin-top: 6px;
            animation: btnGradient 4s ease infinite;
        }
        @keyframes btnGradient {
            0%,100% { background-position: 0% 50%; }
            50%     { background-position: 100% 50%; }
        }
        .btn-login::before {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.35), transparent);
            transition: none;
        }
        .btn-login:hover::before { animation: shine 1.2s ease; }
        @keyframes shine {
            from { left: -100%; }
            to   { left: 120%; }
        }
        .btn-login:hover  { transform: translateY(-3px) scale(1.01); box-shadow: 0 20px 40px rgba(18,105,219,0.5); }
        .btn-login:active { transform: translateY(-1px); }
        .btn-login:disabled { cursor: not-allowed; filter: grayscale(0.2) brightness(0.95); }
        .btn-login .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            transform: scale(0);
            animation: rippleAnim 0.7s linear;
            pointer-events: none;
        }
        @keyframes rippleAnim { to { transform: scale(4); opacity: 0; } }
        .btn-login .spin {
            display: none;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 22px; height: 22px;
            border: 3px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }
 
        .btn-login i.fa-right-to-bracket {
            transition: transform 0.3s;
            display: inline-block;
        }
        .btn-login:hover i.fa-right-to-bracket { transform: translateX(4px); }
 
        .form-foot {
            margin-top: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12.5px;
            color: var(--text-mute);
            opacity: 0;
            animation: fadeUp 0.5s 0.95s forwards;
        }
        .form-foot a { color: var(--brand-1); text-decoration: none; font-weight: 600; }
        .form-foot a:hover { text-decoration: underline; }
        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--success);
            font-weight: 500;
        }
        .secure-badge i {
            animation: lockBounce 2.5s ease-in-out infinite;
        }
        @keyframes lockBounce {
            0%,100% { transform: translateY(0); }
            50%     { transform: translateY(-2px); }
        }
 
        /* ===== Snackbar ===== */
        #snackbar {
            visibility: hidden;
            min-width: 260px;
            max-width: 90vw;
            color: #fff;
            text-align: left;
            border-radius: 14px;
            padding: 14px 22px;
            position: fixed;
            z-index: 9999;
            left: 50%;
            transform: translateX(-50%);
            bottom: 30px;
            font-size: 14.5px;
            font-weight: 500;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
            background: #333;
            display: flex; align-items: center; gap: 10px;
        }
        #snackbar i { font-size: 18px; }
        #snackbar.error   { background: linear-gradient(135deg, #ef4444, #b91c1c); }
        #snackbar.success { background: linear-gradient(135deg, #22c55e, #15803d); }
        #snackbar.show {
            visibility: visible;
            -webkit-animation: snackin 0.5s cubic-bezier(.2,1.5,.4,1), snackout 0.4s 2.6s;
            animation: snackin 0.5s cubic-bezier(.2,1.5,.4,1), snackout 0.4s 2.6s;
        }
        @keyframes snackin {
            from { bottom: -20px; opacity: 0; transform: translateX(-50%) scale(0.8); }
            to   { bottom: 30px;  opacity: 1; transform: translateX(-50%) scale(1); }
        }
        @keyframes snackout {
            from { bottom: 30px; opacity: 1; }
            to   { bottom: 0;    opacity: 0; }
        }
 
        /* ===== Responsive ===== */
        @media (max-width: 1024px) {
            .page { grid-template-columns: 1fr; padding: 24px 18px; }
            .brand-panel { text-align: center; max-width: 600px; padding: 12px 8px 0; }
            .brand-panel p.lead { margin-left: auto; margin-right: auto; }
            .stats-row { justify-content: center; }
            .feature-list { display: none; }
            .shooting-star { display: none; }
        }
        @media (max-width: 540px) {
            .page { padding: 16px 12px; }
            .brand-panel { padding: 8px 4px 0; }
            .brand-panel h1 { font-size: 28px; margin-bottom: 8px; }
            .typewriter-line { font-size: 15px; }
            .brand-panel p.lead { font-size: 14px; margin-bottom: 18px; }
            .brand-mark { margin-bottom: 16px; font-size: 12px; padding: 8px 14px; }
            .stats-row { gap: 10px; margin-bottom: 20px; }
            .stat { padding: 10px 14px; min-width: 90px; }
            .stat .num { font-size: 20px; }
            .stat .lbl { font-size: 10.5px; }
 
            .login-card { padding: 30px 20px 24px; border-radius: 20px; }
            .logo-stage { width: 120px; height: 120px; }
            .orbit.o1 { width: 100px; height: 100px; }
            .orbit.o2 { width: 120px; height: 120px; }
            .logo-ring { width: 78px; height: 78px; }
            .school-logo-img { width: 64px; height: 64px; }
            #school_name { font-size: 19px; }
            .welcome { font-size: 13px; }
            .form-input, .form-select { padding: 13px 14px 13px 42px; font-size: 14px; }
            .captcha-row { grid-template-columns: 1fr 110px 42px; gap: 8px; }
            .captcha-img { height: 46px; }
            .refresh-btn { width: 42px; height: 46px; }
            .form-foot { flex-direction: column; gap: 8px; text-align: center; }
        }
        @media (max-width: 360px) {
            .captcha-row { grid-template-columns: 1fr 100px 40px; }
        }
 
        /* Respect reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
 
    <!-- Background effects -->
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
    <div class="blob b4"></div>
    <div class="grid-overlay"></div>
    <div class="shooting-star s1"></div>
    <div class="shooting-star s2"></div>
    <div class="shooting-star s3"></div>
 
    <div class="particles" aria-hidden="true">
        <?php for ($i = 0; $i < 22; $i++):
            $left = rand(2, 98);
            $size = rand(3, 8);
            $dur  = rand(12, 28);
            $delay = rand(0, 20);
            $opacity = rand(20, 70) / 100;
        ?>
        <span style="left:<?php echo $left; ?>%; width:<?php echo $size; ?>px; height:<?php echo $size; ?>px; animation-duration: <?php echo $dur; ?>s; animation-delay: -<?php echo $delay; ?>s; opacity: <?php echo $opacity; ?>;"></span>
        <?php endfor; ?>
    </div>
 
    <main class="page">
 
        <!-- Brand / Marketing panel -->
        <section class="brand-panel">
            <div class="brand-mark">
                <span class="dot"></span>
                <span>Bluemorphoz Pvt Ltd</span>
            </div>
 
            <h1>Welcome back to your School Portal</h1>
            <div class="typewriter-line"><span id="typewriter"></span></div>
 
            <p class="lead">
                Manage students, staff, attendance, fees and academics — all from one secure, intuitive dashboard. Sign in to continue where you left off.
            </p>
 
            <div class="stats-row">
                <div class="stat">
                    <span class="num counter" data-target="500" data-suffix="+">0</span>
                    <div class="lbl">Schools</div>
                </div>
                <div class="stat">
                    <span class="num counter" data-target="120000" data-suffix="+">0</span>
                    <div class="lbl">Students</div>
                </div>
                <div class="stat">
                    <span class="num counter" data-target="99" data-suffix="%">0</span>
                    <div class="lbl">Uptime</div>
                </div>
            </div>
 
            <ul class="feature-list">
                <li>
                    <span class="ico"><i class="fa-solid fa-shield-halved"></i></span>
                    <span>Bank-grade security with encrypted sessions</span>
                </li>
                <li>
                    <span class="ico"><i class="fa-solid fa-bolt"></i></span>
                    <span>Lightning-fast access across devices</span>
                </li>
                <li>
                    <span class="ico"><i class="fa-solid fa-chart-line"></i></span>
                    <span>Real-time insights & reporting</span>
                </li>
            </ul>
        </section>
 
        <!-- Login Card -->
        <section class="card-wrap">
            <div class="login-card" id="loginCard">
                <input type="hidden" value="0" id="captcha_control_yes">
 
                <div class="school-head">
                    <div class="logo-stage">
                        <div class="orbit o1"></div>
                        <div class="orbit o2"></div>
                        <div class="logo-ring" id="school_logo">
                            <i class="fa-solid fa-graduation-cap" style="font-size:36px;color:var(--brand-1);"></i>
                        </div>
                    </div>
                    <b id="school_name">Loading...</b>
                    <div class="welcome">Sign in to your <strong>account</strong> to continue</div>
                </div>
 
                <form method="post" id="my_form" autocomplete="on" onsubmit="event.preventDefault(); form_submit();">
 
                    <div class="field">
                        <span class="input-icon"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="username" id="username" class="form-input"
                               placeholder="Email / Username" required autocomplete="username" />
                    </div>
 
                    <div class="field">
                        <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-input"
                               placeholder="Password" required autocomplete="current-password" style="padding-right: 44px;" />
                        <button type="button" class="input-suffix" onclick="togglePassword()" aria-label="Show or hide password">
                            <i id="togglePwdIcon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
 
                    <div class="field">
                        <span class="input-icon"><i class="fa-regular fa-calendar"></i></span>
                        <select class="form-select" required name="session" id="session">
                            <option>Loading....</option>
                        </select>
                    </div>
 
                    <div id="captcha_control" style="display:none">
                        <div class="captcha-row">
                            <div class="field">
                                <span class="input-icon"><i class="fa-solid fa-shield-halved"></i></span>
                                <input id="captcha" name="captcha" class="form-input" type="text" placeholder="Captcha" />
                            </div>
                            <img src="../<?php echo $_SESSION['school_software_version'] ?>/admin/attachment/demo_captcha.php"
                                 class="imgcaptcha captcha-img" alt="captcha" />
                            <button type="button" class="refresh-btn" onclick="refresh_captcha();" aria-label="Refresh captcha">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>
                        </div>
                    </div>
 
                    <button type="button" id="loginBtn" onclick="createRipple(event); form_submit()" class="btn-login">
                        <span id="loginBtnText">
                            <i class="fa-solid fa-right-to-bracket" style="margin-right:8px;"></i> Sign In
                        </span>
                        <span id="loginBtnSpin" class="spin"></span>
                    </button>
 
                    <div class="form-foot">
                        <span class="secure-badge">
                            <i class="fa-solid fa-lock"></i> Secure Connection
                        </span>
                        <span>&copy; <?php echo date('Y'); ?> Bluemorphoz</span>
                    </div>
 
                </form>
            </div>
        </section>
    </main>
 
    <div id="snackbar">Notification</div>
</body>
</html>
 