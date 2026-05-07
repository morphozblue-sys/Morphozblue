<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
   function fill_detail(value){
           
			$.ajax({
			  address: "POST",
              url: access_link+"penalty/ajax_search_student_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
        
      
              }
           });

    }
		      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"penalty/penalty_form_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				    alert_new('Successfully Complete','green');
				   get_content('penalty/penalty_list');
            }
			}
         });
      });
</script>  

    <section class="content-header">
      <h1>
    <?php echo $language['Student Action']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('penalty/penalty')"><i class="fa fa-exclamation-circle"></i> <?php echo $language['Penalty Management']; ?></a></li>
        <li class="active"><?php echo $language['Penalty Form']; ?></li>
      </ol>
    </section>

	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><?php echo $language['Penalty Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			<div class="col-md-12">
			<div class="col-md-6 ">				
					<div class="form-group" >
					  <label><?php echo $language['Search Student'] ?><font size="2" style="font-weight: normal;"> </font> <span style="color:red;">*</span></label>
					  <select name="" class="form-control select2" onchange="fill_detail(this.value);" style="width:100%;" required>
					  <option value="">Select student</option>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							$student_admission_number=$row22['student_admission_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-[".$student_roll_no."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
			         </div>
			</div>
			</div>
		       <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="student_name" value="" placeholder="<?php echo $language['Student Name']; ?>"  id="student_name" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="student_class" value="" placeholder="<?php echo $language['Class']; ?>"  id="student_class" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Section']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="student_section" value="" placeholder="<?php echo $language['Student Section']; ?>"  id="student_section" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Student Roll No']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="student_roll_no" value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="student_roll_no" class="form-control" readonly>
					</div>
				</div>  
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Penalty Amount']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="penalty_amount" placeholder="<?php echo $language['Penalty Amount']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-3  ">	
					<div class="form-group" >
					  <label><?php echo $language['Penalty Reason']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="text"  name="penalty_reason" placeholder="<?php echo $language['Penalty Reason']; ?>"  value="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Penalty Remark']; ?></label>
					  <input type="text"  name="penalty_remark" placeholder="<?php echo $language['Penalty Remark']; ?>"  value="" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">	
					
				</div>
				  
				<div class="col-md-12">
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				
			</div>
	        </form>	
	        <div class="col-md-12">   
            </div>
	        </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
    <!-- /.box-body -->
        </div>
        </div>
        </section>
<script>
$(function () {
    $('.select2').select2();
  });
</script>
    