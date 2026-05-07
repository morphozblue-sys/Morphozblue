<?php include("../attachment/session.php"); ?>
<script>
function valid(s_no){
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_element(s_no);       
 }            
else  {      
return false;
 }       
  }
  function delete_element(s_no){
$.ajax({
type: "POST",
url: access_link+"certificate/sport_certificate_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('certificate/sport_certificate_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>
   <section class="content-header">
      <h1>
	  
        <?php echo $language['Certificate Management']; ?>
		<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> Certificate</a></li>
      <li class="active"><?php echo $language['Sports Certificate List']; ?></li> </ol>
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Sports Certificate List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Sports Type']; ?></th>
                  <th><?php echo $language['Organized Date']; ?></th>
                  <th><?php echo $language['Rank']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th><?php echo $language['Print']; ?></th>
                  <th><?php echo $language['Edit']; ?></th>
                  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
                <tbody>
								<?php
$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$sport_certificate = $row321['sport_certificate'];
}	

							
				$qry="select * from sport_certificate where student_sport_status='Active' and session_value='$session1' order by s_no DESC";
				$rest=mysqli_query($conn73,$qry);
				$serial_no=0;
				while($row22=mysqli_fetch_assoc($rest)){
				$s_no=$row22['s_no'];
				$sport_student_name=$row22['sport_student_name'];
				$sport_type=$row22['sport_type'];
				$sport_organized_date=$row22['sport_organized_date'];
				$sport_rank=$row22['sport_rank'];
				$sport_student_roll_no=$row22['sport_student_roll_no'];
				
                $update_change=$row22['update_change'];
                if($row22['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row22['last_updated_date']));
                }else{
                $last_updated_date=$row22['last_updated_date'];
                }
				
				$serial_no++;
				?>
                
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $sport_student_name; ?></td>
				  <td><?php echo $sport_student_roll_no; ?></td>
                  <td><?php echo $sport_type; ?></td>
                  <td><?php echo $sport_organized_date; ?></td>
                  <td><?php echo $sport_rank; ?></td>
                  
                  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
                  
                 <td><a href='<?php echo $pdf_path; ?>certificate_page/<?php echo $sport_certificate; ?>?id=<?php echo $s_no; ?>' target="_blank"><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
				  <td><button type="button" onclick="post_content('certificate/sport_certificate_form_edit','<?php echo 'id='.$s_no; ?>')"  class="btn btn-success"><?php echo $language['Edit']; ?></button></td>
			  
				 <td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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