<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
         <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_account')"><i class="fa fa-bed"></i> <?php echo $language['Hostel List']; ?></a></li>
      </ol>
    </section>
<script>
function valid(s_no){
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_record(s_no);
}
else  {
return false;
}
}

function delete_record(s_no){
$.ajax({
type: "POST",
url: access_link+"hostel/account_collection_delete.php?s_no="+s_no+"",
cache: false,
success: function(detail){
var res=detail.split("|?|");
if(res[1]=='success'){
alert_new('Successfully Deleted','green');
get_content('hostel/account_collection');
}else{
//alert_new(detail); 
}
}
});
}
</script>
<script type="text/javascript">
   function search_by_date(){
      //alert_new(value);
       var from=document.getElementById("date_from").value;
	   var to=document.getElementById("date_to").value;
	   if(from!='' && to!=''){
	   $('#search_detail').html(loader_div);
       $.ajax({
			  type: "POST",
              url: access_link+"hostel/account_collection_search_by_date.php?from="+from+"&to="+to+"",
              cache: false,
              success: function(detail){
			      ////alert_new(detail);  
            $('#search_detail').html(detail);
			
              }
           });
    }
	}
</script>

	<!---******************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
         <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"> <?php echo $language['Fees Details']; ?></h3>
			  <div class="box-title" style="margin-left:20px;">
               <h4> <?php echo $language['From Date']; ?></h4>
		        <input type="date" class="form-control" name="date_from" id="date_from" oninput="search_by_date();">
               </div>
		       <div class="box-title" style="margin-left:20px;">
              <h4> <?php echo $language['To Date']; ?></h4>
		       <input type="date" class="form-control" name="date_to" id="date_to"  oninput="search_by_date();">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" id="search_detail">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>

<?php
$que12="select * from school_info_pdf_info";
$run12=mysqli_query($conn73,$que12) or die(mysqli_error($conn73));
while($row12=mysqli_fetch_assoc($run12)){
$hostal_feereciept=$row12['hostal_feereciept'];
}
$que="select * from hostel_fee_details where fee_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$pay_hostel_charge=0;
while($row=mysqli_fetch_assoc($run)){

	 $pay_hostel_charge+=$row['pay_hostel_charge'];
	
		}
?>

   <tr>
	<th colspan='7' align='center' ><font color="#f1f1f1"><?php echo $language['Hostel student fee details']; ?></th>
	<th colspan='3' align='center' ><font color="black"><?php echo $language['Total Amount Of Hosteler']; ?></th>
	<th colspan='2' align='center' ><font color="black"><?php echo $pay_hostel_charge; ?>/-</th>
   </tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Room Charge Per Bed']; ?></th>
                  <th><?php echo $language['Mess Fee']; ?></th>
                  <th><?php echo $language['Laundry Charge']; ?></th>
                  <th><?php echo $language['Caution Money']; ?></th>
                  <th><?php echo $language['Total Charge']; ?></th>
                  <th><?php echo $language['Date']; ?></th>
                  <th><?php echo $language['Month']; ?></th>
                  <th><?php echo $language['Print']; ?></th>
                  <th>Delete</th>
                 
                </tr>
                </thead>
                <tbody>
<?php
$que="select * from hostel_fee_details where fee_status='Active'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$s_no=$row['s_no'];
	$hostel_student_name = $row['hostel_student_name'];
	$hostel_student_id = $row['hostel_student_id'];
	$roll_number = $row['roll_number'];
	$pay_hostel_room_charge = $row['pay_hostel_room_charge'];
	$pay_mess_fee = $row['pay_mess_fee'];
	$pay_laundry_charge = $row['pay_laundry_charge'];
	$pay_caution_money = $row['pay_caution_money'];
	$pay_hostel_charge = $row['pay_hostel_charge'];
	
	$pay_date = $row['pay_date'];
	
	
	$month_pay = $row['month_pay'];
	
	
	$serial_no++;
?>

    <tr>
	    <td><?php echo $serial_no; ?></td>
        <td><?php echo $hostel_student_name; ?></td>
        <td><?php echo $roll_number; ?></td>
        <td><?php echo $pay_hostel_room_charge; ?></td>
        <td><?php echo $pay_mess_fee; ?></td>
        <td><?php echo $pay_laundry_charge; ?></td>
        <td><?php echo $pay_caution_money; ?></td>
        <td><?php echo $pay_hostel_charge; ?></td>
        <td><?php echo $pay_date; ?></td>
        <td><?php echo $month_pay; ?></td>
       
       <td><a target="_blank" href='<?php echo $pdf_path; ?>Hostal_feereciept/<?php echo $hostal_feereciept; ?>?s_no1=<?php echo $s_no; ?>&roll_no=<?php echo $roll_number; ?>'><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
       <td style="<?php if($_SESSION['hostal_panel_edit_delete_button']!='yes' && $_SESSION['hostal_panel_edit_delete_button']!=''){echo 'display:none';} ?>"><button type="button" onclick="return valid('<?php echo $s_no; ?>');" class="btn btn-success">Delete</button></td>
               
        
    </tr>
        <?php } ?>
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
$(function(){
$('#example1').DataTable()
})
</script>