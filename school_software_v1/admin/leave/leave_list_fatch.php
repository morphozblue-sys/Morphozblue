<?php
include("../attachment/session.php");
$request=$_REQUEST;
$col =array(
    0   =>  's_no',
    1   =>  'student_name',
    2   =>  'student_roll_no',
    3   =>  'student_class',
    4   =>  'student_section',
    5   =>  'leave_from_date',
    5   =>  'leave_to_date',
    6   =>  'leave_approved_by'
);  
if(isset($_GET['student_class'])){
                  $student_class1=$_GET['student_class'];
                  $condition=" and student_class='$student_class1'";
              }else{
                  $student_class1='';
                  $condition="";
              }
              if(isset($_GET['particular_date'])){
                  $particular_date1=$_GET['particular_date'];
                  $particular_date2=date('d-m-Y', strtotime($_GET['particular_date']));
                  $condition1=" and leave_application_date='$particular_date2'";
              }else{
                  $particular_date1='';
                  $condition1="";
              }          

           
$sql1 ="select * from student_leave_management where s_no!='' $condition$condition1";
$query=mysqli_query($conn73,$sql1);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM student_leave_management where s_no!='' $condition$condition1";
if(!empty($request['search']['value'])){
    $sql.=" AND (s_no Like '".$request['search']['value']."%' ";
    $sql.=" OR student_name Like '".$request['search']['value']."%' ";
    $sql.=" OR student_roll_no Like '".$request['search']['value']."%' ";
    $sql.=" OR student_class Like '".$request['search']['value']."%' ";
    $sql.=" OR student_section Like '".$request['search']['value']."%' ";
    $sql.=" OR leave_from_date Like '".$request['search']['value']."%' ";
    $sql.=" OR leave_to_date Like '".$request['search']['value']."%' ";
    $sql.=" OR leave_approved_by Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($conn73,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY s_no DESC  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($conn73,$sql);

$data=array();
$serial_no=1;  

while($row=mysqli_fetch_assoc($query)){
     $subdata=array();


     $s_no=$row['s_no'];
	$student_name=$row['student_name'];
	$student_roll_no=$row['student_roll_no'];
	$student_class=$row['student_class'];
    $student_section = $row['student_section'];
	$leave_from_date = $row['leave_from_date'];
	$leave_to_date = $row['leave_to_date'];
	$leave_approved_by = $row['leave_approved_by'];
	$leave_total_day = $row['leave_total_day'];

	$leave_application=$row['leave_application_name'];

$new_image=$_SESSION['amazon_file_path']."leave_document/".$leave_application;
	


	if($leave_application!=''){
    $file12="<a href='$new_image' target='_blank' >Application Download</a>";
	}else{
	  $file12="";  
	}
	$class_stream="";

    $subdata[]=$serial_no;  
     $subdata[]=$student_name; 
    $subdata[]=$student_class; 
    $subdata[]=$student_roll_no; 
    $subdata[]= $student_section;
	 $subdata[]=$leave_from_date; 
    $subdata[]=$leave_to_date;    
    $subdata[]=$leave_total_day;    
    $subdata[]=$leave_approved_by; 
    $subdata[]=$file12;    
    $subdata[]="<button type='button' onclick=post_content('leave/edit_leave','id=$s_no') class='btn btn-success' >Edit</button>";    
    $subdata[]="<button type='button' class='btn btn-default' onclick=valid('$s_no') >Delete</button>";    
	 


   
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
