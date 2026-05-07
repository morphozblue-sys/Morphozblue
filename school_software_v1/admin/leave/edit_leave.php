<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_search_student_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
        
      
              }
           });

    }
    
 	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"leave/edit_leave_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			//$('#student_name_company').html(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('leave/leave_list');
            }
			}
         });
      });
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $language['Leave Management']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
	   <li><a href="javascript:get_content('leave/leave')"><i class="fa fa-umbrella"></i> <?php echo $language['Leave Management']; ?></a></li>
        <li><a href="javascript:get_content('leave/leave_list')"><i class="fa fa-list"></i> <?php echo $language['Leave List']; ?></a></li>
		<li class="active"><i class="fa fa-edit"></i> <?php echo $language['Leave Edit']; ?></li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Leave Edit']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<?php
						   $s_no1=$_GET['id'];
						   $query="select * from  student_leave_management where s_no=$s_no1";
						   $run=mysqli_query($conn73,$query)or (mysqli_error($conn73));
						   while($row=mysqli_fetch_assoc($run)){
						         $student_name=$row['student_name'];
						         $student_class=$row['student_class'];
						         $student_section=$row['student_section'];
						         $student_roll_no=$row['student_roll_no'];
						         $leave_from_date_1 = $row['leave_from_date'];
                                 $leave_from_date_2 = explode("-",$leave_from_date_1);
                                 $leave_from_date=$leave_from_date_2[2]."-".$leave_from_date_2[1]."-".$leave_from_date_2[0];
                                 $leave_to_date_1 = $row['leave_to_date'];
                                 $leave_to_date_2 = explode("-",$leave_to_date_1);
                                 $leave_to_date=$leave_to_date_2[2]."-".$leave_to_date_2[1]."-".$leave_to_date_2[0];
						         $leave_approved_by=$row['leave_approved_by'];
						         $leave_total_day=$row['leave_total_day'];
	
	$leave_application=$row['leave_application_name'];
	
								 }
								 ?>
			<form role="form" id="my_form" method="post" enctype="multipart/form-data">
			
			
			
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="student_name" placeholder="Student Name"  id="student_name" class="form-control" value="<?php echo $student_name; ?>" readonly>
						    <input type="hidden"  name="s_no1"  id="s_no1" class="form-control" value="<?php echo $s_no1; ?>" readonly>
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="student_class" placeholder="Student Class"  id="student_class" class="form-control" value="<?php echo $student_class; ?>" readonly>
						
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Student Section']; ?></label>
						   <input type="text"  name="student_section" placeholder="Student Section"  id="student_section" class="form-control" value="<?php echo $student_section; ?>" readonly>
						  
						</div>
							</div>
							<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Roll No']; ?></label>
					  <input type="text"  name="student_roll_no" placeholder="student Roll No."  id="student_roll_no" class="form-control" value="<?php echo $student_roll_no; ?>" readonly>
					</div>
				  </div>
				  
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Leave From']; ?></label>
					  <input type="date"  name="leave_from_date" placeholder="Enter start date"  value="<?php echo $leave_from_date_1; ?>" class="form-control">
					</div>
				  </div>
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Leave To']; ?></label>
					  <input type="date"  name="leave_to_date" placeholder="Enter last date"  value="<?php echo $leave_to_date_1; ?>" class="form-control">
					</div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Approved By']; ?></label>
					  <input type="text"  name="leave_approved_by" placeholder="Enter approved by"  value="<?php echo $leave_approved_by; ?>" class="form-control">
					</div>
				  </div>
				  
				  <div class="col-md-3 ">	
					<div class="form-group" >
				  <label><?php echo $language['Upload Application']; ?></label>
					   <input type="file"  name="leave_application" id= "leave_application" onchange="check_file_type(this,'leave_application','show_application','all');"class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc"/>
		
					</div>
				  </div>
				<div class="col-md-1">	
					<div class="form-group" >
					  <img src="<?php if($leave_application!=''){ echo $_SESSION['amazon_file_path']."leave_document/".$leave_application; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_application" height="50" width="50">
			        </div>
				</div>
				  
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Total leave days']; ?></label>
					  <input type="text"  name="leave_total_day" placeholder="Enter total no of day"  value="<?php echo $leave_total_day; ?>" class="form-control">
					</div>
				  </div>
				  <div class="col-md-12">
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				</div>
				
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>