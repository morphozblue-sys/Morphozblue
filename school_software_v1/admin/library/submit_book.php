<?php
include("../../con73/con37.php");
 $id=$_GET['id'];
 $id2=$_GET['id2'];
 $id3=$_GET['id3'];
  $sql="select * from school_library_book where book_id_no='$id'";
  $ex=mysqli_query($conn73,$sql);
 while($row=mysqli_fetch_assoc($ex)){
    $no_of_copy=$row['no_of_copy'];
	
	
	 $no_of_copy1=$no_of_copy+1;
  $query="update school_library_book set no_of_copy=$no_of_copy1,$update_by_update_sql  where book_id_no='$id'";
 mysqli_query($conn73,$query);
 
 
   $query1="update issue_book set status='Deactive',penality='$id3',$update_by_update_sql  where book_id_no='$id' && student_roll_no='$id2'";
 mysqli_query($conn73,$query1);

echo "<script>window.open('return_book_penality.php','_self')</script>";
}