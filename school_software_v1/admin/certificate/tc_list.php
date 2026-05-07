<?php include("../attachment/session.php");

?>
			<script>
			function valid(s_no,roll_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_tc(s_no,roll_no);       
 }            
else  {      
return false;
 }       
  } 
function delete_tc(s_no,roll_no){
$.ajax({
type: "POST",
url: access_link+"certificate/tc_delete.php?id="+s_no+"&roll_no="+roll_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('certificate/tc_list');
			   }
}
});
}

function for_activate(student_roll_no){

if($('#student_'+student_roll_no).prop('checked')==true){
var student_status = "Active";
var message = "Active";
}else{
var student_status = "Tc_issued";
var message = "Inactive";
}

$.ajax({
type: "POST",
url: access_link+"certificate/ajax_active_inactive_student.php?student_roll_no="+student_roll_no+"&student_status="+student_status+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('This Student Successfully '+message+' in Student List !!!','green');
				   get_content('certificate/tc_list');
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
      <li class="active"> <?php echo $language['Tc List']; ?></li> </ol>
    </section>


	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Tc List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Father Name']; ?></th>
                  <th><?php echo $language['Class']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Issue Date']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  <th>A/I</th>
                  
                  <th><?php echo 'Print Tc'; ?></th>
                  <th><?php echo 'Print Noc'; ?></th>
                  <th><?php echo $language['Edit']; ?></th>
                  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php
 $que321="select tc,noc_certificate from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$tc = $row321['tc'];
	$noc_certificate = $row321['noc_certificate'];
}	
?>
                <?php
                $qry="select * from student_tc where student_tc_status='Active' and session_value='$session1' order by s_no DESC";
                $rest=mysqli_query($conn73,$qry);
                $serial_no=0;
                
                while($row22=mysqli_fetch_assoc($rest)){
                $s_no=$row22['s_no'];
                $tc_student_roll_no=$row22['tc_student_roll_no'];
                $tc_student_sssm_id_no=$row22['tc_student_sssm_id_no'];
                $tc_student_uid_no=$row22['tc_student_uid_no'];
                $tc_student_name=$row22['tc_student_name'];
                $tc_student_father_name=$row22['tc_student_father_name'];
                $tc_mother_name=$row22['tc_mother_name'];
                $tc_student_class=$row22['tc_student_class'];
                $date_of_school_leaving=$row22['date_of_school_leaving'];
                
                $update_change=$row22['update_change'];
                if($row22['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row22['last_updated_date']));
                }else{
                $last_updated_date=$row22['last_updated_date'];
                }
                
                $qry1="select student_status from student_admission_info where student_roll_no='$tc_student_roll_no' and session_value='$session1'$filter37";
                $rest1=mysqli_query($conn73,$qry1) or die(mysqli_error($conn73));
                $student_status='';
                while($row1=mysqli_fetch_assoc($rest1)){
                $student_status=$row1['student_status'];
                
                
                $serial_no++;
                
                ?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $tc_student_name; ?></td>
                  <td><?php echo $tc_student_father_name; ?></td>
                  <td><?php echo $tc_student_class; ?></td>
                  <td><?php echo $tc_student_roll_no; ?></td>
                  <td><?php echo $date_of_school_leaving; ?></td>
                  
                  <td><?php echo $update_change; ?></td>
                  <td><?php echo $last_updated_date; ?></td>
                  <td><input type="checkbox" name="" class="" id="<?php echo 'student_'.$tc_student_roll_no; ?>" onclick="for_activate('<?php echo $tc_student_roll_no; ?>');" value="" title="For Admission Info Active / Inactive" <?php if($student_status=='Active'){ echo 'checked'; } ?> /></td>
                  
              <td><a href='<?php echo $pdf_path; ?>certificate_page/<?php echo $tc; ?>?id=<?php echo $s_no; ?>' target="_blank"><button type="button" class="btn btn-success">Print Tc</button></a></td>
              <td><a href='<?php echo $pdf_path; ?>certificate_page/<?php echo $noc_certificate; ?>?id=<?php echo $s_no; ?>' target="_blank"><button type="button" class="btn btn-success">Print Noc</button></a></td>
               <?php if($_SESSION['software_link']!="pioneerschoolbarabanki"){ ?>
              <td><button type="button" onclick="post_content('certificate/tc_form_edit','<?php echo 'id='.$s_no; ?>')"  class="btn btn-success"><?php echo $language['Edit']; ?></button></td>
              <?php }else{?>
              <td><button type="button" onclick="post_content('certificate/tc_form_edit_pio','<?php echo 'id='.$s_no; ?>')"  class="btn btn-success"><?php echo $language['Edit']; ?></button></td>
              <?php }?>
			  <td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','<?php echo $tc_student_roll_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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