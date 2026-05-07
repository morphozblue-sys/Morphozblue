<?php include("../attachment/session.php")?>
  	<script type="text/javascript">
   function for_section(value){
            var id=value;  
       $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                   // alert_new(str);
                  $("#student_class_section1").html(str);
              }
           });
   }
   
function for_mapping(){
      var student_class1=document.getElementById('student_class1').value;
      var student_class_section1=document.getElementById('student_class_section1').value;
	  //alert_new(student_class_section1);
   if(student_class1!='' && student_class_section1!=''){
       $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_mapping_list.php?student_class1="+student_class1+"&student_class_section1="+student_class_section1+"",
              cache: false,
              success: function(detail){
			 //alert_new(detail);
			 $('#mapping_student_list').html(detail);
              }
           });
	  }else if(student_class1=='All'){
	   $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_mapping_list.php?student_class1="+student_class1+"&student_class_section1="+student_class_section1+"",
              cache: false,
              success: function(detail){
			 //alert_new(detail);
			 $('#mapping_student_list').html(detail);
              }
           });
	  }
   } 
   
   function for_check(id){
   if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
   }
   
   function validation(){
   var add=0;
   $(".checked1").each(function() {
	if($(this).prop("checked") == true){
	add=add+1;
	}
	});
	if(add>0){
	return true;
	}else{
	alert_new("Please Select Atleast One Student !!!",'red');
	return false;
	}
   }
   </script>


    <section class="content-header">
      <h1>
        <?php echo $language['Goverment Requirement Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('govt_requirement/govt_requirement')"><i class="fa fa-stack-overflow"></i> <?php echo $language['Govt. Requir.']; ?></a></li>
	  <li class="active"><?php echo $language['Mapping List']; ?></li>
      </ol>
    </section>

	
	
	<!---*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Mapping List']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
			<div class="box-body">
			<form method='post' onsubmit="return validation();" action="../../pdf/pdf/govt_requirement/mapping_list_pdf.php">
			<div class="col-md-6">
			    <div class="col-md-6">	
					<div class="form-group">
					    <label><?php echo $language['Class']; ?></label>
					    <select name="student_class" onchange="for_section(this.value);for_mapping();" id="student_class1" class="form-control" required>
						       <option value="">Select Class</option>
							    <option value="All">All</option>
						       <?php  $que="select * from school_info_class_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $class_name=$row['class_name']; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-6">	
					<div class="form-group">
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" onchange="for_mapping();" id="student_class_section1" >
						<option value="">select</option>
						</select>
					</div>
				</div>
				<div class="col-md-12" id="mapping_student_list">
				  
				</div>
				</div>
				<div class="col-md-12 ">	
					<input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary">
				</div></br></br>
		
		</form>	
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

	

<?php
include("../../con73/con37.php");

	if(isset($_POST['submit'])){
	
	$student_class=$_POST['student_class'];
	$student_class_section=$_POST['student_class_section'];
	$checked=$_POST['check'];
	
	if($student_class=='All'){
	echo "<script>window.open('../../pdf/pdf/govt_requirement/mapping_list_pdf.php?class=$student_class&section=$student_class_section&check=$checked','_blank');</script>";
	
     }else{
	   echo "<script>window.open('../../pdf/pdf/govt_requirement/mapping_list_pdf_class_wise.php?class=$student_class&section=$student_class_section','_blank');</script>";
	 
	 }
	 }
