<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active"> <?php echo $language['Student Fee List']; ?></li>
      </ol>
    </section>
	
<script>
function reset_fee1(student_roll_no){

	var myval=confirm("Are You Sure You Want to Reset Fee of This Student !!!");
	if(myval==true){
		reset_fee(student_roll_no);
	}
	   
}

function reset_fee(student_roll_no){
window.scrollTo(0, 0);
    get_content(loader_div);
	$.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/reset_fee_details_api.php?student_roll_no="+student_roll_no+"",
		  cache: false,
		  success: function(detail){
			var res=detail.split("|?|");
			if(res[1]=='success'){
			alert('Reset Successfully');
			get_content('fees_monthly/student_admission_fee_list');
			}
		  }
	   });
	   
}
</script>

	<!---******************************************************************************************************-->
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <h3 class="box-title"><?php echo $language['Student Fee']; ?></h3>
		   </div>
 <div class="box-body ">
	<div class="col-md-12">
                <!-- /.box -->

                <div class="box">
                <div class="box-header">
                </div>
			
		<div class="box-body table-responsive" id="search_list">
				  <table id="example1" class="table table-bordered table-striped">
						<thead class="my_background_color">
								<tr>
								  <th>#</th>
								  <th>Admission No.</th>
								  <th><?php echo $language['Student Name']; ?></th>
								  <th><?php echo $language['Father Name']; ?></th>
								  <th><?php echo $language['Class']; ?>/Section</th>
								  <th>Fee Amount</th>
								  <th>Paid Amount</th>
								  <th>Balance Amount</th>
								  <th>Status</th>
								  <th>Update By</th>
                                  <th>Date</th>
								  <th>Edit</th>
								</tr>
						</thead>
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
    </section>
<script>



    </script>
    <script>
$(function(){
            var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"fees_monthly/transport_fees_student_list_ajax.php",
                    type:"post"
                }
            });
            
})

</script>