<?php 
 include("../attachment/session.php");

 $student=$_POST['student_roll_no'];
 $book_id_no=$_POST['book_id_no'];
 $date_of_return=$_POST['date_of_return'];
 $date_of_return1=$_POST['date_of_return1'];
 $penalty=$_POST['penalty'];
 $remark=$_POST['remark'];
 
   $query22="select * from school_library_book where book_id_no='$book_id_no'";
    $run22=mysqli_query($conn73,$query22);
    while($row22=mysqli_fetch_assoc($run22)){
    $no_of_copy=$row22['no_of_copy']; 
	}
  $no_of_copy1=$no_of_copy+1; 
  
$query="update issue_book set penalty='$penalty',return_date='$date_of_return',remark='$remark',status='Deactive',$update_by_update_sql  where student_roll_no='$student' and book_id_no='$book_id_no'";
 mysqli_query($conn73,$query);
  
  {
$query2="update school_library_book set no_of_copy=$no_of_copy1,$update_by_update_sql  where book_id_no='$book_id_no'";
 mysqli_query($conn73,$query2);
   
   echo "|?|success|?|";
   }

?>