<?php include("../attachment/session.php"); ?>

<style>
.sa-wrap { padding: 20px 18px 40px; background: linear-gradient(160deg,#eef1f7 0%,#f4f6fb 60%,#eaecf4 100%); min-height: 80vh; font-family: 'Source Sans Pro','Helvetica Neue',Arial,sans-serif; }
.sa-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04); border: 1px solid rgba(15,52,96,.07); overflow: hidden; margin-bottom: 20px; animation: saFadeIn .4s ease forwards; }
.sa-hdr { background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%); padding: 12px 20px; display: flex; align-items: center; gap: 11px; border-bottom: 3px solid #b92b27; }
.sa-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.sa-hdr-icon i { color: #fff; font-size: 14px; }
.sa-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.sa-body { padding: 20px; }
.sa-search-row { display: flex; align-items: flex-end; gap: 14px; flex-wrap: wrap; }
.sa-search-group { display: flex; flex-direction: column; gap: 5px; flex: 1; min-width: 260px; }
.sa-search-group label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; color: #2c3e6b; display: flex; align-items: center; gap: 5px; }
.sa-search-group label i { color: #7f8fa6; font-size: 11px; }
.sa-search-group .form-control,.sa-search-group .select2-container .select2-selection--single { border: 1.5px solid #dce3ef !important; border-radius: 9px !important; height: 38px !important; font-size: 13px; background: #f8f9fc !important; box-shadow: none !important; }
.sa-fields { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 18px; padding-top: 16px; border-top: 1px solid #eef0f6; }
.sa-field { display: flex; flex-direction: column; gap: 4px; min-width: 130px; flex: 1; }
.sa-field label { font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; color: #7f8fa6; margin-bottom: 0; }
.sa-field .form-control { border: 1.5px solid #dce3ef !important; border-bottom: 1.5px solid #dce3ef !important; border-radius: 9px !important; height: 34px !important; font-size: 13px; background: #f4f6fb !important; color: #2c3e6b; font-weight: 600; box-shadow: none !important; }
.sa-field .form-control:focus { border-color: #0f3460 !important; box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important; }
.sa-actions { display: flex; flex-wrap: wrap; gap: 10px; padding: 18px 20px 20px; border-top: 1px solid #eef0f6; }
.sa-btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 11px 20px; border: none; border-radius: 10px; font-size: 13px; font-weight: 700; cursor: pointer; transition: opacity .2s, transform .15s, box-shadow .15s; flex: 1; min-width: 150px; letter-spacing: .2px; }
.sa-btn:hover:not(:disabled) { opacity: .9; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,0,0,.18); }
.sa-btn:disabled { background: #e8eaef !important; color: #9aa0b0 !important; cursor: not-allowed; transform: none; box-shadow: none !important; }
.sa-btn i { font-size: 13px; }
.sa-btn-green   { background: linear-gradient(135deg,#27ae60,#1e8449); color: #fff; }
.sa-btn-blue    { background: linear-gradient(135deg,#2980b9,#1a6b99); color: #fff; }
.sa-btn-orange  { background: linear-gradient(135deg,#e67e22,#ca6f1e); color: #fff; }
.sa-btn-purple  { background: linear-gradient(135deg,#8e44ad,#7d3c98); color: #fff; }
.sa-btn-dark    { background: linear-gradient(135deg,#0f3460,#16213e); color: #fff; }
.sa-btn-red     { background: linear-gradient(135deg,#e74c3c,#c0392b); color: #fff; }
.sa-btn-teal    { background: linear-gradient(135deg,#1abc9c,#16a085); color: #fff; }
.sa-btn-indigo  { background: linear-gradient(135deg,#3498db,#2471a3); color: #fff; }
.sa-result-body { padding: 0 20px 16px; }
.sa-search-group .select2-container { width: 100% !important; }
.sa-search-group .select2-selection--single { height: 38px !important; border: 1.5px solid #dce3ef !important; border-radius: 9px !important; background: #f8f9fc !important; box-shadow: none !important; display: flex; align-items: center; }
.sa-search-group .select2-selection__rendered { line-height: 38px !important; padding-left: 12px !important; color: #2c3e6b; font-size: 13px; }
.sa-search-group .select2-selection__arrow { height: 36px !important; }
@keyframes saFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
</style>

<script type="text/javascript">
function fill_detail(value) {
    $("#student_name").val('Loading....');
    $("#student_class").val('Loading....');
    $("#student_section").val('Loading....');
    $("#school_roll_no").val('Loading....');
    $("#student_roll_no_show").val('Loading....');
    $.ajax({
        address: "POST",
        url: access_link + "student/ajax_search_student_box.php?id=" + value,
        cache: false,
        success: function(detail) {
            var res = detail.split("|?|");
            $("#student_roll_no").val(value);
            $("#student_roll_no1").val(value);
            $("#student_roll_no2").val(value);
            $("#student_roll_no5").val(value);
            $("#student_roll_no6").val(value);
            $("#student_name").val(res[0]);
            $("#student_name1").val(res[0]);
            $("#student_class").val(res[1]);
            $("#student_class2").val(res[1]);
            $("#student_section").val(res[2]);
            $("#school_roll_no").val(res[3]);
            $("#student_roll_no_show").val(res[4]);
            $("#student_scholar_number").val(res[3]);
            $("#student_class_group11").val(res[5]);
            $("#student_class_stream11").val(res[6]);
            $("#student_medium11").val(res[7]);

            $("#pay_fee1").prop('disabled', false);
            $("#fee_detail").prop('disabled', false);
            $("#tc_generate").prop('disabled', false);
            $("#penalty").prop('disabled', false);
            $("#assign_rfid").prop('disabled', false);
            $("#attendance").prop('disabled', false);
            $("#marksheet").prop('disabled', false);
            $("#exam_wise_marksheet").prop('disabled', false);
            $("#id_card_generate").prop('disabled', false);
            $("#student_edit1").prop('disabled', false);
            $("#student").prop('disabled', false);
            $("#parent").prop('disabled', false);
            $("#student_detail").prop('disabled', false);
            $("#student_detail_list").html('');
            for_exam();
        }
    });
}

function set_id_card(value1) {
    document.getElementById("id_card_design").value = value1;
    student_id_card_function();
}

function for_exam() {
    var student_class = document.getElementById('student_class').value;
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_get_exam_type.php?class_name=" + student_class,
        cache: false,
        success: function(detail) { $("#exam_type23").html(detail); }
    });
}

function student_list() {
    var student_roll_no = document.getElementById('student_roll_no').value;
    if (student_roll_no !== '') {
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_get_student_detail.php?student_roll_no=" + student_roll_no,
            cache: false,
            success: function(detail) { $("#student_detail_list").html(detail); }
        });
    } else {
        $("#student_detail_list").html('');
    }
}

function get_identity(id) {
    $('#student_parent').val(id);
    $('#gallery, #parent_gallery, #upload_photo, #img_list, #camera, #save_image, #take_snapshots, #retake').hide();
    $('#dropdown_select').val('');
}

$("#my_form1").submit(function(e) {
    e.preventDefault();
    $("#modal_close_button").click();
    var formdata = new FormData(this);
    $.ajax({
        url: access_link + "student/student_action_assign_rfid_api.php",
        type: "POST", data: formdata, contentType: false, cache: false, processData: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[2] === 'view') {
                alert_new('Card assigned successfully', 'green');
            } else {
                alert_new('Invalid Card No', 'red');
            }
            get_content('student/student_action');
        },
        error: function() { alert_new('Server error. Please try again.', 'red'); }
    });
});

function pay_fee(foldername) {
    var r = document.getElementById('student_roll_no').value;
    post_content(foldername + '/student_fee_add_form', 'student_roll_no=' + r);
}
function fee_detail1(foldername) {
    var r = document.getElementById('student_roll_no').value;
    post_content(foldername + '/student_fee_list_particular', 'student_roll_no=' + r);
}
function tc_generate1() {
    var r = document.getElementById('student_roll_no').value;
    var m = document.getElementById('student_medium11').value;
    if (m === 'English') { post_content('certificate/tc_form_cbse', 'student_roll_no1=' + r); }
    else if (m === 'Hindi') { post_content('certificate/tc_form', 'student_roll_no1=' + r); }
}
function pay_penalty() {
    var r = document.getElementById('student_roll_no').value;
    post_content('penalty/penalty_action', 'student_roll_no1=' + r);
}
function student_edit_function() {
    var r = document.getElementById('student_roll_no').value;
    post_content('student/student_admission', 'student_roll_no=' + r);
}
function student_attendance_function() {
    var r  = document.getElementById('student_roll_no').value;
    var cl = document.getElementById('student_class').value;
    var sc = document.getElementById('student_section').value;
    var n  = document.getElementById('student_name').value;
    var cm = document.getElementById('current_month').value;
    var yr = document.getElementById('year').value;
    post_content('attendance/student_attendance_view', 'id=' + r + '&class=' + cl + '&section=' + sc + '&current_month=' + cm + '&year=' + yr + '&name=' + n);
}
function student_marksheet_function() {
    var pdf      = document.getElementById('marksheet_final_pdf').value;
    var pdfpath  = document.getElementById('pdf_path').value;
    var r        = document.getElementById('student_roll_no').value;
    var cl       = document.getElementById('student_class').value;
    var grp      = document.getElementById('student_class_group11').value;
    var strm     = document.getElementById('student_class_stream11').value;
    var sess     = document.getElementById('session_value11').value;
    window.open(pdfpath + "marksheet_page/" + pdf + "?roll_no=" + r + "&class=" + cl + "&student_class_group=" + grp + "&student_class_stream=" + strm + "&session1=" + sess, '_blank');
}
function student_examwise_marksheet_function() {
    var pdf     = document.getElementById('marksheet_exam_wise_pdf').value;
    var pdfpath = document.getElementById('pdf_path').value;
    var r       = document.getElementById('student_roll_no').value;
    var cl      = document.getElementById('student_class').value;
    var exam    = document.getElementById('exam_type23').value;
    window.open(pdfpath + "marksheet_page/" + pdf + "?roll_no=" + r + "&class=" + cl + "&exam_type=" + exam, '_blank');
}
function student_id_card_function() {
    var design  = document.getElementById('id_card_student_pdf').value;
    var pdfpath = document.getElementById('pdf_path').value;
    var r       = document.getElementById('student_roll_no').value;
    window.open(pdfpath + "id_card_page/" + design + "?school_id_card_info=" + r, '_blank');
}
</script>

<?php
$qry  = "select fees_type from school_info_general";
$rest = mysqli_query($conn73, $qry);
while ($row22 = mysqli_fetch_assoc($rest)) { $fees_type = $row22['fees_type']; }
if ($fees_type === 'installmentwise' || $fees_type === 'monthly' || $fees_type === 'yearly') {
    $folder_name = 'fees_' . $fees_type;
} else {
    $folder_name = 'fees';
}
$que = "select id_card_student_pdf, marksheet_final_pdf, marksheet_exam_wise_pdf from school_info_pdf_info";
$run = mysqli_query($conn73, $que);
while ($row = mysqli_fetch_assoc($run)) {
    $id_card_student_pdf   = $row['id_card_student_pdf'];
    $marksheet_final_pdf   = $row['marksheet_final_pdf'];
    $marksheet_exam_wise_pdf = $row['marksheet_exam_wise_pdf'];
}
?>

<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-bolt"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['One Click']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-bolt"></i> <?php echo $language['One Click']; ?></span>
  </nav>
</section>

<section class="content">
  <div class="sa-wrap">

    <div class="sa-card">
      <div class="sa-hdr">
        <div class="sa-hdr-icon"><i class="fa fa-search"></i></div>
        <span class="sa-hdr-title">Select Student</span>
      </div>
      <div class="sa-body">
        <form role="form" method="post" enctype="multipart/form-data" id="my_form">
          <input type="hidden" id="current_month"        value="<?php echo date('m'); ?>">
          <input type="hidden" id="year"                 value="<?php echo date('Y'); ?>">
          <input type="hidden" id="pdf_path"             value="<?php echo $pdf_path; ?>">
          <input type="hidden" id="id_card_student_pdf"  value="<?php echo $id_card_student_pdf; ?>">
          <input type="hidden" id="marksheet_final_pdf"  value="<?php echo $marksheet_final_pdf; ?>">
          <input type="hidden" id="marksheet_exam_wise_pdf" value="<?php echo $marksheet_exam_wise_pdf; ?>">
          <input type="hidden" id="student_roll_no"      name="student_roll_no">
          <input type="hidden" id="student_scholar_number" name="student_scholar_number">
          <input type="hidden" id="student_class_group11">
          <input type="hidden" id="student_class_stream11">
          <input type="hidden" id="student_medium11">
          <input type="hidden" id="session_value11" value="<?php echo $session1; ?>">

          <!-- Student Search -->
          <div class="sa-search-row">
            <div class="sa-search-group">
              <label><i class="fa fa-search"></i> <?php echo $language['Search Student']; ?></label>
              <select class="form-control select2" onchange="fill_detail(this.value);" id="select_student_action" required>
                <option value=""><?php echo $language['Select student']; ?></option>
                <?php
                $qry  = "select student_roll_no, school_roll_no, student_name, student_class, student_class_section,
                                student_father_name, student_father_contact_number, student_scholar_number, student_admission_number
                         from student_admission_info where student_status='Active' and session_value='$session1'";
                $rest = mysqli_query($conn73, $qry);
                while ($row22 = mysqli_fetch_assoc($rest)) {
                    $srno  = htmlspecialchars($row22['student_roll_no']);
                    $sname = htmlspecialchars($row22['student_name']);
                    $ssch  = htmlspecialchars($row22['student_scholar_number']);
                    $sadm  = htmlspecialchars($row22['student_admission_number']);
                    $sroll = htmlspecialchars($row22['school_roll_no']);
                    $scls  = htmlspecialchars($row22['student_class']);
                    $ssec  = htmlspecialchars($row22['student_class_section']);
                    $sfn   = htmlspecialchars($row22['student_father_name']);
                    $sfc   = htmlspecialchars($row22['student_father_contact_number']);
                    echo "<option value=\"$srno\">$sname [$ssch]-[$sadm]-[$sroll]-[$scls-$ssec]-[$sfn-$sfc]</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <!-- Info Fields -->
          <div class="sa-fields">
            <div class="sa-field">
              <label><?php echo $language['Student Name']; ?></label>
              <input type="text" name="student_name" id="student_name" class="form-control" readonly placeholder="—">
            </div>
            <div class="sa-field">
              <label><?php echo $language['Class']; ?></label>
              <input type="text" name="student_class" id="student_class" class="form-control" readonly placeholder="—">
            </div>
            <div class="sa-field">
              <label><?php echo $language['Student Section']; ?></label>
              <input type="text" name="student_section" id="student_section" class="form-control" readonly placeholder="—">
            </div>
            <div class="sa-field">
              <label><?php echo $language['Scholar No']; ?></label>
              <input type="text" id="school_roll_no" class="form-control" readonly placeholder="—">
            </div>
            <div class="sa-field">
              <label><?php echo $language['Student Roll No']; ?></label>
              <input type="text" id="student_roll_no_show" class="form-control" readonly placeholder="—">
            </div>
          </div>
        </form>
      </div>

      <!-- Action Buttons -->
      <div class="sa-actions">
        <button type="button" onclick="pay_fee('<?php echo $folder_name; ?>');"
                id="pay_fee1" class="sa-btn sa-btn-green" disabled>
          <i class="fa fa-money"></i> <?php echo $language['Pay Fees']; ?>
        </button>
        <button type="button" onclick="fee_detail1('<?php echo $folder_name; ?>');"
                id="fee_detail" class="sa-btn sa-btn-blue" disabled>
          <i class="fa fa-list-alt"></i> <?php echo $language['Fees Details']; ?>
        </button>
        <button type="button" onclick="tc_generate1();"
                id="tc_generate" class="sa-btn sa-btn-orange" disabled>
          <i class="fa fa-file-text-o"></i> <?php echo $language['Tc Generate']; ?>
        </button>
        <button type="button" onclick="pay_penalty();"
                id="penalty" class="sa-btn sa-btn-red" disabled>
          <i class="fa fa-exclamation-triangle"></i> <?php echo $language['Penalty']; ?>
        </button>
        <button type="button" onclick="student_edit_function();"
                id="student_edit1" class="sa-btn sa-btn-dark" disabled>
          <i class="fa fa-pencil"></i> <?php echo $language['Student Edit']; ?>
        </button>
        <button type="button" onclick="student_attendance_function();"
                id="attendance" class="sa-btn sa-btn-teal" disabled>
          <i class="fa fa-calendar-check-o"></i> <?php echo $language['Attendance']; ?>
        </button>
        <button type="button" onclick="student_marksheet_function();"
                id="marksheet" class="sa-btn sa-btn-purple" disabled>
          <i class="fa fa-graduation-cap"></i> <?php echo $language['Full MarkSheet']; ?>
        </button>
        <button type="button" onclick="student_id_card_function();"
                id="id_card_generate" class="sa-btn sa-btn-indigo" disabled>
          <i class="fa fa-id-card-o"></i> <?php echo $language['Id Card Generate']; ?>
        </button>
        <button type="button" onclick="student_list();"
                id="student_detail" class="sa-btn sa-btn-dark" disabled>
          <i class="fa fa-user-circle-o"></i> Student Detail
        </button>
        <button type="button" id="assign_rfid"
                class="sa-btn sa-btn-orange" data-toggle="modal" data-target="#modal-default" disabled>
          <i class="fa fa-wifi"></i> <?php echo $language['Assign Rfid']; ?>
        </button>
      </div>
    </div>

    <!-- Student Detail Result -->
    <div id="student_detail_list"></div>

  </div><!-- /.sa-wrap -->
</section>

<!-- RFID Modal -->
<form role="form" method="post" enctype="multipart/form-data" id="my_form1">
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header my_background_color">
          <button type="button" class="close" data-dismiss="modal" id="modal_close_button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"><b><?php echo $language['ADD RFID CARD NO']; ?></b></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label><?php echo $language['Student Name']; ?></label>
            <input type="text" class="form-control" name="student_name1" id="student_name1" readonly>
          </div>
          <div class="form-group">
            <label><?php echo $language['Roll No']; ?></label>
            <input type="text" class="form-control" name="student_roll_no1" id="student_roll_no1" readonly>
          </div>
          <div class="form-group">
            <label><?php echo $language['Add Rfid']; ?></label>
            <input type="text" name="student_rf_id_number" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $language['Close']; ?></button>
          <input type="submit" name="rf_id_card" value="<?php echo $language['Submit']; ?>" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Exam-Wise Marksheet Modal -->
<form role="form" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-default1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header my_background_color">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"><b><?php echo $language['Choose Exam Type']; ?></b></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label><?php echo $language['Exam Type']; ?></label>
            <select class="form-control" id="exam_type23" name="exam_type" required></select>
          </div>
          <input type="hidden" name="student_roll_no2"      id="student_roll_no2">
          <input type="hidden" name="student_class2"        id="student_class2">
          <input type="hidden" name="student_scholar_number" id="student_scholar_number2">
          <input type="hidden" name="student_class_group11" id="student_class_group11">
          <input type="hidden" name="student_class_stream11" id="student_class_stream11">
          <input type="hidden" name="session_value11"       id="session_value11" value="<?php echo $session1; ?>">
          <input type="hidden" name="student_medium11"      id="student_medium11">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $language['Close']; ?></button>
          <input type="button" onclick="student_examwise_marksheet_function();"
                 value="<?php echo $language['Submit']; ?>" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>
</form>

<script>
$(function() { $('.select2').select2(); });
</script>
