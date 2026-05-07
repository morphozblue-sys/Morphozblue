<?php include("../attachment/session.php")?> 
 


 <!DOCTYPE html>
<html>
<head>
 
   <?php include("../attachment/link_css.php")?>
<script src="../attachment/file_check.js"></script>


  

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

<?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
      <section class="content-header">
				  <h1>
					GROWIDE MANAGEMENT
					<small>Control panel</small>
				  </h1>
				  <ol class="breadcrumb">
					<li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="download.php"><i class="fa fa-male"></i>Download</a></li>
					 <li class="active">Download List</li>
				  </ol>
				</section>
	<!---**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body">
	<form method="post" enctype="multipart/form-data" action="download_projection_list.php">
			 
		<div class="box-body">
		<h3 style="margin-top:0px;"><b>Download Projection List</b></h3>
			
			<div class="col-md-2" style="margin-left:350px;">
				<div class="form-group">
                    <label>Date From<font style="color:red"><b>*</b></font></label>
                    <input type="date"  name="date_from" id=""    value=""  required>
                </div>
			</div>
			<div class="col-md-2" style="margin-left:0px;">
				<div class="form-group">
                    <label>Date To<font style="color:red"><b>*</b></font></label>
                    <input type="date"  name="date_to" id=""    value="" required>
                </div>
			</div>
			
			
			
	           </div>
			   
	    <div class="col-md-12">
		    <center><input type="submit" name="finish" value="Submit" class="btn  btn-success" /></center>
		</div>
	  </form>	
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	


 <?php include("../attachment/link_js.php")?>
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
</body>
</html>
