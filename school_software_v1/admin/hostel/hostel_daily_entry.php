<?php include("../attachment/session.php"); ?>
     <section class="content-header">
      <h1>
         <?php echo $language['Hostel Management']; ?>
     <small> <?php echo $language['Control Panel']; ?></small>
    </h1>
      <ol class="breadcrumb">
  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
	    <li class="Active"> <?php echo $language['Hostel Student Attendance']; ?></li>
      </ol>
    </section>
<script>

function for_room(value){
if(value!=''){
$.ajax({
    address: "POST",
    url: access_link+"hostel/ajax_room_no.php?value="+value+"",
    cache: false,
    success: function(detail){
    $('#room_no').html(detail);		
    }
    });
	}else{
	$('#room_no').html("<option value=''>Select</option>");
	}
}

$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
//window.scrollTo(0, 0);
//    loader();
        $.ajax({
            url: access_link+"hostel/hostel_daily_entry_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			//alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Complete','green');
				   //get_content('hostel/hostel_list');
            }
			}
         });
      });

</script>

	<!---*********************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-1"></div>
		<div class="col-xs-3">
		
		  <form  method="post" enctype="multipart/form-data" id="my_form">
		  <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"> <?php echo $language['Fill Attendance']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
             <div class="form-group">
			<label> <?php echo $language['Hostel Name']; ?></label>
			<select name="hostel_hostel_name" class="form-control" id="hostel_name" onchange="for_room(this.value);" required>
                <option value=''>Select</option>
                <?php $que12="select * from hostel_info where hostel_status='Active'";
                $run12=mysqli_query($conn73,$que12);
                while($row12=mysqli_fetch_assoc($run12)){
                $hostel_name=$row12['hostel_name'];
        		?>
                <option value="<?php echo $hostel_name; ?>" ><?php echo $hostel_name; ?></option>
                <?php } ?>
            </select>
        	</div>
			  <div class="form-group">
				<label> <?php echo $language['Room No']; ?></label>
				<select name="hostel_room" id="room_no" class="form-control" required>
					<option value=''>Select</option>
				</select>
			  </div>
			  <div class="form-group">
					<label for="exampleInputEmail1"><?php echo $language['Date']; ?></label>
					<?php $today_date= date('Y-m-d');
					$date_diff=  date('Y-m-d', strtotime($today_date. '-1000day'));
					?>
					<input  type="date" class="form-control" name="attendance_student_date" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $date_diff; ?>" value="<?php echo date('Y-m-d'); ?>" >
			  </div>
			  <div class="form-group">
					<center><input type="submit" name="fill" value="<?php echo $language['Fill Attendance']; ?>" class="btn btn-success">
					<button type="button" name="view" class="btn btn-success"><?php echo $language['View Attendance']; ?></button></center>
			  </div>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  </form>
		
		</div>
		<div class="col-xs-7">
         
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Hostel Current Month Attendance List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" style="height:800px;">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Class']; ?></th>
				  <th><?php echo $language['Month']; ?></th>
                  <th><?php echo $language['Present']; ?></th>
                  <th><?php echo $language['Absent']; ?></th>
                  <th><?php echo $language['Leave']; ?></th>
                  <th><?php echo $language['View']; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
			

				$que="select * from hostel_student_info where hostel_student_status='Active'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				$month_wise='';
				while($row=mysqli_fetch_assoc($run)){

					$s_no=$row['s_no'];
					$unique_id = $row['roll_number'];
					$student_name = $row['hostel_student_name'];
					$student_class=$row['hostel_student_class'];
					$hostel_hostel_name=$row['hostel_hostel_name'];
					$hostel_room=$row['hostel_room'];
					$month = date('m');
					$year = date('Y');
					
					if($month=="01") 
						   $month_wise="January";
					if($month=="02") 
						   $month_wise="February";
					if($month=="03") 
						   $month_wise="March";
					if($month=="04") 
						   $month_wise="April";
					if($month=="05") 
						   $month_wise="May";
					if($month=="06") 
						   $month_wise="June";
					if($month=="07") 
						   $month_wise="july";
					if($month=="08") 
						   $month_wise="August";
					if($month=="09") 
						   $month_wise="September";
					if($month=="10") 
						   $month_wise="October";
					if($month=="11") 
						   $month_wise="November";
					if($month=="12") 
						   $month_wise="December";
					
					$serial_no++;
					
					$present=0;
					$absent=0;
					$leave=0;
					$date2=$year.'-'.$month.'-01';
					$count1 = date(' t ', strtotime($date2));
					$que11="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and month='$month' and year='$year' and attendance_roll_no='$unique_id'";
				    $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
				    while($row11=mysqli_fetch_assoc($run11)){
					
					for($i=1;$i<=$count1;$i++){
					
					if($i<10){
				    $a=$row11['0'.$i];
					if($a=='P'){
					$present=$present+1;
					}
					if($a=='A'){
					$absent=$absent+1;
					}
					if($a=='L'){
					$leave=$leave+1;
					}
					}else{
				    $a=$row11[$i];
					if($a=='P'){
					$present=$present+1;
					}
					if($a=='A'){
					$absent=$absent+1;
					}
					if($a=='L'){
					$leave=$leave+1;
					}
				    }
					}
					}
					
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $unique_id; ?></td>
                  <td><?php echo $student_name; ?></td>
                  <td><?php echo $student_class; ?></td>
                  <td><?php echo $month_wise; ?></td>
                  <td><?php echo $present; ?></td>
                  <td><?php echo $absent; ?></td>
                  <td><?php echo $leave; ?></td>
                  <td><button type="button"  onclick="post_content('hostel/hostel_student_attendance_view','<?php echo 'id='.$s_no.'&class='.$hostel_hostel_name.'&section='.$hostel_room.'&current_month='.$month.'&year='.$year; ?>')" class="btn btn-success" ><?php echo $language['View']; ?></button>
			</td>
                </tr>
			
				
				
				<?php
				}
				?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
		</div>
		<div class="col-xs-1"></div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
 