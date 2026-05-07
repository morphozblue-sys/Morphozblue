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
              url: "ajax_search_student_box_tc.php?id="+value+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
          $("#tc_student_father_name").val(res[3]);  
          $("#tc_mother_name").val(res[4]);  
          $("#date_of_birth").val(res[5]);  
          $("#date_of_birth_in_word").val(res[6]);  
          $("#tc_student_sssm_id_no").val(res[7]);  
          $("#tc_admission_date").val(res[8]);  
          $("#tc_admission_no").val(res[9]);
          $("#school_roll_no").val(res[10]);
          $("#class_in_which_admitted").val(res[11]);  
          $("#tc_student_class_leaving").val(res[12]);  
          $("#tc_student_uid_no").val(res[13]);  
        
      
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
      <li class="active">Sport Form</li> </ol>
    </section>


	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> Tc Generate</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<?php
                           
						   $query="select * from school_info_class_info";
						   $run=mysqli_query($conn73,$query)or (mysqli_error($conn73));
						   while($row=mysqli_fetch_assoc($run)){
						         $class_name=$row['class_name'];
								 }
								 ?>
			<form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label>Search Student</label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" required>
					  <option value="">Select student</option>
					        <?php
							
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$school_roll_no=$row22['school_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							$student_mother_name=$row22['student_mother_name'];
							$student_date_of_birth=$row22['student_date_of_birth'];
							
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$school_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
			</div>
			
			
			<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Name</label>
						   <input type="text"  name="tc_student_name" value="" placeholder="Student Name"   id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Class</label>
						   <input type="text"  name="tc_student_class" value="" placeholder="Student Class"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text"  name="tc_student_class_section" value="" placeholder="Student Section"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Student Roll No.</label>
					  <input type="hidden"  name="tc_student_roll_no" value="" placeholder="student Roll No."  id="student_roll_no" class="form-control" readonly>
					  <input type="text"   value="" placeholder="student Roll No."  id="school_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>SSSM ID No.</label>
					  <input type="text"  name="tc_student_sssm_id_no" id="tc_student_sssm_id_no" placeholder="Penalty Amount"  value="" class="form-control"  readonly>
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label>Student Uid No.</label>
					  <input type="text"  name="tc_student_uid_no" id="tc_student_uid_no" placeholder="Penalty reason"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Father's Name</label>
					  <input type="text"  name="tc_student_father_name" id="tc_student_father_name" placeholder="Penalty remark"  value="" class="form-control" readonly>
					</div>
				  </div>
				<div class="col-md-3 ">	
				<div class="form-group" >
					  <label>Mother's Name</label>
					  <input type="text"  name="tc_mother_name" id="tc_mother_name" placeholder="Penalty remark"  value="" class="form-control" readonly>
					</div>
					
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth</label>
					  <input type="text"  name="date_of_birth" id="date_of_birth" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth(word)</label>
					  <input type="text"  name="date_of_birth_in_word" id="date_of_birth_in_word" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Student Admission No.</label>
					  <input type="text"  name="tc_admission_no" id="tc_admission_no" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					  
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Admission Date</label>
					  <input type="text"  name="tc_admission_date" id="tc_admission_date" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Class In Which  Admitted</label>
					  <input type="text"  name="class_in_which_admitted" id="class_in_which_admitted" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					 
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Issue Date</label>
					  <input type="date"  name="date_of_school_leaving" id="date_of_school_leaving" placeholder="Penalty Amount"  value="" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Region For Leaving</label>
					  <input type="text"  name="region_for_leaving" placeholder="Penalty Amount"  value="" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					 <label> subject</label>
					  <input type="text"  name="tc_subject" placeholder="Penalty Amount"  value="" class="form-control">
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>class in which leaving</label>
					  <input type="text"  name="tc_student_class_leaving" id="tc_student_class_leaving" placeholder="Penalty Amount"  value="" class="form-control" readonly>
					  
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Due If Any</label>
					  <input type="text"  name="due_if_any" placeholder="Penalty Amount"  value="" class="form-control">
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Conduct And Behaviour</label>
					  <input type="text"  name="conduct_and_behaviour" placeholder="Penalty Amount"  value="" class="form-control">
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
  
  
  
    $query="insert into student_tc(tc_student_roll_no,tc_student_sssm_id_no,tc_student_uid_no,tc_student_name,tc_student_father_name,tc_mother_name,date_of_birth,date_of_birth_in_word,tc_admission_no,tc_admission_date,tc_student_class,tc_student_class_leaving,tc_student_class_section,class_in_which_admitted,date_of_school_leaving,region_for_leaving,tc_subject,due_if_any,conduct_and_behaviour,session_value,$update_by_insert_sql_column) values ('$tc_student_roll_no','$tc_student_sssm_id_no','$tc_student_uid_no','$tc_student_name','$tc_student_father_name','$tc_mother_name','$date_of_birth','$date_of_birth_in_word','$tc_admission_no','$tc_admission_date','$tc_student_class','$tc_student_class_leaving','$tc_student_class_section','$class_in_which_admitted','$date_of_school_leaving','$region_for_leaving','$tc_subject','$due_if_any','$conduct_and_behaviour',$session1,$update_by_insert_sql_value)";
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