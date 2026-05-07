 <?php 
 $paper_language=$_GET['paper_language']; 
$options=$_GET['options']; 
// $options='5'; 

//$paper_language='Hindi'; 
?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
	
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	 <script type="text/javascript">

</script>
		
				  <div class="box" id="main_box6">
					<!-- /.box-header -->
					<input type="hidden" id="paper_language1" value="<?php echo $paper_language;?>" class="form-control">
					<input type="hidden" id="options1" value="<?php echo $options;?>" class="form-control">
					<input type="hidden"  id="div_count" value="1"  class="form-control">
					<br/>  
					<div class="box-body table-responsive no-padding" id="div_1" ><br/>
					<input type="hidden"  id="div_id_1" value="1" class="form-control">
					  <table class="table table-striped">
						<tr>
						  <th style="width:20px"><input style="width:50px" type="text"  id="s_no_1" value="1" class="form-control" readonly style='text-align:center;' /></th>
						  <th><textarea style="width:700px" id="text_area_1" class="form-control" name="question" placeholder="Enter Question" rows="8" required></textarea></th>
						  <th>Marks</th>
						  <td><input style="width:65px" type="text"  name="marks" value="" placeholder="Marks" class="form-control" required /></td>
						</tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">Que. 1.</td>
						  <td><input style="width:700px" type="text" id="option1_1"  name="option_1" value="" placeholder="Enter Question 1st" class="form-control" required /></td>
						 </tr>
						 <tr>
						  <td style="text-align:center; padding-top:15px;">Ans.</td>
						   <td><input style="width:700px" type="text" id="answer1_1" name="answer_1" value="" placeholder="Enter Answer 1st" class="form-control"  /></td>
						 </tr>
						 
						<tr>
						  <td style="text-align:center; padding-top:15px;">Que. 2.</td>
						  <td><input style="width:700px" type="text" id="option2_1" name="option_2" value="" placeholder="Enter Question 2nd" class="form-control" required /></td>
                       </tr>
					   <tr>
						  <td style="text-align:center; padding-top:15px;">Ans.</td>
						  <td><input style="width:700px" type="text" id="answer2_1" name="answer_2" value="" placeholder="Enter Answer 2nd" class="form-control"  /></td>
					   </tr>
					 
						<tr>
						  <td style="text-align:center; padding-top:15px;">Que. 3.</td>
						  <td><input style="width:700px" type="text" id="option3_1" name="option_3" value="" placeholder="Enter Question 3rd" class="form-control" required /></td>
						</tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">Ans.</td>
						   <td><input style="width:700px" type="text" id="answer3_1" name="answer_3" value="" placeholder="Enter Answer 3rd" class="form-control"  /></td>
						</tr>
						
						
						<tr style="display:none;" id="option_tr1_1">
						  <td style="text-align:center; padding-top:15px;">Que. 4.</td>
						  <td><input style="width:700px" type="text" id="option4_1" name="option_4" value="" placeholder="Enter Question 4th" class="form-control"  /></td>
						</tr>
						<tr style="display:none;" id="option_tr11_1">
						  <td style="text-align:center; padding-top:15px;">Ans.</td>
						   <td><input style="width:700px" type="text" id="answer4_1" name="answer_4" value="" placeholder="Enter Answer 4th" class="form-control"  /></td>
						</tr>
						
						
						<tr style="display:none;" id="option_tr2_1">
						  <td style="text-align:center; padding-top:15px;">Que. 5.</td>
						  <td><input style="width:700px" type="text" id="option5_1" name="option_5" value="" placeholder="Enter Question 5th" class="form-control"  /></td>
						</tr>
						<tr style="display:none;" id="option_tr22_1">
						  <td style="text-align:center; padding-top:15px;">Ans.</td>
						    <td><input style="width:700px" type="text" id="answer5_1" name="answer_5" value="" placeholder="Enter Answer 5th" class="form-control"  /></td>
						</tr>

							
					  </table><br/>
					</div>
					<br/>
				
            <!-- /.box-body -->
                 </div>
				 
					
   <script>	     

   var options2=document.getElementById('options1').value;
   if(options2=='4'){
   $('#option_tr1_1').show();
   $('#option_tr11_1').show();
   $('#option4_1').prop('required',true);
   $('#answer4_1').prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_1').show();
    $('#option_tr11_1').show();
    $('#option_tr2_1').show();
    $('#option_tr22_1').show();
	 $('#option4_1').prop('required',true);
	 $('#answer4_1').prop('required',true);
	 $('#option5_1').prop('required',true);
	 $('#answer5_1').prop('required',true);
   }
   
var paper_language2=document.getElementById('paper_language1').value;
if(paper_language2=='Hindi'){

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
        var ids = ["text_area_1","option1_1","option2_1","option3_1","option4_1","option5_1","answer1_1","answer2_1","answer3_1","answer4_1","answer5_1"];
        transliterationControl.makeTransliteratable(ids);


      }
onLoad();
      google.setOnLoadCallback(onLoad);
	
}else{

}

 
</script>	
	