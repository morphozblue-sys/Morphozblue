<?php include("../attachment/session.php"); ?>
            <?php
// 			ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
			function dayCount($day,$month,$year){
            // $totalDay=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                $totalDay=  date('t', mktime(0, 0, 0, $month, 1, $year)); 


$count=0;

for($i=1;$totalDay>=$i;$i++){

  if( date('l', strtotime($year.'-'.$month.'-'.$i))==ucwords($day)){
    $count++;
    }

}

return $count;


}


			$attendance_student_class=$_GET['attendance_student_class'];
			if($attendance_student_class!='All'){
			    $condition=" and student_class='$attendance_student_class'";
			}else{
			    $condition="";
			}
			$section=$_GET['section'];
			if($section!='All'){
			    $condition1=" and student_class_section='$section'";
			}else{
			    $condition1="";
			}
			
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

			
			$month_info=$_GET['month_info'];
		 	$month_info_explode=explode(",",$month_info);
			

    

		  ?>
 <div class="box-header">
                <h5 class="box-title">Student Attendance List</h5>
              </div>
			   <div class="box-body">
			              <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Student Annually Attendance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print_function('printTable');"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
	      	</div>
             
			<div class="row" id="printTable" style="margin-top:10px">
     
			 
		 <div class="col-md-12">
			
			<span style="float:left"><?php echo date('d-m-Y H:i:sa'); ?></span>
			 </div>
			    <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b><?php echo $_SESSION['school_name']; ?></b></center></span>
				 </div>
			  <div class="col-md-3">
	          <center><b>Dise Code : <?php echo $_SESSION['school_dise_code']; ?></b></center>
			  </div>
			  <div class="col-md-6">
				<span style="font-size:20px;font-weight:bold"><center>Student Annually Attendance Report</center></span>
			  </div>
			  <div class="col-md-3">
			  <center><b>School Code : <?php echo $_SESSION['school_code']; ?></b></center>
			  </div>
            <div class="col-md-3">
	          <center></center>
			  </div>
			  <div class="col-md-6">
				  </div>
			  <div class="col-md-3">
			  <center><b>Class/Section : <?php echo $attendance_student_class."/".$section; ?></b></center>
			  </div>

            <div class="col-md-12 table-responsive" >
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">

		  


			  <div class="row table-responsive">
			  <table border="2" id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>Student id</th>
                  <th>Student Name</th>
                  <th>Student Father Name</th>
                  <th>Class/Section</th>
                  <th>Total Days</th>
                  <th>Total Sunday</th>
                  <th>Total Holiday</th>
                  <th>Total Working Days</th>
                  <th>Total Present</th>
                  <th>Total Absent</th>
                  <th>Total Leave</th>
                  <th>Total Not Mark</th>
                  <th>Attendance</th>
                  <th>Percentage</th>
                  
                  
                  
                </tr>
                </thead>
                <tbody>
				<?php
				
				$month_query="";
				$month_query_for_attendance="";
				
					for($xx=0;$xx<count($month_info_explode);$xx++){
				    $month_info_explode1=explode("|?|",$month_info_explode[$xx]);
				    $month=$month_info_explode1[0];
				    $year=$month_info_explode1[1];
				   // $wwwee=$year."-".$month."-%";
				    $wwwee="%-".$month."-".$year;
				   if($month_query==""){
				$month_query="where (holiday_date like '$wwwee'";
				$month_query_for_attendance="(month='$month' and year='$year')";
				   } else{
				$month_query=$month_query."|| holiday_date like '$wwwee'";
				
				$month_query_for_attendance=$month_query_for_attendance." || (month='$month' and year='$year')";
				   }
					}
			 if($month_query!=""){
				 $month_query=$month_query." )";
			 }   if($month_query_for_attendance!=""){
				 $month_query_for_attendance="and (".$month_query_for_attendance." )";
			 }  	
				
	$total_holiday=0;  
	  $que6="select * from holiday_manage $month_query";
				$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
				
					while($row5=mysqli_fetch_assoc($result)){
               
                $event_from_date= $row5['holiday_date'];
                $total_holiday++;

                }
                
				
			
			
				
				$total_days=0;
				$total_sunday=0;
				for($xx=0;$xx<count($month_info_explode);$xx++){
				    $month_info_explode1=explode("|?|",$month_info_explode[$xx]);
				    $month=$month_info_explode1[0];
				    $year=$month_info_explode1[1];
				       $totalDay22=  date('t', mktime(0, 0, 0, $month, 1, $year));
				        
				$total_days=$total_days+$totalDay22;
				$total_sunday=$total_sunday+dayCount('sunday',$month,$year);
				}
				
			
			
			
			 	$que="select * from student_attendance where 1='1' $month_query_for_attendance";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				    	$student_roll_no = $row['attendance_roll_no'];
				    	$month1 = $row['month'];
				    	$year1 = $row['year'];
				    	for($dd=1;$dd<=31;$dd++){
				    	    if($dd<10){
				     $x='0'.$dd;
				   }else{
				       $x=$dd;
				   }
    				   
				    	    
				$student_attendance_array[$year1."-".$month1."-".$dd][$student_roll_no]=$row[$x];
				    	}
				}
			
        $que34="select student_roll_no,student_name,student_class,student_class_section,student_father_name from student_admission_info where student_status='Active' and  session_value='$session1'  $query_filter $condition$condition1$condition2$condition3 order by student_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$student_roll_no = $row34['student_roll_no'];
				$student_name = $row34['student_name'];
				$student_class = $row34['student_class'];
				$student_class_section = $row34['student_class_section'];
				$student_father_name = $row34['student_father_name'];

			
				$present=0;
				$absent=0;
				$leave=0;
				$sunday=0;
				$holiday=0;
				$not_mark=0;
				
					for($xx=0;$xx<count($month_info_explode);$xx++){
				    $month_info_explode1=explode("|?|",$month_info_explode[$xx]);
				    $month=$month_info_explode1[0];
				    $year=$month_info_explode1[1];
				    $days_in_month=  date('t', mktime(0, 0, 0, $month, 1, $year)); 
				    // $days_in_month=cal_days_in_month(CAL_GREGORIAN,$month,$year);
				    for($mm=1;$mm<=$days_in_month;$mm++){
				    if(isset($student_attendance_array[$year."-".$month."-".$mm][$student_roll_no])){
				      $a=$student_attendance_array[$year."-".$month."-".$mm][$student_roll_no];  
				    }else{
				        $a="";
				    }
				    
				    	if($a=='P'){
	$present=$present+1;
	}else if($a=='P/2'){
	$present=$present+1;
	
	}elseif($a=='A'){
	$absent=$absent+1;
		
	}elseif($a=='L'){
	$leave=$leave+1;
		
	}else{
	    	
	    $not_mark=$not_mark+1;
	}
				}
					}
					$total_working_days=$total_days-$total_sunday-$total_holiday;
				
				$serial_no++;
				?>
				 <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_roll_no; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class."/".$student_class_section; ?></td>
              
                   <td><?php echo $total_days; ?></td>
                   <td><?php echo $total_sunday; ?></td>
                   
                   <td><?php echo $total_holiday; ?></td>
                   <td style="color:red"><?php echo $total_working_days; ?></td>
                   <td style="color:red"><?php echo $present; ?></td>
                   <td><?php echo $absent; ?></td>
                   <td><?php echo $leave; ?></td>
                   <td><?php echo $total_working_days-$present-$absent-$leave; ?></td>
                   <td style="color:red"><?php echo $present."/".$total_working_days; ?></td>
                   <td style="color:blue"><?php echo round(100*($present/$total_working_days),2)."%"; ?></td>
			
                </tr>
				<?php }   ?>
                </tbody>
              </table>
			  </div>
			  </div>
	  <div class="row">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Student Attendance Annually Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print_function('printTable');"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
			  </div>
			  </div>