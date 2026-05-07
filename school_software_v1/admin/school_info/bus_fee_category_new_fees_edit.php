<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function for_calculation(value, id_class, class_code, fee_code) {
    var fee_sno     = document.getElementById('fee_sno').value;
    var class_code2 = document.getElementById('class_code2').value;
    var tot_cls     = class_code2.split('|?|');
    var tot_lnth    = tot_cls.length;
    if (id_class === 'my_id') {
        var each_amt = parseFloat(value / fee_sno);
        if ($('#for_same1').prop('checked')) {
            for (var q = 1; q < tot_lnth; q++) {
                $('#' + tot_cls[q]).val(value);
                $('.' + tot_cls[q]).each(function () { $(this).val(each_amt.toFixed()); });
            }
        } else {
            $('.' + class_code).each(function () { $(this).val(each_amt.toFixed()); });
        }
    } else if (id_class === 'my_class') {
        if ($('#for_same1').prop('checked')) {
            var total = 0;
            $('.' + class_code).each(function () { total += Number($(this).val()); });
            var v = 0;
            for (var q = 1; q < tot_lnth; q++) {
                $('#month_' + fee_code + '_' + v).val(value);
                $('#' + tot_cls[q]).val(total);
                v = Number(v + 1);
            }
        } else {
            var total = 0;
            $('.' + class_code).each(function () { total += Number($(this).val()); });
            $('#' + class_code).val(total);
        }
    }
}

function form_submit() {
    var $btn = $('#submit_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var formdata = new FormData(document.getElementById('my_form'));
    $.ajax({
        url: access_link + 'school_info/add_bus_fee_category_new_fees_api.php',
        type: 'POST',
        data: formdata,
        mimeTypes: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Bus fee saved successfully!', 'green');
                get_content('school_info/add_bus_fee_category_new_fees');
            } else {
                alert_new('Could not save. Please try again.', 'red');
            }
        },
        error: function () {
            $btn.prop('disabled', false);
            alert_new('Connection error. Please try again.', 'red');
        }
    });
}
</script>

<?php
$qry  = "select * from school_info_general";
$rest = mysqli_query($conn73, $qry);
while ($row22 = mysqli_fetch_assoc($rest)) {
    $fees_type     = $row22['fees_type'];
    $fees_category = $row22['fees_category'];
}
$table_var = ($fees_category === 'new_fees')
    ? 'new_fees_installment_detail'
    : 'school_info_' . $fees_type . '_fees';

$que1 = "select * from school_info_class_info where class_name!=''";
$run1 = mysqli_query($conn73, $que1) or die(mysqli_error($conn73));
$class_sno = 0; $class_code = []; $class_name1 = []; $class_code2 = '';
while ($row1 = mysqli_fetch_assoc($run1)) {
    $class_name1[$class_sno] = $row1['class_name'];
    $class_code[$class_sno]  = $row1['class_code'];
    $class_code2 .= '|?|' . $row1['class_code'];
    $class_sno++;
}

$que01  = "select * from $table_var where session_value='$session1' and status='Active' ORDER BY s_no";
$run01  = mysqli_query($conn73, $que01);
$fee_sno = 0; $fees_code = []; $fees_type_name = []; $fees_code11 = ''; $seprator = '';
while ($row01 = mysqli_fetch_assoc($run01)) {
    $fees_code[$fee_sno] = $row01['codes'];
    $fees_code11 .= $seprator . $row01['codes'];
    $seprator = '|?|';
    if ($fees_type === 'installmentwise') {
        $fees_type_name[$fee_sno] = strtoupper($row01['installment_name']);
    } else {
        $fees_type_name[$fee_sno] = strtoupper($row01['month_name']);
    }
    $fee_sno++;
}

$bus_fee_category_code11 = $_GET['bus_fee_category_code'] ?? '';
$que  = "select * from bus_fee_category where bus_fee_category_code='$bus_fee_category_code11'";
$run  = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
$bus_fee_category_name = ''; $bus_fee_category_name_hindi = '';
$class_amount = []; $class_amount_monthly = [];
while ($row = mysqli_fetch_assoc($run)) {
    $bus_fee_category_name       = $row['bus_fee_category_name'];
    $bus_fee_category_name_hindi = $row['bus_fee_category_name_hindi'];
    for ($l = 0; $l < $class_sno; $l++) {
        $class_amount[$l] = $row[$class_code[$l] . '_amount'];
        for ($m = 0; $m < $fee_sno; $m++) {
            $class_amount_monthly[$l][$m] = $row[$class_code[$l] . '_amount_month' . $fees_code[$m]];
        }
    }
}
?>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li><a href="javascript:get_content('school_info/add_bus_fee_category_new_fees')"><i class="fa fa-bus"></i> Fee Category List</a></li>
    <li class="active">Edit Bus Fee Category</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-bus"></i></div>
      <h4>Bus Fee Category <span style="font-weight:400;font-size:12px;opacity:.7;">(New Fees)</span>
        <span style="margin-left:16px;font-size:12px;font-weight:400;opacity:.8;">
          <input type="checkbox" id="for_same1" style="margin-right:4px;">Same For All
        </span>
      </h4>
    </div>
    <div class="si-card-body">
      <form id="my_form">
        <input type="hidden" name="fee_sno"                 id="fee_sno"                 value="<?php echo $fee_sno; ?>">
        <input type="hidden" name="class_code2"             id="class_code2"             value="<?php echo htmlspecialchars($class_code2); ?>">
        <input type="hidden" name="bus_fee_category_code11" id="bus_fee_category_code11" value="<?php echo htmlspecialchars($bus_fee_category_code11); ?>">
        <input type="hidden" name="class_sno"               id="class_sno"               value="<?php echo $class_sno; ?>">
        <input type="hidden" name="fees_code11"             id="fees_code11"             value="<?php echo htmlspecialchars($fees_code11); ?>">

        <div class="row" style="margin-bottom:18px;">
          <div class="col-md-5">
            <div class="si-fg">
              <label>Bus Fee Category <span class="req">*</span></label>
              <div class="si-iw no-ico">
                <input type="text" name="bus_fee_category_name" class="si-ctrl" value="<?php echo htmlspecialchars($bus_fee_category_name); ?>" required>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="si-fg">
              <label>Bus Fee Category (Hindi)</label>
              <div class="si-iw no-ico">
                <input type="text" name="bus_fee_category_name_hindi" class="si-ctrl" value="<?php echo htmlspecialchars($bus_fee_category_name_hindi); ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="si-tbl-wrap">
          <table class="si-tbl">
            <thead>
              <tr>
                <th>#</th>
                <th>Class</th>
                <th>Total Amount</th>
                <?php for ($j = 0; $j < $fee_sno; $j++): ?>
                <th class="cen"><?php echo htmlspecialchars($fees_type_name[$j]); ?></th>
                <?php endfor; ?>
              </tr>
            </thead>
            <tbody>
              <?php for ($i = 0; $i < $class_sno; $i++): ?>
              <tr>
                <td><span class="si-sno"><?php echo $i + 1; ?></span></td>
                <td>
                  <strong><?php echo htmlspecialchars($class_name1[$i]); ?></strong>
                  <input type="hidden" name="class_code[]" value="<?php echo htmlspecialchars($class_code[$i]); ?>">
                </td>
                <td>
                  <input type="number" name="total_amount[]"
                    id="<?php echo $class_code[$i]; ?>"
                    value="<?php echo htmlspecialchars($class_amount[$i] ?? ''); ?>"
                    style="width:85px;border:1px solid #cbd5e1;border-radius:6px;padding:5px 8px;font-size:13px;"
                    title="<?php echo htmlspecialchars($class_name1[$i]); ?>"
                    oninput="for_calculation(this.value,'my_id','<?php echo $class_code[$i]; ?>','01');">
                </td>
                <?php for ($k = 0; $k < $fee_sno; $k++): ?>
                <td class="cen">
                  <input type="number"
                    name="<?php echo $class_code[$i] . '_' . $fees_code[$k]; ?>"
                    id="<?php echo 'month_' . $fees_code[$k] . '_' . $i; ?>"
                    value="<?php echo htmlspecialchars($class_amount_monthly[$i][$k] ?? ''); ?>"
                    style="width:70px;border:1px solid #cbd5e1;border-radius:6px;padding:5px 6px;font-size:12px;"
                    class="<?php echo $class_code[$i]; ?>"
                    title="<?php echo htmlspecialchars($class_name1[$i] . ' / ' . $fees_type_name[$k]); ?>"
                    oninput="for_calculation(this.value,'my_class','<?php echo $class_code[$i]; ?>','<?php echo $fees_code[$k]; ?>');">
                </td>
                <?php endfor; ?>
              </tr>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
          <button type="button" id="submit_btn" onclick="form_submit();" class="si-btn si-btn-ok si-btn-lg">
            <i class="fa fa-check"></i> Save Bus Fee
          </button>
          <button type="button" class="si-btn si-btn-ghost si-btn-lg" style="margin-left:10px;"
            onclick="get_content('school_info/add_bus_fee_category_new_fees')">
            <i class="fa fa-arrow-left"></i> Back to List
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
