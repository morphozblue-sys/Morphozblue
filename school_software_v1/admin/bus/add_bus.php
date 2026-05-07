<?php include("../attachment/session.php"); ?>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/add_bus_api.php",
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
				   get_content('bus/bus_list');
            }
			}
         });
      });
      
            
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

    <section class="content-header">
      <h1>
        Bus Management
		    <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active">Add Details Bus</li>
      </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Add Bus Details From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			      <div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Name <font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="bus_name" placeholder="Name"  value="" class="form-control" required>
						</div>
				   </div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Company<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_company" placeholder="Company Name"  value="" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Model No.<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="bus_model_no"  placeholder="Bus Model No."  value="" class="form-control" required>
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus No.<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_no" placeholder="Bus No."  value="" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Name<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_owner_name" placeholder="Bus Owner Name"  value="" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Contact No<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_owner_contact" placeholder="Contact No"  value="" class="form-control" required>
						</div>
					</div>
					
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Registration No.<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_ragistration_no" placeholder="Registration No."  value="" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Capacity Of Bus<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_capacity" placeholder="Capacity Of Bus" value="" class="form-control" required>
						</div>
					</div>	

				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Photo</label>
					  <input type="file" name="bus_photo" id="bus_photo" placeholder="" onchange="check_file_type(this,'bus_photo','show_bus_photo','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>					
							<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Registration Card</label>
					  <input type="file" name="bus_registration" id="bus_registration" placeholder="" onchange="check_file_type(this,'bus_registration','show_bus_registration','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_registration" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>				
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Insurance</label>
					  <input type="file" name="bus_insurance" id="bus_insurance" placeholder="" onchange="check_file_type(this,'bus_insurance','show_bus_insurance','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_insurance" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>					
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Other Document</label>
					  <input type="file" name="bus_other_document" id="bus_other_document" placeholder="" onchange="check_file_type(this,'bus_other_document','show_bus_document_uplode','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_document_uplode" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				
				
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Pollution Certificate</label>
					  <input type="file" name="bus_pollution_certificate" id="bus_pollution_certificate" placeholder="" onchange="check_file_type(this,'bus_pollution_certificate','show_bus_pollution_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_pollution_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Fitness Certificate</label>
					  <input type="file" name="bus_fitness_certificate" id="bus_fitness_certificate" placeholder="" onchange="check_file_type(this,'bus_fitness_certificate','show_bus_fitness_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_fitness_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Permit Certificate</label>
					  <input type="file" name="bus_permit_certificate" id="bus_permit_certificate" placeholder="" onchange="check_file_type(this,'bus_permit_certificate','show_bus_permit_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_permit_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Speed Certificate</label>
					  <input type="file" name="bus_speed_certificate" id="bus_speed_certificate" placeholder="" onchange="check_file_type(this,'bus_speed_certificate','show_bus_speed_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_speed_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus GPS Certificate</label>
					  <input type="file" name="bus_gps_certificate" id="bus_gps_certificate" placeholder="" onchange="check_file_type(this,'bus_gps_certificate','show_bus_gps_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_gps_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
			   <label>Bus Camera Certificate</label>
					  <input type="file" name="bus_camera_certificate" id="bus_camera_certificate" placeholder="" onchange="check_file_type(this,'bus_camera_certificate','show_bus_camera_certificate','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bus_camera_certificate" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				
		
		<div class="col-md-12">
		   <center><input type="submit" name="submit" value="submit" class="btn btn-primary" /></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  

