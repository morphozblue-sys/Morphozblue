<?php include("../attachment/session.php")?>
 <script>
window.scrollTo(0, 0);
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Holiday Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-photo"></i> <?php echo $language['Holiday']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php if(!isset($_SESSION['sub_panel_add_holiday'])){ ?>
		<a href="javascript:get_content('holiday/add_holiday')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Add Holiday']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../<?php echo $school_software_path; ?>images/add_holiday.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('holiday/add_holiday')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 	<?php } if(!isset($_SESSION['sub_panel_holiday_list'])){ ?>
	    <a href="javascript:get_content('holiday/holiday_list')">
			<div class="col-lg-3 col-xs-6">
			  <div class="small-box" style="background-color:#3B7A57;">
				<div class="inner"><br>
				   <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Holiday List']; ?></h3>
					<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
				</div>
				<div class="icon">
				  <i class="ion"><img src="../<?php echo $school_software_path; ?>images/holiday_list.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
				</div>
				<a href="javascript:get_content('holiday/holiday_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
		</a>
	 	 <?php } ?>


		</div>
      </div>
	 
    </section>

