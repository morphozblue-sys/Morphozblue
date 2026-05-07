<?php include("../attachment/session.php"); ?>
 <script>
window.scrollTo(0, 0);
</script>
<?php
$que="select * from school_info_general";
$run=mysqli_query($conn73,$que);
while($row7=mysqli_fetch_array($run)){

	$_SESSION['school_info_school_board'] = $row7['school_info_school_board'];
	if($_SESSION['school_info_school_board']!='Both'){
                      if($_SESSION['school_info_school_board']!='CBSE Board'){
                     $_SESSION['board_change']='State Board';
                      }else{
                           $_SESSION['board_change']='CBSE Board';
                      }
                 }else{
                     if(!isset($_SESSION['board_change']) or ($_SESSION['board_change']=='Both')){
                         $_SESSION['board_change']='State Board';
                     }
                 }
}
                 ?>
  <section class="content-header">
      <h1>
        <?php echo $language['Examination Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active"><?php echo $language['Examination']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">
      
		<?php if($_SESSION['board_change']=='MP Board' || $_SESSION['board_change']=='State Board'|| $_SESSION['board_change']=='Bihar Board' || $_SESSION['board_change']=='Rajsthan Board' || $_SESSION['board_change']=='UP Board' || $_SESSION['board_change']=='CG Board'){ ?>
		<?php  if(!isset($_SESSION['sub_panel_admit_card'])){ ?>
       <a href="javascript:get_content('examination/admit_card')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;"><?php echo $language['Admit Card']; ?></h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
             <a href="javascript:get_content('examination/admit_card')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>

				<?php if(false){ ?>
		<a href="javascript:get_content('examination/admit_card_syllabus')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#302636;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Ad. Card Syllabus</h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
             <a href="javascript:get_content('examination/admit_card_syllabus')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		
		<?php } if(!isset($_SESSION['sub_panel_admit_card_print'])){ ?>
       <a href="javascript:get_content('examination/admit_card_print')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:15px;color:#fff;"><?php echo $language['Print Admit Card']; ?></h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
            <a href="javascript:get_content('examination/admit_card_print')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
			<?php } }if($_SESSION['board_change']=='CBSE Board'){ ?>
			 <?php  if(!isset($_SESSION['sub_panel_admit_card'])){ ?>
				 <a href="javascript:get_content('examination/admit_card_cbse')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;"><?php echo $language['Admit Card']; ?></h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
               <a href="javascript:get_content('examination/admit_card')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php if(false){ ?>
		<a href="javascript:get_content('examination/admit_card_cbse_syllabus')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#302636;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Ad. Card Syllabus</h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
              <a href="javascript:get_content('examination/admit_card_cbse_syllabus')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		 <?php } } if(!isset($_SESSION['sub_panel_admit_card_print'])){ ?>
		 <a href="javascript:get_content('examination/admit_card_print_cbse')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:15px;color:#fff;"><?php echo $language['Print Admit Card']; ?></h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
             <a href="javascript:get_content('examination/admit_card_print')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
			<?php } }if($_SESSION['board_change']=='MP Board'  || $_SESSION['board_change']=='State Board'|| $_SESSION['board_change']=='Bihar Board' || $_SESSION['board_change']=='Rajsthan Board' || $_SESSION['board_change']=='UP Board' || $_SESSION['board_change']=='CG Board'){ ?>
			
	<?php if($_SESSION['software_link']!="eps"){ ?>
	  <a href="javascript:get_content('examination/marksheet_fill')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;"><?php echo $language['Fill Marksheet']; ?></h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
               <a href="javascript:get_content('examination/marksheet_fill')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		 <a href="javascript:get_content('examination/marksheet_fill_examwise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5F5E61;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Fill Marksheet</h3>
				<p style="margin-left:10px;color:#fff;">State Board Examwise</p>
            </div>
               <a href="javascript:get_content('examination/marksheet_fill_examwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }else{ ?>
		
			 <a href="javascript:get_content('examination/marksheet_fill_with_subject_category')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5F5E61;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Fill Marksheet</h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
               <a href="javascript:get_content('examination/marksheet_fill_with_subject_category')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		
		
		
		<a href="javascript:get_content('examination/marksheet_view')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;"><?php echo $language['View Marksheet']; ?></h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
              <a href="javascript:get_content('examination/marksheet_view')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
			<?php  } if($_SESSION['board_change']=='CBSE Board'){ ?>
			 
			  <a href="javascript:get_content('examination/marksheet_fill_cbse')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;"><?php echo $language['Fill Marksheet']; ?></h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
              <a href="javascript:get_content('examination/marksheet_fill_cbse')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php //if($_SESSION['software_link']=='sadalpuracademydhar' || $_SESSION['software_link']=='stteresakpl' || $_SESSION['software_link']=='parasschoolkudra'){ ?>
		<a href="javascript:get_content('examination/marksheet_fill_cbse_examwise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5F5E61;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;"><?php echo $language['Fill Marksheet']; ?></h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board Examwise</p>
            </div>
            <a href="javascript:get_content('examination/marksheet_fill_cbse_examwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		 <?php //} ?>
		<a href="javascript:get_content('examination/marksheet_view_cbse')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;"><?php echo $language['View Marksheet']; ?></h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
             <a href="javascript:get_content('examination/marksheet_view_cbse')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php }  if(!isset($_SESSION['sub_panel_marksheet_fill_monthly'])){ ?>
		
			  <a href="javascript:get_content('examination/marksheet_fill_monthly')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#002B68;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Monthly Test</h3>
				<p style="margin-left:10px;color:#fff;">Fill Marks</p>
            </div>
            <a href="javascript:get_content('examination/marksheet_fill_monthly')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		<a href="javascript:get_content('examination/marksheet_fill_monthly_examwise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#6B5C83;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Monthly Test</h3>
				<p style="margin-left:10px;color:#fff;">Fill Marks Examwise</p>
            </div>
            <a href="javascript:get_content('examination/marksheet_fill_monthly_examwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php } if(!isset($_SESSION['sub_panel_marksheet_view_monthly'])){ ?>
		<a href="javascript:get_content('examination/marksheet_view_monthly')">
        <div class="col-md-3 col-md-6" >
          <div class="small-box" style="background-color:#C462FD;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">Monthly Test</h3>
				<p style="margin-left:10px;color:#fff;">View Marks</p>
            </div>
             <a href="javascript:get_content('examination/marksheet_view_monthly')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		 <?php }  ?>
	 	
		<?php if(false){ ?>
		<a href="javascript:get_content('examination/add_weekly_test')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#002B68;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Add Weekly Test</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
             <a href="javascript:get_content('examination/add_weekly_test')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('examination/view_weekly_test')">
        <div class="col-md-3 col-md-6" >
          <div class="small-box" style="background-color:#C462FD;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">View Weekly Test</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
               <a href="javascript:get_content('examination/view_weekly_test')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('examination/add_weekly_test_marks')">
        <div class="col-md-3 col-md-6" >
          <div class="small-box" style="background-color:#6A4139;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">Add Weekly Test Marks</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
              <a href="javascript:get_content('examination/add_weekly_test_marks')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  ?>
        <a href="javascript:get_content('examination/exam_marksh_filing_sheet')">
         <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#D52210;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">Exam Marks Filing Sheet</h3>
				<p style="margin-left:10px;color:#fff;">Classwise</p>
            </div>
             <a href="javascript:get_content('examination/exam_marksh_filing_sheet')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
         </div>
		</a>
		
		</div>
      </div>
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">
        <?php  if(!isset($_SESSION['exam_sub_panel_view_resultsheet'])){ ?>
		<a href="javascript:get_content('examination/resultsheet_view')">
         <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">View Result Sheet</h3>
				<p style="margin-left:10px;color:#fff;">Classwise</p>
            </div>
             <a href="javascript:get_content('examination/resultsheet_view')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
         </div>
		</a>
		
			<a href="javascript:get_content('examination/resultsheet_view_sectionwise')">
         <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#800080;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:5px;color:#fff;">View Result Sheet</h3>
				<p style="margin-left:10px;color:#fff;">Classwise/Sectionwise</p>
            </div>
             <a href="javascript:get_content('examination/resultsheet_view_sectionwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
         </div>
		</a>
		
		<?php } if($_SESSION['board_change']=='CBSE Board'){ ?>
		 <?php if(!isset($_SESSION['exam_sub_panel_download_marks'])){ ?>
				  <a href="javascript:get_content('examination/marks_download_cbse')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#23FB68;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Download Marks</h3>
				<p style="margin-left:10px;color:#fff;">CBSE Board</p>
            </div>
              <a href="javascript:get_content('examination/marks_download_cbse')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php } } ?>
				<?php if($_SESSION['board_change']=='MP Board' || $_SESSION['board_change']=='State Board'|| $_SESSION['board_change']=='Bihar Board' || $_SESSION['board_change']=='Rajsthan Board' || $_SESSION['board_change']=='UP Board' || $_SESSION['board_change']=='CG Board'){ ?>
			 		 <?php if(!isset($_SESSION['exam_sub_panel_download_marks'])){ ?>
				  <a href="javascript:get_content('examination/marks_download_state_board')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#232BB8;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Download Marks</h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
            <a href="javascript:get_content('examination/marks_download_state_board')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php }  ?>
		 
		 
		 
		 <?php if(!isset($_SESSION['exam_sub_panel_download_marks'])){ ?>
	
		<?php if($_SESSION['board_change']=='CBSE Board'){ ?>
		<a href="javascript:get_content('examination/marks_download_cbse_board_monthly')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#898A80;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Download Marks</h3>
				<p style="margin-left:10px;color:#fff;">Monthly CBSE Board</p>
            </div>
           <a href="javascript:get_content('examination/marks_download_cbse_board_monthly')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php } } } ?>
		 <?php if(!isset($_SESSION['sxam_sub_panel_send_marks'])) { if(false){?>
		<a href="javascript:get_content('examination/send_marks_sms_state_board_examwise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#443303;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Send Marks SMS</h3>
				<p style="margin-left:10px;color:#fff;">State Board</p>
            </div>
            <a href="javascript:get_content('examination/send_marks_sms_state_board_examwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 <?php } } ?>
		 	<a href="javascript:get_content('examination/marks_download_state_board_monthly')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#443303;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Download Marks</h3>
				<p style="margin-left:10px;color:#fff;">Monthly</p>
            </div>
            <a href="javascript:get_content('examination/marks_download_state_board_monthly')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('examination/marks_download_state_board_monthly_subjectwise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#44AA03;">
            <div class="inner"><br>
              <h3 style="font-size:19px;margin-left:10px;color:#fff;">Download Marks Subjectwise</h3>
				<p style="margin-left:10px;color:#fff;">Monthly</p>
            </div>
             <a href="javascript:get_content('examination/marks_download_state_board_monthly_subjectwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
		
		</div>
	  </div>
	 
    </section>

