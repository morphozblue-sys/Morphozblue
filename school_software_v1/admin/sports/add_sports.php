<?php include("../attachment/session.php"); ?>
</head>
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
$("#my_form").submit(function(e){
e.preventDefault();
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    loader();
    $.ajax({
            url: access_link+"sports/add_sports_api.php",
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
				   get_content('sports/add_sports');
            }
			}
         });
      });
</script>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
sports_delete(s_no);       
 }            
else  {      
return false;
 }       
  } 
	function sports_delete(s_no){
	      $("#get_content").html(loader_div);
$.ajax({
type: "POST",
url: access_link+"sports/delete_sports.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('sports/add_sports');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>
    <section class="content-header">
      <h1>
        Sports Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('sports/sports')"#><i class="fa fa-futbol-o"></i> Sport Management</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Add Sports</li>
      </ol>
    </section>
 <!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning my_border_top  ">
            <div class="box-header with-border ">
              <h3 class="box-title">Sports Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			   
	     		   <div class="col-md-12">
			      <div class="col-md-3 ">
						<div class="form-group">
						  <label>Sports Name<font style="color:red"><b>*</b></font></label>
						   <center><input type="text"  name="sports_name" placeholder="Sports Add"  value="" class="form-control" required></center>
						</div>
				   </div>   
			 <div class="col-md-3 "></div>
				
				<div class="col-md-6">
				<div class="col-md-2"></div>
				<div class="col-md-8 box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S.No</th>
                  <th>Sports Name</th>
                  <th>Delete</th>
				</tr>
                </thead>
				<?php
				$que="select * from sports_table";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;	
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$sports_name = $row['sports_name'];	
				$serial_no++;
				?>
				<tbody>
					<tr>
					   <td><?php echo $serial_no; ?></td>
					   <td><?php echo $sports_name; ?></td>
					   <td><button type="button" onclick="return valid('<?php echo $s_no; ?>');" class="btn btn-success" >
						<?php echo $language['Delete']; ?></button></td>
					</tr>
					<?php } ?>
				</tbody>
                </table>
                </div>
		
			</div>
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
<script>
$(function(){
$('#example1').DataTable()
})
</script>