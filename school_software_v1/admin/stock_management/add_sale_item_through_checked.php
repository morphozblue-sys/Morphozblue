<?php include("../attachment/session.php"); ?>
<script>
function for_detail(){
    var sales_type=$('input[name=sales_type]:checked').val();
    var student_class=document.getElementById('student_class').value;
    $('#label_student_customer_id').html(sales_type+'s Name');
    $.ajax({
    type: "POST",
    url: access_link+"stock_management/ajax_get_sales_type_details_through_checked.php?sales_type="+sales_type+"&student_class="+student_class+"",
    cache: false,
    success: function(detail){
    $('#student_customer_id').html(detail);
    your_items(student_class);
    }
    });
}

function your_items(student_class){
    if(student_class!=''){
        $.ajax({
        type: "POST",
        url: access_link+"stock_management/ajax_get_sales_item_details_through_checked.php?student_class="+student_class+"",
        cache: false,
        success: function(detail){
        $('#item_details').html(detail);
        for_total();
        }
        });
    }else{
        $('#item_details').html('');
        for_total();
    }
}

function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
	
	$(".text_"+id).each(function() {
	$(this).addClass('tot_'+id);
	});
	
	$(".qty_"+id).each(function() {
	$(this).addClass('tot_qty_'+id);
	});
	
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
	
	$(".text_"+id).each(function() {
	$(this).removeClass('tot_'+id);
	});
	
	$(".qty_"+id).each(function() {
	$(this).removeClass('tot_qty_'+id);
	});
}
for_total();
}

function for_total(){
    var quantity=0;
    $(".tot_qty_txt1").each(function() {
	quantity=parseFloat(quantity)+parseFloat($(this).val());
	});
	$(".tot_qty_stanry1").each(function() {
	quantity=parseFloat(quantity)+parseFloat($(this).val());
	});
	$("#grand_total_quantity").val(quantity);
    
    var total=0;
    $(".tot_txt1").each(function() {
	total=parseFloat(total)+parseFloat($(this).val());
	});
	var total1=0;
	$(".tot_stanry1").each(function() {
	total1=parseFloat(total1)+parseFloat($(this).val());
	});
	$("#total_txt1").val(total);
	$("#total_stanry1").val(total1);
	var grand_total=parseFloat(total)+parseFloat(total1);
	$("#item_grand_total").val(grand_total);
	$("#total_payable_amount").val(grand_total);
}

function particular(id,no,id1,qid){
    if($('#'+id1+'_'+no).prop("checked") == true){
        $("#"+id+no).addClass('tot_'+id1);
        $("#"+qid+"quantity_"+no).addClass('tot_qty_'+id1);
    }else{
        $("#"+id+no).removeClass('tot_'+id1);
        $("#"+qid+"quantity_"+no).removeClass('tot_qty_'+id1);
    }
    for_total();
}

function for_amount(no,id,q_id,r_id){
    var quantity=document.getElementById(q_id+no).value;
    var rate=document.getElementById(r_id+no).value;
    total_amt=parseFloat(quantity)*parseFloat(rate);
    $("#"+id+no).val(total_amt);
    for_total();
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

function validate(){
	var add1=0;
	$(".sale_items").each(function() {
	if($(this).prop('checked')==true){
		add1 = parseInt(add1+1);
	}
	});
	if(add1>0){
		return true;
	}else{
		alert_new('Please Select Atleast One Class & One Item !!!');
		return false;
	}
}

 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/add_sale_item_through_checked_api.php",
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
				   get_content('stock_management/sale_item_list');
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
        <li class="active">Add Sale Item</li>
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
              <div class="col-md-4"><h1 class="box-title"><b>Create Books Sale Invoice</b></h1></div>
              <div class="col-md-4" style="display:none;">
                    <center>
                    <input type="radio" name="sales_type" value="Student" onclick="for_detail();" checked> Student &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="sales_type" value="Customer" onclick="for_detail();"> Customer
                    </center>
              </div>
              <div class="col-md-4">&nbsp;</div>
              <div class="btnadd">
              </div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
            <div class="box-body">
				
				<div class="col-md-2">
    			    <div class ="form-group">
    			        <label>Class <span style="color:red;">*</span></label>
                        <select name="student_class" id="student_class"  onchange="for_detail();" class="form-control" required>
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
                    </div>
                </div>
				
				<div class="col-md-6">
    			    <div class ="form-group">
    			        <label><span id="label_student_customer_id">*</span> <span style="color:red;">*</span></label>
                        <select class="form-control select2" name="student_customer_id" id="student_customer_id" style="width:100%;" required >
                            
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
                        <!--<input type="number" name="invoice_no" class="form-control" id="invoice_no" value="<?php echo $invoice_no; ?>" required <?php if($_SESSION['database_name']!='simptylz_livingstonenagaland'){ echo 'readonly'; } ?> />-->
<input type="number" name="invoice_no" class="form-control" id="invoice_no" value="<?php echo $invoice_no; ?>" required  >
                    </div>
                </div>
                
                <div class="col-md-12" id="item_details">
				
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
                      <input type="number" name="total_discount_amount" id="total_discount_amount" oninput="" placeholder="Total Discount Amount" class="form-control" step="0.01" />
                    </div>
                    </div>
                    
                    <div class="col-md-2">
    				<div class="form-group">
                      <label>Total Payable Amount <span style="color:red;">*</span></label>
                      <input type="number" name="total_payable_amount" id="total_payable_amount" placeholder="Total Payable Amount" class="form-control" step="0.01" required readonly />
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
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" onclick="return validate();" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  
    </div>
</section>
</form>
<script>
for_detail();
//payment_mode('Cash');
$(function () {
$('.select2').select2();
});
</script>

