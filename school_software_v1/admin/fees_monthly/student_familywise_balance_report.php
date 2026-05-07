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
	    <li><a href="javascript:get_content('fees_monthly/reports')"><i class="fa fa-money"></i> Reports Panel</a></li>
        <li class="active">Balance Details</li>
      </ol>
    </section>
	
<script>
function for_feelist(){
   $("#fee_details").html(loader_div);
   var student_family=document.getElementById('student_family').value;
   var order_by=document.getElementById('order_by').value;
   
    var select_inst = [];
    var select_inst_count = 0;
    $(".sel_installments").each(function() {
    if($(this).prop("checked") == true){
    select_inst.push($(this).val());
    select_inst_count = Number(select_inst_count+1);
    }
    });
   
   if(student_family!='' && select_inst_count>0){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_familywise_balance_report.php",
	  data : {student_family:student_family, order_by:order_by, select_inst:select_inst, select_inst_count:select_inst_count},
	  cache: false,
	  success: function(detail){
		$("#fee_details").html(detail);
	  }
   });
   }else{
	   $("#fee_details").html('');
   }
}

function for_check(id){

if($("#"+id).prop("checked") == true){
$("."+id).each(function() {
$(this).prop("checked",true);
});
}else{
$("."+id).each(function() {
$(this).prop("checked",false);
});
}
for_feelist();

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
		
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-8">
        <?php
        $que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
        $run1=mysqli_query($conn73,$que1);
        while($row1=mysqli_fetch_assoc($run1)){
        $fees_type_name = $row1['fees_type_name'];
        $fees_code = $row1['fees_code'];
        ?>
        <div class="col-md-2">
        <input type="checkbox" class="sel_installments" value="<?php echo $fees_code; ?>" onclick="for_feelist();" /> <?php echo $fees_type_name; ?>
        </div>
        <?php } ?>
        </div>
        <div class="col-md-2"><input type="checkbox" id="sel_installments" onclick="for_check(this.id);" /> <b style="color:red;">All</b></div>
        
        <div class="col-md-12">&nbsp;</div>
        
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-6">
		<div class="col-md-12">
		
			<div class="form-group">
			  <label>Select Family Member</label>
			   <select name="student_family" id="student_family" class="form-control select2" width="100%" onchange="for_feelist();" >
			   <option value="All">All Families</option>
			   <?php
                $que2="select student_family_id from student_admission_info where session_value='$session1' and student_status='Active' and student_family_id!='' GROUP BY student_family_id";
                $run2=mysqli_query($conn73,$que2);
                while($row2=mysqli_fetch_assoc($run2)){
                $student_family_id=$row2['student_family_id'];
                
                $que3="select * from student_admission_info where session_value='$session1' and student_status='Active' and student_family_id='$student_family_id'";
                $run3=mysqli_query($conn73,$que3);
                if(mysqli_num_rows($run3)>=2){
                $student_name='';
                $sep_var='';
                while($row3=mysqli_fetch_assoc($run3)){
                if($student_name!=''){
                    $sep_var=' | ';
                }
                $student_name=$student_name.$sep_var.$row3['student_name'].' ('.$row3['student_class'].'-'.$row3['student_class_section'].')';
                $student_father_name=$row3['student_father_name'];
                $student_father_contact_number=$row3['student_father_contact_number'];
                
                }
			   ?>
			   <option value="<?php echo $student_family_id; ?>"><?php echo $student_father_name.' ('.$student_father_contact_number.') [ '.$student_name.' ]'; ?></option>
			   <?php } } ?>
			   </select>
			</div>
		
		</div>
		</div>
        <div class="col-md-2">
        <div class="form-group">
        <label>Order By</label>
        <select class="form-control" name="order_by" id="order_by" onchange="for_feelist();">
        <option value="">Select</option>
        <option value=" ORDER BY student_father_name ASC">By Father Name</option>
        </select>
        </div>
        </div>
		<div class="col-md-2">&nbsp;</div>
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-12" style="border:1px solid;" id="fee_details">
		
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