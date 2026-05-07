<?php include("../attachment/session.php"); ?>
<style>
.vl {
    border-left: 6px solid green;
    height: 500px;
}
</style>

<script>
function for_valid(value,method_id){
	if(value!=''){
		$('#'+method_id).prop('required',true);
	}else{
		$('#'+method_id).prop('required',false);
	}
}

$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
        $.ajax({
            url: access_link+"fees_monthly/discount_types_edit_api.php",
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
				   get_content('fees_monthly/discount_types_list');
            }
			}
         });
      });
	  
</script>
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/discount_types_list')"><i class="fa fa-money"></i> <?php echo $language['Fees Discount Type List']; ?></a></li>
	  <li class="active"><?php echo $language['Discount Type Edit']; ?></li>
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
			
            <div class="box-body my_border_color"  >
			  <!---------------------------Start Admission form--------------------------------------->
        <!---------------------------Start Personal Details ------------------------------------->
			
		<form method="post" enctype="multipart/form-data" id="my_form">
			<?php
		    $s_no=$_GET['id'];
	        $que="select * from common_fees_discount_types_structure where s_no='$s_no'";
            $run=mysqli_query($conn73,$que);
            while($row=mysqli_fetch_assoc($run)){
			$class_code = $row['class_code'];
			$class_name = $row['class_name'];
		    }
			$que2="select * from school_info_class_info where class_code='$class_code'";
            $run2=mysqli_query($conn73,$que2);
            while($row2=mysqli_fetch_assoc($run2)){
		    $student_class_name = $row2['class_name'];
			}
		    ?>
			<div class="box-body col-lg-12" style="border:1px solid #ecedef;">
			    <div class="col-md-3">
					<div class="form-group">
					  <label><?php echo $language['Class']; ?></label>
					   <input type="text"  name="class"  placeholder="<?php echo $language['Class']; ?>"  value="<?php echo $student_class_name; ?>" class="form-control" readonly>
					   <input type="hidden" name="s_no" value="<?php echo $s_no; ?>" readonly>
					</div>
				</div>	
			</div>
		<?php
		$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
		$run1=mysqli_query($conn73,$que1);
		while($row1=mysqli_fetch_assoc($run1)){
		$fees_type_name[] = $row1['fees_type_name'];	
		$fees_code[] = $row1['fees_code'];
		$fees_count = $row1['fees_count'];
		}
		
		$que="select * from school_info_discount_types";
		$run=mysqli_query($conn73,$que);
		$serial_no=0;
		while($row=mysqli_fetch_assoc($run)){
		$discount_type = $row['discount_type'];
		$discount_code = $row['discount_code'];
		if($discount_type!=''){
		$discount_method[$serial_no]=$discount_type." Discount Method";
		$discount_amount[$serial_no]=$discount_type." Discount Amount";
		$discount_method1[$serial_no]=$discount_code."_method_month";
		$discount_amount1[$serial_no]=$discount_code."_amount_month";
		$serial_no++;
		}
		}
		$que="select * from common_fees_discount_types_structure where s_no='$s_no'";
		$run=mysqli_query($conn73,$que);
		while($row=mysqli_fetch_assoc($run)){
		for($j=0;$j<$fees_count;$j++){
		?>
		<div class="col-md-12">
		<h4 style="color:green;"><?php echo $fees_type_name[$j]; ?> Discount Details</h4>
		</div>
		<?php
		for($i=0;$i<$serial_no;$i++){
		$discount_method2[$i] = $row[$discount_method1[$i].$fees_code[$j]];
		$discount_amount2[$i] = $row[$discount_amount1[$i].$fees_code[$j]];
		?>
        <div class="box-body col-lg-4" style="border:1px solid #ecedef;">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $discount_amount[$i]; ?></label>
					<input type="text" name="<?php echo $discount_amount1[$i].$fees_code[$j] ?>" placeholder="<?php echo $discount_amount[$i]; ?>" value="<?php echo $discount_amount2[$i]; ?>" class="form-control" oninput="for_valid(this.value,'<?php echo $discount_method1[$i].$fees_code[$j]; ?>');" />
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $discount_method[$i]; ?></label>
					<select class="form-control" name="<?php echo $discount_method1[$i].$fees_code[$j] ?>" id="<?php echo $discount_method1[$i].$fees_code[$j]; ?>" <?php if($discount_amount2[$i]!=''){ echo 'required'; } ?> >
					<?php if($discount_method2[$i]==null) { ?>
					<option value="">Select Payment Method</option>
					<?php } else { ?>
					<option value="<?php echo $discount_method2[$i]; ?>"><?php echo $discount_method2[$i]; ?></option>
					<?php } ?>
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
				</div>
			</div>
		</div>		
		<?php } } } ?>

		<div class="box-body ">
		  <div class="col-md-12">
			<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn  my_background_color" /></center>
		  </div>
		</div>
				
	<!---------------------------End Personal Details ----------------------------------------->

    <!---------------------------------------------End Admission form------------------------->
		  <!-- /.box-body -->
         
		</form>	
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>