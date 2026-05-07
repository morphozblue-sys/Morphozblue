<?php include("../attachment/session.php")?>
<?php
$s_no1=$_GET['id'];
$select="select * from classwork_student where s_no='$s_no1'";
$run=mysqli_query($conn73,$select);
while($row=mysqli_fetch_assoc($run))
 {
    $s_no=$row['s_no'];
	$classwork_class = $row['classwork_class'];
	$classwork_section = $row['classwork_section'];
	$classwork = $row['classwork'];
	$classwork_date = $row['classwork_date'];
	$classwork_remark = $row['classwork_remark'];
 }
	
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Homework Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:get_content('homework/homework')"><i class="fa fa-book"></i> Homework</a></li>
        <li><a href="javascript:get_content('homework/homework_list')"><i class="fa fa-list"></i>  Homework List</a></li>
		<li class="active"><i class="fa fa-edit"></i>  Homework Detail</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Homework Detail</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			      
				  <div class="col-md-12">
              <div class="box box-info">
              <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              
                    <textarea id="editor1" name="classwork" class="form-control bordder-color" placeholder="write homework" rows="10" cols="80" Readonly><?php echo $classwork; ?></textarea>
               
               </div>
               </div>
               <!-- /.box -->
               </div>

	         </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>