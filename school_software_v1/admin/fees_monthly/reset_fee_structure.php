<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
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
		alert('Please Select Atleast One Option !!!');
		return false;
	}
}
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
        $.ajax({
            url: access_link+"fees_monthly/reset_fee_structure_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){

               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert('Successfully Complete');
				   get_content('fees_monthly/reset_fee_structure');
            }
			}
         });
      });
</script>


      <section class="content-header">
      <h1>
        Student Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Reset Fee Structure</li>
      </ol>
      </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
	<?php
	$qry="select * from school_info_general";
	$rest=mysqli_query($conn73,$qry);
	while($row22=mysqli_fetch_assoc($rest)){
	$fees_type=$row22['fees_type'];
	}
	if($fees_type=='installmentwise'){
	$show_var='Set Fee Installments';
	}elseif($fees_type=='monthly'){
	$show_var='Set Fee Months';
	}else{
	$show_var='';
	}
	 $table_var="school_info_".$fees_type."_fees";
	?>
	
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
			    
				<div class="col-md-12">
				<div class="col-md-2">&nbsp;</div>
				<div class="col-md-8">
				<div class="col-md-8"><h2><?php echo $show_var; ?></h2></div><div class="col-md-4"><span style="color:red;float:right;"><input type="checkbox" id="info" value="" checked onclick="for_check(this.id);" /> All Check / Uncheck</span></div>
				<div class="col-md-12" style="border:1px solid;border-radius:20px;">
				<?php
			  	 $que01="select * from $table_var where session_value='$session1'$filter37 ORDER BY s_no";
				$run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
				$serial_no=0;
				$installment_var=array("01"=>"Installment1","02"=>"Installment2","03"=>"Installment3","04"=>"Installment4","05"=>"Installment5","06"=>"Installment6","07"=>"Installment7","08"=>"Installment8","09"=>"Installment9","10"=>"Installment10","11"=>"Installment11","12"=>"Installment12");
				$month_var=array("04"=>"April Month","05"=>"May Month","06"=>"June Month","07"=>"July Month","08"=>"August Month","09"=>"September Month","10"=>"October Month","11"=>"November Month","12"=>"December Month","01"=>"January Month","02"=>"February Month","03"=>"March Month");
				while($row01=mysqli_fetch_assoc($run01)){
				$s_no = $row01['s_no'];
				$fees_type_name = $row01['fees_type_name'];
				$fees_code = $row01['fees_code'];
				if($fees_type=='installmentwise'){
				?>
				<div class="col-md-3"><input type="checkbox" name="fees_type_name[]" class="info" value="<?php echo $s_no.'|?|'.$installment_var[$fees_code]; ?>" <?php if($fees_type_name!=''){ echo 'checked'; } ?> > <?php echo $installment_var[$fees_code]; ?></div>
				<?php }elseif($fees_type=='monthly'){ ?>
				<div class="col-md-3"><input type="checkbox" name="fees_type_name[]" class="info" value="<?php echo $s_no.'|?|'.$month_var[$fees_code]; ?>" <?php if($fees_type_name!=''){ echo 'checked'; } ?> > <?php echo $month_var[$fees_code]; ?></div>
				<?php } $serial_no++; } ?>
				</div>
				</div>
				<div class="col-md-2">&nbsp;</div>
				</div>
				<div class="col-md-12">
				<hr/>
				</div>
				
			</div>
				   
		<!---------------------------Start Fees Details ----------------------------------------->
		    <div class="box-body">
		    <div class="col-md-8" id="student_fee_details">
            
			</div>
			<div class="col-md-4" id="student_details">
            
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
