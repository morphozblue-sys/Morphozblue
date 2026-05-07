<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active">Balance Details</li>
      </ol>
    </section>
	
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>
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
   var month_code = [];
   //var month_name = [];
   $(".my_check").each(function() {
   if($(this).prop("checked") == true){
   month_code.push($(this).val());
   //month_name.push($(this).attr('id'));
   }
   });
   
   if($("#transport_head_yearly").prop("checked") == true){
   var transport_head_yearly=document.getElementById('transport_head_yearly').value;
   }else{
   var transport_head_yearly='';
   }
   
   if($("#transport_head_monthly").prop("checked") == true){
   var transport_head_monthly=document.getElementById('transport_head_monthly').value;
   }else{
   var transport_head_monthly='';
   }
   
   if($("#previous_head_yearly").prop("checked") == true){
   var previous_head_yearly=document.getElementById('previous_head_yearly').value;
   }else{
   var previous_head_yearly='';
   }
   //alert(transport_head_yearly+select_head_code+previous_head_yearly);
   
   if(student_class!='' && student_section!='' && month_code!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_fee_balance_details_random.php",
	  data: {student_class:student_class,student_section:student_section,month_code:month_code,transport_head_yearly:transport_head_yearly,transport_head_monthly:transport_head_monthly,previous_head_yearly:previous_head_yearly},
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
		<div class="col-md-10 col-md-offset-1">
		
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
		
		<div class="col-md-2">
			<div class="form-group">
			  <label>Section</label>
			  <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feelist();" required>
			  <option value="All">All</option>
			  </select>
			</div>
		</div>
		
        <div class="col-md-5">
            <div class="col-md-12"><h4>Select Head</h4></div>
            <div class="col-md-6"><input type="checkbox" id="transport_head_yearly" value="transport_head_yearly" onclick="for_feelist();" /> Yearly Transport Fee</div>
            <?php
            $que="select * from school_info_fee_types where fee_type!='' and session_value='$session1' and (fee_type like '%Transport%' || fee_type like '%Bus%')$filter37";
            $run=mysqli_query($conn73,$que);
            while($row=mysqli_fetch_assoc($run)){
        	$s_no=$row['s_no'];
        	$fee_type = $row['fee_type'];
        	$fee_code = $row['fee_code'];
        	?>
        	<div class="col-md-6"><input type="checkbox" id="transport_head_monthly" value="<?php echo $fee_code; ?>" class="" onclick="for_feelist();" /> <?php echo $fee_type; ?></div>
        	<?php } ?>
        </div>
        
        <div class="col-md-3">
            <div class="col-md-12"><h4>Select Head</h4></div>
            <div class="col-md-12"><input type="checkbox" id="previous_head_yearly" value="previous_head_yearly" onclick="for_feelist();" class="" /> Previous Year Dues Fee</div>
        </div>
		
		<div class="col-md-12">
		<?php
		$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
		$run01=mysqli_query($conn73,$que01);
		$a=0;
		while($row01=mysqli_fetch_assoc($run01)){
		$fees_code[$a] = $row01['fees_code'];
		$fees_type_name[$a] = $row01['fees_type_name'];
		?>
		<div class="col-md-2">
			<input type="checkbox" id="<?php echo $fees_type_name[$a]; ?>" class="my_check" value="<?php echo $fees_code[$a]; ?>" onclick="for_feelist();" /><span style="font-weight:bold;"> <?php echo $fees_type_name[$a]; ?></span>
		</div>
		<?php $a++; } ?>
		</div>
		
		</div>
		    
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-10 col-md-offset-1" style="overflow:scroll;border:1px solid;" id="fee_details">
		
		</div>
		  
		    
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
for_feelist();
</script>