<?php include("../attachment/session.php")?> 
<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>

</head>

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
	    <li class="Active"><?php echo $language['Hostel Student Attendance']; ?></li>
      </ol>
    </section>


	<!---**************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
         
          <?php
			$hostel_hostel_name=$_GET['hostel_hostel_name'];
			$hostel_room=$_GET['hostel_room'];
			$attendance_student_date=$_GET['date'];
			$month=$_GET['month'];

			$attendance_student_date2=explode('-',$attendance_student_date);
			$attendance_student_date3=$attendance_student_date2[2]."-".$attendance_student_date2[1]."-".$attendance_student_date2[0];
			$attendance_student_date4=$attendance_student_date2[2];
			$year=$attendance_student_date2[0];
		  ?>
		  
		  <form  method="post" enctype="multipart/form-data">
		  <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"> <?php echo $language['Student Attendance'] ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-md-12">
			  <div class="col-md-2"></div>
			  <div class="col-md-4"><h4><?php echo $language['Attendance Date']; ?> : <?php echo $attendance_student_date3; ?></h4></div>
			  <div class="col-md-4"><h4><?php echo $language['Hostel Name']; ?>: <?php echo $hostel_hostel_name; ?> / <?php echo $language['Room No']; ?> : '<?php echo $hostel_room; ?>'</h4></div>
			  <div class="col-md-2"></div>
			  </div>
			  <div class="col-md-12">
			  <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Student Attendance']; ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
				include("../../con73/con37.php");

				$que="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$month' and year='$year'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){

						$s_no=$row['s_no'];
						$unique_id = $row['attendance_roll_no'];
						$attendance_name = $row['attendance_name'];
						
					$serial_no++;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $attendance_name; ?></td>
                  <td><?php echo $unique_id; ?><input type="hidden" name="unique_id[]" value="<?php echo $unique_id; ?>" readonly /></td>
                  <td>
				  <select name="hostel_student_attendence[]" >
				  <option value="P">P</option>
				  <option value="A">A</option>
				  <option value="L">L</option>
				  </select>
				  </td>
                </tr>
				<?php } ?>
                </tbody>
              </table>
			  </div>
			  <div class="col-md-12">
			  <center><button type="submit" name="submit1" class="btn btn-primary"><?php echo $language['Submit']; ?></button></center>
			  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </form>
		
		</div>
		<div class="col-xs-2"></div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  
	<!---*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
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

<?php
if(isset($_POST['submit1'])){
$unique_id=$_POST['unique_id'];
$hostel_student_attendence=$_POST['hostel_student_attendence'];

$count=count($unique_id);
for($i=0;$i<$count;$i++){

$query="update hostel_student_attendence set `$attendance_student_date4`='$hostel_student_attendence[$i]',$update_by_update_sql  where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$month' and year='$year' and attendance_roll_no='$unique_id[$i]'";
if(mysqli_query($conn73,$query)){
echo "<script>window.open('hostel_student_attendence_list.php?class=$hostel_hostel_name&current_month=$month&year=$year&date=$attendance_student_date&section=$hostel_room','_self');</script>";
}

}
}
?>

