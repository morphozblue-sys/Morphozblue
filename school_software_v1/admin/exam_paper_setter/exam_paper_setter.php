<?php include("../attachment/session.php"); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Paper Setter']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li class="active"><?php echo $language['Exam Paper Setter']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	 <?php  if(!isset($_SESSION['sub_panel_add_question'])){ ?>
 <a href="javascript:get_content('exam_paper_setter/add_question')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;"><?php echo $language['Add Question']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('exam_paper_setter/add_question')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
			 <?php } if(!isset($_SESSION['sub_panel_view_question'])){ ?>
<a href="javascript:get_content('exam_paper_setter/view_question')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;"><?php echo $language['View Question']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('exam_paper_setter/view_question')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } if(!isset($_SESSION['sub_panel_instant_go_to_paper_setter'])){ ?>
		<a href="javascript:get_content('exam_paper_setter/instant_go_to_paper_setter')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B3B6D">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;"><?php echo $language['Instant Paper']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('exam_paper_setter/instant_go_to_paper_setter')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
			 <?php } if(!isset($_SESSION['sub_panel_go_to_paper_setter'])){ ?>
<a href="javascript:get_content('exam_paper_setter/go_to_paper_setter')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;"><?php echo $language['Set Paper']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('exam_paper_setter/go_to_paper_setter')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	 <?php } if(!isset($_SESSION['sub_panel_total_paper_list'])){ ?>
		<a href="javascript:get_content('exam_paper_setter/total_paper_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#C46210">
            <div class="inner"><br>
              <h3 style="font-size:22px;margin-left:10px;color:#fff;"><?php echo $language['Paper List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
           <a href="javascript:get_content('exam_paper_setter/total_paper_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } ?>
		
		
				
		
		
      </div>
      

    </section>
  