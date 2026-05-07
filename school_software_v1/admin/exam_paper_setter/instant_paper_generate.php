<?php include("../attachment/session.php")?><!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>
   <?php include("../attachment/link_js.php")?>
    <?php include("../../con73/con37.php");?>
</head>

<script>

$( document ).ready(function() {
    for_panel();
});

function for_panel(){
var q_class=document.getElementById("question_class").value;
var q_subject=document.getElementById("question_subject").value;
var q_exam_type=document.getElementById("question_exam_type").value;
var q_id=document.getElementById("question_unique_id").value;
var q_language=document.getElementById("question_exam_language").value;
var q_type=document.getElementById("question_type").value;
var q_chapter=document.getElementById("question_chapter").value;
var q_book=document.getElementById("question_book").value;
if(q_class!='' && q_subject!='' && q_exam_type!='' && q_id!='' && q_language!='' && q_type!='' && q_chapter!='' && q_book!=''){
$('#question_panel').show();
$('#paper_panel').show();
}else{
$('#question_panel').hide();
$('#paper_panel').hide();
}

}

</script>

<?php
$u_id=$_GET['u_id'];
$class=$_GET['class'];
$subject=$_GET['subject'];
$e_type=$_GET['e_type'];
$language=$_GET['language'];
?>			

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
        <li class="active">Instant Paper Generate</li>
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
					<input type="text" name="question_unique_id" style="" class="form-control" id="question_unique_id" value="<?php echo $u_id; ?>" readonly />
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label>Class</label>
					    <input type="text" name="question_class" id="question_class" class="form-control" value="<?php echo $class; ?>" readonly />
					</div>
				 </div>				 
				 
			 </div>			
			
			<div class="col-md-12">

                <div class="col-md-2">	
				</div>
		
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label >Subject</label>
					  <input type="text" name="question_subject" class="form-control" id="question_subject" value="<?php echo $subject; ?>" readonly />
					</div>
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label >Exam Type</label>
					  <input type="text" name="question_exam_type" id="question_exam_type" class="form-control" value="<?php echo $e_type; ?>" readonly />
					</div>
				 </div>				 
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-2">	
				</div>
		
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label >Language</label>
					  <input type="text" name="question_exam_language" id="question_exam_language" class="form-control" value="<?php echo $language; ?>" readonly />
					</div>
				 </div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
					  <label>Question Book Name</label>
					  <input type="text" name="question_book" class="form-control" id="question_book" oninput="for_panel();" />
					</div>
				 </div>
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-2">	
				</div>
				
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label>Chapter</label>
					  <select name="question_chapter" class="form-control" id="question_chapter" onchange="for_panel();">
					  <option value="">Select</option>
					  <option value="1st">1st</option>
					  <option value="2nd">2nd</option>
					  <option value="3rd">3rd</option>
					  <option value="4th">4th</option>
					  <option value="5th">5th</option>
					  <option value="6th">6th</option>
					  <option value="7th">7th</option>
					  <option value="8th">8th</option>
					  <option value="9th">9th</option>
					  <option value="10th">10th</option>
					  <option value="11th">11th</option>
					  <option value="12th">12th</option>
					  <option value="13th">13th</option>
					  <option value="14th">14th</option>
					  <option value="15th">15th</option>
					  <option value="16th">16th</option>
					  <option value="17th">17th</option>
					  <option value="18th">18th</option>
					  <option value="19th">19th</option>
					  <option value="20th">20th</option>
					  <option value="21st">21st</option>
					  <option value="22nd">22nd</option>
					  <option value="23rd">23rd</option>
					  <option value="24th">24th</option>
					  </select>
					</div>
				</div>
				
				 <div class="col-md-4">				
					<div class="form-group" >
					  <label>Question Type</label>
					  <select name="question_type" id="question_type" class="form-control" onchange="for_panel();">
					  <option value="">Select</option>
					  <option value="Objective">Objective</option>
					  <option value="True_False">True / False</option>
					  <option value="Fill_in_the_blank">Fill in the blank</option>
					  <option value="Short_Question">Short Question</option>
					  <option value="Long_Question">Long Question</option>
					  <option value="Unseen_Passage">Unseen Passage</option>
					  <option value="Correct_choose_fill_in_the_blank">Correct choose fill in the blank</option>
					  <option value="Matching">Matching</option>
					  <option value="Other">Other</option>
					  </select>
					</div>
				 </div>
				 
				 
			 </div>
			 
			 <br/>
			 <div class="col-md-12">			 
					 <center><button type="submit" name="submit" class="btn btn-success">Submit</button></center><br/>
			 </div>
			 <br/>
			 <br/>
			 <div class="col-md-12" id="question_panel" style="display:none;">			 
				 <div class="col-sm-2"></div>
				 <div class="col-sm-8" style="border:2px solid black;" id="question_view"><br/>	
				 
				 </div>
			 </div>
			 <br/>
			 <br/>
			 <div class="col-md-12" id="paper_panel" style="display:none;" >			 
				 <center><h3>-: Paper Setup :-<h3></center>
				 <div class="col-sm-2"></div>
				 <div class="col-sm-8" style="border:2px solid black;" id="paper_question_list"><br/>	
				 
				 </div>
			 </div>
			 
			 
			 
			
			 
			
			 
			
			 
			 
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

$paper_type=$_POST['paper_type'];
if($paper_type=='new'){
$paper_unique_id2=$_POST['paper_unique_id1'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$question_exam_language=$_POST['question_exam_language'];
}
else{
$paper_unique_id2=$_POST['paper_unique_id'];
$question_class=$_POST['question_class1'];
$question_subject=$_POST['question_subject1'];
$question_exam_type=$_POST['question_exam_type1'];
$question_exam_language=$_POST['question_exam_language1'];
}

if($paper_type!='' && $paper_unique_id2!='' && $question_class!='' && $question_subject!='' && $question_exam_type!='' && $question_exam_language!=''){
echo "<script>window.open('set_paper.php?p_type=$paper_type&u_id=$paper_unique_id2&class=$question_class&subject=$question_subject&e_type=$question_exam_type&language=$question_exam_language','_self');</script>";
}else{
echo "<script>alert_new('Please Fill All Field !!!');</script>";
echo "<script>window.open('go_to_paper_setter.php','_self');</script>";
}

}


?>
