<?php include("../attachment/session.php"); ?>

<script>
$("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/employee_add_api.php",
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
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	   
	    <li><a href="javascript:get_content('hostel/staff')"><i class="fa fa-bed"></i> <?php echo $language['Hostel Staff']; ?></a></li>
	    <li class="Active"><?php echo $language['Add Staff']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Employee Info']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body "  >
		<form method="post" enctype="multipart/form-data" id="my_form">	
		<div class="col-md-12">
		<h3 style="color:#d9534f;"><b><?php echo $language['Personal Detail']; ?></b></h3>
			<div class="col-md-4 ">
				<div class="form-group">
                    <label><?php echo $language['Employee Name']; ?><font style="color:red"><b>*</b></font></label>
                    <input type="text" name="emp_name" placeholder="<?php echo $language['Employee Name']; ?>"  value="" class="form-control">
                </div>
					
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
                  <label><?php echo $language['Gender']; ?></label>
                   <select name="emp_gender" class="form-control">
			          <option value="Male">Male</option>  
			          <option value="Female">Female</option>
			        </select>
				</div>
			</div>
			<div class="col-md-4 ">		
				<div class="form-group">
                    <label><?php echo $language['Date Of Birth']; ?></label>
                    <input type="date" name="emp_dob" placeholder="<?php echo $language['Date Of Birth']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">	
				<div class="form-group">
                    <label><?php echo $language['Husband Father Name']; ?></label>
                    <input type="text" name="emp_father" placeholder="<?php echo $language['Husband Father Name']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Email Address']; ?> </label>
                    <input type="email" name="emp_email" placeholder="<?php echo $language['Email Address']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Mobile No']; ?> <font style="color:red"><b>*</b></font></label>
                    <input type="text" required name="emp_mobile" placeholder="<?php echo $language['Mobile No']; ?>"  value="" class="form-control">
                </div>
			</div>	
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Address']; ?></label>
                   <input type="text" name="emp_address" placeholder="<?php echo $language['Address']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Employee Qualification']; ?></label>
                    <input type="text" name="emp_qualification" placeholder="<?php echo $language['Employee Qualification']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
			 	<div class="form-group">
                  <label><?php echo $language['Photo']; ?></label>
                   <input type="file" name="emp_photo" id="" onchange="check_file_type(this,'emp_photo','emp_phroi12','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png">
                </div>
			</div>	
			<div class="col-md-1 "  >	
					<div class="form-group">
					   <img id="emp_phroi12" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px' >
					</div>
				</div>
		</div>	
	     <div class="col-md-4 ">				
				<div class="form-group">
                    <label><?php echo $language['Date Of joining']; ?></label>
                    <input type="date" name="emp_doj" placeholder="<?php echo $language['Date Of joining']; ?>"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Designation']; ?></label>
                   <input type="text" name="emp_designation" placeholder="<?php echo $language['Designation']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label><?php echo $language['Leave For An Year']; ?></label>
                   <input type="text" name="emp_casual_leave" placeholder="<?php echo $language['Leave For An Year']; ?>"  value="" class="form-control">
                </div>
			</div>
	
		
		
	<div class="col-md-12">
		<h3 style="color:#d9534f;"><b><?php echo $language['Salary Details']; ?></b></h3>
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Pan Card No']; ?></label>
                   <input type="text" name="emp_pan_card_no" placeholder="<?php echo $language['Pan Card No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                  <label ><?php echo $language['Aadhar No']; ?></label>
                  <input type="text"  name="emp_uid_no" placeholder="<?php echo $language['Aadhar No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                  <label ><?php echo $language['Bank Name']; ?> </label>
                  <input type="text" name="emp_bank_name" placeholder="<?php echo $language['Bank Name']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Bank Account No']; ?></label>
                   <input type="text" name="emp_account_no" placeholder="<?php echo $language['Bank Account No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Bank Ifsc Code']; ?></label>
                   <input type="text" name="emp_ifsc_code" placeholder="<?php echo $language['Bank Ifsc Code']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Salary']; ?> <font style="color:red"><b>*</b></font></label>
                   <input type="text" required name="emp_basic_salary" placeholder="<?php echo $language['Salary']; ?> "  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Pf Number']; ?></label>
                   <input type="text" name="emp_pf_number" placeholder="<?php echo $language['Pf Number']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label ><?php echo $language['Remark']; ?></label>
                   <input type="text" name="remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
                </div>
			</div>
		</div>
	
			
		<div class="col-md-12">
		      <center><input type="submit" name="submit" value="<?php echo $language['Submit Details']; ?>" class="btn btn-success" /></center>
		</div>
	  </form>	
	</div>
	
	
	
	
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

  