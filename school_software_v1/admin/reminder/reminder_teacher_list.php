<?php include("../attachment/session.php"); ?> 
			<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_reminder(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_reminder(s_no){
$.ajax({
type: "POST",
url: access_link+"reminder/reminder_teacher_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('reminder/reminder_teacher_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>		

    <section class="content-header">
      <h1>
        <?php echo $language['Reminder Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="javascript:get_content('reminder/reminder')"><i class="fa fa-history"></i> <?php echo $language['Reminder']; ?></a></li>
	   <li><a><i class="fa fa-list"></i><?php echo $language['Teacher Reminder List']; ?></a></li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Teacher Reminder List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
	              <th><?php echo $language['S No']; ?></th>
				  <th><?php echo $language['Teacher Name']; ?></th>
				  <th><?php echo $language['Class']; ?></th>
				  <th><?php echo $language['Section']; ?></th>
				  <th><?php echo $language['Subject']; ?></th>
                  <th><?php echo $language['Allocated Date']; ?></th>
                  <th><?php echo $language['Finish Date']; ?></th>
		          <th><?php echo $language['Reminder Task 1']; ?></th>
				  <th><?php echo $language['Reminder Task 2']; ?></th>
				  <th><?php echo $language['Reminder Task 3']; ?></th>
				  <th><?php echo $language['Reminder Task 4']; ?></th>
				  <th><?php echo $language['Reminder Task 5']; ?></th>
		          <th><?php echo $language['Remark']; ?></th>
		          <th><?php echo $language['Edit']; ?></th>
		          <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
                
             <?php
$que="select * from teacher_reminder where session_value='$session1'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	
	$reminder_teacher_name = $row['reminder_teacher_name'];
	$reminder_allocated_date = $row['reminder_allocated_date'];
	$reminder_finish_date = $row['reminder_finish_date'];
	$reminder_teacher_task_1 = $row['reminder_teacher_task_1'];
	$reminder_teacher_task_2 = $row['reminder_teacher_task_2'];
	$reminder_teacher_task_3 = $row['reminder_teacher_task_3'];
	$reminder_teacher_task_4 = $row['reminder_teacher_task_4'];
	$reminder_teacher_task_5 = $row['reminder_teacher_task_5'];
	$reminder_teacher_remark = $row['reminder_teacher_remark'];
	$reminder_student_class = $row['reminder_student_class'];
	$reminder_student_class_section = $row['reminder_student_class_section'];
	$reminder_subject_name = $row['reminder_subject_name'];

	$serial_no++;
	
?>

<tr  align='center' >


	<td ><?php echo $serial_no; ?></td>
	<td ><?php echo $reminder_teacher_name; ?></td>
	<td ><?php echo $reminder_student_class; ?></td>
	<td ><?php echo $reminder_student_class_section; ?></td>
	<td ><?php echo $reminder_subject_name; ?></td>
	<td  ><?php echo $reminder_allocated_date; ?></td>
	<td  ><?php echo $reminder_finish_date; ?></td>
	<td  ><?php echo $reminder_teacher_task_1; ?></td>
	<td  ><?php echo $reminder_teacher_task_2; ?></td>
	<td  ><?php echo $reminder_teacher_task_3; ?></td>
	<td  ><?php echo $reminder_teacher_task_4; ?></td>
	<td  ><?php echo $reminder_teacher_task_5; ?></td>
	<td  ><?php echo $reminder_teacher_remark; ?></td>
	
	<td><button type="button"  onclick="post_content('reminder/reminder_teacher_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button></td><td>
	<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>

	</tr>
	
	<?php } ?>
				
             </table>
             </div>
             <!-- /.box-body -->
             </div>
             <!-- /.box -->
             </div>
             <!-- /.col -->
             </div>
             <!-- /.row -->
             </section>
                 <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>