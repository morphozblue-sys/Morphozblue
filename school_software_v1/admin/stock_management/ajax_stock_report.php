<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Stock Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>
    <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php
			//$sales_type=$_GET['sales_type'];
			
			$order_by=$_GET['order_by'];
			
			$item_class=$_GET['item_class'];
			if($item_class!='All'){
				$condition1=" and new_stock_item.item_class='$item_class'";
			}else{
				$condition1="";
			}
			$item_category=$_GET['item_category'];
			if($item_category!='All'){
				$condition2=" and new_stock_item.item_category='$item_category'";
			}else{
				$condition2="";
			}
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			}
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>BOOKS STOCK REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td>Date : <?php echo date('d/m/Y'); ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			</table>
				<table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
				    <thead >
						<tr>
						  <th>S.No.</th>
						  <th>Item Name</th>
						  <th>Item Description</th>
						  <th>Item class</th>
						  <th>Opening Stock</th>
						  <th>Available Stock</th>
						</tr>
					</thead>
				    <tbody>
					<?php
					$que1="select new_stock_item.*, new_stock.opening_stock, new_stock.available_stock from new_stock_item join new_stock on new_stock_item.s_no=new_stock.item_s_no where new_stock_item.stock_item_status='Active'$condition1$condition2$order_by";
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					$serial_no=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$item_name=$row1['item_name'];    
					$item_description=$row1['item_description'];    
					$item_class=$row1['item_class'];
					$opening_stock=$row1['opening_stock'];
					$available_stock=$row1['available_stock'];
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $item_name; ?></td>
					<td><?php echo $item_description; ?></td>
					<td><?php echo $item_class; ?></td>
					<td><?php echo $opening_stock; ?></td>
					<td><?php echo $available_stock; ?></td>
					</tr>
					<?php }  ?>
					</tbody>
					<!--<tfoot>
					<tr>
					<td colspan="4"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					
					<td><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					</tr>
					</tfoot>-->
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Stock Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>