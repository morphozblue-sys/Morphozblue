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

<script type="text/javascript">
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
function for_search11(){
var event_name=document.getElementById('event_name').value;
var gender=document.getElementById('gender').value;
var category=document.getElementById('category').value;
if(event_name!='' || gender!='' || category!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"event_management/ajax_team_creation.php?event_name="+event_name+"&gender="+gender+"&category="+category+"",
success: function(detail){
$('#for_student_list').html(detail);
$('#company_123').val('All').change();
  }
});

}else{
$('#for_student_list').html('');
$('#company_123').val('All').change();
}
}

 function validation(){
   var add=0;
   $(".checked1").each(function() {
	if($(this).prop("checked") == true){
	add=add+1;
	}
	});
	var add1=0;
   $(".checked2").each(function() {
	if($(this).prop("checked") == true){
	add1=add1+1;
	}
	});
    if(add>0 && add1>0){
	return true;
	}else{
	alert_new("Please Select Atleast One Student Or One Escorts !!!",'red');
	return false;
	}
   }
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#search-box input[type="text"]').on("keyup input", function(){
	//alert_new('sfdfg');
        /* Get input value on change */
	  var classs=document.getElementById('class_no').value;
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal,term2: classs}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
			
        } else{
            resultDropdown.empty();
        }
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents("#search-box").find('input[type="text"]').val($(this).text());
		$(this).parents("#search-box").find('input[type="text"]').focus();
        $(this).parent(".result").empty();
    });
});
</script>

<script>
   function data_fill(value){
   $(".type_data").each(function() {
	$(this).val(value);
	});
   }
   
function select_company(){
var event_name=document.getElementById('event_name').value;
if(event_name!=''){
    $('#student_name_company').html(loader_div);
 $.ajax({
 type:"POST",
 url: access_link+"event_management/ajax_staff_name.php?event_name="+event_name+"",
 success: function(detail){
 $('#student_name_company').html(detail);
 }
 });
 }else{
 $('#student_name_company').html('');
 }
 }
 	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"event_management/team_creation_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			//$('#student_name_company').html(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('event_management/team_creation_list');
            }
			}
         });
      });
</script>


    <section class="content-header">
      <h1>
       Event Result
	   <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Event Result</li>
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
              <h3 class="box-title">Event Result</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Participate form--------------------------------------------------->
		<form action="" method="post" id="my_form">
               <div class="box-body">
			     <div class="box-body table-responsive">
              <div class="col-md-12">&nbsp;</div>
              <div class="col-md-12">
			  
              <div class="col-md-1"></div>
              <div class="col-md-10">
			  <div class="container-fluid">
			  
			 <div class="panel panel-default">
			  <div class="panel-body">
			    
			    
			    <div class="col-md-3">
				  <label>Event Name</label>
				    <select name="event_name11" class="form-control" id="event_name" onchange="for_search11();" required >
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
				<div class="col-md-3">
				<label>Gender</label>
				  <select name="gender11" class="form-control" id="gender" onchange="for_search11();" required >
						  <option value="All">All</option>
						  <option value="Male">Male</option>
						  <option value="Female">Female</option>
				  </select>
				</div>	
			 
				
				<div class="col-md-3">
				<label>Category</label>
			        <select name="category11" class="form-control" id="category" onchange="for_search11();" required >
					    <option value="All">All</option>
					    <?php
						$query8="select * from event_participate_table GROUP BY category";
						$res8=mysqli_query($conn73,$query8);
						while($row8=mysqli_fetch_assoc($res8)){
						$s_no=$row8['s_no'];
						$category=$row8['category'];
						?>
					    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
				 <label>Escorts(Staff)</label>
					  <select name="company_123" style="width:100%;" id="company_123" class="form-control" onchange="select_company();" required>
					  <option value="All">All</option>
				    </select>
				</div>
			    
			  </div>
		     </div>
			  </div>
			  </div>
			  <div class="col-md-1"></div>
				<div id="for_student_list">

				</div>
			<div id="student_name_company">				
				
			 </div>
			<div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn  btn-success"/></center> 
	 </div>
        </div>
        <!-- /.col -->
      </div>
	</div>
	</form>
	
<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    

<script>

  for_search11();
  select_company();
</script>
