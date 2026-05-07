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
url: access_link+"stock_management/ajax_get_rate_detail.php?item_s_no="+item_s_no+"",
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
    url: access_link+"stock_management/stock_item_rate_api.php",
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
		   get_content('stock_management/stock_item_list');
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
url: access_link+"stock_management/stock_item_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Deleted','green');
            get_content('stock_management/stock_item_list');
        }else{
            //alert_new(detail); 
	    }
    }
});
}

function for_list(){
var category_s_no=document.getElementById('search_item_category').value;
var search_item_class=document.getElementById('search_item_class').value;
$.ajax({
type: "POST",
url: access_link+"stock_management/ajax_get_stock_item_list.php?category_s_no="+category_s_no+"&search_item_class="+search_item_class+"",
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
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-md-4"><h4>Books List</h4></div>
			  <div class="col-md-2">
                    <select name="search_item_class" id="search_item_class" onchange="for_list();" class="form-control">
                    <option value="All">All Class</option>
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
			  <div class="col-md-2">
                    <select name="search_item_category" id="search_item_category" onchange="for_list();" class="form-control">
                    <option value="All">All Category</option>
                    <?php
                    //and (s_no='2' or s_no='3' or s_no='4')
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
			  <div class="col-md-4"><a href="javascript:get_content('stock_management/add_stock_item')"> <button style="float:right;" type="button" class="btn btn-primary"><?php echo $language['+ Add New Item']; ?></button></a></div>
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
					<th>Item Description</th>
					<th>Category</th>
					<th>Item Class</th>
					<th>Sale Rates</th>
					<th>Opening Stock</th>
					<th>Update By</th>
					<th>Date</th>
					<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody>
                <?php
                $que="select nst.*, ns.opening_stock, ns.sale_rate from new_stock_item as nst join new_stock as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active' order by nst.s_no desc";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
                		$s_no=$row['s_no'];
                		$item_name=$row['item_name'];
                		//$item_brand_name=$row['item_brand_name'];
                		$item_description=$row['item_description'];
                		$item_category=$row['item_category'];
                		$item_class=$row['item_class'];
                		$sale_rate=$row['sale_rate'];
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
                    	<td><?php echo $item_class; ?></td>
                    	<td><?php echo $sale_rate; ?></td>
                    	<td><?php echo $opening_stock; ?></td>
                    	<td><?php echo $update_change; ?></td>
                    	<td><?php echo $last_updated_date; ?></td>
                        <td>
                        	<center>
                        	<a href="javascript:post_content('stock_management/edit_stock_item','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;
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