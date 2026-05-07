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
	    <li><a href="javascript:get_content('downloads/student_fees_download_list')"><i class="fa fa-stack-overflow"></i>Student Fees List</a></li>
	    <li class="active">Download Fees List</li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Student fees List')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$schl_query="select fees_type,school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$fees_type=$schl_row['fees_type'];
			}
			
			if($fees_type=='monthly' || $fees_type=='yearly' || $fees_type=='installmentwise'){
			    $add_table="common_";
			}else{
			    $add_table="";
			}
			?>
			  
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
			  <td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			  </tr>
			  <tr>
			  <td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			  <td><center><b>STUDENT FEES LIST</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
				  <?php
				  $student_data=$_POST['student_data'];
				  $head_count=count($student_data);
				  ?>
				  <table id="example1" class="table table-bordered table-striped" style="width:100% " border="1px;" cellspacing="0" cellpadding="5px;">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <?php
								//  $info_column_name='';
								//  $info_column_arr='';
								  for($i=0;$i<$head_count;$i++){
								  $student_data1=explode('|?|',$student_data[$i]);
								  $info_heading=$student_data1[1];
								  $info_column_arr[$i]=$student_data1[0];
								  $info_column_name=$info_column_name.",$student_data1[0]";
								  ?>
								  <th><?php echo $info_heading; ?></th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody >
					<?php
					$date_from = $_POST['date_from'];
					$date_to = $_POST['date_to'];
					$std_class = $_POST['std_class'];
					$student_class_section = $_POST['student_class_section'];
					
					if($date_from!=''){
					$condition1=" and fee_submission_date>='$date_from'";
					}else{
					$condition1='';
					}
 					if($date_to!=''){
					$condition2=" and fee_submission_date<='$date_to'";
					}else{
					$condition2='';
					}
					if($std_class!='All'){
					$condition3=" and student_class='$std_class'";
					}else{
					$condition3='';
					}
					if($student_class_section!='All'){
					$condition4=" and student_class_section='$student_class_section'";
					}else{
					$condition4='';
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
$query1="select student_roll_no from student_admission_info where student_status='Active' and session_value='$session1'$condition3$condition4$filter37$condition11"; 
$result1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
$serial_no=0;
while($row1=mysqli_fetch_assoc($result1)){
$student_roll_no=$row1['student_roll_no'];

$query="select s_no,student_payment_mode$info_column_name from ".$add_table."fees_student_fee_add where student_roll_no='$student_roll_no' and fee_status='Active' and session_value='$session1'$condition1$condition2$condition3$condition4"; 
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($result)){
$student_payment_mode=$row['student_payment_mode'];
$serial_no++;
?>
<tr>
<td><?php echo $serial_no; ?></td>
<?php for($j=0;$j<$head_count;$j++){ ?>
<?php if($info_column_arr[$j]=='fee_submission_date'){ ?>
<td><?php echo date('d-m-Y',strtotime($row[$info_column_arr[$j]])); ?></td>
<?php }elseif($info_column_arr[$j]=='cheque_date'){ ?>
<?php if($student_payment_mode=='Cash'){ ?>
<td>&nbsp;</td>
<?php }else{ ?>
<td><?php echo date('d-m-Y',strtotime($row[$info_column_arr[$j]])); ?></td>
<?php } ?>
<?php }else{ ?>
<td><?php echo $row[$info_column_arr[$j]]; ?></td>
<?php } ?>
<?php } ?>
</tr>
<?php
} }
?>
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Student fees List')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
	