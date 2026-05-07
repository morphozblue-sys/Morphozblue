<?php include("../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/add_room_api.php",
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
				   get_content('hostel/room_list');
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
	    <li><a href="javascript:get_content('hostel/room_list')"><i class="fa fa-bed"></i><?php echo $language['Room List']; ?></a></li>
	    <li class="Active"><?php echo $language['Add Room']; ?></li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
 <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style="color:#930F4B"> <?php echo $language['Add Room']; ?></h3>
            </div>
            <!-- /.box-header -->
			
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<form method="post" enctype="multipart/form-data" id="my_form">
    <div class="col-md-3"></div>
	<div class="col-md-6 col-md-6-offset-3">
    <div class="panel panel-default">
      <div id="my_table" class="panel-heading"><span style="font-size:18px;"> <?php echo $language['Add Room']; ?></span></div>
      <div class="panel-body">
	 

	 <div class="form-group">
		<label> <?php echo $language['Select Hostel']; ?></label>
		<input type="hidden" name="hostel_name">
		<select name="hostel_name" class="form-control" >
        <option value=''>Select</option>
        <?php $que12="select * from hostel_info where hostel_status='Active' GROUP BY hostel_name";
        $run12=mysqli_query($conn73,$que12);
        while($row12=mysqli_fetch_assoc($run12)){
        $s_no=$row12['s_no'];
        $hostel_name=$row12['hostel_name'];
		?>
        <option value="<?php echo $hostel_name; ?>" ><?php echo $hostel_name; ?></option>
        <?php } ?>
    </select>
	  </div>
	  
	  
	
	   <div class="form-group">
		<label> <?php echo $language['Room No']; ?></label>
		<input type="text" name="room_number" value="" class="form-control">
	  </div>
	   <div class="form-group">
		<label> <?php echo $language['Room Bed Type']; ?></label>
		<select name="room_bed_type" class="form-control">
		<option value="1">Single</option>
		<option value="2">Double</option>
		<option value="3">Triple</option>
		<option value="4">Fourth</option>
		<option value="5">Fifth</option>
		<option value="6">Sixth</option>
		</select>
	  </div>
	  <div class="form-group">
		<label> <?php echo $language['Facilities']; ?></label>
		<select name="room_facility" class="form-control">
		<option value="NonAc">NonAc</option>
		<option value="Ac">Ac</option>
		<option value="Cooler">Cooler</option>
		</select>
	  </div>
	  <div class="form-group">
		<label> <?php echo $language['Attach Washroom']; ?></label>
		<select name="room_attach_washroom" class="form-control">
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>
	  </div>
	 <div class="form-group">
		<label> <?php echo $language['Charges Per Student']; ?></label>
		<input type="text" name="room_charge_per_student" class="form-control">
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

 