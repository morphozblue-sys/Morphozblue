<?php include("../attachment/session.php")?>
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
		</h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Add Previous Dues</li>
      </ol>
    </section>
    
<script>
function for_section(value){
   $('#student_class_section').html("<option value='' >Loading....</option>");
   if(value!=''){
   $.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/ajax_class_section_select.php?class_name="+value+"",
		  cache: false,
		  success: function(detail){
			$("#student_class_section").html(detail);
		  }
	   });
   }else{
       $("#student_class_section").html("<option value=''>Select</option>");
   }
   for_feelist();
}

function for_feelist(){
   $("#fee_details").html(loader_div);
   var student_class=document.getElementById('student_class').value;
   var student_section=document.getElementById('student_class_section').value;
   if(student_class!='' && student_section!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_add_previous_year_dues_fee.php?student_class="+student_class+"&student_section="+student_section+"",
	  cache: false,
	  success: function(detail){
		$("#student_detail").html(detail);
	  }
   });
   }else{
	   $("#student_detail").html('');
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
	$(".my_check").each(function() {
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

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
$.ajax({
	url: access_link+"fees_monthly/add_previous_year_dues_fee_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	   var res=detail.split("|?|");
	  
	   res.forEach(element => console.log(element));
	   if(res[1]=='success'){
		   alert('Successfully Complete');
		   get_content('fees_monthly/add_previous_year_dues_fee');
	}
	}
 });
});
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              
              <div class="col-md-6 col-md-offset-3">
                  
                    <div class="col-md-8">
                    <div class="form-group">
                    <label>Select Class</label>
                    <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
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
                    </div>
                    
                    <div class="col-md-4">
                    <div class="form-group">
                    <label>Section</label>
                    <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feelist();" required>
                    <option value="">Select</option>
                    </select>
                    </div>
                    </div>
                  
              </div>
              
              <form method="post" enctype="multipart/form-data" id="my_form">
              <div class="col-md-10 col-md-offset-1" id="student_detail">
                  
                  
                  
              </div>
              </form>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<script>
for_feelist();
</script>