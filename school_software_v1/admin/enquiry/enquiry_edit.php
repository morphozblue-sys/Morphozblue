<?php include("../attachment/session.php"); ?><?php
$s_no1=$_GET['id'];

$que="select * from enquiry_info where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$enquiry_type = $row['enquiry_type'];
	$enquiry_date = $row['enquiry_date'];
	$enquiry_name = $row['enquiry_name'];
	$enquiry_father_name = $row['enquiry_father_name'];
	$student_medium = $row['student_medium'];
	$enquiry_contact_no_1 = $row['enquiry_contact_no_1'];
	$enquiry_contact_no_2 = $row['enquiry_contact_no_2'];
	$enquiry_address = $row['enquiry_address'];
	$enquiry_next_follow_up_date_1 = $row['enquiry_next_follow_up_date'];
	$enquiry_next_follow_up_date_2 = explode("-",$enquiry_next_follow_up_date_1);
	$enquiry_next_follow_up_date=$enquiry_next_follow_up_date_2[2]."-".$enquiry_next_follow_up_date_2[1]."-".$enquiry_next_follow_up_date_2[0];
    $enquiry_remark_1 = $row['enquiry_remark_1'];
	$enquiry_remark_2 = $row['enquiry_remark_2'];
	
	}

?>
<script>
function for_other(){
    var enquiry_type=document.getElementById('enquiry_type').value;
    if(enquiry_type=='other'){
        $('#div_enquiry_type_ohter').show();
        $('#enquiry_type_ohter').val('');
    }else{
        $('#div_enquiry_type_ohter').hide();
        $('#enquiry_type_ohter').val(enquiry_type);
    }
}

	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"enquiry/enquiry_edit_api.php",
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
				   get_content('enquiry/enquiry_list');
            }
			}
         });
      });
</script>
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $language['Enquiry Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-phone-square"></i>  <?php echo $language['Enquiry']; ?></a></li>
        <li><a href="javascript:get_content('enquiry/enquiry_list')"><i class="fa fa-list"></i> <?php echo $language['Enquiry List']; ?></a></li>
		<li class="active"><i class="fa fa-edit"></i> <?php echo $language['Edit']; ?></li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Enquiry Edit']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			      <form role="form" method="post" enctype="multipart/form-data"  id="my_form">
			      <input type="hidden"  name="s_no1"  value="<?php echo $s_no1; ?>" class="form-control">
				  <div class="col-md-4">				
			      <div class="form-group" >
				 <label><?php echo $language['Enquiry Type']; ?></label>
				 <select class="form-control" name="enquiry_type" id="enquiry_type" onchange="for_other();" required>
					<option <?php if($enquiry_type=='for admission'){ echo 'selected'; } ?> value="for admission"><?php echo $language['For Admission']; ?></option>
					<option <?php if($enquiry_type=='for job'){ echo 'selected'; } ?> value="for job"><?php echo $language['For Job']; ?></option>
					<option <?php if($enquiry_type!='for admission' && $enquiry_type!='for job' && $enquiry_type!='other'){ echo 'selected'; } ?> value="other"><?php echo $language['Other']; ?></option>
				 </select>
				  </div>
				  </div>
				  
				  <div class="col-md-4" id="div_enquiry_type_ohter" style=" <?php if($enquiry_type=='for admission' || $enquiry_type=='for job'){ echo 'display:none;'; } ?>">	
					 <div class="form-group" >
					  <label>Enquiry Type Other<font style="color:red"><b>*</b></font></label>
					  <input type="text" value="<?php echo $enquiry_type; ?>" name="enquiry_type_ohter" id="enquiry_type_ohter" value="" class="form-control" required>
					 </div>
				  </div>
				  
				  <div class="col-md-4 ">	
					 <div class="form-group" >
					  <label><?php echo $language['Date']; ?></label>
					  <input type="date" name="enquiry_date"  value="<?php echo $enquiry_date; ?>" class="form-control">
					 </div>
				  </div>
			      <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Name']; ?></label>
						   <input type="text"  name="enquiry_name" placeholder="Name"  value="<?php echo $enquiry_name; ?>" class="form-control">
						</div>
				   </div>
				   <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="enquiry_father_name"  placeholder="Father Name"  value="<?php echo $enquiry_father_name; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Address']; ?></label>
						   <input type="text" name="enquiry_address" placeholder="Your Address"  value="<?php echo $enquiry_address; ?>" class="form-control">
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Contact No1']; ?></label>
						   <input type="text" name="enquiry_contact_no_1" placeholder="Contact No"  value="<?php echo $enquiry_contact_no_1; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Contact No2']; ?></label>
						   <input type="text" name="enquiry_contact_no_2" placeholder="Contact No"  value="<?php echo $enquiry_contact_no_2; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Next Follow Up Date']; ?></label>
					  <input type="date"  name="enquiry_next_follow_up_date" placeholder="Date"  value="<?php echo $enquiry_next_follow_up_date; ?>" class="form-control">
					</div>
				    </div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Enquiry Remark 1']; ?></label>
						   <input type="text" name="enquiry_remark_1" placeholder="Enquiry Remark 1"  value="<?php echo $enquiry_remark_1; ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Enquiry Remark 2']; ?></label>
						   <input type="text" name="enquiry_remark_2" placeholder="Enquiry Remark 2"  value="<?php echo $enquiry_remark_2; ?>" class="form-control">
						</div>
					</div>
					
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Medium</label>
						  <select name="student_medium" class="form-control">
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            </select>
						</div>
					</div>
				    	
		          <div class="col-md-12">
		          <center><input type="submit" name="submit" id="submitButtonId" value="<?php echo $language['Update']; ?>" class="btn btn-primary" /></center>
		          </div>
		          </form>
	                 </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

 
