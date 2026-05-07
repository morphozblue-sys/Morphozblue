<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Homework Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
        <li class="active"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

<?php if(!isset($_SESSION['sub_panel_login_details'])){ ?>
   <a href="javascript:get_content('utility/login_details_traking')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;">Login Details</h3>
				<p style="margin-left:10px;color:#fff;">Traking</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('utility/login_details_traking')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_student_login'])){ if(false){ ?>	
    <a href="javascript:get_content('utility/student_login_details')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#9d669eeb;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;">Student Login </h3>
				<p style="margin-left:10px;color:#fff;">Details</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('utility/student_login_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } } if(!isset($_SESSION['sub_panel_teacher_login'])){  if(false){ ?>
		<a href="javascript:get_content('utility/teacher_login_details')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#52c0d0;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;">Teacher Login </h3>
				<p style="margin-left:10px;color:#fff;">Details</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('utility/teacher_login_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } } ?> 
		</div>
      </div>
    </section>

