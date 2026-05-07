<?php include("../attachment/session.php"); ?>
<style>
    .btnadd{
        float: right;
    padding-right: 55px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#addmore").click(function(){
           var cnt = parseInt($('#item_table tr').length)+1;
            var markup = "<tr id='tr_"+cnt+"'><td><select name='item_name[]' class='form-control select2' id='item_name_"+cnt+"' style='width:100%;' required ><option value=''>Select Item</option><?php $query_v = "select * from new_stock_item where stock_item_status='Active'";$reslt_v = mysqli_query($conn73,$query_v);while($row_v=mysqli_fetch_assoc($reslt_v)){ $item_s_no=$row_v['s_no'];$item_name=$row_v['item_name'];$item_description=$row_v['item_description'];$item_class=$row_v['item_class']; ?><option value='<?php echo $item_s_no; ?>'><?php echo $item_name.' ['.$item_class.']-['.$item_description.']'; ?></option><?php } ?></select></td><td><input type='number' name='item_quantity[]' placeholder='Item Quantity' oninput='for_total("+cnt+");' id='item_quantity_"+cnt+"' class='form-control itm_quantity' step='0.01' required /></td><td><input type='number' name='item_rate[]' placeholder='Item Rate' oninput='for_total("+cnt+");' id='item_rate_"+cnt+"' class='form-control' step='0.01' required /></td><td><input type='number' name='item_total[]' placeholder='Total Amount' id='item_total_"+cnt+"' class='form-control total_amt' step='0.01' required readonly /></td><td><input type='button' class='btn btn-danger' value='Remove Row' onclick='remove_row("+cnt+")'></td></tr>";
            $("table tbody").append(markup);
            $('.select2').select2();
        });
    });
    function remove_row(id){
        //alert_new(id);
        $('#tr_'+id).remove();
        total_quantity();
        grand_total();
    }
</script>
<script>
function for_total(serial_no){
    var item_quantity=document.getElementById('item_quantity_'+serial_no).value;
    var item_rate=document.getElementById('item_rate_'+serial_no).value;
    if(item_quantity!='' && item_rate!=''){
        var item_total=parseFloat(item_quantity)*parseFloat(item_rate);
        $('#item_total_'+serial_no).val(item_total.toFixed(2));
    }else{
        $('#item_total_'+serial_no).val('0.00');
    }
    total_quantity();
    grand_total();
}
function grand_total(){
    var grand_total=0;
    $('.total_amt').each(function() {
    grand_total += Number($(this).val());
    });
    $('#label_item_grand_total').html(grand_total.toFixed(2));
    $('#item_grand_total').val(grand_total.toFixed(2));
    
    var disc_amt=document.getElementById('total_discount_amount').value;
    if(disc_amt!=''){
    var payable_amt=parseFloat(grand_total)-parseFloat(disc_amt);
    $('#total_payable_amount').val(payable_amt.toFixed(2));
    }else{
    $('#total_payable_amount').val(grand_total.toFixed(2));
    }
}
function total_quantity(){
    var total_qty=0;
    $('.itm_quantity').each(function() {
    total_qty += Number($(this).val());
    });
    $('#label_grand_total_quantity').html(total_qty.toFixed(2));
    $('#grand_total_quantity').val(total_qty.toFixed(2));
}

function for_payment(value){
    if(value=='Cheque'){
        $('#for_cheque_date').show();
        $('#for_cheque_no').show();
        $('#for_cheque_name').show();
        $('#for_neft_account_no').hide();
        $('#for_neft_bank_name').hide();
    }else if(value=='NEFT'){
        $('#for_neft_account_no').show();
        $('#for_neft_bank_name').show();
        $('#for_cheque_date').hide();
        $('#for_cheque_no').hide();
        $('#for_cheque_name').hide();
        }else{
        $('#for_cheque_date').hide();
        $('#for_cheque_no').hide();
        $('#for_cheque_name').hide();
        $('#for_neft_account_no').hide();
        $('#for_neft_bank_name').hide();
    }
}

 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/buy_item_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('stock_management/buy_item_list');
            }
			}
         });
      });
</script>
<?php
$invoice_number = $_GET['id'];
$query12 = "select * from purchase_detail where invoice_number='$invoice_number' and session_value='$session1' and purchase_status='Active'";
$result12 = mysqli_query($conn73,$query12) or die(mysqli_error($conn73));
$item_count=0;
while($row12 = mysqli_fetch_assoc($result12)){
$vendor_s_no1=$row12['vendor_s_no'];
$invoice_number=$row12['invoice_number'];
$invoice_date=$row12['invoice_date'];

$item_s_no1[$item_count]=$row12['item_s_no'];
$quantity[$item_count]=$row12['quantity'];
$rate[$item_count]=$row12['rate'];
$total_amount[$item_count]=$row12['total_amount'];

$total_quantity=$row12['total_quantity'];
$grand_total=$row12['grand_total'];
$discount_remark=$row12['discount_remark'];
$discount_amount=$row12['discount_amount'];
$payable_amount=$row12['payable_amount'];
$payment_mode=$row12['payment_mode'];
$cheque_bank_name=$row12['cheque_bank_name'];
$cheque_date=$row12['cheque_date'];
$cheque_number=$row12['cheque_number'];
$neft_bank_name=$row12['neft_bank_name'];
$neft_bank_acount_number=$row12['neft_bank_acount_number'];
$add_in_stock=$row12['add_in_stock'];

$item_count++;
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
        <li class="active">Buy Item Edit</li>
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
              <h1 class="box-title"><b>Purchase Invoice Edit</b></h1>
              <div class="btnadd">
              </div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
				
				<div class="col-md-4">
    			    <div class ="form-group">
    			        <label>Vendor's <span style="color:red;">*</span></label>
                        <select class="form-control select2" name="vendor_id" style="width:100%;" required >
                            <option value="">Select Vendor</option>
                            <?php
                            $query_v = "select * from vendor_detail where vendor_status='Active'";
                            $reslt_v = mysqli_query($conn73,$query_v);
                            while($row_v=mysqli_fetch_assoc($reslt_v)){
                                $vendor_s_no=$row_v['s_no'];
                                $vendor_name=$row_v['vendor_name'];
                                $vendor_contact=$row_v['vendor_contact'];
                                $vendor_email=$row_v['vendor_email'];
                            
                            ?>
                            <option <?php if($vendor_s_no1==$vendor_s_no){ echo 'selected'; } ?> value="<?php echo $vendor_s_no; ?>"><?php echo $vendor_name.' ['.$vendor_contact.']'; ?></option>
                            <?php } ?>
                        </select>        
                    </div>
                </div>
                
                <div class="col-md-2">
    			    <div class ="form-group">
    			        <label>Date <span style="color:red;">*</span></label>
                        <input type="date" name="invoice_date" class="form-control" id="invoice_date" value="<?php echo $invoice_date; ?>" required />
                    </div>
                </div>
                
                <div class="col-md-2">
    			    <div class ="form-group">
    			        <label>Invoice No. <span style="color:red;">*</span></label>
                        <input type="number" name="invoice_no" class="form-control" id="invoice_no" value="<?php echo $invoice_number; ?>" required readonly />
                    </div>
                </div>
                
                <div class="col-md-12">
				<table class="table table-responsive">
				    <thead>
				        <tr>
    				        <th>Item Name <span style="color:red;">*</span></th>
    				        <th>Quantity <span style="color:red;">*</span></th>
    				        <th>Rate <span style="color:red;">*</span></th>
    				        <th>Total <span style="color:red;">*</span></th>
    				        <th>Action</th>
				        </tr>
				    </thead>
				    <tbody id="item_table">
    				    <?php $serial_no=0; for($i=0; $i<$item_count; $i++){ $serial_no++; ?>
    				    <tr id="<?php echo 'tr_'.$serial_no; ?>">
    				        <td>
        				        
                                <select name="item_name[]" class="form-control select2" id="<?php echo 'item_name_'.$serial_no; ?>" style="width:100%;" required >
                                <option value="">Select Item</option>
                                <?php
                                $query_v = "select * from new_stock_item where stock_item_status='Active'";
                                $reslt_v = mysqli_query($conn73,$query_v);
                                while($row_v=mysqli_fetch_assoc($reslt_v)){
                                $item_s_no=$row_v['s_no'];
                                $item_name=$row_v['item_name'];
                                $item_description=$row_v['item_description'];
                                $item_class=$row_v['item_class'];
                                ?>
                                <option <?php if($item_s_no1[$i]==$item_s_no){ echo 'selected'; } ?> value="<?php echo $item_s_no; ?>"><?php echo $item_name.' ['.$item_class.']-['.$item_description.']'; ?></option>
                                <?php } ?>
                                </select>
                        
    				        </td>
    				        <td>
    					       <input type='number' name='item_quantity[]' placeholder='Item Quantity' oninput="for_total('<?php echo $serial_no; ?>');" id="<?php echo 'item_quantity_'.$serial_no; ?>" value="<?php echo $quantity[$i]; ?>" class='form-control itm_quantity' step="0.01" required />
    				        </td>
    				        <td>
    				            <input type='number' name='item_rate[]' placeholder='Item Rate' oninput="for_total('<?php echo $serial_no; ?>');" id="<?php echo 'item_rate_'.$serial_no; ?>" value="<?php echo $rate[$i]; ?>" class='form-control' step="0.01" required />
    				        </td>
    				        <td>
    				            <input type='number' name='item_total[]' placeholder='Total Amount' id="<?php echo 'item_total_'.$serial_no; ?>" value="<?php echo $total_amount[$i]; ?>" class='form-control total_amt' step="0.01" required readonly />
    				        </td>
    				        <td>
    				           <?php if($i==0){ ?>
    					       <input type="button" value="Add More +" class="btn btn-warning" id="addmore" >
    					       <?php }else{ ?>
    					       <input type="button" class="btn btn-danger" value="Remove Row" onclick="remove_row('<?php echo $serial_no; ?>')" >
    					       <?php } ?>
    				        </td>
    				    </tr>
    				    <?php } ?>
				    </tbody>
				    <tfoot>
				        <!--<tr>
    				        <td colspan="5"><hr/></td>
				        </tr>-->
				        <tr>
    				        <td>&nbsp;</td>
    				        <td>
    				        <label>Total Quantity  :-  <span style="color:red;" id="label_grand_total_quantity"><?php echo $total_quantity; ?></span></label>
    				        <input type='hidden' name='grand_total_quantity' placeholder='Total Quantity' id="grand_total_quantity" value="<?php echo $total_quantity; ?>" class='form-control' required readonly />
    				        </td>
    				        <td>&nbsp;</td>
    				        <td>
    				        <label>Grand Total  :-  <span style="color:red;" id="label_item_grand_total"><?php echo $grand_total; ?></span></label>
    				        <input type='hidden' name='item_grand_total' placeholder='Grand Total' id="item_grand_total" value="<?php echo $grand_total; ?>" class='form-control' required readonly />
    				        </td>
    				        <td>&nbsp;</td>
				        </tr>
				    </tfoot>
				</table>
				</div>
				<div class="col-md-12">
				    
				    <div class="col-md-2">
    				<div class="form-group">
                      <label>Discount Remark</label>
                      <input type="text" name="total_discount_remark" id="total_discount_remark" value="<?php echo $discount_remark; ?>" placeholder="Discount Remark" class="form-control" />
                    </div>
                    </div>
				    
				    <div class="col-md-2">
    				<div class="form-group">
                      <label>Total Discount Amount</label>
                      <input type="number" name="total_discount_amount" id="total_discount_amount" oninput="grand_total();" value="<?php echo $discount_amount; ?>" placeholder="Total Discount Amount" class="form-control" step="0.01" />
                    </div>
                    </div>
                    
                    <div class="col-md-2">
    				<div class="form-group">
                      <label>Total Payable Amount <span style="color:red;">*</span></label>
                      <input type="number" name="total_payable_amount" id="total_payable_amount" value="<?php echo $payable_amount; ?>" placeholder="Total Payable Amount" class="form-control" step="0.01" required />
                    </div>
                    </div>
				    
				    <div class="col-md-2">
				    <div class="form-group">
                        <label><?php echo $language['Payment Mode']; ?> <span style="color:red;">*</span></label>
                        <select name="payment_mode" class="form-control" onchange="for_payment(this.value);" id="payment_mode" required >
                        <option <?php if($payment_mode=='Cash'){ echo 'selected'; } ?> value="Cash"><?php echo $language['Cash']; ?></option>
                        <option <?php if($payment_mode=='Cheque'){ echo 'selected'; } ?> value="Cheque"><?php echo $language['Cheque']; ?></option>
                        <option <?php if($payment_mode=='NEFT'){ echo 'selected'; } ?> value="NEFT"><?php echo $language['NEFT Net Banking']; ?></option>
                        </select>
				    </div>
				    </div>
				    
			        <div class="col-md-2" id="for_cheque_name" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Bank Name']; ?></label>
                      <input type="text" name="cheque_bank_name" placeholder="Bank Name" value="<?php echo $cheque_bank_name; ?>" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_cheque_no" style="display:none;">
    				<div class="form-group">
                      <label>Cheque No</label>
                      <input type="text" name="cheque_no" placeholder="Cheque No." value="<?php echo $cheque_number; ?>" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_cheque_date" style="display:none;">
    				<div class="form-group">
                      <label>Cheque Date</label>
                      <input type="date" name="cheque_date" placeholder="Cheque Date" value="<?php echo $cheque_date; ?>" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_neft_bank_name" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Bank Name']; ?></label>
                      <input type="text" name="neft_bank_name" placeholder="Bank Name" value="<?php echo $neft_bank_name; ?>" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_neft_account_no" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Account No']; ?></label>
                      <input type="text" name="neft_bank_account_no" placeholder="Account No." value="<?php echo $neft_bank_acount_number; ?>" class="form-control">
                    </div>
                    </div>
				    
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  </form>
    </div>
</section>

<script>
for_payment('<?php echo $payment_mode; ?>');
$(function () {
$('.select2').select2();
});
</script>

