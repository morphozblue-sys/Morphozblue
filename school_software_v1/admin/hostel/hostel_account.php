<?php include("../attachment/session.php"); ?>
     <section class="content-header">
      <h1>
               <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Account']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<a href="javascript:get_content('hostel/hostel_expenses')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#4B5320;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"> <?php echo $language['Expenses']; ?></h3>
				<p style="margin-left:10px;color:#fff;"> <?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="<?php echo $school_software_path; ?>images/stock.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_expenses')" class="small-box-footer"> <?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('hostel/account_collection')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#C39953;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"> <?php echo $language['Fee Collection']; ?></h3>
				<p style="margin-left:10px;color:#fff;"> <?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="<?php echo $school_software_path; ?>images/stock.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('hostel/account_collection')" class="small-box-footer"> <?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>


		</div>
      </div>
	  
    </section>