<?php include("../attachment/session.php");
 
	$id = $_POST['id'];
	$english_instructions = $_POST['english_instruction'];
	$english_status = $_POST['english_status'];
	$hindi_instructions = $_POST['hindi_instruction'];
	$hindi_status = $_POST['hindi_status'];
	$count=count($id);
	$update=0;
  for($i=0; $i<$count; $i++){
  echo $quer="update question_paper_instructions set english_instructions='$english_instructions[$i]',english_status='$english_status[$i]',hindi_instructions='$hindi_instructions[$i]',hindi_status='$hindi_status[$i]',$update_by_update_sql where s_no='$id[$i]'";
  if(mysqli_query($conn73,$quer)){
  $update=$update+1;
  }
  }

if($update>0){
		
		echo "|?|success|?|";
	}
	


?>