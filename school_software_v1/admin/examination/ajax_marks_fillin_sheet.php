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
$sheet_type=$_POST['sheet_type'];
$order_by=$_POST['order_by'];
$or='';
$select_subject_query=" and  ( ";
$selected_subject=' ';
$selected_subject=$selected_subject.implode(' ',$_POST['selected_subject']);

$selected_subject1=$_POST['selected_subject'];
for($s1=0;$s1<count($selected_subject1);$s1++)
{
$select_subject_query=$select_subject_query.$or." subject_code='$selected_subject1[$s1]' ";
$or=' or ';
}
$select_subject_query=$select_subject_query." ) ";

$filled_sheet=true;
if($sheet_type=='blank')
$filled_sheet=false;

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
$query="select * from school_info_subject_info where class='$student_class' $select_subject_query and (session_value='$session1' || session_value='') $condition1$condition2$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));

$total_subjects=0;
$subject_code='';
while($row=mysqli_fetch_assoc($res)){ 
$subject_code=$row['subject_code'];   
if(stripos($selected_subject,$subject_code)){  
$subjects_name[$subject_code]=$row['subject_name'];
$subjects_code[$total_subjects]=$subject_code;
$subjects_category[$subject_code]=0;
$total_subjects++;
}
}



$query3="select * from school_info_class_info where class_name='$student_class'";
$res3=mysqli_query($conn73,$query3)or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$class_code=$row3['class_code']; 
}
$query00="select * from school_info_exam_types where exam_type!='' and class_code='$class_code'  and exam_code='$selected_exam' and (session_value='$session1' || session_value='') $filter37";
$res00=mysqli_query($conn73,$query00)or die(mysqli_error($conn73));
$exam_type='';
$exam_code='';
while($row00=mysqli_fetch_assoc($res00)){
$exam_code=$row00['exam_code'];
$exam_type=$row00['exam_type'];
}

 
 $exam_marks_maximum1=$exam_code."_maximum_mark";
 $exam_marks_minimum1=$exam_code."_minimum_mark";
 $exam_marks_add1=$exam_code."_mark_add";
 
 $exp_session_year=explode('_',$session1);
 $exp_session_year1=$exp_session_year[0];
 $exp_session_year2=$exp_session_year[0]+1;
 $category_set=0;
 $query5="select * from school_info_subject_info where class='$student_class' $select_subject_query and session_value='$session1'$condition_0011$filter37";
 $res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
 while($row4=mysqli_fetch_assoc($res4)){ 
 $subject_code1=$row4['subject_code'];
 $student_maximum_marks[$subject_code1]=explode('|?|',$row4[$exam_marks_maximum1]);
 $student_minimum_marks[$subject_code1]=explode('|?|',$row4[$exam_marks_minimum1]);
 $exam_marks_add[$subject_code1]=explode('|?|',$row4[$exam_marks_add1]);

  for($i=1;$i<=10;$i++){ 
      $subject_category=$row4['category'.$i];
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
   }
 
 
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
			           echo $exam_type;
			          ?>
			      </span>
			  </td></tr>
			  </table>
			  </div>

   <div class="col-md-12">
			    
				  <table  class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th rowspan="2" >S.NO.</th>
								  <th rowspan="2" >Student Name</th>
								  <th rowspan="2" >Student Roll No</th>
                                  <?php
                                  $sub_count=count($subjects_name);
                                  for($ax=0;$ax<$sub_count;$ax++){
                                  $res=$subjects_category[$subjects_code[$ax]];      
                                  ?>
								  <th rowspan="<?php if($res==1){ echo '2'; } ?>" colspan="<?php if($res>1){echo $res+1;}else{ echo $res;} ?>"><span><center><?php echo $subjects_name[$subjects_code[$ax]]; ?></span></center></th>
								  <?php } ?>
								  <th rowspan="2">Grand Total</th>
								</tr>
								<tr>
                                  <?php
                                  $sub_count=count($subjects_name);
                                  for($ax=0;$ax<$sub_count;$ax++){
                                    $res=$subjects_category[$subjects_code[$ax]];   
                                    for($sub_cat=0;$sub_cat<$subjects_category[$subjects_code[$ax]];$sub_cat++)
                                    {
                                   if($subjects_category[$subjects_code[$ax]]>1){ ?>
								  <th><?php echo $subject_category_name_array[$subjects_code[$ax]][$sub_cat]; ?></th>
								  <?php } } if($res>1){ ?>
								  <th style="color:red;" >Total</th>
								  <?php } } ?>
								  
								</tr>
						</thead>
					<tbody >
					  <tr>
						  <th colspan="3" ><span><center>Maximum</center></span></th>
                          <?php
                          $sub_count=count($subjects_name);
                          $grad_total=0;
                          for($ax=0;$ax<$sub_count;$ax++){
                              $res=$subjects_category[$subjects_code[$ax]]; 
                              $total=0;
                           for($sub_cat=0;$sub_cat<$subjects_category[$subjects_code[$ax]];$sub_cat++)
                              { $total+=$student_maximum_marks[$subjects_code[$ax]][$sub_cat];if(!$filled_sheet){ $total=''; }
                                if($res==1)
                                $grad_total+=$student_maximum_marks[$subjects_code[$ax]][$sub_cat];
                             ?>
							 <th><?php if($filled_sheet){ echo $student_maximum_marks[$subjects_code[$ax]][$sub_cat]; } ?></th>
						    <?php } if($res>1){ ?>
						    <th style="color:red;" ><?=$total?></th>
						    <?php } if(!$filled_sheet){ $grad_total=''; } } ?>
						    <th ><?=$grad_total?></th>
					  </tr>
					  <tr>
						  <th colspan="3" ><span><center>Minimum</center></span></th>
                          <?php
                          $sub_count=count($subjects_name);
                          $grad_total=0;
                          for($ax=0;$ax<$sub_count;$ax++){
                              $total=0;
                             $res=$subjects_category[$subjects_code[$ax]];  
                          for($sub_cat=0;$sub_cat<$subjects_category[$subjects_code[$ax]];$sub_cat++)
                              { $total+=$student_minimum_marks[$subjects_code[$ax]][$sub_cat];if(!$filled_sheet){ $total=''; }
                                if($res==1)
                                $grad_total+=$student_minimum_marks[$subjects_code[$ax]][$sub_cat];
                             ?>
							<th><?php if($filled_sheet){ echo $student_minimum_marks[$subjects_code[$ax]][$sub_cat]; } ?></th>
						   <?php }  if($res>1){ ?>
						    <th style="color:red;" ><?=$total?></th>
						    <?php }  if(!$filled_sheet){ $grad_total=''; } } ?>
						    <th ><?=$grad_total?></th>
					  </tr>  
                <?php
                $query3="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_section' and student_status='Active' and session_value='$session1'$condition01$condition02 $filter37 ORDER BY $order_by ASC";
                $serial_no=0;
                $res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
                while($row3=mysqli_fetch_assoc($res3)){
                $school_roll_no=$row3['school_roll_no'];
                $student_name=$row3['student_name'];
                $student_roll_no=$row3['student_roll_no'];
                $student_class1=$row3['student_class'];
                $student_class_section1=$row3['student_class_section'];
                
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
                
                while($row1=mysqli_fetch_assoc($res1)){
                for($s=0;$s<$total_subjects;$s++){ 
                $subject_code1=$subjects_code[$s];
                $exam_marks1=$exam_code."_".$subject_code1."_marks";
                $exam_marks[$subject_code1]=explode('|?|',$row1[$exam_marks1]);
                }
                }
                
                $serial_no++;
                
                ?>
                <tr>
                <td><?php echo $serial_no; ?></td>
                <td><?php echo $student_name; ?></td>
                <td><?php echo $school_roll_no;?> </td>
                <?php $grad_total=0; for($j=0;$j<$sub_count;$j++){ 
                 $res=$subjects_category[$subjects_code[$j]];      
                 $total=0;
                for($sub_cat=0;$sub_cat<$subjects_category[$subjects_code[$j]];$sub_cat++){
                $total+=$exam_marks[$subjects_code[$j]][$sub_cat]; 
                if($res==1)
                $grad_total+=$exam_marks[$subjects_code[$j]][$sub_cat];
                if(!$filled_sheet){ $total=''; }
                ?>
				<td><?php if($filled_sheet){ echo $exam_marks[$subjects_code[$j]][$sub_cat]; } ?></td>
				<?php } if($res>1){ ?>
				<td style="color:red;" ><?=$total?></td>
				<?php }  if(!$filled_sheet){ $grad_total=''; }} ?>
				<th ><?=$grad_total?></th>
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
