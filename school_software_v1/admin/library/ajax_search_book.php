<?php 
include("../../con73/con37.php");
 $class=$_GET['class']; 
 $query="select * from school_library_book where class='$class'";
$result=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($result)){
   $book_title=$row['book_title']; 

?>
 <option value="<?php echo $book_title; ?>"><?php echo $book_title; ?></option>
<?php } ?>