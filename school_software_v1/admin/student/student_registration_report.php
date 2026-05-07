<?php include("../attachment/session.php"); ?>

<style>
.st-wrap { padding: 20px 18px 40px; background: linear-gradient(160deg,#eef1f7 0%,#f4f6fb 60%,#eaecf4 100%); min-height: 80vh; font-family: 'Source Sans Pro','Helvetica Neue',Arial,sans-serif; }
.st-filter-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 22px rgba(15,52,96,.09), 0 1px 4px rgba(0,0,0,.04); border: 1px solid rgba(15,52,96,.07); margin-bottom: 20px; overflow: hidden; animation: stFadeIn .4s ease forwards; }
.st-filter-hdr { background: linear-gradient(135deg,#0f3460 0%,#16213e 55%,#1a1a2e 100%); padding: 12px 20px; display: flex; align-items: center; gap: 11px; border-bottom: 3px solid #b92b27; }
.st-filter-hdr-icon { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.st-filter-hdr-icon i { color: #fff; font-size: 14px; }
.st-filter-hdr-title { font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
.st-filter-body { padding: 18px 20px 14px; display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end; }
.st-filter-group { display: flex; flex-direction: column; gap: 5px; min-width: 180px; flex: 1; }
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

<script>
function for_list() {
    var from_date = document.getElementById('from_date').value;
    var to_date   = document.getElementById('to_date').value;
    if (from_date !== '' && to_date !== '') {
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_student_registration_report.php?from_date=" + from_date + "&to_date=" + to_date,
            cache: false,
            success: function(detail) { $("#pdf_detail").html(detail); }
        });
    } else {
        $("#pdf_detail").html('');
    }
}

function for_print() {
    var divToPrint = document.getElementById("printTable");
    var newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}

function exportTableToExcel(tableID, filename) {
    filename = filename ? filename + '.xls' : 'excel_data.xls';
    var dataType = 'application/vnd.ms-excel';
    var tableHTML = document.getElementById(tableID).outerHTML.replace(/ /g, '%20');
    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if (navigator.msSaveOrOpenBlob) {
        navigator.msSaveOrOpenBlob(new Blob(['﻿', tableHTML], { type: dataType }), filename);
    } else {
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>

<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-file-text-o"></i></div>
    <div>
      <h1 class="si-ph-title">Registration Report</h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-file-text-o"></i> Registration Report</span>
  </nav>
</section>

<section class="content">
  <div class="st-wrap">

    <div class="st-filter-card">
      <div class="st-filter-hdr">
        <div class="st-filter-hdr-icon"><i class="fa fa-calendar"></i></div>
        <span class="st-filter-hdr-title">Select Date Range</span>
      </div>
      <div class="st-filter-body">

        <div class="st-filter-group">
          <label><i class="fa fa-calendar-o"></i> From Date</label>
          <input type="date" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>"
                 class="form-control" oninput="for_list();">
        </div>

        <div class="st-filter-group">
          <label><i class="fa fa-calendar-o"></i> To Date</label>
          <input type="date" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>"
                 class="form-control" oninput="for_list();">
        </div>

      </div>
    </div>

    <div class="st-result-wrap">
      <div class="st-result-hdr">
        <div class="st-result-hdr-icon"><i class="fa fa-list-alt"></i></div>
        <span class="st-result-hdr-title">Report Results</span>
      </div>
      <div class="st-result-body">
        <div id="pdf_detail"></div>
      </div>
    </div>

  </div><!-- /.st-wrap -->
</section>

<script>for_list();</script>
