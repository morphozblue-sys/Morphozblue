<?php include("../attachment/session.php")?>
<script type="text/javascript">
         	function for_subject(value){
			$.ajax({
			address: "POST",
			url: access_link+"smartclass/ajax_get_subject_without_stream.php?value="+value+"",
			cache: false,
			success: function(detail){
			 $("#subject_name").html(detail);
			 //for_list();
			}
			});
			}
</script>
    <section class="content-header">
      <h1>
         <?php echo $language['Homework Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
          
        <li><a href="javascript:get_content('smartclass/smartclass')"><i class="fa fa-book"></i> Smart Class</a></li>
        <li><a href="javascript:get_content('smartclass/homework')"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></a></li>
        <li class="active"><i class="fa fa-list"></i>  <?php echo $language['Homework List']; ?></li>
      </ol>
    </section>
	
	<script>
	function valid(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	delete_fee(s_no);
	}
	else  {
	return false;
	}
	}
	
	function delete_fee(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"smartclass/homework_delete.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('smartclass/homework_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
/*	
	function for_search(){
	    var student_class=document.getElementById('student_class').value;
	    var particular_date=document.getElementById('particular_date').value;
	    if(student_class!='' && particular_date!=''){
	        var pass_var="student_class="+student_class+"&particular_date="+particular_date;
	    }else{
	    if(student_class!=''){
	        var pass_var="student_class="+student_class;
	    }else if(particular_date!=''){
	        var pass_var="particular_date="+particular_date;
	    }else{
	        var pass_var="";
	    }
	    }
	    post_content('homework/homework_list', pass_var);
	}
	*/
	</script>
	 

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Homework List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              
              <div class="col-md-8 col-md-offset-2">
              
 
              <div class="col-md-3">
              <div class="form-group">
				<label><?php echo $language['Class']; ?></label>
				<select name="student_class" id="student_class" class="form-control" onchange="for_subject(this.value);for_search();" >
					<option  value="">Select</option>
					<?php
					   $class37=$_SESSION['class_name37'];
					   $class371=explode('|?|',$class37);
					   $total_class=$_SESSION['class_total37'];
					   for($q=0;$q<$total_class;$q++){
					   $class_name=$class371[$q]; 
					?>
					<option  value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					<?php
					}
					?>
				</select>
			  </div>
			  </div>
			   <div class="col-md-3">
              <div class="form-group">
			   <label ><?php echo $language['Subject Name']; ?></label>
				     <select class="form-control" name="exam_stuff_subject" id="subject_name" required onchange="for_search();">
				      <option value="">Select Subject</option>
				     </select> </div>
			  </div>
               
			  <div class="col-md-3">
              <div class="form-group">
				<label>Particular Date</label>
				<input type="date" name="particular_date" id="particular_date" class="form-control" oninput="for_search();" value="" />
			  </div>
			  </div>
			  
			  	 <div class="col-md-3">				
				<div class="form-group" >
				<label>Updated By</label>
				<select name="bus_routee" class="form-control" id="bus_routee" onchange="for_search();">
				<option value="">All User</option>
				<?php 
				$que="select * from user_rights GROUP BY user_email";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                $serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
                    $s_no=$row['s_no'];
                    $bus_routee = $row['user_email'];
                    $serial_no++;
                ?>
				<option value="<?php echo $bus_routee; ?>"><?php echo $bus_routee; ?></option>
				<?php } ?>
				</select>
				</div>
				</div>
              
              
              </div>
              
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th><?php echo $language['S No']; ?></th>
		<th><?php echo $language['Class']; ?></th>
		<th><?php echo $language['Student Section']; ?></th>
		<th>Subject</th>
        <th><?php echo $language['Homework']; ?></th>
        <th><?php echo $language['Date']; ?></th>
		<th><?php echo $language['Remark']; ?></th>
		
        <th>Update By</th>
        <th>Date</th>
		
		<th>Download PDF</th>
		<th>Answers</th>
		<th><?php echo $language['Edit']; ?></th>
		<th><?php echo $language['Delete']; ?></th>
        </tr>
        </thead>
        <tbody>
	

</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		
		
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
   function for_search(){
	    var student_class=document.getElementById('student_class').value;
	    var particular_date=document.getElementById('particular_date').value;
	    var subject_name=document.getElementById('subject_name').value;
	    var bus_routee=document.getElementById('bus_routee').value;
	 
	        var pass_var="?student_class="+student_class+"&particular_date="+particular_date+"&subject_name="+subject_name+"&bus_routee="+bus_routee;
	  
            var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"smartclass/homework_list_fatch.php"+pass_var,
                    type:"post"
                }
            });
        }
        for_search();
    </script>
 