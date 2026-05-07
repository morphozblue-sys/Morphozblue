<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function add_edit(value,name){
    $('#class_preffered').find('option:selected').remove().end();
    $('#subject_preffered').find('option:selected').remove().end();
var emp_detail=name.split('|?|');
$('#emp_name').val(emp_detail[0]);
var class_preffered1=emp_detail[1].split(",");
var class_length=class_preffered1.length;

for(var x=0;x<class_length;x++){
      if(class_preffered1[x]!=''){
$('#class_preffered').prepend( '<option value="'+class_preffered1[x]+'" selected>'+class_preffered1[x]+'</option>');
}
}

var subject_preffered1=emp_detail[2].split(",");
var subject_length=subject_preffered1.length;
for(var x=0;x<subject_length;x++){
      if(subject_preffered1[x]!=''){
$('#subject_preffered').prepend( '<option value="'+subject_preffered1[x]+'" selected>'+subject_preffered1[x]+'</option>');
}
}


$('#emp_code_hidden').val(value);
}
</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
				   $("#myModal_close").click();
        $.ajax({
            url: access_link+"time_table/subject_wise_teacher_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   $('#myModal').modal('hide');
				
				   get_content('time_table/subject_wise_teacher');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['School Information Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-graduation-cap"></i>Time Table</a></li>
	  <li class="active">Subject Wise Teacher</li>
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
              <h3 class="box-title">Subject Wise Teacher</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
				<div class="col-md-12 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S No.</th>
                  <th>Teacher Name</th>
                  <th>Subject Preferred</th>
                  <th>Class Preferred</th>
                  <th>Add/Edit</th>		  
                </tr>
                </thead>
<tbody>
<?php
$serial_no=0;
	$qry="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$s_no=$row22['s_no'];
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							$emp_subject_preferred=$row22['emp_subject_preferred'];
							$emp_class_preferred=$row22['emp_class_preferred'];
					
	$name_str=$emp_name.'|?|'.$emp_class_preferred.'|?|'.$emp_subject_preferred;
	

	$serial_no++;
?>				
    <tr  align='center' >
    <th><?php echo $serial_no; ?></th>
	<th><?php echo strtoupper($emp_name); ?></th>
	<th><?php echo $emp_subject_preferred; ?></th>
	<th><?php echo $emp_class_preferred; ?></th>
	
	<th><button type="button" id="<?php echo $s_no; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add</th>
	</tr>
<?php } ?>
				</tbody>
                </table>
                </div>
<div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body" >
        <div class="col-md-12">
        <div class="form-group">
		<label>Teacher Name</label>
		<input type="text" name="emp_name" id="emp_name" class="form-control" readonly> 
		<input type="hidden" name="emp_code_hidden" id="emp_code_hidden" class="form-control">
		</div>
		</div>
		<div class="col-md-12">
	    <div class="form-group">
		<label>Class Preffered</label>
	 <select name="class_preffered[]" class="select2  form-control" id='class_preffered' multiple style="width:100%">
                  <?php
					 $query61="select * from school_info_class_info";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $class_name=$row61['class_name'];
			
					?>
					<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
							<?php
							}
							?>
						
	</select>
		</div>
        </div>
		<div class="col-md-12">
	    <div class="form-group">
		<label>Subject Preferred</label>
	 <select name="subject_preffered[]" class="select2  form-control" id='subject_preffered' multiple style="width:100%">
                  <?php
					 $query61="select * from school_info_subjects";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
						
	</select>
		</div>
        </div>
      </div>
	  <div class="modal-footer">
		<input type="submit" name="finish" value="ADD" class="btn btn-success" />
          <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	
		  </form>
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