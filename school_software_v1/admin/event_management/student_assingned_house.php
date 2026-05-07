<?php include("../attachment/session.php"); ?>
  <script type="text/javascript">
   function for_section(value){
$('#student_class_section').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"event_management/ajax_class_section_code.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                  $("#student_class_section").html(detail);
				 for_search11(); 
              }
           });

    }

function for_search11(){
var student_class=document.getElementById('student_class').value;
var student_class_section=document.getElementById('student_class_section').value;
var student_limit=document.getElementById('student_limit').value;
if(student_class!='' || student_class_section!=''){
$('#for_student_list').html(loader_div);
$.ajax({
type: "POST",
url: access_link+"event_management/ajax_student_assigned_house.php?student_class="+student_class+"&student_class_section="+student_class_section+"&student_limit="+student_limit+"",
success: function(detail){
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
            url: access_link+"event_management/student_assingned_house_api.php",
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
				   get_content('event_management/student_assingned_house');
            }
			}
         });
      });
	</script>

  

    <section class="content-header">
      <h1>
        Student House Assingned
		<small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active">Student House Assingned</li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************-->
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
			 <form role="form" method="post" enctype="multipart/form-data" id="my_form">
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
				<label>Class</label>
				        <select name="student_class" onchange="for_section(this.value);" id="student_class" class="form-control">
						<option value="">Select Class</option>
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
				<div class="col-md-4">
				<label>Section</label>
					<select name="student_class_section" id="student_class_section" style="width:100%;" class="form-control" onchange="for_search11();">
					<option value="">All</option>
					</select>
				</div>
				
				<div class="col-md-4">
				<label>Limit</label>
				<select name="student_limit" id="student_limit" class="form-control" onchange="for_search11();">
				<option value="0">0-20</option>
				<option value="20">20-40</option>
				<option value="40">40-60</option>
				<option value="60">60-80</option>
				<option value="80">80-100</option>
				<option value="100">100-120</option>
				<option value="120">120-140</option>
				<option value="140">140-160</option>
				<option value="160">160-180</option>
				<option value="180">180-200</option>
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
           </div>
     </div>
     </section>

  

