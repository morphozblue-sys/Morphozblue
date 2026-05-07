<?php include("../attachment/session.php")?>
<script type="text/javascript">
      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"certificate/event_certificate_form_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   get_content('certificate/event_certificate_list');
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
        <li><a href="javascript:get_content('certificate/event_certificate_list')"><i class="fa fa-certificate"></i> <?php echo $language['Event Certificate List']; ?></a></li>
      <li class="active"><?php echo $language['Edit Event Certificate Form']; ?></li> </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Edit Event Certificate Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		
			<?php
			$s_no=$_GET['id'];

			
			$qry="select * from event_certificate where s_no='$s_no' and student_event_status='Active'";
			$run=mysqli_query($conn73,$qry);
			$serial_no=0;
			while($row22=mysqli_fetch_assoc($run)){
			$s_no=$row22['s_no'];
			$event_student_name=$row22['event_student_name'];
			$event_type=$row22['event_type'];
			$event_organized_date1=$row22['event_organized_date'];
		    $event_organized_date2=explode("-",$event_organized_date1);
		    $event_organized_date=$event_organized_date2[2]."-".$event_organized_date2[1]."-".$event_organized_date2[0];
			$event_rank=$row22['event_rank'];
			$event_student_roll_no=$row22['event_student_roll_no'];
			
            }
			?>	
		
            <div class="box-body "  >
			
				<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			 <input type="hidden"  name="s_no"  value="<?php echo $s_no; ?>" >
			
			
			          <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="event_student_name"  value="<?php echo $event_student_name; ?>" placeholder="Student Name"   id="student_name" class="form-control" readonly>
					       </div>
					  </div>
			
					  <div class="col-md-3 ">	
					      <div class="form-group" >
						  <label><?php echo $language['Student Roll No']; ?></label>
						  <input type="text" name="event_student_roll_no"  value="<?php echo $event_student_roll_no; ?>" placeholder="student Roll No."  id="school_roll_no" class="form-control" readonly>
					      </div>
				      </div>
				  
				     <div class="col-md-3 ">	
						<div class="form-group" >
						 <label> <?php echo $language['Event Type']; ?></label>
						  <input type="text"  name="event_type" placeholder="event Type"  value="<?php echo $event_type; ?>" class="form-control">
						</div>
					  </div>
				 
					  <div class="col-md-3 ">	
						<div class="form-group" >
						 <label><?php echo $language['Organized Date']; ?></label>
						  <input type="date"  name="event_organized_date" id="date_of_school_leaving" placeholder="Organized  Date"  value="<?php echo $event_organized_date; ?>" class="form-control">
						</div>
					  </div>
				 
				      <div class="col-md-3 ">	
					    <div class="form-group" >
					    <label> <?php echo $language['Rank']; ?></label>
					     <input type="text"  name="event_rank" placeholder="Rank"  value="<?php echo $event_rank; ?>" class="form-control">
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

 