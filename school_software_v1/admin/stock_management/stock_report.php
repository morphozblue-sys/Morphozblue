<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
var order_by=document.getElementById('order_by').value;
var item_class=document.getElementById('item_class').value;
var item_category=document.getElementById('item_category').value;

$.ajax({
	  type: "POST",
	  url: access_link+"stock_management/ajax_stock_report.php?order_by="+order_by+"&item_class="+item_class+"&item_category="+item_category+"",
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
              <div class="col-md-4"><h3 class="box-title">Books Stock Report download</h3></div>
              <!--<div class="col-md-2"><center><input type="radio" name="list_type" value="Student" class="list_type" onclick="for_list();" checked /> <b>Student</b></center></div>
              <div class="col-md-2"><center><input type="radio" name="list_type" value="Customer" class="list_type" onclick="for_list();" /> <b>Customer</b></center></div>-->
              
              <div class="col-md-4">&nbsp;</div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			<div class="col-md-12 col-md-offset-3" id="search_detail">
								
				<div class="col-md-2" id="div_from_date">
				<div class="form-group">
				<label>Class</label>
                <select name="item_class" id="item_class" class="form-control" onchange="for_list();" >
                <option value="All">All</option>
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
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Category</label>
                <select name="item_category" id="item_category" class="form-control" onchange="for_list();" >
                <option value="All">All</option>
                <?php
                $que="select * from category_detail where category_status='Active' and (s_no='2' or s_no='3' or s_no='4')";
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
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Order By</label>
				<select class="form-control" name="order_by" id="order_by" onchange="for_list();">
				<option value="">Select</option>
				<option value="ORDER BY new_stock_item.item_name ASC">By Item Name</option>
				<option value="ORDER BY new_stock_item.item_description ASC">By Item Description</option>
				</select>
				</div>
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