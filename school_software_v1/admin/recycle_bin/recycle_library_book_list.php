<?php include("../attachment/session.php")?>
<script>
function valid1(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_book_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_book_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
restore_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function restore_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_book_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_book_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
			


</script>

</script>
  <script type="text/javascript">
   function search_class(value){
    //alert_new(value);
       $.ajax({
			  type: "POST",
              url: access_link+"recycle_bin/library_search_class.php?id="+value+"",
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
              url: access_link+"recycle_bin/library_search_subject.php?id="+value+"&id2="+subject+"",
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
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
     	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fal fa-trash-alt"></i> Recycle Bin</a></li>
        <li class="active">Library Recycle Bin</li>
      </ol>
    </section>


	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
                 <h3 class="box-title">View Book</h3>
            </div>
            <!-- /.box-header -->	   
			   
            <div class="box-body table-responsive">
			
			   
		
             <table id="example1" class="table table-bordered table-striped">
                <thead >
               <tr>
				  <th>S.No</th>
				  <th>BOOK ID No.</th>
                  <th>BOOK NAME</th>
				  <th>SUBJECT</th>
                  <th>CLASS</th>
                  <th>PUBLISH DATE</th>
                  <th>PUBLISHER</th>
				  <th>PRICE</th>
				  <th>AVIALABLE COPY</th>
				  <th>TOTAL COPY</th>
				  <th>BOOK IMAGE</th>
                  <th>Restore</th>
				  <th>Delete</th>
                </tr>
                </thead>
                  <tbody>
               
                  <?php 
include('../../con73/con37.php');


$sql="select * from school_library_book where school_library_book_status='Deleted'";
$serial_no=0;
$ex=mysqli_query($conn73,$sql);
while($row=mysqli_fetch_assoc($ex)){
     $id=$row['id'];
    $book_id_no=$row['book_id_no'];
    $book_title=$row['book_title'];
    $book_category=$row['book_category'];
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
	        <th><?php echo $book_category; ?></th>
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
			
			<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
	<td><button type="button"  class="btn btn-danger" onclick="return valid1('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
	
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
   