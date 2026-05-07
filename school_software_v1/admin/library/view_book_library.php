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
url: access_link+"library/delete_book.php?id="+id+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('library/view_book_library');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script> 
<script type="text/javascript">
   function search_class(value){
    //alert_new(value);
       $.ajax({
			  type: "POST",
              url: access_link+"library/library_search_class.php?id="+value+"",
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
              url: access_link+"library/library_search_subject.php?id="+value+"&id2="+subject+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail); 
            $('#search_table').html(detail);
              }
           });
    }
</script>
<script type="text/javascript">
   function for_section(value){

       $.ajax({
			  type: "POST",
              url: access_link+"library/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_exam();
				  for_list();
				  
              }
           });

    }
</script>
<script type="text/javascript">
   function for_book(value){
//alert_new(value);
       $.ajax({
			  type: "POST",
              url: access_link+"library/ajax_search_book.php?class="+value+"",
              cache: false,
              success: function($detail){
			 
                   var str =$detail;                
                  //alert_new(str);
                  $("#book_id_no").html(str);
				  for_exam();
				  for_list();
				  
              }
           });

    }
</script>

<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: access_link+"library/ajax_search_book_classwise.php?id="+value+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
	    $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
          
        
      
              }
           });

    }
	
function fill_bookdetail(ser){
var book_id=document.getElementById('book_id_'+ser).value;
if(book_id==''){
alert_new('This book is not available right now','red');
$("#book_title_"+ser).val(''); 
	$("#book_author_name_"+ser).val('');
	//$("#book_class_name").val('');
}else{
	$.ajax({
	address: "POST",
	url: access_link+"library/ajax_search_book_details.php?book_id="+book_id+"",
	cache: false,
	success: function(detail){
	var res = detail.split("|?|");
	$("#book_title_"+ser).val(res[0]); 
	$("#book_author_name_"+ser).val(res[1]);
	//$("#book_class_name").val(res[2]);
	fill_stddetail();
	}
	});
	}
}

function search_student_details(){
var roll_no=document.getElementById('student_details').value;
//alert_new(roll_no);
	$.ajax({
	address: "POST",
	url: access_link+"library/search_student_details.php?student_roll_no="+roll_no+"",
	cache: false,
	success: function(detail){
	////alert_new(detail);
	var res = detail.split("|?|");
	$("#student_class_and_section").val(res[1]); 
	$("#student_roll_no").val(res[2]); 
	$("#student_name").val(res[0]); 
	}
	});
}
</script> 

<script>
function validation(){
var book_id=document.getElementById('book_id').value;
if(book_id==''){
 return false
 
}else{
  return true

}
}
  $("#my_form").submit(function(e){
  e.preventDefault();

    var formdata = new FormData(this);
    $("#myModal_close").click();
  //window.scrollTo(0, 0);
   //loader();
        $.ajax({
            url: access_link+"library/view_book_library_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			$('#modal-default').modal('hide');
               var res=detail.split("|?|");
		   if(res[1]>0 && res[2]>0){
			    alert_new('Some Book Issue & Some Book can not Issue !!!','red');
			    get_content('library/view_book_library');
            }else{
                if(res[1]>0){
			    alert_new('Successfully Complete','green');
			    get_content('library/view_book_library');
			    }else{
			    alert_new('Sorry ! can not Issue Same Book to Same Student !!!','red');
			    get_content('library/view_book_library');
			    }
            }
			}
         });
      });
</script>
 
    <section class="content-header">
      <h1>
       Library Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> Library</a></li>
        <li class="active">View Book</li>
      </ol>
	 
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	
	
	<div class="modal fade" id="modal-default">
 
		<div class="modal-dialog">
		
		<div class="modal-content">
	
		<div class="modal-header">
			
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true">&times;</span></button>
	    <h4 class="modal-title">Issue Book</h4>
		</div>
		<form method="post" id="my_form" >
	    <div class="modal-body">
		
		
				<div class="col-md-12" style="height:200px;overflow:scroll;" >
		        <?php
				$qry="select * from school_library_book where school_library_book_status='Active'";
				$rest=mysqli_query($conn73,$qry);
				$book_ser=0;
				while($row22=mysqli_fetch_assoc($rest)){
				$book_title=$row22['book_title'];
				$subject_name=$row22['subject_name'];
				$author_name=$row22['author_name'];
				$class=$row22['class'];
				$no_of_copies=$row22['no_of_copy'];
				$book_id_no=$row22['book_id_no'];
				if($no_of_copies>0){?>
				<div class="col-md-12" >
				<input type="checkbox" name="issue_book_ser[]" onclick="fill_bookdetail('<?php echo $book_ser; ?>');" value="<?php echo $book_ser; ?>"><?php echo $subject_name."[".$book_id_no."][".$class."][".$author_name.']'; ?>
				<input type="hidden" name="book_id[]" id="<?php echo 'book_id_'.$book_ser; ?>" value="<?php echo $book_id_no; ?>">
				<input type="hidden" class="form-control" name="book_title[]" id="<?php echo 'book_title_'.$book_ser; ?>" value="" placeholder="Enter Name" readonly />
				<input type="hidden" name="book_author_name[]" id="<?php echo 'book_author_name_'.$book_ser; ?>" placeholder="Author Name" value="" class="form-control" readonly />
				<!-- <input type="hidden" name="" id="<?php //echo 'book_class_name_'.$book_ser; ?>" class="form-control" /> -->
				</div>
				<?php $book_ser++; } } ?>
				</div>
			<div class="col-md-12" >
			<div class="form-group" >
					  <label>Borrower's Name<font size="2" style="font-weight: normal;">
					  (Search by Name,Unique Id,Class,Section,Father Name,Father Contact Number) </font> <span style="color:red;">*</span></label>
					  <select name="" class="select2" onchange="search_student_details();" id="student_details" style="width:100%" required>
					  <option value="">Select student</option>
					        <?php
						
							$qry="select * from student_admission_info where student_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
			<input type="hidden" name="student_name" id="student_name" />
			<div class="col-md-6">
						<div class="form-group" >
					  <label>Borrower's Class & Section</label>
					  <input type="text"  name="student_class_and_section" placeholder="Student Class and section"  id="student_class_and_section" class="form-control" readonly />
					</div>
				</div>
				<div class="col-md-6">				
					 <div class="form-group" id="search-box" >
					  <label >Borrower's ID</label>
							<input type="text" autocomplete="off" class="form-control" name="student_roll_no" id="student_roll_no" onblur="for_name(this.value);" placeholder="student id" readonly />
							<div class="result"></div>
						</div>
				</div>
				
				<input type="hidden" class="form-control" name="status" value="Active" readonly />
				
			<div class="col-md-6" >			
            <div class="form-group" >
					  <label>Date Of Issue<font style="color:red"><b>*</b></font></label>
					  <input type="date" class="form-control" name="issue_date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter today's date" required >
					</div>
			</div>
			<div class="col-md-6" >		
						<div class="form-group">
						  <label>Due Date<font style="color:red"><b>*</b></font></label>
						  <input type="date" class="form-control" name="date_of_return" placeholder="Enter publisher name" required >
						</div>
			</div>
						 
					
		  </div>
		  <div class="modal-footer">
		  <button type="button" class="btn btn-default pull-left" id="myModal_close" data-dismiss="modal">Close</button>
		  <input type="submit" name="submit" value="save" class="btn btn-primary" onclick="return validation();">
		  </div>
		  </form>
		  </div>
		  <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		  </div>
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
			<div class="col-sm-12">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-4">
                 <center><h3 class="box-title" style="color:#592712;font-size:25px;"><b>View Books Details</b></h3></center></br>
		    </div>
			 <div class="col-sm-2">
			 <button type="button" name="finish" class="btn btn-primary" value=""  data-toggle="modal"  data-target="#modal-default" >Issue Book</button>
			 </div>
			</div>
            </div>
            <!-- /.box-header -->	   
			   
            <div class="box-body table-responsive">
			
			   
		
             <table id="example1" class="table table-bordered table-striped">
                <thead >
               <tr>
				  <th>S.No</th>
				  <th>Accession No./Book No.</th>
                  <th>Book Title</th>
				  <th>Subject</th>
                  <th>Class</th>
                  <th>Author</th>
                  <th>Vendor Name</th>
				  <th>Publication</th>
				  <th>No Of Copy</th>
				  <th>Cost</th>
				  <th>Publication Date</th>
                  <th><center>ACTION</center></th>
                </tr>
                </thead>
                  <tbody>
               
				<?php 
				$sql="select * from school_library_book where school_library_book_status='Active' and session_value='$session1' order by id DESC";
				$serial_no=0;
				$ex=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($ex)){
				$id=$row['id'];
				$book_id_no=$row['book_id_no'];
				$book_title=$row['book_title'];
				$book_category=$row['book_category'];
				$class=$row['class'];
				$author_name=$row['author_name'];
				$vendor_name=$row['vendor_name'];
				$publish_date=$row['publish_date'];
				$publish_name=$row['publish_name'];
				$cost=$row['price'];
				$no_of_copy=$row['no_of_copy'];
				$subject_name=$row['subject_name'];
				$serial_no++;
				?>
			<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $subject_name; ?></th>
			<th><?php echo $class; ?></th>
			<th><?php echo $author_name; ?></th>
	        <th><?php echo $vendor_name; ?></th>
		    <th><?php echo $publish_name; ?></th>
			<th><?php echo $no_of_copy; ?></th>
			<th><?php echo $cost; ?></th>
			<th><?php echo $publish_date; ?></th>
			
		
		<th>
		<button type="button" <?php if($no_of_copy<=0){ echo "disabled"; } ?> class="btn btn-info" onclick="post_content('library/issue_book','<?php echo 'id='.$book_id_no; ?>');" >Issue</button>
		<button type="button" class="btn btn-success" onclick="post_content('library/edit_book','<?php echo 'id='.$book_id_no; ?>');" ><?php echo $language['Edit']; ?></button>
		<button type="button" class="btn btn-danger" onclick="return valid('<?php echo $id; ?>');" ><?php echo $language['Delete']; ?></button>
		</th>
		
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>