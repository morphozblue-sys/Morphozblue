<?php include("../attachment/session.php")?>



      <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
		<li><a href="javascript:get_content('hostel/hostel_daily_entry')"><i class="fa fa-bed"></i> <?php echo $language['Hostel Attendance Fill']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Student Attendance View']; ?></li>
      </ol>
    </section>

	<!---******************************------9999999999000000000666666666-------------------******************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      
         
	   <?php
	      $unique_id=$_GET['id'];
		  $hostel_hostel_name=$_GET['class'];
		  $hostel_room=$_GET['section'];
		  $current_month=$_GET['current_month'];
		  $current_month2=$current_month;
		  $year=$_GET['year'];
		  //$date=$_GET['date'];
		  ?> 
		  
		  <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">
					  <label><?php echo $language['Month']; ?></label>
					  <select name="attendance_student_month" id="attendance_student_month" onchange="attendance_list(this.value);" class="form-control">
					  <option <?php if($current_month=='01'){ echo "selected"; } ?> value="01"><?php echo $language['January']; ?></option>
					  <option <?php if($current_month=='02'){ echo "selected"; } ?> value="02"><?php echo $language['February']; ?></option>
					  <option <?php if($current_month=='03'){ echo "selected"; } ?> value="03"><?php echo $language['March']; ?></option>
					  <option <?php if($current_month=='04'){ echo "selected"; } ?> value="04"><?php echo $language['April']; ?></option>
					  <option <?php if($current_month=='05'){ echo "selected"; } ?> value="05"><?php echo $language['May']; ?></option>
					  <option <?php if($current_month=='06'){ echo "selected"; } ?> value="06"><?php echo $language['June']; ?></option>
					  <option <?php if($current_month=='07'){ echo "selected"; } ?> value="07"><?php echo $language['July']; ?></option>
					  <option <?php if($current_month=='08'){ echo "selected"; } ?> value="08"><?php echo $language['August']; ?></option>
					  <option <?php if($current_month=='09'){ echo "selected"; } ?> value="09"><?php echo $language['September']; ?></option>
					  <option <?php if($current_month=='10'){ echo "selected"; } ?> value="10"><?php echo $language['October']; ?></option>
					  <option <?php if($current_month=='11'){ echo "selected"; } ?> value="11"><?php echo $language['November']; ?></option>
					  <option <?php if($current_month=='12'){ echo "selected"; } ?> value="12"><?php echo $language['December']; ?></option>
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
                  <th><?php echo $language['Student Unique Id']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><span id="by_month"><?php echo $month_wise; ?></span> <?php echo $language['Month Attendance']; ?></th>
       <th><?php echo $language['Hostel Name']; ?> <?php echo $hostel_hostel_name; ?> <?php echo $language['Room No']; ?> '<?php echo $hostel_room; ?>'
	   <input type="text" name="student_class" id="student_class" value="<?php echo $hostel_hostel_name; ?>" style="display:none;" /></th>
                </tr>
                </thead>
                <tbody id="stud_list">
                <tr>
                  <td>&nbsp;</td>
				  <td><button type="button" class="btn btn-success"><?php echo $language['Date']; ?> </button></td>
				  <td colspan="2">
				  <?php
				  
				  $date1=$year.'-'.$current_month.'-01';
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

			 $que="select * from hostel_student_attendence where hostel_room_attendance='$hostel_room' and month='$current_month' and year='$year' and attendance_roll_no='$unique_id'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){

					$unique_id = $row['attendance_roll_no'];
					$attendance_name = $row['attendance_name'];
					
					$date2=$year.'-'.$current_month.'-01';
					$number = date(' t ', strtotime($date2) );
				?>
                <tr>
                  <td><?php echo $unique_id; ?><input type="text" name="student_unique_id" id="student_unique_id" value="<?php echo $unique_id; ?>" style="display:none;" /></td>
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
 