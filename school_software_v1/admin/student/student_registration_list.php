<?php include("../attachment/session.php"); ?>

<!-- Page Header -->
<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-list-alt"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Student Registration List']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-list-alt"></i> <?php echo $language['Student Registration List']; ?></span>
  </nav>
</section>

<style>
/* ════════════════════════════════════════
   REGISTRATION LIST — Modern UI
   ════════════════════════════════════════ */
.rl-wrap {
    padding: 20px 18px 40px;
    background: linear-gradient(160deg, #eef1f7 0%, #f4f6fb 60%, #eaecf4 100%);
    min-height: 80vh;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}

/* Filter card */
.rl-filter-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04);
    border: 1px solid rgba(15,52,96,.07);
    margin-bottom: 20px;
    overflow: hidden;
    animation: rlFadeIn .4s ease forwards;
}
.rl-filter-hdr {
    background: linear-gradient(135deg, #0f3460 0%, #16213e 55%, #1a1a2e 100%);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 11px;
    border-bottom: 3px solid #b92b27;
}
.rl-filter-hdr-icon {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.rl-filter-hdr-icon i { font-size: 14px; color: #fff; }
.rl-filter-hdr-title {
    font-size: 11.5px; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px; color: #fff;
}
.rl-filter-body {
    padding: 18px 20px 14px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 14px;
}
.rl-filter-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
    min-width: 180px;
}
.rl-filter-group label {
    font-size: 11px; font-weight: 800;
    text-transform: uppercase; letter-spacing: .5px;
    color: #2c3e6b;
    display: flex; align-items: center; gap: 5px;
}
.rl-filter-group label i { font-size: 11px; color: #7f8fa6; }
.rl-filter-group .form-control {
    border: 1.5px solid #dce3ef;
    border-radius: 9px;
    height: 38px;
    font-size: 13px;
    color: #2d3436;
    background: #f8f9fc;
    transition: border-color .2s, box-shadow .2s;
}
.rl-filter-group .form-control:focus {
    border-color: #0f3460;
    box-shadow: 0 0 0 3px rgba(15,52,96,.12);
    background: #fff; outline: none;
}

/* Register new button */
.rl-btn-new {
    display: inline-flex; align-items: center; gap: 7px;
    background: linear-gradient(135deg, #b92b27 0%, #0f3460 100%);
    color: #fff !important;
    border: none; border-radius: 9px;
    padding: 9px 20px; font-size: 13px; font-weight: 700;
    box-shadow: 0 4px 14px rgba(185,43,39,.32);
    transition: transform .2s, box-shadow .2s;
    cursor: pointer; text-decoration: none;
    margin-left: auto;
}
.rl-btn-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(185,43,39,.4);
    color: #fff !important;
}

/* Table card */
.rl-table-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04);
    border: 1px solid rgba(15,52,96,.07);
    overflow: hidden;
    animation: rlFadeIn .5s .08s ease both;
}
.rl-table-hdr {
    background: linear-gradient(135deg, #0f3460 0%, #16213e 55%, #1a1a2e 100%);
    padding: 12px 20px;
    display: flex; align-items: center; gap: 11px;
    border-bottom: 3px solid #b92b27;
}
.rl-table-hdr-icon {
    width: 30px; height: 30px; border-radius: 8px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
}
.rl-table-hdr-icon i { font-size: 14px; color: #fff; }
.rl-table-hdr-title {
    font-size: 11.5px; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px; color: #fff;
}
.rl-table-body { padding: 16px 20px; }

/* DataTable overrides */
.rl-table-card table.dataTable thead th {
    background: #f0f4ff;
    color: #0f3460;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .5px;
    border-bottom: 2px solid #dce3ef !important;
    border-top: none !important;
    padding: 11px 12px;
    white-space: nowrap;
}
.rl-table-card table.dataTable tbody td {
    font-size: 13px;
    color: #2d3436;
    vertical-align: middle;
    padding: 10px 12px;
    border-top: 1px solid #f0f2f8 !important;
}
.rl-table-card table.dataTable tbody tr:hover td {
    background: #f5f7ff !important;
}
.rl-table-card table.dataTable tbody tr:nth-child(even) td {
    background: #fafbff;
}

/* Action buttons */
.rl-act {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 4px; padding: 5px 10px;
    border-radius: 7px; font-size: 11.5px; font-weight: 700;
    border: none; cursor: pointer; transition: transform .18s, box-shadow .18s;
    text-decoration: none; white-space: nowrap;
}
.rl-act:hover { transform: translateY(-1px); box-shadow: 0 3px 10px rgba(0,0,0,.18); }
.rl-act-admit  { background: #1565c0; color: #fff !important; }
.rl-act-print  { background: #6a1b9a; color: #fff !important; }
.rl-act-fee    { background: #00695c; color: #fff !important; }
.rl-act-delete { background: #c62828; color: #fff !important; }

/* Confirm overlay */
.rl-confirm-overlay {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(15,32,70,.55);
    display: flex; align-items: center; justify-content: center;
    animation: rlFadeIn .18s ease;
}
.rl-confirm-box {
    background: #fff; border-radius: 18px;
    padding: 32px 30px 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.22);
    max-width: 380px; width: 90%;
    text-align: center;
    animation: rlSlideUp .22s cubic-bezier(.34,1.56,.64,1);
}
.rl-confirm-icon {
    width: 56px; height: 56px; border-radius: 50%;
    background: #fff3f3; margin: 0 auto 14px;
    display: flex; align-items: center; justify-content: center;
}
.rl-confirm-icon i { font-size: 24px; color: #c62828; }
.rl-confirm-title { font-size: 17px; font-weight: 800; color: #1a1a2e; margin-bottom: 6px; }
.rl-confirm-msg   { font-size: 13px; color: #636e88; margin-bottom: 22px; line-height: 1.5; }
.rl-confirm-btns  { display: flex; gap: 10px; justify-content: center; }
.rl-confirm-yes {
    background: #c62828; color: #fff;
    border: none; border-radius: 9px;
    padding: 10px 28px; font-size: 13.5px; font-weight: 700;
    cursor: pointer; transition: background .2s;
}
.rl-confirm-yes:hover { background: #b71c1c; }
.rl-confirm-no {
    background: #f0f2f8; color: #2c3e6b;
    border: none; border-radius: 9px;
    padding: 10px 28px; font-size: 13.5px; font-weight: 700;
    cursor: pointer; transition: background .2s;
}
.rl-confirm-no:hover { background: #e3e8f5; }

/* Student name badge */
.rl-name { font-weight: 700; color: #0f3460; }
.rl-class-badge {
    display: inline-block; padding: 2px 10px;
    border-radius: 20px; font-size: 11px; font-weight: 700;
    background: #e8f0fe; color: #1565c0;
}

/* ── Custom scrollbar ── */
.rl-table-body { scrollbar-width: thin; scrollbar-color: #c5d0e6 #f0f4ff; }
.rl-table-body::-webkit-scrollbar { height: 6px; width: 6px; }
.rl-table-body::-webkit-scrollbar-track { background: #f0f4ff; border-radius: 10px; }
.rl-table-body::-webkit-scrollbar-thumb { background: #b2becd; border-radius: 10px; }
.rl-table-body::-webkit-scrollbar-thumb:hover { background: #0f3460; }

/* DataTable scrollBody scrollbar */
.dataTables_scrollBody { scrollbar-width: thin; scrollbar-color: #c5d0e6 #f0f4ff; }
.dataTables_scrollBody::-webkit-scrollbar { height: 6px; }
.dataTables_scrollBody::-webkit-scrollbar-track { background: #f0f4ff; border-radius: 10px; }
.dataTables_scrollBody::-webkit-scrollbar-thumb { background: #b2becd; border-radius: 10px; }
.dataTables_scrollBody::-webkit-scrollbar-thumb:hover { background: #0f3460; }

/* ── DataTable wrapper controls ── */
.dataTables_wrapper {
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}

/* Top bar: length + filter */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    padding: 4px 0 14px;
}
.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label {
    font-size: 12px; font-weight: 700; color: #4a5568;
    display: flex; align-items: center; gap: 8px; flex-wrap: nowrap;
}
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1.5px solid #dce3ef !important;
    border-radius: 8px !important;
    height: 34px !important;
    font-size: 12.5px !important;
    color: #2d3436 !important;
    background: #f8f9fc !important;
    padding: 4px 10px !important;
    box-shadow: none !important;
    transition: border-color .2s, box-shadow .2s !important;
    outline: none !important;
}
.dataTables_wrapper .dataTables_filter input { min-width: 200px; }
.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #0f3460 !important;
    box-shadow: 0 0 0 3px rgba(15,52,96,.1) !important;
    background: #fff !important;
}

/* Processing indicator */
.dataTables_wrapper .dataTables_processing {
    background: linear-gradient(135deg, #0f3460, #1a1a2e) !important;
    color: #fff !important;
    border-radius: 10px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    padding: 12px 24px !important;
    box-shadow: 0 8px 30px rgba(15,52,96,.25) !important;
    border: none !important;
    top: 50% !important;
}

/* Info text */
.dataTables_wrapper .dataTables_info {
    font-size: 12px;
    font-weight: 600;
    color: #636e88;
    padding-top: 14px !important;
}

/* ── Pagination ── */
.dataTables_wrapper .dataTables_paginate {
    padding-top: 10px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 34px !important;
    height: 34px !important;
    padding: 0 10px !important;
    margin: 0 2px !important;
    border-radius: 8px !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
    color: #4a5568 !important;
    background: #f0f4ff !important;
    border: 1.5px solid #dce3ef !important;
    cursor: pointer !important;
    transition: all .18s !important;
    box-shadow: none !important;
    line-height: 1 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #e8f0fe !important;
    border-color: #0f3460 !important;
    color: #0f3460 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 10px rgba(15,52,96,.12) !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: linear-gradient(135deg, #0f3460, #1565c0) !important;
    border-color: transparent !important;
    color: #fff !important;
    box-shadow: 0 4px 14px rgba(15,52,96,.28) !important;
    transform: translateY(-1px) !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: #f8f9fc !important;
    border-color: #edf0f7 !important;
    color: #b2becd !important;
    cursor: default !important;
    transform: none !important;
    box-shadow: none !important;
    opacity: .7 !important;
}
/* Previous / Next labels */
.dataTables_wrapper .dataTables_paginate .paginate_button.previous,
.dataTables_wrapper .dataTables_paginate .paginate_button.next {
    padding: 0 14px !important;
    font-size: 12px !important;
}

@keyframes rlFadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes rlSlideUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

@media(max-width:767px) {
    .rl-filter-body { gap: 10px; }
    .rl-btn-new { margin-left: 0; width: 100%; justify-content: center; }
    .dataTables_wrapper .dataTables_filter input { min-width: 140px; }
}
</style>

<script>
/* ── Custom confirm dialog ── */
function rl_confirm(title, msg, onYes) {
    var overlay = $('<div class="rl-confirm-overlay">'+
        '<div class="rl-confirm-box">'+
          '<div class="rl-confirm-icon"><i class="fa fa-trash"></i></div>'+
          '<div class="rl-confirm-title">'+title+'</div>'+
          '<div class="rl-confirm-msg">'+msg+'</div>'+
          '<div class="rl-confirm-btns">'+
            '<button class="rl-confirm-no">Cancel</button>'+
            '<button class="rl-confirm-yes">Yes, Delete</button>'+
          '</div>'+
        '</div></div>');
    $('body').append(overlay);
    overlay.find('.rl-confirm-no').on('click', function() { overlay.remove(); });
    overlay.find('.rl-confirm-yes').on('click', function() { overlay.remove(); onYes(); });
    overlay.on('click', function(e) { if ($(e.target).hasClass('rl-confirm-overlay')) overlay.remove(); });
}

function valid(student_roll_no, student_date_of_admission, student_registration_fee) {
    rl_confirm(
        'Delete Registration',
        'This will permanently remove the student registration record. This action cannot be undone.',
        function() { registration_delete(student_roll_no, student_date_of_admission, student_registration_fee); }
    );
}

function registration_delete(student_roll_no, student_date_of_admission, student_registration_fee) {
    $("#get_content").html(loader_div);
    $.ajax({
        type: "POST",
        url: access_link + "student/student_registration_delete.php?id=" + student_roll_no + "&date=" + student_date_of_admission + "&amount=" + student_registration_fee,
        cache: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                get_content('student/student_registration_list');
            } else {
                alert_new(detail || 'Delete failed. Please try again.', 'red');
                get_content('student/student_registration_list');
            }
        },
        error: function() {
            alert_new('Server error. Please try again.', 'red');
            get_content('student/student_registration_list');
        }
    });
}
</script>

<section class="content">
  <div class="rl-wrap">

    <!-- Filter Card -->
    <div class="rl-filter-card">
      <div class="rl-filter-hdr">
        <div class="rl-filter-hdr-icon"><i class="fa fa-filter"></i></div>
        <span class="rl-filter-hdr-title">Filter Records</span>
      </div>
      <div class="rl-filter-body">
        <div class="rl-filter-group">
          <label><i class="fa fa-graduation-cap"></i> <?php echo $language['Class']; ?></label>
          <select name="student_class" id="student_class_filter" onchange="for_list(this.value);" class="form-control">
            <option value="All"><?php echo $language['All']; ?></option>
            <?php
            $class37   = $_SESSION['class_name37'];
            $class371  = explode('|?|', $class37);
            $total_class = $_SESSION['class_total37'];
            for ($q = 0; $q < $total_class; $q++) {
                $class_name = $class371[$q];
                echo '<option value="' . htmlspecialchars($class_name) . '">' . htmlspecialchars($class_name) . '</option>';
            }
            ?>
          </select>
        </div>
        <button class="rl-btn-new" onclick="get_content('student/student_registration')">
          <i class="fa fa-user-plus"></i> New Registration
        </button>
      </div>
    </div>

    <!-- Table Card -->
    <div class="rl-table-card">
      <div class="rl-table-hdr">
        <div class="rl-table-hdr-icon"><i class="fa fa-table"></i></div>
        <span class="rl-table-hdr-title"><?php echo $language['Registration List']; ?></span>
      </div>
      <div class="rl-table-body">
        <table id="example1" class="table table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>S.No</th>
              <th><?php echo $language['Student Name']; ?></th>
              <th><?php echo $language['Father Name']; ?></th>
              <th><?php echo $language['Class']; ?></th>
              <th>Contact No.</th>
              <th><?php echo $language['Registration Date']; ?></th>
              <th>Reg. No.</th>
              <th>Updated By</th>
              <th>Date</th>
              <th><?php echo $language['Make Admission']; ?></th>
              <th><?php echo $language['Print']; ?></th>
              <th>Print Fee Receipt</th>
              <th><?php echo $language['Delete']; ?></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div><!-- /.rl-wrap -->
</section>

<script>
$(function() {
    for_list('All');
});

function for_list(student_class) {
    $('#example1').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        ajax: {
            url: access_link + "student/student_registration_list_fatch.php?student_class=" + encodeURIComponent(student_class),
            type: "post"
        },
        language: {
            processing: '<i class="fa fa-spinner fa-spin"></i>&nbsp; Loading records...',
            emptyTable: '<div style="padding:24px 0;color:#636e88;font-size:13px;"><i class="fa fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;color:#b2becd;"></i>No registration records found.</div>',
            lengthMenu: 'Show _MENU_ entries',
            info: 'Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> records',
            infoEmpty: 'No records available',
            infoFiltered: '(filtered from <b>_MAX_</b> total)',
            search: '<i class="fa fa-search"></i>',
            searchPlaceholder: 'Search records...',
            paginate: {
                previous: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            }
        },
        columnDefs: [
            { targets: [0],          width: '48px',  className: 'dt-center' },
            { targets: [3],          width: '80px',  className: 'dt-center' },
            { targets: [4,5,6,7,8],  width: '110px' },
            { targets: [9,10,11,12], width: '120px', className: 'dt-center', orderable: false }
        ]
    });
}
</script>
