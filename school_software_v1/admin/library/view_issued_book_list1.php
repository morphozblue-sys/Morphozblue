<?php include("../attachment/session.php"); ?>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    $("#myModal_close").click();
  //window.scrollTo(0, 0);
   //loader();
        $.ajax({
            url: access_link+"library/view_issued_book_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
			$('#modal-default').modal('hide');
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Complete','green');
				  get_content('library/view_issued_book_list');
            }
			}
         });
      });
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
		<form method="post"  enctype="multipart/form-data"  id="my_form" >
	    <div class="modal-body">
		
		
			 <div class="form-group">
						  <label>Student Roll no<font style="color:red"><b>*</b></font></label>
						   <input type="text" class="form-control" name="student_roll_no" id="student_roll_no"  readonly />
						</div>
						<div class="form-group">
						  <label>BOOK_ID_No.</label>
						   <input type="text" name="book_id_no" id="book_id_no" class="form-control" readonly />
						</div>
        <div class="form-group">
					  <label>ISSUED DATE </label>
					  <input type="date" class="form-control" name="date_of_return1" id="issued_date" value=
					 "">
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
		  <button type="button" class="btn btn-default pull-left" id="myModal_close" data-dismiss="modal">Close</button>
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
              <center><h3 class="box-title" style="color:#592712;font-size:25px;"><b>Issue Book List</b></h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No</th>
				  <th>Accession No./Book No.</th>
				  <th>Borrower Name</th>
				  <th>Borrower Class & Section</th>
				  <th>Book TItle</th>
				  <th>Author </th>
                  <th>Date of Issue</th>
                  <th>Due Date</th>
                  <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody id="search_table">
                
               <?php 
$sql="select * from issue_book where status='Active' and session_value='$session1'";
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
 $serial_no++;
   
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
// 		if($date3[2]<=$date1[2] && $date3[1]<=$date1[1] && $date3[0]<=$date1[0]){
// 			 echo '<span style="color:#700134;text-decoartion: blink">Pending</span>';
// 		}else{
// 		echo '<span style="color:green;text-decoartion: blink">check status</span>'; }
		?>-->
			<input type="hidden" value="<?php echo $book_id_no; ?>" id="<?php echo "student_book_".$student_roll_no; ?>">
			<input type="hidden" value="<?php echo $issue_date; ?>" id="<?php echo "student_date_".$student_roll_no; ?>">
			<td><button type="button" name="finish" class="btn btn-default" value="<?php echo $student_roll_no; ?>" onclick="open_model(this.value)" data-toggle="modal" data-target="#modal-default" id="student_roll_no" >Return
			 
			  
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

  <script>
	function open_model(roll_no){
	var book_id=document.getElementById("student_book_"+roll_no).value;
	var date=document.getElementById("student_date_"+roll_no).value;
	document.getElementById("student_roll_no").value=roll_no;
	document.getElementById("book_id_no").value=book_id;
	document.getElementById("issued_date").value=date;
	
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

