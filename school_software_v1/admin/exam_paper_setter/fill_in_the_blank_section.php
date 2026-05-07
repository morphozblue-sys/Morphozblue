 <?php 
 $paper_language=$_GET['paper_language']; 
$options=$_GET['options']; 
// $options='5'; 

//$paper_language='Hindi'; 
?>
<script type="text/javascript">
  function add_more3(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box3" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /> <br/><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></td></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"'  name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer1_"+count+"' name='answer_1[]' value='' placeholder='Enter Answer 1st' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer2_"+count+"' name='answer_2[]' value='' placeholder='Enter Answer 2nd' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td><td colspan='2'><input style='width:150px' type='text' id='answer3_"+count+"' name='answer_3[]' value='' placeholder='Enter Answer 3rd' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer4_"+count+"' name='answer_4[]' value='' placeholder='Enter Answer 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td><td colspan='2'><input style='width:150px' type='text' id='answer5_"+count+"' name='answer_5[]' value='' placeholder='Enter Answer 5th' class='form-control'  /></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options1').value;
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

		
				  <div class="box" id="main_box3">
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
						  <th><textarea style="width:700px" id="text_area_1" class="form-control" name="question[]" placeholder="Enter Question" rows="4" required></textarea></th>
						  <th>Marks</th>
						  <td><input style="width:65px" type="text"  name="marks[]" value="" placeholder="Marks" class="form-control" required /></td>
						</tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">A.</td>
						  <td><input style="width:700px" type="text" id="option1_1"  name="option_1[]" value="" placeholder="Enter option 1st" class="form-control" required /></td>
						   <td colspan="2"><input style="width:150px" type="text" id="answer1_1" name="answer_1[]" value="" placeholder="Enter Answer 1st" class="form-control"  /></td>
						 </tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">B.</td>
						  <td><input style="width:700px" type="text" id="option2_1" name="option_2[]" value="" placeholder="Enter option 2nd" class="form-control" required /></td>
						   <td colspan="2"><input style="width:150px" type="text" id="answer2_1" name="answer_2[]" value="" placeholder="Enter Answer 2nd" class="form-control"  /></td>
					 </tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">C.</td>
						  <td><input style="width:700px" type="text" id="option3_1" name="option_3[]" value="" placeholder="Enter option 3rd" class="form-control" required /></td>
						   <td colspan="2"><input style="width:150px" type="text" id="answer3_1" name="answer_3[]" value="" placeholder="Enter Answer 3rd" class="form-control"  /></td>
						</tr>
						<tr style="display:none;" id="option_tr1_1">
						  <td style="text-align:center; padding-top:15px;">D.</td>
						  <td><input style="width:700px" type="text" id="option4_1" name="option_4[]" value="" placeholder="Enter option 4th" class="form-control"  /></td>
						   <td colspan="2"><input style="width:150px" type="text" id="answer4_1" name="answer_4[]" value="" placeholder="Enter Answer 4th" class="form-control"  /></td>
						</tr>
						<tr style="display:none;" id="option_tr2_1">
						  <td style="text-align:center; padding-top:15px;">E.</td>
						  <td><input style="width:700px" type="text" id="option5_1" name="option_5[]" value="" placeholder="Enter option 5th" class="form-control"  /></td>
						    <td colspan="2"><input style="width:150px" type="text" id="answer5_1" name="answer_5[]" value="" placeholder="Enter Answer 5th" class="form-control"  /></td>
						</tr>

							
					  </table><br/>
					</div>
					<br/>
				
            <!-- /.box-body -->
                 </div>
				  <center><input type="submit" class="addButton btn  btn-success" name="fill_blank" value="submit"  />
					<input type="button" class="addButton btn  btn-success" id="addButton" onclick="add_more3();" value="Add More" /></center><br/>
					
   <script>	     

   var options2=document.getElementById('options1').value;
   if(options2=='4'){
   $('#option_tr1_1').show();
   $('#option4_1').prop('required',true);
   $('#answer4_1').prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_1').show();
    $('#option_tr2_1').show();
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
        var ids = ["text_area_1","option1_1","option2_1","option3_1","option4_1","option5_1","answer1_1","answer2_1","answer3_1","answer4_1","answer5_1","text_area_2","option1_2","option2_2","option3_2","option4_2","option5_2","answer1_2","answer2_2","answer3_2","answer4_2","answer5_2","text_area_3","option1_3","option2_3","option3_3","option4_3","option5_3","answer1_3","answer2_3","answer3_3","answer4_3","answer5_3","text_area_4","option1_4","option2_4","option3_4","option4_4","option5_4","answer1_4","answer2_4","answer3_4","answer4_4","answer5_4","text_area_5","option1_5","option2_5","option3_5","option4_5","option5_5","answer1_5","answer2_5","answer3_5","answer4_5","answer5_5","text_area_6","option1_6","option2_6","option3_6","option4_6","option5_6","answer1_6","answer2_6","answer3_6","answer4_6","answer5_6","text_area_7","option1_7","option2_7","option3_7","option4_7","option5_7","answer1_7","answer2_7","answer3_7","answer4_7","answer5_7","text_area_8","option1_8","option2_8","option3_8","option4_8","option5_8","answer1_8","answer2_8","answer3_8","answer4_8","answer5_8","text_area_9","option1_9","option2_9","option3_9","option4_9","option5_9","answer1_9","answer2_9","answer3_9","answer4_9","answer5_9","text_area_10","option1_10","option2_10","option3_10","option4_10","option5_10","answer1_10","answer2_10","answer3_10","answer4_10","answer5_10","text_area_11","option1_11","option2_11","option3_11","option4_11","option5_11","answer1_11","answer2_11","answer3_11","answer4_11","answer5_11","text_area_12","option1_12","option2_12","option3_12","option4_12","option5_12","answer1_12","answer2_12","answer3_12","answer4_12","answer5_12","text_area_13","option1_13","option2_13","option3_13","option4_13","option5_13","answer1_13","answer2_13","answer3_13","answer4_13","answer5_13","text_area_14","option1_14","option2_14","option3_14","option4_14","option5_14","answer1_14","answer2_14","answer3_14","answer4_14","answer5_14","text_area_15","option1_15","option2_15","option3_15","option4_15","option5_15","answer1_15","answer2_15","answer3_15","answer4_15","answer5_15"];
        transliterationControl.makeTransliteratable(ids);


      }
      onLoad();

      google.setOnLoadCallback(onLoad);
	
}else{

}

 
</script>	
	