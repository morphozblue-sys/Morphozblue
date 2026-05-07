<?php include("../attachment/session.php")?>
 <script type="text/javascript">

		    function form_submit(){
//var csv_file=document.getElementById('csv_file').value;
//if(csv_file!=''){
		    $.ajax({
           type: "POST",
            url: access_link+"student/csv_data_import_api1.php",
           data: $("#my_form1").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
		// }else{
		 //alert("Please select csv file !!!");
		 //}
      }
	  
	  
    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"student/csv_data_import_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				$('#get_content').html(detail);
              // var res=detail.split("|?|");
			 //  if(res[1]=='success'){
				  // alert('Successfully Complete');
				//   get_content('student/student_registration_list');
          //  }
			}
         });
      });
    
</script>
    <section class="content-header">
      <h1>
        CSV Student Upload
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
		<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('student/students')"><i class="fa fa-phone-square"></i>Student</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Generate CSV</li>
      </ol>
    </section>
    <section class="content">
      <!-- Small boxes (Stat box) -->
	  
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">CSV Student Upload</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body ">
			<form role="form" method="post"  enctype="multipart/form-data" id="my_form">
					 <div class="col-md-12">
				
				  <div class="col-md-4">				
			      <div class="form-group" >
				  <label>Choose Session</label>
					  <select class="form-control" required name="session">
					  			<?php	
											$sql11="select defalut_session_value from school_info_general";
				
				$run111=mysqli_query($conn73,$sql11) or die(mysqli_error($conn73));
				while($row111=mysqli_fetch_assoc($run111)){
			echo	$default_session_value=$row111['defalut_session_value']; 
				}
								$sql1="select * From add_session";
				$run1=mysqli_query($conn73,$sql1);
				while($row1=mysqli_fetch_assoc($run1)){
				$session_value1232=$row1['session']; 
?>
					  <option <?php if($default_session_value==$session_value1232){ echo "selected"; } ?> value="<?php echo $session_value1232; ?>"><?php echo $session_value1232; ?></option>
					  <?php }  ?>
					  </select>
					</div>
				  </div>
				  <div class="col-md-4">				
			      <div class="form-group" >
				   <label>Choose CSV file</label>
				   <input type="file" name="csv_file" id="csv_file" class="form-control">
				
				  </div>
				  </div>	 
				  <div class="col-md-4">				
			      <div class="form-group" >
				   <label></label>
				<center><input type="submit" name="importSubmit" value="Import"   class="btn btn-success" /></center>
				  </div>
				  </div>
				  </div>
			  </div>
    		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>

</section>

