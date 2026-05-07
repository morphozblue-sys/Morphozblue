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
				   get_content('staff/employee_drop_list');
			   }else{
               alert_new('Sorry!!! Some Error Occured','red'); 
			   }
}
});
}

function for_rejoin(s_no){
    var myval=confirm("Are you sure you want to Re-Join this Employee !!!!");
    if(myval==true){
    for_rejoin11(s_no);
    }else{
    return false;
    }
}

function for_rejoin11(s_no){
$.ajax({
type: "POST",
url: access_link+"staff/employee_rejoin.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Completed','green');
				   get_content('staff/employee_drop_list');
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

function for_edit(s_no,drop_date){
$('#s_no').val(s_no);
$('#drop_date').val(drop_date);
}

 $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
				 $("#myModal_close").click();  
        $.ajax({
            url: access_link+"staff/employee_drop_api.php",
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
				
				   get_content('staff/employee_drop_list');
            }
			}
         });
      });
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

<?php 
$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
$experience_letter_pdf = $row['experience_letter_pdf'];
}	
?>

          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th>#</th>
                  <th><?php echo $language['Employee Name']; ?></th>
                  <!-- <th><?php //echo $language['Photo']; ?></th> -->
				  <th><?php echo $language['Contact No']; ?></th>
                  <th><?php echo $language['Designation']; ?></th>
                  <th>Drop Date</th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th>Print</th>
                  <th style="display:none;"><?php echo $language['Edit']; ?></th>
                  <th>Re - join</th>
                  <th><?php echo $language['Delete']; ?></th>
                  <th>Drop Date</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				$que="select * from employee_info where emp_status='Drop' ORDER BY emp_drop_date DESC";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$emp_name=$row['emp_name'];
				$emp_mobile=$row['emp_mobile'];
				$emp_designation=$row['emp_designation'];
				$emp_id=$row['emp_id'];
				if($row['emp_drop_date']!='0000-00-00' && $row['emp_drop_date']!=''){
                $emp_drop_date=date('d-m-Y',strtotime($row['emp_drop_date']));
                }else{
                $emp_drop_date=$row['emp_drop_date'];
                }
                $emp_drop_date11=$row['emp_drop_date'];
				
                $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
			
				$serial_no++;
			$emp_photo ='';
			

			
				?>

                <tr>
                <td ><?php echo $serial_no; ?></td>
				<td><?php echo $emp_name; ?></td>
				<!-- <td> <img onclick="open_file1('emp_photo','<?php //echo $emp_id; ?>');" src="<?php //if($emp_photo!=''){ echo $_SESSION['amazon_file_path']."employee_document/".$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50" style="margin-top:10px;"></td> -->
				<td><?php echo $emp_mobile; ?></td>
				<td><?php echo $emp_designation; ?></td>
				<td><?php echo $emp_drop_date; ?></td>
				
                <td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>
				
				<td><a target="_blank" href='<?php echo $pdf_path; ?>salary_slip/<?php echo $experience_letter_pdf; ?>?s_no=<?php echo $s_no; ?>'><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
				<td style="display:none;"><button type="button"  onclick="post_content('staff/employee_edit','<?php echo 's_no='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button></td>
				<td><button type="button"  class="btn btn-info" onclick="return for_rejoin('<?php echo $s_no; ?>');" >Re - join</button></td>
				<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
				<td><button type="button"  class="btn btn-success" onclick="for_edit('<?php echo $s_no; ?>','<?php echo $emp_drop_date11; ?>')" data-toggle="modal" data-target="#myModal" >Change</button></td>
				</tr>
				<?php } ?>
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
    
<div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">
         <div class="form-group">
		<label>Drop Date</label>
		<input type="date" name="drop_date" id="drop_date" class="form-control" />
		<input type="hidden" name="s_no" id="s_no" class="form-control" />
	  </div>
        </div>
        <div class="modal-footer">
		<input type="submit" name="finish" value="Edit" class="btn btn-success" />
          <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal"><?php echo $language['Close']; ?></button>
        </div>
      </div>
      
    </div>
	  </form>
  </div>
    
     <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>
  