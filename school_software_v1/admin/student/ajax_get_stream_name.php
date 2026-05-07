<?php include("../attachment/session.php"); ?>
<option value=''>Select</option>
<?php
   $class_name = $_GET['class_name'];
if($class_name!=''){
    
  $stream=$_SESSION['stream_name_array_'.$class_name];
  //print_r($stream);
 $stream23=explode('_',$stream);
 $total_stream=count($stream23);
for($q=0;$q<$total_stream;$q++){
?>
<option value="<?php echo $stream23[$q]; ?>"><?php echo $stream23[$q]; ?></option>
<?php } } ?>