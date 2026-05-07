<?php include("../attachment/session.php");

$edit_s_no=$_GET['id'];
 

$que="select * from hostel_student_info where s_no='$edit_s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no = $row['s_no'];
	$hostel_student_id = $row['hostel_student_id'];
	$roll_number = $row['roll_number'];
	$hostel_student_name = $row['hostel_student_name'];
	$hotel_father_name = $row['hotel_father_name'];
	$hostel_student_dob = $row['hostel_student_dob'];
	$hostel_student_gender = $row['hostel_student_gender'];
	$hostel_student_handicapped = $row['hostel_student_handicapped'];
	$hostel_student_religion = $row['hostel_student_religion'];
	$hostel_student_category = $row['hostel_student_category'];
	$hostel_student_aadhar = $row['hostel_student_aadhar'];
	$hostel_student_class = $row['hostel_student_class'];
	$hostel_student_father_contact = $row['hostel_student_father_contact'];
	$hostel_student_father_email = $row['hostel_student_father_email'];
	$hostel_student_mother_name = $row['hostel_student_mother_name'];
	$hostel_student_mother_contact = $row['hostel_student_mother_contact'];
	$hostel_student_contact = $row['hostel_student_contact'];
	$hostel_student_email = $row['hostel_student_email'];
	$hostel_emergency_contact = $row['hostel_emergency_contact'];
	$hostel_hostel_name = $row['hostel_hostel_name'];
	$hostel_room = $row['hostel_room'];
	$hostel_room_bed_type = $row['hostel_room_bed_type'];
	$hostel_room_facility = $row['hostel_room_facility'];
	$hostel_washroom = $row['hostel_washroom'];
	$hostel_room_charge_per_bed = $row['hostel_room_charge_per_bed'];
	$hostel_room_table = $row['hostel_room_table'];
	$hostel_room_bed = $row['hostel_room_bed'];
	$hostel_room_almirah = $row['hostel_room_almirah'];
	$hostel_mess = $row['hostel_mess'];
	$hostel_mess_charge = $row['hostel_mess_charge'];
	$hostel_join = $row['hostel_join'];
    $hostel_caution_money = $row['hostel_caution_money'];
	$hostel_laundry_charge = $row['hostel_laundry_charge'];
	 $student_image=$row['student_image'];
    }
    
   
?>

<script>
function check_file_type(input,id,id_show,type1){
if(type1=="image"){
	   var file = input.files[0];
	   if (file.size >= 1024 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB");
      return;
    }  
if(!file.type.match("image/*"))
{
 $('#'+id).val('');
alert_new("Please Upload JPG/JPEG/PNG/GIF File");

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
	alert_new("Please Upload JPG/JPEG/PNG/GIF File");
	
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}else{

	   var file = input.files[0];
	   if (file.size >= 1024 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB");
	  
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
	alert_new("Please Upload JPG/JPEG/PNG/GIF/PDF/DOC File");
	 
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
    loader();
        $.ajax({
            url: access_link+"hostel/hostel_student_details_api.php",
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
				   get_content('hostel/hostel_student_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
      <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel List']; ?></a></li>
	   <li class="Active"><?php echo $language['Hostel Student Details']; ?></li>
      </ol>
    </section>


	
	
	<!---***************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		 
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Hostel Admission Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		<div class="box-body">	
	    	<form method="post" enctype="multipart/form-data" id="my_form">
			<input type="hidden"  name="s_no"    value="<?php echo  $s_no;?>" class="form-control"  >
            <div class="box-body">
			<h3 style="color:#d9534f;"><b><?php echo $language['Student Admission In Hostel']; ?></b></h3>
			    <div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Roll No']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="roll_number" placeholder="Roll No."  value="<?php echo $roll_number;?>" class="form-control" readonly>
						<input type="hidden"  name="hostel_student_id" placeholder="Unique Id"  value="<?php echo $hostel_student_id;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-2" style="display:none;">
					<div class="form-group">
						<button type="submit" style="margin-top:24px;" name="fill" class="btn btn-primary">Validate</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Name']; ?></label>
						<input type="text"  name="hostel_student_name"  placeholder="Name"  value="<?php echo $hostel_student_name;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">		
					<div class="form-group">
				       <label><?php echo $language['Father Name']; ?></label>
					   <input type="text" name="hotel_father_name" placeholder="Father's Name"  value="<?php echo $hotel_father_name;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
					  <label><?php echo $language['Date Of Birth']; ?></label>
					  <input type="date"  name="hostel_student_dob"   value="<?php echo $hostel_student_dob;?>" class="form-control">
					</div>
				  </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Gender']; ?></label><br>
                        <select name="hostel_student_gender" class="form-control">
						   <option value="<?php echo $hostel_student_gender;?>"><?php echo $hostel_student_gender;?></option>
						   <option value="Male">Male</option>
						   <option value="Female">Female</option>
						</select>
				</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Handicapped']; ?></label>
					   <select name="hostel_student_handicapped" class="form-control">
				<option value="<?php echo $hostel_student_handicapped;?>"><?php echo $hostel_student_handicapped;?></option>
						   <option value="No">No</option>
						   <option value="Yes">Yes</option>
						</select>
					  
					</div>
				</div>	
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label><?php echo $language['Religion']; ?></label>
					  <input type="text"  name="hostel_student_religion" placeholder="Religion"  value="<?php echo $hostel_student_religion;?>" class="form-control">
				 </div>
				 </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Category']; ?></label>
					<input type="text"  name="hostel_student_category" placeholder="Category"  value="<?php echo $hostel_student_category;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Aadhar No']; ?></label>
					  <input type="text"  name="hostel_student_aadhar" placeholder="Aadhar No."  value="<?php echo $hostel_student_aadhar;?>" class="form-control">
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Class']; ?></label>
					 <input type="text"  name="hostel_student_class" placeholder="Class"  value="<?php echo $hostel_student_class;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Father Contact No']; ?></label>
					  <input type="text"  name="hostel_student_father_contact"  placeholder="Father Contact"  value="<?php echo $hostel_student_father_contact; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Father Email Id']; ?></label>
					  <input type="text"  name="hostel_student_father_email"  placeholder="Father Email I'd"  value="<?php echo $hostel_student_father_email; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Mother Name']; ?></label>
					  <input type="text"  name="hostel_student_mother_name"  placeholder="Mother Name"  value="<?php echo $hostel_student_mother_name;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Mother Contact No']; ?></label>
					  <input type="text"  name="hostel_student_mother_contact"  placeholder="Mother Contact"  value="<?php echo $hostel_student_mother_contact; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4" style="display:none;">				
					<div class="form-group">
					  <label><?php echo $language['Student Contact']; ?></label>
					  <input type="text"  name="hostel_student_contact"  placeholder="Student Contact"  value="<?php echo $hostel_student_contact;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group" >
					  <label><?php echo $language['Student Email Id']; ?></label>
					  <input type="text"  name="hostel_student_email"  placeholder="Student Email"  value="<?php echo $hostel_student_email; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group" >
					  <label><?php echo $language['Student Photo']; ?></label>
					  <input type="file"  name="hostel_student_photo" onchange="check_file_type(this,'student_image','show_student_photo','image');" placeholder=""  value="" class="form-control">
				      <img src="<?php if($student_image!=''){ echo 'data:image;base64,'.$student_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_photo" height="50" width="50">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Emergency Contact']; ?></label>
					  <input type="text"  name="hostel_emergency_contact" value="<?php echo $hostel_emergency_contact; ?>" class="form-control">
					</div>
				</div>
	        </div>
			
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><?php echo $language['Room Allotment']; ?></button>
			
		
	<!-----------------------------------------------Model Box Start----------------------------------------------------------->

			<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header my_background_color">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Hostel Room</h4>
									  </div>
									  <div class="modal-body">
									  <div class="col-md-12">
									  <div class="col-md-3"></div>
									  <div class="col-md-6">
									  	<div class="form-group">
										<label>Select Hostel:</label>
										<select name="hostel_name" id="hostel_name" class="form-control" onchange="hostel_detail(this.value);" >
										<option value=''>Select</option>
								   <?php $que12="select * from hostel_info where hostel_status='Active' GROUP BY hostel_name";
										$run12=mysqli_query($conn73,$que12);
										while($row12=mysqli_fetch_assoc($run12)){
										$hostel_name=$row12['hostel_name'];
										?>
									 <option value="<?php echo $hostel_name; ?>"><?php echo $hostel_name; ?></option>
										<?php } ?>
									   </select>
									 </div>
									  </div>
									  <div class="col-md-3"></div>
									  </div>
									  <div class="col-md-12" id="bed_detail">
									  
									  
									  
										
									  </div>
									 </div>
									  <div class="modal-footer ">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									  </div>
									</div>
									<!-- /.modal-content -->
								  </div>
								  <!-- /.modal-dialog -->
								</div>
								
  <!-----------------------------------------------Model Box End------------------------------------------------------------>
	 	
	 <div class="box-body">
	 <h3 style="color:#d9534f;"><b><?php echo $language['Hostel Info']; ?></b></h3>
		    <div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Hostel Name']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_name1" id="hostel_name1" placeholder="Room Number"  value="<?php echo $hostel_hostel_name ; ?>" class="form-control" required>
						<input type="hidden" name="hostel_name2" id="hostel_name2" placeholder="Room Number"  value="<?php echo $hostel_hostel_name ; ?>" class="form-control" readonly>
					</div>
				</div><div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room No']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room" id="hostel_room" placeholder="Room Number"  value="<?php echo $hostel_room; ?>" class="form-control" required>
						<input type="hidden" name="hostel_room2" id="hostel_room2" placeholder="Room Number"  value="<?php echo $hostel_room; ?>" class="form-control" readonly />
					</div>
				</div><div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Bed Type']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room_bed_type" id="hostel_bed_type" placeholder="Room Number"  value="<?php echo $hostel_room_bed_type; ?>" class="form-control" required>
						
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Facilities']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room_facility" id="hostel_room_faci" placeholder="Room Number"  value="<?php echo $hostel_room_facility; ?>" class="form-control" required />
						
					</div>
				</div>
				 <div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Attach Washroom']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_washroom" id="hostel_wash" placeholder="Attach Washroom"  value="<?php echo $hostel_washroom; ?>" class="form-control" required />
						
					</div>
				 </div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Charge Per Bed']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="hostel_room_charge_per_bed" id="hostel_room_charge" placeholder="Room Charge Per Bed"  value="<?php echo $hostel_room_charge_per_bed; ?>" class="form-control" required />
					
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Table']; ?></label>
						<select class="form-control" name="hostel_room_table">
						<option value="<?php echo $hostel_room_table; ?>"><?php echo $hostel_room_table; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Bed']; ?></label>
						<select class="form-control" name="hostel_room_bed">
						<option value="<?php echo $hostel_room_bed; ?>"><?php echo $hostel_room_bed; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Almirah']; ?></label>
						<select class="form-control" name="hostel_room_almirah">
						<option value="<?php echo $hostel_room_almirah; ?>"><?php echo $hostel_room_almirah; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Mess']; ?></label>
						<select class="form-control" name="hostel_mess">
						<option value="<?php echo $hostel_room_almirah; ?>"><?php echo $hostel_room_almirah; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Mess Charge']; ?></label>
						<input type="text" class="form-control" name="hostel_mess_charge" value="<?php echo $hostel_mess_charge; ?>">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Date Of joining']; ?></label>
						<input type="date"  name="hostel_join" value="<?php echo $hostel_join; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Caution Money']; ?></label>
						<input type="text"  name="hostel_caution_money" placeholder="Caution Money"  value="<?php echo $hostel_caution_money; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Laundry Charge']; ?></label>
						<input type="text"  name="hostel_laundry_charge" placeholder="Laundry Charge"  value="<?php echo $hostel_laundry_charge; ?>" class="form-control">
					</div>
				</div>
<div class="col-md-12 ">
	<div class="form-group">
		<center><button type="submit" name="submit" class="btn btn-primary"><?php echo $language['Update']; ?> </button></center>
	</div>
</div>
			</div>
			</form>
			</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
		  	
          </div>
		
    </div>
</section>

 