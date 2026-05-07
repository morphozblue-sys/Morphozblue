<?php include("../attachment/session.php");
?>
 <script>
 function student_class(value)
 {
      $('#student_class_section').html("<option value='' >Loading....</option>");
	 $.ajax({
		 type:"POST",
		 url:access_link+"downloads/ajax_get_student_class.php?student_data="+value+"",
		 cache: false,
		 success:function(data2)
		 {
			$("#student_class_section").html("<option value='All'> All </option>"+data2);
		 }
	 });
 }
 function student_section(section_value)
 {
	var class_type=document.getElementById("std_category").value;
	$("#student_name").html("<option value=''>Loading.....</option>");
	 $.ajax({
		 type:"POST",
		 url:access_link+"downloads/ajax_student_name.php?student_data="+section_value+"&class2="+class_type+"",
		 cache:false,
		 success:function(student_name){
			$("#student_name").html("<option value='All'> All </option>"+student_name);
		 }
	 });
 }
 </script>
 <script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/student_tc_download_cbse.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
      }
</script>
</head>

    <section class="content-header">
      <h1>
        Downloads Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
	  <li class="active"><i class="fa fa-user-plus"></i>Student TC List</li>
      </ol>
    </section>
	

	<!---******************************************************************************************************-->
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <h3 class="box-title">Student TC Downloads</h3>
            </div>
 <div class="box-body">
 			<form role="form" method="post" id="my_form" enctype="multipart/form-data">

	<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
				<div class="col-md-12">
		         <div class="col-md-4">				
			      <div class="form-group" >
				  <th><b  style="font-size:15px">Choose Class</b></th>
				<select name="student_category" id="std_category" class="form-control" onchange="student_class(this.value);" >
				<option value="All">All</option>
				<?php 
				$select_class="SELECT * FROM school_info_class_info WHERE class_name!=''";
				$select_class_run=mysqli_query($conn73,$select_class) or die(mysqli_error($conn73));
				while($result=mysqli_fetch_assoc($select_class_run))
				{
					$student_class=$result['class_name'];
				?>
				<option value="<?php echo $student_class ?>"><?php echo $student_class ?></option>
				<?php } ?>
				</select>
				  </div>
				  </div>	
				 
				   <div class="col-md-4">
				 <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section" onchange="student_section(this.value);";>
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
					
					<div class="col-md-4">
				 <div class="form-group" >
					  <th><b style="font-size:15px">Enter Student Name</b></th>
					 <select class="form-control" name="student_name" id="student_name">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
				  </div>
				  </br></br></br>
					<hr>
					
					 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
						 
						  <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="company_name|?|Company Name" class="check_all"><th><b>Company Name</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="tc_student_roll_no|?|Student Roll No" class="check_all"><th><b>Student Roll No</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="tc_generate_no|?|TC Generate No" class="check_all"><th><b>TC Generate No</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="tc_student_sssm_id_no|?|TC Student sssm id no" class="check_all"><th><b>SSSM ID No</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="tc_student_class_section|?|Student Class Section" class="check_all"><th><b>Student Class Section</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="tc_student_uid_no|?|TC UID No" class="check_all"><th><b>TC UID No</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="tc_student_name|?|Student Name" class="check_all"><th><b>Student Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="tc_student_father_name|?|Student Father Name" class="check_all"><th><b>Student Father Name</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="tc_mother_name|?|Mother Name" class="check_all"><th><b>Mother Name</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="date_of_birth|?|Date Of Birth" class="check_all"><th><b>Date Of Birth</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_religion|?|Student Religion" class="check_all"><th><b>Student Religion</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_caste|?|Student Caste" class="check_all"><th><b>Student Caste</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_admission_no|?|Admission No" class="check_all"><th><b>Admission No</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_admission_date|?|Admission Date" class="check_all"><th><b>Admission Date</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_class|?|Student Class" class="check_all"><th><b>Student Class</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_class_leaving|?|Class Leaving" class="check_all"><th><b>Class Leaving</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_class_section|?|Class Section" class="check_all"><th><b>Class Section</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="class_in_which_admitted|?|Admitted" class="check_all"><th><b>Class Admitted</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_class_section|?|Class Section" class="check_all"><th><b>Class Section</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="date_of_school_leaving|?|Date School Leaving" class="check_all"><th><b>Date School Leaving</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="region_for_leaving|?|Region Leaving" class="check_all"><th><b>Region Leaving</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_subject|?|TC Subject" class="check_all"><th><b>TC Subject</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="due_if_any|?|Due If Any" class="check_all"><th><b>Due If Any</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="conduct_and_behaviour|?|Conduct And Behaviour" class="check_all"><th><b>Conduct And Behaviour</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="student_tc_status|?|Student TC Status" class="check_all"><th><b>Student TC Status</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="student_to_status_change_date|?|Status Change Date" class="check_all"><th><b>Status Change Date</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="tc_student_category|?|Student Category" class="check_all"><th><b>Student Category</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="class_change_by|?|Class Change By" class="check_all"><th><b>Class Change By</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="medium|?|Medium" class="check_all"><th><b>Medium</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="school|?|School" class="check_all"><th><b>School</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="board|?|Board" class="check_all"><th><b>Board</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="shift|?|Shift" class="check_all"><th><b>Shift</b></th>
						</div>
					</div>
					
				  <div class="col-md-12">
		   <center><input type="button" name="submit" value="Submit" onclick="form_submit();" class="btn btn-primary"></center>
		   </div>
                </div>
		 </form>
			 </div>
            <!-- /.box-body -->
          </div>
		 
          <!-- /.box -->
        </div>
		</form>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
   
<script>
function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}
function for_validity(){
var num2=0;
$(".check_all").each(function() {
if($(this).prop('checked')==true){ 
	num2 += Number(parseInt(num2)+1);
}
});
if(num2<1){
alert_new('Please Select Atleast One Field !!!','red');
return false;
}else{
	form_submit();
return true;
}
}
</script>


