<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active">Balance Details</li>
      </ol>
    </section>
	
<script>
function for_section(value){
   $('#student_class_section').html("<option value='' >Loading....</option>");
   $.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/ajax_classwise_section_all.php?class_name="+value+"",
		  cache: false,
		  success: function(detail){
			$("#student_class_section").html(detail);
			for_feelist();
		  }
	   });
}

function for_feelist(){
   $("#fee_details").html(loader_div);
   var student_class=document.getElementById('student_class').value;
   var student_section=document.getElementById('student_class_section').value;
   var list_type=$("input[name='f1']:checked").val();
   if(list_type=='Datewise'){
       $('#div_datewise').show();
       $('#div_monthwise').hide();
       var third_var=document.getElementById('std_date').value;
       
       var page_name = access_link+"fees_monthly/ajax_student_fee_balance_details_datewise.php?student_class="+student_class+"&student_section="+student_section+"&std_date="+third_var
   }else if(list_type=='Monthwise'){
       $('#div_monthwise').show();
       $('#div_datewise').hide();
       var third_var=document.getElementById('std_month').value;
       
       var page_name = access_link+"fees_monthly/ajax_student_fee_balance_details_monthwise.php?student_class="+student_class+"&student_section="+student_section+"&std_month="+third_var
   }
   
   if(student_class!='' && student_section!='' && third_var!=''){
   $.ajax({
	  type: "POST",
	  url: page_name+"",
	  cache: false,
	  success: function(detail){
		$("#fee_details").html(detail);
	  }
   });
   }else{
	   $("#fee_details").html('');
   }
}
</script>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		
		<div class="box-body  col-md-12">
		<div class="col-md-12 col-md-offset-4">
		    <div class="col-md-4">
		    <center>
		    <input type="radio" name="f1" value="Datewise" class="list_type" onclick="for_feelist();" checked /> Datewise &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="radio" name="f1" value="Monthwise" class="list_type" onclick="for_feelist();" /> Monthwise
		    </center>
		    </div>
		</div>
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
		<div class="col-md-4">
			<div class="form-group">
			  <label>Select Class</label>
			   <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
			   <option value="All">All Class</option>
			   <?php
			   $class37=$_SESSION['class_name37'];
			   $class371=explode('|?|',$class37);
			   $total_class=$_SESSION['class_total37'];
			   for($q=0;$q<$total_class;$q++){
			   $class_name=$class371[$q]; ?>
			   <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
			   <?php } ?>
			   </select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			  <label>Section</label>
			  <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feelist();" required>
			  <option value="All">All</option>
			  </select>
			</div>
		</div>
		<div class="col-md-5" id="div_datewise">
			<div class="form-group">
			  <label>To Date</label>
			  <input type="date" id="std_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" oninput="for_feelist();" required />
			</div>
		</div>
		<div class="col-md-5" id="div_monthwise">
			<div class="form-group">
			  <label>To Month</label>
              <select name="std_month" class="form-control" id="std_month" onchange="for_feelist();" >
              <option value="">Select Month</option>
              <?php
              if($session1!=''){
              $session_exp=explode('_',$session1);
              $session_exp1=$session_exp[0];
              $session_exp2='20'.$session_exp[1];
              ?>
              <option <?php if(date('m')=='04'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-04'; ?>"><?php echo $language['April']; ?> </option>
              <option <?php if(date('m')=='05'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-05'; ?>"><?php echo $language['May']; ?> </option>
              <option <?php if(date('m')=='06'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-06'; ?>"><?php echo $language['June']; ?> </option>
              <option <?php if(date('m')=='07'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-07'; ?>"><?php echo $language['July']; ?> </option>
              <option <?php if(date('m')=='08'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-08'; ?>"><?php echo $language['August']; ?> </option>
              <option <?php if(date('m')=='09'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-09'; ?>"><?php echo $language['September']; ?> </option>
              <option <?php if(date('m')=='10'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-10'; ?>"><?php echo $language['October']; ?> </option>
              <option <?php if(date('m')=='11'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-11'; ?>"><?php echo $language['November']; ?> </option>
              <option <?php if(date('m')=='12'){ echo "selected"; } ?> value="<?php echo $session_exp1.'-12'; ?>"><?php echo $language['December']; ?> </option>
              <option <?php if(date('m')=='01'){ echo "selected"; } ?> value="<?php echo $session_exp2.'-01'; ?>"><?php echo $language['January']; ?> </option>
              <option <?php if(date('m')=='02'){ echo "selected"; } ?> value="<?php echo $session_exp2.'-02'; ?>"><?php echo $language['February']; ?> </option>
              <option <?php if(date('m')=='03'){ echo "selected"; } ?> value="<?php echo $session_exp2.'-03'; ?>"><?php echo $language['March']; ?> </option>
              <?php } ?>
              </select>
			</div>
		</div>
		</div>
		<div class="col-md-4">&nbsp;</div>
		</div>
		<div class="col-md-12">&nbsp;</div>
			
		<div class="box-body col-md-10 col-md-offset-1" style="overflow:scroll;border:1px solid;" id="fee_details">
		
		</div>
		  
		    
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
<script>
for_feelist();
</script>