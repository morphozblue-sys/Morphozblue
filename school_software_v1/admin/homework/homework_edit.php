<?php include("../attachment/session.php");
$s_no1=$_GET['id'];
$que="select * from  homework_student where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$homework_class = trim($row['homework_class']);
	$homework_section = $row['homework_section'];
	$homework = $row['homework'];
	$homework_date_1 = $row['homework_date'];
	$homework_date_2 = explode("-",$homework_date_1);
	$homework_date=$homework_date_2[2]."-".$homework_date_2[1]."-".$homework_date_2[0];
	$homework_remark = $row['homework_remark'];
	$shift=$row['shift'];
	$medium=$row['medium'];
		$subject_name = $row['blank_field_2'];
	$student_class_stream = $row['blank_field_3'];
	$student_class_group = $row['blank_field_4'];

		
	$serial_no++;
	}
	
?>
<?php
  $query21="select * from school_info_general";
  $res32=mysqli_query($conn73,$query21) or die(mysqli_error($conn73));
  
  while($row55=mysqli_fetch_assoc($res32)){
      $school_info_medium=$row55['school_info_medium'];
      $shift=$row55['shift'];
  }
?>
<script type="text/javascript">

	
   function for_section(value){
            var id=value;  
       $.ajax({
			  type: "POST",
              url: access_link+"homework/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                   // alert_new(str);
                  $("#student_class_section").html(str);
              }
           });

    }
</script>

<script type="text/javascript">

    
    
    	$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"homework/homework_edit_api.php",
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
				   get_content('homework/homework_list');
            }
			}
         });
      });
      			function for_subject(){
			       $('#subject_name').html("<option value='' >Loading....</option>");
			     
			var student_class_stream= document.getElementById('student_class_stream').value;
		
			var student_class_group= document.getElementById('student_class_group').value;
				
			var student_class= document.getElementById('homework_class').value;
		
			$.ajax({
			address: "POST",
			url: access_link+"homework/ajax_get_subject.php?value="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
			cache: false,
			success: function(detail){
			 $("#subject_name").html(detail);
		
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

    }
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $language['Homework Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('homework/homework')"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></a></li>
        <li><a href="javascript:get_content('homework/homework_list')"><i class="fa fa-list"></i>  <?php echo $language['Homework List']; ?></a></li>
		<li class="active"><i class="fa fa-edit"></i>   <?php echo $language['Homework Edit']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Homework Edit']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			      <form role="form" method="post" enctype="multipart/form-data" id="my_form">

			   <div class="col-md-12 ">				
			   <div class="col-md-3 ">				
			  <div class="form-group" >
				 <label ><?php echo $language['Class']; ?></label>
				 <select class="form-control" onchange="for_section(this.value);for_subject();for_stream(this.value)" id="homework_class" name="homework_class" value="">
				 <option value="<?php echo $homework_class; ?>"><?php echo $homework_class; ?></option>
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
				<div class="col-md-3 " id="student_class_stream_div" style="display:none;"  >				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_subject();" >
					        	<option value="<?php echo $student_class_stream; ?>"><?php echo $student_class_stream; ?></option>
					       
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
		<div class="col-md-3" id="student_class_group_div" style="display:none;"  >				
					<div class="form-group">
					  <label ><?php echo $language['Group']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_subject();" >
					        	<option value="<?php echo $student_class_group; ?>"><?php echo $student_class_group; ?></option>
					         
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="homework_section" id="student_class_section">
						<option value="<?php echo $homework_section; ?>"><?php echo $homework_section; ?></option>
					    </select>
					</div>
				</div>
								<div class="col-md-3 ">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="subject_name" id="subject_name"  required>
				     	<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
			  <div class="col-md-3 ">	
				<div class="form-group" >
				<label><?php echo $language['Date']; ?></label>
			    <input type="date" value="<?php echo $homework_date; ?>" name="homework_date" id="myLocalDate" class="form-control" required>
				 </div>
			  </div>
			  <?php if($school_info_medium=='Both') { ?>
			  <div class="col-md-3">
			      <div class="form-group">
			          <label>Medium</label>
			          <select name="medium" class="form-control">
			              <option value="<?php echo $medium; ?>"><?php echo $medium; ?></option>
			              <?php if($medium=='Hindi') { ?>
			              <option value="English">English</option>
			              <?php } elseif($medium=='English') { ?>
			              <option value="Hindi">Hindi</option>
			              <?php } ?>
			          </select>
			      </div>
			  </div>
			  <?php }  if($shift=='Yes') { ?>
			  <div class="col-md-3">
			      <div class="form-group">
			          <label>Shift</label>
			          <select name="shift" class="form-control">
			              <option value="<?php echo $shift; ?>"><?php echo $shift; ?></option>
			              <?php if($shift=='shift2') { ?>
			              <option value="shift1">shift1</option>
			              <?php } elseif($shift=='shift1') { ?>
			              <option value="shift2">shift2</option>
			              <?php } ?>
			          </select>
			      </div>
			  </div>
			  <?php } ?>
			  <div class="col-md-3 ">		
				<div class="form-group">
				<label><?php echo $language['Remark']; ?></label>
				<input type="text" name="homework_remark" placeholder="Write Remark"  value="<?php echo $homework_remark; ?>" class="form-control" required>
				</div>
			  </div>
			  </div>
			  
								  <div class="col-md-12">
              <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><b><?php echo $language['Write Homework Here']; ?></b>
              </h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              
			  <h4 style="display:none;"><?php echo $language['Write Hindi']; ?></h4>
			  <input type="hidden"  class="btn btn-success" value="<?php echo $language['click']; ?>" onclick="hindi_typing();">
			  <h5 style="display:none" id="suggestion">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5>
			 <input type="hidden" id="count_value" value="1" ></input> <input type="hidden" name="edit_id" value="<?php echo $s_no1; ?>" ></input>
             <input type="text" id="question_box" rows="2" onKeyUp="get_text_question()" name="content" class="form-control" style="display:none">
			 
                    <textarea id="editor1" name="homework" class="form-control bordder-color" placeholder="write homework" rows="10" cols="80" required><?php echo $homework; ?></textarea>
               
               </div>
               </div>
               <!-- /.box -->
               </div>	
				    	
		          <div class="col-md-12">
		          <center><input type="submit" name="submit" value="<?php echo $language['Update']; ?>" class="btn btn-primary" /></center>
		          </div>
		          </form>
	                 </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
    var clss=document.getElementById('homework_class').value;
    for_stream(clss);
</script>
