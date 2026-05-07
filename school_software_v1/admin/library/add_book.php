<?php include("../attachment/session.php")?>
  
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


       <section class="content-header">
      <h1>
       Library Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="library.php"><i class="fa fa-book"></i> Library</a></li>
        <li class="active">Add Book</li>
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
                 <h3 class="box-title">Add Book</h3>
            </div>
            <!-- /.box-header -->	   
			   <div class="col-md-12">
			 <span class="input-group-btn">
                      <button class="btn btn-default" type="button" style="background-color:#537266;"><a href="library_add_book.php" style="color:#fff;">ADD NEW BOOK</a></button>
					  
                    </span>
			  </div>
            <div class="box-body table-responsive">
			
			   
		
             <table id="example1" class="table table-bordered table-striped">
                <thead >
               <tr>
				  <th style="color:black">S.No</th>
				  <th style="color:black">BOOK ID No.</th>
                  <th style="color:black">BOOK NAME</th>
				  <th style="color:black">SUBJECT</th>
                  <th style="color:black">CLASS</th>
                  <th style="color:black">PUBLISH DATE</th>
                <th style="color:black">PUBLISHER</th>
				  <th style="color:black">PRICE</th>
				  <th style="color:black">AVIALABLE COPY</th>
				  <th style="color:black">TOTAL COPY</th>
				  <th style="color:black">BOOK IMAGE</th>
                  <th style="color:black"><center>ACTION</center></th>
                </tr>
                </thead>
                  <tbody>
               
                  <?php 

$sql="select * from school_library_book";
$serial_no=0;
$ex=mysqli_query($conn73,$sql
while($row=mysqli_fetch_assoc($ex)){
     $id=$row['id'];
    $book_id_no=$row['book_id_no'];
    $book_title=$row['book_title'];
    $book_catagory=$row['book_catagory'];
    $class=$row['class'];
    $publish_date=$row['publish_date'];
    //$date1=explode("-",$publish_date);
	//$date2=$date1[2]."-".$date1[1]."-".$date1[0];
    $publish_name=$row['publish_name'];
    $price=$row['price'];
    $no_of_copy=$row['no_of_copy'];
    $avaible_copy=$row['available_copy'];
    $image=$row['image'];
	$path="image/";
	 $serial_no++;
	?>

			  
			  
			  

				<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $book_catagory; ?></th>
			<th><?php echo $class; ?></th>
			<th><?php echo $publish_date; ?></th>
	        <th><?php echo $publish_name; ?></th>
		     <th><?php echo $price; ?></th>
			<th><?php echo $no_of_copy; ?></th>
			<th><?php echo $avaible_copy; ?></th>
			<?php if($image==null){  ?>
	<th><img src="<?php echo 'image/blank.jpg'; ?>" height="50" width="50"></th>
	<?php }else{ ?>
	<th><img src="<?php echo $path."/".$image; ?>" height="50" width="50"></th> 
	<?php	 } ?> 
			
			
			<td><a href='library_edit_saved_book.php?id=<?php echo $book_id_no; ?>' style="color:black;"><input type="button" value="ADD BOOk" class="btn btn-primary" /></a>
			
			</td>
			
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
    