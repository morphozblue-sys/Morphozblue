<?php include("../attachment/session.php")?> <!DOCTYPE html>
<html>
<head>
  <?php include("../attachment/link_css.php")?>
  <?php include("../attachment/link_js.php")?>

</head>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_search_student_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
          $("#student_roll_no").val(res[3]);  
        
      
              }
           });

    }
</script>  
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>


  
  
  

  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Certificate Management
		<small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="certificate.php"><i class="fa fa-certificate"></i> Certificate</a></li>
      <li class="active">TC Generate</li> </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Student Penalty From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
						<?php
                           
						    $id=$_GET['student_roll_no1'];
						   
						   $query="select * from student_admission_info where student_roll_no='$id' and session_value='$session1' ";
						   $run=mysqli_query($conn73,$query)or (mysqli_error($conn73));
						   while($row=mysqli_fetch_assoc($run)){
						         $student_roll_no=$row['student_roll_no'];
						         $student_name=$row['student_name'];
						         $student_class=$row['student_class'];
						         $student_class_section=$row['student_class_section'];
						         $student_father_name=$row['student_father_name'];
						         $student_mother_name=$row['student_mother_name'];
						         $student_date_of_birth=$row['student_date_of_birth'];
						         $student_date_of_birth_in_word=$row['student_date_of_birth_in_word'];
						         $student_religion=$row['student_religion'];
						         $student_category=$row['student_category'];
						         $student_sssmid_number=$row['student_sssmid_number'];
						         $student_date_of_admission=$row['student_date_of_admission'];
						         $student_admission_number=$row['student_admission_number'];
						         $student_religion=$row['student_religion'];
						         $student_adhar_number=$row['student_adhar_number'];
						         $school_roll_no=$row['school_roll_no'];
						         $student_admission_class=$row['student_previous_class'];
								 }
								 ?>
			<form role="form" method="post" enctype="multipart/form-data">
			
			
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Name</label>
						   <input type="text"  name="tc_student_name" value="<?php echo $student_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Class</label>
						   <input type="text"  name="tc_student_class" value="<?php echo $student_class; ?>" placeholder="Student Class"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text"  name="tc_student_class_section" value="<?php echo $student_class_section; ?>" placeholder="Student Section"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-3 " style="display:none">	
					<div class="form-group" >
					  <label>Student Roll No.</label>
					  <input type="text"  name="tc_student_roll_no" value="<?php echo $student_roll_no; ?>" placeholder="student Roll No."  id="student_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>SSSM ID No.</label>
					  <input type="text"  name="tc_student_sssm_id_no" placeholder="SSSM ID No."  value="<?php echo $student_sssmid_number; ?>" class="form-control"  readonly>
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label>Student Uid No.</label>
					  <input type="text"  name="tc_student_uid_no" placeholder="Student Uid No"  value="<?php echo $student_adhar_number; ?>" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Father's Name</label>
					  <input type="text"  name="tc_student_father_name" placeholder="Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly>
					</div>
				  </div>
				<div class="col-md-3 ">	
				<div class="form-group" >
					  <label>Mother's Name</label>
					  <input type="text"  name="tc_mother_name" placeholder="Mother's Name"  value="<?php echo $student_mother_name; ?>" class="form-control" readonly>
					</div>
					
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth</label>
					  <input type="text"  name="date_of_birth" placeholder="Date Of Birth"  value="<?php echo $student_date_of_birth; ?>" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth(word)</label>
					  <input type="text"  name="date_of_birth_in_word" placeholder="Date Of Birth(word)"  value="<?php echo $student_date_of_birth_in_word; ?>" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Student Admission No.</label>
					  <input type="text"  name="tc_admission_no" placeholder="Student Admission No."  value="<?php echo $student_admission_number; ?>" class="form-control" readonly>
					  
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Admission Date</label>
					  <input type="text"  name="tc_admission_date" placeholder="Admission Date"  value="<?php echo $student_date_of_admission; ?>" class="form-control" readonly>
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Class In Which  Admitted</label>
					  <input type="text"  name="class_in_which_admitted" placeholder="Class In Which  Admitted"  value="<?php echo $student_admission_class; ?>" class="form-control">
					 
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Issue Date </label>
					  <input type="date"  name="date_of_school_leaving" placeholder="Issue Date "  value="" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Region For Leaving</label>
					  <input type="text"  name="region_for_leaving" placeholder="Region For Leaving"  value="" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					 <label> Subject</label>
					  <input type="text"  name="tc_subject" placeholder="Subject"  value="" class="form-control">
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>class in which leaving</label>
					  <input type="text"  name="tc_student_class_leaving" placeholder="class in which leaving"  value="<?php echo $student_class; ?>" class="form-control">
					  
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Due If Any</label>
					  <input type="text"  name="due_if_any" placeholder="Due If Any"  value="" class="form-control">
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Conduct And Behaviour</label>
					  <input type="text"  name="conduct_and_behaviour" placeholder="Conduct And Behaviour"  value="" class="form-control">
					</div>
				  </div>
				 
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 
					</div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					 
					</div>
				  </div>
				   <div class="col-md-4 ">	
					<div class="form-group" >
					
					</div>
				  </div>
				   <div class="col-md-4 ">	
					<div class="form-group" >
					 
					</div>
				  </div>
				   
				  
				  <div class="col-md-12">
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				
				</div>
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>

</body>
</html>
<?php

if(isset($_POST["finish"])){
  $tc_student_roll_no=$_POST['tc_student_roll_no'];
  $tc_student_sssm_id_no=$_POST['tc_student_sssm_id_no'];
  $tc_student_uid_no=$_POST['tc_student_uid_no'];
  $tc_student_name=$_POST['tc_student_name'];
  $tc_student_father_name=$_POST['tc_student_father_name'];
  $tc_mother_name=$_POST['tc_mother_name'];
  $date_of_birth=$_POST['date_of_birth'];
  $date_of_birth_in_word=$_POST['date_of_birth_in_word'];
  $tc_admission_no=$_POST['tc_admission_no'];
  $tc_admission_date=$_POST['tc_admission_date'];
  $tc_student_class=$_POST['tc_student_class'];
  $tc_student_class_section=$_POST['tc_student_class_section'];
  $tc_student_class_leaving=$_POST['tc_student_class_leaving'];
  $class_in_which_admitted=$_POST['class_in_which_admitted'];
  $date_of_school_leaving=$_POST['date_of_school_leaving'];
  $region_for_leaving=$_POST['region_for_leaving'];
  $tc_subject=$_POST['tc_subject'];
  $due_if_any=$_POST['due_if_any'];
  $conduct_and_behaviour=$_POST['conduct_and_behaviour'];
  
  
  
    $query="insert into student_tc(tc_student_roll_no,tc_student_sssm_id_no,tc_student_uid_no,tc_student_name,tc_student_father_name,tc_mother_name,date_of_birth,date_of_birth_in_word,tc_admission_no,tc_admission_date,tc_student_class,tc_student_class_leaving,tc_student_class_section,class_in_which_admitted,date_of_school_leaving,region_for_leaving,tc_subject,due_if_any,conduct_and_behaviour,session_value,$update_by_insert_sql_column) values ('$tc_student_roll_no','$tc_student_sssm_id_no','$tc_student_uid_no','$tc_student_name','$tc_student_father_name','$tc_mother_name','$date_of_birth','$date_of_birth_in_word','$tc_admission_no','$tc_admission_date','$tc_student_class','$tc_student_class_leaving','$tc_student_class_section','$class_in_which_admitted','$date_of_school_leaving','$region_for_leaving','$tc_subject','$due_if_any','$conduct_and_behaviour','$session1',$update_by_insert_sql_value)";
  mysqli_query($conn73,$query);
	echo "<script>window.open('tc_list.php','_self')</script>";
	
	}
	
	?>
	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>