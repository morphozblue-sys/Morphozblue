<?php include("../attachment/session.php");
 include("../attachment/image_compression_upload.php");
  
  //$id = $_POST['s_no'];
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

 $query="update school_library_book set book_id_no='$book_id_no',book_title='$book_title',author_name='$author',vendor_name='$Vendor_name',class='$student_class',publish_date='$publish_date',publish_name='$publish_name',no_of_copy='$no_of_copy',price ='$book_cost',subject_name='$subject',book_code_number='$book_code_number',entry_date='$entry_date',division_name='$division_name',language='$language',book_type='$book_type',other_information='$other_information',$update_by_update_sql  where book_id_no='$book_id_no'";
if(mysqli_query($conn73,$query))
{
echo "|?|success|?|";
}
?>