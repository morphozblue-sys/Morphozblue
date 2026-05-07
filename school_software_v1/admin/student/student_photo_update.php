<?php include("../attachment/session.php"); ?>

<style>
.st-wrap { padding: 20px 18px 40px; background: linear-gradient(160deg,#eef1f7 0%,#f4f6fb 60%,#eaecf4 100%); min-height: 80vh; font-family: 'Source Sans Pro','Helvetica Neue',Arial,sans-serif; }
.st-filter-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04); border: 1px solid rgba(15,52,96,.07); margin-bottom: 20px; overflow: hidden; animation: stFadeIn .4s ease forwards; }
.st-filter-hdr { background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%); padding: 12px 20px; display: flex; align-items: center; gap: 11px; border-bottom: 3px solid #b92b27; }
.st-filter-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.st-filter-hdr-icon i { color: #fff; font-size: 14px; }
.st-filter-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.st-filter-body { padding: 18px 20px 14px; display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end; }
.st-filter-group { display: flex; flex-direction: column; gap: 5px; min-width: 150px; flex: 1; }
.st-filter-group label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; color: #2c3e6b; margin-bottom: 0; display: flex; align-items: center; gap: 5px; }
.st-filter-group label i { color: #7f8fa6; font-size: 11px; }
.st-filter-group .form-control { border: 1.5px solid #dce3ef; border-radius: 9px; height: 38px; font-size: 13px; background: #f8f9fc; transition: border-color .2s, box-shadow .2s; }
.st-filter-group .form-control:focus { border-color: #0f3460; box-shadow: 0 0 0 3px rgba(15,52,96,.12); background: #fff; outline: none; }
.st-result-wrap { background: #fff; border-radius: 16px; box-shadow: 0 4px 22px rgba(15,52,96,.09); border: 1px solid rgba(15,52,96,.07); overflow: hidden; animation: stFadeIn .5s .08s ease both; }
.st-result-hdr { background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%); padding: 12px 20px; display: flex; align-items: center; gap: 11px; border-bottom: 3px solid #b92b27; }
.st-result-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; }
.st-result-hdr-icon i { color: #fff; font-size: 14px; }
.st-result-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.st-result-body { padding: 16px 20px; }
@keyframes stFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
</style>

<script type="text/javascript">
function for_section(value) {
    $('#student_class_section').html("<option value=''>Loading....</option>");
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_class_section_all.php?class_name=" + value,
        cache: false,
        success: function(detail) {
            $("#student_class_section").html(detail);
            for_stream(value);
        }
    });
}

function for_stream(value2) {
    if (value2 === "11TH" || value2 === "12TH") {
        $("#student_class_stream_div, #student_class_group_div").show();
    } else {
        $("#student_class_stream_div, #student_class_group_div").hide();
    }
    $("#student_class_stream").val('All');
    $("#student_class_group").html("<option value='All'>All</option>");
    for_search11();
}

function get_group(value1) {
    if (value1 !== 'All') {
        $('#student_class_group').html("<option value=''>Loading....</option>");
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_stream_group_all.php?stream_name=" + value1,
            cache: false,
            success: function(d) { $("#student_class_group").html(d); }
        });
    } else {
        $("#student_class_group").html("<option value='All'>All</option>");
    }
    for_search11();
}

function for_search11() {
    var student_class        = document.getElementById('student_class').value;
    var student_class_stream = document.getElementById('student_class_stream').value;
    var student_class_group  = document.getElementById('student_class_group').value;
    var student_class_section = document.getElementById('student_class_section').value;
    var student_limit        = document.getElementById('student_limit').value;
    var student_order_by     = document.getElementById('student_order_by').value;
    if (student_class !== '' || student_class_section !== '') {
        $("#for_student_list").html(loader_div);
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_student_photo_update.php?student_class=" + student_class +
                 "&student_class_stream=" + student_class_stream +
                 "&student_class_group=" + student_class_group +
                 "&student_class_section=" + student_class_section +
                 "&student_limit=" + student_limit +
                 "&student_order_by=" + student_order_by,
            success: function(detail) { $('#for_student_list').html(detail); }
        });
    } else {
        $('#for_student_list').html('');
    }
}

function for_check(id) {
    var checked = $('#' + id).prop("checked");
    $("." + id).each(function() { $(this).prop('checked', checked); });
}

function validation() {
    var add = 0;
    $(".checked1").each(function() { if ($(this).prop("checked")) add++; });
    if (add > 0) return true;
    alert_new("Please select at least one student!", "red");
    return false;
}

$("#my_form").submit(function(e) {
    e.preventDefault();
    var $btn = $(this).find('[type=submit]');
    $btn.prop('disabled', true);
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    $("#get_content").html(loader_div);
    $.ajax({
        url: access_link + "student/student_photo_update_api.php",
        type: "POST", data: formdata, contentType: false, cache: false, processData: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Photos updated successfully', 'green');
            } else {
                alert_new(detail || 'Update failed. Please try again.', 'red');
            }
            get_content('student/student_photo_update');
        },
        error: function() {
            alert_new('Server error. Please try again.', 'red');
            get_content('student/student_photo_update');
        }
    });
});
</script>

<!-- Page Header -->
<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-camera"></i></div>
    <div>
      <h1 class="si-ph-title">Student Photo Update</h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-camera"></i> Photo Update</span>
  </nav>
</section>

<form role="form" method="post" enctype="multipart/form-data" id="my_form">
<section class="content">
  <div class="st-wrap">

    <div class="st-filter-card">
      <div class="st-filter-hdr">
        <div class="st-filter-hdr-icon"><i class="fa fa-filter"></i></div>
        <span class="st-filter-hdr-title">Filter Students</span>
      </div>
      <div class="st-filter-body">

        <div class="st-filter-group">
          <label><i class="fa fa-graduation-cap"></i> Class</label>
          <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control">
            <option value="">Select Class</option>
            <?php
            $class37  = $_SESSION['class_name37'];
            $class371 = explode('|?|', $class37);
            $total_class = count($class371);
            for ($q = 0; $q < $total_class; $q++) {
                $cn = $class371[$q];
                echo '<option value="' . htmlspecialchars($cn) . '">' . htmlspecialchars($cn) . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="st-filter-group" id="student_class_stream_div" style="display:none;">
          <label><i class="fa fa-random"></i> Stream</label>
          <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);">
            <option value="All">All</option>
            <?php
            $que = "select stream_name from school_info_stream_info where stream_name!=''";
            $run = mysqli_query($conn73, $que);
            while ($row = mysqli_fetch_assoc($run)) {
                echo '<option value="' . htmlspecialchars($row['stream_name']) . '">' . htmlspecialchars($row['stream_name']) . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="st-filter-group" id="student_class_group_div" style="display:none;">
          <label><i class="fa fa-object-group"></i> Group</label>
          <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_search11();">
            <option value="All">All</option>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-object-group"></i> Section</label>
          <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_search11();">
            <option value="">Select Section</option>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-list-ol"></i> Limit</label>
          <select name="student_limit" id="student_limit" class="form-control" onchange="for_search11();">
            <?php for ($i = 0; $i <= 180; $i += 20): ?>
            <option value="<?php echo $i; ?>"><?php echo $i . '-' . ($i + 20); ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-sort"></i> Order By</label>
          <select name="student_order_by" id="student_order_by" class="form-control" onchange="for_search11();">
            <option value="">Select</option>
            <option value=" ORDER BY student_name">Student Name</option>
            <option value=" ORDER BY CAST(school_roll_no AS UNSIGNED)">Roll No.</option>
            <option value=" ORDER BY CAST(student_admission_number AS UNSIGNED)">Admission No.</option>
            <option value=" ORDER BY CAST(student_scholar_number AS UNSIGNED)">Scholar No.</option>
          </select>
        </div>

      </div>
    </div>

    <div class="st-result-wrap">
      <div class="st-result-hdr">
        <div class="st-result-hdr-icon"><i class="fa fa-users"></i></div>
        <span class="st-result-hdr-title">Student List</span>
      </div>
      <div class="st-result-body">
        <div id="for_student_list" class="table-responsive"></div>
      </div>
    </div>

  </div><!-- /.st-wrap -->
</section>
</form>
