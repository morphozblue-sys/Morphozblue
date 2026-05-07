<?php include("../attachment/session.php")?>
<script>
window.scrollTo(0, 0);
</script>
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
		<li class="active">List</li>
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
                  <th>Serial No.</th>
                  <th>Date</th>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>Designation</th>
                  <th>Amount Type</th>				  
				  <th>Total Amount</th>
				  <th>Bill File</th>
				</tr>
                </thead>
                <tbody>
				<?php
				$emp_or_student_name=$_GET['id'];
				$date=$_GET['date'];
				$total_amount=$_GET['total_amount'];
				$amount_type=$_GET['amount_type'];
				
				$que="select * from account_expence_info where account_status='Active' and  account_customer_date='$date' and account_customer_name='$emp_or_student_name' and account_customer_total_amount='$total_amount' and account_amount_type='$amount_type' and session_value='$session1'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$account_amount_type=$row['account_amount_type'];
				$account_customer_date1=$row['account_customer_date'];
				$account_customer_date2 = explode("-",$account_customer_date1);
	            $account_customer_date=$account_customer_date2[2]."-".$account_customer_date2[1]."-".$account_customer_date2[0];
				$account_customer_name=$row['account_customer_name'];
				$account_customer_address=$row['account_customer_address'];
				$account_customer_designation=$row['account_customer_designation'];
				$account_customer_total_amount=$row['account_customer_total_amount'];
				$bill_upload=$row['bill_upload_name'];

			
				$serial_no++;
                ?>
                
				<tr>
				<td><?php echo $serial_no; ?></td>
				<td><?php echo $account_customer_date; ?></td>
				<td><?php echo $account_customer_name; ?></td>
				<td><?php echo $account_customer_address; ?></td>
				<td><?php echo $account_customer_designation; ?></td>
				<td><?php echo $account_amount_type; ?></td>
				<td><?php echo $account_customer_total_amount; ?></td>
	<td> <img onclick="open_file1('bill_upload','account_document','account_id','<?php echo $s_no;?>');" src="<?php if($bill_upload!=''){ echo $_SESSION['amazon_file_path']."account_document/".$bill_upload; }else{ echo "../".$school_software_path."images/student_blank.png"; }  ?>"  height="50" width="50" style="margin-top:10px;"></td>
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
 <div id="mypdf_view">
			<div>
			<script>
  $(function () {
    $('#example1').DataTable()

  })
</script>