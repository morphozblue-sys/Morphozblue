<?php
include("../attachment/session.php");
$school_info_school_medium=$_SESSION['school_info_medium'];
?>

<!-- Page Header -->
<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-graduation-cap"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Student Admission List']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student Admission List']; ?></span>
  </nav>
</section>

<style>
/* ════════════════════════════════════════
   ADMISSION LIST — Modern UI
   ════════════════════════════════════════ */
.al-wrap {
    padding: 20px 18px 40px;
    background: linear-gradient(160deg, #eef1f7 0%, #f4f6fb 60%, #eaecf4 100%);
    min-height: 80vh;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}

/* Filter card */
.al-filter-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04);
    border: 1px solid rgba(15,52,96,.07);
    margin-bottom: 20px;
    overflow: hidden;
    animation: alFadeIn .4s ease forwards;
}
.al-filter-hdr {
    background: linear-gradient(135deg, #0f3460 0%, #16213e 55%, #1a1a2e 100%);
    padding: 12px 20px;
    display: flex; align-items: center; gap: 11px;
    border-bottom: 3px solid #b92b27;
    flex-wrap: wrap;
}
.al-filter-hdr-icon {
    width: 30px; height: 30px; border-radius: 8px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.al-filter-hdr-icon i { font-size: 14px; color: #fff; }
.al-filter-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; flex: 1; }
.al-filter-hdr-actions { display: flex; gap: 8px; align-items: center; }
.al-filter-toggle {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.15); color: #fff;
    border: 1px solid rgba(255,255,255,.25); border-radius: 8px;
    padding: 5px 14px; font-size: 12px; font-weight: 700;
    cursor: pointer; transition: background .2s;
}
.al-filter-toggle:hover { background: rgba(255,255,255,.25); }
.al-filter-reset {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(185,43,39,.7); color: #fff;
    border: none; border-radius: 8px;
    padding: 5px 14px; font-size: 12px; font-weight: 700;
    cursor: pointer; transition: background .2s;
    text-decoration: none;
}
.al-filter-reset:hover { background: rgba(185,43,39,1); color: #fff; }
.al-filter-collapse { padding: 16px 20px 12px; }
.al-filter-row { display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-start; }
.al-filter-group { display: flex; flex-direction: column; gap: 5px; min-width: 160px; flex: 1; }
.al-filter-group label {
    font-size: 11px; font-weight: 800; text-transform: uppercase;
    letter-spacing: .5px; color: #2c3e6b; margin-bottom: 0;
    display: flex; align-items: center; gap: 5px;
}
.al-filter-group label i { color: #7f8fa6; font-size: 11px; }
.al-filter-group .form-control {
    border: 1.5px solid #dce3ef; border-radius: 9px; height: 38px;
    font-size: 13px; background: #f8f9fc;
    transition: border-color .2s, box-shadow .2s;
}
.al-filter-group .form-control:focus {
    border-color: #0f3460; box-shadow: 0 0 0 3px rgba(15,52,96,.12);
    background: #fff; outline: none;
}
/* Radio groups */
.al-radio-group {
    display: flex; flex-wrap: wrap; gap: 8px;
    padding: 8px 12px;
    border: 1.5px solid #dce3ef; border-radius: 9px;
    background: #f8f9fc; min-height: 38px; align-items: center;
}
.al-radio-group label { font-size: 12px; font-weight: 600; color: #2d3436; display: flex; align-items: center; gap: 3px; text-transform: none; letter-spacing: 0; }
.al-radio-group input[type=radio] { accent-color: #0f3460; }

/* Medium checkbox */
.al-medium-bar {
    padding: 8px 20px; background: #f8faff;
    border-bottom: 1px solid #eef1f7;
    font-size: 13px; font-weight: 600; color: #2c3e6b;
    display: flex; align-items: center; gap: 8px;
}

/* Table card */
.al-table-card {
    background: #fff; border-radius: 16px;
    box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04);
    border: 1px solid rgba(15,52,96,.07); overflow: hidden;
    animation: alFadeIn .5s .08s ease both;
}
.al-table-hdr {
    background: linear-gradient(135deg, #0f3460 0%, #16213e 55%, #1a1a2e 100%);
    padding: 12px 20px; display: flex; align-items: center; gap: 11px;
    border-bottom: 3px solid #b92b27;
}
.al-table-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; }
.al-table-hdr-icon i { font-size: 14px; color: #fff; }
.al-table-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.al-table-body { padding: 16px 20px; }

/* DataTable overrides */
.al-table-card table.dataTable thead th {
    background: #f0f4ff; color: #0f3460; font-size: 11px; font-weight: 800;
    text-transform: uppercase; letter-spacing: .5px;
    border-bottom: 2px solid #dce3ef !important; border-top: none !important;
    padding: 10px 10px; white-space: nowrap;
}
.al-table-card table.dataTable tbody td {
    font-size: 13px; color: #2d3436; vertical-align: middle;
    padding: 9px 10px; border-top: 1px solid #f0f2f8 !important;
}
.al-table-card table.dataTable tbody tr:hover td { background: #f5f7ff !important; }
.al-table-card table.dataTable tbody tr:nth-child(even) td { background: #fafbff; }

/* Scrollbar */
.al-table-body { scrollbar-width: thin; scrollbar-color: #c5d0e6 #f0f4ff; }
.al-table-body::-webkit-scrollbar { height: 6px; }
.al-table-body::-webkit-scrollbar-track { background: #f0f4ff; border-radius: 10px; }
.al-table-body::-webkit-scrollbar-thumb { background: #b2becd; border-radius: 10px; }
.dataTables_scrollBody { scrollbar-width: thin; scrollbar-color: #c5d0e6 #f0f4ff; }
.dataTables_scrollBody::-webkit-scrollbar { height: 6px; }
.dataTables_scrollBody::-webkit-scrollbar-track { background: #f0f4ff; border-radius: 10px; }
.dataTables_scrollBody::-webkit-scrollbar-thumb { background: #b2becd; border-radius: 10px; }

/* Action buttons */
.al-act {
    display: inline-flex; align-items: center; justify-content: center; gap: 4px;
    padding: 4px 9px; border-radius: 7px; font-size: 11px; font-weight: 700;
    border: none; cursor: pointer; transition: transform .18s, box-shadow .18s;
    text-decoration: none; white-space: nowrap;
}
.al-act:hover { transform: translateY(-1px); box-shadow: 0 3px 10px rgba(0,0,0,.18); }
.al-act-edit   { background: #1565c0; color: #fff !important; }
.al-act-delete { background: #c62828; color: #fff !important; }
.al-act-print  { background: #6a1b9a; color: #fff !important; }

/* Name/class display */
.al-name { font-weight: 700; color: #0f3460; }
.al-class-badge { display: inline-block; padding: 2px 9px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #e8f0fe; color: #1565c0; }

/* DataTable controls */
.dataTables_wrapper { font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif; }
.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label { font-size: 12px; font-weight: 700; color: #4a5568; display: flex; align-items: center; gap: 8px; }
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1.5px solid #dce3ef !important; border-radius: 8px !important;
    height: 34px !important; font-size: 12.5px !important; color: #2d3436 !important;
    background: #f8f9fc !important; padding: 4px 10px !important;
    box-shadow: none !important; transition: border-color .2s !important; outline: none !important;
}
.dataTables_wrapper .dataTables_filter input { min-width: 200px; }
.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #0f3460 !important; box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important; background: #fff !important;
}
.dataTables_wrapper .dataTables_processing {
    background: linear-gradient(135deg, #0f3460, #1a1a2e) !important;
    color: #fff !important; border-radius: 10px !important; font-size: 13px !important;
    font-weight: 700 !important; padding: 12px 24px !important;
    box-shadow: 0 8px 30px rgba(15,52,96,.25) !important; border: none !important; top: 50% !important;
}
.dataTables_wrapper .dataTables_info { font-size: 12px; font-weight: 600; color: #636e88; padding-top: 14px !important; }
.dataTables_wrapper .dataTables_paginate { padding-top: 10px !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-flex !important; align-items: center !important; justify-content: center !important;
    min-width: 34px !important; height: 34px !important; padding: 0 10px !important;
    margin: 0 2px !important; border-radius: 8px !important; font-size: 12.5px !important;
    font-weight: 700 !important; color: #4a5568 !important; background: #f0f4ff !important;
    border: 1.5px solid #dce3ef !important; cursor: pointer !important;
    transition: all .18s !important; box-shadow: none !important; line-height: 1 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #e8f0fe !important; border-color: #0f3460 !important;
    color: #0f3460 !important; transform: translateY(-1px) !important;
    box-shadow: 0 3px 10px rgba(15,52,96,.12) !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: linear-gradient(135deg, #0f3460, #1565c0) !important;
    border-color: transparent !important; color: #fff !important;
    box-shadow: 0 4px 14px rgba(15,52,96,.28) !important; transform: translateY(-1px) !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: #f8f9fc !important; border-color: #edf0f7 !important;
    color: #b2becd !important; cursor: default !important;
    transform: none !important; box-shadow: none !important; opacity: .7 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.previous,
.dataTables_wrapper .dataTables_paginate .paginate_button.next { padding: 0 14px !important; font-size: 12px !important; }

/* Confirm overlay */
.al-confirm-overlay {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(15,32,70,.55);
    display: flex; align-items: center; justify-content: center;
    animation: alFadeIn .18s ease;
}
.al-confirm-box {
    background: #fff; border-radius: 18px; padding: 32px 30px 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.22); max-width: 380px; width: 90%;
    text-align: center; animation: alSlideUp .22s cubic-bezier(.34,1.56,.64,1);
}
.al-confirm-icon { width: 56px; height: 56px; border-radius: 50%; background: #fff3f3; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }
.al-confirm-icon i { font-size: 24px; color: #c62828; }
.al-confirm-title { font-size: 17px; font-weight: 800; color: #1a1a2e; margin-bottom: 6px; }
.al-confirm-msg { font-size: 13px; color: #636e88; margin-bottom: 22px; line-height: 1.5; }
.al-confirm-btns { display: flex; gap: 10px; justify-content: center; }
.al-confirm-yes { background: #c62828; color: #fff; border: none; border-radius: 9px; padding: 10px 28px; font-size: 13.5px; font-weight: 700; cursor: pointer; }
.al-confirm-yes:hover { background: #b71c1c; }
.al-confirm-no { background: #f0f2f8; color: #2c3e6b; border: none; border-radius: 9px; padding: 10px 28px; font-size: 13.5px; font-weight: 700; cursor: pointer; }
.al-confirm-no:hover { background: #e3e8f5; }

@keyframes alFadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes alSlideUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
</style>

<script>
function al_confirm(title, msg, onYes) {
    var overlay = $('<div class="al-confirm-overlay">'+
        '<div class="al-confirm-box">'+
          '<div class="al-confirm-icon"><i class="fa fa-trash"></i></div>'+
          '<div class="al-confirm-title">'+title+'</div>'+
          '<div class="al-confirm-msg">'+msg+'</div>'+
          '<div class="al-confirm-btns">'+
            '<button class="al-confirm-no">Cancel</button>'+
            '<button class="al-confirm-yes">Yes, Delete</button>'+
          '</div>'+
        '</div></div>');
    $('body').append(overlay);
    overlay.find('.al-confirm-no').on('click', function() { overlay.remove(); });
    overlay.find('.al-confirm-yes').on('click', function() { overlay.remove(); onYes(); });
    overlay.on('click', function(e) { if ($(e.target).hasClass('al-confirm-overlay')) overlay.remove(); });
}

function valid(s_no) {
    al_confirm('Delete Admission', 'This will permanently remove the student admission record. This action cannot be undone.',
        function() { admission_delete(s_no); });
}

function admission_delete(s_no) {
    $("#get_content").html(loader_div);
    $.ajax({
        type: "POST",
        url: access_link + "student/student_admission_delete.php?id=" + s_no,
        cache: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Record deleted successfully', 'green');
                get_content('student/student_admission_list');
            } else {
                alert_new(detail || 'Delete failed.', 'red');
                get_content('student/student_admission_list');
            }
        },
        error: function() {
            alert_new('Server error. Please try again.', 'red');
            get_content('student/student_admission_list');
        }
    });
}

function check_function() {
    $("#search_list").html(loader_div);
    var value = $("#all_medium").prop("checked") ? "Yes" : "No";
    $.ajax({
        type: "POST",
        url: access_link + "student/student_admission_filter_checked.php?checked=" + value,
        cache: false,
        success: function(detail) { $("#search_list").html(detail); },
        error: function() { alert_new('Server error. Please try again.', 'red'); }
    });
}
</script>

<section class="content">
  <div class="al-wrap">

    <!-- Filter + Table Card -->
    <div class="al-filter-card">
      <div class="al-filter-hdr">
        <div class="al-filter-hdr-icon"><i class="fa fa-filter"></i></div>
        <span class="al-filter-hdr-title">Filters &amp; Sort</span>
        <div class="al-filter-hdr-actions">
          <?php if($school_info_school_medium=='Both'): ?>
          <label class="al-filter-toggle" style="cursor:pointer;">
            <input type="checkbox" onclick="check_function();" name="all_medium" id="all_medium" style="accent-color:#fff;">
            Both Medium
          </label>
          <?php endif; ?>
          <a href="javascript:get_content('student/student_admission_list')" class="al-filter-reset">
            <i class="fa fa-refresh"></i> Reset
          </a>
          <button class="al-filter-toggle" type="button" onclick="$('#al-collapse').slideToggle(200);">
            <i class="fa fa-sliders"></i> Advanced
          </button>
        </div>
      </div>
      <div id="al-collapse" style="display:none;">
        <div class="al-filter-collapse">
          <?php include("admission_list_filter.php"); ?>
        </div>
      </div>
    </div>

    <!-- Table Card -->
    <div class="al-table-card">
      <div class="al-table-hdr">
        <div class="al-table-hdr-icon"><i class="fa fa-table"></i></div>
        <span class="al-table-hdr-title"><?php echo $language['Admission List']; ?></span>
      </div>
      <div class="al-table-body">
        <table id="example1" class="table table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo $language['Student Name']; ?></th>
              <th><?php echo $language['Father Name']; ?></th>
              <th><?php echo $language['Class']; ?></th>
              <th>Stream</th>
              <th>Contact No.</th>
              <th>DOB</th>
              <th>Age</th>
              <th><?php echo $language['Student Roll No']; ?></th>
              <th>Admission No.</th>
              <?php if($_SESSION['database_name']=='simptkfv_sunriseschoolbijuri'): ?>
              <th>Scholar No.</th>
              <?php endif; ?>
              <th>Updated By</th>
              <th>Date</th>
              <th><?php echo $language['Edit']; ?></th>
              <th><?php echo $language['Delete']; ?></th>
              <th><?php echo $language['Print']; ?></th>
              <th>Scholar Print</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

  </div><!-- /.al-wrap -->
</section>

<script>
$(function() { for_list(); });
</script>
