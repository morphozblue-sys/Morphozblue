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
 newWin.close();
//$('#printTable').print();
 }
</script>

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        School Student Strength Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
	    <li><a href="event_management.php"><i class="fa fa-stack-overflow"></i>Event Management</a></li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'student List')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
		</div>
        </div>
		<?php if($company_name='company_a'){
		       $school="Happy Days (CBSE)";
		}elseif($company_name='company_b'){
		$school="Happy Days Higher Seconday School (Mp Board)";
		
		}
		?>
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			
			 <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b>HAPPY DAYS SCHOOL</b></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center>EVENT RESULT REPORT</center></span>
			  </div>
			  <div class="col-md-12">
			    <img src="../pdf/logohappy.png" style="height:90px;width:120px;margin-top:-60px;">
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
        <th>Participate Type</th>
        <th>Name Of Event</th>
        <th>Name Of Participants</th>
        <th>DOB</th>
        <th>Class & Section</th>
        <th>Gender</th>
        <th>School/Institute Name</th>
        <th>Category</th>
        <th>House Name</th>
        <th>Result Remarks</th>
		      </tr>
<?php

 $event_name=$_POST['event_name'];
if($event_name!='All'){

$condition1=" and event_name='$event_name'";
}else{
$condition1="";
}
// if($house_wise!=''){
// $condition2=" and house_name='$house_wise'";
// }else{
// $condition2="";
// }
   $house_wise=$_POST['house'];
if($house_wise!=''){
if($house_wise!='All'){
    $condition2=" and house_name='$house_wise'";
}else{
   $condition2="";
}
}else{
  $condition2="";
}

// if($remarks!=''){
// $condition3=" remark='$remarks'";
// }else{
// $condition3="";
// }

$remarks=$_POST['remarks'];
if($remarks!=''){
if($remarks!='All'){
$condition3=" and remark='$remarks'";
}else{
$condition3="";
}
}else{
$condition3="";
}

  $query1="select * from event_result where s_no!=''$condition1$condition2$condition3";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$participate_type = $row['participate_type'];
	$student_name = $row['student_name'];
	$event_name = $row['event_name'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$gender = $row['gender'];
	$student_class = $row['student_class'];
	$dateofbirth = $row['dateofbirth'];
	$remark = $row['remark'];
	$category = $row['category'];
    $serial_no++;
	?>
<tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $participate_type; ?></td>
	<td><?php echo $event_name; ?></td>
    <td><?php echo $student_name; ?></td>
	<td><?php echo $dateofbirth; ?></td>
	<td><?php echo $student_class; ?></td>
    <td><?php echo $gender; ?></td>
    <td><?php echo $school_name; ?></td>
    <td><?php echo $category; ?></td>
    <td><?php echo $house_name; ?></td>
    <td><?php echo $remark; ?></td>
  </tr>
<?php  $serial_no11++; } ?>
			  </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Student Strength Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
