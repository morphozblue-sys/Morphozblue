<?php include("../attachment/session.php"); ?>

    <section class="content-header">
      <h1>
        <?php echo $language['Bus Management']; ?>
		<small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active"><?php echo $language['Add Asigned Bus Route']; ?></li>
      </ol>
    </section>

<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/asigned_bus_route_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('bus/asigned_bus_route');
            }
			}
         });
      });
</script>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Assigned Bus Route Generate']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
			
			<div class="col-md-2 "></div>
			 <div class="col-md-4 ">				
			  <div class="form-group" >
				 <label><?php echo $language['Bus No']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="bus_no" required>
				 <option value="">Select</option>
				 <?php

					$que="select * from bus_details";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){

					$bus_no = $row['bus_no'];
					$bus_name = $row['bus_name'];

                    ?>
					<option value="<?php echo $bus_no; ?>"><?php echo $bus_no; ?></option>
					
					 <?php } ?>
				 </select>
				
				
				 </div>
				</div>
				
				<div class="col-md-4 ">				
			  <div class="form-group" >
				 <label ><?php echo $language['Bus Route']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="bus_route" required>
				 <option value="">Select</option>
				 <?php

					$que1="select * from bus_route_details GROUP BY bus_route ";
                    $run=mysqli_query($conn73,$que1);
                    $serial_no=0;
                    while($row=mysqli_fetch_assoc($run)){

	                $bus_route = $row['bus_route'];

                    ?>
					<option value="<?php echo $bus_route; ?>"><?php echo $bus_route; ?></option>
					
					 <?php } ?>
				 </select>
				 </div>
				</div>
				<div class="col-md-2 "></div>
		
				<div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		  </div>
	      </div>
	      </form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
           </div>
     </div>
     </section>

   