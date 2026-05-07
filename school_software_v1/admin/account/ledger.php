<?php include("../attachment/session.php")?>


    <?php 
    $today=date('Y-m-d');
    $current_month2=date('m');
	$current_year=date('Y');
	$current_date=date('d');
	?>

<script type="text/javascript">
      function for_income_ledger(id){
	  $('#my_table1').html(loader_div);
	  if(id=="date_wise"){
	  var from_date= document.getElementById('from_date').value;
	  var to_date= document.getElementById('to_date').value;

	  }
	  	  if(id=="month_wise"){
	  var current_month= document.getElementById('ledger_month_wise').value;
	  var current_year= document.getElementById('ledger_year_wise').value;

	  if(current_month=="01" || current_month=="03" || current_month=="05" || current_month=="07" || current_month=="08" || current_month=="10" ||current_month=="12"){
	  var last_day="31";
	  }else if(current_month=="04" || current_month=="06" || current_month=="09" || current_month=="11"){
	  var last_day="30";
	  }else if(current_month=="02"){
	  	  var last_day="28";
	  if(current_year=="2020" || current_year=="2024" || current_year=="2028" || current_year=="2032" || current_year=="2036"){
	  var last_day="29";
	  }
	  }
	  var from_date=current_year+'-'+current_month+'-01';
      var to_date=current_year+'-'+current_month+'-'+last_day;
	  }
             $.ajax({
			  type: "POST",
              url: access_link+"account/ajax_income_ledger_details.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table1').html(detail);
              }
           });
		   for_total_income_expence_info(from_date,to_date);
            }
      function for_total_income_expence_info(from_date,to_date){
		     $("#expence_total_amount").val("Loading....");
		     $("#grand_total").val("Loading....");
		     $("#income_total_amount").val("Loading....");
             $.ajax({
			  type: "POST",
              url: access_link+"account/ajax_total_income_expence_info.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
     			  var str =detail;
		      var res = str.split("||");
		      $("#expence_total_amount").val(res[1]);
			  $("#grand_total").val(res[2]);
			  $("#income_total_amount").val(res[3]);
              }
           });
            }
      function for_expence_ledger(id){ 
	  $('#my_table2').html(loader_div);
			  if(id=="date_wise"){
	  var from_date= document.getElementById('from_date').value;
	  var to_date= document.getElementById('to_date').value;

	  }
	  	  if(id=="month_wise"){
	  var current_month= document.getElementById('ledger_month_wise').value;
	  var current_year= document.getElementById('ledger_year_wise').value;

	  if(current_month=="01" || current_month=="03" || current_month=="05" || current_month=="07" || current_month=="08" || current_month=="10" ||current_month=="12"){
	  var last_day="31";
	  }else if(current_month=="04" || current_month=="06" || current_month=="09" || current_month=="11"){
	  var last_day="30";
	  }else if(current_month=="02"){
	  	  var last_day="28";
	  if(current_year=="2020" || current_year=="2024" || current_year=="2028" || current_year=="2032" || current_year=="2036"){
	  var last_day="29";
	  }
	  }
	  var from_date=current_year+'-'+current_month+'-01';
      var to_date=current_year+'-'+current_month+'-'+last_day;
	  }
             $.ajax({
			  type: "POST",
              url: access_link+"account/ajax_expence_ledger_details.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
              $('#my_table2').html(detail);

	
              }
           });
	   for_total_income_expence_info(from_date,to_date);
            }
</script>


<script type="text/javascript">
     $( document ).ready(function() {
	  for_income_ledger("month_wise");
	  for_expence_ledger("month_wise");
       });
</script>

  

  <section class="content-header">
      <h1>
         <?php echo $language['Account Management']; ?>
					<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li><i class="Active"></i><?php echo $language['Ledger']; ?></li>
      </ol>
    </section>
	
    <!-- Main content -->
	
    <section class="content">
    <div class="row">
	<div class="col-md-12">
	    <div class="box <?php echo $box_head_color; ?> ">
	        <div class="col-md-6">	
              <br/>	  
			    <div class="col-md-3 my_background_color">
				 <div class="form-group" >
					<label><?php echo $language['From Date']; ?></label>
					  <input type="date" name="ledger_from_date" id="from_date" value="" class="form-control" oninput='for_income_ledger("date_wise");for_expence_ledger("date_wise");'>
				 </div>
			    </div>
				<div class="col-md-3 my_background_color">
				 <div class="form-group" >
					<label><?php echo $language['To Date']; ?></label>
					  <input type="date" name="ledger_to_date" id="to_date" value="" class="form-control" oninput='for_income_ledger("date_wise");for_expence_ledger("date_wise");'>
				 </div>
			    </div>
				<div class="col-md-3 my_background_color">
				 <div class="form-group" >
					<label><?php echo $language['Month Wise']; ?></label>
					  <select name="ledger_month" id="ledger_month_wise" onchange='for_income_ledger("month_wise");for_expence_ledger("month_wise");' class="form-control">
					  <option <?php if($current_month2=='01'){ echo "selected"; } ?> value="01"><?php echo $language['January']; ?></option>
					  <option <?php if($current_month2=='02'){ echo "selected"; } ?> value="02"><?php echo $language['February']; ?></option>
					  <option <?php if($current_month2=='03'){ echo "selected"; } ?> value="03"><?php echo $language['March']; ?></option>
					  <option <?php if($current_month2=='04'){ echo "selected"; } ?> value="04"><?php echo $language['April']; ?></option>
					  <option <?php if($current_month2=='05'){ echo "selected"; } ?> value="05"><?php echo $language['May']; ?></option>
					  <option <?php if($current_month2=='06'){ echo "selected"; } ?> value="06"><?php echo $language['June']; ?></option>
					  <option <?php if($current_month2=='07'){ echo "selected"; } ?> value="07"><?php echo $language['July']; ?></option>
					  <option <?php if($current_month2=='08'){ echo "selected"; } ?> value="08"><?php echo $language['August']; ?></option>
					  <option <?php if($current_month2=='09'){ echo "selected"; } ?> value="09"><?php echo $language['September']; ?></option>
					  <option <?php if($current_month2=='10'){ echo "selected"; } ?> value="10"><?php echo $language['October']; ?></option>
					  <option <?php if($current_month2=='11'){ echo "selected"; } ?> value="11"><?php echo $language['November']; ?></option>
					  <option <?php if($current_month2=='12'){ echo "selected"; } ?> value="12"><?php echo $language['December']; ?></option>
					  </select>
				 </div>
			    </div>
				<div class="col-md-3 my_background_color">
				 <div class="form-group" >
					<label><?php echo $language['Year']; ?></label>
					  <select name="ledger_year" id="ledger_year_wise" onchange='for_income_ledger("month_wise");for_expence_ledger("month_wise");' class="form-control">
                      <option <?php if($current_year=='2017'){ echo "selected"; } ?>  value="2017">2017</option>
					  <option <?php if($current_year=='2018'){ echo "selected"; } ?>  value="2018">2018</option>
					  <option <?php if($current_year=='2019'){ echo "selected"; } ?> value="2019">2019</option>
					  <option <?php if($current_year=='2020'){ echo "selected"; } ?> value="2020">2020</option>
					  <option <?php if($current_year=='2021'){ echo "selected"; } ?> value="2021">2021</option>
					  <option <?php if($current_year=='2022'){ echo "selected"; } ?> value="2022">2022</option>
					  <option <?php if($current_year=='2023'){ echo "selected"; } ?> value="2023">2023</option>
					  <option <?php if($current_year=='2024'){ echo "selected"; } ?> value="2024">2024</option>
					  <option <?php if($current_year=='2025'){ echo "selected"; } ?> value="2025">2025</option>
					  <option <?php if($current_year=='2026'){ echo "selected"; } ?> value="2026">2026</option>
					  <option <?php if($current_year=='2027'){ echo "selected"; } ?> value="2027">2027</option>
					  <option <?php if($current_year=='2028'){ echo "selected"; } ?> value="2028">2028</option>
		
					  </select>
				 </div>
			    </div>
			</div>
			
			    <div class="col-md-6">	
                 <br/>
			        <div class="col-md-4 my_background_color">
					 <div class="form-group" >
					 <label><?php echo $language['Income Total']; ?></label>
					  <input type="text" name="ledger_income_total" id="income_total_amount" placeholder="0" class="form-control" readonly>
				     </div>
			        </div>
			        <div class="col-md-4 my_background_color">
					 <div class="form-group">
					 <label><?php echo $language['Expense Total']; ?></label>
					  <input type="text" name="ledger_expence_total" id="expence_total_amount" placeholder="0"  class="form-control" readonly>
				     </div>
			        </div>
			        <div class="col-md-4 my_background_color">
					 <div class="form-group">
					 <label><?php echo $language['Grand Total']; ?></label>
					  <input type="text" name="ledger_grand_total" placeholder="0" id="grand_total"  class="form-control" readonly>
				     </div>
			        </div>
			    </div>	
	    </div>
	</div>
	   
        <div class="col-md-12"> 
		 <br/>
          <!-- /.box -->
		    <div class="col-md-6">
              <div class="box <?php echo $box_head_color; ?> " style="padding:10px 10px 10px 10px;">
			   <h4 style="color:red;"><center><?php echo $language['Income Details']; ?>:-  </center></h4><br/>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table1">
                  <table id="example1" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th><?php echo $language['Date']; ?></th>
                        <th><?php echo $language['Customer Name']; ?></th>
                        <th><?php echo $language['Amount Type']; ?></th>
                        <th><?php echo $language['Income From']; ?></th>						
				        <th><?php echo $language['Total Amount']; ?></th>
				        <th><?php echo $language['Details']; ?></th>
				        
				        <th>Update By</th>
                        <th>Date</th>
				    </tr>
                    </thead>
                    <tbody id="example5">
					
                    </tbody>
                  </table>
                </div>
            <!-- /.box-body -->
              </div>
          <!-- /.box -->
		    </div>
		  
		  
		    <div class="col-md-6">
              <div class="box <?php echo $box_head_color; ?> " style="padding:10px 10px 10px 10px;">
			   <h4 style="color:red;"><center> <?php echo $language['Expense Details']; ?> :-  </center></h4><br/>
                <!-- /.box-header -->
                <div class="box-body table-responsive" id="my_table2">
                  <table id="example3" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th><?php echo $language['Date']; ?></th>
                        <th><?php echo $language['Customer Name']; ?></th>
                        <th><?php echo $language['Amount Type']; ?></th>
                        <th>Expence For</th>							
				        <th><?php echo $language['Total Amount']; ?></th>
				        <th><?php echo $language['Details']; ?></th>
				        
				        <th>Update By</th>
                        <th>Date</th>
				    </tr>
                    </thead>
                <tbody id="example6">
				
                </tbody>
                     </table>
                </div>
            <!-- /.box-body -->
              </div>
          <!-- /.box -->
		    </div>

        </div>
        <!-- /.col -->
    </div>
      <!-- /.row -->
    </section>
  

<script>
  $(function () {
    $('#example1').DataTable()

  })
</script>
<script>
  $(function () {
    $('#example3').DataTable()

  })
</script>

