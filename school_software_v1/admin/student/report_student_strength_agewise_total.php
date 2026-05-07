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
				<span style="font-size:20px;font-weight:bold"><center>AGEWISE STUDENT STRENGTH INFO</center></span>
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
				  <th rowspan="2">Student</th>
				  <th  colspan="21">Age</th>
				  <th  rowspan="2">Total Students</th>
				  	  
                </tr>
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
				 <?php } ?>
		      
					
				         <tr>
				   	  <?php
		 for($x=0;$x<20;$x++){
		     ?>
				      <td><b><?php  echo ($x)."-".($x+1);  ?></b></td>
				   
				   	     <?php }?>
				   	     <th>20+</th>
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
                 $student_age_detail[$student_gender][$years]=$student_age_detail[$student_gender][$years]+1;   
                }else{
                    $student_age_detail[$student_gender]['20+']=$student_age_detail[$student_gender]['20+']+1;   
                }
				}else{            
				   $student_age_detail[$student_gender]['No DOB']=$student_age_detail[$student_gender]['No DOB']+1;    
				}
				}
				
				
				
				
                ?>

                <tr>
                  <td><b>Boys</b></td>
                  <?php
                  $total1=0;
		 for($x=0;$x<20;$x++){
		     $total1=$total1+$student_age_detail["Male"][$x];
		     ?>
                  <td><b><?php  echo $student_age_detail["Male"][$x];  ?></b></td>
                  <?php }
                   $total1=$total1+$student_age_detail["Male"]['20+'];
		  
                  ?>
                  <td><b><?php echo $student_age_detail["Male"]['20+'] ; ?></b></td>
                  <th><?php echo $total1;?></th>
                  </tr>
                     <tr>
                  <td><b>Girls</b></td>
                  <?php
                  $total2=0;
		 for($x=0;$x<20;$x++){
		       $total2=$total2+$student_age_detail["Female"][$x];
		   
		     ?>
                  <td><b><?php  echo $student_age_detail["Female"][$x];  ?></b></td>
                  <?php }
                    $total2=$total2+$student_age_detail["Female"]['20+'];
		  
                  ?>
                  <td><b><?php echo $student_age_detail["Female"]['20+'] ; ?></b></td>
                   <th><?php echo $total2;?></th>
                  </tr>
                     <tr>
                  <td><b>Other</b></td>
                  <?php
                  $total3=0;
		 for($x=0;$x<20;$x++){
		     
		       $total3=$total3+$student_age_detail["Other"][$x];
		     ?>
                  <td><b><?php  echo $student_age_detail["Other"][$x];  ?></b></td>
                  <?php }
                    $total3=$total3+$student_age_detail["Other"]['20+'];
		  
                  ?>
                  <td><b><?php echo $student_age_detail["Other"]['20+'] ; ?></b></td>
                  <th><?php echo $total3;?></th>
               
                  </tr>
                    <tr>
                  <td><b>Total</b></td>
                  <?php
                  
		 for($x=0;$x<20;$x++){
		     ?>
                  <td><b><?php  echo $student_age_detail["Male"][$x]+$student_age_detail["Female"][$x]+$student_age_detail["Other"][$x];  ?></b></td>
                  <?php } ?>
                  <td><b><?php echo $student_age_detail["Male"]['20+']+$student_age_detail["Female"]['20+']+$student_age_detail["Other"]['20+'] ; ?></b></td>
                  <th><?php echo $total1+$total2+$total3;?></th>
               
                  </tr>
                </tbody>
                <tfoot>
                   
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