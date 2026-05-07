<?php include("../attachment/session.php")?>
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
		</h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Student Transport Fees List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
				  <th><?php echo $language['Student Name']; ?></th>
				  <th><?php echo $language['Father Name']; ?></th>
				  <th><?php echo $language['Class']; ?></th>
				  <th><?php echo $language['Student Section']; ?></th>
                  <th><?php echo $language['Submission Date']; ?></th>
				  <th><?php echo $language['Total Fee']; ?></th>
				  <th><?php echo $language['Total Paid']; ?></th>
				  <th><?php echo $language['Remaining Fee']; ?></th>
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
      <!-- /.row -->
    </section>

 <script>
        $(document).ready(function(){
            var dataTable=$('#example1').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"fees_monthly/fetch_transport_fees_module_twoapi.php",
                    type:"post"
                }
            });
        });
    </script>
	