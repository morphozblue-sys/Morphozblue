<?php include("../attachment/session.php"); ?> 

    <section class="content-header">
      <h1>
        <?php echo 'Fees Management'; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Transport Fees Structure List</li>
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
              <h3 class="box-title">Transport Fees Structure</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
				<div class="col-md-12 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S No.</th>
                  <th>Bus Fee Type</th>
                  <th>Bus Fee Type Hindi</th>
                  <?php
				  $que1="select * from school_info_class_info where class_name!=''";
				  $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
				  $class_sno=0;
				//   $class_code='';
				//   $class_code2='';
				//   $class_name1='';
				  while($row1=mysqli_fetch_assoc($run1)){
				  $class_name=$row1['class_name'];
				  $class_name1[$class_sno]=$class_name;
				  $class_code[$class_sno]=$row1['class_code'];
				  $class_code2=$class_code2."|?|".$row1['class_code'];
				  $class_sno++;
				  ?>
                  <th><?php echo $class_name; ?></th>
                  <?php } ?>
                  
                  <th><input type="hidden" id="all_class_codes" value="<?php echo $class_code2; ?>" />Add/Edit</th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
<tbody>
<?php
$que="select * from bus_fee_category";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$add_more_button=0;
while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_fee_category_name = $row['bus_fee_category_name'];
	$bus_fee_category_name_hindi = $row['bus_fee_category_name_hindi'];
	$bus_fee_category_code = $row['bus_fee_category_code'];
	
	$update_change = $row['update_change'];
    if($row['last_updated_date']!='0000-00-00' && $row['last_updated_date']!=''){
    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
    }else{
    $last_updated_date=$row['last_updated_date'];
    }
	
	$name_str=$bus_fee_category_name.'|?|'.$bus_fee_category_name_hindi;
	
// 	$class_amount='';
	for($i=0;$i<$class_sno;$i++){
	$class_amount[$i] = $row[$class_code[$i].'_amount'];
	$name_str=$name_str."|?|".$row[$class_code[$i].'_amount'];
	}
	
if($bus_fee_category_name!='' || $bus_fee_category_name_hindi!=''){
	$serial_no++;
?>				
    <tr  align='center' >
    <th><?php echo $serial_no; ?></th>
	<th><?php echo $bus_fee_category_name; ?></th>
	<th><?php echo $bus_fee_category_name_hindi; ?></th>
	<?php for($j=0;$j<$class_sno;$j++){ ?>
	<th><?php echo $class_amount[$j]; ?></th>
	<?php } ?>
	
	<th><a style="color:#fff;" href="javascript:post_content('fees_monthly/bus_fee_category_monthly_installmentwise_edit','<?php echo 'bus_fee_category_code='.$bus_fee_category_code; ?>')"><button type="button" id="<?php echo $bus_fee_category_code; ?>" name="<?php echo $name_str; ?>" class="btn btn-default my_background_color" >Add/Edit</a></th>
	
	<th><?php echo $update_change; ?></th>
	<th><?php echo $last_updated_date; ?></th>
	
	</tr>
	<?php } else{ if($add_more_button==0){ $fee_code_blank=$bus_fee_category_code;
	} $add_more_button++; } } if($add_more_button!=0){?>
	<tr align='center' >
	<th colspan="4" ><a style="color:#fff;" href="javascript:post_content('fees_monthly/bus_fee_category_monthly_installmentwise_edit','<?php echo 'bus_fee_category_code='.$fee_code_blank; ?>')"><button type="button" id="<?php echo $fee_code_blank; ?>" name="<?php echo $name_str; ?>" class="btn btn-default my_background_color" >Add More</a></th>
				</tr>
				<?php } ?>
				</tbody>
                </table>
                </div>
  		
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
