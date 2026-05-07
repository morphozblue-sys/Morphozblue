<?php include("../attachment/session.php"); ?>

<script>
function for_list(){
//var from_date=document.getElementById('from_date').value;

var bus_no=document.getElementById('bus_no').value;
var student_class=document.getElementById('student_class').value;
var bus_stop_details=document.getElementById('bus_stop_details').value;
//var no_of_installment=document.getElementById('no_of_installment').value;

var count=0;
var fee_head=[];
$(".my_head").each(function() {
if($(this).prop("checked") == true){
count=Number(count+1);
fee_head.push($(this).val());
}
});

if(count==1){
$(".my_head").each(function() {
$(this).attr("disabled",true);
});
$('#head_'+fee_head).attr("disabled",false);
}else{
$(".my_head").each(function() {
$(this).attr("disabled",false);
});
}


$("#pdf_detail").html('');


$("#pdf_detail").html(loader_div);
if(fee_head!=''){
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_list_buswise_report.php",
	  data:{ bus_no:bus_no,student_class:student_class,bus_stop_details:bus_stop_details,fee_head:fee_head },
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
}else{
$("#pdf_detail").html('');
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

function validate(){
	var add1=0;
	$(".info1").each(function() {
	if($(this).prop('checked')==true){
		add1 = parseInt(add1+1);
	}
	});
	if(add1>0){
		return true;
	}else{
		alert('Please Select Atleast One Student !!!');
		return false;
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
        Download Bus Id Card
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> Fees Panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Bus Id Card</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">student List Buswise Report download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-3" id="search_detail">
				
				<div class="col-md-2">				
				<div class="form-group" >
				<label>Bus Detail</label>
                <select class="form-control" name="bus_no" id="bus_no" onchange="for_list();" required>
                <option value="All">All</option>
                <?php
                $que="select * from bus_details";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
                $bus_name = $row['bus_name'];
                $bus_company = $row['bus_company'];
                $bus_model_no = $row['bus_model_no'];
                $bus_no = $row['bus_no'];
                $bus_id = $row['bus_id'];
                ?>
                <option value="<?php echo $bus_no; ?>"><?php echo $bus_name.' ['.$bus_company.']-['.$bus_model_no.']-['.$bus_no.']'; ?></option>
                <?php } ?>
                </select>
				</div>
				</div>
								
				<div class="col-md-2 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
						<select name="student_class" onchange="for_list();" id="student_class" class="form-control">
						       <option value="All">All</option>
						       <?php $class37=$_SESSION['class_name37'];
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
				<div class="form-group" >
				<label>Route</label>
                <select class="form-control" name="bus_stop_details" id="bus_stop_details" onchange="for_list();" required>
                <option value="All">All</option>
                <?php
                $que12="select * from bus_stop_details";
                $run12=mysqli_query($conn73,$que12);
                while($row12=mysqli_fetch_assoc($run12)){
                $bus_route = $row12['bus_route'];
                ?>
                <option value="<?php echo $bus_route; ?>"><?php echo $bus_route; ?></option>
                <?php } ?>
                </select>
				</div>
				</div>
				
			</div>
			<br/>
			<div class="col-md-12">
 
			    <?php
                    $que0="select * from school_info_fee_types where fee_type!='' and session_value='$session1' and (fee_type like '%Transport%' || fee_type like '%Bus%')$filter37";
                    $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
                    while($row0=mysqli_fetch_assoc($run0)){
                    $s_no=$row0['s_no'];
                    $fee_type = $row0['fee_type'];
                    $fee_code = $row0['fee_code'];
                    if((substr_count($fee_type, 'Transport')>0) || (substr_count($fee_type, 'Bus')>0)){
                    ?>
                    <center>
                    <input type="checkbox" name="month_head[]" onclick="for_list();" class="my_head" id="<?php echo 'head_'.$fee_code; ?>" value="<?php echo $fee_code; ?>"> <?php echo $fee_type; ?>
                    </center>
                    <?php
                    } }
                    ?>
			    
			</div>
			
            <div class="col-md-12">
            <hr/>
            </div>
					
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