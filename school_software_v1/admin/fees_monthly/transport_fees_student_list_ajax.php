<?php
include("../attachment/session.php");
$request=$_REQUEST;

	
$sql1 ="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' and student_bus='Yes' $filter37 ORDER BY s_no DESC";
$query=mysqli_query($conn73,$sql1);
$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' and student_bus='Yes' $filter37";
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
						 $grand_total="";
                        $balance_total="";
                        $paid_total="";
				$que1="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and fee_status='Active' and session_value='$session1'";
						$run1=mysqli_query($conn73,$que1);
						if(mysqli_num_rows($run1)>0){
							$student_fee_status="<b style='color:blue;'>Set</b>";
							$student_fee_status1=1;
						}else{
							$student_fee_status="<b style='color:red;'>Not Set</b>";
							$student_fee_status1=0;
						}
						
						$row1=mysqli_fetch_assoc($run1);
                        $update_change=$row1['update_change'];
                        $grand_total=$row1['grand_total'];
                        $balance_total=$row1['balance_total'];
                        $paid_total=$row1['paid_total'];
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
    $subdata[]=$grand_total; 
    
    $subdata[]=$paid_total;
    $subdata[]=$balance_total;  
    $subdata[]=$student_fee_status; 
    
    $subdata[]=$update_change;    
    $subdata[]=$last_updated_date; 
    if($student_fee_status1==1){
    $subdata[]="<button type='button' onclick=post_content('fees_monthly/transport_fees_student_list_edit','student_roll_no=$student_roll_no') class='btn btn-default my_background_color' >Edit</button>";  
}else{
     $subdata[]="";
}
   


   
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>