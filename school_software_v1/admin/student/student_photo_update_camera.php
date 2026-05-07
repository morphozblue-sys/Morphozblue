<?php include("../attachment/session.php")?>   <!DOCTYPE html>
<html>
<head>

  <?php include("../attachment/link_css.php")?>
  

</head>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_search_student_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		 $("#student_roll_no1").val(value); 
		 $("#student_roll_no2").val(value); 
		 $("#student_roll_no5").val(value); 
		 $("#student_roll_no6").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_name1").val(res[0]); 
		  $("#student_class").val(res[1]); 
		  $("#student_class2").val(res[1]); 
            $("#student_section").val(res[2]);  
                $("#school_roll_no").val(res[3]); 
$("#pay_fee1").prop('disabled', false);
$("#fee_detail").prop('disabled', false);
$("#tc_generate").prop('disabled', false);
$("#penalty").prop('disabled', false);
$("#assign_rfid").prop('disabled', false);
$("#attendance").prop('disabled', false);
$("#marksheet").prop('disabled', false);
$("#exam_wise_marksheet").prop('disabled', false);
$("#id_card_generate").prop('disabled', false);	
$("#student_edit1").prop('disabled', false);				
$("#student").prop('disabled', false);				
$("#parent").prop('disabled', false);				


        for_exam();
      
              }
           });

    }
	 function set_id_card(value1){
	   document.getElementById("id_card_design").value =value1;
	    $("#id_card_design_submit").click();  
        
	   }
	   	   function for_exam(){

         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
              url: "ajax_get_exam_type.php?class_name="+student_class+"",
              cache: false,
              success: function($detail){

                   var str =$detail;                
                  $("#exam_type23").html(str);

              }
           });

    }
	function get_identity(id){
$('#student_parent').val(id);
if(id=='student'){
$('#gallery').hide();
$('#parent_gallery').hide();
$('#upload_photo').hide();
$('#dropdown_select').val('');
$('#img_list').hide();
$('#camera').hide();
$('#save_image').hide();
$('#take_snapshots').hide();
$('#retake').hide();
}else if(id=='parent'){
$('#gallery').hide();
$('#parent_gallery').hide();
$('#upload_photo').hide();
$('#dropdown_select').val('');
$('#img_list').hide();
$('#camera').hide();
$('#save_image').hide();
$('#take_snapshots').hide();
$('#retake').hide();
}
}
</script> 

  
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>
  
  
  <?php  ?>
  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="students.php"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li class="active">Photo Update</li>
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
              <h3 class="box-title"><?php echo $language['Student Action']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
	
			<form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="col-md-6 ">				
					<div class="form-group" >
					  <label><?php echo $language['Search Student']; ?><font size="2" style="font-weight: normal;"></label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" required>
					  <option value=""><?php echo $language['Select student']; ?></option>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$school_roll_no=$row22['school_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$school_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
			</div>
			
			
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="student_name" placeholder="<?php echo $language['Student Name']; ?>"  id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="student_class" placeholder="<?php echo $language['Class']; ?>"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Section']; ?></label>
						   <input type="text"  name="student_section" placeholder="<?php echo $language['Student Section']; ?>"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Roll No']; ?></label>
					  <input type="hidden"  name="student_roll_no" placeholder="<?php echo $language['Student Roll No']; ?>"  id="student_roll_no" class="form-control" readonly>
					  <input type="text"   placeholder="<?php echo $language['Student Roll No']; ?>"  id="school_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
			
				<div class="col-md-12">
			
				  <div class="col-md-6">
				    <button type="button" id="student" onclick="get_identity(this.id);" class="btn btn-success form-control" data-toggle="modal" data-target="#myModal" disabled>Take Student Photo</button>
				  </div>
				   <div class="col-md-6">
				      <button type="button" id="parent" onclick="get_identity(this.id);" class="btn btn-success form-control" data-toggle="modal" data-target="#myModal"disabled >Take Parent Photo</button>
				  </div>
				  
		
				
		</form>	
		<div class="col-md-12">		        
		</div>
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
			              <!-- modal-box-end -->
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/link_js.php")?>
</div>

</body>
</html>
<script>


  function submit_photo_function(){
  $('#submit_photo_button').click();
  }
function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
		$('#'+id).attr('src', e.target.result);
            };
			
            reader.readAsDataURL(input.files[0]);
			
        }
    }
	function check_file_type(input,id,id_show,type1){
if(type1=="image"){
	   var file = input.files[0];
	   if (file.size >= 2 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB","red");
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
	   if (file.size >= 2 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB","red");
	  
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
function retake_open(){
	$('#take_snapshots').show();
   $('#retake').hide();
$('#gallery').hide();
$('#img_list').hide();
$("#camera").show();
    var options = {
      shutter_ogg_url: "jpeg_camera/shutter.ogg",
      shutter_mp3_url: "jpeg_camera/shutter.mp3",
      swf_url: "jpeg_camera/jpeg_camera.swf",
    };
    var camera = new JpegCamera("#camera", options);
}


function model_open(value){
if(value=='from_camera'){
$('#gallery').hide();
$('#parent_gallery').hide();
$('#img_list').hide();
$("#camera").show();

$('#upload_photo').hide();
$("#take_snapshots").show();

    var options = {
      shutter_ogg_url: "jpeg_camera/shutter.ogg",
      shutter_mp3_url: "jpeg_camera/shutter.mp3",
      swf_url: "jpeg_camera/jpeg_camera.swf",
    };
    var camera = new JpegCamera("#camera", options);
}else if(value=='from_gallery'){
var identity=document.getElementById('student_parent').value;
if(identity=='student'){
$('#gallery').show();
$('#parent_gallery').hide();
}else if(identity=='parent'){
$('#parent_gallery').show();
$('#gallery').hide();
}
$('#upload_photo').show();
$("#take_snapshots").hide();
$('#camera').hide();
}else{
$('#upload_photo').hide();
$("#take_snapshots").hide();
$('#camera').hide();
$('#gallery').hide();
$('#parent_gallery').hide();
}


   $('#take_snapshots').click(function(){
  
    var snapshot = camera.capture();
    snapshot.show();
	$('#camera').hide();
	$('#img_list').show();
	$('#save_image').show();
	$('#take_snapshots').hide();
		$('#retake').show();
		
	var identity=document.getElementById('student_parent').value;
	var student_roll_no6=document.getElementById('student_roll_no6').value;
	
 snapshot.upload({api_url: "webcamClass.php?gen_id="+student_roll_no6+"&identity="+identity}).done(function(response) {
$('#imagelist').html("<img src='"+response+"' width='500px' height='400px'>");

if(identity=='student'){
$('#student_photo').val(response);
}else if(identity=='parent'){
$('#parent_photo').val(response);
}
}).fail(function(response) {
  alert_new("Upload failed with status " + response,"red");
});

});


}
</script>
<div class="container">
<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Take Photo</h4>
      </div>
	  <div>
	  
				            
	  <div class="col-md-6 col-md-offset-3">
	  <center>
	  <select class="form-control" id="dropdown_select" onchange="model_open(this.value);">
	  <option value=''>Select</option>
	  <option value='from_camera'>From Camera</option>
	  <option value='from_gallery'>From Gallery</option>
	  </select>
	  </center>
	  
	  </div><br/>
	  
	  </div>
	  <div>&nbsp;</div>
      <div id="camera">
      
      </div>
	  <form role="form"  method="post" enctype="multipart/form-data">
	  <input type="hidden" name="student_parent" id="student_parent" value="" class="form-control">
	  <div id="gallery" style="display:none;">
 <input type="hidden" class="form-control" name="student_roll_no6" id="student_roll_no6">
	  <input type="file"  id="student_image" name="student_image" placeholder="" onchange="check_file_type(this,'student_image','show_student_photo','image');"  value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
	   <center>
	   <img  id="show_student_photo" height="250" width="250" style="margin-top:10px;">
	    </center>
      </div>
	  <div id="parent_gallery" style="display:none;">
     
	 <input type="file"  id="parent_image" name="parent_image" placeholder="" onchange="check_file_type(this,'parent_image','show_parent_photo','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
	 <center>
	 <img  id="show_parent_photo" height="250" width="250" style="margin-top:10px;"> </center>
	 		<input type="hidden" name="student_photo" id="student_photo" placeholder=""  value="" class="form-control">
		 <input type="hidden" name="parent_photo" id="parent_photo" placeholder=""  value="" class="form-control">
	 	<input style="display:none;" type="submit" id="submit_photo_button" name="submit_photo" value="Submit" class="btn btn-success" />
      </div>
	  </form>
	  <div id="img_list" style="display:none;" class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            <tbody id="imagelist">
            
            </tbody>
			</table>
        </div>

					
      <div class="modal-footer">
	    <button id="retake" onclick="retake_open();" class="btn btn-success" style="display:none;">ReTake Image</button>
	   <button id="save_image" class="btn btn-success" onclick="submit_photo_function();" data-dismiss="modal" style="display:none;">Save</button>
        <button id="take_snapshots" style="display:none;" class="btn btn-success">Take Image</button>
		<button id="upload_photo" style="display:none;" onclick="submit_photo_function();" class="btn btn-success" data-dismiss="modal">Upload Now</button>
	
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</form>
</div>
<style>
#camera {
display:none;
  width: 100%;
  height: 350px;
}

</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script>
<?php


	
	
	
	 if(isset($_POST["submit_photo"])){

	
	$student_roll_no=$_POST['student_roll_no6'];
	
		
	$take_student_photo=$_POST['student_photo'];
	$take_parent_photo=$_POST['parent_photo'];
	
	$gallery_student_image=$_FILES['student_image']['name'];
	$gallery_student_image_temp=$_FILES['student_image']['tmp_name'];
	$gallery_parent_image=$_FILES['parent_image']['name'];
	$gallery_parent_image_temp=$_FILES['parent_image']['tmp_name'];
	
	if($take_student_photo!=''){
	$name23=explode("/",$take_student_photo);
	$student_photo=$name23[5];
	}else{
	$path="../../documents/student/".$student_roll_no;
	if($gallery_student_image!=''){
	$student_photo=uniqid().$gallery_student_image;
	}else{
	$student_photo='';
	}
	if(!is_dir($path)){
    mkdir($path, 0755, true);
	}
	move_uploaded_file($gallery_student_image_temp,$path."/".$student_photo);
	}
	
	if($take_parent_photo!=''){
$name23=explode("/",$take_parent_photo);
	
	$student_parents_photo=$name23[5];
	}else{
	$path="../../documents/student/".$student_roll_no;
	if($gallery_parent_image!=''){
	$student_parents_photo=uniqid().$gallery_parent_image;
	}else{
	$student_parents_photo='';
	}
	if(!is_dir($path)){
    mkdir($path, 0755, true);
	}
	move_uploaded_file($gallery_parent_image_temp,$path."/".$student_parents_photo);
	}
if($student_parents_photo!=''){
	  $quer122="update student_admission_info set student_parents_photo='$student_parents_photo',$update_by_update_sql  where student_roll_no='$student_roll_no' and session_value='$session1'";
   mysqli_query($conn73,$quer122);
   }
if($student_photo!=''){
  $quer122="update student_admission_info set student_photo_blob='$student_photo' where student_roll_no='$student_roll_no' and session_value='$session1'";
   mysqli_query($conn73,$quer122);
   }
   
  
	echo "<script>alert_new('Image Successfully Updated');</script>";
	echo "<script>window.open('student_photo_update_camera.php','_self')</script>";
	
	}
	
	
	
?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>