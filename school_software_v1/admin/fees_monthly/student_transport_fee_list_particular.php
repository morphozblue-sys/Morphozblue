<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/student_transport_fee_list')"><i class="fa fa-money"></i> Student Transport Fees List</a></li>
	  <li class="active">Student Transport Fees List Particular</li>
      </ol>
    </section>
	
	<script>
	function valid(s_no,roll_no,total_months){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	delete_fee(s_no,roll_no,total_months);
	}
	else  {
	return false;
	}
	}
	
	function delete_fee(s_no,roll_no,total_months){
	$.ajax({
	type: "POST",
	url: access_link+"fees_monthly/student_transport_fee_delete.php?s_no="+s_no+"&roll_no="+roll_no+"&total_months="+total_months+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert('Successfully Deleted');
	   get_content('fees_monthly/student_transport_fee_list');
	}else{
	alert(detail); 
	}
	}
	});
	}
	</script>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
				  <th><?php echo $language['Student Name']; ?></th>
				  <th><?php echo $language['Father Name']; ?></th>
				  <th><?php echo $language['Class']; ?></th>
				  <th><?php echo $language['Section']; ?></th>
				  <th>Receipt No</th>
                  <th><?php echo $language['Submission Date']; ?></th>
				  <th><?php echo $language['Total Pay']; ?></th>
				  
                  <th>Update By</th>
                  <th>Date</th>
				  
				  <th><?php echo $language['Details']; ?></th>
				  <th>Edit</th>
				  <th style="<?php if($_SESSION['sub_panel_fee_list_delete']!='yes'){ echo 'display:none;'; } ?>" ><?php echo $language['Delete']; ?></th>
				  <th>A4 Print</th>
				  <th>Thermal Print</th>
                </tr>
                </thead>
                <tbody>
<?php 
$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$fee_slip_pdf = $row['fee_slip_pdf'];
	$fee_slip_thermal_pdf = $row['fee_slip_thermal_pdf'];
	$transport_fee_receipt_pdf =$row['transport_fee_receipt_pdf'];
	$transport_fee_receipt_thermal_pdf = $row['transport_fee_receipt_thermal_pdf'];
}
?>    
                    
				<?php               
				$student_roll_no=$_GET['student_roll_no'];
                $que="select * from common_fees_student_transport_fee_add where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active' ORDER BY s_no DESC";
                $run=mysqli_query($conn73,$que);
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_father_name=$row['student_father_name'];
				$student_class=$row['student_class'];
				$student_class_section=$row['student_class_section'];
				$fee_submission_date1=$row['fee_submission_date'];
				if($fee_submission_date1!=''){
				$fee_submission_date=date('d-m-Y',strtotime($fee_submission_date1));
				}else{
				$fee_submission_date=$fee_submission_date1;
				}
				$student_roll_no=$row['student_roll_no'];
				$paid_total=$row['paid_total'];
				$blank_field_5=$row['blank_field_5'];
				$medium=$row['medium'];			
				$shift=$row['shift'];			
				$board=$row['board'];			
				$fee_paid_months=$row['fee_paid_months'];
				
				$update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
				
				$serial_no++;
                ?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class; ?></td>
				  <td><?php echo $student_class_section; ?></td>
				  <td><?php echo $blank_field_5; ?></td>
				  <td><?php echo $fee_submission_date; ?></td>
				  <td><?php echo $paid_total; ?></td>
				  
				  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
				  
                  <td><button type="button" onclick="post_content('fees_monthly/student_transport_fee_list_particular_details','<?php echo 's_no='.$s_no; ?>')" class="btn btn-default my_background_color" ><?php echo $language['Details']; ?></button></td>
				  <td><button type="button" onclick="post_content('fees_monthly/student_transport_fee_add_form_edit','<?php echo 'student_roll_no='.$student_roll_no.'&fee_month='.$fee_paid_months.'&s_no='.$s_no; ?>')" class="btn btn-default my_background_color" >Edit</button></td>
				  <td style="<?php if($_SESSION['sub_panel_fee_list_delete']!='yes'){ echo 'display:none;'; } ?>" ><button type="button"  class="btn btn-default my_background_color" onclick="return valid('<?php echo $s_no; ?>','<?php echo $student_roll_no; ?>','<?php echo $fee_paid_months; ?>');" ><?php echo $language['Delete']; ?></button></td>
								
				  <td><a target="_blank" href='<?php echo $pdf_path; ?>feereciept/<?php echo $transport_fee_receipt_pdf; ?>?s_no1=<?php echo $s_no; ?>&medium=<?php echo $medium; ?>&shift=<?php echo $shift; ?>&board=<?php echo $board; ?>&months=<?php echo $fee_paid_months; ?>'><button type="button" class="btn btn-default my_background_color"><?php echo $language['Print']; ?></button></a></td>
                  <td><a target="_blank" href='<?php echo $pdf_path; ?>feereciept/<?php echo $transport_fee_receipt_thermal_pdf; ?>?s_no1=<?php echo $s_no; ?>&medium=<?php echo $medium; ?>&shift=<?php echo $shift; ?>&board=<?php echo $board; ?>&months=<?php echo $fee_paid_months; ?>'><button type="button" class="btn btn-default my_background_color"><?php echo $language['Print']; ?></button></a></td>
                
                </tr>
                <?php } ?>
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
    <!-- /.content -->
<script>
$(function () {
$('#example1').DataTable()
})
</script>