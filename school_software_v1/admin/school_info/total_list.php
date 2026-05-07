<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
/* ── Determine fee table ── */
$qry  = "select fees_category from school_info_general limit 1";
$rest = mysqli_query($conn73, $qry);
$row22 = mysqli_fetch_assoc($rest);
$fees_category = $row22['fees_category'] ?? '';
$fee_tbl = ($fees_category == 'monthly' || $fees_category == 'installmentwise' || $fees_category == 'yearly')
           ? 'common_fees_student_fee' : 'fees_student_fee';

/* ══════════════════════════════════════════════════════════
   QUERY 1 — all active students, single pass
   ══════════════════════════════════════════════════════════ */
$r = mysqli_query($conn73,
    "SELECT student_class, student_gender, student_category, student_hostel, student_bus
     FROM student_admission_info
     WHERE student_status='Active' AND session_value='$session1'");

$stu = [];   /* stu[class][key] = count */
$all = ['total'=>0,'male'=>0,'female'=>0,'obc'=>0,'sc'=>0,'st'=>0,'gen'=>0,'other'=>0,'hostel'=>0,'bus'=>0];

while ($s = mysqli_fetch_assoc($r)) {
    $c = $s['student_class'];
    if (!isset($stu[$c])) {
        $stu[$c] = ['total'=>0,'male'=>0,'female'=>0,'obc'=>0,'sc'=>0,'st'=>0,'gen'=>0,'other'=>0,'hostel'=>0,'bus'=>0];
    }
    $stu[$c]['total']++;  $all['total']++;
    if ($s['student_gender'] === 'Male')   { $stu[$c]['male']++;   $all['male']++; }
    if ($s['student_gender'] === 'Female') { $stu[$c]['female']++; $all['female']++; }
    $cat = $s['student_category'];
    if ($cat === 'OBC')     { $stu[$c]['obc']++;    $all['obc']++; }
    elseif ($cat === 'SC')  { $stu[$c]['sc']++;     $all['sc']++; }
    elseif ($cat === 'ST')  { $stu[$c]['st']++;     $all['st']++; }
    elseif ($cat === 'General') { $stu[$c]['gen']++; $all['gen']++; }
    elseif ($cat === 'Other')   { $stu[$c]['other']++; $all['other']++; }
    if ($s['student_hostel'] === 'Yes') { $stu[$c]['hostel']++; $all['hostel']++; }
    if ($s['student_bus']    === 'Yes') { $stu[$c]['bus']++;    $all['bus']++; }
}

/* ══════════════════════════════════════════════════════════
   QUERY 2 — fee totals grouped by class, single query
   ══════════════════════════════════════════════════════════ */
$fee = [];   /* fee[class] = [paid, balance] */
$all_paid = 0; $all_bal = 0;
$rf = mysqli_query($conn73,
    "SELECT student_class,
            SUM(paid_total)    AS paid,
            SUM(balance_total) AS bal
     FROM $fee_tbl
     WHERE fee_status='Active' AND session_value='$session1'
     GROUP BY student_class");
while ($f = mysqli_fetch_assoc($rf)) {
    $fee[$f['student_class']] = [(float)$f['paid'], (float)$f['bal']];
    $all_paid += (float)$f['paid'];
    $all_bal  += (float)$f['bal'];
}

/* ══════════════════════════════════════════════════════════
   QUERY 3 — class list in order
   ══════════════════════════════════════════════════════════ */
$classes = [];
$rc = mysqli_query($conn73, "SELECT class_name FROM school_info_class_info ORDER BY s_no");
while ($row = mysqli_fetch_assoc($rc)) {
    $classes[] = $row['class_name'];
}

/* helper */
function fmt($n) { return $n > 0 ? '₹'.number_format($n, 2) : '—'; }
?>
<style>
.tl-wrap   { padding:0 10px 30px; }
.tl-tbl    { width:100%; border-collapse:collapse; font-size:13px; min-width:900px; }
.tl-tbl thead th {
    background:linear-gradient(135deg,#1a1a2e,#0f3460);
    color:#fff; padding:11px 14px; font-size:11px; font-weight:700;
    text-transform:uppercase; letter-spacing:.5px; white-space:nowrap;
    position:sticky; top:0; z-index:2;
}
.tl-tbl tbody tr { border-bottom:1px solid #f1f5f9; transition:background .12s; }
.tl-tbl tbody tr:hover { background:#f0f4ff; }
.tl-tbl tbody td { padding:10px 14px; color:#334155; vertical-align:middle; white-space:nowrap; }
.tl-tbl tbody tr:last-child td { border-bottom:none; }
.tl-num  { text-align:right; font-variant-numeric:tabular-nums; }
.tl-zero { color:#cbd5e1; }
/* summary row */
.tl-sum td {
    background:linear-gradient(135deg,#1a1a2e,#0f3460) !important;
    color:#fff !important; font-weight:700;
}
.tl-sum .tl-paid,.tl-sum .tl-bal { color:#fff !important; }
/* class label */
.tl-cls  { font-weight:700; color:#1e293b; }
/* fee colours */
.tl-paid { color:#16a34a; font-weight:600; }
.tl-bal  { color:#dc2626; font-weight:600; }
/* stat badges */
.tl-stat { display:inline-block; min-width:30px; text-align:right; }
/* scroll container */
.tl-scroll { overflow-x:auto; border-radius:10px; border:1px solid #e2e8f0; }
</style>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active"><?php echo $language['School Information']; ?></li>
  </ol>
</section>

<section class="content">
<div class="tl-wrap">

  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-database"></i></div>
      <h4><?php echo $language['School Data']; ?></h4>
      <span class="si-badge si-badge-sec" style="margin-left:auto;">
        <?php echo count($classes); ?> classes &nbsp;·&nbsp; <?php echo $all['total']; ?> students
      </span>
    </div>
    <div class="si-card-body" style="padding:0;">
      <div class="tl-scroll">
        <table class="tl-tbl">
          <thead>
            <tr>
              <th><?php echo $language['Class']; ?></th>
              <th class="tl-num"><?php echo $language['Total Students']; ?></th>
              <th class="tl-num"><?php echo $language['Total Boys']; ?></th>
              <th class="tl-num"><?php echo $language['Total Girls']; ?></th>
              <th class="tl-num"><?php echo $language['Total Obc']; ?></th>
              <th class="tl-num"><?php echo $language['Total SC']; ?></th>
              <th class="tl-num"><?php echo $language['Total ST']; ?></th>
              <th class="tl-num"><?php echo $language['Total Gen']; ?></th>
              <th class="tl-num"><?php echo $language['Total Other']; ?></th>
              <th class="tl-num"><?php echo $language['Total Hosteler']; ?></th>
              <th class="tl-num"><?php echo $language['Total Bus User']; ?></th>
              <th class="tl-num"><?php echo $language['Total Paid Fee']; ?></th>
              <th class="tl-num"><?php echo $language['Total Balance']; ?></th>
            </tr>
          </thead>
          <tbody>

            <!-- ── All-classes summary ── -->
            <tr class="tl-sum">
              <td><i class="fa fa-globe" style="margin-right:6px;opacity:.7;"></i>All Classes</td>
              <td class="tl-num"><?php echo $all['total']; ?></td>
              <td class="tl-num"><?php echo $all['male']; ?></td>
              <td class="tl-num"><?php echo $all['female']; ?></td>
              <td class="tl-num"><?php echo $all['obc']; ?></td>
              <td class="tl-num"><?php echo $all['sc']; ?></td>
              <td class="tl-num"><?php echo $all['st']; ?></td>
              <td class="tl-num"><?php echo $all['gen']; ?></td>
              <td class="tl-num"><?php echo $all['other']; ?></td>
              <td class="tl-num"><?php echo $all['hostel']; ?></td>
              <td class="tl-num"><?php echo $all['bus']; ?></td>
              <td class="tl-num tl-paid"><?php echo fmt($all_paid); ?></td>
              <td class="tl-num tl-bal"><?php echo fmt($all_bal); ?></td>
            </tr>

            <!-- ── Per-class rows ── -->
            <?php foreach ($classes as $cn):
                $d  = $stu[$cn]  ?? ['total'=>0,'male'=>0,'female'=>0,'obc'=>0,'sc'=>0,'st'=>0,'gen'=>0,'other'=>0,'hostel'=>0,'bus'=>0];
                $fd = $fee[$cn]  ?? [0, 0];
                $paid = $fd[0]; $bal = $fd[1];
            ?>
            <tr>
              <td class="tl-cls"><?php echo htmlspecialchars($cn); ?></td>
              <td class="tl-num <?php echo $d['total'] ? '' : 'tl-zero'; ?>"><?php echo $d['total']; ?></td>
              <td class="tl-num <?php echo $d['male']   ? '' : 'tl-zero'; ?>"><?php echo $d['male']; ?></td>
              <td class="tl-num <?php echo $d['female'] ? '' : 'tl-zero'; ?>"><?php echo $d['female']; ?></td>
              <td class="tl-num <?php echo $d['obc']    ? '' : 'tl-zero'; ?>"><?php echo $d['obc']; ?></td>
              <td class="tl-num <?php echo $d['sc']     ? '' : 'tl-zero'; ?>"><?php echo $d['sc']; ?></td>
              <td class="tl-num <?php echo $d['st']     ? '' : 'tl-zero'; ?>"><?php echo $d['st']; ?></td>
              <td class="tl-num <?php echo $d['gen']    ? '' : 'tl-zero'; ?>"><?php echo $d['gen']; ?></td>
              <td class="tl-num <?php echo $d['other']  ? '' : 'tl-zero'; ?>"><?php echo $d['other']; ?></td>
              <td class="tl-num <?php echo $d['hostel'] ? '' : 'tl-zero'; ?>"><?php echo $d['hostel']; ?></td>
              <td class="tl-num <?php echo $d['bus']    ? '' : 'tl-zero'; ?>"><?php echo $d['bus']; ?></td>
              <td class="tl-num tl-paid"><?php echo fmt($paid); ?></td>
              <td class="tl-num tl-bal"><?php echo fmt($bal); ?></td>
            </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</section>
