<?php include("../attachment/session.php")?>
<script type="text/javascript">
      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/student_certificate_form_edit_api.php",
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
				   get_content('certificate/student_certificate_list');
            }
			}
         });
      });
</script>   
    <section class="content-header">
      <h1>
          <?php echo $language['Certificate Management']; ?>
		<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> Certificate</a></li>
        <li><a href="javascript:get_content('certificate/student_certificate_list')"><?php echo 'Student Certificate List'; ?></a></li>
        <li class="active"><?php echo 'Student Certificate Edit'; ?></li>
      </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo 'Student Certificate Edit'; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		
			<?php
			$s_no=$_GET['id'];

			
			$qry="select * from student_certificate where s_no='$s_no' and student_student_status='Active'";
			$run=mysqli_query($conn73,$qry);
			$serial_no=0;
			while($row22=mysqli_fetch_assoc($run)){ 
			$s_no=$row22['s_no'];
			$student_certificate_no=$row22['student_certificate_no'];
			$student_certificate_date=$row22['student_certificate_date'];
			$student_student_name = $row22['student_student_name'];
			$student_student_father_name = $row22['student_student_father_name'];
			$student_school_name = $row22['student_school_name'];
		//	$student_category = $row22['student_category'];
		//	$student_type = $row22['student_type'];
			$student_student_roll_no = $row22['student_student_roll_no'];
	
			
            }
			?>	
		
            <div class="box-body">
			
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			 <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" >
			
			
			<div class="col-md-12">
			    <div class="col-md-3 ">	
					    <div class="form-group" >
					     <label><?php echo 'Certificate No'; ?></label>
					     <input type="text"  name="student_certificate_no" id="student_certificate_no" placeholder=""  value="<?php echo $student_certificate_no; ?>" required class="form-control" >
					    </div>
			    </div>
			    
			        
			    <div class="col-md-3 ">	
					    <div class="form-group" >
					     <label><?php echo 'Certificate Date'; ?></label>
					     <input type="date"  name="student_certificate_date" id="student_certificate_date" placeholder=""  value="<?php echo date('Y-m-d',strtotime($student_certificate_date)); ?>" required class="form-control" >
					    </div>
			    </div>
            </div>
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="student_student_name"  value="<?php echo $student_student_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" >
					       </div>
					  </div>
					  
					  <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="student_student_father_name"  value="<?php echo $student_student_father_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" >
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="student_student_roll_no"  value="<?php echo $student_student_roll_no; ?>" placeholder="student Roll No."  id="school_roll_no" readonly  class="form-control" >
					      </div>
				      </div>
					  
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['School Name']; ?></label>
						  <input type="text" name="student_school_name"  value="<?php echo $student_school_name; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control">
					      </div>
				      </div>
				      
					 
				 
					  <div class="col-md-12">
					   <br/><center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center><br/>
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

  