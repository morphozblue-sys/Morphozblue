<?php 
include("../../con73/con37.php");
 $book_id=$_GET['book_id']; 
 $query="select * from school_library_book where book_id_no='$book_id'";
$result=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($result)){
    $book_title=$row['book_title'];
	$subject_name=$row['subject_name'];
	$author_name=$row['author_name'];
	$class=$row['class'];
 }
echo $book_title.'|?|'.$author_name.'|?|'.$class;
 ?>