<?php include("../attachment/session.php"); ?>
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$chapter=$_GET['chapter'];
$paper_language2=$_GET['paper_language'];
if($chapter=='select_all'){
$chap="";
}else{
$chap=" and long_question_chapter='$chapter'";
}
$question_book=$_GET['question_book'];
if($question_book==''){
$question_book1="";
}else{
$question_book1=" and long_question_book='$question_book'";
}


$que="select * from question_short where long_question_class='$class' and long_question_subject='$subject'$chap $question_book1  and paper_language='$paper_language2'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

    $s_no=$row['s_no'];
	$long_question=$row['long_question'];
	$long_marks=$row['long_marks'];
	$long_correct_answer=$row['long_correct_answer'];
	$paper_language=$row['paper_language'];

	$serial_no++;
	
?>		  
				  <div class="box" id="main_box1">
					<!-- /.box-header -->
					
					<br/>  
					<div class="box-body table-responsive no-padding" id="div_1" ><br/>
					
					  <table class="table table-striped">
						<tr>
						  <th style="width:50px; text-align:left;"><?php echo $serial_no; ?>.</th>
						  <th style="width:700px"><?php echo $long_question; ?></th>
						  
						  <?php if($paper_language=='English'){?>
						  <th style="width:70px">Marks</th>
						  <?php }?>
						  <?php if($paper_language=='Hindi'){?>
						  <th style="width:70px">अंक</th>
						  <?php }?>
						  
						  <th style="width:70px"><?php echo $long_marks; ?><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','question_objective');" ><?php echo $language['Delete']; ?></button> 
						  </th>
						</tr>
						<tr>
						 <?php if($paper_language=='English'){?>
						  <td style="text-align:right; ">Ans.</td>
						 <?php }?>
						 
						 <?php if($paper_language=='Hindi'){?>
						  <td style="text-align:right; ">उत्तर</td>
						 <?php }?>
						 
						  <td colspan="4"><?php echo $long_correct_answer; ?>
						  </td>
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
				