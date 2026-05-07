<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
   function fill_detail(value){
          $("#student_name").val('Loading....'); 
		  $("#student_class").val('Loading....'); 
          $("#student_section").val('Loading....');  
          $("#tc_student_father_name").val('Loading....'); 
          $("#tc_mother_name").val('Loading....'); 
          $("#date_of_birth").val('Loading....');  
          $("#date_of_birth_in_word").val('Loading....'); 
          $("#tc_student_sssm_id_no").val('Loading....');  
          $("#tc_admission_date").val('Loading....'); 
          $("#tc_admission_no").val('Loading....'); 
          $("#school_roll_no").val('Loading....'); 
          $("#class_in_which_admitted").val('Loading....'); 
          $("#tc_student_class_leaving").val('Loading....'); 
          $("#tc_student_uid_no").val('Loading....');  
          $("#student_category").val('Loading....'); 
			$.ajax({
			  address: "POST",
              url: access_link+"certificate/ajax_search_student_box_tc.php?id="+value+"",
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
          $("#student_category").val(res[14]);  
          $("#total_num_working").val(res[16]);  
          $("#num_of_days_present").val(res[17]);  
        
      
              }
           });

    }
		      $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
  window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/tc_form_cbse_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			 ////alert_new(detail);
			 //$("#print").html(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('certificate/tc_list_cbse');
            }
			}
         });
      });
</script>   

    <section class="content-header">
      <h1>
        Certificate Management
		<small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> Certificate</a></li>
      <li class="active">TC Form</li> </ol>
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
    <!------------------------------------------------Start Registration form------------------------------>
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body">
			
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label>Search Student</label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" required>
					  <option value="">Select student</option>
					        <?php
if(isset($_GET['student_roll_no1'])){
    $student_roll_no1=$_GET['student_roll_no1'];
}else{
 $student_roll_no1='';
}


							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'";
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
							$student_admission_number=$row22['student_admission_number'];
							?>
							<option <?php if($student_roll_no1==$student_roll_no){ echo 'selected'; } ?> value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-[".$school_roll_no."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
				
				<div class="col-md-3">
				<div class="form-group">
						  <?php
						  $qry1="select * from login";
						  $rest1=mysqli_query($conn73,$qry1);
						  while($row1=mysqli_fetch_assoc($rest1)){
						  $tc_generate_no=$row1['tc_generate_no'];
						  if($tc_generate_no=='0'){
						      $tc_generate_no=1;
						  }
						  }
						  ?>
						  <label>Tc Generate No.</label>
						   <input type="number"  name="tc_generate_no" value="<?php echo $tc_generate_no; ?>" placeholder="Tc Generate No." class="form-control">
						    <input type="hidden"  id="student_roll_no1" value="<?php echo $student_roll_no1; ?>"  class="form-control" >
				</div>
				</div>
			</div>
		
				
			        <div class="col-md-3 ">
						<div class="form-group"><!---tcgenerate-no-->
						   <label>Serial No</label>
						   <input type="text"  name="serial_no" value=""   id="" class="form-control" >
					    </div>
					</div>	
					<div class="col-md-3 ">	
					   <div class="form-group" >
					      <label>Student Admission No.</label>
					      <input type="text"  name="tc_admission_no" id="tc_admission_no"   value="" class="form-control" >
					  </div>
				  </div>
					<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Name</label>
						   <input type="text"  name="tc_student_name" value=""    id="student_name" class="form-control" >
						</div>
					</div>
					<div class="col-md-3 ">	
					    <div class="form-group" >
					      <label>Father's Name</label>
					      <input type="text"  name="tc_student_father_name" id="tc_student_father_name"   value="" class="form-control" >
					    </div>
				    </div>
				    <div class="col-md-3 ">	
				        <div class="form-group" >
					      <label>Mother's Name</label>
					      <input type="text"  name="tc_mother_name" id="tc_mother_name"   value="" class="form-control" >
					    </div>
    				</div>
					<div class="col-md-3 ">	
					   <div class="form-group" >
					   <label>Student Category</label>
					   <input type="text"  name="tc_student_category" id="student_category"  value="" class="form-control" >
                       </div>
				    </div>
				    <div class="col-md-3 ">	
					    <div class="form-group" >
					    <label>Admission Date</label>
					    <input type="text"  name="tc_admission_date" id="tc_admission_date"  value="" class="form-control" >
					    </div>
				    </div>
					  <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Class In Which  Admitted</label>
					  <input type="text"  name="class_in_which_admitted" id="class_in_which_admitted"  value="" class="form-control" >
					 
					</div>
				  </div> 
					<div class="col-md-3 ">
						<div class="form-group">
						    <label>Student Class</label>
						    <input type="text"  name="tc_student_class" value=""   id="student_class" class="form-control" >
						</div>
					</div>
				    <div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text"  name="tc_student_class_section" value=""  id="student_section" class="form-control" >
						</div>
					</div>
					 <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth</label>
					  <input type="text"  name="date_of_birth" id="date_of_birth"   value="" class="form-control" >
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Date Of Birth(word)</label>
					  <input type="text"  name="date_of_birth_in_word" id="date_of_birth_in_word"  value="" class="form-control" >
					</div>
				  </div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					<label>Class in which leaving</label>
				    <input type="text"  name="tc_student_class_leaving" id="tc_student_class_leaving"   value="" class="form-control" >
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Wheather failed Once/Twice</label>
					  <input type="text"  name="failed_once" id=""   value="" class="form-control">
					  </div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>School Dues: </label>
					  <input type="text"  name="due_if_any"  value="No" class="form-control">
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Any Fee Concession </label>
					  <input type="text"  name="fee_concession"   value="No" class="form-control">
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Total Number Of Working Days</label>
					  <input type="number"  name="total_num_working" id="total_num_working"  value="" class="form-control">
					</div>
				  </div> 
				  <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Number Of Days Present</label>
					  <input type="number"  name="num_of_days_present" id="num_of_days_present"  value="" class="form-control">
					</div>
				  </div>
             <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Wheather Ncc/Scout/Guide</label>
					  <input type="text"  name="ncc_scout" id=""   value="NO" class="form-control">
					  </div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Games Played Or Extra Activity</label>
					  <input type="text"  name="games_activity" id=""  value="Yes" class="form-control">
					  </div>
				  </div>
  <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Conduct And Behaviour</label>
					  <input type="text"  name="conduct_and_behaviour"  value="Good" class="form-control">
					</div>
				  </div> 
 <div class="col-md-3 ">
                

					<div class="form-group" >
					<label>Date Of Application For Certificate</label>
					  <input type="date"  name="date_of_application" id="date_of_application"   value="<?php echo date('Y-m-d')?>" class="form-control" >
					 
					</div>
				  </div>
				  
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label>Reason For Leaving</label>
					  <input type="text"  name="region_for_leaving"   value="" class="form-control">
					  
					</div>
				  </div>
				 <div class="col-md-3 ">	
					<div class="form-group" >
					   <label>Nationality</label>
					  <input type="text"  name="nationality"   value="Indian" class="form-control">
					</div>
				  </div>
				  
				  
				  
				  <div class="col-md-3 ">
				   <?php if($_SESSION['software_link']=='drhsskgn' || $_SESSION['software_link']=='rukmaniacademybistan' || $_SESSION['software_link']=='rukmaniacdemybarwani'){ ?>	
					<div class="form-group" >
					   <label>Book No</label>
					  <input type="text"  name="meetings_up_to_date"   value="" class="form-control" placeholder="Book No">
					</div>
					<?php }else{ ?> 
					<div class="form-group" >
					   <label>Meetings up to date</label>
					  <input type="text"  name="meetings_up_to_date"   value="" class="form-control" placeholder="Meeting up to date">
					</div>
				 <?php	} ?>
				  </div>
				 
				 
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Any Other Remark</label>
					  <input type="text"  name="other_remark" id=""  value="NIL" class="form-control">
					  </div>
				  </div> 
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Issue Date</label>
					  <input type="date"  name="date_of_school_leaving" id="date_of_school_leaving"  value="<?php echo date('Y-m-d')?>" class="form-control">
					  
					</div>
				  </div>
				  
				  
				  <!--<div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Result Status</label>
					  <input type="date"  name="result_status" id="result_status"  value="<?php echo date('Y-m-d')?>" class="form-control">
					  
					</div>
				  </div>-->
				  
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <?php  if($_SESSION['software_link']=='shiningstarsiwan'){?> 
					 <label>Date of Leaving</label>
					  <input type="date"  name="Date_of_Stuck_off_role" id="Date_of_Stuck_off_role"  value="" class="form-control">
					  <?php }else{?>
					  <label>Date of Stuck off the role</label>
					  <input type="date"  name="Date_of_Stuck_off_role" id="Date_of_Stuck_off_role"  value="<?php echo date('Y-m-d')?>" class="form-control">
					  <?php } ?>
					</div>
				  </div>
				  
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Result status</label>
					  <input type="text"  name="result_status" id="result_status"  value="" class="form-control">
					  </div>
				  </div>
				  
				  
				  
					<div class="col-md-3 " style="display:none">	
					    <div class="form-group" >
					    <label>Student Roll No.</label>
					    <input type="hidden"  name="tc_student_roll_no" value="" id="student_roll_no" class="form-control" >
					   <input type="text"   value="" placeholder="student Roll No."  id="school_roll_no" class="form-control" >
					</div>
				  </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>SSSM ID No.</label>
					  <input type="text"  name="tc_student_sssm_id_no" id="tc_student_sssm_id_no"   value="" class="form-control"  >
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label>Student Uid No.</label>
					  <input type="text"  name="tc_student_uid_no" id="tc_student_uid_no"   value="" class="form-control" >
					</div>
				  </div>

				 
				 <div class="col-md-3">
					<div class="form-group" >
					 <label> Subject 1</label>
					  <input type="text"  name="tc_subject1"  value="" class="form-control">
					</div>
				   </div>
				  
				  <div class="col-md-2 ">	
					<div class="form-group" >
					 <label> Subject 2</label>
					  <input type="text"  name="tc_subject2"  value="" class="form-control">
					</div>
				  </div> 
				  <div class="col-md-2 ">	
					<div class="form-group" >
					 <label> Subject 3</label>
					  <input type="text"  name="tc_subject3"   value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-2 ">	
					<div class="form-group" >
					 <label> Subject 4</label>
					  <input type="text"  name="tc_subject4"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-2 ">	
					<div class="form-group" >
					 <label> Subject 5</label>
					  <input type="text"  name="tc_subject5"  value="" class="form-control">
					</div>
				  </div>
			     <div class="col-md-2 ">	
					<div class="form-group" >
					 <label> Subject 6</label>
					  <input type="text"  name="tc_subject6"  value="" class="form-control">
					</div>
				  </div> 
				  </div> 
				 
				  
				  <div class="col-md-12">
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				
				</div>
				
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
<script>

    var student_roll_no1=document.getElementById('student_roll_no1').value;
    if(student_roll_no1!=''){
        fill_detail(student_roll_no1);
    }
    
</script>
<script>
    $('.select2').select2();

</script>

  