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
 function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename?filename+'.xls':'excel_data.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
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
	  <li class="active">Student Age Report</li>
      </ol>
    </section>			    <section class="content">
      <div class="row">
	  	<div class="box-header with-border ">
		<div class="col-md-12">

			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel('printTable', 'Age Wise Student Data')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
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
				<span style="font-size:20px;font-weight:bold"><center>AgeWise STUDENT STRENGTH INFO</center></span>
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
            <div class="box-body table-responsive">    <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
                <thead>
                <tr>
				  <th rowspan="2">Serial No</th>
				  <th  rowspan="2">Age</th>
				  <th  rowspan="2">Total Students</th>
				 <?php 
				 
				 
				 	$que123="select * from school_info_class_info";
				$run123=mysqli_query($conn73,$que123);
				while($row123=mysqli_fetch_assoc($run123)){
				$class_array[]=$row123['class_name'];
				$student_classwise_total[$row123['class_name']]=0;
				$student_classwise_total_male[$row123['class_name']]=0;
				$student_classwise_total_female[$row123['class_name']]=0;
				}
				 for($x=0;$x<count($class_array);$x++){	
		     $class_name=$class_array[$x];
		     $student_age_detail[$class_name."Male"]['No DOB']=""; 
		     $student_age_detail[$class_name."Female"]['No DOB']=""; 
		     $student_age_detail[$class_name."Male"]['20+']=""; 
		     $student_age_detail[$class_name."Female"]['20+']=""; 
				  ?>
				  <th colspan="3"><?php echo $class_name; ?></th>
				 <?php } ?>
		      
						  
                </tr>
				   <tr>
				   <?php
				   	 for($x=0;$x<count($class_array);$x++){	
				   	     ?>
				   	  <th>Male</th>
				   	  <th>Female</th>
				   	  <th>Total</th>
				   
				   	     <?php }?>
				   </tr>
                </thead>
                <tbody>
				
	
			
				
			
                
				<?php	
	for($m=0;$m<20;$m++){
	    for($x=0;$x<count($class_array);$x++){	
		     $class_name=$class_array[$x];
	    $student_age_detail[$class_name."Male"][$m]="";
	    $student_age_detail[$class_name."Female"][$m]="";
	}
	}
			$today_date=date('Y-m-d');
			$dob_not_found=0;
				
				$que="select * from student_admission_info where student_status='Active' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				while($row=mysqli_fetch_assoc($run)){
				$student_class=$row['student_class'];
				$student_dob=$row['student_date_of_birth'];
				$student_gender=$row['student_gender'];
				if($student_dob!=''){
                $years = intval((strtotime($today_date)-strtotime($student_dob))/(3600*24*365.25)); 
                if($years<20){
                 $student_age_detail[$student_class.$student_gender][$years]=$student_age_detail[$student_class.$student_gender][$years]+1;   
                }else{
                    $student_age_detail[$student_class.$student_gender]['20+']=$student_age_detail[$student_class.$student_gender]['20+']+1;   
                }
				}else{            
				   $student_age_detail[$student_class.$student_gender]['No DOB']=$student_age_detail[$student_class.$student_gender]['No DOB']+1;    
				}
				}
				
				
				
				
	       $total_student=0;
		 for($x=0;$x<20;$x++){	
		    
		     $total_classwise=0;
		       	 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
		     $total_classwise=$total_classwise+$student_age_detail[$class_name."Male"][$x];
		     $total_classwise=$total_classwise+$student_age_detail[$class_name."Female"][$x];
		     $student_classwise_total[$class_name]=$student_classwise_total[$class_name]+$student_age_detail[$class_name."Male"][$x]+$student_age_detail[$class_name."Female"][$x];
		     $student_classwise_total_male[$class_name]=$student_classwise_total_male[$class_name]+$student_age_detail[$class_name."Male"][$x];
		     $student_classwise_total_female[$class_name]=$student_classwise_total_female[$class_name]+$student_age_detail[$class_name."Female"][$x];
		       	 }
		   $total_student=$total_student+$total_classwise;
	$serial_no++;
                ?>

                <tr>
                  <td ><b><?php echo $serial_no; ?></b></td>
                  <td><b><?php  echo ($x)."-".($x+1);  ?></b></td>
                  <td><b><?php echo  $total_classwise; ?></b></td>
                  	 <?php 
				 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
				  ?>
				  <td><b><?php echo $student_age_detail[$class_name."Male"][$x] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Female"][$x] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Male"][$x] +$student_age_detail[$class_name."Female"][$x] ; ?></b></td>
                  	 <?php } ?>
                 
                </tr>
               	 <?php } ?>
               	
                <?php
                $total_classwise_nodob=0;
                $total_classwise_plus=0;
		       	 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
		     $total_classwise_plus=$total_classwise_plus+$student_age_detail[$class_name]['20+'];
		     $student_classwise_total[$class_name]=$student_classwise_total[$class_name]+$student_age_detail[$class_name]['20+'];
		      $total_classwise_nodob=$total_classwise_nodob+$student_age_detail[$class_name]['No DOB'];
		     $student_classwise_total[$class_name]=$student_classwise_total[$class_name]+$student_age_detail[$class_name]['No DOB'];
		       	 }
                ?>
                
                 <tr>
                  <td><b><?php echo $serial_no+1; ?></b></td>
                  <td><b><?php  echo '20+';  ?></b></td>
                  <td><b><?php echo  $total_classwise_plus; ?></b></td>
                  	 <?php 
				 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
				  ?>
				  <td><b><?php echo $student_age_detail[$class_name."Male"]['20+'] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Female"]['20+'] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Male"]['20+']+$student_age_detail[$class_name."Female"]['20+'] ; ?></b></td>
                  	 <?php } ?>
                 
                </tr>
                <tr>
                  <td><b><?php echo $serial_no+2; ?></b></td>
                  <td><b><?php  echo 'DOB Not Found';  ?></b></td>
                  <td><b><?php echo  $total_classwise_nodob; ?></b></td>
                  	 <?php 
				 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
				  ?>
				  <td><b><?php echo $student_age_detail[$class_name."Male"]['No DOB'] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Female"]['No DOB'] ; ?></b></td>
				  <td><b><?php echo $student_age_detail[$class_name."Male"]['No DOB']+$student_age_detail[$class_name."Female"]['No DOB'] ; ?></b></td>
                  	 <?php } ?>
                 
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th><?php echo $total_student; ?></th>
                        	 <?php 
				 for($y=0;$y<count($class_array);$y++){	
		     $class_name=$class_array[$y];
				  ?>
				  <th><b><?php echo $student_classwise_total_male[$class_name]; ?></b></th>
				  <th><b><?php echo $student_classwise_total_female[$class_name]; ?></b></th>
				  <th><b><?php echo $student_classwise_total[$class_name]; ?></b></th>
                  	 <?php } ?>
                    </tr>
                </tfoot>
             </table>
            </div>
            </div>
 
			  <div class="row">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-info" onclick="exportTableToExcel('printTable', 'Age Wise Student Data')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
			  </div>
			  </div>