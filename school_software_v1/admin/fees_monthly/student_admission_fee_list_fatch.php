<?php
include("../attachment/session.php");
$request=$_REQUEST;
	$gender=$_GET['gender'];
	$religion=$_GET['religion'];
	$caste=$_GET['caste'];
	$age=$_GET['age'];
	$scheme=$_GET['scheme'];
	$type=$_GET['type'];
	$class=$_GET['student_class'];
	$section=$_GET['student_class_section'];
	$sort_by=$_GET['sort_by'];
	$student_class_group=$_GET['student_class_group'];
	$student_class_stream=$_GET['student_class_stream'];
	$bus_fee_category_name=$_GET['bus_fee_category_name'];
	
	$current_date= date('Y-m-d');
	$current_date_d= date('d');
	$current_date_m= date('m');
	$current_date_y= date("Y");
	$student_age=$current_date_y-$age;
	$student_dob=$student_age.'-'.$current_date_m.'-'.$current_date_d;
	
	if($gender=='Both'){
	$condition="";
	}else{
	$condition=" and student_gender='$gender'";
	}


	if($religion=='All'){
	$condition1="";
	}else{
	$condition1=" and student_religion='$religion'";
	}
	
	if($caste=='All'){
	$condition2="";
	}else{
	$condition2=" and student_category='$caste'";
	}
	
	if($age==0){
	$condition3="";
	}else{
	$condition3=" and student_date_of_birth >='$student_dob'";
	}
	
	if($scheme=='All'){
	$condition4="";
	}else{
	$condition4=" and student_admission_scheme='$scheme'";
	}
	
	if($type=='All'){
	$condition5="";
	}else{
	$condition5=" and student_admission_type='$type'";
	}
	
	if($class=='All'){
	$condition6="";
	}else{
	$condition6=" and student_class='$class'";
	}
	if($section=='All' || $section==''){
	$condition7="";
	}else{
	$condition7=" and student_class_section='$section'";
	}
	$condition8="";
	$condition9="";
	if($class=="11TH" || $class=="12TH" ){
		if($student_class_group=='All'){
	$condition8="";
	}else{
	$condition8=" and student_class_group='$student_class_group'";
	}
	if($student_class_stream=='All'){
	$condition9="";
	}else{
	$condition9=" and student_class_stream='$student_class_stream'";
	}
	}
	
	if($bus_fee_category_name=='All'){
	$condition10="";
	}else{
	$condition10=" and student_bus_fee_category_code='$bus_fee_category_name'";
	}
	
	if($sort_by=='none'){
	$sort_by1="s_no";
	}else{
	$sort_by1=$sort_by;
	}
	
	
 $sql1 ="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' $condition$condition1$condition8$condition9$condition10$condition2$condition3$condition4$condition5$condition6$condition7$filter37 ORDER BY s_no DESC";
$query=mysqli_query($conn73,$sql1);
$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' $condition$condition1$condition8$condition9$condition10$condition2$condition3$condition4$condition5$condition6$condition7$filter37";
if(!empty($request['search']['value'])){
    $sql.=" AND (student_name Like '%".$request['search']['value']."%' ";
    $sql.=" OR student_father_name Like '%".$request['search']['value']."%' ";
    $sql.=" OR student_class Like '%".$request['search']['value']."%' ";
    $sql.=" OR student_class_section Like '%".$request['search']['value']."%' ";
    $sql.=" OR student_admission_number Like' %".$request['search']['value']."%' ";
    $sql.=" OR school_roll_no Like '%".$request['search']['value']."%' )";
}
 $sql.=" ORDER BY s_no DESC  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($conn73,$sql);

$data=array();
$serial_no=0;  
while($row=mysqli_fetch_assoc($query)){
     $subdata=array();
		$s_no=$row['s_no'];
						$student_name=$row['student_name'];
						$student_father_name=$row['student_father_name'];
						$student_class=$row['student_class'];
						$student_class_section=$row['student_class_section'];
						$student_date_of_birth=$row['student_date_of_birth'];
						$student_roll_no=$row['student_roll_no'];
						$school_roll_no=$row['school_roll_no'];
						$student_date_of_admission=$row['student_date_of_admission'];
						$student_admission_number=$row['student_admission_number'];
				$que1="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and fee_status='Active' and session_value='$session1'";
						$run1=mysqli_query($conn73,$que1);
						if(mysqli_num_rows($run1)>0){
							$student_fee_status="<b style='color:blue;'>Set</b>";
						}else{
							$student_fee_status="<b style='color:red;'>Not Set</b>";
						}
						
						$row1=mysqli_fetch_assoc($run1);
                        $update_change=$row1['update_change'];
                        if($row1['last_updated_date']!='0000-00-00'){
                        $last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
                        }else{
                        $last_updated_date=$row1['last_updated_date'];
                        }
	
	$serial_no++;

    $subdata[]=$serial_no;  
    $subdata[]=$student_admission_number;  
     $subdata[]=$student_name; 
     $subdata[]=$student_father_name; 
    $subdata[]=$student_class."[".$student_class_section."]"; 
    $subdata[]=$school_roll_no; 
    $subdata[]=$update_change;    
    $subdata[]=$last_updated_date; 
    $subdata[]="<button type='button' class='btn my_background_color' onclick=reset_fee1('$student_roll_no') >Reset Fee</button>";    
    $subdata[]=$student_fee_status; 
    $subdata[]="<button type='button' onclick=post_content('fees_monthly/set_fee_details','student_roll_no=$student_roll_no') class='btn btn-default my_background_color' >Set Fee</button>";    
   


   
    $data[]=$subdata;
	$serial_no++;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>