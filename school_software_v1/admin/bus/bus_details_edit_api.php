<?php include("../attachment/session.php");
	 include("../attachment/image_compression_upload.php");
	$s_no1 = $_POST['s_no1'];
	$bus_name = $_POST['bus_name'];
	$bus_company = $_POST['bus_company'];
	$bus_model_no = $_POST['bus_model_no'];
	$bus_no = $_POST['bus_no'];
	$bus_owner_name = $_POST['bus_owner_name'];
	$bus_owner_contact = $_POST['bus_owner_contact'];
	$bus_ragistration_no = $_POST['bus_ragistration_no'];
	$bus_capacity = $_POST['bus_capacity'];
	$bus_id = $_POST['bus_id'];
	
				
	$bus_insurance=$_FILES['bus_insurance']['name'];            
	$bus_other_document=$_FILES['bus_other_document']['name'];            
	$bus_registration=$_FILES['bus_registration']['name'];            
    $bus_photo=$_FILES['bus_photo']['name'];    
				
						if($bus_insurance!=''){
	$imagename = $_FILES['bus_insurance']['name'];
	$size = $_FILES['bus_insurance']['size'];
    $uploadedfile = $_FILES['bus_insurance']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"bus_insurance","bus_document","bus_id");
						}				
						if($bus_other_document!=''){
	$imagename = $_FILES['bus_other_document']['name'];
	$size = $_FILES['bus_other_document']['size'];
    $uploadedfile = $_FILES['bus_other_document']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"bus_other_document","bus_document","bus_id");
						}					
						if($bus_registration!=''){
	$imagename = $_FILES['bus_registration']['name'];
	$size = $_FILES['bus_registration']['size'];
    $uploadedfile = $_FILES['bus_registration']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"bus_registration","bus_document","bus_id");
						}
	
				if($bus_photo!=''){
	$imagename = $_FILES['bus_photo']['name'];
	$size = $_FILES['bus_photo']['size'];
    $uploadedfile = $_FILES['bus_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"bus_photo","bus_document","bus_id");
	
	}
	
	$bus_pollution_certificate=$_FILES['bus_pollution_certificate']['name'];
    if($bus_pollution_certificate!=''){
	$imagename = $_FILES['bus_pollution_certificate']['name'];
	$size = $_FILES['bus_pollution_certificate']['size'];
    $uploadedfile = $_FILES['bus_pollution_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"pollution_certificate","bus_document","bus_id");
	}
	$bus_fitness_certificate=$_FILES['bus_fitness_certificate']['name'];
    if($bus_fitness_certificate!=''){
	$imagename = $_FILES['bus_fitness_certificate']['name'];
	$size = $_FILES['bus_fitness_certificate']['size'];
    $uploadedfile = $_FILES['bus_fitness_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"fitness_certificate","bus_document","bus_id");
	}
	$bus_permit_certificate=$_FILES['bus_permit_certificate']['name'];
	if($bus_permit_certificate!=''){
	$imagename = $_FILES['bus_permit_certificate']['name'];
	$size = $_FILES['bus_permit_certificate']['size'];
    $uploadedfile = $_FILES['bus_permit_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"permit_certificate","bus_document","bus_id");
	}
	$bus_speed_certificate=$_FILES['bus_speed_certificate']['name'];
	if($bus_speed_certificate!=''){
	$imagename = $_FILES['bus_speed_certificate']['name'];
	$size = $_FILES['bus_speed_certificate']['size'];
    $uploadedfile = $_FILES['bus_speed_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"speed_certificate","bus_document","bus_id");
	}
	$bus_gps_certificate=$_FILES['bus_gps_certificate']['name'];
	if($bus_gps_certificate!=''){
	$imagename = $_FILES['bus_gps_certificate']['name'];
	$size = $_FILES['bus_gps_certificate']['size'];
    $uploadedfile = $_FILES['bus_gps_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"gps_certificate","bus_document","bus_id");
	}
	$bus_camera_certificate=$_FILES['bus_camera_certificate']['name'];
	if($bus_camera_certificate!=''){
	$imagename = $_FILES['bus_camera_certificate']['name'];
	$size = $_FILES['bus_camera_certificate']['size'];
    $uploadedfile = $_FILES['bus_camera_certificate']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$bus_id,"camera_certificate","bus_document","bus_id");
	}
	
  $quer="update bus_details set bus_name='$bus_name',bus_company='$bus_company',bus_model_no='$bus_model_no',bus_no='$bus_no',bus_owner_name='$bus_owner_name',bus_owner_contact='$bus_owner_contact',bus_ragistration_no='$bus_ragistration_no',bus_capacity='$bus_capacity',$update_by_update_sql  where s_no='$s_no1'";
 
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>