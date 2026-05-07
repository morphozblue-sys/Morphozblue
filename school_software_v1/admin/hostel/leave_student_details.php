<?php include("../attachment/session.php"); ?>
<?php
$hostel_student_id=$_GET['id'];

$que="select * from hostel_student_info where hostel_student_id='$hostel_student_id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$s_no = $row['s_no'];
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


    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Hostel Management
        <small>Control panel</small>
      </h1>
    <ol class="breadcrumb">
	
	
	
	   <li><a href=".javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
		 <li><a href="javascript:get_content('hostel/leave_student')"><i class="fa fa-bed"></i>Old Hostel Student</a></li>
		
	   
	    <li class="Active">Student Leave details</li>
	</ol>
    </section>

	
	
	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		    <div class="box-header with-border ">
              <h3 class="box-title">Leave Hostel Student</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		<div class="box-body">	
	    	<form method="post" enctype="multipart/form-data" action="">
            <div class="box-body">
			<h3 style="color:#d9534f;"><b>Student Details</b></h3>
			    <div class="col-md-4">
					<div class="form-group">
						<label>Roll No.<font style="color:red"><b>*</b></font></label>
						<input type="text"  name="roll_number" placeholder="Unique Id"  value="<?php echo $roll_number;?>" class="form-control" readonly>
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
						<label>Name</label>
						<input type="text"  name="hostel_student_name"  placeholder="Name"  value="<?php echo $hostel_student_name;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4">		
					<div class="form-group">
				       <label>Father's Name</label>
					   <input type="text" name="hotel_father_name" placeholder="Father's Name"  value="<?php echo $hotel_father_name;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
					  <label>Date Of Birth</label>
					  <input type="date"  name="hostel_student_dob"   value="<?php echo $hostel_student_dob;?>" class="form-control" readonly>
					</div>
				  </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Gender</label><br>
                        <select name="hostel_student_gender" class="form-control" disabled>
						   <option value="<?php echo $hostel_student_gender;?>"><?php echo $hostel_student_gender;?></option>
						   <option value="Male">Male</option>
						   <option value="Female">Female</option>
						</select>
				</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Handicapped</label>
					   <select name="hostel_student_handicapped" class="form-control" disabled>
				<option value="<?php echo $hostel_student_handicapped;?>"><?php echo $hostel_student_handicapped;?></option>
						   <option value="No">No</option>
						   <option value="Yes">Yes</option>
						</select>
					  
					</div>
				</div>	
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label >Religion</label>
					  <input type="text"  name="hostel_student_religion" placeholder="Religion"  value="<?php echo $hostel_student_religion;?>" class="form-control" readonly>
				 </div>
				 </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Category</label>
					<input type="text"  name="hostel_student_category" placeholder="Category"  value="<?php echo $hostel_student_category;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Aadhar No.</label>
					  <input type="text"  name="hostel_student_aadhar" placeholder="Aadhar No."  value="<?php echo $hostel_student_aadhar;?>" class="form-control" readonly>
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Class</label>
					 <input type="text"  name="hostel_student_class" placeholder="Class"  value="<?php echo $hostel_student_class;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Father Contact</label>
					  <input type="text"  name="hostel_student_father_contact" placeholder="Father Contact"  value="<?php echo $hostel_student_father_contact; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Father Email I'd</label>
					  <input type="text"  name="hostel_student_father_email" placeholder="Father Email I'd"  value="<?php echo $hostel_student_father_email; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Mother Name</label>
					  <input type="text"  name="hostel_student_mother_name" placeholder="Mother Name"  value="<?php echo $hostel_student_mother_name;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Mother Contact</label>
					  <input type="text"  name="hostel_student_mother_contact"  placeholder="Mother Contact"  value="<?php echo $hostel_student_mother_contact; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4" style="display:none;">				
					<div class="form-group" >
					  <label >Student Contact</label>
					  <input type="text"  name="hostel_student_contact" placeholder="Student Contact"  value="<?php echo $hostel_student_contact;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group" >
					  <label >Student Email</label>
					  <input type="text"  name="hostel_student_email" placeholder="Student Email"  value="<?php echo $hostel_student_email; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group" >
					  <label >Student Photo</label>
					  <img src="<?php echo ''; ?>" height="50" width="50">
					</div>
				</div>
			   <div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Emergency Contact</label>
					  <input type="text"  name="hostel_emergency_contact" value="<?php echo $hostel_emergency_contact; ?>" class="form-control" readonly>
					</div>
				</div>
	        </div>
	 <div class="box-body">
	 <h3 style="color:#d9534f;"><b>Hostel Info:</b></h3>
		    <div class="col-md-4 ">
					<div class="form-group">
						<label>Hostel Name</label>
						<input type="text" name="hostel_hostel_name" placeholder="Hostel Name"  value="<?php echo $hostel_hostel_name;?>" class="form-control" readonly>
					</div>
				</div><div class="col-md-4 ">
					<div class="form-group">
						<label>Room Number</label>
						<input type="text" name="hostel_room" placeholder="Room Number"  value="<?php echo $hostel_room;?>" class="form-control" readonly>
					</div>
				</div><div class="col-md-4 ">
					<div class="form-group">
						<label>Room Bed Type</label>
						<select name="hostel_room_bed_type" class="form-control" disabled>
						  <option value="<?php echo $hostel_room_bed_type;?>"><?php echo $hostel_room_bed_type;?></option>
						  <option value="Single">Single</option>
						  <option value="Double">Double</option>
						  <option value="Triple">Triple</option>
						  <option value="Fourth">Fourth</option>
						  <option value="fifth">fifth</option>
						  <option value="Sixth">Sixth</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Facility</label>
						<select name="hostel_room_facility" class="form-control" disabled>
						  <option value="<?php echo $hostel_room_facility;?>"><?php echo $hostel_room_facility;?></option>
						  <option value="Ac">Ac</option>
						  <option value="NonAc">NonAc</option>
						  <option value="Cooler">Cooler</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Attach Washroom</label>
						<select name="hostel_washroom" class="form-control" disabled>
						  <option value="<?php echo $hostel_washroom;?>"><?php echo $hostel_washroom;?></option>
						  <option value="Yes">Yes</option>
						  <option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Charge Per Bed</label>
						<input type="text" name="hostel_room_charge_per_bed" placeholder="Room Charge Per Bed"  value="<?php echo $hostel_room_charge_per_bed; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Table</label>
						<select class="form-control" name="hostel_room_table" disabled>
						<option value="<?php echo $hostel_room_table; ?>"><?php echo $hostel_room_table; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Bed</label>
						<select class="form-control" name="hostel_room_bed" disabled>
						<option value="<?php echo $hostel_room_bed; ?>"><?php echo $hostel_room_bed; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Room Almirah</label>
						<select class="form-control" name="hostel_room_almirah" disabled>
						<option value="<?php echo $hostel_room_almirah; ?>"><?php echo $hostel_room_almirah; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Mess</label>
						<select class="form-control" name="hostel_mess" disabled>
						<option value="<?php echo $hostel_room_almirah; ?>"><?php echo $hostel_room_almirah; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Mess Charge</label>
						<input type="text" class="form-control" name="hostel_mess_charge" value="<?php echo $hostel_mess_charge; ?>" readonly>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Date Of Joining</label>
						<input type="date"  name="hostel_join" value="<?php echo $hostel_join; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">
				   
					<div class="form-group">
						<label>Leaving Date</label>
						 <?php 
					$query132="select * from hostel_leave where hostel_student_id='$hostel_student_id'";
					$run132=mysqli_query($conn73,$query132);
					$row132=mysqli_fetch_assoc($run132);
					$leave_date=$row132['leave_date'];
					$hostel_student_id=$row132['hostel_student_id'];
					?>
					<input type="date"  name="hostel_leaving" value="<?php echo $leave_date; ?>" class="form-control" readonly>
					</div>
					
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Caution Money</label>
						<input type="text"  name="hostel_caution_money" placeholder="Caution Money"  value="<?php echo $hostel_caution_money; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label>Laundry Charge</label>
						<input type="text"  name="hostel_laundry_charge" placeholder="Laundry Charge"  value="<?php echo $hostel_laundry_charge; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-4" style="display:none;">
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">Update Details</button>
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

 