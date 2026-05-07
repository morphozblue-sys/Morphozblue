<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	
	$document_name = $_POST['document_name'];
	$document_date = $_POST['document_date'];
	
	$document_upload=$_FILES['document_upload']['name'];
	
$quer="insert into govt_official_info(document_name,document_date,$update_by_insert_sql_column) values('$document_name','$document_date',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){
    
    $last_id=mysqli_insert_id($conn73);
    
    if($document_upload!=''){
    $imagename = $_FILES['document_upload']['name'];
    $size = $_FILES['document_upload']['size'];
    $uploadedfile = $_FILES['document_upload']['tmp_name'];
    
    camera_code($size,$imagename,$uploadedfile,$last_id,"document_upload","govt_official_document","s_no");
    }

echo "|?|success|?|";
}

?>