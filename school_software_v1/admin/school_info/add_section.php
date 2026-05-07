<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
/* Section labels map */
var SEC_LABELS = ['A','B','C','D','E','F','G','H','I','J'];

function getSectionLabel(n) {
  return SEC_LABELS.slice(0, n).join(', ') || '—';
}

function form_submit() {
  var cls = $.trim($('#class_section').val());
  if (cls === '') { alert_new('Please select a class.', 'red'); return; }
  var $btn = $('#sec_add_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  $.ajax({
    type: "POST",
    url: access_link + "school_info/add_section_api.php",
    data: $("#my_form").serialize(),
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[2] === 'ok') {
        alert_new('Section added successfully!', 'green');
      } else {
        alert_new('Maximum 10 sections allowed per class.', 'red');
      }
      get_content('school_info/add_section');
    },
    error: function () {
      $btn.prop('disabled', false);
      alert_new('Connection error. Please try again.', 'red');
    }
  });
}

function section_delete(class_name, section) {
  var lastLetter = SEC_LABELS[section - 1] || '';
  if (!confirm('Remove section ' + lastLetter + ' from ' + class_name + '?\nThis cannot be undone.')) return;
  $.ajax({
    type: "POST",
    url: access_link + "school_info/section_delete.php?id=" + encodeURIComponent(class_name) + "&section=" + encodeURIComponent(section),
    cache: false,
    success: function (detail) {
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Section ' + lastLetter + ' removed from ' + class_name + '.', 'green');
        get_content('school_info/add_section');
      } else {
        alert_new('Cannot delete — at least 1 section must remain per class.', 'red');
      }
    },
    error: function () {
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

  <div class="row">

    <!-- ── Left: Add Section ── -->
    <div class="col-md-4">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-plus-circle"></i></div>
          <h4><?php echo $language['Add Section']; ?></h4>
        </div>
        <div class="si-card-body">
          <form role="form" method="post" enctype="multipart/form-data" id="my_form">

            <div class="si-fg">
              <label><?php echo $language['Choose Class']; ?> <span class="req">*</span></label>
              <div class="si-iw no-ico">
                <select name="class_section" id="class_section" class="si-ctrl" required>
                  <option value="">— Select Class —</option>
                  <?php
                  $que = "select * from school_info_class_info";
                  $run = mysqli_query($conn73, $que);
                  while ($row = mysqli_fetch_assoc($run)) {
                      echo '<option value="' . htmlspecialchars($row['class_name']) . '">'
                         . htmlspecialchars($row['class_name']) . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="si-hint">Each click adds one new section (A → B → C…)</div>
            </div>

            <button type="button" id="sec_add_btn" onclick="form_submit();" class="si-btn si-btn-ok" style="width:100%;">
              <i class="fa fa-plus"></i> <?php echo $language['Add Section']; ?>
            </button>

          </form>
        </div>
      </div>
    </div>

    <!-- ── Right: Current Sections ── -->
    <div class="col-md-8">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-table"></i></div>
          <h4>Current Class Sections</h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <div class="si-tbl-wrap">
            <table class="si-tbl" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo $language['Added Class']; ?></th>
                  <th><?php echo $language['Added Section']; ?></th>
                  <th class="cen"><?php echo $language['Delete Section']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $que = "select * from school_info_class_info";
                $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
                $sno = 0;
                while ($row = mysqli_fetch_assoc($run)) {
                    $sno++;
                    $sn = (int)$row['section'];
                    $sec_str = implode(', ', array_slice(['A','B','C','D','E','F','G','H','I','J'], 0, $sn));
                    ?>
                <tr>
                  <td><span class="si-sno"><?php echo $sno; ?></span></td>
                  <td><strong><?php echo htmlspecialchars($row['class_name']); ?></strong></td>
                  <td>
                    <?php foreach (array_slice(['A','B','C','D','E','F','G','H','I','J'], 0, $sn) as $ltr): ?>
                    <span class="si-badge si-badge-pri" style="margin:2px;"><?php echo $ltr; ?></span>
                    <?php endforeach; ?>
                  </td>
                  <td class="cen">
                    <button type="button"
                      class="si-btn si-btn-del"
                      style="padding:5px 14px;font-size:12px;"
                      onclick="section_delete('<?php echo htmlspecialchars($row['class_name']); ?>','<?php echo $row['section']; ?>')">
                      <i class="fa fa-trash"></i> <?php echo $language['Delete']; ?>
                    </button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /row -->

</div>
</section>
<script>
$(function(){ if($.fn.DataTable) $('#example1').DataTable(); });
</script>
