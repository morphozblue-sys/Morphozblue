<?php include("../attachment/session.php"); ?>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();
     var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader_with_id('attendance_detail');
        $.ajax({
            url: access_link+"attendance_management/emp_attendance_fill_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   fill_attendance();
            }
			}
         });
      });

</script>

            <?php
		
			$default_attendance=$_GET['default_attendance'];
			$emp_department=$_GET['emp_department'];
			$condition="";
			if($emp_department!='All'){
			    $condition="and emp_categories='$emp_department'";
			}
			$emp_attendance_register=$_GET['emp_attendance_register'];
			$condition1="";
			if($emp_attendance_register!='All'){
			    $condition1="and emp_attendance_register='$emp_attendance_register'";
			}
			$staff_attendance_date=$_GET['staff_attendance_date'];
			$staff_attendance_date2=explode('-',$staff_attendance_date);
			$staff_attendance_date3=$staff_attendance_date2[2]."-".$staff_attendance_date2[1]."-".$staff_attendance_date2[0];
			$staff_attendance_date4=$staff_attendance_date2[2];
			$year=$staff_attendance_date2[0];
			$month=$staff_attendance_date2[1];
            $day=$staff_attendance_date2[2];
		
		  ?>
		  
		  <form  method="post" enctype="multipart/form-data" id='my_form'>
	<input type="hidden" name="staff_attendance_date" id="staff_attendance_date" value="<?php echo $staff_attendance_date; ?>"  />
            <div class="col-md-12 table-responsive" style="margin-top:20px">
			  <table border="2" class="table table-bordered table-striped" style="width:100%">
                <thead class="my_background_color">
                <tr>
                  <th>S No</th>
                  <th>EMP ID</th>
                  <th>EMP School</th>
                  <th>EMP Name</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>Filled</th>
                  <th>Attendance</th>
                   <th>In Time</th>
                  <th>Out Time</th>
                </tr>
                </thead>
                <tbody>
				
<?php
				$insert_date=date('d-m-Y h:i:sa');
				$i=$day;

				$touch_column_in='intime_'.$i;
				$touch_column_out='outtime_'.$i;
				$attendance_column=$i;
		        $que34="select emp_id,emp_categories,emp_name,emp_designation,emp_rf_id_no from employee_info where emp_status='Active'$condition1$condition order by emp_attendance_priority ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$emp_id = $row34['emp_id'];
				$emp_department = $row34['emp_categories'];
				$emp_name = $row34['emp_name'];
				$emp_designation = $row34['emp_designation'];
				$emp_rfid = $row34['emp_rf_id_no'];
				$serial_no++;
				$que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from staff_attendance where staff_id='$emp_id' and month='$month' and year='$year' order by s_no DESC LIMIT 1 ";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				
				if(mysqli_num_rows($run)>0){
				}else{
		       	$que223="insert into staff_attendance (staff_id,staff_name,staff_type,staff_designation,emp_rf_id_no,month,year,date,$update_by_insert_sql_column) values('$emp_id','$emp_name','$emp_department','$emp_designation','$emp_rfid','$month','$year','$insert_date',$update_by_insert_sql_value);";
				mysqli_query($conn73,$que223) or die(mysqli_error($conn73));
			    $que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from staff_attendance where staff_id='$emp_id' and  month='$month' and year='$year' order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				}
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$touch_time_in=$row[$touch_column_in];
				$touch_time_out=$row[$touch_column_out];
				$attendance=$row[$attendance_column];
		
			
				$attendance_get=$attendance;
		if($attendance==''){
		    $attendance=$default_attendance;
		}
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $emp_id; ?></td>
                  <td><?php echo $emp_id_school; ?></td>
                  <td><?php echo $emp_name; ?></td>
                  <td><?php echo $emp_department; ?><input type="hidden" name="hidden_id[]" value="<?php echo $s_no; ?>" readonly /></td>
                  <td><?php echo $emp_designation; ?></td>
                  <td><?php echo $attendance_get; ?></td>
				
                  <td>
				  <select name="staff_attendance[]" onchange="for_message('<?php echo $serial_no; ?>',this.value);"  class="form-control">
				  <option <?php if($attendance=='P'){ echo "selected"; } ?> value="P">P</option>
				  <option <?php if($attendance=='P/2'){ echo "selected"; } ?> value="P/2">P/2</option>
				  <option <?php if($attendance=='A'){ echo "selected"; } ?> value="A">A</option>
				  <option <?php if($attendance=='L'){ echo "selected"; } ?> value="L">L</option>
				  <option <?php if($attendance=='' && $touch_time!=''){ echo "selected"; } ?> value="">None</option>
				  </select>
				  </td>
				 
				  <td>
				  <input type="text" name="attendance_time[]" value="<?php echo $touch_time_in; ?>" style="border:none;" readonly class="form-control"/>
				  </td><td>
				  <input type="text"  value="<?php echo $touch_time_out; ?>" style="border:none;" readonly class="form-control"/>
				  </td>
                </tr>
				<?php } }?>
                </tbody>
              </table>
			  </div>
			  <div class="col-md-12">
			  <center><button type="submit" name="submit1" id="submitButtonId" class="btn btn-primary">Submit</button></center>
			  </div>
           
     
          </form>