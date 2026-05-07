<?php include("../attachment/session.php")?>
<script>
    function check_date(holiday){ 
             $.ajax({
			  type: "POST",
              url: access_link+"holiday/ajax_holiday_detail.php?holiday="+holiday+"",
              cache: false,
              success: function(detail){
     		if(detail!=0){
			alert_new("This Date has Aleardy Exist in Holiday List. You can Edit it",'red');
			$('#holiday').val('');
			}
              }
           });
            }
			 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"holiday/add_holiday_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('holiday/add_holiday');
            }
			}
         });
      });
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
				 //  alert_new('Successfully Deleted','green');
				   get_content('holiday/add_holiday');
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
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('holiday/holiday')"><i class="fa fa-photo"></i> <?php echo $language['Holiday']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Add Holiday']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Holiday Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" id="my_form">
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Holiday Name']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="holiday_name"   placeholder="<?php echo $language['Holiday Name']; ?>"  value="" class="form-control " required />
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Date']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="date"  name="date"  id="holiday" onchange="check_date(this.value)" placeholder="<?php echo $language['Date']; ?>"  value="" class="form-control" required />
						</div>
							</div>
			
				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Description']; ?></label>
					  <input type="text"  name="description" placeholder="<?php echo $language['Description']; ?>"  value="" class="form-control">
					</div>
				  </div>
				  
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				
				
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
	
	        <div class="box-body "  >
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
				$query="select * from holiday_manage where session_value='$session1' ORDER BY holiday_date_new DESC";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $s_no=$row['s_no'];
				      $holiday_name=$row['holiday_name'];
				      $holiday_date=$row['holiday_date'];
				      $holiday_day=$row['holiday_day'];
				      $holiday_description=$row['holiday_description'];
				      $date=$row['holiday_date'];
					  //$date_2 = explode("-",$holiday_date);
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
	</div>
	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

     <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>