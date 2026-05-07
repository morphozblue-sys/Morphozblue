         <div class="col-md-3 ">				
					<div class="form-group" >
					  <label>student Name <span style="color:red;">*</span></label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value)" required>
					  <option value="">Select student</option>
					        <?php
							include("../../con73/con37.php");
							$qry="select * from student_addmission_info where contact_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name.' '; ?><?php echo "[".$student_class." ".$student_section." ".$student_father_name."".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
				</div>
				
				
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_search_student.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
	
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
        
      
              }
           });

    }
</script>  
				
				<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>