<?php include("../attachment/session.php"); ?>
<script>

function valid1(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/student_admission_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_student_admission_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
function valid(s_no){   
var myval=confirm("Are you sure want to restore this record !!!!");
if(myval==true){
restore_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function restore_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_student_admission_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Restore','green');
				   get_content('recycle_bin/recycle_student_admission_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>		
</script>
 <section class="content-header">
      <h1>
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
  	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fal fa-trash-alt"></i> Recycle Bin</a></li>
        <li class="active">Student Admission List Recycle Bin</li>
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
              <h3 class="box-title">Admission List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
				  <th>Student Name</th>
				  <th>Father Name</th>
				  <th>Student Class</th>
				  <th>Student Section</th>
				  <th>Student Roll No</th>
				  <th>updated by</th>
				  <th>updated date</th>
                  <th style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes' && $_SESSION['recycle_sub_panel_reset_delete_button']!=''){ echo 'display:none'; } ?>">Restore</th>
                  <th style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes' && $_SESSION['recycle_sub_panel_reset_delete_button']!=''){ echo 'display:none'; } ?>">Delete</th>
                </tr>
                </thead>
                <tbody>
                
				<?php				
                $que="select * from student_admission_info where registration_final='yes' and student_status='Deleted' and session_value='$session1'  ORDER BY s_no DESC";
                $run=mysqli_query($conn73,$que);
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_father_name=$row['student_father_name'];
				$student_class=$row['student_class'];
				$student_class_section=$row['student_class_section'];
				$student_date_of_birth=$row['student_date_of_birth'];
				$student_roll_no=$row['student_roll_no'];
				$school_roll_no=$row['school_roll_no'];
				$student_date_of_admission=$row['student_date_of_admission'];
				$updated_change=$row['updated_change'];
				$updated_status=$row['updated_status'];
				$serial_no++;

                ?>

                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class; ?></td>
				  <td><?php echo $student_class_section; ?></td>
				  <td><?php echo $school_roll_no; ?></td>
				  <td><?php echo $updated_change; ?></td>
				  <td><?php echo $updated_status; ?></td>
				  <td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $student_roll_no; ?>');" style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes' && $_SESSION['recycle_sub_panel_reset_delete_button']!='') { echo 'display:none'; } ?>"><?php echo $language['Restore']; ?></button></td>
	              <td><button type="button"  class="btn btn-danger" onclick="return valid1('<?php echo $student_roll_no; ?>');" style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes' && $_SESSION['recycle_sub_panel_reset_delete_button']!='') { echo 'display:none'; } ?>"><?php echo $language['Delete']; ?></button></td>
     
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
$(function(){
$('#example1').DataTable()
})
</script>