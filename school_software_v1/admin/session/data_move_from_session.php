<?php include("../attachment/session.php"); ?> 
<script type="text/javascript">
function add_edit(value,name){
var fee_name=name.split('|?|');
$('#fee_type1').val(fee_name[0]);
$('#fee_type_hindi').val(fee_name[1]);
$('#fee_code_hidden').val(value);
}
</script>
<script>

    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
				   $("#myModal_close").click();
        $.ajax({
            url: access_link+"school_info/data_move_from_session_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			       alert_new('successfully Update','green');
				   get_content('school_info/data_move_from_session');
               }
               else{
                  alert_new('Error','red');
               }
			}
         });
      });
</script>
<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">School Information Management</h4>
			<ul class="breadcrumbs">
			<li class="nav-home">
    <a href="javascript:get_content('index_content')">
        <i class="icon">
           <img src="../<?php echo $school_software_path; ?>images/dashboard.png" style="width:25px;"   title="Dashboard" class="image1">
        </i>
    </a>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li> 
				<li class="nav-item">
					<a href="javascript:get_content('index_content')">Dashboard</a> 
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="javascript:get_content('school_info/school_info')">School Info</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<b>Data Move</b>
				</li>
			</ul>
		</div> 
		<form method="post" enctype="multipart/form-data" action="" id="my_form">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-primary">
						<div class="card-title">Data Move From to Session</div>
					</div>
					<div class="card-body">
						<!-- place here inner page section -->
						<div class="col-md-12 card-body table-responsive">
					       <div class="row">
					         	<div class="col-md-3">		
								<label>From Select Session</label>
								<select  name="from_session" id="from_session" class="form-control"  required>
								<?php 
								$session_value23=$_SESSION['session_value_array'];
								for($d=0;$d<count($session_value23);$d++) { 
								$session_value12321=explode('_',$session_value23[$d]);
								$session_show=$session_value12321[0].'-'.$session_value12321[1];
								?>
								<option <?php if($session12==$session_value23[$d]){ echo 'selected'; }?> value="<?php echo $session_value23[$d]; ?>"> <?php echo $session_show; ?></option>
								<?php } ?>
								</select>
								</div>
					         	<div class="col-md-3">		
								<label>To Select Session</label>
								<select  name="to_session" id="to_session" class="form-control"  required>
								<?php 
								$session_value23=$_SESSION['session_value_array'];
								for($d=0;$d<count($session_value23);$d++) { 
								$session_value12321=explode('_',$session_value23[$d]);
								$session_show=$session_value12321[0].'-'.$session_value12321[1];
								?>
								<option <?php if($session12==$session_value23[$d]){ echo 'selected'; }?> value="<?php echo $session_value23[$d]; ?>"> <?php echo $session_show; ?></option>
								<?php } ?>
								</select>
								</div>
					            <div class="col-md-6">
					                <label>Table Name</label>
					                <select name="table_name" id="table_name" class="form-control" required>
					                 <option value="school_info_fee_types" >Fees Type</option>
					                 <option value="school_info_fee_category" >Fees Category</option>
					                 <option value="school_info_monthly_fees" >Fees Month</option>
					                 <option value="school_info_exam_types" >Exam Type </option>
					                 <option value="school_info_exam_types_cbse" >Exam Type CBSE</option>
					                 <option value="school_info_exam_types_monthly" >Exam Type Monthly</option>
					                 <option value="school_info_subject_info" >All Subject</option>
					                </select>
					            </div>
					            
					            <div class="col-md-12">
					                <br>
								 <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn  my_background_color" /></center>
								</div>
					       </div>
                        </div>
						<!-- place here inner page section -->
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	