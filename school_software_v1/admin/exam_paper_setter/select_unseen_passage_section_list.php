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
$chap1=" and question_chapter='$chapter'";
}
$book=$_GET['book'];
if($book=='all_book'){
$book1="";
}else{
$book1=" and question_book='$book'";
}

include("../../con73/con37.php");

$que="select * from question_unseen_passage where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap1$book1";
$run=mysqli_query($conn73,$que);
$serial_no=0;
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

    $s_no=$row['s_no'];
	$question=$row['question'];
	$options=$row['options'];
	$marks=$row['marks'];

	$serial_no++;
	
?>
						<tr>
						  <td><input type="checkbox" id="" class="question" value="<?php echo $s_no; ?>" onclick="for_paper();"></td>
						  <td><b><?php echo $serial_no; ?>.<b></td>
						  <td>&nbsp;</td>
						  <td colspan="8"><b><?php echo $question; ?><b></td>
						  <td><b>Marks:<b></td>
						  <td><input type="text" name="question_marks" style="width:30px;" id="<?php echo $s_no; ?>" value="<?php echo $marks; ?>" /></td>
						</tr>
						<?php
						$j=0;
						for($i=1;$i<=$options;$i++){
						$option11=$row['option_'.$i];
						if($option11!=''){
						$j++;
						?>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td><?php if($language=='English'){ echo 'Q.'.$j.'.'; }elseif($language=='Hindi'){ echo 'प्र.'.$j.'.'; } ?></td>
						  <td colspan="10"><?php echo $option11; ?></td>
						</tr>
						<?php
						}
						}
						?>
						
				 <?php } }else{ ?>
					<center><h3>Data Not Found !!!</h3></center>
				 <?php } ?>
				 
</table>
</div>
<br/>
<!-- /.box-body -->
</div>
				 
				