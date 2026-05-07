<?php include("../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
//window.scrollTo(0, 0);
  // loader();
        $.ajax({
            url: access_link+"hostel/employee_edit_api.php",
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
				   get_content('hostel/employee_list');
            }
			}
         });
      });
</script>	

     <section class="content-header">
      <h1>
            <?php echo $language['Hostel Management']; ?>
        <small>  <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	 
	    <li><a href="javascript:get_content('hostel/staff')"><i class="fa fa-bed"></i> <?php echo $language['Hostel Staff']; ?></a></li>
	         <li><a href="employee_list.php"><i class="fa fa-bed"></i> <?php echo $language['Staff List']; ?></a></li>
	    <li class="Active"><?php echo $language['Edit Staff']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
		   <form method="post" enctype="multipart/form-data" id="my_form">
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Employee Info']; ?></h3>
            </div>
            <!-- /.box-header -->
			
<!--------------------------------Start Registration form--------------------------------------------------->

<?php
$s_no=$_GET['id'];

$que="select * from hostel_staff_info where s_no='$s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no = $row['s_no'];
	$emp_name = $row['emp_name'];
	$emp_gender = $row['emp_gender'];
	$emp_dob = $row['emp_dob'];
	$emp_father = $row['emp_father'];
	$emp_email = $row['emp_email'];
	$emp_mobile = $row['emp_mobile'];
	$emp_address = $row['emp_address'];
	$emp_qualification = $row['emp_qualification'];
	$emp_doj = $row['emp_doj'];
	$emp_designation = $row['emp_designation'];
	$emp_casual_leave = $row['emp_casual_leave'];
	$emp_pan_card_no = $row['emp_pan_card_no'];
	$emp_bank_name = $row['emp_bank_name'];
	$emp_account_no = $row['emp_account_no'];
	$emp_ifsc_code = $row['emp_ifsc_code'];
	$emp_basic_salary = $row['emp_basic_salary'];
	$emp_pf_number = $row['emp_pf_number'];
    $emp_uid_no = $row['emp_uid_no'];
    $remarks = $row['remarks'];
		$emp_photo=$row['emp_photo_name'];

    
}
?>
	

    <div class="box-body "  >

			
		<div class="box-body ">
		<h3 style="color:#d9534f;"><b><?php echo $language['Personal Detail']; ?></b></h3>
			<div class="col-md-4 ">
				<div class="form-group">
				  <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" class="form-control">
                    <label><?php echo $language['Employee Name']; ?><font style="color:red"><b>*</b></font></label>
                    <input type="text" required name="emp_name" placeholder="Employee Name"  value="<?php echo $emp_name; ?>" class="form-control">
                </div>
					
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
                  <label><?php echo $language['Gender']; ?></label>
                 <select name="emp_gender" class="form-control">
			          <option value="<?php echo $emp_gender; ?>"><?php echo $emp_gender; ?></option>  
			          <option value="Male">Male</option>  
			          <option value="Female">Female</option>
			        </select>
				</div>
			</div>
			<div class="col-md-4 ">		
				<div class="form-group">
                    <label><?php echo $language['Date Of Birth']; ?></label>
                    <input type="date" name="emp_dob" placeholder="Date of Birth"  value="<?php echo $emp_dob; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">	
				<div class="form-group">
                    <label><?php echo $language['Husband Father Name']; ?></label>
                    <input type="text" name="emp_father" placeholder="Father/Husband Name"  value="<?php echo $emp_father; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Email Address']; ?></label>
                    <input type="email" name="emp_email" placeholder="Email Address"  value="<?php echo $emp_email; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Mobile No']; ?>  <font style="color:red"><b>*</b></font></label>
                    <input type="text" required name="emp_mobile" placeholder="Mobile No"  value="<?php echo $emp_mobile; ?>" class="form-control">
                </div>
			</div>	
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Address']; ?></label>
                   <input type="text" name="emp_address" placeholder="Address"  value="<?php echo $emp_address; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Employee Qualification']; ?></label>
                    <input type="text" name="emp_qualification" placeholder="Employee Qualification"  value="<?php echo $emp_qualification; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
			 	<div class="form-group">
                  <label><?php echo $language['Photo']; ?></label>
                   <input type="file"  name="emp_photo" id="emp_photo" placeholder=""  value="" onchange="check_file_type(this,'emp_photo','emp_phroi12','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png">
                </div>
			</div>	
			<div class="col-md-1 "  >	
					<div class="form-group">
					   <img id="emp_phroi12" src='<?php if($emp_photo!=''){ echo $_SESSION['amazon_file_path']."hostel_staff/".$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>' width='60px' height='60px' >
					</div>
				</div>
		</div>	
		</div>	
		   <div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Date Of joining']; ?></label>
                    <input type="date" name="emp_doj" placeholder=""  value="<?php echo $emp_doj; ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Designation']; ?></label>
                   <input type="text" name="emp_designation" placeholder="Designation"  value="<?php echo $emp_designation; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Leave For An Year']; ?></label>
                   <input type="text" name="emp_casual_leave" placeholder="Casual Leave for an Year"  value="<?php echo $emp_casual_leave; ?>" class="form-control">
                </div>
			</div>
		
		
	<div class="box-body ">
		<h3 style="color:#d9534f;"><b><?php echo $language['Salary Details']; ?></b></h3>
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label>Pan Card No</label>
                   <input type="text" name="emp_pan_card_no" placeholder="Pan Card No."  value="<?php echo $emp_pan_card_no; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                  <label >Aadhar No</label>
                  <input type="text"  name="emp_uid_no" placeholder="Aadhar No."  value="<?php echo $emp_uid_no; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                  <label >Bank Name </label>
                  <input type="text" name="emp_bank_name" placeholder="Bank Name"  value="<?php echo $emp_bank_name; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label >Bank Account No</label>
                   <input type="text" name="emp_account_no" placeholder="Bank Account No"  value="<?php echo $emp_account_no; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label >Bank IFSC Code</label>
                   <input type="text" name="emp_ifsc_code" placeholder="Bank IFSC Code"  value="<?php echo $emp_ifsc_code; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label >Salary <font style="color:red"><b>*</b></font></label>
                   <input type="text" required name="emp_basic_salary" placeholder="Salary"  value="<?php echo $emp_basic_salary; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label >PF NUMBER</label>
                   <input type="text" name="emp_pf_number" placeholder="PF NUMBER"  value="<?php echo $emp_pf_number; ?>" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label >Remarks</label>
                   <input type="text" name="remarks" placeholder="Remarks"  value="<?php echo $remarks; ?>" class="form-control">
                </div>
			</div>
		</div>
		
		<div class="col-md-12">
		      <center><input type="submit" name="finish" value="<?php echo $language['Update']; ?>" class="btn btn-primary" /></center>
		</div>
	  </form>	
	</div>
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  