<?php include("../attachment/session.php")?>
<script>
    $("#my_form").submit(function(e){
    var formdata = new FormData(this);
        $.ajax({
            url: access_link+"exam_paper_setter/instructions_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				//alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','red');
				   get_content('exam_paper_setter/instructions_edit');
            }
			}
         });


      });
</script>
    <section class="content-header">
      <h1>
        Paper Setter
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-scribd" aria-hidden="true"></i>Exam Paper Setter</a></li>
       <li><a href="javascript:get_content('exam_paper_setter/set_paper')"><i class="fa fa-scribd" aria-hidden="true"></i>Set Paper</a></li>
        <li class="active">Edit Instruction</li>
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
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body">
	<form method="post" enctype="multipart/form-data" id="my_form">
			 
		<div class="box-body ">
		
		<div class="col-md-10 col-md-offset-1 ">
		<div class="col-md-6">
		
			<?php
			$que="select * from question_paper_instructions";
			$run=mysqli_query($conn73,$que);
			if(mysqli_num_rows($run)<1){
		$my_quer= "INSERT INTO `question_paper_instructions` (`english_instructions`, `english_status`, `hindi_instructions`, `hindi_status`) VALUES
('', 'Deactive', '', 'Deactive'),
('', 'Deactive', '', 'Deactive'),
('', 'Deactive', '', 'Deactive'),
('', 'Deactive', '', 'Deactive'),
('', 'Deactive', '', 'Deactive'),
( '', 'Deactive', '', 'Deactive'),
( '', 'Deactive', '', 'Deactive'),
( '', 'Deactive', '', 'Deactive'),
( '', 'Deactive', '', 'Deactive');";
mysqli_query($conn73,$my_quer) or die(mysqli_error($conn73));
			}
			$serial_no=0;
			while($row=mysqli_fetch_assoc($run)){
				
				$s_no = $row['s_no'];
				$english_instructions = $row['english_instructions'];
				$english_status = $row['english_status'];
				$serial_no++;
			?>
		
		
			<div class="col-md-8 ">
				<div class="form-group">
                    <label>Instruction : <?php echo $serial_no; ?></label>
					<input type="hidden" name="id[]" value="<?php echo $s_no; ?>">
                    <input type="text" name="english_instruction[]" placeholder="Instruction : <?php echo $serial_no; ?>"  value="<?php echo $english_instructions; ?>" class="form-control">
                </div>
					
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
                  <label>Status : </label>
                   <select name="english_status[]" class="form-control">
			          <option <?php if($english_status=='Active'){ echo "selected"; } ?> value="Active">Active</option>  
			          <option <?php if($english_status=='Deactive'){ echo "selected"; } ?> value="Deactive">De-Active</option>
			        </select>
				</div>
			</div>
			
			<?php
			}
			?>
		</div>
		<div class="col-md-6">
		
			<?php
			$que="select * from question_paper_instructions";
			$run=mysqli_query($conn73,$que);
			$serial_no=0;
			while($row=mysqli_fetch_assoc($run)){
				
				$s_no = $row['s_no'];
				$hindi_instructions = $row['hindi_instructions'];
				$hindi_status = $row['hindi_status'];
				$serial_no++;
			?>
		
			<div class="col-md-8 ">
				<div class="form-group">
                    <label>निर्देश : <?php echo $serial_no; ?></label>
                    <input type="text" name="hindi_instruction[]" placeholder="निर्देश : <?php echo $serial_no; ?>"  value="<?php echo $hindi_instructions; ?>" class="form-control">
                </div>
					
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
                  <label>Status : </label>
                   <select name="hindi_status[]" class="form-control">
			          <option <?php if($hindi_status=='Active'){ echo "selected"; } ?> value="Active">Active</option>  
			          <option <?php if($hindi_status=='Deactive'){ echo "selected"; } ?> value="Deactive">De-Active</option>
			        </select>
				</div>
			</div>
			<?php
			}
			?>
		</div>
		
		</div>
		</div>	
	
	
		<div class="col-md-12">
		        <center><input type="submit" name="finish" value="Edit" class="btn btn-success" /></center>
		</div>
	  </form>	
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
<?php 
if(isset($_POST['finish'])){

echo "<script>document.getElementById('finish').disabled = true</script>";
 
	$id = $_POST['id'];
	$english_instructions = $_POST['english_instruction'];
	$english_status = $_POST['english_status'];
	$hindi_instructions = $_POST['hindi_instruction'];
	$hindi_status = $_POST['hindi_status'];
	$count=count($id);
	$update=0;
  for($i=0; $i<$count; $i++){
  echo $quer="update question_paper_instructions set english_instructions='$english_instructions[$i]',english_status='$english_status[$i]',hindi_instructions='$hindi_instructions[$i]',hindi_status='$hindi_status[$i]',$update_by_update_sql where s_no='$id[$i]'";
  if(mysqli_query($conn73,$quer)){
  $update=$update+1;
  }
  }

if($update>0){
		
		echo "<script>alert_new('Successfully Complete','red');</script>";
		echo "<script>window.open('go_to_paper_setter.php','_self')</script>";
	}
	

}
?>


</div>

