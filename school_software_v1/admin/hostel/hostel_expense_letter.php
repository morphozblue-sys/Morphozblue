<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
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

function for_student(){
var student_class=document.getElementById('student_class').value;
var student_category=document.getElementById('student_category').value;

$.ajax({
type: "POST",
url: "ajax_hostel_student_companywise_list.php?student_class="+student_class+"&student_category="+student_category+"",
cache: false,
success: function(detail){
$('#student_roll_no').html(detail);
  }
});

}

function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}

</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Expense Letter
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Expense Letter</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form method="post" action="hostel_expense_letter_preview.php" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-10">
            <h3>Expense Letter Panel</h3>
        </div>
		<div class="col-md-12">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-2">
		<label>Class</label>
		<select name="student_class" id="student_class" class="form-control" onchange="for_student();">
		<option value="All">All Class</option>
		<?php
		$que15="select * from school_info_class_info where class_name!=''";
		$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
		while($row15=mysqli_fetch_assoc($run15)){
		$class_name=$row15['class_name'];
		$class_code=$row15['class_code'];
		?>
		<option value="<?php echo $class_code.'|?|'.$class_name; ?>"><?php echo $class_name; ?></option>
		<?php
		}
		?>
		</select>
		</div>
		
		<div class="col-md-2">
		<label>Category</label>
		<select name="student_category" id="student_category" class="form-control" onchange="for_student();">
		<option value="All">All Category</option>
		<option value="category3|?|New Hostlers">New Hostlers</option>
		<option value="category4|?|Old Hostlers">Old Hostlers</option>
		</select>
		</div>
		
		<div class="col-md-2">
		<label>Installment</label>
		<select name="installment_no" id="installment_no" class="form-control">
		<option value="All">All Installment</option>
		<option value="installment1">installment1</option>
		<option value="installment2">installment2</option>
		<option value="installment3">installment3</option>
		<option value="installment4">installment4</option>
		</select>
		</div>
		<div class="col-md-2">
		<label>Select Due Date</label>
		<input type="date" name="due_date" id="due_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
		</div>
		<div class="col-md-2">&nbsp;</div>
		</div>
		<div class="col-md-12">&nbsp;</div>
		<div class="col-md-12">
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
		<select name="student_roll_no" id="student_roll_no" class="form-control select2">
		<option value="All">All Student</option>
		<?php
		$query1="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'";
		$res1=mysqli_query($conn73,$query1);
		while($row1=mysqli_fetch_assoc($res1)){
		$student_name=$row1['student_name'];
		$student_roll_no=$row1['student_roll_no'];
		$student_class11=$row1['student_class'];
		$student_class_section11=$row1['student_class_section'];
		$student_admission_number11=$row1['student_admission_number'];
		?>
		<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name.'['.$student_class11.' '.$student_class_section11.']['.$student_admission_number11.']'; ?></option>
		<?php } ?>
		</select>
		</div>
		<div class="col-md-4">&nbsp;</div>
        </div>
		<div class="col-md-12">&nbsp;</div>
		<div class="col-md-12">
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
		<center><input type="submit" name="submit" value="Preview" class="btn btn-success" /></center>
		</div>
		<div class="col-md-4">&nbsp;</div>
        </div>
        </div>
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
				
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  </form>
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