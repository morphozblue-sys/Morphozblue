<?php include("../attachment/session.php"); ?>
<script>
function for_pay(bal_tot){

var total_pay=0;
$("."+bal_tot).each(function() {
total_pay+=Number($(this).val());
});
$("#"+bal_tot).val(total_pay);

}

$("#my_form").submit(function(e){
        e.preventDefault();
 
    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"hostel/hostel_pay_fee_api.php",
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
<?php
$s_no=$_GET['id'];


$que="select * from hostel_student_info where s_no='$s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];

	$roll_number = $row['roll_number'];
	$hostel_student_id = $row['hostel_student_id'];
	$hostel_student_name = $row['hostel_student_name'];
	$hostel_mess_charge = $row['hostel_mess_charge'];
	$hostel_caution_money = $row['hostel_caution_money'];
	$hostel_laundry_charge = $row['hostel_laundry_charge'];
	$hostel_room_charge_per_bed = $row['hostel_room_charge_per_bed'];
	$hostel_charges=$hostel_room_charge_per_bed+$hostel_mess_charge+$hostel_laundry_charge+$hostel_caution_money;

}

$que0="select * from hostel_fee_details where fee_status='Active' and roll_number='$roll_number' and session_value='$session1'";
$pay_hostel_room_charge=0;
$pay_mess_fee=0;
$pay_laundry_charge=0;
$pay_caution_money=0;
$total_pay=0;
$run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73));
while($row0=mysqli_fetch_assoc($run0)){
$pay_hostel_room_charge=$pay_hostel_room_charge+$row0['pay_hostel_room_charge'];
$pay_mess_fee=$pay_mess_fee+$row0['pay_mess_fee'];
$pay_laundry_charge=$pay_laundry_charge+$row0['pay_laundry_charge'];
$pay_caution_money=$pay_caution_money+$row0['pay_caution_money'];
}
$total_pay=$pay_hostel_room_charge+$pay_mess_fee+$pay_laundry_charge+$pay_caution_money;
?>

    <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel List']; ?></a></li>
	   <li class="Active"><?php echo $language['Hostel Pay Fee']; ?> </li>
      </ol>
    </section>


<?php

$date=date("d-m-Y");

	?>

	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Hostel Fee Pay']; ?></h3>
			  
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
				<form method="post" enctype="multipart/form-data" id="my_form">
			   <div class="col-md-6 ">
					<div class="form-group">
						<label><?php echo $language['Roll No']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="roll_number" placeholder="Student Name"  value="<?php echo $roll_number;?>" class="form-control" readonly>
						<input type="hidden"  name="hostel_student_id" placeholder="Student Name"  value="<?php echo $hostel_student_id;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="form-group">
						<label><?php echo $language['Student Name']; ?><font style="color:red"><b>*</b></font></label>
						<input type="text"  name="hostel_student_name" placeholder="Student Name"  value="<?php echo $hostel_student_name;?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="form-group">
						<label><?php echo $language['Date']; ?></label>
						<input type="date"  name="pay_date" value="<?php echo date('Y-m-d');?>" class="form-control">
					</div>
				</div>
				
				<?php
				 $current_month=date('m');
				  $current_month1=$current_month;
				  $month_wise='';
				if($current_month1=="01")
                       $month_wise="January";
				if($current_month1=="02")
                       $month_wise="February";
				if($current_month1=="03")
                       $month_wise="March";
				if($current_month1=="04")
                       $month_wise="April";
				if($current_month1=="05")
                       $month_wise="May";
				if($current_month1=="06")
                       $month_wise="June";
				if($current_month1=="07")
                       $month_wise="July";
				if($current_month1=="08")
                       $month_wise="August";
				if($current_month1=="09")
                       $month_wise="September";
				if($current_month1=="10")
                       $month_wise="October";
				if($current_month1=="11")
                       $month_wise="November"; 
                if($current_month1=="12")
                       $month_wise="December";				
				
				?>
				
				
				
				
				
				<div class="col-md-6 ">
					<div class="form-group">
					   <label><?php echo $language['Month']; ?></label>
					    <select name="month_pay" class="form-control">
						   <option value="<?php echo $month_wise;?>"><?php echo $month_wise;?></option>
						   <option value="January"><?php echo $language['January']; ?></option>
						   <option value="February"><?php echo $language['February']; ?></option>
						   <option value="March"><?php echo $language['March']; ?></option>
						   <option value="April"><?php echo $language['April']; ?></option>
						   <option value="May"><?php echo $language['May']; ?></option>
						   <option value="June"><?php echo $language['June']; ?></option>
						   <option value="July"><?php echo $language['July']; ?></option>
						   <option value="August"><?php echo $language['August']; ?></option>
						   <option value="September"><?php echo $language['September']; ?></option>
						   <option value="October"><?php echo $language['October']; ?></option>
						   <option value="November"><?php echo $language['November']; ?></option>
						   <option value="December"><?php echo $language['December']; ?></option>
						</select>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label>Fees Type</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Total Fee</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Balance Fee</label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Pay Fee</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Remark</label>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Room Charge Per Bed']; ?></label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text"  name="hostel_room_charge_balance"   placeholder="Amount"  value="<?php echo $hostel_room_charge_per_bed; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" name="" placeholder="Amount" value="<?php echo $hostel_room_charge_per_bed-$pay_hostel_room_charge; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text"  name="pay_hostel_room_charge" id="room_charge" oninput="for_pay('bal_tot');" placeholder="0"  value="" class="form-control bal_tot">
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="hostel_room_charge_remarks"  placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group" >
					  <label><?php echo $language['Mess Fee']; ?> </label>
					</div>
				  </div>
				  <div class="col-md-2">	
					<div class="form-group" >
					  <input type="text"  name="mess_fee_balance" placeholder="Amount"  value="<?php echo $hostel_mess_charge; ?>" class="form-control" readonly>
					</div>
				  </div>
				  
				  <div class="col-md-2">
					<div class="form-group">
						<input type="text" name="" placeholder="Amount" value="<?php echo $hostel_mess_charge-$pay_mess_fee; ?>" class="form-control" readonly>
				    </div>
				</div>
				  
				  <div class="col-md-2">	
					<div class="form-group" >
					  <input type="text"  name="pay_mess_fee" placeholder="0" oninput="for_pay('bal_tot');" id="mess_fee" value="" class="form-control bal_tot" >
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group">
					  <input type="text"  name="mess_fee_remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" >
					</div>
				  </div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Laundry Charge']; ?> </label>
					</div>
				</div>
				<div class="col-md-2">				
					<div class="form-group" >
					  <input type="text"  name="laundry_charge_balance" placeholder="Amount"  value="<?php echo $hostel_laundry_charge; ?>" class="form-control" readonly>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" name="" placeholder="Amount" value="<?php echo $hostel_laundry_charge-$pay_laundry_charge; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">				
					<div class="form-group" >
					  <input type="text"  name="pay_laundry_charge" oninput="for_pay('bal_tot');" id="laundry_charge" placeholder="0"  value="" class="form-control bal_tot">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="laundry_charge_remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Caution Money']; ?> </label>
					</div>
				</div>
				<div class="col-md-2">				
					<div class="form-group" >
					  <input type="text"  name="caution_money_balance" placeholder="Amount"  value="<?php echo $hostel_caution_money; ?>" class="form-control" readonly>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" name="" placeholder="Amount" value="<?php echo $hostel_caution_money-$pay_caution_money; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">				
					<div class="form-group" >
					  <input type="text"  name="pay_caution_money" oninput="for_pay('bal_tot');" id="caution_money" placeholder="0"  value="" class="form-control bal_tot">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="caution_money_remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Total Charge']; ?> </label>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text"  name="hostel_charge_balance"  placeholder="Amount"  value="<?php echo $hostel_charges; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" name="" placeholder="Amount" value="<?php echo $hostel_charges-$total_pay; ?>" class="form-control" readonly>
				    </div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<input type="text"  name="pay_hostel_charge" id="bal_tot" placeholder="0"  value="" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="hostel_charge_remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
					</div>
				</div>
				
				
			<div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit Details']; ?>" class="btn btn-success" /></center>
		    </div>
		</form>	
      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

  
