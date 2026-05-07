<?php include("../attachment/session.php"); ?>
<script>
function searchKeyPress(e)
{
    e = e || window.event;
    if (e.keyCode == 13)
    {
        document.getElementById('popup_click').click();
        return false;
    }
    return true;
}

function get_barcode(){
var code=document.getElementById('barcode_no1').value;
document.getElementById('barcode_no').value=code;

}
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock/add_item_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                // //alert_new(detail);
// 			console.log(detail)
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('stock/item_list');
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
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active"><?php echo $language['Add New Item']; ?></li>
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
              <h1 class="box-title"><b><?php echo $language['Add New Item']; ?></b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
						
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Name']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="item_product_name" placeholder="<?php echo $language['Product Name']; ?>"  value="" class="form-control" required >
					</div>
			</div>
			
			<div class="col-md-4 ">				
                <div class="form-group" >
                    <label >Category <font style="color:red"><b>*</b></font></label>
                    <select name="item_product_category" class="form-control" required>
                    <option value="">Select</option>
                    <?php
                    $que="select * from stock_category where category_status='Active'";
                    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                    while($row=mysqli_fetch_assoc($run)){
                    $s_no=$row['s_no'];
                    $category_name=$row['category_name'];
                    ?>
                    <option value="<?php echo $s_no; ?>"><?php echo $category_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
			</div>
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Brand']; ?></label>
					  <input type="text"  name="item_brand_name" placeholder="<?php echo $language['Product Brand']; ?>"  value="" class="form-control" >
					</div>
			</div>
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo "Product Rate"; ?></label>
					  <input type="number"  name="item_rate" placeholder="<?php echo "Product Rate"; ?>"  value="" class="form-control" >
					</div>
			</div>
			
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Description']; ?> </label>
					  <input type="text"  name="item_description" placeholder="<?php echo $language['Product Description']; ?>"  value="" class="form-control">
					</div>
			</div>	
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label>Product Quantity</label>
					  <input type="text"  name="item_quantity" placeholder="Product Quantity"  value="" class="form-control">
					</div>
			</div>	
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label>Product Code</label>
					  <input type="text"  name="item_code" placeholder="Product Code"  value="" class="form-control">
					</div>
			</div>
		

			
		<br><br>
		<div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		</div>
          
		  </div>
		  </form>
    </div>
</section>


