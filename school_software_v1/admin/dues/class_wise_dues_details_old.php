<?php include("../attachment/session.php"); ?>
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
	  <?php echo $language['Fees Dues Management']; ?>
	  <small><?php echo $language['Control Panel']; ?></small>
      </h1>
	    <?php
		$qry22="select * from school_info_general";
		$rest22=mysqli_query($conn73,$qry22);
		while($row22=mysqli_fetch_assoc($rest22)){
		$fees_type=$row22['fees_type'];
		}
		if($fees_type=='installmentwise' || $fees_type=='monthly' || $fees_type=='yearly'){
			$addon_var='common_';
			$detail_page='fees_'.$fees_type;
		}else{
			$addon_var='';
			$detail_page='fees';
		}
		
        $stream_name_condition='';
        if(isset($_GET['stream_name'])){
        $stream_name=$_GET['stream_name'];
        $stream_name_condition=" and student_class_stream='$stream_name'";
        }
        $class=$_GET['class_name'];
        
        $bus_and_rte_condition="";
        if($_SESSION['software_link']=='scholarsarmy'){
        $bus_and_rte_condition=" and (student_admission_scheme='NON-RTE' or (student_admission_scheme='RTE' and student_bus='Yes'))";
        }
        
		$que="select * from ".$addon_var."fees_student_fee where fee_status='Active' and session_value='$session1' and student_class='$class'";
		$run=mysqli_query($conn73,$que);
		$all_grand_total=0;
		$all_paid_total=0;
		$all_balance_total=0;
		$total_discount=0;
		while($row=mysqli_fetch_assoc($run)){
		$student_roll_no1 = $row['student_roll_no'];
		$que2="select * from student_admission_info where student_status='Active' and student_roll_no='$student_roll_no1' and session_value='$session1'$stream_name_condition$bus_and_rte_condition$filter37";
        $run2=mysqli_query($conn73,$que2);
        $que121="select blank_field_2 from common_fees_student_fee_add where fee_status='Active' and student_roll_no='$student_roll_no1' and session_value='$session1'  ";
        $run121=mysqli_query($conn73,$que121);
        $discount121=0;
        while($row121=mysqli_fetch_assoc($run121))
        {
         $discount121+=$row121['blank_field_2']; //if($update_change=='rahul@simption.com'){echo '<pre>';print_r($row121);}  
        }
        while($row2=mysqli_fetch_assoc($run2)){ 
		$grand_total=$row['grand_total'];
		$balance_total=$row['balance_total'];
		$paid_total=$row['paid_total'];
		$total_discount+=$discount121;
		$all_balance_total=$all_balance_total+$balance_total;
		$all_paid_total=$all_paid_total+$paid_total;
		$all_grand_total=$all_grand_total+$grand_total;
        }
		}
		
        ?>
        <ol class="breadcrumb">
		<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('dues/dues')"><i class="fa fa-info-circle"></i><?php echo $language['Dues Details']; ?></a></li>
        <li class="active"><?php echo ucfirst($class);?><?php echo $language['Class Details']; ?></li>
        </ol>
    </section>
    
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->
          <div class="box" id="printTable">
            <div class="box-header with-border">
			<div class="col-sm-12">
			<div class="col-sm-4">
			<h5 class="my_background_color" style="padding:10px 10px 10px 10px;"><center><?php echo $class;?><?php echo " / ".$stream_name;?> <?php echo $language['Class Fee Total Amount']; ?> :-  <?php echo $all_grand_total.'.00';?></center></h5>
			</div>
			<div class="col-sm-4">
			<h5 class="my_background_color" style="padding:10px 10px 10px 10px;"><center><?php echo $class;?><?php echo " / ".$stream_name;?> <?php echo $language['Class Paid Total Amount']; ?> :-  <?php echo $all_paid_total.'.00';?></center></h5>
			</div>
			<div class="col-sm-4">
			<h5 class="my_background_color" style="padding:10px 10px 10px 10px;"><center><?php echo $class;?><?php echo " / ".$stream_name;?> <?php echo $language['Class Dues Total Amount']; ?> :-  <?php echo $all_balance_total-$total_discount.'.00';?></center></h5>
			</div>
			</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="printTable" border="1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>S.no</th>
				  <th><?php echo $language['Student Name']; ?> </th>
				  <th><?php echo $language['Father Name']; ?> </th>
				  <th><?php echo "Conatact Details"; ?> </th>
				  <th><?php echo $language['Student Section']; ?> </th>
				  <th><?php echo $language['Total Fee']; ?> </th>
				  
				  <th><?php echo $language['Total Paid']; ?> </th>
				  <th>Total Discount</th>
				  <th><?php echo $language['Total Balance']; ?> </th>
				  <th><?php echo $language['Details']; ?> </th>
                </tr>
                </thead>
                <tbody>
                
				<?php				
                
                $serial_no=0;
                $all_grand_total=0;
                $all_paid_total=0;
                $all_balance_total=0;
                
				
				
			 	$que1="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_class='$class'$stream_name_condition$bus_and_rte_condition$filter37";
                $run1=mysqli_query($conn73,$que1);
                while($row1=mysqli_fetch_assoc($run1)){
                $student_name=$row1['student_name'];
				$student_father_name=$row1['student_father_name'];
				$student_class_section=$row1['student_class_section'];
				$school_roll_no=$row1['school_roll_no'];
				$student_roll_no=$row1['student_roll_no'];
				$student_father_contact_number=$row1['student_father_contact_number'];
				$student_father_contact_number2=$row1['student_father_contact_number2'];    
            //    $que="select * from ".$addon_var."fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1' and student_class='$class' ORDER BY student_name";
                $que="select * from ".$addon_var."fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1' and student_class='$class'  ORDER BY student_name";
                $run=mysqli_query($conn73,$que);    
                while($row=mysqli_fetch_assoc($run)){
				$fee_s_no=$row['s_no'];
				$grand_total=$row['grand_total'];
				$balance_total=$row['balance_total'];
				$paid_total=$row['paid_total'];
				$student_roll_no=$row['student_roll_no'];
				$all_grand_total=$all_grand_total+$grand_total;
                $discount_total=0;
                $paid_total=0;
                $balance_total=0;
                       $que="select blank_field_2,paid_total from common_fees_student_fee_add where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'  ORDER BY student_name";
                $run=mysqli_query($conn73,$que);    
                while($row=mysqli_fetch_assoc($run)){
				$discount_total=$discount_total+$row['blank_field_2'];
				$paid_total=$paid_total+$row['paid_total'];
                }
                $balance_total=$grand_total-$discount_total-$paid_total;
				$all_paid_total=$all_paid_total+$paid_total;
				
				$all_balance_total=$all_balance_total+$balance_total;
                $serial_no++;
                ?>

                <tr>
                  <td style="text-align:center;"><?php echo $serial_no; ?></td>
                  <td style="text-align:center;"><?php echo $student_name; ?></td>
				  <td style="text-align:center;"><?php echo $student_father_name; ?></td>
				  <td style="text-align:center;"><?php echo $student_father_contact_number.', '.$student_father_contact_number2; ?></td>
                  <td style="text-align:center;"><?php echo $class.'('.$student_class_section.')'; ?></td>
                  <td style="text-align:center;"><?php echo $grand_total; ?></td>
                  
                  <td style="text-align:center;"><?php echo $paid_total; ?></td>  
                  
                  <td style="text-align:center;"><?php echo $discount_total; ?></td>
                  <td style="text-align:center;"><?php echo $balance_total; ?></td>            
                  <td><button type="button" onclick="post_content('<?php echo $detail_page.'/student_fee_list_particular'; ?>','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-primary">Details</button></td>
                </tr>
                <?php } } ?>
                </tbody>
             </table>
             
            </div>
            <!-- /.box-body -->
          </div>
          <div class="col-sm-12">
			  <div class="col-sm-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Dues Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-sm-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
     
     <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>
