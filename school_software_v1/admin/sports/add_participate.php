<?php include("../attachment/session.php"); ?>
<style type="text/css">
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 80%;
        left: 0;
		background:white;
    }
    .search-box input[type="text"], .result{
        width: 90%;
		margin-left:5%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>

<script type="text/javascript">
   function fill_detail(value){
       
          $("#student_roll_no").val('Loading.....'); 
		  $("#student_name").val('Loading.....'); 
		  $("#student_class").val('Loading.....'); 
          $("#student_section").val('Loading.....');  
          $("#student_father_name").val('Loading.....');  
          $("#contact_no").val('Loading.....');  
          $("#gender").val('Loading.....');
          //$("#dateofbirth").val('Loading.....');
          $("#student_category").val('Loading.....');
          $("#student_roll").val('Loading.....');
          $("#session_value").val('Loading.....');
          //$("#student_photo_hidden").val(res[10]);
		  $("#student_adhar_number").val('Loading.....');
          $("#student_admission_number").val('Loading.....');
          $("#student_scholar_number").val('Loading.....');
          //$("#company_name11").val(res[14]);
          $("#student_mother_name").val('Loading.....');
          //$("#actualdate").val(res[16]);
          $("#age_year").val('Loading.....');
       
			$.ajax({
			  address: "POST",
              url: access_link+"sports/ajax_search_student_box.php?id="+value+"",
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
		  $("#show_student_photo").attr("src","data:image;base64,"+res[10]);
          //$("#student_photo_hidden").val(res[10]);
		  $("#student_adhar_number").val(res[11]);
          $("#student_admission_number").val(res[12]);
          $("#student_scholar_number").val(res[13]);
          $("#company_name11").val(res[14]);
          $("#student_mother_name").val(res[15]);
          $("#actualdate").val(res[16]);
          $("#age_year").val(res[17]);
		  $("#show_documents").attr("src","data:image;base64,"+res[18]);
          //$("#dob_certificate").val(res[18]);
         ////alert_new(detail);
              }
           });

    }
	  $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"sports/add_participate_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('sports/participate_list');
            }
			}
         });
      });
     
</script>

    <section class="content-header">
      <h1>
       Participation Form
	   <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
    	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"><i class="fa fa-futbol-o"></i> Sport Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Add Participation</li>
      </ol>
    </section>
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Participation Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
		<div class="col-md-12">
                  <div class="col-md-6">
					<div class="form-group">
						<label>Sports Name<font style="color:red"><b>*</b></font></label>
						<select name="sports_name" class="form-control" required>
						  <option value="">Select</option>
							<?php
							$query2="select * from sports_table GROUP BY sports_name";
							$res2=mysqli_query($conn73,$query2);
							while($row2=mysqli_fetch_assoc($res2)){
							$s_no=$row2['s_no'];
							$sports_name=$row2['sports_name'];
							?>
					      <option value="<?php echo $sports_name; ?>"><?php echo $sports_name; ?></option>
						  <?php } ?>
						</select>
					</div>
				 </div> 
			<div class="col-md-6">
			<div class="form-group">
	         <label>Student Name<font size="2" style="font-weight: normal;">(Search by Name)</font><span style="color:red;">*</span></label>
			    <select name="" style="width:100%;" class="form-control select2" onchange="fill_detail(this.value);" >
				<option value="">Select Student</option>
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
	        <?php
			$que="select `school_info_school_name` from school_info_general";
			$run=mysqli_query($conn73,$que);
			while($row=mysqli_fetch_assoc($run)){
			$school_info_school_name = $row['school_info_school_name'];
			}
			?>
	            <div class="col-md-3">		
				   <div class="form-group">
					  <label>School/Institute Participate</label>
					  <input type="text" name="school_name" placeholder="School Institute" value="<?php echo $school_info_school_name; ?>" class="form-control" readonly />
				  </div>
				</div>

				<div class="col-md-3" style="display:none;">		
				   <div class="form-group">
				     <input type="text" name="session_value" id="session_value" value="" class="form-control" readonly />
				   </div>
				</div>
				
				<div class="col-md-3" style="display:none;">		
				   <div class="form-group">
					  <label>Student Roll No</label>
					  <input type="text" name="student_roll_no" id="student_roll" placeholder="Student Roll"  value="" class="form-control"/>
				  </div>
				</div>
					
			  <div class="col-md-3">
				<div class="form-group">
					<label>Student Name</label>
					<input type="text"  name="student_name" placeholder="Student Name"  id="student_name" class="form-control" readonly>
				</div>
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label>Father Name</label>
					<input type="text" name="student_father_name" id="student_father_name" placeholder="Father Name" value="" class="form-control" readonly >
				</div>
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label>Mother Name</label>
					 <input type="text" name="student_mother_name" id="student_mother_name" placeholder="Mother Name" value="" class="form-control" readonly >
				</div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Aadhar/Uid No</label>
					  <input type="text" name="student_adhar_number" id="student_adhar_number" class="form-control" readonly />
			       </div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Addmission No.</label>
					<input type="text" name="student_admission_number" id="student_admission_number" value="" class="form-control" readonly />
				  </div>
				</div>
				<div class="col-md-3">		
				   <div class="form-group">
				     <label>Scholar No.</label>
					 <input type="text" name="student_scholar_number" id="student_scholar_number" value="" class="form-control" readonly />
			      </div>
				</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Contact Number</label>
					 <input type="text" name="contact_no" id="contact_no" placeholder="Contact No" value="" class="form-control" readonly >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Board Registration Number</label>
					<input type="text"  name="board_no" required placeholder="Board Registration Number"  id="" class="form-control" >
				</div>
			</div>
			  <div class="col-md-3">
				 <div class="form-group" >
				   <label>Class</font></label>
					<input type="text" name="student_class" placeholder="Student Class"  id="student_class" class="form-control" readonly>
				 </div>
			  </div> 
			  <div class="col-md-3">
				 <div class="form-group">
				   <label>Section</font></label>
					<input type="text" name="student_section" placeholder="Student Class"  id="student_section" class="form-control" readonly>
				 </div>
			  </div>
		
				 <div class="col-md-3">
					<div class="form-group">
						<label>Gender</label>
						<input type="text" id="gender" name="gender" class="form-control" readonly>
					</div>
				</div>
		
			     <div class="col-md-3">		
					  <div class="form-group">
					    <label>Date Of Birth</label>
					    <input type="date" name="dateofbirth" id="dateofbirth"  value="" class="form-control" readonly>
					  </div>
				 </div> 
			     <div class="col-md-3">		
					  <div class="form-group">
					    <label>Age Category</label>
					    <input type="text" name="age_category" id="age_year" value="" class="form-control" readonly>
					  </div>
				 </div>
				 <div class="col-md-3">		
					  <div class="form-group">
					    <label>Actual Age</label>
					    <input type="text" name="actual_age" id="actualdate" value="" class="form-control" readonly>
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
					   <img src="" id="show_student_photo" height="50" width="50"><input type="hidden" name="student_photo_hidden" id="student_photo_hidden">
					</div>
				</div>	
				<div class="col-md-3">	
					<div class="form-group">
					  <label>Dob Certificate</label>
					  <input type="file" name="document_dob" id="document_dob" placeholder="" onchange="check_file_type(this,'document_dob','show_documents','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <label>Document</label>
					   <img src="" id="show_documents" height="50" width="50"><input type="hidden" name="dob_certificate_hidden" id="dob_certificate">
					</div>
				</div>
		
		<div class="col-md-12">
		     <center><input type="submit" name="finish" value="Submit" class="btn btn-primary" /></center>
		</div>
		</form>	
	</div>

<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<script>
$(function () {
    $('.select2').select2();
  });
</script>
 