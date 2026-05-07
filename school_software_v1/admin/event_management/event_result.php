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

<!---vidhan---->
<script>
function for_search11(){
var event_name=document.getElementById('event_name').value;
if(event_name!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"event_management/ajax_event_list_student.php?event_name="+event_name+"",
success: function(detail){
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
   	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"event_management/event_result_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('event_management/event_result_list');
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
			  
              <div class="col-md-2"></div>
              <div class="col-md-8">
			  <div class="container-fluid">
			  
			 <div class="panel panel-default">
			  <div class="panel-body">
			    
			    <div class="col-md-3"></div>
			    <div class="col-md-6">
				<label>Event Name</label>
				    <select name="event_name" class="form-control" id="event_name" onchange="for_search11();" required >
						<option value="">Select</option>
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
	</form>
	
<!---------------------------------------------End Participate form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
 <script>
$(function(){
$('#example1').DataTable()
})
</script>

 