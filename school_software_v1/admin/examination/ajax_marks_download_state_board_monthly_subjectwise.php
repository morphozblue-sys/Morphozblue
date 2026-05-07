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
$('#printTable').print();
 }
</script>
<?php
$student_class=$_POST['student_class'];
$student_section=$_POST['student_class_section'];
$student_class_stream=$_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];

$selected_exam=$_POST['selected_exam'];
$selected_subject=$_POST['selected_subject'];

if($student_class=='11TH' || $student_class=='12TH'){
    $condition1=" and stream_name='$student_class_stream'";
    $condition01=" and student_class_stream='$student_class_stream'";
    $condition2=" and group_name='$student_class_group'";
    $condition02=" and student_class_group='$student_class_group'";
}else{
    $condition1="";
    $condition01="";
    $condition2="";
    $condition02="";
}
$query="select * from school_info_subject_info where class='$student_class' and (session_value='$session1' || session_value='') $condition1$condition2$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
//$subject_name='';
while($row=mysqli_fetch_assoc($res)){
$subject_code=$row['subject_code'];
 $subject_name[$subject_code]=$row['subject_name'];
}

$query3="select * from school_info_class_info where class_name='$student_class'";
$res3=mysqli_query($conn73,$query3)or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$class_code=$row3['class_code']; 
}
$query00="select * from school_info_exam_types_monthly where exam_type!='' and class_code='$class_code' and (session_value='$session1' || session_value='') $filter37";
$res00=mysqli_query($conn73,$query00)or die(mysqli_error($conn73));
$exam_type='';
while($row00=mysqli_fetch_assoc($res00)){
$exam_code=$row00['exam_code'];
$exam_type[$exam_code]=$row00['exam_type'];
}
//$exam_type=$_POST['student_exam_type'];
?>
		<div class="col-md-12">
		
			  <div class="col-md-6">
				  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php echo $student_class.'_'.$student_section.'_Marks'; ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
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
			 <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b>Marks INFO</b></center></span>
			  </div>
			    <div class="col-md-12">
			     <table width="100%">
			         <tr><td>
			  <span style="float:left;"><b>Class : <?php echo $student_class; ?></b></span>
			  </td><td>
			  <span style="float:right;"><b>Section : <?php echo $student_section; ?></b></span>
			  </td></tr>
			  <tr><td colspan="2">
			      <span><b>Exam Type :- </b></span>
			      <span>
			          <?php
			          $exam_count=count($selected_exam);
			          for($az=0;$az<$exam_count;$az++){
			              echo $exam_type[$selected_exam[$az]].', ';
			          }
			          ?>
			      </span>
			  </td></tr>
			  </table>
			  </div>

   <div class="col-md-12">
			
				  <table  class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.NO.</th>
								  <th>Student Name</th>
								  <th>Student_Roll_No</th>
                                  <?php
                                  $sub_count=count($selected_subject);
                                  for($ax=0;$ax<$sub_count;$ax++){
                                  ?>
								  <th><?php echo $subject_name[$selected_subject[$ax]]; ?></th>
								  <?php } ?>
								  <th>Total Marks</th>
								</tr>
						</thead>
					<tbody >
<?php

// for($p1=0;$p1<$total_subject;$p1++){
//  $exam_marks1[$p1]=$exam_type."_".$subject_code[$p1]."_marks";
// }

$query3="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_section' and student_status='Active' and session_value='$session1'$condition01$condition02 $filter37 ORDER BY school_roll_no ASC";
$serial_no=0;
$res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$school_roll_no=$row3['school_roll_no'];
$student_name=$row3['student_name'];
$student_roll_no=$row3['student_roll_no'];
$student_class1=$row3['student_class'];
$student_class_section1=$row3['student_class_section'];

$query1="select * from examination_monthly where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
if(mysqli_num_rows($res1)>0){
}else{
$que4="select * from school_info_class_info Where class_name='$student_class1'";
$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($run4)){
$class_code = $row4['class_code'];
}
$quer111="insert into examination_monthly(student_roll_no,student_class,student_section,student_name,student_class_code,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_class1','$student_class_section1','$student_name','$class_code','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$quer111);
$query1="select * from examination_monthly where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
}

while($row1=mysqli_fetch_assoc($res1)){
for($p1=0;$p1<$sub_count;$p1++){
if($p1==0){
$total_marks=0;
}
$student_marks[$p1]=0;
for($p2=0;$p2<$exam_count;$p2++){
$exam_marks1[$p2]=$selected_exam[$p2]."_".$selected_subject[$p1]."_marks";
$student_marks[$p1]=$student_marks[$p1]+$row1[$exam_marks1[$p2]];
$total_marks=$total_marks+$row1[$exam_marks1[$p2]];
}
}
}
$serial_no++;

?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $school_roll_no;?> </td>
<?php for($j=0;$j<$sub_count;$j++){ ?>
<td><?php echo $student_marks[$j]; ?></td>
<?php } ?>
<td><?php echo $total_marks; ?></td>

</tr>
<?php
}
?>
					</tbody>
				 </table>
				 
		
		</div>	  
        <!-- /.col -->
      </div>
      </div>
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php echo $student_class.'_'.$student_section.'_Marks'; ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  
 
  
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
