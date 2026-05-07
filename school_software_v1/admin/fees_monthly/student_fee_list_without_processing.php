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
	  <li class="active"><?php echo $language['Student Fees List']; ?></li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
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
				  <th><?php echo $language['Student Section']; ?></th>
                  <th><?php echo $language['Submission Date']; ?></th>
				  <th><?php echo $language['Total Fee']; ?></th>
				  <th><?php echo $language['Total Paid']; ?></th>
				  <th><?php echo $language['Remaining Fee']; ?></th>
				  <th><?php echo $language['Details']; ?></th>
                </tr>
                </thead>
                <tbody>
                
				<?php				
                $que="select * from common_fees_student_fee_add where session_value='$session1' and fee_status='Active'$filter37 group by student_roll_no ORDER BY s_no DESC";
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
				$paid_amount=$row['paid_total'];
				$serial_no++;
                
				$que1="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
                $run1=mysqli_query($conn73,$que1);
                while($row1=mysqli_fetch_assoc($run1)){
				$paid_total=$row1['paid_total'];
				$balance_total=$row1['balance_total'];
				$grand_total=$row1['grand_total'];
                ?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class; ?></td>
				  <td><?php echo $student_class_section; ?></td>
				  <td><?php echo $fee_submission_date; ?></td>
				  <td><?php echo $grand_total; ?></td>
				  <td><?php echo $paid_total; ?></td>
				  <td><?php echo $balance_total; ?></td>
				  <td><button type="button"  onclick="post_content('fees_monthly/student_fee_list_particular','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-default my_background_color" >Details</button></td>
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
    <!-- /.content -->
    <script>
$(function () {
$('#example1').DataTable()
})

</script>