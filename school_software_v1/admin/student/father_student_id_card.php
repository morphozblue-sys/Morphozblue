<?php include("../attachment/session.php")?>
<script type="text/javascript">




   function for_list(){ 
			var student_class_section= document.getElementById('student_class_section').value;
			var student_class=	document.getElementById('student_class').value;
	$("#my_table").html(loader_div);
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_parents_student_id_card.php?id="+student_class+"&student_section="+student_class_section+"",
              cache: false,
              success: function(detail){
            $('#my_table').html(detail);
		
              }
           });
		  }
</script>
     <section class="content-header">
      <h1>
         <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
    		<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li class="active"><?php echo $language['Student ID Card']; ?></li>
      </ol>
    </section>
	

	<script type="text/javascript">
   function for_section(value){
          $('#student_class_section').html("<option value='' >Loading....</option>"); 
            var id=value;  
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_class_section_all.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                   
                  $("#student_class_section").html(str);
                   for_list();
              }
           });
}

 
</script>


	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Father Generate ID']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->

						<?php 
				$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$id_card_father_pdf = $row['id_card_father_pdf'];
}	
   ?>
          	
            <div class="box-body "  >
					<form role="form"  method="post" id="my_form" action="<?php echo $pdf_path; ?>id_card_page_father/<?php echo $id_card_father_pdf; ?>" onsubmit="return checked_null_value();" enctype="multipart/form-data" target="_blank">
			
			 <div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control" required>
						       <option value=""><?php echo $language['Select Class']; ?></option>
						       <?php     $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" onchange='for_list();' id="student_class_section" >
						<option value=""><?php echo $language['select']; ?></option>
						 
					    </select>
					</div>
				</div>		
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table">
                <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th><?php echo $language['S No']; ?></th>
				  <th>Admission No.</th>
                  <th><?php echo $language['Student Roll No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Select Student']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                </tr>
                </thead>
				
				<tbody id="example2">
				
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>


<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
