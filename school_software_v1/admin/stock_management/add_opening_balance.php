<?php include("../attachment/session.php"); ?>

<script>
function valid(s_no){   
    var myval=confirm("Are you sure want to delete this record !!!!");
    if(myval==true){
        delete_record(s_no);       
    }            
    else  {      
        return false;
    }
}

function delete_record(s_no){
$.ajax({
type: "POST",
url: access_link+"stock_management/opening_balance_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Deleted','green');
            get_content('stock_management/add_opening_balance');
        }else{
            //alert_new(detail); 
	    }
    }
});
}


 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/add_opening_balance_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                ////alert_new(detail);
                //$('#trial_detail').html(detail);
              var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Complete','green');
				  get_content('stock_management/add_opening_balance');
            }
			}
         });
      });
</script>


   <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Add Opening Balance</li>
        </ol>
    </section>
	
	
	<!---*******************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b>Add Opening Balance</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
            <div class="box-body">
				<form role="form" method="post" id="my_form" enctype="multipart/form-data">
				<div class="col-md-12 col-md-offset-4">
                
                <!--<div class="col-md-4">						
				<div class="form-group">
                  <label >Opening Balance Remark</label>
                  <input type="text" name="opening_balance_remark" placeholder="Opening Balance Remark" class="form-control" />
                </div>
				</div>-->
				
				<div class="col-md-4">						
				<div class="form-group">
                  <label >Opening Balance <span style="color:red;">*</span></label>
                  <input type="number" name="opening_balance" placeholder="Opening Balance" class="form-control" required />
                </div>
				</div>
				
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
		</form>
          
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-6 col-md-offset-3">
            
            <table class="table table-responsive">
                <thead>
                    <th>S.No.</th>
                    <th>Date</th>
                    <th>Opening Balance</th>
                    <th>Action</th>
                </thead>
                <?php
                $que1="select * from new_stock_ledger where ledger_status='Active' and session_value='$session1' and ledger_type='' and ledger_invoice_no='0' and ledger_student_customer_id='0'";
                $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
                $serial_no=0;
                while($row1=mysqli_fetch_assoc($run1)){
                $s_no=$row1['s_no'];
                $ledger_invoice_date=$row1['ledger_invoice_date'];
                $ledger_payable_amount=$row1['ledger_payable_amount'];
                if($ledger_invoice_date!='' && $ledger_invoice_date!='0000-00-00'){
                	$ledger_invoice_date=date('d-m-Y',strtotime($ledger_invoice_date));
                }
                
                $serial_no++;
                ?>
                <tbody>
                    <td><?php echo $serial_no.'.'; ?></td>
                    <td><?php echo $ledger_invoice_date; ?></td>
                    <td><?php echo $ledger_payable_amount; ?></td>
                    <td>
                    <a href="javascript:post_content('stock_management/opening_balance_edit','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button>
                    </td>
                </tbody>
                <?php } ?>
            </table>
            
          </div>
          
		  </div>
		  
    </div>
</section>
