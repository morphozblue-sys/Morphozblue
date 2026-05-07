<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>

  <?php include("../attachment/link_css.php")?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
	
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

           google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad(){

        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['hi'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = ["question_box"];
        transliterationControl.makeTransliteratable(ids);
       
      }

      google.setOnLoadCallback(onLoad);
	  
	  	function hindi_typing(){
    $("#question_box").show();
    $("#suggestion").show();
     $("#question_box").focus();

}
	  function get_text_question() 
            {
			var x1=document.getElementById("question_box").value;
			var x2=document.getElementById("count_value").value;
			var res=x1.split(" ");
			var count=res.length;
			var count1=count-3;
			if(parseInt(count)>parseInt(x2))
			{
			
		
		    var desc = CKEDITOR.instances.editor1.getData();
			var res2 = desc.replace("<p>", "");
			var res3 = res2.replace("</p>", "");
			if(count1<0){
			}else{
			 var res4=res3+res[count1];
			 CKEDITOR.instances.editor1.setData(res4);
			 }
		
			 
			}
				 document.getElementById("count_value").value=count;
	}
   function for_section(value){
            var id=value;  
       $.ajax({
			  type: "POST",
              url: "ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                   // alert_new(str);
                  $("#student_class_section").html(str);
              }
           });

    }
</script>
<script src="class_section.js"></script>
<script type="text/javascript">
  $(function(){
            var id=document.getElementById('homework_class').value;	
       $.ajax({
			  type: "POST",
              url: "ajax_class_section.php?class_name="+id+"",
              cache: false,
              success: function(detail){
                   //var str =detail;                
                   // alert_new(str);
                  $("#student_class_section").html(detail);
              }
           });

    });
</script>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?> 
  <?php include("../attachment/sidebar.php")?>

  
  
  

  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $language['Homework Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="homework.php"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Add Homework']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Homework Form']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
              <div class="box-body "  >
			  <form role="form" method="post" enctype="multipart/form-data" >
			
			  <div class="col-md-8">
              <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><b><?php echo $language['Write Homework Here']; ?><font style="color:red"><b>*</b></font></b>
              </h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              			  
			
			  <h4><?php echo $language['Write Hindi']; ?></h4>
			  <input type="button"  class="btn btn-success" value="<?php echo $language['click']; ?>" onclick="hindi_typing();">
			  <h5 style="display:none" id="suggestion">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h5>
			 <input type="hidden" id="count_value" value="1" ></input>
             <input type="text" id="question_box" rows="2" onKeyUp="get_text_question()" name="content" class="form-control" style="display:none">
			
                    <textarea id="editor1" name="homework" class="form-control bordder-color" placeholder="write homework" rows="10" cols="80" required></textarea>
               
               </div>
               </div>
               <!-- /.box -->
               </div>
			   <div class="col-md-4 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select name="homework_class" onchange="for_section(this.value);" id="homework_class" class="form-control" required>
						<option value="">Select</option>
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
				<div class="col-md-4 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="homework_section" id="student_class_section">
						
					    </select>
					</div>
				</div>
	         <div class="col-md-4 ">	
				<div class="form-group" >
				<label><?php echo $language['Date']; ?><font style="color:red"><b>*</b></font></label>
			    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="homework_date" id="myLocalDate"  placeholder="Date"  value="" class="form-control" required>
				 </div>
			  </div>
			  <div class="col-md-4 ">		
				<div class="form-group">
				<label><?php echo $language['Remark']; ?></label>
				<input type="text" name="homework_remark" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" required>
				</div>
			  </div>
			  
			  
			  <div class="col-md-4 ">		
				<div class="form-group">
				<label>Homework PDF</label>
				<input type="file" name="file[]" multiple="" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control" required>
				</div>
			  </div>
			  
	       <div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		  </div>
		  </form>
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
<?php
include("../../con73/con37.php");


	if(isset($_POST['submit'])){
	
	echo "<script>document.getElementById('submit').disabled = true</script>"; 
	$homework_date_1 = $_POST['homework_date'];
	$homework_date_2 = explode("-",$homework_date_1);
	$homework_date=$homework_date_2[2]."-".$homework_date_2[1]."-".$homework_date_2[0];
	$homework_class = $_POST['homework_class'];
	$homework_section = $_POST['homework_section'];
	$homework = $_POST['homework'];
	$homework_remark = $_POST['homework_remark'];
	$img_name=$_FILES['file']['name'];
	   $img=count($img_name);
	

		
	for($i=0; $i<$img; $i++){
	$img_name=$_FILES['file']['name'][$i];
	$file_tmp =$_FILES['file']['tmp_name'][$i];
	
	 move_uploaded_file($file_tmp,"../../documents/student_homework_pdf/".$img_name);
	 
	 
	$quer="insert into homework_student(homework_date,homework_class,homework_section,homework,homework_remark,	session_value,image_name,$update_by_insert_sql_column)
    values('$homework_date','$homework_class','$homework_section','$homework','$homework_remark','$session1','$img_name[$i]',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer);
 }
 

}

	?>

	
	
	
	
	
	