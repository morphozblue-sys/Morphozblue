<?php include("../attachment/session.php"); ?>

<script>
function for_section(value){
$('#student_class_section').html("<option value='' >Loading....</option>");
if(value!=''){
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_class_section.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		  $("#student_class_section").html(detail);
	  }
   });
}else{
    $('#student_class_section').html("<option value='All'>All</option>");
}
}

function for_check(id,con11){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
if(con11=='Yes'){
for_msg();
}
}

function for_msg(){
	var school_name=document.getElementById('school_info_school_name').value;
	var ins_name={ 01:"January", 02:"February", 03:"March", 04:"April", 05:"May", 06:"June", 07:"July", 08:"August", 09:"September", 10:"October", 11:"November", 12:"December" };
	var month_arr=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    month_arr.push(ins_name[Number($(this).val())]);
	}
	});
	$("#student_message").val("Dear Parents, Kindly deposit the "+month_arr+" transport due amount ? of your child ? at the earliest. Regards, "+school_name);
}

function student_list(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	if(student_class!='' && student_class_section!='' && selected_month!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_transport_list_statuswise.php",
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month },
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month !!!');
		$('#student_list').html('');
	}
}

function validation(id){

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
if(add>0 && n==true && q==3){
return true;
}else{
if(add<=0){
alert("Please Choose student Class & Check Atleast One Student !!!");
}else if(n==false || q!=3){
alert("Please Do Not Remove & Add the Extra ? (Question Mark) in Your Message !!!");
}
return false;
}
}

function print_list(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_transport_list_for_print_statuswise.php",
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,student_note:student_note },
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month !!!');
		$('#student_list').html('');
	}
}

function print_list1(){
    var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_fee_due_student_transport_list_statuswise.php",
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,student_note:student_note },
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
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_selected_student_transport_list_for_print_statuswise.php",
		cache: false,
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,student_note:student_note,student_roll_no : student_roll_no },
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month !!!');
		$('#student_list').html('');
	}
    }else{
        alert("Please Select Atleast One student !!!");
        $('#student_list').html('');
    }
}

function print_list3(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var head_value = $("input[name='select_head']:checked").val();
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!='' && head_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_list_for_print_tablewise.php",
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,head_value:head_value,student_note:student_note },
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month And One Head !!!');
		$('#student_list').html('');
	}
}

function print_list4(){
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
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var head_value = $("input[name='select_head']:checked").val();
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!='' && head_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_selected_student_list_for_print_tablewise.php",
		cache: false,
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,head_value:head_value,student_note:student_note,student_roll_no : student_roll_no },
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month And One Head !!!');
		$('#student_list').html('');
	}
    }else{
        alert("Please Select Atleast One student !!!");
        $('#student_list').html('');
    }
}


function print_list5(){
    $("#student_list").html(loader_div);
	var student_class=document.getElementById('student_class').value;
	var student_class_section=document.getElementById('student_class_section').value;
	var student_status=document.getElementById('student_status').value;
	var selected_month=[];
	$(".my_month").each(function() {
	if($(this).prop("checked") == true){
	    selected_month.push($(this).val());
	}
	});
	var head_value = $("input[name='select_head']:checked").val();
	var student_note=document.getElementById('student_note').value;
	if(student_class!='' && student_class_section!='' && selected_month!='' && head_value!=''){
		$.ajax({
		type: "POST",
		url: access_link+"fees_monthly/ajax_get_student_list_for_print_tablewise_exel.php",
		data: { student_class:student_class,student_class_section:student_class_section,student_status:student_status,selected_month:selected_month,head_value:head_value,student_note:student_note },
		cache: false,
		success: function(detail){
		$("#student_list").html(detail);
		}
		});
	}else{
		alert('Please Select Atleast One Class, One Month And One Head !!!');
		$('#student_list').html('');
	}
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
$.ajax({
	url: access_link+"fees_monthly/student_transport_fee_dues_list_statuswise_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
			alert('Message Successfully Sent.');
			get_content('fees_monthly/student_transport_fee_dues_list_statuswise');			   
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
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
		<li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active">Transport Fees Dues List</li>
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
				  <select name="student_class_section" class="form-control" id="student_class_section" required>
				  <option value="All">All</option>
				  </select>
				</div>
			</div>
			<div class="col-md-7">
			<label>Write Your Message</label>
			<input type="text" name="student_message" id="student_message" placeholder="Write Your Message" class="form-control" />
			</div>
			<div class="col-md-2">				
				<div class="form-group" >
				  <label>Status</label>
				  <select name="student_status" class="form-control" id="student_status" required>
				  <option value="Active">Active</option>
				  <option value="Tc_issued">TC Issued</option>
				  <option value="Deactive">Deleted</option>
				  <option value="All">All</option>
				  </select>
				</div>
			</div>
			
		</div>
		
		<div class="box-body  col-md-12">
		    <div class="col-md-10 col-md-offset-1" style="border:1px solid;border-radius:15px;">
		        <div class="col-md-10"><h4>Select Months</h4></div>
		        <div class="col-md-2"><span style="float:right;font-weight:bold;color:red;"><input type="checkbox" name="" id="my_month" onclick="for_check(this.id,'Yes');" /> All</span></div>
                <?php
                $que1="select * from school_info_monthly_transport_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
                $run1=mysqli_query($conn73,$que1);
                while($row1=mysqli_fetch_assoc($run1)){
                $fees_type_name = $row1['fees_type_name'];
                $fees_code = $row1['fees_code'];
                ?>
                <div class="col-md-3"><input type="checkbox" name="select_month[]" value="<?php echo $fees_code; ?>" class="my_month" onclick="for_msg();" /> <?php echo $fees_type_name; ?></div>
                <?php } ?>
		    </div>
		</div>
		
		<div class="box-body  col-md-12">
		    <div class="col-md-8">
		    <label>Note : <small style="color:blue;">( This Area Use Only for Print Dues List )</small></label>
		    <input type="text" name="" id="student_note" placeholder="Please Write Dues Note Here" class="form-control" />
		    </div>
		    <div class="col-md-2">
		    <center>
		    <label>Click For Print List :</label>
		    <!-- <button type="button" onclick="print_list();" class="btn btn-info">For List Print</button> -->
                <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">For List Print
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <li style="cursor: pointer;" onclick="print_list();"><a>All</a></li>
                <li class="divider"></li>
                <li style="cursor: pointer;" onclick="print_list1();"><a>Selected</a></li>
                <!--
                <li class="divider"></li>
                <li style="cursor: pointer;" onclick="print_list3();"><a>All Tablewise</a></li>
               
                <li class="divider"></li>
                <li style="cursor: pointer;" onclick="print_list5();"><a>All Tablewise in excel</a></li> -->
                
                </ul>
                </div>
		    </center>
		    </div>
		    <div class="col-md-2">
		    <center>
		    <label>Click For Dues List :</label>
		    <button type="button" class="btn my_background_color" onclick="student_list();" > Show List</button>
		    </center>
		    </div>
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-12" style="border:1px solid;">
		<div class="col-md-12"><center><u><h4 style="color:red;">Dues List</h4></u></center></div>
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10" id="student_list">
				
				</div>
				<div class="col-md-1"><span style="float:right;font-weight:bold;color:red;"><input type="checkbox" name="" id="my_no" onclick="for_check(this.id,'No');" checked /> All</span></div>
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
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->


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
          <!-- <button type="button" class="btn my_background_color" onclick="print_list4();" data-dismiss="modal">Open List Tablewise</button> -->
        </div>
      </div>
      
    </div>
  </div>
<!------  End Model ------->

<script>
for_msg();
</script>