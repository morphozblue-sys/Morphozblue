<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>

 <?php include("../attachment/link_css.php")?>
  <?php include("../attachment/link_js.php")?>

</head>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_search_student_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
        
      
              }
           });

    }
</script>  
<script>
    function check_date(){
	var from_date=document.getElementById("leave_from_date").value;
	var to_date=document.getElementById("leave_to_date").value;
	if(from_date!='' && to_date!=''){
             $.ajax({
			  type: "POST",
              url: "ajax_holiday_detail.php?from_date="+from_date+"&&to_date="+to_date+"",
              cache: false,
              success: function(detail){
                 var str=detail;
            var res=str.split("|?|");
           $("#total_leave_days").val(res[0]);
           $("#total_sunday").val(res[1]);
           $("#total_holiday").val(res[2]);
			
			}
             
           });
            }
			}
</script>
	<script>
  $(function () {
 
    $('.select2').select2()

  })
</script>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add Leave
      </h1>
      <ol class="breadcrumb">
         <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
	   <li><a href="leave.php"><i class="fa fa-umbrella"></i> Leave Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Add Leave</li>
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
              <h3 class="box-title">Student Leave Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
            <form role="form" method="post" enctype="multipart/form-data">
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label>Search Student</label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" required>
					  <option value="">Select student</option>
					        <?php
							include("../../con73/con37.php");
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
			</div>
			
			
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Student Name</label>
						   <input type="text"  name="student_name" placeholder="Student Name"  id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Student Class</label>
						   <input type="text"  name="student_class" placeholder="Student Class"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text"  name="student_section" placeholder="Student Section"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Student Roll No.</label>
					  <input type="text"  name="student_roll_no" placeholder="student Roll No."  id="student_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Leave From</label>
					  <input type="date"  id="leave_from_date" name="leave_from_date" placeholder="Enter start date" onchange="check_date();" value="" class="form-control">
					</div>
				  </div>
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Leave To</label>
					  <input type="date"  onchange="check_date();" id="leave_to_date" name="leave_to_date" placeholder="Enter End date"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Approved By</label>
					  <input type="text"  name="approved_by" placeholder="Enter approved by"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>upload Application</label>
					  <input type="file"  name="image"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-2 ">	
					<div class="form-group" >
					  <label>Total leave days</label>
					  <input type="text"  name="total_leave_days" id="total_leave_days" placeholder="Enter total no of day"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-1 ">	
					<div class="form-group" >
					  <label>Total Sunday</label>
					  <input type="text"   id="total_sunday"   value="" class="form-control" readonly>
					</div>
				  </div>
				  <div class="col-md-1 ">	
					<div class="form-group" >
					  <label>Total Holiday</label>
					  <input type="text"   id="total_holiday"   value="" class="form-control" readonly>
					</div>
				  </div>
				  
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				
				
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>

</body>
</html>
<?php
include("../../con73/con37.php");
if(isset($_POST["finish"])){
  $student_name=$_POST['student_name'];
  $student_class=$_POST['student_class'];
  $student_section=$_POST['student_section'];
  $student_roll_no=$_POST['student_roll_no'];
echo  $leave_from_date_1 = $_POST['leave_from_date'];
  $leave_from_date_2 = explode("-",$leave_from_date_1);
  $leave_from_date=$leave_from_date_2[2]."-".$leave_from_date_2[1]."-".$leave_from_date_2[0];
 echo $leave_to_date_1 = $_POST['leave_to_date'];
echo  $leave_to_date_2 = explode("-",$leave_to_date_1);
echo  $leave_to_date=$leave_to_date_2[2]."-".$leave_to_date_2[1]."-".$leave_to_date_2[0];
  $approved_by=$_POST['approved_by'];
  $total_leave_days=$_POST['total_leave_days'];
  

    $from_date=$leave_from_date_2[2];
  $from_month=$leave_from_date_2[1];
  $from_year=$leave_from_date_2[0];
  $to_date=$leave_to_date_2[2];
  $to_month=$leave_to_date_2[1];
  $to_year=$leave_to_date_2[0];
  
   $file=$_FILES['image']['name'];            
	$file_temp=$_FILES['image']['tmp_name'];
     $path="../../documents/leave/".$student_name;
	 mkdir($path, 0777, true);
    move_uploaded_file($file_temp,$path."/$file");
  
  
   
if($from_month==$to_month){  

$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
 	
$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=(int)$from_date; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and session_value='$session1' ";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,session_value,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$from_month','$from_year','$session1',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=(int)$from_date; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     } }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}
}else{  

$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
 	
$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=(int)$from_date; $x<=(int)$number; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year' and session_value='$session1' ";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and session_value='$session1' ";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$from_month','$from_year',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=(int)$from_date; $x<=(int)$number; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}

$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=1; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$to_month .'-'.$to_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and session_value='$session1' ";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$to_month','$to_year',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=1; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$to_month .'-'.$to_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}
}
   
   
  
  
   $query="insert into student_leave_management(student_name,student_class,student_section,student_roll_no,leave_from_date,leave_to_date,leave_approved_by,leave_total_day,image,session_value,$update_by_insert_sql_column) values ('$student_name','$student_class','$student_section','$student_roll_no','$leave_from_date','$leave_to_date','$approved_by','$total_leave_days','$file','$session1',$update_by_insert_sql_value)";
  mysqli_query($conn73,$query);
	echo "<script>window.open('leave_list.php','_self')</script>";


	
	}
	
	?>
