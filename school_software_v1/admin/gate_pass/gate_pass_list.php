<?php include("../attachment/session.php")?>

<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_gate_pass(s_no);       
 }            
else  {      
return false;
 }       
  }
function  delete_gate_pass(s_no){
$.ajax({
type: "POST",
url: access_link+"gate_pass/delete_gate_pass.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
		
				   get_content('gate_pass/gate_pass_list');
			   }else{
               alert(detail); 
			   }
}
});
}  
</script>
  
  <section class="content-header">
      <h1>
           Gate Pass
					<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('gate_pass/gate_pass')"><i class="fa fa-inr"></i>Gate Pass</a></li>
		<li><i class="Active"></i><?php echo $language['List']; ?></li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th>S NO</th>
                  <th>Gate Pass Number</th>
                  <th>Student Name</th>
                  <th>Class(Section)</th>
                  <th>Admission No</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Reason</th>
                  <th>Recommender</th>
                  <th>Approver</th>
                  <th>Print</th>
                  <th>Thermal Print</th>
				  <th><?php echo $language['Delete']; ?></th>
				</tr>
                </thead>
                <tbody>
				<?php
				//$_SESSION; software_link   simsrampur
				$que="select * from student_gate_pass where gate_pass_status='Active'  and session_value='$session1' ORDER BY s_no DESC";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_class=$row['student_class'];
				$student_section=$row['student_section'];
				$gate_pass_date=$row['gate_pass_date'];
				$gate_pass_time=$row['gate_pass_time'];
				$student_admission_number=$row['student_admission_number'];
				$recommender=$row['recommender'];
				$reason_for_leaving=$row['reason_for_leaving'];
				$approver=$row['approver'];
				$session_value=$row['session_value'];

				$serial_no++;
                ?>
                
				<tr>         
				<td><?php echo $serial_no; ?></td>
				<td><?php echo $s_no; ?></td>
				<td><?php echo $student_name; ?></td>
				<td><?php echo $student_class."(".$student_section.")"; ?></td>
					<td><?php echo $student_admission_number; ?></td>
				<td><?php echo $gate_pass_date; ?></td>
				<td><?php echo $gate_pass_time; ?></td>
				<td><?php echo $reason_for_leaving; ?></td>
				<td><?php echo $recommender; ?></td>
				<td><?php echo $approver; ?></td>
				<?php $pdf_url='gate_pass_pdf.php';
				 //  echo '<pre>';print_r($_SESSION);
				//   
				if($_SESSION['database_name1']=='hujaifaschooltura')
				{
				   $pdf_url='gate_pass_pdf_huj.php'; 
				}else
				{
				  	if($_SESSION['database_name1']=='saraswatibalmandirbhaunkhedi')
				{
				   $pdf_url='gate_pass_saraswatibal.php'; 
				}
				}
				?>
				<td><a href='<?php echo $pdf_path; ?>gate_pass/<?php echo $pdf_url?>?id=<?php echo $s_no; ?>&session=<?php echo $session_value;?>' target="_blank"><button type="button" class="btn btn-success" >
		         Print</button></td>
		         <td><a href='../school_software_v1/pdf/pdf/gate_pass/gate_pass_pdf_thermal.php?id=<?php echo $s_no; ?>&session=<?php echo $session_value;?>' target="_blank"><button type="button" class="btn btn-success" >
		         Print</button></td>
		         
		         <td><button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
			
			
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
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
