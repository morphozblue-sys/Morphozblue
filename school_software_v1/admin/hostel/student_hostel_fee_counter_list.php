<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
<?php include("../attachment/link_css.php"); ?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> 
<?php include("../attachment/header.php"); ?>
<?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
<script>

function validation(){
var myval=confirm('Do You Want to Delete This Record !!!');
if(myval==true){
return true;
}else{
return false;
}
}

function for_search(){
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;
$.ajax({
type: "POST",
url: "ajax_search_hostel_challan_counter_list.php?from_date="+from_date+"&to_date="+to_date+"",
cache: false,
success: function(detail){
$('#counter_list').html(detail);
  }
});
}

function dialy_report(){
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;
var payment_mode=document.getElementById('payment_mode').value;
window.open('../pdf/hostel_fee_daily_collection.php?from_date='+from_date+'&to_date='+to_date+'&payment_mode='+payment_mode,'_blank');
}
</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fee Counter List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Counter List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-12">
            <div class="col-md-6"><h3>Challan Search Panel</h3></div>
            <div class="col-md-3"></div>			
            <div class="col-md-2">
			<select name="payment_mode" id="payment_mode" class="form-control">
			<option value="All">All</option>
			<option value="Cash">Cash</option>
			<option value="Swep">Swep</option>
			<option value="Cheque">Cheque</option>
			<option value="Online">Online</option>
			</select>
			</div>			
            <div class="col-md-1">
			<button type="button" onclick="dialy_report();" class="btn btn-success">Report</button>
			</div>		
        </div>
		<div class="col-md-12">
		<div class="col-md-3"></div>
		<div class="col-md-3">
		<label>From Date</label>
		<input type="date" name="from_date" id="from_date" oninput="for_search();" class="form-control" />
		</div>
		<div class="col-md-3">
		<label>To Date</label>
		<input type="date" name="to_date" id="to_date" oninput="for_search();" class="form-control" />
		</div>
		<div class="col-md-3"></div>
		</div>
		
        </div>
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12" id="counter_list">
				<table id="example1" class="table table-bordered table-striped">
				<thead >
				<tr>
				  <td>#</td>
				  <td>Date</td>
				  <td>Invoice No</td>
				  <td>admission No</td>
				  <td>Student Name</td>
				  <td>Challan No</td>
				  <td>Payment Mode</td>
				  <td>full / Partial</td>
				  <td>Total Amount</td>
				  <td>Paid Amount</td>
				  <td>Balance</td>
				  <td>Remark</td>
				  <td>Action</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$query="select * from student_hostel_fees_counter where session_value='$session1' ORDER BY s_no DESC";
				$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($res)){
				$s_no=$row['s_no'];
				$student_roll_no=$row['student_roll_no'];
				$challan_no=$row['challan_no'];
				$installment_no=$row['installment_no'];
				$payment_mode=$row['payment_mode'];
				$challan_full_partial=$row['challan_full_partial'];
				$challan_amount=$row['challan_amount'];
				$challan_paid_amount=$row['challan_paid_amount'];
				$challan_balance=$row['challan_balance'];
				$challan_remark=$row['challan_remark'];
				$date=$row['date'];
				$date1=explode('-',$date);
				$date=$date1[2].'-'.$date1[1].'-'.$date1[0];
				$serial_no++;
				
				$query2="select * from student_admission_info where session_value='$session1' and student_roll_no='$student_roll_no'";
				$res2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
				while($row2=mysqli_fetch_assoc($res2)){
				$student_name=$row2['student_name'];
				$student_admission_number=$row2['student_admission_number'];
				}
				
				$query1="select * from student_hostel_fees_paid where challan_no='$challan_no' and session_value='$session1'";
				$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
				while($row1=mysqli_fetch_assoc($res1)){
				$verify=$row1['verify'];
				}
				?>
				<tr>
				<td><?php echo $serial_no.'.'; ?></td>
				<td><?php echo $date; ?></td>
				<td><?php echo $s_no; ?></td>
				<td><?php echo $student_admission_number; ?></td>
				<td><?php echo $student_name; ?></td>
				<td><?php echo $challan_no; ?></td>
				<td><?php echo $payment_mode; ?></td>
				<td><?php echo $challan_full_partial; ?></td>
				<td><?php echo $challan_amount; ?></td>
				<td><?php echo $challan_paid_amount; ?></td>
				<td><?php echo $challan_balance; ?></td>
				<td><?php echo $challan_remark; ?></td>
				<td><a href="student_hostel_fee_counter_edit.php?challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-info" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Edit</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="student_hostel_fee_counter_delete.php?s_no=<?php echo $s_no; ?>" onclick="return validation();"><button type="button" class="btn btn-danger" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Delete</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../pdf/hostel_invoice.php?challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-success">Print</button><a></td>
				</tr>
				<?php
				}
				?>
				</tbody>
				</table>
			  </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
</div>
 <?php include("../attachment/link_js.php"); ?>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>