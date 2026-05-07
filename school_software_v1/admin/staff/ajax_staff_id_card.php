<?php 
include("../attachment/session.php"); ?> 
                <table id="example3" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
                  <th>Employee Id No</th>
                  <th>Employee Name</th>
                  <th>Select Employee &nbsp;<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
                </tr>
                </thead>
				
				<tbody>
			
 
<?php
 $emp_categories1=$_GET['id'];
if($emp_categories1=='All'){
 $condition=" ";   
}else{
 $condition="and emp_categories='$emp_categories1'";  
}
//  $emp_categories=$_GET['id'];

$query1="select * from employee_info where emp_status='Active' $condition ORDER BY emp_name";
$serial_no=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$emp_name=$row1['emp_name'];
$emp_id=$row1['emp_id'];

$serial_no++;
?>
  
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $emp_id; ?></td>
<td><?php echo $emp_name; ?></td>
<td><input type="checkbox"  name="staff_id_card_info[]" class="checked1" value="<?php echo $emp_id; ?>" checked ></td>
</tr>
<?php  } ?>
 	
		        </tbody>
				
                </table>
				<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>