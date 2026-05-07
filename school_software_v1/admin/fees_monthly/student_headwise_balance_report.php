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

function for_list(){
var class_name=document.getElementById('std_class').value;
var section_name=document.getElementById('student_class_section').value;
var bus_fee_category_code=document.getElementById('bus_fee_category_code').value;
var order_by=document.getElementById('order_by').value;
if($('#student_bus_fee_category').prop("checked") == true){
var bus_fee_category=$('#student_bus_fee_category').val();
}else{
var bus_fee_category="";
}

var head_code = [];
var head_name = [];
$(".my_head").each(function() {
if($(this).prop("checked") == true){
head_code.push($(this).val());
head_name.push($(this).attr('id'));
}
});

var previous_head_dues='';
if($('#previous_head').prop("checked") == true){
previous_head_dues='Yes';
}

var transport_head_dues='';
if($('#transport_head').prop("checked") == true){
transport_head_dues='Yes';
}

$("#pdf_detail").html('');

if(class_name!='' && section_name!='' && (head_code!='' || previous_head_dues!='' || transport_head_dues!='')){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_headwise_balance_report.php",
	  cache: false,
	  data:{ class_name:class_name, section_name:section_name, head_code:head_code, head_name:head_name, bus_fee_category_code:bus_fee_category_code, order_by:order_by, bus_fee_category:bus_fee_category, previous_head_dues:previous_head_dues, transport_head_dues:transport_head_dues },
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
        Download Student Balance Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li><a href="javascript:get_content('fees_monthly/reports')"><i class="fa fa-money"></i> Reports Panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Balance Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <div class="col-md-8">
              <h3 class="box-title">Balance Report download</h3>
              </div>
              <div class="col-md-4">
              <input type="checkbox" id="student_bus_fee_category" onclick="for_list();" value="student_bus_fee_category" /> <b>Print Bus Category Name</b>
              </div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12" id="search_detail">
								
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

				<div class="col-md-1">
				<div class="form-group">
				<label>Section</label>
				<select class="form-control" name="student_class_section" id="student_class_section" onchange="for_list();">
				<option value="All">All</option>
				</select>
				</div>
				</div>
				
				<div class="col-md-5">				
                    <?php
                    $que0="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
                    $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
                    while($row0=mysqli_fetch_assoc($run0)){
                    $s_no=$row0['s_no'];
                    $fee_type = $row0['fee_type'];
                    $fee_code = $row0['fee_code'];
                    ?>
                    <div class="col-md-4">
                    <input type="checkbox" name="month_head[]" onclick="for_list();" class="my_head" id="<?php echo $fee_type; ?>" value="<?php echo $fee_code; ?>"> <?php echo $fee_type; ?>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-4">
                    <input type="checkbox" name="" onclick="for_list();" id="previous_head" value=""> Previous Dues
                    </div>
                    <div class="col-md-4">
                    <input type="checkbox" name="" onclick="for_list();" id="transport_head" value=""> Transport Fee
                    </div>
				</div>
				
				<div class="col-md-2">				
                <div class="form-group">
                <label>Bus Fee Category</label>
                <select class="form-control" name="bus_fee_category_code" id="bus_fee_category_code" onchange="for_list();">
                <option value="All">All</option>
                <?php
                $query18="select * from bus_fee_category where bus_fee_category_name!=''";
                $run18=mysqli_query($conn73,$query18) or die(mysqli_error($conn73));
                while($row=mysqli_fetch_assoc($run18)){
                $bus_fee_category_name=$row['bus_fee_category_name'];
                $bus_fee_category_code=$row['bus_fee_category_code'];
                ?>
                <option value="<?php echo $bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
                <?php } ?>
                </select>
                </div>
                </div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Order By</label>
				<select class="form-control" name="order_by" id="order_by" onchange="for_list();">
				<option value="">Select</option>
				<option value=" ORDER BY student_name ASC">By Name</option>
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
</script>
<script>
for_list();
</script>