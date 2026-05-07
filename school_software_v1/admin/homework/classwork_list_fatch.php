<?php
include("../attachment/session.php");
$request=$_REQUEST;
$col =array(
    0   =>  's_no',
    1   =>  'classwork_class',
    2   =>  'classwork_section',
    3   =>  'classwork',
    4   =>  'classwork_date',
    5   =>  'classwork_remark',
    6   =>  'classwork_subject',
    7   =>  'update_by'
);  
          
              if($_GET['student_class']!=''){
                  $student_class1=$_GET['student_class'];
                  $condition=" and classwork_class='$student_class1'";
              }else{
                  $student_class1='';
                  $condition="";
              }
              
          
              
              
              if($_GET['update_by']!=''){
                  $update_by=$_GET['update_by'];
                  $condition3=" and update_change='$update_by'";
              }else{
                  $update_by='';
                  $condition3="";
              }
              
              
              
              
              if($_GET['particular_date']!=''){
                  $particular_date1=$_GET['particular_date'];
                  $particular_date2=date('d-m-Y', strtotime($_GET['particular_date']));
                  $condition1=" and classwork_date='$particular_date2'";
                  $condition1=" and (classwork_date='$particular_date2' || classwork_date='$particular_date1')";
              }else{
                  $particular_date1='';
                  $condition1="";
              }
           

 $sql1 ="select * from classwork_student where session_value='$session1'$condition$condition1$condition3 ORDER BY s_no DESC";
// if($update_change=='rahul@simption.com'){echo $sql1;}
$query=mysqli_query($conn73,$sql1);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM classwork_student WHERE session_value='$session1'$condition$condition1$condition3";
if(!empty($request['search']['value'])){
    $sql.=" AND (s_no Like '".$request['search']['value']."%' ";
    $sql.=" OR classwork_class Like '".$request['search']['value']."%' ";
    $sql.=" OR classwork_section Like '".$request['search']['value']."%' ";
    $sql.=" OR classwork_date Like '".$request['search']['value']."%' ";
    $sql.=" OR classwork_remark Like '".$request['search']['value']."%' ";
    $sql.=" OR blank_field_2 Like '".$request['search']['value']."%' ";
    $sql.=" OR classwork Like '".$request['search']['value']."%' )";
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
	$classwork_class = $row['classwork_class'];
	$classwork_section = $row['classwork_section'];
	$classwork1 = $row['classwork'];
	$read_more="";
	//$classwork = '';
	$classwork_date =date('d-m-y',strtotime($row['classwork_date']));
	$classwork_remark = utf8_encode($row['classwork_remark']);
	//$classwork_remark = '';
	$subject_name = $row['blank_field_2'];
	$student_class_stream = $row['blank_field_3'];
	$student_class_group = $row['blank_field_4'];
    $update_change=$row['update_change'];
    if($row['last_updated_date']!='0000-00-00'){
    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
    }else{
    $last_updated_date=$row['last_updated_date'];
    }
	
//	$serial_no++;
// 	if(strlen($classwork)>100){
// 	    $classwork1 = substr($classwork, 0, 100);
// 	    $read_more="<br><button type='button' class='btn btn-default' onclick=post_content('homework/classwork_Detail','id=$s_no') >Read More....";
   
// 	}else{
// 	    $classwork1=$classwork;
// 	    $read_more="";
// 	}
	$classwork_name=$row['blank_field_1'];


 	$classwork_file=$row['blank_field_5'];
 $new_image=$_SESSION['amazon_file_path']."classwork_student/".$classwork_file;

 
	if($classwork_file!=''){
    $file12="<a href='$new_image' target='_blank' >File Download</a>";
	}else{
	  $file12="";  
	}

 


	$class_stream="";
	if($classwork_class!="11TH" || $classwork_class!="12TH"){ 
	    $class_stream="[".$student_class_stream."][".$student_class_group."]";
	}
    $subdata[]=$serial_no;  
     $subdata[]=$classwork_class.$class_stream; 
    $subdata[]=$classwork_section; 
    $subdata[]=$subject_name; 
    $subdata[]= $classwork1.$read_more;
	 $subdata[]=$classwork_date; 
    $subdata[]=$classwork_remark; 
    
    $subdata[]=$file12;  
    $subdata[]=$update_change;    
    $subdata[]=$last_updated_date;   
    $subdata[]="<button type='button' onclick=post_content('homework/classwork_edit','id=$s_no') class='btn btn-success' >Edit</button>";    
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
