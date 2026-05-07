<?php include("../attachment/session.php")?>
<script type="text/javascript">
      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/other_certificate_form_edit_api.php",
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
				   get_content('certificate/other_certificate_list');
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
        <li><a href="javascript:get_content('certificate/other_certificate_list')">Other Certificate List</a></li>
        <li class="active">Other Certificate Edit</li>
      </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Other Certificate Edit</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		
			<?php
			$s_no=$_GET['id'];

			
			$qry="select * from other_certificate where s_no='$s_no' ";
			$run=mysqli_query($conn73,$qry);
			$serial_no=0;
			while($row22=mysqli_fetch_assoc($run)){
			$s_no=$row22['s_no'];
			$other_student_name = $row22['other_student_name'];
			$other_student_father_name = $row22['other_student_father_name'];
			$other_school_name = $row22['other_school_name'];
			$other_certificate_type = $row22['other_certificate_type'];
			$other_certificate_name = $row22['other_certificate_name'];
			$other_student_roll_no = $row22['other_student_roll_no'];
	
			
            }
			?>	
		
            <div class="box-body">
			
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			 <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" >
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="other_student_name"  value="<?php echo $other_student_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
					  
					  <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="other_student_father_name"  value="<?php echo $other_student_father_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="other_student_roll_no"  value="<?php echo $other_student_roll_no; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control" readonly>
					      </div>
				      </div>
					  
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['School Name']; ?></label>
						  <input type="text" name="other_school_name"  value="<?php echo $other_school_name; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control">
					      </div>
				      </div>
				      
					 <div class="col-md-3">	
						<div class="form-group" >
						 <label> <?php echo $language['other Name']; ?></label>
						  <input type="text"  name="other_type" placeholder="<?php echo $language['other Name']; ?>"  value="<?php echo $other_type; ?>" class="form-control" required>
						</div>
					  </div>
				 
					  <div class="col-md-3 ">	
						<div class="form-group" >
						 <label><?php echo $language['other Category']; ?></label>
						  <input type="text"  name="other_category"  placeholder="<?php echo $language['other Category']; ?>" id="student_category" value="<?php echo $other_category; ?>" class="form-control" required>
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

  