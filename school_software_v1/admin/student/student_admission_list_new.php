<?php 
include("../attachment/session.php");
$school_info_school_medium=$_SESSION['school_info_medium'];
?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
admission_delete(s_no);       
 }            
else  {      
return false;
 }       
  } 
function admission_delete(s_no){
	      $("#get_content").html(loader_div);
$.ajax({
type: "POST",
url: access_link+"student/student_admission_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted',"red");
				   get_content('student/student_admission_list_new');
			   }else{
              //  alert_new(detail); 
			   }
}
});
}
</script>
<script>
function check_function(){
$("#search_list").html(loader_div);
 if($("#all_medium").prop("checked")==true){
    var value="Yes";
 }else{
     var value="No";
 }
    $.ajax({
    type: "POST",
    url: access_link+"student/student_admission_filter_checked_new.php?checked="+value+"",
    cache: false,
    success: function(detail){
    $("#search_list").html(detail);
    }
    });
}
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
      <li class="active"><?php echo $language['Student Admission List']; ?></li>
      </ol>
    </section>
	

	<!---******************************************************************************************************-->
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <h3 class="box-title"><?php echo $language['Admission List']; ?></h3>
			<?php include("admission_list_filter_new.php"); ?>
            </div>
                <?php if($school_info_school_medium=='Both'){  ?>
                    <div class="col-md-12">
                        <div style="float: right; font-size:15px;">
                            <label><input type="checkbox"  onclick="check_function();" name="all_medium" id="all_medium" value="" />Plz check to see the both medium student</label>
                        </div>
                    </div>
                <?php } ?>    
 <div class="box-body ">
	<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>">
                    
                <div class="box-header with-border">
                </div>

		<div class="box-body table-responsive" id="search_list">
				  <table id="example1" class="table table-bordered table-striped">
						<thead >
								<tr>
								  <th>#</th>
								  <th><?php echo $language['Student Name']; ?></th>
								  <th><?php echo $language['Father Name']; ?></th>
								  <th><?php echo $language['Class']; ?></th>
								  <th>Stream</th>
								  <th>Father Contact No.</th>
								  <th>student DOB</th>
								  <th>student Age</th>
								  <th><?php echo $language['Student Roll No']; ?></th>
								  <th>Admission No</th>
								  <?php if($_SESSION['database_name']=='simptkfv_sunriseschoolbijuri'){ ?>
								  <th>Scholar No</th>
								  <?php } ?>
                                <th>Update By</th>
                                <th>Date</th>
								 
								  <th><?php echo $language['Edit']; ?></th>
								  <th><?php echo $language['Delete']; ?></th>
								  <th><?php echo $language['Print']; ?></th>
								  <th>Scholar <?php echo $language['Print']; ?></th>
								</tr>
						</thead>
					<tbody>
					

					</tbody>
				 </table>
			</div>
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
 

<script>
  $(function (){
    for_list();
  })
</script>