<?php
$language    = $_SESSION['lang'];
$session12   = $_SESSION['session37'];

if ($language == 'Hindi') {
    include 'language_hindi.php';
} else {
    include 'language_english.php';
}

$school_info_username5          = $_SESSION['school_info_username5'];
$school_info_logo5              = $_SESSION['school_info_logo_name'];
$school_info_school_contact_no5 = $_SESSION['school_info_school_contact_no5'];
$school_info_principal_name5    = $_SESSION['school_info_principal_name5'];
$school_info_school_name5       = $_SESSION['school_info_school_name5'];
$software_validity_form         = $_SESSION['software_validity_form'];
$software_validity_to           = $_SESSION['software_validity_to'];

$SERVER_NAME1 = $_SERVER['SERVER_NAME'];
$path2343     = 'https://' . $SERVER_NAME1 . '/' . $_SESSION['software_link'];
?>
<style>
    /* ── Main header shell — dark theme ── */
    .main-header .navbar,
    .main-header .logo {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
        box-shadow: 0 2px 12px rgba(0,0,0,.5) !important;
        border-bottom: 3px solid #b92b27 !important;
    }
    .main-header {
        box-shadow: 0 3px 20px rgba(0,0,0,.45) !important;
    }

    /* ── Logo area ── */
    .main-header .logo {
        letter-spacing: 1px;
    }
    .main-header .logo .logo-lg {
        font-weight: 800;
        font-size: 16px;
        letter-spacing: 1.5px;
    }

    /* ── Frosted pill wrapping all controls ── */
    .hdr-pill {
        display: flex;
        align-items: center;
        gap: 0;
        background: rgba(255, 255, 255, .13);
        border: 1px solid rgba(255, 255, 255, .22);
        border-radius: 24px;
        padding: 4px 14px;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        box-shadow: 0 1px 6px rgba(0,0,0,.15);
    }

    /* ── Labels ── */
    .hdr-lbl {
        color: rgba(255, 255, 255, .85);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        white-space: nowrap;
        margin: 0 5px 0 10px;
    }
    .hdr-lbl:first-child {
        margin-left: 0;
    }

    /* ── Selects ── */
    .hdr-sel {
        background: rgba(255, 255, 255, .95) !important;
        color: #1a2540 !important;
        border: none !important;
        border-radius: 6px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 2px 6px !important;
        height: 26px !important;
        width: auto !important;
        min-width: 82px;
        cursor: pointer;
        box-shadow: 0 1px 4px rgba(0,0,0,.18) !important;
        transition: box-shadow .15s;
    }
    .hdr-sel:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px rgba(255,255,255,.5) !important;
    }

    /* ── Thin vertical divider between control groups ── */
    .hdr-div {
        display: inline-block;
        width: 1px;
        height: 18px;
        background: rgba(255, 255, 255, .28);
        margin: 0 8px;
        vertical-align: middle;
        flex-shrink: 0;
    }

    /* ── School name left-aligned after sidebar toggle ── */
    .hdr-school-name {
        position: absolute;
        left: 55px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #fff;
        font-size: 16px;
        font-weight: 800;
        white-space: nowrap;
        letter-spacing: .6px;
        text-shadow: 0 1px 6px rgba(0,0,0,.45), 0 0 24px rgba(0,0,0,.2);
    }

    /* ── Profile dropdown trigger ── */
    .main-header .navbar .user-menu > .dropdown-toggle {
        padding: 8px 14px !important;
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
    }
    .main-header .navbar .user-menu > .dropdown-toggle img {
        border: 2px solid rgba(255,255,255,.55) !important;
        border-radius: 50% !important;
        width: 28px !important;
        height: 28px !important;
        object-fit: cover;
    }
    .main-header .navbar .user-menu > .dropdown-toggle .hdr-username {
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .main-header .navbar .user-menu > .dropdown-toggle .hdr-caret {
        color: rgba(255,255,255,.7);
        font-size: 10px;
        margin-left: 2px;
    }

    /* ── Profile dropdown panel ── */
    .main-header .user-menu .dropdown-menu {
        border-radius: 10px !important;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,.25) !important;
        border: none !important;
        min-width: 200px;
    }
    .main-header .user-menu .user-header {
        background: linear-gradient(135deg, #b92b27, #1565C0) !important;
        padding: 18px 16px !important;
    }
    .main-header .user-menu .user-header img {
        border: 3px solid rgba(255,255,255,.6) !important;
        border-radius: 50% !important;
        width: 60px !important;
        height: 60px !important;
        object-fit: cover;
        display: block;
        margin: 0 auto 10px !important;
    }
    .main-header .user-menu .user-header p {
        text-align: center;
        margin: 0;
    }
    .main-header .user-menu .user-header p small {
        display: block;
        color: rgba(255,255,255,.9);
        font-size: 12px;
        font-weight: 600;
    }
    .main-header .user-menu .user-footer {
        padding: 10px 14px !important;
        background: #f9f9f9;
        display: flex;
        justify-content: space-between;
    }
    .main-header .user-menu .user-footer .btn {
        border-radius: 6px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 5px 14px !important;
    }

    /* ── Sidebar toggle button ── */
    .main-header .sidebar-toggle {
        color: rgba(255,255,255,.85) !important;
        font-size: 18px !important;
        padding: 14px 16px !important;
    }
    .main-header .sidebar-toggle:hover {
        color: #fff !important;
        background: rgba(255,255,255,.1) !important;
    }

    /* ── Responsive ── */
    @media screen and (min-width: 1193px) { #school_name { display: block; } }
    @media screen and (max-width: 1192px) { #school_name { display: none; } }
    @media screen and (max-width: 768px) {
        #school_name234  { display: none; }
        #font_help       { display: none; }
        #school_name2341 { display: block; }
        .hdr-school-name { display: none; }
    }
</style>

<script>
    /* Reload on browser back-navigation to prevent stale state */
    if (window.performance && window.performance.navigation.type === 2) {
        window.location.reload();
    }

    function for_change_header(set_value, set_param) {
        $.ajax({
            type: 'POST',
            url: access_link + 'attachment/set_header_details.php?set_param=' + set_param + '&set_value=' + set_value,
            cache: false,
            success: function ($detail) {
                if (set_param === 'lang') {
                    window.location.reload();
                } else if (set_param === 'hindi_typing') {
                    var langue345 = set_value;
                    $('#hindi_typing').val(langue345);
                    if (langue345 === 'Hindi') {
                        pramukhIME.setLanguage('hindi', 'pramukhindic');
                        pramukhIME.setSettings([{ language: 'all', kb: 'pramukhindic', digitInEnglish: true }]);
                    } else if (langue345 === 'Gujarati') {
                        pramukhIME.setLanguage('gujarati', 'pramukhindic');
                        pramukhIME.setSettings([{ language: 'all', kb: 'pramukhindic', digitInEnglish: true }]);
                    } else {
                        pramukhIME.addKeyboard(PramukhIndic);
                        pramukhIME.enable();
                        pramukhIME.setLanguage('english', 'pramukhime');
                    }
                } else {
                    url_control();
                }
            }
        });
    }
</script>

<header class="main-header">
    <!-- Logo -->
    <a href="javascript:get_content('index_content')" class="logo">
        <span class="logo-mini">B</span>
        <span class="logo-lg">Bluemorphoz</span>
    </a>

    <!-- Top navigation bar -->
    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- School name — centred absolutely -->
        <div class="hdr-school-name">
            <?php echo htmlspecialchars($school_info_school_name5); ?>
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" style="display:flex; align-items:center;">

                <!-- Compact controls row (hidden on mobile) -->
                <li class="hidden-xs" style="padding: 0 8px;">
                    <form method="post" enctype="multipart/form-data" style="margin:0;">
                        <div class="hdr-pill">

                            <span class="hdr-lbl">Font</span>
                            <select name="language_change" id="language_change" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'lang');">
                                <option value="English" <?php if ($_SESSION['lang'] == 'English') echo 'selected'; ?>>English</option>
                                <option value="Hindi"   <?php if ($_SESSION['lang'] == 'Hindi')   echo 'selected'; ?>>Hindi</option>
                            </select>

                            <span class="hdr-div"></span>

                            <span class="hdr-lbl">Typing</span>
                            <select name="hindi_typing" id="hindi_typing" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'hindi_typing');">
                                <option value="English"  <?php if ($_SESSION['hindi_typing'] == 'English')  echo 'selected'; ?>>English</option>
                                <option value="Hindi"    <?php if ($_SESSION['hindi_typing'] == 'Hindi')    echo 'selected'; ?>>Hindi</option>
                                <option value="Gujarati" <?php if ($_SESSION['hindi_typing'] == 'Gujarati') echo 'selected'; ?>>Gujarati</option>
                            </select>

                            <?php if ($_SESSION['school_info_medium'] == 'Both') : ?>
                            <span class="hdr-div"></span>
                            <span class="hdr-lbl">Medium</span>
                            <select name="medium_change" id="medium_change" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'medium_change');">
                                <option value="Hindi"   <?php if ($_SESSION['medium_change'] == 'Hindi')   echo 'selected'; ?>>Hindi</option>
                                <option value="English" <?php if ($_SESSION['medium_change'] == 'English') echo 'selected'; ?>>English</option>
                            </select>
                            <?php endif; ?>

                            <?php if ($_SESSION['shift'] == 'yes') : ?>
                            <span class="hdr-div"></span>
                            <span class="hdr-lbl">Shift</span>
                            <select name="shift_change" id="shift_change" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'shift_change');">
                                <option value="Shift1" <?php if ($_SESSION['shift_change'] == 'Shift1') echo 'selected'; ?>>Shift 1</option>
                                <option value="Shift2" <?php if ($_SESSION['shift_change'] == 'Shift2') echo 'selected'; ?>>Shift 2</option>
                            </select>
                            <?php endif; ?>

                            <?php if ($_SESSION['school_info_school_board'] == 'Both') : ?>
                            <?php $stateBoardList = ['State Board', 'UP Board', 'MP Board', 'Bihar Board', 'Rajsthan Board', 'CG Board']; ?>
                            <span class="hdr-div"></span>
                            <span class="hdr-lbl">Board</span>
                            <select name="board_change" id="board_change" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'board_change');">
                                <option value="State Board" <?php if (in_array($_SESSION['board_change'], $stateBoardList)) echo 'selected'; ?>>State Board</option>
                                <option value="CBSE Board"  <?php if ($_SESSION['board_change'] == 'CBSE Board')            echo 'selected'; ?>>CBSE Board</option>
                            </select>
                            <?php endif; ?>

                            <span class="hdr-div"></span>

                            <span class="hdr-lbl">Session</span>
                            <select name="session_change" id="session_change" class="hdr-sel"
                                    onchange="for_change_header(this.value, 'session37');">
                                <?php
                                $session_value23 = $_SESSION['session_value_array'];
                                $session12       = $_SESSION['session37'];
                                foreach ($session_value23 as $sv) :
                                    $parts = explode('_', $sv);
                                    $show  = $parts[0] . '-' . $parts[1];
                                ?>
                                <option value="<?php echo htmlspecialchars($sv); ?>"
                                        <?php if ($session12 == $sv) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($show); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <input type="submit" name="finish2" id="finish2" value="Submit" style="display:none;">
                    </form>
                </li>

                <!-- Profile dropdown -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo htmlspecialchars($school_info_logo5); ?>"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 40 40\'%3E%3Ccircle cx=\'20\' cy=\'20\' r=\'20\' fill=\'%23ffffff33\'/%3E%3Ctext x=\'50%25\' y=\'54%25\' text-anchor=\'middle\' dominant-baseline=\'middle\' font-size=\'18\' fill=\'%23fff\' font-family=\'Arial\'%3E<?php echo strtoupper(substr(htmlspecialchars($school_info_username5), 0, 1)); ?>%3C/text%3E%3C/svg%3E'">
                        <span class="hdr-username hidden-xs"><?php echo htmlspecialchars($school_info_username5); ?></span>
                        <i class="fa fa-caret-down hdr-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo htmlspecialchars($school_info_logo5); ?>"
                                 onerror="this.style.display='none'">
                            <p>
                                <small><?php echo htmlspecialchars($school_info_username5); ?></small>
                                <small><?php echo htmlspecialchars($school_info_school_contact_no5); ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="javascript:get_content('school_info/school_info_general')"
                                   class="btn btn-default btn-flat">
                                    <i class="fa fa-user" style="margin-right:5px;"></i>Profile
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:get_content('attachment/logout')"
                                   class="btn btn-danger btn-flat">
                                    <i class="fa fa-sign-out" style="margin-right:5px;"></i>Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>

<input type="hidden" value="<?php echo htmlspecialchars($_SESSION['software_link']); ?>" id="a9876">
<input type="hidden" value="<?php echo htmlspecialchars($path2343); ?>" id="a19876">

<script>
    (function () {
        var href     = window.location.href;
        var afterDot = href.split('.in')[1];
        if (!afterDot) return;

        var seg      = afterDot.split('/');
        var softLink = document.getElementById('a9876').value;
        var fullPath = document.getElementById('a19876').value;
        var altLink  = softLink + '1';

        if ((seg[1] === softLink || seg[1] === altLink) && seg[1] !== 'school_software') {
            /* valid path — do nothing */
        } else {
            window.open(fullPath, '_self');
        }
    }());
</script>
