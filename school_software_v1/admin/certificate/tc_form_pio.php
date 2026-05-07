<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function fill_detail(value){
        $.ajax({
			  address: "POST",
              url: access_link+"certificate/ajax_search_student_box_tc.php?id="+value+"",
              cache: false,
              success: function(detail){

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
          $("#total_num_working").val(res[16]);  
          $("#num_of_days_present").val(res[17]);  
        //   $("#tc_generate_no").val(res[18]);  
       
      
              }
           });

    }
		      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/tc_form_api_pio.php",
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
				   get_content('certificate/tc_list');
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
						   while($row=mysqli_fetch_assoc($run)){
						         $class_name=$row['class_name'];
								 }
								 ?>
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label><?php echo $language['Search Student']; ?></label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" style="width:100%" required>
					  <option value="">Select student</option>
					  <?php 
					  $qry2="select * from login";
							$rest2=mysqli_query($conn73,$qry2);
							while($row2=mysqli_fetch_assoc($rest2)){
							$tc_generate_no=$row2['tc_generate_no'];
							}
							?>
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
							$student_admission_number=$row22['student_admission_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-[".$school_roll_no."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
				<div class="col-md-3">
				<div class="form-group">
						  <label>Tc Generate No.</label>
						   <input type="text"  id="tc_generate_no" name="tc_generate_no" value="<?php echo $tc_generate_no;?>" placeholder="Tc Generate No." class="form-control" >
				</div>
				</div>
				</div>
			
			
			<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="tc_student_name" value="" placeholder="<?php echo $language['Student Name']; ?>"   id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="tc_student_class" value="" placeholder="<?php echo $language['Class']; ?>"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Section']; ?></label>
						   <input type="text"  name="tc_student_class_section" value="" placeholder="<?php echo $language['Student Section']; ?>"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Roll No']; ?></label>
					  <input type="hidden"  name="tc_student_roll_no" value="" placeholder=""  id="student_roll_no" class="form-control" readonly>
					  <input type="text"   value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="school_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Sssm Id No']; ?></label>
					  <input type="text"  name="tc_student_sssm_id_no" id="tc_student_sssm_id_no" placeholder="<?php echo $language['Sssm Id No']; ?>"  value="" class="form-control"  readonly>
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Unique Id']; ?></label>
					  <input type="text"  name="tc_student_uid_no" id="tc_student_uid_no" placeholder="<?php echo $language['Student Unique Id']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Father Name']; ?></label>
					  <input type="text"  name="tc_student_father_name" id="tc_student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				<div class="col-md-3 ">	
				<div class="form-group" >
					  <label><?php echo $language['Mother Name']; ?></label>
					  <input type="text"  name="tc_mother_name" id="tc_mother_name" placeholder="<?php echo $language['Mother Name']; ?>"  value="" class="form-control" readonly>
					</div>
					
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth']; ?></label>
					  <input type="text"  name="date_of_birth" id="date_of_birth" placeholder="<?php echo $language['Date Of Birth']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth(word)']; ?></label>
					  <input type="text"  name="date_of_birth_in_word" id="date_of_birth_in_word" placeholder="<?php echo $language['Date Of Birth(word)']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label><?php echo $language['Student Admission No']; ?></label>
					  <input type="text"  name="tc_admission_no" id="tc_admission_no" placeholder="<?php echo $language['Student Admission No']; ?>"  value="" class="form-control" readonly>
					  
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Admission Date']; ?></label>
					  <input type="text"  name="tc_admission_date" id="tc_admission_date" placeholder="<?php echo $language['Admission Date']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label><?php echo $language['Class In Which Admitted']; ?></label>
					  <input type="text"  name="class_in_which_admitted" id="class_in_which_admitted" placeholder="<?php echo $language['Class In Which Admitted']; ?>"  value="" class="form-control" >
					 
					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label><?php echo $language['Issue Date']; ?></label>
					  <input type="date"  name="date_of_school_leaving" id="date_of_school_leaving" placeholder="<?php echo $language['Issue Date']; ?>"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
					  
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label><?php echo $language['Region For Leaving']; ?></label>
					  <input type="text"  name="region_for_leaving" placeholder="<?php echo $language['Region For Leaving']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label> paid Month</label>
					  <input type="text"  name="paid_month" id="paid_month"  value="" class="form-control" placeholder='enter paid month'>
					  </div>
				  </div>
				  
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Any Fee Concession</label>
					  <input type="text"  name="any_fee_concession" id="any_fee_concession"  value="" class="form-control" placeholder='any fees concession'>
					  </div>
				  </div>
				 
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Wheather Ncc/Scout/Guide</label>
					  <input type="text"  name="wheather_ncc_scount_guide" id="wheather_ncc_scount_guide"  value="" class="form-control" placeholder='Yes/No'>
					  </div>
				  </div>
				  
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Games Played Or Extra Activity</label>
					  <input type="text"  name="Games_Played_Or_Extra_Activity" id="Games_Played_Or_Extra_Activity"  value="" class="form-control" placeholder='Yes/No'>
					  </div>
				  </div>

				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Total Num working</label>
					  <input type="text"  name="total_num_working" id="total_num_working" class="form-control" placeholder='Total Num Working'>
					  </div>
				  </div>
				  
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Num of days present </label>
					  <input type="text"  name="num_of_days_present" id="num_of_days_present" class="form-control" placeholder='Total Num Present days'>
					  </div>
				  </div>
				  
				  <div class="col-md-3">	
					<div class="form-group" >
					 <label>Result status</label>
					  <input type="text"  name="result_status" id="result_status"  value="" class="form-control" placeholder='result status pass,fail'>
					  </div>
				  </div>
				  
				    <div class="col-md-3 ">	
					<div class="form-group" >
					 <label> <?php echo $language['Subject']; ?></label>
					  <input type="text"  name="tc_subject" placeholder="<?php echo $language['Subject']; ?>"  value="" class="form-control">
					</div>
				  </div>
				    <div class="col-md-3 ">	
					<div class="form-group" >
					<label><?php echo $language['Class In Which Leaving']; ?></label>
					  <input type="text"  name="tc_student_class_leaving" id="tc_student_class_leaving" placeholder="<?php echo $language['Class In Which Leaving']; ?>"  value="" class="form-control" readonly>

					</div>
				  </div>
				   <div class="col-md-3 ">	
					<div class="form-group" >
					 <label><?php echo $language['Due If Any']; ?></label>
					  <input type="text"  name="due_if_any" placeholder="<?php echo $language['Due If Any']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					 <label>Due Date</label>
                         <input type="date"  name="due_date" id="due_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				  </div>	
				   <div class="col-md-3 ">	
					<div class="form-group" >
					   <label><?php echo $language['Conduct And Behaviour']; ?></label>
					  <input type="text"  name="conduct_and_behaviour" placeholder="<?php echo $language['Conduct And Behaviour']; ?>"  value="" class="form-control">
					</div>
				  </div>
				 <div class="col-md-3 ">	
					<div class="form-group" >
					   <label><?php echo "Date Of Application"; ?></label>
					  <input type="date"  name="date_of_application" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  
				 <div class="col-md-3 ">	
					<div class="form-group" >
					   <label><?php echo "Any Other Remark"; ?></label>
					  <input type="text"  name="any_other_remark" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  
				  
				  
				  
				  
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA1"; ?></label>
					  <input type="text"  name="any_other_remark1" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA2"; ?></label>
					  <input type="text"  name="any_other_remark2" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA3"; ?></label>
					  <input type="text"  name="any_other_remark3" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA4"; ?></label>
					  <input type="text"  name="any_other_remark4" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA5"; ?></label>
					  <input type="text"  name="any_other_remark5" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				  
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA6"; ?></label>
					  <input type="text"  name="any_other_remark6" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				   
				   
				   <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA7"; ?></label>
					  <input type="text"  name="any_other_remark7" placeholder=""  value="" class="form-control">
					</div>
				  </div>			
				  
				  
				  <div class="col-md-1 ">	
					<div class="form-group" >
					   <label><?php echo "DOA8"; ?></label>
					  <input type="text"  name="any_other_remark8" placeholder=""  value="" class="form-control">
					</div>
				  </div>
				   
				  
				  <div class="col-md-12">
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				
				</div>
				
			
				
		</form>	
		<div class="col-md-12" id="query_print">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<script>
    $('.select2').select2();

</script>

  