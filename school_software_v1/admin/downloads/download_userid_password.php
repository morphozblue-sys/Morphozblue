<?php include("../attachment/session.php");
?>
<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 var isAndroid = /(android)/i.test(navigator.userAgent);
 if(!isAndroid){
  newWin.close();   
 }
//$('#printTable').print();
 }
</script>

  <section class="content-header">
      <h1>
        Downloads Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
  <li><a href="javascript:get_content('downloads/userid_password')"><i class="fa fa-phone-square"></i>Userid Password</a></li>
	    <li class="active">Download Userid Password</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-12">
		
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Userid And Password')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
		</div>
        </div>
	
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			 
			  <?php
			  $schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			  $schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			  while($schl_row=mysqli_fetch_assoc($schl_result)){
			  $school_info_school_name=$schl_row['school_info_school_name'];
			  $school_info_dise_code=$schl_row['school_info_dise_code'];
			  $school_info_school_code=$schl_row['school_info_school_code'];
			  }
			  ?>
			 
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
			  <td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			  </tr>
			  <tr>
			  <td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			  <td><center><b>USERID & PASSWORD LIST</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
				  <table cellspacing="0" cellpadding="10px;" border="1" id="example1" class="table table-bordered table-striped" style="width:100%;">
						<thead class="my_background_color">
								<tr>
								  <td><b>S.No.</b></td>
								  <td><b>Student Name</b></td>
								  <td><b>Father Name</b></td>
								  <td><b>UserId</b></td>
								  <td><b>Password</b></td>
								</tr>
						</thead>
					<tbody >
					<?php 
					
						 
						$std_category=$_POST['student_category'];
						if($std_category!='All'){
						$condition1=" and student_class='$std_category'";
						}else{
						$condition1="";
						}
						
						$student_class_section=$_POST['student_class_section'];
						if($student_class_section!='All'){
						$condition2=" and student_class_section='$student_class_section'";
						}else{
						$condition2="";
						}
						
						$order_by = $_POST['order_by'];
    					if($order_by!=''){
    					if($order_by=='student_name' || $order_by=='student_father_name'){
    					    $condition11 =" ORDER BY $order_by ASC";
    					}else{
    					    $condition11 =" ORDER BY CAST($order_by AS UNSIGNED) ASC";
    					}
    					}else{
    					$condition11="";
    					}
						
						$que="select * from student_admission_info where session_value='$session1' and student_status='Active'$condition1$condition2$filter37$condition11";
						$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
						$serial_no=0;
						while($row=mysqli_fetch_assoc($run)){
						$student_name=$row['student_name'];
						$student_father_name=$row['student_father_name'];
						$student_roll_no=$row['student_roll_no'];
						$student_password=$row['student_password'];
						$student_class_section=$row['student_class_section'];
						$student_class=$row['student_class'];
						$serial_no++;
						?>
						<tr>
						  <td><?php echo $serial_no; ?></td>
						  <td><?php echo $student_name; ?></td>
						  <td><?php echo $student_father_name; ?></td>
						  <td><?php echo $student_roll_no; ?></td>
						  <td><?php echo $student_password; ?></td>
					   </tr>
					 <?php } ?>
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Userid And Password')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
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
	