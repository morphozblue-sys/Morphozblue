<?php include("../attachment/session.php")?>
	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

 <section class="content-header">
      <h1>
        <?php echo $language['Time Table Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-clock-o"></i> <?php echo $language['Time Table']; ?></a></li>
	  <li class="active"><?php echo $language['Teacher Availability']; ?></li>
      </ol>
    </section>
	

	
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Teacher Managemnet</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
   <h3 class="box-title">Please check that you have already marked staff's attendence and have already filled subject wise teacher list</h3>
			<form role="form"  method="post" enctype="multipart/form-data">
			

			  
				
				
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                <table id="table-data" border="1" class="table table-bordered table-striped" width="100%">
                <thead >
				  <tr>
				  <th>S.no</th>
				  <th>Absent <?php echo $language['Teacher Name']; ?></th>
				<?php 
				$total_period=0;
				$day=strtolower(date("l"));
				$que="select * from school_info_class_period where period_code=''";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				$period_name = $row['period_name'];
				$period_code1=$row['period_code'];
					if($period_name!=''){
						$period_coloum_teacher[]=$period_code1."_teacher_".$day;
						$period_coloum_subject[]=$period_code1."_subject_".$day;
					
					$total_period++;
				?>
                  <th><?php echo strtoupper($period_name) ?></th>
				  <?php } } ?>
				  
				
				  
                  </tr>
                </thead>
				<tbody id="example2">
<?php

date_default_timezone_set('Asia/Calcutta');
$current_time=date('Y-m-d H:i:s');
$current_date1=date('d');
$current_month1=date('m');
$current_year1=date('Y');
$quer121="select * from staff_attendance where `$current_date1`!='P' and month='$current_month1' and year='$current_year1' and session_value='$session1' ";
$runn121=mysqli_query($conn73,$quer121) or die(mysqli_error($conn73));
$teacher_list='';
	while($row112=mysqli_fetch_assoc($runn121)){
					$staff_id=$row112['staff_id'];
					$teacher_list=$teacher_list." and emp_id!=".$staff_id;
	}
		$new_teacher_list="";
	$que19="select * from employee_info where emp_categories='Teaching' and emp_status='Active' $teacher_list";
					$run19=mysqli_query($conn73,$que19) or die(mysqli_error($conn73));
					while($row19=mysqli_fetch_assoc($run19)){
					$teacher_name129=$row19['emp_name'];
				
					for($i=0;$i<$total_period;$i++){
				$que342="select * from class_time_table where $period_coloum_teacher[$i]='$teacher_name129'";
					$run342=mysqli_query($conn73,$que342);
if(mysqli_num_rows($run342)>0){
$new_teacher_list[$i]=$new_teacher_list[$i]." and emp_name!='".$teacher_name129."'";
}
}
}
					$que1="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
					$serial_no=0;
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					while($row1=mysqli_fetch_assoc($run1)){
					$teacher_name=$row1['emp_name'];
					$emp_id=$row1['emp_id'];
			

$quer12="select * from staff_attendance where `$current_date1`!='P' and month='$current_month1' and year='$current_year1' and session_value='$session1' and staff_id='$emp_id'";
$runn12=mysqli_query($conn73,$quer12) or die(mysqli_error($conn73));
if(mysqli_num_rows($runn12)>0){
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no ?></td>
					<td><?php echo $teacher_name ?></td>
					<?php
					for($i=0;$i<$total_period;$i++){
					$que="select * from class_time_table where $period_coloum_teacher[$i]='$teacher_name'";
					$run=mysqli_query($conn73,$que);
					$total=0;
					$total_available_teacher=0;
					$class_name[]='';
					$section_name[]='';
					while($row=mysqli_fetch_assoc($run)){
					$class_name[$total]=$row['class'];
					$section_name[$total]=$row['section'];
					$period_subject[$total]=$row[$period_coloum_subject[$i]];
             $teacher_perferencer="";
         $que1121="select * from employee_info where emp_categories='Teaching' and emp_status='Active' and emp_subject_preferred LIKE '%$period_subject[$total]%' and emp_class_preferred LIKE '%$class_name[$total]%' $teacher_list $new_teacher_list[$i]";
					$run1121=mysqli_query($conn73,$que1121) or die(mysqli_error($conn73));
					while($row1121=mysqli_fetch_assoc($run1121)){
					$teacher_name12[$total_available_teacher]=$row1121['emp_name'];
					$teacher_perferencer=$teacher_perferencer." and emp_name!='".$row1121['emp_name']."'";
					$total_available_teacher++;
					}
				
					$que1121="select * from employee_info where emp_categories='Teaching' and emp_status='Active' and emp_subject_preferred LIKE '%$period_subject[$total]%' $teacher_list $teacher_perferencer $new_teacher_list[$i]";
					$run1121=mysqli_query($conn73,$que1121) or die(mysqli_error($conn73));
					while($row1121=mysqli_fetch_assoc($run1121)){
					$teacher_name12[$total_available_teacher]=$row1121['emp_name'];
					$teacher_perferencer=$teacher_perferencer." and emp_name!='".$row1121['emp_name']."'";
					$total_available_teacher++;
					}
					
					$que1121="select * from employee_info where emp_categories='Teaching' and emp_status='Active'  and emp_class_preferred LIKE '%$class_name[$total]%' $teacher_list $teacher_perferencer $new_teacher_list[$i]";
					$run1121=mysqli_query($conn73,$que1121) or die(mysqli_error($conn73));
					while($row1121=mysqli_fetch_assoc($run1121)){
					$teacher_name12[$total_available_teacher]=$row1121['emp_name'];
					$teacher_perferencer=$teacher_perferencer." and emp_name!='".$row1121['emp_name']."'";
					$total_available_teacher++;
					}
					
				$que1121="select * from employee_info where emp_categories='Teaching' and emp_status='Active'  $teacher_list $teacher_perferencer $new_teacher_list[$i]";
					$run1121=mysqli_query($conn73,$que1121) or die(mysqli_error($conn73));
					while($row1121=mysqli_fetch_assoc($run1121)){
					$teacher_name12[$total_available_teacher]=$row1121['emp_name'];
					$teacher_perferencer=$teacher_perferencer." and emp_name!='".$row1121['emp_name']."'";
					$total_available_teacher++;
					}
            
					
					$total++;
					} 
					if($total==0)
					{?>
					
					<td>
					<font>--</font>
                    </td>
					<?php
					}
					else{
					?>
					
					<td>
                       <?php 
					     for($j=0;$j<$total;$j++){
					   echo $class_name[$j]."(".$section_name[$j].")<br>[".$period_subject[$j]."]<br>";
					   } 
					   ?>
					   	<font color="green"><?php 
					     for($j=0;$j<$total_available_teacher;$j++){
					   echo $teacher_name12[$j]."<br>";
					   } 
					   ?></font>
                    </td>
			<?php		}  }
			
			?>
			
		
			
			</tr>
			<?php
}
}
					?>
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  </form>
		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('table-data', 'teacher availability')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
		  </div>
		  
		  
		  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
		  
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("table-data");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>


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
	