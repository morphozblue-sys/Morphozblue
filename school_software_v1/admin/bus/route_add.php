<?php include("../attachment/session.php"); ?>

<script type="text/javascript">
 

 	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/route_add_api.php",
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
				   get_content('bus/route_add');
            }
			}
         });
      });
	    function delete_route(s_no){
$.ajax({
type: "POST",
url: access_link+"bus/route_dlt.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Deleted','green');
				   get_content('bus/route_add');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>
 <section class="content-header">
      <h1>
        <?php echo $language['Bus Management']; ?>
      </h1>
      <ol class="breadcrumb">
              	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
		<li class="active"><?php echo $language['Add Routes']; ?></li>
      </ol>
    </section>

<!---********************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"> <?php echo $language['Bus Route Generate']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" id="my_form" method="post" enctype="multipart/form-data">
			   
	     		   <div class="col-md-12">
			      <div class="col-md-6 ">
						<div class="form-group">
						  <label><?php echo $language['Route Name']; ?><font style="color:red"><b>*</b></font></label>
						   <center><input type="text"  name="bus_route" placeholder="Eg: Route1,Route2"  value="" class="form-control" required></center>
						</div>
				   </div>
			 
				
				<div class="col-md-6">
				<div class="col-md-2"></div>
				
				
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Route Name']; ?></th>
                  <th><?php echo $language['Delete']; ?></th>
				</tr>
                </thead>
<?php



$que="select * from bus_stop_details GROUP BY bus_route";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

	
	
while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_route = $row['bus_route'];
	
	$serial_no++;

?>	
<tbody>
	<tr>
		<td><?php echo $serial_no; ?></td>
		<td><?php echo $bus_route; ?></td>
		<th><button type="button" class="btn btn-default" onclick="delete_route('<?php echo $s_no; ?>')" ><?php echo $language['Delete']; ?></th>
	</tr>
	<?php } ?>
</tbody>
</table>
</div>
<div class="col-md-2"></div>
</div>
</div>
<div class="col-md-12">
<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
</div>
</form>
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<script>
$(function(){
$('#example1').DataTable()
})
</script>
  