<?php include("../attachment/session.php");

$student_class = $_GET['student_class'];
if($student_class!=''){
    $condition1=" and new_stock_item.item_class='$student_class'";
}else{
    $condition1="";
}
?>
<div class="col-md-12">
<table class="table table-responsive">
<thead >
<tr>
<th colspan="4"><center><b>Class - <?php echo $student_class; ?></b></center></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2">

<table class="table table-responsive">
<thead >
<tr>
<th><input type="checkbox" name="" id="txt1" value="" class="" onclick="for_check(this.id);" checked /></th>
<th>Text Book</th>
<th>Rate</th>
</tr>
</thead>
<tbody>
<?php
  $query_v = "select new_stock_item.*, new_stock.sale_rate, new_stock.available_stock from new_stock_item JOIN new_stock ON new_stock_item.s_no=new_stock.item_s_no where new_stock_item.stock_item_status='Active'$condition1";
$reslt_v = mysqli_query($conn73,$query_v);
$text_book_total=0;
$s_no1=0;
$indexing=0;
while($row_v=mysqli_fetch_assoc($reslt_v)){
$item_s_no=$row_v['s_no'];
$item_name=$row_v['item_name'];
$item_description=$row_v['item_description'];
$item_class=$row_v['item_class'];
$category_s_no=$row_v['item_category'];
$available_stock=$row_v['available_stock'];
$sale_rate=$row_v['sale_rate'];
$text_book_total=$text_book_total+$sale_rate;
$s_no1++;
?>
<tr>
<td>
<input type="checkbox" name="index[]" id="<?php echo 'txt1_'.$s_no1; ?>" value="<?php echo $indexing; ?>" onclick="particular('txt_book_','<?php echo $s_no1; ?>','txt1','txt_');" <?php if($available_stock>=1){ ?> class="sale_items txt1" checked <?php }else{ ?> disabled <?php } ?> />
</td>
<td>
<input type="hidden" name="item_category[<?php echo $indexing; ?>]" id="" value="<?php echo $category_s_no; ?>" class="" style="" readonly />
<input type="hidden" name="item_name[<?php echo $indexing; ?>]" id="" value="<?php echo $item_s_no; ?>" class="" style="" readonly />
<?php echo $item_name; ?>
</td>
<td>
<input type="hidden" name="item_quantity[<?php echo $indexing; ?>]" id="<?php echo 'txt_quantity_'.$s_no1; ?>" value="1" oninput="for_amount('<?php echo $s_no1; ?>','txt_book_','txt_quantity_','txt_rate_');" <?php if($available_stock>=1){ ?> class="qty_txt1 tot_qty_txt1" <?php } ?> style="width:50px;" readonly />
<b>₹</b>&nbsp;<input type="text" name="item_rate[<?php echo $indexing; ?>]" id="<?php echo 'txt_rate_'.$s_no1; ?>" value="<?php echo $sale_rate; ?>" oninput="for_amount('<?php echo $s_no1; ?>','txt_book_','txt_quantity_','txt_rate_');" class="" style="width:50px;border:none;" />
<input type="hidden" name="item_total[<?php echo $indexing; ?>]" id="<?php echo 'txt_book_'.$s_no1; ?>" value="<?php echo 1*$sale_rate; ?>" <?php if($available_stock>=1){ ?> class="text_txt1 tot_txt1" <?php } ?> style="width:50px;border:none;" readonly />
</td>
</tr>
<?php $indexing++; } ?>
</tbody>
</table>

</td>
<td colspan="2">

<table class="table table-responsive">
<thead >
<tr>
<th><input type="checkbox" name="" id="stanry1" value="" class="" onclick="for_check(this.id);" checked /></th>
<th>Stationery/Notebook</th>
<th>Qty.</th>
<th>Rate</th>
<th>Amt.</th>
</tr>
</thead>
<tbody>
<?php
$query_v = "select new_stock_item.*, new_stock.sale_rate, new_stock.available_stock from new_stock_item JOIN new_stock ON new_stock_item.s_no=new_stock.item_s_no where new_stock_item.stock_item_status='Active' ";
$reslt_v = mysqli_query($conn73,$query_v);
$stationery_total=0;
$sno2=0;
while($row_v=mysqli_fetch_assoc($reslt_v)){
$item_s_no=$row_v['s_no'];
$item_name=$row_v['item_name'];
$item_description=$row_v['item_description'];
$item_class=$row_v['item_class'];
$category_s_no=$row_v['item_category'];
$available_stock=$row_v['available_stock'];
$sale_rate=$row_v['sale_rate'];
$stationery_total=$stationery_total+$sale_rate;
$sno2++;
?>
<tr>
<td>
<input type="checkbox" name="index[]" id="<?php echo 'stanry1_'.$sno2; ?>" value="<?php echo $indexing; ?>" onclick="particular('note_book_','<?php echo $sno2; ?>','stanry1','stnry_');" <?php if($available_stock>=1){ ?> class="sale_items stanry1" checked <?php }else{ ?> disabled <?php } ?> />
</td>
<td>
<input type="hidden" name="item_category[<?php echo $indexing; ?>]" id="" value="<?php echo $category_s_no; ?>" class="" style="" readonly />
<input type="hidden" name="item_name[<?php echo $indexing; ?>]" id="" value="<?php echo $item_s_no; ?>" class="" style="" readonly />
<?php echo $item_name; ?>
</td>
<td>
<input type="text" name="item_quantity[<?php echo $indexing; ?>]" id="<?php echo 'stnry_quantity_'.$sno2; ?>" value="1" oninput="for_amount('<?php echo $sno2; ?>','note_book_','stnry_quantity_','stnry_rate_');" <?php if($available_stock>=1){ ?> class="qty_stanry1 tot_qty_stanry1" <?php } ?> style="width:50px;" />
</td>
<td>
<b>₹</b>&nbsp;<input type="text" name="item_rate[<?php echo $indexing; ?>]" id="<?php echo 'stnry_rate_'.$sno2; ?>" value="<?php echo $sale_rate; ?>" oninput="for_amount('<?php echo $sno2; ?>','note_book_','stnry_quantity_','stnry_rate_');" class="" style="width:50px;border:none;" />
</td>
<td>
<b>₹</b>&nbsp;<input type="text" name="item_total[<?php echo $indexing; ?>]" id="<?php echo 'note_book_'.$sno2; ?>" value="<?php echo 1*$sale_rate; ?>" <?php if($available_stock>=1){ ?> class="text_stanry1 tot_stanry1" <?php } ?> style="width:50px;border:none;" readonly />
</td>
</tr>
<?php $indexing++; } ?>
</tbody>
</table>

</td>
</tr>
</tbody>
<tfoot>
<tr style="display:none;">
<td colspan="4">
<input type="text" name="grand_total_quantity" id="grand_total_quantity" value="" class="" />
<input type="text" name="item_grand_total" id="item_grand_total" value="" class="" />
</td>
</tr>
<tr>
<td><center><b>Text Books Total</b></center></td>
<td><b>₹</b>&nbsp;<input type="text" name="" id="total_txt1" value="<?php echo $text_book_total; ?>" class="" style="width:80px;border:none;font-weight:bold;" readonly /></td>

<td><center><b>Stationery Total</b></center></td>
<td><b>₹</b>&nbsp;<input type="text" name="" id="total_stanry1" value="<?php echo $stationery_total; ?>" class="" style="width:80px;border:none;font-weight:bold;" readonly /></td>
</tr>
</tfoot>
</table>
</div>