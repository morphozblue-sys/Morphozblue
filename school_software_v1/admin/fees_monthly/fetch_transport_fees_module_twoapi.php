<?php
include("../attachment/session.php");
$request=$_REQUEST;
 
$sql2 ="select * from common_fees_student_transport_fee_add INNER JOIN common_fees_student_transport_fee ON common_fees_student_transport_fee_add.student_roll_no=common_fees_student_transport_fee.student_roll_no where 1=1 and common_fees_student_transport_fee_add.`student_name` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee_add.`student_father_name` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee_add.`student_class` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee_add.`student_class_section` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee_add.`fee_submission_date` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee.`grand_total` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee.`paid_total` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' or 1=1 and common_fees_student_transport_fee.`balance_total` LIKE '%".$request['search']['value']."%' and common_fees_student_transport_fee_add.fee_status='Active' and common_fees_student_transport_fee_add.session_value='$session1' and common_fees_student_transport_fee.fee_status='Active' and common_fees_student_transport_fee.session_value='$session1' GROUP BY common_fees_student_transport_fee_add.student_roll_no ORDER BY common_fees_student_transport_fee_add.s_no DESC";

$query=mysqli_query($conn73,$sql2);
$totalData=mysqli_num_rows($query);
$totalFilter=$totalData;

$data=array();
$serial_no=1;  
while($row=mysqli_fetch_assoc($query)){
    
    $student_roll_no_temp=$row['student_roll_no'];
    $sql3 ="select fee_submission_date from common_fees_student_transport_fee_add where student_roll_no='$student_roll_no_temp' and fee_status='Active' and session_value='$session1'";
    $query3=mysqli_query($conn73,$sql3);
    $fee_submission_date1='';
    while($row3=mysqli_fetch_assoc($query3)){
        $fee_submission_date1=$row3['fee_submission_date'];
    }
      
   
    $subdata=array();
                     $subdata[]=$serial_no;  
    
     $subdata[]=$row['student_name']; 

    $subdata[]=$row['student_father_name']; 
    $subdata[]=$row['student_class'];
   
	 $subdata[]=$row['student_class_section'];
	  if($fee_submission_date1!=''){
				$subdata[]=date('d-m-Y',strtotime($fee_submission_date1));
		}else{
				$subdata[]=$fee_submission_date1;
		}
			$subdata[]=$row['grand_total'];
		$student_roll_no=$row['student_roll_no'];
                    $subdata[]=$row['paid_total'];
					$subdata[]=$row['balance_total'];
		
 $subdata[]="<button type='button' onclick="."post_content('fees_monthly/student_transport_fee_list_particular','student_roll_no=".$student_roll_no."');"." class='btn btn-default my_background_color'>Details</button>";
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
