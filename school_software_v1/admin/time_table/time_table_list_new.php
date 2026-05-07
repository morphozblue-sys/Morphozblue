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

var class_name=document.getElementById('student_class').value;
var class_section=document.getElementById('student_section').value;
var student_class_group=document.getElementById('student_class_group').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var t=0;
if(class_name=='class14' || class_name=='class15'){
if(student_class_group!='' && student_class_stream!=''){
t=1;
}
}else{
t=1;
}
if(class_name!='' && class_section!='' && t==1){
$('#time_table_list1').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_time_table_list_new.php?class="+class_name+"&section="+class_section+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
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
				<select name="student_class1" id="student_class"  class="form-control" onchange="for_section(this.value);get_time_table();" required>
					<option value="">Select</option>
					<?php
				    $que="select * from school_info_class_info";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					while($row=mysqli_fetch_assoc($run)){
					$class_name=$row['class_name'];
					$class_code=$row['class_code'];
					?>
					<option value="<?php echo $class_code; ?>"><?php echo $class_name; ?></option>
					<?php
					}
					?>
				</select>
				<input type="hidden" id="class_code_hidden" name="class_code_hidden" />
			  </div>
			  	</div>
									<div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label >Stream</label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);get_time_table();" >
					           <option  value="">Select Stream</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
                               $stream_code=$row['stream_code'];
if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_code; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
				</div>
								<div class="col-md-3 " id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label >Group</label>
					      <select class="form-control" name="student_class_group" id="student_class_group" onchange="get_time_table();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
			   <div class="col-md-3 ">	
			  <div class="form-group">
				<label><?php echo $language['Section'] ; ?></label>
				<select name="student_section" id="student_section" class="form-control" onchange="get_time_table();"  required>
					<option value="">Select</option>
				</select>
			  </div>
					</div>
		<div class="col-md-12">
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th><?php echo $language['S No']; ?></th>
        <th><?php echo $language['Class']; ?></th>
		<th><?php echo $language['Section']; ?></th>
		
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
