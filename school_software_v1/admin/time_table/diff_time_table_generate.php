<?php include("../attachment/session.php"); ?>

</head>

<script type="text/javascript">
function for_section(class_name){
$('#student_section').html("<option value='' >Loading....</option>");
$.ajax({
type: "POST",
url: access_link+"time_table/ajax_class_section.php?class_name="+class_name+"",
cache: false,
success: function(detail){
$("#student_section").html(detail);
for_stream(class_name);
get_period();
  }
});

}
function get_period(){

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
$('#period_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"time_table/diff_ajax_get_period.php?class="+class_name+"&section="+class_section+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
cache: false,
success: function(detail){
$("#period_list").html(detail);
  }
});
}else{
$("#period_list").html('');
}
$('#class_code_hidden').val(class_name);
}
function fill_subject_name(row_num){

var subject_name=document.getElementById('subject_name_monday_'+row_num).value;

$('#subject_name_tuesday_'+row_num).prepend( '<option value="'+subject_name+'" selected>'+subject_name+'</option>');
$('#subject_name_wednesday_'+row_num).prepend( '<option value="'+subject_name+'" selected>'+subject_name+'</option>');
$('#subject_name_thursday_'+row_num).prepend( '<option value="'+subject_name+'" selected>'+subject_name+'</option>');
$('#subject_name_friday_'+row_num).prepend( '<option value="'+subject_name+'" selected>'+subject_name+'</option>');
$('#subject_name_saturday_'+row_num).prepend( '<option value="'+subject_name+'" selected>'+subject_name+'</option>');


}
function fill_teacher_name(row_num){

var teacher_name=document.getElementById('teacher_name_monday_'+row_num).value;

$('#teacher_name_tuesday_'+row_num).prepend( '<option value="'+teacher_name+'" selected>'+teacher_name+'</option>');
$('#teacher_name_wednesday_'+row_num).prepend( '<option value="'+teacher_name+'" selected>'+teacher_name+'</option>');
$('#teacher_name_thursday_'+row_num).prepend( '<option value="'+teacher_name+'" selected>'+teacher_name+'</option>');
$('#teacher_name_friday_'+row_num).prepend( '<option value="'+teacher_name+'" selected>'+teacher_name+'</option>');
$('#teacher_name_saturday_'+row_num).prepend( '<option value="'+teacher_name+'" selected>'+teacher_name+'</option>');


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
              success: function($detail1){
                   var str1 =$detail1;                
        
                  $("#student_class_group").html(str1);
              }
           });
    }

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"time_table/diff_time_table_generate_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('time_table/time_table_list');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Time Table Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-clock-o"></i> <?php echo $language['Time Table']; ?></a></li>
	  <li class="active"><?php echo $language['Time Table Generate']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Time Table Generate'] ; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >

			<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
			
		
				 <div class="col-md-3 ">	
				<div class="form-group">
				<label><?php echo $language['Class'] ; ?></label>
				<select name="student_class1" id="student_class"  class="form-control" onchange="for_section(this.value);get_period();" required>
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
			    <div class="col-md-3" id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label >Stream</label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);get_period();" >
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
			    <div class="col-md-3" id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label >Group</label>
					      <select class="form-control" name="student_class_group" id="student_class_group" onchange="get_period();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
			<div class="col-md-3">	
			  <div class="form-group">
				<label><?php echo $language['Section'] ; ?></label>
				<select name="student_section" id="student_section" class="form-control" onchange="get_period();"  required>
					<option value="">Select</option>
				</select>
			  </div>
			</div>
				
				
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th></th>
                  <th></th>
				  <th></th>
				  <th colspan="2"><center><?php echo $language['Monday'] ; ?></center></th>
				  <th colspan="2"><center><?php echo $language['Tuesday'] ; ?></center></th>
				  <th colspan="2"><center><?php echo $language['Wednesday'] ; ?></center></th>
				  <th colspan="2"><center><?php echo $language['Thursday'] ; ?></center></th>
				  <th colspan="2"><center><?php echo $language['Friday'] ; ?></center></th>
				  <th colspan="2"><center><?php echo $language['Saturday'] ; ?></center></th>
				  
				  <th></th>
				  <th></th>
				  
                  </tr>
				 <tr>
                 <th><center><?php echo $language['Period Name'] ; ?></center></th>
                 <th><center><?php echo $language['Time From'] ; ?></center></th>
                 <th><center><?php echo $language['Time To'] ; ?></center></th>
                 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
				 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
				 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
				 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
				 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
				 <th><center><?php echo $language['Subject Name'] ; ?></center></th>
                 <th><center><?php echo $language['Teacher Name'] ; ?></center></th>
                 
                 <th>Update By</th>
                 <th>Date</th>
                 
                </tr>
                </thead>
				<tbody id="period_list">

				
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
				
		 <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

