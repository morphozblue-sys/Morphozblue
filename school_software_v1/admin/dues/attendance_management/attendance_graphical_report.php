<?php
include("../attachment/session.php");
?> 

<style>
.panel-default>.panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.panel-default>.panel-heading a {
  display: block;
  padding: 10px 15px;
}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}
.panel-default>.panel-heading a:after{
font-size:12px;
margin-top:5px;
}
.panel-group .panel {
    margin-bottom: 0;
}
.panel-body{
padding-top:10px;
padding-bottom:10px;
padding-right:50px;
padding-left:50px;
}
.panel-group{
margin-bottom:10px;
}
.panel-default>.panel-heading+.panel-collapse>.panel-body{
font-weight:600;
}
#hover_hand:hover{
cursor: pointer; 
}
#default_dropdown li{
padding:10px;
border-bottom: 1px solid #b0da9f;
font-weight:bold;
}
#default_dropdown .active{
background:#3c8dbc;
color:#FFF;
}
#default_dropdown{
min-width:40px;
background:#dff0d8;
}
#clas_student span{
font-size:18px;
padding:0 20px;
}
#clas_student span:hover{
cursor: pointer;
}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
</head>

<script>
function graphic_detail(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance_management/attendance_graphical_report_ajax.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		$("#attendance_chart").html(data);
		}
	});
}

function another_chart(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance_management/attendance_graphical_report_chart.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		$("#classwise_chart").html(data);
		}
	});
}

function strengths(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance_management/attendance_graphical_report_strength.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		 $("#attendance_strength_report").html(data);
		var res2=data.split('|???|');
		total_student=Number(res2[1]);
		total_present=Number(res2[2]);
		total_absent=Number(res2[3]);
		total_leave=Number(res2[4]);
		not_mark=Number(res2[5]);
		$('#total_student').html(total_student);
		$('#total_present').html(total_present);
		$('#total_absent').html(total_absent);
		$('#total_leave').html(total_leave);
		$('#not_mark').html(not_mark);
		}
	});
}


function set_attendance(student_id,att_id,attendance,student_rf_id_number){
var current_date=document.getElementById('attendance_date').value;

	$.ajax({
		type:"POST",
		url:access_link+"attendance_management/ajax_set_attendance_student.php?current_date="+current_date+"&student_id="+student_id+"&attendance="+attendance+"&student_rf_id_number="+student_rf_id_number+"",
		cache:false,
		success:function(data)
		{
		//alert(data);
		$('.'+student_id).removeClass('active');
		$('#'+att_id+student_id).addClass('active');
		}
	});
}

function for_date(value){
post_content('attendance_management/attendance_graphical_report','select_date='+value);
}

function mark_attendance(student_class,mark){
var current_date=document.getElementById('attendance_date').value;

	$.ajax({
		type:"POST",
		url:access_link+"attendance_management/ajax_set_attendance_student_markwise.php?current_date="+current_date+"&student_class="+student_class+"&mark="+mark+"",
		cache:false,
		success:function(data)
		{
		$('#mark_details').html(data);
		$('#my_model').click();
		}
	});

}

function validity_checked(student_id,preword){
if($('#'+preword+student_id).is(':checked')){
$('.'+student_id).prop('checked',false);
$('#'+preword+student_id).prop('checked',true);
}else{
$('.'+student_id).prop('checked',false);
}
}


	  		    function form_submit(){
          
		    $.ajax({
           type: "POST",
            url: access_link+"attendance_management/attendance_graphical_report_api.php",
           data: $("#my_form").serialize(), 
           success: function(detail)
           { 
		    $("#modal_close").click();
           $("#myModal").close();
		   var res=detail.split("|?|");
			   if(res[1]=='success'){
				   post_content('attendance_management/attendance_graphical_report',res[2]);
            }
			}
         });
      }
</script>

		
			
		    <div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
                <div class="row">
                    	<div class="col-md-3">	
				<label>Date : </label>
				<input type="date" name="attendance_date" id="attendance_date" value="<?php if(isset($_GET['select_date'])){ echo $_GET['select_date']; }else{ echo date('Y-m-d'); } ?>" oninput="for_date(this.value);strengths();graphic_detail();another_chart();" />
			</div>
                </div>
                <div class="row" style="background-color:#dff0d8;">
			
			<div class="col-md-3">
			<label><h5>Total Student : <span id="total_student"></span></h5></label>
			</div>
			<div class="col-md-2">
			<label><h5>Total Present : <span id="total_present"></span></h5></label>
			</div>
			<div class="col-md-2">
			<label><h5>Total Absent : <span id="total_absent"></span></h5></label>
			</div>
			<div class="col-md-2">
			<label><h5>Total Leave : <span id="total_leave"></span></h5></label>
			</div>
			<div class="col-md-3">
			<label><h5>Not Mark : <span id="not_mark"></span></h5></label>
			</div>
		
			
			</div>
			</div>
			</div>
			 <div class="row">
			 <div class="col-md-6">
		   <div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
                <div class="row" id="attendance_strength_report">

<?php

$query3="select class_name,section from school_info_class_info where status='Active'";
$result3=mysqli_query($conn73,$query3)or die(mysqli_error($conn73));
$class_serial_no=0;
while($row3=mysqli_fetch_assoc($result3)){
$class_name=$row3['class_name'];
$class_name111=$row3['class_name'];
if(substr_count($class_name111, ' ')>0){
    $class_name111=str_replace(' ','',$class_name111);
}
$class_code=$row3['class_code'];
$section=$row3['section'];
for($s=1;$s<=$section;$s++){
if($s==1){
$student_section='A'; 
}else if($s==2){
$student_section='A,B'; 
}else if($s==3){
$student_section='A,B,C'; 
}else if($s==4){
$student_section='A,B,C,D'; 
}else if($s==5){
$student_section='A,B,C,D,E'; 
}
}
$class_serial_no++;
$student_ser=0;

?>	
 <div class="row">
<div class="col-md-12">
    <h5>
          <?php echo $class_serial_no.'.'; ?>&nbsp;&nbsp;&nbsp;<?php echo $class_name; ?>&nbsp;&nbsp;[<?php echo $student_section; ?>]
      </h5>
      </div>
		<div class="col-md-12" style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="<?php echo 'strength_'.$class_name111; ?>">S : <?php echo ''; ?>,</span>
		  <span onclick="mark_attendance('<?php echo $class_name; ?>','P');" style="color:rgb(16, 150, 24);" id="<?php echo 'present_'.$class_name111; ?>">P : <?php echo ''; ?>,</span>
		  <span onclick="mark_attendance('<?php echo $class_name; ?>','A');" style="color:rgb(153, 0, 153);" id="<?php echo 'absent_'.$class_name111; ?>">A : <?php echo ''; ?>,</span>
		  <span onclick="mark_attendance('<?php echo $class_name; ?>','L');" style="color:rgb(255, 153, 0);"id="<?php echo 'leave_'.$class_name111; ?>">L : <?php echo ''; ?>,</span>
		  <span onclick="mark_attendance('<?php echo $class_name; ?>','');" style="color:rgb(220, 57, 18);" id="<?php echo 'not_mark_'.$class_name111; ?>">N : <?php echo ''; ?></span>
		</div>
		</div>
<?php } ?>
  
			</div>
			</div>
			</div>
			</div>
			<div class="col-md-6">
		   <div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
                <div class="row"id="attendance_chart"></div>
                <div class="row"id="classwise_chart"></div>
		
			</div>
			</div>
			</div>
			</div>
			
   

</form>


<script>
graphic_detail();
strengths();
another_chart();
</script>
