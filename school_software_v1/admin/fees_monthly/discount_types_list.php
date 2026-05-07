<?php include("../attachment/session.php"); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active"><?php echo $language['Discount Type List']; ?></li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				<td>#</td>
				<td><?php echo $language['Class']; ?></td>
				<?php
				$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
				$run1=mysqli_query($conn73,$que1);
				while($row1=mysqli_fetch_assoc($run1)){
				$fees_type_name[] = $row1['fees_type_name'];	
				$fees_code[] = $row1['fees_code'];
				$fees_count = $row1['fees_count'];
				}
				
                $que="select * from school_info_discount_types";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$discount_type = $row['discount_type'];
				$discount_code = $row['discount_code'];
				if($discount_type!=''){
				$discount_method=$discount_type." Discount Method";
				$discount_amount=$discount_type." Discount Amount";
				
				$discount_method1[$serial_no]=$discount_code."_method_month";
				$discount_amount1[$serial_no]=$discount_code."_amount_month";
				$serial_no++;
				?>
				<td><?php echo $discount_method; ?></td>
				<td><?php echo $discount_amount; ?></td>
				<?php } } ?>
				<td><?php echo $language['Action']; ?></td>
                </tr>
                </thead>
                <tbody>
              
				<?php			
                $que="select * from common_fees_discount_types_structure";
                $run=mysqli_query($conn73,$que);
				$serial_no1=0;
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$class_code = $row['class_code'];
				$serial_no1++;
			    $que3="select * from school_info_class_info where class_code='$class_code'";
                $run3=mysqli_query($conn73,$que3);
                while($row3=mysqli_fetch_assoc($run3)){
				$class=$row3['class_name'];
				}
				?>
				 <tr>
				 <td><?php echo $serial_no1; ?></td>
				 <td><?php echo $class; ?></td>
				 <?php 
				 for($i=0;$i<$serial_no;$i++){
				 ?>
				 <td>
				 <?php
				 for($j=0;$j<$fees_count;$j++){
				 $discount_method2[$j] = $row[$discount_method1[$i].$fees_code[$j]];
				 echo $discount_method2[$j].', ';
				 }
				 ?>
				 </td>
				 <td>
				 <?php
				 for($k=0;$k<$fees_count;$k++){
				 $discount_amount2[$k] = $row[$discount_amount1[$i].$fees_code[$k]];
				 echo $discount_amount2[$k].', ';
				 }
				 ?>
				 </td>

				 <?php } ?>
				 <td><button type="button" onclick="post_content('fees_monthly/discount_types_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-default my_background_color" ><?php echo $language['Edit']; ?></button></td>
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