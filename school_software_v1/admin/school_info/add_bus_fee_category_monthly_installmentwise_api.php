<?php include("../attachment/session.php");

$bus_fee_category_name       = $_POST['bus_fee_category_name']       ?? '';
$bus_fee_category_name_hindi = $_POST['bus_fee_category_name_hindi'] ?? '';
$fee_sno                     = (int)($_POST['fee_sno']               ?? 0);
$class_code2                 = $_POST['class_code2']                 ?? '';
$bus_fee_category_code11     = $_POST['bus_fee_category_code11']     ?? '';
$class_sno                   = (int)($_POST['class_sno']             ?? 0);
$class_code                  = $_POST['class_code']                  ?? [];
$total_amount                = $_POST['total_amount']                ?? [];
$fees_code11                 = $_POST['fees_code11']                 ?? '';
$fees_code22                 = explode('|?|', $fees_code11);
$fee_count                   = count($fees_code22);

$month_code = ["1"=>"01","2"=>"02","3"=>"03","4"=>"04","5"=>"05","6"=>"06",
               "7"=>"07","8"=>"08","9"=>"09","10"=>"10","11"=>"11","12"=>"12"];

$update_column       = '';
$blank_update_column = '';
$fill_update_column  = '';

for ($l = 0; $l < $class_sno; $l++) {
    for ($m = 1; $m < 13; $m++) {
        $blank_update_column .= ',' . $class_code[$l] . '_amount_month' . $month_code[$m] . "=''";
    }
    for ($n = 0; $n < $fee_count; $n++) {
        $fees_classwise_monthly_amount = $_POST[$class_code[$l] . '_' . $fees_code22[$n]] ?? '';
        $fill_update_column .= ',' . $class_code[$l] . '_amount_month' . $fees_code22[$n] . "='$fees_classwise_monthly_amount'";
    }
    $update_column .= ',' . $class_code[$l] . "_amount='" . ($total_amount[$l] ?? '') . "'";
}

// Clear then refill
$query11 = "UPDATE bus_fee_category
            SET bus_fee_category_name='$bus_fee_category_name',
                bus_fee_category_name_hindi='$bus_fee_category_name_hindi'
                $blank_update_column
            WHERE bus_fee_category_code='$bus_fee_category_code11'";
mysqli_query($conn73, $query11);

$quer12 = "UPDATE bus_fee_category
           SET bus_fee_category_name='$bus_fee_category_name',
               bus_fee_category_name_hindi='$bus_fee_category_name_hindi'
               $update_column
               $fill_update_column,
               $update_by_update_sql
           WHERE bus_fee_category_code='$bus_fee_category_code11'";

if (mysqli_query($conn73, $quer12)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
