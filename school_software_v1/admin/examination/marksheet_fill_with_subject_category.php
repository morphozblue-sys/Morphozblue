<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
      function for_list(){ 
			var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var subject_name= document.getElementById('subject_name').value;
			var exam_type= document.getElementById('exam_type').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var select_month= document.getElementById('select_month').value;
			var order_by= document.getElementById('order_by').value;
			if(student_class_section!='' && student_class!='' && exam_type!='' && subject_name!='' ){
			 $('#example2').html(loader_div);
             $.ajax({
			  type: "POST",
             url:  access_link+"examination/marksheet_fill_with_subject_category_ajax.php?id="+student_class+"&student_section="+student_class_section+"&subject_name="+subject_name+"&student_exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&select_month="+select_month+"&order_by="+order_by,
              cache: false,
              success: function(detail){
              $('#example2').html(detail);
			  var str =detail;
              }
           });
            }
}
			function for_subject(selected){
			       $('#subject_name').html("<option value='' >Loading....</option>");
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var student_class= document.getElementById('student_class').value;
	         var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			$.ajax({
			type: "POST",
			url: access_link+"examination/ajax_get_subject.php?value="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
			cache: false,
			success: function(detail){
			$("#subject_name").html(detail);
			if(selected!=''){
			$('#subject_name').val(selected).change();
			}
			for_list();
			}
			});
			}
</script>
  <script type="text/javascript">
   function for_section(value,selected,selected1){
 $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html("<option value='All'>All</option>"+str);
                  if(selected!=''){
                  $('#student_class_section').val(selected);
                  }
				  for_exam(selected1);
				  for_list();
				  
              }
           });

    }
	   function for_exam(selected){
	        $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_get_exam_type.php?class_name="+student_class+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#exam_type").html(str);
                  $('#exam_type').val(selected);
              }
           });

    }
	function for_stream(value2,selected){
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
if(selected!=''){
$('#student_class_stream').val(selected).change();
}
}

function for_validation(id,value,category){
    var maximum_marks=document.getElementById('student_maximum_marks_'+category).value;
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

   function get_group(value1,selected){
 $('#student_class_group').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
                  if(selected!=''){
                  $('#student_class_group').val(selected).change();
                  }
              }
           });
for_list();
    }

function for_same(value){
	if($('#check_for_same').prop("checked") == true){
		$(".check_for_same").each(function(){
		$(this).val(value);
		});
	}
}

		$(document).ready(function(){
		$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);

			 $('#example2').html(loader_div);
        $.ajax({
            url: access_link+"examination/marksheet_fill_with_subject_category_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|??|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   for_list();
            }
			}
         });
      });
		}); // $(document).ready
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

<?php
if(isset($_GET['student_class'])){
    $student_class=$_GET['student_class'];
    $student_class_stream=$_GET['student_class_stream'];
    $student_class_group=$_GET['student_class_group'];
    $student_class_section=$_GET['student_class_section'];
    $subject_name=$_GET['subject_name'];
    $exam_type=$_GET['exam_type'];
}else{
    $student_class='';
    $student_class_stream='';
    $student_class_group='';
    $student_class_section='';
    $subject_name='';
    $exam_type='';
}
?>
	
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
					    <select name="student_class" onchange="for_section(this.value,'<?php echo $student_class_section; ?>','<?php echo $exam_type; ?>');for_subject('<?php echo $subject_name; ?>');for_stream(this.value,'<?php echo $student_class_stream; ?>');" id="student_class" class="form-control" required>
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
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value,'<?php echo $student_class_group; ?>');for_subject('<?php echo $subject_name; ?>');" >
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
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_subject('<?php echo $subject_name; ?>');" >
					           <option value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();' required>
					     <option value="All">All</option>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3 ">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="subject_name" id="subject_name" onchange='for_list();' required>
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
	

			  <div class="col-md-3 ">				
			  <div class="form-group" >
				 <label ><?php echo $language['Exam Type']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();' required>
				               <option value="">Select Exam Type</option>
					          
				 </select>
				 </div>
				</div>
			
				 
				 <div class="col-md-3 ">				
			     <div class="form-group" >
				 <label>Till Month <small>( For Attendance Calculation )</small></label>
				<select class="form-control" name="select_month" id="select_month" onchange="for_list();" >
				            <option value="">Select</option>
                            <option value="|?|04"><?php echo $language['April']; ?> </option>
                            <option value="|?|04|?|05"><?php echo $language['May']; ?> </option>
                            <option value="|?|04|?|05|?|06"><?php echo $language['June']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07"><?php echo $language['July']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08"><?php echo $language['August']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09"><?php echo $language['September']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10"><?php echo $language['October']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10|?|11"><?php echo $language['November']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10|?|11|?|12"><?php echo $language['December']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10|?|11|?|12|?|01"><?php echo $language['January']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10|?|11|?|12|?|01|?|02"><?php echo $language['February']; ?> </option>
                            <option value="|?|04|?|05|?|06|?|07|?|08|?|09|?|10|?|11|?|12|?|01|?|02|?|03"><?php echo $language['March']; ?> </option>
				 </select>
				 </div>
				 </div>
				 
				 <div class="col-md-3 ">				
			     <div class="form-group" >
				 <label>Order By</label>
				 <select class="form-control" name="order_by" id="order_by" onchange="for_list();" >
				    <option value="">Select</option>
				    <option value="name">Student Name</option>
				    <option value="father">Father Name</option>
				    <option value="roll_no" selected>Roll No</option>
				 </select>
				 </div>
				 </div>
				
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="example2">
             
				
		    
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn  btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<?php if(isset($_GET['student_class'])){ ?>
<script>
$(document).ready(function() {

$('#student_class').val('<?php echo $student_class; ?>').change();

});
</script>
<?php } ?>
<script>
$(function () {
$('#example1').DataTable()
})
</script>
 