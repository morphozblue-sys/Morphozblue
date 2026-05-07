<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name) {
  var parts = name.split('-');
  $('#fee_type1').val(parts[0] || '');
  $('#fee_type_hindi').val(parts[1] || '');
  $('#fee_code_hidden').val(code);
  $('#si_fee_modal_title').text(parts[0] ? 'Edit Fee Type' : 'Add Fee Type');
}

$(document).ready(function () {
  $("#my_form").off('submit').on('submit', function (e) {
    e.preventDefault();
    var ft = $.trim($('#fee_type1').val());
    if (ft === '') { alert_new('Fee type name is required.', 'red'); return; }
    var $btn = $(this).find('[type=submit]');
    $btn.prop('disabled', true);
    var formdata = new FormData(this);
    $.ajax({
      url: access_link + "school_info/fee_types_add_api.php",
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
          alert_new('Fee type saved successfully!', 'green');
          $('#myModal').one('hidden.bs.modal', function () {
            get_content('school_info/fee_types_add');
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
  });
});
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
      <div class="si-hdr-ico"><i class="fa fa-inr"></i></div>
      <h4><?php echo $language['Add Fees Type']; ?></h4>
    </div>
    <div class="si-card-body">

      <?php
      $ser_limit = ($_SESSION['database_name1'] === 'livingstonenagaland') ? 11 : 10;
      $que = "select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
      $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
      $serial_no = 0; $add_more_button = 0; $fee_code_blank = ''; $last_fee_type = ''; $last_hindi = '';
      $rows = [];
      while ($row = mysqli_fetch_assoc($run)) {
        if ($row['fee_type'] !== '' || $row['fee_type_hindi'] !== '') {
          $rows[] = $row; $serial_no++;
        } else {
          if ($add_more_button === 0) $fee_code_blank = $row['fee_code'];
          $last_fee_type  = $row['fee_type'];
          $last_hindi     = $row['fee_type_hindi'];
          $add_more_button++;
        }
      }
      ?>

      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo $language['Fee Type']; ?></th>
              <th><?php echo $language['Fee Type Hindi']; ?></th>
              <th class="cen"><?php echo $language['Add Edit']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $i => $r): ?>
            <tr>
              <td><span class="si-sno"><?php echo $i + 1; ?></span></td>
              <td><?php echo htmlspecialchars($r['fee_type']); ?></td>
              <td><?php echo htmlspecialchars($r['fee_type_hindi']); ?></td>
              <td class="cen">
                <button type="button"
                  class="si-btn si-btn-ok"
                  style="padding:5px 14px;font-size:12px;"
                  id="<?php echo htmlspecialchars($r['fee_code']); ?>"
                  name="<?php echo htmlspecialchars($r['fee_type'].'-'.$r['fee_type_hindi']); ?>"
                  onclick="add_edit(this.id,this.name)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> Edit
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php if ($add_more_button > 0 && $serial_no < $ser_limit): ?>
            <tr>
              <td colspan="4" class="cen" style="padding:12px;">
                <button type="button"
                  class="si-btn si-btn-pri"
                  id="<?php echo htmlspecialchars($fee_code_blank); ?>"
                  name="<?php echo htmlspecialchars($last_fee_type.'-'.$last_hindi); ?>"
                  onclick="add_edit(this.id,this.name)"
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

<!-- ══ Add / Edit Fee Type Modal ══ -->
<div class="modal fade si-modal" id="myModal" role="dialog">
  <form role="form" method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" id="myModal_close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="si_fee_modal_title">Add / Edit Fee Type</h4>
        </div>

        <div class="modal-body">
          <div class="si-fg">
            <label><?php echo $language['Fee Type Add Edit']; ?><span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-inr ico"></i>
              <input type="text" name="fee_type1" id="fee_type1" class="si-ctrl"
                placeholder="Fee type name (English)" required>
              <input type="hidden" name="fee_code_hidden" id="fee_code_hidden">
            </div>
          </div>
          <div class="si-fg" style="margin-bottom:0;">
            <label><?php echo $language['Fee Type Hindi Add Edit']; ?></label>
            <div class="si-iw">
              <i class="fa fa-font ico"></i>
              <input type="text" name="fee_type_hindi" id="fee_type_hindi" class="si-ctrl"
                placeholder="शुल्क प्रकार (हिंदी)">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="finish" class="si-btn si-btn-ok">
            <i class="fa fa-check"></i> <?php echo $language['Add']; ?>
          </button>
          <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
            <i class="fa fa-times"></i> <?php echo $language['Close']; ?>
          </button>
        </div>

      </div>
    </div>
  </form>
</div>
