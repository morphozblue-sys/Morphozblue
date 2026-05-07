<?php include("../attachment/session.php")?>
<?php 

$student_admission_no=$_GET['number'];
$student_roll_no=$_GET['roll'];

	$que="select * from student_admission_info where student_admission_number='$student_admission_no' and  student_roll_no!='$student_roll_no' and session_value='$session1'";
    $run=mysqli_query($conn73,$que) or mysqli_error($conn73);
    $i=mysqli_num_rows($run);
    if(false)
    {
        echo 'Yes';
    }
    else
    {
        echo 'no';
    }
    
        
?>        