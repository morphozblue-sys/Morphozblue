<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Employee Attendance Register
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-money"></i> Staff</a></li>
	  <li class="active">Employee Attendance Register</li>
      </ol>
    </section>
	<script>
	function for_check(id){
   if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
    }else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
   }
   }
   
   function validation(){
   var add=0;
   $(".checked1").each(function() {
	if($(this).prop("checked") == true){
	add=add+1;
	}
	});
    if(add>0){
	return true;
	}else{
	alert_new("Please Select Atleast One Employee !!!",'red');
	return false;
	}
   }
   
       $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"staff/emp_attendance_register_api.php",
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
				   get_content('staff/emp_attendance_register');
            }
			}
         });
      });
   
	</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form id="my_form" method="post" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12">
			  
              <div class="col-sm-2">
			  </div>
              <div class="col-sm-8">
			  <div class="container-fluid">
			  <div class="panel panel-default">
			  <div class="panel-body">
			    <div class="col-sm-12">
				
				<table class="table table-bordered table-striped">
				<thead >
				<tr>
				<td>#</td>
				<td><input type="checkbox" id="checked1" onclick="for_check(this.id);" checked> All</td>
				<td>Empolyee Name</td>
				<td>Attendance Register</td>
				</tr>
				</thead>
				<tbody id="priority">
				<?php
				$query="select * from employee_info where emp_status='Active' ORDER BY emp_attendance_priority ASC";
				$result=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
				$serial_no=0;
				$serial_no11=0;
				while($row=mysqli_fetch_assoc($result)){
				$emp_id=$row['emp_id'];
				$emp_name=$row['emp_name'];
				$emp_attendance_priority=$row['emp_attendance_priority'];
				$emp_attendance_register=$row['emp_attendance_register'];
				$serial_no++;
				?>
				<tr>
				<td><b><?php echo $serial_no.'.'; ?></b><input type="hidden" name="emp_id[]" class="form-control" value="<?php echo $emp_id; ?>" readonly /></td>
				<td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="emp_index[]"></td>
				<td><input type="text" name="emp_name[]" class="form-control" value="<?php echo $emp_name; ?>" readonly /></td>
				<td>
				  <select name="emp_attendance_register[]" class="form-control">
			        <option value="">Select</option>
			        <?php
                    $query1="select * from school_info_attendance_register";
                    $result1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
                    while($row1=mysqli_fetch_assoc($result1)){
                    $register_name=$row1['register_name'];
			        ?>
			        <option <?php if($emp_attendance_register==$register_name){ echo 'selected'; } ?> value="<?php echo $register_name; ?>"><?php echo $register_name; ?></option>
			        <?php } ?>
			      </select>  
				</td>
				</tr>
				<?php
				 $serial_no11++; }
				?>
				</tbody>
				<tfoot>
				
				<tr>
				<td colspan="6"><center><input type="submit" name="submit" value="Update" onclick="return validation();" class="btn btn-success" /></center></td>
				</tr>
				
				</tfoot>
				</table>
				
				</div>
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-2"></div>
			  
			  </div>
			</div>
		</div>
	</div>
  </div>
      <!-- /.row -->
  </section>
  </form>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>