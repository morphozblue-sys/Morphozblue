<?php include("../attachment/session.php");?>
<style>
#staff_company {
    padding: 15px;
    width: 100%;
    height: 300px;
    overflow: scroll;
    border: 1px solid #ccc;
}
</style>
<div id="staff_company">
<table id="example1" class="table table-bordered table-striped">
		<thead >
		<tr>
	    <th>All<br/><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Name</th>
        <th>Class</th>
        <th>Section</th>
        <th>Gender</th>
        <th>Addm No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>DOB</th>
        <th>Age Category</th>
        <th style="width:200px;">Actual Age As Per In(YY-MM-DD)</th>
        </tr>
        </thead>
        <tbody>
		<?php
		function Get_Date_Difference($start_date, $end_date)
    {
        $diff = abs(strtotime($end_date) - strtotime($start_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $inword = $years.' Years '.$months.' Month '.$days.' Days';
		return $inword;
    }
	$date_search=$_GET['date_search'];

    $age_category=$_GET['age_category'];
	$current_date= date('Y-m-d');
	$current_date_d= date('d');
	$current_date_m= date('m');
	$current_date_y= date("Y");
	$student_age=$current_date_y-$age_category;
    $student_dob=$student_age.'-'.$current_date_m.'-'.$current_date_d;		
		if($age_category==0){
	$condition3="";
	}else{
	$condition3=" and student_date_of_birth >='$student_dob'";
	}
	
$student_class11=$_GET['student_class'];
if($student_class11!=''){
if($student_class11!='All'){
$condition2=" and student_class='$student_class11'";
}else{
$condition2="";
}
}else{
$condition2="";
}

$gender=$_GET['gender'];
if($gender!=''){
if($gender!='All'){
$condition1=" and student_gender='$gender'";
}else{
$condition1="";
}
}else{
$condition1="";
}

$sports_name=$_GET['sports_name'];
if($sports_name=='All'){
$condition4="";
}elseif($sports_name=='Non_Sport'){
$condition4=" and sports_name=''";
}else{
$condition4=" and sports_name='$sports_name'";
}

$query1="select * from student_admission_info where s_no!=''$condition3$condition2$condition1$condition4 and session_value='$session1' order By s_no";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no1=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_class_section = $row['student_class_section'];
	$student_gender = $row['student_gender'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_date_of_birth = $row['student_date_of_birth'];
	$session_value = $row['session_value'];
   
 $serial_no++;
 $StartDate=$student_date_of_birth;
 $EndDate=$date_search;

 $words = Get_Date_Difference($StartDate,$EndDate);	
?>

  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no1; ?>" name="student_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $student_name; ?></td>
	<td><?php echo $student_class; ?></td>
	<td><?php echo $student_class_section; ?></td>
    <td><?php echo $student_gender; ?></td>
    <td><?php echo $student_admission_number; ?></td>
    <td><?php echo $student_father_name; ?></td>
    <td><?php echo $student_mother_name; ?></td>
    <td><?php echo $student_date_of_birth; ?></td>
    <td><?php echo "Under ".$age_category; ?></td>
    <td><?php echo $words; ?></td>
  </tr>
	<?php  $serial_no1++; } ?>
     </tbody>
     </table>
	 </div>
	 <div class="col-md-12">
			<center><button type="button" class="btn btn-success" onclick="post_content('sports/download_category_list','<?php echo 'age_category='.$age_category.'&student_class='.$student_class11.'&gender='.$gender.'&date_search='.$date_search; ?>')" >Print</button></center>
	 </div>
<script>
$(function(){
$('#example1').DataTable()
})
</script>