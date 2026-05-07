<?php include("../attachment/session.php"); ?>
<?php
$student_class_code = $_GET['class_name']   ?? '';
$subject_type1      = $_GET['subject_type'] ?? 'subject';
$group_name         = $_GET['group_name']   ?? '';
$stream_name        = $_GET['stream_name']  ?? '';

$parts      = explode('_', $student_class_code);
$class_name = $parts[0] ?? '';

$que = "select * from school_info_subjects where subject_type='$subject_type1'
        and (session_value='$session1' || session_value='')$filter37";
$run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));

$serial = 0;
$rows   = [];
while ($row = mysqli_fetch_assoc($run)) {
    $sname  = $row['subject'];
    $shindi = $row['subject_hindi'];
    $scode  = $row['subject_code'];
    $stype  = $row['subject_type'];
    if ($sname === '' && $shindi === '') continue;

    $q1  = "select * from school_info_subject_info where class='$class_name'
            and subject_name='$sname' and stream_name='$stream_name'
            and group_name='$group_name'
            and (session_value='$session1' || session_value='')$filter37";
    $r1  = mysqli_query($conn73, $q1) or die(mysqli_error($conn73));
    if (mysqli_num_rows($r1) > 0) continue;

    $serial++;
    $val = htmlspecialchars($sname   . '|?|' . $shindi . '|?|' . $stype .
           '|?|' . $scode . '|?|' . $student_class_code .
           '|?|' . $group_name . '|?|' . $stream_name);
    $rows[] = [
        'serial'  => $serial,
        'name'    => $sname,
        'hindi'   => $shindi,
        'scode'   => $scode,
        'val'     => $val,
        'data'    => 'subject_name=' . urlencode($sname) .
                     '&subject_name_hindi=' . urlencode($shindi) .
                     '&subject_type=' . urlencode($stype) .
                     '&subject_code=' . urlencode($scode) .
                     '&class_name=' . urlencode($student_class_code) .
                     '&group_name=' . urlencode($group_name) .
                     '&stream_name=' . urlencode($stream_name),
    ];
}
?>
<div class="si-tbl-wrap">
  <table class="si-tbl">
    <thead>
      <tr>
        <th style="width:40px;"></th>
        <th>Subject</th>
        <th>Hindi</th>
        <th class="cen" style="width:80px;">Add</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($rows)): ?>
      <tr><td colspan="4" style="text-align:center;padding:20px;color:#94a3b8;font-size:13px;">No subjects available to add.</td></tr>
      <?php else: foreach ($rows as $r): ?>
      <tr>
        <td>
          <label style="display:flex;align-items:center;gap:8px;margin:0;cursor:pointer;">
            <input type="checkbox" class="subjects" value="<?php echo $r['val']; ?>"
              style="width:16px;height:16px;cursor:pointer;accent-color:#4361ee;">
            <span class="si-sno"><?php echo $r['serial']; ?></span>
          </label>
        </td>
        <td><strong><?php echo htmlspecialchars($r['name']); ?></strong></td>
        <td style="color:#64748b;"><?php echo htmlspecialchars($r['hindi']); ?></td>
        <td class="cen">
          <button type="button" class="si-btn si-btn-pri" style="padding:5px 12px;font-size:12px;"
            data-act="add-subj"
            data-subj="<?php echo htmlspecialchars($r['data']); ?>">
            <i class="fa fa-plus"></i> Add
          </button>
        </td>
      </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
