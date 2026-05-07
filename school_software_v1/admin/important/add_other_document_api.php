<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	
	$other_document_name = $_POST['other_document_name'];
	$document_date = $_POST['document_date'];
	$class = $_POST['class'];
	$remark = $_POST['remark'];

	
	$other_document_upload=$_FILES['other_document_upload']['name'];
	
 $quer="insert into govt_official_other_info(other_document_name,class,remark,document_date,$update_by_insert_sql_column)
                                         values('$other_document_name','$class','$remark','$document_date',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){

    $last_id=mysqli_insert_id($conn73);
    
    if($other_document_upload!=''){
    $imagename = $_FILES['other_document_upload']['name'];
    $size = $_FILES['other_document_upload']['size'];
    $uploadedfile = $_FILES['other_document_upload']['tmp_name'];
    
    camera_code($size,$imagename,$uploadedfile,$last_id,"other_document_upload","govt_official_other_document","other_info_id");
    }

echo "|?|success|?|";
}
?>