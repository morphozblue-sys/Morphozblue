<?php
include("../attachment/session.php");
$request=$_REQUEST;
$col =array(
    0   =>  's_no',
    1   =>  'emp_name',
    2   =>  'emp_mobile',
    3   =>  'emp_designation',
    4   =>  'emp_id'
);  
          

           
$sql1 ="select * from employee_info where emp_status='Active' GROUP BY emp_id";
$query=mysqli_query($conn73,$sql1);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM employee_info where emp_status='Active'$filter37 GROUP BY emp_id";
if(!empty($request['search']['value'])){
    $sql.=" AND (s_no Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_name Like '".$request['search']['value']."%' ";
    $sql.=" OR emp_mobile Like '".$request['search']['value']."%' ";
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
$serial_no=0;  


while($row=mysqli_fetch_assoc($query)){
     $subdata=array();


     $s_no=$row['s_no'];
					$emp_name=$row['emp_name'];
					$emp_mobile=$row['emp_mobile'];
					$emp_designation=$row['emp_designation'];
					$emp_id=$row['emp_id'];
					
				    $serial_no++;


    $subdata[]=$serial_no;  
     $subdata[]=$emp_name; 
    //$subdata[]=$emp_photo_file; 
    $subdata[]=$emp_mobile; 
    $subdata[]= $emp_designation;
    $subdata[]="<button type='button' onclick=post_content('staff/emp_salary_generate','emp_id=$emp_id') class='btn btn-success' >Salary Generate</button>";    
    $subdata[]="<button type='button' onclick=post_content('staff/emp_salary_list_particular','emp_id=$emp_id') class='btn btn-success' >Details</button>";    
 
	 


   
    $data[]=$subdata;
	//$serial_no++;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>
