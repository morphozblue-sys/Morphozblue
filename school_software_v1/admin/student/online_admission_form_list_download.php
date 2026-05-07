<?php include("../attachment/session.php");
?>
<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
//$('#printTable').print();
 }
</script>


  <section class="content-header">
      <h1>
        <?php echo $language['Student Management']; ?>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li class="active">Admission Form Download</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-12">
		
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Student Admission Form List Download')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
		</div>
        </div>
	
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			  
			<?php
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			}
			?>
			  
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
			  <td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			  </tr>
			  <tr>
			  <td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			  <td><center><b>Student Admission Form List Download</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0">
						<thead >
								<tr>
								  <th>S.No.</th>
								  <th>Selection Roll No</th>
								  <th>Selection Obtain Marks</th>
								  <th>Selection Category</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Father Occupation</th>
								  <th>Father Annual Income</th>
								  <th>Mother Name</th>
								  <th>Mother Occupation</th>
								  <th>Student Category</th>
								  <th>Student DOB</th>
								  <th>Student DOB Word</th>
								  <th>Student Full Address</th>
								  <th>Student Gender</th>
								  <th>Student Disability Class</th>
								  <th>Student Disability Type</th>
								  <th>Student Disability Percentage</th>
								  <th>Student Mobile No</th>
								  <th>Father Mobile No</th>
								  <th>Whatsapp No</th>
								  <th>Student SSSM Id</th>
								  <th>Student UID No</th>
								  <th>Support Card No</th>
								  <th>Student Bank Account No</th>
								  <th>IFSC Code</th>
								  <th>Bank Name & Address</th>
								  <th>Previous Class</th>
								  <th>Previous School Name</th>
								  <th>School Dise Code</th>
								  <th>Previous Percentage</th>
								  <th>Admission Class</th>
								  <th>Stream</th>
								  <th>Sibling</th>
								  <th>Whatsapp Group Related</th>
								  <th>Student Image</th>
								  <th>Income Certificate Image</th>
								  <th>Student UID Image</th>
								  <th>Caste Certificate Image</th>
								  <th>Bank Passbook Image</th>
								</tr>
						</thead>
					<tbody >
                    <?php
                    $query19="select * from student_admission_info_website where status='Active'";
                    $run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
                    $ser=0;
                    while($row=mysqli_fetch_assoc($run19)){
                    $selection_roll_no=$row['selection_roll_no'];
                    $selection_obtain_marks=$row['selection_obtain_marks'];
                    $selection_category=$row['selection_category'];
                    $student_name=$row['student_name'];
                    $father_name=$row['father_name'];
                    $father_occupation=$row['father_occupation'];
                    $father_annual_income=$row['father_annual_income'];
                    $mother_name=$row['mother_name'];
                    $mother_occupation=$row['mother_occupation'];
                    $student_category=$row['student_category'];
                    $student_dob=$row['student_dob'];
                    $student_dob_word=$row['student_dob_word'];
                    $student_full_address=$row['student_full_address'];
                    $student_gender=$row['student_gender'];
                    $student_disability_class=$row['student_disability_class'];
                    $student_disability_type=$row['student_disability_type'];
                    $student_disability_percentage=$row['student_disability_percentage'];
                    $student_mobile_no=$row['student_mobile_no'];
                    $father_mobile_no=$row['father_mobile_no'];
                    $whatsapp_no=$row['whatsapp_no'];
                    $student_sssm_id=$row['student_sssm_id'];
                    $student_uid_no=$row['student_uid_no'];
                    $support_card_no=$row['support_card_no'];
                    $student_bank_account_no=$row['student_bank_account_no'];
                    $student_bank_ifsc_code=$row['student_bank_ifsc_code'];
                    $student_bank_name_address=$row['student_bank_name_address'];
                    $student_previous_class=$row['student_previous_class'];
                    $student_previous_school_name_disecode=$row['student_previous_school_name_disecode'];
                    $school_disecode=$row['school_disecode'];
                    $student_previous_percentage=$row['student_previous_percentage'];
                    $student_admission_class=$row['student_admission_class'];
                    $student_stream=$row['student_stream'];
                    $student_sibling=$row['student_sibling'];
                    $whatsapp_group_related=$row['whatsapp_group_related'];
                    $student_image=$row['student_image'];
                    $income_certificate_image=$row['income_certificate_image'];
                    $student_uid_image=$row['student_uid_image'];
                    $caste_certificate_image=$row['caste_certificate_image'];
                    $bank_passbook_image=$row['bank_passbook_image'];
                    
                    $ser++;
                    ?>
					<tr>
					<td><?php echo $ser; ?></td>
					<td><?php echo $selection_roll_no; ?></td>
					<td><?php echo $selection_obtain_marks; ?></td>
					<td><?php echo $selection_category; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $father_name; ?></td>
					<td><?php echo $father_occupation; ?></td>
					<td><?php echo $father_annual_income; ?></td>
					<td><?php echo $mother_name; ?></td>
					<td><?php echo $mother_occupation; ?></td>
					<td><?php echo $student_category; ?></td>
					<td><?php echo $student_dob; ?></td>
					<td><?php echo $student_dob_word; ?></td>
					<td><?php echo $student_full_address; ?></td>
					<td><?php echo $student_gender; ?></td>
					<td><?php echo $student_disability_class; ?></td>
					<td><?php echo $student_disability_type; ?></td>
					<td><?php echo $student_disability_percentage; ?></td>
					<td><?php echo $student_mobile_no; ?></td>
					<td><?php echo $father_mobile_no; ?></td>
					<td><?php echo $whatsapp_no; ?></td>
					<td><?php echo $student_sssm_id; ?></td>
					<td><?php echo $student_uid_no; ?></td>
					<td><?php echo $support_card_no; ?></td>
					<td><?php echo $student_bank_account_no; ?></td>
					<td><?php echo $student_bank_ifsc_code; ?></td>
					<td><?php echo $student_bank_name_address; ?></td>
					<td><?php echo $student_previous_class; ?></td>
					<td><?php echo $student_previous_school_name_disecode; ?></td>
					<td><?php echo $school_disecode; ?></td>
					<td><?php echo $student_previous_percentage; ?></td>
					<td><?php echo $student_admission_class; ?></td>
					<td><?php echo $student_stream; ?></td>
					<td><?php echo $student_sibling; ?></td>
					<td><?php echo $whatsapp_group_related; ?></td>
					
					<td><img src="<?php if($student_image!=''){ echo $_SESSION['amazon_file_path']."student_admission_info_website/".$student_image; } ?>" height="50" width="50"></td>
					<td><img src="<?php if($income_certificate_image!=''){ echo $_SESSION['amazon_file_path']."student_admission_info_website/".$income_certificate_image; } ?>" height="50" width="50"></td>
					<td><img src="<?php if($student_uid_image!=''){ echo $_SESSION['amazon_file_path']."student_admission_info_website/".$student_uid_image; } ?>" height="50" width="50"></td>
					<td><img src="<?php if($caste_certificate_image!=''){ echo $_SESSION['amazon_file_path']."student_admission_info_website/".$caste_certificate_image; } ?>" height="50" width="50"></td>
					<td><img src="<?php if($bank_passbook_image!=''){ echo $_SESSION['amazon_file_path']."student_admission_info_website/".$bank_passbook_image; } ?>" height="50" width="50"></td>
					</tr>
					<?php
					}
					?>		
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Student Admission Form List Download')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
      <!-- /.row -->
    </section>

  
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
