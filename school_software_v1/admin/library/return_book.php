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
        <li class="active">Return Book</li>
      </ol>
    </section>


	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"  style="font:italic bold 30px/30px Georgia, serif;color:#230226;">RETURN BOOK</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th style="color:black">S.No</th>
				  <th style="color:black">BOOK ID No.</th>
                 
				  <th style="color:black">STUDENT ROLL NO</th>
                  <th style="color:black">ISSUE DATE</th>
                  <th style="color:black">RETURNING DATE</th>
                  <th style="color:black">PENALTY</th>
                  <th style="color:black;"><center>ACTION</center></th>
                </tr>
                </thead>
                <tbody id="search_table">
                
                <?php 
include('../../con73/con37.php');



$sql="select * from issue_book where status='active'";
$serial_no=0;
$ex=mysqli_query($conn73,$sql);
while($row=mysqli_fetch_assoc($ex)){
     $id=$row['id'];
    $book_id_no=$row['book_id_no'];
    //$book_title=$row['book_title'];
    $student_roll_no=$row['student_roll_no'];
    $issue_date=$row['issue_date'];
	$date01=explode("-",$issue_date);
    $date02=$date01[2]."-".$date01[1]."-".$date01[0];
    $return_date=$row['return_date'];
    $status=$row['status'];
    $date1=explode("-",$return_date);
	$date_2=$date1[2]."-".$date1[1]."-".$date1[0];
	$serial_no++;
	$current_date=date('Y-m-d');
	$penality=0;
    
	$diff1=0;
	if($current_date>$return_date){
	$date1 = new DateTime($return_date);
    $date2 = new DateTime($current_date);
	$diff = $date1->diff($date2);
    $diff1=$diff->days;
	$penality=$diff1*10;
	}
	else{
	$penality=0;
	}
	?>
<form action='' method="post">
			  
			  
			  

				<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $student_roll_no; ?></th>
			<th><?php echo $date02; ?></th>
			<th><?php echo $date_2; ?></th>
		    <th><?php echo $penality;  ?></th>
			<td>
			<a href='submit_book.php?id=<?php echo $book_id_no; ?> && id2=<?php echo $student_roll_no; ?>&&id3=<?php echo $penality; ?>'style="color:#fff;"><input type="button" name="submit" value="Return" class="btn btn-default" style="background-color:#242821;color:#fff;"></a>
			<a href='pay_penality.php?id=<?php echo $id; ?> && id2=<?php echo $student_roll_no; ?>&&id3=<?php echo $penality; ?>'style="color:#fff;"><input type="button" name="submit" value="PAY DUE" class="btn btn-default" style="background-color:#15265b;color:#fff;display:none"></a>
			
			</td>
			
	   </tr>
			</form>	
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
