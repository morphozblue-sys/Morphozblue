<?php $room_number=$_GET['id'];
 $hostel_name=$_GET['sno'];?>
<!DOCTYPE html><html><head> 
<?php include("../attachment/link_css.php")?>
</head>  
<?php include("../attachment/header.php")?>
  <?php include("../attachment/sidebar.php")?>
  <body class="hold-transition skin-green fixed sidebar-mini">
  <div class="wrapper"> 
  <script>
  function myFunction() { 
  var txt=confirm("Are You Sure Want to Delete!"); 
  if (txt==true) {	return true;    }
  else {        return false;    }   
  }</script>  
  <div class="content-wrapper">  
  <!-- Content Header (Page header) -->   
  <section class="content-header">     
  <h1>        Student Hostel List        <small>Control Panel</small>      </h1>   
  <ol class="breadcrumb">      
  <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a>
  </li>	  <li><a href="hostel.php"><i class="fa fa-bed">
  </i> Hostel</a></li>	  <li><a href="hostel_student_list.php">
  <i class="fa fa-bed"></i>Hostel Student List</a></li>  
  </ol>   
  </section>
  <!---******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->    <!-- Main content -->    
  <section class="content">     
  <div class="row">     
  <div class="col-xs-12">  
  <!-- /.box -->          
  <div class="box <?php echo $box_head_color; ?>" > 
  <div class="box-header with-border">          
  <h3 class="box-title">Student Hostel List</h3> 
  </div>            <!-- /.box-header -->      
  <div class="box-body table-responsive">      
  <table id="example1" class="table table-bordered table-striped"> 
  <thead >           
  <tr>                 
  <th>S_no</th>        
  <th>Name</th>        
  <th>Father Name</th>  
  <th>Class</th>        
  <th>Hostel Name</th>
  <th>Room Number</th>     
  <th>Roll No.</th>      
  <th>Total Fees</th>    
  <th>Action</th>         
  </tr>        
  </thead>     
  <tbody>
  <?php    
  include("../../con73/con37.php");
  $que="select * from hostel_student_info where hostel_room='$room_number' and hostel_hostel_name='$hostel_name'";
  $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));$serial_no=0;$hostel_charges=0;
  while($row=mysqli_fetch_assoc($run))
  {		
   $s_no=$row['s_no'];		
   $roll_number=$row['roll_number'];
   $hostel_student_name=$row['hostel_student_name'];
   $hotel_father_name=$row['hotel_father_name'];	
   $hostel_student_class=$row['hostel_student_class'];	
   $hostel_hostel_name=$row['hostel_hostel_name'];		
   $hostel_room=$row['hostel_room'];		
   $hostel_student_id=$row['hostel_student_id'];
   $hostel_caution_money=$row['hostel_caution_money'];	
   $hostel_laundry_charge=$row['hostel_laundry_charge'];	
   $hostel_room_charge_per_bed=$row['hostel_room_charge_per_bed'];	
   $hostel_mess_charge=$row['hostel_mess_charge'];		
   $hostel_charges=$hostel_room_charge_per_bed+$hostel_mess_charge+$hostel_laundry_charge+$hostel_caution_money;	
   $serial_no++;	?>          
   <tr>           
   <td ><?php echo $serial_no; ?></td>  
   <td ><?php echo $hostel_student_name; ?></td>  
   <td ><?php echo $hotel_father_name; ?></td>    
   <td ><?php echo $hostel_student_class; ?></td> 
   <td ><?php echo $hostel_hostel_name; ?></td>   
   <td ><?php echo $hostel_room; ?></td>          
   <td ><?php echo $roll_number; ?></td>      
   <td ><?php echo $hostel_charges; ?></td>   
   <td>				
   <a href='hostel_student_details.php?id=<?php echo $s_no; ?>'>
   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">View</button>
   </a>				            
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
   <!-- /.content --> 
   </div>  
   </div> 
   <!---*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************--> 
   <?php include("../attachment/footer.php")?>
   <?php include("../attachment/sidebar_2.php")?>
   </div> 
   <?php include("../attachment/link_js.php")?>
   <script>  
   $(function () { 
   $('#example1').DataTable() 
   $('#example2').DataTable({    
   'paging'      : true,     
   'lengthChange': false,  
   'searching'   : false,  
   'ordering'    : true,  
   'info'        : true,  
   'autoWidth'   : false  
   })
   })</script>
   </body>
   </html>
  
  