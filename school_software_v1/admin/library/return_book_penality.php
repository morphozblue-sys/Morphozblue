<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> 
<?php include("../attachment/header.php")?>  
<?php include("../attachment/sidebar.php")?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Library Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="library.php"><i class="fa fa-book"></i> Library</a></li>
        <li class="active">Return Book Penality</li>
      </ol>
    </section>
	<!-- Model Box -->
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true">&times;</span></button>
	    <h4 class="modal-title">Teacher Reply</h4>
		</div>
	    <div class="modal-body">
		<div class="file_upload">
		<form action="file_upload.php" class="dropzone">
			 <div class="dz-message needsclick">
			 <div class="form-group">
						  <label>Student Roll no<font style="color:red"><b>*</b></font></label>
						   <input type="text" class="form-control" name="student_roll_no" value="<?php echo $student_roll_no; ?> "  readonly />
						</div>

			 </div>
	   </form>		
	   </div>
									  
		  <p>One fine body&hellip;</p>
		  </div>
		  <div class="modal-footer">
		  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		  </div>
		  </div>
		  <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		  </div>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form">
			<?php 
			include("../../con73/con37.php");
			
			 $student_roll_no=$_GET['id'];
			$sql="select * from issue_book where student_roll_no='$student_roll_no'";
			$res=mysqli_query($conn73,$sql);
			while($row=mysqli_fetch_assoc($res)){
			$id=$row['id'];
			$book_id_no=$row['book_id_no'];
			$student_roll_no=$row['student_roll_no'];
			$issue_date=$row['issue_date'];
			$return_date=$row['return_date'];
			
			
			
			
			
			}
			
			?>
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Student Roll no<font style="color:red"><b>*</b></font></label>
						   <input type="text" class="form-control" name="student_roll_no" value="<?php echo $student_roll_no; ?> "  readonly />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>BOOK_ID_No.</label>
						   <input type="text" name="book_id_no" class="form-control" value="<?php echo $book_id_no; ?> " readonly />
						</div>
							</div>
				<div class="col-md-4 ">		
						<div class="form-group">
						  <label>RETURNING DATE</label>
						  <input type="date" class="form-control" name="date_of_return" value=
					 "<?php echo $return_date; ?>">
						</div>
					</div>
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label>RETURN DATE</label>
					  <input type="date" class="form-control" name="date_of_return1" value=
					 "<?php echo date('Y-m-d'); ?>">
					</div>
				  </div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Panelity</label>
					  <input type="text" class="form-control" name="panelity" value=
					 "">
					</div>
				  </div>
				    <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Remark</label>
					  <input type="text" class="form-control" name="remark" value=
					 "">
					</div>
				  </div>
				
		</form>	 
		<div class="col-md-12">
		       <th><button type="button" class="btn btn-default " data-toggle="modal"  onclick="open_model(<?php echo $student_roll_no; ?>)" data-target="#modal-default" >Reply</th>
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>

