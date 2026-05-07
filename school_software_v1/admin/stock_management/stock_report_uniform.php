<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
var search_item_name=document.getElementById('search_item_name').value;
var search_item_color=document.getElementById('search_item_color').value;
var search_item_size=document.getElementById('search_item_size').value;
var order_by=document.getElementById('order_by').value;

$.ajax({
	  type: "POST",
	  url: access_link+"stock_management/ajax_stock_report_uniform.php?search_item_name="+search_item_name+"&search_item_color="+search_item_color+"&search_item_size="+search_item_size+"&order_by="+order_by+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });

}
</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stock Management
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i>Stock Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Stock Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <div class="col-md-4"><h3 class="box-title">Uniform Stock Report download</h3></div>
              <!--<div class="col-md-2"><center><input type="radio" name="list_type" value="Student" class="list_type" onclick="for_list();" checked /> <b>Student</b></center></div>
              <div class="col-md-2"><center><input type="radio" name="list_type" value="Customer" class="list_type" onclick="for_list();" /> <b>Customer</b></center></div>-->
              
              <div class="col-md-4">&nbsp;</div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			<div class="col-md-12 col-md-offset-2" id="search_detail">
								
                <div class="col-md-2">
                <label>Item Name</label>
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
                <label>Color</label>
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
                <label>Size</label>
                <select name="search_item_size" id="search_item_size" onchange="for_list();" class="form-control">
                <option value="All">All Size</option>
                <?php
                $que000="select item_size from new_stock_item_uniform where stock_item_status='Active' GROUP BY item_size";
                $run000=mysqli_query($conn73,$que000) or die(mysqli_error($conn73));
                $size_serial=0;
                $item_size='';
                while($row000=mysqli_fetch_assoc($run000)){
                $item_size[$size_serial]=$row000['item_size'];
                $size_serial++;
                }
                asort($item_size);
                foreach($item_size as $item_size1){
                ?>
                <option value="<?php echo $item_size1; ?>"><?php echo $item_size1; ?></option>
                <?php } ?>
                </select>
                </div>
				
				<div class="col-md-2">
				<label>Order By</label>
				<select class="form-control" name="order_by" id="order_by" onchange="for_list();">
				<option value="">Select</option>
				<option value="ORDER BY new_stock_item_uniform.item_name ASC">By Item Name</option>
				<option value="ORDER BY new_stock_item_uniform.item_description ASC">By Item Color</option>
				</select>
				</div>
				
			</div>
			
			</br></br></br><hr>
					
			<div class="col-md-12" id="pdf_detail">
			
			</div>
			
	        </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
<script>
for_list();
</script>