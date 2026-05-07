<?php
include("../../con73/con37.php");
$term = mysqli_real_escape_string($conn73,$_REQUEST['term']);
$term2 = mysqli_real_escape_string($conn73,$_REQUEST['term2']);
 
if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT student_roll_no FROM student_admission_info WHERE student_roll_no LIKE '%" . $term . "%' and student_class='".$term2."'";
    if($result = mysqli_query($conn73,$sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<p>" . $row['student_roll_no'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn73);
    }
}
 
?>