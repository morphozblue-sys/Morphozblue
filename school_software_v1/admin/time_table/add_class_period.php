<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function add_edit(value,name){
var period_name1=name.split('|?|');
$('#period_name').val(period_name1[0]);
$('#period_start_time').val(period_name1[1]);
$('#period_end_time').val(period_name1[2]);
$('#period_code_hidden').val(value);
}
</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
				   $("#myModal_close").click();
        $.ajax({
            url: access_link+"time_table/add_class_period_api.php",
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
				
				   get_content('time_table/add_class_period');
            }
			}
         });
      });
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
<tbody>
<?php
$add_more_button=0;
	$que="select * from school_info_class_period where class_code=''";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_code=$row['s_no'];
					$period_name1=$row['period_name'];
	                $period_start_time1 = $row['period_start_time'];
					$period_end_time1 = $row['period_end_time'];
	$name_str=$period_name1.'|?|'.$period_start_time1.'|?|'.$period_end_time1;
	
if($period_name1!=''){
	$serial_no++;
?>				
    <tr  align='center' >
    <th><?php echo $serial_no; ?></th>
	<th><?php echo strtoupper($period_name1); ?></th>
	<th><?php echo $period_start_time1; ?></th>
	<th><?php echo $period_end_time1; ?></th>
	
	<th><button type="button" id="<?php echo $period_code; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add/Edit</th>
	</tr>
	<?php } else{ if($add_more_button==0){ $period_code_blank=$period_code;
	} $add_more_button++; } } if($add_more_button!=0){?>
	<tr align='center' >
	<th colspan="4" ><button type="button" id="<?php echo $period_code_blank; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add More</th>
				</tr>
				<?php } ?>
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
