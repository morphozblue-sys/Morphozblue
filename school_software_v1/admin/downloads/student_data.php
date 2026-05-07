<?php include("../attachment/session.php"); ?>
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

  <section class="content-header">
      <h1>
        Downloads Management
        <mdall>Control Panel</mdall>
      </h1>
      <ol class="breadcrumb">
	    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
	    <li><a href="javascript:get_content('downloads/select_student')"><i class="fa fa-stack-overflow"></i>Select Student</a></li>
	    <li class="active">Download PDF EXCEL</li>
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
			  <center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Student Data')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$school_info_medium=$schl_row['school_info_medium'];
			}
			?>
			  
			  <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			  <tr>
			  <td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			  </tr>
			  <tr>
			  <td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			  <td><span style="margin-left :10px"; <center><b>STUDENT INFO</b></center></td>
			  <td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			  </tr>
			  </table>
				  <?php

									$query181="select * from school_info_class_info";
								$run181=mysqli_query($conn73,$query181) or die(mysqli_error($conn73));
								while($row1=mysqli_fetch_assoc($run181)){
								$class_code_no=$row1['class_code_no'];
								$class_name=$row1['class_name'];
								$wyyw="update student_admission_info set class_code_no='$class_code_no' where student_class='$class_name'";
								mysqli_query($conn73,$wyyw);
								}
				  $student_data=$_POST['student_data'];
				  $head_count=count($student_data);
				  ?>
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <?php
								//   $info_column_name='';
								//   $info_column_arr='';
								  for($i=0;$i<$head_count;$i++){
								  $student_data1=explode("|?|",$student_data[$i]);
								  $info_heading=$student_data1[1];
								  $info_column_arr[$i]=$student_data1[0];
								  if($student_data1[0]!='student_age'){
								  $info_column_name=$info_column_name.",$student_data1[0]";
								  }
								  ?>
								  <th><?php echo $info_heading; ?></th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody >
					<?php
					$category = $_POST['category']; 
					$gender = $_POST['gender'];
					$class = $_POST['std_class'];
					$section = $_POST['student_class_section'];
					$student_old_new = $_POST['student_old_new'];
					$student_Medium = $_POST['student_Medium'];
					$student_Bus = $_POST['student_Bus'];
					$student_Route = $_POST['student_Route'];
					$Student_Status = $_POST['Student_Status'];
					$Student_hostel = $_POST['Student_hostel'];
					$admission_scheme = $_POST['admission_scheme'];
					$bus_fee_category_name = $_POST['bus_fee_category_name'];
					$student_adress = $_POST['student_adress'];
					$student_conveyance = $_POST['student_conveyance'];
					$student_fee_category = $_POST['student_fee_category'];
					if($category!='All'){
					$condition1 =" and student_category='$category'";
					}else{
					$condition1="";
					}
					if($gender!='All'){
					$condition2 =" and student_gender='$gender'";
					}else{
					$condition2="";
					}
					if($class!=''){
					$condition3 =" and student_class='$class'";
					}else{
					$condition3="";
					}
					if($section!='All'){
					$condition4 =" and student_class_section='$section'";
					}else{
					$condition4="";
					}
					
					if($admission_scheme!='All'){
					$condition_scheme =" and student_admission_scheme='$admission_scheme'";
					}else{
					$condition_scheme="";
					}
					
					if($student_old_new!='All')
					{
						$condition5=" and stuent_old_or_new='$student_old_new'";
					}
					else{
						$condition5="";
					}
					if($student_Medium!='All')
					{
						$condition6=" and student_medium='$student_Medium'";
					}
					else{
						$condition6="";
					}
					if($student_Bus!='All')
					{
						$condition7=" and student_bus='$student_Bus'";
					}
					else{
						$condition7="";
					}
					if($Student_Status!='All')
					{
						$condition8=" and student_status='$Student_Status'";
					}
					else{
						$condition8="";
					}
					if($Student_hostel!='All')
					{
						$condition9=" and student_hostel='$Student_hostel'";
					}
					else{
						$condition9="";
					}
					if($bus_fee_category_name!='All')
					{
						$condition10=" and student_bus_fee_category_code='$bus_fee_category_name'";
					}
					else{
						$condition10="";
					}
					if($student_Route!='All')
					{
						$Route_wise=" and student_bus_route='$student_Route'";
					}
					else{
						$Route_wise="";
					}
					$order_by = $_POST['order_by'];
					if($order_by!=''){
					if($order_by=='student_name' || $order_by=='student_father_name' || $order_by=='student_class_section' || $order_by=='student_category'){
					    $condition11 =" ORDER BY $order_by ASC";
					}elseif($order_by=='class_code_no'){
					    $condition11 =" ORDER BY student_class, student_class_section, student_class_stream, student_class_group ASC";
					}else{
					    $condition11 =" ORDER BY CAST($order_by AS UNSIGNED) ASC";
					}
					}else{
					$condition11="";
					}
					
					$age = $_POST['student_age'];
					//$student_age1 = $student_age-1;
                    if($age==0){
                    $age_condition="";
                    }else{
                    $current_date= date('Y-m-d');
                    $current_date_d= date('d');
                    $current_date_m= date('m');
                    $current_date_y= date("Y");
                    $current_date_y1= $current_date_y+1;
                    $student_age=$current_date_y-$age;
                    $student_age1=$current_date_y1-$age;
                    $student_dob=$student_age.'-'.$current_date_m.'-'.$current_date_d;
                    $student_dob1=$student_age1.'-'.$current_date_m.'-'.$current_date_d;
                    $age_condition=" and student_date_of_birth >='$student_dob' and student_date_of_birth <='$student_dob1'";
                    // $age_condition=" and (YEAR(CURDATE()) - YEAR(student_date_of_birth)) >'$student_age1' and (YEAR(CURDATE()) - YEAR(student_date_of_birth)) <='$student_age'";
                    }
					
					if($student_adress!='All'){
					$condition12=" and student_adress='$student_adress'";
					}else{
					$condition12="";
					}
					
					$student_city = $_POST['student_city'];
					if($student_city!='All'){
					$condition12_city=" and student_city='$student_city'";
					}else{
					$condition12_city="";
					}
					
					$student_block = $_POST['student_block'];
					if($student_block!='All'){
					$condition12_block=" and student_block='$student_block'";
					}else{
					$condition12_block="";
					}
					
					$student_district = $_POST['student_district'];
					if($student_district!='All'){
					$condition12_district=" and student_district='$student_district'";
					}else{
					$condition12_district="";
					}
					
					if($student_conveyance!='All'){
					$condition13=" and student_walk_through='$student_conveyance'";
					}else{
					$condition13="";
					}
					if($student_fee_category!='All'){
					$condition14=" and student_fee_category_code='$student_fee_category'";
					}else{
					$condition14="";
					}
					
					$student_class_stream = $_POST['student_class_stream'];
					if($student_class_stream!='All'){
					$stream_condition=" and student_class_stream='$student_class_stream'";
					}else{
					$stream_condition="";
					}
					
					$student_class_group = $_POST['student_class_group'];
					if($student_class_group!='All'){
					$group_condition=" and student_class_group='$student_class_group'";
					}else{
					$group_condition="";
					}
					
					$student_caste = $_POST['student_caste'];
					if($student_caste!='All'){
					$cast_condition=" and student_caste='$student_caste'";
					}else{
					$cast_condition="";
					}
					
					$student_religion = $_POST['student_religion'];
					if($student_religion!='All'){
					$religion_condition=" and student_religion='$student_religion'";
					}else{
					$religion_condition="";
					}
					
					$student_photo1 = $_POST['student_photo1'];
					if($student_photo1!='All'){
					if($student_photo1=='Yes'){
					$student_photo_condition=" and student_image!=''";
					//$student_photo_condition1=$student_image!='';
					}else{
					$student_photo_condition=" and student_image=''";
					//$student_photo_condition1=$student_image=='';
					}
					}else{
					$student_photo_condition="";
					//$student_photo_condition1=$student_image!=''." || ".$student_image='';
					}
					
					$student_rf_id_number1 = $_POST['student_rf_id_number1'];
					if($student_rf_id_number1=='Signed'){
					    $rfid_condition000=" and student_rf_id_number!=''";
					}elseif($student_rf_id_number1=='Unsigned'){
					    $rfid_condition000=" and (student_rf_id_number='' or student_rf_id_number IS NULL)";
					}else{
					    $rfid_condition000="";
					}
					
					$student_admission_type1 = $_POST['student_admission_type1'];
					if($student_admission_type1!='All'){
					    $adm_type_condition000=" and student_admission_type='$student_admission_type1'";
					}else{
					    $adm_type_condition000="";
					}
					
// 			echo 		$_SESSION['database_name'];

if(	$_SESSION['database_name']=="simptvla_globalacademygangapurcity" || $_SESSION['software_link']=="sanskarschoolnarsinghpur" || $_SESSION['software_link']=="gbvnhindoli" ){
    // $filter37
    $query="select s_no$info_column_name,student_roll_no,student_image_name,student_date_of_birth from student_admission_info where s_no!=''$rfid_condition000 and session_value='$session1' and student_status='Active' $condition1$condition2$condition3$condition4$condition5$condition6$condition7$condition8$condition9$condition10$condition_scheme$condition12$condition12_city$condition12_block$condition12_district$condition14$condition13$stream_condition$group_condition$cast_condition$religion_condition$age_condition$adm_type_condition000$condition11$Route_wise";
}else{
    $query="select s_no$info_column_name,student_roll_no,student_image_name,student_date_of_birth from student_admission_info where s_no!=''$rfid_condition000 and session_value='$session1' and student_status='Active' $condition1$filter37$condition2$condition3$condition4$condition5$condition6$condition7$condition8$condition9$condition10$condition_scheme$condition12$condition12_city$condition12_block$condition12_district$condition14$condition13$stream_condition$group_condition$cast_condition$religion_condition$age_condition$adm_type_condition000$condition11$Route_wise";
}
				
			    
					$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
					
					$serial_no=0;
					while($row=mysqli_fetch_assoc($result)){
					$student_roll_no=$row['student_roll_no'];
					$student_date_of_birth=$row['student_date_of_birth'];
                    $today = date("Y-m-d");
                    $student_age="";
                    if($student_date_of_birth!=''){
                    $diff = date_diff(date_create($student_date_of_birth), date_create($today));
                   
                    $student_age=$diff->format('%y')." Year ".$diff->format('%m')." Month ".$diff->format('%d')." Days";
                    }
                     $student_image=$row['student_image_name'];
                   
				    if(($student_photo1=='All') || ($student_photo1=='Yes' && $student_image!='') || ($student_photo1=='No' && $student_image=='')){
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no; ?></td>
					<?php for($j=0;$j<$head_count;$j++){ ?>
					<?php if($info_column_arr[$j]=='student_photo'){ ?>
					<td><img src="<?php if($student_image!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$student_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50px;" width="50px;"></td>
				<?php }else{ ?>
				
				<?php if($info_column_arr[$j]=='student_date_of_birth'){ ?>
				<?php if($row[$info_column_arr[$j]]!=''){ ?>
				<td><?php echo date('d-m-Y',strtotime($row[$info_column_arr[$j]])); ?></td>
				<?php }else{ ?>
				<td><?php echo $row[$info_column_arr[$j]]; ?></td>
				<?php } }elseif($info_column_arr[$j]=='student_age'){ ?>
				<?php if($student_date_of_birth!=''){ ?>
				<td><?php echo $student_age; ?></td>
				<?php }else{ ?>
				<td>&nbsp;</td>
				<?php } }elseif($info_column_arr[$j]=='student_date_of_admission'){ ?>
				<?php if($row[$info_column_arr[$j]]!=''){ ?>
				<td><?php echo date('d-m-Y',strtotime($row[$info_column_arr[$j]])); ?></td>
				<?php }else{ ?>
				<td><?php echo $row[$info_column_arr[$j]]; ?></td>
				<?php } }elseif($info_column_arr[$j]=='student_medium'){ ?>
				<?php if($row[$info_column_arr[$j]]!=''){ ?>
				<td><?php echo $row[$info_column_arr[$j]]; ?></td>
				<?php }else{ ?>
				<td><?php echo $school_info_medium; ?></td>
				<?php } }else{ ?>
				
					<td><?php echo $row[$info_column_arr[$j]]; ?></td>
					<?php } } } ?>
					</tr>
					<?php
					} }
					?>
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Student Data')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
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
