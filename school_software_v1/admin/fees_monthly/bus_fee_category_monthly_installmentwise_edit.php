<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function for_calculation(value,id_class,class_code,fee_code){

var fee_sno=document.getElementById('fee_sno').value;
var class_code2=document.getElementById('class_code2').value;
var tot_cls=class_code2.split('|?|');
var tot_lnth=tot_cls.length;
if(id_class=='my_id'){
    var each_amt=parseFloat(value/fee_sno);
    if($('#for_same1').prop("checked") == true){
    for(var q=1;q<tot_lnth;q++){
        $('#'+tot_cls[q]).val(value);
        $('.'+tot_cls[q]).each(function() {
        $(this).val(each_amt.toFixed());
        });
    }
    }else{
    $('.'+class_code).each(function() {
    $(this).val(each_amt.toFixed());
    });
    }
}else if(id_class=='my_class'){
    if($('#for_same1').prop("checked") == true){
    var total=0;
    $('.'+class_code).each(function() {
    total += Number($(this).val());
    });
    var v=0;
    for(var q=1;q<tot_lnth;q++){
        $('#month_'+fee_code+'_'+v).val(value);
        $('#'+tot_cls[q]).val(total);
        v=Number(v+1);
    }
    }else{
    var total=0;
    $('.'+class_code).each(function() {
    total += Number($(this).val());
    });
    $('#'+class_code).val(total);
    }
}

}

</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
		window.scrollTo(0, 0);
        get_content(loader_div);
        $.ajax({
            url: access_link+"fees_monthly/add_bus_fee_category_monthly_installmentwise_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                //$('#test').html(detail);
              var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert('Successfully Completed');
				   get_content('fees_monthly/add_bus_fee_category_monthly_installmentwise');
            }
			}
         });
      });
</script>
    
    <?php
	$qry="select * from school_info_general";
	$rest=mysqli_query($conn73,$qry);
	while($row22=mysqli_fetch_assoc($rest)){
	$fees_type=$row22['fees_type'];
	}
	$table_var="school_info_".$fees_type."_transport_fees";
	?>
    
    <section class="content-header">
      <h1>
        <?php echo 'Fees Management'; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/add_bus_fee_category_monthly_installmentwise')"><i class="fa fa-graduation-cap"></i>Transport Fee List</a></li>
	  <li class="active">Transport Fees Structure Edit</li>
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
              <div class="col-md-8"><h3 class="box-title">Transport Fees Structure</h3></div>
              <div class="col-md-4"><span style="float:right;font-weight:bold;color:red;"><input type="checkbox" id="for_same1">Check For Same</span></div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <?php
            $que1="select * from school_info_class_info where class_name!=''";
            $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
            $class_sno=0;
            // $class_code='';
            // $class_code2='';
            // $class_name1='';
            while($row1=mysqli_fetch_assoc($run1)){
            $class_name=$row1['class_name'];
            $class_name1[$class_sno]=$class_name;
            $class_code[$class_sno]=$row1['class_code'];
            $class_code2=$class_code2."|?|".$row1['class_code'];
            $class_sno++;
            }
            
            $que01="select * from $table_var where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
            $run01=mysqli_query($conn73,$que01);
            $fee_sno=0;
            // $fees_code11='';
            // $seprator='';
            while($row01=mysqli_fetch_assoc($run01)){
            $fees_type_name[$fee_sno] = $row01['fees_type_name'];
            $fees_type = $row01['fees_type'];
            $fees_code[$fee_sno] = $row01['fees_code'];
            $fees_count = $row01['fees_count'];
            if($fee_sno!=0){
                $seprator='|?|';
            }
            $fees_code11=$fees_code11.$seprator.$row01['fees_code'];
            //$var_condition="month".$fees_code[$fee_sno];
            $fee_sno++;
            }
            
            $bus_fee_category_code11=$_GET['bus_fee_category_code'];
            $que="select * from bus_fee_category where bus_fee_category_code='$bus_fee_category_code11'";
            $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
            $serial_no=0;
            $add_more_button=0;
            while($row=mysqli_fetch_assoc($run)){
            
            $s_no=$row['s_no'];
            $bus_fee_category_name = $row['bus_fee_category_name'];
            $bus_fee_category_name_hindi = $row['bus_fee_category_name_hindi'];
            $bus_fee_category_code = $row['bus_fee_category_code'];
            //$name_str=$bus_fee_category_name.'|?|'.$bus_fee_category_name_hindi;
            
            // $class_amount='';
            // $class_amount_monthly='';
            for($l=0;$l<$class_sno;$l++){
            $class_amount[$l] = $row[$class_code[$l].'_amount'];
            //$name_str=$name_str."|?|".$row[$class_code[$i].'_amount'];
            for($m=0;$m<$fee_sno;$m++){
                 $class_amount_monthly[$l][$m] = $row[$class_code[$l].'_amount_month'.$fees_code[$m]];;
            }
            
            }
            
            $serial_no++;
            }
            ?>
            <form role="form"  method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body "  >
		        
				<div class="col-md-12 box-body table-responsive">
				<div class="col-md-8 col-md-offset-2">
				    <div class="col-md-6">
				        <label>Bus Fee Type</label>
				        <input type="text" name="bus_fee_category_name" id="" value="<?php echo $bus_fee_category_name; ?>" class="form-control" />
				        <input type="hidden" name="fee_sno" id="fee_sno" value="<?php echo $fee_sno; ?>" class="form-control" />
				        <input type="hidden" name="class_code2" id="class_code2" value="<?php echo $class_code2; ?>" class="form-control" />
				        <input type="hidden" name="bus_fee_category_code11" id="bus_fee_category_code11" value="<?php echo $bus_fee_category_code11; ?>" class="form-control" />
				        <input type="hidden" name="class_sno" id="class_sno" value="<?php echo $class_sno; ?>" class="form-control" />
				        <input type="hidden" name="fees_code11" id="fees_code11" value="<?php echo $fees_code11; ?>" class="form-control" />
				    </div>
				    <div class="col-md-6">
				        <label>Bus Fee Type Hindi</label>
				        <input type="text" name="bus_fee_category_name_hindi" id="" value="<?php echo $bus_fee_category_name_hindi; ?>" class="form-control" />
				    </div>
				</div>
				<div class="col-md-12" id="test">&nbsp;</div>
                <table id="table-data" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
				  <th>Class Name</th>
				  <th>Total Amount</th>
				  <?php for($j=0;$j<$fee_sno;$j++){ ?>
                  <th><?php echo $fees_type_name[$j]; ?></th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $serial=0;
                for($i=0;$i<$class_sno;$i++){
                $serial++;
                ?>
                <tr>
                <td><?php echo $serial.'.'; ?></td>
                <td><?php echo $class_name1[$i]; ?><input type="hidden" name="class_code[]" value="<?php echo $class_code[$i]; ?>" /></td>
                <td><input type="number" name="total_amount[]" id="<?php echo $class_code[$i]; ?>" value="<?php echo $class_amount[$i]; ?>" style="width:80px;" class="amt1" title="<?php echo $class_name1[$i]; ?>" oninput="for_calculation(this.value,'my_id','<?php echo $class_code[$i]; ?>','01');" /></td>
                <?php $u=0; for($k=0;$k<$fee_sno;$k++){ $u++; ?>
                <td><input type="number" name="<?php echo $class_code[$i].'_'.$fees_code[$k]; ?>" id="<?php echo 'month_'.$fees_code[$k].'_'.$i; ?>" value="<?php echo $class_amount_monthly[$i][$k]; ?>" style="width:60px;" class="<?php echo $class_code[$i]; ?> amt" title="<?php echo $class_name1[$i].' / '.$fees_type_name[$k]; ?>" oninput="for_calculation(this.value,'my_class','<?php echo $class_code[$i]; ?>','<?php echo $fees_code[$k]; ?>');" /></td>
                <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <div class="col-md-12">
                <center><input type="submit" name="submit" value="Submit" class="btn  my_background_color" /></center>
                </div>
                </div>
  		
	      </div>
	      </form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
