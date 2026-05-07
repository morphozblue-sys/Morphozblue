<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
if (isset($_GET['class_name'])) {
    $student_class_code = $_GET['class_name'];
    $parts = explode('_', $student_class_code);
    $class_name       = $parts[0];
    $class_name_hindi = $parts[1] ?? '';
    $class_code_val   = $parts[2] ?? '';
}
$stream_name = $_GET['stream_name'] ?? '';
$group_name  = $_GET['group_name']  ?? '';
$subject_type = $_GET['subject_type'] ?? 'subject';
?>
<script>
function for_stream() {
    var value2 = document.getElementById('class_name1').value;
    var cv = value2.split('_');
    if (cv[2] === 'class14' || cv[2] === 'class15' || cv[2] === 'class16') {
        $('#student_class_stream_div').show();
        $('#student_class_group_div').show();
        $('#stream_name').attr('required', true);
        $('#group_name').attr('required', true);
    } else {
        $('#student_class_stream_div').hide();
        $('#student_class_group_div').hide();
        $('#stream_name').attr('required', false).val('');
        $('#group_name').attr('required', false).val('');
    }
}

function get_group(value1) {
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/ajax_stream_group.php?stream_name=' + value1,
        cache: false,
        success: function (detail) { $('#group_name').html(detail); }
    });
}

function for_subject_add() {
    var class_name2  = document.getElementById('class_name1').value;
    var subject_type = document.getElementById('subject_type').value;
    var stream       = document.getElementById('stream_name').value;
    var group        = document.getElementById('group_name').value;
    if (!class_name2) return;
    var cv = class_name2.split('_');
    if ((cv[2] === 'class14' || cv[2] === 'class15') && (stream === '' || group === '')) return;
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/ajax_class_wise_subject_add.php?class_name=' + class_name2 +
            '&subject_type=' + subject_type + '&stream_name=' + stream + '&group_name=' + group,
        cache: false,
        success: function (detail) { $('#example1').html(detail); }
    });
}

function for_subject_delete() {
    var class_name2  = document.getElementById('class_name1').value;
    var subject_type = document.getElementById('subject_type').value;
    var stream       = document.getElementById('stream_name').value;
    var group        = document.getElementById('group_name').value;
    if (!class_name2) return;
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/ajax_class_wise_subject_delete.php?class_name=' + class_name2 +
            '&subject_type=' + subject_type + '&stream_name=' + stream + '&group_name=' + group,
        cache: false,
        success: function (detail) { $('#example2').html(detail); }
    });
}

function for_valid() {
    var data = [];
    $('.subjects:checked').each(function () { data.push($(this).val()); });
    if (data.length === 0) { alert_new('Please select at least one subject.', 'red'); return; }
    add_multiple_subject(data);
}

function add_multiple_subject(data) {
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/classwise_multiple_subject_insert.php',
        data: { subject_details: data },
        success: function (detail) {
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Subjects added successfully!', 'green');
                get_content('school_info/class_wise_subject');
            } else {
                alert_new('Could not save. Please try again.', 'red');
            }
        }
    });
}

function add_subject(data) {
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/class_wise_subject_insert.php?' + data,
        success: function (detail) {
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                post_content('school_info/class_wise_subject', res[2]);
            } else {
                alert_new('Could not add subject. Please try again.', 'red');
            }
        }
    });
}

function delete_subject(data) {
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/class_wise_subject_delete.php?' + data,
        success: function (detail) {
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                post_content('school_info/class_wise_subject', res[2]);
            } else {
                alert_new('Could not delete subject. Please try again.', 'red');
            }
        }
    });
}

window.add_subject    = add_subject;
window.delete_subject = delete_subject;
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['Add Subject Classwise']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <!-- Filters card -->
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-book"></i></div>
      <h4><?php echo $language['Add Subject Classwise']; ?></h4>
    </div>
    <div class="si-card-body">
      <div class="row">
        <div class="col-md-2">
          <div class="si-fg">
            <label><?php echo $language['Subject Type']; ?></label>
            <div class="si-iw">
              <i class="fa fa-tag ico"></i>
              <select id="subject_type" class="si-ctrl" onchange="for_subject_add();for_subject_delete();">
                <?php
                $types = ['subject' => 'Main Subject', 'practical' => 'Practical Subject', 'other_subject' => 'Other Subject'];
                $sel   = $subject_type;
                echo "<option value=\"$sel\">{$types[$sel]}</option>";
                foreach ($types as $v => $l) {
                    if ($v !== $sel) echo "<option value=\"$v\">$l</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="si-fg">
            <label><?php echo $language['Class Name']; ?></label>
            <div class="si-iw">
              <i class="fa fa-graduation-cap ico"></i>
              <select id="class_name1" class="si-ctrl" onchange="for_stream();for_subject_add();for_subject_delete();" required>
                <?php if (isset($student_class_code)): ?>
                <option value="<?php echo htmlspecialchars($student_class_code); ?>"><?php echo htmlspecialchars($class_name); ?></option>
                <?php else: ?>
                <option value="">Select</option>
                <?php endif; ?>
                <?php
                $que = "select * from school_info_class_info";
                $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
                while ($row = mysqli_fetch_assoc($run)) {
                    $val = $row['class_name'] . '_' . $row['class_name_hindi'] . '_' . $row['class_code'];
                    echo '<option value="' . htmlspecialchars($val) . '">' . htmlspecialchars($row['class_name']) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-3" id="student_class_stream_div" style="display:none;">
          <div class="si-fg">
            <label><?php echo $language['Stream']; ?></label>
            <div class="si-iw">
              <i class="fa fa-stream ico"></i>
              <select id="stream_name" class="si-ctrl" onchange="get_group(this.value);for_subject_add();for_subject_delete();">
                <?php if ($stream_name): ?>
                <option value="<?php echo htmlspecialchars($stream_name); ?>"><?php echo htmlspecialchars($stream_name); ?></option>
                <?php else: ?>
                <option value="">Select Stream</option>
                <?php endif; ?>
                <?php
                $que = "select * from school_info_stream_info";
                $run = mysqli_query($conn73, $que);
                while ($row = mysqli_fetch_assoc($run)):
                    if ($row['stream_name'] !== ''):
                ?>
                <option value="<?php echo htmlspecialchars($row['stream_name']); ?>"><?php echo htmlspecialchars($row['stream_name']); ?></option>
                <?php endif; endwhile; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-2" id="student_class_group_div" style="display:none;">
          <div class="si-fg">
            <label><?php echo $language['Group']; ?></label>
            <div class="si-iw">
              <i class="fa fa-users ico"></i>
              <select id="group_name" class="si-ctrl" onchange="for_subject_add();for_subject_delete();">
                <?php if ($group_name): ?>
                <option value="<?php echo htmlspecialchars($group_name); ?>"><?php echo htmlspecialchars($group_name); ?></option>
                <?php else: ?>
                <option value="">Select Group</option>
                <?php endif; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-2" style="display:flex;align-items:flex-end;padding-bottom:16px;">
          <button type="button" class="si-btn si-btn-ok" onclick="for_valid();" style="width:100%;">
            <i class="fa fa-plus"></i> Add Selected
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Two subject tables -->
  <div class="row">
    <div class="col-md-6">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-plus-circle"></i></div>
          <h4><?php echo $language['Add']; ?> Subject</h4>
        </div>
        <div class="si-card-body" style="padding:0;">
          <div id="example1"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-trash"></i></div>
          <h4><?php echo $language['Delete']; ?> Subject</h4>
        </div>
        <div class="si-card-body" style="padding:0;">
          <div id="example2"></div>
        </div>
      </div>
    </div>
  </div>

</div>
</section>

<script>
$(function () {
    for_stream();
    for_subject_add();
    for_subject_delete();

    $(document).off('click.cws-add').on('click.cws-add', '[data-act="add-subj"]', function () {
        add_subject($(this).attr('data-subj'));
    });
    $(document).off('click.cws-del').on('click.cws-del', '[data-act="del-subj"]', function () {
        delete_subject($(this).attr('data-subj'));
    });
});
</script>
