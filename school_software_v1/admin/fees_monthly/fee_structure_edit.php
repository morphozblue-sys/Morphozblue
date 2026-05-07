<?php include("../attachment/session.php"); ?>
<style>
.vl {
    border-left: 6px solid green;
    height: 500px;
}
</style>
<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    var category_code = document.getElementById('category_code').value;
window.scrollTo(0, 0);
    get_content(loader_div);
        $.ajax({
            url: access_link+"fees_monthly/fee_structure_edit_api.php",
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
				   post_content('fees_monthly/fee_structure_list', 'category_code='+category_code);
            }
			}
         });
      });
	 
function set_blank_filed(){
    $(".all_blank_field").each(function() {
	if($(this).val()=='')
	{
	 $(this).val(0);   
	}
	});
    
} 
</script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	   <li><a href="javascript:get_content('fees_monthly/fee_structure_list')"><i class="fa fa-money"></i> <?php echo $language['Fees Structure List']; ?></a></li>
	 <li class="active"><?php echo $language['Fees Structure Edit']; ?></li>
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
			
		<form method="post" enctype="multipart/form-data"  id="my_form">
			<?php

			$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			$run1=mysqli_query($conn73,$que1);
			while($row1=mysqli_fetch_assoc($run1)){
			$fees_type_name[] = $row1['fees_type_name'];	
			$fees_code[] = $row1['fees_code'];
			$fees_count = $row1['fees_count'];
			}
			
		    $s_no=$_GET['id'];
	        $que="select * from common_fees_fee_structure where session_value='$session1' and s_no='$s_no'$filter37";
            $run=mysqli_query($conn73,$que);
            while($row=mysqli_fetch_assoc($run)){
		    $student_class = $row['class_code'];
		    $total_fee = $row['total_fee'];
		    }
		    $que2="select * from school_info_class_info where class_code='$student_class'";
            $run2=mysqli_query($conn73,$que2);
            while($row2=mysqli_fetch_assoc($run2)){
		    $student_class_name = $row2['class_name'];
			}
		    ?>
			<div class="box-body col-lg-12" style="border:1px solid #ecedef;">

			    <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="student_class"  placeholder="class"  value="<?php echo $student_class_name; ?>" class="form-control" readonly>
						   <input type="hidden" name="s_no" value="<?php echo $s_no; ?>" readonly>
				        </div>
				</div>	
			    <div class="col-md-3">
						<div class="form-group">
						  <label>Total Fees/Year</label>
						   <input type="text"  name="student_total_fee_per_year" id="student_total_fee_per_year"  placeholder="Total Fee"  value="" class="form-control" readonly />
						</div>
				</div>
				<div class="col-md-3">
						&nbsp;
				</div>	
			    <div class="col-md-3">
					<span style="float:right;font-weight:bold;margin-top:30px;color:red;"><input type="checkbox" id="for_same1">Check For Same</span>
				</div>
         	
			</div>
  
		        <?php
                $que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_type = $row['fee_type'];
				$fee_code = $row['fee_code'];
				if($fee_type!=''){
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee[$serial_no]="student_".$fee_code."_month";
				$serial_no++;
				} }
				
	            echo $que="select * from common_fees_fee_structure where session_value='$session1' and s_no='$s_no'$filter37";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
                $category_code = $row['category_code'];
				for($k=0;$k<$fees_count;$k++){
				?>
				<div class="col-md-12">
				<h4 style="color:green;"><?php echo $fees_type_name[$k]; ?> Fee</h4>
				</div>
				<?php
				for($i=0;$i<$serial_no;$i++){
				$fee1[$i] = $row[$fee[$i].$fees_code[$k]];
				$text_name=$fee[$i].$fees_code[$k];
				?>
				<div class="box-body col-lg-3" style="border:1px solid #ecedef;">
					<div class="col-md-12">
						<div class="form-group">
							<label><?php echo $fees_type_name[$k].' '.$fee_type1[$i]; ?></label>
							<input type="text" name="<?php echo $text_name; ?>" placeholder="<?php echo $fee_type1[$i]; ?>" value="<?php echo $fee1[$i]; ?>" oninput="same_value(this.value,'<?php echo $i; ?>');" class="form-control <?php echo 'amt_'.$i; ?> all_blank_field " />
						</div>
					</div>
				</div>
		        <?php } } } ?>
				<div class="col-md-12">
				<hr/><input type="hidden" id="total_fee_head" value="<?php echo $serial_no; ?>" />
				<input type="hidden" id="category_code" value="<?php echo $category_code; ?>" />
				</div>
				<div class="box-body ">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn  my_background_color" /></center>
		          </div>
			    </div>
		
				<!---------------------------End Personal Details -------------------------------------->
<script>
function same_value(value,id){
if($('#for_same1').prop("checked") == true){
	$(".amt_"+id).each(function() {
	$(this).val(value);
	});
	total_fee();
}else{
	total_fee();
}
}

function total_fee(){
var head_count=document.getElementById('total_fee_head').value;
var add = 0;
for(var j=0;j<head_count;j++){
$('.amt_'+j).each(function() {
add += Number($(this).val());
});
}
document.getElementById('student_total_fee_per_year').value = add;
}
</script>
    <!---------------------------------------------End Admission form------------------------->
		  <!-- /.box-body -->
		</form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
total_fee();
$(function(){
 set_blank_filed();
})
</script>