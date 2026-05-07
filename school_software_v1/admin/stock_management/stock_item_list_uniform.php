<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active"> <?php echo $language['Item List']; ?></li>
        </ol>
    </section>

<script>
function for_rates(item_s_no){
$.ajax({
type: "POST",
url: access_link+"stock_management/ajax_get_rate_detail_uniform.php?item_s_no="+item_s_no+"",
cache: false,
success: function(detail){
$('#rate_details').html(detail);
}
});
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
$("#myModal_close").click();
$.ajax({
    url: access_link+"stock_management/stock_item_rate_uniform_api.php",
    type: "POST",
    data: formdata,
    mimeTypes:"multipart/form-data",
    contentType: false,
    cache: false,
    processData: false,
    success: function(detail){
       var res=detail.split("|?|");
	   if(res[1]=='success'){
		   $('#myModal').modal('hide');
		   get_content('stock_management/stock_item_list_uniform');
    }
	}
 });
});

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
url: access_link+"stock_management/stock_item_delete_uniform.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Deleted','green');
            get_content('stock_management/stock_item_list_uniform');
        }else{
            //alert_new(detail); 
	    }
    }
});
}

function for_list(){
var search_item_name=document.getElementById('search_item_name').value;
var search_item_color=document.getElementById('search_item_color').value;
var search_item_size=document.getElementById('search_item_size').value;
var category_s_no=document.getElementById('search_item_category').value;
$.ajax({
type: "POST",
url: access_link+"stock_management/ajax_get_stock_item_list_uniform.php?category_s_no="+category_s_no+"&search_item_name="+search_item_name+"&search_item_color="+search_item_color+"&search_item_size="+search_item_size+"",
cache: false,
success: function(detail){
    $("#search_table").html(detail);
    }
});
}

</script>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-12">
          <!-- /.box -->
        <?php
        $que000="select item_size from new_stock_item_uniform where stock_item_status='Active' GROUP BY item_size";
        $run000=mysqli_query($conn73,$que000) or die(mysqli_error($conn73));
        $size_serial=0;
        $item_size='';
        while($row000=mysqli_fetch_assoc($run000)){
        $item_size[$size_serial]=$row000['item_size'];
        $size_serial++;
        }
        if($item_size!=''){
        asort($item_size);
        }
        ?>
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-md-2"><h4>Uniforms List</h4></div>
			  <div class="col-md-2">
                    <select name="search_item_name" id="search_item_name" onchange="for_list();" class="form-control">
                    <option value="All">All Item Name</option>
                    <?php
                    $que0="select item_name from new_stock_item_uniform where stock_item_status='Active' GROUP BY item_name ORDER BY item_name ASC";
                    $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73));
                    while($row0=mysqli_fetch_assoc($run0)){
                    $item_name=$row0['item_name'];
                    ?>
                    <option value="<?php echo $item_name; ?>"><?php echo $item_name; ?></option>
                    <?php } ?>
                    </select>
			  </div>
			  <div class="col-md-2">
                    <select name="search_item_color" id="search_item_color" onchange="for_list();" class="form-control">
                    <option value="All">All Color</option>
                    <?php
                    $que00="select item_description from new_stock_item_uniform where stock_item_status='Active' GROUP BY item_description ORDER BY item_description ASC";
                    $run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73));
                    while($row00=mysqli_fetch_assoc($run00)){
                    $item_description=$row00['item_description'];
                    ?>
                    <option value="<?php echo $item_description; ?>"><?php echo $item_description; ?></option>
                    <?php } ?>
                    </select>
			  </div>
			  <div class="col-md-2">
                    <select name="search_item_size" id="search_item_size" onchange="for_list();" class="form-control">
                    <option value="All">All Size</option>
                    <?php
                    if($item_size!=''){
                    foreach($item_size as $item_size1){
                    ?>
                    <option value="<?php echo $item_size1; ?>"><?php echo $item_size1; ?></option>
                    <?php } } ?>
                    </select>
			  </div>
			  <div class="col-md-2">
                    <select name="search_item_category" id="search_item_category" onchange="for_list();" class="form-control">
                    <option value="All">All Category</option>
                    <?php
                    //and s_no='1'
                    $que="select * from category_detail where category_status='Active' ";
                    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                    while($row=mysqli_fetch_assoc($run)){
                    $s_no=$row['s_no'];
                    $category_name=$row['category_name'];
                    ?>
                    <option value="<?php echo $s_no; ?>"><?php echo $category_name; ?></option>
                    <?php } ?>
                    </select>
			  </div>
			  <div class="col-md-2"><a href="javascript:get_content('stock_management/add_stock_item_uniform')"> <button style="float:right;" type="button" class="btn btn-primary"><?php echo $language['+ Add New Item']; ?></button></a></div>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-md-12" id="search_table">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Item Name  </th>
					<!--<th><?php echo $language['Product Brand']; ?></th>-->
					<th>Item Color</th>
					<th>Category</th>
					<th>Size</th>
					<th>Sale Rates</th>
					<th style="display:none;">Item Class</th>
					<th>Opening Stock</th>
					<th>Update By</th>
					<th>Date</th>
					<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody>
                <?php
                $que="select nst.*, ns.opening_stock, ns.sale_rate from new_stock_item_uniform as nst join new_stock_uniform as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active' order by nst.s_no desc";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
                		$s_no=$row['s_no'];
                		$item_name=$row['item_name'];
                		//$item_brand_name=$row['item_brand_name'];
                		$item_description=$row['item_description'];
                		$item_category=$row['item_category'];
                		$item_size=$row['item_size'];
                		$sale_rate=$row['sale_rate'];
                		$item_class=$row['item_class'];
                		$opening_stock=$row['opening_stock'];
                		$update_change=$row['update_change'];
                		$last_updated_date=$row['last_updated_date'];
                        if($last_updated_date!='' && $last_updated_date!='0000-00-00 00:00:00'){
                        $last_updated_date=date('d-m-Y h:i:s',strtotime($last_updated_date));
                        }
                        
                        $querr="select category_name from category_detail where category_status='Active' and s_no='$item_category'";
                		$runn=mysqli_query($conn73,$querr) or die(mysqli_error($conn73));
                        $category_name='';
                        while($roww=mysqli_fetch_assoc($runn)){
                            $category_name=$roww['category_name'];
                        }
                		
                	$serial_no++;
                ?>
                    <tr>
                    	<td><?php echo $serial_no; ?></td>
                    	<td><?php echo $item_name; ?></td>
                    	<td><?php echo $item_description; ?></td>
                    	<td><?php echo $category_name; ?></td>
                    	<td><?php echo $item_size; ?></td>
                    	<td><?php echo $sale_rate; ?></td>
                    	<td style="display:none;"><?php echo $item_class; ?></td>
                    	<td><?php echo $opening_stock; ?></td>
                    	<td><?php echo $update_change; ?></td>
                    	<td><?php echo $last_updated_date; ?></td>
                        <td>
                        	<center>
                        	<a href="javascript:post_content('stock_management/edit_stock_item_uniform','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;
                        	<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button> &nbsp;
                        	<button type="button"  class="btn btn-warning" onclick="for_rates('<?php echo $s_no; ?>');" data-toggle="modal" data-target="#myModal" >Add/Edit Rates</button>
                        	</center>
                        </td>
                    </tr>
                <?php } ?>
        		</tbody>
             </table>
             </div>
             
    <!-- Model Start -->
    <div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">
        <h2>Update Rates</h2>
        <div class="col-md-12" id="rate_details">
        
		</div>
        
        </div>
	    <div class="modal-footer">
		<input type="submit" name="finish" value="Add / Edit" class="btn btn-success" />
        <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	
		  </form>
  </div>
<!-- Model End -->         
             
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
        <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>