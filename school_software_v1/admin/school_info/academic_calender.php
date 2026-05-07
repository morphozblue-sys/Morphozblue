<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function for_list() {
  $('#pdf_detail').html('<div style="text-align:center;padding:40px;color:#94a3b8;"><i class="fa fa-spinner fa-spin fa-2x"></i><br><small style="margin-top:10px;display:block;">Loading calendar…</small></div>');
  $.ajax({
    type: "POST",
    url: access_link + "school_info/ajax_academic_calender.php",
    cache: false,
    success: function (detail) { $('#pdf_detail').html(detail); },
    error: function () { $('#pdf_detail').html('<p style="color:#e74c3c;padding:20px;">Failed to load calendar. Please try again.</p>'); }
  });
}

function for_print() {
  var area = document.getElementById("ac-print-area");
  if (!area) { alert('Nothing to print.'); return; }
  var css = `
    <style>
      * { box-sizing: border-box; margin: 0; padding: 0; }
      body { font-family: 'Times New Roman', Times, serif; background:#fff; padding:20px; }
      .ac-header { display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #1a237e; padding-bottom:12px; margin-bottom:16px; }
      .ac-school-name { font-size:26px; font-weight:bold; font-style:italic; color:#1a237e; margin:0 0 4px; line-height:1.2; }
      .ac-school-sub { font-size:13px; color:#333; margin:2px 0; }
      .ac-title-box { text-align:center; margin:10px 0 6px; }
      .ac-title-box h2 { display:inline-block; font-size:20px; font-weight:bold; border:2px solid #1a237e; border-radius:8px; padding:6px 24px; box-shadow:-3px 3px #7986cb; color:#1a237e; }
      .ac-subtitle { text-align:center; font-size:16px; font-weight:bold; text-decoration:underline; margin:8px 0 16px; color:#333; }
      .ac-tables { display:flex; gap:14px; }
      .ac-col { flex:1; min-width:0; }
      .ac-tbl { width:100%; border-collapse:collapse; font-size:11px; }
      .ac-tbl thead tr { background:#1a237e !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
      .ac-tbl thead th { padding:6px 8px; text-align:left; font-size:11px; font-weight:600; border:1px solid #1a237e; color:#fff; }
      .ac-tbl tbody tr:nth-child(even) { background:#f0f4ff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
      .ac-tbl tbody td { padding:5px 8px; border:1px solid #c5cae9; color:#222; vertical-align:middle; }
      .ac-tbl tbody td.month-cell { font-weight:700; color:#1a237e; background:#e8eaf6 !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
      .ac-footer { text-align:center; margin-top:16px; padding-top:10px; border-top:2px solid #1a237e; font-size:11px; color:#555; }
      img { border-radius:50%; border:2px solid #1a237e; }
      .ac-empty { text-align:center; padding:20px; color:#94a3b8; font-size:12px; font-style:italic; }
    </style>`;
  var newWin = window.open("", "_blank");
  newWin.document.write('<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Academic Calendar</title>' + css + '</head><body>' + area.outerHTML + '</body></html>');
  newWin.document.close();
  newWin.focus();
  setTimeout(function(){ newWin.print(); }, 400);
}

function exportTableToExcel(tableID, filename) {
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  if (!tableSelect) return;
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
  filename = (filename || 'academic_calendar') + '.xls';
  var link = document.createElement("a");
  document.body.appendChild(link);
  link.href = 'data:' + dataType + ', ' + tableHTML;
  link.download = filename;
  link.click();
  document.body.removeChild(link);
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Academic Calendar</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-calendar"></i></div>
      <h4>Academic Calendar</h4>
    </div>
    <div class="si-card-body">
      <div id="pdf_detail"></div>
    </div>
  </div>
</div>
</section>

<script>for_list();</script>
