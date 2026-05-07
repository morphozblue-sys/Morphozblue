<?php include("../attachment/session.php"); ?>
<script>
	function open_file1(image_type,student_roll_no){

	$.ajax({
	address: "POST",
	url: access_link+"student/ajax_open_image.php?image_type="+image_type+"&student_roll_no="+student_roll_no+"",
	cache: false,
	success: function(detail){
	 $("#mypdf_view").html('');
	 $("#mypdf_view").html(detail);
	}
	});
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
</script>
<table id="example1" class="table table-bordered table-striped">
	<thead >
	<tr>
	<th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	<th>S No</th>
	<th>Admission No.</th>
	<th>Name</th>
	<th>Father Name</th>
	<th>Choose Student Photo</th>
	<th>Student Photo</th>
	<th>Choose Father Photo</th>
	<th>Father Photo</th>
	<th>Choose Mother Photo</th>
	<th>Mother Photo</th>

	</thead>
	<tbody>
<?php
$student_class=$_GET['student_class'];
if($student_class!=''){  
$condition1=" and student_class='$student_class'";
}else{
$condition1="";
}

$student_class_stream=$_GET['student_class_stream'];
if($student_class_stream!='All'){  
$condition3=" and student_class_stream='$student_class_stream'";
}else{
$condition3="";
}
$student_class_group=$_GET['student_class_group'];
if($student_class_group!='All'){  
$condition4=" and student_class_group='$student_class_group'";
}else{
$condition4="";
}

$student_class_section=$_GET['student_class_section'];
if($student_class_section!='All'){
$condition2=" and student_class_section='$student_class_section'";
}else{
$condition2="";
}
$student_limit=$_GET['student_limit'];
$student_order_by=$_GET['student_order_by'];

$query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2$condition3$condition4$filter37$student_order_by LIMIT $student_limit, 20";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=$student_limit;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$student_name = $row['student_name'];
	$student_father_name = $row['student_father_name'];
    $student_roll_no = $row['student_roll_no'];
    $student_admission_number=$row['student_admission_number'];
	
	

	$student_photo=$row['student_image_name'];
	 $student_father_photo=$row['student_father_image_name'];
	$student_mother_photo=$row['student_mother_image_name'];
	

    $serial_no++;
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
	<td><?php echo $serial_no; ?></td>
	<td><?php echo $student_admission_number; ?></td>
	<td><input type="text" name="student_name[]" class="" value="<?php echo $student_name; ?>" readonly><input type="hidden" name="student_roll_no[]" class="" value="<?php echo $student_roll_no; ?>"></td>
	

	<td><input type="text" name="student_father_name[]" class="" value="<?php echo $student_father_name; ?>"readonly></td>
	<td style="display:none"><input type="text" name="student_photo_name[]" class="" value="<?php echo $student_photo; ?>"></td>
	<td style="display:none"><input type="text" name="student_father_photo_name[]" class="" value="<?php echo $student_father_photo; ?>"></td>
	<td style="display:none"><input type="text" name="student_mother_photo_name[]" class="" value="<?php echo $student_father_photo; ?>"></td>
	
	<td><input type="file" id="<?php echo "student".$student_roll_no; ?>" name="student_photo[]" placeholder="" onchange="check_file_type(this,'<?php echo "student".$student_roll_no; ?>','<?php echo "show_student".$student_roll_no; ?>','image');"  value="" class="form-control" accept="image/*" capture>
	</td>
	<td><img onclick="open_file1('student_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_photo!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$student_photo; }else echo $school_software_path."images/student_blank.png";  ?>" id="<?php echo "show_student".$student_roll_no; ?>" height="50" width="50" style="margin-top:10px;"></td>	
	
	
	<td> <input type="file"  id="<?php echo "parent".$student_roll_no; ?>" name="student_father_photo[]" placeholder="" onchange="check_file_type(this,'<?php echo "parent".$student_roll_no; ?>','<?php echo "show_parent".$student_roll_no; ?>','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png"></td>
	<td><img onclick="open_file1('student_father_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_father_photo!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$student_father_photo; }else echo $school_software_path."images/student_blank.png";  ?>" id="<?php echo "show_parent".$student_roll_no; ?>" height="50" width="50" style="margin-top:10px;"></td>
	
	
	
		<td> <input type="file"  id="<?php echo "parent1".$student_roll_no; ?>" name="student_mother_photo[]" placeholder="" onchange="check_file_type(this,'<?php echo "parent1".$student_roll_no; ?>','<?php echo "show_parent1".$student_roll_no; ?>','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png"></td>
		
		
	<td><img onclick="open_file1('student_mother_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_mother_photo!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$student_mother_photo; }else echo $school_software_path."images/student_blank.png";  ?>" id="<?php echo "show_parent1".$student_roll_no; ?>" height="50" width="50" style="margin-top:10px;"></td>

  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
     </table>
	 <div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn btn-success"/></center> 
	 </div>
	<div id="mypdf_view">
			<div>	 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
  
 $(function () {
$('#example1').DataTable()
})
</script>