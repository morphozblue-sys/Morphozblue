<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> 
<?php include("../attachment/header.php")?> 
 <?php include("../attachment/sidebar.php")?> 
  
  <script type="text/javascript">
   function search_class(value){
    //alert_new(value);
       $.ajax({
			  type: "POST",
              url: "library_search_class.php?id="+value+"",
              cache: false,
              success: function(detail){
			    // //alert_new(detail); 
            $('#search_table').html(detail);
              }
           });
    }
</script>
<script type="text/javascript">
   function search_subject(value){
     //alert_new(value);
	  var subject =document.getElementById('class_no').value;
	 //alert_new(subject);
       $.ajax({
			  type: "POST",
              url: "library_search_subject.php?id="+value+"&id2="+subject+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail); 
            $('#search_table').html(detail);
              }
           });
    }
</script>

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
        <li class="active">View Book</li>
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
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			
			  
			   
			 
			   <div class="col-md-2">
			 <span class="input-group-btn">
                      <button class="btn btn-default" type="button" style="background-color:#537266;"><a href="library_add_book.php" style="color:#fff;">ADD NEW BOOK</a></button>
					  
                    </span>
			  </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead >
               <tr>
				  <th style="color:black">S.No</th>
				  <th style="color:black">BOOK ID No.</th>
                  <th style="color:black">BOOK NAMe</th>
				  <th style="color:black">SUBJECT</th>
                  <th style="color:black">CLASS</th>
                  <th style="color:black">PUBLISH DATE</th>
                <th style="color:black">PUBLISHER</th>
				  <th style="color:black">PRICE</th>
				  <th style="color:black">AVIALABLE COPY</th>
				  <th style="color:black">TOTAL COPY</th>
				  <th style="color:black">BOOK IMAGE</th>
                  
                </tr>
                </thead>
                <tbody id="search_table">
                
                <tr>
                          
<?php 
include('../../con73/con37.php');
$id=$_GET['id'];

if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;

	$setLimit = 10;
	$pageLimit = ($page * $setLimit) - $setLimit;


$sql="select * from school_library_book where id='$id' LIMIT $pageLimit , $setLimit";
$serial_no=0;
$ex=mysqli_query($conn73,$sql);
while($row=mysqli_fetch_assoc($ex)){
    $book_id_no=$row['book_id_no'];
    $book_title=$row['book_title'];
    $book_catagory=$row['book_catagory'];
    $class=$row['class'];
    $publish_date=$row['publish_date'];
	$date1=explode("-",$publish_date);
	$date2=$date1[2]."-".$date1[1]."-".$date1[0];
    $publish_name=$row['publish_name'];
    $price=$row['price'];
    $no_of_copy=$row['no_of_copy'];
	$avaible_copy=$row['available_copy'];
    $image=$row['image'];
	$path="../image/";
	 
	 $serial_no++;
	?>

			  
			  
			  

				<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $book_catagory; ?></th>
			<th><?php echo $class; ?></th>
			<th><?php echo $date2; ?></th>
	        <th><?php echo $publish_name; ?></th>
		     <th><?php echo $price; ?></th>
			<th><?php echo $no_of_copy; ?></th>
			<th><?php echo $avaible_copy=$row['available_copy']; ?></th>
		<?php if($image==null){  ?>
	<th><img src="<?php echo '../image/blank.jpg'; ?>" height="50" width="50"></th>
	<?php }else{ ?>
	<th><img src="<?php echo $path."/".$image; ?>" height="50" width="50"></th> 
	<?php	 } ?> 
			
	   </tr>
				
			<?php } ?>
			
                </tr>

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
