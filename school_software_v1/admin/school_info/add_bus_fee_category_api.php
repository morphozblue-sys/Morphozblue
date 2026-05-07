<?php include("../attachment/session.php");

$bus_fee_type       = $_POST['bus_fee_type1']        ?? '';
$bus_fee_code       = $_POST['bus_fee_code_hidden']   ?? '';
$bus_fee_type_hindi = $_POST['bus_fee_type_hindi']    ?? '';
$class_code         = $_POST['class_code_hidden']     ?? [];
$classwise_amount   = $_POST['classwise_amount']      ?? [];

$month_code = ["1"=>"01","2"=>"02","3"=>"03","4"=>"04","5"=>"05","6"=>"06",
               "7"=>"07","8"=>"08","9"=>"09","10"=>"10","11"=>"11","12"=>"12"];

$count1 = count($classwise_amount);
$update_column       = '';
$blank_update_column = '';

for ($l = 0; $l < $count1; $l++) {
    for ($m = 1; $m < 13; $m++) {
        $blank_update_column .= ',' . $class_code[$l] . '_amount_month' . $month_code[$m] . "=''";
    }
    $update_column .= ',' . $class_code[$l] . "_amount='" . $classwise_amount[$l] . "'";
}

// First: clear monthly breakdown amounts for all classes
$query11 = "UPDATE bus_fee_category
            SET bus_fee_category_name='$bus_fee_type',
                bus_fee_category_name_hindi='$bus_fee_type_hindi'
                $blank_update_column
            WHERE bus_fee_category_code='$bus_fee_code'";
mysqli_query($conn73, $query11);

// Second: set the flat per-class annual amounts
$quer12 = "UPDATE bus_fee_category
           SET bus_fee_category_name='$bus_fee_type',
               bus_fee_category_name_hindi='$bus_fee_type_hindi'
               $update_column,
               $update_by_update_sql
           WHERE bus_fee_category_code='$bus_fee_code'";

if (mysqli_query($conn73, $quer12)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
