<?php include("../attachment/session.php"); ?>
<script type="text/javascript">

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

function validate(){
var subject=0;
$('.subject11').each(function() {
if($(this).prop('checked')==true){
subject = Number(parseInt(subject)+1);
}
});
if (subject<=0) {
	alert_new("Please Select Atleast One Subject !!!",'red');
	return false;
}
}

 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"examination/update_weekly_test_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('examination/view_weekly_test');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
       <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('examination/examination')"><i class="fa fa-id-card-o"></i> <?php echo $language['Examination']; ?></a></li>
	   <li class="active">Update Weekly Test</li>
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
              <h3 class="box-title">Update Weekly Test</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
<?php
$s_no_get=$_GET['s_no'];
$query="select * from weekly_test_info where test_status='Active' and s_no='$s_no_get' order by s_no DESC";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];
$test_s_no=$row['s_no'];
$test_name=$row['test_name'];
$from_date=$row['from_date'];
$to_date=$row['to_date'];
$student_class=$row['student_class'];
$student_class_stream = $row['student_class_stream'];
$student_class_group=$row['student_class_group'];
$student_class_section=$row['student_class_section'];
$test_description=$row['test_description'];
$update_change=$row['update_change'];
$last_updated_date=date('d-m-Y h:i:s',strtotime($row['last_updated_date']));
$serial_no++;
}
?>
			<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
			
			    <div class="col-md-3">	
					<div class="form-group" >
					    <label>Test Name</label>
					    <input type="hidden" name="s_no_hidden"  value="<?php echo $s_no_get; ?>" class="form-control" required />
					    <input type="text" name="test_name" id="test_name" value="<?php echo $test_name; ?>" class="form-control" required />
					</div>
				</div>
				
				<div class="col-md-2">	
					<div class="form-group" >
					    <label>From Date</label>
					    <input type="date" name="from_date" id="from_date" value="<?php echo $from_date; ?>" class="form-control" required />
					</div>
				</div>
				
				<div class="col-md-2">	
					<div class="form-group" >
					    <label>To Date</label>
					    <input type="date" name="to_date" id="to_date" value="<?php echo $to_date; ?>" class="form-control" required />
					</div>
				</div>
				
				<div class="col-md-2">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <input type="text" name="student_class" id="student_class" value="<?php echo $student_class; ?>" class="form-control" required readonly/>
				
					</div>
				</div>
				
				<div class="col-md-3" id="student_class_stream_div" <?php if($student_class!='11TH' && $student_class!='12TH' ){ ?>style="display:none;" <?php  } ?>>				
					<div class="form-group">
					  <label ><?php echo $language['Stream']; ?></label>
					  
					    <input type="text" name="student_class_stream" id="student_class_stream" value="<?php echo $student_class_stream; ?>" class="form-control" required readonly/>
					</div>
		        </div>
		        
		        <div class="col-md-2" id="student_class_group_div"  <?php if($student_class!='11TH' && $student_class!='12TH' ){ ?>style="display:none;" <?php  } ?>>				
					<div class="form-group">
					  <label ><?php echo $language['Group']; ?></label>
					  
					    <input type="text" name="student_class_group" id="student_class_group" value="<?php echo $student_class_group; ?>" class="form-control" required readonly/>
					    
					  </select>
					</div>
				</div>
				
				<div class="col-md-2">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    
					    <input type="text" name="student_class_section" id="student_class_section" value="<?php echo $student_class_section; ?>" class="form-control" required readonly/>
					   
					</div>
				</div>
				
				<div class="col-md-6">	
					<div class="form-group" >
					    <label>Description</label>
					    <input type="text" name="test_description" id="test_description" value="<?php echo $test_description; ?>" class="form-control" />
					</div>
				</div>
				
				<div class="col-md-12" id="test_subjects_detail">	
			<?php	
$class_condition00="";
$class_condition="";
if($student_class!=''){
$class_condition00=" and class='$student_class'";
$class_condition=" and student_class='$student_class'";
}
$section_condition="";
if($student_class_section!=''){
$section_condition=" and student_class_section='$student_class_section'";
}
$stream_condition00="";
$stream_condition="";
if($student_class_stream!=''){
$stream_condition00=" and stream_name='$student_class_stream'";
$stream_condition=" and student_class_stream='$student_class_stream'";
}
$group_condition00="";
$group_condition="";
if($student_class_group!='' && $student_class_group!='All'){
$group_condition00=" and group_name='$student_class_group'";
}
if($student_class_group!=''){
$group_condition=" and student_class_group='$student_class_group'";
}
$test_condition="";
if($test_s_no!=''){
$test_condition=" and s_no='$test_s_no'";
}

 $query="select test_subjects from weekly_test_info where test_status='Active' and s_no='$s_no_get'";
$res=mysqli_query($conn73,$query);
$test_subjects='';
while($row=mysqli_fetch_assoc($res)){
 $test_subjects=$row['test_subjects'];
}
if(substr_count($test_subjects,"|?|")>0){
$test_subjects1=explode('|?|',$test_subjects);
$test_subjects_count=count($test_subjects1);
$test_subjects_code='';
for($i=0; $i<$test_subjects_count; $i++){
$test_subjects2=explode('|??|',$test_subjects1[$i]);
$test_subjects_code[$i]=$test_subjects2[0];
$test_subjects_dates[$i]=$test_subjects2[1];
$test_from_time[$i]=$test_subjects2[2];
$test_to_time[$i]=$test_subjects2[3];
$test_higest_mark[$i]=$test_subjects2[4];
}
}else{
$test_subjects01=explode('|??|',$test_subjects);
$test_subjects_count=1;
$test_subjects_code[0]=$test_subjects01[0];
$test_subjects_dates[0]=$test_subjects01[1];

$test_from_time[0]=$test_subjects2[2];
$test_to_time[0]=$test_subjects2[3];
$test_higest_mark[0]=$test_subjects2[4];
}
?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>S No</th>
<th><input type="checkbox" name="" id="subject11" onclick="for_check(this.id);" checked /> Subject Name</th>
<th>Date</th>
<th>From Time</th>
<th>To Time</th>
<th>Highest Marks</th>
</tr>
</thead>

<tbody>
<?php

	$query="select * from school_info_subject_info where s_no!='' and (session_value='$session1' || session_value='')$class_condition00$stream_condition00$group_condition00$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no111=0;
while($row=mysqli_fetch_assoc($res)){
$subject_name=$row['subject_name'];
$subject_code=$row['subject_code'];

$serial_no++;
$code_match=0;
$test_dates="";
$test_from_times="";
$test_to_times="";
$hightest_marks="";
for($i=0; $i<$test_subjects_count; $i++){
    if($test_subjects_code[$i]==$subject_code){
      $code_match=1;;  
      
 $test_dates=$test_subjects_dates[$i];
$test_from_times=$test_from_time[$i];
$test_to_times=$test_to_time[$i];
$hightest_marks=$test_higest_mark[$i];
    }
}

?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><input type="checkbox" name="test_indexes[]" id="" value="<?php echo $serial_no111; ?>" class="subject11" <?php if($code_match==1){ ?>checked <?php } ?> /> <b><?php echo $subject_name; ?></b><input type="hidden" name="test_subjects[]" id="" value="<?php echo $subject_code; ?>" class="form-control" /></td>
<td><input type="date" name="test_dates[]" id="" class="form-control"  value="<?php echo $test_dates; ?>" /></td>
<td><input type="time" name="test_from_times[]" id="" class="form-control"  value="<?php echo $test_from_times; ?>" /></td>
<td><input type="time" name="test_to_times[]" id="" class="form-control"  value="<?php echo $test_to_times; ?>" /></td>
<td><input type="number" name="hightest_marks[]" id="" class="form-control" value="<?php echo $hightest_marks; ?>" /></td>
</tr>
<?php $serial_no111++; } ?>
</tbody>
</table>
				</div>
				

		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" onclick="return validate();" class="btn  btn-success" /></center>
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