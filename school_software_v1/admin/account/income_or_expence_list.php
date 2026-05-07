<?php include("../attachment/session.php")?>

<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_account(s_no);       
 }else{      
return false;
 }       
  }
function  delete_account(s_no){
$.ajax({
type: "POST",
url: access_link+"account/income_or_expence_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Deleted');
				   get_content('account/income_or_expence_list');
			   }else if(res[1]=='session_not_set'){
                alert_new('Session Expire !!!','red');
            }else{
              //  alert_new(detail); 
			   }
}
});
}

function open_file1(image_type,s_no){

$.ajax({
address: "POST",
url: access_link+"account/ajax_open_image.php?image_type="+image_type+"&s_no="+s_no+"",
cache: false,
success: function(detail){
 $("#mypdf_view").html('');
 $("#mypdf_view").html(detail);
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
		<li><a href="javascript:get_content('account/add_income_or_expence_info')"><i class="fa fa-user-plus"></i><?php echo $language['Add Info']; ?></a></li>
		<li><i class="Active"></i><?php echo $language['List']; ?></li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th></i><?php echo $language['S No']; ?></th>
                  <th></i><?php echo $language['Date']; ?></th>
                  <th></i><?php echo $language['Customer Name']; ?></th>
                  <th></i><?php echo $language['Address']; ?></th>
                  <th></i><?php echo $language['Designation']; ?></th>
                  <th></i><?php echo $language['Amount Type']; ?></th>				  
				  <th></i><?php echo $language['Total Amount']; ?></th>
				  <th></i><?php echo $language['Bill File']; ?></th>
				  
				  
				  <th>Update By</th>
                  <th>Date</th>
				  <th style="<?php if($_SESSION['account_panel_edit_button']!='yes'){echo 'display:none'; } ?>"></i><?php echo $language['Edit']; ?></th>
				  <th style="<?php if($_SESSION['account_panel_delete_button']!='yes'){echo 'display:none'; } ?>"></i><?php echo $language['Delete']; ?></th>
				  <th></i><?php echo 'Print Voucher'; ?></th>
				</tr>
                </thead>
                <tbody>
				<?php
				$que321="select * from school_info_pdf_info";
                $run321=mysqli_query($conn73,$que321);
                while($row321=mysqli_fetch_assoc($run321)){
	            $account_payment_voucher = $row321['account_payment_voucher'];
                }
				$que="select * from account_expence_info where account_status='Active'  and session_value='$session1' ORDER BY s_no DESC";
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
				$blank_field_3=$row['blank_field_3'];
				
                $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
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
			
				<td> <img onclick="open_file1('bill_upload','<?php echo $s_no11; ?>');" src="<?php if($bill_upload!=''){ echo $_SESSION['amazon_file_path']."account_document/".$bill_upload; }else{ echo "../".$school_software_path."images/student_blank.png"; }  ?>"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>
				
                <td style="<?php if($_SESSION['account_panel_edit_button']!='yes'){echo 'display:none'; } ?>"><button type="button"  onclick="post_content('account/income_or_expence_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" style="<?php if($blank_field_3=='Refund'){ echo 'display:none;'; } ?>"><?php echo $language['Edit']; ?></button></td>
                <td style="<?php if($_SESSION['account_panel_delete_button']!='yes'){echo 'display:none'; } ?>"><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');"><?php echo $language['Delete']; ?></button></td>
			    <td><a href='<?php echo $pdf_path; ?>account_voucher/<?php echo $account_payment_voucher; ?>?id=<?php echo $s_no; ?>' target="_blank"><button type="button" class="btn btn-success" style="<?php if($blank_field_3=='Refund'){ echo 'display:none;'; } ?>"><?php echo $language['Print']; ?></button></a></td>
			
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
</div>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
