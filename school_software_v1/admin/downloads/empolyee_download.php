 <?php include("../attachment/session.php")?>
    <section class="content-header">
      <h1>
        Download Employee  Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Downloads</li>
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
              <h3 class="box-title">Employee  Download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" action='employee_generate_data.php'enctype="multipart/form-data">
			
			<div class="col-md-12">
			<div class="col-md-4">
			</div>
             <div class="col-md-4">
			 <div class="form-group">
			<th><b style="font-size:15px">Choose Staff:-</b></th><select name="staff" class="form-control" required>
			<option value="">select</option>
			<option value="all">All</option>
			<option value="Teaching">Teaching Staff</option>
			<option value="Non Teaching">Non Teaching Staff</option>
			</select>
			</div>
			</div>
			<div class="col-md-4">
			</div>
			</div></br></br></br></br></br>
			
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="emp_id,emp id" /><th><b>Employee Id</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="emp_rf_id_no,emp rf id no" /><th><b>Employee Rf Id No</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_name,emp name" /><th><b>Employee Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="emp_gender,emp gender" /><th><b>Employee Gender</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="emp_father,emp father" /><th><b>Employee Father</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_email,emp_email" /><th><b>Employee Email</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_mobile,emp mobile" /><th><b>Employee Mobile</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_address,emp_address" /><th><b>Employee Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_qualification,emp qualification" /><th><b>Employee Qualification</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_doj,emp_doj" /><th><b>Employee Date Of Joning</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="emp_categories,emp categories" /><th><b>Employee Categories</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_class_preferred,emp class preferred" /><th><b>Employee Class Preferred</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_designation,emp designation" /><th><b>Employee Designation</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_pan_card_no,emp pan card no" /><th><b>Employee Pan Card No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_bank_name,emp bank name" /><th><b>Employee Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_account_no,emp account no" /><th><b>Employee Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_ifsc_code,emp ifsc code" /><th><b>Employee Ifsc Code</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_basic_salary,emp basic salary" /><th><b>Emp Basic Salary</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_pf_number,emp pf number" /><th><b>Employee Pf Number</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_subject_preferred,emp subject preferred" /><th><b>Employee Subject Preferred</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_uid_no,emp uid no"/><th><b>Employee Uid No</b></th>
						</div>
					</div>
					
		<div class="col-md-12">
		   <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

