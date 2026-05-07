<?php include("../attachment/session.php"); ?>
<?php

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
    <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	  
	    <li><a href=".javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_mess')"><i class="fa fa-bed"></i><?php echo $language['Hostel Mess']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_mess_menu_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel Mess Menu List']; ?></a></li>
	    <li class="Active">Edit Hostel Mess Menu</li>
	</ol>
    </section>

<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/mess_menu_api.php",
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
				   get_content('hostel/hostel_mess_menu_list');
            }
			}
         });
      });
</script>

	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Mess Menu']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			<form method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body">
			
			<div class="col-lg-12 form-group">
				<div class="col-lg-3 "><h4><?php echo $language['Day']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Break Fast']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Lunch']; ?></h4></div>
				<div class="col-lg-3"><h4><?php echo $language['Dinner']; ?></h4></div>
			</div>
			<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Sunday']; ?> </label>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="sun_breakfast"  placeholder="Breakfast"  value="<?php echo $sun_breakfast; ?>" class="form-control" >
				    </div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="sun_lunch"  placeholder="Lunch"  value="<?php echo $sun_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="sun_dinner" placeholder="Dinner"  value="<?php echo $sun_dinner; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo $language['Monday']; ?></label>
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="mon_breakfast"  placeholder="Breakfast"  value="<?php echo $mon_breakfast; ?>" class="form-control" >
				    </div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
						<input type="text"  name="mon_lunch"  placeholder="Lunch"  value="<?php echo $mon_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="form-group">
					   <input type="text"  name="mon_dinner"  placeholder="Dinner"  value="<?php echo $mon_dinner; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group" >
					  <label><?php echo $language['Tuesday']; ?> </label>
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group" >
					  <input type="text"  name="tue_breakfast" placeholder="Breakfast"  value="<?php echo $tue_breakfast; ?>" class="form-control" >
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group" >
					  <input type="text"  name="tue_lunch" placeholder="Lunch"  value="<?php echo $tue_lunch; ?>" class="form-control" >
					</div>
				  </div>
				  <div class="col-md-3">	
					<div class="form-group">
					  <input type="text"  name="tue_dinner" placeholder="Dinner"  value="<?php echo $tue_dinner; ?>" class="form-control" >
					</div>
				  </div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Wednesday']; ?> </label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_breakfast" placeholder="Breakfast"  value="<?php echo $wed_breakfast; ?>" class="form-control" >
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_lunch" placeholder="Lunch"  value="<?php echo $wed_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="wed_dinner" placeholder="Dinner"  value="<?php echo $wed_dinner; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Thursday']; ?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="thu_breakfast" placeholder="Breakfast"  value="<?php echo $thu_breakfast; ?>" class="form-control" >
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="thu_lunch" placeholder="Lunch"  value="<?php echo $thu_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="thu_dinner" placeholder="Dinner"  value="<?php echo $thu_dinner; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Friday']; ?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="fri_breakfast" placeholder="Breakfast"  value="<?php echo $fri_breakfast; ?>" class="form-control" >
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="fri_lunch" placeholder="Lunch"  value="<?php echo $fri_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="fri_dinner" placeholder="Dinner"  value="<?php echo $fri_dinner; ?>" class="form-control">
					</div>
				</div><div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Saturday']; ?></label>
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="sat_breakfast" placeholder="Breakfast"  value="<?php echo $sat_breakfast; ?>" class="form-control" >
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <input type="text"  name="sat_lunch" placeholder="Lunch"  value="<?php echo $sat_lunch; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					   <input type="text"  name="sat_dinner" placeholder="Dinner"  value="<?php echo $sat_dinner; ?>" class="form-control">
					</div>
				</div>
				
				
			<div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Update']; ?>" class="btn btn-success" />&nbsp;&nbsp;</center>
		    </div>
			
      </div>
      </form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
