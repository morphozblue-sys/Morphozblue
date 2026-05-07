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
            var markup = "<tr id='tr_"+cnt+"'><td><select name='item_class[]' id='item_class_"+cnt+"' onchange='for_item("+cnt+");' class='form-control' required><option value=''>Select</option><?php $class37=$_SESSION['class_name37']; $class371=explode('|?|',$class37); $total_class=$_SESSION['class_total37']; for($q=0;$q<$total_class;$q++){ $class_name=$class371[$q]; ?><option value='<?php echo $class_name; ?>'><?php echo $class_name; ?></option><?php } ?></select></td><td><select name='item_category[]' id='item_category_"+cnt+"' onchange='for_item("+cnt+");' class='form-control' required><option value=''>Select</option><?php $que="select * from category_detail where category_status='Active' and (s_no='2' or s_no='3' or s_no='4')"; $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73)); while($row=mysqli_fetch_assoc($run)){ $category_s_no=$row['s_no']; $category_name=$row['category_name']; ?><option value='<?php echo $category_s_no; ?>'><?php echo $category_name; ?></option><?php } ?></select></td><td><select name='item_name[]' class='form-control select2' id='item_name_"+cnt+"' onchange='item_detail("+cnt+");' style='width:100%;' required ><option value=''>Select Item</option><?php $query_v="select nst.*, ns.available_stock from new_stock_item as nst join new_stock as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active' and ns.new_stock_status='Active'"; $reslt_v = mysqli_query($conn73,$query_v); while($row_v=mysqli_fetch_assoc($reslt_v)){ $item_s_no=$row_v['s_no']; $item_name=$row_v['item_name']; $item_description=$row_v['item_description']; $item_class=$row_v['item_class']; $available_stock=$row_v['available_stock']; ?><option value='<?php echo $item_s_no; ?>' <?php if($available_stock<=0){ echo 'disabled'; } ?>><?php echo $item_name.' ['.$item_class.']-['.$item_description.']'; ?></option><?php } ?></select></td><td><input type='number' name='item_quantity[]' placeholder='Item Quantity' oninput='for_total("+cnt+");' id='item_quantity_"+cnt+"' class='form-control itm_quantity' step='0.01' required /></td><td><input type='number' name='item_rate[]' placeholder='Item Rate' oninput='for_total("+cnt+");' id='item_rate_"+cnt+"' class='form-control' step='0.01' required /><input type='hidden' name='available_stock[]' placeholder='Available Stock' id='available_stock_"+cnt+"' class='form-control' step='0.01' /></td><td><input type='number' name='item_total[]' placeholder='Total Amount' id='item_total_"+cnt+"' class='form-control total_amt' step='0.01' required readonly /></td><td><input type='button' class='btn btn-danger' value='Remove Row' onclick='remove_row("+cnt+")'></td></tr>";
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
// function for_detail(){
//     var sales_type=$('input[name=sales_type]:checked').val();
//     $('#label_student_customer_id').html(sales_type+'s Name');
//     $.ajax({
//     type: "POST",
//     url: access_link+"stock_management/ajax_get_sales_type_details.php?sales_type="+sales_type+"",
//     cache: false,
//     success: function(detail){
//     $('#student_customer_id').html(detail);
//     }
//     });
// }

function item_detail(serial_no){
    
    // var item_row_count=0;
    // $('.select2').each(function() {
    // item_row_count += Number($(this).val());
    // });
    
    var item_s_no=document.getElementById('item_name_'+serial_no).value;
    $.ajax({
    type: "POST",
    url: access_link+"stock_management/ajax_get_stock_return_details.php?item_s_no="+item_s_no+"",
    cache: false,
    success: function(detail){
    var res=detail.split('|?|');
    $('#item_quantity_'+serial_no).prop('max',res[1]);
    $('#available_stock_'+serial_no).val(res[1]);
    $('#item_rate_'+serial_no).val(res[2]);
    for_total(serial_no);
    }
    });
}

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

function for_item(s_no){
    var item_class=document.getElementById('item_class_'+s_no).value;
    var item_category=document.getElementById('item_category_'+s_no).value;
    
    $.ajax({
	  type: "POST",
	  url: access_link+"stock_management/ajax_get_stock_return_list.php?item_class="+item_class+"&item_category="+item_category+"",
	  cache: false,
	  success: function(detail){
		$("#item_name_"+s_no).html(detail);
	  }
   });
    
}

 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/stock_return_api.php",
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
				   get_content('stock_management/stock_return_list');
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
        <li class="active">Stock Return</li>
        </ol>
    </section>
	<!---*******************************************************************************************************************************************************************-->
    <form role="form" method="post" id="my_form" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <div class="col-md-4"><h1 class="box-title"><b>Create Books Stock Return Invoice</b></h1></div>
              <div class="col-md-4">&nbsp;</div>
              <div class="col-md-4">&nbsp;</div>
              <div class="btnadd">
              </div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
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
                            <option value="<?php echo $vendor_s_no; ?>"><?php echo $vendor_name.' ['.$vendor_contact.']'; ?></option>
                            <?php } ?>
                        </select>        
                    </div>
                </div>
                
                <div class="col-md-2">
    			    <div class ="form-group">
    			        <label>Date <span style="color:red;">*</span></label>
                        <input type="date" name="invoice_date" class="form-control" id="invoice_date" value="<?php echo date('Y-m-d'); ?>" required />
                    </div>
                </div>
                
                <div class="col-md-2">
    			    <div class ="form-group">
    			        <?php
                            $query_w = "select * from login";
                            $reslt_w = mysqli_query($conn73,$query_w);
                            $invoice_no='';
                            while($row_w=mysqli_fetch_assoc($reslt_w)){
                                $invoice_no=$row_w['sale_invoice_'.$session1];
                            }
                            ?>
    			        <label>Invoice No. <span style="color:red;">*</span></label>
                        <input type="number" name="invoice_no" class="form-control" id="invoice_no" value="<?php echo $invoice_no; ?>" required readonly />
                    </div>
                </div>
                
                <div class="col-md-12">
				<table class="table table-responsive">
				    <thead>
				        <tr>
    				        <th>Class <span style="color:red;">*</span></th>
    				        <th>Category <span style="color:red;">*</span></th>
    				        <th>Item Name <span style="color:red;">*</span></th>
    				        <th>Quantity <span style="color:red;">*</span></th>
    				        <th>Rate <span style="color:red;">*</span></th>
    				        <th>Total <span style="color:red;">*</span></th>
    				        <th>Action</th>
				        </tr>
				    </thead>
				    <tbody id="item_table">
    				    <tr>
    				        <td>
                                <select name="item_class[]" id="item_class_1" onchange="for_item('1');" class="form-control" required>
                                <option value="">Select</option>
                                <?php 
                                $class37=$_SESSION['class_name37'];
                                $class371=explode('|?|',$class37);
                                $total_class=$_SESSION['class_total37'];
                                for($q=0;$q<$total_class;$q++){
                                $class_name=$class371[$q]; ?>
                                <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
                                <?php } ?>
                                </select>
    				        </td>
    				        <td>
                                <select name="item_category[]" id="item_category_1" onchange="for_item('1');" class="form-control" required>
                                <option value="">Select</option>
                                <?php
                                $que="select * from category_detail where category_status='Active' and (s_no='2' or s_no='3' or s_no='4')";
                                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                                while($row=mysqli_fetch_assoc($run)){
                                $category_s_no=$row['s_no'];
                                $category_name=$row['category_name'];
                                ?>
                                <option value="<?php echo $category_s_no; ?>"><?php echo $category_name; ?></option>
                                <?php } ?>
                                </select>
    				        </td>
    				        <td>
        				        
                                <select name="item_name[]" class="form-control select2" id="item_name_1" onchange="item_detail('1');" style="width:100%;" required >
                                <option value="">Select Item</option>
                                <?php
                                $query_v="select nst.*, ns.available_stock from new_stock_item as nst join new_stock as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active' and ns.new_stock_status='Active'";
                                $reslt_v = mysqli_query($conn73,$query_v);
                                while($row_v=mysqli_fetch_assoc($reslt_v)){
                                $item_s_no=$row_v['s_no'];
                                $item_name=$row_v['item_name'];
                                $item_class=$row_v['item_class'];
                                $item_description=$row_v['item_description'];
                                
                                $available_stock=$row_v['available_stock'];
                                ?>
                                <option value="<?php echo $item_s_no; ?>" <?php if($available_stock<=0){ echo 'disabled'; } ?>><?php echo $item_name.' ['.$item_class.']-['.$item_description.']'; ?></option>
                                <?php } ?>
                                </select>
                        
    				        </td>
    				        <td>
    					       <input type='number' name='item_quantity[]' placeholder='Item Quantity' oninput="for_total('1');" id="item_quantity_1" class='form-control itm_quantity' step="0.01" required />
    				        </td>
    				        <td>
    				            <input type='number' name='item_rate[]' placeholder='Item Rate' oninput="for_total('1');" id="item_rate_1" class='form-control' step="0.01" required />
    				            <input type='hidden' name='available_stock[]' placeholder='Available Stock' id="available_stock_1" class='form-control' step="0.01" />
    				        </td>
    				        <td>
    				            <input type='number' name='item_total[]' placeholder='Total Amount' id="item_total_1" class='form-control total_amt' step="0.01" required readonly />
    				        </td>
    				        <td>
    					       <input type="button" value="Add More +" class="btn btn-warning" id="addmore" >
    				        </td>
    				    </tr>
				    </tbody>
				    <tfoot>
				        <!--<tr>
    				        <td colspan="5"><hr/></td>
				        </tr>-->
				        <tr>
    				        <td>&nbsp;</td>
    				        <td>&nbsp;</td>
    				        <td>
    				        <label>Total Quantity  :-  <span style="color:red;" id="label_grand_total_quantity">0</span></label>
    				        <input type='hidden' name='grand_total_quantity' placeholder='Total Quantity' id="grand_total_quantity" class='form-control' required readonly />
    				        </td>
    				        <td>&nbsp;</td>
    				        <td>
    				        <label>Grand Total  :-  <span style="color:red;" id="label_item_grand_total">0</span></label>
    				        <input type='hidden' name='item_grand_total' placeholder='Grand Total' id="item_grand_total" class='form-control' required readonly />
    				        </td>
    				        <td>&nbsp;</td>
    				        <td>&nbsp;</td>
				        </tr>
				    </tfoot>
				</table>
				</div>
				<div class="col-md-12">
				    
				    <div class="col-md-2" style="display:none;">
    				<div class="form-group">
                      <label>Discount Remark</label>
                      <input type="text" name="total_discount_remark" id="total_discount_remark" placeholder="Discount Remark" class="form-control" />
                    </div>
                    </div>
				    
				    <div class="col-md-2" style="display:none;">
    				<div class="form-group">
                      <label>Total Discount Amount</label>
                      <input type="number" name="total_discount_amount" id="total_discount_amount" oninput="grand_total();" placeholder="Total Discount Amount" class="form-control" step="0.01" />
                    </div>
                    </div>
                    
                    <div class="col-md-2">
    				<div class="form-group">
                      <label>Total Payable Amount <span style="color:red;">*</span></label>
                      <input type="number" name="total_payable_amount" id="total_payable_amount" placeholder="Total Payable Amount" class="form-control" step="0.01" required />
                    </div>
                    </div>
				    
				    <div class="col-md-2">
				    <div class="form-group">
                        <label><?php echo $language['Payment Mode']; ?> <span style="color:red;">*</span></label>
                        <select name="payment_mode" class="form-control" onchange="for_payment(this.value);" id="payment_mode" required >
                        <option value="Cash"><?php echo $language['Cash']; ?></option>
                        <option value="Cheque"><?php echo $language['Cheque']; ?></option>
                        <option value="NEFT"><?php echo $language['NEFT Net Banking']; ?></option>
                        </select>
				    </div>
				    </div>
				    
			        <div class="col-md-2" id="for_cheque_name" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Bank Name']; ?></label>
                      <input type="text" name="cheque_bank_name" placeholder="Bank Name" value="" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_cheque_no" style="display:none;">
    				<div class="form-group">
                      <label>Cheque No</label>
                      <input type="text" name="cheque_no" placeholder="Cheque No." value="" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_cheque_date" style="display:none;">
    				<div class="form-group">
                      <label>Cheque Date</label>
                      <input type="date" name="cheque_date" placeholder="Cheque Date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_neft_bank_name" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Bank Name']; ?></label>
                      <input type="text" name="neft_bank_name" placeholder="Bank Name" value="" class="form-control">
                    </div>
                    </div>
    				<div class="col-md-2" id="for_neft_account_no" style="display:none;">
    				<div class="form-group">
                      <label><?php echo $language['Account No']; ?></label>
                      <input type="text" name="neft_bank_account_no" placeholder="Account No." value="" class="form-control">
                    </div>
                    </div>
				    
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  
    </div>
</section>
</form>
<script>
//for_detail();
//payment_mode('Cash');
$(function () {
$('.select2').select2();
});
</script>

