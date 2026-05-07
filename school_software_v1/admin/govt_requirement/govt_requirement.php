<?php include("../attachment/session.php"); ?>
<script>
window.scrollTo(0, 0);
</script>
      <section class="content-header">
      <h1>
        <?php echo $language['Goverment Requirement Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active"><?php echo $language['Govt. Requir.']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['sub_panel_mapping_list'])){ ?>
   <a href="javascript:get_content('govt_requirement/mapping_list')">
						<div class="col-md-3 col-md-6">
						  <div class="small-box" style="background-color:#E32636;">
							<div class="inner"><br>
							   <h3 style="font-size:20px;margin-left:5px;color:#fff;">Mapping List</h3>
								<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
							</div>
							<div class="icon">
							  <i class="ion"></i>
							</div>
							<a href="javascript:get_content('govt_requirement/mapping_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
		            </a>
			 <?php } if(!isset($_SESSION['sub_panel_student_list'])){ ?>

		<a href="javascript:get_content('govt_requirement/student_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Student List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('govt_requirement/student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } if(!isset($_SESSION['sub_panel_student_contact_list'])){ ?>
		 <a href="javascript:get_content('govt_requirement/student_contact_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Contact No']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('govt_requirement/student_contact_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } ?>


		</div>
      </div>
	
		
		</div>
	  </div>
    </section>