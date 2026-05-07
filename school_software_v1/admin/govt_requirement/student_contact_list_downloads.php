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

  <section class="content-header">
      <h1>
        Goverment Requirement
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('govt_requirement/govt_requirement')"><i class="fa fa-stack-overflow"></i> <?php echo $language['Govt. Requir.']; ?></a></li>
	    <li><a href="javascript:get_content('govt_requirement/student_contact_list')"><i class="fa fa-stack-overflow"></i>Student Contact List</a></li>
	    <li class="active">Download Contact List</li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Student Contact List')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			  <td><center><b>STUDENT CONTACT LIST</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
				  <table cellspacing="0" cellpadding="10px;" border="1" id="example1" class="table table-bordered table-striped" style="width:100%;">
						<thead >
								<tr>
								  <td><b>S.No.</b></td>
								  <?php 
								  
									  $info_column_name='';
								      $info_column_arr='';
									  $student_data=$_POST['student_data'];
									  $student_data1=count($student_data);
									  for($i=0; $i<$student_data1; $i++)
									  {
										$student_data2=explode('|?|',$student_data[$i]); 
										$student_heading=$student_data2[1];
										$student_colums_name[$i]=$student_data2[0];
										$info_column_name=$info_column_name.",$student_data2[0]";
								  ?>
								  <td><b><?php echo $student_heading; ?></b></td>
								  <?php }  ?>
								</tr>
						</thead>
					<tbody>
						<?php 
					$std_class=$_POST['std_class'];
					$student_class_section=$_POST['student_class_section'];
					if($std_class!='All')
					{
						$condition1=" and student_class='$std_class'";
					}
					else{
						$condition1='';
					}
					if($student_class_section!='All')
					{
						$condition2=" and student_class_section='$student_class_section'";
					}
					else{
						$condition2='';
					}
					$sql="select s_no $info_column_name from student_admission_info where student_status='Active' and session_value='$session1'$filter37$condition1$condition2";
					$run=mysqli_query($conn73,$sql) or die(mysqli_error($conn73));
					$num_rows=mysqli_num_rows($run);
					$sno=0;
					if($num_rows>0)
					{
						while($rows=mysqli_fetch_assoc($run))
						{
							$sno++;
					?>
					   <tr>
						  <td><?php echo $sno ?></td>
						  <?php 
						  for($j=0; $j<$student_data1; $j++)
						  {
						  ?>
						  <td><?php echo $rows[$student_colums_name[$j]]; ?></td>
						<?php } ?>
					   </tr>
					  <?php 
						}
					}
					
					?>
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-danger" onclick="return ('printTable', 'Student Contact List')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
	