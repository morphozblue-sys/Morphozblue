<?php include("../attachment/session.php"); ?>
            <?php
			
			
			$student_attendance_class=$_GET['student_attendance_class'];
			if($student_attendance_class!='All'){
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
			
			$attendance_date=$_GET['attendance_date'];

    

		$month=$student_attendance_month;
        $year=$student_attendance_year;
    $date2=$year.'-'.$month.'-01';
	$count1 = date(' t ', strtotime($date2) );
	$month_date_name = date('F', mktime(0, 0, 0, $month, 10));
		  ?>
 <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Student Attendance List</h5>
              </div>
			   <div class="box-body">
			              <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Student Attendance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print_function('printTable');"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
	      	</div>
             
			<div class="col-md-12" id="printTable" style="margin-top:10px">
     
			 
		
			    <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b><?php echo $_SESSION['school_name']; ?></b></center></span>
				 </div>
			  <div class="col-md-3">
	          <center><b>Dise Code : <?php echo $_SESSION['school_dise_code']; ?></b></center>
			  </div>
			  <div class="col-md-6">
				<span style="font-size:20px;font-weight:bold"><center>Student Attendance Report</center></span>
			  </div>
			  <div class="col-md-3">
			  <center><b>School Code : <?php echo $_SESSION['school_code']; ?></b></center>
			  </div>
            <div class="col-md-3">
	          <center><b>Month/Year : <?php echo $month_date_name."-".$year; ?></b></center>
			  </div>
			  <div class="col-md-6">
				  </div>
			  <div class="col-md-3">
			  <center><b>Class/Section : <?php echo $student_attendance_class."/".$section; ?></b></center>
			  </div>

            <div class="col-md-12 table-responsive" >
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">

		  


                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>Student id</th>
                  <th>Student Name</th>
                  <th>Student Father Name</th>
                  <th>Class/Section</th>
                  <?php
                  for($xc=1;$xc<=$count1;$xc++){
                  if($xc<10){
                      $xc="0".$xc;
                  }
                  ?>
                   <th><?php echo $xc; ?></th>
                  
                  <?php
                  } ?>
                  <th>Total Present</th>
                  <th>Total Absent</th>
                  <th>Total Leave</th>
                  <th>Total Not Mark</th>
                  
                </tr>
                </thead>
                <tbody>
				<?php
         $que34="select student_roll_no,student_name,student_class,student_class_section,student_father_name from  student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition3 $filter37 order by student_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$student_id = $row34['student_roll_no'];
				$student_name = $row34['student_name'];
				$student_class = $row34['student_class'];
				$student_class_section = $row34['student_class_section'];
				$student_father_name = $row34['student_father_name'];

			
				$present=0;
				$absent=0;
				$leave=0;
				$not_mark=0;
					$serial_no++;
				?>
				 <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_id; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class."/".$student_class_section; ?></td>
              
				<?php
				$que="select * from student_attendance where attendance_roll_no='$student_id' and month='$month' and year='$year' order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					if(mysqli_num_rows($run)>0){
					    
				while($row=mysqli_fetch_assoc($run)){
				for($i=1;$i<=$count1;$i++){
if($attendance_report_type=='Daily'){
    $i=$day;
}
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
	
				
				?>
                    
                   <th><?php echo $a; ?></th>
                  <?php
                  }} }else{
                    
                  for($xc=1;$xc<=$count1;$xc++){
                  ?>
                   <th></th>
                  
                  <?php
                  } }?>
              
                   <td><?php echo $present; ?></td>
                   <td><?php echo $absent; ?></td>
                   <td><?php echo $leave; ?></td>
                   <td><?php echo $not_mark; ?></td>
                   <?php
                   ?>
                </tr>
				<?php }   ?>
                </tbody>
              </table>
			  </div>
			  </div>
	  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Student Attendance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print_function('printTable');"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
			  </div>
			  </div>