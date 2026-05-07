<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
function fill_detail(value){
			$.ajax({
			  address: "POST",
              url: "ajax_search_student_edit.php?id="+value+"",
              cache: false,
              success: function(detail){
			  
          var str =detail;
		  var res = str.split("|?|");
	      $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
          $("#student_father_name").val(res[3]);  
          $("#contact_no").val(res[4]);  
          $("#gender").val(res[5]);
          $("#dateofbirth").val(res[6]);
          $("#student_category").val(res[7]);
          $("#student_roll").val(res[8]);
          $("#session_value").val(res[9]);
		  if(res[10]!=''){
		  $("#show_student_photo").attr("src","../../documents/student/"+value+"/"+res[10]);
		  }else{
		  $("#show_student_photo").attr("src","../../documents/student/blank.jpg");
		  }
          $("#student_photo_hidden").val(res[10]);
		  $("#student_adhar_number").val(res[11]);
          $("#student_admission_number").val(res[12]);
          $("#student_scholar_number").val(res[13]);
          $("#company_name11").val(res[14]);
          $("#student_mother_name").val(res[15]);
          $("#actualdate").val(res[16]);
          $("#age_year").val(res[17]);
		   if(res[18]!=''){
		  $("#show_documents").attr("src","../../documents/student/"+value+"/"+res[18]);
		  }else{
		  $("#show_documents").attr("src","../../documents/student/blank.jpg");
		  }
          $("#dob_certificate").val(res[18]);
         ////alert_new(detail);
              }
           });

    }
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sports Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="sports.php"><i class="fa fa-futbol-o"></i> Sport Management</a></li>
	    <li><a href="participate_list.php"><i class="fa fa-list"></i>Participate List</a></li>
        <li class="active"><i class="fa fa-edit"></i> Edit Participate</li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Edit Participation From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
			
<div class="box-body">
<table id="example1" class="table table-bordered table-striped">
<form role="form" method="post" enctype="multipart/form-data">	
<?php
$id=$_GET['id'];
$que="select * from sports_participate_table where s_no='$id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){ 
	$s_no11 = $row['s_no'];
    $sports_name = $row['sports_name'];
	$school_name = $row['school_name'];
	$session_value = $row['session_value'];
	$student_roll_no = $row['student_roll_no'];
	$student_name = $row['student_name'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_adhar_number = $row['student_adhar_number'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$contact_no = $row['contact_no'];
	$board_no = $row['board_no'];
	$student_class = $row['student_class'];
	$student_section = $row['student_section'];
	$gender = $row['gender'];
	$dateofbirth = $row['dateofbirth'];
	$age_category = $row['age_category'];
	$actual_age = $row['actual_age'];
}
$query1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session_value'";
$run1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($run1)){
$student_dob_certificate = $row1['student_dob_certificate'];
$student_photo = $row1['student_photo_blob'];

$path="../../documents/student/".$student_roll_no."/".$student_photo;
$path1="../../documents/student/".$student_roll_no."/".$student_dob_certificate;

}
	
?>
			
			
			<div class="col-md-12">
                  <div class="col-md-6">
					<div class="form-group">
						<label>Sports Name<font style="color:red"><b>*</b></font></label>
						<select name="sports_name" class="form-control" required>
						<?php
						$query="select * from sports_table GROUP BY sports_name";
						$res=mysqli_query($conn73,$query);
						while($row=mysqli_fetch_assoc($res)){
						$s_no=$row['s_no'];
						$sports_name1=$row['sports_name'];
						?>
					    <option <?php if($sports_name1==$sports_name){ echo 'selected'; } ?> value="<?php echo $sports_name1; ?>"><?php echo $sports_name1; ?></option>
						<?php } ?>
						</select>
					</div>
				 </div> 
			 <div class="col-md-6">				
			<div class="form-group">
	         <label>Student Name<font size="2" style="font-weight: normal;">(Search by Name)</label>
			    <select name="" style="width:100%;" class="form-control select2" onchange="fill_detail(this.value);" >
				<option value="<?php echo $student_name; ?>"><?php echo $student_name; ?></option>
				    <?php
					$qry="select * from student_admission_info where session_value='$session1' and student_status='Active'";
					$rest=mysqli_query($conn73,$qry);
					while($row22=mysqli_fetch_assoc($rest)){
					$student_roll_no=$row22['student_roll_no'];
					$student_name=$row22['student_name'];
					$gender=$row22['student_gender'];
					$student_class=$row22['student_class'];
					$student_section=$row22['student_class_section'];
					$student_father_name=$row22['student_father_name'];
					$student_father_contact_number=$row22['student_father_contact_number'];
					$student_date_of_birth=$row22['student_date_of_birth'];
					$session_value=$row22['session_value'];
				    ?>
					<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."-".$gender."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
				    <?php } ?>
			    </select>
            </div>	
			 </div>
         </div>
	
	            <div class="col-md-3">		
				   <div class="form-group">
					  <label>School/Institute Participate</label>
					  <input type="text" name="school_name" placeholder="School Institute"  value="<?php echo $school_name; ?>" class="form-control" readonly />
				  </div>
				</div>

				<div class="col-md-3" style="display:none;">		
				   <div class="form-group">
				     <input type="text" name="session_value" id="session_value" value="<?php echo $session_value; ?>" class="form-control" readonly />
				   </div>
				</div>
				
				<div class="col-md-3" style="display:none;">		
				   <div class="form-group">
					  <label>Student Roll No</label>
					  <input type="text" name="student_roll_no" id="student_roll" placeholder="Student Roll"  value="<?php echo $student_roll_no; ?>" class="form-control"/>
				  </div>
				</div>
					
			  <div class="col-md-3">
				<div class="form-group">
					<label>Student Name</label>
					<input type="text"  name="student_name" placeholder="Student Name" value="<?php echo $student_name; ?>" id="student_name" class="form-control" readonly>
				</div>
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label>Father Name</label>
					<input type="text" name="student_father_name" id="student_father_name" placeholder="Father Name" value="<?php echo $student_father_name; ?>" class="form-control" readonly >
				</div>
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label>Mother Name</label>
					 <input type="text" name="student_mother_name" id="student_mother_name" placeholder="Mother Name" value="<?php echo $student_mother_name; ?>" class="form-control" readonly >
				</div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Aadhar/Uid No</label>
					  <input type="text" name="student_adhar_number" id="student_adhar_number" value="<?php echo $student_adhar_number; ?>" class="form-control" readonly />
			       </div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Addmission No.</label>
					<input type="text" name="student_admission_number" id="student_admission_number" value="<?php echo $student_admission_number; ?>" class="form-control" readonly />
				  </div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Scholar No.</label>
					 <input type="text" name="student_scholar_number" id="student_scholar_number" value="<?php echo $student_scholar_number; ?>" class="form-control" readonly />
			      </div>
				</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Contact Number</label>
					 <input type="text" name="contact_no" id="contact_no" placeholder="Contact No" value="<?php echo $contact_no; ?>" class="form-control" readonly >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Board Registration Number</label>
					<input type="text"  name="board_no" value="<?php echo $board_no; ?>" required placeholder="Board Registration Number"  id="" class="form-control" >
				</div>
			</div>
			  <div class="col-md-3">
				 <div class="form-group" >
				   <label>Class</font></label>
					<input type="text" name="student_class" value="<?php echo $student_class; ?>" placeholder="Student Class"  id="student_class" class="form-control" readonly>
				 </div>
			  </div> 
			  <div class="col-md-3">
				 <div class="form-group">
				   <label>Section</font></label>
					<input type="text" name="student_section" value="<?php echo $student_section; ?>" placeholder="Student Class"  id="student_section" class="form-control" readonly>
				 </div>
			  </div>
		
				 <div class="col-md-3">
					<div class="form-group">
						<label>Gender</label>
						<input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" class="form-control" readonly>
					</div>
				</div>
		
			     <div class="col-md-3">		
					  <div class="form-group">
					    <label>Date Of Birth</label>
					    <input type="date" name="dateofbirth" id="dateofbirth"  value="<?php echo $dateofbirth; ?>" class="form-control" readonly>
					  </div>
				 </div> 
			     <div class="col-md-3">		
					  <div class="form-group">
					    <label>Age Category</label>
					    <input type="text" name="age_category" id="age_year" value="<?php echo $age_category; ?>" class="form-control" readonly>
					  </div>
				 </div>
				 <div class="col-md-3">		
					  <div class="form-group">
					    <label>Actual Age</label>
					    <input type="text" name="actual_age" id="actualdate" value="<?php echo $actual_age; ?>" class="form-control" readonly>
					  </div>
				 </div> 
				 
				  <div class="col-md-3">	
					<div class="form-group">
					  <label>Student Photo</label>
					  <input type="file" name="student_photo" id="student_photo" placeholder="" onchange="check_file_type(this,'student_photo','show_student_photo','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <label>Photo</label>
					   <img src="<?php echo $path; ?>" id="show_student_photo" height="50" width="50"><input type="hidden" value="<?php echo $student_photo; ?>" name="student_photo_hidden">
					</div>
				</div>	
				<div class="col-md-3">	
					<div class="form-group">
					  <label>Dob Certificate</label>
					  <input type="file" name="document_dob" id="student_photo" placeholder="" onchange="check_file_type(this,'student_photo','show_documents','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <label>Document</label>
					   <img src="<?php echo $path1; ?>" id="show_documents" height="50" width="50"><input type="hidden" value="<?php echo $student_dob_certificate; ?>" name="dob_certificate_hidden">
					</div>
				</div>
		
	<div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" class="btn btn-primary" /></center>
	</div>
		</form>	
		</table>
	</div>

<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
  select_company();
</script>