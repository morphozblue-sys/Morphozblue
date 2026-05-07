<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<style>
.si-pw-card-wrap{display:flex;justify-content:center;align-items:flex-start;padding:30px 10px 40px;min-height:70vh;}
.si-pw-card{width:100%;max-width:440px;}
.si-pw-logo{display:flex;align-items:center;justify-content:center;gap:12px;padding:20px 22px 0;}
.si-pw-logo i{font-size:28px;color:rgba(255,255,255,.85);}
.si-pw-logo span{font-size:18px;font-weight:800;color:#fff;letter-spacing:.4px;}
.si-pw-divider{height:1px;background:rgba(255,255,255,.15);margin:14px 22px;}
.si-pw-subtitle{text-align:center;color:rgba(255,255,255,.65);font-size:12px;padding:0 22px 16px;letter-spacing:.3px;}
.si-pw-strength{height:4px;border-radius:2px;margin-top:5px;background:#e2e8f0;overflow:hidden;}
.si-pw-strength-bar{height:100%;width:0;border-radius:2px;transition:width .3s,background .3s;}
.si-pw-strength-label{font-size:11px;margin-top:3px;}
</style>
<script>
function form_submit() {
  var uname = $.trim($('#cp_username').val());
  var oldpw = $.trim($('#cp_oldpw').val());
  var newpw = $.trim($('#cp_newpw').val());
  if (!uname)  { siVal(document.getElementById('cp_username')); return; }
  if (!oldpw)  { siVal(document.getElementById('cp_oldpw')); return; }
  if (!newpw)  { siVal(document.getElementById('cp_newpw')); return; }
  if (newpw.length < 6) { alert_new('New password must be at least 6 characters.', 'red'); return; }

  $.ajax({
    type: "POST",
    url: access_link + "school_info/change_password_api.php",
    data: $("#my_form").serialize(),
    success: function (detail) {
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new("Password changed successfully! Please log in again.", 'green');
        window.open('index.php', '_self');
      } else {
        alert_new("Username or old password did not match. Please try again.", 'red');
        get_content('school_info/change_password');
      }
    }
  });
}

function checkStrength(val) {
  var bar   = document.getElementById('pw_strength_bar');
  var label = document.getElementById('pw_strength_label');
  if (!bar) return;
  var score = 0;
  if (val.length >= 6)  score++;
  if (val.length >= 10) score++;
  if (/[A-Z]/.test(val)) score++;
  if (/[0-9]/.test(val)) score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;
  var map = [
    { w:'0%',  bg:'#e2e8f0', lbl:'' },
    { w:'20%', bg:'#e74c3c', lbl:'Weak' },
    { w:'40%', bg:'#e67e22', lbl:'Fair' },
    { w:'60%', bg:'#f1c40f', lbl:'Good' },
    { w:'80%', bg:'#2ecc71', lbl:'Strong' },
    { w:'100%',bg:'#27ae60', lbl:'Very Strong' },
  ];
  var m = map[score] || map[0];
  bar.style.width = m.w;
  bar.style.background = m.bg;
  label.textContent = m.lbl;
  label.style.color  = m.bg;
}
</script>

<section class="content-header">
  <h1>&nbsp;</h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Change Password</li>
  </ol>
</section>

<section class="content">
<div class="si-pw-card-wrap">
  <div class="si-pw-card">

    <div class="si-card">
      <!-- Gradient header with icon -->
      <div class="si-card-header" style="flex-direction:column;gap:4px;padding:0 0 16px;">
        <div class="si-pw-logo">
          <i class="fa fa-lock"></i>
          <span>Change Password</span>
        </div>
        <div class="si-pw-divider"></div>
        <p class="si-pw-subtitle">Enter your credentials below to set a new password.</p>
      </div>

      <div class="si-card-body">
        <form method="post" id="my_form">

          <!-- Username -->
          <div class="si-fg">
            <label>Username <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-user ico"></i>
              <input type="text" name="user_name" id="cp_username" required
                placeholder="Your username"
                class="si-ctrl" autocomplete="username"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="cp_username_err"></div>
          </div>

          <!-- Old Password -->
          <div class="si-fg">
            <label>Current Password <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-lock ico"></i>
              <input type="password" name="old_password" id="cp_oldpw" required
                placeholder="Current password"
                class="si-ctrl" autocomplete="current-password"
                onblur="siVal(this)">
              <button type="button" class="si-pw-btn" onclick="siPwToggle('cp_oldpw',this)" tabindex="-1">
                <i class="fa fa-eye"></i>
              </button>
            </div>
            <div class="si-err" id="cp_oldpw_err"></div>
          </div>

          <!-- New Password -->
          <div class="si-fg">
            <label>New Password <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-key ico"></i>
              <input type="password" name="new_password" id="cp_newpw" required
                placeholder="Minimum 6 characters"
                class="si-ctrl" autocomplete="new-password"
                onblur="siVal(this)"
                oninput="checkStrength(this.value)">
              <button type="button" class="si-pw-btn" onclick="siPwToggle('cp_newpw',this)" tabindex="-1">
                <i class="fa fa-eye"></i>
              </button>
            </div>
            <div class="si-pw-strength">
              <div class="si-pw-strength-bar" id="pw_strength_bar"></div>
            </div>
            <div class="si-pw-strength-label" id="pw_strength_label"></div>
            <div class="si-err" id="cp_newpw_err"></div>
          </div>

          <!-- Submit -->
          <div style="margin-top:8px;">
            <button type="button" onclick="form_submit();"
              class="si-btn si-btn-pri si-btn-lg"
              style="width:100%;justify-content:center;">
              <i class="fa fa-check-circle"></i> Change Password
            </button>
          </div>

        </form>
      </div>
    </div><!-- /si-card -->

  </div>
</div>
</section>
