<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
var debit_credit_type=document.getElementById('debit_credit_type').value;
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;

if(debit_credit_type!='' && from_date!='' && to_date!=''){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"stock_management/ajax_ledger_report.php?debit_credit_type="+debit_credit_type+"&from_date="+from_date+"&to_date="+to_date+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
}else{
    $("#pdf_detail").html('');
}

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
        <li class="active"><i class="fa fa-user-plus"></i>Stock Ledger Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <div class="col-md-4"><h3 class="box-title">Stock Ledger Report download</h3></div>
              <div class="col-md-2">&nbsp;</div>
              <div class="col-md-2">&nbsp;</div>
              <div class="col-md-4">&nbsp;</div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-3" id="search_detail">
								
				<div class="col-md-2">				
				<div class="form-group" >
				<label>Debit/Credit</label>
				<select name="debit_credit_type" class="form-control" id="debit_credit_type" onchange="for_list();" >
				<option value="All">All</option>
				<option value="Debit">Debit</option>
				<option value="Credit">Credit</option>
				</select>
				</div>
				</div>

				<div class="col-md-2">
				<div class="form-group">
				<label>From Date</label>
				<input type="date" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" oninput="for_list();" />
				</div>
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>To Date</label>
				<input type="date" name="to_date" id="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" oninput="for_list();" />
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