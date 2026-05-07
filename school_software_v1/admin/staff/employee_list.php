<?php include("../attachment/session.php"); ?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_employee(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_employee(s_no){
$.ajax({
type: "POST",
url: access_link+"staff/employee_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('staff/employee_list');
			   }else{
               alert_new('Sorry!!! Some Error Occured','red'); 
			   }
}
});
}

function for_drop(s_no){
    var myval=confirm("Are you sure you want to Drop this Employee !!!!");
    if(myval==true){
    for_drop11(s_no);
    }else{
    return false;
    }
}

function for_drop11(s_no){
$.ajax({
type: "POST",
url: access_link+"staff/employee_drop.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");  
			   if(res[1]=='success'){
				   alert_new('Successfully Completed','green');
				   get_content('staff/employee_list');
			   }else{
               alert_new('Sorry!!! Some Error Occured','red'); 
			   }
}
});
}

function open_file1(image_type,emp_id){
	$.ajax({
	address: "POST",
	url: access_link+"staff/ajax_open_image.php?image_type="+image_type+"&emp_id="+emp_id+"",
	cache: false,
	success: function(detail){
	 $("#mypdf_view").html(detail);
	}
	});
	}

function fill_detail(){

var emp_id=document.getElementById('employee_id').value;
$.ajax({
type: "POST",
url: access_link+"staff/ajax_get_emp_detail.php?emp_id="+emp_id+"",
cache: false,
success: function(detail){
    
    console.log(detail)
    
  $("#emp_detail_list").html(detail);
}
});

}
	
</script>
  <section class="content-header">
      <h1><?php echo $language['Employee Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small></h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  <li class="active"><?php echo $language['Employee List']; ?></li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
                <div class="col-md-4 col-md-offset-4">				
                <div class="col-md-12">				
					<div class="form-group" >
					  <label><?php echo "Search Employees"; ?><font size="2" style="font-weight: normal;"></label>
					  <select name="" class="form-control select2" onchange="fill_detail();" id="employee_id" >
					  <option value="All">All</option>
					        <?php
                            $que1="select * from employee_info where emp_status='Active' ORDER BY s_no DESC";
                            $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
                            while($row1=mysqli_fetch_assoc($run1)){
                            $s_no=$row1['s_no'];
                            $emp_name=$row1['emp_name'];
                            $emp_mobile=$row1['emp_mobile'];
                            $emp_dob1=$row1['emp_dob'];
                            $emp_dob=date('d-m-Y',strtotime($emp_dob1));
                            $emp_designation=$row1['emp_designation'];
                            $emp_id=$row1['emp_id'];
							?>
							<option value="<?php echo $emp_id; ?>"><?php echo $emp_name."[".$emp_id."]-[".$emp_designation."]-[".$emp_mobile."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
			</div>
                
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th>S.NO.</th>
                  <th><?php echo $language['Employee Name']; ?></th>
                  <!-- <th><?php //echo $language['Photo']; ?></th> -->
				  <th><?php echo $language['Contact No']; ?></th>
				  <th><?php echo 'D.O.B.'; ?></th>
                  <th><?php echo $language['Designation']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th><?php echo $language['Edit']; ?></th>
                  <th>Drop</th>
                  <th><?php echo $language['Delete']; ?></th>
                  <th>Joining Letter</th>
                </tr>
                </thead>
                <tbody id="emp_detail_list">

                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<div id="mypdf_view">
			<div>
      </div>
      <!-- /.row -->
    </section>
         <script>
  $(function () {
      var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"staff/emp_list_fatch.php",
                    type:"post"
                }
            });
   // $('#example1').DataTable()
  })
 
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

  