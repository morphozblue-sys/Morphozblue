<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
         	function for_subject(value){
			$.ajax({
			address: "POST",
			url: access_link+"library/ajax_get_subject.php?value="+value+"",
			cache: false,
			success: function(detail){
			 $("#subject_name").html(detail);
			 for_list();
			}
			});
			}
</script>
<script type="text/javascript">
         	function for_subject_exam_stuff(value){
			$.ajax({
			address: "POST",
			url: access_link+"library/ajax_get_subject_exam_stuff.php?value="+value+"",
			cache: false,
			success: function(detail){
			 $("#subject_name_exam_stuff").html(detail);
			 for_list();
			}
			
			});
			}
</script>
<script type="text/javascript">
         	function for_document_exam_stuff(){
			var value1=document.getElementById('student_class1').value;
			var value=document.getElementById('subject_name_exam_stuff').value;
			$.ajax({
			address: "POST",
			url: access_link+"library/ajax_get_document_name.php?value="+value+"&value1="+value1+"",
			cache: false,
			success: function(detail){
			 $("#document_name_exam_stuff").html(detail);
			 for_list();
			}
			
			});
			}
			
			function for_document(){
			var value=document.getElementById('subject_name_exam_stuff').value;
			var value1=document.getElementById('student_class1').value;
			var value2=document.getElementById('document_name_exam_stuff').value;
			if(value!='' && value1!='' && value2!=''){
			$('#my_button').show("");
			}else{
			$('#my_button').hide("");
			}
			}
	
	function for_detail(){
        var value=document.getElementById('subject_name_exam_stuff').value;
        var value1=document.getElementById('student_class1').value;
        var value2=document.getElementById('document_name_exam_stuff').value;
        if(value!='' && value1!='' && value2!=''){
        post_content("library/exam_stuff_detail","class="+value1+"&subject="+value+"&document="+value2);
        }else{
        alert_new("Please Select All Field !!!");
        }
	}
			
	$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"library/exam_stuff_add_api.php",
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
				  get_content('library/exam_stuff_add');
            }
			}
         });
      });
	
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
        <li class="active">Exam Stuff</li>
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
              <h3 class="box-title">Exam Stuff</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body table-responsive">
			<form id="my_form" role="form" method="post" enctype="multipart/form-data">
							
				<div class="col-md-4 ">	
				<div class="col-md-12 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="exam_stuff_class" onchange="for_subject(this.value);" id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						       <?php 
							   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-12 ">				
			       <div class="form-group" >
				    <label ><?php echo $language['Subject Name']; ?></label>
				     <select class="form-control" name="exam_stuff_subject" id="subject_name" required>
				      <option value="">Select Subject</option>
				     </select>
				   </div>
				</div>
				
			  <div class="col-md-12 ">		
				<div class="form-group">
				  <label>Ducument Name</label>
				  <input type="text" name="exam_stuff_document_name" placeholder="Ducument Name"  value="" class="form-control" required>
				</div>
			  </div>
				 
				<div class="col-md-12 ">				
					 <div class="form-group" >
					  <label>Date</label>
						<input type="date" class="form-control" name="exam_stuff_date" placeholder="<?php echo $language['Publish Date']; ?>" required/> 
					 </div>
				</div>
			          <div class="col-md-9">	
					<div class="form-group">
					  <label>Upload Documents</label>
					  <input type="file" id="upload_file" name="upload_file" placeholder="" onchange="check_file_type(this,'upload_file','show_upload_file','all');" class="form-control" accept=".gif, .jpg, .jpeg, .png, .pdf, .doc" value="" required >
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
					   <img id="show_upload_file" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				</div>
			  
				
				
				<div class="col-md-12">
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				</div>
				</div>
				
				
				<div class="col-md-8 ">
                <center><h3 class="box-title" style="color:red;">Exam Stuff List</h3></center>				
				<table  id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
		        <th><?php echo $language['Class']; ?></th>
                <th><?php echo $language['Subject']; ?></th>
                <th>Document Name</th>
		        <th><?php echo $language['Details']; ?></th>
                </tr>
                </thead>

    <tr  align='center' >
    <th>
	    <select class="form-control" id="student_class1" onchange="for_subject_exam_stuff(this.value);for_document();" >
		  <option value="">Select Class</option>
		    <?php
            $select="select * from library_exam_stuff Group By exam_stuff_class";
            $run=mysqli_query($conn73,$select);
            while($row=mysqli_fetch_assoc($run)){
          
            $s_no=$row['s_no'];
	        $exam_stuff_class = $row['exam_stuff_class'];
            ?>
			<option value="<?php echo $exam_stuff_class; ?>" ><?php echo $exam_stuff_class; ?></option>
		    <?php } ?>
		</select>
    </th>
	<th>
	    <select class="form-control" onchange="for_document_exam_stuff();for_document();" id="subject_name_exam_stuff" >
		  <option value="" >Select Subject</option>
		</select>
    </th>
	<th>
	    <select class="form-control" id="document_name_exam_stuff" onchange="for_document();" >
		  <option value="" >Select Document</option>
		</select>
    </th>
	<th><button type="button" class="btn btn-default" id="my_button" onclick="for_detail();" >Details</button></th>
	
	</tr>
	
	       </table>
				 </div>
				</form>	
		        </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
                 </div>
                </div>
                 <div id="mypdf_view">
			<div>
           </section>
<script>
for_document();
</script>