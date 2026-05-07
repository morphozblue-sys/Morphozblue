<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<?php
$s_no1=$_GET['id'];




$que="select * from bus_details where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

	$bus_name = $row['bus_name'];
	$bus_company = $row['bus_company'];
	$bus_model_no = $row['bus_model_no'];
	$bus_no = $row['bus_no'];
	$bus_owner_name = $row['bus_owner_name'];
	$bus_owner_contact = $row['bus_owner_contact'];
	$bus_ragistration_no = $row['bus_ragistration_no'];
	$bus_document_uplode = $row['bus_document_uplode'];
	$bus_photo = $row['bus_photo'];
	$bus_id = $row['bus_id'];

		
	$serial_no++;
	
  $path1="../../documents/bus/".$bus_id;

	}

?>

    <section class="content-header">
    <h1>
     Bus Management
	     <small>Control Panel</small>
    </h1>
     <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	   
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> <?php echo $language['Bus Management']; ?></a></li>
        <li><a href="javascript:get_content('bus/bus_list')"><i class="fa fa-list"></i>Bus Details List</a></li>
        <li class="active">Bus Details Edit</li>
     </ol>
     </section>

       <!-- Main content -->
       <section class="content">
       <!-- Small boxes (Stat box) -->
       <div class="row">
	   <!-- general form elements disabled -->
       <div class="box box-warning  ">
       <div class="box-header with-border ">
       <h3 class="box-title">Bus Details Edit</h3>
       </div>
	   
       <!-- /.box-header -->
     <!------------------------------------------------Start Registration form--------------------------------------------------->

			

                  <div class="box-body "  >
			      <form role="form" method="post" enctype="multipart/form-data">
			      <input type="hidden" name="s_no1" value="<?php echo $s_no1; ?>" />
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Name</label>
						   <input type="text"  name="bus_name" placeholder="Name"  value="<?php echo $bus_name; ?>" class="form-control" >
						</div>
				   </div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Company</label>
						   <input type="text" name="bus_company" placeholder="Company Name"  value="<?php echo $bus_company; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="form-group">
						  <label>Bus Model No.</label>
						   <input type="text"  name="bus_model_no"  placeholder="Bus Model No."  value="<?php echo $bus_model_no; ?>" class="form-control" >
						</div>
					</div>
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus No.</label>
						   <input type="text" name="bus_no" placeholder="Bus No."  value="<?php echo $bus_no; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Name</label>
						   <input type="text" name="bus_owner_name" placeholder="Bus Owner Name"  value="<?php echo $bus_owner_name; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Owner Contact No</label>
						   <input type="text" name="bus_owner_contact" placeholder="Contact No"  value="<?php echo $bus_owner_contact; ?>" class="form-control" >
						</div>
					</div>
					
				    <div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Ragistration No.</label>
						   <input type="text" name="bus_ragistration_no" placeholder="Ragistration No."  value="<?php echo $bus_ragistration_no; ?>" class="form-control" >
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Document Uplode</label>
						   <input type="file" name="bus_document_uplode" placeholder="Uplode"  value="<?php echo $bus_document_uplode; ?>" class="form-control"><img src="<?php echo $path1."/".$bus_document_uplode; ?>" height="50" width="50">
						</div>
					</div>
					<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Bus Photo</label>
						   <input type="file" name="bus_photo" placeholder="Uplode"  value="<?php echo $bus_photo; ?>" class="form-control" ><img src="<?php echo $path1."/".$bus_photo; ?>" height="50" width="50">
						</div>
					</div>
				  
				 </div>
					
				    	
		   <div class="col-md-12">
		   <center><input type="submit" name="submit" value="update" class="btn btn-primary" /></center>
		   </div>
		   </form>
	                 </div>
       <!---------------------------------------------End Registration form--------------------------------------------------------->
	<!-- /.box-body -->
          </div>
          </div>
          </section>
         