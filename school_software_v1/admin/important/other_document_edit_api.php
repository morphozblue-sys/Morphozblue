<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");

	$s_no1 = $_POST['s_no1'];
	$other_document_name = $_POST['other_document_name'];
	$document_date = $_POST['document_date'];

	
	$other_document_upload=$_FILES['other_document_upload']['name'];
	
$quer="update govt_official_other_info set other_document_name='$other_document_name',document_date='$document_date',$update_by_update_sql  where s_no='$s_no1'";

if(mysqli_query($conn73,$quer)){
    
    if($other_document_upload!=''){
    $imagename = $_FILES['other_document_upload']['name'];
    $size = $_FILES['other_document_upload']['size'];
    $uploadedfile = $_FILES['other_document_upload']['tmp_name'];
    
    camera_code($size,$imagename,$uploadedfile,$s_no1,"other_document_upload","govt_official_other_document","other_info_id");
    }

echo "|?|success|?|";
}
?>