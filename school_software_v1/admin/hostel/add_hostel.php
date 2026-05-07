<?php include("../attachment/session.php"); ?>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"hostel/add_hostel_api.php",
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
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel List']; ?></a></li>
	    <li class="Active"><?php echo $language['Add Hostel']; ?></li>
      </ol>
    </section>
	
	
	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
 <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style="color:#930F4B"><?php echo $language['Add Hostel']; ?></h3>
            </div>
            <!-- /.box-header -->
			
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<form method="post" enctype="multipart/form-data" id="my_form">
    <div class="col-md-3"></div>
	<div class="col-md-6 col-md-6-offset-3">
    <div class="panel panel-default">
      <div id="my_table" class="panel-heading"><span style="font-size:18px;"><?php echo $language['Add Hostel']; ?></span></div>
      <div class="panel-body">
	  <div class="form-group">
		<label><?php echo $language['Hostel Name']; ?></label>
		<input type="text" name="hostel_name" class="form-control" required>
	  </div>
	   <div class="form-group">
		<label><?php echo $language['Hostel Type']; ?></label>
		<select name="hostel_type" class="form-control">
		<option value="Girls">Girls</option>
		<option value="Boys">Boys</option>
		<option value="Both">Both</option>
		</select>
	  </div>
	   <div class="form-group">
		<label><?php echo $language['No Of Room']; ?></label>
		<input type="number" name="hostel_number_of_room" class="form-control" required>
	  </div>
	   <div class="form-group">
		<label><?php echo $language['Total Capacity']; ?></label>
		<input type="text" name="hostel_total_capacity" class="form-control">
	  </div>
	   <div class="form-group">
		<label><?php echo $language['Facilities']; ?></label>
		<select name="hostel_facility" class="form-control">
		<option value="AC&NonAc">AC&NonAc</option>
		<option value="Non A.c">Non A.C</option>
		<option value="A.C">A.C</option>
		<option value="Cooler">Cooler</option>
		</select>
	  </div>
	  <div class="form-group">
		<label><?php echo $language['Laundry Services']; ?></label>
		<select name="hostel_laundry" class="form-control">
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>
	  </div>
	 <div class="form-group">
		<label><?php echo $language['Mess']; ?></label>
		<select name="hostel_mess" class="form-control">
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>
	  </div>
	   <div class="form-group">
		<label><?php echo $language['Warden Name']; ?></label>
		<input type="text" name="hostel_warden_name" class="form-control">
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

  