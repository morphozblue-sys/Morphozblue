<?php include("../attachment/session.php"); ?>

            <?php
			$student_attendance_class=$_GET['student_attendance_class'];
			if($student_attendance_class!='' && $student_attendance_class!='All'){
			    $condition=" and student_class='$student_attendance_class'";
			}else{
			    $condition="";
			}
			$section=$_GET['section'];
			if($section!='All'){
			    $condition1=" and student_class_section='$section'";
			}else{
			    $condition1="";
			}
			$student_attendance_date=$_GET['student_attendance_date'];
			
			$student_class_group=$_GET['student_class_group'];
			if($student_class_group!='All'){
			    $condition2=" and student_class_group='$student_class_group'";
			}else{
			    $condition2="";
			}
			$student_class_stream=$_GET['student_class_stream'];
			if($student_class_stream!='All'){
			    $condition3=" and student_class_stream='$student_class_stream'";
			}else{
			    $condition3="";
			}

			$student_attendance_month=$_GET['student_attendance_month'];
			$student_attendance_year=$_GET['student_attendance_year'];

		$month=$student_attendance_month;
        $year=$student_attendance_year;
    $date2=$year.'-'.$month.'-01';
	$count1 = date(' t ', strtotime($date2) );
	$month_name = date('F', mktime(0, 0, 0, $month, 10))
		  ?>
		  


			  <div class="col-md-12 table-responsive">
			  <table border="2" id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>Student id</th>
                  <th>Student Name</th>
                  <th>Student Father Name</th>
                  <th>Class/Section</th>
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
                $que34="select student_roll_no,student_name,student_class,student_class_section,student_father_name from  student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition3$filter37 order by student_name ASC";
			
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$student_id = $row34['student_roll_no'];
				$student_name = $row34['student_name'];
				$student_class = $row34['student_class'];
				$student_class_section = $row34['student_class_section'];
				$student_father_name = $row34['student_father_name'];

				$serial_no++;
				$present=0;
				$absent=0;
				$leave=0;
				$not_mark=0;
				$que="select * from student_attendance where attendance_roll_no='$student_id' and month='$month' and year='$year' order by s_no DESC LIMIT 1";
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

		$data123="student_id=".$student_id."&month=".$month."&year=".$year."&student_name=".$student_name."&student_class=".$student_class."&student_class_section=".$student_class_section;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_id; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class."/".$student_class_section; ?></td>
                   <td><?php echo $month_name; ?></td>
                   <td><?php echo $present; ?></td>
                   <td><?php echo $absent; ?></td>
                   <td><?php echo $leave; ?></td>
                   <td><?php echo $not_mark; ?></td>
				   <td><button type="button" onclick="post_content('attendance_management/student_attendance_list_view','<?php echo $data123; ?>')"  class="btn btn-success">View</button></td>
                </tr>
				<?php } } } ?>
                </tbody>
              </table>
			  </div>
