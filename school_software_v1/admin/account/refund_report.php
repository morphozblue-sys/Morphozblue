<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;
var income_expense=document.getElementById('income_expense').value;
var income_expense_heads=document.getElementById('income_expense_heads').value;

$("#pdf_detail").html('');

if(from_date!='' && to_date!='' && income_expense!='' && income_expense_heads!=''){
if(income_expense=='Debit'){
    $page_name="ajax_refund_report.php";
}else if(income_expense=='Credit'){
    $page_name="ajax_income_report.php";
}else{
    $page_name="ajax_income_expense_report.php";
}
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"account/"+$page_name+"?from_date="+from_date+"&to_date="+to_date+"&income_expense="+income_expense+"&income_expense_heads="+income_expense_heads+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
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
        Download Refund Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('account/account')"><i class="fa fa-money"></i> Account Panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Refund Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Refund Report download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-4" id="search_detail">
								
				<div class="col-md-2">				
				<div class="form-group" >
				<label>From Date</label>
				<input type="date" name="from_date" class="form-control" id="from_date" value="<?php echo date('Y-m-d'); ?>" oninput="for_list();" />
				</div>
				</div>

				<div class="col-md-2">
				<div class="form-group">
				<label>To Date</label>
				<input type="date" name="to_date" class="form-control" id="to_date" value="<?php echo date('Y-m-d'); ?>" oninput="for_list();" />
				</div>
				</div>
				
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
				<label>Income/Expense</label>
				<select name="income_expense" class="form-control" id="income_expense" onchange="for_list();" >
				<option value="Debit">Expense</option>
				<option value="Credit">Income</option>
				</select>
				</div>
				</div>
				
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
				<label>Heads</label>
				<select name="income_expense_heads" class="form-control" id="income_expense_heads" onchange="for_list();" >
				<option value="All">All</option>
				<?php
                $que="select * from account_expence_info where account_status='Active' and session_value='$session1' GROUP BY account_customer_name";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
                $account_customer_name=$row['account_customer_name'];
                
				?>
				<option value="<?php echo $account_customer_name; ?>"><?php echo $account_customer_name; ?></option>
				<?php } ?>
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