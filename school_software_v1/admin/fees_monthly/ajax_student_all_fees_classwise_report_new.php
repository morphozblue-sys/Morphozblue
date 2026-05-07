<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>
        <?php 
        
            $schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			} 
         
            $que_fee_type="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
            $run=mysqli_query($conn73,$que_fee_type);
            $serial_no_fee_type=0;
            while($row=mysqli_fetch_assoc($run)){
            $s_no_fee_type=$row['s_no'];
            $fee_type5_fee_type = $row['fee_type'];
            $fee_code_fee_type = $row['fee_code'];
            if($fee_type5_fee_type!=''){
            $fee_type_fee_type = preg_replace('/\s+/', '_', $fee_type5_fee_type);
            $fee_type1_fee_type[$serial_no_fee_type] = $row['fee_type'];
            $fee_type_code[$serial_no_fee_type] = $fee_code_fee_type;
            $fee_type_fee_type=strtolower($fee_type);
            $student_fee_after_discount[$serial_no_fee_type]="student_".$fee_code_fee_type."_total_amount_after_discount_month";
            $student_fee_balance[$serial_no_fee_type]="student_".$fee_code_fee_type."_balance_month";
            $student_fee_paid[$serial_no_fee_type]="student_".$fee_code_fee_type."_paid_total_month";
            $serial_no_fee_type++;
            }
            }
            //student_fee1_total_amount_after_discount_month
            
             $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			 $run01=mysqli_query($conn73,$que01);
			 $serial_no=0;
			 while($row01=mysqli_fetch_assoc($run01)){
			 $fees_type_name[$serial_no] = $row01['fees_type_name'];
			 $fees_type = $row01['fees_type'];
			 $fees_code[$serial_no] = $row01['fees_code'];
			 $fees_count = $row01['fees_count'];
			 $serial_no++;
			 }
           
            $class_name=$_GET['class_name'];
			if($class_name!='All'){
				$condition1=" and student_class='$class_name'";
			}else{
				$condition1="";
			}
			$section_name=$_GET['section_name'];
			if($section_name!='All'){
				$condition2=" and student_class_section='$section_name'";
			}else{
				$condition2="";
			}
			$student_roll_no_get=$_GET['select_student'];
			if($student_roll_no_get!='')
			{
			$student_condtion=" and student_roll_no='$student_roll_no_get' ";    
			}
			else{
			  $student_condtion='';  
			}
			
			$payment_mode=$_GET['payment_mode'];
			if($payment_mode!='All'){
				$condition3=" and student_payment_mode='$payment_mode'";
			}else{
				$condition3="";
			}
			
			
			
			$order_by=$_GET['order_by'];
			if($order_by==" ORDER BY student_name ASC"){
			    $order_by1=$order_by;
			}else{
			    $order_by1='';
			}
            
            $from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=explode('-',$from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$condition3=" and fee_submission_date>='$from_date'";
			}else{
				$from_date2='';
				$condition3="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=explode('-',$to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$condition4=" and fee_submission_date<='$to_date'";
			}else{
				$to_date2='';
				$condition4="";
			}
			
        ?>
        
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
                <table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
    			<tr>
    			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
    			</tr>
    			<tr>
    			<td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
    			<td><center><b>STUDENT FEE REPORT</b></center></td>
    			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
    			</tr>
    			<tr>
    			<td colspan="3"><center><b>Classwise</b></center></td>
    			</tr>
    			</table>
    			<table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
    			    <thead class="my_background_color">
						<tr>
						  <th>S.No.</th>
						   <th>Id</th>
						  <th>Student Name</th>
						  <th>Class (Sec)</th>
						  <th>Total Fees</th>
						  <th>Total Fees Previous</th>
						  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="#b4c5cc" >Total <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Fees Current</th>
						  <th>Total Paid Fees</th>
						  <th>Total Paid Fees Previous</th>
						  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="green" >Total Paid <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Paid Fees Current</th>
						  <th>Total Paid Other Fees</th>
						  <th>Penalty</th>
						  <th>Total Discount</th>
						  <th>Total Receive</th>
						  <th>Total Balance Fees</th>
						  <th>Total Balance Fees Previous</th>
						   <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="#a8a19d" >Balance <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Balance Fees Current</th>
						  
						</tr>
					</thead>
					<tfoot class="my_background_color">
						<tr>
						  <th>S.No.</th>
						  <th>Id</th>
						  <th>Student Name</th>
						  <th>Class (Sec)</th>
						  <th>Total Fees</th>
						  <th>Total Fees Previous</th>
						  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="#b4c5cc" >Total <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Fees Current</th>
						  <th>Total Paid Fees</th>
						  <th>Total Paid Fees Previous</th>
						  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="green" >Total Paid <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Paid Fees Current</th>
						  <th>Total Paid Other Fees</th>
						  <th>Penalty</th>
						  <th>Total Discount</th>
						  <th>Total Receive</th>
						  <th>Total Balance Fees</th>
						  <th>Total Balance Fees Previous</th>
						  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
						  <th bgcolor="#a8a19d" >Balance <?=$fee_type1_fee_type[$i]?></th>
						  <?php } ?>
						  <th>Total Balance Fees Current</th>
						  
						</tr>
					</tfoot>
					<tbody>
					<?php 
	                $que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1 $condition2 $student_condtion $order_by1 ";
					$run=mysqli_query($conn73,$que);
					$s_no=1;
				    $grand_total_fees=0;
                    $grand_total_fees_current=0;
                    $grand_total_fees_previous=0;
                    $grand_total_paid_fees=0;
                    $grand_total_paid_fees_previous=0;
                    $grand_total_paid_fees_current=0;
                    $grand_total_balance_fees=0;
                    $grand_total_balance_fees_previous=0;
                    $grand_total_balance_fees_current=0;
                    $grand_total_discount=0;
                    $grand_total_actual_paid=0;
                    $grand_total_other_fee_amount=0;
                    $grand_total_penalty_amount=0;
                     for($i=0;$i<$serial_no_fee_type;$i++)
				 	 {
				 	  $grand_total_fees_headwise[$i]=0;    
				 	  $grand_total_fees_paid_headwise[$i]=0;    
				 	  $grand_total_fees_balance_headwise[$i]=0;    
				 	 }
					while($row=mysqli_fetch_assoc($run)){
					 $student_roll_no=$row['student_roll_no'];
					 $student_name=$row['student_name'];
					 $student_class=$row['student_class'];
					 $total_fees=0; 
					 $total_fees_current=0; 
				 	 $total_fees_previous=0;
				 	 $total_paid_fees=0;
                     $total_paid_fees_current=0;
                     $total_paid_fees_previous=0;
                     $total_balance_fees=0;
                     $total_balance_fees_previous=0;
                     $total_balance_fees_current=0;
				 	 $total_discount=0;
				 	 $total_actual_paid=0;
				 	 $total_other_fee_amount=0;
				 	 $total_penalty_amount=0;
				 	 
				 	 for($i=0;$i<$serial_no_fee_type;$i++)
				 	 {
				 	  $total_fees_headwise[$student_roll_no][$i]=0;    
				 	  $total_fees_paid_headwise[$student_roll_no][$i]=0;    
				 	  $total_fees_balance_headwise[$student_roll_no][$i]=0;    
				 	 }
				 	 
				 	 $que1="select * from common_fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no'  and session_value='$session1'";
					 $run1=mysqli_query($conn73,$que1);
					 while($row1=mysqli_fetch_assoc($run1)){ 
					     $total_fees_previous=$row1['student_previous_year_fee'];
					     $student_previous_year_fee_balance=$row1['student_previous_year_fee_balance'];
					     $balance_total=$row1['balance_total'];
					     for($i=0;$i<$serial_no_fee_type;$i++)
					     {
					       for($j=0;$j<$serial_no;$j++)
					       {
					        $student_fee_after_discount1=$student_fee_after_discount[$i].$fees_code[$j];    
					        $total_fees_current+=$row1[$student_fee_after_discount1];    
					        
					        $total_fees_headwise[$student_roll_no][$i]+=$row1[$student_fee_after_discount1];
                            
                            $student_fee_after_discount1=$student_fee_after_discount[$i].$fees_code[$j];
                            $student_fee_balance1=$student_fee_balance[$i].$fees_code[$j];
                            $total_fees_balance_headwise[$student_roll_no][$i]+=$row1[$student_fee_balance1];
					       }
					     }
					     
					     
					     $total_fees=$total_fees_current+$total_fees_previous;
					     
					 }  
					 $grand_total_fees+=$total_fees;
                     $grand_total_fees_previous+=$total_fees_previous;
                     $grand_total_fees_current+=$total_fees_current;
                     
                     
					 $que1_paid="select * from common_fees_student_fee_add where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1' $condition3 $condition4 order by s_no asc";
					 $run_paid=mysqli_query($conn73,$que1_paid);
					 while($row2=mysqli_fetch_assoc($run_paid))
					 {
					   $total_paid_fees_previous+=$row2['student_previous_year_fee_paid_total'];  
					   $total_discount+=$row2['blank_field_2'];
					   $total_other_fee_amount+=$row2['other_fee_amount'];
					   $total_penalty_amount+=$row2['penalty_amount'];
					   for($i=0;$i<$serial_no_fee_type;$i++)
					     {
					       for($j=0;$j<$serial_no;$j++)
					       {
					        $student_fee_paid1=$student_fee_paid[$i].$fees_code[$j];    
					        
					        $total_paid_fees_current+=$row2[$student_fee_paid1];   
					        
					        $total_fees_paid_headwise[$student_roll_no][$i]+=$row2[$student_fee_paid1];
					       }
					     }
					      
					 }
					$total_paid_fees=$total_paid_fees_previous+$total_paid_fees_current;
					$grand_total_discount+=$total_discount;
					$grand_total_paid_fees_previous+=$total_paid_fees_previous; 
					$grand_total_paid_fees_current+=$total_paid_fees_current; 
					$total_actual_paid=$total_paid_fees+$total_other_fee_amount-$total_discount;
					$grand_total_actual_paid+=$total_actual_paid;
					
					$total_balance_fees=$total_fees-$total_paid_fees;
					$total_balance_fees_previous=$total_fees_previous-$total_paid_fees_previous;
					$total_balance_fees_current=$total_fees_current-$total_paid_fees_current;
					
					$grand_total_balance_fees+=$total_balance_fees;
					$grand_total_balance_fees_previous+=$total_balance_fees_previous;
					$grand_total_balance_fees_current+=$total_balance_fees_current;
					$grand_total_other_fee_amount+=$total_other_fee_amount;
					
					
					$total_paid_fees=$total_paid_fees+$total_other_fee_amount;
					$grand_total_paid_fees+=$total_paid_fees; 
					
					for($i=0;$i<$serial_no_fee_type;$i++)
					{
					$grand_total_fees_headwise[$i]+=$total_fees_headwise[$student_roll_no][$i];
					$grand_total_fees_paid_headwise[$i]+=$total_fees_paid_headwise[$student_roll_no][$i];
					$grand_total_fees_balance_headwise[$i]+=$total_fees_balance_headwise[$student_roll_no][$i];
					}
					
					$color='';
					if($balance_total!=$total_balance_fees || $student_previous_year_fee_balance!=$total_balance_fees_previous)
					$color="style='color:red'";
					if($color!='' || true){
					?> 
					  <tr <?=$color?>  >
					  <td><?=$s_no?></td>
					  <td><?=$student_roll_no?></td>
					  <td><?=$student_name?></td>
					  <td><?=$student_class?></td>
					  <td><?=$total_fees?></td>
					  <td><?=$total_fees_previous?></td>
					  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
					  <td bgcolor="#b4c5cc" ><?=$total_fees_headwise[$student_roll_no][$i]?></td>
					  <?php } ?>
					  <td><?=$total_fees_current?></td>
					  <td><?=$total_paid_fees?></td>
					  <td><?=$total_paid_fees_previous?></td>
					  <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
					  <td bgcolor="green" ><?=$total_fees_paid_headwise[$student_roll_no][$i]?></td>
					  <?php } ?>
					  <td><?=$total_paid_fees_current?></td>
					  <td><?=$total_other_fee_amount?></td>
					  <td><?=$total_penalty_amount?></td>
					  <td><?=$total_discount?></td>
					  <td><?=$total_actual_paid?></td>
					  <td><?=$total_balance_fees?></td>
                      <td><?=$total_balance_fees_previous?></td>
                      <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
                      <td bgcolor="#a8a19d" ><?=$total_fees_balance_headwise[$student_roll_no][$i];?></td>
                      <?php } ?>
                      <td><?=$total_balance_fees_current?></td>
					  </tr>
					<?php 
					}
					$s_no++;
					}
					
					
					?>
					</tbody>
					<tfoo>
					    <th colspan="4"><center>Total</center></th>
					    <th><?=$grand_total_fees?></th>
					    <th><?=$grand_total_fees_previous?></th>
					    <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
					    <th bgcolor="#b4c5cc" ><?=$grand_total_fees_headwise[$i]?></th>
					    <?php } ?>
					    <th><?=$grand_total_fees_current?></th>
					    <th><?=$grand_total_paid_fees?></th>
					    <th><?=$grand_total_paid_fees_previous?></th>
					    <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
					    <th bgcolor="green" ><?=$grand_total_fees_paid_headwise[$i]?></th>
					    <?php } ?>
					    <th><?=$grand_total_paid_fees_current?></th>
					    <th><?=$grand_total_other_fee_amount?></th>
					    <th><?=$grand_total_penalty_amount?></th>
					    <th><?=$grand_total_discount?></th>
					    <th><?=$grand_total_actual_paid?></th>
					    <th><?=$grand_total_balance_fees?></th>
					    <th><?=$grand_total_balance_fees_previous?></th>
					    <?php for($i=0;$i<$serial_no_fee_type;$i++){ ?>
					    <th bgcolor="#a8a19d" ><?=$grand_total_fees_balance_headwise[$i]?></th>
                        <?php } ?>
					    <th><?=$grand_total_balance_fees_current?></th>
					    
					</tfoo>
    			</table>    
            </div>
            </div>
         </div>
        </div> 