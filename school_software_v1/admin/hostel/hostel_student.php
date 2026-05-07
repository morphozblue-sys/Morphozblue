<?php include("../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/hostel_student_api.php",
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
<script type="text/javascript">
function hostel_detail(value){

$.ajax({
type: "POST",
url: access_link+"hostel/room_alloting.php?hostel_name="+value+"",
cache: false,
success: function(detail){
////alert_new(detail);
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

<script type="text/javascript">
   function for_name(value){
   //alert_new('hit');
       $.ajax({
			  type: "POST",
              url: access_link+"hostel/hostel_student_ajax.php?roll="+value+"",
              cache: false,
              success: function(detail){
			  var str =detail;
			  var res = str.split("|?|");
            $('#student_name').val(res[0]);
            $('#student_father_name').val(res[1]);
            $('#student_photo').val(res[2]);
            $('#student_date_of_birth').val(res[3]);
            $('#student_gender').val(res[4]);
            $('#student_handicapped').val(res[5]);
            $('#student_religion').val(res[6]);
            $('#student_category').val(res[7]);
            $('#student_adhar_number').val(res[8]);
            $('#student_class').val(res[9]);
            $('#student_father_contact_number').val(res[10]);
            $('#student_father_email_id').val(res[11]);
            $('#student_mother_name').val(res[12]);
            $('#student_mother_contact_number').val(res[13]);
            $('#student_contact_number').val(res[14]);
            $('#student_email_id').val(res[15]);
			var path='';
			}
           });
    }
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
	    <li class="Active"><?php echo $language['Hostel Student Add']; ?></li>
     </ol>
    </section>
	
	
	<!---*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		 
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Registration Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
 <?php
        $que3="select * from login";
        $run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
        while($row3=mysqli_fetch_assoc($run3)){
        $hostel_student_id=$row3['student_hostel_id'];
       }
    ?>		
		
		<div class="box-body">	
	    	<form method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body">
			<h3 style="color:#d9534f;"><b><?php echo $language['Student Admission In Hostel']; ?></b></h3>
			    
				<div class="col-md-4">				
					<div class="form-group">
					  <label><?php echo $language['Student Name']; ?><font size="1" style="font-weight: normal;">
					  (Search by Name,Unique Id,Class,Section,Father Name,Father Contact) </font> <span style="color:red;">*</span></label>
					  <select name="roll_number" class="form-control select2" onchange="for_name(this.value);" required>
					  <option value="">Select student</option>
					        <?php
						
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
				<input type="hidden" name="hostel_student_id" placeholder="Unique Id"  value="<?php echo $hostel_student_id; ?>" class="form-control" readonly>
				<div class="col-md-2" style="display:none;">
					<div class="form-group">
						<button type="submit" style="margin-top:24px;" name="fill" class="btn btn-primary">Validate</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Name']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="hostel_student_name" id="student_name" placeholder="<?php echo $language['Name']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">		
					<div class="form-group">
				       <label><?php echo $language['Father Name']; ?><font style="color:red"><b>*</b></font></label>
					   <input type="text" name="hotel_father_name" placeholder="<?php echo $language['Father Name']; ?>" id="student_father_name" value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">	
					<div class="form-group">
					  <label><?php echo $language['Date Of Birth']; ?></label>
					  <input type="date"  name="hostel_student_dob" id="student_date_of_birth"  value="" class="form-control">
					</div>
				  </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Gender']; ?></label><br>
                        <select name="hostel_student_gender" id="student_gender" class="form-control">
						   <option value="Male">Male</option>
						   <option value="Female">Female</option>
						</select>
				</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Handicapped']; ?></label>
					   <select name="hostel_student_handicapped" id="student_handicapped" class="form-control">
						   <option value="No">No</option>
						   <option value="Yes">Yes</option>
						</select>
					  
					</div>
				</div>	
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label ><?php echo $language['Religion']; ?></label>
					  <input type="text"  name="hostel_student_religion" id="student_religion" placeholder="<?php echo $language['Religion']; ?>"  value="" class="form-control">
				 </div>
				 </div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Category']; ?></label>
					<input type="text"  name="hostel_student_category" id="student_category" placeholder="<?php echo $language['Category']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Aadhar No']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="hostel_student_aadhar" id="student_adhar_number" placeholder="<?php echo $language['Aadhar No']; ?>"  value="" class="form-control" required>
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					 <input type="text"  name="hostel_student_class" placeholder="Class" id="student_class" value="<?php echo $language['Class']; ?>" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group">
					  <label ><?php echo $language['Father Contact No']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="hostel_student_father_contact" id="student_father_contact_number" placeholder="<?php echo $language['Father Contact No']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Father Email Id']; ?></label>
					  <input type="text"  name="hostel_student_father_email" id="student_father_email_id"  placeholder="<?php echo $language['Father Email Id']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Mother Name']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="hostel_student_mother_name" id="student_mother_name" placeholder="<?php echo $language['Mother Name']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Mother Contact No']; ?></label>
					  <input type="text"  name="hostel_student_mother_contact" id="student_mother_contact_number" placeholder="<?php echo $language['Mother Contact No']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 " style="display:none;">				
					<div class="form-group" >
					  <label ><?php echo $language['Student Contact']; ?></label>
					  <input type="text"  name="hostel_student_contact" id="student_contact_number" placeholder="<?php echo $language['Student Contact']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group">
					  <label><?php echo $language['Student Email Id']; ?></label>
					  <input type="text"  name="hostel_student_email" id="student_email_id" placeholder="<?php echo $language['Student Email Id']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Student Photo']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="hostel_student_photo" value="" id="student_photo" class="form-control">
					 </div>
				</div>
				<div class="col-md-4" style="display:none;">				
					<div class="form-group" >
					  <label ><?php echo $language['School Name']; ?></label>
					  <input type="text"  name="hostel_school_name" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Emergency Contact']; ?></label>
					  <input type="text"  name="hostel_emergency_contact" placeholder="Emergency Contact" value="<?php echo $language['Emergency Contact']; ?>" class="form-control">
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
										<h4 class="modal-title"><?php echo $language['Hostel Room']; ?></h4>
									  </div>
									  <div class="modal-body">
									  <div class="col-md-12">
									  <div class="col-md-3"></div>
									  <div class="col-md-6">
									  	<div class="form-group">
										<label><?php echo $language['Select Hostel']; ?></label>
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
	 <h3 style="color:#d9534f;"><b><?php echo $language['Hostel Info']; ?></b></h3>
		    <div class="col-md-4 ">
				 <div class="form-group">
		<label><?php echo $language['Hostel Name']; ?><font style="color:red"><b>*</b></font></label>
		<input type="text" name="hostel_name1" id="hostel_name1" placeholder="<?php echo $language['Hostel Name']; ?>"  value="" class="form-control"  required>
	  </div>
		</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Room No']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room" id="hostel_room" placeholder="<?php echo $language['Room No']; ?>"  value="" class="form-control"  readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Room Bed Type']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_bed_type" id="hostel_bed_type" placeholder="<?php echo $language['Room Bed Type']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Facilities']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_room_facility" id="hostel_room_faci" placeholder="<?php echo $language['Facilities']; ?>"  value="" class="form-control"  required />
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Attach Washroom']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text" name="hostel_washroom" id="hostel_wash" placeholder="<?php echo $language['Attach Washroom']; ?>"  value="" class="form-control" required />
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Charge Per Bed']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="hostel_room_charge_per_bed" id="hostel_room_charge" placeholder="<?php echo $language['Room Charge Per Bed']; ?>"  value="" class="form-control" required/>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo $language['Room Table']; ?></label>
						<select class="form-control" name="hostel_room_table">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Bed']; ?></label>
						<select class="form-control" name="hostel_room_bed">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Room Almirah']; ?></label>
						<select class="form-control" name="hostel_room_almirah">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Mess']; ?></label>
						<select class="form-control" name="hostel_mess">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Mess Charge']; ?></label>
						<input type="text" class="form-control" name="hostel_mess_charge">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Date Of joining']; ?></label>
						<input type="date"  name="hostel_join" value="<?php echo date('Y-m-d'); ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Caution Money']; ?></label>
						<input type="text"  name="hostel_caution_money" placeholder="<?php echo $language['Caution Money']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label><?php echo $language['Laundry Charge']; ?></label>
						<input type="text"  name="hostel_laundry_charge" placeholder="<?php echo $language['Laundry Charge']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="form-group">
						<center><button type="submit" name="submit" class="btn btn-primary"><?php echo $language['Submit Details']; ?></button></center>
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
<script>
$(function () {
    $('.select2').select2();
  });
</script>

  