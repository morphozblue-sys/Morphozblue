<?php
include("../attachment/session.php");
$request=$_REQUEST;
$col =array(
    0   =>  's_no',
    1   =>  'homework_class',
    2   =>  'homework_section',
    3   =>  'homework',
    4   =>  'homework_date',
    5   =>  'homework_remark',
    6   =>  'homework_subject',
    7   =>  'bus_routee'
);  
          
    
              
                     $condition="";
          $condition1="";
          $condition2="";
          $condition3="";
          
              if($_GET['student_class']!=''){
                  $student_class1=$_GET['student_class'];
                  $condition=" and homework_class='$student_class1'";
              }
            //   echo $_GET['bus_routee'];
              
            //   die();
              if($_GET['bus_routee']!='All'){
                  $bus_routee=$_GET['bus_routee'];
                  $condition3=" and update_change='$bus_routee'";
              }
              
              if($_GET['subject_name']!=''){
                  $subject_name=$_GET['subject_name'];
                  if($subject_name!='All'){
                  $condition2=" and blank_field_2='$subject_name'";
                  }
              }
              if($_GET['particular_date']!=''){
                  $particular_date1=$_GET['particular_date'];
                  $particular_date2=date('d-m-Y', strtotime($_GET['particular_date']));
                  $condition1=" and homework_date='$particular_date2'";
              }
              
           
$sql1 ="select * from homework_student where session_value='$session1'$condition$condition1$condition2$condition3 ORDER BY s_no DESC";
$query=mysqli_query($conn73,$sql1);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
 $sql ="SELECT * FROM homework_student WHERE session_value='$session1'$condition$condition1$condition2$condition3 ";
if(!empty($request['search']['value'])){
    $sql.=" AND (s_no Like '%".$request['search']['value']."%' ";
    $sql.=" OR homework_class Like '%".$request['search']['value']."%' ";
    $sql.=" OR homework_section Like '%".$request['search']['value']."%' ";
    $sql.=" OR homework_date Like '%".$request['search']['value']."%' ";
    $sql.=" OR homework_remark Like '%".$request['search']['value']."%' ";
    $sql.=" OR blank_field_2 Like '%".$request['search']['value']."%' ";
    $sql.=" OR homework Like '%".$request['search']['value']."%' )";
    $sql.=" OR update_change Like '%".$request['search']['value']."%' )";
}
$query=mysqli_query($conn73,$sql);
$totalData=mysqli_num_rows($query);


$sql.=" ORDER BY s_no DESC  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($conn73,$sql);

$data=array();
$serial_no=1;  
while($row=mysqli_fetch_assoc($query)){
     $subdata=array();
    $s_no=$row['s_no'];
	$homework_class = $row['homework_class'];
	$homework_section = $row['homework_section'];
	$homework = $row['homework'];
	$homework_date = $row['homework_date'];
	$homework_remark = $row['homework_remark'];
			$subject_name = $row['blank_field_2'];
	$student_class_stream = $row['blank_field_3'];
	$student_class_group = $row['blank_field_4'];
    $update_change=$row['update_change'];
    if($row['last_updated_date']!='0000-00-00'){
    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
    }else{
    $last_updated_date=$row['last_updated_date'];
    }
		if(strlen($homework_remark)>49){
	    $homework_remark="";
	}
	$serial_no++;
	if(strlen($homework)>100){
	    $homework1 = substr($homework, 0, 100);
	    $read_more="<br><button type='button' class='btn btn-default' onclick=post_content('homework/homework_detail','id=$s_no') >Read More....</button>";
   
	}else{
	    $homework1=$homework;
	    $read_more="";
	}
	
    $homework_name=$row['blank_field_1'];


 	$homework_file=$row['homework_file_name'];
 $new_image=$_SESSION['amazon_file_path']."homework_document/".$homework_file;

 
	if($homework_file!=''){
    $file12="<a href='$new_image' target='_blank' >File Download</a>";
	}else{
	  $file12="";  
	}
	$class_stream="";
	if($homework_class=="11TH" || $homework_class=="12TH"){ 
	    $class_stream="[".$student_class_stream."][".$student_class_group."]";
	}
    $subdata[]=$serial_no;  
     $subdata[]=$homework_class.$class_stream; 
    $subdata[]=$homework_section; 
    $subdata[]=$subject_name; 
    $subdata[]= htmlspecialchars($homework);
	 $subdata[]=$homework_date; 
    $subdata[]=htmlspecialchars($homework_remark);    
    $subdata[]=$update_change;    
    $subdata[]=$last_updated_date; 
    $subdata[]=$file12;    
    $subdata[]="<button type='button' onclick=post_content('smartclass/homework_student_answer','homework_id=$s_no') class='btn btn-success' >Answers</button>";    
    $subdata[]="<button type='button' onclick=post_content('smartclass/homework_edit','id=$s_no') class='btn btn-primary' >Edit</button>";    
    $subdata[]="<button type='button' class='btn btn-danger' onclick=valid('$s_no') >Delete</button>";    
	 


   
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