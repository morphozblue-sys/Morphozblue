<script type="text/javascript">
  function add_more_objective(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:100px'>Marks&nbsp;<input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /></th></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"' name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></center></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:21px;'>Correct Answer</td><td><br/><select style='width:700px' name='correct_answer[]' class='form-control' required ><option value=''>Select</option><option value='A'>A</option><option value='B'>B</option><option value='C'>C</option><option id='option_value4_"+count+"' style='display:none;'  value='D'>D</option><option id='option_value5_"+count+"' style='display:none;'  value='E'>E</option></select></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options6').value;
   if(options2=='4'){
   $('#option_tr1_'+count).show();
   $('#option_value4_'+count).show();
   $('#option4_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr2_'+count).show();
	 $('#option_value4_'+count).show();
	 $('#option_value5_'+count).show();
	 $('#option4_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
   }

 }
 }
  function add_more_matching(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th colspan='3'><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></td></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:200px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td><td><input style='width:200px' type='text' id='option21_"+count+"' name='option2_1[]' value='' placeholder='Enter option 1st' class='form-control'  /></td><td><input style='width:200px' type='text' id='answer1_"+count+"' name='answer_1[]' value='' placeholder='Enter Answer 1st' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:200px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td><input style='width:200px' type='text' id='option22_"+count+"' name='option2_2[]' value='' placeholder='Enter option 2nd' class='form-control'  /></td><td><input style='width:200px' type='text' id='answer2_"+count+"' name='answer_2[]' value='' placeholder='Enter Answer 2nd' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:200px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td><td><input style='width:200px' type='text' id='option23_"+count+"' name='option2_3[]' value='' placeholder='Enter option 3rd' class='form-control'  /></td><td><input style='width:200px' type='text' id='answer3_"+count+"' name='answer_3[]' value='' placeholder='Enter Answer 3rd' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:200px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td><input style='width:200px' type='text' id='option24_"+count+"' name='option2_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td><input style='width:200px' type='text' id='answer4_"+count+"' name='answer_4[]' value='' placeholder='Enter Answer 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:200px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td><input style='width:200px' type='text' id='option25_"+count+"' name='option2_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td><input style='width:200px' type='text' id='answer5_"+count+"' name='answer_5[]' value='' placeholder='Enter Answer 5th' class='form-control'  /></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options6').value;
    
   if(options2=='4'){
   $('#option_tr1_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   $('#option24_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr2_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   $('#option24_'+count).prop('required',true);
	 $('#answer5_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
	 $('#option25_'+count).prop('required',true);
   }

 }
 }
 function add_more_fill_in_the_blank(){
 var count=document.getElementById('div_count').value;
 if(count==''){
     count=0;
 }
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></td></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer1_"+count+"' name='answer_1[]' value='' placeholder='Enter Answer 1st' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer2_"+count+"' name='answer_2[]' value='' placeholder='Enter Answer 2nd' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer3_"+count+"' name='answer_3[]' value='' placeholder='Enter Answer 3rd' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer4_"+count+"' name='answer_4[]' value='' placeholder='Enter Answer 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer5_"+count+"' name='answer_5[]' value='' placeholder='Enter Answer 5th' class='form-control'  /></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;

serail_no();

  var options2=document.getElementById('options6').value;

   if(options2=='4'){
      
   $('#option_tr1_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr2_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
	 $('#answer5_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
   }

 }
 }
       
 function add_more_long(){

 var count=document.getElementById('div_count').value;
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control' /><table class='table table-striped'><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_question("+count+");'><h5 style='display:none' id='suggestion_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value_"+count+"' value='1' ></input><input type='text' id='question_box_"+count+"' rows='2' onKeyUp='get_text_question("+count+")' name='content' class='form-control' style='display:none'></td></tr><tr><th><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th></th><th></th><td style='float:right;'> <b>Marks</th></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='width:65px; float:right;' type='text'  name='long_marks[]' value='' placeholder='Marks' class='form-control' style='margin-top:5px;' required /></td></tr><tr><th colspan='4'><textarea id='editor1_"+count+"' style='width:700px' class='form-control' name='long_question[]' placeholder='Enter Question' rows='4' required ></textarea></th></tr><tr><td style='padding-top:25px;'>Correct Answer</td><th></th><th></th><th><input type='button' style='float:right;' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></th></tr><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_answer("+count+");'><h5 style='display:none' id='suggestion1_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value1_"+count+"' value='1' ></input><input type='text' id='answer_box_"+count+"' rows='2' onKeyUp='get_text_answer("+count+")' name='content' class='form-control' style='display:none'></tr></tr><tr><td colspan='4'><textarea style='width:700px' id='editor2_"+count+"' class='form-control' name='long_correct_answer[]' placeholder='Enter Answer' rows='4' required ></textarea></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();
 CKEDITOR.replace('editor1_'+count);
 CKEDITOR.replace('editor2_'+count);
	show_option();


	 
 }
 function add_more_short(){

 var count=document.getElementById('div_count').value;
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control' /><table class='table table-striped'><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_question("+count+");'><h5 style='display:none' id='suggestion_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value_"+count+"' value='1' ></input><input type='text' id='question_box_"+count+"' rows='2' onKeyUp='get_text_question("+count+")' name='content' class='form-control' style='display:none'></td></tr><tr><th><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th></th><th></th><td style='float:right;'> <b>Marks</th></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='width:65px; float:right;' type='text'  name='long_marks[]' value='' placeholder='Marks' class='form-control' style='margin-top:5px;' required /></td></tr><tr><th colspan='4'><textarea id='editor1_"+count+"' style='width:700px' class='form-control' name='long_question[]' placeholder='Enter Question' rows='4' required ></textarea></th></tr><tr><td style='padding-top:25px;'>Correct Answer</td><th></th><th></th><th><input type='button' style='float:right;' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></th></tr><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_answer("+count+");'><h5 style='display:none' id='suggestion1_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value1_"+count+"' value='1' ></input><input type='text' id='answer_box_"+count+"' rows='2' onKeyUp='get_text_answer("+count+")' name='content' class='form-control' style='display:none'></tr></tr><tr><td colspan='4'><textarea style='width:700px' id='editor2_"+count+"' class='form-control' name='long_correct_answer[]' placeholder='Enter Answer' rows='4' required ></textarea></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();
 CKEDITOR.replace('editor1_'+count);
 CKEDITOR.replace('editor2_'+count);
	show_option();


	 
 }
 function add_more_one_word(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></td></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer1_"+count+"' name='answer_1[]' value='' placeholder='Enter Answer 1st' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer2_"+count+"' name='answer_2[]' value='' placeholder='Enter Answer 2nd' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer3_"+count+"' name='answer_3[]' value='' placeholder='Enter Answer 3rd' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer4_"+count+"' name='answer_4[]' value='' placeholder='Enter Answer 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer5_"+count+"' name='answer_5[]' value='' placeholder='Enter Answer 5th' class='form-control'  /></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options6').value;
   if(options2=='4'){
   $('#option_tr1_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr2_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
	 $('#answer5_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
   }

 }
 }
   function main_box_other(){

 var count=document.getElementById('div_count').value;
  if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control' /><table class='table table-striped'><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_question("+count+");'><h5 style='display:none' id='suggestion_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value_"+count+"' value='1' ></input><input type='text' id='question_box_"+count+"' rows='2' onKeyUp='get_text_question("+count+")' name='content' class='form-control' style='display:none'></td></tr><tr><th><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th></th><th></th><td style='float:right;'> <b>Marks</th></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='width:65px; float:right;' type='text'  name='long_marks[]' value='' placeholder='Marks' class='form-control' style='margin-top:5px;' required /></td></tr><tr><th colspan='4'><textarea id='editor1_"+count+"' style='width:700px' class='form-control' name='long_question[]' placeholder='Enter Question' rows='4' required ></textarea></th></tr><tr><td style='padding-top:25px;'>Correct Answer</td><th></th><th></th><th><input type='button' style='float:right;' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></th></tr><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_answer("+count+");'><h5 style='display:none' id='suggestion1_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value1_"+count+"' value='1' ></input><input type='text' id='answer_box_"+count+"' rows='2' onKeyUp='get_text_answer("+count+")' name='content' class='form-control' style='display:none'></tr></tr><tr><td colspan='4'><textarea style='width:700px' id='editor2_"+count+"' class='form-control' name='long_correct_answer[]' placeholder='Enter Answer' rows='4' required ></textarea></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();
 CKEDITOR.replace('editor1_'+count);
 CKEDITOR.replace('editor2_'+count);
	show_option();


	} 
 }
 function add_more_unseen_passage(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='8' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Que. 1.</td><td><input style='width:700px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter Question 1st' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Ans.</td><td><input style='width:700px' type='text' id='answer1_"+count+"' name='answer_1[]' value='' placeholder='Enter Answer 1st' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Que. 2.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter Question 2nd' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Ans.</td><td><input style='width:700px' type='text' id='answer2_"+count+"' name='answer_2[]' value='' placeholder='Enter Answer 2nd' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Que. 3.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter Question 3rd' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>Ans.</td><td><input style='width:700px' type='text' id='answer3_"+count+"' name='answer_3[]' value='' placeholder='Enter Answer 3rd' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>Que. 4.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter Question 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr11_"+count+"'><td style='text-align:center; padding-top:15px;'>Ans.</td><td><input style='width:700px' type='text' id='answer4_"+count+"' name='answer_4[]' value='' placeholder='Enter Answer 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>Que. 5.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter Question 5th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr22_"+count+"'><td style='text-align:center; padding-top:15px;'>Ans.</td><td><input style='width:700px' type='text' id='answer5_"+count+"' name='answer_5[]' value='' placeholder='Enter Answer 5th' class='form-control'  /></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options6').value;
   if(options2=='4'){
   $('#option_tr1_'+count).show();
   $('#option_tr11_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr11_'+count).show();
    $('#option_tr2_'+count).show();
    $('#option_tr22_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
	 $('#answer5_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
   }

 }
 }
 
       
     function add_more_true_false(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:100px'>Marks&nbsp;<input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></th></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td><td colspan='2'><select  class='form-control' id='answer1_"+count+"' name='answer_1[]' required ><option value=''>Select</option><option class='my_hindi' style='display:none;' value='सत्य '>सत्य </option><option class='my_hindi' style='display:none;' value='असत्य  '>असत्य  </option><option class='my_english' style='display:none;' value='True '>True</option><option class='my_english' style='display:none;' value='False  '>False  </option></select></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td colspan='2'><select  class='form-control' id='answer2_"+count+"' name='answer_2[]' required ><option value=''>Select</option><option class='my_hindi' style='display:none;' value='सत्य '>सत्य </option><option class='my_hindi' style='display:none;' value='असत्य  '>असत्य  </option><option class='my_english' style='display:none;' value='True '>True</option><option class='my_english' style='display:none;' value='False  '>False  </option></select></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td><td colspan='2'><select  class='form-control' id='answer3_"+count+"' name='answer_3[]' required ><option value=''>Select</option><option class='my_hindi' style='display:none;' value='सत्य '>सत्य </option><option class='my_hindi' style='display:none;' value='असत्य  '>असत्य  </option><option class='my_english' style='display:none;' value='True '>True</option><option class='my_english' style='display:none;' value='False  '>False  </option></select></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td colspan='2'><select  class='form-control' id='answer4_"+count+"' name='answer_4[]'  ><option value=''>Select</option><option class='my_hindi' style='display:none;' value='सत्य '>सत्य </option><option class='my_hindi' style='display:none;' value='असत्य  '>असत्य  </option><option class='my_english' style='display:none;' value='True '>True</option><option class='my_english' style='display:none;' value='False  '>False  </option></select></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td colspan='2'><select  class='form-control' id='answer5_"+count+"' name='answer_5[]'  ><option value=''>Select</option><option class='my_hindi' style='display:none;' value='सत्य '>सत्य </option><option class='my_hindi' style='display:none;' value='असत्य  '>असत्य  </option><option class='my_english' style='display:none;' value='True '>True</option><option class='my_english' style='display:none;' value='False  '>False  </option></select></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

var paper_language2=document.getElementById('paper_language').value;
if(paper_language2=='Hindi'){
	 $(".my_hindi").each(function() {
	 $(this).show();
     });
	 $(".my_english").each(function() {
	 $(this).hide();
     });
     
}else{
	 $(".my_hindi").each(function() {
	 $(this).hide();
     });
	 $(".my_english").each(function() {
	 $(this).show();
     });
}

   var options2=document.getElementById('options6').value;
   if(options2=='4'){
   $('#option_tr1_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_'+count).show();
    $('#option_tr2_'+count).show();
   $('#answer4_'+count).prop('required',true);
   $('#option4_'+count).prop('required',true);
	 $('#answer5_'+count).prop('required',true);
	 $('#option5_'+count).prop('required',true);
   }
 }
 }    
 function for_delete(id){
	 $('#div_'+id).remove();
	 var count=document.getElementById('div_count').value;
	 var i=1;
	 count=count-1;
	 document.getElementById('div_count').value=count;
	 $(".my_num").each(function() {
	 $(this).val(i);
	 i++;
     });
	 serail_no();
 }
 function serail_no()
 {
var total=document.getElementById('div_count').value;
 var serial_number=1;
 for(var i=1;i<=total;i++){
 var count=document.getElementById('div_id_'+i).value;
 if(count==1){
 document.getElementById('s_no_'+i).value=+serial_number;
 serial_number=parseInt(serial_number)+parseInt(1);
 }
 else{
  document.getElementById('s_no_'+i).value=0;
 }
 }
 }
 
  function show_option(){
var paper_language2=document.getElementById('paper_language1').value;
	if(paper_language2=='Hindi'){
 $(".paper_language_tr").each(function(){
	 $(this).show();
     });
	 }else{
	  $(".paper_language_tr").each(function(){
	 $(this).hide();
     });
	 }
 
 }


  $(function () { 
    show_option(); 
    CKEDITOR.replace('editor1_1')
	CKEDITOR.replace('editor2_1')
	onLoad();
    $('.textarea').wysihtml5()
  })
 </script>