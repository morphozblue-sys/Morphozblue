<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
   function for_list(){ 
			var student_class_section= document.getElementById('student_class_section').value;
			var student_class=	document.getElementById('student_class').value;
			var student_identity_category=document.getElementById('student_identity_category').value;
			
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
			$("#my_table").html(loader_div);
       $.ajax({
			  type: "POST",
              url:  access_link+"student/ajax_student_id_card.php?id="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&student_section="+student_class_section+"&student_identity_category="+student_identity_category+"",
              cache: false,
              success: function(detail){
            $('#my_table').html(detail);
              }
           });     
    }
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
            for_stream(value);
              }
           });
}

   function for_stream(value2){
if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
}
$("#student_class_stream").val('All');
$("#student_class_group").val('All');
}

function get_group(value1){
if(value1!='All'){
$('#student_class_group').html("<option value='' >Loading....</option>"); 
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_stream_group_all.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){
                  $("#student_class_group").html(detail1);
              }
           });
}else{
$("#student_class_group").html("<option value='All'>All</option>");
}
} 

</script>
    <!-- Content Header (Page header) -->
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
	


	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Student Roll No']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			<?php 
				$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$id_card_student_pdf = $row['id_card_student_pdf'];
}	
   ?>
            <div class="box-body">
			<form role="form"  method="post" id="my_form" action="<?php echo $pdf_path; ?>id_card_page/<?php echo $id_card_student_pdf; ?>" onsubmit="return checked_null_value();" enctype="multipart/form-data" target="_blank">
			
			    <div class="col-md-3">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control" required>
						       <option value=""><?php echo $language['Select Class']; ?></option>
						       <option value="all">All</option>
						       <?php $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
					
				<div class="col-md-3 " id="student_class_stream_div" style="display:none;">
					    <label >Stream</label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);" >
					           <option value="All">All</option>
						       <?php  $que="select stream_name from school_info_stream_info where stream_name!=''";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name']; ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } ?>
					    </select>
				</div>
				<div class="col-md-3 " id="student_class_group_div" style="display:none;">
					  <label >Group</label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange='for_search11();' >
						<option value="All">All</option>
					    </select>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" onchange='' id="student_class_section" >
						<option value=""><?php echo $language['select']; ?></option>
					    </select>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
					    <label>Student Identity Category</label>
					    <select class="form-control" name="student_identity_category" onchange='' id="student_identity_category">
						<option value="all">All</option>
						<?php
						$query1="select identity_category_name from school_info_identity_category";
						$res1=mysqli_query($conn73,$query1);
						while($row1=mysqli_fetch_assoc($res1)){
						$identity_category_name=$row1['identity_category_name'];
						?>
						<option value="<?php echo $identity_category_name; ?>"><?php echo $identity_category_name; ?></option>
						<?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
					    <label>Elements</label>
					    <!-- Default inline 1-->
						<div class="custom-control custom-checkbox custom-control-inline ">
						  <input type="checkbox" class="custom-control-input" id="defaultInline1" name="address" checked value="address"/>
						  <label class="custom-control-label" for="defaultInline1">Address</label>
						   <input type="checkbox" class="custom-control-input" id="defaultInline2" name="website" checked value="website">
						  <label class="custom-control-label" for="defaultInline2"/>Website</label>
						</div>

					</div>
				</div>
					<div class="col-md-12">	
					<div class="form-group">
					    <label>&nbsp;</label>
					<center><button class="btn btn-success" onclick="for_list();">Get List</button></center>
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
                  <th><?php echo $language['Class']; ?></th>
                  <th><?php echo $language['Select Student']; ?>
				  
				  <th>Update By</th>
                  <th>Date</th>
				  </th>
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

<script>
function checked_null_value(){
var number_checked =$('[name="school_id_card_info[]"]:checked').length;
if(number_checked == 0){
alert_new('Please select atleast one student',"red");
return false;
}else{
return true;
}
}
</script>