<?php include("../attachment/session.php"); ?>
<script>
function for_check(id){
if($('#'+id).prop("checked") == true){
$("."+id).each(function() {
$(this).prop('checked',true);
});
}else{
$("."+id).each(function() {
$(this).prop('checked',false);
});
}
}
function for_message(id,value){
var for_msg=document.getElementById('parents_message_'+id).value;
var value1=for_msg.split('|?|');
var value2=value1[0]+'|?|'+value1[1]+'|?|'+value;
$('#parents_message_'+id).val(value2);
}

    $("#my_form").submit(function(e){
        e.preventDefault();
     var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader_with_id('attendance_detail');
        $.ajax({
            url: access_link+"attendance_management/student_attendance_fill_api.php",
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
			$school_name = $_SESSION["school_name"];
		    
		  
			$default_attendance=$_GET['default_attendance'];
			$student_attendance_class=$_GET['student_attendance_class'];
			if($student_attendance_class!=''){
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
			
			$order_by=$_GET['order_by'];
			if($order_by=='school_roll_no')
			{
			  $order_by= "CAST(`school_roll_no` AS decimal)";
			}

			$student_attendance_date2=explode('-',$student_attendance_date);
			$student_attendance_date3=$student_attendance_date2[2]."-".$student_attendance_date2[1]."-".$student_attendance_date2[0];
			$student_attendance_date4=$student_attendance_date2[2];
			$year=$student_attendance_date2[0];
			$month=$student_attendance_date2[1];
            $day=$student_attendance_date2[2];
		
		  ?>
		  
		  <form  method="post" enctype="multipart/form-data" id='my_form'>
	<input type="hidden" name="student_attendance_date" id="student_attendance_date" value="<?php echo $student_attendance_date; ?>"  />
			  <div class="col-md-3">
			  <label>Present Student <input type="checkbox" name="all_present_student" checked ></label>
			  <input type="text" name="persent_message" id="" value="Dear Parent, Your ward student_name is PRESENT today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name_sms; ?> [SIMPTION]" class="form-control" readonly/>
			  </div>
			   <div class="col-md-3">
			  <label>Half Day Student <input type="checkbox" name="all_halfday_student" checked ></label>
			  <input type="text" name="halfday_message" id="" value="Dear Parent, Your ward student_name is HALF DAY today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name_sms; ?> [SIMPTION]" class="form-control" readonly/>
			  </div>
			  <div class="col-md-3">
			  <label>Absent Student <input type="checkbox" name="all_absent_student" checked ></label>
			  <input type="text" name="absent_message" id="" value="Dear Parent, Your ward student_name is ABSENT today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name_sms; ?> [SIMPTION]" class="form-control" readonly/>
			  </div>
			  <div class="col-md-3">
			  <label>Leave Student <input type="checkbox" name="all_leave_student" checked ></label>
			  <input type="text" name="leave_message" id="" value="Dear Parent, Your ward student_name is on LEAVE today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name_sms; ?> [SIMPTION]" class="form-control"  readonly/>
			  </div>
			  </div>
		     
          
			  <div class=" col-md-12 table-responsive" style="margin-top:20px">
			  <table border="2" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>S No</th>
                  <th>Student ID</th>
                  <th>Student Name</th>
                  <th>Class/Section</th>
                  <th>Class Roll No</th>
                  <th>Contact Number</th>
                  <th>Filled Attendance</th>
                  <th>Student Attendance</th>
                  <th>In Time</th>
                  <th>Out Time</th>
                  <th><input type="checkbox" id="selection" onclick="for_check(this.id);" /> All</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$insert_date=date('d-m-Y h:i:sa');
				$i=$day;
				$touch_column_in='intime_'.$i;
				$touch_column_out='outtime_'.$i;
				$attendance_column=$i;
		        $que34="select student_roll_no,school_roll_no,student_name,student_class,student_class_section,student_rf_id_number,student_sms_contact_number from  student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition3 $filter37 order by $order_by ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$student_id = $row34['student_roll_no'];
				$school_roll_no = $row34['school_roll_no'];
				$student_name = $row34['student_name'];
				$student_class = $row34['student_class'];
				$student_class_section = $row34['student_class_section'];
				$student_rfid = $row34['student_rf_id_number'];
				$student_sms_contact_number= $row34['student_sms_contact_number'];

				$serial_no++;
				$que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from student_attendance where attendance_roll_no='$student_id' and month='$month' and year='$year'  order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				
				if(mysqli_num_rows($run)>0){
				}else{
		  	$que223="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,date,$update_by_insert_sql_column) values('$student_id','$student_name','$student_class','$student_class_section','$student_rfid','$month','$year','$insert_date',$update_by_insert_sql_value);";
				mysqli_query($conn73,$que223) or die(mysqli_error($conn73));
			    $que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from student_attendance where attendance_roll_no='$student_id' and  month='$month' and year='$year'  order by s_no DESC LIMIT 1";
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
                  <td><?php echo $student_id; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_class."/".$student_class_section; ?></td>
                     <td><?php echo $school_roll_no; ?><input type="hidden" name="hidden_id[]" value="<?php echo $s_no; ?>" readonly class="form-control"/>
				  </td>
                  <td><?php echo $student_sms_contact_number; ?></td>
                  <td><?php echo $attendance_get; ?></td>
               
                  <td>
				  <select name="student_attendance[]" onchange="for_message('<?php echo $serial_no; ?>',this.value);" class="form-control">
				  <option <?php if($attendance=='P'){ echo "selected"; } ?> value="P">P</option>
				  <option <?php if($attendance=='P/2'){ echo "selected"; } ?> value="P/2">P/2</option>
				  <option <?php if($attendance=='A'){ echo "selected"; } ?> value="A">A</option>
				  <option <?php if($attendance=='L'){ echo "selected"; } ?> value="L">L</option>
				  <option <?php if($attendance==''){ echo "selected"; } ?> value="">None</option>
				  </select>
				  </td>
				  <td>
				  <input type="text" name="attendance_time[]" value="<?php echo $touch_time_in; ?>" style="border:none;" readonly class="form-control"/>
				  </td><td>
				  <input type="text"  value="<?php echo $touch_time_out; ?>" style="border:none;" readonly class="form-control"/>
				  </td>
				  <td>
				  <input type="checkbox" name="parents_message[]" id="<?php echo 'parents_message_'.$serial_no; ?>"  value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$attendance; ?>" <?php if($student_sms_contact_number==''){ ?> disabled <?php  }else{ ?> class="selection" <?php  } ?> >
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