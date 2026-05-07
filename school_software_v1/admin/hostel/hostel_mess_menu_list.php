<?php include("../attachment/session.php")?>
<?php
include("../../con73/con37.php");

$que2="select * from hostel_mess_menu";
$run2=mysqli_query($conn73,$que2);
if(mysqli_num_rows($run2)<1){
$qur3="insert hostel_mess_menu (sun_breakfast) values('')" ;
mysqli_query($conn73,$qur3);
}
$que="select * from hostel_mess_menu";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){
    
	$sun_breakfast = $row['sun_breakfast'];
	$mon_breakfast = $row['mon_breakfast'];
	$tue_breakfast = $row['tue_breakfast'];
	$wed_breakfast = $row['wed_breakfast'];
	$thu_breakfast = $row['thu_breakfast'];
	$fri_breakfast = $row['fri_breakfast'];
	$sat_breakfast = $row['sat_breakfast'];
	$sun_lunch = $row['sun_lunch'];
	$mon_lunch = $row['mon_lunch'];
	$tue_lunch = $row['tue_lunch'];
	$wed_lunch = $row['wed_lunch'];
	$thu_lunch = $row['thu_lunch'];
	$fri_lunch = $row['fri_lunch'];
	$sat_lunch = $row['sat_lunch'];
	$sun_dinner = $row['sun_dinner'];
	$mon_dinner = $row['mon_dinner'];
	$tue_dinner = $row['tue_dinner'];
	$wed_dinner = $row['wed_dinner'];
	$thu_dinner = $row['thu_dinner'];
	$fri_dinner = $row['fri_dinner'];
	$sat_dinner = $row['sat_dinner'];
	
}

?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	     <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	       <li><a href="javascript:get_content('hostel/hostel_mess')"><i class="fa fa-bed"></i><?php echo $language['Hostel Mess']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Mess Menu List']; ?></li>
	</ol>
    </section>

<!---*****************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Mess Menu']; ?></h3>
			  <a href="javascript:get_content('hostel/mess_menu')"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default"><?php echo $language['Mess Menu Edit']; ?></button></a>
            </div>

            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form method="post">
			<div class="col-lg-12 form-group">
				<div class="col-lg-3"><h4><?php echo $language['Day']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Break Fast']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Lunch']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Dinner']; ?></h4></div>
			</div>
			<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Sunday']; ?></label>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="sun_breakfast"  placeholder="Breakfast"  value="<?php echo $sun_breakfast; ?>" class="form-control" readonly>
				    </div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="sun_lunch"  placeholder="Lunch"  value="<?php echo $sun_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="sun_dinner" placeholder="Dinner"  value="<?php echo $sun_dinner; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Monday']; ?></label>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="mon_breakfast"  placeholder="Breakfast"  value="<?php echo $mon_breakfast; ?>" class="form-control" readonly>
				    </div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="mon_lunch"  placeholder="Lunch"  value="<?php echo $mon_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="mon_dinner"  placeholder="Dinner"  value="<?php echo $mon_dinner; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group" >
					  <label><?php echo $language['Tuesday']?> </label>
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group" >
					  <input type="text"  name="tue_breakfast" placeholder="Breakfast"  value="<?php echo $tue_breakfast; ?>" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group" >
					  <input type="text"  name="tue_lunch" placeholder="Lunch"  value="<?php echo $tue_breakfast; ?>" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group">
					  <input type="text"  name="tue_dinner" placeholder="Dinner"  value="<?php echo $tue_breakfast; ?>" class="form-control" readonly>
					</div>
				  </div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Wednesday']?> </label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_breakfast" placeholder="Breakfast"  value="<?php echo $wed_breakfast; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_lunch" placeholder="Lunch"  value="<?php echo $wed_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_dinner" placeholder="Dinner"  value="<?php echo $wed_dinner; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Thursday']?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="thu_breakfast" placeholder="Breakfast"  value="<?php echo $thu_breakfast; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="thu_lunch" placeholder="Lunch"  value="<?php echo $thu_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="thu_dinner" placeholder="Dinner"  value="<?php echo $thu_dinner; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Friday']?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="fri_breakfast" placeholder="Breakfast"  value="<?php echo $fri_breakfast; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="fri_lunch" placeholder="Lunch"  value="<?php echo $fri_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="fri_dinner" placeholder="Dinner"  value="<?php echo $fri_dinner; ?>" class="form-control" readonly>
					</div>
				</div><div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Saturday']?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="sat_breakfast" placeholder="Breakfast"  value="<?php echo $sat_breakfast; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="sat_lunch" placeholder="Lunch"  value="<?php echo $sat_lunch; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="sat_dinner" placeholder="Dinner"  value="<?php echo $sat_dinner; ?>" class="form-control" readonly>
					</div>
				</div>
				
				
			
		</form>	
      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
</div>
  