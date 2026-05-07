<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
$subject_id = $_GET['subject_name'] ?? '';
$serial_no  = 0;
$subject_name = '';
$s_no = '';
$subject_category_column_blank = 'category1';

$que = "select * from school_info_subject_info where s_no='$subject_id'";
$run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
$rows = [];
while ($row = mysqli_fetch_assoc($run)) {
    $subject_name = $row['subject_name'];
    $s_no = $row['s_no'];
    $count_blank = 0;
    for ($i = 1; $i <= 10; $i++) {
        $cat = $row['category' . $i];
        $col = 'category' . $i;
        if ($cat === '' && $count_blank === 0) {
            $subject_category_column_blank = $col;
            $count_blank++;
        }
        if ($cat !== '') {
            $rows[] = ['s_no' => $s_no, 'subject_name' => $subject_name, 'category' => $cat, 'column' => $col];
        }
    }
}
?>
<div style="margin-top:10px;">
  <div class="si-tbl-wrap">
    <table class="si-tbl">
      <thead>
        <tr>
          <th>#</th>
          <th>Subject Name</th>
          <th>Category Name</th>
          <th class="cen">Edit</th>
          <th class="cen">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $i => $r): ?>
        <tr>
          <td><span class="si-sno"><?php echo $i + 1; ?></span></td>
          <td><strong><?php echo htmlspecialchars($r['subject_name']); ?></strong></td>
          <td><?php echo htmlspecialchars($r['category']); ?></td>
          <td class="cen">
            <button type="button" class="si-btn si-btn-ok" style="padding:5px 12px;font-size:12px;"
              data-val="<?php echo htmlspecialchars($r['s_no'] . '|?|' . $r['category'] . '|?|' . $r['column']); ?>"
              onclick="for_modal(this.dataset.val)">
              <i class="fa fa-pencil"></i> Edit
            </button>
          </td>
          <td class="cen">
            <button type="button" class="si-btn si-btn-del" style="padding:5px 12px;font-size:12px;"
              onclick="category_delete('<?php echo htmlspecialchars($r['s_no']); ?>','<?php echo htmlspecialchars($r['column']); ?>')">
              <i class="fa fa-trash"></i> Delete
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if ($s_no !== ''): ?>
        <tr>
          <td colspan="5" class="cen" style="padding:10px;">
            <button type="button" class="si-btn si-btn-pri" style="padding:6px 18px;font-size:12px;"
              data-val="<?php echo htmlspecialchars($s_no . '|?||?|' . $subject_category_column_blank); ?>"
              onclick="for_modal(this.dataset.val)">
              <i class="fa fa-plus"></i> Add Category
            </button>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
