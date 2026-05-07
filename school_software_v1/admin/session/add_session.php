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
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_account(s_no);       
 }            
else  {      
return false;
 }       
  }
function  delete_account(s_no){
$.ajax({
type: "POST",
url: access_link+"session/delete_session.php?id="+s_no+"",
cache: false,
success: function(detail){
    //alert_new(detail);
	 var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
			  get_content('session/add_session');
			  }else{
              alert_new(detail); 
			  }
}
});
}
</script>
<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"session/add_session_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Complete');
				   get_content('session/add_session');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
        Session Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i><?php echo $language['Home']; ?></a></li>
		<li><a href="javascript:get_content('session/add_session')"><i class="fa fa-truck"></i>Add Session </a></li>
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
              <h3 class="box-title">Add Session</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
			   <div class="col-md-12">
	     		   <div class="col-md-6">
			      <div class="col-md-6">
			      <?php 
			    $sql1="select * From add_session";
				$run1=mysqli_query($conn73,$sql1);
				while($row1=mysqli_fetch_assoc($run1)){
			    $last_session=$row1['last_session']; 
				$s1=$last_session-2000;
				$s1++;
				$new_session=$last_session.'_'.$s1;
				
				}
		    	$last_session1=$last_session+1;
				?>
						<div class="form-group">
						  <label>Add Session<font style="color:red"><b>*</b></font></label>
						   <center><input type="text"  name="add_session" placeholder="Add session"  value="<?php echo $new_session; ?>" class="form-control" readonly ></center>
						</div>
						<input type="hidden" name="last_session" value="<?php echo $last_session1; ?>">
				   </div>
				    <div class="col-md-6 ">
						<div class="form-group">
						   <label>Creation Date<font style="color:red"><b>*</b></font></label>
						   <center><input type="date"  name="creation_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly></center>
						</div>
				   </div>
				   
				   </div>
			 
				
				<div class="col-md-6">
				<div class="col-md-2"></div>
				
				
				<div class="col-md-8 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S No</th>
                  <th>Session</th>
                  <th>Creation Date</th>
                  <th>Last Session</th>
                  <th>Delete</th>
				</tr>
                </thead>
				<?php 
				$sql="select * From add_session";
				$run=mysqli_query($conn73,$sql);
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$session=$row['session'];
				$creation_date=$row['creation_date'];
				$date1=explode("_",$session);
				$date_session=$date1[0];
				$last_session=$date_session-2000;
				$date_session;
				$serial_no++;
				?>
				
				
				
				<tbody>
					<tr>
					   <td><?php echo $serial_no; ?></td>
					   <td><?php echo $session; ?></td>
					   <td><?php echo $creation_date; ?></td>
					   <td><?php echo $date_session; ?></td>
				       <th><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></th>
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