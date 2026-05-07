<?php include("../attachment/session.php"); ?>
            <?php
			
			
			$attendance_emp_department=$_GET['attendance_emp_department'];
			if($attendance_emp_department!='All'){
			    $condition=" and emp_categories='$attendance_emp_department'";
			}else{
			    $condition="";
			}
			$emp_attendance_register=$_GET['emp_attendance_register'];
			if($emp_attendance_register!='All'){
			    $condition1=" and emp_attendance_register='$emp_attendance_register'";
			}else{
			    $condition1="";
			}
			$attendance_staff_date=$_GET['attendance_staff_date'];
			
		

			$attendance_report_type=$_GET['attendance_report_type'];
			$attendance_staff_month=$_GET['attendance_staff_month'];
			$attendance_staff_year=$_GET['attendance_staff_year'];
			
			$attendance_date=$_GET['attendance_date'];
if($attendance_report_type=='Daily'){
    	$attendance_staff_date2=explode('-',$attendance_date);
			$attendance_date=$attendance_staff_date2[2]."-".$attendance_staff_date2[1]."-".$attendance_staff_date2[0];
			$year=$attendance_staff_date2[0];
			$month=$attendance_staff_date2[1];
            $day=intval($attendance_staff_date2[2]);
            $count1=1;
}elseif($attendance_report_type=='Monthly'){
    

		$month=$attendance_staff_month;
        $year=$attendance_staff_year;
    $date2=$year.'-'.$month.'-01';
	$count1 = date(' t ', strtotime($date2) );
}

	$month_date_name = date('F', mktime(0, 0, 0, $month, 10));
		  ?>
 <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Staff Attendance List</h5>
              </div>
			   <div class="box-body">
			              <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Staff Attendance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
				<span style="font-size:20px;font-weight:bold"><center>Staff Attendance Report</center></span>
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
			  <center><b>Date : <?php echo $_GET['attendance_date']; ?></b></center>
			  </div>

            <div class="col-md-12 table-responsive" >
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">

		  


			  <div class="col-md-12 table-responsive">
			  <table border="2" id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>Emp id</th>
                  <th>Emp Name</th>
                  <th>Emp Department</th>
                  <th>Emp Designation</th>
                  <?php
                  if($attendance_report_type=='Daily'){
                  
                  ?>
                   <th>Date</th>
                   <th>Attendance</th>
                  <?php
                  }if($attendance_report_type=='Monthly'){
                      ?>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Leave</th>
                  <th>Not Mark</th>
                   <?php
                  } ?>
                </tr>
                </thead>
                <tbody>
				<?php
         $que34="select emp_id,emp_name,emp_categories,emp_attendance_register,emp_designation from employee_info where emp_status!='Deleted' $condition$condition1$condition2$condition3 order by emp_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$emp_id = $row34['emp_id'];
				$emp_name = $row34['emp_name'];
				$emp_department = $row34['emp_categories'];
				$emp_attendance_register = $row34['emp_attendance_register'];
				$emp_designation = $row34['emp_designation'];

			
				$present=0;
				$absent=0;
				$leave=0;
				$not_mark=0;
				$que="select * from staff_attendance where staff_id='$emp_id' and month='$month' and year='$year'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					if(mysqli_num_rows($run)>0){
					    	$serial_no++;
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
	}
				}
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $emp_id; ?></td>
                  <td><?php echo $emp_name; ?></td>
                  <td><?php echo $emp_designation; ?></td>
                  <td><?php echo $emp_department."/".$emp_attendance_register; ?></td>
                   <?php
                  if($attendance_report_type=='Daily'){
                  
                  ?>
                   <td><?php echo $attendance_date; ?></td>
                   <th><?php echo $a; ?></th>
                  <?php
                  }if($attendance_report_type=='Monthly'){
                      ?>
              
                   <td><?php echo $present; ?></td>
                   <td><?php echo $absent; ?></td>
                   <td><?php echo $leave; ?></td>
                   <td><?php echo $not_mark; ?></td>
                   <?php
                  } ?>
                </tr>
				<?php } }  ?>
                </tbody>
              </table>
			  </div>
			  </div>
	  <div class="row">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel_function('printTable', 'Staff Attendance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print_function('printTable');"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
			  </div>
			  </div>
<script>
    
    function exportTableToExcel_function(tableID, filename = ''){
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


function for_print_function()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>			  
			  