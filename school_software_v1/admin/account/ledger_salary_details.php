<?php include("../attachment/session.php")?>

<script>
function valid(){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
return true;        
 }            
else  {      
return false;
 }       
  }           
</script>  
    <section class="content-header">
      <h1>
       Account Management
					<small>Control panel</small>
      </h1>
       <ol class="breadcrumb">
	  
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li><a href="javascript:get_content('account/ledger')"><i class="fa fa-list"></i>Ledger</a></li>
		<li><i class="Active"></i>Ledger Salary Details</li>
      </ol>
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S no.</th>
                  <th>Employee Name</th>
                  <th>Photo</th>
				  <th>Contact No.</th>
                  <th>Designation</th>
                  <th>Salary From</th>
                  <th>Salary To</th>
                  <th>Salary Amount</th>
				  <th>Print</th>
                </tr>
                </thead>
        <tbody>
                
            <?php

$que3="select * from school_info_pdf_info";
$run3=mysqli_query($conn73,$que3);
while($row3=mysqli_fetch_assoc($run3)){
$salary_slip_pdf = $row3['salary_slip_pdf'];
}	
            
			$emp_id_or_student_roll_no=$_GET['id'];
			$date=$_GET['date'];
			$total_amount=$_GET['total_amount'];
			$que="select * from employee_info where emp_status='Active' and emp_id='$emp_id_or_student_roll_no'";
			$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
			while($row=mysqli_fetch_assoc($run)){
					$emp_name=$row['emp_name'];
					$emp_photo=$row['emp_photo'];
					$emp_mobile=$row['emp_mobile'];
					$emp_designation=$row['emp_designation'];
					$emp_id=$row['emp_id'];
					$emp_photo=$row['emp_photo_name'];
			

				
		
				$que1="select * from employee_salary_generate where emp_id='$emp_id_or_student_roll_no' and employee_salary_status='Active' and employee_salary_generate_date='$date' and final_salary='$total_amount'  and session_value='$session1'";
				$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
				$employee_salary_date_from2='';
				$employee_salary_date_to2='';
				$employee_total_pay_after_pf=0;
				$serial_no=0;
				while($row1=mysqli_fetch_assoc($run1)){
			    $s_no1=$row1['s_no'];
				$employee_salary_date_from=$row1['employee_salary_date_from'];
				$employee_salary_date_to=$row1['employee_salary_date_to'];
				$date1=date_create($employee_salary_date_from);
                $date2=date_create($employee_salary_date_to);
				$diff=date_diff($date1,$date2);
				$date_diff= $diff->format("%a");				
	            
				$final_salary=$row1['final_salary'];
				$employee_salary_date_from1=explode("-",$employee_salary_date_from);
				$employee_salary_date_from2=$employee_salary_date_from1[2]."-".$employee_salary_date_from1[1]."-".$employee_salary_date_from1[0];
				
				$employee_salary_date_to1=explode("-",$employee_salary_date_to);
				$employee_salary_date_to2=$employee_salary_date_to1[2]."-".$employee_salary_date_to1[1]."-".$employee_salary_date_to1[0];
				
				$serial_no++;
				 
			    ?>
				<tr>
				<td><?php echo $serial_no; ?></td>
				<td><?php echo $emp_name; ?></td>
				<td><img src="<?php if($emp_photo!=''){ echo $_SESSION['amazon_file_path']."employee_document/".$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50" style="margin-top:10px;"></td>
				<td><?php echo $emp_mobile; ?></td>
				<td><?php echo $emp_designation; ?></td>
				<td><?php echo $employee_salary_date_from2; ?></td>
				<td><?php echo $employee_salary_date_to2; ?></td>
				<td><b><?php echo $final_salary; ?></b></td>	
				<td><a target="_blank" href='<?php echo $pdf_path; ?>salary_slip/<?php echo $salary_slip_pdf; ?>?id=<?php echo $s_no1; ?>&emp_id=<?php echo $emp_id; ?>&date_diff=<?php echo $date_diff; ?>'><button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-default" >Print</button></a></td>
				</tr>
				<?php } } ?>
	    </tbody>
    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  