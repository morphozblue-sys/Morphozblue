<?php include("../attachment/session.php")?>

<script>
$("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"hostel/daily_mess_purchase_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('hostel/daily_mess_purchase_detail');
            }
			}
         });
      });
</script>

    <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	      <li><a href=".javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_mess')"><i class="fa fa-bed"></i><?php echo $language['Hostel Mess']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/daily_mess_purchase_detail')"><i class="fa fa-bed"></i> <?php echo $language['Daily Mess Purchase Details']; ?></a></li>
		
	
	    <li class="Active"><?php echo $language['Daily Mess Purchase']; ?></li>
      </ol>
    </section>
<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
 <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style="color:#930F4B"><?php echo $language['Daily Purchase']; ?></h3>
            </div>
            <!-- /.box-header -->
			
<!------------------------------------------------Start Registration form--------------------------------------------------->
		<form method="post" enctype="multipart/form-data" id="my_form">
    <div class="col-md-3"></div>
	<div class="col-md-6 col-md-6-offset-3">
    <div class="panel panel-default">
      <div id="my_table" class="panel-heading"><span style="font-size:18px;"><?php echo $language['Daily Purchase']; ?></span><input type ="date" style="margin-left:170px;" name="date_purchase" value="<?php echo date("Y-m-d")?>"></div>
	  
      <div class="panel-body">
         <div class="panel-body">
	           <div class="box-body">

<div class="table-responsive">

 <table  class="table table-bordered table-striped">

                <thead>
                <tr>
                   
				  
				  <th><input class='check_all' type='checkbox' onclick="select_all()"/></th> 
				  <th><?php echo $language['S No']; ?></th>

                  <th><?php echo $language['Item Description']; ?></th>

                  <th><?php echo $language['Quantity']; ?></th>

                  <th><?php echo $language['Rate']; ?>(<i class="fa fa-inr" aria-hidden="true">)</th>

				</tr>
                </thead>
				


				

                <tbody class="appenew">

         

      <tr class="tr_clone">

	<td><input type='checkbox' class='case'/></td>
    <td><span id='snum'>1.</span></td>
    <td><input type="text" name="item_description[]" id="item_description_1" class="form-control"></td>
    <td><input type="text" name="quantity[]" id="quantity_1" class="form-control"></td>
    <td><input type="text" name="rate[]" id="rate_1" class="form-control"></td>

	   </tr>

	</tbody>
   </table>
   <br>                
<button type="button" class="btn btn-danger" id='delete'>-</button>&nbsp;&nbsp;
<button type="button" class="btn btn-info" id='addmore'>+</button>
   <br/>
   <br/>
   <br/>

<script>

$("#delete").on('click', function() {

	$('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

	check();

	


	

});

var i=2;

$("#addmore").on('click',function(){

	count=$('table tr').length;

   

    var data="<tr><td><input type='checkbox' class='case'/></td><td><span id='snum"+i+"'>"+count+".</span></td>";

    data +="<td><input type='text' name='item_description[]' id='item_description_"+count+"' class='form-control'></td><td><input type='text' name='quantity[]' id='quantity_"+count+"' class='form-control'></td><td><input type='text' name='rate[]' id='rate_"+count+"' class='form-control'></td>";

	$('table').append(data);

	i++;

});

function select_all() {

	$('input[class=case]:checkbox').each(function(){ 

		if($('input[class=check_all]:checkbox:checked').length == 0){ 

			$(this).prop("checked", false); 

		} else {

			$(this).prop("checked", true); 

		} 

	});

}

function check(){

	obj=$('table tr').find('span');

	$.each( obj, function( key, value ) {

	id=value.id;

	$('#'+id).html(key+1);

	});

	}



</script>  

</div>

	 

			  </div>


	  
	  
	    </div>
	  <div class="form-group">
		    <center><button type="submit" name="submit" class="btn btn-primary"><?php echo $language['Submit Details'] ;?></button></center>
	  </div>
	  
	  </div>
    </div>
    </div>
	<div class="col-md-3"></div>
	</form>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>


