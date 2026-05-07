<?php include("../attachment/session.php");?> 
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_penalty(s_no);       
 }            
else  {      
return false;
 }       
  } 
function delete_penalty(s_no){
$.ajax({
type: "POST",
url: access_link+"penalty/penalty_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
		if(res[1]=='success'){
		 alert_new('Successfully Deleted'.'green');
		 get_content('penalty/penalty_list');
	  }else{
        //  alert_new(detail); 
   }
}
});
}
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Student Action']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="javascript:get_content('penalty/penalty')"><i class="fa fa-exclamation-circle"></i> <?php echo $language['Penalty Management']; ?></a></li>
        <li class="active"><?php echo $language['Penalty List']; ?></li>
      </ol>
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Penalty List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Student Roll No']; ?></th>
                  <th><?php echo $language['Class']; ?></th>
                  <th><?php echo $language['Student Section']; ?></th>
                  <th><?php echo $language['Penalty']; ?></th>
                  <th><?php echo $language['Penalty Reason']; ?></th>
                  <th><?php echo $language['Penalty Remark']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
				$query="select * from student_penality";
				$run=mysqli_query($conn73,$query);
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $s_no=$row['s_no'];
				      $student_roll_no=$row['student_roll_no'];
				      $student_name=$row['student_name'];
				      $student_class=$row['student_class'];
				      $student_class_section=$row['student_class_section'];
				      $penalty=$row['penalty'];
				      $penalty_reason=$row['penalty_reason'];
				      $penalty_remark=$row['penalty_remark'];
				      
                      $update_change=$row['update_change'];
                      if($row['last_updated_date']!='0000-00-00'){
                      $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                      }else{
                      $last_updated_date=$row['last_updated_date'];
                      }
				      
					  $serial_no++;
					  ?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_roll_no; ?></td>
                  <td><?php echo $student_class; ?></td>
                  <td><?php echo $student_class_section; ?></td>
                  <td><?php echo $penalty; ?></td>
                  <td><?php echo $penalty_reason; ?></td>
                  <td><?php echo $penalty_remark; ?></td>
                  
                  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
                  
            <td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td></td>
                </tr>
<?php } ?>
                </tbody>
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
  