<?php include("../attachment/session.php"); ?>

<script>
function attendance_list(){

var staff_attendance_year=document.getElementById('staff_attendance_year').value;
var staff_attendance_month=document.getElementById('staff_attendance_month').value;
attendance_date=staff_attendance_year+"-"+staff_attendance_month+"-01";
$("#attendance_date").val(attendance_date);
view_attendance();
}
function month_list(value){
	    $('#staff_attendance_month').html("<option value='' >Loading....</option>"); 
          
       $.ajax({
			  type: "POST",
              url: access_link+"attendance_management/month_list_ajax.php?year="+value+"",
              cache: false,
              success: function($detail){
                var str =$detail;                
                $("#staff_attendance_month").html(str);
               
              }
           });
}
</script>

      <?php
			$emp_department=$_GET['emp_department'];
			$staff_attendance_date=$_GET['staff_attendance_date'];
			$condition="";
			if($emp_department!='All'){
			    $condition="and emp_categories='$emp_department'";
			}
					$emp_attendance_register=$_GET['emp_attendance_register'];
			$condition1="";
			if($emp_attendance_register!='All'){
			    $condition1="and emp_attendance_register='$emp_attendance_register'";
			}
			$staff_attendance_date2=explode('-',$staff_attendance_date);
			$staff_attendance_date3=$staff_attendance_date2[2]."-".$staff_attendance_date2[1]."-".$staff_attendance_date2[0];
			$staff_attendance_date4=$staff_attendance_date2[2];
			$year=$staff_attendance_date2[0];
			$month=$staff_attendance_date2[1];
            $day=intval($staff_attendance_date2[2]);
		
		  ?>
            <div class="col-md-12">
                		<div class="col-md-2">
			  <label>Year : </label>
			  <select name="staff_attendance_year" id="staff_attendance_year" onchange="attendance_list();month_list(this.value);" class="form-control">
			      <?php $current_year=date('Y'); 
			      for($n=2019;$n<=$current_year;$n++){
			      
			      ?>
			  <option <?php if($n==$year){ echo "selected"; } ?> value="<?php echo $n; ?>"><?php echo $n; ?></option>
<?php } ?>
			  </select>
			  </div>
            <div class="col-md-2">
			  <label>Month : </label>
			  <select name="staff_attendance_month" id="staff_attendance_month" onchange="attendance_list();" class="form-control">
			      
			      <?php
			        $month_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
$current_month1=date('m');
     for($k=0;$k<$current_month1;$k++){
         $y=$k+1;
         if($y<10){
             $y='0'.$y;
             
         } ?>
          <option <?php if($y==$month){ echo "selected"; } ?> value="<?php echo $y; ?>"><?php echo $month_array[$k]; ?></option>
         <?php
     }
 ?>
			  </select>
			 
			  </div>
	
			 
		<div class="col-md-8">
		    <br>
 <button style="width:100px;" type="button" class="btn btn-primary">Present</button>
 <button style="width:100px;" type="button" class="btn btn-danger">Absent</button>
 <button style="width:100px;" type="button" class="btn btn-warning">Leave</button>
 <button style="width:100px;" type="button" class="btn btn-info">Holiday</button>
 <button style="width:100px;" type="button" class="btn btn-success">Sunday</button>
 <button style="width:100px;" type="button" class="btn btn-default">Not Filled</button>
            </div>
            </div>
           
            <div class="col-md-12 table-responsive" style="margin-top:20px">
              <table id="example1" class="table table-bordered table-striped" style="width: 1600px; overflow: scroll;">
                <thead class="my_background_color">
				<?php
				$current_month1=$month;
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
                    <th>S NO</th>
                  <th>Employee Name</th>
                  <th colspan="10"><span id="by_month"><?php echo strtoupper($month_wise); ?></span> Month Attendance</th>
                  <th colspan="30">Department : <?php echo $emp_department; ?> </th>
                </tr>
                </thead>
                 <tbody id="stud_list">
                <tr>
                    <td></td>
				  <td><button type="button" class="btn btn-success" style='font-size:14px;'>Date : </button></td>
			
				  <?php
				  $date1=$year.'-'.$month.'-01';
				  $count = date(' t ', strtotime($date1) );
					
				  for($i=1;$i<=$count;$i++){
				  
				  $a=$i;
				  
				  ?><td style="margin=0px;padding:0px">
				  <button style="width:25px;padding:2px;height:25px;font-size:14px" type="button" class="btn btn-success"><?php echo $a; ?></button>
				  </td>
				  <?php } ?>
				  <td style="margin=0px;padding:0px">
				  <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-primary">Present</button>
				   </td><td style="margin=0px;padding:0px">
				  <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-danger">Absent</button>
				   </td><td style="margin=0px;padding:0px">
				  <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-warning">Leave</button>
				   </td><td style="margin=0px;padding:0px">
                  <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-info">Holiday</button>
                   </td><td style="margin=0px;padding:0px">
				     <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-success">Sunday</button>
				      </td><td style="margin=0px;padding:0px">
                    <button style="width:50px;padding:1px;font-size:12px;height:25px;" type="button" class="btn btn-default">Not Fill</button>
				  </td>
				</tr>
				<?php
    $que34="select emp_id,emp_categories,emp_name,emp_designation,emp_rf_id_no from employee_info where emp_status='Active'$condition$condition1 order by emp_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$emp_id = $row34['emp_id'];
				$emp_department = $row34['emp_categories'];
				$emp_name = $row34['emp_name'];
				$emp_designation = $row34['emp_designation'];
				$emp_rf_id_no = $row34['emp_rf_id_no'];

				$serial_no++;
				$que="select * from staff_attendance where staff_id='$emp_id' and month='$month' and year='$year'  order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					if(mysqli_num_rows($run)>0){
				while($row=mysqli_fetch_assoc($run)){

			
					$date2=$year.'-'.$month.'-01';
					$number = date(' t ', strtotime($date2) );
					
					$day_name = date(' N ', strtotime($date2) );
				    $day_diff=8-$day_name;
				?>
                <tr>
                  <td style='font-size:14px;'><?php echo $serial_no; ?></td>
                  <td style='font-size:14px;'><?php echo $emp_name; ?></td>
				  
				  <?php
				  $total_present=0;
				  $total_absent=0;
                  $total_holiday=0;
				  $total_leave=0;
				  $total_sunday=0;
				  $total_not_mark=0;
				  $date3=$year.'-'.$month.'-';
				    for($i1=1;$i1<=31;$i1++){
				         $holiday[$i1]='';
				         $holiday_name[$i1]='';
				    }
               $que6="select * from holiday_manage where holiday_date like '$date3%'";
				$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
				while($row5=mysqli_fetch_assoc($result)){
				    $event_date=$row5['holiday_date'];
				    $event_date1=explode("-",$event_date);
                $holiday[intval($event_date1[2])]="H";
                $holiday_name[intval($event_date1[2])]= $row5['holiday_name'];
                }
				  
				  	  for($i=1;$i<=$number;$i++){
			
				 
				  $x=$i;
				  if($i<10){
				     $x='0'.$i;
				   }else{
				       $x=$i;
				   }
				  $a=$row[''.$x];
				  $b=$a;
				  
					$touch_time=$row['intime_'.$x]."-".$row['outtime_'.$x];
			  if($i==$day_diff || $i==$day_diff+7 || $i==$day_diff+14 || $i==$day_diff+21 || $i==$day_diff+28){
			      if($a==''){
				  $a="S";
			      }
				    $total_sunday++;
				  }
				  if($a==''){
                   $a=$holiday[intval($i)];
                   $h=$holiday_name[intval($i)];
               }
				   if($i<10){
				        if($a==''){
				  $a=strtoupper('0'.$i);
				  }
				   }else{
				        if($a==''){
				  $a=strtoupper($i);
				  }
				   }
               
                
                    if($a=='P'){
				  $total_present=$total_present+1;
				  }elseif($a=='P/2'){
				   $total_present=$total_present+0.5;
				  }elseif($a=='A'){
				  $total_absent++;
				  }elseif($a=='L'){
				  $total_leave++;
				  }elseif($a=='H'){
				  $total_holiday++;
				  }else{
					  $total_not_mark++;
				  }
				  ?> 
				   <td style="margin=0px;padding:0px">
              <button type="button" class="<?php if($a=='P'){ echo 'btn btn-primary'; }elseif($a=='A'){ echo 'btn btn-danger'; }elseif($a=='H'){ echo 'btn btn-info'; }elseif($a=='P/2'){ echo 'btn btn-primary'; }elseif($a=='L'){ echo 'btn btn-warning'; }elseif($a=='S'){ echo 'btn btn-success'; }elseif($b==''){ echo 'btn btn-default'; } ?>" title="<?php if($a=='P'){ echo $touch_time; }elseif($a=='P/2'){ echo $touch_time; }elseif($a=='A'){ echo 'Absent'; }elseif($a=='L'){ echo 'Leave'; }elseif($a=='H'){ echo $h; }elseif($a=='S'){ echo 'Sunday'; }elseif($b==''){ echo 'Not Fill'; } ?>" style="width:25px;padding:2px;height:25px;font-size:14px;"><?php echo $a; ?></button>
</td>
                  <?php } ?>
                   <td style="margin=0px;padding:0px">
				  <button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-primary"><?php echo $total_present; ?></button>
				   </td><td style="margin=0px;padding:0px">
				  <button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-danger"><?php echo $total_absent; ?></button>
				   </td><td style="margin=0px;padding:0px">
				  <button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-warning"><?php echo $total_leave; ?></button>
				   </td><td style="margin=0px;padding:0px">
                  <button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-info"><?php echo $total_holiday; ?></button>
                   </td><td style="margin=0px;padding:0px">
				<button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-info"><?php echo $total_sunday; ?></button>
				 </td><td style="margin=0px;padding:0px">
                  <button style="width:50px;font-size:14px;height:25px;padding:2px;" type="button" class="btn btn-default"><?php echo $total_not_mark-$total_sunday; ?></button>
				  
				  </td>
                </tr>
				<?php } } } ?>

                </tbody>
             </table>
            </div>
           
   

