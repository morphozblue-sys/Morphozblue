<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name) {
  $('#fee_type1').val(name || '');
  $('#fee_code_hidden').val(code);
  $('#si_feenew_modal_title').text(name ? 'Edit Fee Head' : 'Add Fee Head');
}

function form_submit() {
  var nm = $.trim($('#fee_type1').val());
  if (nm === '') { alert_new('Fee head name is required.', 'red'); return; }
  var $btn = $('#feenew_save_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  $.ajax({
    type: "POST",
    url: access_link + "school_info/fee_types_add_new_fees_api.php",
    data: { fee_type1: $('#fee_type1').val(), fee_code_hidden: $('#fee_code_hidden').val() },
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Fee head saved successfully!', 'green');
        $('#myModal').one('hidden.bs.modal', function () {
          get_content('school_info/fee_types_add_new_fees');
        });
        $('#myModal').modal('hide');
      } else {
        alert_new('Could not save. Please try again.', 'red');
      }
    },
    error: function () {
      $btn.prop('disabled', false);
      alert_new('Connection error. Please try again.', 'red');
    }
  });
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['Add Fees Type']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-tag"></i></div>
      <h4><?php echo $language['Add Fees Type']; ?></h4>
    </div>
    <div class="si-card-body" style="padding-top:16px;">
      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th>Fee Head Name</th>
              <th>Fee Head Code</th>
              <th class="cen"><?php echo $language['Add Edit']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $que = "select * from new_fees_fee_head";
            $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
            $serial_no = 0; $add_more_button = 0;
            $fee_code_blank = ''; $fee_name_blank = '';
            while ($row = mysqli_fetch_assoc($run)) {
                $fee_head_name = $row['fee_head_name'];
                $fee_head_code = $row['fee_head_code'];
                if ($fee_head_name !== '') {
                    $serial_no++;
                    ?>
            <tr>
              <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
              <td><strong><?php echo htmlspecialchars($fee_head_name); ?></strong></td>
              <td><span class="si-badge si-badge-sec"><?php echo htmlspecialchars($fee_head_code); ?></span></td>
              <td class="cen">
                <button type="button" class="si-btn si-btn-ok" style="padding:5px 14px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($fee_head_code); ?>"
                  data-name="<?php echo htmlspecialchars($fee_head_name); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> <?php echo $language['Add Edit']; ?>
                </button>
              </td>
            </tr>
                    <?php
                } else {
                    if ($add_more_button === 0) { $fee_code_blank = $fee_head_code; $fee_name_blank = $fee_head_name; }
                    $add_more_button++;
                }
            }
            if ($add_more_button > 0 && $serial_no < 10): ?>
            <tr>
              <td colspan="4" class="cen" style="padding:10px;">
                <button type="button" class="si-btn si-btn-pri" style="padding:6px 18px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($fee_code_blank); ?>"
                  data-name="<?php echo htmlspecialchars($fee_name_blank); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i> <?php echo $language['Add More']; ?>
                </button>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</section>

<div class="modal fade si-modal" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="si_feenew_modal_title">Add / Edit Fee Head</h4>
      </div>
      <div class="modal-body">
        <div class="si-fg" style="margin-bottom:0;">
          <label><?php echo $language['Fee Type Add Edit']; ?> <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-tag ico"></i>
            <input type="text" id="fee_type1" class="si-ctrl" placeholder="Fee head name" required>
            <input type="hidden" id="fee_code_hidden">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="feenew_save_btn" onclick="form_submit();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
