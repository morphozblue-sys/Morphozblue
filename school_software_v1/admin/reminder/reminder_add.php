<?php include("../attachment/session.php"); ?>
 <script>
       $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"reminder/reminder_add_api.php",
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
				   get_content('reminder/reminder_list');
            }
			}
         });
      });
 </script>
    <section class="content-header">
    <h1>
      <?php echo $language['Reminder Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
    </h1>
     <ol class="breadcrumb">
            <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="javascript:get_content('reminder/reminder')"><i class="fa fa-history"></i> <?php echo $language['Reminder']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Add Reminder']; ?></li>
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
       <h3 class="box-title"><?php echo $language['Reminder Form']; ?></h3>
       </div>
	   
       <!-- /.box-header -->
     <!------------------------------------------------Start Registration form--------------------------------------------------->
			
                  <div class="box-body "  >
			      <form role="form" method="post" enctype="multipart/form-data" id="my_form">
			      
				  
				 <div class="col-md-4 ">
				  <div class="form-group" id="for_task_1">
                  <label for="reminder_task_1"><?php echo $language['Reminder Task 1']; ?><font style="color:red"><b>*</b></font></label>
                  <input type="text" name="reminder_task_1" class="form-control bordder-color" id="" placeholder="<?php echo $language['Write Task']; ?>" required>
                 </div>
				 </div>
				 <div class="col-md-4 ">
				  <div class="form-group" id="for_task_2">
                  <label for="reminder_task_2"><?php echo $language['Reminder Task 2']; ?></label>
                  <input type="text" name="reminder_task_2" class="form-control bordder-color" id="" placeholder="<?php echo $language['Write Task']; ?>" >
                 </div>
				 </div>
				 <div class="col-md-4 ">
				  <div class="form-group" id="for_task_3">
                  <label for="reminder_task_3"><?php echo $language['Reminder Task 3']; ?></label>
                  <input type="text" name="reminder_task_3" class="form-control bordder-color" id="" placeholder="<?php echo $language['Write Task']; ?>" >
                 </div>
				 </div>
				 <div class="col-md-4 ">
				  <div class="form-group" id="for_task_4">
                  <label for="reminder_task_4"><?php echo $language['Reminder Task 4']; ?></label>
                  <input type="text" name="reminder_task_4" class="form-control bordder-color" id="" placeholder="<?php echo $language['Write Task']; ?>" >
                 </div>
				 </div>
				 <div class="col-md-4 ">
				  <div class="form-group" id="for_task_5">
                  <label for="reminder_task_5"><?php echo $language['Reminder Task 5']; ?></label>
                  <input type="text" name="reminder_task_5" class="form-control bordder-color" id="" placeholder="<?php echo $language['Write Task']; ?>" >
                 </div>
				 </div>
				 <div class="col-md-4 ">	
					 <div class="form-group" >
					  <label><?php echo $language['Allocated Date']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="date" value="<?php echo date('Y-m-d'); ?>" name="reminder_allocated_date" id="myLocalDate"  placeholder="Date"  value="" class="form-control" required>
					 </div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Finish Date']; ?></label>
					  <input type="date"  name="reminder_finish_date" placeholder="Date"  value="" class="form-control">
					</div>
				   </div>
				   <div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Remark']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text" name="reminder_remark" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" required>
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
        