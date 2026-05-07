<?php include("../attachment/session.php"); ?>

<script>
function for_fee(){
var student_old_new=document.getElementById('student_old_new').value;
var student_class=document.getElementById('student_class').value;
if(student_old_new!='' && student_class!=''){
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_get_classwise_fee.php?old_new="+student_old_new+"&student_class="+student_class+"",
	  cache: false,
	  success: function(detail){
		var str =detail;
		var res = str.split("||");
		$("#student_admission_fee").val(res[0]);
		$("#click").click();
	    }
    });
}
}
</script>

<script>
// function discount_type1(value,count,class_code,fees_code){

	// if(value!='None'){		
	// $.ajax({
		  // type: "POST",
		  // url: access_link+"fees_monthly/ajax_discount.php?id="+value+"&student_class_code="+class_code+"&fees_code="+fees_code+"",
		  // cache: false,
		  // success: function(detail){
		  // var res = detail.split("|?|");
		  // $("#discount_method_"+count).val(res[2]);
	      // $("#discount_amount_"+count).val(res[1]);
	      // $("#click_"+count).click();
		  // }
	   // });
	   // }else{
	   // $("#discount_method_"+count).val('%');
	   // $("#discount_amount_"+count).val('0');
	   // $("#click_"+count).click();
	   // }
	   
// }
	
function for_total(value,count){
	  
	  var discount_amount=document.getElementById('discount_amount_'+count).value;
	  var discount_method=document.getElementById('discount_method_'+count).value;
	  var amount=document.getElementById('fee_type_'+count).value;
	  var paid_amt=document.getElementById('fee_paid11_'+count).value;
	  if(discount_amount>0){
	  if(discount_method=='%'){
	  var aft_disc_amount=parseFloat(amount)-parseFloat(parseFloat(amount)*parseFloat(discount_amount))/100;
	  $("#after_discount_amount_"+count).val(aft_disc_amount);
	  $("#balance_per_year_"+count).val(aft_disc_amount);
	  var min_val=parseFloat(paid_amt)+(parseFloat(amount)-parseFloat(aft_disc_amount));
	  $("#fee_type_"+count).prop('min',min_val);
	  }else if(discount_method=='Rs'){
	  var aft_disc_amount=parseFloat(amount)-parseFloat(discount_amount);
	  $("#after_discount_amount_"+count).val(aft_disc_amount);
	  $("#balance_per_year_"+count).val(aft_disc_amount);
	  var min_val=parseFloat(paid_amt)+(parseFloat(amount)-parseFloat(aft_disc_amount));
	  $("#fee_type_"+count).prop('min',min_val);
	  }
	  }else{
	  $("#after_discount_amount_"+count).val(amount);
	  $("#balance_per_year_"+count).val(amount);
	  $("#fee_type_"+count).prop('min',paid_amt);
	  }
	  if(value=='yes'){
	   var add1 = 0;
	  $('.amt').each(function() {
	  add1 += Number($(this).val());
	  });
	  document.getElementById('grand_total1').value = add1;
	  }else if(value=='no'){
	  var add = 0;
	  $('.fee').each(function() {
	  add += Number($(this).val());
	  });
	  document.getElementById('grand_total').value = add;
	  }

}
	
function month_total(month){
	var add = 0;
	$('.fee_amount_'+month).each(function() {
	add += Number($(this).val());
	});
	$('#total_month_'+month).html('Total Fee : '+add);
	var add1 = 0;
	$('.balance_amount_'+month).each(function() {
	add1 += Number($(this).val());
	});
	$('#balance_month_'+month).html('Total Balance : '+add1);
	var add2 = 0;
	$('.fee_paid_'+month).each(function() {
	add2 += Number($(this).val());
	});
	$('#paid_month_'+month).html('Total Paid : '+add2);
}

function for_same(id,class_name,clk_btn_cls,btn_id,chk_id){
	if($('#'+chk_id).prop("checked") == true){
		var all_val = document.getElementById(id).value;
		$("."+class_name).each(function(){
		$(this).val(all_val);
		});
		$("."+clk_btn_cls).each(function(){
		$(this).click();
		});
	}else{
		$('#'+btn_id).click();
	}
}
</script>	
<script>
  $(function(){
          var add = 0;
		  $('.fee').each(function() {
		  add += Number($(this).val());
          document.getElementById('grand_total').value = add;
    });
	});
	
	$(function(){
          var add1 = 0;
		  $('.amt').each(function() {
		  add += Number($(this).val());
          document.getElementById('grand_total1').value = add;
    });
	});
	
	function transport_total(value){
		if(value=='yes'){
		var add1 = 0;
		$('.amt').each(function() {
		add1 += Number($(this).val());
		});
		document.getElementById('grand_total1').value = add1;
		}else if(value=='no'){
		var add = 0;
		$('.fee').each(function() {
		add += Number($(this).val());
		});
		document.getElementById('grand_total').value = add;
		}
	}
	
	function with_admission(val){
	$('#click_'+val).click();
	}


    $(function(){
            var id=document.getElementById('student_class').value;			
            var section_hidden=document.getElementById('student_class_section_hidden').value;			
       $.ajax({
			  type: "POST",
              url: access_link+"fees_monthly/ajax_class_section_hidden.php?class_name="+id+"&section_hidden="+section_hidden+"",
              cache: false,
              success: function(detail){
                  $("#student_class_section").html(detail);
              }
           });

    });	
	
$("#my_form").submit(function(e){
	e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
	$.ajax({
		url: access_link+"fees_monthly/set_fee_details_api.php",
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
			   get_content('fees_monthly/student_admission_fee_list');
		}
		}
	 });
  });
  
function reset_fee(student_roll_no){
window.scrollTo(0, 0);
    get_content(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/reset_fee_details_api.php?student_roll_no="+student_roll_no+"",
	  cache: false,
	  success: function(detail){
		var res=detail.split("|?|");
		if(res[1]=='success'){
		alert('Reset Successfully');
		post_content('fees_monthly/set_fee_details',"student_roll_no="+student_roll_no);
		}
	  }
   });
   
}
</script>

    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Student Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/student_admission_fee_list')"><i class="fa fa-money"></i> Student Admission Fee List</a></li>
	  <li class="active">Set Student Fee Details</li>
      </ol>
      </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	<?php	
	$student_roll_no=$_GET['student_roll_no'];	
	$que="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$stuent_old_or_new=$row['stuent_old_or_new'];
	$student_bus=$row['student_bus'];
	$student_bus_fee_category_code=$row['student_bus_fee_category_code'];
	$student_fee_category_code=$row['student_fee_category_code'];
	}
	$que125="select * from school_info_class_info where class_name='$student_class'";
    $run125=mysqli_query($conn73,$que125);
    while($row125=mysqli_fetch_assoc($run125)){
    $class_code=$row125['class_code'];
    }
	$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
	$run01=mysqli_query($conn73,$que01);
	while($row01=mysqli_fetch_assoc($run01)){
	$fees_type_name[] = $row01['fees_type_name'];	
	$fees_code[] = $row01['fees_code'];
	$fees_count = $row01['fees_count'];
	}
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
			    <div class="col-md-3">
					<div class="form-group">
					  <label>Student Name</label>
					   <input type="text"  name="student_name"  placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly>
					</div>
				</div>
				 <div class="col-md-3">
						<div class="form-group">
						  <label>Father Name</label>
						   <input type="text"  name="father_name"  placeholder="Father Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly>
						</div>
				 </div>
				<div class="col-md-2">
						<div class="form-group">
						  <label>Class</label>
						   <input type="text"  name="student_class"  placeholder="Class"  value="<?php echo $student_class; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-2">
						<div class="form-group">
						  <label>Section</label>
						   <input type="text"  name="student_class_section"  placeholder="Section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					<label>&nbsp;</label>
		            <center><button type="button" value="Reset Fee" onclick="reset_fee('<?php echo $student_roll_no; ?>');" class="btn  my_background_color" >Reset Fee</button></center>
		          </div>
			    </div>
				
			</div>
				   
		<!---------------------------Start Fees Details ----------------------------------------->
		    <div class="box-body">
			<div class="col-md-4"><h3 style="color:#d9534f;"><b>Fees Details:</b></h3></div>
			<div class="col-md-3" style="float:right;"><span style="color:red;"><input type="checkbox" name="" id="check_for_same" value="" />&nbsp;&nbsp;&nbsp;<b>Check For Same Discount</b></span></div>
			<div class="col-md-3" style="float:right;"><span style="color:red;"><input type="checkbox" name="" id="head_same" value="" />&nbsp;&nbsp;&nbsp;<b>Check For Same Fee</b></span></div>
            <?php
                
                $que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73)) ;
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$fee_type = $row['fee_type'];
				$fee_code = $row['fee_code'];
				if($fee_type!=''){
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee_code1[$serial_no] = $row['fee_code'];
				$fee_type=strtolower($fee_type);
				$fee[$serial_no]="student_".$fee_code."_month";
				$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
				$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
				$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
				$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
				$serial_no++;
	            } }
			    $que5="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
				$run1=mysqli_query($conn73,$que5);
				if(mysqli_num_rows($run1)<1){
				$quer11232="insert into common_fees_student_fee(student_class,student_name,student_roll_no,session_value,$update_by_insert_sql_column)values('$student_class','$student_name','$student_roll_no','$session1',$update_by_insert_sql_value)";
                mysqli_query($conn73,$quer11232);
				$que5="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
				$run1=mysqli_query($conn73,$que5);
				}
                while($row=mysqli_fetch_assoc($run1)){
				$s_no=$row['s_no'];
				$fee_status = $row['fee_status'];
				$balance_total = $row['balance_total'];
				$paid_total = $row['paid_total'];
				}
				$transport_amount=0;
				if($fee_status=='Active'){
				$que="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
				$total_fee=0;
				$grand_total = $row['grand_total'];
				$student_transport_fee = $row['student_transport_fee'];
				$student_transport_fee_paid_total = $row['student_transport_fee_paid_total'];
				
				$student_previous_year_fee = $row['student_previous_year_fee'];
				$student_previous_year_fee_paid_total = $row['student_previous_year_fee_paid_total'];
				
				$coun=0;
				$d=0;
					for($a=0;$a<$fees_count;$a++){
					?>
					<div class="col-md-12">
					<div class="col-md-12">
					<h4 style="color:green;"><?php echo $fees_type_name[$a]; ?> Fee Set</h4>
					</div>
					<?php
					$show_total_fee=0;
					$show_paid_fee=0;
					$show_balance_fee=0;
					for($i=0;$i<$serial_no;$i++){
					
					    $coun++;
						$d=$d+1;
				        $fee1[$i] = $row[$fee[$i].$fees_code[$a]];
				        $fee_discount_type1[$i] = $row[$fee_discount_type[$i].$fees_code[$a]];
				        $fee_discount_method1[$i] = $row[$fee_discount_method[$i].$fees_code[$a]];
				        $fee_discount_amount1[$i] = $row[$fee_discount_amount[$i].$fees_code[$a]];
				        $total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i].$fees_code[$a]];
				        $fee_balance1[$i] = $row[$fee_balance[$i].$fees_code[$a]];
						$fee_paid1[$i] = $row[$fee_paid[$i].$fees_code[$a]];
						
						$show_total_fee=$show_total_fee+$total_amount_after_discount1[$i];
						$show_paid_fee=$show_paid_fee+$fee_paid1[$i];
						$show_balance_fee=$show_balance_fee+$fee_balance1[$i];
	
						$total_fee= $total_fee+$total_amount_after_discount1[$i];
						?>
				<div class="col-md-12">				
				<div class="col-md-2">				
				<div class="form-group">
                  <label ><?php echo $fee_type1[$i];?></label>
                  <input type="number" name="<?php echo $fee[$i].$fees_code[$a];?>" placeholder="<?php echo $fee_type1[$i];?>" step="1" min="<?php echo $fee_paid1[$i]+($fee1[$i]-$total_amount_after_discount1[$i]); ?>" value="<?php echo $fee1[$i];?>" id="<?php echo "fee_type_".$d;?>" class="form-control fee <?php echo 'third_'.$i; ?>" oninput="for_same(this.id,'<?php echo 'third_'.$i; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','head_same');"/>
                </div>
				</div>
				<div class="col-md-2">				
				<div class="form-group">
					<input type="hidden" value="<?php echo $student_class; ?> " id="student_class" />
					<input type="hidden" value="<?php //echo $student_old_new; ?> " id="student_old_new" />
                    <label >Discount Type</label>
				    <select name="<?php echo $fee_discount_type[$i].$fees_code[$a];?>" id="<?php echo "disc_type_".$d;?>" onchange="for_same(this.id,'<?php echo 'disc_type_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');" class="form-control <?php echo 'disc_type_'.$fee_code1[$i]; ?>">
				    <option value="<?php echo $fee_discount_type1[$i]; ?>"><?php echo $fee_discount_type1[$i]; ?></option>
					<option value="None">None</option>
				  <?php
				$que1="select discount_type from school_info_discount_types where discount_type!=''";
                $run1=mysqli_query($conn73,$que1);
                while($row1=mysqli_fetch_assoc($run1)){
				$discount_type = $row1['discount_type'];
				?>
				<option value="<?php echo $discount_type; ?>"><?php echo $discount_type; ?></option>
			    <?php } ?>
			    </select>				 
                </div>
				</div>
				<div class="col-md-2">				
                  <label >Discount Amount</label>
				  <div class="input-group">
				    <input type="hidden" id="<?php echo "click_".$d; ?>" class="<?php echo 'clk_btn_'.$fee_code1[$i]; ?>" value="yes" onclick="for_total('yes','<?php echo $d; ?>');month_total('<?php echo $fees_code[$a]; ?>');">
					<input type="text" name="<?php echo $fee_discount_amount[$i].$fees_code[$a];?>" id="<?php echo "discount_amount_".$d;?>" value="<?php echo $fee_discount_amount1[$i]; ?>" class="form-control <?php echo 'disc_amt_'.$fee_code1[$i]; ?>" oninput="for_same(this.id,'<?php echo 'disc_amt_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');" />
					<span class="input-group-addon" style="padding:0px;">
					<select name="<?php echo $fee_discount_method[$i].$fees_code[$a];?>" id="<?php echo "discount_method_".$d;?>" style="border:none;" class="<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>" onchange="for_same(this.id,'<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');">
					<option value="<?php echo $fee_discount_method1[$i]; ?>"><?php echo $fee_discount_method1[$i]; ?></option>
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
					</span>
				 </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small>Total Amount After Discount</small></label>
                  <input type="text" name="<?php echo $total_amount_after_discount[$i].$fees_code[$a];?>" placeholder="" value="<?php echo $total_amount_after_discount1[$i]; ?>" id="<?php echo "after_discount_amount_".$d; ?>" class="form-control amt <?php echo "fee_amount_".$fees_code[$a]; ?>" readonly />
                </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Balance</small></label>
                  <input type="text" name="<?php echo $fee_balance[$i].$fees_code[$a];?>" placeholder="0" value="<?php echo $fee_balance1[$i]; ?>" id="" class="form-control <?php echo "balance_amount_".$fees_code[$a]; ?>" readonly />
                </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Paid Amount</small></label>
                  <input type="text" name="<?php echo $fee_paid[$i].$fees_code[$a];?>" value="<?php echo $fee_paid1[$i]; ?>" placeholder="0" id="<?php echo "fee_paid11_".$d; ?>" class="form-control <?php echo "fee_paid_".$fees_code[$a]; ?>" readonly />
                </div>
				</div>
				</div>		
				<?php } ?>
				<div class="col-md-12" style="border:1px solid;border-radius:20px;">
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'total_month_'.$fees_code[$a] ?>">Total Fee : <?php echo $show_total_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'balance_month_'.$fees_code[$a] ?>">Total Balance : <?php echo $show_balance_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'paid_month_'.$fees_code[$a] ?>">Total Paid : <?php echo $show_paid_fee; ?></h4></center>
				</div>
				</div>
				</div>
				<?php } } ?>
				<div class="col-md-12">
				<div class="col-md-3">				
				<div class="form-group">
                  &nbsp;
                </div>
				</div>
				
				<div class="col-md-3">
				<div class="form-group">
                  <label>Previous Dues Fee</label>
                  <input type="number" name="student_previous_year_fee" placeholder="0" step="1" min="<?php echo $student_previous_year_fee_paid_total; ?>" oninput="transport_total('yes');" value="<?php echo $student_previous_year_fee; ?>" id="student_previous_year_fee" class="form-control amt" />
				  <input type="hidden" name="student_previous_year_fee_paid" placeholder="0" value="<?php echo $student_previous_year_fee_paid_total; ?>" id="student_previous_year_fee_paid" class="form-control" readonly />
                </div>
				</div>
				
				<?php if($student_bus=='Yes' && $student_bus_fee_category_code!='' && !in_array('Transport Amount', $fee_type1) && !in_array('Transport Fee', $fee_type1) && !in_array('Bus Amount', $fee_type1) && !in_array('Bus Fee', $fee_type1)){ ?>
				<div class="col-md-3">				
				<div class="form-group">
                  <label>Transport Fee</label>
				  <?php
				  $select_tran_column=$class_code."_amount";
				  $que0125="select $select_tran_column from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code'";
				  $run0125=mysqli_query($conn73,$que0125);
				  while($row0125=mysqli_fetch_assoc($run0125)){
				  $transport_amount=$row0125[$select_tran_column];
				  }
				  ?>
                  <input type="number" name="student_transport_fee" placeholder="0" step="1" min="<?php echo $student_transport_fee_paid_total; ?>" oninput="transport_total('yes');" value="<?php echo $student_transport_fee; ?>" id="student_transport_fee" class="form-control amt" />
				  <input type="hidden" name="student_transport_fee_paid" placeholder="0" value="<?php echo $student_transport_fee_paid_total; ?>" id="student_transport_fee_paid" class="form-control" readonly />
                </div>
				</div>
				<?php }else{ $student_transport_fee=0; ?>
				<div class="col-md-3">				
				<div class="form-group">
                  <input type="hidden" name="student_transport_fee" placeholder="0" value="<?php echo $student_transport_fee; ?>" id="student_transport_fee" class="form-control" readonly />
				  <input type="hidden" name="student_transport_fee_paid" placeholder="0" value="0" id="student_transport_fee_paid" class="form-control" readonly />
                </div>
				</div>
				<?php } ?>
				
				<div class="col-md-3">				
				<div class="form-group">
                  <label>Grand Total</label>
                  <input type="text" name="grand_total" placeholder="0" value="<?php echo $grand_total; ?>" id="grand_total1" class="form-control" readonly />
				  <input type="hidden" name="paid_total" value="<?php echo $paid_total; ?>" readonly />
                </div>
				</div>
				
				</div>
				<?php } else {
				
				$exp_session=explode('_',$session1);
                $exp_session1=$exp_session[0]-1;
                $exp_session2=$exp_session[1]-1;
                $session22=$exp_session1.'_'.$exp_session2;
                
                //$que001="select * from common_fees_student_fee_add where student_roll_no='$student_roll_no' and session_value='$session22' and fee_status='Active'";
                //$total_discount_amount=0;
                //$run001=mysqli_query($conn73,$que001) or die(mysqli_error($conn73)) ;
                //while($row001=mysqli_fetch_assoc($run001)){
				//$total_discount_amount=$total_discount_amount+$row001['blank_field_2'];
                //}
                
                $que00="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session22' and fee_status='Active'";
                $student_previous_year_fee=0;
                $run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73)) ;
                while($row00=mysqli_fetch_assoc($run00)){
				$student_previous_year_fee=$row00['balance_total'];
                }
                //$student_previous_year_fee=$student_previous_year_fee-$total_discount_amount;
				
				$que3="select * from school_info_class_info where class_name='$student_class'";
                $run3=mysqli_query($conn73,$que3)or die(mysqli_error($conn73));
                while($row3=mysqli_fetch_assoc($run3)){
				$student_class_code=$row3['class_code'];
				}
				$que="select * from common_fees_fee_structure where session_value='$session1' and class_code='$student_class_code' and category_code='$student_fee_category_code'$filter37";
                $run=mysqli_query($conn73,$que)or die(mysqli_error($conn73));
				$serial_no1=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$total_fee=0;
				$serial_no1++;
				
				?>
	
				 <?php
				 $coun=0;
				 $d=0;
				 for($b=0;$b<$fees_count;$b++){
				 ?>
				 <div class="col-md-12">
				 <div class="col-md-12">
				 <h4 style="color:green;"><?php echo $fees_type_name[$b]; ?> Fee Set</h4>
				 </div>
				 <?php
				 $show_total_fee=0;
				 $show_paid_fee=0;
				 $show_balance_fee=0;
				 for($i=0;$i<$serial_no;$i++){
				 
				 if($student_bus=='Yes' && $student_bus_fee_category_code!='' && ((substr_count($fee_type1[$i], 'Transport')>0) || (substr_count($fee_type1[$i], 'Bus')>0))){
                 $sel_col=$student_class_code.'_amount_month'.$fees_code[$b];
                 $que_3="select $sel_col from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code'";
                 $run_3=mysqli_query($conn73,$que_3) or die(mysqli_error($conn73));
                 while($row_3=mysqli_fetch_assoc($run_3)){
                 $installmentwise_amount = $row_3[$sel_col];
                 }
                 
				 $fee1[$i] = $installmentwise_amount;
				 $total_fee= $total_fee+$fee1[$i];
				 
				 $show_total_fee=$show_total_fee+$fee1[$i];
				 $show_balance_fee=$show_balance_fee+$fee1[$i];
				 }else{
				 $fee1[$i] = $row[$fee[$i].$fees_code[$b]];
				 $total_fee= $total_fee+$fee1[$i];
				 
				 $show_total_fee=$show_total_fee+$fee1[$i];
				 $show_balance_fee=$show_balance_fee+$fee1[$i];
				 }
				 
				 $coun=$coun+1;
				 $d=$d+1;
				 ?>
				<div class="col-md-12">
				<div class="col-md-2">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?></label>
                  <input type="text"  name="<?php echo $fee[$i].$fees_code[$b];?>" placeholder="<?php echo $fee_type1[$i];?>" value="<?php echo $fee1[$i];?>" id="<?php echo "fee_type_".$d;?>" class="form-control <?php echo 'third_'.$i; ?>" oninput="for_same(this.id,'<?php echo 'third_'.$i; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','head_same');" />
                </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
				<input type="hidden" value="<?php echo $student_class; ?>" id="student_class" />
                  <label>Discount Type</label>
				   <select name="<?php echo $fee_discount_type[$i].$fees_code[$b];?>" id="<?php echo "disc_type_".$d;?>" onchange="for_same(this.id,'<?php echo 'disc_type_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');" class="form-control <?php echo 'disc_type_'.$fee_code1[$i]; ?>" required>
				    <option value="None">None</option>
				<?php
				$que2="select discount_type from school_info_discount_types where discount_type!=''";
                $run2=mysqli_query($conn73,$que2);
                while($row2=mysqli_fetch_assoc($run2)){
				$discount_type = $row2['discount_type'];
				?>
				<option value="<?php echo $discount_type; ?>"><?php echo $discount_type; ?></option>
			    <?php } ?>
				</select>			 
                </div>
				</div>
				
				<div class="col-md-2">				
                <label>Discount Amount</label>
				<div class="input-group">
					<input type="hidden" id="<?php echo "click_".$d; ?>" class="<?php echo 'clk_btn_'.$fee_code1[$i]; ?>" value="no" onclick="for_total('no','<?php echo $d; ?>');month_total('<?php echo $fees_code[$b]; ?>');">
					<input type="text" name="<?php echo $fee_discount_amount[$i].$fees_code[$b];?>" id="<?php echo "discount_amount_".$d;?>" value="0" class="form-control <?php echo 'disc_amt_'.$fee_code1[$i]; ?>" oninput="for_same(this.id,'<?php echo 'disc_amt_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');" />
					<span class="input-group-addon" style="padding:0px;">
					<select name="<?php echo $fee_discount_method[$i].$fees_code[$b];?>" id="<?php echo "discount_method_".$d;?>" style="border:none;" class="<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>" onchange="for_same(this.id,'<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>','check_for_same');">
					<option value="%">%</option>
					<option value="Rs">Rs</option>
					</select>
					</span>
				</div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small>Total Amount After Discount</small></label>
                  <input type="text"  name="<?php echo $total_amount_after_discount[$i].$fees_code[$b];?>" placeholder="0"  value="<?php echo $fee1[$i]; ?>" id="<?php echo "after_discount_amount_".$d; ?>" class="form-control fee <?php echo "fee_amount_".$fees_code[$b]; ?>" readonly />
                </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Balance</small></label>
                  <input type="text" name="<?php echo $fee_balance[$i].$fees_code[$b];?>" placeholder="0"  value="<?php echo $fee1[$i]; ?>" id="<?php echo "balance_per_year_".$d; ?>" class="form-control <?php echo "balance_amount_".$fees_code[$b]; ?>" readonly />
                </div>
				</div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Paid Amount</small></label>
                  <input type="text" name="<?php echo $fee_paid[$i].$fees_code[$b];?>" value="0" placeholder="0" id="<?php echo "fee_paid11_".$d; ?>" class="form-control <?php echo "fee_paid_".$d; ?>" readonly />
                </div>
				</div>
				</div>
		
				<?php } ?>
				<div class="col-md-12" style="border:1px solid;border-radius:20px;">
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'total_month_'.$fees_code[$b] ?>">Total Fee : <?php echo $show_total_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'balance_month_'.$fees_code[$b] ?>">Total Balance : <?php echo $show_balance_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;" id="<?php echo 'paid_month_'.$fees_code[$b] ?>">Total Paid : <?php echo $show_paid_fee; ?></h4></center>
				</div>
				</div>
                </div>
				<?php } } ?>
				<div class="col-md-12">
				<div class="col-md-3">
				<div class="form-group">
                  &nbsp;
                </div>
				</div>
				
				<div class="col-md-3">
				<div class="form-group">
                  <label>Previous Dues Fee</label>
                  <input type="text" name="student_previous_year_fee" placeholder="0" oninput="transport_total('no');" value="<?php echo $student_previous_year_fee; ?>" id="student_previous_year_fee" class="form-control fee" />
				  <input type="hidden" name="student_previous_year_fee_paid" placeholder="0" value="0" id="student_previous_year_fee_paid" class="form-control" readonly />
                </div>
				</div>
				
				<?php if($student_bus=='Yes' && $student_bus_fee_category_code!='' && !in_array('Transport Amount', $fee_type1) && !in_array('Transport Fee', $fee_type1) && !in_array('Bus Amount', $fee_type1) && !in_array('Bus Fee', $fee_type1)){ ?>
				<div class="col-md-3">				
				<div class="form-group">
                  <label>Transport Fee</label>
				  <?php
				  $select_tran_column=$student_class_code."_amount";
				  $que0125="select $select_tran_column from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code'";
				  $run0125=mysqli_query($conn73,$que0125);
				  while($row0125=mysqli_fetch_assoc($run0125)){
				  $transport_amount=$row0125[$select_tran_column];
				  }
				  ?>
                  <input type="text" name="student_transport_fee" placeholder="0" oninput="transport_total('no');" value="<?php echo $transport_amount; ?>" id="student_transport_fee" class="form-control fee" />
				  <input type="hidden" name="student_transport_fee_paid" placeholder="0" value="0" id="student_transport_fee_paid" class="form-control" readonly />
                </div>
				</div>
				<?php }else{ $transport_amount=0; ?>
				<div class="col-md-3">				
				<div class="form-group">
                  <input type="hidden" name="student_transport_fee" placeholder="0" value="<?php echo $transport_amount; ?>" id="student_transport_fee" class="form-control" readonly />
				  <input type="hidden" name="student_transport_fee_paid" placeholder="0" value="0" id="student_transport_fee_paid" class="form-control" readonly />
                </div>
				</div>
				<?php } ?>
				
			    <div class="col-md-3">				
				<div class="form-group">
                  <label>Grand Total</label>
                  <input type="text" name="grand_total" placeholder="0"  value="<?php echo $total_fee+$student_previous_year_fee+$transport_amount; ?>" id="grand_total" class="form-control" readonly />
				  <input type="hidden" name="paid_total" value="0" readonly />
                </div>
				</div>
				
				</div>
				<?php } ?>

				<div class="box-body ">
			       <div class="col-md-12">
				   <input type="hidden" name="student_roll_no" value="<?php echo $student_roll_no; ?>" readonly />
		            <center><input type="submit" name="finish" value="Save" class="btn  my_background_color" /></center>
		          </div>
			    </div>
				
			</div>
		<!---------------------------End Fees Details ----------------------------------------->		   
			</div>
			</br></br>
              <!---------------------------End Document Upload ----------------------------------------->

    <!---------------------------------------------End Admission form------------------------->
		  <!-- /.box-body -->
         
		</form>	
<div id="mypdf_view">
			<div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>