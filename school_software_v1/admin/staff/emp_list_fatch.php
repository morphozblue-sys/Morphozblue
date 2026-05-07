<?php
include("../attachment/session.php");
$request=$_REQUEST;
$col =array(
    0   =>  's_no',
    1   =>  'emp_name',
    2   =>  'emp_mobile',
    3   =>  'emp_dob',
    4   =>  'emp_designation',
    5   =>  'emp_id'
);  
          

           
$sql1 ="select * from employee_info where emp_status='Active' AND (medium='".$_SESSION['medium_change']."' || medium='') AND (shift='".$_SESSION['shift_change']."' || shift='')";
$query=mysqli_query($conn73,$sql1);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM employee_info where emp_status='Active'  AND (medium='".$_SESSION['medium_change']."' || medium='') AND (shift='".$_SESSION['shift_change']."' || shift='')";
if(!empty($request['search']['value'])){
    $sql.=" AND (s_no Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_name Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_mobile Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_dob Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_designation Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_id Like '".$request['search']['value']."%' )";
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
					$emp_name=$row['emp_name'];
					$emp_mobile=$row['emp_mobile'];
					$emp_dob1=$row['emp_dob'];
					$emp_dob=date('d-m-Y',strtotime($emp_dob1));
					$emp_designation=$row['emp_designation'];
					$emp_id=$row['emp_id'];
					
					      $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }

					$joining_letter='';
	$que2="select joining_letter_pdf from  school_info_pdf_info ";
	$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
	while($row2=mysqli_fetch_assoc($run2)){
	$joining_letter=$row2['joining_letter_pdf'];
	 }	
//$emp_photo_file="<img onclick=open_file1('emp_photo','$emp_id'); src='$local_path'; height='50' width='50' style='margin-top:10px;'>";


$pdf_link=$pdf_path."joining_letter/".$joining_letter."?emp_id=".$emp_id;
$pdf_info="<a  href='$pdf_link' target='_blank'><button type='button' class='btn btn-success'>Print</button></a>";
    $subdata[]=$serial_no;  
     $subdata[]=$emp_name; 
    //$subdata[]=$emp_photo_file; 
    $subdata[]=$emp_mobile; 
    $subdata[]=$emp_dob; 
    $subdata[]= $emp_designation;
    $subdata[]= $update_change;
    $subdata[]= $last_updated_date;
    $subdata[]="<button type='button' onclick=post_content('staff/employee_edit','s_no=$s_no') class='btn btn-success' >Edit</button>";    
    $subdata[]="<button type='button'  class='btn btn-warning' onclick=for_drop('$s_no'); >Drop - Emp</button>";    
    $subdata[]="<button type='button' onclick=valid('$s_no') class='btn btn-success' >Delete</button>";    
    $subdata[]= $pdf_info;
	 


   
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
