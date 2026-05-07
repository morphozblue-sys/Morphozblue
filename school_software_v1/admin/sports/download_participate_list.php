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
        Participate List Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"#><i class="fa fa-futbol-o"></i> Sport Management</a></li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Event Result Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			  <td><center><b>EVENT RESULT REPORT</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="" style="width:100%;">
			 
			  <tr >
				<th>Serial No.</th>
				   <th>Name</th>
				   <th>Class/Sec</th>
				   <th>Gender</th>
                   <th>Adm No</th>
				   <th>Father Name</th>
				   <th>Mother Name</th>
				   <th>Dob</th>
				   <th>Aadhar/Uid</th>
				   <th>Contact</th>
				   <th>Sports Name</th>
				   <th>Board Reg No</th>
				   <th>Age Category</th>
				   <th>Actual Age </th>
		      </tr>
    <?php
$que="select * from sports_participate_table ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

    $s_no = $row['s_no'];
    $student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_section = $row['student_section'];
	$gender = $row['gender'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$dateofbirth = $row['dateofbirth'];
	$student_adhar_number = $row['student_adhar_number'];
	$contact_no = $row['contact_no'];
	$sports_name = $row['sports_name'];
	$board_no = $row['board_no'];
	$age_category = $row['age_category'];
	$actual_age = $row['actual_age'];
	$serial_no++;
	
	?>

<tr align='center'>
    <th><?php echo $serial_no; ?></th>
	<th><?php echo $student_name; ?></th>
	<th><?php echo $student_class; ?>(<?php echo $student_section; ?>)</th>
	<th><?php echo $gender; ?></th>
	<th><?php echo $student_admission_number; ?></th>
	<th><?php echo $student_father_name; ?></th>
	<th><?php echo $student_mother_name; ?></th>
	<th><?php echo $dateofbirth; ?></th>
	<th><?php echo $student_adhar_number; ?></th>
	<th><?php echo $contact_no; ?></th>
	<th><?php echo $sports_name; ?></th>
	<th><?php echo $board_no; ?></th>
	<th><?php echo $age_category; ?></th>
	<th><?php echo $actual_age; ?></th>
  </tr>
<?php } ?>
			  </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-sm-12">&nbsp;</div>
			  <div class="col-sm-12">
			  <div class="col-sm-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Event Result Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
