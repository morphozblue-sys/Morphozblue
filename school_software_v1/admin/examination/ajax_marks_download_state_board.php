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
                   $exam_type=$_GET['student_exam_type'];
                  $student_class_stream=$_GET['student_class_stream'];
                  $student_class_group=$_GET['student_class_group'];
                  //$exam_term=$_GET['exam_term'];
                  $subject_type111=$_GET['subject_type'];
                  if($subject_type111!='All'){
                      $condition=" and subject_type='$subject_type111'";
                  }else{
                      $condition="";
                  }
                  $order_by=$_GET['order_by'];
                  ?>
		<div class="col-md-12">
		
			  <div class="col-md-6">
				  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php  if($student_section=='All'){echo $student_class.'_Marks';}else{echo $student_class.'_'.$student_section.'_Marks';} ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
           <?php if($student_section=='All'){  ?>
			    <div class="col-md-12">
			  <div class="col-md-12">
			  <center><b>Class : <?php echo $student_class; ?></b></center>
			  </div>
			  </div>
			<?php }else{ ?> 
			
			<div class="col-md-12">
			  <div class="col-md-6">
			  <center><b>Class : <?php echo $student_class; ?></b></center>
			  </div><div class="col-md-6">
			  <center><b>Section : <?php echo $student_section; ?></b></center>
			  </div>
			  </div>
			
			<?php } ?>
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
								  <th rowspan="2" >Serial No</th>
								  <th rowspan="2" >School Roll No</th>
								  <th rowspan="2" >Student Name</th>
								  <th rowspan="2" >Father's Name</th>
								  <th rowspan="2" >Student Class/Section</th>
				<?php
                     $query="select * from school_info_subject_info where stream_name='$student_class_stream' and group_name='$student_class_group' and class='$student_class'$condition and (session_value='$session1' || session_value='') $filter37";
                    $res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
					$total_subject=0;
					$total_subject_marks=0;
                    while($row=mysqli_fetch_assoc($res)){
                    $subject_name=$row['subject_name'];
					$subject_code[$total_subject]=$row['subject_code'];
					$subject_code1=$row['subject_code'];
					
					for($i=1;$i<=10;$i++){ 
                      $subject_category=$row['category'.$i];
                      $subject_category_column='category'.$i;
                      if($subject_category!=''){
                         $category_set=1;
                         $subject_category_name_array[$subject_code1][]=$subject_category;
                         $subject_category_code_array[$subject_code1][]=$i-1;
                         $subjects_category[$subject_code1]=$subjects_category[$subject_code1]+1;
                        }
                      }
                      if($subjects_category[$subject_code1]==0){ 
                      $subjects_category[$subject_code1]=1;
                      $subject_category_name_array[$subject_code1][]='';
                      $subject_category_code_array[$subject_code1][]='';
                    }
					
				    
				    $subject_mark_add[$total_subject]=explode("|?|",$row[$exam_type.'_mark_add']);
				    $subject_mark_maximum[$total_subject]=explode("|?|",$row[$exam_type.'_maximum_mark']);
					$subject_mini_marks[$total_subject]=$row[$exam_type.'_minimum_mark'];
					for($c=0;$c<$subjects_category[$subject_code1];$c++){
				    if($subject_mark_add[$total_subject][$c]=="Yes"){
					$total_subject_marks=$total_subject_marks+$subject_mark_maximum[$total_subject][$c];
				    }
					}
				    $row_span='';
				    if($subjects_category[$subject_code1]==1 && $subject_category_name_array[$subject_code1][0]=='')
				    $row_span=2;
				    
					$total_subject++;
								  ?>
								  <th colspan="<?=$subjects_category[$subject_code1]?>" rowspan="<?=$row_span?>" ><?php echo $subject_name; ?></th>
								  <?php } ?>
								  <th rowspan="2" >Total Marks</th>
								  <th rowspan="2" >Percentage</th>
								  <th rowspan="2" >Result</th>
								</tr>
								<tr>
								 <?php 
								  for($s=0;$s<$total_subject;$s++){ 
								    for($c=0;$c<$subjects_category[$subject_code[$s]];$c++){ 
					              $category_name=$subject_category_name_array[$subject_code[$s]][$c];         
								  ?>
								  <th style="display:<?php if($category_name==''){ echo 'none'; }?>" ><?php echo $category_name; ?></th>
								  <?php 
					              }
                                   } 
								  ?>
								</tr>
						</thead>
					<tbody >
					<?php
 
for($p1=0;$p1<$total_subject;$p1++){
 $exam_marks1[$p1]=$exam_type."_".$subject_code[$p1]."_marks";
}



if($student_section=='All'){
$query3="select * from student_admission_info where student_class='$student_class' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$order_by";
}else{
$query3="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_section' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$order_by";    
}
$serial_no=0;
$res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$school_roll_no=$row3['school_roll_no'];
$student_name=$row3['student_name'];
$student_roll_no=$row3['student_roll_no'];
$student_class1=$row3['student_class'];
$student_class_section1=$row3['student_class_section'];
$student_father_name=$row3['student_father_name'];

$query1="select * from examination where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
if(mysqli_num_rows($res1)>0){
}else{
	$que4="select * from school_info_class_info Where class_name='$student_class1'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_code = $row4['class_code'];
    }
    $quer111="insert into examination(student_roll_no,student_class,student_section,student_name,student_class_code,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_class1','$student_class_section1','$student_name','$class_code','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer111);
	$query1="select * from examination where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
}
$total_marks=0;
$fail_pass='Pass';
$fail_pass_count=0;
while($row1=mysqli_fetch_assoc($res1)){
for($p1=0;$p1<$total_subject;$p1++){
$student_marks[$p1]=explode("|?|",$row1[$exam_marks1[$p1]]);


	for($c=0;$c<$subjects_category[$subject_code[$p1]];$c++){
	if($subject_mark_add[$p1][$c]=="Yes"){
	$total_marks=$total_marks+$student_marks[$p1][$c];    
	if($student_marks[$p1][$c]<$subject_mini_marks[$p1][$c])
	$fail_pass_count++;
	}
	}


}
}
$serial_no++;


if($total_marks!=0 && $total_subject_marks!=0)
$percent=round(($total_marks/$total_subject_marks)*100,2);
else
$percent=0;


if($percent<33)
$fail_pass='Fail';


					?>
					<tr>
					<td><?php echo $serial_no; ?></td>
					<td><?php echo $school_roll_no; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class1.'('.$student_class_section1.')'; ?></td>
					<?php for($j=0;$j<$total_subject;$j++){ 
					for($c=0;$c<$subjects_category[$subject_code[$j]];$c++)
					{
					 $category_name=$subject_category_name_array[$subject_code[$j]][$c];    
					?>
					<td><?php echo $student_marks[$j][$c]; ?></td>
					<?php 
					}
					} 
					?>
					<td><?php echo $total_marks; ?></td>
					<td><?php echo $percent.' %'; ?></td>
					
				     <td><?php echo $fail_pass; ?></td>
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
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', '<?php echo $student_class.'_'.$student_class_section1.'_Marks'; ?>')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
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
