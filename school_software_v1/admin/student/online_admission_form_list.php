<?php include("../attachment/session.php"); ?>

<style>
.oal-wrap { padding: 20px 18px 40px; background: linear-gradient(160deg,#eef1f7 0%,#f4f6fb 60%,#eaecf4 100%); min-height: 80vh; font-family: 'Source Sans Pro','Helvetica Neue',Arial,sans-serif; }
.oal-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 22px rgba(15,52,96,.09); border: 1px solid rgba(15,52,96,.07); overflow: hidden; animation: oalFadeIn .4s ease forwards; }
.oal-hdr { background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%); padding: 12px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 3px solid #b92b27; }
.oal-hdr-left { display: flex; align-items: center; gap: 11px; }
.oal-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; }
.oal-hdr-icon i { color: #fff; font-size: 14px; }
.oal-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.oal-body { padding: 16px 20px; }
.oal-dl-btn { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); border-radius: 8px; padding: 6px 16px; font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background .2s; display: inline-flex; align-items: center; gap: 6px; }
.oal-dl-btn:hover { background: rgba(255,255,255,.28); color: #fff; text-decoration: none; }
.oal-act { border: none; border-radius: 7px; padding: 5px 12px; font-size: 12px; font-weight: 600; cursor: pointer; transition: opacity .2s; }
.oal-act:hover { opacity: .82; }
.oal-act-del  { background: #e74c3c; color: #fff; }
.oal-act-dis  { background: #e67e22; color: #fff; }
.oal-act-en   { background: #27ae60; color: #fff; }
.oal-act-view { background: #2980b9; color: #fff; }
@keyframes oalFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
</style>

<script>
function valid(s_no) {
    if (confirm("Are you sure you want to delete this record?")) {
        delete_record(s_no);
    }
}

function delete_record(s_no) {
    $.ajax({
        type: "POST",
        url: access_link + "student/online_admission_form_delete.php?s_no=" + s_no,
        cache: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Successfully Deleted', 'red');
                get_content('student/online_admission_form_list');
            } else if (res[1] === 'session_not_set') {
                alert_new('Session Expired!', 'red');
            }
        }
    });
}

function for_status(s_no, value) {
    $.ajax({
        type: "POST",
        url: access_link + "student/online_admission_form_enable_disable.php?s_no=" + s_no + "&value=" + value,
        cache: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Successfully Completed', 'green');
                get_content('student/online_admission_form_list');
            } else if (res[1] === 'session_not_set') {
                alert_new('Session Expired!', 'red');
            }
        }
    });
}
</script>

<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-wpforms"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Student Management']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-wpforms"></i> Online Admission Form List</span>
  </nav>
</section>

<section class="content">
  <div class="oal-wrap">

    <div class="oal-card">
      <div class="oal-hdr">
        <div class="oal-hdr-left">
          <div class="oal-hdr-icon"><i class="fa fa-list-alt"></i></div>
          <span class="oal-hdr-title">Admission Form List</span>
        </div>
        <a href="javascript:get_content('student/online_admission_form_list_download')" class="oal-dl-btn">
          <i class="fa fa-download"></i> Download
        </a>
      </div>
      <div class="oal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Roll No</th>
                <th>Selection Marks</th>
                <th>Student Name</th>
                <th>Admission Class</th>
                <th>Contact No.</th>
                <th>Category</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Father Name</th>
                <th>Father Contact</th>
                <th>Annual Income</th>
                <th>Mother Name</th>
                <th>Action</th>
                <th>Enable / Disable</th>
                <th>Photo</th>
                <th>Income Cert.</th>
                <th>Aadhar Card</th>
                <th>Caste Cert.</th>
                <th>Bank Passbook</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $query19 = "select * from student_admission_info_website where status='Active'";
            $run19   = mysqli_query($conn73, $query19) or die(mysqli_error($conn73));
            $ser = 0;
            while ($row = mysqli_fetch_assoc($run19)):
                $s_no                    = $row['s_no'];
                $selection_roll_no       = htmlspecialchars($row['selection_roll_no']);
                $selection_obtain_marks  = htmlspecialchars($row['selection_obtain_marks']);
                $student_name            = htmlspecialchars($row['student_name']);
                $student_admission_class = htmlspecialchars($row['student_admission_class']);
                $student_mobile_no       = htmlspecialchars($row['student_mobile_no']);
                $student_category        = htmlspecialchars($row['student_category']);
                $student_dob             = htmlspecialchars($row['student_dob']);
                $student_gender          = htmlspecialchars($row['student_gender']);
                $father_name             = htmlspecialchars($row['father_name']);
                $father_mobile_no        = htmlspecialchars($row['father_mobile_no']);
                $father_annual_income    = htmlspecialchars($row['father_annual_income']);
                $mother_name             = htmlspecialchars($row['mother_name']);
                $website_status          = $row['website_status'];
                $base_path               = $_SESSION['amazon_file_path'] . "student_admission_info_website/";
                $ser++;
            ?>
              <tr>
                <td><?php echo $ser; ?></td>
                <td><?php echo $selection_roll_no; ?></td>
                <td><?php echo $selection_obtain_marks; ?></td>
                <td><?php echo $student_name; ?></td>
                <td><?php echo $student_admission_class; ?></td>
                <td><?php echo $student_mobile_no; ?></td>
                <td><?php echo $student_category; ?></td>
                <td><?php echo $student_dob; ?></td>
                <td><?php echo $student_gender; ?></td>
                <td><?php echo $father_name; ?></td>
                <td><?php echo $father_mobile_no; ?></td>
                <td><?php echo $father_annual_income; ?></td>
                <td><?php echo $mother_name; ?></td>
                <td>
                  <button type="button" class="oal-act oal-act-del"
                          onclick="return valid('<?php echo $s_no; ?>');">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </td>
                <td>
                  <?php if ($website_status === 'Enable'): ?>
                  <button type="button" class="oal-act oal-act-dis"
                          onclick="for_status('<?php echo $s_no; ?>','Disable');">
                    <i class="fa fa-ban"></i> Disable
                  </button>
                  <?php else: ?>
                  <button type="button" class="oal-act oal-act-en"
                          onclick="for_status('<?php echo $s_no; ?>','Enable');">
                    <i class="fa fa-check"></i> Enable
                  </button>
                  <?php endif; ?>
                </td>
                <td><?php if ($row['student_image']): ?><a href="<?php echo $base_path . htmlspecialchars($row['student_image']); ?>" target="_blank"><button type="button" class="oal-act oal-act-view"><i class="fa fa-eye"></i></button></a><?php endif; ?></td>
                <td><?php if ($row['income_certificate_image']): ?><a href="<?php echo $base_path . htmlspecialchars($row['income_certificate_image']); ?>" target="_blank"><button type="button" class="oal-act oal-act-view"><i class="fa fa-eye"></i></button></a><?php endif; ?></td>
                <td><?php if ($row['student_uid_image']): ?><a href="<?php echo $base_path . htmlspecialchars($row['student_uid_image']); ?>" target="_blank"><button type="button" class="oal-act oal-act-view"><i class="fa fa-eye"></i></button></a><?php endif; ?></td>
                <td><?php if ($row['caste_certificate_image']): ?><a href="<?php echo $base_path . htmlspecialchars($row['caste_certificate_image']); ?>" target="_blank"><button type="button" class="oal-act oal-act-view"><i class="fa fa-eye"></i></button></a><?php endif; ?></td>
                <td><?php if ($row['bank_passbook_image']): ?><a href="<?php echo $base_path . htmlspecialchars($row['bank_passbook_image']); ?>" target="_blank"><button type="button" class="oal-act oal-act-view"><i class="fa fa-eye"></i></button></a><?php endif; ?></td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div><!-- /.oal-wrap -->
</section>

<script>
$(function() { $('#example1').DataTable(); });
</script>
