<?php include("../attachment/session.php"); ?>
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$chapter=$_GET['chapter'];
$paper_language2=$_GET['paper_language'];
if($chapter=='select_all'){
$chap="";
}else{
$chap=" and question_chapter='$chapter'";
}
$question_book=$_GET['question_book'];
if($question_book==''){
$question_book1="";
}else{
$question_book1=" and question_book='$question_book'";
}


$que="select * from question_matching where question_class='$class' and question_subject='$subject'$chap $question_book1 and paper_language='$paper_language2'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

    $s_no=$row['s_no'];
	$question=$row['question'];
	$marks=$row['marks'];
	$option_1=$row['option_1'];
	$option_2=$row['option_2'];
	$option_3=$row['option_3'];
	$option_4=$row['option_4'];
	$option_5=$row['option_5'];
	$option2_1=$row['option2_1'];
	$option2_2=$row['option2_2'];
	$option2_3=$row['option2_3'];
	$option2_4=$row['option2_4'];
	$option2_5=$row['option2_5'];
	$options=$row['options'];
	$answer_1=$row['answer_1'];
	$answer_2=$row['answer_2'];
	$answer_3=$row['answer_3'];
	$answer_4=$row['answer_4'];
	$answer_5=$row['answer_5'];
	$paper_language=$row['paper_language'];
	

	$serial_no++;
	
?>		  
				  <div class="box" id="main_box1">
					<!-- /.box-header -->
					
					<br/>  
					<div class="box-body table-responsive no-padding" id="div_1" ><br/>
					
					  <table class="table table-striped">
						<tr>
						  <th style="width:40px; text-align:left;"><?php echo $serial_no; ?>.</th>
						  <th colspan="4" style="width:800px"><?php echo $question; ?></th>
						  <?php if($paper_language=='English'){?>
						  <th>Marks</th>
						  <?php }?>
						  <?php if($paper_language=='Hindi'){?>
						  <th>अंक</th>
						  <?php }?>
						  <th ><?php echo $marks; ?><br/><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','question_objective');" ><?php echo $language['Delete']; ?></button></th>
						</tr>
						<tr>
						  <td style="text-align:right; ">A.</td>
						  <td style="width:250px"><?php echo $option_1; ?></td>
						  <td style="width:250px"><?php echo $option2_1; ?></td>
						  <td style="width:250px" > <b><?php echo $answer_1; ?></b></td>
						 </tr>
						<tr>
						  <td style="text-align:right; ">B.</td>
						  <td style="width:250px"><?php echo $option_2; ?></td>
						  <td style="width:250px"><?php echo $option2_2; ?></td>
						  <td style="width:250px"> <b><?php echo $answer_2; ?></b></td>
					    </tr>
						<tr>
						  <td style="text-align:right; ">C.</td>
						  <td style="width:250px"><?php echo $option_3; ?></td>
						  <td style="width:250px"><?php echo $option2_3; ?></td>
						  <td style="width:250px"> <b><?php echo $answer_3; ?></b></td>
						</tr>
					<?php if($options>3){?>
						<tr>
						  <td style="text-align:right; ">D.</td>
						  <td style="width:250px"><?php echo $option_4; ?></td>
						  <td style="width:250px"><?php echo $option2_4; ?></td>
						  <td style="width:250px"> <b><?php echo $answer_4; ?></b></td>
						</tr>
						<?php }?>
						<?php if($options>4){?>
						<tr>
						  <td style="text-align:right; ">E.</td>
						  <td style="width:250px"><?php echo $option_5; ?></td>
						  <td style="width:250px"><?php echo $option2_5; ?></td>
						  <td style="width:250px"> <b><?php echo $answer_5; ?></b></td>
						</tr>
						<?php }?>
					    
					    </table><br/>
						</div>
						<br/>
			       <!-- /.box-body -->
                 </div>
				 
				 <?php } }else{ ?>
				 <div class="box" id="main_box1">
					<div class="box-body table-responsive no-padding" id="div_1" ><br/>
					<center><h3>Data Not Found !!!</h3></center>
					</div><br/>
				 </div>
				 <?php } ?>
				