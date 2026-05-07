<?php
include("../attachment/session.php");
$request=$_REQUEST;

$qry0001="select * from login";
$rest0001=mysqli_query($conn73,$qry0001);
$use_editable_or_not='';
while($row0001=mysqli_fetch_assoc($rest0001)){
$use_editable_or_not=$row0001['use_editable_or_not'];
}
if($use_editable_or_not=='Yes'){
    $fee_rec_column_name='editable_receipt_no';
}else{
    $fee_rec_column_name='blank_field_5';
}

$sql2 ="select common_fees_student_fee_add.$fee_rec_column_name,common_fees_student_fee_add.fee_submission_date,common_fees_student_fee.balance_total,common_fees_student_fee.paid_total,common_fees_student_fee.grand_total,student_admission_info.student_name,student_admission_info.student_father_name,student_admission_info.student_class,student_admission_info.student_class_section,student_admission_info.student_roll_no,student_admission_info.student_admission_number from common_fees_student_fee_add INNER JOIN common_fees_student_fee ON common_fees_student_fee_add.student_roll_no=common_fees_student_fee.student_roll_no INNER JOIN student_admission_info ON student_admission_info.student_roll_no=common_fees_student_fee.student_roll_no where common_fees_student_fee_add.fee_status='Active' and common_fees_student_fee_add.session_value='$session1' and common_fees_student_fee.fee_status='Active' and common_fees_student_fee.session_value='$session1' and student_admission_info.student_status='Active' and student_admission_info.session_value='$session1'";

if(!empty($request['search']['value'])){
    $sql2.=" AND (common_fees_student_fee_add.`editable_receipt_no` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR common_fees_student_fee_add.`blank_field_5` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR common_fees_student_fee.`balance_total` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR common_fees_student_fee.`paid_total` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR common_fees_student_fee.`grand_total` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR common_fees_student_fee_add.`fee_submission_date` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR student_admission_info.`student_father_name` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR student_admission_info.`student_class_section` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR student_admission_info.`student_class` Like '%".$request['search']['value']."%' ";
    $sql2.=" OR student_admission_info.`student_name` Like '%".$request['search']['value']."%' )";
}
$sql2.=" GROUP BY common_fees_student_fee_add.student_roll_no ORDER BY common_fees_student_fee_add.s_no DESC";
$query=mysqli_query($conn73,$sql2) or die(mysqli_error($conn73));
$totalData=mysqli_num_rows($query);
$totalFilter=$totalData;
$data=array();
$serial_no=1;
$sql2.=" LIMIT ".$request['start']."  ,".$request['length']."  ";
$query=mysqli_query($conn73,$sql2) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($query)){

$student_roll_no_temp=$row['student_roll_no'];

$sql4 ="select student_roll_no from student_admission_info where student_roll_no='$student_roll_no_temp' and student_status='Active' and session_value='$session1'$filter37";
$query4=mysqli_query($conn73,$sql4);
if(mysqli_num_rows($query4)>0){

     $sql3 ="select fee_submission_date,$fee_rec_column_name from common_fees_student_fee_add where student_roll_no='$student_roll_no_temp' and fee_status='Active' and session_value='$session1'";
    $query3=mysqli_query($conn73,$sql3);
    $fee_submission_date1='';
    $blank_field_5='';
    $comma='';
    while($row3=mysqli_fetch_assoc($query3)){
        $fee_submission_date1=$row3['fee_submission_date'];
        $blank_field_5=$blank_field_5.$comma.$row3[$fee_rec_column_name];
        $comma=',';
    }
      
   
    $subdata=array();
    $subdata[]=$serial_no;  
    
    $subdata[]=$row['student_admission_number'];
    $subdata[]=$row['student_name']; 

    $subdata[]=$row['student_father_name']; 
    $subdata[]=$row['student_class'];
   
	 $subdata[]=$row['student_class_section'];
	 $subdata[]=$blank_field_5;
	 if($fee_submission_date1!=''){
	 $subdata[]=date('d-m-Y',strtotime($fee_submission_date1));
	 }else{
	 $subdata[]=$fee_submission_date1;
		}
		$subdata[]=$row['grand_total'];
		$student_roll_no=$row['student_roll_no'];
                    $subdata[]=$row['paid_total'];
					$subdata[]=$row['balance_total'];
		
 $subdata[]="<button type='button' onclick="."post_content('fees_monthly/student_fee_list_particular','student_roll_no=".$student_roll_no."');"." class='btn btn-primary my_background_color'>Details</button>";
	$data[]=$subdata;
	$serial_no++;

}
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
?>