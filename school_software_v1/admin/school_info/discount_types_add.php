<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name, hindi) {
  $('#discount_type1').val(name || '');
  $('#discount_type_hindi').val(hindi || '');
  $('#discount_code_hidden').val(code);
  $('#si_discount_modal_title').text(name ? 'Edit Discount Type' : 'Add Discount Type');
}

function form_submit() {
  var nm = $.trim($('#discount_type1').val());
  if (nm === '') { alert_new('Discount type name is required.', 'red'); return; }
  var $btn = $('#discount_save_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  $.ajax({
    type: "POST",
    url: access_link + "school_info/discount_types_add_api.php",
    data: {
      discount_type1:       $('#discount_type1').val(),
      discount_type_hindi:  $('#discount_type_hindi').val(),
      discount_code_hidden: $('#discount_code_hidden').val()
    },
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Discount type saved successfully!', 'green');
        $('#myModal').one('hidden.bs.modal', function () {
          get_content('school_info/discount_types_add');
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
    <li class="active"><?php echo $language['Add discounts Type']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-minus-circle"></i></div>
      <h4><?php echo $language['Add discounts Type']; ?></h4>
    </div>
    <div class="si-card-body" style="padding-top:16px;">
      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo $language['discount Type']; ?></th>
              <th><?php echo $language['discount Type Hindi']; ?></th>
              <th class="cen"><?php echo $language['Add Edit']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $que = "select * from school_info_discount_types";
            $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
            $serial_no = 0; $add_more_button = 0;
            $discount_code_blank = ''; $last_nm = ''; $last_hi = '';
            while ($row = mysqli_fetch_assoc($run)) {
                $discount_type       = $row['discount_type'];
                $discount_type_hindi = $row['discount_type_hindi'];
                $discount_code       = $row['discount_code'];
                if ($discount_type !== '' || $discount_type_hindi !== '') {
                    $serial_no++;
                    ?>
            <tr>
              <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
              <td><strong><?php echo htmlspecialchars($discount_type); ?></strong></td>
              <td><?php echo htmlspecialchars($discount_type_hindi); ?></td>
              <td class="cen">
                <button type="button" class="si-btn si-btn-ok" style="padding:5px 14px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($discount_code); ?>"
                  data-name="<?php echo htmlspecialchars($discount_type); ?>"
                  data-hindi="<?php echo htmlspecialchars($discount_type_hindi); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name,this.dataset.hindi)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> <?php echo $language['Add Edit']; ?>
                </button>
              </td>
            </tr>
                    <?php
                } else {
                    if ($add_more_button === 0) $discount_code_blank = $discount_code;
                    $last_nm = $discount_type; $last_hi = $discount_type_hindi;
                    $add_more_button++;
                }
            }
            if ($add_more_button > 0): ?>
            <tr>
              <td colspan="4" class="cen" style="padding:10px;">
                <button type="button" class="si-btn si-btn-pri" style="padding:6px 18px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($discount_code_blank); ?>"
                  data-name="<?php echo htmlspecialchars($last_nm); ?>"
                  data-hindi="<?php echo htmlspecialchars($last_hi); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name,this.dataset.hindi)"
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
        <h4 class="modal-title" id="si_discount_modal_title">Add / Edit Discount Type</h4>
      </div>
      <div class="modal-body">
        <div class="si-fg">
          <label><?php echo $language['discount Type Add Edit']; ?> <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-minus-circle ico"></i>
            <input type="text" id="discount_type1" class="si-ctrl" placeholder="Discount name (English)" required>
            <input type="hidden" id="discount_code_hidden">
          </div>
        </div>
        <div class="si-fg" style="margin-bottom:0;">
          <label><?php echo $language['discount Type Hindi Add Edit']; ?></label>
          <div class="si-iw">
            <i class="fa fa-font ico"></i>
            <input type="text" id="discount_type_hindi" class="si-ctrl" placeholder="छूट का प्रकार (हिंदी)">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="discount_save_btn" onclick="form_submit();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
