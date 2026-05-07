<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
var enquiry_type=document.getElementById('enquiry_type').value;
var enquiry_medium=document.getElementById('enquiry_medium').value;
var enquiry_from_date=document.getElementById('enquiry_from_date').value;
var enquiry_to_date=document.getElementById('enquiry_to_date').value;
var enquiry_order_by=document.getElementById('enquiry_order_by').value;

if(enquiry_from_date!='' && enquiry_to_date!=''){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"enquiry/ajax_enquiry_daily_report.php?enquiry_type="+enquiry_type+"&enquiry_medium="+enquiry_medium+"&enquiry_from_date="+enquiry_from_date+"&enquiry_to_date="+enquiry_to_date+"&enquiry_order_by="+enquiry_order_by+"",
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
        Enquiry Daily Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-phone-square"></i> <?php echo $language['Enquiry']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Enquiry Daily Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border">
              <h3 class="box-title">Enquiry Daily Report download</h3>
             </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-1" id="search_detail">
								
                <div class="col-md-2">				
                <div class="form-group" >
                <label>Enquiry Type</label>
                <select class="form-control" name="enquiry_type" id="enquiry_type" onchange="for_list();" >
                <option value="All">All</option>
                <option value="for admission">For Admission</option>
                <option value="for job">For Job</option>
                <option value="other">Other</option>
                </select>
                </div>
                </div>
                
                <div class="col-md-2">		
                <div class="form-group">
                <label>Enquiry Medium</label>
                <select name="enquiry_medium" id="enquiry_medium" class="form-control" onchange="for_list();">
                <option value="All">All</option>
                <option value="Hindi">Hindi</option>
                <option value="English">English</option>
                </select>
                </div>
                </div>

				<div class="col-md-2">
				<div class="form-group">
				<label>Enquiry From Date</label>
				<input type="date" name="enquiry_from_date" id="enquiry_from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" oninput="for_list();" />
				</div>
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Enquiry To Date</label>
				<input type="date" name="enquiry_to_date" id="enquiry_to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" oninput="for_list();" />
				</div>
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Order By</label>
				<select class="form-control" name="enquiry_order_by" id="enquiry_order_by" onchange="for_list();">
				<option value="">Select</option>
				<option value=" ORDER BY enquiry_name ASC">By Enquiry Name</option>
				<option value=" ORDER BY enquiry_father_name ASC">By Enquiry Father Name</option>
				<option value=" ORDER BY enquiry_date ASC">By Enquiry Date</option>
				<option value=" ORDER BY enquiry_next_follow_up_date ASC">By Enquiry Next Follow Up Date</option>
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