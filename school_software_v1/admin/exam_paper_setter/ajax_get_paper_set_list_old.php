<?php include("../attachment/session.php"); ?>
<style>
.table>tbody>tr>td
{
border-top: 1px solid white;
}

.table>tbody>tr>th
{
border-top: 1px solid white;
}
hr
{

background-color: black;
height: 2px;
}
</style>

<div class="" id="main_box1" style="height: 800px;overflow-y: auto;">
<div class="box-body table-responsive no-padding" id="printTable" ><br/>
<table class="table">
<!-- /.box-header --> 
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$exam_type=$_GET['exam_type'];
$id=$_GET['id'];
echo $language=$_GET['language'];


$que11="select * from question_paper_set where question_class='$class' and question_subject='$subject' and exam_type='$exam_type' and paper_unique_id='$id'";
$run11=mysqli_query($conn73,$que11);
if(mysqli_num_rows($run11)>0){
$total_marks=0;
while($row11=mysqli_fetch_assoc($run11)){

    $exam_type=$row11['exam_type'];
	$question_class=$row11['question_class'];
	$question_subject=$row11['question_subject'];
	$exam_date=$row11['exam_date'];
	$exam_time_from=$row11['exam_time_from'];
	$exam_time_to=$row11['exam_time_to'];
	$total_marks+=$row11['question_marks'];
	}
?>
<tr>
	<td colspan="3"><center><h2><?php echo $exam_type; ?></center></h2></td>
</tr>
<tr>
	<td><b><?php if($language=='English'){ echo "Exam Date : "; }elseif($language=='Hindi'){ echo "परीक्षा दिनांक : "; } ?><?php echo $exam_date; ?></b></td>
	<td width="370px;">&nbsp;</td>
	<td><b><?php if($language=='English'){ echo "Class : "; }elseif($language=='Hindi'){ echo "कक्षा : "; } ?><?php echo $question_class; ?></b></td>
</tr>
<tr>
	<td><b><?php if($language=='English'){ echo "Exam Time : "; }elseif($language=='Hindi'){ echo "परीक्षा समय : "; } ?><?php echo $exam_time_from."  -  ".$exam_time_to; ?></b></td>
	<td>&nbsp;</td>
	<td><b><?php if($language=='English'){ echo "Marks : "; }elseif($language=='Hindi'){ echo "पूर्णांक : "; } ?><?php echo $total_marks; ?></b></td>
</tr>
<tr>
	<td><b><?php if($language=='English'){ echo "Subject : "; }elseif($language=='Hindi'){ echo "विषय : "; } ?><?php echo $question_subject; ?></b></td>
	<td>&nbsp;</td>
	<td><b><?php if($language=='English'){ echo "Roll No : "; }elseif($language=='Hindi'){ echo "अनुक्रमांक : "; } ?>...............</b></td>
</tr>
<tr>
	<td colspan="3"><hr/></td>
</tr>
</table>
<table class="table" cellspacing="8" cellpadding="8">
<?php
if($language=='English'){
$status="english_status";
$col_name="english_instructions";
}elseif($language=='Hindi'){
$status="hindi_status";
$col_name="hindi_instructions";
}
$que55="select * from question_paper_instructions where `$status`='Active'";
$run55=mysqli_query($conn73,$que55) or die(mysqli_error($conn73));
$ser55=0;
if(mysqli_num_rows($run55)>0){
while($row55=mysqli_fetch_assoc($run55)){

    $instructions=$row55[$col_name];
	$ser55++;
	if($ser55>0 && $ser55<2){
?>
<tr>
  <td>&nbsp;</td>
  <?php if($language=='English'){ echo "<td colspan='3'><h4><b>INSTRUCTIONS - </b></h4></td>"; }elseif($language=='Hindi'){ echo "<td colspan='3'><h4><b>निर्देश - </b></h4></td>"; } ?>
</tr>
<?php } ?>
<tr>
  <td>&nbsp;</td>
  <td><b><?php echo $ser55."."; ?></b></td>
  <td width="800px;"><b><?php echo $instructions; ?></b></td>
  <td>&nbsp;</td>
</tr>
<?php
}
}
?>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td width="800px;">&nbsp;</td>
  <td>&nbsp;</td>
</tr>	
<?php
}
$que="select * from question_paper_set where question_class='$class' and question_subject='$subject' and exam_type='$exam_type' and paper_unique_id='$id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

    $question_s_no=$row['question_s_no'];
    $question_marks=$row['question_marks'];
	$question_type=$row['question_type'];
	$or_question_s_no=$row['or_question_s_no'];
	
	if($question_type=='Objective'){
	
	$que1="select * from question_objective where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){
		$question=$row1['question'];
		$options=$row1['options'];
		$marks=$row1['marks'];
	$serial_no++;
	
?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row1['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				<?php
				if($or_question_s_no!=''){
				$que1_1="select * from question_objective where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run1_1=mysqli_query($conn73,$que1_1);
				while($row1_1=mysqli_fetch_assoc($run1_1)){
					$question_1=$row1_1['question'];
					$options_1=$row1_1['options'];
				
				?>
						
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options_1;$i++){
						$options11=$row1_1['option_'.$i];
						if($options11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $options11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				 <?php } }elseif($question_type=='True_False'){
					$que2="select * from question_true_false where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
					$run2=mysqli_query($conn73,$que2);
					while($row2=mysqli_fetch_assoc($run2)){

					$question=$row2['question'];
					$options=$row2['options'];

					$serial_no++;
								 
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row2['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				<?php
				if($or_question_s_no!=''){
				$que2_1="select * from question_true_false where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run2_1=mysqli_query($conn73,$que2_1);
				while($row2_1=mysqli_fetch_assoc($run2_1)){
					$question_1=$row2_1['question'];
					$options_1=$row2_1['options'];
				
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options_1;$i++){
						$option11=$row2_1['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
						
				 <?php } }elseif($question_type=='Fill_in_the_blank'){
				 
					$que3="select * from question_fill_in_the_blank where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
					$run3=mysqli_query($conn73,$que3);
					while($row3=mysqli_fetch_assoc($run3)){
					
						$question=$row3['question'];
						$options=$row3['options'];

					$serial_no++;
					
				 
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
				 <?php
				 $j=0;
				 for($i=1;$i<=$options;$i++){
				 $option11=$row3['option_'.$i];
				 if($option11!=''){
				 $j++;
				 ?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
				 <?php
				 }
				 }
				 }
				 ?>
				 
				<?php
				if($or_question_s_no!=''){
				$que3_1="select * from question_fill_in_the_blank where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run3_1=mysqli_query($conn73,$que3_1);
				while($row3_1=mysqli_fetch_assoc($run3_1)){
						$question_1=$row3_1['question'];
						$options_1=$row3_1['options'];
				
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
				<?php
				 $j=0;
				 for($i=1;$i<=$options_1;$i++){
				 $option11_1=$row3_1['option_'.$i];
				 if($option11_1!=''){
				 $j++;
				 ?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11_1; ?></td>
						  <td>&nbsp;</td>
						</tr>
				 <?php
				 }
				 }
				 }
				 ?>
						
				 <?php } }elseif($question_type=='Short_Question'){
					$que4="select * from question_short where long_question_class='$class' and long_question_subject='$subject' and s_no='$question_s_no'";
					$run4=mysqli_query($conn73,$que4);
					while($row4=mysqli_fetch_assoc($run4)){
					
					$long_question=$row4['long_question'];

					$serial_no++;
					}
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
				<?php
				if($or_question_s_no!=''){
				$que4_1="select * from question_short where long_question_class='$class' and long_question_subject='$subject' and s_no='$or_question_s_no'";
				$run4_1=mysqli_query($conn73,$que4_1);
				while($row4_1=mysqli_fetch_assoc($run4_1)){
					$long_question_1=$row4_1['long_question'];
				}
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						
				 <?php } }elseif($question_type=='Long_Question'){
					$que5="select * from question_long where long_question_class='$class' and long_question_subject='$subject' and s_no='$question_s_no'";
					$run5=mysqli_query($conn73,$que5);
					while($row5=mysqli_fetch_assoc($run5)){
					
					$long_question=$row5['long_question'];

					$serial_no++;
					}
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
				<?php
				if($or_question_s_no!=''){
				$que5_1="select * from question_long where long_question_class='$class' and long_question_subject='$subject' and s_no='$or_question_s_no'";
				$run5_1=mysqli_query($conn73,$que5_1);
				while($row5_1=mysqli_fetch_assoc($run5_1)){
					$long_question_1=$row5_1['long_question'];
				}
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						
				 <?php } }elseif($question_type=='Unseen_Passage'){
					$que6="select * from question_unseen_passage where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
					$run6=mysqli_query($conn73,$que6);
					while($row6=mysqli_fetch_assoc($run6)){
					
					$question=$row6['question'];
					$options=$row6['options'];
					
					$serial_no++;
					
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row6['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ echo 'Q.'.$j.'.'; }elseif($language=='Hindi'){ echo 'प्र.'.$j.'.'; } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
						
				<?php
				if($or_question_s_no!=''){
				$que6_1="select * from question_unseen_passage where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run6_1=mysqli_query($conn73,$que6_1);
				while($row6_1=mysqli_fetch_assoc($run6_1)){
					$question_1=$row6_1['question'];
					$options_1=$row6_1['options'];
				
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options_1;$i++){
						$option11=$row6_1['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ echo 'Q.'.$j.'.'; }elseif($language=='Hindi'){ echo 'प्र.'.$j.'.'; } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
						
				 <?php } }elseif($question_type=='One_Word'){
					$que7="select * from question_one_word where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
					$run7=mysqli_query($conn73,$que7);
					while($row7=mysqli_fetch_assoc($run7)){
					
					$question=$row7['question'];
					$options=$row7['options'];
					
					$serial_no++;
					
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row7['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				<?php
				if($or_question_s_no!=''){
				$que7_1="select * from question_one_word where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run7_1=mysqli_query($conn73,$que7_1);
				while($row7_1=mysqli_fetch_assoc($run7_1)){
					$question_1=$row7_1['question'];
					$options_1=$row7_1['options'];
				
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options_1;$i++){
						$option11=$row7_1['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><?php echo $option11; ?></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				 <?php } }elseif($question_type=='Matching'){
					$que8="select * from question_matching where question_class='$class' and question_subject='$subject' and s_no='$question_s_no'";
					$run8=mysqli_query($conn73,$que8);
					while($row8=mysqli_fetch_assoc($run8)){
					
					$question=$row8['question'];
					$options=$row8['options'];
					
					$serial_no++;
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row8['option_'.$i];
						$option21=$row8['option2_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><label style="width:300px;font-weight:normal;"><?php echo $option11; ?></label><label style="width:100px;"></label><label style="width:300px;font-weight:normal;"><?php echo $option21; ?></label></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				<?php
				if($or_question_s_no!=''){
				$que8_1="select * from question_matching where question_class='$class' and question_subject='$subject' and s_no='$or_question_s_no'";
				$run8_1=mysqli_query($conn73,$que8_1);
				while($row8_1=mysqli_fetch_assoc($run8_1)){
					$question_1=$row8_1['question'];
					$options_1=$row8_1['options'];
				
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options_1;$i++){
						$option11_1=$row8_1['option_'.$i];
						$option21_1=$row8_1['option2_'.$i];
						if($option11_1!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ if($j=='1'){ echo 'A.'; }elseif($j=='2'){ echo 'B.'; }elseif($j=='3'){ echo 'C.'; }elseif($j=='4'){ echo 'D.'; }elseif($j=='5'){ echo 'E.'; } }elseif($language=='Hindi'){ if($j=='1'){ echo 'अ.'; }elseif($j=='2'){ echo 'ब.'; }elseif($j=='3'){ echo 'स.'; }elseif($j=='4'){ echo 'द.'; }elseif($j=='5'){ echo 'इ.'; } } ?></td>
						  <td width="800px;"><label style="width:300px;font-weight:normal;"><?php echo $option11_1; ?></label><label style="width:100px;"></label><label style="width:300px;font-weight:normal;"><?php echo $option21_1; ?></label></td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						}
						}
						}
						?>
				 <?php } }elseif($question_type=='Other'){
					$que9="select * from question_other where long_question_class='$class' and long_question_subject='$subject' and s_no='$question_s_no'";
					$run9=mysqli_query($conn73,$que9);
					while($row9=mysqli_fetch_assoc($run9)){
					
					$long_question=$row9['long_question'];
					
					$serial_no++;
					}
				 ?>
						<tr>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
				<?php
				if($or_question_s_no!=''){
				$que9_1="select * from question_other where long_question_class='$class' and long_question_subject='$subject' and s_no='$or_question_s_no'";
				$run9_1=mysqli_query($conn73,$que9_1);
				while($row9_1=mysqli_fetch_assoc($run9_1)){
					$long_question_1=$row9_1['long_question'];
				}
				?>
						<tr>
						  <?php if($language=='English'){ echo "<td colspan='4'><center><h6><b>OR</b></h6></center></td>"; }elseif($language=='Hindi'){ echo "<td colspan='4'><center><h6><b>अथवा</b></h6></center></td>"; } ?>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width="800px;"><b><?php echo $long_question_1; ?></b></td>
						  <td><b><?php echo $question_marks; ?></b></td>
						</tr>
						
				 <?php } } ?>
				 
				 <?php } }else{ ?>
					<center><h3>Data Not Found !!!</h3></center>
				 <?php } ?>
<!-- /.box-body -->
</table><br/>
</div>
<div class="">
<center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print</button></center>
</div>
</div>
				