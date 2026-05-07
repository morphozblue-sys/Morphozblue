<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
$(function()
{
    $("#table-data").on('click', 'input.addButton', function() 
	{	
		 var $tr = $(this).closest('tr');
        var allTrs = $tr.closest('table').find('tr');
        var lastTr = allTrs[allTrs.length-1];
        var $clone = $(lastTr).clone();
        $clone.find('td').each(function()
		{
			var el = $(this).find(':first-child');
			var id = el.attr('id') || null;
			if(id) 
			{
				var i = id.substr(id.length-1);
				var prefix = id.substr(0, (id.length-1));
			}
        });
        $clone.find('input:text').val('');
        $tr.closest('table').append($clone);
});
});
</script>
<script type="text/javascript">
 
 var deleteRow = function (link) {
     var row = link.parentNode.parentNode;
     var table = row.parentNode; 
     table.removeChild(row); 
	 
 }
 
function for_list(){
    var route_name=document.getElementById('bus_route').value;
    var stop_name=document.getElementById('bus_stop').value;
   if(route_name!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"bus/ajax_get_route_list.php?route_name="+route_name+"",
	  cache: false,
	  success: function(detail){
		$("#route_list").html(detail);
	  }
   });
   }else{
	   $("#route_list").html('');
   }
}
 
 	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"bus/bus_route_add_api.php",
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
				   get_content('bus/bus_route_add');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Bus Management']; ?>
      </h1>
      <ol class="breadcrumb">
            	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active"> <?php echo $language['Add Routes']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Bus Route Generate']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" id="my_form" method="post" enctype="multipart/form-data">
			   
	     		   <div class="col-md-12 ">
			       <div class="col-md-4 "></div>
			       <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Route Name']; ?><font style="color:red"><b>*</b></font></label>
						   <select name="bus_route" id="bus_route" class="form-control" onchange="for_list();" >
                        <option value=''>Select</option>
                        <?php $que12="select * from bus_stop_details GROUP BY bus_route";
                        $run12=mysqli_query($conn73,$que12);
                        while($row12=mysqli_fetch_assoc($run12)){
                        $s_no=$row12['s_no'];
                        $bus_route=$row12['bus_route'];
		                ?>
                  <option value="<?php echo $bus_route; ?>" ><?php echo $bus_route; ?></option>
        <?php } ?>
    </select>
						</div>
				   </div>
				   <div class="col-md-4 "></div>
				</div>
				
				<div class="col-md-12 ">
				<div class="col-md-2"></div>
				
				
				<div class="col-md-8 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $language['Stop Name']; ?></th>
                  <th><?php echo $language['Time']; ?></th>
				  <!--<th><?php echo $language['Add More']; ?></th>-->
                </tr>
                </thead>
				<tbody>
					<tr >
					<td>
					<select name="bus_stop[]" id="bus_stop" class="form-control" required >
					    <option value="">Select</option>
					    <?php
                        $query18="select * from bus_fee_category where bus_fee_category_name!=''";
                        $run18=mysqli_query($conn73,$query18) or die(mysqli_error($conn73));
                        while($row=mysqli_fetch_assoc($run18)){
                        $bus_fee_category_name=$row['bus_fee_category_name'];
                        $bus_fee_category_code=$row['bus_fee_category_code'];
					    ?>
					    <option value="<?php echo $bus_fee_category_name; ?>"><?php echo $bus_fee_category_name; ?></option>
					    <?php } ?>
					</select>
					</td>
					<td><input type="time" name="bus_time[]" required value=""></td>
					<!--<td>
					<input type="button" class="addButton" value="+" />
					<a class="btnAddnew" style="text-decoration: none;" onClick="javascript:deleteRow(this); return false;" id="btnremove">
					<input type="button" style="color:#000000" value="-" />
					</a>
					</td>-->

					</tr>
					
					</tbody>
				
                </table>
                </div>
				<div class="col-md-2"></div>
			</div>
			
				
				
				
				
		 <div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		  </div>
		  
		  <div class="col-md-12">&nbsp;</div>
		  <div class="col-md-8 col-md-offset-2" id="route_list">
		        
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

  