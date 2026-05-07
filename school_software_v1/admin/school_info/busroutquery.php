<?php
//include("../attachment/session.php");
$result=0;
for($i=102;$i<=200;$i++){
    $code='busfee'.$i;
    $qeury = "insert into bus_fee_category (bus_fee_category_code) values ('$code')";
    if(mysqli_query($conn73,$qeury)){
        $result++;
    }
}
if($result>0){
        echo "query inserted/ ".$result;
    } else {
        echo "Error";
    }

?>