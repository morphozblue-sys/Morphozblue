<?php include("../attachment/session.php")?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_employee(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_employee(s_no){
$.ajax({
type: "POST",
url: access_link+"library/delete_return_book.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('library/view_return_book_list');
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
       Library Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> Library</a></li>
        <li class="active">View Return Book List</li>
      </ol>
	 
    </section>
	

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
		   <div class="box-header with-border ">
              <center><h3 class="box-title" style="color:#592712;font-size:25px;"><b>Return Book Detail</b></h3></center></br>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No</th>
				  <th>Borrower's Name</th>
				  <th>Borrower's Id</th>
				  <th>Borrower's Class & section</th>
				  <th>Book Title</th>
				  <th>Author</th>
                  <th>Issued Date</th>
                  <th>Due Date</th>
                  <th>Return Date</th>
                  <th>No. of over due day</th>
                  <th>over due fine</th>
                  <th>Remark</th>
                  <th>Action</th>
                  
                  
                </tr>
                </thead>
                <tbody id="search_table">
                
               <?php 
$sql="select * from issue_book where status='Deactive' and session_value='$session1'";
$serial_no=0;
$ex=mysqli_query($conn73,$sql);
while($row=mysqli_fetch_assoc($ex)){
     $id=$row['id'];
    $book_id_no=$row['book_id_no'];
    //$book_title=$row['book_title'];
    $student_roll_no=$row['student_roll_no'];
    $issue_date=$row['issue_date'];
    $author_name=$row['author_name'];
    $book_title=$row['book_title'];
     $due_date=$row['due_date']; 
     $return_date=$row['return_date']; 
	 $date1=date_create($due_date);
	 $date2=date_create($return_date);
	 $date_difference=date_diff($date1,$date2); 
	 $diff= $date_difference->format("%R%a days");
    $extra_days=$diff; 
    $status=$row['status'];
	$serial_no++;
	$current_date=date('y-m-d');
    $date3=explode("-",$current_date);
    $date4=$date3[2]."-".$date3[1]."_".$date3[0];
    $date3[2];
	//$date_1=$row['return_date1'];
	$penalty=$row['penalty'];
	$student_name=$row['student_name'];
	 $class=$row['class'];
	 $remark=$row['remark'];
    
	?>
			<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $student_name; ?></th>
	        <th><?php echo $student_roll_no; ?></th>
	        <th><?php echo $class; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $author_name; ?></th>
	        <th><?php echo $issue_date; ?></th>
			<th><?php echo $due_date; ?></th>
			<th><?php echo $return_date; ?></th>
			<th><?php echo $extra_days; ?></th>
			<th><?php echo $penalty; ?></th>
			<th><?php echo $remark; ?></th>
			<th>
			<button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $id; ?>');" ><?php echo $language['Delete']; ?></button>  </th>  
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