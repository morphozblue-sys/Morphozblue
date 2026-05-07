<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function add_edit(value,name){
var fee_name=name.split('|?|');
$('#bus_fee_type1').val(fee_name[0]);
$('#bus_fee_type_hindi').val(fee_name[1]);
$('#bus_fee_code_hidden').val(value);
var class_codes=document.getElementById('all_class_codes').value;
var class_codes1=class_codes.split('|?|');
var class_codes2=class_codes1.length;
var class_codes3=Number(parseInt(class_codes2)-1);
for(var i=1;i<=class_codes3;i++){
var j=Number(parseInt(i)+1);
$('#'+class_codes1[i]+'_amount').val(fee_name[j]);
}
}
</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
				   $("#myModal_close").click();
        $.ajax({
            url: access_link+"school_info/add_bus_fee_category_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   $('#myModal').modal('hide');
				
				   get_content('school_info/add_bus_fee_category');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['School Information Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
	  <li class="active">Add Bus Fees Type</li>
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
              <h3 class="box-title">Bus Fee Type Add</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
		
				<div class="col-md-12 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S No.</th>
                  <th>Bus Fee Type</th>
                  <th>Bus Fee Type Hindi</th>
                  <?php
				  $que1="select * from school_info_class_info where class_name!=''";
				  $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
				  $class_sno=0;
				  $class_code='';
				  $class_code2='';
				  $class_name1='';
				  while($row1=mysqli_fetch_assoc($run1)){
				  $class_name=$row1['class_name'];
				  $class_name1[$class_sno]=$class_name;
				  $class_code[$class_sno]=$row1['class_code'];
				  $class_code2=$class_code2."|?|".$row1['class_code'];
				  $class_sno++;
				  ?>
                  <th><?php echo $class_name; ?></th>
                  <?php } ?>
                  <th><input type="hidden" id="all_class_codes" value="<?php echo $class_code2; ?>" />Add/Edit</th>		  
                </tr>
                </thead>
<tbody>
<?php
$que="select * from bus_fee_category";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$add_more_button=0;
while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_fee_category_name = $row['bus_fee_category_name'];
	$bus_fee_category_name_hindi = $row['bus_fee_category_name_hindi'];
	$bus_fee_category_code = $row['bus_fee_category_code'];
	$name_str=$bus_fee_category_name.'|?|'.$bus_fee_category_name_hindi;
	
	$class_amount='';
	for($i=0;$i<$class_sno;$i++){
	$class_amount[$i] = $row[$class_code[$i].'_amount'];
	$name_str=$name_str."|?|".$row[$class_code[$i].'_amount'];
	}
	
if($bus_fee_category_name!='' || $bus_fee_category_name_hindi!=''){
	$serial_no++;
?>				
    <tr  align='center' >
    <th><?php echo $serial_no; ?></th>
	<th><?php echo $bus_fee_category_name; ?></th>
	<th><?php echo $bus_fee_category_name_hindi; ?></th>
	<?php for($j=0;$j<$class_sno;$j++){ ?>
	<th><?php echo $class_amount[$j]; ?></th>
	<?php } ?>
	
	<th><button type="button" id="<?php echo $bus_fee_category_code; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add/Edit</th>
	</tr>
	<?php } else{ if($add_more_button==0){ $fee_code_blank=$bus_fee_category_code;
	} $add_more_button++; } } if($add_more_button!=0){?>
	<tr align='center' >
	<th colspan="4" ><button type="button" id="<?php echo $fee_code_blank; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add More</th>
				</tr>
				<?php } ?>
				</tbody>
                </table>
                </div>
<div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body" >
        <div class="col-md-12">
        <div class="form-group">
		<label>Bus Fee Category Add/Edit</label>
		<input type="text" name="bus_fee_type1" id="bus_fee_type1" class="form-control">
		<input type="hidden" name="bus_fee_code_hidden" id="bus_fee_code_hidden" class="form-control">
		</div>
		</div>
		<div class="col-md-12">
	    <div class="form-group">
		<label>Bus Fee Category Hindi Add/Edit</label>
		<input type="text" name="bus_fee_type_hindi" id="bus_fee_type_hindi" class="form-control">
		</div>
        </div>
		<div class="col-md-12">
		<?php for($k=0;$k<$class_sno;$k++){ ?>
		<div class="col-md-3">
		<div class="form-group">
		<label><?php echo $class_name1[$k]." Fee"; ?></label>
		<input type="text" name="classwise_amount[]" id="<?php echo $class_code[$k]."_amount"; ?>" class="form-control" />
		<input type="hidden" name="class_code_hidden[]" value="<?php echo $class_code[$k]; ?>" class="form-control" />
		</div>
		</div>
		<?php } ?>
		</div>
		
      </div>
	  <div class="modal-footer">
		<input type="submit" name="finish" value="ADD" class="btn btn-success" />
          <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	
		  </form>
  </div>
  		
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
