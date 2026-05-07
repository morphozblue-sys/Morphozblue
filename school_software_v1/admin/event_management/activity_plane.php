<?php include("../attachment/session.php"); ?>
<style type="text/css">
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 80%;
        left: 0;
		background:white;
    }
    .search-box input[type="text"], .result{
        width: 90%;
		margin-left:5%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>

<script>
function event_select(value){ 
var event_name=document.getElementById('event_name').value; 
//alert_new(event_name);
  $.ajax({
  address: "POST",
  url: access_link+"event_management/ajax_activity_plane.php?id="+value+"",
  cache:false,
  success: function(detail){
  var str=detail;
  	  var res = str.split("|?|");
	    //$("#s_no").val(value); 
		$("#total_participats").val(res[0]); 
		//$("#event_name1").val(); 
		participants_select(value);
  }
  })
}
function participants_select(value){ 
var event_name=document.getElementById('event_name').value;
$("#participants").html(loader_div);
//alert_new(event_name);
  $.ajax({
  address: "POST",
  url: access_link+"event_management/ajax_participants_list.php?id="+value+"",
  cache:false,
  success: function(detail){
  $("#participants").html(detail);

  }
  })
}
</script>
<script>
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
   
   function validation(){
   var add=0;
   $(".checked1").each(function() {
	if($(this).prop("checked") == true){
	add=add+1;
	}
	});
    if(add>0){
	return true;
	}else{
	alert_new("Please Select Atleast One Student !!!",'red');
	return false;
	}
   }
        $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"event_management/activity_plane_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            //$("#participants").html(detail);
			//alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('event_management/activity_plane_list');
            }
			}
         });
      });
</script>

    <section class="content-header">
       <h1>
         Activity Plan
	    <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Activity Plan</li>
      </ol>
    </section>
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Activity Plane</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
	<form method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body">
			    <div class="col-md-9">		
			    <div class="col-md-3">		
				    <div class="form-group">
					  <label><small>Name Of Event Activity</small></label>
					    <select name="event_name" class="form-control" id="event_name" onchange="event_select(this.value);" required>
						<option value="">Select</option>
						<?php
						$query="select * from event_table";
						$res=mysqli_query($conn73,$query);
						while($row=mysqli_fetch_assoc($res)){
						$s_no=$row['s_no'];
						$event_name=$row['event_name'];
						$total_participats=$row['total_participats'];
						?>
					    <option value="<?php echo $event_name; ?>"><?php echo $event_name; ?></option>
						<?php } ?>
						</select>
				    </div>
				</div>
               <div class="col-md-3">
				 <div class="form-group">
					<label><small>Type Of The Activity</small></label>
					<input type="text"  name="activity_type" placeholder="Type Of The Activity"  id="" class="form-control" >
				</div>
			</div>
			  <div class="col-md-3">
				 <div class="form-group" >
				   <label><small>Organiser</font></small></label>
					<input type="text" name="organiser" placeholder="Organiser"  id="" class="form-control" >
				 </div>
			  </div>
		     <div class="col-md-3">
				<div class="form-group">
					<label><small>Objective</small></label>
					<input type="text"  name="objective" placeholder="Objective"   id="" class="form-control" >
				</div>
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Topic/Theme</small></label>
					<input type="text"  name="topic_theme" placeholder="Topic/Theme"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Venue</small></label>
					<input type="text"  name="venue" placeholder="Venue"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Date And Day</small></label>
					<input type="text"  name="date_day" placeholder="Date And Day"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Category</small></label>
					<input type="text"  name="category" placeholder="Category"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Name Of Committee</small></label>
					<input type="text"  name="committee" placeholder="Name Of Committee"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Name Of Incharge</small></label>
					<input type="text"  name="incharge" placeholder="Name Of Incharge"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>No Of Participants</small></label>
					<input type="text" name="no_participants" placeholder="No Of Participants" id="total_participats" value="" class="form-control">
				</div>
			</div>	
			
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Invitees</small></label>
					<input type="text" name="invitees" placeholder="Invitees" id="" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Circular/Invitation Card</small></label>
					<input type="text"  name="invitation_card" placeholder="Circular/invitation"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Distribution Of Invitation Card</small></label>
					<input type="text"  name="distribution_card" placeholder="Distribution Of Invitation Card"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Arrangement Of Sound System</small></label>
					<input type="text"  name="sound_system" placeholder="Arrangement Of Sound System"   id="" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Seating For Guest & Participants</small></label>
					<input type="text"  name="seating_guest" placeholder="Guest & Participants"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Arrangement Of Green Room</small></label>
					<input type="text"  name="green_room" placeholder="Arrangement Of Green Room"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Sound System/In Or Out Source</small></label>
					<input type="text"  name="out_source" placeholder="Sound System/In Or Out Source"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Stage Arrangement</small></label>
					<input type="text"  name="stage_arrangement" placeholder="Stage Arrangement"   id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Arrangement Of Light</small></label>
					<input type="text"  name="light_arrangement" placeholder="Arrangement Of Light"   id="" class="form-control">
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Name Of Judges</small></label>
					<input type="text"  name="name_judges" placeholder="Name Of Judges"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Time Duration</small></label>
					<input type="text"  name="time_duration" placeholder="Time Duration"   id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Compering</small></label>
					<input type="text"  name="compering" placeholder="Compering"  id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Preparation</small></label>
					<input type="text" name="preparation" placeholder="Preparation"  id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Preparation Of Script</small></label>
					<input type="text" name="preparation_script" placeholder="Preparation Of Script"  id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Photography</small></label>
					<input type="text" name="photography" placeholder="Photography"  id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Publicity/Banner/Pressnote</small></label>
					<input type="text" name="publicity_banner" placeholder="Publicity/Banner/Pressnote"  id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Refreshment Arrangement</small></label>
					<input type="text" name="refreshment" placeholder="Refreshment Arrangement"  id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Writting Of Report</small></label>
					<input type="text" name="writting_report" placeholder="Writting Of Report"  id="" class="form-control" >
				</div>
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Feedback From Students</small></label>
					<input type="text" name="feedback_students" placeholder="Writting Of Report"  id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Feedback From Parents</small></label>
					<input type="text" name="feedback_parents" placeholder="Writting Of Report"  id="" class="form-control" >
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Total Amount Spent</small></label>
					<input type="text" name="amt_spent" placeholder="Writting Of Report"  id="" class="form-control" >
				</div>
			</div>		
			<div class="col-md-3">
				<div class="form-group">
					<label><small>Review Of The Event</small></label>
					<input type="text" name="review_event" placeholder="Writting Of Report"  id="" class="form-control" >
				</div>
			</div>
			</div>
			<div class="col-md-3">
			<div class="col-md-12">
			<label><h3>Participants List</h3></label>
			</div>
			<div class="col-md-12" id="participants" style="height:560px;overflow-Y: auto;">
			</div>
			</div>
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
		  <div class="col-md-12">
		     <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" onclick="return validation();" /></center>
		  </div>
	</div>
	</form>
<!---------------------------------------------End Participate form--------------------------------------------------------->
		  
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  