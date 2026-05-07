<?php include("../attachment/session.php"); ?>
  <script>
window.scrollTo(0, 0);
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Fees Dues Management']; ?>
		    <small><?php echo $language['Control Panel']; ?></small>
       
      </h1>
      <ol class="breadcrumb">
  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $language['Dues Details']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  $que="select * from school_info_class_info";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$class_name=$row['class_name'];
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
	
	if($class_name!='11TH' && $class_name!='12TH'){
	?>
	
	  <a href="javascript:post_content('dues/class_wise_dues_details','class_name=<?php echo $class_name; ?>')">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box" style="background-color:#<?php echo $color; ?>;">
             <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:10px;color:#fff;"><?php echo $language['Dues']." " .$class_name; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter'];?></p>
             </div>
           
             <a href="javascript:post_content('dues/class_wise_dues_details','class_name=<?php echo $class_name; ?>')" class="small-box-footer"><?php echo $language['More info'];?><i class="fa fa-arrow-circle-right"></i>
	         </a>
            </div>
        </div>
	  </a>
	  <?php }else{
	  $que1="select * from school_info_stream_info where stream_name!=''";
	  $run1=mysqli_query($conn73,$que1);
	  while($row1=mysqli_fetch_assoc($run1)){
	  $stream_name=$row1['stream_name'];
	  ?>
	  <a href="javascript:post_content('dues/class_wise_dues_details','class_name=<?php echo $class_name; ?>&stream_name=<?php echo $stream_name; ?>')">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box" style="background-color:#<?php echo $color; ?>;">
             <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:10px;color:#fff;"><?php echo $language['Dues']." " .$class_name." ".$stream_name; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter'];?></p>
             </div>
                <a href="javascript:post_content('dues/class_wise_dues_details','class_name=<?php echo $class_name; ?>&stream_name=<?php echo $stream_name; ?>')" class="small-box-footer"><?php echo $language['More info'];?><i class="fa fa-arrow-circle-right"></i>
	         </a>
            </div>
        </div>
	  </a>
	  <?php } } } ?>


		</div>
      </div>

    </section>