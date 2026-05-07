<?php
//error_reporting(0);
include("../attachment/session.php");
$request=$_REQUEST;
$order= $request['order'];
$order1=$order[0]["column"];
$order2=$order[0]["dir"];
$col =array(
    0   =>  's_no',
    1   =>  'enquiry_type',
    2   =>  'enquiry_name',
    3   =>  'blank_field_1',
    4   =>  'enquiry_father_name',
    5   =>  'student_medium',
    6   =>  'enquiry_date',
    7   =>  'enquiry_contact_no_1',
    8   =>  'enquiry_contact_no_2',
    9   =>  'enquiry_address',
    10   =>  'enquiry_next_follow_up_date',
    11   =>  'enquiry_remark_1',
    12   =>  'enquiry_remark_2',
    13   =>  'update_change',
    14   =>  's_no',
    15   =>  's_no',
    16   =>  's_no',
    17   =>  's_no',
    18   =>  's_no'
);	

$order_column=$col[$order1];
$order_type=$order2;


$sql1 ="select s_no from enquiry_info where session_value='$session1' ORDER BY s_no DESC";
$query=mysqli_query($conn73,$sql1);
$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="select * from enquiry_info  where session_value='$session1'";
if(!empty($request['search']['value'])){
    $sql.=" AND (enquiry_type Like '%".$request['search']['value']."%'";
    $sql.=" OR enquiry_father_name Like '%".$request['search']['value']."%'";
    $sql.=" OR blank_field_1 Like '%".$request['search']['value']."%'";
    $sql.=" OR enquiry_name Like '%".$request['search']['value']."%'";
    $sql.=" OR enquiry_contact_no_1 Like' %".$request['search']['value']."%'";
    $sql.=" OR enquiry_contact_no_2 Like' %".$request['search']['value']."%'";
    $sql.=" OR enquiry_address Like' %".$request['search']['value']."%'";
    $sql.=" OR enquiry_remark_1 Like' %".$request['search']['value']."%'";
    $sql.=" OR enquiry_remark_2 Like' %".$request['search']['value']."%'";
    $sql.=" OR update_change Like '%".$request['search']['value']."%' )";
}
$query=mysqli_query($conn73,$sql);
$totalFilter=mysqli_num_rows($query);
$sql.=" ORDER BY $order_column $order_type  LIMIT ".
    $request['start']."  ,".$request['length'];
$query=mysqli_query($conn73,$sql);
$data=array();
$serial_no=0; 
	
while($row=mysqli_fetch_assoc($query)){
     $subdata=array();
	$s_no=$row['s_no'];
	$enquiry_type = $row['enquiry_type'];
	$enquiry_name = $row['enquiry_name'];
	$student_class = $row['blank_field_1'];
	$enquiry_father_name = $row['enquiry_father_name'];
	$student_medium = $row['student_medium'];
	$enquiry_date1 = $row['enquiry_date'];
	$enquiry_contact_no_1 = $row['enquiry_contact_no_1'];
	$enquiry_contact_no_2 = $row['enquiry_contact_no_2'];
	$enquiry_address = $row['enquiry_address'];
	$enquiry_next_follow_up_date = $row['enquiry_next_follow_up_date'];
	$enquiry_remark_1 = $row['enquiry_remark_1'];
	$enquiry_remark_2 = $row['enquiry_remark_2'];
    $enquiry_date = date('d-m-Y',strtotime($enquiry_date1));
    $update_change=$row['update_change'];
	if($row['last_updated_date']!='0000-00-00'){
	$last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
	}else{
	$last_updated_date=$row['last_updated_date'];
	}
		
		     
				$serial_no++;
if($_SESSION['software_link']=='geniusworldbairad'){
$pdf_link=$pdf_path."enquiry_pdf/enquiryform_gws.php?s_no=".$s_no;
}elseif($_SESSION['software_link']=='srmbrilliantschool'){
$pdf_link=$pdf_path."enquiry_pdf/enquiry_form_srm.php?s_no=".$s_no;
}
else{
$pdf_link=$pdf_path."enquiry_pdf/enquiry_form.php?s_no=".$s_no;
}
    $subdata[]=$serial_no;  
     $subdata[]=$enquiry_type; 
     $subdata[]=$enquiry_name; 
    $subdata[]=$student_class; 
    $subdata[]=$enquiry_father_name; 
    $subdata[]=$student_medium; 
    $subdata[]=$enquiry_date; 
    $subdata[]=$enquiry_contact_no_1; 
    $subdata[]=$enquiry_contact_no_2; 
    $subdata[]=$enquiry_address; 
    $subdata[]=$enquiry_next_follow_up_date; 
    $subdata[]=$enquiry_remark_1; 
    $subdata[]=$enquiry_remark_2; 
    $subdata[]=$update_change;    
    $subdata[]=$last_updated_date; 
    $subdata[]="<button type='button' onclick=post_content('enquiry/enquiry_edit','id=$s_no') class='btn btn-primary' >".$language['Edit']."</button>";    
    $subdata[]="<a href='$pdf_link' target='_blank'><button type='button' class='btn btn-primary'>".$language['Print']."</button></a></td>";    
      
    $subdata[]="<button type='button' class='btn btn-success' onclick=valid('$s_no') >".$language['Delete']."</button>";    
    

   
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