<?php include("../attachment/session.php"); ?>
<?php
include("../attachment/image_compression_upload.php");

  $exam_stuff_class=$_POST['exam_stuff_class'];
  $exam_stuff_subject=$_POST['exam_stuff_subject'];
  $exam_stuff_document_name=$_POST['exam_stuff_document_name'];
  $exam_stuff_date=$_POST['exam_stuff_date'];

$upload_file=$_FILES['upload_file']['name'];

$quer="insert into library_exam_stuff(exam_stuff_class,exam_stuff_subject,exam_stuff_document_name,exam_stuff_date) values('$exam_stuff_class','$exam_stuff_subject','$exam_stuff_document_name','$exam_stuff_date')";

if(mysqli_query($conn73,$quer)){
    
    $last_id=mysqli_insert_id($conn73);
    if($upload_file!=''){
	$imagename = $_FILES['upload_file']['name'];
	$size = $_FILES['upload_file']['size'];
    $uploadedfile = $_FILES['upload_file']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$last_id,"stuff_image","library_exam_stuff_document","stuff_s_no");
	}
    
	echo "|?|success|?|";
	
}

?>