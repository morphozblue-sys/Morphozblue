<?php include("../attachment/session.php"); ?>
<?php

	$que321="select * from school_info_pdf_info";
    $run321=mysqli_query($conn73,$que321);
    while($row321=mysqli_fetch_assoc($run321)){
	$result_sheet_pdf = $row321['result_sheet_pdf'];
     }
	$link=$pdf_path.'resultsheet_page/'.$result_sheet_pdf;	
?>
<script>

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
              url: access_link+"examination/ajax_stream_group.php?stream_code="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });
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
                 
                  $("#student_class_section").html("<option value='All'>All</option>"+str);
				 for_exam();
              }
           });

    }
	function print_resultsheet(){
	
	  	var pdf_path="<?php echo $link; ?>";
	  	var session1="<?php echo $session1; ?>";
	        var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var exam_type= document.getElementById('exam_type').value;
            var sheet_type= document.getElementById('sheet_type').value;
            var rank= document.getElementById('rank').value;
            if(sheet_type=='all')
            exam_type='';
			if(!(student_class=='11TH' || student_class=='12TH'))
			{student_class_stream='';student_class_group='';}
			if(student_class!=''){
			var url2=pdf_path+"?class="+student_class+"&section="+student_class_section+"&stream_code="+student_class_stream+"&group_name="+student_class_group+"&session="+session1+"&sheet_type="+sheet_type+"&exam_type="+exam_type+"&rank="+rank+"";
			window.open(url2,'_blank');
		
			}
	}
	
	function exam_sheet(value){
    if(value=='exam_wise'){
    $('#for_exam_wise').show();
    }else{
    $('#for_exam_wise').hide();
    }
    }
    
     function for_exam(){
	       $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_get_exam_type.php?class_name="+student_class+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#exam_type").html(str);

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
              <h3 class="box-title"><?php echo $language['Exam Mark List']; ?></h3>
            </div>

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
					  <label >Group<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group"  >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" required>
					     <option value="All">All</option>
					    </select>
					</div>
                </div>
	 
			   <div class="col-md-12">
			     <div class="col-md-3 ">				
			  <div class="form-group" >
				 <label >Sheet Type</label>
				 <select class="form-control" name="sheet_type" id="sheet_type" onchange='exam_sheet(this.value);' required>
				               <option value="">Select</option>
				               <option value="all">Final Sheet</option>
				               <option value="exam_wise">Exam Wise Sheet</option>
					          
				 </select>
				 </div>
				</div>
	  <div class="col-md-3 " id="for_exam_wise"; style="display:none";>				
			  <div class="form-group" >
				 <label ><?php echo $language['Exam Type']; ?></label>
				 <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();'>
				               <option value="">Select Exam Type</option>
					          
				 </select>
				 </div>
				</div>
				<div class="col-md-3 ">				
			  <div class="form-group" >
				 <label >Rank</label>
				 <select class="form-control" name="rank" id="rank">
				               <option value="No">No</option> 
				               <option value="Yes">Yes</option> 
					          
				 </select>
				 </div>
				</div>
				<div class="col-md-3">
				 <br>    
			     <div class="form-group" >
				  <button class="form-control my_background_color"  type="button" onclick="print_resultsheet();"  >Print ResultSheet</button>
				 </div>
				</div>	      				  
			   </div> 
			
			
				
				
	
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
