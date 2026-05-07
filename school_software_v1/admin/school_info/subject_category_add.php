<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function for_subject() {
    $('#subject_name').html("<option value=''>Loading…</option>");
    var stream = $('#student_class_stream').val();
    var group  = $('#student_class_group').val();
    var cls    = $('#student_class').val();
    $.ajax({
        url: access_link + 'school_info/ajax_get_subject_1.php?value=' + cls +
            '&student_class_stream=' + stream + '&student_class_group=' + group,
        cache: false,
        success: function (detail) { $('#subject_name').html(detail); }
    });
}

function get_category() {
    var subject = $('#subject_name').val();
    $('#category_list').html(loader_div_google);
    $.ajax({
        url: access_link + 'school_info/subject_category_add_ajax.php?subject_name=' + subject,
        cache: false,
        success: function (detail) { $('#category_list').html(detail); }
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
        url: access_link + 'school_info/ajax_stream_group.php?stream_name=' + value1,
        cache: false,
        success: function (detail) {
            $('#student_class_group').html(detail);
            for_subject();
        }
    });
}

function for_modal(values) {
    var v = values.split('|?|');
    $('#s_no_hidden').val(v[0]);
    $('#subject_category').val(v[1]);
    $('#subject_category_column_hidden').val(v[2]);
    $('#btn_modal').click();
}

function category_delete(s_no, col) {
    if (!confirm('Delete this subject category?\nThis cannot be undone.')) return;
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/subject_category_delete.php?s_no=' + s_no + '&subject_category_column=' + col,
        cache: false,
        success: function (detail) {
            var res = detail.split('|?|');
            if (res[1] === 'success') { alert_new('Category deleted.', 'green'); get_category(); }
            else { alert_new('Could not delete. Please try again.', 'red'); }
        }
    });
}

function cat_save() {
    var $btn = $('#cat_save_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var data = {
        s_no_hidden:                    $('#s_no_hidden').val(),
        subject_category_column_hidden: $('#subject_category_column_hidden').val(),
        subject_category:               $('#subject_category').val()
    };
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/subject_category_add_api.php',
        data: data,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Category saved successfully!', 'green');
                $('#subject_category').val('');
                $('#myModal').one('hidden.bs.modal', function () { get_category(); });
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
    <li class="active">Subject Category</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <!-- Filters -->
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-book"></i></div>
      <h4>Subject Category</h4>
    </div>
    <div class="si-card-body">
      <div class="row">
        <div class="col-md-3">
          <div class="si-fg">
            <label><?php echo $language['Class']; ?> <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-graduation-cap ico"></i>
              <select id="student_class" class="si-ctrl"
                onchange="for_subject();for_stream(this.value)" required>
                <option value="">Select</option>
                <?php
                $class37  = $_SESSION['class_name37'];
                $class371 = explode('|?|', $class37);
                $total_cl = $_SESSION['class_total37'];
                for ($q = 0; $q < $total_cl; $q++):
                ?>
                <option value="<?php echo htmlspecialchars($class371[$q]); ?>"><?php echo htmlspecialchars($class371[$q]); ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-3" id="student_class_stream_div" style="display:none;">
          <div class="si-fg">
            <label><?php echo $language['Stream']; ?></label>
            <div class="si-iw">
              <i class="fa fa-stream ico"></i>
              <select id="student_class_stream" class="si-ctrl" onchange="get_group(this.value);for_subject();">
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
        </div>

        <div class="col-md-3" id="student_class_group_div" style="display:none;">
          <div class="si-fg">
            <label><?php echo $language['Group']; ?></label>
            <div class="si-iw">
              <i class="fa fa-users ico"></i>
              <select id="student_class_group" class="si-ctrl" onchange="for_subject();">
                <option value="">Select Group</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="si-fg">
            <label><?php echo $language['Subject Name']; ?> <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-book ico"></i>
              <select id="subject_name" class="si-ctrl" onchange="get_category();">
                <option value="">Select Subject</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- AJAX-loaded category list -->
  <div id="category_list"></div>

</div>
</section>

<!-- Hidden trigger for modal -->
<button type="button" id="btn_modal" data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<div class="modal fade si-modal" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add / Edit Subject Category</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="s_no_hidden">
        <input type="hidden" id="subject_category_column_hidden">
        <div class="si-fg" style="margin-bottom:0;">
          <label>Subject Category <span class="req">*</span></label>
          <div class="si-iw">
            <i class="fa fa-book ico"></i>
            <input type="text" id="subject_category" class="si-ctrl" placeholder="Category name" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cat_save_btn" onclick="cat_save();" class="si-btn si-btn-ok">
          <i class="fa fa-check"></i> Save
        </button>
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
          <i class="fa fa-times"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
