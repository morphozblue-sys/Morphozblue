<?php include("../attachment/session.php"); ?>

<script>
function valid(s_no){
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);
}
else  {
return false;
}
}

function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"examination/weekly_test_delete.php?s_no="+s_no+"",
cache: false,
success: function(detail){
var res=detail.split("|?|");
if(res[1]=='success'){
alert_new('Successfully Deleted','green');
get_content('examination/view_weekly_test');
}else if(res[1]=='session_not_set'){
alert_new('Session Expire !!!','red');
}else{
//alert_new(detail); 
}
}
});
}
</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('examination/examination')"><i class="fa fa-id-card-o"></i> <?php echo $language['Examination']; ?></a></li>
	   <li class="active">View Weekly Test</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">View Weekly Test</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
 
            <div class="box-body">
			
				<div class="col-xs-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S No</th>
				  <th>Test Name</th>
				  <th>Date</th>
				  <th>Class (Sec)</th>
				  <th>Stream (Group)</th>
				  <th>Test Description</th>
				  <th>Update By</th>
                  <th>Date</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
				
<tbody>

<?php
$query="select * from weekly_test_info where test_status='Active' and session_value='$session1' order by s_no DESC";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];
$test_name=$row['test_name'];
$from_date=date('d-m-Y',strtotime($row['from_date']));
$to_date=date('d-m-Y',strtotime($row['to_date']));
$student_class=$row['student_class'];
$student_class_stream = $row['student_class_stream'];
$student_class_group=$row['student_class_group'];
$student_class_section=$row['student_class_section'];
$test_description=$row['test_description'];
$update_change=$row['update_change'];
$last_updated_date=date('d-m-Y h:i:s',strtotime($row['last_updated_date']));
$serial_no++;
?>

<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $test_name; ?></td>
<td><?php echo $from_date.'-'.$to_date; ?></td>
<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
<td><?php echo $student_class_stream.' ('.$student_class_group.')'; ?></td>
<td><?php echo $test_description; ?></td>
<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
<td><button type="button"  class="btn btn-primary" onclick="post_content('examination/view_weekly_test_detailed','s_no=<?php echo $s_no; ?>');" >Edit</button></td>
<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
</tr>
<?php
}  
?>
</tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
			
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
       <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>

  