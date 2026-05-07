<?php include("../attachment/session.php"); ?>
<?php
$student_class_code = $_GET['class_name']   ?? '';
$subject_type1      = $_GET['subject_type'] ?? 'subject';
$group_name         = $_GET['group_name']   ?? '';
$stream_name        = $_GET['stream_name']  ?? '';

$parts      = explode('_', $student_class_code);
$class_name = $parts[0] ?? '';
$class_code = $parts[2] ?? '';

$que = "select * from school_info_subject_info where class='$class_name'
        and subject_type='$subject_type1' and stream_name='$stream_name'
        and group_name='$group_name'
        and (session_value='$session1' || session_value='')$filter37";
$run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));

$serial = 0;
$rows   = [];
while ($row = mysqli_fetch_assoc($run)) {
    $sname  = $row['subject_name'];
    $shindi = $row['subject_name_hindi'];
    $scode  = $row['subject_code'];
    $s_no   = $row['s_no'];
    if ($sname === '') continue;
    $serial++;
    $rows[] = [
        'serial' => $serial,
        'name'   => $sname,
        'hindi'  => $shindi,
        'data'   => 's_no='         . urlencode($s_no) .
                    '&subject_code=' . urlencode($scode) .
                    '&class_name='   . urlencode($student_class_code) .
                    '&class_code='   . urlencode($class_code) .
                    '&subject_type=' . urlencode($subject_type1) .
                    '&group_name='   . urlencode($group_name) .
                    '&stream_name='  . urlencode($stream_name),
    ];
}
?>
<div class="si-tbl-wrap">
  <table class="si-tbl">
    <thead>
      <tr>
        <th style="width:40px;">#</th>
        <th>Subject</th>
        <th>Hindi</th>
        <th class="cen" style="width:80px;">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($rows)): ?>
      <tr><td colspan="4" style="text-align:center;padding:20px;color:#94a3b8;font-size:13px;">No subjects assigned yet.</td></tr>
      <?php else: foreach ($rows as $r): ?>
      <tr>
        <td><span class="si-sno"><?php echo $r['serial']; ?></span></td>
        <td><strong><?php echo htmlspecialchars($r['name']); ?></strong></td>
        <td style="color:#64748b;"><?php echo htmlspecialchars($r['hindi']); ?></td>
        <td class="cen">
          <button type="button" class="si-btn si-btn-del" style="padding:5px 12px;font-size:12px;"
            data-act="del-subj"
            data-subj="<?php echo htmlspecialchars($r['data']); ?>">
            <i class="fa fa-trash"></i> Delete
          </button>
        </td>
      </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
