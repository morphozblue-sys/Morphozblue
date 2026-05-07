<?php include("../attachment/session.php"); ?>
  
<script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/enquiry_download_list.php",
           data: $("#my_form1").serialize(), 
           success: function(data1)
           {
			  
			$('#get_content').html(data1);
		
           }
         });
      }
</script>
    <section class="content-header">
      <h1>
        Download Enquiry Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Download</li>
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
              <h2 class="box-title">Enquiry 
			  Download Info</h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post"  enctype="multipart/form-data" id="my_form1">
			<div class="col-md-12">
			<div class="col-md-2">
			</div>
			<div class="col-md-3">
			<th><b style="font-size:15px">Date From:-</b></th><input type="date" name="date_from" id="date_from" class="form-control" >
			</div>
			<div class="col-md-3">
			<th><b style="font-size:15px">Date To:-</b></th><input type="date" name="date_to" id="date_to" class="form-control" >
			</div>
			
			<div class="col-md-2">
             <label>Order By</label>
             <select class="form-control" name="order_by" id="order_by">
                <option  value="">Select</option>
            	<option value="enquiry_name">Enquiry Name</option>
            	<option value="enquiry_date">Enquiry Date</option>
             </select>
            </div>
			
			<div class="col-md-2">
			</div>
			</div></br></br></br></br>
			
			<div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" name="" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="enquiry_type|?|enquiry type" class="check_all"><th><b>Enquiry Type</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="enquiry_date|?|enquiry date" class="check_all"><th><b>Enquiry Date</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="enquiry_name|?|enquiry name" class="check_all"><th><b>Enquiry Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="enquiry_father_name|?|enquiry father name" class="check_all"><th><b>Enquiry Father Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="enquiry_contact_no_1|?|enquiry contact no 1" class="check_all"><th><b>Enquiry Contact No 1</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="enquiry_contact_no_2|?|enquiry contact no 2" class="check_all"><th><b>Enquiry Contact No 2</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="enquiry_address|?|enquiry addresss" class="check_all"><th><b>Enquiry Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="enquiry_next_follow_up_date|?|enquiry next follow up date" class="check_all"><th><b>Enquiry Next Follow Up Date</b></th>
						</div>
					</div>
					
		<div class="col-md-12">
		   <center><input type="button" name="submit" value="Submit" class="btn btn-primary" onclick="return for_validity();"/></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

 <script>
function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}
function for_validity(){
var num2=0;
$(".check_all").each(function() {
if($(this).prop('checked')==true){ 
	num2 += Number(parseInt(num2)+1);
}
});
if(num2<1){
alert_new('Please Select Atleast One Field !!!','red');
return false;
}else{
	form_submit();
return true;
}
}
</script>
