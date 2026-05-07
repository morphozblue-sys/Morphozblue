<?php include("../attachment/session.php"); ?>

<script>
function for_total(serial){
	var add = 0;
	$('.fee1_'+serial).each(function() {
	add += Number($(this).val());
	});
	$('#total_amount_'+serial).val(add);
}

function for_section(value){
   $('#student_class_section').html("<option value='' >Loading....</option>");
   $.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/ajax_classwise_section_all.php?class_name="+value+"",
		  cache: false,
		  success: function(detail){
			$("#student_class_section").html(detail);
			for_feedetails();
		  }
	   });
}

function for_feedetails(){
    $("#student_fee_details").html(loader_div);
   var class_name=document.getElementById('student_class').value;
   var student_class_stream=document.getElementById('student_class_stream').value;
   var transport_fee_head=document.getElementById('transport_fee_head').value;
   var student_class_section=document.getElementById('student_class_section').value;
   if(class_name!='' && student_class_stream!='' && student_class_section!=''){
     
        if ($("#transport_fee_head").prop('checked')){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_set_classwise_monthly_transport_fee_details.php?class_name="+class_name+"&student_class_stream="+student_class_stream+"&student_class_section="+student_class_section+"&transport_fee_head="+transport_fee_head+"",
	  cache: false,
	  success: function(detail){
		$("#student_fee_details").html(detail);
	  }
   });
   }else{
       
       alert_new("Please Checked Transport Fees Head","Red");
       
        $("#student_fee_details").html('');
	  
   }
   }else{
        $("#student_fee_details").html('');
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
	var add2=0;
	$(".my_head").each(function() {
	if($(this).prop('checked')==true){
		add2 = parseInt(add2+1);
	}
	});
	if(add1>0 && add2>0){
		return true;
	}else{
		alert('Please Select Atleast One Fee Head And One Student !!!');
		return false;
	}
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
$.ajax({
	url: access_link+"fees_monthly/set_classwise_monthly_transport_fee_details_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	   //alert(detail);
	   // $("#student_fee_details").html(detail);
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
		   alert('Successfully Complete');
		   get_content('fees_monthly/set_classwise_monthly_transport_fee_details');
	}
	}
 });
});

</script>

    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Set Transport Fees</li>
      </ol>
      </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			  <!---------------------------Start Admission form--------------------------------------->
        <!---------------------------Start Personal Details ------------------------------------->
			
		<form method="post" enctype="multipart/form-data" id="my_form">
		
            <div class="box-body">
            <div class="col-md-6 col-md-offset-3">
			    
				<div class="col-md-4">
						<div class="form-group">
						  <label>Select Class</label>
						   <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
						   <option value="">Select</option>
						   <?php
						   $class37=$_SESSION['class_name37'];
						   $class371=explode('|?|',$class37);
						   $total_class=$_SESSION['class_total37'];
				           for($q=0;$q<$total_class;$q++){
                           $class_name=$class371[$q]; ?>
						   <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					       <?php } ?>
						   </select>
						</div>
				</div>
				<div class="col-md-4">				
					<div class="form-group">
					  <label>Class Stream</label>
					    <select class="form-control select2" name="student_class_stream" id="student_class_stream" style="width:100%;" onchange="for_feedetails();">
					           <option value="All">All</option>
						       <?php
								$query19="select * from school_info_stream_info where stream_name!=''";
								$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
								while($row=mysqli_fetch_assoc($run19)){
								$stream_name=$row['stream_name'];
								$student_class_stream_code=$row['stream_code'];
								?>
								<option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
								<?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
						  <label>Section</label>
						  <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feedetails();" required>
						  <option value="All">All</option>
						  </select>
						</div>
				</div>
				
				<div class="col-md-12">
<?php
$que="select fee_type,fee_code from school_info_fee_types where fee_type!='' and session_value='$session1' and (fee_type like '%Transport%' || fee_type like '%Bus%')$filter37";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

$fee_type = $row['fee_type'];
$fee_code = $row['fee_code'];
if((substr_count($fee_type, 'Transport')>0) || (substr_count($fee_type, 'Bus')>0)){
?>

<center>
<input type="checkbox" name="transport_fee_head" id="transport_fee_head" class="my_head" value="<?php echo $fee_code; ?>" onclick="for_feedetails()" > <?php echo $fee_type; ?>
</center>
<?php } } ?>
				</div>
				
				<div class="col-md-12">
				<hr/>
				</div>
				
			</div>
			</div>
				   
		<!---------------------------Start Fees Details ----------------------------------------->
		    <div class="box-body">
		    <div class="col-md-12" id="student_fee_details" style="overflow-x: auto;">
            
			</div>
			<div class="box-body ">
			<div class="col-md-12">
			<center><input type="submit" name="finish" value="Save Fee" onclick="return validate();" class="btn  my_background_color" /></center>
			</div>
			</div>
			</div>
		<!---------------------------End Fees Details ----------------------------------------->		   
			</div>
              <!---------------------------End Document Upload ----------------------------------------->

    <!---------------------------------------------End Admission form------------------------->
		  <!-- /.box-body -->
         
		</form>	

    </div>
</section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>