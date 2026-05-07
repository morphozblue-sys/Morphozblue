<?php include("../attachment/session.php"); ?>
<script>
function for_search11(){
//var company_name12=document.getElementById('company_name12').value;
var sports_name=document.getElementById('sports_name').value;
var age_category=document.getElementById('age_category').value;
if(sports_name!='' && age_category!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"sports/ajax_team_creation_list.php?sports_name="+sports_name+"&age_category="+age_category+"",
success: function(detail){
////alert_new(detail);
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
	}else{
	return false;
	}
	}
	
	function for_fee(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"sports/dlt_team_participants.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	alert_new('Successfully Deleted','green');
	get_content('sports/team_creation_list');
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
	url: access_link+"sports/dlt_team_staff.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('sports/team_creation_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Team Creation List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"><i class="fa fa-futbol-o"></i> Sport Management</a></li>
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
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12">
			  
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
			  <div class="container-fluid">
			  
			  <div class="panel panel-default">
			  <div class="panel-body">
			   
				<div class="col-sm-3"></div>
				<div class="col-sm-3">
				<label>Sports Name</label>
				        <select name="sports_name" class="form-control" id="sports_name" onchange="for_search11();" required  >
						  <option value="All">All</option>
							<?php
							$query="select * from sports_table GROUP BY sports_name";
							$res=mysqli_query($conn73,$query);
							while($row=mysqli_fetch_assoc($res)){
							$s_no=$row['s_no'];
							$sports_name=$row['sports_name'];
							?>
							<option value="<?php echo $sports_name; ?>"><?php echo $sports_name; ?></option>
							<?php } ?>
						</select>
				</div>	
				<div class="col-sm-3">
				<label>Age Category</label>
				       <select name="age_category" class="form-control" id="age_category" onchange="for_search11();" required >
						  <option value="All">All</option>
							<?php
							$query1="select * from sports_team_creation GROUP BY age_category";
							$res1=mysqli_query($conn73,$query1);
							while($row1=mysqli_fetch_assoc($res1)){
							$s_no=$row1['s_no'];
							$age_category=$row1['age_category'];
							?>
							<option value="<?php echo $age_category; ?>"><?php echo $age_category; ?></option>
							<?php } ?>
						</select>
				</div>
<div class="col-sm-3"></div>				
			</div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-2"></div>
<div id="for_student_list">

</div>
        </div>
        <!-- /.col -->
      </div>

			</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
           </div>
     </div>
     </section>
	    <!-- /.content -->
	    <script>
	    for_search11();
	    </script>
  