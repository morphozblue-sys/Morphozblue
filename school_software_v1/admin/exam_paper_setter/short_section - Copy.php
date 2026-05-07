<script type="text/javascript">
  function add_more4(){
 var count=document.getElementById('div_count').value;
count=parseInt(count)+parseInt(1);
 $("#div_"+count).show();
$( "#main_box4" ).append("<div class='box-body table-responsive no-padding' id='div_"+count+"'><br/><input type='hidden'  id='div_id_"+count+"' value='0' class='form-control' /><table class='table table-striped'><tr><th style='width:12px'><input style='width:50px' type='text' readonly style='text-align:center;' id='s_no_"+count+"' value='"+count+"' class='form-control my_num' /></th><th><textarea id='editor1_"+count+"' style='width:700px' class='form-control' name='short_question[]' placeholder='Enter Question' rows='4' required ></textarea></th><th style='width:70px'>Marks</th><td style='width:70px'><input style='width:65px' type='text'  name='short_marks[]' value='' placeholder='Marks' class='form-control' style='margin-top:5px;' required /></td></tr><tr><td style='text-align:center; padding-top:25px;'>Correct Answer</td><td><br/><textarea style='width:700px' id='editor2_"+count+"' class='form-control' name='short_correct_answer[]' placeholder='Enter Answer' rows='4' required ></textarea></td><td><br/> <center><input type='button' class='addButton' id='' onclick='for_delete("+count+");' value='Delete' /></center></td></tr></table><br/></div>");
document.getElementById('div_count').value=count;
document.getElementById('div_id_'+count).value=1;
serail_no();
 CKEDITOR.replace('editor1_'+count);
 CKEDITOR.replace('editor2_'+count);
    $('.textarea').wysihtml5();
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
 
          <div class="box" id="main_box4">
            <!-- /.box-header -->
           	<input type="hidden"  id="div_count" value="1"  class="form-control">
			<br/>  
			<div class="box-body table-responsive no-padding" id="div_1"><br/>
			<input type="hidden"  id="div_id_1" value="1" class="form-control">
              <table class="table table-striped">
                <tr>
                  <th style="width:12px"><input style="width:50px" type="text"  id="s_no_1" value="1" class="form-control" readonly style='text-align:center;' /></th>
                  <th><textarea id="editor1_1" style="width:700px" class="form-control" name="short_question[]" placeholder="Enter Question" rows="2" required ></textarea></th>
                  <th style="width:70px">Marks</th>
				  <td style="width:70px"><input style="width:65px" type="text"  name="short_marks[]" value="" placeholder="Marks" class="form-control" style="margin-top:5px;" required /></td>
                 </tr>
                 <tr> 
                  <td style="text-align:center; padding-top:25px;">Correct Answer</td>
                  <td><br/><textarea id="editor2_1" style="width:700px" class="form-control" name="short_correct_answer[]" placeholder="Enter Answer" rows="2" required ></textarea></td>
				  </tr>
				</table><br/>
            </div>
           <br/>
          <!-- /.box-body -->
          </div>
		  <center><input type="submit" class="addButton btn  btn-success" name="short" value="submit" />
			<input type="button" class="addButton btn  btn-success" id="addButton" onclick="add_more4();" value="Add More" /></center><br/>
		 <!-- /.box -->
		
<script>
  $(function () {  
    CKEDITOR.replace('editor1_1')
	CKEDITOR.replace('editor2_1')
    $('.textarea').wysihtml5()
  })
</script>
