<?php include("../attachment/session.php")?>
<?php
$image_type=$_GET['image_type'];
$student_roll_no=$_GET['student_roll_no'];
$database_name1=$_SESSION['database_name'];
$database_blob1=$database_name1."_blob";
$que1="select * from $database_name1.student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){
$image=$row1[$image_type."_name"];

		}
?>


<script>
$('#myModal').modal('hide'); 
$('#myModal').modal('show'); 
</script>



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" width="150%" style="margin-right:400px;">
    
      <!-- Modal content-->
      <div class="modal-content" >
	   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
 <img  src="<?php if($image!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>"   width="50%" height="50%" style="margin-top:10px;">
					
        </div>
        <div class="modal-footer">
         <?php if($image!=''){ ?> <a href="<?php echo $_SESSION['amazon_file_path']."student_documents/".$image;  ?>" download><button type="button" class="btn btn-success" >Download</button></a><?php } ?>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
