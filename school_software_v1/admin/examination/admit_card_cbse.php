<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
      function for_list(){ 

			var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var exam_type= document.getElementById('exam_type').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var exam_term= document.getElementById('exam_term').value;
			if(student_class!='' && exam_type!=''){
			 $('#example2').html(loader_div);
             $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_admit_card_list_cbse.php?class="+student_class+"&student_section="+student_class_section+"&student_exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&exam_term="+exam_term+"",
              cache: false,
              success: function(detail){

              $('#example2').html(detail);
			  
			//$("#click").click();
              }
           });
            }
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
for_list();
    }

 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"examination/admit_card_cbse_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('examination/admit_card_print_cbse');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
       <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('examination/examination')"><i class="fa fa-id-card-o"></i> <?php echo $language['Examination']; ?></a></li>
	   <li class="active"><?php echo $language['Admit Card Generate']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Admit Card Generate']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
			<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
			
			  <div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="admit_card_student_class" onchange="for_stream(this.value);for_section(this.value);" id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						       <?php 
							   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					</div>
				</div>
				
	    <div class="col-md-3" id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_list();" >
					           <option value="">Select Stream</option>
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
					  <label ><?php echo $language['Group']; ?></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_list();" >
					    <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="admit_card_student_section" id="student_class_section" onchange='for_list();'>
					     <option value="">All</option>
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
			  <div class="col-md-3 ">				
			  <div class="form-group" >
				 <label ><?php echo $language['Exam Type']; ?></label>
				 <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();' required>
				 <option value="">Select Exam Type</option>     
				 </select>
				 </div>
				</div>
				
				
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Subject Name']; ?></th>
                  <th><?php echo $language['Date']; ?></th>
                  <th><?php echo $language['Exam Time From']; ?></th>
				  <th><?php echo $language['Exam Time To']; ?></th>
				  <th>Sitting</th>
				  <th><?php echo $language['Show on Admit Card']; ?></th>
				  
				  <th>Update By</th>
                  <th>Date</th>
				  
                </tr>
                </thead>
				
				<tbody id="example2">
				
		        </tbody>
				
                </table>
                </div>
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
<script>
$(function () {
$('#example1').DataTable()
})
</script>