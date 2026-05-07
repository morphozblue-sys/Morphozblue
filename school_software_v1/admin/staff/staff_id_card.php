<?php include("../attachment/session.php"); ?>
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




   function for_list(){ 
			var emp_categories=	document.getElementById('emp_categories').value;
$("#my_table").html(loader_div);
       $.ajax({
			  type: "POST",
              url: access_link+"staff/ajax_staff_id_card.php?id="+emp_categories+"",
              cache: false,
              success: function(detail){
            $('#my_table').html(detail);
			//$("#click").click();
              }
           });
		     
    }
</script>

     <section class="content-header">
      <h1>
        Employee Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  <li class="active">Staff ID Card</li>
      </ol>
    </section>
	

	<script type="text/javascript">

    
	   function set_id_card(value1){
	   var page1 = "../pdf/id_card_page/id_card_pdf_"+value1+".php";
	    $('#my_form').attr('action',page1);
    }
</script>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
						<?php 
				$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$id_card_staff_pdf = $row['id_card_staff_pdf'];
}	
   ?>
            <div class="box-body "  >
			<form role="form"  method="post" id="my_form" action="<?php echo $pdf_path; ?>id_card_page/<?php echo $id_card_staff_pdf; ?>" enctype="multipart/form-data" target="_blank">
			
			 <div class="col-md-3 ">	
					<div class="form-group" >
					    <label>Categories</label>
					    <select name="emp_categories" onchange="for_list();" id="emp_categories" class="form-control" required>
						       <option value="">Select</option>  
						       <option value="All">All</option>  
						       <option value="Teaching">Teaching</option>  
			                   <option value="Non Teaching">Non Teaching</option>
					    </select>
					</div>
				</div>
				
				
				
				<div class="col-xs-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table">
                <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
                  <th>Employee Id No</th>
                  <th>Employee Name</th>
                  <th>Select Employee &nbsp;<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
                </tr>
                </thead>
				
				<tbody id="example2">
				
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="Submit" class="btn btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  


<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
