<?php include("../attachment/session.php"); ?>
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
 
 function get_section($class){
     $.ajax({
         url:access_link+"fees_installmentwise/get_student_section?class_name="+$class+"",
         type:"POST",
         cache:false,
         success:function(data){
             $("#student_section").html(data);
             for_list();
         }
         
     });
 }


function for_list(){ 
var student_class=	document.getElementById('student_class').value;
var student_section= document.getElementById('student_section').value;
$("#my_table").html(loader_div);
if(student_class!=''){
       $.ajax({
			  type: "POST",
              url: access_link+"fees_installmentwise/ajax_get_student.php?student_class="+student_class+"&student_section="+student_section+"",
              cache: false,
              success: function(detail){
            $('#my_table').html(detail);
			//$("#click").click();
              }
           });
 }else{
  $('#my_table').html('');  
} 
		     
    }
</script>
     <section class="content-header">
      <h1>
        Employee Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_installmentwise/fees')"><i class="fa fa-graduation-cap"></i> Fees</a></li>
	  <li class="active">Student Income Tax</li>
      </ol>
    </section>
	

	<script type="text/javascript">
	   function set_id_card(value1){
	   var page1 = "../pdf/id_card_page/id_card_pdf_"+value1+".php";
	    $('#my_form').attr('action',page1);
    }
</script>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Student Income Tax</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<?php 
$que="select student_income_tax from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$income_tax = $row['student_income_tax'];
}	
   ?>
            <div class="box-body">
			<form role="form"  method="post" id="my_form" action="<?php echo $pdf_path; ?>student_income_tax/<?php echo $income_tax; ?>" enctype="multipart/form-data" target="_blank">
			 <div class="col-md-6">	
					<div class="form-group" >
					    <label>Student Class</label>
					    <select name="student_class" onchange="get_section(this.value);" id="student_class" class="form-control" required>
						       <option value="">Select Class</option>  
						       <option value="NURSERY">NURSERY</option>  
						       <option value="LKG">LKG</option>  
						       <option value="UKG">UKG</option>  
						       <option value="1ST">1ST</option>  
						       <option value="2ND">2ND</option>  
						       <option value="3RD">3RD</option>  
						       <option value="4TH">4TH</option>  
						       <option value="5TH">5TH</option>  
						       <option value="6TH">6TH</option>  
						       <option value="7TH">7TH</option>  
						       <option value="8TH">8TH</option>  
						       <option value="9TH">9TH</option>  
						       <option value="10TH">10TH</option>  
						       <option value="11TH">11TH</option>  
						       <option value="12TH">12TH</option>  
			                   
					    </select>
					</div>
				</div>
				
				 <div class="col-md-6">	
					<div class="form-group" >
					    <label>Student Section</label>
					    <select name="student_section" onchange="for_list();" id="student_section" class="form-control" required>
						       <option value="All">All</option> 
				        </select>
					</div>
				</div>
				
				<div class="col-md-6">	
				</div>
				
				<div class="col-md-12">
                <!-- /.box -->

                <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table">
                
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
				
		  <div class="col-md-12">
		        <center><input type="submit" name="finish" value="Print" class="btn  my_background_color" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  


<script>
// $(function () {
//     $('#example1').DataTable()
//   })
</script>
