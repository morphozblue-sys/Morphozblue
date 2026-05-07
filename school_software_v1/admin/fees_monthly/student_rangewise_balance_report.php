<?php include("../attachment/session.php"); ?>

<style>
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}
</style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	    <li><a href="javascript:get_content('fees_monthly/reports')"><i class="fa fa-money"></i> Reports Panel</a></li>
        <li class="active">Balance Details</li>
      </ol>
    </section>
	
<script>
function for_section(value){
   $('#student_class_section').html("<option value='' >Loading....</option>");
   $.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/ajax_classwise_section_all.php?class_name="+value+"",
		  cache: false,
		  success: function(detail){
			$("#student_class_section").html(detail);
			for_feelist();
		  }
	   });
}

function for_feelist(){
   $("#fee_details").html(loader_div);
   var student_class=document.getElementById('student_class').value;
   var student_section=document.getElementById('student_class_section').value;
   var bus_fee_category_code=document.getElementById('bus_fee_category_code').value;
   var myRange=document.getElementById('myRange').value;
   var for_paid_balance=document.getElementById('for_paid_balance').value;
   var for_less_greater=document.getElementById('for_less_greater').value;
   var order_by=document.getElementById('order_by').value;
   if(student_class!='' && student_section!='' && bus_fee_category_code!='' && myRange!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_rangewise_balance_report.php?student_class="+student_class+"&student_section="+student_section+"&bus_fee_category_code="+bus_fee_category_code+"&myRange="+myRange+"&for_paid_balance="+for_paid_balance+"&for_less_greater="+for_less_greater+"&order_by="+order_by+"",
	  cache: false,
	  success: function(detail){
		$("#fee_details").html(detail);
	  }
   });
   }else{
	   $("#fee_details").html('');
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

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		
		<div class="box-body  col-md-12">
		
		<div class="col-md-12">
		
		<div class="col-md-6 col-md-offset-3">
		<div class="col-md-4">
		<div class="form-group">
		<label>For Paid/Balance</label>
		<select name="for_paid_balance" id="for_paid_balance" class="form-control" onchange="for_feelist();" >
          <option value="paid_total">Paid</option>
          <option value="balance_total">Balance</option>
        </select>
        </div>
        </div>
        <div class="col-md-4">
		<div class="form-group">
		<label>For Less/Greater</label>
		<select name="for_less_greater" id="for_less_greater" class="form-control" onchange="for_feelist();" >
          <option value="<=">Less</option>
          <option value=">=">Greater</option>
        </select>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
        <label>Order By</label>
        <select class="form-control" name="order_by" id="order_by" onchange="for_feelist();">
        <option value="">Select</option>
        <option value=" ORDER BY student_name ASC">By Name</option>
        </select>
        </div>
        </div>
        </div>
		
		</div>
		<div class="col-md-12">
		
		<div class="col-md-2">
			<div class="form-group">
			  <label>Select Class</label>
			   <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
			   <option value="All">All Class</option>
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
			<div class="form-group">
			  <label>Section</label>
			  <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feelist();" required>
			  <option value="All">All</option>
			  </select>
			</div>
		</div>
		<div class="col-md-3">
		<div class="form-group">
         <label>Bus Category</label>
         <select class="form-control select2" name="bus_fee_category_code" id="bus_fee_category_code" style="width:100%" onchange="for_feelist();">
                   <option  value="All">All</option>
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
		<div class="col-md-6">
		<div class="form-group">
        <?php
        $query01="select total_fee from common_fees_fee_structure where session_value='$session1'$filter37";
        $run01=mysqli_query($conn73,$query01);
        $greater_val=0;
        while($row01=mysqli_fetch_assoc($run01)){
        $total_fee=$row01['total_fee'];
        if($total_fee>=$greater_val){
        $greater_val=$total_fee;
        }else{
        $greater_val=$greater_val;
        }
        }
        $total_fee_range=$greater_val+50000;
        ?>
         <label>Fee Range</label>
		<div class="""slidecontainer">
          <input type="range" min="0" max="<?php echo $total_fee_range; ?>" value="0" step="5" class="slider" id="myRange" onchange="for_feelist();" />
          <p style="color:blue;">Value : <span id="demo"></span></p>
        </div>
		</div>
		</div>
		
		</div>
		
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-12" style="overflow:scroll;border:1px solid;" id="fee_details">
		
		</div>
		  
		    
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
<script>
for_feelist();
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
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