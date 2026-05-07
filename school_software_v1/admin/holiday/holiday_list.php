<?php include("../attachment/session.php"); ?> 
<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_holiday(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_holiday(s_no){
$.ajax({
type: "POST",
url: access_link+"holiday/delete_holiday.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('holiday/holiday_list');
			   }else{
               alert_new(detail); 
			   }
}
});
}

</script>	

    <section class="content-header">
      <h1>
        <?php echo $language['Holiday Management']; ?> 
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('holiday/holiday')"><i class="fa fa-photo"></i> <?php echo $language['Holiday']; ?></a></li>
        <li class="active"><i class="fa fa-list"></i> <?php echo $language['Holiday List']; ?> </li>
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
              <h3 class="box-title"><?php echo $language['Holiday List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Holiday Name']; ?></th>
                  <th><?php echo $language['Date']; ?></th>
                  <th><?php echo $language['Day']; ?></th>
                  <th><?php echo $language['Description']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th><?php echo $language['Action']; ?></th>
                 
                </tr>
                </thead>
		
		<tbody>
				<?php
				$query="select * from holiday_manage where session_value='$session1' ORDER BY holiday_date_new ASC";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $s_no=$row['s_no'];
				      $holiday_name=$row['holiday_name'];
				      $holiday_date=$row['holiday_date'];
				      $holiday_day=$row['holiday_day'];
				      $holiday_description=$row['holiday_description'];
				      $date=$row['holiday_date'];
					  //	  $date_2 = explode("-",$holiday_date);
                      //$date=$date_2[2]."-".$date_2[1]."-".$date_2[0];
                      
                      $update_change=$row['update_change'];
                      if($row['last_updated_date']!='0000-00-00'){
                      $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                      }else{
                      $last_updated_date=$row['last_updated_date'];
                      }
                      
				$serial_no++;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $holiday_name; ?></td>
                  <td><?php echo $date; ?></td>
                  <td><?php echo $holiday_day; ?></td>
                  <td><?php echo $holiday_description; ?></td>
                  
                  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
                  
                  <td><button type="button"  onclick="post_content('holiday/edit_holiday','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button>
			<button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
                </tr>
               <?php } ?>

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
   <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>