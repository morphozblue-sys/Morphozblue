<?php include("../attachment/session.php"); ?>
<script>
 function sales_calculation(){
   var quantity=document.getElementById("item_quantity").value;
   var rate=document.getElementById("item_sales_rate").value;
   
	if(quantity>0 && rate>0){
	var total=parseFloat(quantity)*parseFloat(rate);
	document.getElementById("total_amount").value=total;
	}else{
	document.getElementById("total_amount").value='0';
	}
 }
</script>

<script>
 function student_details(){
   var stu_name=document.getElementById("item_quantity").value;
   var stu_f_name=document.getElementById("item_sales_rate").value;
   var stu_class=document.getElementById("item_sales_rate").value;
   var stu_roll_no=document.getElementById("item_sales_rate").value;
   
	if(quantity>0 && rate>0){
	var total=parseFloat(quantity)*parseFloat(rate);
	document.getElementById("total_amount").value=total;
	}else{
	document.getElementById("total_amount").value='0';
	}
 }
</script>

<script type="text/javascript">
			function student_details(value){
			$("#student_father_name").val('Loading.....');
			$("#student_class").val('Loading.....');
			$("#student_roll_no").val('Loading.....');
			$.ajax({
			address: "POST",
			url: access_link+"stock/get_student_details.php?id="+value+"",
			cache: false,
			success: function(detail){
			var res = detail.split("|?|");
			$("#student_father_name").val(res[0]);
			$("#student_class").val(res[1]);
			$("#student_roll_no").val(res[2]);
			
			}
			});
			}
			
			 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock/sales_item_api.php",
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
				   get_content('stock/sale_list');
            }
			}
         });
      });
			</script>



   <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
             <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active"><?php echo $language['Sale Item']; ?></li>
        </ol>
    </section>

	
	
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b><?php echo $language['Sale Item']; ?></b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			<?php
			$item_s_no=$_GET['id'];
			
			$que3="select * from stock_buy_table_1 where s_no='$item_s_no' and purchase_status='Active'";
			$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
			while($row3=mysqli_fetch_assoc($run3)){
			$item_product_name=$row3['item_product_name'];
			$item_quantity=$row3['item_quantity'];
			$s_no=$row3['s_no'];
			$item_product_category=$row3['item_product_category'];
			
			$que1="select category_name from stock_category where category_status='Active' and s_no='$item_product_category'";
            $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
            $category_name='';
            while($row1=mysqli_fetch_assoc($run1)){
            $category_name=$row1['category_name'];
            }
			}
			?>
			<input type="hidden"  name="item_s_no" value="<?php echo $item_s_no; ?>"  class="form-control" readonly>
			<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Name']; ?> </label>
					  <input type="text"  name="item_product_name" value="<?php echo $item_product_name; ?>"  class="form-control" readonly>
					</div>
			</div>
			
			<div class="col-md-3">				
					<div class="form-group" >
					  <label >Category</label>
					  <input type="hidden" name="item_product_category" value="<?php echo $item_product_category; ?>" readonly class="form-control">
					  <input type="text" name="" value="<?php echo $category_name; ?>" readonly class="form-control">
					</div>
			</div>
		
			<div class="col-md-2">				
					<div class="form-group" >
					  <label ><?php echo $language['Quantity']; ?> <font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="item_quantity" placeholder="0" oninput="sales_calculation();" id="item_quantity"; value=""; class="form-control" required />
					</div>
			</div>  
				
			<div class="col-md-2">				
					<div class="form-group" >
					  <label ><?php echo $language['Rate']; ?> <font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="item_sales_rate" placeholder="0.00"  oninput="sales_calculation();" id="item_sales_rate"; value=""; class="form-control" required>
					</div>
			</div>
				
			<div class="col-md-2">				
					<div class="form-group" >
					  <label ><?php echo $language['Total Amount']; ?> <font style="color:red"><b>*</b></font> </label>
					  <input type="text"  name="total_amount" value=""  id="total_amount"; placeholder="0.00"  class="form-control" readonly />
					</div>
			</div>
			
			<br><br><br><br><br>
			
			<div class="box-header with-border ">
					<h1 class="box-title"><b>Student Details</b></h1>
            </div>
			
			<br>
			
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Student Name']; ?> <font style="color:red"><b>*</b></font></label>
						<select type="text"  name="student_name" id="student_name" onchange="student_details(this.value);" value="" class="form-control select2" style="width:100%" required>
						<option value="">Select</option>
					  
						<?php
							$que4="select * from student_admission_info where session_value='$session1' and registration_final='yes' and student_status='Active'";
							$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
							while($row4=mysqli_fetch_assoc($run4)){
							$s_no=$row4['s_no'];
							$student_name=$row4['student_name'];
							$student_class=$row4['student_class'];
							$student_class_section=$row4['student_class_section'];
							echo "<option value='".$s_no."'>".$student_name." [".$student_class." (".$student_class_section.") ]</option>";
							}
							?>
			
						</select>
					</div>
			</div>

		
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Father Name']; ?> </label>
					  <input type="text"  name="student_father_name" placeholder="Student Father Name" id="student_father_name"; value=""; class="form-control">
					</div>
			</div>  
				
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Class']; ?> </label>
					  <input type="text"  name="student_class" placeholder="Student Class"   id="student_class"; value=""; class="form-control">
					</div>
			</div>
				
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Student Roll No']; ?> </label>
					  <input type="text"  name="student_roll_no" placeholder="Student Roll No"  id="student_roll_no"; class="form-control">
					</div>
			</div>
			
		<br><br><br><br>
		<div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		</div>	
			
	</form>	

          
		  </div>
    </div>
</section>
<script>
$(function () {
    $('.select2').select2();
  });
</script>
 