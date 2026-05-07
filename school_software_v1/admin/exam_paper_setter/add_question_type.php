<?php include("../attachment/session.php")?>
<?php 
if(isset($_GET['question_class'])){
$question_class1=$_GET['question_class']; 
$question_subject1=$_GET['question_subject']; 
$question_chapter1=$_GET['question_chapter']; 
$question_book1=$_GET['question_book']; 
$paper_language1=$_GET['paper_language']; 
$question_type1=$_GET['question_type']; 
$option3=$_GET['option2']; 
}else{
	$question_class1=""; 
$question_subject1=""; 
$question_chapter1=""; 
$question_book1=""; 
$paper_language1=""; 
$question_type1=""; 
$option3=""; 
}
?>

<script>
function for_change(){
alert_new();
var paper_language = document.getElementById('paper_language').value;

var question_class = document.getElementById('question_class').value;

var question_subject = document.getElementById('question_subject').value;
var question_chapter = document.getElementById('question_chapter').value;
var question_type = document.getElementById('question_type1').value;
var question_book = document.getElementById('book_type_hidden').value;
var option4 = document.getElementById('options6').value;

if(question_class==''){
	alert_new("Please select class",'red');

}else if(question_subject==''){
	alert_new("Please select Subject",'red');

}else if(question_chapter==''){
	alert_new("Please select Chapter",'red');

}else if(question_book==''){
	alert_new("Please select Book",'red');

}else if(paper_language==''){
	alert_new("Please select Language",'red');

}else if(question_type==''){
	alert_new("Please select Question Type",'red');

}else if(option4==''){
	alert_new("Please select Number of Options",'red');

}else{

var data="question_class="+question_class+"&question_subject="+question_subject+"&question_chapter="+question_chapter+"&question_book="+question_book+"&paper_language="+paper_language+"&question_type="+question_type+"&option2="+option4;
post_content('exam_paper_setter/add_question_type',data);

}
}

function for_options(value1){
	alert_new();
var question_type2 = document.getElementById('question_type1').value;
var paper_language=document.getElementById('paper_language').value;
if(question_type2!=''){
if(question_type2=='Objective'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/objective_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}else if(question_type2=='True_False'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/true_false_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}else if(question_type2=='Fill_in_the_blank'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/fill_in_the_blank_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}else if(question_type2=='Matching'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/matching_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}else if(question_type2=='One_word'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/one_word_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}else if(question_type2=='Unseen_Passage'){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/unseen_passage_section.php?options="+value1+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
     document.getElementById('question_type1').value=question_type2;
}





}
}

function for_question(value){
if(value!=''){
if(value=='Objective'){
$("#options").show();
document.getElementById('question_type1').value=value;

}
else if(value=='True_False'){
$("#options").show();
document.getElementById('question_type1').value=value;
}
else if(value=='Fill_in_the_blank'){
$("#options").show();
document.getElementById('question_type1').value=value;
}
else if(value=='Short_Question'){
var paper_language=document.getElementById('paper_language').value;
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/short_section.php?paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
   document.getElementById('question_type1').value=value;
}
else if(value=='Long_Question'){
var paper_language=document.getElementById('paper_language').value;
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/long_section.php?paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		$("#question_panel").html(detail);
	  }
   });
   document.getElementById('question_type1').value=value;
}
else if(value=='Unseen_Passage'){
$("#options").show();
document.getElementById('question_type1').value=value;
}
else if(value=='One_word'){
$("#options").show();
document.getElementById('question_type1').value=value;
}
else if(value=='Matching'){
$("#options").show();
document.getElementById('question_type1').value=value;
}
else if(value=='Other'){
var paper_language=document.getElementById('paper_language').value;
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/other_section.php?paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_panel").html(detail);
	  }
   });
   document.getElementById('question_type1').value=value;
}
}else{
$('#question_panel').empty();
}
}
function for_subject(value){
     alert_new();
if(value!=''){
   $('#question_subject').html("<option value='' >Loading....</option>");
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_subject.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
	       //alert_new(detail);
	   	 $("#question_subject").html(detail);
	   }
   });
}else{
$("#question_subject").html("<option value=''>Select</option>");
}
}

function for_book(){
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
if(s_class!='' && subject!=''){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_book_name.php?s_class="+s_class+"&subject="+subject+"",
	  cache: false,
	  success: function(detail){
	     // //alert_new(detail);
		 $("#new_book_dropdown").html(detail);
	  }
   });
}else{
$("#new_book_dropdown").html("<option value=''>Select</option>");
}
}
function book_type(book){
if(book=="Add New"){
$("#new_book_input").show();
$("#new_book_input").attr("required",true);
$("#new_book_dropdown").hide();
$("#new_book_dropdown").attr("required",false);
$("#book_type1").val("Old Book");
$("#book_type_hidden").val("Old Book");
}
else{
$("#new_book_input").hide();
$("#new_book_dropdown").show();
$("#book_type1").val("Add New");
$("#book_type_hidden").val("Add New");
$("#new_book_input").attr("required",false);
$("#new_book_dropdown").attr("required",true);
}
}

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"exam_paper_setter/add_question_api.php",
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
				   get_content('exam_paper_setter/add_question_type');
            }
			}
         });
      });
	  function select_book_name(value){
		  $("#book_type_hidden").val(value);
	  }
	    function enter_book_name(value){
		  $("#book_type_hidden").val(value);
	  }
</script>

 <section class="content-header">
      <h1>
        Paper Setter
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
		   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	   <li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-dashboard"></i> <?php echo $language['Paper Setter']; ?></a></li>
	   <li class="active"><?php echo $language['Add Question']; ?></li>
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
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		   <div class="box-body">
			<form method="post" enctype="multipart/form-data">
			<div class="col-md-12 ">
               <div class="col-md-2">	
				</div>	
				
					 				<div class="col-md-4">				
					 <div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="question_class" id="question_class" class="form-control" required onchange="for_subject(this.value);for_book();" >
								  <?php if($question_class1==''){ ?>
					   <option value="">Select Class</option>
					  <?php }else{ ?>
					  <option value="<?php echo $question_class1; ?>"><?php echo $question_class1; ?></option>
					   <?php } ?>
						    
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
					  <select name="question_subject" id="question_subject" onchange="for_book();" class="form-control" required >
					  		  <?php if($question_subject1==''){ ?>
					   <option value="">Select Subject</option>
					  <?php }else{ ?>
					  <option value="<?php echo $question_subject1; ?>"><?php echo $question_subject1; ?></option>
					   <?php } ?>
					
					  </select>
					</div>
				 </div>
		
			</div>
			 <div class="col-md-12 ">
                <div class="col-md-2">	
				</div>
								 <div class="col-md-4">				
					 <div class="form-group" >
					  <label ><?php echo $language['Question Book Name']; ?></label>
					  <div class="input-group">
					  <select name="question_book_dropdown" id="new_book_dropdown" onchange="select_book_name(this.value)" class="form-control"  required >
					   <?php if($question_book1==''){ ?>
					   <option value="">Select book</option>
					  <?php }else{ ?>
					  <option value="<?php echo $question_book1; ?>"><?php echo $question_book1; ?></option>
					   <?php } ?>
					  </select>
					  <input type="text"  id="new_book_input" name="question_book_input" value="" oninput="enter_book_name(this.value)" style="display:none" placeholder="Enter Question Book Name" class="form-control" />
					  <span class="input-group-addon" style="padding:0px;">
					    <input type="button" class="btn" id="book_type1" onclick="book_type(this.value);" value="<?php echo $language['Add New']; ?>">
						</span>
						<input type="hidden" value="Add New" id="book_type_hidden" name="book_button">
						</div>
					</div>
				 </div>
		 <div class="col-md-4">				
					 <div class="form-group" >
					  <label ><?php echo $language['Chapter']; ?></label>
					  <select name="question_chapter" id="question_chapter" class="form-control" required>
					  		   <?php if($question_chapter1==''){ ?>
					   <option value="">Select </option>
					  <?php }else{ ?>
					  <option value="<?php echo $question_chapter1; ?>"><?php echo $question_chapter1; ?></option>
					   <?php } ?>
		
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
			
			 </div>
			  <div class="col-md-12 ">
                <div class="col-md-2">	
				</div>
					<div class="col-md-4">	
					  <label >Paper Language</label>
					  <select name="paper_language2" class="form-control" id="paper_language" onchange="for_change();">
					    <?php if($paper_language1==''){ ?>
					   <option value="">Select</option>
					  <?php }else{ ?>
					  <option value="<?php echo $paper_language1; ?>"><?php echo $paper_language1; ?></option>
					   <?php } ?>

					  <option value="Hindi">Hindi</option>
					  <option value="English">English</option>
					  </select>
					</div>
				<div class="col-md-4">		
                    <input type="hidden"  id="question_type1" value="<?php echo $question_type1; ?>"/>				
					 <div class="form-group" >
					  <label >Question Type</label>
					  <select name="" class="form-control" onchange="for_change();for_question(this.value)">
					  <?php if($question_type1==''){ ?>
					   <option value="">Select</option>
					  <?php }else{ ?>
					  <option value="<?php echo $question_type1; ?>"><?php echo $question_type1; ?></option>
					   <?php } ?>
					  <option value="Objective">Objective</option>
					  <option value="True_False">True / False</option>
					  <option value="Fill_in_the_blank">Fill in the blank</option>
					  <option value="Short_Question">Short Question</option>
					  <option value="Long_Question">Long Question</option>
					  <option value="Unseen_Passage">Unseen Passage</option>
					  <option value="One_word">One Word</option>
					  <option value="Matching">Matching</option>
					  <option value="Other">Other</option>
					  </select>
					</div>
				</div>
			 </div>
			 			  <div class="col-md-12 ">
                <div class="col-md-2">	
				</div>
				 <div class="col-md-4">				 
					 <div class="form-group" style="display:none;" id="options">
					  <label >Total Options</label>
					  <select name="options6" class="form-control" id="options6" onchange="for_change();">
							  <?php if($option3==''){ ?>
					   <option value="">Select</option>
					  <?php }else{ ?>
					  <option value="<?php echo $option3; ?>"><?php echo $option3; ?></option>
					   <?php } ?>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  </select>
					</div>
				</div>
			 </div>
             <div class="col-sm-12">
			 <div class="col-sm-2"></div>
			 <div class="col-sm-8" id="question_panel">	
			 <div id="xyz"></div>
			 </div>
			 </div>
			 
          </form> 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
	

<script>
var question_type = document.getElementById('question_type1').value;
var options5 = document.getElementById('options6').value;
for_question(question_type);
if(question_type=='Objective' || question_type=='True_False' || question_type=='Fill_in_the_blank' || question_type=='Matching' || question_type=='One_word'  || question_type=='Unseen_Passage')
{
for_options(options5);
}
</script>

