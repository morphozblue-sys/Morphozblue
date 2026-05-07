<?php include("../attachment/session.php")?>
  
  
  <script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_enquiry(s_no);       
 }            
else  {      
return false;
 }       
  }           

function edit_enquiry(s_no){
$.ajax({
type: "POST",
url:access_link+"enquiry/enquiry_edit.php?id="+s_no+"",
cache: false,
success: function(detail){
$("#get_content").html(detail);
}
});
}
function delete_enquiry(s_no){
$.ajax({
type: "POST",
url: access_link+"enquiry/enquiry_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  // alert_new('Successfully Deleted');
				   get_content('enquiry/enquiry_list');
			   }else{
              //  alert_new(detail); 
			   }
}
});
}

   
 </script>
  
    <section class="content-header">
      <h1>
       <?php echo $language['Enquiry Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
       	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  <?php echo $language['Home']; ?></a></li>
        <li><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-phone-square"></i>  <?php echo $language['Enquiry']; ?></a></li>
        <li class="active"><i class="fa fa-list"></i>  <?php echo $language['Enquiry List']; ?></li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Enquiry List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
	    <th><?php echo $language['S No']; ?></th>
		<th><?php echo $language['Enquiry Type']; ?></th>
        <th><?php echo $language['Name']; ?></th>
        <th><?php echo $language['Class']; ?></th>
        <th><?php echo $language['Father Name']; ?></th>
        <th>Student Medium</th>
        <th><?php echo $language['Date']; ?></th>
        <th><?php echo $language['Contact No1']; ?></th>
	    <th><?php echo $language['Contact No2']; ?></th>
	    <th><?php echo $language['Address']; ?></th>
		<th><?php echo $language['Next Follow Up Date']; ?></th>
		<th><?php echo $language['Enquiry Remark 1']; ?></th>
		<th><?php echo $language['Enquiry Remark 2']; ?></th>
		
		<th>Update By</th>
        <th>Date</th>
		
		<th>Print</th>
		
		<th><?php echo $language['Edit']; ?></th>
		<th><?php echo $language['Delete']; ?></th>
        </tr>
        </thead>
		<tbody>
		    
		</tbody>


             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 

<script>

var dataTable=$('#example1').DataTable({
                "orderMulti": true,
                "processing": true,
                "serverSide":true,
              
                "ajax":{
                    url:access_link+"enquiry/enquiry_list_fetch.php",
                    type:"post"
                }
            });


</script>
