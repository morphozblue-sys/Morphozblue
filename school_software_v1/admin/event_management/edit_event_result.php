<?php include("../attachment/session.php");
$company_name=$_SESSION['company'];
?> <!DOCTYPE html>
<html>
<head>

</head>
<style type="text/css">
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 80%;
        left: 0;
		background:white;
    }
    .search-box input[type="text"], .result{
        width: 90%;
		margin-left:5%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>

<script type="text/javascript">

    
	function for_activity(value){
            //alert_new(value);
			$.ajax({
			  address: "POST",
              url: "ajax_get_activity.php?name="+value+"",
              cache: false,
              success: function(detail){		  
		 
		  $("#event_activity").html(detail);
              }
           });
    }
	
   function event_search(value){
            var sport=document.getElementById('event_name').value;
			$.ajax({
			  address: "POST",
              url: "ajax_add_participate.php?activity="+value+"&sport_name="+sport+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		  
		 
		  $("#event_type").val(res[0]); 
          $("#event_date").val(res[1]); 
          $("#event_address").val(res[2]);  
              }
           });
    }
</script>  
<script type="text/javascript">
   function roll_search(value){
            //alert_new(value);
			$.ajax({
			  address: "POST",
              url: "ajax_search_student.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		  if(res[5]==1){
		  $("#gender").val(res[0]);
		  $("#student_class").val(res[1]); 
          $("#student_name").val(res[2]); 
          $("#father_name").val(res[3]);  
          $("#contact_no").val(res[4]);
          }  
              }
           });

    }
</script>  
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#search-box input[type="text"]').on("keyup input", function(){
	//alert_new('sfdfg');
        /* Get input value on change */
	  var classs=document.getElementById('class_no').value;
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal,term2: classs}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
			
        } else{
            resultDropdown.empty();
        }
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents("#search-box").find('input[type="text"]').val($(this).text());
		$(this).parents("#search-box").find('input[type="text"]').focus();
        $(this).parent(".result").empty();
    });
});
</script>

<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: "ajax_event_result_name.php?id="+value+"",
              cache: false,
              success: function(detail){
			  
		  var res = detail.split("|?|");
		  //alert_new(res[7]);
	    $("#s_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#school_name_qw").val(res[1]); 
          $("#house_name").val(res[2]);  
          $("#gender").val(res[3]);  
          $("#student_class").val(res[4]);  
          $("#dateofbirth").val(res[5]);
          $("#category").val(res[6]);
          $("#session_value_11").val(res[7]);
          $("#event_name").val(res[8]);
              }
           });

    }
</script>

<script>
 function select_school(){
var participants_type=document.getElementById('participants_type').value;
if(participants_type!=''){
 $.ajax({
 type:"POST",
 url:"ajax_event_result.php?participants_type="+participants_type+"",
 success: function(detail){
 $('#student_name_company').html(detail);
 }
 });
 }else{
 $('#student_name_company').html('');
 }
 }

 </script>
<script>
  function our_other(value){
 if(value=='Our_School'){
$('#house_name_school').show();
}else{
$('#house_name_school').hide();
}
}
</script>

<?php
include("../../con73/con37.php");

$edit_record=$_GET['id'];
$query="select * from event_result where s_no='$edit_record'";
$run=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($run)){ 
 
	$winner = $row['winner'];
    $participate_type = $row['participate_type'];
	$event_name = $row['event_name'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$student_name = $row['student_name'];
	$gender = $row['gender'];
	$student_class = $row['student_class'];
	$dateofbirth = $row['dateofbirth'];
	$remark = $row['remark'];
	$category = $row['category'];
	$session_value = $row['session_value'];
	}
?>

<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Event Result
	   <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
	   <li><a href="event_management.php"#><i class="fa fa-calendar-check-o"></i> Event Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Event Result</li>
      </ol>
    </section>
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Event Result</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
		
            <div class="box-body">
			   <table id="example1" class="table table-bordered table-striped">
			<form role="form" method="post" enctype="multipart/form-data">
			    <div class="col-md-12">
			    <div class="col-md-4">
					<div class="form-group">
						<label>Winner<font style="color:red"><b>*</b></font></label>
					    <input type="text" name="winner" placeholder="Winner" value="<?php echo $winner; ?>" class="form-control">
					</div>
				</div>   
				<div class="col-md-4">
					<div class="form-group">
						<label>Participants Type<font style="color:red"><b>*</b></font></label>
						<select name="participate_type" id="participants_type" class="form-control" required onchange="select_school();our_other(this.value);">
						  <option <?php if($participate_type=='Our_School'){ echo 'selected'; } ?> value="Our_School">Our School</option>
						  <option <?php if($participate_type=='Other_School'){ echo 'selected'; } ?> value="Other_School">Other School</option>
						</select>
					</div>
				</div>
               <div class="col-md-4" id="student_name_company">
			
			   </div>
			</div>
			      
			<input type="hidden" name="session_value" id="session_value_11">
		    <input type="hidden" id="student_name" name="student_name">
	         <div class="col-md-3">
		      	<div class="form-group" >
				    <label>Participants Name</font></label>
				    <input type="text" name="student_name" placeholder="Student Name" value="<?php echo $student_name ?>" id="student_name" class="form-control" readonly>
				</div>
			</div>    
			<div class="col-md-3">
		      	<div class="form-group" >
				    <label>Class</font></label>
				    <input type="text" name="student_class" placeholder="Student Class" value="<?php echo $student_class ?>" id="student_class" class="form-control" readonly>
				</div>
			</div>  
			<div class="col-md-3">
		      	<div class="form-group" >
				    <label>Event Name</font></label>
				    <input type="text" name="event_name" placeholder="Student Class" value="<?php echo $event_name; ?>" id="event_name" class="form-control" readonly>
				</div>
			</div>
		    <div class="col-md-3">		
				<div class="form-group">
					<label>School/Institute Name</label>
					<input type="text" name="school_name" value="<?php echo $school_name;?>" placeholder="School Institute" id="school_name_qw" value="" class="form-control" readonly />
				</div>
			</div>
            <div class="col-md-3">		
				<div class="form-group">
					<label>Category</label>
					<input type="text" name="category" id="category" placeholder="Category"  value="<?php echo $category; ?>" class="form-control" readonly />
				</div>
			</div>
			<div class="col-md-3" id="house_name_school" style="<?php if($participate_type=='Other_School'){ echo 'display:none'; } ?>" >
				<div class="form-group">
					<label>House Name</label>
					<input type="text"  name="house_name" placeholder="House Name"  id="house_name" value="<?php echo $house_name;?>" class="form-control" readonly>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Gender</label>
					<input type="text"  name="gender" placeholder="Gender" value="<?php echo $gender; ?>"  id="gender" class="form-control" readonly>
				</div>
			</div>
		    <div class="col-md-3" id="birth_other">		
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="date" name="dateofbirth" id="dateofbirth" placeholder="Date Of Birth"  value="<?php echo $dateofbirth; ?>" class="form-control" readonly>
				</div>
			</div>    
			<div class="col-md-3">		
				<div class="form-group">
					<label>Remark</label>
					<input type="text" name="remark" id="remark" placeholder="Remark"  value="<?php echo $remark; ?>" class="form-control">
				</div>
			</div>
			
		  <div class="col-md-12">
		     <center><input type="submit" name="finish" value="Submit" class="btn btn-primary" /></center>
		  </div>
		</form>	
		</table>
	</div>
<?php

include("../../con73/con37.php");

if(isset($_POST['finish'])){

    $winner = $_POST['winner'];
    $participate_type = $_POST['participate_type'];
	$event_name = $_POST['event_name'];
	$house_name = $_POST['house_name'];
	$school_name = $_POST['school_name'];
	$student_name = $_POST['student_name'];
	$gender = $_POST['gender'];
	$student_class = $_POST['student_class'];
	$dateofbirth = $_POST['dateofbirth'];
	$remark = $_POST['remark'];
	$category = $_POST['category'];
	$session_value = $_POST['session_value'];
    //$event_date_2 = explode("-",$event_date_1);
	//$event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
  
  $quer="insert into event_result(winner,participate_type,event_name,house_name,school_name,student_name,gender,student_class,dateofbirth,remark,category,session_value,$update_by_insert_sql_column)values('$winner','$participate_type','$event_name','$house_name','$school_name','$student_name','$gender','$student_class','$dateofbirth','$remark','$category','$session_value',$update_by_insert_sql_value)";
 
 if(mysqli_query($conn73,$quer)){
	echo "<script>window.open('event_result.php','_self');</script>";
}
 }
 
 ?>
<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>

