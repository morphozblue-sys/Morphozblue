<?php include("../attachment/session.php")?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_account(s_no);       
 }            
else  {      
return false;
 }       
  }
function  delete_account(s_no){
$.ajax({
type: "POST",
url: access_link+"account/bank_account_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  // alert_new('Successfully Deleted');
				   get_content('account/account_list');
			   }else{
            //    alert_new(detail); 
			   }
}
});
}
</script>
				<section class="content-header">
				  <h1>
					 <?php echo $language['Account Management']; ?>
					<small><?php echo $language['Control Panel']; ?></small>
				  </h1>
				  <ol class="breadcrumb">
			      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		            <li class="active"><?php echo $language['Account List']; ?></li>
				  </ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
					 
							<!-- /.box -->

							<div class="box <?php echo $box_head_color; ?> ">
								<div class="box-header with-border">
								  <h3 class="box-title"><?php echo $language['Account List']; ?></h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead >
											<tr>
											   <th><?php echo $language['S No']; ?></th>
											   <th><?php echo $language['Account Holder Name']; ?></th>
											  <th><?php echo $language['Account No']; ?></th>
											  <th><?php echo "Opening Balance"; ?></th>
											  <th><?php echo "Current Balance"; ?></th>
											  <th><?php echo $language['Bank Name']; ?></th>
											  <th><?php echo $language['Bank Branch Name']; ?></th>
											  <th><?php echo $language['Bank Ifsc Code']; ?></th>
											  <th style="<?php if($_SESSION['sub_panel_account_list_edit']!='yes'){echo 'display:none'; } ?>"><?php echo $language['Edit']; ?></th>
											  <th style="<?php if($_SESSION['sub_panel_account_list_delete']!='yes'){echo 'display:none'; } ?>"><?php echo $language['Delete']; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php
												



												$que="select * from account_office_bank_account";
												$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
												$serial_no=0;


											
												while($row=mysqli_fetch_assoc($run)){

													 $s_no=$row['s_no'];
													 $bank_account_holder_name =$row['bank_account_holder_name'];
													 $bank_account_no=$row['bank_account_no'];
													 $account_opening_balance=$row['account_opening_balance'];
													 $bank_name=$row['bank_name'];
													 $bank_branch_name=$row['bank_branch_name'];
													 $bank_ifsc_code=$row['bank_ifsc_code'];
													
													$serial_no++;
												
												$que1="select SUM(total_amount) AS credit_total from ledger_info where ledger_status='Active' and session_value='$session1' and amount_type='Credit' and office_account_sno='$s_no'";
												$run1=mysqli_query($conn73,$que1);
												$current_balance=0;
												$row1=mysqli_fetch_assoc($run1);
												$credit_total=$row1['credit_total'];
												
												$que2="select SUM(total_amount) AS debit_total from ledger_info where ledger_status='Active' and session_value='$session1' and amount_type='Debit' and office_account_sno='$s_no'";
												$run2=mysqli_query($conn73,$que2);
												$row2=mysqli_fetch_assoc($run2);
												$debit_total=$row2['debit_total'];
											
											$current_balance=$credit_total-$debit_total;
											
											?>
												
                    <tr>
                        <td><?php echo $serial_no; ?></td>
                        <td><?php echo $bank_account_holder_name; ?></td>
                        <td><?php echo $bank_account_no; ?></td>
                        <td><?php echo $account_opening_balance; ?></td>
                        <td><?php echo $current_balance; ?></td>
                        <td><?php echo $bank_name; ?></td>
                        <td><?php echo $bank_branch_name; ?></td>
                        <td><?php echo $bank_ifsc_code; ?></td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" style="<?php if($_SESSION['sub_panel_account_list_edit']!='yes'){echo 'display:none'; } ?>" ><?php echo $language['Edit']; ?></button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" style="<?php if($_SESSION['sub_panel_account_list_delete']!='yes'){echo 'display:none'; } ?>" ><?php echo $language['Delete']; ?></button>
                        </td>
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
<script>
  $(function () {
    $('#example1').DataTable()

  })
</script>