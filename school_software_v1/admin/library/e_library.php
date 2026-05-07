<?php include("../attachment/session.php")?>
<style>
#tr_1{

 background-image: url(images/bookshelf_empty_tr.png), url(images/bookshelf_empty_tr1.png), url(images/bookshelf_empty_tr2.png); !important;
 background-position:left , right, center;
 background-repeat: no-repeat,no-repeat,repeat;
 background-size: auto;
}
 .table>tbody>tr>td
 {
    border: none !important;
 }
 .h
 {
    color:white;
	size:50px;
	height:45px;
 } 
 
 .table-responsive
 {
     overflow-x: unset !important;
 }
 
</style>	
	
<script type="text/javascript">
         	function for_subject(value){
         	$.ajax({
			address: "POST",
			url: access_link+"library/ajax_get_book_subject.php?class_name="+value+"",
			cache: false,
			success: function(detail){
			    
	       	 $("#my_table").html(detail);
			
			}
			});
			}
</script>

<script type="text/javascript">
   function for_book(){
         var class_name=document.getElementById("student_class").value;
         var subject_name=document.getElementById("subject_name").value;
       $.ajax({
			  type: "POST",
              url: access_link+"library/ajax_get_book_name.php?class_name="+class_name+"&subject_name="+subject_name+"",
              cache: false,
              success: function(detail){
                  $("#book_name").html(detail);
				
				  for_book_image();
				   for_list();
              }
           });

    }
</script>

<script>
function for_book_image(){
 var class_name=document.getElementById("student_class").value;
  var subject_name=document.getElementById("subject_name").value;
  var book_name=document.getElementById("book_name").value;
  if(class_name!='' && subject_name!='' && book_name!=''){
$.ajax({
address: "POST",
url: access_link+"library/ajax_get_books_image.php?book_name="+book_name+"",
cache: false,
success: function(detail){
 $("#book_image").html(detail);
}
});
}
for_list();
}
function get_chapter(book_name){
$("#example1").show();
var res=book_name;
var res1=book_name.split('/');
var book_code=res1[0];
var book_name=res1[1];
var subject_name=res1[2];
document.getElementById("book_name1").value=book_name;
document.getElementById("subject_name1").value=subject_name;
$.ajax({
address: "POST",
url: access_link+"library/ajax_get_chapter.php?book_name="+book_code+"",
cache: false,
success: function(detail){
 $("#chapter_name").html(detail);
}
});
}

function get_pdf(path1){
$.ajax({
address: "POST",
url: access_link+"library/ajax_get_books_pdf.php?path2="+path1+"",
cache: false,
success: function(detail){
 $("#book_image").html(detail);
}
});
}

</script>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Library Management 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> Library Management</a></li>
        <li class="active">E-Library </li>
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
              <h3 class="box-title">E-Library</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body  table-responsive">
			<form role="form" method="post" enctype="multipart/form-data">
			


							
				<div class="col-md-4 ">	
					<div class="form-group" >
					    <label>Class<font style="color:red"><b>*</b></font></label>
					    <select name="class" onchange="for_subject(this.value);" id="student_class" class="form-control" required>
							  <option value=>Select Class</option>
							  <option value="1">Class I</option>
							  <option value=2>Class II</option>
							  <option value=3>Class III</option>
							  <option value=4>Class IV</option>
							  <option value=5>Class V</option>
							  <option value=6>Class VI</option>
							  <option value=7>Class VII</option>
							  <option value=8>Class VIII</option>
							  <option value=9>Class IX</option>
							  <option value=10>Class X</option>
							  <option value=11>Class XI</option>
							  <option value=12>Class XII</option>
							  <option value=13>Class XI & XII Combined</option>
                         </select>
					</div>
				</div>
				
				 </div>
				 
		        </form>	

			 <div class="col-sm-12" id="my_pdf" style="margin-top:50px; margin-bottom:-10px;">
			 <div class="col-sm-6">
			 <table class="table" style="height:900px; width:100%;">
			 <tbody id="my_table">
			
			  </tbody>
			 </table><br/><br/><br/><br/>
			 </div>
			 		       <div class="col-md-6" style="margin-top:5px;">
                <table id="example1" class="table table-bordered table-striped" style="display:none">
                <thead class="">
				 <tr>
				  <th><input type="text" id="book_name1" color="red" readonly style="border:none;color:blue"></th>
                  <th><input type="text" id="subject_name1" readonly style="border:none;color:blue" ></th>
                </tr>
                 <tr>
				  <th>Chapter</th>
                  <th>Open</th>
				 
                </tr>
                </thead>
                  <tbody id="chapter_name">
                  </tbody>
             </table>
            </div>
			 </div>
			 
			 
			 	 <div class="col-sm-12" id="book_image">
			   </div>
			 
	            </div>
				
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
                 </div>
                </div>
           </section>