<?php include("../attachment/session.php"); ?>
<style>
    .btnadd{
        float: right;
    padding-right: 55px;
    }
</style>

<script>
 $("#my_form").submit(function(e){
    
        e.preventDefault();
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock/edit_item_api.php",
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
				   get_content('stock/item_list');
                }
			}
         });
      });
</script>
   <section class="content-header">
      <h1>
        <?php echo $language['Stock']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Edit Stock Item</li>
        </ol>
    </section>
	<!---*******************************************************************************************************************************************************************-->
    <!-- Main content -->
    <form role="form" method="post" id="my_form" enctype="multipart/form-data">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b>Edit Stock Item</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->

				    <?php
				    $sno=$_GET['id'];
				    $que="select * from stock_item_table where s_no='$sno'";
                    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                    $row=mysqli_fetch_assoc($run);
                    $item_product_name = $row['item_product_name'];
                    $item_product_category = $row['item_product_category'];
	                $item_brand_name = $row['item_brand_name'];
	                $item_description = $row['item_description'];
	                $item_quantity = $row['item_quantity'];
	                $item_code = $row['item_code'];
	                $item_rate = $row['item_rate'];
				    ?>
				    
	        <div class="box-body">
						
			<div class="col-md-4 ">	
			<input type="hidden"  name="s_no"  value="<?php echo $sno; ?>">
					
					<div class="form-group" >
					  <label ><?php echo $language['Product Name']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="item_product_name" placeholder="<?php echo $language['Product Name']; ?>"  value="<?php echo $item_product_name; ?>" class="form-control" required >
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
                    <option value="<?php echo $s_no; ?>" <?php if($item_product_category==$s_no){ echo 'selected'; } ?> ><?php echo $category_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
			</div>
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Brand']; ?></label>
					  <input type="text"  name="item_brand_name" placeholder="<?php echo $language['Product Brand']; ?>"  value="<?php echo $item_brand_name; ?>" class="form-control" >
					</div>
			</div>
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo "Product Rate"; ?></label>
					  <input type="number"  name="item_rate" placeholder="<?php echo "Product Rate"; ?>"  value="<?php echo $item_rate; ?>" class="form-control" >
					</div>
			</div>
			
			
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Description']; ?> </label>
					  <input type="text"  name="item_description" placeholder="<?php echo $language['Product Description']; ?>"  value="<?php echo $item_description; ?>" class="form-control">
					</div>
			</div>	
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label>Product Quantity</label>
					  <input type="text"  name="item_quantity" placeholder="Product Quantity"  value="<?php echo $item_quantity; ?>" class="form-control">
					</div>
			</div>	
			<div class="col-md-4 ">				
					<div class="form-group" >
					  <label>Product Code</label>
					  <input type="text"  name="item_code" placeholder="Product Code"  value="<?php echo $item_code; ?>" class="form-control">
					</div>
			</div>
          </div>
		  
				</div>
                    <center>
                        <input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
                    </center>
                </div>
		    </div>
		
    </div>
</section>
</form>