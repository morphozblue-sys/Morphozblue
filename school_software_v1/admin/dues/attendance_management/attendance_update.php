<?php include("../attachment/session.php");
/*
$column_name;
	 for($i1=4;$i1<=31;$i1++){
				     if($i1<10){
				         $k='0'.$i1;
				     }else{
				       $k=$i1;   
				     }
			
				$incloumn='intime_'.$k;
				$outcloumn='outtime_'.$k;
				$attendancecloumn=$k;
				
			$column_name=$column_name.",$incloumn='0000-00-00 00:00:00',$outcloumn='0000-00-00 00:00:00',`$attendancecloumn`=''";
				
				 }
				 		echo		 $que2="update staff_attendance set company_name='1' $column_name where month='03' and year='2023'";
				 		*/
			//	 mysqli_query($conn73,$que2);

/*
				$que="select * from staff_attendance28022023 ";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				$staff_id=$row['staff_id'];
				$month=$row['month'];
				$year=$row['year'];
				$detail=$staff_id."_".$month."_".$year;
				if(!isset($month_detail[$detail])){
				    $month_detail[$detail]=1;
				    $month_array[]=$detail;
				}
				$column_name="";
				 for($i1=1;$i1<=31;$i1++){
				     if($i1<10){
				         $k='0'.$i1;
				     }else{
				       $k=$i1;   
				     }
				$incloumn='intime_'.$k;
				$outcloumn='outtime_'.$k;
				$attendancecloumn=$k;
				$time_in=$row[$incloumn];
				$time_out=$row[$outcloumn];
				$attendance=$row[$attendancecloumn];
				if($attendance!=""){
				$attendance_array[$detail][$i1]=$attendance;
				}
					if($time_in!=""){
				$intime_array[$detail][$i1]=$time_in;
				}
					if($time_out!=""){
				$timeout_array[$detail][$i1]=$time_out;
				}
				
				
			//	$column_name=$column_name.",$incloumn='$time_in',$outcloumn='$time_out',$attendancecloumn='$attendance'";
				
				 }
				}
			//	 $que2="update staff_attendance set company_name='1' $column_name where staff_id='11' and month='02' and year='2023'";
			//	 mysqli_query($conn73,$que2);
			//	}
				for($dd=0;$dd<count($month_array);$dd++){
				   $detail_explode=explode("_",$month_array[$dd]);
				 	$staff_id=$detail_explode[0];
				$month=$detail_explode[1];
				$year=$detail_explode[2]; 
				
				
				
				
							$column_name="";
				 for($i1=1;$i1<=31;$i1++){
				     if($i1<10){
				         $k='0'.$i1;
				     }else{
				       $k=$i1;   
				     }
				$incloumn='intime_'.$k;
				$outcloumn='outtime_'.$k;
				$attendancecloumn=$k;
				$time_in=$intime_array[$month_array[$dd]][$i1];
				$time_out=$timeout_array[$month_array[$dd]][$i1];
				$attendance=$attendance_array[$month_array[$dd]][$i1];
			
				
				$column_name=$column_name.",$incloumn='$time_in',$outcloumn='$time_out',`$attendancecloumn`='$attendance'";
				
				 }
				
				
				
				
			echo	 $que2="update staff_attendance28022023 set company_name='1' $column_name where staff_id='$staff_id' and month='$month' and year='$year'";
			echo "<br>";
				 mysqli_query($conn73,$que2);
					$que111="select * from staff_attendance28022023  where staff_id='$staff_id' and month='$month' and year='$year'";
				$run111=mysqli_query($conn73,$que111) or die(mysqli_error($conn73));
				$j=0;
				while($row111=mysqli_fetch_assoc($run111)){
				$sss=$row111['s_no'];
				    if($j>0){
				      
			echo	 $que211="delete from staff_attendance28022023  where s_no='$sss'";
			echo "<br>";
				 mysqli_query($conn73,$que211);  
				    }
				    $j++;
				}
				}
				*/
				
				
			    $que="select * from student_attendance1605 where year='2024'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				$attendance_roll_no=$row['attendance_roll_no'];
				$month=$row['month'];
				$year=$row['year'];
				$detail=$attendance_roll_no."_".$month."_".$year;
				if(!isset($month_detail[$detail])){
				    $month_detail[$detail]=1;
				    $month_array[]=$detail;
				}
				$column_name="";
				 for($i1=1;$i1<=31;$i1++){
				     if($i1<10){
				         $k='0'.$i1;
				     }else{
				       $k=$i1;   
				     }
				$incloumn='intime_'.$k;
				$outcloumn='outtime_'.$k;
				$attendancecloumn=$k;
				$time_in=$row[$incloumn];
				$time_out=$row[$outcloumn];
				$attendance=$row[$attendancecloumn];
				if($attendance!=""){
				$attendance_array[$detail][$i1]=$attendance;
				}
					if($time_in!="0000-00-00 00:00:00"){
				$intime_array[$detail][$i1]=$time_in;
				}
					if($time_out!="0000-00-00 00:00:00"){
				$timeout_array[$detail][$i1]=$time_out;
				}
				
				
				
				 }
				}
				
				for($dd=0;$dd<count($month_array);$dd++){
				   $detail_explode=explode("_",$month_array[$dd]);
				 	$attendance_roll_no=$detail_explode[0];
				$month=$detail_explode[1];
				$year=$detail_explode[2]; 
				
				
				
				
							$column_name="";
				 for($i1=1;$i1<=31;$i1++){
				     if($i1<10){
				         $k='0'.$i1;
				     }else{
				       $k=$i1;   
				     }
				$incloumn='intime_'.$k;
				$outcloumn='outtime_'.$k;
				$attendancecloumn=$k;
				$time_in=$intime_array[$month_array[$dd]][$i1];
				$time_out=$timeout_array[$month_array[$dd]][$i1];
				$attendance=$attendance_array[$month_array[$dd]][$i1];
			
				
				$column_name=$column_name.",$incloumn='$time_in',$outcloumn='$time_out',`$attendancecloumn`='$attendance'";
				
				 }
				
				
				
				
			echo	 $que2="update student_attendance1605 set company_name='1' $column_name where attendance_roll_no='$attendance_roll_no' and month='$month' and year='$year'";
			echo "<br>";
				 mysqli_query($conn73,$que2);
				 
				$que111="select * from student_attendance1605  where attendance_roll_no='$attendance_roll_no' and month='$month' and year='$year'";
				$run111=mysqli_query($conn73,$que111) or die(mysqli_error($conn73));
				$j=0;
				while($row111=mysqli_fetch_assoc($run111)){
				    	$sss=$row111['s_no'];
				    if($j>0){
				      
			echo	 $que211="delete from student_attendance1605  where s_no='$sss'";
			echo "<br>";
				 mysqli_query($conn73,$que211);  
				    }
				    $j++;
				}
			
				}
				