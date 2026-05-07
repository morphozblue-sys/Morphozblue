<?php include("../attachment/session.php"); ?>
<?php
$s_no1=$_GET['id'];

$que="select * from teacher_reminder where s_no='$s_no1' and session_value='$session1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$reminder_teacher_name = $row['reminder_teacher_name'];
    $reminder_allocated_date_1 = $row['reminder_allocated_date'];
	$reminder_allocated_date_1 = $row['reminder_allocated_date'];
	$reminder_allocated_date_2 = explode("-",$reminder_allocated_date_1);
	$reminder_allocated_date=$reminder_allocated_date_2[2]."-".$reminder_allocated_date_2[1]."-".$reminder_allocated_date_2[0];
	$reminder_finish_date_1 = $row['reminder_finish_date'];
	$reminder_finish_date_2 = explode("-",$reminder_finish_date_1);
	$reminder_finish_date=$reminder_finish_date_2[2]."-".$reminder_finish_date_2[1]."-".$reminder_finish_date_2[0];
	$reminder_teacher_task_1 = $row['reminder_teacher_task_1'];
	$reminder_teacher_task_2 = $row['reminder_teacher_task_2'];
	$reminder_teacher_task_3 = $row['reminder_teacher_task_3'];
	$reminder_teacher_task_4 = $row['reminder_teacher_task_4'];
	$reminder_teacher_task_5 = $row['reminder_teacher_task_5'];
	$reminder_teacher_remark = $row['reminder_teacher_remark'];

	}

?>
 <script>
       $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"reminder/reminder_teacher_edit_api.php",
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
				   get_content('reminder/reminder_teacher_list');
            }
			}
         });
      });
 </script>
    <section class="content-header">
    <h1>
      <?php echo $language['Reminder Management'] ;?>
        <small><?php echo $language['Control Panel'] ;?></small>
    </h1>
     <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="javascript:get_content('reminder/reminder')"><i class="fa fa-history"></i> <?php echo $language['Reminder']; ?></a></li>
	   <li><a href="javascript:get_content('reminder/reminder_teacher_list')"><i class="fa fa-list"></i><?php echo $language['Teacher Reminder List'] ;?></a></li>
        <li class="active"><i class="fa fa-edit"></i><?php echo $language['Teacher Reminder Edit'] ;?></li>
     </ol>
     </section>

       <!-- Main content -->
       <section class="content">
       <!-- Small boxes (Stat box) -->
       <div class="row">
	   <!-- general form elements disabled -->
       <div class="box box-warning  ">
       <div class="box-header with-border ">
       <h3 class="box-title"><?php echo $language['Teacher Reminder Edit'] ;?></h3>
       </div>
	   
       <!-- /.box-header -->
     <!------------------------------------------------Start Registration form--------------------------------------------------->
			
                  <div class="box-body "  >
			      <form role="form" method="post" enctype="multipart/form-data" id="my_form">
				      <input type="hidden" name="s_no1"  value="<?php echo $s_no1; ?>" >
			      <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Teacher Name'] ;?></label>
						   <input type="text" name="reminder_teacher_name" placeholder="Enter Name"  value="<?php echo $reminder_teacher_name; ?>" class="form-control" readonly>
						</div>
				  </div>
				  
					<div class="col-md-4 ">
				      <div class="form-group" >
                      <label for="reminder_teacher_task_1"><?php echo $language['Reminder Task 1'] ;?></label>
                      <input type="text" name="reminder_teacher_task_1" class="form-control bordder-color" id="" placeholder="Write Task" value="<?php echo $reminder_teacher_task_1; ?>" >
                    </div>
				    </div>
				    <div class="col-md-4 ">
				      <div class="form-group" >
                      <label for="reminder_teacher_task_2"><?php echo $language['Reminder Task 2'] ;?></label>
                      <input type="text" name="reminder_teacher_task_2" class="form-control bordder-color" id="" placeholder="Write Task" value="<?php echo $reminder_teacher_task_2; ?>" >
                    </div>
				   </div>
				    <div class="col-md-4 ">
				    <div class="form-group">
                    <label for="reminder_teacher_task_3"><?php echo $language['Reminder Task 3'] ;?></label>
                    <input type="text" name="reminder_teacher_task_3" class="form-control bordder-color" id="" placeholder="Write Task" value="<?php echo $reminder_teacher_task_3; ?>" >
                    </div>
				    </div>
				    <div class="col-md-4 ">
				    <div class="form-group">
                    <label for="reminder_teacher_task_4"><?php echo $language['Reminder Task 4'] ;?></label>
                    <input type="text" name="reminder_teacher_task_4" class="form-control bordder-color" id="" placeholder="Write Task" value="<?php echo $reminder_teacher_task_4; ?>" >
                    </div>
				    </div>
				    <div class="col-md-4 ">
				    <div class="form-group" >
                    <label for="reminder_teacher_task_5"><?php echo $language['Reminder Task 5'] ;?></label>
                    <input type="text" name="reminder_teacher_task_5" class="form-control bordder-color" id="" placeholder="Write Task" value="<?php echo $reminder_teacher_task_5; ?>" >
                    </div>
				    </div>
					<div class="col-md-4 ">	
					 <div class="form-group" >
					  <label><?php echo $language['Allocated Date'] ;?></label>
					  <input type="date" name="reminder_allocated_date" placeholder="Date"  value="<?php echo $reminder_allocated_date; ?>" class="form-control">
					 </div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Finish Date'] ;?></label>
					  <input type="date"  name="reminder_finish_date" placeholder="Date"  value="<?php echo $reminder_finish_date; ?>" class="form-control">
					</div>
				   </div>
			        <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Remark'] ;?></label>
						   <input type="text" name="reminder_teacher_remark" placeholder="Enquiry Remark 2"  value="<?php echo $reminder_teacher_remark; ?>" class="form-control">
						</div>
					</div>
					
				    	
		   <div class="col-md-12">
		   <center><input type="submit" name="submit" value="<?php echo $language['Update'] ;?>" class="btn btn-primary" /></center>
		   </div>
		   </form>
	                 </div>
       <!---------------------------------------------End Registration form--------------------------------------------------------->
	<!-- /.box-body -->
          </div>
          </div>
          </section>
         