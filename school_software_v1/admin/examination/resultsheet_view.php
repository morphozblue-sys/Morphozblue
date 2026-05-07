<?php include("../attachment/session.php")?>
    <section class="content-header">
      <h1>
        Answersheet For Government
		    <small>Control Panel</small>
       
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('examination/examination')"><i class="fa fa-id-card-o"></i> <?php echo $language['Examination']; ?></a></li>
        <li class="active">Result sheet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
	  
	
    <div class="row">
	<?php


	$que="select * from school_info_class_info";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$class_name=$row['class_name']; 
	$class_code=$row['class_code']; 
	$class_name=strtolower($class_name);
	$serial_no++;
	
	if($serial_no=='1'){
	$color='E32636';
	}elseif($serial_no=='2'){
	$color='3B7A57';
	}elseif($serial_no=='3'){
	$color='9F2B68';
	}elseif($serial_no=='4'){
	$color='C46210';
	}elseif($serial_no=='5'){
	$color='3B3B6D';
	}elseif($serial_no=='6'){
	$color='FF7E00';
	}elseif($serial_no=='7'){
	$color='804040';
	}elseif($serial_no=='8'){
	$color='34B334';
	}elseif($serial_no=='9'){
	$color='551B8C';
	}elseif($serial_no=='10'){
	$color='915C83';
	}elseif($serial_no=='11'){
	$color='4B5320';
	}elseif($serial_no=='12'){
	$color='3B444B';
	}elseif($serial_no=='13'){
	$color='A2006D';
	}elseif($serial_no=='14'){
	$color='007FFF';
	}elseif($serial_no=='15'){
	$color='FF1493';
	}elseif($serial_no=='16'){
	$color='21ABCD';
	}elseif($serial_no=='17'){
	$color='E0218A';
	}elseif($serial_no=='18'){
	$color='7C0A02';
	}else{
	$color='E48400';
	}
	$que321="select * from school_info_pdf_info";
    $run321=mysqli_query($conn73,$que321);
    while($row321=mysqli_fetch_assoc($run321)){
	$result_sheet_pdf = $row321['result_sheet_pdf'];
     }
	$link=$pdf_path.'resultsheet_page/'.$result_sheet_pdf;
	if($class_name=='11th' || $class_name=='12th' ){
	$query11="select * from school_info_subject_info where class_code='$class_code'  and (session_value='$session1' || session_value='') $filter37 GROUP BY stream_code";
	}
	else
	{
	    $query11="select * from school_info_subject_info where class_code='$class_code'  and (session_value='$session1' || session_value='') $filter37 GROUP BY class";}
	$run11=mysqli_query($conn73,$query11);
	while($row11=mysqli_fetch_assoc($run11)){
	$stream_code= $row11['stream_code'];
	$group_name= $row11['group_name'];
	$stream_name= $row11['stream_name'];
	
	?>
	  <a target="_blank" href="<?php echo $link; ?>?class=<?php echo $class_name; ?>&session=<?php echo $session1; ?>&stream_code=<?php echo $stream_code; ?>&group_name=<?php echo $group_name;?>">
        <div class="col-md-3 col-md-6">
            <div class="small-box" style="background-color:#<?php echo $color; ?>;">
             <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:10px;color:#fff;">Resultsheet <?php echo $class_name; ?></h3>
              <p style="margin-left:10px;color:#fff;"><small style=color:white;><?php if($stream_name!='') { echo $stream_name.' ( '.$group_name.' )'; } else {  } ?></small></p>
 			<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter'];?></p>
             </div>
             <div class="icon">
              <i class="ion"><img src="<?php echo $school_software_path; ?>images/templates.png" style="width:65px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
             </div>
             <a target="_blank" href="<?php echo $link; ?>?class=<?php echo $class_name; ?>&session=<?php echo $session1; ?>&stream_code=<?php echo $stream_code; ?>&group_name=<?php echo $group_name;?>" class="small-box-footer"><?php echo $language['More info'];?><i class="fa fa-arrow-circle-right"></i>
	         </a>
            </div>
        </div>
	  </a>
	  <?php } } ?>
	  
			
    </div>
    </section>

