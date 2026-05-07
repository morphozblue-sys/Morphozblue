<?php include("../attachment/session.php")?>  
<option value=''>Select Section</option>				
<?php
$class_name = $_GET['class_name'];
$section=$_SESSION[$class_name.'_section37'];
$section23=explode('_',$section);
$total_section=count($section23);
for($q=0;$q<$total_section;$q++){
?>
<option value="<?php echo $section23[$q]; ?>"><?php echo $section23[$q]; ?></option>
<?php } ?>