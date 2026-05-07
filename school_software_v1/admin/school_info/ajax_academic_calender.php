<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
$schl_query = "SELECT * FROM school_info_general LIMIT 1";
$schl_result = mysqli_query($conn73, $schl_query);
$schl_row    = mysqli_fetch_assoc($schl_result) ?: [];

$school_name    = $schl_row['school_info_school_name']    ?? '';
$school_dist    = $schl_row['school_info_school_district'] ?? '';
$school_state   = $schl_row['school_info_school_state']   ?? '';
$school_contact = $schl_row['school_info_school_contact_no'] ?? '';
$school_email   = $schl_row['school_info_school_email_id'] ?? '';
$school_website = $schl_row['school_info_school_website']  ?? '';
$school_logo    = $schl_row['school_info_logo']            ?? '';

$exp_session = explode('_', $session1);
$session2    = ($exp_session[0] ?? '') . '-' . ($exp_session[1] ?? '');

$month_name = [
    '01' => 'January',  '02' => 'February', '03' => 'March',
    '04' => 'April',    '05' => 'May',       '06' => 'June',
    '07' => 'July',     '08' => 'August',    '09' => 'September',
    '10' => 'October',  '11' => 'November',  '12' => 'December',
];

function get_holiday_rows($conn73, $session1, $months, $month_name) {
    $rows = [];
    foreach ($months as $m) {
        $query = "SELECT * FROM holiday_manage WHERE session_value='$session1' AND holiday_month='$m' GROUP BY holiday_name ORDER BY holiday_date_new";
        $result = mysqli_query($conn73, $query);
        if (!$result) continue;
        $holidays_in_month = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $hname = $row['holiday_name'];
            $q2 = "SELECT * FROM holiday_manage WHERE session_value='$session1' AND holiday_month='$m' AND holiday_name='$hname' ORDER BY holiday_date_new";
            $r2  = mysqli_query($conn73, $q2);
            $dates = [];
            $days  = [];
            while ($r2 && $d = mysqli_fetch_assoc($r2)) {
                $dates[] = $d['holiday_date'];
                $days[]  = $d['holiday_day'];
            }
            $date_str = count($dates) >= 2 ? $dates[0] . ' to ' . $dates[count($dates)-1] : ($dates[0] ?? '');
            $day_str  = count($days)  >= 2 ? $days[0]  . ' to ' . $days[count($days)-1]   : ($days[0]  ?? '');
            $holidays_in_month[] = ['name' => $hname, 'date' => $date_str, 'day' => $day_str];
        }
        if (!empty($holidays_in_month)) {
            $rows[] = ['month' => $month_name[$m] ?? $m, 'span' => count($holidays_in_month), 'items' => $holidays_in_month];
        }
    }
    return $rows;
}

$left_months  = ['04','05','06','07','08','09','10'];
$right_months = ['11','12','01','02','03'];
$left_rows  = get_holiday_rows($conn73, $session1, $left_months,  $month_name);
$right_rows = get_holiday_rows($conn73, $session1, $right_months, $month_name);

$logo_src = $school_logo
    ? 'data:image;base64,' . $school_logo
    : ($school_software_path . 'images/student_blank.png');
?>

<style>
.ac-wrap { font-family: 'Times New Roman', Times, serif; background: #fff; }
.ac-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #1a237e; padding-bottom: 12px; margin-bottom: 16px; }
.ac-school-name { font-size: 30px; font-weight: bold; font-style: italic; color: #1a237e; margin: 0 0 4px; line-height: 1.2; }
.ac-school-sub { font-size: 15px; color: #333; margin: 2px 0; }
.ac-title-box { text-align: center; margin: 10px 0 6px; }
.ac-title-box h2 { display: inline-block; font-size: 22px; font-weight: bold; border: 2px solid #1a237e; border-radius: 8px; padding: 6px 24px; box-shadow: -3px 3px #7986cb; color: #1a237e; margin: 0; }
.ac-subtitle { text-align: center; font-size: 18px; font-weight: bold; text-decoration: underline; margin: 8px 0 16px; color: #333; }
.ac-tables { display: flex; gap: 16px; }
.ac-col { flex: 1; min-width: 0; }
.ac-tbl { width: 100%; border-collapse: collapse; font-size: 13px; }
.ac-tbl thead tr { background: #1a237e; color: #fff; }
.ac-tbl thead th { padding: 8px 10px; text-align: left; font-size: 13px; font-weight: 600; border: 1px solid #1a237e; }
.ac-tbl tbody tr:nth-child(even) { background: #f0f4ff; }
.ac-tbl tbody tr:nth-child(odd)  { background: #fff; }
.ac-tbl tbody td { padding: 7px 10px; border: 1px solid #c5cae9; color: #222; vertical-align: middle; }
.ac-tbl tbody td.month-cell { font-weight: 700; color: #1a237e; background: #e8eaf6; font-size: 13px; }
.ac-empty { text-align: center; padding: 30px; color: #94a3b8; font-size: 14px; font-style: italic; }
.ac-footer { text-align: center; margin-top: 20px; padding-top: 12px; border-top: 2px solid #1a237e; font-size: 13px; color: #555; }

@media print {
  .ac-wrap { padding: 0; }
  .ac-tbl { font-size: 11px; }
  .ac-tbl thead tr { background: #1a237e !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  .ac-tbl tbody td.month-cell { background: #e8eaf6 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  .ac-tbl tbody tr:nth-child(even) { background: #f0f4ff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
}
</style>

<div style="margin-bottom:14px;display:flex;gap:10px;justify-content:flex-end;">
  <button type="button" class="si-btn si-btn-ghost" onclick="exportTableToExcel('ac-print-area','Academic_Calendar_<?php echo $session2; ?>')">
    <i class="fa fa-file-excel-o"></i> Export Excel
  </button>
  <button type="button" class="si-btn si-btn-pri" onclick="for_print();">
    <i class="fa fa-print"></i> Print PDF
  </button>
</div>

<div class="ac-wrap" id="ac-print-area">

  <!-- School Header -->
  <div class="ac-header">
    <div>
      <p class="ac-school-name"><?php echo htmlspecialchars($school_name); ?></p>
      <p class="ac-school-sub"><?php echo htmlspecialchars($school_dist . ($school_state ? ' (' . $school_state . ')' : '') . ($school_contact ? ', Mobile : ' . $school_contact : '')); ?></p>
      <?php if ($school_email): ?>
      <p class="ac-school-sub">E-mail : <?php echo htmlspecialchars($school_email); ?><?php echo $school_website ? '&nbsp;&nbsp;&nbsp;' . htmlspecialchars($school_website) : ''; ?></p>
      <?php endif; ?>
    </div>
    <img src="<?php echo $logo_src; ?>" height="90" width="90" style="border-radius:50%;border:2px solid #1a237e;object-fit:cover;">
  </div>

  <!-- Title -->
  <div class="ac-title-box">
    <h2>Academic Calendar &mdash; Session <?php echo htmlspecialchars($session2); ?></h2>
  </div>
  <div class="ac-subtitle">List of Holidays</div>

  <!-- Two-column tables -->
  <div class="ac-tables">
    <!-- Left: April–October -->
    <div class="ac-col">
      <table class="ac-tbl">
        <thead>
          <tr>
            <th style="width:18%;">Month</th>
            <th style="width:28%;">Date</th>
            <th style="width:18%;">Day</th>
            <th>Festival / Holiday</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($left_rows)): ?>
          <tr><td colspan="4" class="ac-empty">No holidays recorded for Apr–Oct.</td></tr>
          <?php else: foreach ($left_rows as $grp): ?>
            <?php foreach ($grp['items'] as $idx => $item): ?>
            <tr>
              <?php if ($idx === 0): ?>
              <td class="month-cell" rowspan="<?php echo $grp['span']; ?>"><?php echo htmlspecialchars($grp['month']); ?></td>
              <?php endif; ?>
              <td><?php echo htmlspecialchars($item['date']); ?></td>
              <td><?php echo htmlspecialchars($item['day']); ?></td>
              <td><?php echo htmlspecialchars($item['name']); ?></td>
            </tr>
            <?php endforeach; endforeach; endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Right: November–March -->
    <div class="ac-col">
      <table class="ac-tbl">
        <thead>
          <tr>
            <th style="width:18%;">Month</th>
            <th style="width:28%;">Date</th>
            <th style="width:18%;">Day</th>
            <th>Festival / Holiday</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($right_rows)): ?>
          <tr><td colspan="4" class="ac-empty">No holidays recorded for Nov–Mar.</td></tr>
          <?php else: foreach ($right_rows as $grp): ?>
            <?php foreach ($grp['items'] as $idx => $item): ?>
            <tr>
              <?php if ($idx === 0): ?>
              <td class="month-cell" rowspan="<?php echo $grp['span']; ?>"><?php echo htmlspecialchars($grp['month']); ?></td>
              <?php endif; ?>
              <td><?php echo htmlspecialchars($item['date']); ?></td>
              <td><?php echo htmlspecialchars($item['day']); ?></td>
              <td><?php echo htmlspecialchars($item['name']); ?></td>
            </tr>
            <?php endforeach; endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="ac-footer">
    This calendar is subject to change &mdash; <?php echo htmlspecialchars($school_name); ?> &mdash; Session <?php echo htmlspecialchars($session2); ?>
  </div>
</div>

<div style="margin-top:14px;display:flex;gap:10px;justify-content:center;">
  <button type="button" class="si-btn si-btn-ghost" onclick="exportTableToExcel('ac-print-area','Academic_Calendar_<?php echo $session2; ?>')">
    <i class="fa fa-file-excel-o"></i> Export Excel
  </button>
  <button type="button" class="si-btn si-btn-pri" onclick="for_print();">
    <i class="fa fa-print"></i> Print PDF
  </button>
</div>
