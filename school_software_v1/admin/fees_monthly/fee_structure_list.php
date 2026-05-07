<?php include("../attachment/session.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
?>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active"><?php echo $language['Fees Structure List']; ?></li>
      </ol>
    </section>
    
    <script>
    function for_category(value){
        post_content('fees_monthly/fee_structure_list', 'category_code='+value);
    }
    </script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->
<?php
if(isset($_GET['category_code'])){
    $select_category=$_GET['category_code'];
}else{
    $que001="select category_code from school_info_fee_category where category_name!='' LIMIT 1";
    $run001=mysqli_query($conn73,$que001) or die(mysqli_error($conn73));
    while($row001=mysqli_fetch_assoc($run001)){
    $select_category=$row001['category_code'];
    }
}
?>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-md-2 col-md-offset-5">
              <div class="col-md-12">
                <div class="form-group">
                <!-- <label>Fee Category</label> -->
                <select class="form-control" name="student_fee_category" id="student_fee_category" onchange="for_category(this.value);">
                <?php
                $que01="select * from school_info_fee_category where category_name!=''";
                $run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
                while($row01=mysqli_fetch_assoc($run01)){
                $category_name = $row01['category_name'];
                $category_name_hindi = $row01['category_name_hindi'];
                $category_code = $row01['category_code'];
                ?>
                <option <?php if($select_category==$category_code){ echo 'selected'; } ?> value="<?php echo $category_code; ?>"><?php echo $category_name; ?></option>
                <?php } ?>
                </select>
                </div>
              </div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <td>#</td>
				   <td><?php echo $language['Class']; ?></td>
				<?php				
                
				$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
                $run1=mysqli_query($conn73,$que1);
                while($row1=mysqli_fetch_assoc($run1)){
				$fees_code[] = $row1['fees_code'];
				$fees_count = $row1['fees_count'];
				}

                $que="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_type = $row['fee_type'];
				$fee_code = $row['fee_code'];
				$fee[$serial_no]="student_".$fee_code."_month";
				$serial_no++;
				?>
				  <td><?php echo $fee_type; ?></td>
				  <?php } ?>
				  <td><?php echo $language['Total Fee']; ?></td>
				  
				  <td>Update By</td>
                  <td>Date</td>
				  
				  <td><?php echo $language['Action']; ?></td>
                </tr>
                </thead>
                <tbody>
              
				<?php
				
				$serial_no1=0;
					$que3="select * from school_info_class_info";
                $run3=mysqli_query($conn73,$que3);
                while($row3=mysqli_fetch_assoc($run3)){
				$student_class=$row3['class_name'];
				$class_code=$row3['class_code'];
                
                 $que="select * from common_fees_fee_structure where session_value='$session1' and category_code='$select_category'$filter37 and class_code='$class_code' ORDER BY s_no ASC";
            
                $run=mysqli_query($conn73,$que);
                if(mysqli_num_rows($run)<1){
                    $ineser="insert into common_fees_fee_structure (session_value,category_code,class_code,student_medium,board,shift)values('$session1','$select_category','$class_code','$medium_change','$board_change','$shift_change')";
                    mysqli_query($conn73,$ineser);
                     $run=mysqli_query($conn73,$que);
                }
                while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
			 	$class_code = $row['class_code'];
				
                $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
				
				$serial_no1++;
				
			
				?>
				 <tr>
				 <td><?php echo $serial_no1; ?></td>
				 <td><?php echo $student_class; ?></td>
				 <?php 
				 $total_fee=0;
				 for($i=0;$i<$serial_no;$i++){
				 $fee1[$i] = 0;
				 for($u=0;$u<$fees_count;$u++){
				 $fee1[$i] = $fee1[$i]+intval($row[$fee[$i].$fees_code[$u]]);
				 }
				 $total_fee= $total_fee+$fee1[$i];
				 ?>
				<td><?php echo  $fee1[$i]; ?></td>
				<?php } ?>
				<td><?php echo $total_fee; ?>
				
				<td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>
				
				</td>
				<td><button type="button" onclick="post_content('fees_monthly/fee_structure_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-default my_background_color" ><?php echo $language['Edit']; ?></button></td>
                </tr>
                <?php } } ?>
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