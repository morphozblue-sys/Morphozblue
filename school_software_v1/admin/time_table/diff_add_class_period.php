<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function add_edit(value,name){
var period_name1=name.split('|?|');
$('#period_name').val(period_name1[0]);
$('#period_start_time').val(period_name1[1]);
$('#period_end_time').val(period_name1[2]);
$('#class_code_hidden').val(period_name1[3]);
$('#period_code_hidden').val(value);
}
</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
				   $("#myModal_close").click();
        $.ajax({
            url: access_link+"time_table/diff_add_class_period_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   $('#myModal').modal('hide');
				
				   post_content('time_table/diff_add_class_period','class='+res[2]);
            }
			}
         });
      });
         function get_period_name(value1){
       $.ajax({
			  type: "POST",
              url: access_link+"time_table/diff_ajax_get_period_name.php?class_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#my_data").html(detail1);
              }
           });

    }
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['School Information Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-graduation-cap"></i>Time Table</a></li>
	  <li class="active">Add Period</li>
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
              <h3 class="box-title">Period Add</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >

                			  <div class="col-md-4 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
					    <select  onchange="get_period_name(this.value);" class="form-control" required>
					                        <?php 
                if(isset($_GET['class'])){
                    $class_code=$_GET['class'];
                    	$que4="select * from school_info_class_info Where class_code='$class_code'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_name1 = $row4['class_name'];
    } 
     echo "<script>get_period_name('$class_name1')</script>";
    ?>
      <option value="<?php echo $class_name1; ?>"><?php echo $class_name1; ?></option>
     
           <?php     }else { ?>
					       
						<option value="">Select Class</option>
						<?php } ?>
						        <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				</div>
            <div class="box-body "  >
		
				<div class="col-md-12 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S No.</th>
                  <th>Period Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Add/Edit</th>		  
                </tr>
                </thead>
<tbody id="my_data">

				</tbody>
                </table>
                </div>
<div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body" >
        <div class="col-md-12">
        <div class="form-group">
		<label>Period Add/Edit</label>
		<input type="text" name="period_name" id="period_name" class="form-control">
		<input type="hidden" name="period_code_hidden" id="period_code_hidden" class="form-control">
		<input type="hidden" name="class_code_hidden" id="class_code_hidden" class="form-control">
		</div>
		</div>
		<div class="col-md-12">
	    <div class="form-group">
		<label>Start Time Add/Edit</label>
		<input type="Time" name="period_start_time" id="period_start_time" class="form-control">
		</div>
        </div>
		<div class="col-md-12">
	    <div class="form-group">
		<label>End Time Add/Edit</label>
		<input type="Time" name="period_end_time" id="period_end_time" class="form-control">
		</div>
        </div>
      </div>
	  <div class="modal-footer">
		<input type="submit" name="finish" value="ADD" class="btn btn-success" />
          <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	
		  </form>
  </div>
  		
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
