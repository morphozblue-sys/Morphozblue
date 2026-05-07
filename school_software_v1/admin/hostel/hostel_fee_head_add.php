<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<html>
<head>

  <?php include("../attachment/link_css.php"); ?>
   <?php include("../attachment/link_js.php"); ?>

</head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
	
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	 <script type="text/javascript">

      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['hi'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        // Create an instance on TransliterationControl with the required
        // options. 
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = ["fee_type_hindi" ];
        transliterationControl.makeTransliteratable(ids);
		}
		      google.setOnLoadCallback(onLoad);

function add_edit(value,name){
var fee_name=name.split('|?|');
$('#fee_type1').val(fee_name[0]);
$('#fee_type_hindi').val(fee_name[1]);
$('#fee_head_type').val(fee_name[2]);
$('#fee_code_hidden').val(value);

}
</script>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        School Information Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-graduation-cap"></i> Hostel</a></li>
	  <li class="active">Add Fees Type</li>
      </ol>
    </section>
	
	
	<!---************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Fee Type Add</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form"  method="post" enctype="multipart/form-data">
				<div class="col-md-12 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>S No.</th>
                  <th>Fee Type</th>
                  <th>Fee Type Hindi</th>
                  <th>Add/Edit</th>			  
                </tr>
                </thead>
<tbody>
		<?php
include("../../con73/con37.php");

$que="select * from school_info_hostel_head";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$fee_head_name = $row['fee_head_name'];
	$fee_head_name_hindi = $row['fee_head_name_hindi'];
	$fee_head_type = $row['fee_head_type'];
	$fee_head_code = $row['fee_head_code'];
	
	$serial_no++;
if($fee_head_name!='' || $fee_head_name_hindi!='' ){
?>				
				
				
				<tr  align='center' >

	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $fee_head_name; ?></th>
	<th  ><?php echo $fee_head_name_hindi; ?></th>
	<th  ><button type="button" id="<?php echo $fee_head_code; ?>" name="<?php echo $fee_head_name.'|?|'.$fee_head_name_hindi.'|?|'.$fee_head_type; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add/Edit</th>
	
	
	
	
	          
	            </tr>
				<?php } else{  ?>
		<tr  align='center' >
	<th colspan="4" ><button type="button" id="<?php echo $fee_head_code; ?>" name="<?php echo $fee_head_name.'|?|'.$fee_head_name_hindi.'|?|'.$fee_head_type; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add More</th>
				<?php 
				break;
				} } ?>
				</tbody>
                </table>
                </div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">
         <div class="form-group">
		<label>Fee Head Add/Edit</label>
		<input type="text" name="fee_type1" id="fee_type1" class="form-control">
		<input type="hidden" name="fee_code_hidden" id="fee_code_hidden" class="form-control">
	  </div>
	         <div class="form-group">
		<label>Fee Head Hindi Add/Edit</label>
		<input type="text" name="fee_type_hindi" id="fee_type_hindi" class="form-control">
		
	  </div>
	  <div class="form-group">
		<label>Fee Head Type</label>
		<select name="fee_head_type" id="fee_head_type" class="form-control">
		<option value="Expense">Expense</option>
		<option value="Regular">Regular</option>
		</select>
	  </div>
        </div>
        <div class="modal-footer">
		<input type="submit" name="finish" value="ADD" class="btn btn-success" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  		
		 
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>

</body>
</html>

<?php
if(isset($_POST['finish'])){
include("../../con73/con37.php");

$fee_type=$_POST['fee_type1'];
$fee_code=$_POST['fee_code_hidden'];
$fee_type_hindi=$_POST['fee_type_hindi'];
$fee_head_type=$_POST['fee_head_type'];

  $quer12="update school_info_hostel_head set fee_head_name='$fee_type',fee_head_name_hindi='$fee_type_hindi' ,fee_head_type='$fee_head_type',$update_by_update_sql  where fee_head_code='$fee_code'";
   mysqli_query($conn73,$quer12);
 
echo "<script>window.open('hostel_fee_head_add.php','_self');</script>";

}
?>

