<?php include("../attachment/session.php")?>
<style>
.table>tbody>tr>td
{
border-top: 1px solid white;
}

.table>tbody>tr>th
{
border-top: 1px solid white;
}

</style>
<div class="box" id="main_box1">
<!-- /.box-header -->
<div class="box-body table-responsive no-padding" id="" style="height: 400px;overflow-y: auto;" ><br/>
<table class="table">
		
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$chapter=$_GET['chapter'];
$language=$_GET['language'];
if($chapter=='select_all'){
$chap1="";
}else{
$chap1=" and long_question_chapter='$chapter'";
}
$book=$_GET['book'];
if($book=='all_book'){
$book1="";
}else{
$book1=" and long_question_book='$book'";
}

include("../../con73/con37.php");

$que="select * from question_short where long_question_class='$class' and paper_language='$language' and long_question_subject='$subject'$chap1$book1";
$run=mysqli_query($conn73,$que);
$serial_no=0;
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

    $s_no=$row['s_no'];
	$long_question=$row['long_question'];
	$long_marks=$row['long_marks'];
	$long_correct_answer=$row['long_correct_answer'];
	$long_question_class=$row['long_question_class'];
	$long_question_subject=$row['long_question_subject'];
	$long_question_chapter=$row['long_question_chapter'];
	$long_question_book=$row['long_question_book'];

	$serial_no++;
	
?>
						<tr>
						  <td><input type="checkbox" id="" class="question" value="<?php echo $s_no; ?>" onclick="for_paper();"></td>
						  <td><b><?php echo $serial_no; ?>.</b></td>
						  <td>&nbsp;</td>
						  <td colspan="8"><b><?php echo $long_question; ?></b></td>
						  <td><b>Marks:</b></td>
						  <td><input type="text" name="question_marks" style="width:30px;" id="<?php echo $s_no; ?>" value="<?php echo $long_marks; ?>" /></td>
						</tr>
				 
				 <?php } }else{ ?>
					<center><h3>Data Not Found !!!</h3></center>
				 <?php } ?>
				 
</table>
</div>
<br/>
<!-- /.box-body -->
</div>
				