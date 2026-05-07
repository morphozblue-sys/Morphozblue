<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name, hindi) {
    $('#class_name1').val(name || '');
    $('#class_name_hindi').val(hindi || '');
    $('#class_code_hidden').val(code);
    $('#si_class_modal_title').text(name ? 'Edit Class' : 'Add Class');
}

function form_submit() {
    var nm = $.trim($('#class_name1').val());
    if (nm === '') { alert_new('Class name is required.', 'red'); return; }
    var $btn = $('#class_save_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/add_class_api.php',
        data: {
            class_name1:       $('#class_name1').val(),
            class_name_hindi:  $('#class_name_hindi').val(),
            class_code_hidden: $('#class_code_hidden').val()
        },
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Class saved successfully!', 'green');
                $('#myModal').one('hidden.bs.modal', function () {
                    get_content('school_info/add_class');
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
    <li class="active"><?php echo $language['Add Class']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-graduation-cap"></i></div>
      <h4><?php echo $language['Add Class']; ?></h4>
    </div>
    <div class="si-card-body" style="padding-top:16px;">
      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo $language['Class']; ?></th>
              <th><?php echo $language['Class Hindi']; ?></th>
              <th class="cen"><?php echo $language['Add Edit']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $que = "select * from school_info_class_info";
            $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
            $sno = 0;
            while ($row = mysqli_fetch_assoc($run)):
                $sno++;
            ?>
            <tr>
              <td><span class="si-sno"><?php echo $sno; ?></span></td>
              <td><strong><?php echo htmlspecialchars($row['class_name']); ?></strong></td>
              <td><?php echo htmlspecialchars($row['class_name_hindi']); ?></td>
              <td class="cen">
                <button type="button" class="si-btn si-btn-ok" style="padding:5px 14px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($row['class_code']); ?>"
                  data-name="<?php echo htmlspecialchars($row['class_name']); ?>"
                  data-hindi="<?php echo htmlspecialchars($row['class_name_hindi']); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name,this.dataset.hindi)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> <?php echo $language['Add Edit']; ?>
                </button>
              </td>
            </tr>
            <?php endwhile; ?>
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
        <h4 class="modal-title" id="si_class_modal_title">Add / Edit Class</h4>
      </div>
      <div class="modal-body">
        <div class="si-fg">
          <label><?php echo $language['Class Add Edit']; ?> <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-graduation-cap ico"></i>
            <input type="text" id="class_name1" class="si-ctrl" placeholder="Class name (English)" required>
            <input type="hidden" id="class_code_hidden">
          </div>
        </div>
        <div class="si-fg" style="margin-bottom:0;">
          <label><?php echo $language['Class Hindi Add Edit']; ?></label>
          <div class="si-iw">
            <i class="fa fa-font ico"></i>
            <input type="text" id="class_name_hindi" class="si-ctrl" placeholder="कक्षा (हिंदी)">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="class_save_btn" onclick="form_submit();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
