<?php include("../attachment/session.php")?>

<script>


function for_subject(value){
if(value!=''){
	   $('#question_subject').html("<option value='' >Loading....</option>");
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_subject.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		 $("#question_subject").html(detail);
		 for_question();
		 for_question1();
		 for_list();
	  }
   });
}else{
$("#question_subject").html("<option value=''>Select</option>");
}
}

function create_unique_id(){
var paper_type_1=document.getElementById("paper_type").value;
if(paper_type_1=='new'){
var class_1=document.getElementById("question_class").value;
var subject_1=document.getElementById("question_subject").value;
var exam_type_1=document.getElementById("question_exam_type").value;
var date_1=document.getElementById("current_date").value;
var language=document.getElementById("question_exam_language").value;
var uni_id=class_1+"_"+subject_1+"_"+exam_type_1+"_"+date_1+"_"+language;
document.getElementById("paper_unique_id1").value=uni_id;
$('#paper_unique_id').hide();
$('#paper_unique_id1').show();
$('#question_class').show();
$('#question_class').prop('required',true);
$('#question_class1').hide();
$('#question_subject').show();
$('#question_subject').prop('required',true);
$('#question_subject1').hide();
$('#question_exam_type').show();
$('#question_exam_type').prop('required',true);
$('#question_exam_type1').hide();
$('#question_exam_language').show();
$('#question_exam_language').prop('required',true);
$('#question_exam_language1').hide();
}else{
$('#paper_unique_id').show();
$('#paper_unique_id1').hide();
$('#question_class1').show();
$('#question_class').hide();
$('#question_class').prop('required',false);
$('#question_subject1').show();
$('#question_subject').hide();
$('#question_subject').prop('required',false);
$('#question_exam_type1').show();
$('#question_exam_type').hide();
$('#question_exam_type').prop('required',false);
$('#question_exam_language1').show();
$('#question_exam_language').hide();
$('#question_exam_language').prop('required',false);
}
}

function for_details(value){
if(value!=''){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_details.php?value="+value+"",
	  cache: false,
	  success: function(detail){
		 var str=detail;
		 var res=str.split('|?|');
		 $('#question_class1').val(res[2]);
		 $('#question_subject1').val(res[3]);
		 $('#question_exam_type1').val(res[1]);
		 $('#question_exam_language1').val(res[4]);
	  }
   });
}else{
$('#question_class1').val('');
$('#question_subject1').val('');
$('#question_exam_type1').val('');
$('#question_exam_language1').val('');
}
}

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"exam_paper_setter/instant_go_to_paper_setter_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','red');
				   post_content('exam_paper_setter/instant_set_paper',res[2]);
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
       <?php echo $language['Paper Setter']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-dashboard"></i> <?php echo $language['Paper Setter']; ?></a></li>
	 <li class="active"><?php echo $language['Set Paper']; ?></li>
      </ol>
    </section>
<form method="post" enctype="multipart/form-data" id='my_form'>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		   <div class="box-body">
			
			<div class="col-md-12">

                <div class="col-md-2">	
				</div>
		
				<div class="col-md-4">				
					 <div class="form-group" >
					    <label><?php echo $language['Old New']; ?></label>
					    <select name="paper_type" id="paper_type" class="form-control" onchange="create_unique_id();" required>
						    <option value="old">Old</option>
						    <option value="new">New</option>
					    </select>
					</div>
				</div>
				 
				 <div class="col-md-4">				
					<div class="form-group" id="text_select" >
						<label ><?php echo $language['Unique Id']; ?></label>
						<input type="text" name='paper_unique_id1' id="paper_unique_id1" class='form-control' style="display:none;" readonly />
						<input type="hidden" id="current_date" value="<?php echo date('d_m_Y'); ?>" />
						<select name='paper_unique_id' class='form-control' id='paper_unique_id' onchange="for_details(this.value);" >
						<option value=''>Select</option>
						<?php
						include("../../con73/con37.php");
						$que="select * from question_paper_set GROUP BY paper_unique_id";
						$run=mysqli_query($conn73,$que);
						if(mysqli_num_rows($run)>0){
						while($row=mysqli_fetch_assoc($run)){

							$paper_unique_id=$row['paper_unique_id'];

						?>
						<option value="<?php echo $paper_unique_id; ?>"><?php echo $paper_unique_id; ?></option>
						<?php
						}
						}
						?>
						</select>
					</div>
				 </div>				 
				 
			 </div>
			
			<div class="col-md-12">

                <div class="col-md-2">	
				</div>
		
				<div class="col-md-4">				
					 <div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
						<input type="text" name="question_class1" id="question_class1" class='form-control' readonly />
					    <select name="question_class" style="display:none;" id="question_class" class="form-control" onchange="for_subject(this.value);create_unique_id();" >
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
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label ><?php echo $language['Subject']; ?></label>
					  <input type="text" name="question_subject1" id="question_subject1" class='form-control' readonly />
					  <select name="question_subject" style="display:none;" class="form-control" id="question_subject" onchange="create_unique_id();">
					  <option value="">Select Subject</option>
					  </select>
					</div>
				 </div>				 
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-2">	
				</div>
				
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label ><?php echo $language['Exam Type']; ?></label>
					  <input type="text" name="question_exam_type1" id="question_exam_type1" class='form-control' readonly />
					  <input type="text" name="question_exam_type" style="display:none;" id="question_exam_type" class='form-control' oninput="create_unique_id()";  />
					</div>
				</div>
				
				 <div class="col-md-4">				
					<div class="form-group" >
					  <label ><?php echo $language['Language']; ?></label>
					  <input type="text" name="question_exam_language1" id="question_exam_language1" class='form-control' readonly />
					  <select name="question_exam_language" style="display:none;" id="question_exam_language" class="form-control" onchange="create_unique_id();">
					  <option value="Hindi">Hindi</option>
					  <option value="English">English</option>
					  </select>
					</div>
				 </div>
				 
				 
			 </div>
			 <br/>
			 <div class="col-md-12">			 
					 <center><button type="submit" name="submit" class="btn btn-success"><?php echo $language['Submit']; ?></button></center>
			 </div>
			 <div class="col-md-12">			 
					&nbsp;
			 </div>
			 
			 
			 
			
			 
			
			 
			
			 
			 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<!-- / All Section -->
</form>
  