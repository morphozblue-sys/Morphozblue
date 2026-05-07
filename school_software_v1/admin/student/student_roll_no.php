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
.st-submit-row { padding: 14px 20px; border-top: 1px solid #eef0f6; text-align: center; }
.st-submit-btn { background: linear-gradient(135deg,#0f3460,#16213e); color: #fff; border: none; border-radius: 9px; padding: 10px 36px; font-size: 13px; font-weight: 700; letter-spacing: .5px; cursor: pointer; transition: opacity .2s; }
.st-submit-btn:hover { opacity: .88; }
@keyframes stFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
</style>

<script type="text/javascript">
function for_list() {
    var student_class_section  = document.getElementById('student_class_section').value;
    var roll_no_generate_by    = document.getElementById('roll_no_generate_by').value;
    var student_class          = document.getElementById('student_class').value;
    var start_number           = document.getElementById('start_number').value;
    var student_class_stream   = document.getElementById('student_class_stream').value;
    var student_admission_type = document.getElementById('student_admission_type').value;
    var order_by               = document.getElementById('order_by').value;

    $('#my_table').html(loader_div);
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_student_roll_no.php?id=" + student_class +
             "&student_section=" + student_class_section +
             "&roll_no_generate_by=" + roll_no_generate_by +
             "&start_number=" + start_number +
             "&student_class_stream=" + student_class_stream +
             "&student_admission_type=" + student_admission_type +
             "&order_by=" + order_by,
        cache: false,
        success: function(detail) { $('#my_table').html(detail); }
    });
}

function for_section(value) {
    $('#student_class_section').html("<option>Loading....</option>");
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_class_section_for_roll.php?class_name=" + value,
        cache: false,
        success: function(detail) {
            $("#student_class_section").html(detail);
            for_list();
        }
    });
}

$("#my_form").submit(function(e) {
    e.preventDefault();
    var $btn = $(this).find('[type=submit]');
    $btn.prop('disabled', true).val('Saving...');
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    $("#get_content").html(loader_div);
    $.ajax({
        url: access_link + "student/student_roll_no_api.php",
        type: "POST", data: formdata, contentType: false, cache: false, processData: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Roll numbers saved successfully', 'green');
                get_content('student/student_roll_no');
            } else {
                alert_new(detail || 'Save failed. Please try again.', 'red');
                $btn.prop('disabled', false).val('<?php echo $language["Submit"]; ?>');
            }
        },
        error: function() {
            alert_new('Server error. Please try again.', 'red');
            $btn.prop('disabled', false).val('<?php echo $language["Submit"]; ?>');
        }
    });
});
</script>

<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-sort-numeric-asc"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Student Roll No']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-sort-numeric-asc"></i> <?php echo $language['Student Roll No']; ?></span>
  </nav>
</section>

<section class="content">
  <div class="st-wrap">
    <form role="form" method="post" enctype="multipart/form-data" id="my_form">

    <div class="st-filter-card">
      <div class="st-filter-hdr">
        <div class="st-filter-hdr-icon"><i class="fa fa-filter"></i></div>
        <span class="st-filter-hdr-title">Filter &amp; Settings</span>
      </div>
      <div class="st-filter-body">

        <div class="st-filter-group">
          <label><i class="fa fa-play"></i> Start No.</label>
          <input type="number" name="start_number" id="start_number" oninput="for_list();"
                 class="form-control" placeholder="e.g. 1">
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-graduation-cap"></i> Class</label>
          <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control" required>
            <option value=""><?php echo $language['Select Class']; ?></option>
            <?php
            $class37  = $_SESSION['class_name37'];
            $class371 = explode('|?|', $class37);
            $total_class = $_SESSION['class_total37'];
            for ($q = 0; $q < $total_class; $q++) {
                $cn = $class371[$q];
                echo '<option value="' . htmlspecialchars($cn) . '">' . htmlspecialchars($cn) . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-random"></i> Stream</label>
          <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="for_list();">
            <option value="All">All</option>
            <?php
            $query19 = "select stream_name from school_info_stream_info where stream_name!=''";
            $run19   = mysqli_query($conn73, $query19) or die(mysqli_error($conn73));
            while ($row = mysqli_fetch_assoc($run19)) {
                echo '<option value="' . htmlspecialchars($row['stream_name']) . '">' . htmlspecialchars($row['stream_name']) . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-object-group"></i> Section</label>
          <select class="form-control" name="student_class_section" id="student_class_section" onchange="for_list();">
            <option value="All">All</option>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-cog"></i> Generate By</label>
          <select class="form-control" name="roll_no_generate_by" id="roll_no_generate_by" onchange="for_list();">
            <option value="Automatic">Automatic</option>
            <option value="Mannual">Manual</option>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-list"></i> Admission Type</label>
          <select class="form-control" name="student_admission_type" id="student_admission_type" onchange="for_list();">
            <option value="All">All</option>
            <option value="Regular">Regular</option>
            <option value="Private">Private</option>
          </select>
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-sort"></i> Order By</label>
          <select class="form-control" name="order_by" id="order_by" onchange="for_list();">
            <option value=" ORDER BY student_name ASC">Student Name</option>
            <option value=" ORDER BY student_admission_number ASC">Admission No.</option>
          </select>
        </div>

      </div>
    </div>

    <div class="st-result-wrap">
      <div class="st-result-hdr">
        <div class="st-result-hdr-icon"><i class="fa fa-list-ol"></i></div>
        <span class="st-result-hdr-title">Roll Number List</span>
      </div>
      <div class="st-result-body">
        <div id="my_table" class="table-responsive"></div>
      </div>
      <div class="st-submit-row">
        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="st-submit-btn">
      </div>
    </div>

    </form>
  </div><!-- /.st-wrap -->
</section>
