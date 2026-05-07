<?php include("../attachment/session.php"); ?>
<script>
function valid(id){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(id);       
 }            
else  {      
return false;
 }
}
  
function for_delete(id){
$.ajax({
type: "POST",
url: access_link+"library/exam_stuff_delete.php?id="+id+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('library/exam_stuff_add');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>
    <!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
       <?php echo $language['Library Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> <?php echo $language['Library']; ?></a></li>
        <li class="active">Exam Stuff Detail</li>
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
              <h3 class="box-title">Exam Stuff List</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body table-responsive">
				<table  id="example1" class="table table-bordered table-striped ">
                <thead >
                <tr>
	            <th><?php echo $language['S No']; ?></th>
		        <th><?php echo $language['Class']; ?></th>
                <th><?php echo $language['Subject']; ?></th>
				<th>Document Name</th>
                <th><?php echo $language['Date']; ?></th>
                <th>Image</th>
		        <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
		<?php
$class=$_GET['class'];
$subject=$_GET['subject'];
$document=$_GET['document']; 
$serial_no=0;
$select="select * from library_exam_stuff where exam_stuff_class='$class' and exam_stuff_subject='$subject' and exam_stuff_document_name='$document'";
$run=mysqli_query($conn73,$select);
while($row=mysqli_fetch_assoc($run))
 {
    $s_no=$row['s_no'];
	$exam_stuff_class = $row['exam_stuff_class'];
	$exam_stuff_subject = $row['exam_stuff_subject'];
	$exam_stuff_document_name = $row['exam_stuff_document_name'];
	$exam_stuff_date = $row['exam_stuff_date'];
	$serial_no++;
	
    $stuff_image=$row['stuff_image_name'];
    
 
    ?>
    <tr align='center' >

	<th><?php echo $serial_no; ?></th>
	<th><?php echo $exam_stuff_class; ?></th>
	<th><?php echo $exam_stuff_subject; ?></th>
	<th><?php echo $exam_stuff_document_name; ?></th>
	<th><?php echo $exam_stuff_date; ?></th>
	<th><a href="<?php if($stuff_image!=''){ echo $_SESSION['amazon_file_path']."library_exam_stuff_document/".$stuff_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" ><button type="button" class="btn btn-default" <?php if($stuff_image==''){ echo 'disabled'; } ?> >Download</button></a></th>
	<th><button type="button" class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></th>
	
	</tr>
	
	<?php } ?>	

</table>
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
                 </div>
                </div>
                 <div id="mypdf_view">
			<div>
           </section>

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
