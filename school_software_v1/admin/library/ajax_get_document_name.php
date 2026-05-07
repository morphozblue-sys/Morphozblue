<option value="" >Select Document</option>
<?php
                    $class=$_GET['value1'];
                    $subject=$_GET['value'];
					include("../../con73/con37.php");
                    $query="select * from library_exam_stuff where exam_stuff_class='$class' and exam_stuff_subject='$subject' Group By exam_stuff_document_name";
                    $res=mysqli_query($conn73,$query);
                    while($row=mysqli_fetch_assoc($res)){
					$exam_stuff_document_name=$row['exam_stuff_document_name'];

?>
					<option value="<?php echo $exam_stuff_document_name; ?>"><?php echo $exam_stuff_document_name; ?></option>
					
<?php } ?>