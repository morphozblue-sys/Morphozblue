
<?php //include("../attachment/session.php"); 
$rhoesult=0;
for($i=21;$i<=200;$i++){
    $busfee='busfee'.$i;
    $query = "INSERT INTO bus_fee_category (bus_fee_category_code) value ('$busfee')";
    
    if(mysqli_query($conn73,$query)){
        $rhoesult++;
    }
}
echo $rhoesult." records Updated";
?>