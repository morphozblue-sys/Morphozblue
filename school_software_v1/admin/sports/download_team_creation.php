<?php include("../attachment/session.php");
$sports_name=$_GET['sports_name'];
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

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
       Event Management Team Download
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"><i class="fa fa-futbol-o"></i> Sport Management</a></li>
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
		 <div class="col-sm-6">
         <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable','Team Creation Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
         </div>
         <div class="col-sm-6">
         <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
         </div>
		</div>
        </div>
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
			<div class="col-xs-10 col-xs-offset-1">
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
			  <td><center><b>TEAM REPORT WITH PARTICIPANTS LIST</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="" style="width:100%;">
			 
			  <tr >
	   <th>S No.</th>
        <th>Name</th>
        <th>Class</th>
        <th>Adm No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>D.O.B</th>
        <th>Board Reg No</th>
		      </tr>
<?php
$sports_name=$_GET['sports_name'];
if($sports_name!=''){
if($sports_name!='All'){
$condition1=" and sports_name='$sports_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}
$age_category=$_GET['age_category'];
if($age_category!=''){
if($age_category!='All'){
$condition2=" and age_category='$age_category'";
}else{
$condition2="";
}
}else{
$condition2="";
}
$query1="select * from  sports_team_creation where s_no!=''$condition1$condition2 and session_value='$session1' ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
   $s_no=$row['s_no'];
	$sports_name = $row['sports_name'];
	$student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_admission_number = $row['student_admission_number'];
	$dateofbirth = $row['dateofbirth'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$board_no = $row['board_no'];
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
    <td><?php echo $board_no; ?></td>
    </tr>
<?php  $serial_no11++; } ?>
			  </table>
			
              <div class="col-md-12">
				<span style="font-weight:bold"><center>COACH & MANAGER DETAILS</center></span>
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
			 
			  <tr >
	    <th>S No.</th>
        <th>Name Of Staff</th>
        <th>Designation</th>
        <th>Contact No</th>
        <th>Remarks</th>
		      </tr>
<?php
$sports_name=$_GET['sports_name'];
if($sports_name!=''){
if($sports_name!='All'){
$condition1=" and sports_name='$sports_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}

 $query1="select * from  sports_team_creation_staff where s_no!=''$condition1";
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
	
			  <div class="col-sm-12">&nbsp;</div>
			  <div class="col-sm-12">
			  <div class="col-sm-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Team Creation Report'),exportTableToExcel_staff('printTable_staff');"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-sm-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
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


