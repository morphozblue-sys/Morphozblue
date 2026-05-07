<?php include("../attachment/session.php"); ?>
<script>
function attendance_list(){

var emp_id=document.getElementById('emp_id').value;
var month=document.getElementById('staff_attendance_month').value;
var year=document.getElementById('staff_attendance_year').value;
	var data12="emp_id="+emp_id+"&month="+month+"&year="+year;
	post_content('attendance_management/student_attendance_list_view',data12);
}
function month_list(value){
	    $('#staff_attendance_month').html("<option value='' >Loading....</option>"); 
          
       $.ajax({
			  type: "POST",
              url: access_link+"attendance_management/month_list_ajax.php.php?year="+value+"",
              cache: false,
              success: function($detail){
                var str =$detail;                
                $("#staff_attendance_month").html("<option value='All' >All</option>");
                $("#staff_attendance_month").append(str);
               
              }
           });
}
</script>

 
          <?php
			$emp_id=$_GET['emp_id'];
			$staff_attendance_month=$_GET['month'];
			$staff_attendance_year=$_GET['year'];
			$emp_name=$_GET['emp_name'];
			$emp_department=$_GET['emp_department'];
		$month=$staff_attendance_month;
        $year=$staff_attendance_year;

		  ?>
		    <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	 <li><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-dashboard"></i>  Attendance</a></li>
	  <li class="active"> Staff Attendance View</li>
      </ol>
    </section>
		<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance List</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
                    
			       <div class="col-md-2">
			  <label>Year : </label>
						  <select name="staff_attendance_year" id="staff_attendance_year" onchange="attendance_list();month_list(this.value);" class="form-control">
			      <?php $current_year=date('Y'); 
			      for($n=2020;$n<=$current_year;$n++){
			      
			      ?>
			  <option <?php if($n==$staff_attendance_year){ echo "selected"; } ?> value="<?php echo $n; ?>"><?php echo $n; ?></option>
<?php } ?>
			  </select>
			  </div>
			            <div class="col-md-2">
			  <label>Month : </label>
					  <select name="staff_attendance_month" id="staff_attendance_month" onchange="attendance_list();" class="form-control">
					      <option  value="All">All</option>
			      <?php
			        $month_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
$current_month1=date('m');
     for($k=0;$k<$current_month1;$k++){
         $y=$k+1;
         if($y<10){
             $y='0'.$y;
             
         } ?>
          <option <?php if($y==$staff_attendance_month){ echo "selected"; } ?> value="<?php echo $y; ?>"><?php echo $month_array[$k]; ?></option>
         <?php
     }
 ?>
			  </select>
			  </div>
			  <input type="hidden"  id="emp_id" value="<?php echo $emp_id; ?>" />
			  <input type="hidden"  id="month" value="<?php echo $month; ?>" />
			  <input type="hidden"  id="year" value="<?php echo $year; ?>" />
	
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
            </div>
            </div>
            </div>
           
        <div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance List</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12 table-responsive">
              <table id="example1" class="table table-bordered table-striped" style="width: 1500px; overflow: auto;">
                <thead class="my_background_color">
				<?php
				$current_month1=$month;
				$month_wise='';

			
				if($month=="All"){
				    $current_month=date('m');
				    if(intval($current_month)>3){
				    $month_arrry=array("04", "05", "06", "07", "08", "09", "10", "11", "12", "01", "02", "03");
				    $year_arrry=array($year, $year, $year, $year, $year, $year, $year, $year, $year, $year+1, $year+1, $year+1);
				}else{
				    $month_arrry=array("04", "05", "06", "07", "08", "09", "10", "11", "12", "01", "02", "03");
				    $year_arrry=array($year-1, $year-1, $year-1, $year-1, $year-1, $year-1, $year-1, $year-1, $year-1, $year, $year, $year);
			
				}
				}else{
				  	$month_arrry=array($month);
				    $year_arrry=array($year);
			  
				}
								if($current_month1=="All") 
					   $month_wise="All";
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
				  <td><button type="button" class="btn btn-success">Date : </button></td>
				  <td colspan="2">
				  <?php
				  $date1=$year_arrry[$r].'-'.$month_arrry[$r].'-01';
				  $count = date(' t ', strtotime($date1) );
					
				  for($i=1;$i<=31;$i++){
				  
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
				for($r=0;$r<count($month_arrry);$r++){
				$que="select * from staff_attendance where staff_id='$emp_id' and month='$month_arrry[$r]' and year='$year_arrry[$r]' order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				if(mysqli_num_rows($run)>0){
		
				$current_month1=$month_arrry[$r];
								if($current_month1=="All") 
					   $month_wise="All";
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
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$staff_id = $row['staff_id'];
			
			
				
				
					$date2=$year_arrry[$r].'-'.$month_arrry[$r].'-01';
					$number = date(' t ', strtotime($date2) );
					
					$day_name = date(' N ', strtotime($date2) );
				    $day_diff=8-$day_name;
				?>
                <tr>
                  <td><?php echo $month_wise."-".$year_arrry[$r]; ?></td>
				  <td colspan="2">
				  <?php
				  $total_present=0;
				  $total_absent=0;
                  $total_holiday=0;
				  $total_leave=0;
				  $total_sunday=0;
				  $total_not_mark=0;
				   $date3=$year_arrry[$r].'-'.$month_arrry[$r].'-';
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
                
				  
                  <?php }
               for($m=0;$m<31-$number;$m++){ ?>
                   <td style="margin=0px;padding:0px">  <button type="button" class="btn" style="width:25px;padding-left:5px;color:white;"></button></td>

               <?php     
               }
                  
                  
                  
                  ?>
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
            </div>
            </div>
           


