<?php include("../attachment/session.php"); ?>

<script>
function for_section(value){
$('#student_class_section').html("<option value='' >Loading....</option>");
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_class_section.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		  $("#student_class_section").html(detail);
		  student_list();
	  }
   });
}

function for_msg(){
	var range_value=document.getElementById('message_range').value;
	var school_name=document.getElementById('school_info_school_name').value;
	var student_due_month=document.getElementById('student_due_month').value;
	if(student_due_month=='01'){
		var student_due_month1='January';
	}else if(student_due_month=='02'){
		var student_due_month1='February';
	}else if(student_due_month=='03'){
		var student_due_month1='March';
	}else if(student_due_month=='04'){
		var student_due_month1='April';
	}else if(student_due_month=='05'){
		var student_due_month1='May';
	}else if(student_due_month=='06'){
		var student_due_month1='June';
	}else if(student_due_month=='07'){
		var student_due_month1='July';
	}else if(student_due_month=='08'){
		var student_due_month1='August';
	}else if(student_due_month=='09'){
		var student_due_month1='September';
	}else if(student_due_month=='10'){
		var student_due_month1='October';
	}else if(student_due_month=='11'){
		var student_due_month1='November';
	}else if(student_due_month=='12'){
		var student_due_month1='December';
	}
	if(range_value==0){
		$("#student_message").val("Dear Parents, Kindly deposit the "+student_due_month1+" month's dues fee amount ? and previous year dues fee amount ? of your child ? at the earliest. Regards, "+school_name);
	}else{
		$("#student_message").val("Dear Parents, Your ward ? "+student_due_month1+" month's fee is Paid. Regards, "+school_name);
	}
	student_list();
}

function student_list(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_due_month=document.getElementById('student_due_month').value;
	var range_value=document.getElementById('message_range').value;
	if(student_class!='' && student_class_section!='' && student_due_month!='' && range_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_list.php?student_class="+student_class+"&student_class_section="+student_class_section+"&student_due_month="+student_due_month+"&range_value="+range_value+"",
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		$('#student_list').html('');
	}
}

function print_list(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_due_month=document.getElementById('student_due_month').value;
	var range_value=document.getElementById('message_range').value;
	var student_note=document.getElementById('student_note').value;
	if(student_class_section!='' && student_due_month!='' && range_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_list_for_print.php?student_class="+student_class+"&student_class_section="+student_class_section+"&student_due_month="+student_due_month+"&range_value="+range_value+"&student_note="+student_note+"",
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		$('#student_list').html('');
	}
}

function print_list1(){
    var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_due_month=document.getElementById('student_due_month').value;
	var range_value=document.getElementById('message_range').value;
	if(student_class_section!='' && student_due_month!='' && range_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_fee_due_student_list.php?student_class="+student_class+"&student_class_section="+student_class_section+"&student_due_month="+student_due_month+"&range_value="+range_value+"",
		cache: false,
		success: function(detail){
        $("#prnt_stdnt_lst").html(detail);
        $("#model_button").click();
		}
		});
	}
}

function print_list2(){
    var student_roll_no=[];
    $(".selected_student").each(function() {
	if($(this).prop("checked") == true){
	    student_roll_no.push($(this).val());
	}
	});
    if(student_roll_no!=''){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_due_month=document.getElementById('student_due_month').value;
	var range_value=document.getElementById('message_range').value;
	var student_note=document.getElementById('student_note').value;
	if(student_class_section!='' && student_due_month!='' && range_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_selected_student_list_for_print.php",
		cache: false,
		data:{student_class : student_class, student_class_section : student_class_section, student_due_month : student_due_month, range_value : range_value, student_note : student_note, student_roll_no : student_roll_no},
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		$('#student_list').html('');
	}
    }else{
        alert("Please Select Atleast One student !!!");
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

function validation(id){
var range_value=document.getElementById('message_range').value;
if(range_value==0){
    var chk=4;
}else{
    var chk=2;
}
var str = document.getElementById('student_message').value;
var n = str.includes("?");
var m=str.split("?");
var q=m.length;

var add=0;
$("."+id).each(function() {
if($(this).prop('checked') == true){
	add = parseInt(add+1);
}
});
if(add>0 && n==true && q==chk){
return true;
}else{
if(add<=0){
alert("Please Choose student Class & Check Atleast One Student !!!");
}else if(n==false || q!=chk){
alert("Please Do Not Remove & Add the Extra ? (Question Mark) in Your Message !!!");
}
return false;
}
}

$("#my_form").submit(function(e){
	e.preventDefault();

var formdata = new FormData(this);
//window.scrollTo(0, 0);
//    get_content(loader_div);
	$.ajax({
		url: access_link+"fees_monthly/student_fee_dues_list_api.php",
		type: "POST",
		data: formdata,
		mimeTypes:"multipart/form-data",
		contentType: false,
		cache: false,
		processData: false,
		success: function(detail){
		    //alert(detail);
		   var res=detail.split("|?|");
		   if(res[1]=='success'){
			    alert('Message Successfully Sent.');
			    get_content('fees_monthly/student_fee_dues_list');			   
		}
		}
	 });
  });

</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active"><?php echo $language['Student Fee Add']; ?></li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	<form method="post" enctype="multipart/form-data" id="my_form">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		<br>
		<?php
		$query="select * from school_info_general";
		$run=mysqli_query($conn73,$query);
		while($row=mysqli_fetch_assoc($run)){
		$school_info_school_name=$row['school_info_school_name'];
		}
		?>
		<input type="hidden" id="school_info_school_name" value="<?php echo $school_info_school_name; ?>" />
		<div class="box-body  col-md-12">
			
			<div class="col-md-2">				
				<div class="form-group" >
				  <label>Select Student Class</label>
				  <select name="student_class" class="form-control" id="student_class" onchange="for_section(this.value);" required>
				  <option value="">Select Class</option>
					<?php 
					$class37=$_SESSION['class_name37'];
					$class371=explode('|?|',$class37);
					$total_class=$_SESSION['class_total37'];
					for($q=0;$q<$total_class;$q++){
					$class_name=$class371[$q]; ?>
					<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					<?php } ?>
				  </select>
				</div>
			</div>
			<div class="col-md-1">				
				<div class="form-group" >
				  <label>Section</label>
				  <select name="student_class_section" class="form-control" id="student_class_section" onchange="student_list();" required>
				  <option value="All">All</option>
				  </select>
				</div>
			</div>
			<div class="col-md-2">				
				<div class="form-group" >
				  <label>Select Month</label>
				  <select name="student_due_month" class="form-control" id="student_due_month" onchange="for_msg();" required>
				  <?php
				  $que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
                  $run1=mysqli_query($conn73,$que1);
                  while($row1=mysqli_fetch_assoc($run1)){
				  $fees_type_name = $row1['fees_type_name'];
				  $fees_code = $row1['fees_code'];
				  ?>
				  <option value="<?php echo $fees_code; ?>"><?php echo $fees_type_name; ?></option>
				  <?php } ?>
				  </select>
				</div>
			</div>
			<div class="col-md-1">
			<label style="float:left;"><span title="For Dues">D</span></label><label style="float:right;"><span title="For Paid">P</span></label>
			<div class="slidecontainer"><input type="range" name="message_range" id="message_range" min="0" max="1" value="0" oninput="for_msg();"></div>
			</div>
			<div class="col-md-6">
			<label>Write Your Message</label><span style="float:right;font-weight:bold;color:red;"><input type="checkbox" name="" id="my_no" onclick="for_check(this.id);" checked /> All</span>
			<input type="text" name="student_message" id="student_message" placeholder="Write Your Message" class="form-control" />
			</div>
			
		</div>
		<div class="box-body  col-md-12">
		    <div class="col-md-2">
		    <span style="font-size:18px;color:blue;">This Area Use Only for Print Dues List :</span>
		    </div>
		    <div class="col-md-8">
		    <label>Note :</label>
		    <input type="text" name="" id="student_note" placeholder="Please Write Dues / Paid Note Here" class="form-control" />
		    </div>
		    <div class="col-md-2">
		    <center>
		    <label>Click For List Print :</label>
		    <!-- <button type="button" onclick="print_list();" class="btn btn-info">For List Print</button> -->
                <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">For List Print
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <li style="cursor: pointer;" onclick="print_list();"><a>All</a></li>
                <li class="divider"></li>
                <li style="cursor: pointer;" onclick="print_list1();"><a>Selected</a></li>
                </ul>
                </div>
			</center>
		    </div>
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-12" style="border:1px solid;">
		<center><u><h3 style="color:red;">Dues List</h3></u></center>
				<div class="col-md-2">&nbsp;</div>
				<div class="col-md-8" id="student_list">
				
				</div>
				<div class="col-md-2">&nbsp;</div>
		</div>
		  
		    
		</div>
		
		        <div class="box-body">
			       <div class="col-md-12">
		            <center>
		            <input type="submit" name="finish" value="Send SMS" class="btn  my_background_color" onclick="return validation('my_no');" />
		            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		            <button type="button" class="btn btn-default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button>
		            </center>
		           </div>
			    </div>

</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
</form>

<!------  Start Model ------->
<!-- Trigger the modal with a button -->
  <button type="button" id="model_button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display:none;">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Student List</h4>
        </div>
        <div class="modal-body" id="prnt_stdnt_lst">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn my_background_color" onclick="print_list2();" data-dismiss="modal">Open List</button>
        </div>
      </div>
      
    </div>
  </div>
<!------  End Model ------->

<script>
for_msg();
</script>