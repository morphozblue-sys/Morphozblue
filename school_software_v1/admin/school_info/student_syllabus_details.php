<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_record(s_no);       
 }            
else  {      
return false;
 }       
  } 
  
function delete_record(s_no){
$.ajax({
type: "POST",
url: access_link+"school_info/student_syllabus_details_delete.php?s_no="+s_no+"",
cache: false,
success: function(detail){
	//alert(detail);
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				    alert_new('Successfully Deleted!!!','green');
				  
				   get_content('school_info/student_syllabus_details');
			   }else{
              alert_new('Sorry!!! Some error occcured','red');
			   }
}
});
}
</script>
<script type="text/javascript">
   function for_section(value){
       if(value!=''){
  $('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"school_info/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                  $("#student_class_section").html(detail);
                  for_subject();
              }
           });
       }else{
           $("#student_class_section").html("<option value=''>Select Section</option>");
           for_subject();
       }
    }
    
    function for_subject(){
    var student_class= document.getElementById('student_class').value;
    if(student_class!=''){
    $('#subject_name').html("<option value='' >Loading....</option>");
    $.ajax({
    address: "POST",
    url: access_link+"school_info/ajax_get_subject.php?value="+student_class+"",
    cache: false,
    success: function(detail){
    $("#subject_name").html(detail);
    for_list();
    }
    });
    }else{
           $("#subject_name").html("<option value=''>Select Subject</option>");
           for_list();
       }
    }
    
function for_list(){ 
var student_class= document.getElementById('student_class').value;
var student_class_section= document.getElementById('student_class_section').value;
var subject_name= document.getElementById('subject_name').value;
if(student_class_section!='' && student_class!='' && subject_name!='' ){
$('#example2').html(loader_div);
$.ajax({
type: "POST",
url:  access_link+"school_info/ajax_student_syllabus_details.php?id="+student_class+"&student_section="+student_class_section+"&subject_name="+subject_name+"",
cache: false,
success: function(detail){
$('#example2').html(detail);
}
});
}else{
$('#example2').html('');
}
}


function for_section1(value){
       if(value!=''){
  $('#model_student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
             url:  access_link+"school_info/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                  $("#model_student_class_section").html(detail);
                  for_subject1();
              }
           });
       }else{
           $("#model_student_class_section").html("<option value=''>Select Section</option>");
           for_subject1();
       }
    }
    
    function for_subject1(){
    var student_class= document.getElementById('model_student_class').value;
    if(student_class!=''){
    $('#model_subject_name').html("<option value='' >Loading....</option>");
    $.ajax({
    address: "POST",
    url: access_link+"school_info/ajax_get_subject.php?value="+student_class+"",
    cache: false,
    success: function(detail){
    $("#model_subject_name").html(detail);
    }
    });
    }else{
           $("#model_subject_name").html("<option value=''>Select Subject</option>");
       }
    }
    
function syllabus_submit() {
    var $btn = $('#syllabus_add_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var formdata = new FormData(document.getElementById('my_form'));
    $.ajax({
        url: access_link + 'school_info/student_syllabus_details_add.php',
        type: 'POST', data: formdata, mimeTypes: 'multipart/form-data',
        contentType: false, cache: false, processData: false,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Syllabus saved!', 'green');
                $('#myModal').one('hidden.bs.modal', function () { get_content('school_info/student_syllabus_details'); });
                $('#myModal').modal('hide');
            } else { alert_new('Could not save. Please try again.', 'red'); }
        },
        error: function () { $btn.prop('disabled', false); alert_new('Connection error.', 'red'); }
    });
}
      
    function for_edit(sno){
        if(sno!=''){
        $.ajax({
        type: "POST",
        url:  access_link+"school_info/ajax_student_syllabus_details_edit.php?id="+sno+"",
        cache: false,
        success: function(detail){
        $('#edit_detail').html(detail);
        $('#edit_button').click();
        }
        });
        }else{
        $('#edit_detail').html('');
        $('#edit_button').click();
        }
    }
function syllabus_edit_submit() {
    var $btn = $('#syllabus_edit_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var formdata = new FormData(document.getElementById('my_form1'));
    $.ajax({
        url: access_link + 'school_info/student_syllabus_details_edit.php',
        type: 'POST', data: formdata, mimeTypes: 'multipart/form-data',
        contentType: false, cache: false, processData: false,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Syllabus updated!', 'green');
                $('#myModal1').one('hidden.bs.modal', function () { get_content('school_info/student_syllabus_details'); });
                $('#myModal1').modal('hide');
            } else { alert_new('Could not update. Please try again.', 'red'); }
        },
        error: function () { $btn.prop('disabled', false); alert_new('Connection error.', 'red'); }
    });
}
      });
      
    function for_complete(s_no,value){
        $.ajax({
        type: "POST",
        url:  access_link+"school_info/ajax_student_syllabus_details_complete_incomplete.php?s_no="+s_no+"&value="+value+"",
        cache: false,
        success: function(detail){
        
            var res=detail.split("|?|");
            if(res[1]=='success'){
            get_content('school_info/student_syllabus_details');
            }
        
        }
        });
    }
</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("example1");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
	   <li class="active"> Syllabus Details</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="si-card">
            <div class="si-card-header"><div class="si-hdr-ico"><i class="fa fa-book"></i></div><h4>Syllabus Details</h4></div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="si-card-body">
		
		<!--	<form role="form" id="my_form" method="post" enctype="multipart/form-data"> -->
			
			    <div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						        <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" onchange="for_subject();" required>
					     <option value="">Select Section</option>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3 ">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="subject_name" id="subject_name" onchange="for_list();" required>
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
				 
				 <div class="col-md-3 ">
				 <div class="form-group">
				 <center><label >For Add</label></center>
			     <button class="si-btn si-btn-pri" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add More</button>
				 </div>
				 </div>
				
				<div class="col-md-12">
                <!-- /.box -->

                <div>
                <div class="box-header with-border">
                    
                    <div class="col-md-12">
                    <div class="col-md-6">
                    <center><button type="button" class="btn default" onclick="exportTableToExcel('example1', 'Syllabus Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
                    </div>
                    <div class="col-md-6">
                    <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
                    </div>
                    </div>
                    
                </div>
                <!-- /.box-header  id="printTable" -->
                <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
                  <th>Class(Sec)</th>
                  <th>Subject Name</th>
				  <th>Syllabus Topic</th>
				  <th>Book Name</th>
				  <th>Chapter Book Name</th>
				  <th>Subject Teacher</th>
				  <th>Estimated Completion Date</th>
				  <th>Action</th>
                </tr>
                </thead>
				
				<tbody id="example2">
				
                <?php
                $query5="select * from school_info_syllabus_info where session_value='$session1' ORDER BY s_no";
                $serial_no=0;
                $res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
                while($row4=mysqli_fetch_assoc($res4)){
                $s_no=$row4['s_no'];
                $class=$row4['class'];
                $section=$row4['section'];
                $subject_name=$row4['subject_name'];
                $syllabus_topic=$row4['syllabus_topic'];
                $syllabus_book_name=$row4['syllabus_book_name'];
                $syllabus_chapter_book_name=$row4['syllabus_chapter_book_name'];
                //$syllabus_insert_date=$row4['syllabus_insert_date'];
                //$syllabus_completion_date=$row4['syllabus_completion_date'];
                $syllabus_subject_teacher=$row4['syllabus_subject_teacher'];
                $syllabus_student_feedback=$row4['syllabus_student_feedback'];
                $syllabus_completion_status=$row4['syllabus_completion_status'];
                $syllabus_remark=$row4['syllabus_remark'];
                $syllabus_estimated_completion_date=$row4['syllabus_estimated_completion_date'];
                $syllabus_actual_completion_date=$row4['syllabus_actual_completion_date'];
                
                if($syllabus_completion_status=='Complete'){
                    $btn_var1="Incomplete";
                    $btn_color="btn-default";
                }elseif($syllabus_completion_status=='Incomplete'){
                    $btn_var1="Complete";
                    $btn_color="btn-warning";
                }
                
                if($syllabus_estimated_completion_date!='0000-00-00' && $syllabus_estimated_completion_date!=''){
                $syllabus_estimated_completion_date=date('d-m-Y', strtotime($syllabus_estimated_completion_date));
                }
                
                $serial_no++;
                ?>
                
                <tr>
                <td><?php echo $serial_no.'.'; ?></td>
                <td><?php echo $class.' ('.$section.')'; ?></td>
                <td><?php echo $subject_name; ?></td>
                <td><?php echo $syllabus_topic; ?></td>
                <td><?php echo $syllabus_book_name; ?></td>
                <td><?php echo $syllabus_chapter_book_name; ?></td>
                <td><?php echo $syllabus_subject_teacher; ?></td>
                <td><?php echo $syllabus_estimated_completion_date; ?></td>
                <td>
                <button type="button" class="si-btn si-btn-ok" style="padding:4px 10px;font-size:11px;" onclick="for_edit('<?php echo $s_no; ?>');"><i class="fa fa-pencil"></i> Edit</button>&nbsp;
                <button type="button" class="si-btn si-btn-del" style="padding:4px 10px;font-size:11px;" onclick="return valid('<?php echo $s_no; ?>');"><i class="fa fa-trash"></i> Delete</button>&nbsp;
                <button type="button" class="btn <?php echo $btn_color; ?>" onclick="for_complete('<?php echo $s_no; ?>','<?php echo $btn_var1; ?>');" name="complete/incomplete"><?php echo $syllabus_completion_status; ?></button>
                </td>
                </tr>
                <?php } ?>
				
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		<!--  </form> -->
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<script>
$(function () {
$('#example1').DataTable()
})
</script>
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

<!-- Modal1 Start -->
<form role="form" id="my_form" method="post" enctype="multipart/form-data">
<!-- Modal -->
<div id="myModal" class="modal fade si-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Syllabus</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
            
            <div class="col-md-5">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select name="model_student_class" onchange="for_section1(this.value);" id="model_student_class" class="form-control" required>
						<option value="">Select Class</option>
						        <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="model_student_class_section" id="model_student_class_section" onchange="for_subject1();" required>
					     <option value="">Select Section</option>
					    </select>
					</div>
				</div>
				
				<div class="col-md-4">				
			    <div class="form-group" >
				 <label ><?php echo $language['Subject Name']; ?><font style="color:red"><b>*</b></font></label>
				 <select class="form-control" name="model_subject_name" id="model_subject_name" required>
				 <option value="">Select Subject</option>
				 </select>
				 </div>
				 </div>
				 
				 <div class="col-md-6">				
			    <div class="form-group" >
				 <label >Syllabus Subject Teacher<font style="color:red"><b>*</b></font></label>
				 <select class="form-control select2" name="model_subject_teacher" id="model_subject_teacher" style="width:100%" required>
				 <?php
				 $quee="select emp_name,emp_father,emp_mobile from employee_info where emp_status='Active' and emp_designation='Teacher'";
				 $runn=mysqli_query($conn73,$quee) or die(mysqli_error($conn73));
				 while($roww=mysqli_fetch_assoc($runn)){
				     $emp_name=$roww['emp_name'];
				     $emp_father=$roww['emp_father'];
				     $emp_mobile=$roww['emp_mobile'];
				 ?>
				 <option value="<?php echo $emp_name; ?>"><?php echo $emp_name.'['.$emp_father.']['.$emp_mobile.']'; ?></option>
				 <?php } ?>
				 </select>
				 </div>
				 </div>
				 
	<div class="col-md-6">
		<div class="form-group" >
		    <label>Syllabus Topic</label>
		    <input type="text" name="model_syllabus_topic" class="form-control" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Book Name</label>
		    <input type="text" name="model_syllabus_book_name" class="form-control" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Chapter Book Name</label>
		    <input type="text" name="model_syllabus_chapter_book_name" class="form-control" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Student Feedback</label>
		    <input type="text" name="model_syllabus_student_feedback" class="form-control" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Syllabus Remark</label>
		    <input type="text" name="model_syllabus_remark" class="form-control" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group" >
		    <label>Estimated Completion Date</label>
		    <input type="date" name="model_syllabus_estimated_completion_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required />
		</div>
    </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal" id="close_btn"><i class="fa fa-times"></i> Close</button>
        <button type="button" id="syllabus_add_btn" onclick="syllabus_submit();" class="si-btn si-btn-ok"><i class="fa fa-check"></i> Save</button>
      </div>
    </div>

  </div>
</div>
</form>
<!-- Modal1 End -->

<!-- Edit Model Start -->
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1" id="edit_button" style="display:none;">Open Modal</button>
<form role="form" id="my_form1" method="post" enctype="multipart/form-data">
<!-- Modal -->
<div id="myModal1" class="modal fade si-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Syllabus Edit</h4>
      </div>
      <div class="modal-body" id="edit_detail">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal" id="close_btn1"><i class="fa fa-times"></i> Close</button>
        <button type="button" id="syllabus_edit_btn" onclick="syllabus_edit_submit();" class="si-btn si-btn-ok"><i class="fa fa-check"></i> Update</button>
      </div>
    </div>

  </div>
</div>
</form>
<!-- Edit Model End -->
<script>
$(function () {
    $('.select2').select2();
  });
</script>