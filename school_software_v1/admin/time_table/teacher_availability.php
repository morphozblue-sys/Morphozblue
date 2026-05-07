<?php include("../attachment/session.php")?>
	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script type="text/javascript">
function for_teacher_detail(){
var day=$("#calender_day").val();
$('#example2').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_get_teacher_detail.php?day="+day+"",
cache: false,
success: function(detail){
//alert_new(detail);
$("#example2").html(detail);
  }
});
}
for_teacher_detail();
</script>

 <section class="content-header">
      <h1>
        <?php echo $language['Time Table Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-clock-o"></i> <?php echo $language['Time Table']; ?></a></li>
	  <li class="active"><?php echo $language['Teacher Availability']; ?></li>
      </ol>
    </section>
	

	
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Teacher Availability']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >

			<form role="form"  method="post" enctype="multipart/form-data">
			<?php
			$today_day=date('N');
			?>
		
				 <div class="col-md-4 ">	
				<div class="form-group">
				<label>Select Date</label>
				<input type="date"  id="calender_day"  class="form-control" onchange="for_teacher_detail();" required value="<?php echo date('Y-m-d'); ?>">
				
			  </div>
			  	</div>
			  
				
				
				<div class="col-md-12" id="example2">
              

			
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  </form>
		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('table-data', 'teacher availability')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
		  </div>
		  
		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
		  
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("table-data");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>


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
	