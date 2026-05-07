<?php include("../attachment/session.php")?>
<script src="../attachment/file_check.js"></script>
<script>
  function check_file_type(input,id,id_show,type1){
if(type1=="image"){
	   var file = input.files[0];
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB","red");
      return;
    }  
if(!file.type.match("image/*"))
{
 $('#'+id).val('');
alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");

 return;
}  
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	  $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");
	
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}else{

	   var file = input.files[0];
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB","red");
	  
      return;
    }  
 
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	 $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF/PDF/DOC File","red");
	 
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}

}
    function mimeType(headerString) {
  switch (headerString) {
    case "89504e47":
      type = "image/png";
      break;
    case "47494638":
      type = "image/gif";
      break;
    case "ffd8ffe0":
    case "ffd8ffe1":
    case "ffd8ffe2":
      type = "image/jpeg";
      break;
	 case "25504446":
      type = "application/pdf";
      break;
	  case "d0cf11e0":
      type = "application/doc";
      break;
    default:
      type = "1";
      break;
  }
  return type;
}
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"important/add_other_document_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
// 			//alert_new(detail);
			
// 			console.log(detail)
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('important/other_document_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        Add Other Info
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('important/important')"><i class="fa fa-check-square"></i>Important</a></li>
		<li><a>Add Other Info</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title">Other Info Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Name<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="other_document_name" style="  border-color: red;"   placeholder="Name"  value="" class="form-control" required>
						</div>
				</div>
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Date<font style="color:red"><b>*</b></font></label>
					  <input type="date"  name="document_date" placeholder="Date"  value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
					</div>
				  </div>

				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Documents upload<font style="color:red"><b>*</b></font></label>
					  <input type="file"  name="other_document_upload" placeholder="Upload document"  value="" onchange="check_file_type(this,'other_document_upload','show_other_document_upload','image');" class="form-control" required>
					</div>
				  </div>
				  
				  <div class="col-md-4" >
					    <label><?php echo $language['Class']; ?></label>
					    <select name="class"  id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						         <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				  
				  <div class="col-md-4 ">	
					<div class="form-group" >
					  <label>Remark<font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="remark" placeholder="Remark"  value="" class="form-control" required>
					</div>
				  </div>
				  	<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_other_document_upload" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-12">
		        <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		  </div>
	</div>
		</form>	

          </div>
    </div>
</section>
 