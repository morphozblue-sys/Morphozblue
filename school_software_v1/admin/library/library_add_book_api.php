<?php include("../attachment/session.php");
  $book_id_no=$_POST['book_id_no'];
  $book_title=$_POST['book_title'];
  $author=$_POST['author'];
  $student_class=$_POST['student_class'];
  $subject=$_POST['subject'];
  $publish_date=$_POST['publish_date'];
  $publish_name=$_POST['publish_name'];
  $no_of_copy=$_POST['no_of_copy']; 
  $Vendor_name=$_POST['Vendor_name']; 
  $book_cost=$_POST['book_cost'];
  
  $book_code_number=$_POST['book_code_number'];
  $entry_date=$_POST['entry_date'];
  $division_name=$_POST['division_name'];
  $language=$_POST['language'];
  $book_type=$_POST['book_type'];
  $other_information=$_POST['other_information'];
  
  $sql="select * from school_library_book where school_library_book_status='Active' and book_id_no='$book_id_no'";
$ex=mysqli_query($conn73,$sql);

  
	 if(mysqli_num_rows($ex)<1){
 
  echo $query="insert into school_library_book(book_id_no,book_title,author_name,vendor_name,class,publish_date,publish_name,no_of_copy,price,subject_name,session_value,book_code_number,entry_date,division_name,language,book_type,other_information,$update_by_insert_sql_column) values ('$book_id_no','$book_title','$author','$Vendor_name','$student_class','$publish_date','$publish_name','$no_of_copy','$book_cost','$subject','$session1','$book_code_number','$entry_date','$division_name','$language','$book_type','$other_information',$update_by_insert_sql_value)";

	
if(mysqli_query($conn73,$query)){
echo "|?|success|?|view|?|";

}
}else{
	echo "|?|success|?|alert|?|";

}



	?>
