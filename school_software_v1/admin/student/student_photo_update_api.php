<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
$student_index=$_POST['student_index'];
$student_name=$_POST['student_name'];
$student_father_name=$_POST['student_father_name'];
$student_roll_no=$_POST['student_roll_no'];


$student_photo_name2=$_FILES['student_photo']['name'];            
$student_photo_temp=$_FILES['student_photo']['tmp_name'];
$student_photo_size = $_FILES['student_photo']['size'];

$student_father_photo_name2=$_FILES['student_father_photo']['name'];            
$student_father_photo_temp=$_FILES['student_father_photo']['tmp_name'];
$student_father_photo_size = $_FILES['student_father_photo']['size'];

$student_mother_photo_name2=$_FILES['student_mother_photo']['name'];            
$student_mother_photo_temp=$_FILES['student_mother_photo']['tmp_name'];
$student_mother_photo_size = $_FILES['student_mother_photo']['size'];

$count1=count($student_index);

for($i=0;$i<$count1;$i++){



$index11=$student_index[$i];


	if($student_photo_name2[$index11]!=null){
		$imagename = $student_photo_name2[$index11];
	$size = $student_photo_size[$index11];
    $uploadedfile = $student_photo_temp[$index11];
    $student_roll_no1 = $student_roll_no[$index11];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no1,"student_image","student_documents","student_roll_no");
		

	}
		
	if($student_father_photo_name2[$index11]!=null){
			$imagename = $student_father_photo_name2[$index11];
	$size = $student_father_photo_size[$index11];
    $uploadedfile = $student_father_photo_temp[$index11];
    $student_roll_no1 = $student_roll_no[$index11];
    camera_code($size,$imagename,$uploadedfile,$student_roll_no1,"student_father_image","student_documents","student_roll_no");
	}		
	if($student_mother_photo_name2[$index11]!=null){
			$imagename = $student_mother_photo_name2[$index11];
	$size = $student_mother_photo_size[$index11];
    $uploadedfile = $student_mother_photo_temp[$index11];
    $student_roll_no1 = $student_roll_no[$index11];
    camera_code($size,$imagename,$uploadedfile,$student_roll_no1,"student_mother_image","student_documents","student_roll_no");
	}


}
echo "|?|success|?|";
?>
