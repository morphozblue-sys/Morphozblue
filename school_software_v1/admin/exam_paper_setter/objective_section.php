 <?php 
 $paper_language=$_GET['paper_language']; 
$options=$_GET['options']; 

?>
<script type="text/javascript">
  function add_more_objective(){
 var count=document.getElementById('div_count').value;
 if(count>14){
 alert_new('You Can not add more than 15 question in one shot ','red');
 }else{
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box1" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control'><table class='table table-striped'><tr><th style='width:20px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea style='width:700px' class='form-control' id='text_area_"+count+"' name='question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input type='text'  name='marks[]' value='' placeholder='Marks' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>A.</td><td><input style='width:700px' type='text' id='option1_"+count+"' name='option_1[]' value='' placeholder='Enter option 1st' class='form-control' required /></td></tr><tr><td style='text-align:center; padding-top:15px;'>B.</td><td><input style='width:700px' type='text' id='option2_"+count+"' name='option_2[]' value='' placeholder='Enter option 2nd' class='form-control' required /></td><td><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></center></td></tr><tr><td style='text-align:center; padding-top:15px;'>C.</td><td><input style='width:700px' type='text' id='option3_"+count+"' name='option_3[]' value='' placeholder='Enter option 3rd' class='form-control' required /></td></tr><tr style='display:none;' id='option_tr1_"+count+"'><td style='text-align:center; padding-top:15px;'>D.</td><td><input style='width:700px' type='text' id='option4_"+count+"' name='option_4[]' value='' placeholder='Enter option 4th' class='form-control'  /></td></tr><tr style='display:none;' id='option_tr2_"+count+"'><td style='text-align:center; padding-top:15px;'>E.</td><td><input style='width:700px' type='text' id='option5_"+count+"' name='option_5[]' value='' placeholder='Enter option 5th' class='form-control'  /></td></tr><tr><td style='text-align:center; padding-top:21px;'>Correct Answer</td><td><br/><select style='width:700px' name='correct_answer[]' class='form-control' required ><option value=''>Select</option><option value='A'>A</option><option value='B'>B</option><option value='C'>C</option><option id='option_value4_"+count+"' style='display:none;'  value='D'>D</option><option id='option_value5_"+count+"' style='display:none;'  value='E'>E</option></select></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();

   var options2=document.getElementById('options1').value;
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



		
				  <div class="box" id="main_box1">
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
						  <th style="width:70px">Marks</th>
						  <td style="width:70px"><input style="width:65px" type="text"  name="marks[]" value="" placeholder="Marks" class="form-control" required /></td>
						</tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">A.</td>
						  <td><input style="width:700px" type="text" id="option1_1"  name="option_1[]" value="" placeholder="Enter option 1st" class="form-control" required /></td>
						 </tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">B.</td>
						  <td><input style="width:700px" type="text" id="option2_1" name="option_2[]" value="" placeholder="Enter option 2nd" class="form-control" required /></td>
					 </tr>
						<tr>
						  <td style="text-align:center; padding-top:15px;">C.</td>
						  <td><input style="width:700px" type="text" id="option3_1" name="option_3[]" value="" placeholder="Enter option 3rd" class="form-control" required /></td>
						</tr>
						<tr style="display:none;" id="option_tr1_1">
						  <td style="text-align:center; padding-top:15px;">D.</td>
						  <td><input style="width:700px" type="text" id="option4_1" name="option_4[]" value="" placeholder="Enter option 4th" class="form-control"  /></td>
						</tr>
						<tr style="display:none;" id="option_tr2_1">
						  <td style="text-align:center; padding-top:15px;">E.</td>
						  <td><input style="width:700px" type="text" id="option5_1" name="option_5[]" value="" placeholder="Enter option 5th" class="form-control"  /></td>
						</tr>
					<tr>
						  <td style="text-align:center; padding-top:21px;">Correct Answer</td>
						  <td><br/><select style="width:700px" name="correct_answer[]" class="form-control" required >
							  <option value="">Select</option>
							  <option value="A">A</option>
							  <option value="B">B</option>
							  <option value="C">C</option>
							  <option id="option_value4_1" style="display:none;"  value="D">D</option>
							  <option id="option_value5_1" style="display:none;"  value="E">E</option>
							  </select></td>
						</tr>
							
					  </table><br/>
					</div>
					<br/>
				
            <!-- /.box-body -->
                 </div>
				  <center><input type="submit"  class="addButton btn  btn-success" name="objective" value="submit"  />
					<input type="button" class="addButton btn  btn-success" id="addButton" onclick="add_more_objective();" value="Add More" /></center><br/>
					
   <script>	     

   var options2=document.getElementById('options1').value;
   if(options2=='4'){
   $('#option_tr1_1').show();
   $('#option_value4_1').show();
   $('#option4_1').prop('required',true);
   } 
   else if(options2=='5'){
    $('#option_tr1_1').show();
    $('#option_tr2_1').show();
	 $('#option_value4_1').show();
	 $('#option_value5_1').show();
	 $('#option4_1').prop('required',true);
	 $('#option5_1').prop('required',true);
   }
   

</script>	
	