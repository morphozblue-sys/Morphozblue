<?php include("../attachment/session.php"); ?>
<style type="text/css">
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 80%;
        left: 0;
		background:white;
    }
    .search-box input[type="text"], .result{
        width: 90%;
		margin-left:5%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script>
  function our_other(value){
 if(value=='Scholar'){
$('#house_name').show();
$('#student_name_our').show();
$('#school_name_1').prop('readonly',true);
$('#student_name').prop('readonly',true);
$('#dateofbirth').prop('readonly',true);
$('#student_class').prop('readonly',true);
$('#gender').prop('readonly',true);
$('#student_mother_name').prop('readonly',true);
$('#student_father_name').prop('readonly',true);
}else{
$('#house_name').hide();
$('#student_name_our').hide();
$('#school_name_1').prop('readonly',false);
$('#student_name').prop('readonly',false);
$('#dateofbirth').prop('readonly',false);
$('#student_class').prop('readonly',false);
$('#gender').prop('readonly',false);
$('#student_mother_name').prop('readonly',false);
$('#student_father_name').prop('readonly',false);
}
}

$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"event_management/edit_participate_api.php",
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
				   alert_new('Successfully Complete','green');
				   get_content('event_management/participate_list');
            }
			}
         });
      });
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Participation
	   <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Edit Participation</li>
      </ol>
    </section>
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Edit Participation</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
			
		<div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data" id="my_form">
				<?php
				$id=$_GET['id'];
				$que="select * from event_participate_table where s_no='$id'";
				$run=mysqli_query($conn73,$que);
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){

				$s_no11 = $row['s_no'];
				$event_name11 = $row['event_name'];
				$company_name1 = $row['company_name'];
				$participate_type1 = $row['participate_type'];
				$house_name1 = $row['house_name'];
				$school_name1 = $row['school_name'];
				$student_name1 = $row['student_name'];
				$student_class1 = $row['student_class'];
				$dateofbirth1 = $row['dateofbirth'];
				$student_roll_no1 = $row['student_roll_no'];
				$gender1 = $row['gender'];
				$category1 = $row['category'];
				$student_mother_name1 = $row['student_mother_name'];
				$student_father_name1 = $row['student_father_name'];
				$session_value1 = $row['session_value'];

				}
				?>
			
			    <div class="col-md-12">
			    <div class="col-md-4">
				  <div class="form-group">
						<label>Participate Type<font style="color:red"><b>*</b></font></label>
						<input type="hidden" name="s_no11" value="<?php echo $s_no11; ?>" class="form-control" readonly>
						<input type="text" value="<?php echo $participate_type1; ?>" class="form-control" readonly>
                   </div>
				
					<div class="form-group" style="display:none;">
						<label>Participate Type<font style="color:red"><b>*</b></font></label>
						<select name="participate_type" class="form-control" onchange="our_other(this.value);" required  >
						<option <?php if($participate_type1=='Scholar'){ echo 'selected'; } ?> value="Scholar">Scholar</option>
						  <option <?php if($participate_type1=='Other'){ echo 'selected'; }?> value="Other">Other</option>
						</select>
					</div>
				</div>   
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Event Name<font style="color:red"><b>*</b></font></label>
						  <select name="event_name" class="form-control" id="event_name" onchange="for_activity(this.value);" required>
						  <option value="">Select</option>
						  <?php
						$query="select * from event_table GROUP BY event_name";
						$res=mysqli_query($conn73,$query);
						while($row=mysqli_fetch_assoc($res)){
						$s_no=$row['s_no'];
						$event_name=$row['event_name'];
						  ?>
					<option <?php if($event_name11==$event_name){ echo 'selected'; } ?> value="<?php echo $event_name; ?>"><?php echo $event_name; ?></option>
						  <?php } ?>
						  </select>
					</div>
				</div>
             <div class="col-md-4" id="house_name" style="<?php if($participate_type1=='Other'){  echo 'display:none;'; }?>">
				<div class="form-group">
					<label>House Name</label>
					<select name="house_name" class="form-control" id="">
						<option value="">select</option>
				    	<?php
						$query1="select * from event_house GROUP BY house";
						$res1=mysqli_query($conn73,$query1);
						while($row1=mysqli_fetch_assoc($res1)){
						$s_no=$row1['s_no'];
						$house=$row1['house'];
				    	?>
					<option <?php if($house_name1==$house){ echo 'selected'; } ?> value="<?php echo $house; ?>"><?php echo $house; ?></option>
						  <?php } ?>
					</select>
                </div>
			</div>
				</div>
	
			<div class="col-md-3">		
			<div class="form-group">
			<label>School/Institute Participate</label>
			<input type="text" name="school_name" id="school_name_1" placeholder="School Institute"  value="<?php echo $school_name1; ?>" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly'; } ?> />
			</div>
			</div>

				
			<div class="col-md-3" style="display:none;">		
			   <div class="form-group">
				  <label>Student Roll No</label>
				  <input type="text" name="student_roll_no" id="student_roll" placeholder="Student Roll"  value="<?php echo $student_roll_no1; ?>" class="form-control"/>
				</div>
			</div>
					
			  <div class="col-md-3">
				<div class="form-group">
					<label>Student Name</label>
					<input type="text"  name="student_name" placeholder="Student Name" value="<?php echo $student_name1; ?>" id="student_name" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly';} ?> >
				</div>
			</div>				
			  <div class="col-md-3">
				<div class="form-group">
					<label>Father Name</label>
					<input type="text"  name="student_father_name" placeholder="Father Name" value="<?php echo $student_father_name1; ?>" id="student_father_name" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly';} ?> >
				</div>
			</div>				
			  <div class="col-md-3">
				<div class="form-group">
					<label>Mother Name</label>
					<input type="text"  name="student_mother_name" placeholder="Mother Name" value="<?php echo $student_mother_name1; ?>" id="student_mother_name" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly';} ?> >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Category</label>
					<input type="text" name="category" placeholder="Category" value="<?php echo $category1; ?>" id="" class="form-control">
				</div>
			</div>
			  <div class="col-md-3">
				 <div class="form-group" >
				   <label>Class</font></label>
					<input type="text" name="student_class" placeholder="Student Class" value="<?php echo $student_class1; ?>" id="student_class" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly';} ?>>
				 </div>
			  </div>
		
				 <div class="col-md-3">
					<div class="form-group">
						<label>Gender</label>
			<input type="text" name="gender" class="form-control" value="<?php echo $gender1; ?>" id="gender" <?php if($participate_type1=='Scholar'){ echo 'readonly';} ?> >
					</div>
				</div>
		
			     <div class="col-md-3" id="birth_other">		
					  <div class="form-group">
					    <label>Date Of Birth</label>
					    <input type="date" name="dateofbirth" id="dateofbirth" placeholder="Date Of Birth"  value="<?php echo $dateofbirth1; ?>" class="form-control" <?php if($participate_type1=='Scholar'){ echo 'readonly'; } ?> >
					  </div>
				 </div>
		      
				
		
				
		  <div class="col-md-12">
		     <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		  </div>
		</form>	
	</div>
	
<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

