<?php include("../attachment/session.php");
	
	$s_no=$_GET['id'];

	$query2="select * from school_info_syllabus_info where s_no='$s_no' and session_value='$session1'";
	$run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
	while($row2=mysqli_fetch_assoc($run2)){
    $class=$row2['class'];
    $section=$row2['section'];
    $subject_name=$row2['subject_name'];
    $syllabus_topic=$row2['syllabus_topic'];
    $syllabus_book_name=$row2['syllabus_book_name'];
    $syllabus_chapter_book_name=$row2['syllabus_chapter_book_name'];
    //$syllabus_insert_date=$row2['syllabus_insert_date'];
    //$syllabus_completion_date=$row2['syllabus_completion_date'];
    $syllabus_subject_teacher=$row2['syllabus_subject_teacher'];
    $syllabus_student_feedback=$row2['syllabus_student_feedback'];
    $syllabus_completion_status=$row2['syllabus_completion_status'];
    $syllabus_remark=$row2['syllabus_remark'];
    $syllabus_estimated_completion_date=$row2['syllabus_estimated_completion_date'];
    $syllabus_actual_completion_date=$row2['syllabus_actual_completion_date'];
	}
?>
<div class="col-md-12">
    <div class="col-md-4"><b>Class : <?php echo $class; ?></b><input type="hidden" name="s_no" value="<?php echo $s_no; ?>" /></div>
    <div class="col-md-4"><b>Section : <?php echo $section; ?></b></div>
    <div class="col-md-4"><b>Subject : <?php echo $subject_name; ?></b></div>
    <div class="col-md-12"><center><span style="color:green;font-size:18px;font-weight:bold;">Subject Teacher : <?php echo $syllabus_subject_teacher; ?></span></center></div>
    <div class="col-md-6">
		<div class="form-group" >
		    <label>Syllabus Topic</label>
		    <input type="text" name="syllabus_topic" value="<?php echo $syllabus_topic; ?>" class="form-control" placeholder="Syllabus Topic" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Book Name</label>
		    <input type="text" name="syllabus_book_name" value="<?php echo $syllabus_book_name; ?>" class="form-control" placeholder="Syllabus Book Name" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Chapter Book Name</label>
		    <input type="text" name="syllabus_chapter_book_name" value="<?php echo $syllabus_chapter_book_name; ?>" class="form-control" placeholder="Syllabus Chapter Book Name" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Student Feedback</label>
		    <input type="text" name="syllabus_student_feedback" value="<?php echo $syllabus_student_feedback; ?>" class="form-control" placeholder="Syllabus Student Feedback" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Syllabus Remark</label>
		    <input type="text" name="syllabus_remark" value="<?php echo $syllabus_remark; ?>" class="form-control" placeholder="Syllabus Remark" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Estimated Completion Date</label>
		    <input type="date" name="syllabus_estimated_completion_date" value="<?php echo $syllabus_estimated_completion_date; ?>" class="form-control" required />
		</div>
    </div>
    
</div>