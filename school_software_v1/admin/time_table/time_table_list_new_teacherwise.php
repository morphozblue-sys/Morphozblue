<?php include("../attachment/session.php")?>
<script>
function for_section(class_name){
$('#student_section').html("<option value='' >Loading....</option>");
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_class_section.php?class_name="+class_name+"",
cache: false,
success: function(detail){
$("#student_section").html(detail);
for_stream(class_name);
get_time_table();
  }
});
}

function get_time_table(){

var emp_name=document.getElementById('emp_name1').value;
if(emp_name!=''){
$('#time_table_list1').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_time_table_list_new_teacherwise.php?emp_name="+emp_name+"",
cache: false,
success: function(detail){
$("#time_table_list1").html(detail);
  }
});
}else{
$("#time_table_list1").html('');
}
}
function for_stream(value2){
		   if(value2=="class14" || value2=="class15"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_group_subject_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_group_subject_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}

function get_group(value1){
        $('#student_class_group').html("<option value='' >Loading....</option>");
        $.ajax({
        type: "POST",
        url: access_link+"time_table/ajax_stream_group.php?stream_name="+value1+"",
        cache: false,
        success: function(detail1){
        //alert_new(detail1);
        $("#student_class_group").html(detail1);
        }
        });
    }

</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Time Table Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-clock-o"></i> <?php echo $language['Time Table']; ?></a></li>
	  <li class="active"><?php echo $language['Time Table List']; ?></li>
      </ol>
    </section>
	
	
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Time Table List']; ?></h3>
            </div>
			      <div class="box-body "  >
				 <div class="col-md-3 ">	
				<div class="form-group">
				<label><?php echo $language['Class'] ; ?></label>
				<select name="emp_name1" id="emp_name1" class="form-control select2" onchange="get_time_table();" style="width:100%" required>
					<option value="">Select</option>
					<?php
                    $qry="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
                    $rest=mysqli_query($conn73,$qry);
                    while($row22=mysqli_fetch_assoc($rest)){
                    $emp_id=$row22['emp_id'];
                    $emp_name=$row22['emp_name'];
					?>
					<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
					<?php
					}
					?>
				</select>
			  </div>
			  	</div>
		<div class="col-md-12">
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th><?php echo $language['S No']; ?></th>
        <th>Teacher Name</th>
		
		<th>Update By</th>
        <th>Date</th>
		
		<th><?php echo $language['Print']; ?></th>
        </tr>
        </thead>
		<tbody id="time_table_list1">
        </tbody>
             </table>
            </div>
       	</div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
<script>
$(function () {
$('#example2').DataTable()
})
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
