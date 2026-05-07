<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: access_link+"penalty/ajax_search_student_box.php?id="+value+"",
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

        $.ajax({
            url: access_link+"penalty/penalty_action_api.php",
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
				   get_content('penalty/penalty_list');
            }
			}
         });
      });
</script>  

    <section class="content-header">
      <h1>
    <?php echo $language['Student Action']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="javascript:get_content('penalty/penalty')"><i class="fa fa-exclamation-circle"></i> <?php echo $language['Penalty Management']; ?></a></li>
        <li class="active"><?php echo $language['Penalty Form']; ?></li>
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
              <h3 class="box-title">Student Penalty From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<?php
                           include("../../con73/con37.php");
						   $id=$_GET['student_roll_no1'];
						   
						   $query="select * from student_admission_info where student_roll_no='$id' and session_value='$session1' ";
						   $run=mysqli_query($conn73,$query)or (mysqli_error($conn73));
						   while($row=mysqli_fetch_assoc($run)){
						         $student_roll_no=$row['student_roll_no'];
						         $student_name=$row['student_name'];
						         $student_class=$row['student_class'];
						         $student_class_section=$row['student_class_section'];
								 }
								 ?>
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Name</label>
						   <input type="text"  name="student_name" value="<?php echo $student_name; ?>" placeholder="Student Name"  id="student_name" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Class</label>
						   <input type="text"  name="student_class" value="<?php echo $student_class; ?>" placeholder="Student Class"  id="student_class" class="form-control" readonly>
						
						</div>
							</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Student Section</label>
						   <input type="text"  name="student_section" value="<?php echo $student_class_section; ?>" placeholder="Student Section"  id="student_section" class="form-control" readonly>
						  
						</div>
							</div>
							<div class="col-md-3 " style="display:none">	
					<div class="form-group" >
					  <label>Student Roll No.</label>
					  <input type="text"  name="student_roll_no" value="<?php echo $student_roll_no; ?>" placeholder="student Roll No."  id="student_roll_no" class="form-control" readonly>
					</div>
				  </div>
				  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Penalty Amount</label>
					  <input type="text"  name="penalty_amount" placeholder="Penalty Amount"  value="" class="form-control">
					</div>
				  </div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label>Penalty Reason</label>
					  <input type="text"  name="penalty_reason" placeholder="Penalty reason"  value="" class="form-control">
					</div>
				  </div>
				  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label>Penalty Remark</label>
					  <input type="text"  name="penalty_remark" placeholder="Penalty remark"  value="" class="form-control">
					</div>
				  </div>
				<div class="col-md-3 ">	
					
				  </div>
				  
				  <div class="col-md-12">
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				
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

  