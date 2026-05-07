<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        Contact Info List
       
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('important/important')"><i class="fa fa-check-square"></i>Important</a></li>
		<li><a>Contact Info List</a></li>
      </ol>
    </section>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"important/contact_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('important/contact_info_list');
			   }else{
               //alert_new(detail); 
			   }
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <div class="col-md-4">
              <h3 class="box-title">Contact Info List</h3>
              </div>
              <div class="col-md-4">
              <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Contact Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
              </div>
              <div class="col-md-4">
              <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="printTable">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                   <th>Serial No.</th>
                   <th>Name</th>
                  <th>Contact No</th>
                  <th>Address</th>
				  <th>Remark</th>
				  <th>Edit</th>
				  <th>Delete</th>
				</tr>
                </thead>
                <tbody>
                <?php

$que="select * from govt_contact_info";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
	
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$name=$row['name'];
		$contact_no=$row['contact_no'];
		$address=$row['address'];
		$remark=$row['remark'];
		
	$serial_no++;
?>
                
<tr>         
	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $name; ?></th>
	<th  ><?php echo $contact_no; ?></th>
	<th  ><?php echo $address; ?></th>
	<th  ><?php echo $remark; ?></th>
	
	<th><button type="button" class="btn btn-success" onclick="post_content('important/contact_edit','<?php echo 'id='.$s_no; ?>');" >Edit</button></th>
	<th><button type="button" class="btn btn-success" onclick="return valid('<?php echo $s_no; ?>');" >Delete</button></th>
</tr>
				<?php } ?>
                </tbody>
             </table>
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
$(function(){
$('#example1').DataTable()
})
</script>