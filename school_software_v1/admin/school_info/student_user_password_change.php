<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function for_section() {
    var class_name = document.getElementById('attendance_student_class').value;
    $('#attendance_student_section').html("<option value=''>Loading…</option>");
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/ajax_class_section.php?class_name=' + class_name,
        cache: false,
        success: function (detail) {
            $('#attendance_student_section').html(detail);
            attendance_list();
        }
    });
}

function for_stream(value2) {
    if (value2 === '11TH' || value2 === '12TH') {
        $('#student_class_stream_div').show();
        $('#student_class_group_div').show();
        $('#student_class_stream').attr('required', true);
        $('#student_class_group').attr('required', true);
    } else {
        $('#student_class_stream_div').hide();
        $('#student_class_group_div').hide();
        $('#student_class_stream').attr('required', false);
        $('#student_class_group').attr('required', false);
    }
}

function get_group(value1) {
    $('#student_class_group').html("<option value=''>Loading…</option>");
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/ajax_stream_group.php?stream_name=' + value1,
        cache: false,
        success: function (detail) {
            $('#student_class_group').html(detail);
            attendance_list();
        }
    });
}

function attendance_list() {
    var class_name  = document.getElementById('attendance_student_class').value;
    var class_section = document.getElementById('attendance_student_section').value;
    var stream      = document.getElementById('student_class_stream').value;
    var group       = document.getElementById('student_class_group').value;
    var ok = 0;
    if (class_name === '11TH' || class_name === '12TH') {
        if (group !== '' && stream !== '') ok = 1;
    } else {
        ok = 1;
    }
    if (class_name !== '' && class_section !== '' && ok) {
        $('#student_table').html(loader_div);
        $.ajax({
            type: 'POST',
            url: access_link + 'school_info/ajax_student_password_update.php?class_name=' + class_name +
                '&class_section=' + class_section +
                '&student_class_stream=' + stream +
                '&student_class_group=' + group,
            cache: false,
            success: function (detail) { $('#student_table').html(detail); }
        });
    } else {
        $('#student_table').html('');
    }
}

function pw_submit() {
    var $btn = $('#pw_submit_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var formdata = new FormData(document.getElementById('pw_form'));
    $.ajax({
        url: access_link + 'school_info/student_user_password_change_api.php',
        type: 'POST',
        data: formdata,
        mimeTypes: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Passwords updated successfully!', 'green');
                get_content('school_info/student_user_password_change');
            } else {
                alert_new('Could not update. Please try again.', 'red');
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
  <h1><?php echo $language['Student Password Update']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['Student Password Update']; ?></li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="row">

    <!-- ── Left: Filters ── -->
    <div class="col-md-3">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-filter"></i></div>
          <h4>Select Class</h4>
        </div>
        <div class="si-card-body">
          <div class="si-fg">
            <label><?php echo $language['Class']; ?> <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-graduation-cap ico"></i>
              <select id="attendance_student_class" class="si-ctrl"
                onchange="for_section();for_stream(this.value)" required>
                <option value=""><?php echo $language['Select']; ?></option>
                <?php
                $class37   = $_SESSION['class_name37'];
                $class371  = explode('|?|', $class37);
                $total_cls = $_SESSION['class_total37'];
                for ($q = 0; $q < $total_cls; $q++):
                ?>
                <option value="<?php echo htmlspecialchars($class371[$q]); ?>"><?php echo htmlspecialchars($class371[$q]); ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>

          <div class="si-fg" id="student_class_stream_div" style="display:none;">
            <label>Stream</label>
            <div class="si-iw">
              <i class="fa fa-stream ico"></i>
              <select id="student_class_stream" class="si-ctrl" onchange="get_group(this.value);">
                <option value="">Select Stream</option>
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

          <div class="si-fg" id="student_class_group_div" style="display:none;">
            <label>Group</label>
            <div class="si-iw">
              <i class="fa fa-users ico"></i>
              <select id="student_class_group" class="si-ctrl" onchange="attendance_list();">
                <option value="">Select Group</option>
              </select>
            </div>
          </div>

          <div class="si-fg">
            <label><?php echo $language['Section']; ?> <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-list ico"></i>
              <select id="attendance_student_section" class="si-ctrl" onchange="attendance_list();" required>
                <option value=""><?php echo $language['Select']; ?></option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Right: Student table ── -->
    <div class="col-md-9">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-key"></i></div>
          <h4><?php echo $language['Student Password Update']; ?></h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <form id="pw_form">
            <div id="student_table" style="min-height:120px;"></div>
            <div style="margin-top:16px;">
              <button type="button" id="pw_submit_btn" onclick="pw_submit();" class="si-btn si-btn-ok">
                <i class="fa fa-check"></i> Update Passwords
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
</section>
