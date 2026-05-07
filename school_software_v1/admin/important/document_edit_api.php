<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	
	$s_no1 = $_POST['s_no1'];
	$document_name = $_POST['document_name'];
	$document_date = $_POST['document_date'];
	
	$document_upload=$_FILES['document_upload']['name'];
	
  $quer="update govt_official_info set document_name='$document_name',document_date='$document_date',$update_by_update_sql  where s_no='$s_no1'";
 
if(mysqli_query($conn73,$quer)){
    
    if($document_upload!=''){
    $imagename = $_FILES['document_upload']['name'];
    $size = $_FILES['document_upload']['size'];
    $uploadedfile = $_FILES['document_upload']['tmp_name'];
    
    camera_code($size,$imagename,$uploadedfile,$s_no1,"document_upload","govt_official_document","s_no");
    }

echo "|?|success|?|";
}
?>