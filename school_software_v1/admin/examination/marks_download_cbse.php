<?php include("../attachment/session.php");

?>

<script>
function for_list(){
var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var exam_type= document.getElementById('exam_type').value;
			var exam_term= document.getElementById('exam_term').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var subject_type= document.getElementById('subject_type').value;
			var sheet_type= document.getElementById('sheet_type').value;
			if(student_class!='' && exam_term!=''){
			if(sheet_type!='all'){
			 $('#marks_download').html(loader_div);
             $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_marks_download_cbse.php?id="+student_class+"&student_section="+student_class_section+"&student_exam_type="+exam_type+"&exam_term="+exam_term+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&subject_type="+subject_type+"",
              cache: false,
              success: function(detail){
              $('#marks_download').html(detail);

              }
           });
			}else{
			 $('#marks_download').html(loader_div);
             $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_marks_download_cbse_termwise.php?id="+student_class+"&student_section="+student_class_section+"&exam_term="+exam_term+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&subject_type="+subject_type+"",
              cache: false,
              success: function(detail){
              $('#marks_download').html(detail);

              }
           });   
			    
			}
            }

}

	   function for_exam(){
	       $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_get_exam_type_cbse.php?class_name="+student_class+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#exam_type").html(str);

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
   function get_group(value1){
$('#student_class_group').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });
for_list();
    }
</script>
  <script type="text/javascript">
   function for_section(value){
       $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_exam();
				  for_list();
              }
           });

    }

</script>
<script>
function exam_sheet(value){
if(value=='exam_wise'){
$('#for_exam_wise').show();
}else{
$('#for_exam_wise').hide();
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
	   <li class="active"><?php echo $language['Marksheet View']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Exam Mark List']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			    <div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
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
					  <label >Stream<font style="color:red"><b>*</b></font></label>
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
					  <label >Group<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange='for_list();' >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				
				<div class="col-md-3">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
    				    <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();' required>
    				     <option value="">All</option>
    				    </select>
					</div>
                </div>
                
                <div class="col-md-3 ">				
                    <div class="form-group" >
                        <label >Sheet Type</label>
                            <select class="form-control" name="sheet_type" id="sheet_type" onchange='for_list(),exam_sheet(this.value);' required>
                            <option value="">Select</option>
                            <option value="all">Final Sheet</option>
                            <option value="exam_wise">Exam Wise Sheet</option>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-3" id="for_exam_wise"; style="display:none";>				
                    <div class="form-group" >
                     <label ><?php echo $language['Exam Type']; ?></label>
                        <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();' >
                            <option value="">Select Exam Type</option>
                        </select>
                    </div>
                </div>
				
                <div class="col-md-3" >				
                    <div class="form-group" >
                     <label >Exam Term</label>
                        <select class="form-control" name="exam_term" id="exam_term" onchange='for_list();' >
                            <option value="">Select Exam Term</option>
                            <option value="term1">Term1</option>
                            <option value="term2">Term2</option>
                        </select>
                    </div>
                </div>
				
    			<div class="col-md-3">
    				  <div class="form-group">
    				    <label><?php echo $language['Subject Type']; ?></label>
    					<select  class="form-control" id="subject_type" onchange='for_list();' >
    					<option value="All">All</option>
    					<option value="subject">Main Subject</option>
    					<option value="practical">Practical Subject</option>
    					<option value="other_subject">Other Subject</option>
    					</select>				
    				  </div>
    			</div>

		
	      </div>
		  <div class="box-body " id="marks_download" >

          </div>
          </div>
    </div>
</section>

   