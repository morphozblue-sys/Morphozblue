<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
$grp_letters = range('A', 'U'); // A–U = 21 groups max
function grp_badges($count) {
  global $grp_letters;
  $out = '';
  for ($i = 0; $i < $count && $i < 21; $i++) {
    $out .= '<span class="si-badge si-badge-pri" style="margin:2px;">Group-' . $grp_letters[$i] . '</span>';
  }
  return $out ?: '<span class="si-badge si-badge-sec">—</span>';
}
?>
<script>
var GRP_LETTERS = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'];

function form_submit() {
  var stream = $.trim($('#stream_name1').val());
  if (stream === '') { alert_new('Please select a stream.', 'red'); return; }
  var $btn = $('#grp_add_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  $.ajax({
    type: "POST",
    url: access_link + "school_info/add_stream_group_api.php",
    data: { stream_name1: stream },
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[2] === 'ok') {
        alert_new('Group added successfully!', 'green');
      } else {
        alert_new('Maximum 21 groups allowed per stream.', 'red');
      }
      get_content('school_info/add_stream_group');
    },
    error: function () {
      $btn.prop('disabled', false);
      alert_new('Connection error. Please try again.', 'red');
    }
  });
}

function group_delete(id, stream_group, stream_code) {
  var last = GRP_LETTERS[stream_group - 1] || '';
  if (!confirm('Remove Group-' + last + '?\nThis cannot be undone.')) return;
  $.ajax({
    type: "POST",
    url: access_link + "school_info/group_delete.php?id=" + encodeURIComponent(id) +
         "&stream_group=" + encodeURIComponent(stream_group) +
         "&stream_code=" + encodeURIComponent(stream_code),
    cache: false,
    success: function (detail) {
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Group-' + last + ' removed.', 'green');
        get_content('school_info/add_stream_group');
      } else {
        alert_new('Cannot delete — at least 1 group must remain.', 'red');
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

    <!-- ── Left: Add Group ── -->
    <div class="col-md-4">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-plus-circle"></i></div>
          <h4><?php echo $language['Add Group']; ?></h4>
        </div>
        <div class="si-card-body">
          <div class="si-fg">
            <label><?php echo $language['Choose Stream']; ?> <span class="req">*</span></label>
            <div class="si-iw no-ico">
              <select id="stream_name1" class="si-ctrl" required>
                <option value="">— Select Stream —</option>
                <?php
                $que = "select * from school_info_stream_info";
                $run = mysqli_query($conn73, $que);
                while ($row = mysqli_fetch_assoc($run)) {
                    if ($row['stream_name'] !== '') {
                        echo '<option value="' . htmlspecialchars($row['stream_name']) . '">'
                           . htmlspecialchars($row['stream_name']) . '</option>';
                    }
                }
                ?>
              </select>
            </div>
            <div class="si-hint">Each click adds one new group (Group-A → Group-B → …)</div>
          </div>

          <button type="button" id="grp_add_btn" onclick="form_submit();" class="si-btn si-btn-ok" style="width:100%;">
            <i class="fa fa-plus"></i> <?php echo $language['Add Group']; ?>
          </button>
        </div>
      </div>
    </div>

    <!-- ── Right: Current Groups ── -->
    <div class="col-md-8">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-table"></i></div>
          <h4>Current Stream Groups</h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo $language['Added Stream']; ?></th>
                  <th><?php echo $language['Added Group']; ?></th>
                  <th class="cen"><?php echo $language['Delete Group']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $que = "select * from school_info_stream_info";
                $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
                $serial_no = 0;
                while ($row = mysqli_fetch_assoc($run)) {
                    if ($row['stream_name'] === '') continue;
                    $serial_no++;
                    $sg = (int)$row['stream_group'];
                    ?>
                <tr>
                  <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
                  <td><strong><?php echo htmlspecialchars($row['stream_name']); ?></strong></td>
                  <td><?php echo grp_badges($sg); ?></td>
                  <td class="cen">
                    <button type="button"
                      class="si-btn si-btn-del"
                      style="padding:5px 14px;font-size:12px;"
                      onclick="group_delete('<?php echo htmlspecialchars($row['s_no']); ?>','<?php echo $sg; ?>','<?php echo htmlspecialchars($row['stream_code']); ?>')">
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
