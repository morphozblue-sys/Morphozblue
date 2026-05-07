<?php include("../attachment/session.php"); ?>

<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/vendor_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                ////alert_new(detail);
                //$('#trial_detail').html(detail);
              var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Complete','green');
				  get_content('stock_management/vendor_list');
            }
			}
         });
      });
</script>


   <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Edit Vendor</li>
        </ol>
    </section>
    
	<?php
	$s_no1=$_GET['id'];
	
    $que="select * from vendor_detail where vendor_status='Active' and s_no='$s_no1'";
    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run)){
    
    $vendor_name=$row['vendor_name'];
    $vendor_contact=$row['vendor_contact'];
    $vendor_email=$row['vendor_email'];
    $vendor_address=$row['vendor_address'];
    $vendor_status=$row['vendor_status'];
    
    }
	?>
	
	<!---*******************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b>Edit New Vendor</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
				<div class="col-md-12">
                
                <div class="col-md-4">						
				<div class="form-group">
                  <label >Vendor Name <span style="color:red;">*</span></label>
                  <input type="text" name="vendor_name" placeholder="Vendor Name" value="<?php echo $vendor_name; ?>" id="" class="form-control" required />
                </div>
				</div>
				
				<div class="col-md-4">						
				<div class="form-group">
                  <label >Vendor Contact <span style="color:red;">*</span></label>
                  <input type="number" name="vendor_contact" placeholder="Vendor Contact" value="<?php echo $vendor_contact; ?>" id="" class="form-control" required />
                </div>
				</div>
				
				<div class="col-md-4">						
				<div class="form-group">
                  <label >Vendor E-mail</label>
                  <input type="email" name="vendor_email" placeholder="Vendor E-mail" value="<?php echo $vendor_email; ?>" id="" class="form-control" />
                </div>
				</div>
				
				<div class="col-md-12">						
				<div class="form-group">
                  <label >Vendor Address</label>
                  <input type="text" name="vendor_address" placeholder="Vendor Address" value="<?php echo $vendor_address; ?>" id="" class="form-control" />
                </div>
				</div>
				
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="hidden" name="vendor_s_no" placeholder="" value="<?php echo $s_no1; ?>" id="" class="form-control" readonly />
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  </form>
    </div>
</section>


