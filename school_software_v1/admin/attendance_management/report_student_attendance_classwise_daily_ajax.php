<?php include("../attachment/session.php"); 
  $condition="";
          $condition1="";
          $condition2="";
          $condition3="";
            $student_class=$_GET['student_class'];
            $student_class_section=$_GET['student_class_section'];
            $student_class_stream=$_GET['student_class_stream'];
            $student_class_group=$_GET['student_class_group'];
            $date_from=$_GET['date_from'];
            $date_to=$_GET['date_to'];
              if($student_class!='All' && $student_class!=''){
                  $condition=" and  class_name='$student_class'";
              }
           if($student_class_section!='All'){
                 $condition1=" and  student_class_section='$student_class_section'";
            }
           if($student_class_stream!='All'){
                 $condition2=" and student_class_stream='$student_class_stream'";
            }
           if($student_class_group!='All'){
                 $condition3=" and student_class_group='$student_class_group'";
            }
          
           



?>
  <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	 <li><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-dashboard"></i>  Attendance</a></li>
	  <li class="active"> Student Attendance Report</li>
      </ol>
    </section>
 <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance List</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn btn-success"  width="200px" onclick="exportTableToExcel('printTable', 'Student Daily Attendance Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn btn-info"  width="200px"  onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        
            <div class="col-md-12 table-responsive" id="printTable">
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left"><b>Dise Code : <?php echo $_SESSION['school_dise_code']; ?></b></td>
			<td><center><b>STUDENT ATTENDANCE DAILY REPORT CLASSWISE</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $_SESSION['school_code']; ?></b></td>
			</tr>
			<tr>
			<td style="float:left"><b>Current Date : <?php echo date('d-m-Y'); ?></b></td>
			<td><center><b>FROM : <?php echo $date_from; ?> TO : <?php echo $date_to; ?></b></center></td>
			<td style="float:right"><b>Class (Sec) : <?php echo $class_name.' ( '.$section_name.' )'; ?></b></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Class Name</th>
								  <th>Total Student</th>
								  <th>Present</th>
								  <th>Absent</th>
								  <th>Leave</th>
								  <th>Not Mark</th>
								</tr>
						</thead>
					<tbody>
					<?php
					$date_from1=explode("-",$date_from);
					$date_to1=explode("-",$date_to);
						if($date_from!='' && $date_to!=''){
			$month_condition=" and month='$date_from1[1]'";
			$year_condition=" and year='$date_from1[0]'";
			}else{
			$month_condition="";
			$year_condition="";
			}
					$que0="select * from school_info_class_info where 1='1'$condition";
					$run0=mysqli_query($conn73,$que0);
					$serial_no=0;
					$grand_total_student=0;
					$grand_total_present=0;
					$grand_total_absent=0;
					$grand_total_leave=0;
					$grand_total_notmark=0;
					while($row0=mysqli_fetch_assoc($run0)){

					$s_no=$row0['s_no'];
					$class_name = $row0['class_name'];
					
					$serial_no++;
					
				 	$que="select student_roll_no from  student_admission_info where student_status='Active' and session_value='$session1' and student_class='$class_name'$condition1 $filter37";
					$run=mysqli_query($conn73,$que);
					$total_student=0;
					$total_present=0;
					$total_absent=0;
					$total_leave=0;
					$total_notmark=0;
					$total_sunday=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_id=$row['student_roll_no'];
					$total_student++;
					
					$que1="select * from student_attendance where attendance_roll_no='$student_id' $month_condition $year_condition order by s_no DESC limit 1 ";
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					if(mysqli_num_rows($run1)>0){
					 
					while($row1=mysqli_fetch_assoc($run1)){
					    
                  
                    
                        for($i=intval($date_from1[2]);$i<=intval($date_to1[2]);$i++){
                      
				  $x=$i;
				  if($i<10){
				     $x='0'.$i;
				   }else{
				       $x=$i;
				   }
	$a=$row1[''.$x];
                      
                        if($a=='P'){
                            $total_present++;
                        }elseif($a=='P/2'){
                            $total_present=$total_present+0.5;
                            $total_absent=$total_absent+0.5;
                        }elseif($a=='A'){
                            $total_absent++;
                        }elseif($a=='L'){
                            $total_leave++;
                        }elseif($a==''){
                            $total_notmark++;
                        }//elseif($a=='S'){
                        //    $total_sunday++;
                        //}
                        
                       
                        }
					    
					}
					}else{
					    for($i=intval($date_from1[2]);$i<=intval($date_to1[2]);$i++){
					        $total_notmark++;
					    }
					}
					
					}
					$grand_total_student=$grand_total_student+$total_student;
					$grand_total_present=$grand_total_present+$total_present;
					$grand_total_absent=$grand_total_absent+$total_absent;
					$grand_total_leave=$grand_total_leave+$total_leave;
					$grand_total_notmark=$grand_total_notmark+$total_notmark;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $class_name; ?></td>
					<td><?php echo $total_student; ?></td>
					<td><?php echo $total_present; ?></td>
					<td><?php echo $total_absent; ?></td>
					<td><?php echo $total_leave; ?></td>
					<td><?php echo $total_notmark; ?></td>
					<!--<td><?php echo ''; ?></td>-->
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="2"><span style="float:right;font-weight:bold;">Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_student; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_present; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_absent; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_leave; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_notmark; ?></span></td>
					<!--<td><span style="font-weight:bold;"><?php echo ''; ?></span></td>-->
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
                     <div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn btn-success"  width="200px" onclick="exportTableToExcel('printTable', 'Student Daily Attendance Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn btn-info"  width="200px"  onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>
  </div>
  </div>