<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name, hindi) {
  $('#stream_name1').val(name || '');
  $('#stream_name_hindi').val(hindi || '');
  $('#stream_code_hidden').val(code);
  $('#si_stream_modal_title').text(name ? 'Edit Stream' : 'Add Stream');
}

function stream_delete(code, name) {
  if (!confirm('Delete stream "' + name + '"?\nThis cannot be undone.')) return;
  $.ajax({
    type: "POST",
    url: access_link + "school_info/stream_delete.php?stream_code=" + encodeURIComponent(code),
    cache: false,
    success: function (detail) {
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('"' + name + '" removed from stream list.', 'green');
        get_content('school_info/add_class_stream');
      } else {
        alert_new('Could not delete. Please try again.', 'red');
      }
    },
    error: function () { alert_new('Connection error. Please try again.', 'red'); }
  });
}

function form_submit() {
  var nm = $.trim($('#stream_name1').val());
  if (nm === '') { alert_new('Stream name is required.', 'red'); return; }
  var $btn = $('#stream_save_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  var payload = {
    stream_name1:        $('#stream_name1').val(),
    stream_name_hindi:   $('#stream_name_hindi').val(),
    stream_code_hidden:  $('#stream_code_hidden').val()
  };
  $.ajax({
    type: "POST",
    url: access_link + "school_info/add_class_stream_api.php",
    data: payload,
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Stream saved successfully!', 'green');
        $('#myModal').one('hidden.bs.modal', function () {
          get_content('school_info/add_class_stream');
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
    <li class="active"><?php echo $language['Add Stream']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-code-fork"></i></div>
      <h4><?php echo $language['Stream Add']; ?></h4>
    </div>
    <div class="si-card-body" style="padding-top:16px;">
      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo $language['Stream']; ?></th>
              <th><?php echo $language['Stream Hindi']; ?></th>
              <th class="cen"><?php echo $language['Add Edit']; ?></th>
              <th class="cen"><?php echo $language['Delete']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $que = "select * from school_info_stream_info";
            $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
            $serial_no = 0;
            $add_more_button = 0;
            $stream_code_blank = '';
            $last_sn = ''; $last_snh = '';
            while ($row = mysqli_fetch_assoc($run)) {
                $s_no       = $row['s_no'];
                $stream_name       = $row['stream_name'];
                $stream_name_hindi = $row['stream_name_hindi'];
                $stream_code       = $row['stream_code'];
                if ($stream_name !== '' || $stream_name_hindi !== '') {
                    $serial_no++;
                    ?>
            <tr>
              <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
              <td><strong><?php echo htmlspecialchars($stream_name); ?></strong></td>
              <td><?php echo htmlspecialchars($stream_name_hindi); ?></td>
              <td class="cen">
                <button type="button"
                  class="si-btn si-btn-ok"
                  style="padding:5px 14px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($stream_code); ?>"
                  data-name="<?php echo htmlspecialchars($stream_name); ?>"
                  data-hindi="<?php echo htmlspecialchars($stream_name_hindi); ?>"
                  onclick="add_edit(this.dataset.code,this.dataset.name,this.dataset.hindi)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> <?php echo $language['Edit']; ?>
                </button>
              </td>
              <td class="cen">
                <button type="button"
                  class="si-btn si-btn-del"
                  style="padding:5px 14px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($stream_code); ?>"
                  data-name="<?php echo htmlspecialchars($stream_name); ?>"
                  onclick="stream_delete(this.dataset.code,this.dataset.name)">
                  <i class="fa fa-trash"></i> <?php echo $language['Delete']; ?>
                </button>
              </td>
            </tr>
                    <?php
                } else {
                    if ($add_more_button === 0) $stream_code_blank = $stream_code;
                    $last_sn  = $stream_name;
                    $last_snh = $stream_name_hindi;
                    $add_more_button++;
                }
            }
            if ($add_more_button > 0): ?>
            <tr>
              <td colspan="5" class="cen" style="padding:10px;">
                <button type="button"
                  class="si-btn si-btn-pri"
                  style="padding:6px 18px;font-size:12px;"
                  data-code="<?php echo htmlspecialchars($stream_code_blank); ?>"
                  data-name="<?php echo htmlspecialchars($last_sn); ?>"
                  data-hindi="<?php echo htmlspecialchars($last_snh); ?>"
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

<!-- ══ Add / Edit Stream Modal ══ -->
<div class="modal fade si-modal" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="si_stream_modal_title">Add / Edit Stream</h4>
      </div>

      <div class="modal-body">
        <div class="si-fg">
          <label><?php echo $language['Class Add Edit']; ?> <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-code-fork ico"></i>
            <input type="text" id="stream_name1" class="si-ctrl" placeholder="Stream name (English)" required>
            <input type="hidden" id="stream_code_hidden">
          </div>
        </div>
        <div class="si-fg" style="margin-bottom:0;">
          <label><?php echo $language['Class Hindi Add Edit']; ?></label>
          <div class="si-iw">
            <i class="fa fa-font ico"></i>
            <input type="text" id="stream_name_hindi" class="si-ctrl" placeholder="स्ट्रीम का नाम (हिंदी)">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="stream_save_btn" onclick="form_submit();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>

    </div>
  </div>
</div>
