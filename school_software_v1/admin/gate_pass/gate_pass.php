<?php include("../attachment/session.php")?>
 <script>
window.scrollTo(0, 0);
</script>
			<section class="content-header">
				<h1>
					Gate Pass
					<small><?php echo $language['Control Panel']; ?></small>
				</h1>
				<ol class="breadcrumb">
				  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
					 <li class="active">Gate Pass</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- Small boxes (Stat box) -->
				<div class="row">
                <?php  if(!isset($_SESSION['gatepass_sub_panel_add_new'])){ ?> 
					<a href="javascript:get_content('gate_pass/new_gate_pass')">
					<div class="col-lg-3 col-xs-6">
						<div class="small-box" style="background-color:#E32636;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">New Gate Pass</h3>
								<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
							</div>
							<div class="icon">
								<i class="ion"></i>
							</div>
							<a href="javascript:get_content('gate_pass/new_gate_pass')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
                <?php } if(!isset($_SESSION['gatepass_sub_panel_gatepass_list'])){ ?>
					<a href="javascript:get_content('gate_pass/gate_pass_list')">
					<div class="col-lg-3 col-xs-6">
						<div class="small-box" style="background-color:#3B7A57;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Gate Pass List</h3>
								<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
							</div>
							<div class="icon">
								<i class="ion"></i>
							</div>
							<a href="javascript:get_content('gate_pass/gate_pass_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
				<?php } ?>	
					
				</div>
      

			</section>
		