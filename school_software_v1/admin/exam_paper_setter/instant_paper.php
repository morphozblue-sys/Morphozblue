<?php include("../attachment/session.php")?><!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>
   <?php include("../attachment/link_js.php")?>
    <?php include("../../con73/con37.php");?>
</head>

<script>


function for_subject(value){
if(value!=''){
$.ajax({
	  address: "POST",
	  url: "ajax_get_subject.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		 $("#question_subject").html(detail);
		 create_unique_id();
	  }
   });
}else{
$("#question_subject").html("<option value=''>Select</option>");
}
}

$( document ).ready(function() {
    create_unique_id();
});

function create_unique_id(){

var class_1=document.getElementById("question_class").value;
var subject_1=document.getElementById("question_subject").value;
var exam_type_1=document.getElementById("question_exam_type").value;
var date_1=document.getElementById("current_date").value;
var language=document.getElementById("question_exam_language").value;
var uni_id=class_1+"_"+subject_1+"_"+exam_type_1+"_"+date_1+"_"+language;
document.getElementById("question_unique_id").value=uni_id;
for_panel();

}

function for_panel(){
var q_class=document.getElementById("question_class").value;
var q_subject=document.getElementById("question_subject").value;
var q_exam_type=document.getElementById("question_exam_type").value;
var q_id=document.getElementById("question_unique_id").value;
var q_language=document.getElementById("question_exam_language").value;
if(q_class!='' && q_subject!='' && q_exam_type!='' && q_id!='' && q_language!=''){
$('#my_submit').prop('disabled', false);
}else{
$('#my_submit').prop('disabled', true);
}

}

</script>

				

<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

  <?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?> 
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Paper Setter
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="exam_paper_setter.php"><i class="fa fa-scribd" aria-hidden="true"></i>Exam Paper Setter</a></li>
        <li class="active">Instant Paper Set</li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<form method="post" enctype="multipart/form-data">
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
					<label >Unique Id</label>
					<input type="text" name="question_unique_id" style="" class="form-control" id="question_unique_id" readonly />
					<input type="hidden" name="current_date" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="current_date" />
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label>Class</label>
					    <select name="question_class" style="" id="question_class" class="form-control" onchange="for_subject(this.value);" >
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
				 
			 </div>			
			
			<div class="col-md-12">

                <div class="col-md-2">	
				</div>
		
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label >Subject</label>
					  <select name="question_subject" style="" class="form-control" id="question_subject" onchange="create_unique_id();">
					  <option value="">Select Subject</option>
					  </select>
					</div>
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label >Exam Type</label>
					  <select name="question_exam_type" style="" id="question_exam_type" class="form-control" onchange="create_unique_id();">
					  <option value="">Select</option>
					  <option value="Terminal Exam">Terminal Exam</option>
					  <option value="Half Yearly Exam">Half Yearly Exam</option>
					  <option value="Annual Exam">Annual Exam</option>
					  </select>
					</div>
				 </div>				 
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-2">	
				</div>
				
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label >Language</label>
					  <select name="question_exam_language" style="" id="question_exam_language" class="form-control" onchange="create_unique_id();">
					  <option value="hindi">Hindi</option>
					  <option value="english">English</option>
					  </select>
					</div>
				</div>
				
				 <div class="col-md-4">				
					<div class="form-group" >
					  &nbsp;
					</div>
				 </div>
				 
				 
			 </div>
			 
			 <br/>
			 <div class="col-md-12">			 
					 <center><button type="submit" name="submit" id="my_submit" class="btn btn-success" disabled>Submit</button></center><br/>
			 </div>
			 <br/>
			 	 
			 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<!-- / All Section -->
</form>
  </div>
  

  
  <!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 
</body>
</html>

<?php
if(isset($_POST['submit'])){


$question_unique_id=$_POST['question_unique_id'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$question_exam_language=$_POST['question_exam_language'];


if($question_unique_id!='' && $question_class!='' && $question_subject!='' && $question_exam_type!='' && $question_exam_language!=''){
echo "<script>window.open('instant_paper_generate.php?u_id=$question_unique_id&class=$question_class&subject=$question_subject&e_type=$question_exam_type&language=$question_exam_language','_self');</script>";
}else{
echo "<script>alert_new('Please Fill All Field !!!');</script>";
echo "<script>window.open('instant_paper.php','_self');</script>";
}

}


?>
