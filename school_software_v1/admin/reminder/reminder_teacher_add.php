<?php include("../attachment/session.php"); ?> 
 <script>
       $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"reminder/reminder_teacher_add_api.php",
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
 <script type="text/javascript">
 function for_section(value){

       $.ajax({
			  type: "POST",
              url: access_link+"downloads/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                 $("#student_class_section").html("<option value='All'>All</option>"+detail);
              }
           });

    }
    
 function for_subject(){
			$('#subject_name').html("<option value='' >Loading....</option>");
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var student_class= document.getElementById('std_class').value;
			$.ajax({
			address: "POST",
			url: access_link+"homework/ajax_get_subject_1.php?value="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
			cache: false,
			success: function(detail){
			    
			    console.log(detail)
			 $("#subject_name").html(detail);
		
			}
			});   
 } 
 function for_stream(value2){
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}
 function get_group(value1){
 $('#student_class_group').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"homework/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });

    }
 </script>
    <section class="content-header">
    <h1>
     <?php echo $language['Reminder Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
    </h1>
     <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="javascript:get_content('reminder/reminder')"><i class="fa fa-history"></i> <?php echo $language['Reminder']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Add Teacher Reminder']; ?></li>
     </ol>
     </section>
	 
	 <!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

       <!-- Main content -->
       <section class="content">
       <!-- Small boxes (Stat box) -->
       <div class="row">
	   <!-- general form elements disabled -->
       <div class="box box-warning  ">
       <div class="box-header with-border ">
       <h3 class="box-title"><?php echo $language['Reminder Teacher Form']; ?></h3>
       </div>
	   
       <!-- /.box-header -->
     <!------------------------------------------------Start Registration form--------------------------------------------------->
			
                  <div class="box-body "  >
			       <form role="form" method="post" enctype="multipart/form-data" id="my_form">
			      
				 <div class="col-md-3 ">				
			       <div class="form-group" >
				   <label ><?php echo $language['Teacher Name']; ?><font style="color:red"><b>*</b></font></label>
				   <select class="form-control" name="reminder_teacher_name" required>
                    <?php
					$que="select * from employee_info where emp_status='Active'";
					$run=mysqli_query($conn73,$que);
					while($row=mysqli_fetch_assoc($run)){

					$emp_name = $row['emp_name'];
                    ?>                  
					<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
					
					 <?php } ?>
				   </select>
				   </div>
				 </div>
				 
				  <div class="col-md-3">				
			      <div class="form-group" >
				  <th><b   style="font-size:15px">Choose Class</b></th>
				<select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);for_subject();for_stream(this.value)" >
				<option value="">All</option>
				<?php 
				$sql= "select * From school_info_class_info";
				$result=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($result)){
				$class_name=$row['class_name'];
				 ?>
				<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				  </div>
				  </div>
				  
					
				 
				 <div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_subject();" >
					           <option  value="">Select Stream</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
                            if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
		</div>
		<div class="col-md-3" id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Group']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_subject();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				
				<div class="col-md-3">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div> 
				 
				 <div class="col-md-3 ">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="subject_name" id="subject_name">
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
				 
				 
				 <div class="col-md-3 ">
				  <div class="form-group" >
                  <label for="reminder_teacher_task_1">Task 1<font style="color:red"><b>*</b></font></label>
                  <input type="text" name="reminder_teacher_task_1" class="form-control bordder-color" id=""  required>
                 </div>
				 </div>
				 <div class="col-md-3 ">
				  <div class="form-group" >
                  <label for="reminder_teacher_task_2">Task 2</label>
                  <input type="text" name="reminder_teacher_task_2" class="form-control bordder-color" id=""  >
                 </div>
				 </div>
				 <div class="col-md-3 ">
				  <div class="form-group">
                  <label for="reminder_teacher_task_3">Task 3</label>
                  <input type="text" name="reminder_teacher_task_3" class="form-control bordder-color" id=""  >
                 </div>
				 </div>
				 <div class="col-md-3 ">
				  <div class="form-group">
                  <label for="reminder_teacher_task_4">Task 4</label>
                  <input type="text" name="reminder_teacher_task_4" class="form-control bordder-color" id=""  >
                 </div>
				 </div>
				 <div class="col-md-3 ">
				  <div class="form-group" >
                  <label for="reminder_teacher_task_5">Task 5</label>
                  <input type="text" name="reminder_teacher_task_5" class="form-control bordder-color" id=""  >
                 </div>
				 </div>
				 <div class="col-md-3 ">	
					 <div class="form-group" >
					  <label><?php echo $language['Allocated Date']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="date" value="<?php echo date('Y-m-d'); ?>" name="reminder_allocated_date" id="myLocalDate"  placeholder="Date"  value="" class="form-control" required>
					 </div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Finish Date']; ?></label>
					  <input type="date"  name="reminder_finish_date" placeholder="Date"  value="" class="form-control">
					</div>
				   </div>
				   <div class="col-md-3 ">		
						<div class="form-group">
						  <label><?php echo $language['Remark']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text" name="reminder_teacher_remark" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" >
						</div>
				  </div>
				  
					
				    	
		   <div class="col-md-12">
		   <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary" /></center>
		   </div>
		   </form>
	                 </div>
       <!---------------------------------------------End Registration form--------------------------------------------------------->
	<!-- /.box-body -->
          </div>
          </div>
          </section>
         