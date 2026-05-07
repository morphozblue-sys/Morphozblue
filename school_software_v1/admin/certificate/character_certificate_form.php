<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function fill_detail(value){
     
		  var res = value.split("|?|");
		 $("#student_roll_no").val(res[0]); 
		  $("#student_name").val(res[1]); 
		  $("#student_father_name").val(res[2]);
          $("#school_roll_no").val(res[3]);
              
       

    }
		      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/character_certificate_form_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('certificate/character_certificate_list');
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
      <li class="active"><?php echo $language['Character Certificate Form']; ?></li> </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Character Certificate Generate']; ?></h3>
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
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" required>
					  <option value="">Select student</option>
					        <?php
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
							<option value="<?php echo $student_roll_no."|?|".$student_name."|?|".$student_father_name."|?|".$school_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-[".$school_roll_no."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
			</div>
			
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="character_student_name" value="" placeholder="<?php echo $language['Student Name']; ?>"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
					  
					  <div class="col-md-3 ">	
					    <div class="form-group" >
					     <label><?php echo $language['Father Name']; ?></label>
					     <input type="text"  name="character_student_father_name" id="student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control" readonly>
					    </div>
				      </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="character_student_roll_no"  value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="school_roll_no" class="form-control" readonly>
						  <input type="hidden" name="student_roll_no"  value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="student_roll_no" class="form-control" readonly>
					      </div>
				      </div>
					  
					  <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['School Name']; ?></label>
						   <input type="text"  name="character_school_name" value="<?php echo $_SESSION['school_info_school_name5']; ?>" placeholder="<?php echo $language['School Name']; ?>" required  class="form-control" >
					       </div>
					  </div>
				     
					  <div class="col-md-3 ">	
					    <div class="form-group">
						<label><?php echo $language['During Year']; ?></label>
						<div class="col-sm-12">
						 <div class="col-sm-6">
						
						   <input type="text" name="character_current_year_from"  class="form-control" placeholder="From" required />
						   </div>
						  
						   <div class="col-sm-6">
						 
						   	<input type="text" class="form-control" name="character_current_year_to" placeholder="To" required /><br/>
                          </div>
					   </div>
					</div>
				     </div>
					 
				     <div class="col-md-3 ">	
						<div class="form-group" >
						 <label> <?php echo $language['Character Type']; ?></label>
						  <input type="text"  name="character_type" placeholder="<?php echo $language['Character Type']; ?>"  value="" class="form-control">
						</div>
					  </div>
				 
					  <div class="col-md-3 ">	
						<div class="form-group" >
						 <label><?php echo $language['Issued Date']; ?></label>
						  <input type="date"  name="character_issue_date"  placeholder="<?php echo $language['Issued Date']; ?>"  value="" class="form-control" required>
						</div>
					  </div>
				 
				     
				    
					  <div class="col-md-12">
					   <br/><center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center><br/>
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
    $('.select2').select2();
</script>

  