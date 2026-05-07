<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();

}
 
// Validate school_software_version against an allowlist to prevent path traversal.

// Adjust the allowed list to match your actual deployed versions.

$raw_version = $_SESSION['school_software_version'] ?? '';

if (!preg_match('/^[A-Za-z0-9._-]+$/', $raw_version)) {

    http_response_code(400);

    exit('Invalid software version.');

}

$school_software_version = $raw_version;
 
// session_id: prefer GET, fall back to session. Sanitize either way.

$raw_session_id = $_GET['session_id'] ?? ($_SESSION['session_id'] ?? '');

$session_id23   = preg_replace('/[^A-Za-z0-9._-]/', '', (string)$raw_session_id);
 
$hindi_typing = $_SESSION['hindi_typing'] ?? '';
 
include "../$school_software_version/admin/attachment/session_index.php";
 
// Helper to keep the template clean

function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Bluemorphoz</title>
<?php include "../$school_software_version/admin/attachment/link_css.php"; ?>
</head>
<body>
 
    <input type="hidden" id="language_change_37"       value="<?= h($hindi_typing) ?>">
<input type="hidden" id="school_software_version_id" value="<?= h($school_software_version) ?>">
<input type="hidden" id="session_id23"             value="<?= h($session_id23) ?>">
<input type="hidden" id="hidden_value1" value="">
<input type="hidden" id="hidden_value2" value="">
 
    <div class="wrapper">
<?php include "../$school_software_version/admin/attachment/header_index.php"; ?>
<?php include "../$school_software_version/admin/attachment/sidebar_index.php"; ?>
 
        <div class="content-wrapper">
<div class="content" id="get_content"></div>
<div id="snackbar_new"></div>
<?php include "../$school_software_version/admin/attachment/footer.php"; ?>
</div>
</div>
 
    <?php include "../$school_software_version/admin/attachment/link_js.php"; ?>
 
    <script>

    (function () {

        // Cache values once

        const session_id231           = document.getElementById('session_id23').value;

        const school_software_version = document.getElementById('school_software_version_id').value;

        const langue345               = document.getElementById('language_change_37').value;
 
        // Kept for backward compatibility with other scripts that may reference them

        window.session_id231           = session_id231;

        window.school_software_version = school_software_version;

        window.access_link             = '../' + school_software_version + '/admin/';

        window.css_js_path             = '../../' + school_software_version;
 
        const LOADER = "<div class='card-body is-loading is-loading-lg'></div>";

        const $content       = $("#get_content");

        const $hiddenValue1  = $('#hidden_value1');

        const $hiddenValue2  = $('#hidden_value2');
 
        // Right-click rewrite: replace single-quoted segments inside href with hash links.

        // Was iterating the live NodeList 3x per element — now once.

        function rewriteAnchorHrefs() {

            const baseUrl = window.location.href.split('#')[0];

            const anchors = document.getElementsByTagName('a');

            for (let i = 0, len = anchors.length; i < len; i++) {

                const parts = anchors[i].href.split("'");

                if (parts.length > 1) {

                    anchors[i].href = baseUrl + '#' + parts[1];

                }

            }

        }

        // contextmenu fires on right-click specifically — better than onmousedown+button check

        document.addEventListener('contextmenu', rewriteAnchorHrefs);
 
        // Shared hidden-flag toggle used by both get/post

        function toggleHiddenFlags() {

            if ($hiddenValue2.val() == 0) {

                $hiddenValue1.val('0');

            } else {

                $hiddenValue2.val('0');

            }

        }
 
        function buildAdminUrl(link, query) {

            return '../../' + school_software_version + '/admin/' + link + '.php' + (query ? '?' + query : '');

        }
 
        window.get_content = function (link) {

            $content.html(LOADER);

            toggleHiddenFlags();

            const query = 'session_id=' + encodeURIComponent(session_id231);

            $.get(buildAdminUrl(link, query), function (data) {

                $content.html(data);

                window.location.hash = '#' + link + '?' + query;

            });

        };
 
        window.post_content = function (link, content) {

            $content.html(LOADER);

            toggleHiddenFlags();
 
            const firstKey = content.split('=')[0];

            const sessionPrefix = (firstKey === 'session_id')

                ? ''

                : 'session_id=' + encodeURIComponent(session_id231) + '&';
 
            const fullQuery = sessionPrefix + content;

            $.ajax({

                type: 'POST',

                url: buildAdminUrl(link, fullQuery),

                cache: false,

                success: function (data) {

                    $content.html(data);

                    window.location.hash = '#' + link + '?' + fullQuery;

                }

            });

        };
 
        function url_control() {

            const parts = window.location.href.split('#');

            if (parts.length < 2) {

                get_content('index_content');

                return;

            }

            const sub = parts[1].split('?');

            if (sub.length < 2) {

                get_content(parts[1]);

            } else {

                post_content(sub[0], sub[1]);

            }

        }
 
        $(window).on('popstate', function () {

            if ($hiddenValue1.val() == 0) {

                $hiddenValue1.val('1');

                $hiddenValue2.val('0');

            } else {

                $hiddenValue2.val('1');

                url_control();

            }

        });
 
        $(document).ready(function () {

            url_control();
 
            // Pramukh IME setup

            pramukhIME.addKeyboard(PramukhIndic);

            pramukhIME.enable();
 
            if (langue345 === 'Hindi') {

                pramukhIME.setLanguage('hindi', 'pramukhindic');

                pramukhIME.setSettings([

                    { language: 'all', kb: 'pramukhindic', digitInEnglish: true }

                ]);

            } else {

                pramukhIME.setLanguage('english', 'pramukhime');

            }

        });

    })();
</script>
 
    <script src="../<?= h($school_software_version) ?>/admin/attachment/file_check.js"></script>
</body>
</html>
 