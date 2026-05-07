<?php include("../attachment/session.php"); ?>

<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock_management/customer_edit_api.php",
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
				  get_content('stock_management/customer_list');
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
        <li class="active">Edit customer</li>
        </ol>
    </section>
    
	<?php
	$s_no1=$_GET['id'];
	
    $que="select * from customer_detail where customer_status='Active' and s_no='$s_no1'";
    $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run)){
    
    $customer_name=$row['customer_name'];
    $customer_contact=$row['customer_contact'];
    $customer_email=$row['customer_email'];
    $customer_address=$row['customer_address'];
    $customer_status=$row['customer_status'];
    
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
              <h1 class="box-title"><b>Edit New Customer</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
				<div class="col-md-12">
                
                <div class="col-md-4">						
				<div class="form-group">
                  <label >Customer Name <span style="color:red;">*</span></label>
                  <input type="text" name="customer_name" placeholder="Customer Name" value="<?php echo $customer_name; ?>" id="" class="form-control" required />
                </div>
				</div>
				
				<div class="col-md-4">						
				<div class="form-group">
                  <label >Customer Contact <span style="color:red;">*</span></label>
                  <input type="number" name="customer_contact" placeholder="Customer Contact" value="<?php echo $customer_contact; ?>" id="" class="form-control" required />
                </div>
				</div>
				
				<div class="col-md-4">						
				<div class="form-group">
                  <label >Customer E-mail</label>
                  <input type="email" name="customer_email" placeholder="Customer E-mail" value="<?php echo $customer_email; ?>" id="" class="form-control" />
                </div>
				</div>
				
				<div class="col-md-12">						
				<div class="form-group">
                  <label >Customer Address</label>
                  <input type="text" name="customer_address" placeholder="Customer Address" value="<?php echo $customer_address; ?>" id="" class="form-control" />
                </div>
				</div>
				
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="hidden" name="customer_s_no" placeholder="" value="<?php echo $s_no1; ?>" id="" class="form-control" readonly />
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  </form>
    </div>
</section>


