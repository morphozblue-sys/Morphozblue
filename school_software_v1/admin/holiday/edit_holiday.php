<?php include("../attachment/session.php")?>
<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"holiday/edit_holiday_api.php",
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
				   get_content('holiday/holiday_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Holiday Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('holiday/holiday')"><i class="fa fa-photo"></i> <?php echo $language['Holiday']; ?></a></li>
		<li><a href="javascript:get_content('holiday/holiday_list')"><i class="fa fa-list"></i><?php echo $language['Holiday List']; ?></a></li>
        <li class="active"><i class="fa fa-edit"></i><?php echo $language['Edit Holiday']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Edit Holiday']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			
			<?php 
				$id=$_GET['id'];
				$query="select * from holiday_manage where s_no='$id'";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $s_no=$row['s_no'];
				      $holiday_name=$row['holiday_name'];
					  
				      $holiday_date_1=$row['holiday_date'];
                      $holiday_date_2 = explode("-",$holiday_date_1);
                      $holiday_date=$holiday_date_2[2]."-".$holiday_date_2[1]."-".$holiday_date_2[0];
					  
				      $holiday_day=$row['holiday_day'];
				      $holiday_year=$row['holiday_year'];
				      $holiday_description=$row['holiday_description'];
				$serial_no++;
				}
				?>
			
			<form role="form" method="post" id="my_form">
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Holiday Name']; ?></label>
						   <input type="text"  name="holiday_name"   placeholder="Enter Holiday Name"  value="<?php echo $holiday_name; ?>" class="form-control " > 
						   <input type="hidden"  name="id123"     value="<?php echo $id; ?>" >
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Date']; ?></label>
						   <input type="date"  name="date"  placeholder="Enter Date"  value="<?php echo $holiday_date; ?>" class="form-control" readonly>
						</div>
							</div>

				<div class="col-md-4 ">	
					<div class="form-group" >
					  <label><?php echo $language['Description']; ?></label>
					  <input type="text"  name="holiday_description" placeholder="Description of holiday"  value="<?php echo $holiday_description; ?>" class="form-control">
					</div>
				  </div>
				  
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				
				
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

  