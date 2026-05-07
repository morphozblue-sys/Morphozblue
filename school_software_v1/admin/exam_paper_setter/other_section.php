<?php 
$paper_language=$_GET['paper_language']; 

//$paper_language='Hindi'; 
?>
<script type="text/javascript">

  function main_box9(){

 var count=document.getElementById('div_count').value;
  if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box9" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control' /><table class='table table-striped'><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_question("+count+");'><h5 style='display:none' id='suggestion_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value_"+count+"' value='1' ></input><input type='text' id='question_box_"+count+"' rows='2' onKeyUp='get_text_question("+count+")' name='content' class='form-control' style='display:none'></td></tr><tr><th><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th></th><th></th><td style='float:right;'> <b>Marks</th></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='width:65px; float:right;' type='text'  name='long_marks[]' value='' placeholder='Marks' class='form-control' style='margin-top:5px;' required /></td></tr><tr><th colspan='4'><textarea id='editor1_"+count+"' style='width:700px' class='form-control' name='long_question[]' placeholder='Enter Question' rows='4' required ></textarea></th></tr><tr><td style='padding-top:25px;'>Correct Answer</td><th></th><th></th><th><input type='button' style='float:right;' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></th></tr><tr class='paper_language_tr' style='display:none'><td colspan='4'><h4>Don't Know Hindi Typing? Don't Worry Click Here </h4><input type='button'  class='btn btn-success' value='click' onclick='hindi_typing_answer("+count+");'><h5 style='display:none' id='suggestion1_"+count+"'>Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5><input type='hidden' id='count_value1_"+count+"' value='1' ></input><input type='text' id='answer_box_"+count+"' rows='2' onKeyUp='get_text_answer("+count+")' name='content' class='form-control' style='display:none'></tr></tr><tr><td colspan='4'><textarea style='width:700px' id='editor2_"+count+"' class='form-control' name='long_correct_answer[]' placeholder='Enter Answer' rows='4' required ></textarea></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();
 CKEDITOR.replace('editor1_'+count);
 CKEDITOR.replace('editor2_'+count);
	show_option();
onLoad();

	} 
 }
 function for_delete(id){
	 $('#div_'+id).remove();
	 var count=document.getElementById('div_count').value;
	 var i=2;
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
</script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
	
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	 <script type="text/javascript">

      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad(){

        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['hi'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = ["question_box_1","answer_box_1","question_box_2","answer_box_2","question_box_3","answer_box_3","question_box_4","answer_box_4","question_box_5","answer_box_5","question_box_6","answer_box_6","question_box_7","answer_box_7","question_box_8","answer_box_8","question_box_9","answer_box_9","question_box_10","answer_box_10","question_box_11","answer_box_11","question_box_12","answer_box_12","question_box_13","answer_box_13","question_box_14","answer_box_14","question_box_15","answer_box_15"];
        transliterationControl.makeTransliteratable(ids);
       
      }

      google.setOnLoadCallback(onLoad);
	  
	  
	  function get_text_question(value2) 
            {
			var x1=document.getElementById("question_box_"+value2).value;
			var x2=document.getElementById("count_value_"+value2).value;
			var res=x1.split(" ");
			var count=res.length;
			var count1=count-3;
			if(parseInt(count)>parseInt(x2))
			{
			
			  var editor_name1="editor1_"+value2;
		    var desc = CKEDITOR.instances[editor_name1].getData();
			var res2 = desc.replace("<p>", "");
			var res3 = res2.replace("</p>", "");
			if(count1<0){
			}else{
			 var res4=res3+res[count1];
			 CKEDITOR.instances[editor_name1].setData(res4);
			 }
		
			 
			}
				 document.getElementById("count_value_"+value2).value=count;
	}
	function get_text_answer(value2) 
            {
			var x1=document.getElementById("answer_box_"+value2).value;
			var x2=document.getElementById("count_value1_"+value2).value;
			var res=x1.split(" ");
			var count=res.length;
			var count1=count-3;
			if(parseInt(count)>parseInt(x2))
			{
		
			 var editor_name="editor2_"+value2;
		    var desc = CKEDITOR.instances[editor_name].getData();
			var res2 = desc.replace("<p>", "");
			var res3 = res2.replace("</p>", "");
			if(count1<0){
			}else{
			 var res4=res3+res[count1];
			 CKEDITOR.instances[editor_name].setData(res4);
			 }
		
			 
			}
			 document.getElementById("count_value1_"+value2).value=count;
	}
	  	function hindi_typing_question(value1){
    $("#question_box_"+value1).show();
    $("#suggestion_"+value1).show();
     $("#question_box_"+value1).focus();

}
	function hindi_typing_answer(value1){
     $("#answer_box_"+value1).show();
     $("#suggestion1_"+value1).show();
     $("#answer_box_"+value1).focus();

}
	  </script>
	
	
          <div class="box" id="main_box9">
            <!-- /.box-header -->
			 <input type="hidden" id="paper_language1" value="<?php echo $paper_language; ?>" class="form-control">
           	<input type="hidden" id="div_count" value="1"  class="form-control">
			<br/>  
			<div class="box-body table-responsive no-padding" id="div_1"><br/>
			<input type="hidden"  id="div_id_1" value="1" class="form-control">
              <table class="table table-striped">
			 
			  <tr class="paper_language_tr" style="display:none">
			  <td colspan="4">
			  <h4>Don't Know Hindi Typing? Don't Worry Click Here </h4>
			  <input type="button"  class="btn btn-success" value="click" onclick="hindi_typing_question(1);">
			  <h5 style="display:none" id="suggestion_1">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5>
			 <input type="hidden" id="count_value_1" value="1" ></input>
             <input type="text" id="question_box_1" rows="2" onKeyUp="get_text_question(1)" name="content" class="form-control" style="display:none">
			 </td>
			  </tr>
			   <tr>
                  <th><input style="width:50px" type="text"  id="s_no_1" value="1" class="form-control" readonly style='text-align:center;' /></th>
                  <th></th>
				  <th></th>
				  <td style="float:right;"> <b>Marks</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style="width:65px; float:right;" type="text"  name="long_marks[]" value="" placeholder="Marks" class="form-control" style="margin-top:5px;" required /></td>
				  </tr>
				 <tr>
                 <th colspan="4"><textarea id="editor1_1" style="width:700px" class="form-control editor1_1" name="long_question[]" placeholder="Enter Question" rows="2" required ></textarea></th>
                 </tr>
				 <tr> 
                  <td style="padding-top:25px;">Correct Answer</td>
                  <th></th>
				  <th></th>
				  <th></th>
				  </tr>
			<tr class="paper_language_tr" style="display:none">
			 <td colspan="4">
			  <h4>Don't Know Hindi Typing? Don't Worry Click Here </h4>
			  <input type="button"  class="btn btn-success" value="click" onclick="hindi_typing_answer(1);">
			  <h5 style="display:none" id="suggestion1_1">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5>
			 <input type="hidden" id="count_value1_1" value="1" ></input>
             <input type="text" id="answer_box_1" rows="2" onKeyUp="get_text_answer(1)" name="content" class="form-control" style="display:none">
			</td>
			  </tr>
				  <tr> 
                  <td colspan="4"><textarea id="editor2_1" style="width:700px" class="form-control editor2_1" name="long_correct_answer[]" placeholder="Enter Answer" rows="2" required ></textarea></td>
				  </tr>
				</table><br/>
            </div>
           <br/>
          <!-- /.box-body -->
          </div>
		  <center><input type="submit" class="addButton btn  btn-success" name="other" value="submit" />
			<input type="button" class="addButton btn  btn-success" id="addButton" onclick="main_box9();" value="Add More" /></center><br/>
		 <!-- /.box -->
<script>	
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
