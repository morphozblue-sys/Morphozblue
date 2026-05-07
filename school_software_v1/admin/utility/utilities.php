<?php include("../attachment/session.php"); ?>
<script>
window.scrollTo(0, 0);
</script>
 <section class="content-header">
      <h1>
        Utilities Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li class="active">Utilities</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['sub_panel_hindi_type'])){ ?>
 	 <a href="javascript:get_content('utility/hindi_type')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Hindi Typing']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('utility/hindi_type')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		   			 	<?php } if(!isset($_SESSION['sub_panel_editor1'])){ ?>
 	<a href="javascript:get_content('utility/editor')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Editor']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('utility/editor')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		   			 	<?php }  ?>


		</div>
      </div>
	
    </section>