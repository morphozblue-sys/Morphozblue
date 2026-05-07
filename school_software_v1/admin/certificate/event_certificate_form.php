<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function fill_detail(value){
           
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
          $("#school_roll_no").val(res[10]);
          $("#student_class").val(res[1]);
          $("#student_class_section").val(res[2]);
              }
           });

    }
 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/event_certificate_form_api.php",
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
				   get_content('certificate/event_certificate_list');
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
      <li class="active"><?php echo $language['Event Certificate Form']; ?></li> </ol>
    </section>
	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Event Certificate Generate']; ?></h3>
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
			</div>
			
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="event_student_name" value="" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="event_student_roll_no"  value="" placeholder="student Roll No."  id="school_roll_no" class="form-control" readonly>
					      </div>
				      </div>
					  
					  <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="event_student_class" value="" placeholder="Student Class"   id="student_class" class="form-control" readonly>
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Section']; ?></label>
						  <input type="text" name="event_student_section"  value="" placeholder="student Section"  id="student_class_section" class="form-control" readonly>
					      </div>
				      </div>
				  
				     <div class="col-md-3 ">	
						<div class="form-group" >
						 <label> <?php echo $language['Event Type']; ?></label>
						  <input type="text"  name="event_type" placeholder="Event Type"  value="" class="form-control" required>
						</div>
					  </div>
				 
					  <div class="col-md-3 ">	
						<div class="form-group" >
						 <label><?php echo $language['Organized Date']; ?></label>
						  <input type="date"  name="event_organized_date" id="date_of_school_leaving" placeholder="Organized  Date"  value="" class="form-control" required>
						</div>
					  </div>
				 
				      <div class="col-md-3 ">	
					    <div class="form-group" >
					    <label> <?php echo $language['Rank']; ?></label>
					     <input type="text"  name="event_rank" placeholder="Rank"  value="" class="form-control" required>
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
  