<?php include("../attachment/session.php"); ?>

<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"stock/category_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                ////alert_new(detail);
                //$('#trial_detail').html(detail);
              var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Complete','green');
				  get_content('stock/category_list');
            }
			}
         });
      });
</script>


   <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Edit Category</li>
        </ol>
    </section>

<?php
$s_no1=$_GET['id'];
$que="select * from stock_category where category_status='Active' and s_no='$s_no1'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

$s_no=$row['s_no'];
$category_name=$row['category_name'];
}
?>	
	
	<!---*******************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b>Edit New Category</b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
            <div class="box-body">
				<div class="col-md-12">
                
				<div class="form-group">
                  <label >Category Name <span style="color:red;">*</span></label>
                  <input type="text" name="category_name" placeholder="Category Name" value="<?php echo $category_name; ?>" id="" class="form-control" required />
                  <input type="hidden" name="category_s_no" value="<?php echo $s_no; ?>" class="form-control" />
                </div>
				
				</div>
		<div class="col-md-12">
		        <center>
		        <input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" />
		        </center>
		</div>
          
		  </div>
		  </form>
    </div>
</section>
