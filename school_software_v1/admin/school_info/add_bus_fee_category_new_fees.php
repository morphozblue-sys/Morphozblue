<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<?php
$que1 = "select * from school_info_class_info where class_name!=''";
$run1 = mysqli_query($conn73, $que1) or die(mysqli_error($conn73));
$classes = [];
while ($row1 = mysqli_fetch_assoc($run1)) {
    $classes[] = ['name' => $row1['class_name'], 'code' => $row1['class_code']];
}
?>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Add Bus Fee Category</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-bus"></i></div>
      <h4>Bus Fee Category <span style="font-weight:400;font-size:12px;opacity:.7;">(New Fees)</span></h4>
    </div>
    <div class="si-card-body" style="padding:0;">
      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th>Bus Fee Type</th>
              <th>Bus Fee Type (Hindi)</th>
              <?php foreach ($classes as $cl): ?>
              <th class="cen"><?php echo htmlspecialchars($cl['name']); ?></th>
              <?php endforeach; ?>
              <th class="cen">Add / Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $que = "select * from bus_fee_category";
            $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
            $serial_no = 0; $add_more_button = 0; $fee_code_blank = '';
            while ($row = mysqli_fetch_assoc($run)) {
                $name  = $row['bus_fee_category_name'];
                $hindi = $row['bus_fee_category_name_hindi'];
                $code  = $row['bus_fee_category_code'];
                if ($name !== '' || $hindi !== '') {
                    $serial_no++;
                    ?>
            <tr>
              <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
              <td><strong><?php echo htmlspecialchars($name); ?></strong></td>
              <td><?php echo htmlspecialchars($hindi); ?></td>
              <?php foreach ($classes as $cl):
                  $amt = $row[$cl['code'] . '_amount'] ?? '—'; ?>
              <td class="cen"><?php echo $amt !== '' ? '₹'.htmlspecialchars($amt) : '—'; ?></td>
              <?php endforeach; ?>
              <td class="cen">
                <button type="button" class="si-btn si-btn-ok" style="padding:5px 14px;font-size:12px;"
                  onclick="post_content('school_info/bus_fee_category_new_fees_edit','bus_fee_category_code=<?php echo htmlspecialchars($code,ENT_QUOTES); ?>')">
                  <i class="fa fa-pencil"></i> Edit
                </button>
              </td>
            </tr>
                    <?php
                } else {
                    if ($add_more_button === 0) $fee_code_blank = $code;
                    $add_more_button++;
                }
            }
            if ($add_more_button > 0): ?>
            <tr>
              <td colspan="<?php echo 4 + count($classes); ?>" class="cen" style="padding:10px;">
                <button type="button" class="si-btn si-btn-pri" style="padding:6px 18px;font-size:12px;"
                  onclick="post_content('school_info/bus_fee_category_new_fees_edit','bus_fee_category_code=<?php echo htmlspecialchars($fee_code_blank,ENT_QUOTES); ?>')">
                  <i class="fa fa-plus"></i> Add More
                </button>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</section>
