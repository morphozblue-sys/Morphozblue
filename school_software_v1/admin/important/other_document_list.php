<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>Other Document List</h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('important/important')"><i class="fa fa-check-square"></i>Important</a></li>
		<li><a>Other Document List</a></li>
      </ol>
    </section>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"important/other_document_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('important/other_document_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">Other Document List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                   <th>Serial No.</th>
                   <th>Name</th>
                   <th>Class</th>
                   <th>Remark</th>
                  <th>Date</th>
                  <th>Documents</th>
				  <th>Edit</th>
				  <th>Delete</th>
				</tr>
                </thead>
                <tbody>
                <?php

$que="select * from govt_official_other_info  order by s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$class=$row['class'];
		$remark=$row['remark'];
		$other_document_name=$row['other_document_name'];
		$document_date=$row['document_date'];
	$serial_no++;
	
$document_upload1=$row['other_document_upload_name'];
$document_upload2=$_SESSION['amazon_file_path']."govt_official_other_document/".$document_upload1;
	
	
?>
                
	<tr>         
	<th><?php echo $serial_no; ?></th>
	<th><?php echo $other_document_name; ?></th>
	<th><?php echo $class; ?></th>
	<th><?php echo $remark; ?></th>
	<th><?php echo $document_date; ?></th>
	<th><img onclick="open_file1('other_document_upload','govt_official_other_document','other_info_id','<?php echo $s_no; ?>');" src="<?php if($document_upload1!=''){ echo $document_upload2; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></th>
	<th><button type="button" class="btn btn-success" onclick="post_content('important/other_document_edit','<?php echo 'id='.$s_no; ?>');" >Edit</button></th>
	<th><button type="button" class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" >Delete</button></th>
    </tr>
				<?php } ?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
     <div id="mypdf_view">
			<div>
    </section>
<script>
$(function(){
$('#example1').DataTable()
})
</script>