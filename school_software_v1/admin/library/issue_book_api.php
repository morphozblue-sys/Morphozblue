<?php
include("../attachment/session.php");

  $book_id_no=$_POST['book_id_number'];
  $student_roll_no=$_POST['student_roll_no'];
  $issue_date=$_POST['issue_date'];
  $return_date=$_POST['date_of_return'];
  $student_class=$_POST['student_class'];
  $student_class_section=$_POST['author_name'];
  $status=$_POST['status'];
  $book_title=$_POST['book_title'];
  $student_name=$_POST['student_name'];
 $copy_left=$_POST['copy_left'];
$query="insert into issue_book(book_id_no,student_roll_no,issue_date,due_date,class,author_name,status,book_title,student_name,session_value,$update_by_insert_sql_column) values ('$book_id_no','$student_roll_no','$issue_date','$return_date','$student_class','$student_class_section','$status','$book_title','$student_name','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$query);
echo $query1="update school_library_book set no_of_copy='$copy_left',$update_by_update_sql  where book_id_no='$book_id_no'";
if(mysqli_query($conn73,$query1)){
echo "|?|success|?|";
}
?>