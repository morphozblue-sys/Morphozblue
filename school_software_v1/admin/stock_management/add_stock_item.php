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
           var cnt = $('#item_table tr').length;
           //and (s_no='2' or s_no='3' or s_no='4')
            var markup = "<tr id='tr_"+cnt+"'><td><input type='text' name='item_name[]' placeholder='Item Name' value='' class='form-control' id='name_id_"+cnt+"' required /></td><td><input type='text'  name='item_description[]' placeholder='Item Description'  value='' class='form-control' id='discp_id_"+cnt+"' ></td><td><select name='item_category[]' class='form-control' required><?php $que="select * from category_detail where category_status='Active' "; $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73)); while($row=mysqli_fetch_assoc($run)){ $s_no=$row['s_no']; $category_name=$row['category_name']; ?><option value='<?php echo $s_no; ?>'><?php echo $category_name; ?></option><?php } ?></select></td><td><select name='item_class[]' class='form-control' ><option value=''>Select</option><?php $class37=$_SESSION['class_name37']; $class371=explode('|?|',$class37); $total_class=$_SESSION['class_total37']; for($q=0;$q<$total_class;$q++){ $class_name=$class371[$q]; ?><option value='<?php echo $class_name; ?>'><?php echo $class_name; ?></option><?php } ?></select></td><td><input type='number' name='item_opening_stock[]' placeholder='Opening Stock' value='' class='form-control' id='opnstk_id_"+cnt+"' ></td><td><input type='button' class='btn btn-danger' value='Remove Row' onclick='remove_row("+cnt+")'><td></tr>";
            $("table tbody").append(markup);
        });
    });
    function remove_row(id){
        //alert_new(id);
        $('#tr_'+id).remove();   
    }
</script>
<script>
 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/add_stock_item_api.php",
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
              <h1 class="box-title"><b>Add New Books</b></h1>
              <div class="btnadd">
              </div>
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
    				        <th>Item Class</th>
    				        <th>Item Opening Stock</th>
    				        <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
    				    <tr>
    				        <td>
        				        <input type='text' name='item_name[]' placeholder='Item Name' value='' class='form-control' required />
    				        </td>
    				        <td>
    					       <input type='text'  name='item_description[]' placeholder='Item Description'  value='' class='form-control'>
    				        </td>
    				        <td>
                                <select name="item_category[]" class="form-control" required>
                                <!--<option value="">Select</option>-->
                                <?php
                                $que="select * from category_detail where category_status='Active'";
                                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                                while($row=mysqli_fetch_assoc($run)){
                                $s_no=$row['s_no'];
                                $category_name=$row['category_name'];
                                ?>
                                
                                <option value="<?php echo $s_no; ?>"><?php echo $category_name; ?></option>
                                <?php } ?>
                                </select>
    				        </td>
    				        <td>
                                <select name="item_class[]" class="form-control" >
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
    				            <input type='number'  name='item_opening_stock[]' placeholder='Opening Stock'  value='' class='form-control' >
    				        </td>
    				        <td>
    					       <input type="button" value="Add More +" class="btn btn-warning" id="addmore" >
    				        </td>
    				    </tr>
				    </tbody>
				</table>
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


