<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<style>
.si-class-block{margin-bottom:20px;}
.si-class-block .si-class-toggle{background:linear-gradient(135deg,#1e293b,#334155);color:#fff;border:none;width:100%;text-align:left;padding:10px 16px;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:space-between;transition:background .2s;}
.si-class-block .si-class-toggle:hover{background:linear-gradient(135deg,#0f3460,#1a1a2e);}
.si-class-block .si-class-toggle i.toggle-icon{transition:transform .25s;}
.si-class-block.open .si-class-toggle i.toggle-icon{transform:rotate(180deg);}
.si-class-tbl{display:none;margin-top:8px;}
.si-class-block.open .si-class-tbl{display:block;}
</style>
<script>
function add_edit(code, name) {
  var parts = name.split('-');
  $('#exam_type1').val(parts[0] || '');
  $('#exam_type_hindi').val(parts[1] || '');
  $('#class_code_hidden').val(parts[2] || '');
  $('#exam_code_hidden').val(code);
  $('#s_no_hidden').val(parts[3] || '');
  var lbl = parts[0] ? 'Edit Exam Type' : 'Add Exam Type';
  if (parts[2]) lbl += ' — ' + ($('#si_class_lbl_' + parts[2]).text() || '');
  $('#si_exam_modal_title').text(lbl);
}

function form_submit() {
  var et = $.trim($('#exam_type1').val());
  if (et === '') { alert_new('Exam type name is required.', 'red'); return; }
  var $btn = $('#exam_save_btn');
  $btn.prop('disabled', true);
  var payload = {
    exam_type1:        $('#exam_type1').val(),
    exam_type_hindi:   $('#exam_type_hindi').val(),
    exam_code_hidden:  $('#exam_code_hidden').val(),
    class_code_hidden: $('#class_code_hidden').val(),
    s_no_hidden:       $('#s_no_hidden').val()
  };
  $.ajax({
    type: "POST",
    url: access_link + "school_info/exam_type_add_cbse_api.php",
    data: payload,
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Exam type saved successfully!', 'green');
        $('#myModal').one('hidden.bs.modal', function () {
          get_content('school_info/exam_type_add_cbse');
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

$(document).ready(function () {
  $(document).on('click', '.si-class-toggle', function () {
    $(this).closest('.si-class-block').toggleClass('open');
  });
  $('.si-class-block:first').addClass('open');
});
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['Add exams Type']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-certificate"></i></div>
      <h4><?php echo $language['Add exams Type']; ?> (CBSE)</h4>
    </div>
    <div class="si-card-body">

      <?php
      $que3 = "select * from school_info_class_info";
      $run3 = mysqli_query($conn73, $que3) or die(mysqli_error($conn73));
      while ($row3 = mysqli_fetch_assoc($run3)):
          $class_name = $row3['class_name'];
          $class_code = $row3['class_code'];

          $que  = "select * from school_info_exam_types_cbse where class_code='$class_code' and (session_value='$session1' || session_value='') $filter37";
          $run  = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
          $rows = []; $add_more_button = 0; $exam_code_blank = '';
          $last_et = ''; $last_eth = '';
          while ($row = mysqli_fetch_assoc($run)) {
              if ($row['exam_type'] !== '' || $row['exam_type_hindi'] !== '') {
                  $rows[] = $row;
              } else {
                  if ($add_more_button === 0) $exam_code_blank = $row['exam_code'];
                  $last_et  = $row['exam_type'];
                  $last_eth = $row['exam_type_hindi'];
                  $add_more_button++;
              }
          }
      ?>
      <div class="si-class-block">
        <button type="button" class="si-class-toggle">
          <span>
            <i class="fa fa-certificate" style="margin-right:8px;"></i>
            <?php echo $language['Exam Type Add For']; ?> <strong style="margin-left:6px;"><?php echo htmlspecialchars($class_name); ?></strong>
            <span id="si_class_lbl_<?php echo htmlspecialchars($class_code); ?>" style="display:none;"><?php echo htmlspecialchars($class_name); ?></span>
          </span>
          <span>
            <span class="si-badge si-badge-sec" style="margin-right:8px;"><?php echo count($rows); ?> type<?php echo count($rows) !== 1 ? 's' : ''; ?></span>
            <i class="fa fa-chevron-down toggle-icon"></i>
          </span>
        </button>

        <div class="si-class-tbl">
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo $language['Exam Type']; ?></th>
                  <th><?php echo $language['Exam Type Hindi']; ?></th>
                  <th class="cen">Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $i => $r): ?>
                <tr>
                  <td><span class="si-sno"><?php echo $i + 1; ?></span></td>
                  <td><?php echo htmlspecialchars($r['exam_type']); ?></td>
                  <td><?php echo htmlspecialchars($r['exam_type_hindi']); ?></td>
                  <td class="cen">
                    <button type="button"
                      class="si-btn si-btn-ok"
                      style="padding:5px 12px;font-size:12px;"
                      id="<?php echo htmlspecialchars($r['exam_code']); ?>"
                      name="<?php echo htmlspecialchars($r['exam_type'].'-'.$r['exam_type_hindi'].'-'.$class_code.'-'.$r['s_no']); ?>"
                      onclick="add_edit(this.id,this.name)"
                      data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-pencil"></i> Edit
                    </button>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php if ($add_more_button > 0): ?>
                <tr>
                  <td colspan="4" class="cen" style="padding:10px;">
                    <button type="button"
                      class="si-btn si-btn-pri"
                      style="padding:6px 16px;font-size:12px;"
                      id="<?php echo htmlspecialchars($exam_code_blank); ?>"
                      name="<?php echo htmlspecialchars($last_et.'-'.$last_eth.'-'.$class_code); ?>"
                      onclick="add_edit(this.id,this.name)"
                      data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-plus"></i> Add More
                    </button>
                  </td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php endwhile; ?>

    </div>
  </div>

</div>
</section>

<!-- ══ Add / Edit Exam Type Modal ══ -->
<div class="modal fade si-modal" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" id="modal_close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="si_exam_modal_title">Add / Edit Exam Type</h4>
      </div>

      <div class="modal-body">
        <div class="si-fg">
          <label>Exam Type <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-certificate ico"></i>
            <input type="text" name="exam_type1" id="exam_type1" class="si-ctrl"
              placeholder="Exam name (English)" required>
            <input type="hidden" name="exam_code_hidden" id="exam_code_hidden">
            <input type="hidden" name="class_code_hidden" id="class_code_hidden">
            <input type="hidden" name="s_no_hidden" id="s_no_hidden">
          </div>
        </div>
        <div class="si-fg" style="margin-bottom:0;">
          <label>Exam Type Hindi</label>
          <div class="si-iw">
            <i class="fa fa-font ico"></i>
            <input type="text" name="exam_type_hindi" id="exam_type_hindi" class="si-ctrl"
              placeholder="परीक्षा प्रकार (हिंदी)">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="exam_save_btn" onclick="form_submit();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>

    </div>
  </div>
</div>
