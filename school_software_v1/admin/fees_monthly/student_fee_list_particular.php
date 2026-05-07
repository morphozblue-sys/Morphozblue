<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/student_fee_list')"><i class="fa fa-money"></i> <?php echo $language['Student Fees List']; ?></a></li>
	  <li class="active"><?php echo $language['Student Fees List Particular']; ?></li>
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
	url: access_link+"fees_monthly/student_fee_delete.php?s_no="+s_no+"&roll_no="+roll_no+"&total_months="+total_months+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('fees_monthly/student_fee_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	</script>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

<?php
$qry0001="select * from login";
$rest0001=mysqli_query($conn73,$qry0001);
$use_editable_or_not='';
while($row0001=mysqli_fetch_assoc($rest0001)){
$use_editable_or_not=$row0001['use_editable_or_not'];
}
if($use_editable_or_not=='Yes'){
    $fee_rec_column_name='editable_receipt_no';
}else{
    $fee_rec_column_name='blank_field_5';
}
?>

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
				  <th>Adm. No.</th>
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
				  <th style="<?php if($_SESSION['fees_panel_edit_button']!='yes'){ echo 'display:none;'; } ?>">Edit</th>
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
	$fee_receipt_pdf =$row['fee_receipt_pdf'];
	$fee_receipt_thermal_pdf = $row['fee_receipt_thermal_pdf'];
}
   ?>                       
                    
                    
				<?php
				$student_roll_no=$_GET['student_roll_no'];
				
                $query11="select student_name,student_father_name,student_class,student_class_section,student_admission_number from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
                $res11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
                $student_admission_number='';
                while($row11=mysqli_fetch_assoc($res11)){
                $student_name=$row11['student_name'];
				$student_father_name=$row11['student_father_name'];
				$student_class=$row11['student_class'];
				$student_class_section=$row11['student_class_section'];
                $student_admission_number=$row11['student_admission_number'];
                }
				
                $que="select * from common_fees_student_fee_add where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active' ORDER BY s_no DESC";
                $run=mysqli_query($conn73,$que);
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$fee_submission_date1=$row['fee_submission_date'];
				if($fee_submission_date1!=''){
				$fee_submission_date=date('d-m-Y',strtotime($fee_submission_date1));
				}else{
				$fee_submission_date=$fee_submission_date1;
				}
				$student_roll_no=$row['student_roll_no'];
				$paid_total=$row['paid_total'];
				$blank_field_5=$row[$fee_rec_column_name];
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
                  <td><?php echo $student_admission_number; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class; ?></td>
				  <td><?php echo $student_class_section; ?></td>
				  <td><?php echo $blank_field_5; ?></td>
				  <td><?php echo $fee_submission_date; ?></td>
				  <td><?php echo $paid_total; ?></td>
				  
				  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
				  
				  <td><button type="button" onclick="post_content('fees_monthly/student_fee_list_particular_details','<?php echo 's_no='.$s_no; ?>')" class="btn btn-primary" ><?php echo $language['Details']; ?></button></td>
				  <td style="<?php if($_SESSION['fees_panel_edit_button']!='yes'){ echo 'display:none;'; } ?>"><button type="button" onclick="post_content('fees_monthly/student_fee_add_form_edit','<?php echo 'student_roll_no='.$student_roll_no.'&fee_month='.$fee_paid_months.'&s_no='.$s_no; ?>')" class="btn btn-primary" >Edit</button></td>
				  <td style="<?php if($_SESSION['sub_panel_fee_list_delete']!='yes'){ echo 'display:none;'; } ?>" ><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','<?php echo $student_roll_no; ?>','<?php echo $fee_paid_months; ?>');" ><?php echo $language['Delete']; ?></button></td>
								
				  <td><a target="_blank" href='<?php echo $pdf_path; ?>fee_receipt/<?php echo $fee_receipt_pdf; ?>?s_no1=<?php echo $s_no; ?>&medium=<?php echo $medium; ?>&shift=<?php echo $shift; ?>&board=<?php echo $board; ?>&months=<?php echo $fee_paid_months; ?>'><button type="button" class="btn btn-primary"><?php echo $language['Print']; ?></button></a></td>
                  <td><a target="_blank" href='<?php echo $pdf_path; ?>fee_receipt/<?php echo $fee_receipt_thermal_pdf; ?>?s_no1=<?php echo $s_no; ?>&medium=<?php echo $medium; ?>&shift=<?php echo $shift; ?>&board=<?php echo $board; ?>&months=<?php echo $fee_paid_months; ?>'><button type="button" class="btn btn-primary"><?php echo $language['Print']; ?></button></a></td>
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