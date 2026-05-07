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
        <li class="active">Edit Book</li>
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
              <div class="box-header with-border ">
              <h3 class="box-title" style="serif;color:#230226;">Edit</h3>
            </div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<?php 
			  include("../../con73/con37.php");
			  $id=$_GET['id'];
			  
			  $sql="select * from school_library_book where book_id_no='$id'";
			  $ex=mysqli_query($conn73,$sql);
			  while($row= mysqli_fetch_assoc($ex)){
			         $id=$row['id'];
			         $book_id_no=$row['book_id_no'];
					 $book_title=$row['book_title'];
					 $book_category=$row['book_catagory'];
					 $class=$row['class'];
					 $publish_date=$row['publish_date'];
			         $publish_name=$row['publish_name'];
					 $price=$row['price'];
					 $no_of_copy=$row['no_of_copy'];
					 $avaible_copy=$row['available_copy'];
					 $image=$row['image'];
	                 $path="image/";
					 
					 }
			  ?>
			<form role="form" method="post" enctype="multipart/form-data">
			
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>BOOK ID NO<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="book_id_no"   placeholder="Enter book id"  value="<?php echo $book_id_no; ?>" class="form-control " readonly>
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>BOOK NAME</label>
						   <input type="text"  name="book_title"  placeholder="Enter book name"  value="<?php echo $book_title; ?>" class="form-control" readonly>
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>SUBJECT</label>
						   <input type="text"  name="book_catagory"  placeholder="Enter book name"  value="<?php echo $book_category; ?>" class="form-control" readonly>
						</div>
							</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>CLASS</label>
						   <input type="text"  name="class_no"  placeholder="Enter book name"  value="<?php echo $class; ?>" class="form-control" readonly>
						</div>
							</div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label >PUBLISH DATE</label><br>
						
							<input type="text" class="form-control" name="date" value="<?php echo $publish_date; ?> "readonly> 
						</div>
				</div>
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >PUBLICATION</label>
					  <input type="text" class="form-control" name="publish_name" placeholder="Enter publisher name" value="<?php echo $publish_name; ?>" readonly>
					</div>
				</div>	
			
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >NO OF COPY</label>
					  <input type="text" class="form-control" name="no_of_copy" value="" required  />
					</div>
				</div>
				<div class="col-md-4 " style="display:none;">				
					<div class="form-group" >
					  <label >TOTAL COPY</label>
					  <input type="text" class="form-control" name="avaible_copy" placeholder="Enter no of copy">
					</div>
				</div>	
				<div class="col-md-4 " >				
					<div class="form-group" >
					  <label >Price</label>
					  <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" placeholder="Enter no of copy">
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >BOOK IMAGE</label>
					  <input type="file" class="form-control" name="image" readonly />
				<?php if($image==null){  ?>
				<img src="<?php echo 'image/blank.jpg'; ?>" height="50" width="50" readonly />
				<?php }else{ ?>
				<img src="<?php echo $path."/".$image; ?>" height="50" width="50" readonly />
				<?php	 } ?>
					</div>
				</div>
				<div class="col-md-4 " style="display:none;">				
					<marquee style="font:italic bold 30px/30px Georgia, serif;color:#000000;"><h4><b>A LIBRARY IS NOT A LUXURY ITS A NECESSITY</b></h4></marquee>
				</div>
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				
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
include("../con73/con37.php");
if(isset($_POST['finish'])){

$book_id_no=$_POST['book_id_no'];
$book_title=$_POST['book_title'];
$book_category=$_POST['book_catagory'];
$class=$_POST['class_no'];
$publish_date=$_POST['date'];
$publish_name=$_POST['publish_name'];
$price=$_POST['price'];
$no_of_copy1=$_POST['no_of_copy'];
$avaible_copy=$_POST['avaible_copy'];

$image1=$_FILES['image']['name'];            
  $image_temp=$_FILES['image']['tmp_name'];
  if($image1==null){
   $image1=$image;
   }
   else{
	move_uploaded_file($image_temp,$path."/$image1");
	}
	$no_ofcopy2=$no_of_copy+$no_of_copy1;

$query="update school_library_book set book_id_no='$book_id_no',book_title='$book_title',book_catagory='$book_category',class='$class',publish_date='$publish_date',publish_name='$publish_name',price='$price',no_of_copy='$no_ofcopy2',available_copy='$no_ofcopy2',image='$image1',$update_by_update_sql  where id='$id'";


if(mysqli_query($conn73,$query))
{
 echo "<script>window.open('add_book.php','_self')</script>";
}
}
?>