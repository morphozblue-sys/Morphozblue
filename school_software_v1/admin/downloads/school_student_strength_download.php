<?php include("../attachment/session.php");
$company_name=$_SESSION['company']; 
?><!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
 <?php include("../attachment/link_css.php"); ?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
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
 var isAndroid = /(android)/i.test(navigator.userAgent);
 if(!isAndroid){
  newWin.close();   
 }
//$('#printTable').print();
 }
</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        School Student Strength Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
	    <li><a href="downloads.php"><i class="fa fa-stack-overflow"></i>Downloads</a></li>
	    <li class="active">School Student Strength Report Download</li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'student List')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
		</div>
        </div>
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			
			<?php 
			$query111="select * from school_info_general";
			$redd=mysqli_query($conn73,$query111);
			while($rowq=mysqli_fetch_assoc($redd)){
			$school_info_school_name=$rowq['school_info_school_name'];
			}
			?>
			
			
<?php 
    $session_value=explode('_',$session1);
    $session_1=$session_value[0];			
    $session_2=$session_value[1];
		 ?>
			  
			  <div class="col-md-12">
				<span style="font-size:28px;font-weight:bold"><center><?php echo $school_info_school_name; ?></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center>SESSION<?php echo $session_1.'-'.$session_2; ?></center></span>
			  </div>
			  <div class="col-md-12">
				<span style="font-size:20px;font-weight:bold"><center>SCHOOL STUDENT STRENGTH REPORT</center></span>
			  </div>
			  <div class="col-md-12">
			  </div>
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
				<td style="float:left"><b></b></td>
				<td style="float:right"><b></b></td>
			  </tr>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="" style="width:100%;">
			 
			  <tr class="my_background_color">
			  <th rowspan="2">S.No.</th>
			  <th rowspan="2">CLASS</th>
			  <th colspan="4">CURRENT STRENGTH</th>
			  <th>TOTAL STRENGTH CLASSWISE</th>
		      </tr>
			  
			  <tr class="my_background_color">
			  <th>A</th>
			  <th>B</th>
			  <th>C</th>
			  <th>D</th>
			  
			  
			  <th>All Sections A+B+C+D</th>
		      </tr>
			  
	   <?php
		 $student_class=$_POST['student_class'];
		 $strength_type=$_POST['strength_type'];
		
	  if($strength_type=='All'){
	  $filter_type="registration_final='yes'";
	  }elseif($strength_type=='Old'){
	  $filter_type="registration_final='yes' && student_status='Active' && stuent_old_or_new='Old'";
	  }elseif($strength_type=='New'){
	  $filter_type="registration_final='yes' && student_status='Active' && stuent_old_or_new='New'";
	  }
	 
$student_class=$_POST['student_class']; 
if($student_class!=''){
if($student_class!='All'){
$condition1=" and class_name='$student_class'";
}else{
$condition1="";
}
}else{
$condition1="";
}
	
		$sql1="select * from school_info_class_info where s_no!=''$condition1"; 
		$serail_no=0;
		$serail_no1=0;
		$grand_total_A_strength=0;
		$grand_total_B_strength=0;
		$grand_total_C_strength=0;
		$grand_total_D_strength=0;
		$result1=mysqli_query($conn73,$sql1);
		while($row1=mysqli_fetch_assoc($result1)){
        $serail_no11=0;
	    $student_class_section=0;
        $current_session_new_admission=0;
        $class_name=$row1['class_name'];
       
	   $pre_variable_A_strength=$class_name."_student_current_strength_A_strength";
       $pre_variable_B_strength=$class_name."_student_current_strength_B_strength";
       $pre_variable_C_strength=$class_name."_student_current_strength_C_strength";
       $pre_variable_D_strength=$class_name."_student_current_strength_D_strength";
       

	   if($serail_no11=='0'){
	   $$pre_variable_A_strength=0;
	   $$pre_variable_B_strength=0;
	   $$pre_variable_C_strength=0;
	   $$pre_variable_D_strength=0;
	   }
	  
	 
	  $sql2="select * From student_admission_info where session_value='$session1' and student_class_section='A' && student_class='$class_name' && $filter_type";
	  $result2=mysqli_query($conn73,$sql2);
	  
	  while($row2=mysqli_fetch_assoc($result2)){
	  $stuent_old_or_new=$row2['stuent_old_or_new'];
	  
	  $$pre_variable_A_strength++;
	  $grand_total_A_strength++;
	  }
	  
	  $sql3="select * From student_admission_info where session_value='$session1' and student_class_section='B' && student_class='$class_name' && $filter_type";
	  $result3=mysqli_query($conn73,$sql3);
	  while($row3=mysqli_fetch_assoc($result3)){
	  $stuent_old_or_new=$row3['stuent_old_or_new'];
	  
	  $$pre_variable_B_strength++;
	  $grand_total_B_strength++;
	  }
	  
	  $sql4="select * From student_admission_info where session_value='$session1' and student_class_section='C' && student_class='$class_name' && $filter_type";
	  $result4=mysqli_query($conn73,$sql4);
	  while($row4=mysqli_fetch_assoc($result4)){
	  $stuent_old_or_new=$row4['stuent_old_or_new'];
	  
	  $$pre_variable_C_strength++;
	  $grand_total_C_strength++;
	  }
	  
	  $sql5="select * From student_admission_info where session_value='$session1' and student_class_section='D' && student_class='$class_name' && $filter_type";
	  $result5=mysqli_query($conn73,$sql5);
	  while($row5=mysqli_fetch_assoc($result5)){
	  $stuent_old_or_new=$row5['stuent_old_or_new'];
	  
	  $$pre_variable_D_strength++;
	  $grand_total_D_strength++;
	  }
	 


$serail_no11++;
$serail_no1++;
$serail_no++;

			  ?>
		      <tr>
			  
			  <th><?php echo $serail_no; ?></th>
			  <th><?php echo $class_name; ?></th>
			  			  
			  <th><?php echo $$pre_variable_A_strength; ?></th>
			  <th><?php echo $$pre_variable_B_strength; ?></th>
			  <th><?php echo $$pre_variable_C_strength; ?></th>
			  <th><?php echo $$pre_variable_D_strength; ?></th>
			  <th><?php echo $$pre_variable_A_strength+$$pre_variable_B_strength+$$pre_variable_C_strength+$$pre_variable_D_strength; ?></th>
			
		      </tr>
			  <?php } ?>
			  
			  
			  <tr>
			  <th>Total</th>
			  <th></th>		  
			  <th><?php echo $grand_total_A_strength; ?></th>
			  <th><?php echo $grand_total_B_strength; ?></th>
			  <th><?php echo $grand_total_C_strength; ?></th>
			  <th><?php echo $grand_total_D_strength; ?></th>
			  <th><?php echo $grand_total_A_strength+$grand_total_B_strength+$grand_total_C_strength+$grand_total_D_strength; ?></th>
		      </tr>
			  </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Student Strength Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  
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
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
</div>
 <?php include("../attachment/link_js.php"); ?>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>