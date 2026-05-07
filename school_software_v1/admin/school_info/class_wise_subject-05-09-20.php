<?php include("../attachment/session.php"); ?>
<?php 
if(isset($_GET['class_name'])){
$student_class_code=$_GET['class_name'];
$group_name=$_GET['group_name'];
$stream_name=$_GET['stream_name'];
$student_class_code1=explode("_",$student_class_code);
$class_name=$student_class_code1[0];
$class_name_hindi=$student_class_code1[1];
$class_code=$student_class_code1[2];
}
?>
     <section class="content-header">
      <h1>
        <?php echo $language['School Information Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
	  <li class="active"><?php echo $language['Add Subject Classwise']; ?></li>
      </ol>
    </section>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	<script>

function for_stream(){
	var value2=document.getElementById("class_name1").value;
	  var class_value=value2.split('_');
	  	  if(class_value[2]=='class14' || class_value[2]=='class15'){

$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_group_subject_div").show();
$("#stream_name").attr('required',true);
$("#group_name").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_group_subject_div").hide();
$("#stream_name").attr('required',false);
$("#group_name").attr('required',false);
$("#stream_name").val('');
$("#group_name").val('');
}
}
   function get_group(value1){
         
       $.ajax({
			  type: "POST",
              url: access_link+"school_info/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function($detail1){
                   var str1 =$detail1;                
    
                  $("#group_name").html(str1);
              }
           });
    }
      function for_subject_add(){ 

	    var class_name2=document.getElementById("class_name1").value;
	  var subject_type=document.getElementById('subject_type').value;
	  	  var stream_name=document.getElementById("stream_name").value;
         var group_name=document.getElementById('group_name').value;
	  if(class_name2!=''){
	  	  var class_value=class_name2.split('_');
	  	  if(class_value[2]=='class14' || class_value[2]=='class15'){
	   if(stream_name!='' && group_name!=''){
             $.ajax({
			  type: "POST",
              url: access_link+"school_info/ajax_class_wise_subject_add.php?class_name="+class_name2+"&subject_type="+subject_type+"&stream_name="+stream_name+"&&group_name="+group_name+"",
              cache: false,
              success: function(detail){
			  
              $('#example1').html(detail);
              }
           });
            }
			}else{
			   $.ajax({
			  type: "POST",
              url: access_link+"school_info/ajax_class_wise_subject_add.php?class_name="+class_name2+"&subject_type="+subject_type+"&stream_name="+stream_name+"&&group_name="+group_name+"",
              cache: false,
              success: function(detail){
              $('#example1').html(detail);
              }
           });
			}
}	
	}
      function for_subject_delete(){ 
	  
	    var class_name2=document.getElementById("class_name1").value;
	   var subject_type=document.getElementById('subject_type').value;
	  	  var stream_name=document.getElementById("stream_name").value;
         var group_name=document.getElementById('group_name').value;
	  if(class_name2!=''){
             $.ajax({
			  type: "POST",
              url: access_link+"school_info/ajax_class_wise_subject_delete.php?class_name="+class_name2+"&subject_type="+subject_type+"&stream_name="+stream_name+"&&group_name="+group_name+"",
              cache: false,
              success: function(detail){
              $('#example2').html(detail);
              }
           });
            }	
}			
	</script>  

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
        <div class="box-body">
			<form role="form" method="post" enctype="multipart/form-data">
				<div class="col-md-12">
			<div class="col-md-3">
				  <div class="form-group">
				    <label><?php echo $language['Subject Type']; ?></label>
					<select  class="form-control" id="subject_type" onchange='for_subject_add();for_subject_delete();' required >
				  <?php	if(isset($_GET['subject_type'])){
						$subject_type=$_GET['subject_type'];
					if($subject_type=='subject'){ ?>
						<option value="subject" > Main Subject</option>
					<option value="practical" > Practical Subject</option>
					<option value="other_subject" > Other Subject</option>
					<?php	} else if($subject_type=='practical'){ ?>
						<option value="practical" > Practical Subject</option>
							<option value="subject" > Main Subject</option>
					<option value="other_subject" > Other Subject</option>
					<?php	} else if($subject_type=='other_subject'){ ?>
					<option value="other_subject" > Other Subject</option>
					<option value="subject" > Main Subject</option>
					<option value="practical" > Practical Subject</option>
						<?php } } else { ?>
					<option value="subject" > Main Subject</option>
					<option value="practical" > Practical Subject</option>
					<option value="other_subject" > Other Subject</option>
						<?php } ?>
					</select>				
				  </div>
			</div>
				<div class="col-md-3">				
					<div class="form-group">
				    <label><?php echo $language['Class Name']; ?></label>
					<select name="class_name" class="form-control " id="class_name1" onchange='for_stream();for_subject_add();for_subject_delete();' required >
					<?php 
					if(isset($_GET['class_name'])){
						$student_class_code=$_GET['class_name'];
						$student_class_code1=explode("_",$student_class_code);
						$class_name=$student_class_code1[0];
							$class_name_hindi=$student_class_code1[1];
							$class_code=$student_class_code1[2];
					?>
					<option value="<?php echo $class_name."_".$class_name_hindi."_".$class_code; ?>" ><?php echo $class_name; ?></option>
					<?php } else { ?>
					<option value=''>Select</option>
					<?php }
					$que="select * from school_info_class_info";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					while($row=mysqli_fetch_assoc($run)){
					$class_name = $row['class_name'];
					$class_name_hindi = $row['class_name_hindi'];
					$class_code = $row['class_code'];
					?>
					<option value="<?php echo $class_name."_".$class_name_hindi."_".$class_code; ?>" ><?php echo $class_name; ?></option>
					<?php } ?>
					</select>				
				  </div>
				</div>	
			<div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?></label>
					    <select class="form-control" name="student_class_stream" id="stream_name" onchange="get_group(this.value);for_subject_add();for_subject_delete();" >
						  <?php	if(isset($_GET['stream_name'])){
						$stream_name=$_GET['stream_name']; ?>
						<option value="<?php echo $stream_name; ?>" ><?php echo $stream_name; ?></option>
						<?php }else{ ?>
					           <option  value="">Select Stream</option>
							   <?php } ?>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
                           if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
				</div>
				<div class="col-md-3 " id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label ><?php echo $language['Group']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="group_name" onchange='for_subject_add();for_subject_delete();' >
								  <?php	if(isset($_GET['group_name'])){
						$group_name=$_GET['group_name']; ?>
						<option value="<?php echo $group_name; ?>" ><?php echo $group_name; ?></option>
						<?php }else{ ?>
					            <option  value="">Select Group</option>
							   <?php } ?>
					         
					    </select>
					  </select>
					</div>
				</div>			
				</div>			
				<div class="col-md-6 box-body table-responsive">               
				<div class="col-md-12">
				<table  class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Subject Name English']; ?></th>
				  <th><?php echo $language['Subject Name Hindi']; ?></th>
				  <th><?php echo $language['Add']; ?></th>
                </tr>
                </thead>				
				<tbody id="example1">
				
				</tbody>				
                </table>
				</div>	
				
                </div>
			
				<div class="col-md-6 box-body table-responsive">
		
                <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Subject Name English']; ?></th>
				  <th><?php echo $language['Subject Name Hindi']; ?></th>
				  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
										
				<tbody id="example2">
				
				</tbody>				
                </table>
                </div>
		</div>
	       </form>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
</section>

<script>
  $(function () {
  for_subject_add();
for_subject_delete();
for_stream();
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
