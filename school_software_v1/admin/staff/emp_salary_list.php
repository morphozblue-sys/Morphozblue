<?php include("../attachment/session.php")?>
<script>
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
</script>
    <section class="content-header">
       <h1><?php echo $language['Employee Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small></h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  	 <li><a href="javascript:get_content('staff/employee_list')"><i class="fa fa-male"></i><?php echo $language['Employee List']; ?></a></li>
	  <li class="active"><?php echo $language['Employee Salary List']; ?></li>
      </ol>
    </section>


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
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Employee Name']; ?></th>
                  <!-- <th><?php //echo $language['Photo']; ?></th> -->
				  <th><?php echo $language['Contact No']; ?></th>
                  <th><?php echo $language['Designation']; ?></th>
                  <th><?php echo $language['Salary']; ?></th>
				  <th><?php echo $language['Details']; ?></th>
                </tr>
                </thead>
    <tbody>
                
           
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
  $(function () {
      var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"staff/salary_list_fatch.php",
                    type:"post"
                }
            });
   // $('#example1').DataTable()
  })
 
</script>
   