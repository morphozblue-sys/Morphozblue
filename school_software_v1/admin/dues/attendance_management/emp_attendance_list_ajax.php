<?php include("../attachment/session.php"); ?>

        <div class="col-md-12">
            <?php

			$emp_department=$_GET['emp_department'];
			$condition="";
			if($emp_department!='All'){
			    $condition="and emp_categories='$emp_department'";
			}
			$staff_attendance_month=$_GET['staff_attendance_month'];
			$staff_attendance_year=$_GET['staff_attendance_year'];

		$month=$staff_attendance_month;
        $year=$staff_attendance_year;
    $date2=$year.'-'.$month.'-01';
	$count1 = date(' t ', strtotime($date2) );
	$month_name = date('F', mktime(0, 0, 0, $month, 10))
		  ?>
		  

  <div class="col-md-12 table-responsive">
			  <table border="2" id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>EMP id</th>
                  <th>EMP Name</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>Month</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Leave</th>
                  <th>Not Mark</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?php
         $que34="select emp_id,emp_categories,emp_name,emp_designation,emp_rf_id_no from employee_info where emp_status!='Deleted'$condition order by emp_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$emp_id = $row34['emp_id'];
				$emp_department = $row34['emp_categories'];
				$emp_name = $row34['emp_name'];
				$emp_designation = $row34['emp_designation'];
				$emp_rf_id_no = $row34['emp_rf_id_no'];

				$serial_no++;
				$present=0;
				$absent=0;
				$leave=0;
				$not_mark=0;
				$que="select * from staff_attendance where staff_id='$emp_id' and month='$month' and year='$year'  order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					if(mysqli_num_rows($run)>0){
				while($row=mysqli_fetch_assoc($run)){
				for($i=1;$i<=$count1;$i++){
 $x=$i;
				  if($i<10){
				     $x='0'.$i;
				   }else{
				       $x=$i;
				   }
	$a=$row[''.$x];
	if($a=='P'){
	$present=$present+1;
	}else if($a=='P/2'){
	$present=$present+0.5;
	}elseif($a=='A'){
	$absent=$absent+1;
	}elseif($a=='L'){
	$leave=$leave+1;
	}else{
	    $not_mark=$not_mark+1;
	}
	}

		$data123="emp_id=".$emp_id."&month=".$month."&year=".$year."&emp_name=".$emp_name."&emp_department=".$emp_department;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $emp_id; ?></td>
                  <td><?php echo $emp_name; ?></td>
                  <td><?php echo $emp_department; ?></td>
                  <td><?php echo $emp_designation; ?></td>
                   <td><?php echo $month_name; ?></td>
                   <td><?php echo $present; ?></td>
                   <td><?php echo $absent; ?></td>
                   <td><?php echo $leave; ?></td>
                   <td><?php echo $not_mark; ?></td>
				   <td><button type="button" onclick="post_content('attendance_management/emp_attendance_list_view','<?php echo $data123; ?>')"  class="btn btn-success">View</button></td>
                </tr>
				<?php } } } ?>
                </tbody>
              </table>
			  </div>

            </div>
          </div>
          </form>
		
		</div>