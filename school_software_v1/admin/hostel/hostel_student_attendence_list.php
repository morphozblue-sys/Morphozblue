<?php include("../attachment/session.php")?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../attachment/link_css.php");?>
</head>

<script>
function attendance_list(value){
var year=document.getElementById('current_year').value;
var s_class=document.getElementById('student_class').value;
var student_section=document.getElementById('student_section').value;
$.ajax({
address: "POST",
url: "ajax_getattendance_list.php?month="+value+"&year="+year+"&s_class="+s_class+"&section="+student_section+"",
cache: false,
success: function(detail){
$("#stud_list").html(detail);
if(value=='01'){
var my_month='January';
}else if(value=='02'){
var my_month='February';
}else if(value=='03'){
var my_month='March';
}else if(value=='04'){
var my_month='April';
}else if(value=='05'){
var my_month='May';
}else if(value=='06'){
var my_month='June';
}else if(value=='07'){
var my_month='july';
}else if(value=='08'){
var my_month='August';
}else if(value=='09'){
var my_month='September';
}else if(value=='10'){
var my_month='October';
}else if(value=='11'){
var my_month='November';
}else if(value=='12'){
var my_month='December';
}
$("#by_month").html(my_month);
}
});
}
</script>


<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="hostel.php"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="hostel_daily_entry.php"><i class="fa fa-bed"></i> <?php echo $language['Hostel Attendance Fill']; ?></a></li>
	    <li><a href="hostel_daily_attendence.php"><i class="fa fa-bed"></i><?php echo $language['Daily Attendance']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Student Attendance List']; ?></li>
      </ol>
    </section>

   <!---**********************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <?php
		  $hostel_hostel_name=$_GET['class'];
		  $hostel_room=$_GET['section'];
		  $current_month=$_GET['current_month'];
		  $current_month2=$current_month;
		  $year=$_GET['year'];
		  $date=$_GET['date'];
		  ?>
		  <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">
					  <label>Month : </label>
					  <select name="attendance_student_month" id="attendance_student_month" onchange="attendance_list(this.value);" class="form-control">
					  <option <?php if($current_month2=='01'){ echo "selected"; } ?> value="01">January</option>
					  <option <?php if($current_month2=='02'){ echo "selected"; } ?> value="02">February</option>
					  <option <?php if($current_month2=='03'){ echo "selected"; } ?> value="03">March</option>
					  <option <?php if($current_month2=='04'){ echo "selected"; } ?> value="04">April</option>
					  <option <?php if($current_month2=='05'){ echo "selected"; } ?> value="05">May</option>
					  <option <?php if($current_month2=='06'){ echo "selected"; } ?> value="06">June</option>
					  <option <?php if($current_month2=='07'){ echo "selected"; } ?> value="07">July</option>
					  <option <?php if($current_month2=='08'){ echo "selected"; } ?> value="08">August</option>
					  <option <?php if($current_month2=='09'){ echo "selected"; } ?> value="09">September</option>
					  <option <?php if($current_month2=='10'){ echo "selected"; } ?> value="10">October</option>
					  <option <?php if($current_month2=='11'){ echo "selected"; } ?> value="11">November</option>
					  <option <?php if($current_month2=='12'){ echo "selected"; } ?> value="12">December</option>
					  </select>
					  <input type="hidden" name="current_year" id="current_year" value="<?php echo $year; ?>" />
			  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<?php
				$current_month1=$current_month;
				$month_wise='';
				if($current_month1=="01") 
					   $month_wise="January";
				if($current_month1=="02") 
					   $month_wise="February";
				if($current_month1=="03") 
					   $month_wise="March";
				if($current_month1=="04") 
					   $month_wise="April";
				if($current_month1=="05") 
					   $month_wise="May";
				if($current_month1=="06") 
					   $month_wise="June";
				if($current_month1=="07") 
					   $month_wise="july";
				if($current_month1=="08") 
					   $month_wise="August";
				if($current_month1=="09") 
					   $month_wise="September";
				if($current_month1=="10") 
					   $month_wise="October";
				if($current_month1=="11") 
					   $month_wise="November";
				if($current_month1=="12") 
					   $month_wise="December";
				?>
                <tr>
                  <th><?php echo $language['Unique Id']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><span id="by_month"><?php echo $month_wise; ?></span> <?php echo $language['Month Attendance']; ?></th>
                  <th><?php echo $language['Hostel Name']; ?> <?php echo $hostel_hostel_name; ?> / <?php echo $language['Room No']; ?> '<?php echo $hostel_room; ?>'<input typt="text" name="student_class" id="student_class" value="<?php echo $hostel_hostel_name; ?>" style="display:none;" /><input typt="text" name="student_section" id="student_section" value="<?php echo $hostel_room; ?>" style="display:none;" /></th>
                </tr>
                </thead>
                <tbody id="stud_list">
                <tr>
                  <td>&nbsp;</td>
				  <td><button type="button" class="btn btn-success"><?php echo $language['Date']; ?> : </button></td>
				  <td colspan="2">
				  <?php
				  $date0=explode('-',$date);
				  $date1=$date0[0].'-'.$date0[1].'-01';
				  $count = date(' t ', strtotime($date1) );
					
				  for($i=1;$i<=$count;$i++){
				  
				  $a=$i;
				  
				  ?>
				  <button style="width:40px;" type="button" class="btn btn-success"><?php echo $a; ?></button>
				  <?php } ?>
				  </td>
				</tr>
				<?php
				include("../../con73/con37.php");

				$que="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$current_month' and year='$year'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){

				$unique_id = $row['attendance_roll_no'];
				$attendance_name = $row['attendance_name'];
					
					
					$date1=explode('-',$date);
					$date2=$date1[0].'-'.$date1[1].'-01';
					$number = date(' t ', strtotime($date2) );
				?>
                <tr>
                  <td><?php echo $unique_id; ?></td>
                  <td><?php echo $attendance_name; ?></td>
				  <td colspan="2">
				  <?php
				  for($i=1;$i<=$number;$i++){
				  if($i<10){
				  $a=$row['0'.$i];
				  $b=$a;
				  if($a==''){
				  $a=strtoupper('0'.$i);
				  }
				  }else{
				  $a=$row[$i];
				  $b=$a;
				  if($a==''){
				  $a=strtoupper($i);
				  }
				  }
				  ?> 
                  <button type="button" class="<?php if($a=='P'){ echo 'btn btn-primary'; }elseif($a=='A'){ echo 'btn btn-danger'; }elseif($a=='L'){ echo 'btn btn-warning'; }elseif($b==''){ echo 'btn'; } ?>" title="<?php if($a=='P'){ echo 'Present'; }elseif($a=='A'){ echo 'Absent'; }elseif($a=='L'){ echo 'Leave'; }elseif($b==''){ echo 'Not Fill'; } ?>" style="width:40px;"><?php echo $a; ?></button>
				  <?php } ?>
				  </td>
                </tr>
				<?php } ?>

                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  
		  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  
	<!---*************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
