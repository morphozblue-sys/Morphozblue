<?php include("../attachment/session.php");



	
	$s_no1 = $_POST['s_no1'];
	$bus_name = $_POST['bus_name'];
	$bus_company = $_POST['bus_company'];
	$bus_model_no = $_POST['bus_model_no'];
	$bus_no = $_POST['bus_no'];
	$bus_owner_name = $_POST['bus_owner_name'];
	$bus_owner_contact = $_POST['bus_owner_contact'];
	$bus_ragistration_no = $_POST['bus_ragistration_no'];
	
	$bus_document_uplode_name=$_FILES['bus_document_uplode']['name'];            
	$bus_photo_name=$_FILES['bus_photo']['name'];            

  $quer="update bus_details set bus_name='$bus_name',bus_company='$bus_company',bus_model_no='$bus_model_no',bus_no='$bus_no',bus_owner_name='$bus_owner_name',bus_owner_contact='$bus_owner_contact',bus_ragistration_no='$bus_ragistration_no',bus_document_uplode='$bus_document_uplode_name',bus_photo='$bus_photo_name' where s_no='$s_no1'";
 
 
if(mysqli_query($conn73,$quer)){
			
				include("../attachment/image_compression_upload.php");
						if($bus_photo_name!=''){
	$imagename = $_FILES['bus_photo_name']['name'];
	$size = $_FILES['bus_photo_name']['size'];
    $uploadedfile = $_FILES['bus_photo_name']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$s_no1,"bus_photo","bus_details","s_no");
	}
					if($bus_document_uplode_name!=''){
	$imagename = $_FILES['bus_document_uplode_name']['name'];
	$size = $_FILES['bus_document_uplode_name']['size'];
    $uploadedfile = $_FILES['bus_document_uplode_name']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$s_no1,"bus_document_uplode","bus_details","s_no");
	}
	
echo "|?|success|?|";
}


	?>

