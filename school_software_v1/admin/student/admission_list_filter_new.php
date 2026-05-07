  <script>
  function  for_list(){
  if (document.getElementById('g1').checked) {
  var gender = document.getElementById('g1').value;
  }else if (document.getElementById('g2').checked) {
  var gender = document.getElementById('g2').value;
  }else if (document.getElementById('g3').checked) {
  var gender = document.getElementById('g3').value;
  }else if (document.getElementById('g4').checked) {
  var gender = document.getElementById('g4').value;
  }
   
  if (document.getElementById('r1').checked) {
  var religion = document.getElementById('r1').value;
  }else if (document.getElementById('r2').checked) {
  var religion = document.getElementById('r2').value;
  }else if (document.getElementById('r3').checked) {
  var religion = document.getElementById('r3').value;
  }else if (document.getElementById('r4').checked) {
  var religion = document.getElementById('r4').value;
  }else if (document.getElementById('r5').checked) {
  var religion = document.getElementById('r5').value;
  }else if (document.getElementById('r6').checked) {
  var religion = document.getElementById('r6').value;
  }else if (document.getElementById('r7').checked) {
  var religion = document.getElementById('r7').value;
  }else if (document.getElementById('r8').checked) {
  var religion = document.getElementById('r8').value;
  }
  if (document.getElementById('c1').checked) {
  var caste = document.getElementById('c1').value;
  }else if (document.getElementById('c2').checked) {
  var caste = document.getElementById('c2').value;
  }else if (document.getElementById('c3').checked) {
  var caste = document.getElementById('c3').value;
  }else if (document.getElementById('c4').checked) {
  var caste = document.getElementById('c4').value;
  }else if (document.getElementById('c5').checked) {
  var caste = document.getElementById('c5').value;
  }else if (document.getElementById('c6').checked) {
  var caste = document.getElementById('c6').value;
  }
 
  var age=document.getElementById('a').value;
  var scheme=document.getElementById('student_admission_scheme').value;
  var type=document.getElementById('student_admission_type').value;
  var student_class=document.getElementById('student_class').value;
  var student_class_stream=document.getElementById('student_class_stream').value;
  var student_class_group=document.getElementById('student_class_group').value;
  var student_class_section=document.getElementById('student_class_section').value;
  var bus_fee_category_name=document.getElementById('bus_fee_category_name').value;
  
  var sort_by=document.getElementById('sort_by').value;
       var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"student/student_admission_list_fatch_new.php?gender="+gender+"&student_class_group="+student_class_group+"&student_class_stream="+student_class_stream+"&religion="+religion+"&caste="+caste+"&age="+age+"&scheme="+scheme+"&type="+type+"&student_class="+student_class+"&student_class_section="+student_class_section+"&bus_fee_category_name="+bus_fee_category_name+"&sort_by="+sort_by+"",
                    type:"post"
                }
            });
  
  /*$.ajax({
  
		  type: "POST",
		  url: access_link+"student/ajax_filter_student_admission_list.php?gender="+gender+"&student_class_group="+student_class_group+"&student_class_stream="+student_class_stream+"&religion="+religion+"&caste="+caste+"&age="+age+"&scheme="+scheme+"&type="+type+"&student_class="+student_class+"&student_class_section="+student_class_section+"&bus_fee_category_name="+bus_fee_category_name+"&sort_by="+sort_by+"",
		  cache: false,
		  success: function(detail){
		$('#search_list').html(detail);
		$('#example1').DataTable();
		  }
	   });
*/
  
  }
  </script>
  <script>	
function for_stream(value2){
if(value2=="11TH" || value2=="12TH" || value2=="13TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
}
}
function get_group(value1){
         if(value1!='All'){
              $('#student_class_group').html("<option value='' >Loading....</option>"); 
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_stream_group_all.php?stream_name="+value1+"",
              cache: false,
              success: function($detail1){
                   var str1 =$detail1;                
        
                  $("#student_class_group").html(str1);
              }
           });
}else{
$("#student_class_group").html('');
}
    }
</script>
    <script type="text/javascript">
   function for_section(value){
        $('#student_class_section').html("<option value='' >Loading....</option>"); 
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_class_section_all.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                 
                  $("#student_class_section").html(str);
				 
              }
           });

    }
</script>
		

                        <div class="input-group-btn" >
						  <select  name="sort_by" class="btn btn-info " id="sort_by" onchange="for_list();" >
						  <option value=" ORDER BY s_no DESC">Sort By</option>
						  <option value=" ORDER BY student_name ASC">Name</option>
						  <option value=" ORDER BY CAST(class_code_no AS UNSIGNED)  ASC">Classwise</option>
						  <option value=" ORDER BY student_class_section ASC">Section</option>
						  <option value=" ORDER BY student_father_name ASC">Father</option>
						  <option value=" ORDER BY school_roll_no ASC">Roll No.</option>
						  <option value=" ORDER BY CAST(student_date_of_admission AS UNSIGNED) ASC">Roll No.</option>
						  <option value=" ORDER BY student_class,CAST(school_roll_no AS UNSIGNED) ASC">Roll No. & Class</option>
						  </select>
						 <a href="javascript:get_content('student/student_admission_list')"><button style="float:right;" type="button" class="btn btn-info my_background_color" ><?php echo $language['Reset']; ?></button></a>
						<button style="float:right;" type="button" class="btn btn-info" onclick="myFunction()" data-toggle="collapse" data-target="#demo"><?php echo $language['Filter']; ?></button>
						</div>
					
					 
			<form  oninput="x.value=parseInt(a.value)" id="demo" class="collapse" method="post">
					
		
				 
				<div class="col-md-4 ">				
					 <div class="form-group" >
						<label ><?php echo $language['Class']; ?></label><br>
						 <select name="student_class" onchange="for_section(this.value);for_list();for_stream(this.value);" id="student_class" class="form-control" required>
						<option value="All">All</option>
						       <?php  	   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-4 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label >Stream<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_list();" required>
					           <option  value="All">All</option>
						       <?php  $que="select stream_name from school_info_stream_info where stream_name!=''";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name']; ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } ?>
					    </select>
					  </select>
					</div>
				</div>
								<div class="col-md-4 " id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label >Group<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange='for_list();' required>
						<option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
						<label ><?php echo $language['Section']; ?></label><br>
						  <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();' required>
					     <option value="All">All</option>
					    </select>
					</div>
				</div>
			    <div class="col-md-4 ">				
					 <div class="form-group" >
						<label ><?php echo $language['Gender']; ?></label><br>
						<div class="form-control">
							<input type="radio" name="student_gender" onclick="for_list();" id="g3" value="Both" checked>&nbsp;&nbsp;<b>Both</b>
							<input type="radio" name="student_gender" onclick="for_list();" id="g1" value="Male">&nbsp;&nbsp;<b>Male</b>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="student_gender" onclick="for_list();" id="g2" value="Female">&nbsp;&nbsp;<b>Female</b>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="student_gender" onclick="for_list();" id="g4" value="Other">&nbsp;&nbsp;<b>Other</b>&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
					</div>
				</div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label ><?php echo $language['Religion']; ?></label><br>
						<div class="form-control">
							<input type="radio" name="student_religion" onclick="for_list();" id="r5" value="All" checked>&nbsp;&nbsp;<b>All</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r1" value="Hindu">&nbsp;<b>Hindu</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r2" value="Muslim">&nbsp;<b>Muslim</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r3" value="Sikh">&nbsp;<b>Sikh</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r4" value="Christian">&nbsp;<b>Christian</b>
								<input type="radio" name="student_religion" onclick="for_list();" id="r7" value="Jain">&nbsp;<b>Jain</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r8" value="Buddh">&nbsp;<b>Buddh</b>
							<input type="radio" name="student_religion" onclick="for_list();" id="r6" value="Other">&nbsp;<b>Other</b>
							
						</div>
					</div>
				</div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label ><?php echo $language['Catagory']; ?></label><br>
						<div class="form-control">
							<input type="radio" name="student_category" onclick="for_list();" id="c5" value="All" checked>&nbsp;<b>All</b>
							<input type="radio" name="student_category" onclick="for_list();" id="c1" value="General">&nbsp;<b>General</b>&nbsp;
							<input type="radio" name="student_category" onclick="for_list();" id="c2" value="OBC">&nbsp;<b>OBC</b>&nbsp;
							<input type="radio" name="student_category" onclick="for_list();" id="c3" value="SC">&nbsp;<b>SC</b>&nbsp;
							<input type="radio" name="student_category" onclick="for_list();" id="c4" value="ST">&nbsp;<b>ST</b>&nbsp;
							<input type="radio" name="student_category" onclick="for_list();" id="c6" value="Other">&nbsp;<b>Other</b>&nbsp;
							
						</div>
					</div>
				</div>
				<div class="col-md-4 ">				
					 <div class="form-group" >
					  <label ><?php echo $language['Scheme']; ?></label>
					  <select class="form-control" name="student_admission_scheme" id="student_admission_scheme" onchange="for_list();" >
					  <option value="All">All</option>
					  <option value="NON-RTE">NON-RTE</option>
					  <option value="RTE">RTE</option>
					  </select>
					</div>
				 </div>
			
				<div class="col-md-4 ">				
					<div class="form-group" >
						  <label ><?php echo $language['Admission Type']; ?></label>
						  <select class="form-control" name="student_admission_type" id="student_admission_type" onchange="for_list();" >
						  <option value="All">All</option>
						  <option value="Regular">Regular</option>
						  <option value="Private">Private</option>
						  </select>
					</div>
				</div>
				<div class="col-md-4 ">
					 <label><?php echo $language['Age (In Years)']; ?></label>
					 <div class="input-group">
					<input style="width:100%;" type="range" name="student_date_of_birth" id="a" value="0" oninput="for_list();" >
					 <span class="input-group-addon" style="padding:0px;">
					 <input style="color:red;font-size:20px;width:100px;" name="x" style="border:none;" >
					 </span>
					</div>
				</div>
				<div class="col-md-4">
					 <label>Bus Category</label>
				     <select class="form-control select2" name="bus_fee_category_name" id="bus_fee_category_name" style="width:100%" onchange="for_list();">
					           <option  value="All">All</option>
						       <?php
								$query18="select bus_fee_category_name,bus_fee_category_code from bus_fee_category where bus_fee_category_name!=''";
								$run18=mysqli_query($conn73,$query18) or die(mysqli_error($conn73));
								while($row=mysqli_fetch_assoc($run18)){
								$bus_fee_category_name=$row['bus_fee_category_name'];
								$bus_fee_category_code=$row['bus_fee_category_code'];
								?>
								<option value="<?php echo $bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
								<?php } ?>
					 </select>
				</div>
				
		</form>	
    <?php
									$query181="select * from school_info_class_info";
								$run181=mysqli_query($conn73,$query181) or die(mysqli_error($conn73));
								while($row1=mysqli_fetch_assoc($run181)){
								$class_code_no=$row1['class_code_no'];
								$class_name=$row1['class_name'];
								$wyyw="update student_admission_info set class_code_no='$class_code_no' where student_class='$class_name'";
								mysqli_query($conn73,$wyyw);
								}
								?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>			