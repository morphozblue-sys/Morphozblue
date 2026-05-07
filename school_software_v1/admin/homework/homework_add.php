<?php include("../attachment/session.php"); ?>
<?php
  $query21="select * from school_info_general";
  $res32=mysqli_query($conn73,$query21) or die(mysqli_error($conn73));
  
  while($row55=mysqli_fetch_assoc($res32)){
      $school_info_medium=$row55['school_info_medium'];
      $shift=$row55['shift'];
  }
?>
<script>
	  function get_text_question() 
            {
			var x1=document.getElementById("question_box").value;
			var x2=document.getElementById("count_value").value;
			var res=x1.split(" ");
			var count=res.length;
			var count1=count-3;
			if(parseInt(count)>parseInt(x2))
			{
			
		    var desc = CKEDITOR.instances.editor1.getData();
			var res2 = desc.replace("<p>", "");
			var res3 = res2.replace("</p>", "");
			if(count1<0){
			}else{
			 var res4=res3+res[count1];
			 CKEDITOR.instances.editor1.setData(res4);
			 }
		  }
				 document.getElementById("count_value").value=count;
	}
   function for_section(value){
       $('#student_class_section').html("<option value='' >Loading....</option>");
        if(value!=''){
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
        } else {
            $("#student_class_section").html("<option value=''>Select</option>");
        }

    }
</script>
<script type="text/javascript">
/* $(function(){
      
            var id=document.getElementById('homework_class').value;	
           $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"homework/ajax_class_section.php?class_name="+id+"",
              cache: false,
              success: function(detail){
                   //var str =detail;                
                   // alert_new(str);
                  $("#student_class_section").html(detail);
              }
           });

    });*/
    
    function check_file_type(input,id,id_show,type1){
if(type1=="image"){
	   var file = input.files[0];
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB","red");
      return;
    }  
if(!file.type.match("image/*"))
{
 $('#'+id).val('');
alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");

 return;
}  
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	  $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");
	
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}else{

	   var file = input.files[0];
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB","red");
	  
      return;
    }  
 
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	 $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF/PDF/DOC File","red");
	 
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}

}
    function mimeType(headerString) {
  switch (headerString) {
    case "89504e47":
      type = "image/png";
      break;
    case "47494638":
      type = "image/gif";
      break;
    case "ffd8ffe0":
    case "ffd8ffe1":
    case "ffd8ffe2":
      type = "image/jpeg";
      break;
	 case "25504446":
      type = "application/pdf";
      break;
	  case "d0cf11e0":
      type = "application/doc";
      break;
    default:
      type = "1";
      break;
  }
  return type;
}

	$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
  $("#get_content").html(loader_div);
        $.ajax({
            url: access_link+"homework/homework_add_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               
                $("#student_detail").html(detail);
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
			url: access_link+"homework/ajax_get_subject_1.php?value="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
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
             url:  access_link+"homework/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });

    }
</script>
<section class="content-header">
      <h1>
        <?php echo $language['Homework Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('homework/homework')"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Add Homework']; ?></li>
      </ol>
	   </section>
  <form role="form" method="post" enctype="multipart/form-data" id="my_form">
	
 <div class="col-md-12">
			   <div class="col-md-3">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select name="homework_class" onchange="for_section(this.value);for_subject();for_stream(this.value)" id="homework_class" class="form-control" required>
						<option value="">Select</option>
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
					<div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_subject();" >
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
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_subject();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="homework_section" id="student_class_section">
					        <option value=''>Select</option>
					    </select>
					</div>
				</div>
					<div class="col-md-3 ">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="subject_name" id="subject_name">
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
				 <div class="col-md-3">	
				<div class="form-group" >
				<label><?php echo $language['Date']; ?></label>
			    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="homework_date" id="myLocalDate"  placeholder="Date"  value="" class="form-control">
				 </div>
			  </div>
		
			  <div class="col-md-3"  <?php if($school_info_medium!='Both') { ?> style="display:none" <?php }  ?> >
			      <div class="form-group">
			          <label>Medium</label>
			          <select name="medium" class="form-control">
			              <option value="">Select Medium</option>
			              <option value="English">English</option>
			              <option value="Hindi">Hindi</option>
			          </select>
			      </div>
			  </div>
		
			  <div class="col-md-3"  <?php if($shift!='yes') { ?> style="display:none" <?php }  ?>>
			      <div class="form-group">
			          <label>Shift</label>
			          <select name="shift" class="form-control">
			              <option value="">Select Shift</option>
			              <option value="shift1">shift1</option>
			              <option value="shift2">shift2</option>
			          </select>
			      </div>
			  </div>
		
			   <div class="col-md-3">		
				<div class="form-group">
				<label><?php echo $language['Remark']; ?></label>
				<input type="text" name="homework_remark" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" required>
				</div>
			  </div>

               <div class="col-md-3">	
					<div class="form-group">
					  <label>Home Work Image</label>
					  <input type="file" name="student_photo" id="student_photo" placeholder="" onchange="check_file_type(this,'student_photo','show_student_photo','all');" class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_student_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				</div>
			  			  <div class="col-md-12">
              <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><b><?php echo $language['Write Homework Here']; ?><font style="color:red"><b>*</b></font></b>
              </h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              			  
			
			  <h4 style="display:none;"><?php echo $language['Write Hindi']; ?></h4>
			  <input type="hidden"  class="btn btn-success" value="<?php echo $language['click']; ?>" onclick="hindi_typing();">
			  <h5 style="display:none;" id="suggestion">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5>
			 <input type="hidden" id="count_value" value="1" ></input>
             <input type="text" id="question_box" rows="2" onKeyUp="get_text_question()" name="content" class="form-control" style="display:none;">
			
  <textarea id="" name="homework" class="form-control bordder-color" placeholder="write homework" rows="12" cols="80" required></textarea>
               
               </div>
               </div>
               <!-- /.box -->
               </div>
	       <div class="col-md-12">
		        <center><input type="submit" name="btnSave" value="submit" class="btn btn-success" /></center>
		  </div>
		  <div id="student_detail"></div>
</form>

