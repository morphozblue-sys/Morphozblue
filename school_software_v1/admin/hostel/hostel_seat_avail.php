<?php include("../attachment/session.php"); ?>

     <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	     <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li class="active"><?php echo $language['Hostel List']; ?></a></li>
     </ol>
    </section>
    
<script>
function hostel_detail(value){
$("#bed_detail").html(loader_div);
$.ajax({
type: "POST",
url: access_link+"hostel/seat_avail.php?hostel_name="+value+"",
cache: false,
success: function(detail){
$("#bed_detail").html(detail);
}
});
}
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Seat Availability']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form method="post">
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
                </form>	
		    </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>