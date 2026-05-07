<?php include("../attachment/session.php"); ?>

<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/opening_balance_edit_api.php",
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

<?php
$edit_record=$_GET['id'];
$que1="select * from new_stock_ledger where ledger_status='Active' and session_value='$session1' and s_no='$edit_record'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$ledger_invoice_date=$row1['ledger_invoice_date'];
$ledger_payable_amount=$row1['ledger_payable_amount'];
}
?>

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
                  <input type="number" name="opening_balance" placeholder="Opening Balance" value="<?php echo $ledger_payable_amount; ?>" class="form-control" required />
                  <input type="hidden" name="edit_record" value="<?php echo $edit_record; ?>" class="form-control" />
                </div>
				</div>
				
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
		</form>
          
		  </div>
		  
    </div>
</section>
