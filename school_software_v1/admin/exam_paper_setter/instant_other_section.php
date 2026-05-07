<?php 
$paper_language=$_GET['paper_language']; 

//$paper_language='Hindi'; 
?>
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
        var ids = ["question_box_1","answer_box_1"];
        transliterationControl.makeTransliteratable(ids);
       
      }
onLoad();
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
				  <td style="float:right;"> <b>Marks</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input style="width:65px; float:right;" type="text"  name="long_marks" value="" placeholder="Marks" class="form-control" style="margin-top:5px;" required /></td>
				  </tr>
				 <tr>
                 <th colspan="4"><textarea id="editor1_1" style="width:700px" class="form-control editor1_1" name="long_question" placeholder="Enter Question" rows="2" required ></textarea></th>
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
                  <td colspan="4"><textarea id="editor2_1" style="width:700px" class="form-control editor2_1" name="long_correct_answer" placeholder="Enter Answer" rows="2" required ></textarea></td>
				  </tr>
				</table><br/>
            </div>
           <br/>
          <!-- /.box-body -->
          </div>
		  
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
