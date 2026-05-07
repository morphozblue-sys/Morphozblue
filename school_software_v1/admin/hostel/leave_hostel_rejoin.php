<?php include("../attachment/session.php"); ?>


 <script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/leave_hostel_rejoin_api.php",
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
				   get_content('hostel/leave_student');
            }
			}
         });
      });
</script>

<?php
$hostel_student_id=$_GET['id'];

 

$que="select * from hostel_student_info where hostel_student_id='$hostel_student_id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    $edit_s_no = $row['s_no'];
    $roll_number = $row['roll_number'];
    $hostel_student_id = $row['hostel_student_id'];
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
	$hostel_student_photo = $row['hostel_student_photo'];
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
	
	$query="select * from student_admission_info where student_roll_no='$roll_number' and session_value='$session1' ";
	$run121=mysqli_query($conn73,$query);
	$row121=mysqli_fetch_assoc($run121);
	$student_id_generate = $row121['student_id_generate'];
	$student_photo = $row121['student_photo_blob'];
	
	//$path1="../../documents/student/".$student_id_generate."/".$student_photo;
	
}
?>




</head>

<script>
function hostel_detail(value){
$.ajax({
type: "POST",
url: access_link+"hostel/room_alloting.php?hostel_name="+value+"",
cache: false,
success: function(detail){
$("#bed_detail").html(detail);
}
});
}


function bed_details(room_no,bed_type){
//alert_new(room_no+' '+bed_type);

var hos_name=document.getElementById('hostel_name').value;
document.getElementById('hostel_name1').value=hos_name;

document.getElementById('hostel_room').value=room_no;
if(bed_type==1){
bed_type1='Single';
}else if(bed_type==2){
bed_type1='Double';
}else if(bed_type==3){
bed_type1='Triple';
}else if(bed_type==4){
bed_type1='Fourth';
}else if(bed_type==5){
bed_type1='Fifth';
}else if(bed_type==6){
bed_type1='Sixth';
}

document.getElementById('hostel_bed_type').value=bed_type1;
var facility=document.getElementById('detail'+room_no).value;

var res = facility.split("|?|");
document.getElementById('hostel_room_faci').value=res[0];
document.getElementById('hostel_wash').value=res[1];
document.getElementById('hostel_room_charge').value=res[2];

}
</script>


     <section class="content-header">
      <h1>
        Hostel Management
        <small>Control panel</small>
      </h1>
    <ol class="breadcrumb">
	    
	
	   <li><a href=".javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
		 <li><a href="javascript:get_content('hostel/leave_student')"><i class="fa fa-bed"></i>Old Hostel Student</a></li>
		 <li class="Active">Student Hostel Rejoin</li>
	</ol>
    </section>

	
	
	<!---*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		 
            <div class="box-header with-border ">
              <h3 class="box-title">Registration From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->

		
		<div class="box-body">	
	    <form method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body">
			<h3 style="color:#d9534f;"><b>Student Admission In Hostel</b></h3>
			    <div class="col-md-4">
					<div class="form-group">
						<label>Roll No.<font style="color:red"><b>*</b></font></label>
						<input type="text"  name="roll_number" placeholder="Unique Id"  value="<?php echo $roll_number; ?>" class="form-control" readonly>
						<input type="hidden"  name="hostel_student_id" placeholder="Unique Id"  value="<?php echo $hostel_student_id; ?>" class="form-control" readonly>
						<input type="hidden"  name="edit_s_no"  value="<?php echo $edit_s_no; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 " style="display:none;">
					<div class="form-group">
						<button type="submit" style="margin-top:24px;" name="fill" class="btn btn-primary">Validate</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Name</label>
						<input type="text"  name="hostel_student_name"  placeholder="Name"  value="<?php echo $hostel_student_name;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">		
					<div class="form-group">
				       <label>Father's Name</label>
					   <input type="text" name="hotel_father_name" placeholder="Father's Name"  value="<?php echo $hotel_father_name;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
					  <label>Date Of Birth</label>
					  <input type="date"  name="hostel_student_dob"   value="<?php echo $hostel_student_dob;?>" class="form-control">
					</div>
				  </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Gender</label><br>
                        <select name="hostel_student_gender" class="form-control">
						<option value="<?php echo $hostel_student_gender;?>"><?php echo $hostel_student_gender;?></option>
						   <option value="Male">Male</option>
						   <option value="Female">Female</option>
						</select>
				</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Handicapped</label>
					   <select name="hostel_student_handicapped" class="form-control">
			<option value="<?php echo $hostel_student_handicapped;?>"><?php echo $hostel_student_handicapped;?></option>
						   <option value="No">No</option>
						   <option value="Yes">Yes</option>
						</select>
					  
					</div>
				</div>	
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label >Religion</label>
					  <input type="text"  name="hostel_student_religion" placeholder="Religion"  value="<?php echo $hostel_student_religion;?>" class="form-control">
				 </div>
				 </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Category</label>
					<input type="text"  name="hostel_student_category" placeholder="Category"  value="<?php echo $hostel_student_category;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Aadhar No.</label>
					  <input type="text"  name="hostel_student_aadhar" placeholder="Aadhar No."  value="<?php echo $hostel_student_aadhar;?>" class="form-control">
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Class</label>
					 <input type="text"  name="hostel_student_class" placeholder="Class"  value="<?php echo $hostel_student_class;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Father Contact</label>
					  <input type="text"  name="hostel_student_father_contact"  placeholder="Father Contact"  value="<?php echo $hostel_student_father_contact; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Father Email I'd</label>
					  <input type="text"  name="hostel_student_father_email"  placeholder="Father Email I'd"  value="<?php echo $hostel_student_father_email ;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Mother Name</label>
					  <input type="text"  name="hostel_student_mother_name"  placeholder="Mother Name"  value="<?php echo $hostel_student_mother_name ;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Mother Contact</label>
					  <input type="text"  name="hostel_student_mother_contact"  placeholder="Mother Contact"  value="<?php echo $hostel_student_mother_contact ;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Student Contact</label>
					  <input type="text"  name="hostel_student_contact"  placeholder="Student Contact"  value="<?php echo $hostel_student_contact;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group">
					  <label>Student Email</label>
					  <input type="text"  name="hostel_student_email"  placeholder="Student Email"  value="<?php echo $hostel_student_email ;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group">
					  <label >Student Photo</label>
					  <input type="hidden"  name="hostel_student_photo" placeholder=""  value="" class="form-control">
				       <img src="<?php echo ''; ?>" height="50" width="50">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Emergency Contact</label>
					  <input type="text"  name="hostel_emergency_contact" value="<?php echo $hostel_emergency_contact ;?>" class="form-control">
					</div>
				</div>
	        </div>
			
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Room Allotment</button>
	
	
	<!-----------------------------------------------Model Box Start----------------------------------------------------------->

						<div class="modal fade" id="modal-default">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header my_background_color">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Default Modal</h4>
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
										$s_no=$row12['s_no'];
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
	 <h3 style="color:#d9534f;"><b>Hostel Info:</b></h3>
		    <div class="col-md-4 ">
				 <div class="form-group">
		<label>Hostel Name:<font style="color:red"><b>*</b></font></label>
		<input type="text" name="hostel_name1" id="hostel_name1" placeholder="Room Number"  value="" class="form-control" required>
	  </div>
		</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Room Number<font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room" id="hostel_room" placeholder="Room Number"  value="" class="form-control" readonly />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Room Bed Type<font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_bed_type" id="hostel_bed_type" placeholder="Room Number"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Facility<font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room_facility" id="hostel_room_faci" placeholder="Room Number"  value="" class="form-control" required />
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Attach Washroom<font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_washroom" id="hostel_wash" placeholder="Attach Washroom"  value="" class="form-control" required />
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Charge Per Bed<font style="color:red"><b>*</b></font></label>
						<input type="text"  name="hostel_room_charge_per_bed" id="hostel_room_charge" placeholder="Room Charge Per Bed"  value="" class="form-control" required/>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Room Table</label>
						<select class="form-control" name="hostel_room_table">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Bed</label>
						<select class="form-control" name="hostel_room_bed">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Almirah</label>
						<select class="form-control" name="hostel_room_almirah">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Mess</label>
						<select class="form-control" name="hostel_mess">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Mess Charge</label>
						<input type="text" class="form-control" name="hostel_mess_charge">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Date Of Joining</label>
						<input type="date"  name="hostel_join" value="<?php echo date('Y-m-d')?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Caution Money</label>
						<input type="text"  name="hostel_caution_money" placeholder="Caution Money"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Laundry Charge</label>
						<input type="text"  name="hostel_laundry_charge" placeholder="Laundry Charge"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="form-group">
						<center><button type="submit" name="submit" class="btn btn-primary">Submit Details</button></center>
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

 