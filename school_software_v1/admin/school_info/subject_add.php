<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function add_edit(code, name) {
  var parts = name.split('|?|');
  $('#subject_code_hidden').val(code);
  $('#subject').val(parts[1] || '');
  $('#subject_hindi').val(parts[0] || '');
  $('#si_subj_modal_title').text(parts[1] ? 'Edit Subject' : 'Add Subject');
}

function form_submit() {
  var subj = $.trim($('#subject').val());
  if (subj === '') { alert_new('Subject name is required.', 'red'); return; }
  var payload = $("#my_form").serialize();
  $.ajax({
    type: "POST",
    url: access_link + "school_info/subject_add_api.php",
    data: payload,
    success: function (detail) {
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        $('#myModal12').one('hidden.bs.modal', function () {
          get_content('school_info/subject_add');
        });
        $('#myModal12').modal('hide');
      }
    }
  });
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['Add Subject']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-book"></i></div>
      <h4><?php echo $language['Add Subject']; ?></h4>
    </div>
    <div class="si-card-body">
      <div class="row">

        <?php
        $subject_panels = [
          'subject'         => $language['Add Subject'],
          'practical'       => $language['Practical Subject Add'],
          'other_subject'   => $language['Other Subject Add'],
        ];
        $col_class = 'col-md-4';
        foreach ($subject_panels as $type => $panel_title):
          $que = "select * from school_info_subjects where subject_type='$type' and (session_value='$session1' || session_value='') $filter37";
          $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
          $serial_no = 0; $add_more_button = 0; $subject_code_blank = '';
          $rows = [];
          while ($row = mysqli_fetch_assoc($run)) {
            if ($row['subject'] !== '' || $row['subject_hindi'] !== '') {
              $rows[] = $row; $serial_no++;
            } else {
              if ($add_more_button === 0) $subject_code_blank = $row['subject_code'];
              $add_more_button++;
            }
          }
        ?>
        <div class="<?php echo $col_class; ?>">
          <div class="si-sec"><?php echo htmlspecialchars($panel_title); ?></div>
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo $language['Subject Name']; ?></th>
                  <th><?php echo $language['Subject Name Hindi']; ?></th>
                  <th class="cen"><?php echo $language['Add Edit']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $i => $r): ?>
                <tr>
                  <td><span class="si-sno"><?php echo $i + 1; ?></span></td>
                  <td><?php echo htmlspecialchars($r['subject']); ?></td>
                  <td><?php echo htmlspecialchars($r['subject_hindi']); ?></td>
                  <td class="cen">
                    <button type="button"
                      class="si-btn si-btn-ok"
                      style="padding:5px 14px;font-size:12px;"
                      id="<?php echo htmlspecialchars($r['subject_code']); ?>"
                      name="<?php echo htmlspecialchars($r['subject_hindi'].'|?|'.$r['subject']); ?>"
                      onclick="add_edit(this.id,this.name)"
                      data-toggle="modal" data-target="#myModal12">
                      <i class="fa fa-pencil"></i> Edit
                    </button>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php if ($add_more_button > 0): ?>
                <tr>
                  <td colspan="4" class="cen" style="padding:12px;">
                    <button type="button"
                      class="si-btn si-btn-pri"
                      id="<?php echo htmlspecialchars($subject_code_blank); ?>"
                      name="|?|"
                      onclick="add_edit(this.id,this.name)"
                      data-toggle="modal" data-target="#myModal12">
                      <i class="fa fa-plus"></i> <?php echo $language['Add More']; ?>
                    </button>
                  </td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php endforeach; ?>

      </div><!-- /row -->
    </div><!-- /card-body -->
  </div><!-- /card -->

</div>
</section>

<!-- ══ Add / Edit Subject Modal ══ -->
<div class="modal fade si-modal myModal121223" id="myModal12" role="dialog">
  <form role="form" method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" id="modal_close_subj" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="si_subj_modal_title">Add / Edit Subject</h4>
        </div>

        <div class="modal-body">
          <div class="si-fg">
            <label><?php echo $language['Subject Name Add Edit']; ?><span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-book ico"></i>
              <input type="text" name="subject" id="subject" class="si-ctrl"
                placeholder="Subject name (English)" required>
            </div>
            <input type="hidden" name="subject_code_hidden" id="subject_code_hidden">
          </div>
          <div class="si-fg" style="margin-bottom:0;">
            <label><?php echo $language['Subject Name Hindi Add Edit']; ?></label>
            <div class="si-iw">
              <i class="fa fa-font ico"></i>
              <input type="text" name="subject_hindi" id="subject_hindi" class="si-ctrl"
                placeholder="विषय का नाम (हिंदी)">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" onclick="form_submit();" class="si-btn si-btn-ok">
            <i class="fa fa-check"></i> <?php echo $language['Add']; ?>
          </button>
          <button type="button" id="modal_close_subj2" class="si-btn si-btn-ghost" data-dismiss="modal">
            <i class="fa fa-times"></i> <?php echo $language['Close']; ?>
          </button>
        </div>

      </div>
    </div>
  </form>
</div>
