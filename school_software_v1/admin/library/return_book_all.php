<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>


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
        <li class="active">View Issued Book List</li>
      </ol>
	 
    </section>
	
<div class="modal fade" id="modal-default">
 
		<div class="modal-dialog">
		
		<div class="modal-content">
	
		<div class="modal-header">
			
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true">&times;</span></button>
	    <h4 class="modal-title">RETURN BOOK</h4>
		</div>
		<form method="post"  >
	    <div class="modal-body">
		
		
			 <div class="form-group">
						  <label>Student Roll no<font style="color:red"><b>*</b></font></label>
						   <input type="text" class="form-control" name="student_roll_no" id="student_roll_no"  readonly />
						</div>
						<div class="form-group">
						  <label>BOOK_ID_No.</label>
						   <input type="text" name="book_id_no" id="book_id_no" class="form-control" readonly />
						</div>
<div class="form-group" >
					  <label>ISSUE DATE </label>
					  <input type="date" class="form-control" name="date_of_return1" value=
					 "<?php echo date('Y-m-d'); ?>">
					</div>
						<div class="form-group">
						  <label>RETURNING DATE</label>
						  <input type="date" class="form-control" name="date_of_return" id="date_of_return">
						</div>
						
					<div class="form-group" >
					  <label>Panelity</label>
					  <input type="text" class="form-control" name="penalty" value=
					 "">
					</div>
					<div class="form-group" >
					  <label>Remark</label>
					  <input type="text" class="form-control" name="remark" value=
					 "">
					</div>
	   		
	
									  
		  </div>
		  <div class="modal-footer">
		  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		  <input type="submit" name="submit" value="save" class="btn btn-primary" >
		  </div>
		  </form>
		  </div>
		  <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		  </div>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border ">
              <h3 class="box-title" style="serif;color:#230226;">Issued Book list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No</th>
				  <th>Borrower No./Accession No.</th>
				  <th>Borrower Name</th>
				  <th>Borrower Class & Section</th>
				  <th>Book TItle</th>
				  <th>Author </th>
                  <th>Date of Issue</th>
                  <th>Due Date</th>
                  <th>Date of Return</th>
                  <th>No. Overdue Days</th>
                  <th>Overdue Fine</th>
                  <th></th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody id="search_table">
                
               <?php 
include('../../con73/con37.php');
$sql="select * from issue_book where status='Active'";
$serial_no=0;
$ex=mysqli_query($conn73,$sql)or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($ex)){

    $book_id_no=$row['book_id_no'];
    $student_roll_no=$row['student_roll_no'];
    $issue_date=$row['issue_date'];
    $due_date=$row['due_date'];
    $class=$row['class'];
    $author_name=$row['author_name'];
    $book_title=$row['book_title'];
    $student_name=$row['student_name'];
 
   
	?>
			<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $student_name; ?></th>
	        <th><?php echo $class; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $author_name; ?></th>
			<th><?php echo $issue_date; ?></th>
			<th><?php echo $due_date; ?></th>
		<!--<th><?php 
		if($date3[2]<=$date1[2] && $date3[1]<=$date1[1] && $date3[0]<=$date1[0]){
			 echo '<span style="color:#700134;text-decoartion: blink">Pending</span>';
		}else{
		echo '<span style="color:green;text-decoartion: blink">check status</span>'; }
		?>-->
		
			
			<input type="hidden" value="<?php echo $book_id_no; ?>" id="<?php echo "student_book_".$student_roll_no; ?>">
			<input type="hidden" value="<?php echo $return_date; ?>" id="<?php echo "student_date_".$student_roll_no; ?>">
			  <td><button type="button" name="finish" class="btn btn-default" value="<?php echo $student_roll_no; ?>" onclick="open_model(this.value)" data-toggle="modal"  data-target="#modal-default" id="student_roll_no" >Return
			 
			  
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  <script>
	function open_model(roll_no){
	var book_id=document.getElementById("student_book_"+roll_no).value;
	var date=document.getElementById("student_date_"+roll_no).value;
	document.getElementById("student_roll_no").value=roll_no;
	document.getElementById("book_id_no").value=book_id;
	document.getElementById("date_of_return").value=date;
	
	}
	
</script>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
<?php 
include("../../con73/con37.php");
if(isset($_POST['submit'])){

 $student=$student_roll_no;
 $book_id_no=$_POST['book_id_no'];
 $date_of_return=$_POST['date_of_return'];
 $date_of_return1=$_POST['date_of_return1'];
 $penalty=$_POST['penalty'];
 $remark=$_POST['remark'];
 
 $query1="select * from school_library_book where book_id_no='$book_id_no'";
$run=mysqli_query($conn73,$query1)or (mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){
    $no_of_copy=$row['no_of_copy'];
	}
 
 $no_of_copy1=$no_of_copy+1;
  
  $query="update issue_book set penalty='$penalty',return_date='$date_of_return1',remark='$remark',status='Deactive',$update_by_update_sql  where student_roll_no='$student'";
  mysqli_query($conn73,$query);
  if($penalty>=0){
    $sql="insert into library_accounts(student_roll_no,date_of_return,penalty,$update_by_insert_sql_column) values('$student','$date_of_return1','$penalty',$update_by_insert_sql_value)";
    mysqli_query($conn73,$sql);
  }
  
  {
 $query2="update school_library_book set no_of_copy=$no_of_copy1,$update_by_update_sql  where book_id_no='$book_id_no'";
  mysqli_query($conn73,$query2);
   
   echo "<script>window.open('view_return_book_list.php','_self')</script>";
   }
   
  }
 
?>