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
		   $('#new_book_dropdown').html("<option value='' >Loading....</option>");
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_book_name.php?s_class="+s_class+"&subject="+subject+"",
	  cache: false,
	  success: function(detail){
		 $("#question_book").html(detail);
	  }
   });
}else{
$("#question_book").html("<option value=''>Select</option>");
}
}


function for_question(){
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var chapter=document.getElementById('question_chapter').value;
var question_book=document.getElementById('question_book').value;
var paper_language=document.getElementById('paper_language').value;
var q_type=document.getElementById('question_type').value;
if(q_type=='Objective'){
var page_name='objective_section_list.php';
}else if(q_type=='True_False'){
var page_name='true_false_section_list.php';
}else if(q_type=='Fill_in_the_blank'){
var page_name='fill_in_the_blank_section_list.php';
}else if(q_type=='Short_Question'){
var page_name='short_section_list.php';
}else if(q_type=='Long_Question'){
var page_name='long_section_list.php';
}else if(q_type=='Unseen_Passage'){
var page_name='unseen_passage_section_list.php';
}else if(q_type=='One_word'){
var page_name='one_word_section_list.php';
}else if(q_type=='Matching'){
var page_name='matching_section_list.php';
}else if(q_type=='Other'){
var page_name='other_section_list.php';
}else{
var page_name='';
}
if(s_class!='' && subject!='' && page_name!=''){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/"+page_name+"?s_class="+s_class+"&subject="+subject+"&chapter="+chapter+"&question_book="+question_book+"&paper_language="+paper_language+"",
	  cache: false,
	  success: function(detail){
		 $('#question_view').show();
		 $("#question_view").html(detail);
	  }
   });
}else{
$('#question_view').hide();
}
}
			function valid(s_no,question_table){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_question(s_no,question_table);       
 }            
else  {      
return false;
 }       
  } 
  function delete_question(s_no,question_table){
	 // var question_table=document.getElementById('question_table').value;
	  
$.ajax({
type: "POST",
url: access_link+"exam_paper_setter/delete_question.php?id="+s_no+"&question_table="+question_table+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','red');
				   get_content('exam_paper_setter/view_question');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>


 <section class="content-header">
      <h1>
         <?php echo $language['Paper Setter']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-dashboard"></i> <?php echo $language['Paper Setter']; ?></a></li>
	  <li class="active"><?php echo $language['View Question']; ?></li>
      </ol>
    </section>
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
					    <label><?php echo $language['Class']; ?></label>
					    <select name="question_class" id="question_class" class="form-control" onchange="for_book();for_question();for_subject(this.value);" required>
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
					  <select name="question_subject" class="form-control" id="question_subject" onchange="for_book();for_question();">
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
					  <label ><?php echo $language['Question Book Name']; ?></label>
					  <select name="question_book" class="form-control" id="question_book" onchange="for_question();">
					  <option value="">Select</option>
					  
					  </select>
					</div>
				 </div>
				<div class="col-md-4">				
					 <div class="form-group" >
					  <label ><?php echo $language['Chapter']; ?></label>
					  <select name="question_chapter" class="form-control" id="question_chapter" onchange="for_question();">
					  <option value="select_all">All</option>
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
					  <label ><?php echo $language['Paper Language']; ?></label>
					  <select name="paper_language2" class="form-control" id="paper_language" onchange="for_question();">
					  <option value="Hindi">Hindi</option>
					  <option value="English">English</option>
					  </select>
					</div>
			  <div class="col-md-4">				
					 <div class="form-group" >
					  
					  <label ><?php echo $language['Question Type']; ?></label>
					  <select name="" class="form-control" id="question_type" onchange="for_question();">
					  <option value="">Select</option>
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
			 
			 <div class="col-sm-12">
			 <div class="col-sm-2"></div>
			 <div class="col-sm-8" id="question_view" style="display:none;">	
			 
			 </div>
			 </div>
			 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
		
  