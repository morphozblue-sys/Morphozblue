<?php include("../attachment/session.php"); ?>

<script type="text/javascript">
      function for_list(){ 
			var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var exam_type= document.getElementById('exam_type').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var order_by= document.getElementById('order_by').value;
			var student_limit= document.getElementById('student_limit').value;
			if(student_class_section!='' && student_class!='' && exam_type!=''){
			 $('#example2').html(loader_div);
             $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_fill_marksheet_monthly_examwise.php?id="+student_class+"&student_section="+student_class_section+"&student_exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&order_by="+order_by+"&student_limit="+student_limit+"",
              cache: false,
              success: function(detail){
              $('#example2').html(detail);
              }
           });
            }else{
                $('#example2').html('');
            }
}
</script>
  <script type="text/javascript">
   function for_section(value){
  $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_exam();
				  for_list();
				  
              }
           });

    }
	   function for_exam(){
	       $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_get_exam_type_monthly.php?class_name="+student_class+"",
              cache: false,
              success: function(detail){          
                  $("#exam_type").html(detail);

              }
           });

    }
	function for_stream(value2){
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}

function for_validation(id,value,sub_code){
    var maximum_marks=document.getElementById('student_maximum_marks_'+sub_code).value;
    if(maximum_marks>0){
        var maximum_marks1=maximum_marks;
    }else{
        var maximum_marks1='0';
    }
    if(parseFloat(value)>parseFloat(maximum_marks1)){
        alert_new("Please Fill Marks Less or Equals to Maximum Marks !!!",'red');
        $('#'+id).val('');
        $('#'+id).focus();
    }
}

function valid(){
var num=0;
$(".exam_student_class").each(function() {
num = Number(parseInt(num)+1);
});
if(num<=0){
    alert_new("Student Not On Your Screen !!!",'red');
    return false;
}
}

   function get_group(value1){
$('#student_class_group').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });
for_list();
    }
	$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    $("#loader_div_id").html(loader_div);
        $.ajax({
            url: access_link+"examination/marksheet_fill_monthly_examwise_api.php",
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
				  //get_content('examination/marksheet_fill_monthly_examwise');
				  for_list();
				  $("#loader_div_id").html("");
            }
			}
         });
      });

function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
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
	   <li class="active"> <?php echo $language['Exam Marks Fill']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Exam Marks Fill']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
		
			<form role="form" id="my_form" method="post" enctype="multipart/form-data">
			
			    <div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select name="student_class" onchange="for_section(this.value);for_stream(this.value);" id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						        <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
					<div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);" >
					           <option  value="">Select Stream</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
		</div>
		<div class="col-md-3" id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Group']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_list();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();' required>
					     <option value="">Select Section</option>
					    </select>
					</div>
				</div>
	

			  <div class="col-md-3 ">				
			  <div class="form-group" >
				 <label ><?php echo $language['Exam Type']; ?></label>
				 <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();' required>
				               <option value="">Select Exam Type</option>
					          
				 </select>
				 </div>
				</div>
				
				<div class="col-md-3 ">				
			     <div class="form-group" >
				 <label>Order By</label>
				 <select class="form-control" name="order_by" id="order_by" onchange="for_list();" >
				    <option value="">Select</option>
				    <option value=" ORDER BY student_name ASC">Student Name</option>
				    <option value=" ORDER BY student_father_name ASC">Father Name</option>
				    <option value=" ORDER BY CAST(school_roll_no AS SIGNED) ASC">Roll No</option>
				 </select>
				 </div>
				 </div>
				 
				 <div class="col-md-3 ">				
			     <div class="form-group" >
				 <label>Limit</label>
				 <select class="form-control" name="student_limit" id="student_limit" onchange="for_list();" >
				    <option value=" LIMIT 0, 30">0-30</option>
				    <option value=" LIMIT 30, 30">30-60</option>
				    <option value=" LIMIT 60, 30">60-90</option>
				    <option value=" LIMIT 90, 30">90-120</option>
				    <option value=" LIMIT 120, 30">120-150</option>
				    <option value=" LIMIT 150, 30">150-180</option>
				    <option value=" LIMIT 180, 30">180-210</option>
				    <option value=" LIMIT 210, 30">210-240</option>
				    <option value=" LIMIT 240, 30">240-270</option>
				    <option value=" LIMIT 270, 30">270-300</option>
				 </select>
				 </div>
				 </div>
				
				<div class="col-md-12">
				       <div  id="loader_div_id">
                </div>
                </div>
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="example2">
                
				
		        
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" onclick="return valid();" class="btn  btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
