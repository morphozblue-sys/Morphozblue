<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Overall Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

<?php
$qry0001="select * from login";
$rest0001=mysqli_query($conn73,$qry0001);
$use_editable_or_not='';
while($row0001=mysqli_fetch_assoc($rest0001)){
$use_editable_or_not=$row0001['use_editable_or_not'];
}
if($use_editable_or_not=='Yes'){
    $fee_rec_column_name='editable_receipt_no';
}else{
    $fee_rec_column_name='blank_field_5';
}
?>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
            <?php
			$class_name=$_GET['class_name'];
			if($class_name!=''){
			    $condition=" and student_class='$class_name'";
			}else{
			    $condition="";
			}
			$section_name=$_GET['section_name'];
			if($section_name!='All'){
			    $condition1=" and student_class_section='$section_name'";
			}else{
			    $condition1="";
			}
			$order_by=$_GET['order_by'];
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code,fees_category from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$fees_category=$schl_row['fees_category'];
			}
			
			if($fees_category=='installmentwise' || $fees_category=='monthly' || $fees_category=='yearly'){
			    $head_column_name="( <small>".ucfirst($fees_category)."</small> )";
			    $table_pre_name="common_";
			}else{
			    $head_column_name="( <small>Yearly</small> )";
			    $table_pre_name="";
			}
			
            $que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
            $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
            $serial_no=0;
            while($row0=mysqli_fetch_assoc($run0)){
            $s_no=$row0['s_no'];
            $fee_type = $row0['fee_type'];
            $fee_code = $row0['fee_code'];
            if($fee_type!=''){
            $fee_type1[$serial_no] = $row0['fee_type'];
            $fee_code1[$serial_no] = $row0['fee_code'];
            $fee_type=strtolower($fee_type);
            $fee[$serial_no]="student_".$fee_code."_month";
            $fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
            $fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
            $fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
            $total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
            $fee_balance[$serial_no]="student_".$fee_code."_balance_month";
            $fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
            $serial_no++;
            } }
            
            $qry3="select fees_code,fees_type_name,fees_count from school_info_".$fees_category."_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
            $rest3=mysqli_query($conn73,$qry3);
            // $fees_type_name='';
            // $fees_code1='';
            while($row3=mysqli_fetch_assoc($rest3)){
            $fees_code=$row3['fees_code'];
            $fees_code1[]=$row3['fees_code'];
            $fees_count=$row3['fees_count'];
            $fees_type_name[$fees_code]=$row3['fees_type_name'];
            }
            
            $qry1="select student_roll_no,student_name,student_class,student_class_section,student_father_name,student_mother_name,student_admission_number from student_admission_info where student_status='Active' and session_value='$session1' and registration_final='yes'$condition$condition1$filter37$order_by";
            $rest1=mysqli_query($conn73,$qry1);
            while($row1=mysqli_fetch_assoc($rest1)){
            $student_roll_no1=$row1['student_roll_no'];
            $student_name=$row1['student_name'];
            $student_class=$row1['student_class'];
            $student_class_section=$row1['student_class_section'];
            $student_father_name=$row1['student_father_name'];
            $student_mother_name=$row1['student_mother_name'];
            $student_admission_number=$row1['student_admission_number'];
            
            $database_name1=$_SESSION['database_name'];
            $database_blob1=$database_name1."_blob";
            $que2="select student_image from $database_blob1.student_documents where student_roll_no='$student_roll_no1'";
            $run2=mysqli_query($conn73,$que2);
            $student_image='';
            while($row2=mysqli_fetch_assoc($run2)){
            $student_image=$row2['student_image_name'];
            }
			?>
            <table id="example5" style="page-break-after:always;" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
            <tr>
            <td>
			
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>OVERALL REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
					<tr>
					    <td>
					        Name : <?php echo $student_name; ?>
					    </td>
					    <td>
					        Class : <?php echo $student_class; ?>
					    </td>
					    <td>
					        Section : <?php echo $student_class_section; ?>
					    </td>
					    <td rowspan="2">
					        <img src="<?php if($student_image!=''){ echo $_SESSION['amazon_file_path']."student_documents/".$student_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_photo" height="90" width="80" />
					    </td>
					</tr>
					<tr>
					    <td>
					        Mother : <?php echo $student_mother_name; ?>
					    </td>
					    <td>
					        Father : <?php echo $student_father_name; ?>
					    </td>
					    <td>
					        Admission No : <?php echo $student_admission_number; ?>
					    </td>
					</tr>
				  </table>
				  
				  <table id="example2" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
					<thead class="my_background_color">
					<tr>
					    <th>
					        S.No.
					    </th>
					    <th>
					        Pay
					    </th>
					    <th>
					        Date
					    </th>
					    <th>
					        Receipt No
					    </th>
					    <th>
					        Paid Amount
					    </th>
					    <th>
					        Balance Amount
					    </th>
					</tr>
					</thead>
					<tbody>
					<?php
					$qry4="select * from ".$table_pre_name."fees_student_fee_add where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no1'$condition";
                    $rest4=mysqli_query($conn73,$qry4);
                    $serial_no4=0;
                    while($row4=mysqli_fetch_assoc($rest4)){
                    //$grand_total=$row4['grand_total'];
                    if($row4['fee_submission_date']!=''){
                        $fee_submission_date=date('d-m-Y', strtotime($row4['fee_submission_date']));
                    }else{
                        $fee_submission_date=$row4['fee_submission_date'];
                    }
                    $paid_total=$row4['paid_total'];
                    $balance_total=$row4['balance_total'];
                    $fee_paid_months=$row4['fee_paid_months'];
                    $blank_field_5=$row4[$fee_rec_column_name];
             
                    $month_strcount1=substr_count($fee_paid_months,',');
                    // $month_exp='';
                    if($month_strcount1>0){
                    $month_exp=explode(',',$fee_paid_months);
                    $month_count=count($month_exp);
                    }else{
                    $month_exp[]=$fee_paid_months;
                    $month_count=1;
                    }
                    
                    // $month_string='';
                    // $comma='';
                    for($i=0;$i<$month_count;$i++){
                    if($i>0){
                    $comma=', ';    
                    }
                    $month_string = $month_string.$comma.$fees_type_name[$month_exp[$i]];
                    }
                    
                    $serial_no4++;
					?>
					<tr>
					    <td>
					        <?php echo $serial_no4.' .'; ?>
					    </td>
					    <td>
					        <?php echo $month_string; ?>
					    </td>
					    <td>
					        <?php echo $fee_submission_date; ?>
					    </td>
					    <td>
					        <?php echo $blank_field_5; ?>
					    </td>
					    <td>
					        <?php echo $paid_total; ?>
					    </td>
					    <td>
					        <?php echo $balance_total; ?>
					    </td>
					</tr>
					<?php } ?>
					</tbody>
				  </table>
				  
				  <table id="example3" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
					<thead class="my_background_color">
					<tr>
					    <th>
					        School Fee Description
					    </th>
					    <th>
					        Total Fee
					    </th>
					    <th>
					        Total Paid
					    </th>
					    <th>
					        Total Left
					    </th>
					    <th>
					        Discount
					    </th>
					</tr>
					</thead>
					<tbody>
					<?php
					$qry5="select * from ".$table_pre_name."fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no1'$condition";
                    $rest5=mysqli_query($conn73,$qry5);
                    $total_class_fee=0;
                    $total_paid_class_fee=0;
                    $total_left_class_fee=0;
                    $total_discount_class_fee=0;
                    $overall_total_class_fee=0;
                    $overall_total_paid_class_fee=0;
                    $overall_total_left_class_fee=0;
                    $overall_total_discount_class_fee=0;
                    $student_transport_fee=0;
                    $student_transport_fee_balance=0;
                    $student_transport_fee_paid_total=0;
                    $student_transport_fee_discount_total=0;
                    
                    $trans_total_class_fee=0;
                    $trans_total_paid_class_fee=0;
                    $trans_total_left_class_fee=0;
                    $trans_total_discount_class_fee=0;
                    $total_previous_dues_class_fee=0;
                    $total_previous_dues_paid_class_fee=0;
                    $total_previous_dues_left_class_fee=0;
                    $total_previous_dues_discount_class_fee=0;
                    
                    $other_fee_amount=0;
                    $penalty_amount=0;
                    while($row5=mysqli_fetch_assoc($rest5)){
                    $student_transport_fee=$row5['student_transport_fee'];
                    $student_transport_fee_balance=$row5['student_transport_fee_balance'];
                    $student_transport_fee_paid_total=$row5['student_transport_fee_paid_total'];
                    
                    $total_previous_dues_class_fee=$row5['student_previous_year_fee'];
                    $total_previous_dues_paid_class_fee=$row5['student_previous_year_fee_paid_total'];
                    $total_previous_dues_left_class_fee=$row5['student_previous_year_fee_balance'];
                    
                    $other_fee_amount=$row5['other_fee_amount'];
                    $penalty_amount=$row5['penalty_amount'];
                    //$grand_total=$row5['grand_total'];
                    
                    for($j=0;$j<$serial_no;$j++){
                        for($k=0;$k<$fees_count;$k++){
                            if(substr_count($fee_type1[$j],'Transport')>0 || substr_count($fee_type1[$j],'Bus')>0){
                            $trans_total_class_fee=$trans_total_class_fee+$row5[$total_amount_after_discount[$j].$fees_code1[$k]];
                            $trans_total_paid_class_fee=$trans_total_paid_class_fee+$row5[$fee_paid[$j].$fees_code1[$k]];
                            $trans_total_left_class_fee=$trans_total_left_class_fee+$row5[$fee_balance[$j].$fees_code1[$k]];
                            $trans_total_discount_class_fee=$trans_total_discount_class_fee+($row5[$fee[$j].$fees_code1[$k]]-$row5[$total_amount_after_discount[$j].$fees_code1[$k]]);
                            }else{
                            $total_class_fee=$total_class_fee+$row5[$total_amount_after_discount[$j].$fees_code1[$k]];
                            $total_paid_class_fee=$total_paid_class_fee+$row5[$fee_paid[$j].$fees_code1[$k]];
                            $total_left_class_fee=$total_left_class_fee+$row5[$fee_balance[$j].$fees_code1[$k]];
                            $total_discount_class_fee=$total_discount_class_fee+($row5[$fee[$j].$fees_code1[$k]]-$row5[$total_amount_after_discount[$j].$fees_code1[$k]]);
                            }
                        }
                    }
                    
                    $student_transport_fee=$student_transport_fee+$trans_total_class_fee;
                    $student_transport_fee_balance=$student_transport_fee_balance+$trans_total_left_class_fee;
                    $student_transport_fee_paid_total=$student_transport_fee_paid_total+$trans_total_paid_class_fee;
                    $student_transport_fee_discount_total=$student_transport_fee_discount_total+$trans_total_discount_class_fee;
                    
                    $overall_total_class_fee=$total_class_fee+$student_transport_fee+$total_previous_dues_class_fee;
                    $overall_total_paid_class_fee=$total_paid_class_fee+$student_transport_fee_paid_total+$total_previous_dues_paid_class_fee+$other_fee_amount+$penalty_amount;
                    $overall_total_left_class_fee=$total_left_class_fee+$student_transport_fee_balance+$total_previous_dues_left_class_fee;
                    $overall_total_discount_class_fee=$total_discount_class_fee+$student_transport_fee_discount_total+$total_previous_dues_discount_class_fee;
                    
                    }
					?>
					<tr>
					    <td>
					        Total Class Fee
					    </td>
					    <td>
					        <?php echo $total_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_paid_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_left_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_discount_class_fee; ?>
					    </td>
					</tr>
					<tr>
					    <td>
					        Total Previous Dues Fee
					    </td>
					    <td>
					        <?php echo $total_previous_dues_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_previous_dues_paid_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_previous_dues_left_class_fee; ?>
					    </td>
					    <td>
					        <?php echo $total_previous_dues_discount_class_fee; ?>
					    </td>
					</tr>
					<tr>
					    <td>
					        Total Transport Fee
					    </td>
					    <td>
					        <?php echo $student_transport_fee; ?>
					    </td>
					    <td>
					        <?php echo $student_transport_fee_paid_total; ?>
					    </td>
					    <td>
					        <?php echo $student_transport_fee_balance; ?>
					    </td>
					    <td>
					        <?php echo $student_transport_fee_discount_total; ?>
					    </td>
					</tr>
					<tr>
					    <td>
					        Total Hostel Fee
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        0
					    </td>
					</tr>
					<tr>
					    <td>
					        Total Other Fee
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        <?php echo $other_fee_amount; ?>
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        0
					    </td>
					</tr>
					<tr>
					    <td>
					        Total Fine ( Penalty )
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        <?php echo $penalty_amount; ?>
					    </td>
					    <td>
					        0
					    </td>
					    <td>
					        0
					    </td>
					</tr>
					</tbody>
					<tfoot>
					<tr>
					    <td>
					        <b>Overall Detail</b>
					    </td>
					    <td>
					        <b><?php echo $overall_total_class_fee; ?></b>
					    </td>
					    <td>
					        <b><?php echo $overall_total_paid_class_fee; ?></b>
					    </td>
					    <td>
					        <b><?php echo $overall_total_left_class_fee; ?></b>
					    </td>
					    <td>
					        <b><?php echo $overall_total_discount_class_fee; ?></b>
					    </td>
					</tr>
					</tfoot>
				  </table>
		
		</td>
		</tr>
		<tr>
		<td style="height:100px;"><span style="float:right;">Signature........................................</span></td>
		</tr>
		</table>
		<?php } ?>
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Overall Report Classwise')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>