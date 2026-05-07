<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-money"></i> Enquiry</a></li>
        <li class="active">Enquiry SMS List</li>
      </ol>
    </section>
	
<script>
function for_feelist(){
   $("#fee_details").html(loader_div);
   var enquiry_type=document.getElementById('enquiry_type').value;
   var from_date=document.getElementById('from_date').value;
   var to_date=document.getElementById('to_date').value;
   
   if(enquiry_type!='' && from_date!='' && to_date!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"enquiry/ajax_enquiry_sms_list.php",
	  data: {enquiry_type:enquiry_type,from_date:from_date,to_date:to_date},
	  cache: false,
	  success: function(detail){
		$("#fee_details").html(detail);
	  }
   });
   }else{
	   $("#fee_details").html('');
   }
}

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

function validate(){
	var add1=0;
	$(".info").each(function() {
	if($(this).prop('checked')==true){
		add1 = parseInt(add1+1);
	}
	});
	if(add1>0){
		return true;
	}else{
		alert_new('Please Select Atleast One Option !!!','red');
		return false;
	}
}

$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"enquiry/enquiry_sms_list_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                    alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('enquiry/enquiry_sms_list');
            }
			}
         });
      });
</script>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	<form method="post" enctype="multipart/form-data" id="my_form">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		
		<div class="box-body  col-md-12">
		<div class="col-md-12 col-md-offset-3">
		
		<div class="col-md-2">
			<div class="form-group">
                <label>Enquiry Type</label>
                <select class="form-control" name="enquiry_type" id="enquiry_type" onchange="for_feelist();" required>
                <option value="All">All</option>
                <option value="for admission"><?php echo $language['For Admission']; ?></option>
                <option value="for job"><?php echo $language['For Job']; ?></option>
                <option value="other"><?php echo $language['Other']; ?></option>
                </select>
			</div>
		</div>
		
        <div class="col-md-2">	
         <div class="form-group" >
          <label>From Date</label>
          <input type="date" value="<?php echo date('Y-m-d'); ?>" name="from_date" id="from_date" oninput="for_feelist();" class="form-control" />
         </div>
        </div>
        
        <div class="col-md-2">	
         <div class="form-group" >
          <label>To Date</label>
          <input type="date" value="<?php echo date('Y-m-d'); ?>" name="to_date" id="to_date" oninput="for_feelist();" class="form-control" />
         </div>
        </div>
		
		</div>
		
		<div class="col-md-12 col-md-offset-3">
		
		<div class="col-md-6">	
         <div class="form-group" >
          <label>Write Your Message Here</label>
          <textarea name="message_content" class="form-control"></textarea>
         </div>
        </div>
        
        </div>
		    
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-10 col-md-offset-1" style="overflow:scroll;border:1px solid;" id="fee_details">
		
		</div>
		  
		    
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
</form>
<script>
for_feelist();
</script>