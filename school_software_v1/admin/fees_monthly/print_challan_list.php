<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active"> Print Challan List</li>
      </ol>
    </section>
<script>
function for_section(value){
$('#student_class_section').html("<option value='' >Loading....</option>");
if(value!='All'){
$.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_classwise_section_all.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		$("#student_class_section").html(detail);
		student_list();
	  }
   });

}else{
    $("#student_class_section").html("<option value='All'>All</option>");
    student_list();
}
}

function for_check(id,check){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
if(check=='Yes'){
student_list();
}
}

function student_list(){
        $("#search_list").html(loader_div);
        var class_name=document.getElementById('student_class').value;
        var section_name=document.getElementById('student_class_section').value;
        var admission_scheme=document.getElementById('admission_scheme').value;
        
        var no_of_count=0;
        var month_arr=[];
        $(".fee_month").each(function() {
        if($(this).prop("checked") == true){
            no_of_count = Number(no_of_count+1);
            month_arr.push($(this).val());
        }
        });
        
        if(class_name!='' && section_name!='' && no_of_count>0){
        $.ajax({
        type: "POST",
        url: access_link+"fees_monthly/ajax_get_student_for_challan.php",
        data: {class_name:class_name,section_name:section_name,month_arr:month_arr,no_of_count:no_of_count,admission_scheme:admission_scheme},
        cache: false,
        success: function(detail){
        $("#search_list").html(detail);
        }
        });
        }else{
        $("#search_list").html('');
        }
}

function check_valid(){
    var count=0;
    $(".info").each(function() {
    if($(this).prop("checked") == true){
    count = Number(count+1);
    }
    });
    if(count>0){
        return true;
    }else{
        alert('Please select Atleast One Student !!!');
        return false;
    }
}




</script>

	<!---******************************************************************************************************-->
<form method="post" action="<?php echo $pdf_path.'challan_pdf/challan_pdf_monthly.php'; ?>" enctype="multipart/form-data" target="_blank">
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <div class="col-md-4">
            <h3 class="box-title">Selection Area</h3>
			</div>
			<div class="col-md-6">
			<span style="float:right;"><input type="checkbox" name="doc_no_update" value="" /><b style="color:red;"> With Doc No Update</b></span>
			</div>
			<div class="col-md-2">
			<span style="float:right;"><input type="checkbox" value="" id="fee_month" onclick="for_check(this.id,'Yes');" /><b style="color:red;">Check All</b></span>
			</div>
			
			<div class="col-md-12 col-md-offset-1">
                
                <div class="col-md-2">
                <div class="form-group">
                <label>Select Class</label>
                <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
                <option value="All">All</option>
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
                
                <div class="col-md-2">
                <div class="form-group">
                <label>Section</label>
                <select name="student_class_section" id="student_class_section" class="form-control" onchange="student_list();" required>
                <option value="All">All</option>
                </select>
                </div>
                </div>
                
                <div class="col-md-4">				
                <div class="form-group">
                <label>Select Bank</label>
                <select name="selected_bank" class="form-control select2" id="selected_bank" style="width:100%;">
                <option value="">Select Bank</option>
                <?php
                $qry="select * from account_office_bank_account";
                $rest=mysqli_query($conn73,$qry);
                while($row22=mysqli_fetch_assoc($rest)){
                $s_no=$row22['s_no'];
                $bank_account_no=$row22['bank_account_no'];
                $bank_account_holder_name=$row22['bank_account_holder_name'];
                $bank_name=$row22['bank_name'];
                $bank_branch_name=$row22['bank_branch_name'];
                $bank_ifsc_code=$row22['bank_ifsc_code'];
                ?>
                <option <?php if (isset($_GET['s_no'])) { if($_GET['s_no']==$s_no){ echo 'selected'; } } ?> value="<?php echo $s_no; ?>"><?php echo $bank_account_holder_name."[".$bank_name."]-[".$bank_branch_name."]-[".$bank_account_no."]-[".$bank_ifsc_code."]"; ?></option>
                <?php
                }
                ?>
                </select>
                </div>
                </div>
                
                <div class="col-md-2">
                <div class="form-group">
                <label>Admission Scheme</label>
                <select name="admission_scheme" id="admission_scheme" class="form-control" onchange="student_list();">
                <option value="All">All</option>
                <option value="RTE">RTE</option>
                <option value="NON-RTE">NON-RTE</option>
                </select>
                </div>
                </div>
                
                
			</div>

			<div class="box-body  col-md-12">
			
			<div class="col-md-12 col-md-offset-1">
                
                <div class="col-md-10">
                <?php
                $query="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37";
                $result=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
                while($row=mysqli_fetch_assoc($result)){
                $fees_type_name = $row['fees_type_name'];
                $fees_type = $row['fees_type'];
                $fees_code = $row['fees_code'];
                ?>
                
                <div class="col-md-2">
                <input type="checkbox" name="fee_months[]" id="" class="fee_month" value="<?php echo $fees_code; ?>" onclick="student_list();" /> <?php echo $fees_type_name; ?>
                </div>
                <?php } ?>
                </div>
                
			</div>
			
            </div>
 <div class="box-body ">
	<div class="col-md-12">
                <!-- /.box -->

                <div class="box">
                <div class="box-header">
                </div>
			
		<div class="box-body table-responsive">
				  
				  <div class="col-md-8 col-md-offset-2" id="search_list">
				      
				  </div>
				  
			</div>
			 </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
</form>

    <!-- /.content -->
<script>
student_list();
</script>
<script>
$(function () {
    $('.select2').select2();
  });
</script>