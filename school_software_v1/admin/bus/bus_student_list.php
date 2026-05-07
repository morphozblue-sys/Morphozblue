<?php include("../attachment/session.php"); ?>
<script>
   function for_list(value){
       $('#my_table').html(loader_div);
       if(value!=''){
       $.ajax({
			  type: "POST",
              url: access_link+"bus/ajax_bus_student_list.php?id="+value+"",
              cache: false,
              success: function(detail){
              $('#my_table').html(detail);
              }
           });
       }else{
       $('#my_table').html('');
       }
    }
</script>
<script>
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
$("#my_button").click();
        $.ajax({
            url: access_link+"bus/bus_student_list_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			////alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('bus/bus_student_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        Bus Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
	  <li class="active">Student Registration List</li>
      </ol>
    </section>
	
	<!---*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************    <section class="content">
      <!-- Small boxes (Stat box) -->
	  <form role="form"  method="post" enctype="multipart/form-data" id="my_form">
	  <section class="content">
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <h3 class="box-title">Bus Student List</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			
			 <div class="col-md-3 ">	
					<div class="form-group" >
					    <label>Class</label>
					    <select name="student_class" onchange="for_list(this.value);"  class="form-control" required>
						       <option value="">Select Class</option>
						       <?php 
							   $que="select * from school_info_class_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $class_name=$row['class_name']; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				
	
    		<div class="col-md-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?> ">
                <div class="box-header with-border">
                </div>
            <div class="box-body table-responsive" id="my_table" >
              
            </div>
            	
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </div>
      <!-- /.row -->
    </section>
    </form>
<script>
for_list('');
</script>
