<?php include("../attachment/session.php");?>
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
        $("#dateofbirth").val('Loading.....');
        $("#student_category").val('Loading.....');
        $("#student_roll").val('Loading.....');
        $("#session_value").val('Loading.....');
        $("#student_adhar_number").val('Loading.....');
        $("#student_admission_number").val('Loading.....');
        $("#student_scholar_number").val('Loading.....');
        $("#company_name11").val('Loading.....');
        $("#student_mother_name").val('Loading.....');
        $("#house_name").val('Loading.....');
        $("#school_name_1").val('Loading.....');
       
			$.ajax({
			  address: "POST",
              url: access_link+"event_management/ajax_search_student_box.php?id="+value+"",
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
	      $("#student_adhar_number").val(res[10]);
          $("#student_admission_number").val(res[11]);
          $("#student_scholar_number").val(res[12]);
          $("#company_name11").val(res[13]);
          $("#student_mother_name").val(res[14]);
          $("#house_name").val(res[15]);
          $("#school_name_1").val(res[16]);
           }
           });

    }
</script>

<script>
function our_other(value){
if(value=='Scholar'){
$('#search_student').show();
$('#house_name1').show();
$('#student_name_our').show();
$('#student_name_our1').show();
$('#school_name_1').prop('readonly',true);
$('#student_name').prop('readonly',true);
$('#dateofbirth').prop('readonly',true);
$('#student_class').prop('readonly',true);
$('#gender').prop('readonly',true);
$('#student_father_name').prop('readonly',true);
$('#student_mother_name').prop('readonly',true);

$('#school_name_1').val('');
$('#student_name').val('');
$('#dateofbirth').val('');
$('#student_class').val('');
$('#gender').val('');
$('#student_father_name').val('');
$('#student_mother_name').val('');
}else{
$('#search_student').hide();
$('#house_name1').hide();
$('#student_name_our').hide();
$('#student_name_our1').hide();
$('#school_name_1').prop('readonly',false);
$('#student_name').prop('readonly',false);
$('#dateofbirth').prop('readonly',false);
$('#student_class').prop('readonly',false);
$('#gender').prop('readonly',false);
$('#student_father_name').prop('readonly',false);
$('#student_mother_name').prop('readonly',false);

$('#school_name_1').val('');
$('#student_name').val('');
$('#dateofbirth').val('');
$('#student_class').val('');
$('#gender').val('');
$('#student_father_name').val('');
$('#student_mother_name').val('');
}
}

$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"event_management/add_participate_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			//alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('event_management/participate_list');
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
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
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
			    <div class="col-md-4">
					<div class="form-group">
						<label>Participate Type<font style="color:red"><b>*</b></font></label>
						<select name="participate_type" class="form-control" onchange="our_other(this.value);" required >
						  <option value="">Select</option>
						  <option value="Scholar">Scholar</option>
						  <option value="Other">Other</option>
						</select>
					</div>
				</div>   
				<div class="col-md-4">
					<div class="form-group">
						<label>Event Name<font style="color:red"><b>*</b></font></label>
						  <select name="event_name" class="form-control" id="event_name" onchange="for_activity(this.value);" required>
						  <option value="">Select</option>
						  <?php
							$query="select * from event_table GROUP BY event_name";
							$res=mysqli_query($conn73,$query);
							while($row=mysqli_fetch_assoc($res)){
							$s_no=$row['s_no'];
							$event_name=$row['event_name'];
							?>
					      <option value="<?php echo $event_name; ?>"><?php echo $event_name; ?></option>
						  <?php } ?>
						  </select>
					</div>
				</div>
			<div class="col-md-4" id="search_student" style="display:none">
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
					  <input type="text" name="school_name" id="school_name_1" placeholder="School Institute"  value="" class="form-control" readonly />
				  </div>
				</div>

				<div class="col-md-3" style="display:none;">		
				   <div class="form-group">
					 <input type="text" name="session_value" id="session_value" value="" class="form-control" readonly />
					  <input type="text" name="student_adhar_number" id="student_adhar_number" class="form-control" readonly />
					  <input type="text" name="student_admission_number" id="student_admission_number" value="" class="form-control" readonly />
					  <input type="text" name="student_scholar_number" id="student_scholar_number" value="" class="form-control" readonly />
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
					<input type="text" name="student_name" placeholder="Student Name"  id="student_name" class="form-control" readonly>
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
				 <div class="form-group" >
				   <label>Class</font></label>
					<input type="text" name="student_class" placeholder="Student Class"  id="student_class" class="form-control" readonly>
				 </div>
			  </div>
		
				 <div class="col-md-3">
					<div class="form-group">
						<label>Gender</label>
						<input type="text" id="gender" name="gender" class="form-control" readonly>
					</div>
				</div>
		
			     <div class="col-md-3" id="birth_other">		
					  <div class="form-group">
					    <label>Date Of Birth</label>
					    <input type="date" name="dateofbirth" id="dateofbirth" placeholder="Date Of Birth"  value="" class="form-control" readonly>
					  </div>
				 </div> 
				 <div class="col-md-3" id="house_name1" style="display:none">
					<div class="form-group">
						<label>House Name</label>
						<input type="text" id="house_name" name="house_name" class="form-control" readonly>
					</div>
				</div>
			  <div class="col-md-3">
				<div class="form-group">
					<label>Category</label>
					<input type="text"  name="category" required placeholder="Eg:Dancing,Solo Dancing,Singing,etc"  id="" class="form-control" >
				</div>
			</div>

				
		  <div class="col-md-12">
		     <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
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
   