<?php include("../attachment/session.php");
$event_name=$_GET['event_name'];
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
 newWin.close();
//$('#printTable').print();
 }
</script>
  <section class="content-header">
      <h1>
       Event Management Team Download
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>Home</a></li>
	    <li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Team Management</a></li>
	    <li class="active">Download PDF EXCEL</li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable','Team Creation')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$que="select * from school_info_general";
			$run=mysqli_query($conn73,$que);
			while($row=mysqli_fetch_assoc($run)){
			$school_info_school_name = $row['school_info_school_name'];
			$school_info_logo = $row['school_info_logo'];
		
			}
			?>
				
			  <div class="col-md-12">
			  <span style="font-size:20px;font-weight:bold"><center><?php echo $school_info_school_name; ?></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><?php echo $event_name; ?>-<?php echo $company_name1; ?></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center>TEAM REPORT WITH PARTICIPANTS LIST</center></span>
			  </div>
		
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
				<td style="float:left"><b></b></td>
				<td style="float:right"><b></b></td>
			  </tr>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="" style="width:100%;">
			 
			  <tr class="my_background_color">
	   <th>S No.</th>
        <th>Name</th>
        <th>Class</th>
        <th>Adm/Sch No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>D.O.B</th>
        <th>Aadhar/Uid No</th>
		      </tr>
<?php

$event_name=$_GET['event_name'];
if($event_name!=''){
if($event_name!='All'){
$condition1=" and event_name='$event_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}

 $query1="select * from  event_team_creation where s_no!=''$condition1 ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
   $s_no=$row['s_no'];
	$event_name = $row['event_name'];
	$participate_type = $row['participate_type'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$dateofbirth = $row['dateofbirth'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_adhar_number = $row['student_adhar_number'];
    $serial_no++;
	?>
<tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $student_name; ?></td>
	<td><?php echo $student_class; ?></td>
    <td><?php echo $student_admission_number; ?></td>
	<td><?php echo $student_father_name; ?></td>
	<td><?php echo $student_mother_name; ?></td>
    <td><?php echo $dateofbirth; ?></td>
    <td><?php echo $student_adhar_number; ?></td>
  </tr>
<?php  $serial_no11++; } ?>
			  </table>
			
<div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center>ESCORTS DETAILS</center></span>
			  </div>
			  <div class="col-md-12">
			  </div>
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
				<td style="float:left"><b></b></td>
				<td style="float:right"><b></b></td>
			  </tr>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="" style="width:100%;">
			 
			  <tr class="my_background_color">
	    <th>S No.</th>
        <th>Name Of Staff</th>
        <th>Designation</th>
        <th>Contact No</th>
        <th>Remarks</th>
		      </tr>
<?php

$event_name=$_GET['event_name'];
if($event_name!=''){
if($event_name!='All'){
$condition1=" and event_name='$event_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}

 $query1="select * from  event_team_creation_staff where s_no!=''$condition1";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row1=mysqli_fetch_assoc($run)){
    $s_no=$row1['s_no'];
    $emp_name=$row1['emp_name'];
    $emp_designation=$row1['emp_designation'];
    $emp_mobile=$row1['emp_mobile'];
    $remark_staff=$row1['remark_staff'];
 
	$serial_no++;
	?>
<tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $emp_name; ?></td>
	<td><?php echo $emp_designation; ?></td>
    <td><?php echo $emp_mobile; ?></td>
	<td><?php echo $remark_staff; ?></td>
  </tr>
<?php  $serial_no11++; } ?>
			  </table>
			
        <!-- /.col -->
      </div>
      </div>
	
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Team Creation'),exportTableToExcel_staff('printTable_staff');"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  
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
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
