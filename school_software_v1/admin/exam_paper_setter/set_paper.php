<?php include("../attachment/session.php"); ?>
<script>


function for_subject(value){
if(value!=''){
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


$( document ).ready(function() {
for_question();
});

function for_question(){
var value=document.getElementById('question_type').value;
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var chapter=document.getElementById('question_chapter').value;
var language=document.getElementById('language').value;

if(s_class!='' && subject!='' && chapter!='' && value!='' && language!=''){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_select_book_name.php?s_class="+s_class+"&subject="+subject+"&chapter="+chapter+"&q_type="+value+"&language="+language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_book").html(detail);
		 for_question1();
	  }
   });
}else{
$("#question_book").html("<option value=''>Select</option>");
}

}


function for_question1(){
var value=document.getElementById('question_type').value;
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var exam_type=document.getElementById('question_exam_type').value;
var chapter=document.getElementById('question_chapter').value;
var book=document.getElementById('question_book').value;
var language=document.getElementById('language').value;

if(value=='Objective'){
var page_name='select_objective_section_list.php';
}else if(value=='True_False'){
var page_name='select_true_false_section_list.php';
}else if(value=='Fill_in_the_blank'){
var page_name='select_fill_in_the_blank_section_list.php';
}else if(value=='Short_Question'){
var page_name='select_short_section_list.php';
}else if(value=='Long_Question'){
var page_name='select_long_section_list.php';
}else if(value=='Unseen_Passage'){
var page_name='select_unseen_passage_section_list.php';
}else if(value=='One_Word'){
var page_name='select_one_word_section_list.php';
}else if(value=='Matching'){
var page_name='select_matching_section_list.php';
}else if(value=='Other'){
var page_name='select_other_section_list.php';
}else{
var page_name='';
}
if(page_name!='' && exam_type!='' && chapter!='' && book!='' && language!=''){

$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/"+page_name+"?s_class="+s_class+"&subject="+subject+"&chapter="+chapter+"&book="+book+"&language="+language+"",
	  cache: false,
	  success: function(detail){
		 $("#question_view").html(detail);
		 $('#for_paper_view').show();
	  }
   });
}else{
$('#question_view').html('<center><h3>Please Select All Required Field !!!</h3></center>');
$('#for_paper_view').hide();
}
}


$( document ).ready(function() {
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var exam_type=document.getElementById('question_exam_type').value;
var id=document.getElementById('paper_unique_id').value;
var language=document.getElementById('language').value;
if(s_class!='' && subject!='' && exam_type!='' && id!='' && language!=''){
$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_paper_set_list.php?s_class="+s_class+"&subject="+subject+"&exam_type="+exam_type+"&id="+id+"&language="+language+"",
	  cache: false,
	  success: function(detail){
		  
		 $("#paper_question_list").html(detail);
		 $('#for_paper_setup').show();
	  }
   });
}else{
$('#for_paper_setup').hide();
}
});

$( document ).ready(function() {
var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var exam_type=document.getElementById('question_exam_type').value;
var id=document.getElementById('paper_unique_id').value;
if(s_class!='' && subject!='' && exam_type!='' && id!=''){
$('#timmings').prop("disabled",false);
$('#question_class1').val(s_class);
$('#question_subject1').val(subject);
$('#paper_unique_id1').val(id);
$('#question_exam_type1').val(exam_type);
}else{
$('#timmings').prop("disabled",true);
}
});

function for_paper(){
var check_value=[];
var marks=[];
var count=0;
    $(".question").each(function(){
    if ($(this).prop('checked')==true){ 
	var x=$(this).val();
        check_value.push($(this).val());
		count=count+1;
		marks.push($('#'+x).val());
		$('#'+x).prop("disabled",true);
    }
	
	if ($(this).prop('checked')==false){ 
	var x=$(this).val();
		$('#'+x).prop("disabled",false);
    }
	});
	
	//alert_new(marks);
	if(count>0){
	$('#total_question').val(check_value);
	$('#total_count').val(count);
	$('#total_question_marks').val(marks);
	$('#add_in_paper').prop("disabled",false);
	//$('#or_question').prop("disabled",false);
	}else{
	$('#total_question').val('');
	$('#total_count').val('');
	$('#total_question_marks').val('');
	$('#add_in_paper').prop("disabled",true);
	//$('#or_question').prop("disabled",true);
	}
}


function for_print()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   //$('#printTable').print();
}

function for_unique(value){
if(value!=''){
if(value=='old'){

$.ajax({
	  address: "POST",
	  url: access_link+"exam_paper_setter/ajax_get_unique_id_list.php",
	  cache: false,
	  success: function(detail){
		$("#text_select").html(detail);
	  }
   });

}else if(value=='new'){
$("#text_select").html("<label >Unique Id</label><input type='text' name='paper_unique_id' class='form-control' placeholder='Enter Unique Id' id='paper_unique_id' required />");
}
}else{
$("#text_select").empty();
}
for_detail();
for_list();
}

$( document ).ready(function() {
var value=document.getElementById('paper_unique_id').value;
var language=document.getElementById('language').value;
if(value!='' && language!=''){
$("#for_edit_button").html("<a href="+access_link+"'exam_paper_setter/paper_edit.php?id="+value+"&language="+language+"'><button type='button' class='btn btn-default btn-md' id='paper_edit' >Edit Paper</button></a>");
}else{
$("#for_edit_button").empty();
}
});
function get_submit_type(value){
	$("#submit_type").val(value);
	$("#"+value).click();
	
}

    $("#my_form").submit(function(e){

	var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var exam_type=document.getElementById('question_exam_type').value;
var paper_unique_id=document.getElementById('paper_unique_id').value;
var language=document.getElementById('language').value;
var book_name=document.getElementById('question_book').value;

	var new_data="u_id="+paper_unique_id+"&class="+s_class+"&subject="+subject+"&e_type="+exam_type+"&language="+language+"&book_name="+book_name;

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"exam_paper_setter/set_paper_api.php",
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
				   alert_new('Successfully Complete','red');
				   post_content('exam_paper_setter/set_paper_api',new_data);
            }
			}
         });


      });
	  
	      $("#my_form1").submit(function(e){
		
	var s_class=document.getElementById('question_class').value;
var subject=document.getElementById('question_subject').value;
var exam_type=document.getElementById('question_exam_type').value;
var paper_unique_id=document.getElementById('paper_unique_id').value;
var language=document.getElementById('language').value;
var book_name=document.getElementById('question_book').value;

	var new_data="u_id="+paper_unique_id+"&class="+s_class+"&subject="+subject+"&e_type="+exam_type+"&language="+language+"&book_name="+book_name;
    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"exam_paper_setter/set_schedule_api.php",
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
				   alert_new('Successfully Complete','red');
				   post_content('exam_paper_setter/set_paper_api',new_data);
            }
			}
         });


      });
	  for_book();
</script>

<?php
$p_type=$_GET['p_type'];
$u_id=$_GET['u_id'];
$class=$_GET['class'];
$subject=$_GET['subject'];
$e_type=$_GET['e_type'];
$paper_language=$_GET['language'];
?>			


    <section class="content-header">
      <h1>
        Paper Setter
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-scribd" aria-hidden="true"></i>Exam Paper Setter</a></li>
        <li class="active">Instant Set Paper</li>
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
<form method="post" enctype="multipart/form-data" id="my_form">
		   <div class="box-body">
			
			<div class="col-md-12">

                <div class="col-md-1">	
				</div>
		
				<div class="col-md-5">				
					 <div class="form-group" >
					    <label>Old / New</label>
						<input type="text" name='paper_type' id="paper_type" value="<?php echo $p_type; ?>" class='form-control' readonly />
					</div>
				</div>
				 
				 <div class="col-md-5">				
					<div class="form-group" id="text_select" >
						<label >Unique Id</label>
						<input type="text" name='paper_unique_id' id="paper_unique_id" value="<?php echo $u_id; ?>" class='form-control' readonly />
					</div>
				 </div>				 
				 
			 </div>
			
			<div class="col-md-12">

                <div class="col-md-1">	
				</div>
		
				<div class="col-md-5">				
					 <div class="form-group" >
					    <label>Class</label>
						<input type="text" name='question_class' id="question_class" value="<?php echo $class; ?>" class='form-control' readonly />
					</div>
				</div>
				 
				 <div class="col-md-5">				
					 <div class="form-group" >
					  <label>Subject</label>
					  <input type="text" name='question_subject' id="question_subject" value="<?php echo $subject; ?>" class='form-control' readonly />
					</div>
				 </div>				 
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-1">	
				</div>
				
				<div class="col-md-5">				
					 <div class="form-group" >
					  <label>Exam Type</label>
					  <input type="text" name='question_exam_type' id="question_exam_type" value="<?php echo $e_type; ?>" class='form-control' readonly />
					</div>
				</div>
				
				 <div class="col-md-5">				
					 <div class="form-group" >
					  <label>Question Type</label>
					  <?php
					  $que1="select * from question_paper_set where question_class='$class' and question_subject='$subject' and exam_type='$e_type' and paper_unique_id='$u_id'";
					  $res1=mysqli_query($conn73,$que1);
					  $question_type='';
					  while($row1=mysqli_fetch_assoc($res1)){
					  $question_type=$row1['question_type'];
					  }
					  ?>
					  <select name="question_type" id="question_type" class="form-control" onchange="for_question();">
					  <option <?php if($question_type==''){ echo "selected"; } ?> value="">Select</option>
					  <option <?php if($question_type=='Objective'){ echo "selected"; } ?> value="Objective">Objective</option>
					  <option <?php if($question_type=='True_False'){ echo "selected"; } ?> value="True_False">True / False</option>
					  <option <?php if($question_type=='Fill_in_the_blank'){ echo "selected"; } ?> value="Fill_in_the_blank">Fill in the blank</option>
					  <option <?php if($question_type=='Short_Question'){ echo "selected"; } ?> value="Short_Question">Short Question</option>
					  <option <?php if($question_type=='Long_Question'){ echo "selected"; } ?> value="Long_Question">Long Question</option>
					  <option <?php if($question_type=='Unseen_Passage'){ echo "selected"; } ?> value="Unseen_Passage">Unseen Passage</option>
					  <option <?php if($question_type=='One_Word'){ echo "selected"; } ?> value="One_Word">One Word</option>
					  <option <?php if($question_type=='Matching'){ echo "selected"; } ?> value="Matching">Matching</option>
					  <option <?php if($question_type=='Other'){ echo "selected"; } ?> value="Other">Other</option>
					  </select>
					</div>
				 </div>
				 
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-1">	
				</div>
		
				<div class="col-md-5">				
					 <div class="form-group" >
					  <label>Chapter</label>
					  <select name="question_chapter" class="form-control" id="question_chapter" onchange="for_question();">
					  <option value="select_all">Select All</option>
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
				 
				 <div class="col-md-5">				
					 <div class="form-group" >
					  <label>Question Book Name</label>
					  <select name="question_book" class="form-control" id="question_book" onchange="for_question1();">
					  <option value="">Select</option>
					  
					  </select>
					</div>
				 </div>
				 
			 </div>
			 
			 <div class="col-md-12 ">

                <div class="col-md-1">	
				</div>
				
				<div class="col-md-5">				
					<div class="col-md-4" >
					  <center><button type="button" class="btn btn-warning btn-md" id="timmings" onclick="for_detail();" data-toggle="modal" data-target="#myModal" disabled>Add Schedule</button></center>
					</div>
					<div class="col-md-4" >
					  <a href="javascript:get_content('exam_paper_setter/instructions_edit')"><button type="button" class="btn btn-primary btn-md" id="">Instructions</button></a>
					</div>
					<div class="col-md-4" id="for_edit_button" >
					
					</div>
				</div>
				
				 <div class="col-md-2">				
					<div class="form-group" >
					  <label>Total Question Count</label>
					  <input type="hidden" name="total_question" id="total_question" class="form-control" readonly />
					  <input type="hidden" name="total_question_marks" id="total_question_marks" class="form-control" readonly />
					  <input type="text" name="total_count" id="total_count" class="form-control" readonly />
					</div>
				 </div>
				 
				 <div class="col-md-4">				
					<div class="form-group" >
					  <label>Language</label>
					  <input type="text" name="language" id="language" class="form-control" value="<?php echo $paper_language; ?>" readonly />
					</div>
				 </div>				 
				   
			 </div>
			 <div class="col-md-12 ">
			 <center>
			 <button type="button" id="add_in_paper" class="btn btn-success" onclick="get_submit_type('submit');" disabled>Add In Question Paper</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  id="or_question" onclick="get_submit_type('submit2');" class="btn btn-success" disabled >Add Or Question</button>
			 <input type="text" name="submit_type" id="submit_type"  style="display:none">
			 <button type="submit" name="submit" id="submit"  style="display:none"></button>
			 <button type="submit" name="submit2" id="submit2" style="display:none" ></button><br/><br/>
			 </center>
			 </div>
			 
			 <div class="col-sm-12" id="for_paper_view" style="display:none;">
			 <div class="col-sm-1"></div>
			 <div class="col-sm-10" style="border:2px solid black;" id="question_view"><br/>	
			 
			 </div>
			 
			 </div>
			 
			 <div class="col-sm-12" id="for_paper_setup" style="display:none;">
			 <center><h3>-: Paper Setup :-<h3></center>
			 <div class="col-sm-1"></div>
			 <div class="col-sm-10" style="border:2px solid black;" id="paper_question_list"><br/>	
			 
			 </div>
			 </div>
			 
			 
	</div>
	</form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<!-- / All Section -->

  </div>
  

<form method="post" enctype="multipart/form-data" id="my_form1">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fill Info</h4>
        </div>
        <div class="modal-body">
          
		  <div class="col-md-12">
                <div class="col-md-2">	
				</div>
				<div class="col-md-4">				
					 <div class="form-group" >
					    <label>Exam Date</label>
					    <input type="date" name="exam_date" id="" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
						
						<input type="hidden" name="question_class1" id="question_class1" value="" class="form-control" />
						<input type="hidden" name="question_subject1" id="question_subject1" value="" class="form-control" />
						<input type="hidden" name="question_exam_type1" id="question_exam_type1" value="" class="form-control" />
						<input type="hidden" name="paper_unique_id1" id="paper_unique_id1" value="" class="form-control" />
					</div>
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
						&nbsp;
					</div>
				 </div>
			</div>
			
			<div class="col-md-12">
                <div class="col-md-2">	
				</div>
				<div class="col-md-4">				
					 <div class="form-group" >
					    <label>Exam Time From</label>
					    <input type="time" name="exam_time_from" id="" value="<?php date_default_timezone_set('Asia/Calcutta'); echo date('H:i'); ?>" class="form-control" />
					</div>
				</div>
				 
				 <div class="col-md-4">				
					 <div class="form-group" >
						<label>Exam Time To</label>
					    <input type="time" name="exam_time_to" id="" value="<?php date_default_timezone_set('Asia/Calcutta'); echo date('H:i'); ?>" class="form-control" />
					</div>
				 </div>
			</div>
		  
        </div>
        <div class="modal-footer">
       
          <button type="submit" class="btn btn-success" id="submit1" name="submit1">Set</button>
        </div>
      </div>
      
    </div>
  </div>
  </form>
 

 