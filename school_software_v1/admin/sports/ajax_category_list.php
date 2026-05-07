  <table id="example1" class="table table-bordered table-striped" >
                <thead >
                <tr>
                   <th>Serial No.</th>
				   <th>Name</th>
				   <th>Class/Sec</th>
				   <th>Gender</th>
                   <th>Adm/Sch No</th>
				   <th>Father Name</th>
				   <th>Mother Name</th>
				   <th>Dob</th>
				   <th>Age Category</th>
				   <th>Actual Age As Per In(YY-MM-DD)</th>
				   <th>Delete</th>
				  
                </tr>
                </thead>
                <tbody>
                 <?php
				 
$category=$_GET['category'];
if($category!=''){
if($category!='All'){
$condition2=" and age_category='$category'";
}else{
$condition2="";
}
}else{
$condition2="";
}
				 
include("../../con73/con37.php");
$que="select * from sports_age_category where s_no!=''$condition2 ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

    $s_no = $row['s_no'];
    $student_name = $row['student_name'];
	$class_section = $row['class_section'];
	$student_gender = $row['student_gender'];
	$student_adm_sch = $row['student_adm_sch'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_date_of_birth = $row['student_date_of_birth'];
	$age_category = $row['age_category'];
	$in_words = $row['in_words'];
	$serial_no++;
	
	?>
                <tr>
                  <th><?php echo $serial_no; ?></th>
				  <th><?php echo $student_name; ?></th>
				  <th><?php echo $class_section; ?></th>
				  <th><?php echo $student_gender; ?></th>
				  <th><?php echo $student_adm_sch; ?></th>
				  <th><?php echo $student_father_name; ?></th>
				  <th><?php echo $student_mother_name; ?></th>
				  <th><?php echo $student_date_of_birth; ?></th>
				  <th><?php echo $age_category; ?></th>
				  <th><?php echo $in_words; ?></th>
		          <th><button type="button" onclick="return for_delete('<?php echo $s_no; ?>');"  class="btn btn-default" >Delete</button></th>
               </tr>
               
	<?php } ?>			
                </tbody>
             </table>
<div class="col-md-12">
  <center>
	<a href="download_category_list.php?id=<?php echo $age_category; ?>"><button type="button" class="btn btn-success" >Print</button></a>
  </center>
</div>