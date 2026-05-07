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
            url: access_link+"stock_management/edit_stock_item_api.php",
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
				   get_content('stock_management/stock_item_list');
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
        <li class="active">Edit Stock Books</li>
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
              <h1 class="box-title"><b>Edit Stock Books</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
				<div class="col-md-12" style="text-align:center;">
				<table class="table table-responsive" id="item_table">
				    <thead>
				        <tr>
    				        <th>Item Name <span style="color:red;">*</span></th>
    				        <th>Item Description</th>
    				        <th>Category <span style="color:red;">*</span></th>
    				        <th>Item Class</span></th>
    				        <th>Opening Stock</th>
				        </tr>
				    </thead>
				    <?php
				    $sno=$_GET['id'];
				    $que="select nst.*, ns.available_stock, ns.opening_stock from new_stock_item as nst left join new_stock as ns on ns.item_s_no=nst.s_no where nst.s_no='$sno' ";
                    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                    $row=mysqli_fetch_assoc($run);
                    $item_name = $row['item_name'];
                    $item_description = $row['item_description'];
                    $item_class = $row['item_class'];
                    $item_category = $row['item_category'];
                    $available_stock = $row['available_stock'];
                    $opening_stock = $row['opening_stock'];
                    $new_available_stock = $available_stock - $opening_stock;
				    ?>
				    <tbody>
    				    <tr>
    				        <td>
        				        <input type='text' name='item_name' placeholder='Item Name' value='<?php echo $item_name; ?>' class='form-control' required />
        				        
    				        </td>
    				        <td>
    					       <input type='text' name='item_description' placeholder='Item Description' value='<?php echo $item_description; ?>' class='form-control'>
    				        </td>
    				        <td>
                                <select name="item_category" class="form-control" required>
                                <!--<option value="">Select</option>-->
                                <?php
                                $que="select * from category_detail where category_status='Active' and (s_no='2' or s_no='3' or s_no='4')";
                                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                                while($row=mysqli_fetch_assoc($run)){
                                $s_no=$row['s_no'];
                                $category_name=$row['category_name'];
                                ?>
                                <option <?php if($item_category==$s_no){ echo 'selected'; } ?> value="<?php echo $s_no; ?>"><?php echo $category_name; ?></option>
                                <?php } ?>
                                </select>
    				        </td>
    				        <td>
                                <select name="item_class" class="form-control" >
                                <option value="">Select</option>
                                <?php 
                                $class37=$_SESSION['class_name37'];
                                $class371=explode('|?|',$class37);
                                $total_class=$_SESSION['class_total37'];
                                for($q=0;$q<$total_class;$q++){
                                $class_name=$class371[$q]; ?>
                                <option <?php if($item_class==$class_name){ echo 'selected'; } ?> value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
                                <?php } ?>
                                </select>
    				        </td>
    				        <td>
    				            <input type='number' name='item_opening_stock' placeholder='Opening Stock' value='<?php echo $opening_stock; ?>' class='form-control' <?php if($opening_stock>$available_stock){ ?> readonly <?php } ?>>
    				        </td>
    				    </tr>
				    </tbody>
				</table>
				</div>
                <div class="col-md-12">
                    <input type='hidden' name='s_no' value='<?php echo $sno; ?>'>
                    <input type='hidden' name='item_available_stock' value='<?php echo $new_available_stock; ?>'>
                    <center>
                        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
                    </center>
                </div>
		    </div>
		    </form>
    </div>
</section>