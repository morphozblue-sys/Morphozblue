<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
 function for_section(value){
//alert_new(id);
       $.ajax({
			  type: "POST",
              url: access_link+"downloads/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                 $("#student_class_section").html('<option value="All">All</option>'+detail);
              }
           });

    }
  </script>
  
<script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/attendance_export.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {
			$('#get_content').html(data1);
		
           }
         });
      }
</script>

    <section class="content-header">
      <h1>
        Download Attendance Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Download</li>
      </ol>
    </section>
	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><b>Attendance Download Info</b></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" id="my_form"  enctype="multipart/form-data">
			<div class="col-md-12">
			
			<div class="col-md-3">	
					<div class="form-group" >
					  <th><b style="font-size:15px">Select Month</b></th>
					  <select class="form-control" name="month_name" required>
			  <option value="All" >All</option>
			  <option <?php if($month=='04'){ echo 'selected'; } ?> value="04"><?php echo $language['April']; ?></option>
			  <option <?php if($month=='05'){ echo 'selected'; } ?> value="05"><?php echo $language['May']; ?></option>
			  <option <?php if($month=='06'){ echo 'selected'; } ?> value="06"><?php echo $language['June']; ?></option>
			  <option <?php if($month=='07'){ echo 'selected'; } ?> value="07"><?php echo $language['July']; ?></option>
			  <option <?php if($month=='08'){ echo 'selected'; } ?> value="08"><?php echo $language['August']; ?></option>
			  <option <?php if($month=='09'){ echo 'selected'; } ?> value="09"><?php echo $language['September']; ?></option>
			  <option <?php if($month=='10'){ echo 'selected'; } ?> value="10"><?php echo $language['October']; ?></option>
			  <option <?php if($month=='11'){ echo 'selected'; } ?> value="11"><?php echo $language['November']; ?></option>
			  <option <?php if($month=='12'){ echo 'selected'; } ?> value="12"><?php echo $language['December']; ?></option>
			  <option <?php if($month=='01'){ echo 'selected'; } ?> value="01"><?php echo $language['January']; ?></option>
			  <option <?php if($month=='02'){ echo 'selected'; } ?> value="02"><?php echo $language['February']; ?></option>
			  <option <?php if($month=='03'){ echo 'selected'; } ?> value="03"><?php echo $language['March']; ?></option>
	                 </select>
	                 </select>
	                  
					</div>
				</div>
							<div class="col-md-2">	
					<div class="form-group" >
					  <th><b style="font-size:15px">Select Year</b></th>
					  <?php $year=date('Y'); ?>
					  <select class="form-control" name="year_name" required>
			  <option <?php if($year=='2016'){ echo 'selected'; } ?> value="2016" >2016</option>
			  <option <?php if($year=='2017'){ echo 'selected'; } ?> value="2017" >2017</option>
			  <option <?php if($year=='2018'){ echo 'selected'; } ?> value="2018" >2018</option>
			  <option <?php if($year=='2019'){ echo 'selected'; } ?> value="2019" >2019</option>
			  <option <?php if($year=='2020'){ echo 'selected'; } ?> value="2020" >2020</option>
			  <option <?php if($year=='2021'){ echo 'selected'; } ?> value="2021" >2021</option>
			  <option <?php if($year=='2022'){ echo 'selected'; } ?> value="2022" >2022</option>

			
	                 </select>
	                  
					</div>
				</div>

			 <div class="col-md-2">
				 <div class="form-group" >
					  <th><b style="font-size:15px">Class</b></th>
					 <select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);">
				<option value="All">All</option>
				<?php
				$sql= "select * From school_info_class_info";
				$result=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($result)){
				$class_name=$row['class_name'];
				 ?>
				<option value="<?php  echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
	
					</div>
					</div>
					 <div class="col-md-2">
				 <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
					
					<div class="col-md-3">
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
					
			</div></br></br></br></br></br>
			
					
					</div>
		
		<div class="col-md-12">
		   <center><input type="button" name="submit" value="Submit" class="btn btn-primary" onclick="form_submit()" /></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  
