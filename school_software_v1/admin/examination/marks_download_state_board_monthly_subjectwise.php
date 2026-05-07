<?php include("../attachment/session.php");

?>

<script>
function for_list(){

            var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
            
            var selected_exam=[];
            $(".sel_exam1").each(function() {
            if($(this).prop("checked") == true){
            selected_exam.push($(this).val());
            }
            });
            
            var selected_subject=[];
            $(".sel_subject1").each(function() {
            if($(this).prop("checked") == true){
            selected_subject.push($(this).val());
            }
            });
            
			if(student_class_section!='' && student_class!='' && selected_exam!='' && selected_subject!=''){
			 $('#marks_download').html(loader_div);
             $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_marks_download_state_board_monthly_subjectwise.php",
              data: { student_class:student_class,student_class_section:student_class_section,student_class_stream:student_class_stream,student_class_group:student_class_group,selected_exam:selected_exam,selected_subject:selected_subject },
              cache: false,
              success: function(detail){
              $('#marks_download').html(detail);
              }
          });
            }else{
            $('#marks_download').html('');
            }

}

	   function for_exam(){
         	var student_class= document.getElementById('student_class').value;
       if(student_class!=''){
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_get_exam_type_monthly_subjectwise.php?class_name="+student_class+"",
              cache: false,
              success: function(detail){
                  $("#exam_detail").html(detail);
              }
           });
       }else{
           $("#exam_detail").html('');
       }
    }
    
    function for_subject(){
         var student_class= document.getElementById('student_class').value;
         var student_class_stream= document.getElementById('student_class_stream').value;
		 var student_class_group= document.getElementById('student_class_group').value;
      if(student_class!=''){
      $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_get_subject_monthly_subjectwise.php?class_name="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
              cache: false,
              success: function(detail){
                  $("#subject_detail").html(detail);
              }
          });
      }else{
          $("#subject_detail").html('');
      }
      for_list();
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
                  for_subject();
              }
           });
//for_list();
    }
    
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
for_list();
}
</script>
  <script type="text/javascript">
   function for_section(value){
       $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_exam();
				  for_subject();
				  //for_list();
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
              <h3 class="box-title">Exam Marks List</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
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
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange='for_subject();' >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();' required>
					     <option value="">Select Section</option>
					    </select>
					</div>
</div>
        
        <div class="col-md-8"><h4>Select Exam Type</h4></div>
        <div class="col-md-4"><span style="float:right;"><input type="checkbox" value="" id="sel_exam1" onclick="for_check(this.id);" /><b style="color:red;">Check All</b></span></div>
        <div class="col-md-12" id="exam_detail"></div>
        
        <div class="col-md-8"><h4>Select Subject</h4></div>
        <div class="col-md-4"><span style="float:right;"><input type="checkbox" value="" id="sel_subject1" onclick="for_check(this.id);" /><b style="color:red;">Check All</b></span></div>
        <div class="col-md-12" id="subject_detail"></div>

		
	      </div>
		  <div class="box-body " id="marks_download" >

          </div>
          </div>
    </div>
</section>

   