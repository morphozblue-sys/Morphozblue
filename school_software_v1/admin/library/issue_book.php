<?php include("../attachment/session.php"); ?>
<style type="text/css">
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 80%;
        left: 0;
		background:white;
    }
    .search-box input[type="text"], .result{
        width: 90%;
		margin-left:5%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"library/issue_book_api.php",
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
				  get_content('library/view_issued_book_list');
            }
			}
         });
      });
</script>
<script type="text/javascript">
   function for_name(value){
   //alert_new('hit');
       $.ajax({
			  type: "POST",
              url: access_link+"library/ajax_get_name.php?roll="+value+"",
              cache: false,
              success: function(detail){
			  ////alert_new(detail); 
            $('#student_name').val(detail);
              }
           });
    }
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
		var classs=document.getElementById('class_no').value;
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal,term2: classs}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents("#search-box").find('input[type="text"]').val($(this).text());
        $(this).parents("#search-box").find('input[type="text"]').focus();
        $(this).parent(".result").empty();
    });
});
</script>
<script type="text/javascript">
   function fill_detail(value){
    var book_id=document.getElementById('book_id_number').value;
			$.ajax({
			  address: "POST",
              url: access_link+"library/ajax_search_student_box.php?id="+value+"&book_id="+book_id+"",
              cache: false,
              success: function(detail){
			  if(detail!=0){
		  var res = detail.split("|?|");
	      $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);
          }else{
		  alert_new('Sorry ! can not Issue Same Book to Same Student !!!','red');
		  $("#student_roll_no111").val('');
		  }
        
      
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
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> Library</a></li>
	  <li class="active">Issue Book List</li>
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
              <center><h3 class="box-title" style="color:#592712;font-size:25px;"><b>Issue Book</b></h3></center></br>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label>Borrower's Name<font size="2" style="font-weight: normal;">
					  (Search by Name,Unique Id,Class,Section,Father Name,Father Contact Number) </font> <span style="color:red;">*</span></label>
					  <select name="" class="form-control select2" id="student_roll_no111" onchange="fill_detail(this.value);" required>
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
			</div>
			
			<input type="hidden" name="student_name" id="student_name" />
			
         	<div class="col-md-3 ">
						<div class="form-group" >
					  <label>Borrower's Class & Section</label>
					  <input type="text"  name="student_class" placeholder="Student Class"  id="student_class" class="form-control" readonly />
					</div>
				</div>
				<div class="col-md-3 ">				
					 <div class="form-group" id="search-box" >
					  <label >Borrower's ID</label>
							<input type="text" autocomplete="off" class="form-control" name="student_roll_no" id="student_roll_no" onblur="for_name(this.value);" placeholder="student id" readonly />
							<div class="result"></div>
						</div>
				</div>
				
				<?php
				  $id=$_GET['id'];
				  $qry2="select * from school_library_book where book_id_no='$id'";
				  $result=mysqli_query($conn73,$qry2);
				  while($row=mysqli_fetch_assoc($result)){
				  $book_title=$row["book_title"];
				  $author_name=$row["author_name"];
				  $no_of_copy=$row["no_of_copy"];
				  $copy_left=$no_of_copy-1;
				  
				  
				  }?>			
				
				<div class="col-md-3 ">				
					 <div class="form-group" >
					  <label >Book Title</label>
						<input type="hidden" class="form-control" name="copy_left" value="<?php echo $copy_left; ?>">
							<input type="text" class="form-control" name="book_title"  value="<?php echo $book_title; ?>" placeholder="Enter Name" readonly /> 
						</div>
				</div>
				<input type="hidden" class="form-control" name="book_id_number" id="book_id_number"  value="<?php echo $id; ?>" placeholder="" readonly /> 

			     <div class="col-md-3 ">						 
					 <div class="form-group" >
					  <label >Author Name</label>
					  <input type="text"  name="author_name" placeholder="Add Student Roll No"  value="<?php echo $author_name; ?>" class="form-control"  readonly />
					</div>
				  </div>
				  
				  	<div class="col-md-3 ">				
					<div class="form-group" >
					  <label >Date Of Issue<font style="color:red"><b>*</b></font></label>
					  <input type="date" class="form-control" name="issue_date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter today's date" required >
					</div>
				</div>
			
				<div class="col-md-3 ">				
					 <div class="form-group" >
					  <label >Due Date<font style="color:red"><b>*</b></font></label>
					 <input type="date" class="form-control" name="date_of_return" placeholder="Enter publisher name" required >
					</div>
				 </div>
				
				<div class="col-md-3">				
					<div class="form-group" style="display:none" >
					  <label style="color:black;">Status</label>
					  <input type="text" class="form-control" name="status" value="Active" readonly />
					</div>
				</div>
				<div class="col-md-12">
				<div class="form-group">
				<center><input type="submit" name="finish" value="Submit" class="btn btn-success"/></center>
				</div>
				</div>
		</form>	
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>