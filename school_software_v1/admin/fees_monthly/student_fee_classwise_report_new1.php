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
		 for_list();
	  }
   });
}

function for_list(value=''){
var class_name=document.getElementById('std_class').value;
var section_name=document.getElementById('student_class_section').value;
var order_by=document.getElementById('order_by').value;
var payment_mode=document.getElementById('payment_mode').value;
var student_roll_no='';
if(value!='')
{
 student_roll_no=value;   
}

$("#div_from_date").hide();
$("#div_to_date").hide();
//$("#search_detail").removeClass('col-md-12 col-md-offset-1').addClass('col-md-12 col-md-offset-3');
$("#pdf_detail").html('');

if(class_name!='' && section_name!=''){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_classwise_fee_report_installmentwise_new1.php?class_name="+class_name+"&section_name="+section_name+"&order_by="+order_by+"&payment_mode="+payment_mode+"&student_roll_no="+student_roll_no+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
}


}
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
        Download Classwise Fee Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li><a href="javascript:get_content('fees_monthly/reports')"><i class="fa fa-money"></i> Reports Panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Classwise Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <!--<div class="col-md-4"><h3 class="box-title">Classwise Fee Report download</h3></div>
              <div class="col-md-2"><center><input type="radio" name="list_type" value="Installmentwise" class="list_type" onclick="for_list();" checked /> <b>Classwise</b></center></div>
              <div class="col-md-2"><center><input type="radio" name="list_type" value="Random" class="list_type" onclick="for_list();" /> <b>Datewise</b></center></div>
              <div class="col-md-4">&nbsp;</div>-->
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12" id="search_detail">
				
					<div class="col-md-4">				
					<div class="form-group" >
					<label><?php echo $language['Search Student']; ?></label>
					<select name="" class="form-control select2" id="selected_student" onchange="for_list(this.value);" style="width:100%;" required>
					<option value=""><?php echo $language['Select student']; ?></option>
					<?php
					$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'";
					$rest=mysqli_query($conn73,$qry);
					while($row22=mysqli_fetch_assoc($rest)){
					$student_roll_no3=$row22['student_roll_no'];
					$school_roll_no3=$row22['school_roll_no'];
					$student_name3=$row22['student_name'];
					$student_class3=$row22['student_class'];
					$student_section3=$row22['student_class_section'];
					$student_father_name3=$row22['student_father_name'];
					$student_father_contact_number3=$row22['student_father_contact_number'];
					$student_admission_number=$row22['student_admission_number'];
					?>
					<option <?php if (isset($_GET['student_roll_no'])) { if($_GET['student_roll_no']==$student_roll_no3){ echo 'selected';} } ?> value="<?php echo $student_roll_no3; ?>"><?php echo $student_name3."[".$student_admission_number."]-[".$school_roll_no3."]-[".$student_class3."-".$student_section3."]-[".$student_father_name3."-".$student_father_contact_number3."]"; ?></option>
					<?php
					}
					?>
					</select>
					</div>
			</div>
				    				
				<div class="col-md-2">				
				<div class="form-group" >
				<label>Class</label>
				<select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);" >
				<option value="All">All Class</option>
				<?php 
				$sql= "select * From school_info_class_info";
				$result=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($result)){
				$class_name=$row['class_name'];
				?>
				<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				</div>
				</div>

				<div class="col-md-2">
				<div class="form-group">
				<label>Section</label>
				<select class="form-control" name="student_class_section" id="student_class_section" onchange="for_list();">
				<option value="All">All</option>
				</select>
				</div>
				</div>

				
				<div class="col-md-2">
				<div class="form-group">
				<label>Order By</label>
				<select class="form-control" name="order_by" id="order_by" onchange="for_list();">
				<option value="">Select</option>
				<option value=" ORDER BY student_name ASC">By Name</option>
				<option value=" ORDER BY blank_field_5 ASC">By Receipt No.</option>
				<option value=" ORDER BY fee_submission_date ASC">By Date</option>
				<option value=" ORDER BY student_class ">By Date</option>
				</select>
				</div>
				</div>
				
				
					<div class="col-md-2">
				<div class="form-group">
				<label>Payment Mode</label>
				<select class="form-control" name="payment_mode" id="payment_mode" onchange="for_list();">
				<option value="All">All Mode</option>
				<option value="Cash">Cash</option>
				<option value="UPI">UPI</option>
				<option value="Cheque">Cheque</option>
				<option value="NEFT">NEFT</option>
		
				</select>
				</div>
				</div>
				
			</div>
			
			</br></br></br><hr>
					
			<div class="col-md-12" id="pdf_detail">
			
			</div>
			
	        </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

$(function () {
    $('.select2').select2();
  });
</script>
