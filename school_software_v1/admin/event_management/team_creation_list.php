<?php include("../attachment/session.php"); ?>
<script>
function for_search11(){

var event_name=document.getElementById('event_name').value;
if(event_name!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"event_management/ajax_team_creation_list.php?event_name="+event_name+"",
success: function(detail){
//alert_new(detail);
$('#for_student_list').html(detail);
  }
});

}else{
$('#for_student_list').html('');
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
</script>
<script>
	function valid(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	for_fee(s_no);
	}
	else  {
	return false;
	}
	}
	
	function for_fee(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"event_management/dlt_team_participants.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('event_management/team_creation_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	
	
	function valid1(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	for_fee1(s_no);
	}
	else  {
	return false;
	}
	}
	
	function for_fee1(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"event_management/dlt_team_staff.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('event_management/team_creation_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	</script>

    <section class="content-header">
      <h1>
         Team Creation List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-list"></i>Team Creation List</li>
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
			<form action method="post">
            <div class="box-body">
			     <div class="box-body table-responsive">
              <div class="col-md-12">&nbsp;</div>
              <div class="col-md-12">
			  
              <div class="col-md-2"></div>
              <div class="col-md-8">
			  <div class="container-fluid">
			  
			  <div class="panel panel-default">
			  <div class="panel-body">
			   
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<label>Events</label>
				     <select name="event_name" class="form-control" id="event_name" onchange="for_search11();" required  >
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
<div class="col-md-3"></div>				
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
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
           </div>
     </div>
     </section>
	<script>
	for_search11();
	</script>