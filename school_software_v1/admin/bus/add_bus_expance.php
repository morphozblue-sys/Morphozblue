<?php include("../attachment/session.php"); ?>
<script>
	function valid(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	delete_fee(s_no);
	}
	else  {
	return false;
	}
	}
	
	function delete_fee(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"bus/bus_expense_delete.php?s_no="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('bus/add_bus_expance');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	</script>
<script>
function for_detail(value){
    if(value!=''){
        var res=value.split('|?|');
        $('#bus_company').val(res[1]);
        $('#bus_model_no').val(res[2]);
        $('#bus_no').val(res[3]);
    }else{
        $('#bus_company').val('');
        $('#bus_model_no').val('');
        $('#bus_no').val('');
    }
}

	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/add_bus_expense_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			 //   alert
			 //console.log(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('bus/add_bus_expance');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
        Bus Management
		    <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active">Add Bus Expense</li>
      </ol>
    </section>

<?php
$table_exists="SELECT * FROM INFORMATION_SCHEMA.bus_expense";
if(!mysqli_query($conn73,$table_exists)){
$creat_table="CREATE TABLE `bus_expense` (`s_no` int(11) NOT NULL,`bus_id` varchar(50) NOT NULL,`expense_remark` varchar(200) NOT NULL,`expense_amount` varchar(50) NOT NULL,`date` date NOT NULL,`update_change` varchar(50) NOT NULL,`last_updated_date` varchar(20) NOT NULL)";
mysqli_query($conn73,$creat_table);
$update_table="ALTER TABLE `bus_expense` ADD PRIMARY KEY (`s_no`);";
mysqli_query($conn73,$update_table);
$update_table1="ALTER TABLE `bus_expense` MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($conn73,$update_table1);
}

if(isset($_GET['bus_expanse_s_no'])){
    $bus_expanse_s_no=$_GET['bus_expanse_s_no'];
    $que11="select * from bus_expense where s_no='$bus_expanse_s_no'";
    $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
    while($row11=mysqli_fetch_assoc($run11)){
    $expanse_bus_id = $row11['bus_id'];
    $expense_remark = $row11['expense_remark'];
    $expense_amount = $row11['expense_amount'];
    $maintainance_date = $row11['maintainance_date'];
    $garage_shop = $row11['garage_shop'];
    $bill_date = $row11['bill_date'];
    $date = $row11['date'];
    $bus_reading = $row11['bus_reading'];
    }
    $que12="select * from bus_details where bus_id='$expanse_bus_id'";
    $run12=mysqli_query($conn73,$que12) or die(mysqli_error($conn73));
    while($row12=mysqli_fetch_assoc($run12)){
    $expense_bus_company = $row12['bus_company'];
    $expense_bus_model_no = $row12['bus_model_no'];
    $expense_bus_no = $row12['bus_no'];
    }
}else{
    $expanse_bus_id = '';
    $expense_remark = '';
    $expense_amount = '';
    $expense_bus_company = '';
    $expense_bus_model_no = '';
    $expense_bus_no = '';
    $maintainance_date = date('Y-m-d');
    $garage_shop = '';
    $bill_date = date('Y-m-d');
    $date = date('Y-m-d');
    $bus_reading = '';
}
?>
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Add Bus Expense</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body ">
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			      <div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Name <font style="color:red"><b>*</b></font></label>
                   <select class="form-control" name="bus_name" id="bus_name" onchange="for_detail(this.value);" required>
				 <option value="">Select</option>
				 <?php
					$que="select * from bus_details";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
                    $bus_name = $row['bus_name'];
                    $bus_company = $row['bus_company'];
                    $bus_model_no = $row['bus_model_no'];
					$bus_no = $row['bus_no'];
					$bus_id = $row['bus_id'];
                    ?>
					<option <?php if($expanse_bus_id==$bus_id){ echo 'selected'; } ?> value="<?php echo $bus_name.'|?|'.$bus_company.'|?|'.$bus_model_no.'|?|'.$bus_no.'|?|'.$bus_id; ?>"><?php echo $bus_name.' ['.$bus_company.']-['.$bus_model_no.']-['.$bus_no.']'; ?></option>
					
					 <?php } ?>
				 </select>						</div>
				   </div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Company<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_company" id="bus_company" placeholder="Company Name" value="<?php echo $expense_bus_company; ?>" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Model No.<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_model_no" id="bus_model_no" placeholder="Bus Model No." value="<?php echo $expense_bus_model_no; ?>" class="form-control" required>
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus No.<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bus_no" id="bus_no" placeholder="Bus No." value="<?php echo $expense_bus_no; ?>" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Expense Remark</label>
						   <input type="text" name="bus_expance_remark" id="bus_expance_remark" value="<?php echo $expense_remark; ?>" class="form-control" >
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Maintainance Date<font style="color:red"><b></b></font></label>
						   <input type="date" name="maintainance_date" id="maintainance_date" value="<?php echo $maintainance_date; ?>" class="form-control">
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Garage/Shop<font style="color:red"><b></b></font></label>
						   <input type="text" name="garage_shop" id="garage_shop" value="<?php echo $garage_shop; ?>" class="form-control">
						</div>
					</div>
					
			        <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Expense Amount<font style="color:red"><b></b></font></label>
						   <input type="number" name="bus_expance_amount" id="bus_expance_amount" value="<?php echo $expense_amount; ?>" class="form-control" required>
						</div>
					</div>
				      
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bill Date<font style="color:red"><b></b></font></label>
						   <input type="date" name="bill_date" id="bill_date" value="<?php echo $bill_date; ?>" class="form-control">
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Payment Date<font style="color:red"><b></b></font></label>
						   <input type="date" name="payment_date" id="payment_date" value="<?php echo $date; ?>" class="form-control" />
						</div>
					</div>
					
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Reading<font style="color:red"><b></b></font></label>
						   <input type="text" name="bus_reading" id="bus_reading" value="<?php echo $bus_reading; ?>" class="form-control" />
						</div>
					</div>
		
		<div class="col-md-12">
		   <?php if(isset($_GET['bus_expanse_s_no'])){ ?>
		   <center><input type="submit" name="submit1" value="Edit" class="btn btn-primary" /></center>
		   <input type="hidden" name="bus_expanse_s_no" value="<?php echo $bus_expanse_s_no; ?>" class="form-control" />
		   <?php }else{ ?>
		   <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		   <?php } ?>
		   </div>
		   </form>	
	       
	       <div class="col-md-12">&nbsp;</div>
	       <div class="col-md-12">
	       <table class="table table-responsive">
	           <thead >
	               <tr>
                        <th>S.No.</th>
                        <th>Bus No.</th>
                        <th>Bus Name</th>
                        <th>Expense Remark</th>
                        
                        <th>Garage Shop</th>
                        <th>Maintainance Date</th>
                        <th>Bill Date</th>
                        
                        <th>Payment Date</th>
                        <th>Reading</th>
                        <th>Expense Amount</th>
                        <th style="<?php if($_SESSION['bus_panel_edit_button']!='yes'){ echo 'display:none;'; } ?>" >Edit</th>
                        <th style="<?php if($_SESSION['bus_panel_delete_button']!='yes'){ echo 'display:none;'; } ?>" >Delete</th>
	               </tr>
	           </thead>
	           <tbody>
	               <?php					
					$que="select * from bus_expense";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					$serial_no1=0;
					$expense_grand_total=0;
					while($row=mysqli_fetch_assoc($run)){
					$s_no=$row['s_no'];
					$expense_remark=$row['expense_remark'];
                    if($row['maintainance_date']!='' && $row['maintainance_date']!='0000-00-00'){
                    $maintainance_date=date('d-m-Y',strtotime($row['maintainance_date']));
                    }else{
                    $maintainance_date=$row['maintainance_date'];
                    }
					$garage_shop=$row['garage_shop'];
                    if($row['bill_date']!='' && $row['bill_date']!='0000-00-00'){
                    $bill_date=date('d-m-Y',strtotime($row['bill_date']));
                    }else{
                    $bill_date=$row['bill_date'];
                    }
					$total_amount=$row['expense_amount'];
					$expense_grand_total=$expense_grand_total+$total_amount;
					
					//$date=date('d-m-Y',strtotime($row['date']));
                    if($row['date']!='' && $row['date']!='0000-00-00'){
                    $date=date('d-m-Y',strtotime($row['date']));
                    }else{
                    $date=$row['date'];
                    }
					$bus_id=$row['bus_id'];
					$bus_reading=$row['bus_reading'];
					
					$query1="select * from bus_details where bus_id='$bus_id'";
					$run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
                    // $bus_name = '';
                    // $bus_company = '';
                    // $bus_model_no = '';
                    // $bus_no = '';
					while($row1=mysqli_fetch_assoc($run1)){
                        $bus_name = $row1['bus_name'];
                        $bus_company = $row1['bus_company'];
                        $bus_model_no = $row1['bus_model_no'];
                        $bus_no = $row1['bus_no'];
					}
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $bus_no; ?></td>
					<td><?php echo $bus_name; ?></td>
					<td><?php echo $expense_remark; ?></td>
					<td><?php echo $garage_shop; ?></td>
					<td><?php echo $maintainance_date; ?></td>
					<td><?php echo $bill_date; ?></td>
					<td><?php echo $date; ?></td>
					<td><?php echo $bus_reading; ?></td>
					<td><?php echo $total_amount; ?></td>
					<td style="<?php if($_SESSION['bus_panel_edit_button']!='yes'){ echo 'display:none;'; } ?>" >
					<a href="javascript:post_content('bus/add_bus_expance','<?php echo 'bus_expanse_s_no='.$s_no; ?>')"><button type="button" class="btn btn-success" >Edit</button></a>
					</td>
					<td style="<?php if($_SESSION['bus_panel_delete_button']!='yes'){ echo 'display:none;'; } ?>" >
					<button type="button" class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button>
					</td>
					</tr>
					<?php } ?>
	           </tbody>
	       </table>
	       </div>
	       
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
