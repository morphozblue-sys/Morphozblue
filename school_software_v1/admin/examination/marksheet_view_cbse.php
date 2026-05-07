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
			if(student_class_section!='' && student_class!='' && exam_type!='' && exam_term!=''){
			 $('#example2').html(loader_div);
             $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_view_marksheet_cbse.php?id="+student_class+"&student_section="+student_class_section+"&student_exam_type="+exam_type+"&exam_term="+exam_term+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
              cache: false,
              success: function(detail){
              $('#example2').html(detail);
			  $('#print_all_button_exam_wise').show();
			  $('#print_all_button').show();
              }
           });
            }
			$('#print_all_button_exam_wise').hide();
			  $('#print_all_button').hide();
}

	   function for_exam(){
	         $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
             url:  access_link+"examination/ajax_get_exam_type_cbse.php?class_name="+student_class+"",
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
             url:  access_link+"examination/ajax_stream_group.php?stream_name="+value1+"",
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
              url: access_link+"examination/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_exam();
				  for_list();
              }
           });

    }
	function print_all(value){
	var marksheet_final_cbse_all_pdf= document.getElementById('marksheet_final_cbse_all_pdf').value;
		var marksheet_exam_wise_cbse_all_pdf= document.getElementById('marksheet_exam_wise_cbse_all_pdf').value;
	  	var pdf_path= document.getElementById('pdf_path').value;
	        var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var exam_type= document.getElementById('exam_type').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var session1= document.getElementById('session1').value;
			var exam_term= document.getElementById('exam_term').value;
			
			if(student_class_section!='' && student_class!='' && exam_type!='' && exam_term!=''){
			
			if(value==1){
			var url2=pdf_path+"marksheet_page/"+marksheet_exam_wise_cbse_all_pdf+"?class="+student_class+"&section="+student_class_section+"&exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&session1="+session1+"&exam_term="+exam_term+"&student_class_group="+student_class_group;
			window.open(url2,'_blank');
			}
	if(value==2){
			var url2=pdf_path+"marksheet_page/"+marksheet_final_cbse_all_pdf+"?class="+student_class+"&section="+student_class_section+"&exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&session1="+session1+"&exam_term="+exam_term+"&student_class_group="+student_class_group;
			window.open(url2,'_blank');
			}
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
<?php
$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$marksheet_final_cbse_all_pdf = $row321['marksheet_final_cbse_all_pdf'];
	$marksheet_exam_wise_cbse_all_pdf = $row321['marksheet_exam_wise_cbse_all_pdf'];
}	
?>
					<input type="hidden"  id="pdf_path" value="<?php echo $pdf_path; ?>" >
			<input type="hidden"  id="marksheet_final_cbse_all_pdf" value="<?php echo $marksheet_final_cbse_all_pdf; ?>" >
			<input type="hidden"  id="marksheet_exam_wise_cbse_all_pdf" value="<?php echo $marksheet_exam_wise_cbse_all_pdf; ?>" >
			
            <div class="box-body "  >
			<form role="form" id="add_employee" method="post" enctype="multipart/form-data">
				<input type="hidden" id="session1" value="<?php echo $session1; ?>" >
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
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
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
				 
				 <button class="form-control my_background_color"  id="print_all_button_exam_wise" onclick="print_all('1');" style="display:none;" >Print All Exam Wise</button>
				 <button class="form-control my_background_color" style="display:none;" id="print_all_button" onclick="print_all('2');" >Print All Final</button>
			
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
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
				  <th><?php echo $language['View Marksheet']; ?></th>
				  <th><?php echo $language['Final Marksheet']; ?></th>
				  
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