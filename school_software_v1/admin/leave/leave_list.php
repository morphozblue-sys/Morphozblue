<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Leave Management']; ?>
      </h1>
      <ol class="breadcrumb">
               <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	   <li><a href="javascript:get_content('leave/leave')"><i class="fa fa-umbrella"></i> <?php echo $language['Leave Management']; ?></a></li>
        <li class="active"><i class="fa fa-list"></i> <?php echo $language['Leave List']; ?></li>
      </ol>
    </section>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  } 
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"leave/delete_leave.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('leave/leave_list');
			   }else{
               alert_new(detail); 
			   }
}
});
}

</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Leave List']; ?></h3>
            </div>
                    
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
            <div class="col-md-3">
              <div class="form-group">
				<label><?php echo $language['Class']; ?></label>
				<select name="student_class" id="student_class" class="form-control" onchange="for_search();" >
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
				<label>Particular Date</label>
				<input type="date" name="particular_date" id="particular_date" class="form-control" oninput="for_search();" value="" />
			  </div>
			  </div> 
                
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Class']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Section']; ?></th>
                  <th><?php echo $language['From Date']; ?></th>
                  <th><?php echo $language['To Date']; ?></th>
				  <th><?php echo $language['Total leave days']; ?></th>
                  <th><?php echo $language['Approved By']; ?></th>         
                  <th><?php echo $language['Application']; ?></th>
                  <th>Edit</th>
                  <th>Delete</th>
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
	    if(student_class!='' && particular_date!=''){
	        var pass_var="?student_class="+student_class+"&particular_date="+particular_date;
	    }else{
	    if(student_class!=''){
	        var pass_var="?student_class="+student_class;
	    }else if(particular_date!=''){
	        var pass_var="?particular_date="+particular_date;
	    }else{
	        var pass_var="";
	    }
	    }
            var dataTable=$('#example1').DataTable({
                destroy: true,
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:access_link+"leave/leave_list_fatch.php"+pass_var,
                    type:"post"
                }
            });
        }
        for_search();
    </script>