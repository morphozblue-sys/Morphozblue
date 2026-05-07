<?php include("../attachment/session.php"); ?>  
<?php
$student_roll_no=$_GET['id'];
$term=$_GET['term'];


$que15="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";

$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
while($row15=mysqli_fetch_assoc($run15)){

	   $student_name=$row15['student_name'];
	   $student_class_section=$row15['student_class_section'];
	   $student_father_name=$row15['student_father_name'];
	   $student_class=$row15['student_class'];
	   $school_roll_no=$row15['school_roll_no'];
		
	}
$que1="select * from student_physical_fitness where student_roll_no='$student_roll_no' and session_value='$session1'";
$count=0;
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)<1){
$que123="insert into student_physical_fitness(student_roll_no,session_value,$update_by_insert_sql_column)values('$student_roll_no','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que123);
$que1="select * from student_physical_fitness where student_roll_no='$student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
}
while($row1=mysqli_fetch_assoc($run1)){

	   $body_weight_rawscore=$row1[$term.'_body_weight_rawscore'];
	   $body_weight_zone=$row1[$term.'_body_weight_zone'];
	   $body_weight_description=$row1[$term.'_body_weight_description'];

	   $body_height_rawscore=$row1[$term.'_body_height_rawscore'];
	   $body_height_zone=$row1[$term.'_body_height_zone'];
	   $body_height_description=$row1[$term.'_body_height_description'];
	   
	   $pacer_raw_score=$row1[$term.'_pacer_raw_score'];
	   $pacer_zone=$row1[$term.'_pacer_zone'];
	   $pacer_description=$row1[$term.'_pacer_description']; 

	   $trunk_lift_raw_score=$row1[$term.'_trunk_lift_raw_score'];
	   $trunk_lift_zone=$row1[$term.'_trunk_lift_zone'];
	   $trunk_lift_description=$row1[$term.'_trunk_lift_description'];
	   
	   $sit_reach_l_raw_score=$row1[$term.'_sit_reach_l_raw_score'];
	   $sit_reach_l_zone=$row1[$term.'_sit_reach_l_zone'];
	   $sit_reach_l_description=$row1[$term.'_sit_reach_l_description'];
	
	   $sit_reach_r_raw_score=$row1[$term.'_sit_reach_r_raw_score'];
	   $sit_reach_r_zone=$row1[$term.'_sit_reach_r_zone'];
	   $sit_reach_r_description=$row1[$term.'_sit_reach_r_description'];
	  
	   $curl_raw_score=$row1[$term.'_curl_raw_score'];
	   $curl_zone=$row1[$term.'_curl_zone'];
	   $curl_description=$row1[$term.'_curl_description'];
	  
       $standing_raw_score=$row1[$term.'_standing_raw_score'];
       $standing_zone=$row1[$term.'_standing_zone'];
       $standing_description=$row1[$term.'_standing_description'];
	   
	   $count++;
	   }
	   
	   if($count<=0){	   
	   $body_weight_rawscore='';
	   $body_weight_zone='';
	   $body_weight_description='';

	   $body_height_rawscore='';
	   $body_height_zone='';
	   $body_height_description='';
	   
	   $pacer_raw_score='';
	   $pacer_zone='';
	   $pacer_description=''; 

	   $trunk_lift_raw_score='';
	   $trunk_lift_zone='';
	   $trunk_lift_description='';
	   
	   $sit_reach_l_raw_score='';
	   $sit_reach_l_zone='';
	   $sit_reach_l_description='';
	
	   $sit_reach_r_raw_score='';
	   $sit_reach_r_zone='';
	   $sit_reach_r_description='';
	  
	   $curl_raw_score='';
	   $curl_zone='';
	   $curl_description='';
	  
       $standing_raw_score='';
       $standing_zone='';
       $standing_description='';
	  }
	
?>
	 <input type="hidden" name="fitness_test" value="<?php echo $term; ?>" >
		    <div class="box-body col-md-3">
                <div class="form-group">
                  <label>Fitness Test Date</label>
                  <input type="date" name="fitness_test_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
			    <div class="form-group">
                  <label>Student Name</label>
                  <input type="text"  name="student_name" id="student_name" placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Father's Name</label>
                  <input type="text"  name="student_father_name" id="student_father_name" placeholder="Student Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Unique Id</label>
                  <input type="hidden"  name="student_roll_no"   value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
				  <input type="text"  id="student_roll_no"   value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
                </div>
			    <div class="form-group">
                  <label>Student Class</label>
                  <input type="text"  name="student_class" id="student_class" placeholder="Student Class"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Class Section</label>
                  <input type="text"  name="student_class_section" id="student_class_section" placeholder="Student Class section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
				
			
				
			</div>
			<div class="col-md-1">
			</div>
		<div style="border:1px solid" id="fitness_div" class="box-body table-responsive col-md-6" id="example2">
		<center><h4 style="color:red;">Fitness Scores</h4></center>
               <table class="table table-bordered table-striped">
			   <thead >
			     <tr>
				   <th>Part Of Fitness</th>
				   <th>Test</th>
				   <th>Raw Score</th>
				   <th>Zone</th>
				   <th>Description</th>
			     </tr>
			 </thead>
			 <tbody>
			    <tr>
			      <td rowspan="2">Body Composition</td>
			      <td>Body Weight</td>
			      <td><input type="number" id="body_weight" name="body_weight_rawscore" oninput="fitness_detail(this.value,this.id)" value="<?php echo $body_weight_rawscore; ?>" class="form-control"></td>
			      <td><input type="text" id="body_weight_zone" name="body_weight_zone" value="<?php echo $body_weight_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" id="body_weight_description" name="body_weight_description" value="<?php echo $body_weight_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			       <td>Body Height</td>
			      <td><input type="number" oninput="fitness_detail(this.value,this.id)" id="body_height" value="<?php echo $body_height_rawscore; ?>" name="body_height_rawscore" class="form-control"></td>
			      <td><input type="text" id="body_height_zone" name="body_height_zone" value="<?php echo $body_height_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" id="body_height_description" name="body_height_description" value="<?php echo $body_height_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td>Cardio Resiratory Endurance</td>
			      <td>Pacer(20m)</td>
			      <td><input type="number" oninput="fitness_detail(this.value,this.id)" name="pacer_raw_score" value="<?php echo $pacer_raw_score; ?>" id="pacer" class="form-control"></td>
			      <td><input type="text" id="pacer_zone" name="pacer_zone" value="<?php echo $pacer_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" id="pacer_description" name="pacer_description" value="<?php echo $pacer_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td rowspan="3">Flexibility</td>
			      <td>Trunk Lift</td>
			      <td><input type="number" oninput="fitness_detail(this.value,this.id)" value="<?php echo $trunk_lift_raw_score; ?>" id="trunk_lift" name="trunk_lift_raw_score" class="form-control"></td>
			      <td><input type="text"  id="trunk_lift_zone" value="<?php echo $trunk_lift_zone; ?>" name="trunk_lift_zone" class="form-control" readonly></td>
			      <td><input type="text" id="trunk_lift_description" name="trunk_lift_description" value="<?php echo $trunk_lift_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td>Sit And reach(L)</td>
			      <td><input type="number" name="sit_reach_l_raw_score" oninput="fitness_detail(this.value,this.id)" id="sit_reach_l" value="<?php echo $sit_reach_l_raw_score; ?>" class="form-control"></td>
			      <td><input type="text" name="sit_reach_l_zone" id="sit_reach_l_zone" value="<?php echo $sit_reach_l_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" name="sit_reach_l_description" id="sit_reach_l_description" value="<?php echo $sit_reach_l_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td>Sit And reach(R)</td>
			      <td><input type="number" name="sit_reach_r_raw_score" id="sit_reach_r" oninput="fitness_detail(this.value,this.id)" value="<?php echo $sit_reach_r_raw_score; ?>" class="form-control"></td>
			      <td><input type="text" name="sit_reach_r_zone" id="sit_reach_r_zone" value="<?php echo $sit_reach_r_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" name="sit_reach_r_description" id="sit_reach_r_description" value="<?php echo $sit_reach_r_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td>Muscular Endurance</td>
			      <td>Curl-ups</td>
			      <td><input type="number" name="curl_raw_score" id="curl_ups" value="<?php echo $curl_raw_score; ?>" oninput="fitness_detail(this.value,this.id)" class="form-control"></td>
			      <td><input type="text" name="curl_zone" id="curl_zone" value="<?php echo $curl_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" name="curl_description" id="curl_description" value="<?php echo $curl_description; ?>" class="form-control" readonly></td>
			    </tr>
				<tr>
			      <td>Muscular Strength</td>
			      <td>Standing Long Jump</td>
			      <td><input type="number" name="standing_raw_score" id="standing_raw" oninput="fitness_detail(this.value,this.id)" value="<?php echo $standing_raw_score; ?>" class="form-control"></td>
			      <td><input type="text" name="standing_zone" id="standing_zone" value="<?php echo $standing_zone; ?>" class="form-control" readonly></td>
			      <td><input type="text" name="standing_description" id="standing_description" value="<?php echo $standing_description; ?>" class="form-control" readonly></td>
			    </tr>
			 </tbody>
			   </table>
		</div>