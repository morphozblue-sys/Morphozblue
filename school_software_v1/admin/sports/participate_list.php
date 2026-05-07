<?php include("../attachment/session.php"); ?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"sports/delete_participate.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('sports/participate_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>	

    <section class="content-header">
      <h1>
         Sports Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"#><i class="fa fa-futbol-o"></i> Sport Management</a></li>
       <li><i class="fa fa-list"></i> Participate List</li>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Participation List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:scroll;width:100%;" >
              <table id="example1" class="table table-bordered table-striped" style="height:100px;">
                <thead  >
                <tr>
                   <th>Serial No.</th>
				   <th>Name</th>
				   <th>Class/Sec</th>
				   <th>Gender</th>
                   <th>Adm No</th>
				   <th>Father Name</th>
				   <th>Mother Name</th>
				   <th>Dob</th>
				   <th>Aadhar/Uid</th>
				   <th>Contact</th>
				   <th>Sports Name</th>
				   <th>Board Reg No</th>
				   <th>Age Category</th>
				   <th>Actual Age </th>
				   <th style="display:none;">Edit</th>
				   <th>Delete</th>
				</tr>
                </thead>
                <tbody>
                 <?php

$que="select * from sports_participate_table ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

    $s_no = $row['s_no'];
    $student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_section = $row['student_section'];
	$gender = $row['gender'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$dateofbirth = $row['dateofbirth'];
	$student_adhar_number = $row['student_adhar_number'];
	$contact_no = $row['contact_no'];
	$sports_name = $row['sports_name'];
	$board_no = $row['board_no'];
	$age_category = $row['age_category'];
	$actual_age = $row['actual_age'];
	$serial_no++;
	

	
	?>
                <tr>
                  <th><?php echo $serial_no; ?></th>
				  <th><?php echo $student_name; ?></th>
				  <th><?php echo $student_class; ?>(<?php echo $student_section; ?>)</th>
				  <th><?php echo $gender; ?></th>
				  <th><?php echo $student_admission_number; ?></th>
				  <th><?php echo $student_father_name; ?></th>
				  <th><?php echo $student_mother_name; ?></th>
				  <th><?php echo $dateofbirth; ?></th>
				  <th><?php echo $student_adhar_number; ?></th>
				  <th><?php echo $contact_no; ?></th>
				  <th><?php echo $sports_name; ?></th>
				  <th><?php echo $board_no; ?></th>
				  <th><?php echo $age_category; ?></th>
				  <th><?php echo $actual_age; ?></th>
				<th style="display:none;"><button type="button" onclick="post_content('sports/edit_participate','<?php echo 'id='.$s_no; ?>');" class="btn btn-default" >Edit</button></th>
                <th><button type="button" onclick="return valid('<?php echo $s_no; ?>');"  class="btn btn-default" >Delete</button></th>
                  </tr>
               
	<?php } ?>			
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
		  <div class="col-md-12">
		    <center><button type="button" class="btn btn-success" onclick="get_content('sports/download_participate_list');" >Print</button></center>
		  </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
$(function () {
$('#example1').DataTable()
})

</script>
