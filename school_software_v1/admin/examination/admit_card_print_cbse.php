<?php include("../attachment/session.php");
?>
<script type="text/javascript">
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

<script type="text/javascript">
      function for_list(){ 
			var student_class= document.getElementById('student_class').value;
			var student_class_section= document.getElementById('student_class_section').value;
			var exam_type= document.getElementById('exam_type').value;
			var student_class_stream= document.getElementById('student_class_stream').value;
			var student_class_group= document.getElementById('student_class_group').value;
			var exam_term= document.getElementById('exam_term').value;
			
			if(student_class!='' && exam_type!=''){
			 $('#my_table').html(loader_div);
             $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_admit_card_print.php?id="+student_class+"&student_section="+student_class_section+"&student_exam_type="+exam_type+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&exam_term="+exam_term+"",
              cache: false,
              success: function(detail){
              $('#my_table').html(detail);
			 var str1 =detail;			 
			 
			//$("#click").click();
              }
           });
		   document.getElementById('exam_type_hidden').value=exam_type;
		   document.getElementById('student_class_hidden').value=student_class;
		   document.getElementById('exam_term1_hidden').value=exam_term;
		           document.getElementById('student_class_stream_hidden').value=student_class_stream;
        document.getElementById('student_class_group_hidden').value=student_class_group;
	
		   $("#print_all").show();
            }
}
</script>
<script type="text/javascript">
   function for_section(value){
        $('#student_class_section').html("<option value='' >Loading....</option>");    
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#student_class_section").html(str);
				  for_exam();
				  for_list();
              }
           });

    }
    		
function for_stream(value2){
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}
   function get_group(value1){
       $('#student_class_group').html("<option value='' >Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function(detail1){			   
                  $("#student_class_group").html(detail1);
              }
           });

    }
		   function for_exam(){
		       $('#exam_type').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
              url: access_link+"examination/ajax_get_exam_type_cbse.php?class_name="+student_class+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#exam_type").html(str);
              }
           });
for_list();
    }
</script>

    <section class="content-header">
      <h1>
        <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('examination/examination')"><i class="fa fa-id-card-o"></i> <?php echo $language['Examination']; ?></a></li>
	   <li class="active"><?php echo $language['Admit Card Print']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Admit Card Print']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<?php 
$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$admit_card_cbse_pdf = $row321['admit_card_cbse_pdf'];
}	
   ?>  
            <div class="box-body">
				
			 <form role="form" action="<?php echo $pdf_path; ?>admit_card/<?php echo $admit_card_cbse_pdf; ?>" method="post" enctype="multipart/form-data" target="_blank">
			
			     <div class="col-md-3">	
					<div class="form-group">
					    <label><?php echo $language['Class']; ?></label>
					    <select name="student_class" onchange="for_stream(this.value);for_section(this.value);" id="student_class" class="form-control" required>
						<option value="">Select Class</option>
						        <?php    $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				 </div>
                 <div class="col-md-3" id="student_class_stream_div" style="display:none;">				
				 	<div class="form-group">
					  <label><?php echo $language['Stream']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);for_list();" >
					           <option value="">Select Stream</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					</div>
		        </div>
		        <div class="col-md-3" id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label><?php echo $language['Group']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_list();" >
					        <option value="">Select Group</option>
					    </select>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
					    <select class="form-control" name="student_class_section" id="student_class_section" onchange='for_list();'>
					     <option value="">All</option>
					    </select>
					</div>
				</div>
		    <div class="col-md-3" >				
			  <div class="form-group">
				 <label>Exam Term</label>
				 <select class="form-control" name="exam_term" id="exam_term" onchange='for_list();' >
				      <option value="">Select Exam Term</option>
				      <option value="term1">Term1</option>
				      <option value="term2">Term2</option>
				</select>
			  </div>
			</div>
			<div class="col-md-3">				
			  <div class="form-group" >
				 <label><?php echo $language['Exam Type']; ?></label>
        		 <select class="form-control" name="exam_type" id="exam_type" onchange='for_list();' required>
				       <option value="">Select Exam Type</option>
				 </select>
			  </div>
			</div>
			<div class="col-md-3">				
			  <div class="form-group" id="print_all" style="display:none;">
				 <label ><?php echo $language['Print All']; ?></label>
				 <input type="submit" name="finish" value="Print All" class="btn  btn-success form-control" />
				 <input type="hidden" name="session" value="<?php echo $session1; ?>" />
		      </div>
			</div>
			
		</form>
			<form role="form" action="<?php echo $pdf_path; ?>admit_card/<?php echo $admit_card_cbse_pdf; ?>" method="post" enctype="multipart/form-data" target="_blank">
			    
			    <?php if($_SESSION['software_link'] == 'shiningstarsiwan'){?>
			<div class="col-md-8">
			<div class="col-md-12">
			    <span style="float:right;"><input type="checkbox" value="" id="fee_month" onclick="for_check(this.id);" <?php if (isset($_GET['check_all'])) { echo 'checked'; } ?> /><b style="color:red;">Check All</b></span>
			</div>
			 <?php
			 
			 if (isset($_GET['fee_month'])){
			 $month=$_GET['fee_month'];
			 $month_strcount1=substr_count($month,',');
			 if($month_strcount1>0){
			 $month_exp=explode(',',$month);
			 $month_count=count($month_exp);
			 }else{
			 $month_exp[]=$month;
			 $month_count=1;
			 }
			 }
			 
			 $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			 $run01=mysqli_query($conn73,$que01);
			 $sno=0;
			 while($row01=mysqli_fetch_assoc($run01)){
			 $fees_type_name[$sno] = $row01['fees_type_name'];
			 $fees_type = $row01['fees_type'];
			 $fees_code[$sno] = $row01['fees_code'];
			 $fees_count = $row01['fees_count'];
			 $var_condition="month".$fees_code[$sno];
			 
			 $penalty_day_monthly[$fees_code[$sno]] = $row01['penalty_day_monthly'];
			 
			 $dues_last_date[$fees_code[$sno]] = $row01['dues_last_date'];
			 $penalty_percent_rupees_amount[$fees_code[$sno]] = $row01['penalty_percent_rupees_amount'];
			 $penalty_method[$fees_code[$sno]] = $row01['penalty_method'];
			 ?>
			
			<div class="col-md-3">
			<input type="checkbox" id="fees_month" class="fee_month" name='fees_month[]' value="<?php echo $fees_code[$sno]; ?>" <?php if (isset($_GET['fee_month'])){ for($f=0;$f<$month_count;$f++){ if($month_exp[$f]==$fees_code[$sno]){ echo 'checked'; } } } ?>  > <?php echo $fees_type_name[$sno]; ?>
			</div>
			<?php $sno++; } ?>
			</div>
			<?php } ?>
			    
				<input type="hidden" name="student_class1" id="student_class_hidden" value="<?php echo $student_class; ?>" />
                <input type="hidden" name="exam_type1" id="exam_type_hidden" value="" />
                <input type="hidden" name="exam_term1" id="exam_term1_hidden" value="" />
                <input type="hidden" name="exam_group1" id="student_class_group_hidden" value="" />
                <input type="hidden" name="exam_stream1" id="student_class_stream_hidden" value="" />
                <input type="hidden" name="session" value="<?php echo $session1; ?>" />

				<div class="col-xs-12">
                <!-- /.box -->

                <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table">
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Father Name']; ?></th>
                  <th><?php echo $language['Class Roll No']; ?></th>
				  <th><?php echo $language['Select']; ?><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
				  
				  <th>Update By</th>
                  <th>Date</th>
				  
                </tr>
                </thead>
				
				<tbody id="example2">
				
		        </tbody>
				
                </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				

		  <div class="col-md-12">
		        <center><input type="submit" name="finish"  value="<?php echo $language['Print']; ?>" class="btn  btn-success" /></center>
				
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
       <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>

  