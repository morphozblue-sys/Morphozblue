<?php include("../attachment/session.php");
$que = "select * from school_info_general";
$run = mysqli_query($conn73, $que);
while ($row = mysqli_fetch_assoc($run)) {
    $s_no                          = $row['s_no'];
    $school_info_school_name       = $row['school_info_school_name'];
    $school_info_school_state      = $row['school_info_school_state'];
    $school_info_school_district   = $row['school_info_school_district'];
    $school_info_school_city       = $row['school_info_school_city'];
    $school_info_school_pincode    = $row['school_info_school_pincode'];
    $school_info_school_landmark   = $row['school_info_school_landmark'];
    $school_info_school_latitude   = $row['school_info_school_latitude'];
    $school_info_school_longitude  = $row['school_info_school_longitude'];
    $school_info_school_address    = $row['school_info_school_address'];
    $school_info_school_contact_no = $row['school_info_school_contact_no'];
    $school_info_school_email_id   = $row['school_info_school_email_id'];
    $school_info_school_website    = $row['school_info_school_website'];
    $school_info_principal_name    = $row['school_info_principal_name'];
    $school_info_dise_code         = $row['school_info_dise_code'];
    $school_info_school_code       = $row['school_info_school_code'];
    $school_info_registration_code = $row['school_info_registration_code'];
    $school_info_total_class       = $row['school_info_total_class'];
    $school_info_medium            = $row['school_info_medium'];
    $school_info_school_board      = $row['school_info_school_board'];
    $school_info_student_type      = $row['school_info_student_type'];
    $school_info_student_category  = $row['school_info_student_category'];
    $school_info_about             = $row['school_info_about'];
    $database_version              = $row['database_version'];
    $fees_category                 = $row['fees_category'];
    $blank_field_1                 = $row['blank_field_1'];
    $attendance_machine_message    = $row['attendance_machine_message'];
    $defalut_session_value         = $row['defalut_session_value'];
    $multiple_school               = $row['multiple_school'];
    $school_info_principal_seal    = $row['school_info_principal_seal_name'];
    $school_info_principal_signature = $row['school_info_principal_signature_name'];
    $school_info_logo              = $row['school_info_logo_name'];
}
?>
<?php include("si_form_ui.php"); ?>
<script>
$(document).ready(function () {

  /* ── Form submit via AJAX ── */
  $("#si_gen_form").submit(function (e) {
    e.preventDefault();
    var $form = $(this);
    var $btn  = $form.find('[type="submit"]');
    if ($btn.prop('disabled')) return;
    /* Client-side validation sweep */
    var allOk = true;
    $form.find('.si-ctrl[required], .si-ctrl[data-req]').each(function () {
      if (!siVal(this)) allOk = false;
    });
    if (!allOk) { alert_new('Please fix the highlighted errors before saving.', 'red'); return; }
    $btn.prop('disabled', true);
    window.scrollTo(0, 0);
    loader();
    var formdata = new FormData(this);
    $.ajax({
      url: access_link + "school_info/school_info_general_api.php",
      type: "POST",
      data: formdata,
      mimeTypes: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success: function (detail) {
        $btn.prop('disabled', false);
        var res = detail.split("|?|");
        if (res[1] === 'success') {
          alert_new('School information saved successfully!', 'green');
          get_content('school_info/school_info_general');
        } else {
          alert_new('Something went wrong. Please try again.', 'red');
          get_content('school_info/school_info_general');
        }
      },
      error: function () {
        $btn.prop('disabled', false);
        alert_new('Connection error. Please try again.', 'red');
        get_content('school_info/school_info_general');
      }
    });
  });

});

/* ── Image lightbox ── */
function open_file1(image_type) {
  $.ajax({
    type: "POST",
    url: access_link + "school_info/ajax_open_image.php?image_type=" + image_type,
    cache: false,
    success: function (detail) {
      $("#mypdf_view").html(detail);
    }
  });
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['School General Info']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

<form method="post" enctype="multipart/form-data" id="si_gen_form">

  <!-- ══ CARD 1 — Identification ══ -->
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-id-card-o"></i></div>
      <h4><?php echo $language['School General Info']; ?></h4>
    </div>
    <div class="si-card-body">

      <div class="si-sec">School Identification</div>
      <div class="row">

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Name']; ?><span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-university ico"></i>
              <input type="text" name="school_info_school_name" id="sig_name" required
                placeholder="Full school name"
                value="<?php echo htmlspecialchars($school_info_school_name); ?>"
                class="si-ctrl" maxlength="150"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_name_err"></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Principal Name']; ?></label>
            <div class="si-iw">
              <i class="fa fa-user-tie ico" style="font-family:FontAwesome;"></i>
              <i class="fa fa-user ico"></i>
              <input type="text" name="school_info_principal_name" id="sig_principal"
                placeholder="Principal full name"
                value="<?php echo htmlspecialchars($school_info_principal_name); ?>"
                class="si-ctrl" maxlength="100"
                onblur="siVal(this)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label>
              <?php if ($_SESSION['database_name'] === 'simptczo_svhschoolchhapra'): ?>
                Affiliation No
              <?php else: ?>
                <?php echo $language['Dise Code']; ?>
              <?php endif; ?>
            </label>
            <div class="si-iw">
              <i class="fa fa-barcode ico"></i>
              <input type="text" name="school_info_dise_code" id="sig_dise"
                placeholder="DISE / Affiliation code"
                value="<?php echo htmlspecialchars($school_info_dise_code); ?>"
                class="si-ctrl" maxlength="30"
                onblur="siVal(this)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Code']; ?></label>
            <div class="si-iw">
              <i class="fa fa-tag ico"></i>
              <input type="text" name="school_info_school_code" id="sig_scode"
                placeholder="School code"
                value="<?php echo htmlspecialchars($school_info_school_code); ?>"
                class="si-ctrl" maxlength="30">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Registration Code']; ?></label>
            <div class="si-iw">
              <i class="fa fa-certificate ico"></i>
              <input type="text" name="school_info_registration_code" id="sig_regcode"
                placeholder="Registration code"
                value="<?php echo htmlspecialchars($school_info_registration_code); ?>"
                class="si-ctrl" maxlength="30">
            </div>
          </div>
        </div>

      </div><!-- /row identification -->

      <!-- ══ Location ══ -->
      <div class="si-sec">Location</div>
      <div class="row">

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['State']; ?></label>
            <div class="si-iw">
              <i class="fa fa-map ico"></i>
              <input type="text" name="school_info_school_state"
                placeholder="State"
                value="<?php echo htmlspecialchars($school_info_school_state); ?>"
                class="si-ctrl" maxlength="60">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['District']; ?></label>
            <div class="si-iw">
              <i class="fa fa-map-marker ico"></i>
              <input type="text" name="school_info_school_district"
                placeholder="District"
                value="<?php echo htmlspecialchars($school_info_school_district); ?>"
                class="si-ctrl" maxlength="60">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['City']; ?></label>
            <div class="si-iw">
              <i class="fa fa-building ico"></i>
              <input type="text" name="school_info_school_city"
                placeholder="City / Town"
                value="<?php echo htmlspecialchars($school_info_school_city); ?>"
                class="si-ctrl" maxlength="60">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Pincode']; ?></label>
            <div class="si-iw">
              <i class="fa fa-mail-bulk ico" style="font-family:FontAwesome;"></i>
              <i class="fa fa-hashtag ico"></i>
              <input type="text" name="school_info_school_pincode" id="sig_pin"
                placeholder="6-digit pincode" data-pin
                value="<?php echo htmlspecialchars($school_info_school_pincode); ?>"
                class="si-ctrl" maxlength="10"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_pin_err"></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Landmark']; ?></label>
            <div class="si-iw">
              <i class="fa fa-flag ico"></i>
              <input type="text" name="school_info_school_landmark"
                placeholder="Nearby landmark"
                value="<?php echo htmlspecialchars($school_info_school_landmark); ?>"
                class="si-ctrl" maxlength="100">
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="si-fg">
            <label><?php echo $language['School Address']; ?></label>
            <div class="si-iw">
              <i class="fa fa-home ico"></i>
              <input type="text" name="school_info_school_address"
                placeholder="Full address"
                value="<?php echo htmlspecialchars($school_info_school_address); ?>"
                class="si-ctrl" maxlength="200">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Latitude']; ?> <span class="si-tip" title="GPS latitude, e.g. 23.259933">?</span></label>
            <div class="si-iw">
              <i class="fa fa-compass ico"></i>
              <input type="text" name="school_info_school_latitude" id="sig_lat"
                placeholder="e.g. 23.259933" data-latlng
                value="<?php echo htmlspecialchars($school_info_school_latitude); ?>"
                class="si-ctrl" maxlength="20"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_lat_err"></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Longitude']; ?> <span class="si-tip" title="GPS longitude, e.g. 77.412615">?</span></label>
            <div class="si-iw">
              <i class="fa fa-compass ico"></i>
              <input type="text" name="school_info_school_longitude" id="sig_lng"
                placeholder="e.g. 77.412615" data-latlng
                value="<?php echo htmlspecialchars($school_info_school_longitude); ?>"
                class="si-ctrl" maxlength="20"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_lng_err"></div>
          </div>
        </div>

      </div><!-- /row location -->

      <!-- ══ Contact ══ -->
      <div class="si-sec">Contact</div>
      <div class="row">

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Contact No']; ?></label>
            <div class="si-iw">
              <i class="fa fa-phone ico"></i>
              <input type="tel" name="school_info_school_contact_no" id="sig_phone"
                placeholder="Contact number" data-tel
                value="<?php echo htmlspecialchars($school_info_school_contact_no); ?>"
                class="si-ctrl" maxlength="20"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_phone_err"></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Email Id']; ?></label>
            <div class="si-iw">
              <i class="fa fa-envelope ico"></i>
              <input type="email" name="school_info_school_email_id" id="sig_email"
                placeholder="admin@school.edu" data-email
                value="<?php echo htmlspecialchars($school_info_school_email_id); ?>"
                class="si-ctrl" maxlength="100"
                onblur="siVal(this)">
            </div>
            <div class="si-err" id="sig_email_err"></div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Website']; ?></label>
            <div class="si-iw">
              <i class="fa fa-globe ico"></i>
              <input type="text" name="school_info_school_website"
                placeholder="www.school.edu"
                value="<?php echo htmlspecialchars($school_info_school_website); ?>"
                class="si-ctrl" maxlength="100">
            </div>
          </div>
        </div>

      </div><!-- /row contact -->

    </div><!-- /si-card-body -->
  </div><!-- /card 1 -->

  <!-- ══ CARD 2 — Academic Configuration ══ -->
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-cogs"></i></div>
      <h4>Academic Configuration</h4>
    </div>
    <div class="si-card-body">
      <div class="row">

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['School Board']; ?></label>
            <div class="si-iw no-ico">
              <select name="school_info_school_board" class="si-ctrl">
                <option <?php if (in_array($school_info_school_board, ['State Board','MP Board','Bihar Board','Rajsthan Board','Both'])) echo 'selected'; ?> value="State Board">State Board</option>
                <option <?php if ($school_info_school_board === 'CBSE Board') echo 'selected'; ?> value="CBSE Board">CBSE Board</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Student Type']; ?></label>
            <div class="si-iw no-ico">
              <select name="school_info_student_type" class="si-ctrl">
                <option <?php if ($school_info_student_type === 'Regular') echo 'selected'; ?> value="Regular">Regular</option>
                <option <?php if ($school_info_student_type === 'Regular + Unregular') echo 'selected'; ?> value="Regular + Unregular">Regular + Unregular</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label><?php echo $language['Student Category']; ?></label>
            <div class="si-iw no-ico">
              <select name="school_info_student_category" class="si-ctrl">
                <option <?php if ($school_info_student_category === 'Non EWS') echo 'selected'; ?> value="Non EWS">Non EWS</option>
                <option <?php if ($school_info_student_category === 'EWS + Non EWS') echo 'selected'; ?> value="EWS + Non EWS">EWS + Non EWS</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label>Fee Type</label>
            <div class="si-iw no-ico">
              <select name="fees_category" class="si-ctrl">
                <option <?php if ($fees_category === 'monthly') echo 'selected'; ?> value="monthly">Monthly Fees</option>
                <option <?php if ($fees_category === 'yearly') echo 'selected'; ?> value="yearly">Yearly Fees</option>
                <option <?php if ($fees_category === 'installmentwise') echo 'selected'; ?> value="installmentwise">Installment-wise Fees</option>
                <option <?php if ($fees_category === 'fees') echo 'selected'; ?> value="fees">Old Fees</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="si-fg">
            <label>Default Session</label>
            <div class="si-iw no-ico">
              <select name="defalut_session_value" class="si-ctrl">
                <?php
                $session_value23 = $_SESSION['session_value_array'];
                foreach ($session_value23 as $sv) {
                    $parts = explode('_', $sv);
                    $show  = $parts[0] . '-' . $parts[1];
                    $sel   = ($defalut_session_value === $sv) ? 'selected' : '';
                    echo "<option $sel value=\"" . htmlspecialchars($sv) . "\">" . htmlspecialchars($show) . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>

      </div><!-- /row academic -->

      <!-- Medium is always hidden (preserved for DB) -->
      <div style="display:none;">
        <select name="school_info_medium">
          <option value="<?php echo htmlspecialchars($school_info_medium); ?>" selected><?php echo htmlspecialchars($school_info_medium); ?></option>
          <?php if ($school_info_medium === 'Both'): ?>
            <option value="English">English</option>
            <option value="Hindi">Hindi</option>
          <?php endif; ?>
        </select>
      </div>

      <!-- Hidden: short name for SMS -->
      <input type="hidden" name="multiple_school" value="<?php echo htmlspecialchars($multiple_school); ?>">

    </div>
  </div><!-- /card 2 -->

  <!-- ══ CARD 3 — Documents & Branding ══ -->
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-image"></i></div>
      <h4>Documents &amp; Branding</h4>
    </div>
    <div class="si-card-body">

      <div class="si-doc-row">

        <!-- Principal Seal -->
        <div class="si-doc-item">
          <span><?php echo $language['Principal Seal']; ?></span>
          <div class="si-file">
            <i class="fa fa-stamp si-file-ico" style="font-family:FontAwesome;"></i>
            <i class="fa fa-upload si-file-ico"></i>
            <input type="file" name="school_info_principal_seal"
              id="school_info_principal_seal"
              accept=".gif,.jpg,.jpeg,.png"
              onchange="check_file_type(this,'school_info_principal_seal','img_seal','image'); siFileLabel(this,'lbl_seal');">
            <span id="lbl_seal">Choose image…</span>
          </div>
          <img onclick="open_file1('school_info_principal_seal');"
            src="<?php echo $school_info_principal_seal ? $_SESSION['amazon_file_path'].'school_document/'.$school_info_principal_seal : $school_software_path.'images/student_blank.png'; ?>"
            id="img_seal" class="si-img" alt="Seal">
        </div>

        <!-- Principal Signature -->
        <div class="si-doc-item">
          <span><?php echo $language['Principal']; ?> Signature</span>
          <div class="si-file">
            <i class="fa fa-pen si-file-ico" style="font-family:FontAwesome;"></i>
            <i class="fa fa-pencil si-file-ico"></i>
            <input type="file" name="school_info_principal_signature"
              id="school_info_principal_signature"
              accept=".gif,.jpg,.jpeg,.png"
              onchange="check_file_type(this,'school_info_principal_signature','img_sig','image'); siFileLabel(this,'lbl_sig');">
            <span id="lbl_sig">Choose image…</span>
          </div>
          <img onclick="open_file1('school_info_principal_signature');"
            src="<?php echo $school_info_principal_signature ? $_SESSION['amazon_file_path'].'school_document/'.$school_info_principal_signature : $school_software_path.'images/student_blank.png'; ?>"
            id="img_sig" class="si-img" alt="Signature">
        </div>

        <!-- School Logo -->
        <div class="si-doc-item">
          <span><?php echo $language['Logo']; ?></span>
          <div class="si-file">
            <i class="fa fa-image si-file-ico"></i>
            <input type="file" name="school_info_logo"
              id="school_info_logo"
              accept=".gif,.jpg,.jpeg,.png"
              onchange="check_file_type(this,'school_info_logo','img_logo','image'); siFileLabel(this,'lbl_logo');">
            <span id="lbl_logo">Choose image…</span>
          </div>
          <img onclick="open_file1('school_info_logo');"
            src="<?php echo $school_info_logo ? $_SESSION['amazon_file_path'].'school_document/'.$school_info_logo : $school_software_path.'images/student_blank.png'; ?>"
            id="img_logo" class="si-img" alt="Logo">
        </div>

      </div><!-- /si-doc-row -->

      <!-- About School -->
      <div class="si-sec" style="margin-top:24px;">About School</div>
      <div class="si-fg">
        <label>School Description</label>
        <div class="si-iw">
          <i class="fa fa-file-text-o ico-ta"></i>
          <textarea name="school_info_about" class="si-ctrl" maxlength="500" rows="4"
            placeholder="Brief description about the school…"><?php echo htmlspecialchars($school_info_about); ?></textarea>
        </div>
        <div class="si-hint">Maximum 500 characters</div>
      </div>

      <!-- Submit -->
      <?php if ($_SESSION['database_name1'] !== 'demo' || (isset($_GET['edit']) && $_GET['edit'] == 1)): ?>
      <div class="si-submit-bar">
        <button type="submit" class="si-btn si-btn-pri si-btn-lg">
          <i class="fa fa-save"></i> <?php echo $language['Submit']; ?>
        </button>
      </div>
      <?php endif; ?>

    </div>
  </div><!-- /card 3 -->

</form>

<div id="mypdf_view"></div>

</div><!-- /padding wrap -->
</section>
