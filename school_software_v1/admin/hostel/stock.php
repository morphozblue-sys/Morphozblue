<?php include("../attachment/session.php")?>

<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>
  
</head>

<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>

<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

<div class="content-wrapper">

     <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="Active">Stock</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	 <a href="buy_item.php">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"><?php echo $language['Purchase Item']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../../images/student.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="admin/stock/buy_item.php"" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="purchase_list.php">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#4B5320;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"><?php echo $language['Purchase List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../../images/stock.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="admin/stock/purchase_list.php" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		
      </div>

    </section>

  </div>

 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php");?>
 </div>
<?php include("../attachment/link_js.php")?>

</body>
</html>
