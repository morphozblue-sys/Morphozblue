<?php include("../attachment/session.php");
$s_no1=$_GET['id'];
$que="select * from bus_details where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
	$bus_name = $row['bus_name'];
	$bus_company = $row['bus_company'];
	$bus_model_no = $row['bus_model_no'];
	$bus_no = $row['bus_no'];
	$bus_owner_name = $row['bus_owner_name'];
	$bus_owner_contact = $row['bus_owner_contact'];
	$bus_ragistration_no = $row['bus_ragistration_no'];
	$bus_capacity = $row['bus_capacity'];

	$bus_id = $row['bus_id'];
	$serial_no++;
	
	
	$bus_photo=$row['bus_photo_name'];
	$bus_registration=$row['bus_registration_name'];
	$bus_other_document=$row['bus_other_document_name'];
	$bus_insurance=$row['bus_insurance_name'];
	$pollution_certificate=$row['pollution_certificate_name'];
	$fitness_certificate=$row['fitness_certificate_name'];
	$permit_certificate=$row['permit_certificate_name'];
	$speed_certificate=$row['speed_certificate_name'];
	$gps_certificate=$row['gps_certificate_name'];
	$camera_certificate=$row['camera_certificate_name'];

	}

?>
<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/bus_details_edit_api.php",
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
	  
</script>

    <section class="content-header">
    <h1>
     Bus Management
	     <small>Control Panel</small>
    </h1>
     <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li><a href="javascript:get_content('bus/bus_list')"><i class="fa fa-list"></i>Bus Details List</a></li>
        <li class="active">Bus Details Edit</li>
     </ol>
     </section>

       <!-- Main content -->
       <section class="content">
       <!-- Small boxes (Stat box) -->
       <div class="row">
	   <!-- general form elements disabled -->
       <div class="box box-warning  ">
       <div class="box-header with-border ">
       <h3 class="box-title">Bus Details Edit</h3>
       </div>
	   
       <!-- /.box-header -->
     <!------------------------------------------------Start Registration form--------------------------------------------------->

			

                  <div class="box-body "  >
			      <form  method="post" enctype="multipart/form-data" id="my_form">
			       <input type="hidden"  name="s_no1"   value="<?php echo $s_no1; ?>">
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Name</label>
						   <input type="text"  name="bus_name" placeholder="Name"  value="<?php echo $bus_name; ?>" class="form-control" >
						   <input type="hidden"  name="bus_id"   value="<?php echo $bus_id; ?>"  >
						</div>
				   </div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Company</label>
						   <input type="text" name="bus_company" placeholder="Company Name"  value="<?php echo $bus_company; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Model No.</label>
						   <input type="text"  name="bus_model_no"  placeholder="Bus Model No."  value="<?php echo $bus_model_no; ?>" class="form-control" >
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus No.</label>
						   <input type="text" name="bus_no" placeholder="Bus No."  value="<?php echo $bus_no; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Name</label>
						   <input type="text" name="bus_owner_name" placeholder="Bus Owner Name"  value="<?php echo $bus_owner_name; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Contact No</label>
						   <input type="text" name="bus_owner_contact" placeholder="Contact No"  value="<?php echo $bus_owner_contact; ?>" class="form-control" >
						</div>
					</div>
					
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Ragistration No.</label>
						   <input type="text" name="bus_ragistration_no" placeholder="Ragistration No."  value="<?php echo $bus_ragistration_no; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Capacity Of Bus</label>
						   <input type="text" name="bus_capacity" placeholder="Registration No." value="<?php echo $bus_capacity; ?>" class="form-control">
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
					  <img onclick="open_file1('bus_photo','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($bus_photo!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_photo" height="50" width="50" style="margin-top:10px;">
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
					  <img onclick="open_file1('bus_registration','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($bus_registration!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_registration; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_registration" height="50" width="50" style="margin-top:10px;">
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
					  <img onclick="open_file1('bus_insurance','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($bus_insurance!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_insurance; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_insurance" height="50" width="50" style="margin-top:10px;">
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
					  <img onclick="open_file1('bus_other_document','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($bus_other_document!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_other_document; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_document_uplode" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('pollution_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($pollution_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$pollution_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_pollution_certificate" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('fitness_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($fitness_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$fitness_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_fitness_certificate" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('permit_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($permit_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$permit_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_permit_certificate" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('speed_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($speed_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$speed_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_speed_certificate" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('gps_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($gps_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$gps_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_gps_certificate" height="50" width="50" style="margin-top:10px;">
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
					   <img onclick="open_file1('camera_certificate','bus_document','bus_id','<?php echo $bus_id; ?>');" src="<?php if($camera_certificate!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$camera_certificate; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_bus_camera_certificate" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
					
				  
				
					
				    	
		   <div class="col-md-12">
		   <center><input type="submit" name="submit" value="update" class="btn btn-primary" /></center>
		   </div>
		   </form>
	                 </div>
       <!---------------------------------------------End Registration form--------------------------------------------------------->
	<!-- /.box-body -->
          </div>
          </div>
          </section>

<div id="mypdf_view">
			<div>
