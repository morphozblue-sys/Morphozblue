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
			 
			 function grade($percentage)
			 {
			     if($percentage>=75){
                $grade='A';    
                }elseif($percentage>=60 && $percentage<=74.9){
                $grade='B';    
                }elseif($percentage>=45 && $percentage<=59.9){
                $grade='C';    
                }elseif($percentage>=33 && $percentage<=44.9){
                $grade='D';    
                }elseif($percentage>=0 && $percentage<=32.9){
                $grade='E';    
                }
                return $grade;
                
			 }
			 
				  $student_class=$_GET['id'];
                  $student_section=$_GET['student_section'];
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
                  
            if($student_section=='All'){                 
            $query2="select * from student_admission_info where student_class='$student_class'  and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$order_by";
            }else{
            $query2="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_section' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$order_by";    
            }
            $total_student=0;        
            		$run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
                    while($row2=mysqli_fetch_assoc($run2)){
                    $student_roll_no[$total_student]=$row2['student_roll_no'];
            $total_student++;
            }                  
                              
                              
                              
             //// code for rank start
            $que4="select * from school_info_class_info where class_name='$student_class'";
            $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
            while($row4=mysqli_fetch_assoc($run4)){
            $class_code=$row4['class_code'];
            }
            
            $que="select * from school_info_exam_types where class_code='$class_code' and (session_value='$session1' || session_value='')";
            $total_exam=0;
            $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
            while($row1=mysqli_fetch_assoc($run1)){
            $exam_type7=$row1['exam_type'];
            if($exam_type7!=''){
            $exam_type2[]=$row1['exam_type'];
            $exam_code[]=$row1['exam_code'];
            $grand_total_maximum[$total_exam]=0;
            $grand_total_minimum[$total_exam]=0;
            $grand_total_obtain[$total_exam]=0;
            $grand_total_student_maximum_marks[$total_exam]=0;
            $grand_total_exam_marks1[$total_exam]=0;
            
            $total_exam++;
            }
            }
            
            $que="select * from school_info_subject_info where class='$student_class' and group_name='$student_class_group' and stream_name='$student_class_stream' $condition and (session_value='$session1' || session_value='')  ";
            $total_subject=0;
            $total_subject_other=0;
            $total_subject_practical=0;
            $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
            while($row1=mysqli_fetch_assoc($run1)){ 
            $subject_type = $row1['subject_type'];
            $subject_code1 = $row1['subject_code'];
            $subjects_name[$subject_code1]=$row1['subject_name'];
            if($subject_type=='subject'){
            $subject[] = strtolower($row1['subject_name']);
            $subject_code[] =$row1['subject_code'];
            for($j=0; $j<$total_exam; $j++){
            $exam_marks_maximum1=$exam_code[$j]."_maximum_mark";
            $exam_marks_minimum1=$exam_code[$j]."_minimum_mark";
            $exam_marks_add1=$exam_code[$j]."_mark_add";
            $student_maximum_marks[$total_subject][$j]=explode("|?|",$row1[$exam_marks_maximum1]);
            $student_minimum_marks[$total_subject][$j]=explode("|?|",$row1[$exam_marks_minimum1]);
            $exam_marks_add[$total_subject][$j]=explode("|?|",$row1[$exam_marks_add1]);
            }
            $total_obtain[$total_subject]=0;
            $total_maximum[$total_subject]=0;
            $total_minimum[$total_subject]=0;
            $total_subject++;
            }else if($subject_type=='other_subject'){
            $subject_other[] = strtolower($row1['subject_name']);
            $subject_code_other[] =$row1['subject_code'];
            for($j=0; $j<$total_exam; $j++){
            $exam_marks_maximum1_other=$exam_code[$j]."_maximum_mark";
            $exam_marks_minimum1_other=$exam_code[$j]."_minimum_mark";
            $exam_marks_add1_other=$exam_code[$j]."_mark_add";
            $student_maximum_marks_other[$total_subject_other][$j]=explode("|?|",$row1[$exam_marks_maximum1_other]);
            $student_minimum_marks_other[$total_subject_other][$j]=explode("|?|",$row1[$exam_marks_minimum1_other]);
            $exam_marks_add_other[$total_subject_other][$j]=explode("|?|",$row1[$exam_marks_add1_other]);
            }
            $total_obtain_other[$total_subject_other][$j]=0;
            $grand_total_maximum_other[$total_subject_other][$j]=0;
            $total_subject_other++;
            }else if($subject_type=='practical'){
            $subject_practical[] = strtolower($row1['subject_name']);
            $subject_code_practical[] =$row1['subject_code'];
            for($j=0; $j<$total_exam; $j++){
            $exam_marks_maximum1_practical=$exam_code[$j]."_maximum_mark";
            $exam_marks_minimum1_practical=$exam_code[$j]."_minimum_mark";
            $exam_marks_add1_practical=$exam_code[$j]."_mark_add";
            $student_maximum_marks_practical[$total_subject_practical][$j]=explode("|?|",$row1[$exam_marks_maximum1_practical]);
            $student_minimum_marks_practical[$total_subject_practical][$j]=explode("|?|",$row1[$exam_marks_minimum1_practical]);
            $exam_marks_add_practical[$total_subject_practical][$j]=explode("|?|",$row1[$exam_marks_add1_practical]);
            }
            $total_obtain_practical[]=0;
            $total_subject_practical++;
            }
             for($i=1;$i<=10;$i++){ 
              $subject_category=$row1['category'.$i];
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
            
            
            $exam1_roll='';
            $exam1='';
            $exam2='';
            $exam3='';
            $student_rank_array=array();
            for($ac=0;$ac<$total_student;$ac++){
                ////////////////////////
            
            $query1="select * from examination where student_roll_no='$student_roll_no[$ac]' and session_value='$session1'";
            $run1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
            while($row1=mysqli_fetch_assoc($run1)){
            $z=0;
            $total_marks=0;
            for($i=0; $i<$total_subject; $i++){ 
            $category=$subjects_category[$subject_code[$i]];    
            for($j=0; $j<$total_exam; $j++){
            $exam_marks=$exam_code[$j]."_".$subject_code[$i]."_marks";
            $exam_marks1[$i][$j]=explode("|?|",$row1[$exam_marks]);
            
            for($c=0;$c<$category;$c++){
                
            if($student_maximum_marks[$i][$j][$c]!=0){ 
            $exam_marks_weightage[$i][$j][$c]=$exam_marks1[$i][$j][$c]*100/$student_maximum_marks[$i][$j][$c];
            $total_marks+=$exam_marks1[$i][$j][$c];
            }
            }
            }
            }
            
            for($i=0; $i<$total_subject_other; $i++){ 
            $category=$subjects_category[$subject_code_other[$i]];    
            for($j=0; $j<$total_exam; $j++){
            $exam_marks=$exam_code[$j]."_".$subject_code_other[$i]."_marks";
            $exam_marks1[$i][$j]=explode("|?|",$row1[$exam_marks]);
            
            for($c=0;$c<$category;$c++){
                
            // if($student_maximum_marks[$i][$j][$c]!=0){ 
            $exam_marks_weightage[$i][$j][$c]=$exam_marks1[$i][$j][$c]*100/$student_maximum_marks_other[$i][$j][$c];
            $total_marks+=$exam_marks1[$i][$j][$c];
            // }
            }
            }
            }
            
            $student_rank_array[$student_roll_no[$ac]]=$total_marks;
            
            }
            
            
                  
            }
            
             $json = json_encode($student_rank_array);
            function getRanks($json) {
            $tmp_arr = json_decode($json, TRUE);
            arsort($tmp_arr);
            $uniq_vals = array_values(array_unique($tmp_arr)); // unique values indexed numerically from 0
            
            foreach ($tmp_arr as $k => $v) {
                $tmp_arr[$k] = array_search($v, $uniq_vals) + 1; //as rank will start with 1
            }
            return $tmp_arr;
            }
            $get_rank=getRanks($json);
            
            
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
								  <th rowspan="2" >Student Id</th>
								  <th rowspan="2" >Student Name</th>
								  <th rowspan="2" >Father Name</th>
								  <th rowspan="2" >Roll Number</th>
								  <th rowspan="2" >Adm Number</th>
								  <th rowspan="2" >Student Class</th>
								  <th rowspan="2" >Student Section</th>
				            <?php
                                  foreach($subjects_name as $x => $value){
                                  $res=$subjects_category[$x];      
                                  ?>
								  <th rowspan="<?php if($res==1){ echo '2'; } ?>" colspan="<?php if($res>1){echo $res;}else{ echo $res;} ?>"><span><center><?php echo $subjects_name[$x]; ?></span></center></th>
								  <?php } ?>
								  
							  <th rowspan="2">Total Marks</th>
							  <th rowspan="2" >Percentage</th>
							  <th rowspan="2" >Grade</th>
							  <th rowspan="2" >Rank</th>
								</tr>
								<tr>
								<?php   
								
                                  foreach($subjects_name as $x => $value){
                                  $res=$subjects_category[$x];
                                  for($sub_cat=0;$sub_cat<$res;$sub_cat++)
                                    {
                                 if($subject_category_name_array[$x][$sub_cat]!='')
                                 {
                                  ?>
								  <th ><span><center><?php echo $subject_category_name_array[$x][$sub_cat]; ?></span></center></th>
								  <?php } } } ?> 
								</tr>
						</thead>
					<tbody >
				    <?php 
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
                $student_admission_number=$row3['student_admission_number'];
                $student_scholar_number=$row3['student_scholar_number'];
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
                $res1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
                
                
                
                }
                while($row11=mysqli_fetch_assoc($res1))
                { 
                   $total_marks_category_wise=array();
                   $subject_all=0;
                   $total_marks=0;
                   $total_max_marks=0;
                   $total_max_marks=0;
                   for($i=0; $i<$total_subject; $i++){ 
                    $category=$subjects_category[$subject_code[$i]];    
                    for($j=0; $j<$total_exam; $j++){
                    $exam_marks=$exam_code[$j]."_".$subject_code[$i]."_marks";
                    $exam_marks1[$subject_all][$j]=explode("|?|",$row11[$exam_marks]);
                    
                    for($c=0;$c<$category;$c++){
                        
                    // if($student_maximum_marks[$i][$j][$c]!=0){ 
                    $exam_marks_weightage[$subject_all][$j][$c]=$student_maximum_marks[$i][$j][$c];
                    $total_marks+=$exam_marks1[$subject_all][$j][$c];
                    $total_max_marks+=$student_maximum_marks[$i][$j][$c];
                    $total_marks_category_wise[$subject_all][$c]+=$exam_marks1[$i][$j][$c];
                    // }
                    }
                    }
                    $subject_all++;
                    }  
                    
                   for($i=0; $i<$total_subject_other; $i++){ 
                    $category=$subjects_category[$subject_code_other[$i]];    
                    for($j=0; $j<$total_exam; $j++){
                    $exam_marks=$exam_code[$j]."_".$subject_code_other[$i]."_marks";
                    
                    $exam_marks1[$subject_all][$j]=explode("|?|",$row11[$exam_marks]);
                    
                    for($c=0;$c<$category;$c++){
                        
                    // if($student_maximum_marks_other[$i][$j][$c]!=0){ 
                    $exam_marks_weightage[$subject_all][$j][$c]=$exam_marks1[$i][$j][$c]*100/$student_maximum_marks_other[$i][$j][$c];
                    $total_marks+=$exam_marks1[$subject_all][$j][$c];
                    $total_max_marks+=$student_maximum_marks_other[$i][$j][$c];
                    $total_marks_category_wise[$subject_all][$c]+=$exam_marks1[$i][$j][$c];
                    // }
                    }
                    }
                    $subject_all++;
                    }   
                }
               
				?>  
				 <tr>
				   <td><?php echo $serial_no+1; ?></td>
                   <td><?php echo $student_roll_no; ?></td>
                   <td><?php echo $student_name; ?></td>
                   <td><?php echo $student_father_name; ?></td>
                   <td><?php echo $school_roll_no; ?></td>
                   <td><?php echo $student_admission_number; ?></td>
                   <td><?php echo $student_class1; ?></td>
                   <td><?php echo $student_class_section1; ?></td> 
                   <?php  
                    
				    for($i=0; $i<count($total_marks_category_wise); $i++){ 
  
                    for($c=0;$c<count($total_marks_category_wise[$i]);$c++){
                   
                    ?>
                    <td><span><center><?=$total_marks_category_wise[$i][$c]?></center></span></td>
                    <?php 
                    }
                    }     
                  ?> 
                  <td><?=$total_marks?></td>
                  <td><?=round($total_marks*100/$total_max_marks,2)?></td>
                  <td><?=grade(round($total_marks*100/$total_max_marks,2))?></td>
                  <td><?=$get_rank[$student_roll_no]?></td>
				 </tr> 
				 <?php  
                  $serial_no++; }  
				 ?>
					</tbody>
				 </table>
				 
			</div>
			  
        <!-- /.col -->
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
