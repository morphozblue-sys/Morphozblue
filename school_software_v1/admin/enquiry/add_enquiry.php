<?php include("../attachment/session.php"); ?>
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

function myFunction() {
    if ($("#myCheck").prop("checked") == true){
    $("#div_sms_content").show();
    } else {
    $("#div_sms_content").hide();
    }
}
 
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"enquiry/add_enquiry_api.php",
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
 
    <section class="content-header">
      <h1>
        <?php echo $language['New Enquiry']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-phone-square"></i>  <?php echo $language['Enquiry']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Enquiry Add']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Enquiry Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
			
				 
				 <div class="col-md-4">				
			      <div class="form-group" >
				 <label><?php echo $language['Enquiry Type']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="enquiry_type" id="enquiry_type" onchange="for_other();" required>
					<option value=""><?php echo $language['Select']; ?></option>
					<option value="for admission"><?php echo $language['For Admission']; ?></option>
					<option value="for job"><?php echo $language['For Job']; ?></option>
					<option value="other"><?php echo $language['Other']; ?></option>
				 </select>
				  </div>
				  </div>
				  
				  <div class="col-md-4" id="div_enquiry_type_ohter">	
					 <div class="form-group" >
					  <label>Enquiry Type Other<font style="color:red"><b>*</b></font></label>
					  <input type="text" value="" name="enquiry_type_ohter" id="enquiry_type_ohter" value="" class="form-control" required>
					 </div>
				  </div>
	
				  <div class="col-md-4 ">	
					 <div class="form-group" >
					  <label><?php echo $language['Date']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="date" value="<?php echo date('Y-m-d'); ?>" name="enquiry_date" id="myLocalDate"  placeholder="Date"  value="" class="form-control" required>
					 </div>
				  </div>
			      <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Name']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="enquiry_name" placeholder="<?php echo $language['Name']; ?>"  value="" class="form-control" required>
						</div>
				   </div>
				   <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="enquiry_father_name"  placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Address']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text" name="enquiry_address" placeholder="<?php echo $language['Address']; ?>"  value="" class="form-control" required>
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Contact No1']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text" name="enquiry_contact_no_1" placeholder="<?php echo $language['Contact No1']; ?>"  value="" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Contact No2']; ?></label>
						   <input type="text" name="enquiry_contact_no_2" placeholder="<?php echo $language['Contact No2']; ?>"  value="" class="form-control">
						</div>
					</div>
					<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Next Follow Up Date']; ?></label>
					  <input type="date"  name="enquiry_next_follow_up_date" placeholder="Date"  value="" class="form-control">
					</div>
				    </div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Enquiry Remark 1']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text" name="enquiry_remark_1" placeholder="<?php echo $language['Enquiry Remark 1']; ?>"  value="" class="form-control" required>
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Enquiry Remark 2']; ?></label>
						   <input type="text" name="enquiry_remark_2" placeholder="<?php echo $language['Enquiry Remark 2']; ?>"  value="" class="form-control">
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label> Medium</label>
						  <select name="student_medium" class="form-control">
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            </select>
						</div>
					</div>
					
        <div class="col-md-12 ">
        <?php
        $qry="select school_info_school_name,school_info_school_contact_no from school_info_general";
        $rest=mysqli_query($conn73,$qry);
        while($row22=mysqli_fetch_assoc($rest)){
        $school_info_school_name=$row22['school_info_school_name'];
        $school_info_school_contact_no=$row22['school_info_school_contact_no'];
        }
        ?>
        <div class="col-md-8 ">	
        <label><input type="checkbox" name="myCheck" id="myCheck"  onclick="myFunction();">&nbsp;&nbsp;&nbsp;Check For Message</label>
        <div class="form-group" id="div_sms_content" style="display:none">
        <input type="text" name="sms_content" id="sms_content" value="Welcome to our School. Regards - <?php echo $school_info_school_name; ?> For more detail - <?php echo $school_info_school_contact_no; ?>" class="form-control">
        </div>
        </div>
        </div>
				
		<div class="col-md-12">
		   <center><input type="submit" name="submit" id="submitButtonId" value="<?php echo $language['Submit']; ?>" class="btn btn-primary" /></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<script>
for_other();
</script>
