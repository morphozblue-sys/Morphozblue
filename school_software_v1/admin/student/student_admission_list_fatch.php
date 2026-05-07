<?php

error_reporting(0);
include("../attachment/session.php");

$request              = $_REQUEST;
$gender               = $_GET['gender']               ?? 'Both';
$religion             = $_GET['religion']             ?? 'All';
$caste                = $_GET['caste']                ?? 'All';
$age                  = $_GET['age']                  ?? 0;
$scheme               = $_GET['scheme']               ?? 'All';
$type                 = $_GET['type']                 ?? 'All';
$class                = $_GET['student_class']        ?? 'All';
$section              = $_GET['student_class_section'] ?? 'All';
$sort_by              = $_GET['sort_by']              ?? ' ORDER BY s_no DESC';
$student_class_group  = $_GET['student_class_group']  ?? 'All';
$student_class_stream = $_GET['student_class_stream'] ?? 'All';
$bus_fee_category_name = $_GET['bus_fee_category_name'] ?? 'All';
	
	$current_date= date('Y-m-d');
	$current_date_d= date('d');
	$current_date_m= date('m');
	$current_date_y= date("Y");
	$student_age=$current_date_y-$age;
	$student_dob=$student_age.'-'.$current_date_m.'-'.$current_date_d;
	
	$student_age1=$current_date_y-($age+1);
	$student_dob1=$student_age1.'-'.$current_date_m.'-'.$current_date_d;
	
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
	$condition3=" and student_date_of_birth <='$student_dob' and student_date_of_birth >='$student_dob1'";
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
	if($student_class_group=='All' || $student_class_group==''){
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
	
// 	if($sort_by=='none'){
// 	$sort_by1="s_no";
// 	}else{
// 	$sort_by1=$sort_by;
// 	}
	
	if($_SESSION['database_name']=='simptylz_sapientschoolsingrauli'){
	$order_by_condition=" ORDER BY CAST(student_admission_number AS UNSIGNED) ASC";
	}else{
	$order_by_condition=$sort_by;
	}
	
$sql1 ="select s_no from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' $condition$condition1$condition8$condition9$condition10$condition2$condition3$condition4$condition5$condition6$condition7$filter37$order_by_condition";
$query=mysqli_query($conn73,$sql1);
$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

$sql ="select student_date_of_birth,s_no,student_name,student_class_section,student_class_stream,student_father_name,student_class,student_roll_no,student_father_contact_number,student_admission_number,student_scholar_number,school_roll_no,update_change,last_updated_date from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' $condition$condition1$condition8$condition9$condition10$condition2$condition3$condition4$condition5$condition6$condition7$filter37";
$sv = trim($request['search']['value'] ?? '');
if ($sv !== '') {
    $sv = mysqli_real_escape_string($conn73, $sv);
    $sql .= " AND (student_name LIKE '%$sv%'
               OR student_father_name LIKE '%$sv%'
               OR student_class LIKE '%$sv%'
               OR student_class_section LIKE '%$sv%'
               OR student_class_stream LIKE '%$sv%'
               OR student_father_contact_number LIKE '%$sv%'
               OR student_admission_number LIKE '%$sv%'";
    if ($_SESSION['database_name'] === 'simptkfv_sunriseschoolbijuri') {
        $sql .= " OR student_scholar_number LIKE '%$sv%'";
    }
    $sql .= " OR update_change LIKE '%$sv%')";
}
$query=mysqli_query($conn73,$sql);
$totalData=mysqli_num_rows($query);
$start  = (int)($request['start']  ?? 0);
$length = (int)($request['length'] ?? 10);
$sql   .= $order_by_condition . " LIMIT $start, $length";
$query=mysqli_query($conn73,$sql);
$data=array();
$que12="select admission_form_pdf,scholar_register_pdf from school_info_pdf_info";
$run12=mysqli_query($conn73,$que12);
while($row12=mysqli_fetch_assoc($run12)){
	$admission_form_pdf = $row12['admission_form_pdf'];
	$scholar_register_pdf=$row12['scholar_register_pdf'];
}
$serial_no = (int)($request['start'] ?? 0);
while ($row = mysqli_fetch_assoc($query)) {
    $subdata = [];
				$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_father_name=$row['student_father_name'];
		    	$student_class=$row['student_class'];
			    $student_roll_no=$row['student_roll_no'];
			   $student_father_contact_no=$row['student_father_contact_number'];
				$student_admission_number=$row['student_admission_number'];
				$student_scholar_number=$row['student_scholar_number'];
				$student_date_of_birth=$row['student_date_of_birth'];
		 	    $school_roll_no=$row['school_roll_no'];
		     	$student_class_section=$row['student_class_section'];
		     	$student_class_stream=$row['student_class_stream'];
                $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
              $student_age="";  
        //   $today = date("Y-m-d");
           $today = date("d-m-Y");
            if($student_date_of_birth!=''){
            $student_date_of_birth=date_format(date_create($student_date_of_birth),"d-m-Y");
                }
           if($student_date_of_birth!=''){
           $diff = date_diff(date_create($student_date_of_birth), date_create($today));
		   	$student_age=$diff->format('%y')." Year ".$diff->format('%m')." Month ".$diff->format('%d')." Days";
           }
    $serial_no++;
    $s_roll    = htmlspecialchars($student_roll_no);
    $s_name    = htmlspecialchars($student_name);
    $s_father  = htmlspecialchars($student_father_name);
    $s_class   = htmlspecialchars($student_class);
    $s_section = htmlspecialchars($student_class_section);
    $s_stream  = htmlspecialchars($student_class_stream);
    $s_contact = htmlspecialchars($student_father_contact_no);
    $s_admno   = htmlspecialchars($student_admission_number);
    $s_scholar = htmlspecialchars($student_scholar_number);

    $pdf_link   = $pdf_path . "admission_form/" . $admission_form_pdf . "?id=" . $s_roll;
    $pdf_link_1 = $pdf_path . "admission_form/" . $scholar_register_pdf . "?id=" . $s_roll;

    $name_cell  = "<span class='al-name'>$s_name</span>";
    $class_cell = "<span class='al-class-badge'>$s_class" . ($s_section ? " [$s_section]" : "") . "</span>";

    $subdata[] = $serial_no;
    $subdata[] = $name_cell;
    $subdata[] = $s_father;
    $subdata[] = $class_cell;
    $subdata[] = $s_stream;
    $subdata[] = $s_contact;
    $subdata[] = $student_date_of_birth;
    $subdata[] = $student_age;
    $subdata[] = $school_roll_no;
    $subdata[] = $s_admno;
    if ($_SESSION['database_name'] === 'simptkfv_sunriseschoolbijuri') {
        $subdata[] = $s_scholar;
    }
    $subdata[] = htmlspecialchars($update_change);
    $subdata[] = $last_updated_date;

    if ($_SESSION['student_panel_edit_button'] !== 'no380') {
        $subdata[] = "<button type='button' onclick=\"post_content('student/student_admission','student_roll_no=$s_roll')\" class='al-act al-act-edit'><i class='fa fa-pencil'></i> " . $language['Edit'] . "</button>";
    } else {
        $subdata[] = '';
    }
    if ($_SESSION['student_panel_delete_button'] !== 'no381') {
        $subdata[] = "<button type='button' class='al-act al-act-delete' onclick=\"valid('$s_no')\"><i class='fa fa-trash'></i> " . $language['Delete'] . "</button>";
    } else {
        $subdata[] = '';
    }
    $subdata[] = "<a href='$pdf_link' target='_blank'><button type='button' class='al-act al-act-print'><i class='fa fa-print'></i> " . $language['Print'] . "</button></a>";
    $subdata[] = "<a href='$pdf_link_1' target='_blank'><button type='button' class='al-act al-act-print'><i class='fa fa-print'></i> Scholar</button></a>";

    $data[] = $subdata;
}

$json_data = [
    "draw"            => intval($request['draw'] ?? 1),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data"            => $data,
];

echo json_encode($json_data);

?>