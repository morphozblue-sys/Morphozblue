<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>


  
  
  

  
  
  
  
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
		<li><a href="view_book_library.php"><i class="fa fa-book"></i> Book List</a></li>
        <li class="active">Edit Issued Book</li>
      </ol>
	 
    </section>
	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">view issued book</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<?php
			include("../../con73/con37.php");
			 $id=$_GET['id'];
			$sql="select * from issue_book where book_id_no='$id'";
			$ex=mysqli_query($conn73,$sql);
			while($row=mysqli_fetch_assoc($ex)){
			    $id=$row['id'];
			   $book_id_no=$row['book_id_no'];
			   $student_roll_no=$row['student_roll_no'];
			   $issue_date=$row['issue_date'];
			   $return_date=$row['return_date'];
			   $class=$row['class'];
			   $status=$row['status'];
			   } 
			   ?>
			
			<form role="form">
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>CLASS<font style="color:red"><b>*</b></font></label>
						     <input type="text" name="class" style="color:black" class="form-control" value="<?php echo $class;?>  "readonly />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>STUDENT ROLL No.</label>
						   <input type="text" class="form-control" name="student_roll_no" value="<?php echo $student_roll_no; ?> "  readonly />
						</div>
							</div>
				<div class="col-md-4 ">		
						<div class="form-group">
						  <label>ISSUEING DATE</label>
						   <input type="date" class="form-control" name="issue_date" value="<?php echo $issue_date; ?>" placeholder="Enter today's date" readonly />
						</div>
					</div>
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label>RETURNING DATE</label>
					 <input type="date" class="form-control" name="date_of_return" value=
					 "<?php echo $return_date; ?>">
					</div>
				  </div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
					    <?php
				  include("../../con73/con37.php");
				  $id=$_GET['id'];
				
				  $qry2="select * from school_library_book where book_id_no='$id'";
				  $res2=mysqli_query($conn73,$qry2);
				  while($row2=mysqli_fetch_assoc($res2)){
				  $id=$row2["id"];
				  $book_id_no=$row2["book_id_no"];
				  $book_title=$row2["book_title"];
				  $no_of_copy=$row2["no_of_copy"];
				  
				  }?>
						</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >BOOK_ID_No.</label>
					  <input type="text" name="book_id_no" class="form-control" value="<?php echo $book_id_no; ?> " readonly />
					</div>
				</div>	
				
			 <center><input type="submit" name="finish" value="submit" class="btn btn-success" /></center>
				
		</form>	
		<div class="col-md-12">
		       
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
<?php
include("../../con73/con37.php");
if(isset($_POST["finish"])){
  $book_id_no=$_POST['book_id_no'];
  $student_roll_no=$_POST['student_roll_no'];
  $issue_date=$_POST['issue_date'];
  $return_date=$_POST['date_of_return'];
  $class=$_POST['class'];
  $status=$_POST['status'];
	
  $query1="update issue_book set return_date='$return_date' where student_roll_no='$student_roll_no'";
	if(mysqli_query($conn73,$query1)){
	  
	echo "<script>window.open('view_issued_book_list.php','_self')</script>";
	
	}
	}
	
	?>
	
