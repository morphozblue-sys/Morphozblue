<?php include("../attachment/session.php"); 
  $condition="";
          $condition1="";
          $condition2="";
          $condition3="";
            $emp_department=$_GET['emp_department'];
            $emp_attendance_register=$_GET['emp_attendance_register'];
            $date_from=$_GET['date_from'];
            $date_to=$_GET['date_to'];
              if($emp_department!='All'){
                  $condition=" and  emp_categories='$emp_department'";
              }
           if($emp_attendance_register!='All'){
                 $condition1=" and  emp_attendance_register='$emp_attendance_register'";
            }
          
          
           



?>
 <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance List</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn btn-success"  width="200px" onclick="exportTableToExcel('printTable', 'Staff Daily Attendance Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>STAFF ATTENDANCE DAILY REPORT CLASSWISE</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $_SESSION['school_code']; ?></b></td>
			</tr>
			<tr>
			<td style="float:left"><b>Current Date : <?php echo date('d-m-Y'); ?></b></td>
			<td><center><b>FROM : <?php echo $date_from; ?> TO : <?php echo $date_to; ?></b></center></td>
			<td style="float:right"><b>Department : <?php echo $emp_department; ?></b></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Department</th>
								  <th>Total Employee</th>
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
					$que0="select * from employee_info where emp_status!='Deleted' $condition group by emp_categories";
					$run0=mysqli_query($conn73,$que0);
					$serial_no=0;
					$grand_total_staff=0;
					$grand_total_present=0;
					$grand_total_absent=0;
					$grand_total_leave=0;
					$grand_total_notmark=0;
					while($row0=mysqli_fetch_assoc($run0)){

					$s_no=$row0['s_no'];
					$emp_department = $row0['emp_categories'];
					
					$serial_no++;
					
					$que="select emp_id from employee_info where emp_status='Active'  and emp_categories='$emp_department'$condition1 ";
					$run=mysqli_query($conn73,$que);
					$total_staff=0;
					$total_present=0;
					$total_absent=0;
					$total_leave=0;
					$total_notmark=0;
					$total_sunday=0;
					while($row=mysqli_fetch_assoc($run)){
					$emp_id=$row['emp_id'];
					$total_staff++;
					
					$que1="select * from staff_attendance where staff_id='$emp_id' $month_condition $year_condition  order by s_no DESC";
					$run1=mysqli_query($conn73,$que1);
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
					$grand_total_staff=$grand_total_staff+$total_staff;
					$grand_total_present=$grand_total_present+$total_present;
					$grand_total_absent=$grand_total_absent+$total_absent;
					$grand_total_leave=$grand_total_leave+$total_leave;
					$grand_total_notmark=$grand_total_notmark+$total_notmark;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $emp_department; ?></td>
					<td><?php echo $total_staff; ?></td>
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
					<td><span style="font-weight:bold;"><?php echo $grand_total_staff; ?></span></td>
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
                     <div class="row">
<div class="col-md-6">
<center><button type="button" class="btn btn-success"  width="200px" onclick="exportTableToExcel('printTable', 'Staff Daily Attendance Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn btn-info"  width="200px"  onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>
  </div>
  </div>
 <script>
     
     function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
} 
 </script> 