<?php include("../attachment/session.php")?>


<script>
$("#my_form").submit(function(e){
        e.preventDefault();
 
    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"hostel/leave_api.php",
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
$hostel_student_id=$_GET['id'];
 

$que="select * from hostel_student_info where hostel_student_id='$hostel_student_id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$due_caution_money=0;
$due_hostel_charge=0;
$due_room_charge=0;
$due_mess_charge=0;
$due_laundry_charge=0;
while($row=mysqli_fetch_assoc($run)){
    
	$roll_number = $row['roll_number'];
	$hostel_student_id = $row['hostel_student_id'];
	$hostel_student_name = $row['hostel_student_name'];
	$hostel_room = $row['hostel_room'];
	$hostel_hostel_name = $row['hostel_hostel_name'];
}
 ?>
 
<?php
$query="select * from hostel_fee_details where hostel_student_id='$hostel_student_id' and fee_status='Active'";
$run1=mysqli_query($conn73,$query);
$serial_no=0;	
$pay_hostel_charge=0;
$pay_hostel_room_charge=0;
$pay_mess_fee=0;
$pay_laundry_charge=0;
$pay_caution_money=0;
while($row1=mysqli_fetch_assoc($run1)){

 $hostel_student_id = $row1['hostel_student_id'];

    $hostel_charge_balance = $row1['hostel_charge_balance'];
    $pay_hostel_charge+= $row1['pay_hostel_charge'];
	
	$hostel_room_charge_balance = $row1['hostel_room_charge_balance'];
	$pay_hostel_room_charge+= $row1['pay_hostel_room_charge'];
	
	$mess_fee_balance = $row1['mess_fee_balance'];
	$pay_mess_fee+= $row1['pay_mess_fee'];
    
    $laundry_charge_balance = $row1['laundry_charge_balance'];
	$pay_laundry_charge+= $row1['pay_laundry_charge'];
	
	$caution_money_balance = $row1['caution_money_balance'];
	$pay_caution_money+= $row1['pay_caution_money'];
	
	$due_hostel_charge=$hostel_charge_balance-$pay_hostel_charge;
	$due_room_charge=$hostel_room_charge_balance-$pay_hostel_room_charge;
	$due_mess_charge=$mess_fee_balance-$pay_mess_fee;
	$due_laundry_charge=$laundry_charge_balance-$pay_laundry_charge;
	$due_caution_money=$caution_money_balance-$pay_caution_money;
}

?>


        <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel List']; ?></a></li>
	   <li class="Active"><?php echo $language['Leave Student']; ?></li>
	</ol>
    </section>
	
	
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
 <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style="color:#930F4B"><?php echo $language['Leave The Hostel']; ?></h3>
            </div>
            <!-- /.box-header -->
			
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<form method="post" enctype="multipart/form-data" id="my_form">
    <div class="col-md-3"></div>
	<div class="col-md-6 col-md-6-offset-3">
    <div class="panel panel-default">
      <div id="my_table" class="panel-heading"><span style="font-size:18px;"><?php echo $language['Leave The Hostel']; ?></span></div>
      <div class="panel-body">

	 <div class="form-group">
		<label><?php echo $language['Roll No']; ?><font style="color:red"><b>*</b></font></label>
		<input type="text" name="roll_number" placeholder="Student Name" value="<?php echo $roll_number; ?>" class="form-control" readonly>
		<input type="hidden" name="hostel_student_id" placeholder="Student Name" value="<?php echo $hostel_student_id; ?>" class="form-control" readonly>
	</div>
	  
	<div class="form-group">
		<label><?php echo $language['Student Name']; ?></label>
		<input type="text" name="hostel_student_name" value="<?php echo $hostel_student_name; ?>" class="form-control" readonly>
	</div>
	<div class="form-group">
		<label><?php echo $language['Room No']; ?></label>
		<input type="text" name="room_number" value="<?php echo $hostel_room; ?>" class="form-control" readonly>
	</div>
	<div class="form-group">
		<label>Caution Due Money:</label>
		<input type="text" name="caution_due" value="<?php echo $due_caution_money; ?>"  class="form-control">
	</div>
	<div class="form-group">
		<label><?php echo $language['Laundry Due']; ?></label>
		<input type="text" name="laundry_due" value="<?php echo $due_laundry_charge; ?>" class="form-control">
	</div>
	<div class="form-group">
		<label><?php echo $language['Mess Due']; ?></label>
		<input type="text" name="mess_due" value="<?php echo $due_mess_charge; ?>" class="form-control">
	</div>
	<div class="form-group">
		<label><?php echo $language['Room Due']; ?></label>
		<input type="text" name="room_due" value="<?php echo $due_room_charge; ?>" class="form-control">
	</div>
	<div class="form-group">
		<label><?php echo $language['Total Due']; ?></label>
		<input type="text" name="total_due" value="<?php echo $due_hostel_charge; ?>" class="form-control">
	</div>
	<div class="form-group">
		<label><?php echo $language['Leave Date']; ?></label>
		<input type="date" name="leave_date" value="<?php echo date('Y-m-d')?>" class="form-control">
	</div>
	  
	 
	  <div class="form-group">
		    <center><button type="submit" name="submit" class="btn btn-primary"><?php echo $language['Submit Details']; ?></button></center>
	  </div>
	  
	  </div>
    </div>
    </div>
	<div class="col-md-3"></div>
	</form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

 