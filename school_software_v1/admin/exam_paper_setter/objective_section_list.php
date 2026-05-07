<?php include("../attachment/session.php"); ?>
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$chapter=$_GET['chapter'];
$paper_language2=$_GET['paper_language'];
$question_book=$_GET['question_book'];
if($chapter=='select_all'){
$chap="";
}else{
$chap=" and question_chapter='$chapter'";
}
if($question_book==''){
$question_book1="";
}else{
$question_book1=" and question_book='$question_book'";
}


$que="select * from question_objective where question_class='$class' and question_subject='$subject'$chap $question_book1 and paper_language='$paper_language2'";
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
	$options=$row['options'];
	$correct_answer=$row['correct_answer'];
	$question_class=$row['question_class'];
	$question_subject=$row['question_subject'];
	$question_chapter=$row['question_chapter'];
	$question_book=$row['question_book'];
    $paper_language=$row['paper_language'];
	
	$serial_no++;
	
?>		  
				  <div class="box" id="main_box1">
					<!-- /.box-header -->
					
					<br/>  
					<div class="box-body table-responsive no-padding" id="div_1" ><br/>
					<input type="hidden"  id="div_id_1" value="1" class="form-control">
					<input type="hidden"  id="question_table" value="question_objective" class="form-control">
					  <table class="table table-striped">
						<tr>
						  <th style="width:20px"><?php echo $serial_no; ?>.</th>
						  <th style="width:700px"><?php echo $question; ?></th>
						  <?php if($paper_language=='English'){?>
						  <th style="width:70px">Marks</th>
						  <?php }?>
						  <?php if($paper_language=='Hindi'){?>
						  <th style="width:70px">अंक</th>
						  <?php }?>
						  <th style="width:70px"><?php echo $marks; ?> </th>
						</tr>
						<tr>
						  <td style="text-align:center; ">A.</td>
						  <td style="width:700px"><?php echo $option_1; ?></td>
						 </tr>
						<tr>
						  <td style="text-align:center; ">B.</td>
						  <td style="width:700px"><?php echo $option_2; ?></td>
					    </tr>
						<tr>
						  <td style="text-align:center; ">C.</td>
						  <td style="width:700px"><?php echo $option_3; ?></td>
						</tr>
					<?php if($options>3){?>
						<tr>
						  <td style="text-align:center; ">D.</td>
						  <td style="width:700px"><?php echo $option_4; ?></td>
						</tr>
						<?php }?>
						<?php if($options>4){?>
						<tr>
						  <td style="text-align:center; ">E.</td>
						  <td style="width:700px"><?php echo $option_5; ?></td>
						</tr>
						<?php }?>
					    <tr>
						
						
						 <?php if($paper_language=='English'){?>
						  <td style="text-align:center; "><b>Ans.</b></td>
						 <?php }?>
						 
						 <?php if($paper_language=='Hindi'){?>
						  <td style="text-align:center; "><b>उत्तर</b></td>
						 <?php }?>
						
						  
						  <td style="width:700px"> <b>(<?php echo $correct_answer; ?>)</b></td>
						  <td style="width:70px; margin-top:5px;"><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','question_objective');" ><?php echo $language['Delete']; ?></button></td>
						</tr>
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
				