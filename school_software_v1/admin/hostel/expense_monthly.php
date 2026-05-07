<?php include("../attachment/session.php")?>
<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php"); ?>
</head>
<script type="text/javascript">
   function fill_detail(){
           var value=document.getElementById('student_roll_no').value;
			$.ajax({
			  address: "POST",
              url: "ajax_expense_mothly.php?student_roll_no="+value+"",
              cache: false,
              success: function(detail){
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_name").val(res[0]);
	     $("#student_class").val(res[1]);
 		 $("#student_section").val(res[2]);  
		 $("#school_roll_no").val(res[3]);     
              }
           });
    }

	function calculate(){
	var add=0;
	$('.amt').each(function() {
	  add += Number($(this).val());
	});
	$('#for_total').html(add);
	}
	
</script> 
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>
  
  <?php include("../../con73/con37.php"); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Student Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-graduation-cap"></i> Hostel</a></li>
	  <li class="active">Expense Monthly</li>
      </ol>
    </section>
	

	
	
	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Student Action</h3><span style="float:right;"><b><?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
 echo $date->format('d-m-Y'); ?></b></span>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
	
			<form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="col-md-6 ">				
					<div class="form-group" >
					  <label>Search Student<font size="2" style="font-weight: normal;"></label>
					  <select name="student_roll_no" id="student_roll_no" class="form-control select2" onchange="fill_detail();" required>
					  <option value="">Select Student</option>
					        <?php
							$qry="select * from student_admission_info where student_hostel='Yes' and student_status='Active' and registration_final='yes' and session_value='$session1'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_admission_number=$row22['student_admission_number'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_class_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-"."[".$student_class."-".$student_class_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
			<div class="col-md-3">
		       	<div class="form-group">
					<label>From Date</label>
					<input type="date" name="from_date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
				</div>	
			</div>
			<div class="col-md-3">
		       	<div class="form-group">
					<label>To Date</label>
					<input type="date" name="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
				</div>	
			</div>
			</div>
			
			
				<div class="col-md-3 ">
						<div class="form-group">
						   <label>Student Name</label>
						   <input type="text" name="student_name" placeholder="Student Name" id="student_name" class="form-control" readonly>
				        </div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Class</label>
						   <input type="text" name="student_class" placeholder="Student Class" id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text" name="student_section" placeholder="Student Section" id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Student Roll No.</label>
					  <input type="text" placeholder="Student Roll No." id="school_roll_no" class="form-control" readonly>
					</div>
				</div>
				
				  
		
			
				<div class="col-md-12">
<!---table----------------------------------------------------------------------->				
		<div class="box-body table-responsive" id="showing_box">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>Fee Name</th>
                  <th>Amount</th>
                  <th>Remark</th>
                </tr>
                </thead>
                <tbody>
				<form method="post">
                <?php  
					include("../../con73/con37.php");
					$que5="select * from school_info_hostel_head where fee_head_name !='' and fee_head_type !='Regular'";
                    $run5=mysqli_query($conn73,$que5);
					$sl_no=0;
                    while($row5=mysqli_fetch_assoc($run5)){
                    $fee_head_name[$sl_no]=$row5['fee_head_name'];
                    $fee_head_code[$sl_no]=$row5['fee_head_code'];
                    $sl_no++;
					}
					for($i=0;$i<$sl_no;$i++){
					?>        
            <tr>
                <td><?php echo $fee_head_name[$i]; ?><input type="hidden" name="fee_code[]" class="form-control" id="" value="<?php echo $fee_head_code[$i]; ?>" style="width:80px;" /></td>
			    <td><input type="text" name="fee_monthly_amount[]" class="form-control amt" id="" value="" style="width:80px;" oninput="calculate();" /></td>
				<td><textarea rows="2" cols="50" name="fee_monthly_remarks[]"></textarea></td>
		    </tr>	
			<?php } ?>
		    <tr>
                <td><label>Total Amount</label></td>
			    <td><label id="for_total">0</label></td>
				<td>&nbsp;</td>
		    </tr>
           <tr>
			   <td colspan="3"><center><input type="submit" name="finish" value="Submit" class="btn btn-success"></center></td>
			</tr> 			
               </form>             
			  </tbody>
             </table>
            </div>  
				
		</form>	
		<div class="col-md-12">		        
		</div>
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>

  
 
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
 <?php include("../attachment/link_js.php"); ?>
</div>

</body>
</html>

<?php

    if(isset($_POST["finish"])){
    $student_roll_no=$_POST['student_roll_no'];
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];	
    $fee_code=$_POST['fee_code'];
    $fee_monthly_amount=$_POST['fee_monthly_amount'];
    $fee_monthly_remarks=$_POST['fee_monthly_remarks'];
	$current_date=date('Y-m-d');
	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $current_time=$date->format('H:i:s');
	$count1=count($fee_code);
	$total_amount=0;
	$fee_column='';
	$fee_value='';
	$fee_column1='';
	$fee_value1='';
	for($i=0;$i<$count1;$i++){
	$total_amount=$total_amount+$fee_monthly_amount[$i];
	$fee_column=$fee_column.','.$fee_code[$i];
	$fee_value=$fee_value.",'$fee_monthly_amount[$i]'";
	$fee_column1=$fee_column1.','.$fee_code[$i].'_remark';
	$fee_value1=$fee_value1.",'$fee_monthly_remarks[$i]'";
	}
	
	$query="insert into expense_monthly(student_roll_no,create_date,create_time,from_date,to_date,total_amount,session_value$fee_column$fee_column1,$update_by_insert_sql_column) values('$student_roll_no','$current_date','$current_time','$from_date','$to_date','$total_amount','$session1'$fee_value$fee_value1,$update_by_insert_sql_value)";
	
	if(mysqli_query($conn73,$query)){
	echo "<script>alert_new('Successfully Add Expenses !!!')</script>";
	echo "<script>window.open('expense_monthly_list.php','_self')</script>";
	}
	}
	
?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>