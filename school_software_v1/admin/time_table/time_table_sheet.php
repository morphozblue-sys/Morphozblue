<?php include("../attachment/session.php"); ?>

</head>

<script type="text/javascript">
 

function get_period(){

var day_name=document.getElementById('day_name').value;

if(day_name!=''){
$('#period_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_get_time_table_sheet.php?day_name="+day_name+"",
cache: false,
success: function(detail){
$("#period_list").html(detail);
  }
});
}else{
$("#period_list").html('');
}

}


</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Time Table Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-clock-o"></i> <?php echo $language['Time Table']; ?></a></li>
	  <li class="active">Time Table Sheet</li>
      </ol>
    </section>
	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Time Table Generate'] ; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >


			
		
				 <div class="col-md-3 ">	
				<div class="form-group">
				<label>Select Day</label>
				<select id="day_name"  class="form-control" onchange="get_period();" required>
					<option value="">Select</option>
					<option value="monday">Monday</option>
					<option value="tuesday">Tuesday</option>
					<option value="wednesday">Wednesday</option>
					<option value="thursday">Thursday</option>
					<option value="friday">Friday</option>
					<option value="saturday">Saturday</option>

				
				</select>
			  </div>
			  	</div>
	
	
				
						  

		  
	      </div>
		
	<div class="col-md-12">
                <div class="box <?php echo $box_head_color; ?>">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                <table id="table-data" border="1" class="table table-bordered table-striped" width="100%">
                <thead >
    
                <tr>
				  <th>Class</th>
				    <?php
                    $que="select * from school_info_class_period where class_code=''";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
						if($period_name1!=''){
	                $period_start_time1 = $row['period_start_time'];
					$period_end_time1 = $row['period_end_time'];
					$period_start_time11=explode(":",$period_start_time1);
					$period_start_time12=$period_start_time11[0].":".$period_start_time11[1];
					$period_end_time11=explode(":",$period_end_time1);
					$period_end_time12=$period_end_time11[0].":".$period_end_time11[1];
					?>
				  <th><center><?php echo strtoupper($period_name1); ?><br><?php echo $period_start_time12."-".$period_end_time12; ?></center></th>
				  <?php
					} }
					?>
                  </tr>
                </thead>
				<tbody id="period_list">

				
		        </tbody>
				
                </table>
                </div>
                </div>
                </div>
                		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('table-data', 'Class Time Table')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
		  </div>
		  
		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
		  
	      </div>

	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

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
	