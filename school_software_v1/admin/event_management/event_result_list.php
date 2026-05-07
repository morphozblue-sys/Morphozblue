<?php include("../attachment/session.php"); ?>
<script>
function for_search11(){
//var company_name12=document.getElementById('company_name12').value;
var event_name=document.getElementById('event_name').value;
var house_wise=document.getElementById('house_wise').value;
var remarks=document.getElementById('remarks').value;
if(event_name!='' || house_wise!='' || remarks!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"event_management/ajax_event_result.php?event_name="+event_name+"&house_wise="+house_wise+"&remarks="+remarks+"",
success: function(detail){
//alert_new(detail);
$('#for_student_list').html(detail);
  }
});

}else{
$('#for_student_list').html('');
}
}

function validation(){
    var add=0;
    $(".checked1").each(function() {
	if($(this).is(':checked')){
	  add = ParseInt(add+1);  
	}
	});
	if(add<1){
	    alert_new('Please Select Atleast One Student !!!','red');
	    return false;
	}else{
	    return true;
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

function valid(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	for_delete(s_no);
	}
	else  {
	return false;
	}
	}
	
	function for_delete(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"event_management/ajax_dlt_event_result.php?sno="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('event_management/event_result_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}

</script>	

    <section class="content-header">
      <h1>
         Event Result List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-list"></i> Event Result List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			<form action="event_management/download_event_result" method="post">
            <div class="box-body">
			     <div class="box-body table-responsive">
              <div class="col-md-12">&nbsp;</div>
              <div class="col-md-12">
			  
              <div class="col-md-2"></div>
              <div class="col-md-8">
			  <div class="container-fluid">
			  
			  <div class="panel panel-default">
			  <div class="panel-body">
			   
				<div class="col-md-4">
				<label>Events</label>
				     <select name="event_name" class="form-control" id="event_name" onchange="for_search11();" required>
						  <option value="All">All</option>
						  <?php
						$query="select * from event_table GROUP BY event_name";
						$res=mysqli_query($conn73,$query);
						while($row=mysqli_fetch_assoc($res)){
						$s_no=$row['s_no'];
						$event_name=$row['event_name'];
						  ?>
					<option value="<?php echo $event_name; ?>"><?php echo $event_name; ?></option>
						  <?php } ?>
						  </select>
				</div>	
				<div class="col-md-4">
				<label>House Wise</label>
					<select name="house" id="house_wise" style="width:100%;" class="form-control" onchange="for_search11();">
					<option value="All">All</option>
					<?php
						$query1="select * from event_house";
						$res1=mysqli_query($conn73,$query1);
						while($row1=mysqli_fetch_assoc($res1)){
						$s_no=$row1['s_no'];
						$house=$row1['house'];
					?>
						<option value="<?php echo $house; ?>"><?php echo $house; ?></option>
						  <?php } ?>
					</select>
				</div>	
				<div class="col-md-4">
				<label>Results Remarks</label>
				   	<select name="remarks" id="remarks" style="width:100%;" class="form-control" onchange="for_search11();">
					<option value="All">All</option>
					<?php
						$query2="select * from event_result group By remark";
						$res2=mysqli_query($conn73,$query2);
						while($row2=mysqli_fetch_assoc($res2)){
						$s_no=$row2['s_no'];
						$remark=$row2['remark'];
					?>
						<option value="<?php echo $remark; ?>"><?php echo $remark; ?></option>
						  <?php } ?>
					</select>
				</div>
				
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-md-2"></div>
<div id="for_student_list">

</div>
        </div>
        <!-- /.col -->
      </div>
			
			<div class="col-md-12">
			<div class="col-md-12">						
			  <div class="box-body table-responsive">
             
            </div>
				</div>
				
				
		</div>
			</div>
			</form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
           </div>
     </div>
     </section>

<script>

 for_search11();
</script>

