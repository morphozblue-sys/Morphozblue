 <?php 
 $get_year=$_GET['year']; 
  $month= date('m');
  $current_year= date('Y');
  $month_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
 if($get_year==$current_year){
     for($k=0;$k<$month;$k++){
         $y=$k+1;
         if($y<10){
             $y='0'.$y;
             
         } ?>
          <option <?php if($y==$month){ echo "selected"; } ?> value="<?php echo $y; ?>"><?php echo $month_array[$k]; ?></option>
         <?php
     }
 }elseif($get_year<$current_year){ ?>
			  
			  <option  value="01">January </option>
			  <option value="02">February </option>
			  <option  value="03">March </option>
			  <option value="04">April </option>
			  <option  value="05">May </option>
			  <option value="06">June </option>
			  <option value="07">July </option>
			  <option value="08">August </option>
			  <option  value="09">September </option>
			  <option  value="10">October </option>
			  <option value="11">November </option>
			  <option  value="12">December </option>
		
			  <?php } ?>