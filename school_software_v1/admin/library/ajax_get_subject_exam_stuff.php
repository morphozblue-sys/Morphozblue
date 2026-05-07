<option value="" >Select Subject</option>
<?php
                    $class=$_GET['value'];
					include("../../con73/con37.php");
                    $query="select * from library_exam_stuff where exam_stuff_class='$class' Group By exam_stuff_subject";
                    $res=mysqli_query($conn73,$query);
                    while($row=mysqli_fetch_assoc($res)){
					$exam_stuff_subject=$row['exam_stuff_subject'];

?>
					<option value="<?php echo $exam_stuff_subject; ?>"><?php echo $exam_stuff_subject; ?></option>
					
<?php } ?>