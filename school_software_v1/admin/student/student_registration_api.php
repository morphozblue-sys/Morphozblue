<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");

   $que11="select * from login ";
       $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
       while($row11=mysqli_fetch_assoc($run11)){
	   $student_id_generate=$row11['student_id_generate']; 
	   $blank_field_1=$row11['blank_field_1']; 
	   } 
	$student_class                  = $_POST['student_class']                  ?? '';

	$query012345="select * from school_info_class_info where class_name='$student_class'";
    $run012345=mysqli_query($conn73,$query012345) or die(mysqli_error($conn73));
    $class_code_no=0;
    while($row012345=mysqli_fetch_assoc($run012345)){
    $class_code_no=$row012345['class_code_no'];
    }

	if($student_class=="11TH" || $student_class=="12TH"){
	$student_class_stream = $_POST['student_class_stream'] ?? '';
	$student_class_group  = $_POST['student_class_group']  ?? '';
	}else{
	$student_class_stream = "";
	$student_class_group = "";
	}
	$student_class_group_subject        = $_POST['student_class_group_subject']        ?? '';
	$student_name                       = my_validation($_POST['student_name']          ?? '');
	$student_father_name                = $_POST['student_father_name']                ?? '';
	$student_mother_name                = $_POST['student_mother_name']                ?? '';
	$student_father_contact_number      = $_POST['student_father_contact_number']      ?? '';
	$student_father_contact_number2     = $_POST['student_father_contact_number2']     ?? '';
	$student_date_of_birth              = $_POST['student_date_of_birth']              ?? '';
	$student_date_of_birth_in_word      = $_POST['student_date_of_birth_in_word']      ?? '';
	$student_gender                     = $_POST['student_gender']                     ?? '';
	$student_date_of_admission          = $_POST['student_date_of_admission']          ?? '';
	$student_admission_type             = $_POST['student_admission_type']             ?? '';
	$student_admission_scheme           = $_POST['student_admission_scheme']           ?? '';
	$student_medium                     = $_POST['student_medium']                     ?? '';
	$student_bus                        = $_POST['student_bus']                        ?? '';
	$student_hostel                     = $_POST['student_hostel']                     ?? '';
	$student_library                    = $_POST['student_library']                    ?? '';
	$send_sms                           = $_POST['send_sms']                           ?? '';
	$sms                                = $_POST['sms']                                ?? '';
	$student_sms_contact_number         = $_POST['student_sms_contact_number']         ?? '';
	$stuent_old_or_new                  = $_POST['stuent_old_or_new']                  ?? '';
	
	if(isset($_POST['student_fee_category'])){
	$student_fee_category=$_POST['student_fee_category'];
	$student_fee_category1=explode('|?|',$student_fee_category);
	$student_fee_category_name=$student_fee_category1[0];
	$student_fee_category_code=$student_fee_category1[1];
	}else{
	$student_fee_category_name='';
	$student_fee_category_code='';
	}	
	
	$student_adress              = $_POST['student_adress']           ?? '';
	$student_city                = $_POST['student_city']             ?? '';
	$student_block               = $_POST['student_block']            ?? '';
	$student_district            = $_POST['student_district']         ?? '';
	$student_state               = $_POST['student_state']            ?? '';
	$student_landmark            = $_POST['student_landmark']         ?? '';
	$student_pincode             = $_POST['student_pincode']          ?? '';
	$student_remark_1            = $_POST['student_remark_1']         ?? '';
	$student_remark_2            = $_POST['student_remark_2']         ?? '';
	$student_remark_3            = $_POST['student_remark_3']         ?? '';
	$student_remark_4            = $_POST['student_remark_4']         ?? '';
	$student_registration_fee    = $_POST['student_registration_fee'] ?? '';	
		$student_id_generate=$student_id_generate+1;
	
	if($_SESSION['database_name1']=='msnpschoolgopalganj' || $_SESSION['database_name1']=='gopaljimemorialschool'){
	    $blank_field_1=$blank_field_1+1;
	    if($blank_field_1<10){
	        $student_id_generate1="00".$blank_field_1;
	    }elseif($blank_field_1<100){
	        $student_id_generate1="0".$blank_field_1;
	    }else{
	        $student_id_generate1=$blank_field_1;
	    }
	   $student_id_generate1=$student_id_generate1."/".str_replace("_","-",$session1); 
	   
	$student_registration_number = $student_id_generate1;
	}elseif($_SESSION['database_name1']=='bharatbharatischoolkullu'){
	    $blank_field_1=$blank_field_1+1;
	    if($blank_field_1<10){
	        $student_id_generate1="00".$blank_field_1;
	    }elseif($blank_field_1<100){
	        $student_id_generate1="0".$blank_field_1;
	    }else{
	        $student_id_generate1=$blank_field_1;
	    }
	   
	$student_registration_number = $student_id_generate1;
	}elseif($_SESSION['database_name1']!='sanskarschoolnarsinghpur' && $_SESSION['database_name1']!='saraswatibalmandirbhaunkhedi'){
	    
	$student_registration_number = $student_id_generate;
	}else{
	    
	$student_registration_number = $_POST['student_registration_number'] ?? '';
	}
          
   $student_image=$_FILES['student_photo']['name'];            
         
	$father_image=$_FILES['father_photo']['name'];            
	$mother_image=$_FILES['mother_photo']['name'];            

	
	$que11="select * from login ";
       $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
       while($row11=mysqli_fetch_assoc($run11)){
       $class_roll=$row11['student_id_generate'];	   
	   }			 
	   $class_roll=$class_roll+1;
	  
    if($class_roll<10)
    {
    $class_roll_new="0000".$class_roll;
    } else if($class_roll<100)
    {
    $class_roll_new="000".$class_roll;
    }
	else if($class_roll<1000)
    {
    $class_roll_new="00".$class_roll;
    }
	else if($class_roll<10000)
    {
    $class_roll_new="0".$class_roll;
    }
    $y=date("Y")-2000;
    $student_roll_no=$y.$class_roll_new;



	$que4="select * from school_info_class_info Where class_name='$student_class'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_code = $row4['class_code'];
    }
	$student_date_of_birth2=explode('-',$student_date_of_birth);
    $student_date_of_birth_month=$student_date_of_birth2[1];
    $student_date_of_birth_date=$student_date_of_birth2[2];

		if($_SESSION['shift']=='yes'){
		$shift = $_POST['student_shift'] ?? '';
		}else{
		$shift='';
		}
		if($_SESSION['school_info_school_board']=='Both'){
		$board = $_POST['student_board'] ?? '';
		}else{
		$board='';
		}
		if($_SESSION['school_info_medium']=='Both'){
		$medium = $_POST['student_medium'] ?? '';
		}else{
		$medium='';
		}
		
	
		$school='';
		
		

	$quer="insert into student_admission_info(student_id_generate,stuent_old_or_new,student_class,student_name,student_father_name,student_mother_name,student_father_contact_number,student_father_contact_number2,student_roll_no,student_date_of_birth,student_date_of_birth_in_word,student_gender,student_date_of_admission,student_admission_type,student_admission_scheme,student_medium,student_class_section,student_password,student_bus,student_hostel,student_library,student_remark_1,student_remark_2,student_remark_3,student_remark_4,student_class_stream,student_class_group,student_class_subject,student_date_of_birth_month,student_date_of_birth_date,student_sms_contact_number,session_value,board,medium,shift,school,student_registration_fee,student_fee_category,student_fee_category_code,student_adress,student_city,student_block,student_district,student_state,student_landmark,student_pincode,class_code_no,student_registration_number,$update_by_insert_sql_column) values('$student_id_generate','$stuent_old_or_new','$student_class','$student_name','$student_father_name','$student_mother_name','$student_father_contact_number','$student_father_contact_number2','$student_roll_no','$student_date_of_birth','$student_date_of_birth_in_word','$student_gender','$student_date_of_admission','$student_admission_type','$student_admission_scheme','$student_medium','A','$student_father_contact_number','$student_bus','$student_hostel','$student_library','$student_remark_1','$student_remark_2','$student_remark_3','$student_remark_4','$student_class_stream','$student_class_group','$student_class_group_subject','$student_date_of_birth_month','$student_date_of_birth_date','$student_sms_contact_number','$session1','$board','$medium','$shift','$school','$student_registration_fee','$student_fee_category_name','$student_fee_category_code','$student_adress','$student_city','$student_block','$student_district','$student_state','$student_landmark','$student_pincode','$class_code_no','$student_registration_number',$update_by_insert_sql_value)";


    
    if(mysqli_query($conn73,$quer)){
        $quer12="update login set student_id_generate='$student_id_generate',blank_field_1='$blank_field_1'";
    mysqli_query($conn73,$quer12);
    $quer1="insert into fees_student_fee(student_class,student_name,student_roll_no,session_value,$update_by_insert_sql_column)values('$student_class','$student_name','$student_roll_no','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer1);
	if($student_registration_fee!="" && $student_registration_fee!=0 ){
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_name','$student_date_of_admission','Credit','Cash','$student_registration_fee','Registration Fee','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$query);
	}
        
        	if($student_image!=''){
	$imagename = $_FILES['student_photo']['name'];
	$size = $_FILES['student_photo']['size'];
    $uploadedfile = $_FILES['student_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_image","student_documents","student_roll_no");
	}
	
	if($father_image!=''){
	$imagename = $_FILES['father_photo']['name'];
	$size = $_FILES['father_photo']['size'];
	$uploadedfile = $_FILES['father_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_father_image","student_documents","student_roll_no");
	}
	
	if($mother_image!=''){
	$imagename = $_FILES['mother_photo']['name'];
	$size = $_FILES['mother_photo']['size'];
	$uploadedfile = $_FILES['mother_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_mother_image","student_documents","student_roll_no");
	}
	
        
        
        
        
        
        
	if($send_sms=="Yes"){
	include("../sms/sms.php");
	//sendDNDSMS($student_sms_contact_number,$sms);	
	}
	echo "|?|success|?|";
	}
?>	