<?php include("../attachment/session.php"); ?>
<?php
$edit_s_no=$_GET['id'];

$que="select * from hostel_info where s_no='$edit_s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$hostel_name = $row['hostel_name'];
	$hostel_type = $row['hostel_type'];
	$hostel_number_of_room = $row['hostel_number_of_room'];
	$hostel_total_capacity = $row['hostel_total_capacity'];
	$hostel_facility = $row['hostel_facility'];
	$hostel_laundry = $row['hostel_laundry'];
	$hostel_mess = $row['hostel_mess'];
	$hostel_warden_name = $row['hostel_warden_name'];

}
?>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/hostel_details_api.php",
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
				   get_content('hostel/hostel_list');
            }
			}
         });
      });
</script>
     <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel List']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Details']; ?></li>
	</ol>
    </section>


	
	
	<!---****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		 
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Registration']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		<div class="box-body">	
	    	<form method="post" enctype="multipart/form-data" id="my_form">
			<input type="hidden" name="s_no" value="<?php echo $edit_s_no; ?>" />
     <div class="box-body">
	 <h3 style="color:#d9534f;"><b><?php echo $language['Hostel Info']; ?></b></h3>
		    <div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Hostel Name']; ?></label>
						<input type="text"  name="hostel_name"   placeholder="Hostel Name"  value="<?php echo $hostel_name;?>" class="form-control " >
					</div>
				</div><div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Hostel Type']; ?></label>
						<select name="hostel_type" class="form-control">
						  <option value="<?php echo $hostel_type;?>"><?php echo $hostel_type;?></option>
						  <option value="Boys">Boys</option>
						  <option value="Girls">Girls</option>
						  <option value="Both">Both</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['No Of Room']; ?></label>
						<input type="number"  name="hostel_number_of_room"   placeholder="Room Number"  value="<?php echo $hostel_number_of_room;?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Total Capacity']; ?></label>
						<input type="number"  name="hostel_total_capacity"   placeholder="Room Number"  value="<?php echo $hostel_total_capacity; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Facilities']; ?></label>
						<select name="hostel_facility" class="form-control">
						  <option value="<?php echo $hostel_facility;?>"><?php echo $hostel_facility;?></option>
						  <option value="Ac">Ac</option>
						  <option value="NonAc">NonAc</option>
						  <option value="Cooler">Cooler</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Laundry Services']; ?></label>
						<select class="form-control" name="hostel_laundry">
						<option value="<?php echo $hostel_laundry; ?>"><?php echo $hostel_laundry; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Mess']; ?></label>
						<select class="form-control" name="hostel_mess">
						<option value="<?php echo $hostel_mess; ?>"><?php echo $hostel_mess; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
						</select>
					</div>
				</div>
			 <div class="col-md-4 ">
					<div class="form-group">
						<label> <?php echo $language['Warden Name']; ?></label>
						<input type="text" class="form-control" name="hostel_warden_name" value="<?php echo $hostel_warden_name; ?>">
					</div>
				</div>
			
				<div class="col-md-12 ">
					<div class="form-group">
						<center><button type="submit" name="submit" class="btn btn-primary"><?php echo $language['Update']; ?></button></center>
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
