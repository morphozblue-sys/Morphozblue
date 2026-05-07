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
            url: access_link+"attendance_management/student_attendance_sms_api.php",
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
				   get_list();
            }
			}
         });
      });

</script>

            <?php
			$school_name = $_SESSION["school_info_school_name5"];
		    
		  
			$attendance_type=$_GET['attendance_type'];
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

			$student_attendance_date2=explode('-',$student_attendance_date);
			$student_attendance_date3=$student_attendance_date2[2]."-".$student_attendance_date2[1]."-".$student_attendance_date2[0];
			$student_attendance_date4=$student_attendance_date2[2];
			$year=$student_attendance_date2[0];
			$month=$student_attendance_date2[1];
            $day=$student_attendance_date2[2];
		
		  ?>
		  
		  <form  method="post" enctype="multipart/form-data" id='my_form'>
	<input type="hidden" name="student_attendance_date" id="student_attendance_date" value="<?php echo $student_attendance_date; ?>"  />
            <div class="col-md-12">
                <?php if($attendance_type=='P'){?>
			  <div class="col-md-12">
			  <label>Present Student</label>
			  <input type="text" name="message_content" id="" value="Dear Parent, Your ward student_name is PRESENT today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name; ?> [SCHOOL]" class="form-control" readonly/>
			  
			  
			  </div>
			   <?php }if($attendance_type=='P/2'){?>
			  <div class="col-md-12">
			  <label>Absent Student</label>
			  <input type="text" name="message_content" id="" value="Dear Parent, Your ward student_name is Half Day today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name; ?> [SCHOOL]" class="form-control" readonly/>
			  </div>
			   <?php }if($attendance_type=='A'){?>
			  <div class="col-md-12">
			  <label>Absent Student</label>
			  <input type="text" name="message_content" id="" value="Dear Parent, Your ward student_name is ABSENT today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name; ?> [SIMPTION]" class="form-control" readonly/>
			  </div>
			   <?php }if($attendance_type=='L'){?>
			  <div class="col-md-12">
			  <label>Leave Student </label>
			  <input type="text" name="message_content" id="" value="Dear Parent, Your ward student_name is on LEAVE today (<?php echo $student_attendance_date3; ?>). Regards <?php echo $school_name; ?> [SCHOOL]" class="form-control"  readonly/>
			  </div>
			  </div>
			   <?php }?>
		     
          
			  <div class="col-md-12 table-responsive" style="margin-top:20px">
			  <table border="2" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>S No</th>
                  <th><?php echo "Student ID"; ?></th>
                  <th>Student Name</th>
                  <th>Class/Section</th>
                  <th>Class Roll No</th>
                  <th>Contact Number</th>
                  <th>Filled Attendance</th>
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
		       $que34="select student_roll_no,school_roll_no,student_name,student_class,student_class_section,student_rf_id_number,student_father_contact_number from  student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition3 $filter37 order by student_name ASC";
				$run34=mysqli_query($conn73,$que34) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row34=mysqli_fetch_assoc($run34)){
				$student_roll_no = $row34['student_roll_no'];
				$school_roll_no = $row34['school_roll_no'];
				$student_name = $row34['student_name'];
				$student_class = $row34['student_class'];
				$student_class_section = $row34['student_class_section'];
				$student_rf_id_number = $row34['student_rf_id_number'];
				$student_father_contact_number= $row34['student_father_contact_number'];

			$que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from student_attendance where attendance_roll_no='$student_roll_no' and month='$month' and year='$year' and `$attendance_column`='$attendance_type' order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$attendance=$row[$attendance_column];
						$serial_no++;
		
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $student_roll_no; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_class."/".$student_class_section; ?></td>
                     <td><?php echo $school_roll_no; ?></td>
                  <td><?php echo $student_father_contact_number; ?></td>
                  <td><?php echo $attendance; ?></td>
				  <td>
				  <input type="checkbox" name="parents_message[]" id="<?php echo 'parents_message_'.$serial_no; ?>" value="<?php echo $student_name.'|?|'.$student_father_contact_number.'|?|'.$attendance; ?>" <?php if($student_father_contact_number==''){ ?> disabled <?php  }else{ ?> class="selection" <?php  } ?> >
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