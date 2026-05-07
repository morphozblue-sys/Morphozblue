<?php include("../attachment/session.php");
?>
 <script>
 function student_class(value){
      
	 $.ajax({
		 type:"POST",
		 url: access_link+"downloads/ajax_get_student_class.php?student_data="+value+"",
		 cache: false,
		 success:function(data2)
		 {
			$("#student_class_section").html("<option value='All'> All </option>"+data2);
		 }
	 });
 }
 </script>
 <script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/download_userid_password.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
      }
</script>
</head>

    <section class="content-header">
      <h1>
        Downloads Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
	  <li class="active"><i class="fa fa-user-plus"></i>User Id And Password</li>
      </ol>
    </section>
	

	<!---******************************************************************************************************-->
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <h3 class="box-title">User Id And Password</h3>
            </div>
 <div class="box-body">
 			<form role="form" method="post"id="my_form" enctype="multipart/form-data" >

	<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                <div class="col-md-2"></div>
				<div class="col-md-6">
		         <div class="col-md-6">				
			      <div class="form-group" >
				  <th><b  style="font-size:15px">Choose Class</b></th>
				<select name="student_category" id="std_category" class="form-control" onchange="student_class(this.value);" >
				<option value="All">All</option>
				<?php 
				$select_class="SELECT * FROM school_info_class_info";
				$select_class_run=mysqli_query($conn73,$select_class) or die(mysqli_error($conn73));
				while($result=mysqli_fetch_assoc($select_class_run))
				{
					$student_class=$result['class_name'];
				?>
				<option value="<?php echo $student_class ?>"><?php echo $student_class ?></option>
				<?php } ?>
				</select>
				  </div>
				  </div>	
				 
				   <div class="col-md-6">
				 <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
				  </div>
				  
				  <div class="col-md-2">
					 <label>Order By</label>
				     <select class="form-control" name="order_by" id="order_by">
					    <option  value="">Select</option>
						<option value="student_name">Student Name</option>
						<option value="student_father_name">Father Name</option>
						<option value="school_roll_no">School Roll No</option>
						<option value="student_admission_number">Admission No</option>
						<option value="student_scholar_number">Scholar No</option>
						<option value="student_registration_number">Registration No</option>
						<option value="student_enrollment_number">Enrollment No</option>
					 </select>
				    </div>
				  
				  <div class="col-md-2"></div>
				  <div class="col-md-12">
		   <center><input type="button" name="submit" onclick="form_submit();" value="Submit" class="btn btn-primary"></center>
		   </div>
                </div>
		 </form>
			 </div>
            <!-- /.box-body -->
          </div>
		 
          <!-- /.box -->
        </div>
		</form>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

