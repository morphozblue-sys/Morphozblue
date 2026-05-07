<?php include("../attachment/session.php")?>
 <script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();

 }
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['School Information Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li class="active">Student Strength Report</li>
      </ol>
    </section>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
	  	<div class="box-header with-border ">
		<div class="col-md-12">
		
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Religion Wise Student Data')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
		</div>
        </div>
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              
            </div>
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
			 <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span>
			  </div>
			  <div class="col-md-12">
			  <div class="col-md-3">
			  <center><b>Dise Code : <?php echo $school_info_dise_code; ?></b></center>
			  </div>
			  <div class="col-md-6">
				<span style="font-size:20px;font-weight:bold"><center>STUDENT STRENGTH INFO Religion Wise</center></span>
			  </div>
			  <div class="col-md-3">
			  <center><b>School Code : <?php echo $school_info_school_code; ?></b></center>
			  </div>
			  </div>
			  
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
				<td style="float:left"><b></b></td>
				<td style="float:right"><b></b></td>
			  </tr>
			  </table>
            <div class="box-body table-responsive" >
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
                <thead >
                <tr>
				  <th rowspan="2">Serial No</th>
				  <th rowspan="2"><?php echo $language['Class']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Students']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Boys']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Girls']; ?></th>
				  <th colspan="3">Hindu</th>
				  <th colspan="3">Muslim</th>
				  <th colspan="3">Sikh</th>
				  <th colspan="3">Christian</th>
				  <th colspan="3">Jain</th>
				  <th colspan="3">Buddh</th>
				  <th colspan="3">Other</th>
						  
                </tr>
				   <tr>
				  <th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>
					<th>Boy</th>
				  <th>Girl</th>
				  <th>Total</th>				  
                </tr>
                </thead>
                <tbody>
				
	
				
			
				
			
                
				<?php				
                  $total_total_student_class_wise=0;
                 $total_student_male_total=0;
                 $total_student_female_total=0;
                 $total_hindu_student_total_male=0;
                 $total_hindu_student_total_female=0;
                 $total_hindu_student_total=0;
                 $total_muslim_student_total_male=0;
                 $total_muslim_student_total_female=0;
                 $total_muslim_student_total=0;
				  $total_sikh_student_total_male=0;
                 $total_sikh_student_total_female=0;
                 $total_sikh_student_total=0;
				  $total_jain_student_total_male=0;
                 $total_jain_student_total_female=0;
                 $total_jain_student_total=0;
				  $total_other_student_total_male=0;
                 $total_other_student_total_female=0;
                 $total_other_student_total=0;
				  $total_chirstan_student_total_male=0;
                 $total_chirstan_student_total_female=0;
                 $total_chirstan_student_total=0;
				  $total_buddh_student_total_male=0;
                 $total_buddh_student_total_female=0;
                 $total_buddh_student_total=0;
				$que123="select * from school_info_class_info order by s_no";
				$run123=mysqli_query($conn73,$que123);
				$serial_no=0;
				while($row123=mysqli_fetch_assoc($run123)){
				$class_name=$row123['class_name'];
                $serial_no++;
				
				
 				
              $color="white";
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$total_student_class_wise=0;
				while($row=mysqli_fetch_assoc($run)){
				$total_student_class_wise++;
				}
			
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$student_male_total=0;
				while($row=mysqli_fetch_assoc($run)){	
				$student_male_total++;
					
				}

				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$student_female_total=0;
				while($row=mysqli_fetch_assoc($run)){	
				$student_female_total++;
					
				}
				
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Hindu' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$hindu_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$hindu_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Hindu' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$hindu_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$hindu_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Muslim' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$muslim_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$muslim_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Muslim' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$muslim_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$muslim_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Sikh' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$sikh_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$sikh_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Sikh' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$sikh_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$sikh_student_total_female++;
				}
				
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Jain' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$jain_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$jain_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Jain' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$jain_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$jain_student_total_female++;
				}
				
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Other' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$other_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$other_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Other' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$other_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$other_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Buddh' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$buddh_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$buddh_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Buddh' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$buddh_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$buddh_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_religion='Christian' and student_gender='Male' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$chirstan_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$chirstan_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_religion='Christian' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$chirstan_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$chirstan_student_total_female++;
				}
				
				
	$hindu_student_total=$hindu_student_total_male+$hindu_student_total_female;
	$muslim_student_total=$muslim_student_total_male+$muslim_student_total_female;
	$sikh_student_total=$sikh_student_total_male+$sikh_student_total_female;
	$jain_student_total=$jain_student_total_male+$jain_student_total_female;
	$other_student_total=$other_student_total_male+$other_student_total_female;
	$buddh_student_total=$buddh_student_total_male+$buddh_student_total_female;
	$chirstan_student_total=$chirstan_student_total_male+$chirstan_student_total_female;
                ?>

                <tr>
                  <td><b><?php echo $serial_no; ?></b></td>
                  <td><b><?php echo $class_name; ?></b></td>
                  <td><b><?php echo $total_student_class_wise ; ?></b></td>
                  <td><b><?php echo $student_male_total ; ?></b></td>
                  <td><b><?php echo $student_female_total ; ?></b></td>
                  <td><b><?php echo $hindu_student_total_male ; ?></b></td>
                  <td><b><?php echo $hindu_student_total_female ; ?></b></td>
                  <td><b><?php echo $hindu_student_total ; ?></b></td>
                  <td><b><?php echo $muslim_student_total_male ; ?></b></td>
                  <td><b><?php echo $muslim_student_total_female ; ?></b></td>
                  <td><b><?php echo $muslim_student_total ; ?></b></td>
				  <td><b><?php echo $sikh_student_total_male ; ?></b></td>
                  <td><b><?php echo $sikh_student_total_female ; ?></b></td>
                  <td><b><?php echo $sikh_student_total ; ?></b></td>
				  <td><b><?php echo $chirstan_student_total_male ; ?></b></td>
                  <td><b><?php echo $chirstan_student_total_female ; ?></b></td>
                  <td><b><?php echo $chirstan_student_total ; ?></b></td>
				  <td><b><?php echo $jain_student_total_male ; ?></b></td>
                  <td><b><?php echo $jain_student_total_female ; ?></b></td>
                  <td><b><?php echo $jain_student_total ; ?></b></td>
				  <td><b><?php echo $buddh_student_total_male ; ?></b></td>
                  <td><b><?php echo $buddh_student_total_female ; ?></b></td>
                  <td><b><?php echo $buddh_student_total ; ?></b></td>
				  <td><b><?php echo $other_student_total_male ; ?></b></td>
                  <td><b><?php echo $other_student_total_female ; ?></b></td>
                  <td><b><?php echo $other_student_total ; ?></b></td>

                  
                </tr>
                <?php 
                $total_total_student_class_wise=$total_total_student_class_wise+$total_student_class_wise;
                 $total_student_male_total=$total_student_male_total+$student_male_total;
                 $total_student_female_total=$total_student_female_total+$student_female_total;
                 $total_hindu_student_total_male=$total_hindu_student_total_male+$hindu_student_total_male;
                 $total_hindu_student_total_female=$total_hindu_student_total_female+$hindu_student_total_female;
                 $total_hindu_student_total=$total_hindu_student_total+$hindu_student_total;
                 $total_muslim_student_total_male=$total_muslim_student_total_male+$muslim_student_total_male;
                 $total_muslim_student_total_female=$total_muslim_student_total_female+$muslim_student_total_female;
                 $total_muslim_student_total=$total_muslim_student_total+$muslim_student_total;
				  $total_sikh_student_total_male=$total_sikh_student_total_male+$sikh_student_total_male;
                 $total_sikh_student_total_female=$total_sikh_student_total_female+$sikh_student_total_female;
                 $total_sikh_student_total=$total_sikh_student_total+$sikh_student_total;
				  $total_jain_student_total_male=$total_jain_student_total_male+$jain_student_total_male;
                 $total_jain_student_total_female=$total_jain_student_total_female+$jain_student_total_female;
                 $total_jain_student_total=$total_jain_student_total+$jain_student_total;
				  $total_other_student_total_male=$total_other_student_total_male+$other_student_total_male;
                 $total_other_student_total_female=$total_other_student_total_female+$other_student_total_female;
                 $total_other_student_total=$total_other_student_total+$other_student_total;
				   $total_chirstan_student_total_male=$total_chirstan_student_total_male+$chirstan_student_total_male;
                 $total_chirstan_student_total_female=$total_chirstan_student_total_female+$chirstan_student_total_female;
                 $total_chirstan_student_total=$total_chirstan_student_total+$chirstan_student_total;
				  $total_buddh_student_total_male=$total_buddh_student_total_male+$buddh_student_total_male;
                 $total_buddh_student_total_female=$total_buddh_student_total_female+$buddh_student_total_female;
                 $total_buddh_student_total=$total_buddh_student_total+$buddh_student_total;
				
				
				
				
				}
 ?>
					<tr>
                  <td><b></b></td>
                  <td style="color:red;"><b>All Class</b></td>
                  <td><b><?php echo $total_total_student_class_wise ; ?></b></td>
                  <td><b><?php echo $total_student_male_total ; ?></b></td>
                  <td><b><?php echo $total_student_female_total ; ?></b></td>
                  <td><b><?php echo $total_hindu_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_hindu_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_hindu_student_total ; ?></b></td>
                  <td><b><?php echo $total_muslim_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_muslim_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_muslim_student_total ; ?></b></td>
				  <td><b><?php echo $total_sikh_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_sikh_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_sikh_student_total ; ?></b></td>
		          <td><b><?php echo $total_chirstan_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_chirstan_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_chirstan_student_total ; ?></b></td>
				  <td><b><?php echo $total_jain_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_jain_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_jain_student_total ; ?></b></td>
				  <td><b><?php echo $total_buddh_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_buddh_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_buddh_student_total ; ?></b></td>
				  <td><b><?php echo $total_other_student_total_male ; ?></b></td>
                  <td><b><?php echo $total_other_student_total_female ; ?></b></td>
                  <td><b><?php echo $total_other_student_total ; ?></b></td>
                </tr>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Religion Wise Student Data')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
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
