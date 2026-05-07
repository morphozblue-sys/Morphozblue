<?php include("../attachment/session.php"); ?>
<script>
function valid(id,date,emp_id,amount,advance_id,advance_amount){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
salary_delete(id,date,emp_id,amount,advance_id,advance_amount);       
 }            
else  {      
return false;
 }       
  }    
function salary_delete(id,date,emp_id,amount,advance_id,advance_amount){
$.ajax({
type: "POST",
url: access_link+"staff/emp_salary_list_particular_delete.php?id="+id+"&date="+date+"&amount="+amount+"&emp_id="+emp_id+"&advance_id="+advance_id+"&advance_amount="+advance_amount+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   post_content('staff/emp_salary_list_particular',res[2]);
			   }else{
               alert_new('Sorry!!! Some Error Occured','red'); 
			   }
}
});
}
  
</script>  


    <section class="content-header">
       <h1><?php echo $language['Employee Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small></h1>
       <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  	 <li><a href="javascript:get_content('staff/emp_salary_list')"><i class="fa fa-male"></i><?php echo $language['Employee Salary List']; ?></a></li>
	   <li class="active"><?php echo $language['Employee Salary List']; ?></li>
       </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Employee Name']; ?></th>
                  <!-- <th><?php //echo $language['Photo']; ?></th> -->
				  <th><?php echo $language['Contact No']; ?></th>
                  <th><?php echo $language['Designation']; ?></th>
                  <th><?php echo $language['Salary From']; ?></th>
                  <th><?php echo $language['Salary To']; ?></th>
                  <th><?php echo $language['Salary Amount']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
				  <th><?php echo $language['Print']; ?></th>
				  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
        <tbody>
             						<?php 
				$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$salary_slip_pdf = $row['salary_slip_pdf'];
}	
   ?>   
            <?php
			$emp_id=$_GET['emp_id'];
			$que="select * from employee_info where emp_status='Active' and emp_id='$emp_id'";
			$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
			while($row=mysqli_fetch_assoc($run)){
					$emp_name=$row['emp_name'];
					$emp_mobile=$row['emp_mobile'];
					$emp_designation=$row['emp_designation'];
					$emp_id=$row['emp_id'];

		
				
				$que1="select * from employee_salary_generate where emp_id='$emp_id' and employee_salary_status='Active' and session_value='$session1' order by s_no DESC";
				$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
				$employee_salary_date_from2='';
				$employee_salary_date_to2='';
				$final_salary=0;
				$serial_no=0;
				while($row1=mysqli_fetch_assoc($run1)){
			    $s_no1=$row1['s_no'];
			    $employee_salary_generate_date=$row1['employee_salary_generate_date'];
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
				
                $update_change=$row1['update_change'];
                if($row1['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
                }else{
                $last_updated_date=$row1['last_updated_date'];
                }
                $advance_id=$row1['advance_id'];
                $advance_amount=$row1['advance_amount'];
				
				$serial_no++;
				 
			    ?>
				<tr>
				<td><?php echo $serial_no; ?></td>
				<td><?php echo $emp_name; ?></td>
				<!-- <td><img  src="<?php //if($emp_photo!=''){ echo 'data:image;base64,'.$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50" style="margin-top:10px;"></td> -->
				<td><?php echo $emp_mobile; ?></td>
				<td><?php echo $emp_designation; ?></td>
				<td><?php echo $employee_salary_date_from2; ?></td>
				<td><?php echo $employee_salary_date_to2; ?></td>
				<td><b><?php echo $final_salary; ?></b></td>
				
                <td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>
				
				<td><a target="_blank" href='<?php echo $pdf_path; ?>salary_slip/<?php echo $salary_slip_pdf; ?>?id=<?php echo $s_no1; ?>&emp_id=<?php echo $emp_id; ?>&date_diff=<?php echo $date_diff; ?>'><button type="button"  class="btn btn-success"  >Print</button></a></td>
				<td><button type="button" class="btn btn-success"  onclick="return valid('<?php echo $s_no1; ?>','<?php echo $employee_salary_generate_date; ?>','<?php echo $emp_id; ?>','<?php echo $final_salary; ?>','<?php echo $advance_id; ?>','<?php echo $advance_amount; ?>');">
                Delete</button></td>
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
  