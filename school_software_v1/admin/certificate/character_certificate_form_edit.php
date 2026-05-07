<?php include("../attachment/session.php")?>
<script type="text/javascript">
      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/character_certificate_form_edit_api.php",
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
				   get_content('certificate/character_certificate_list');
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
        <li><a href="javascript:get_content('certificate/character_certificate_list')"><?php echo $language['Cc List']; ?></a></li>
        <li class="active"><?php echo $language['Character Certificate Edit']; ?></li>
      </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Character Certificate Edit']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		
			<?php
			$s_no=$_GET['id'];

			
			$qry="select * from character_certificate where s_no='$s_no' and student_character_status='Active'";
			$run=mysqli_query($conn73,$qry);
			$serial_no=0;
			while($row22=mysqli_fetch_assoc($run)){
			$s_no=$row22['s_no'];
			$character_student_name = $row22['character_student_name'];
			$character_student_father_name = $row22['character_student_father_name'];
			$character_school_name = $row22['character_school_name'];
			$character_current_year_from = $row22['character_current_year_from'];
			$character_current_year_to = $row22['character_current_year_to'];
			$character_type = $row22['character_type'];
			$character_issue_date1=$row22['character_issue_date'];
			$character_issue_date2=explode("-",$character_issue_date1);
			$character_issue_date=$character_issue_date2[2]."-".$character_issue_date2[1]."-".$character_issue_date2[0];
			$character_student_roll_no = $row22['character_student_roll_no'];
	
			
            }
			?>	
		
            <div class="box-body "  >
			
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			 <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" >
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="character_student_name"  value="<?php echo $character_student_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
					  
					  <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="character_student_name"  value="<?php echo $character_student_father_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="character_student_roll_no"  value="<?php echo $character_student_roll_no; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control" readonly>
					      </div>
				      </div>
					  
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['School Name']; ?></label>
						  <input type="text" name="character_school_name"  value="<?php echo $character_school_name; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control">
					      </div>
				      </div>
				      
					  <div class="col-md-3 ">	
					    <div class="form-group">
						<label><?php echo $language['During Year']; ?></label>
						<div class="col-sm-12">
						 <div class="col-sm-6">
						
						   <input type="text" name="character_current_year_from"  class="form-control" placeholder="From" value="<?php echo $character_current_year_from; ?>"  />
						   </div>
						  
						   <div class="col-sm-6">
						 
						   	<input type="text" class="form-control" name="character_current_year_to" placeholder="To" value="<?php echo $character_current_year_to; ?>" /><br/>
                          </div>
					   </div>
					</div>
				     </div>
					  
				     <div class="col-md-3 ">	
						<div class="form-group" >
						 <label> <?php echo $language['Character Type']; ?></label>
						  <input type="text"  name="character_type" placeholder="character Type"  value="<?php echo $character_type; ?>" class="form-control">
						</div>
					  </div>
				 
					  <div class="col-md-3 ">	
						<div class="form-group" >
						 <label><?php echo $language['Issued Date']; ?></label>
						  <input type="date"  name="character_issue_date" id="date_of_school_leaving" placeholder="Organized  Date"  value="<?php echo $character_issue_date; ?>" class="form-control">
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

  