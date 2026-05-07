<?php include("../attachment/session.php");

$issue_book_ser=$_POST['issue_book_ser'];

 $book_id_no=$_POST['book_id'];
 $book_title=$_POST['book_title'];
 $book_author_name=$_POST['book_author_name'];
 $student_full_name=$_POST['student_name'];
 $student_class_and_section=$_POST['student_class_and_section'];
 $student_roll_no=$_POST['student_roll_no'];
 $issue_date=$_POST['issue_date'];
 $return_date=$_POST['date_of_return'];
 $status=$_POST['status'];
 
$view=0;
$alert=0;
$issue_book_count=count($issue_book_ser);
for($as=0;$as<$issue_book_count;$as++){
$indexing=$issue_book_ser[$as];
 
 $chk_qry="select * from issue_book where book_id_no='$book_id_no[$indexing]' and student_roll_no='$student_roll_no' and status='Active'";
 $chk_res=mysqli_query($conn73,$chk_qry)or die(mysqli_error($conn73));
 if(mysqli_num_rows($chk_res)<1){
  $qry2="select * from school_library_book where book_id_no='$book_id_no[$indexing]'";
				  $result=mysqli_query($conn73,$qry2);
				  while($row=mysqli_fetch_assoc($result)){
				  echo $no_of_copy=$row["no_of_copy"];
				  $copy_left=$no_of_copy-1;
				  }
 
  $query="insert into issue_book(book_id_no,student_roll_no,issue_date,due_date,class,author_name,status,book_title,student_name,session_value,$update_by_insert_sql_column) values ('$book_id_no[$indexing]','$student_roll_no','$issue_date','$return_date','$student_class_and_section','$book_author_name[$indexing]','$status','$book_title[$indexing]','$student_full_name','$session1',$update_by_insert_sql_value)";
 mysqli_query($conn73,$query);
 
  $query1="update school_library_book set no_of_copy='$copy_left',$update_by_update_sql  where book_id_no='$book_id_no[$indexing]'"; 
	if(mysqli_query($conn73,$query1)){
// 	 echo "|?|success|?|view|?|"; 
	$view++;
	
	}
	}else{
// 	echo "|?|success|?|alert|?|";
	$alert++;
	}
 
}
echo "|?|".$view."|?|".$alert."|?|";
 ?>
 