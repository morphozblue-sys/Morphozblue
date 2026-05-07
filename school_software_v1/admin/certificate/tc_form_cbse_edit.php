<?php include("../attachment/session.php")?>
<script type="text/javascript">
      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/tc_form_cbse_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
          	////alert_new(detail);
	     	//$('#query_print').html(detail);
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
       <?php echo $language['Certificate Management']; ?>
		<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
           <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> Certificate</a></li>
      <li class="active"><?php echo $language['Tc Form']; ?></li> </ol>
    </section>


	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Tc Generate']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<?php
                           
$query="select * from school_info_class_info";
$run=mysqli_query($conn73,$query)or (mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){//print_r($row);
$class_name=$row['class_name'];
}

$s_no=$_GET['id'];
            $query1="select * from student_tc_cbse where s_no='$s_no'";
            $run1=mysqli_query($conn73,$query1);
            while($row1=mysqli_fetch_assoc($run1)){
                $tc_student_roll_no=$row1['tc_student_roll_no'];
                $tc_student_sssm_id_no=$row1['tc_student_sssm_id_no'];
                $tc_student_uid_no=$row1['tc_student_uid_no'];
                $tc_student_name=$row1['tc_student_name'];
                $tc_student_father_name=$row1['tc_student_father_name'];
                $tc_mother_name=$row1['tc_mother_name'];
                $date_of_birth=$row1['date_of_birth'];
                $date_of_birth_in_word=$row1['date_of_birth_in_word'];
                $tc_admission_no=$row1['tc_admission_no'];
                $tc_admission_date=$row1['tc_admission_date'];
                $tc_student_class=$row1['tc_student_class'];
                $tc_student_class_section=$row1['tc_student_class_section'];
                $tc_student_class_leaving=$row1['tc_student_class_leaving'];
                $class_in_which_admitted=$row1['class_in_which_admitted'];
                $date_of_school_leaving=$row1['date_of_school_leaving'];
                $region_for_leaving=$row1['region_for_leaving'];
                $tc_subject=$row1['tc_subject'];
                $due_if_any=$row1['due_if_any'];
                $conduct_and_behaviour=$row1['conduct_and_behaviour'];
                $tc_generate_no=$row1['tc_generate_no'];	
                $tc_student_category=$row1['tc_student_category'];	
                $failed_once=$row1['failed_once'];	
                $due_if_any=$row1['due_if_any'];	
                $fee_concession=$row1['fee_concession'];	
                $total_num_working=$row1['total_num_working'];	
                $num_of_days_present=$row1['num_of_days_present'];	
                $ncc_scout=$row1['ncc_scout'];	
                $games_activity=$row1['games_activity'];	
                $date_of_application=$row1['date_of_application'];	
                $nationality=$row1['nationality'];	
                $meetings_up_to_date=$row1['blank_field_1'];	
                $other_remark=$row1['other_remark'];	
                $Date_of_Stuck_off_role=$row1['blank_field_2'];	
                $result_status=$row1['blank_field_3'];	
                $tc_subject1=$row1['tc_subject1'];	
                $tc_subject2=$row1['tc_subject2'];	
                $tc_subject3=$row1['tc_subject3'];	
                $tc_subject4=$row1['tc_subject4'];	
                $tc_subject5=$row1['tc_subject5'];	
                $tc_subject6=$row1['tc_subject6'];	
            }
			?>
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			     <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" >
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tc Generate No.</label>
                            <input type="number"  name="tc_generate_no" placeholder="Tc Generate No." class="form-control" value="<?php echo $tc_generate_no;?>" >
                        </div>
                    </div>
                    
                </div>
			
			
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo $language['Student Name']; ?></label>
                        <input type="text"  name="tc_student_name" value="<?php echo $tc_student_name; ?>" placeholder="<?php echo $language['Student Name']; ?>"   id="student_name" class="form-control" readonly>
                    
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label><?php echo $language['Class']; ?></label>
                        <input type="text"  name="tc_student_class" value="<?php echo $tc_student_class; ?>" placeholder="<?php echo $language['Class']; ?>"  id="student_class" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo $language['Student Section']; ?></label>
                        <input type="text"  name="tc_student_class_section" value="<?php echo $tc_student_class_section; ?>" placeholder="<?php echo $language['Student Section']; ?>"  id="student_section" class="form-control" readonly>
                    
                    </div>
                </div>
                <div class="col-md-3 ">	
                    <div class="form-group" >
                        <label><?php echo $language['Student Roll No']; ?></label>
                        <input type="hidden"  name="tc_student_roll_no" value="<?php echo $tc_student_roll_no; ?>" placeholder=""  id="student_roll_no" class="form-control" readonly>
                        <input type="text"   value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="school_roll_no" class="form-control" readonly>
                    </div>
                </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Sssm Id No']; ?></label>
					  <input type="text"  name="tc_student_sssm_id_no" value="<?php echo $tc_student_sssm_id_no; ?>" id="tc_student_sssm_id_no" placeholder="<?php echo $language['Sssm Id No']; ?>"  value="" class="form-control"  readonly>
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Unique Id']; ?></label>
					  <input type="text"  name="tc_student_uid_no" value="<?php echo $tc_student_uid_no; ?>" id="tc_student_uid_no" placeholder="<?php echo $language['Student Unique Id']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Father Name']; ?></label>
					  <input type="text"  name="tc_student_father_name" value="<?php echo $tc_student_father_name; ?>" id="tc_student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				 <div class="col-md-3">	
				    <div class="form-group" >
					  <label><?php echo $language['Mother Name']; ?></label>
					  <input type="text"  name="tc_mother_name" id="query_print" value="<?php echo $tc_mother_name; ?>" placeholder="<?php echo $language['Mother Name']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
  				 <div class="col-md-3">	
				    <div class="form-group" >
					  <label>Student Category</label>
					  <input type="text"  name="student_category" id="query_print" value="<?php echo $tc_student_category; ?>" placeholder="Student Category"  class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth']; ?></label>
					  <input type="text"  name="date_of_birth" id="date_of_birth" value="<?php echo $date_of_birth; ?>" placeholder="<?php echo $language['Date Of Birth']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth(word)']; ?></label>
					  <input type="text"  name="date_of_birth_in_word" id="date_of_birth_in_word" value="<?php echo $date_of_birth_in_word; ?>" placeholder="<?php echo $language['Date Of Birth(word)']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label><?php echo $language['Student Admission No']; ?></label>
					  <input type="text"  name="tc_admission_no" id="tc_admission_no" value="<?php echo $tc_admission_no; ?>" placeholder="<?php echo $language['Student Admission No']; ?>"  value="" class="form-control" readonly>
					  
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Admission Date']; ?></label>
					  <input type="text"  name="tc_admission_date" id="tc_admission_date" value="<?php echo $tc_admission_date; ?>" placeholder="<?php echo $language['Admission Date']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label><?php echo $language['Class In Which Admitted']; ?></label>
					  <input type="text"  name="class_in_which_admitted" id="class_in_which_admitted" value="<?php echo $class_in_which_admitted; ?>" placeholder="<?php echo $language['Class In Which Admitted']; ?>"  value="" class="form-control" >
					 
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label><?php echo $language['Issue Date']; ?></label>
					  <input type="date"  name="date_of_school_leaving" id="date_of_school_leaving" value="<?php echo $date_of_school_leaving; ?>" placeholder="<?php echo $language['Issue Date']; ?>"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label><?php echo $language['Region For Leaving']; ?></label>
					  <input type="text"  name="region_for_leaving" value="<?php echo $region_for_leaving; ?>" placeholder="<?php echo $language['Region For Leaving']; ?>"  value="" class="form-control">
					  
					</div>
				  </div>
				 <!--   <div class="col-md-3 ">	-->
					<!--<div class="form-group" >-->
					<!-- <label> <?php echo $language['Subject']; ?></label>-->
					<!--  <input type="text"  name="tc_subject" value="<?php echo $tc_subject; ?>" placeholder="<?php echo $language['Subject']; ?>"  value="" class="form-control">-->
					<!--</div>-->
				 <!-- </div>-->
				    <div class="col-md-3 ">	
    					<div class="form-group" >
    					<label><?php echo $language['Class In Which Leaving']; ?></label>
    					  <input type="text"  name="tc_student_class_leaving" value="<?php echo $tc_student_class_leaving; ?>" id="tc_student_class_leaving" placeholder="<?php echo $language['Class In Which Leaving']; ?>"  value="" class="form-control" >
    					</div>
				    </div>
				    <div class="col-md-3">	
    					<div class="form-group" >
    					<label>Wheather failed Once/Twice</label>
    					  <input type="text"  name="failed_once" value="<?php echo $failed_once; ?>" id="failed_once" placeholder="Wheather failed Once/Twice"  value="" class="form-control" >
    					</div>
				    </div>
				    <div class="col-md-3">	
    					<div class="form-group" >
    					<label>School Dues</label>
    					  <input type="text"  name="due_if_any" value="<?php echo $due_if_any; ?>" id="due_if_any" placeholder="due if any" class="form-control" >
    					</div>
				    </div>
				   <div class="col-md-3">	
					<div class="form-group" >
					 <label>Any Fee Concession</label>
					  <input type="text"  name="fee_concession" value="<?php echo $fee_concession; ?>" placeholder="fee concession"  class="form-control">
					</div>
				  </div>
  				   <div class="col-md-3">	
					<div class="form-group" >
					 <label>Total Number Of Working Days</label>
					  <input type="text"  name="total_number_of_working_days" value="<?php echo $total_num_working; ?>" placeholder="number of working days"  class="form-control">
					</div>
				  </div>
				  
				   <div class="col-md-3">	
					<div class="form-group" >
					 <label>Number Of Days Present</label>
					  <input type="text"  name="num_of_days_present" value="<?php echo $num_of_days_present; ?>" placeholder="number of Present days"  class="form-control">
					</div>
				  </div>
				  
  				   <div class="col-md-3">	
					<div class="form-group" >
					 <label>Wheather Ncc/Scout/Guide</label>
					  <input type="text"  name="ncc_scout" value="<?php echo $ncc_scout; ?>" placeholder="NCC Scout"  class="form-control">
					</div>
				  </div>
				  
			    <div class="col-md-3">	
					<div class="form-group" >
					 <label>Games Played Or Extra Activity</label>
					  <input type="text"  name="games_activity" value="<?php echo $games_activity; ?>" placeholder="Games Activity"  class="form-control">
					</div>
				  </div>

				   <div class="col-md-3">	
					<div class="form-group" >
					   <label><?php echo $language['Conduct And Behaviour']; ?></label>
					  <input type="text"  name="conduct_and_behaviour" value="<?php echo $conduct_and_behaviour; ?>" placeholder="<?php echo $language['Conduct And Behaviour']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  
  				   <div class="col-md-3">	
					<div class="form-group" >
					   <label>Date Of Application For Certificate</label>
					  <input type="text"  name="date_of_application" value="<?php echo $date_of_application; ?>" placeholder="Date of Application"  value="" class="form-control">
					</div>
				  </div>
				  
				   <div class="col-md-3">	
					<div class="form-group" >
					   <label>Nationality</label>
					  <input type="text"  name="nationality" value="<?php echo $nationality; ?>" placeholder="Nationality" class="form-control">
					</div>
				  </div>
  				   <div class="col-md-3">
  				       

    

                        <?php
                 if($_SESSION['software_link']=='drhsskgn' || $_SESSION['software_link']=='rukmaniacademybistan' || $_SESSION['software_link']=='rukmaniacdemybarwani'){ ?>
					<div class="form-group">
					   <label>Book No</label>
					  <input type="text"  name="meetings_up_to_date" value="<?php echo $meetings_up_to_date; ?>" placeholder="Please Fill...." class="form-control">
					</div>
				<?php	}else { ?>
					<div class="form-group">
					   <label>Meetings up to date</label>
					  <input type="text"  name="meetings_up_to_date" value="<?php echo $meetings_up_to_date; ?>" placeholder="Please Fill...." class="form-control">
					</div>
				<?php	} ?>
                     	
					
				  </div>
				  
				   <div class="col-md-3">	
					<div class="form-group">
					   <label>Any Other Remark</label>
					  <input type="text"  name="other_remark" value="<?php echo $other_remark; ?>" placeholder="other remark" class="form-control">
					</div>
				  </div>
				  
  			    <div class="col-md-3">	
					<div class="form-group">
					    <?php 
					    if($_SESSION['software_link']=='shiningstarsiwan'){?>
					   <label>Date of Leaving</label>
					   <?php }
					   else
					   {
					   ?>
					   <label>Date of Stuck off the role</label>
					   <?php }?>
					  <input type="date"  name="Date_of_Stuck_off_role" value="<?php echo $Date_of_Stuck_off_role; ?>" placeholder="Date of Stuck off the role" class="form-control">
					</div>
				  </div>
				  
		        <div class="col-md-3">	
					<div class="form-group">
					    
					   <label>Result status</label>
					   
					  <input type="text"  name="result_status" value="<?php echo $result_status; ?>" placeholder="Result Status" class="form-control">
					</div>
				  </div>
				  
  		        <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 1</label>
					  <input type="text"  name="tc_subject1" value="<?php echo $tc_subject1; ?>" placeholder="Subject 1" class="form-control">
					</div>
				 </div>
				 
   		        <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 2</label>
					  <input type="text"  name="tc_subject2" value="<?php echo $tc_subject2; ?>" placeholder="Subject 2" class="form-control">
					</div>
				 </div>
				 
		        <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 3</label>
					  <input type="text"  name="tc_subject3" value="<?php echo $tc_subject3; ?>" placeholder="Subject 3" class="form-control">
					</div>
				 </div>
				 
 		        <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 4</label>
					  <input type="text"  name="tc_subject4" value="<?php echo $tc_subject4; ?>" placeholder="Subject 4" class="form-control">
					</div>
				 </div>
				 
  		        <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 5</label>
					  <input type="text"  name="tc_subject5" value="<?php echo $tc_subject5; ?>" placeholder="Subject 5" class="form-control">
					</div>
				 </div>
				 
				    <div class="col-md-3">	
					<div class="form-group">
					   <label>Subject 6</label>
					  <input type="text"  name="tc_subject6" value="<?php echo $tc_subject6; ?>" placeholder="Subject 6" class="form-control">
					</div>
				 </div>
				 
				  
				 <!--  <div class="col-md-3">	-->
					<!--<div class="form-group" >-->
					<!--  <label>Student Uid No.</label>-->
					<!--  <input type="text"  name="tc_student_uid_no" id="tc_student_uid_no" value="<?php //echo $tc_student_uid_no;?>" class="form-control" >-->
					<!--</div>-->
				 <!-- </div>-->
				   
				  
                <div class="col-md-12">
                <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
                </div>

			
				
		</form>	
	
	</div>

          </div>
    </div>
</section>
<script>
$('.select2').select2();
</script>

  