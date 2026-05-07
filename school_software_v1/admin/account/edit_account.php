<?php include("../attachment/session.php")?>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"account/edit_account_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Complete');
				   get_content('account/account_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
         <?php echo $language['Account Management']; ?>
					<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li><a href="javascript:get_content('account/account_list')"><i class="fa fa-list"></i><?php echo $language['List']; ?></a></li>
		<li><i class="active"></i> <?php echo $language['Edit Account']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style=" color: red;" > <?php echo $language['Bank Account Edit Form']; ?> </h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		<?php
$s_no1=$_GET['id'];




$que="select * from account_office_bank_account where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

		 
	$bank_account_holder_name =$row['bank_account_holder_name'];
	$bank_account_no=$row['bank_account_no'];
	$bank_name=$row['bank_name'];
	$bank_branch_name=$row['bank_branch_name'];
	$bank_ifsc_code=$row['bank_ifsc_code'];
	}

?>	

            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			  <input type="hidden"  name="s_no1"  value="<?php echo $s_no1; ?>" >
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Account Holder Name']; ?></label>
						   <input type="text"  name="bank_account_holder_name"  placeholder="Account Holder Name"  value="<?php echo $bank_account_holder_name; ?>" class="form-control">
						 
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Account No']; ?></label>
						   <input type="number"  name="bank_account_no"  placeholder="Account No."  value="<?php echo $bank_account_no; ?>" class="form-control">
						</div>
							</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Bank Name']; ?></label>
						   <input type="text" name="bank_name" placeholder="Bank Name"  value="<?php echo $bank_name; ?>" class="form-control">
						</div>
					</div>	
				  <div class="col-md-6 ">		
						<div class="form-group">
						  <label><?php echo $language['Bank Branch Name']; ?></label>
						   <input type="text" name="bank_branch_name"  placeholder="Bank Branch Name"  value="<?php echo $bank_branch_name; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-6 ">		
						<div class="form-group">
						  <label><?php echo $language['Bank Ifsc Code']; ?></label>
						   <input type="text" name="bank_ifsc_code" placeholder="Bank IFSC Code"  value="<?php echo $bank_ifsc_code; ?>" class="form-control">
						</div>
					</div>	
			
	
		  <div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary" /></center>
		  </div>
		
	</div>
	  	</form>	

          </div>
    </div>
</section>
