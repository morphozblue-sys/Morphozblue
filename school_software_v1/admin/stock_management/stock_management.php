<?php include("../attachment/session.php"); ?>
  <script>
window.scrollTo(0, 0);
</script>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
                 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['stock_mgt_sub_panel_add_vandor'])){ ?>
		<a href="javascript:get_content('stock_management/add_vendor')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#1E3C7D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Vendor</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_vendor')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	   <?php  } if(!isset($_SESSION['stock_mgt_sub_panel_vandor_list'])){ ?>
		<a href="javascript:get_content('stock_management/vendor_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#4E155C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Vendor List</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/vendor_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php  } if(!isset($_SESSION['stock_mgt_sub_panel_add_category'])){ ?>
		<a href="javascript:get_content('stock_management/add_customer')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#757522;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Customer</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_customer')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php  } if(!isset($_SESSION['stock_mgt_sub_panel_category_list'])){ ?>
		<a href="javascript:get_content('stock_management/customer_list')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#85501B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Customer List</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/customer_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php  } if(!isset($_SESSION['stock_mgt_sub_panel_add_category'])){ ?>
		<a href="javascript:get_content('stock_management/category_add')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#87A518;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Category</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/category_add')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_category_list'])){ ?>
		<a href="javascript:get_content('stock_management/category_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#053332;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Category List</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/category_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>		 


		</div>
      </div>
	  
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel For Books</b></h3>
		</div>
		<div class="box-body">

		<?php if(!isset($_SESSION['stock_mgt_sub_panel_add_book_item'])){ ?>
        <a href="javascript:get_content('stock_management/add_stock_item')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_stock_item')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_list_book_item'])){ ?>			 	
 	 <a href="javascript:get_content('stock_management/stock_item_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#42EA21;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Item List</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_item_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     <?php }  if(!isset($_SESSION['stock_mgt_sub_panel_buy_book_item'])){ ?>
        <a href="javascript:get_content('stock_management/add_buy_item')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_buy_item')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_buy_book_item_list'])){ ?>		
		<a href="javascript:get_content('stock_management/buy_item_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5B5952;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Item List</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/buy_item_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_buy_book_cancle_list'])){ ?>	
		<a href="javascript:get_content('stock_management/buy_item_cancelled_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#1C238D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Cancel List</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/buy_item_cancelled_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_book_add_in_stock'])){ ?>
		<a href="javascript:get_content('stock_management/purchase_item_add_in_stock')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#0DAF9B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add In Stock</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/purchase_item_add_in_stock')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_book_sale_item'])){ ?>		 	
			 	
        <a href="javascript:get_content('stock_management/add_sale_item')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_sale_item')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_book_sale_item'])){ ?>	
		<a href="javascript:get_content('stock_management/add_sale_item_through_checked')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_sale_item_through_checked')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_book_sale_item_list'])){ ?>		 	
        <a href="javascript:get_content('stock_management/sale_item_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Sale List']; ?></h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_item_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }  if(!isset($_SESSION['stock_mgt_sub_panel_book_sale_cancle_list'])){ ?>
		<a href="javascript:get_content('stock_management/sale_item_cancelled_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#190521;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Cancel List</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_item_cancelled_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		<a href="javascript:get_content('stock_management/add_opening_balance')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#6C4181;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Opening</h3>
				<p style="margin-left:10px;color:#fff;">Balance</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_opening_balance')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php   if(!isset($_SESSION['stock_mgt_sub_panel_book_stock_return'])){ ?>
		<a href="javascript:get_content('stock_management/stock_return')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#327980;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Stock Return</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_return')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php  } if(!isset($_SESSION['stock_mgt_sub_panel_book_stock_return_list'])){ ?>
		<a href="javascript:get_content('stock_management/stock_return_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#142440;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Stock Return List</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_return_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php  } ?>
		<a href="javascript:get_content('stock_management/add_sale_item_new')">
        <div class="col-md-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Item New</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_sale_item_new')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
				 


		</div>
      </div>
      
      <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel For Uniform</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['stock_mgt_sub_panel_add_item_uniform'])){ ?>
		<a href="javascript:get_content('stock_management/add_stock_item_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_stock_item_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_list_item_uniform'])){ ?>
		<a href="javascript:get_content('stock_management/stock_item_list_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#42EA21;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Item List</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_item_list_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_uniform_buy_item'])){ ?>
		<a href="javascript:get_content('stock_management/add_buy_item_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_buy_item_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_uniform_buy_item_list'])){ ?>  
		<a href="javascript:get_content('stock_management/buy_item_list_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5B5952;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Item List</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/buy_item_list_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	    <?php } if(!isset($_SESSION['stock_mgt_sub_panel_buy_cancel_list'])){  ?>
		<a href="javascript:get_content('stock_management/buy_item_cancelled_list_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#1C238D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Buy Cancel List</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/buy_item_cancelled_list_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_add_in_stock'])){  ?>
		<a href="javascript:get_content('stock_management/purchase_item_add_in_stock_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#0DAF9B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add In Stock</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/purchase_item_add_in_stock_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_sale_item_uniform'])){  ?>
		<a href="javascript:get_content('stock_management/add_sale_item_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Item</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_sale_item_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_uniform_sale_list'])){  ?>
		<a href="javascript:get_content('stock_management/sale_item_list_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Sale List']; ?></h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_item_list_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_uniform_sale_cancel_list'])){  ?>
		<a href="javascript:get_content('stock_management/sale_item_cancelled_list_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#190521;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Cancel List</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_item_cancelled_list_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['stock_mgt_sub_panel_uniform_add_opening'])){  ?>
		<a href="javascript:get_content('stock_management/add_opening_balance')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#6C4181;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Opening</h3>
				<p style="margin-left:10px;color:#fff;">Balance</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/add_opening_balance')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?> 			 


		</div>
      </div>
      
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">
		<?php if(!isset($_SESSION['stock_mgt_reports'])){  ?>     
        <a href="javascript:get_content('stock_management/stock_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#7C8114;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Stock Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/stock_report_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#7C8114;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Stock Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_report_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
        
        <a href="javascript:get_content('stock_management/sale_reports')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_reports')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/sale_reports_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Sale Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/sale_reports_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/Purchase_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#1E3C7D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Purchase Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/Purchase_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/Purchase_report_uniform')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#1E3C7D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Purchase Report</h3>
				<p style="margin-left:10px;color:#fff;">(For Uniform)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/Purchase_report_uniform')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/stock_return_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#554817;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Stock Return</h3>
				<p style="margin-left:10px;color:#fff;">(Report For Books)</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/stock_return_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('stock_management/ledger_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#327980;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Ledger Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('stock_management/ledger_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		</div>
	  </div>
	
    </section>