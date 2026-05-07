<?php include("../attachment/session.php"); ?>
  <script>
window.scrollTo(0, 0);
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Reminder Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
                  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-history"></i> <?php echo $language['Reminder']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['sub_panel_reminder_add'])){ ?>
  
		<a href="javascript:get_content('reminder/reminder_add')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Add Reminder']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('reminder/reminder_add')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['sub_panel_reminder_list'])){ ?>
  <a href="javascript:get_content('reminder/reminder_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Reminder List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('reminder/reminder_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     		<?php } if(!isset($_SESSION['sub_panel_reminder_teacher_add'])){ ?>
    <a href="javascript:get_content('reminder/reminder_teacher_add')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:2px;color:#fff;"><?php echo 'ClassWork Plan'; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('reminder/reminder_teacher_add')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
      		<?php } if(!isset($_SESSION['sub_panel_reminder_teacher_list'])){ ?>
   <a href="javascript:get_content('reminder/reminder_teacher_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:	#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo 'ClassWork Plan List'; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('reminder/reminder_teacher_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
				<?php } ?>


		</div>
      </div>
		
		</div>
	  </div>
    </section>