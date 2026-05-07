<?php include("../attachment/session.php"); ?>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
 window.scrollTo(0, 0);
  loader();
        $.ajax({
            url: access_link+"library/edit_book_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('library/view_book_library');
            }
			}
         });
      });
</script>
<script type="text/javascript">
         	function for_subject(value){
			$.ajax({
			address: "POST",
			url: "ajax_get_subject.php?value="+value+"",
			cache: false,
			success: function(detail){
			 $("#subject_name").html(detail);
			 for_list();
			}
			});
			}
</script>
<script type="text/javascript">
   function for_section(value){
         
       $.ajax({
			  type: "POST",
              url: "ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				  for_list();
              }
           });

    }
</script>


   <section class="content-header">
      <h1>
       Library  Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> Library</a></li>
		<li><a href="javascript:get_content('library/view_book_library')"><i class="fa fa-book"></i> Book List</a></li>
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
             <center><h3 class="box-title" style="color:#f4427d;font-size:30px;"><b>Update Library Book</b></h3></center></br></br></br>
            </div>
			 <?php 
			 
			   $id=$_GET['id'];
			  
			  $sql="select * from school_library_book where book_id_no='$id'";
			  $ex=mysqli_query($conn73,$sql);
			  while($row= mysqli_fetch_assoc($ex)){
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
    
    $book_code_number=$row['book_code_number'];
    $entry_date=$row['entry_date'];
    $division_name=$row['division_name'];
    $language=$row['language'];
    $book_type=$row['book_type'];
    $other_information=$row['other_information'];
					 }
			  ?>
			  
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form"  method="post"  id="my_form" enctype="multipart/form-data">
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Accession NO./Book No.<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="book_id_no"   placeholder="Enter Book Accession No."  value="<?php echo $book_id_no; ?>" class="form-control " readonly />
						</div>
				</div>
				
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Book Code No.</label>
						   <input type="text" name="book_code_number" value="<?php echo $book_code_number; ?>" class="form-control" />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Division Name</label>
						   <input type="text" name="division_name" value="<?php echo $division_name; ?>" class="form-control" />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Language</label>
						   <input type="text" name="language" value="<?php echo $language; ?>" class="form-control" />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Book Type</label>
						   <input type="text" name="book_type" value="<?php echo $book_type; ?>" class="form-control" />
						</div>
				</div>
				
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Book Title<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="book_title"  placeholder="Enter book title"  value="<?php echo $book_title; ?>" class="form-control" required />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Author<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="author"  placeholder="Enter Author name"  value="<?php echo $author_name; ?>" class="form-control" required />
						</div>
				</div>
							
				<div class="col-md-4 ">	
					<div class="form-group" >
					    <label>Classification No./Main Class<font style="color:red"><b>*</b></font></label>
					    <select name="student_class" onchange="for_section(this.value);for_search11();" id="student_class" class="form-control" >
						       <option  value="">Select Class</option>
						       <?php 
							   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option <?php if($class==$class_name){ echo 'selected'; } ?> value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-4 ">				
			    <div class="form-group" >
				 <label >Subject</label>
				 <input type="text" name="subject" class="form-control" placeholder="Enter subject Name" value="<?php echo $subject_name; ?>">
				 </div>
				 </div>
				
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Publisher</label>
					  <input type="text" class="form-control" name="publish_name" placeholder="Enter publication" value="<?php echo $publish_name; ?>">
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Publication Date</label>
					  <input type="date" class="form-control" name="publish_date" value="<?php echo $publish_date; ?>">
					</div>
				</div>	
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >No. Of Copies</label>
					  <input type="Number" class="form-control" name="no_of_copy" placeholder="Enter No of Book" value="<?php echo $no_of_copy; ?>">
					</div>
				</div>	
				
				<div class="col-md-4 ">				
					<div class="form-group" >
					  <label >Vendor</label>
					  <input type="text" class="form-control" name="Vendor_name" placeholder="Enter Vendor Name" value="<?php echo $vendor_name; ?>">
					</div>
				</div>	
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label >Cost of Book<font style="color:red"><b>*</b></font></label>
					  <input type="Number" class="form-control" name="book_cost" placeholder="Enter book cost" value="<?php echo $cost; ?>" required>
					</div>
				 </div>
				
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Entry Date</label>
						   <input type="date" name="entry_date" value="<?php echo $entry_date; ?>" class="form-control" />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Other Information</label>
						   <input type="text" name="other_information" value="<?php echo $other_information; ?>" class="form-control" />
						</div>
				</div>
				
				<div class="col-md-12">
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
				</div>
		        </form>	
		        
		 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
