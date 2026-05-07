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

<?php 

$student_class=$_GET['id'];
$student_section=$_GET['student_section'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$exam_term=$_GET['exam_term'];
$exam_type=$_GET['exam_type'];
$subject_type111=$_GET['subject_type'];

if($subject_type111!='All'){
$condition=" and subject_type='$subject_type111'";
}else{
$condition="";
}
                  
if($student_section==''){
$condition_section="";
}else{
$condition_section=" and student_class_section='$student_section'";
}  


                    $query="select * from school_info_subject_info where stream_name='$student_class_stream' and group_name='$student_class_group' and class='$student_class'$condition and (session_value='$session1' || session_value='') $filter37";
                    $res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
					$total_subject=0;
                    while($row=mysqli_fetch_assoc($res)){
					$total_subject++;
                    }
?>
                  
                  
                  
                  
		<div class="col-md-12">
		
			  <div class="col-md-6">
				  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php if($student_section!=''){ echo $student_class.'_'.$student_section.'_'.$exam_term.'_Marks'; }else{ echo $student_class.'_'.$exam_term.'_Marks';
				  } ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
			  $school_info_principal_seal=$schl_row['school_info_principal_seal'];
            $school_info_principal_signature=$schl_row['school_info_principal_signature'];
            $school_info_logo=$schl_row['school_info_logo'];
			}
			
			
			?>
			
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span>
			  </div>

              <?php 
			  $session2=explode('_',$session1); 
			  $session=$session2[0].'-'.$session2[1];
			  
			  ?>
			    

              <table  class="table table-bordered table-striped" >     
			  <tr>
			  <td>     
			  <span><center><b>Term : <?php echo ucfirst($exam_term); ?></b></center></span>
			  </td>
			  <td>
			  <center><b>Session : <?php echo $session;  ?></b></center>
			  </td>
			  <?php for($u=0;$u<$total_subject+5;$u++){ ?>
			  <td>
			  </td>
			  <?php } ?>
              <td>     
			  <center><b>Class : <?php echo $student_class.'-'.$student_section; ?></b></center>
			  </td>
			  <td>
			      
			  <?php if($total_student!=0){
			  ?>
			  <center><b>Percent : <?php echo round($percent_common_total/$total_student,2); ?></b></center>
			  <?php
			  }else{ ?>
			       <center><b>Percent : <?php echo round("",2); ?></b></center>
			 <?php
			  }
			  ?>
			  
			  </td>
			  </tr>
			  </table>
			  
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
				<td style="float:left"><b></b></td>
				<td style="float:right"><b></b></td>
			  </tr>
			  </table>
         <div class="box-body table-responsive" >
			
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S No</th>
								  <th>Adm No.</th>
								  <th>Student Name</th>
								  <th>Roll No.</th>
				    <?php
                    $query="select * from school_info_subject_info where stream_name='$student_class_stream' and group_name='$student_class_group' and class='$student_class'$condition and (session_value='$session1' || session_value='') $filter37";
                    $res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
					$total_subject=0;
					$total_subject_marks=0;
                    while($row=mysqli_fetch_assoc($res)){
                    $subject_name=$row['subject_name'];
					$subject_code[$total_subject]=$row['subject_code'];
				    $total_subject_marks=$total_subject_marks+$row[$exam_term.'_'.$exam_type.'_maximum_mark'];
					$total_subject++;
					?>
								  <th><?php echo $subject_name; ?></th>
								  <?php } ?>
								  <th>Total Marks</th>
								  <th>Percentage</th>
								  <th>Result</th>
								  <th>Position</th>
								  <th>Attendance</th>
								</tr>
						</thead>
					<tbody >
<?php

$exam_table=$exam_term."_";

for($p1=0;$p1<$total_subject;$p1++){
 $exam_marks1[$p1]=$exam_type."_".$subject_code[$p1]."_marks";
}

$query3="select * from student_admission_info where student_class='$student_class'$condition_section and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1' order by student_name ASC";
$serial_no=0;
$res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$school_roll_no=$row3['school_roll_no'];
$student_name=$row3['student_name'];
$student_roll_no=$row3['student_roll_no'];
$student_class1=$row3['student_class'];
$student_class_section1=$row3['student_class_section'];
$student_admission_number=$row3['student_admission_number'];

$query1="select * from examination_$exam_term where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
if(mysqli_num_rows($res1)>0){
}else{
	$que4="select * from school_info_class_info Where class_name='$student_class1'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_code = $row4['class_code'];
    }
    $quer111="insert into examination_$exam_term(student_roll_no,student_class,student_section,student_name,student_class_code,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_class1','$student_class_section1','$student_name','$class_code','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer111);
	$query1="select * from examination_$exam_term where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
}
$total_marks=0;
while($row1=mysqli_fetch_assoc($res1)){
    
for($p1=0;$p1<$total_subject;$p1++){
  
 $student_marks[$p1]=$row1[$exam_marks1[$p1]];
$total_marks=$total_marks+$student_marks[$p1];
 $total_working_days=$row1[$exam_type.'_total_attendance'];   
 $total_present_days=$row1[$exam_type.'_total_present']; 
}
}
$serial_no++;

if($total_subject_marks!=0){
$percent=$total_marks*100/$total_subject_marks;
}else{
$percent=0;    
}

if($percent>=90){
$grade='A+';    
}elseif($percent>=80 && $percent<90){
$grade='A';   
}elseif($percent>=70 && $percent<80){
$grade='B+';   
}elseif($percent>=60 && $percent<70){
$grade='B';   
}elseif($percent>=50 && $percent<60){
$grade='C';   
}elseif($percent>=33 && $percent<50){
$grade='D';   
}else{
$grade='E';    
}


					?>
					<tr>
					<td><?php echo $serial_no; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $school_roll_no; ?></td>
					<?php for($j=0;$j<$total_subject;$j++){ ?>
					<td><?php echo $student_marks[$j]; ?></td>
					    <?php
						} 
						?>
					<td><?php echo $total_marks; ?></td>
					<td><?php echo round($percent,2).' %'; ?></td>
					<td><?php echo $grade; ?></td>
					<td></td>
					<td><?php echo $total_present_days; ?></td>
				
					</tr>
					<?php
					}
					?>
					
					</tbody>
				 
                <thead class="my_background_color">
                    <tr>
                        <th></th>
                        <th></th>
                        <th width="10%">Highest Marks Obtained</th>
                        <th></th>
                        <?php for($j=0;$j<$total_subject;$j++){ ?>
                        <th></th>
                        <?php 
                        } 
                        ?>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            
			</div>
			
			<?php $count_subject=$total_subject+7; 
			
			if($count_subject%2){
            $adjust=($count_subject-1)/2;
			}else{
			$adjust=$count_subject/2;    
			}
			
			?>
			
			<div><br><br><br></div>
            <table  class="table table-bordered table-striped" >     
                <tr>
                    <td>     
                    <center><b>Principal</b></center>
                    </td>
                    <?php for($u1=0;$u1<$adjust;$u1++){ ?>
                    <td>
                    </td>
                    <?php } ?>
                    <td>     
                    <center><b>Class Teacher</b></center>
                    </td>
                    <?php for($u1=0;$u1<$adjust;$u1++){ ?>
                    <td>
                    </td>
                    <?php } ?>
                    <td>     
                    <center><b>Exam Controller</b></center>
                    </td>
                </tr>
            </table>
			
			
        <!-- /.col -->
      </div>
      </div>
      </div>
      </div>
      
	  <div class="col-md-12">&nbsp;</div>
			  
	  <div class="col-md-12">
	  <div class="col-md-6">
	  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php echo $student_class.'_'.$student_class_section1.'_'.$exam_term.'_Marks'; ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
