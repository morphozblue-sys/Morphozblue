<?php
$date3='1995-09-31';
echo datetoword($date3);
function datetoword($date){
$date1=explode('-',$date);
$dd=$date1[2];
$mm=$date1[1];
$yy=$date1[0];

 $dd1=date2($dd);
 $mm1=month($mm);
 $yy1=year($yy);
$datetoword1=$dd1." ".$mm1." ".$yy1;
return $datetoword1;
}
function date2($x){

switch($x){
case 1:$y="First";break;
case 2:$y="Second";break;
case 3:$y="Third";break;
case 4:$y="Fourth";break;
case 5:$y="Fifth";break;
case 6:$y="Sixth";break;
case 7:$y="Seventh";break;
case 8:$y="Eighth";break;
case 9:$y="Ninth";break;
case 10:$y="Tenth";break;
case 11:$y="Eleventh";break;
case 12:$y="Twelfth";break;
case 13:$y="Thirteenth";break;
case 14:$y="Fourteenth";break;
case 15:$y="Fifteenth";break;
case 16:$y="Sixteenth";break;
case 17:$y="Seventeenth";break;
case 18:$y="Eighteenth";break;
case 19:$y="Nineteenth";break;
case 20:$y="Twentieth";break;
case 21:$y="Twenty First";break;
case 22:$y="Twenty Second";break;
case 23:$y="Twenty Third";break;
case 24:$y="Twenty Fourth";break;
case 25:$y="Twenty Fifth";break;
case 26:$y="Twenty Sixth";break;
case 27:$y="Twenty Seventh";break;
case 28:$y="Twenty Eighth";break;
case 29:$y="Twenty Ninth";break;
case 30:$y="Thirtieth";break;
case 31:$y="Thirty First";break;
}
return $y;
}
function month($a){
if($a=='08'){
$a=13;
}
if($a=='09'){
$a=14;
}
switch($a){
case 01:$b="January";break;
case 02:$b="February";break;
case 03:$b="March";break;
case 04:$b="April";break;
case 05:$b="May";break;
case 06:$b="June";break;
case 07:$b="July";break;
case 13:$b="August";break;
case 14:$b="September";break;
case 10:$b="October";break;
case 11:$b="November";break;
case 12:$b="December";break;
}
return $b;
}



function year($c){

  $m=intval($c/100);
 $j=intval($m*100);
 $n=intval($c-$j);
  $o=intval($n/10);
	$i=intval($o*10);
  $s=intval($n-$i);


if($m==19){
 $p="Ninteen Hundred";
}
if($m==20){
 $p="Two Thousand";
}

if ($n > 19){
switch($o){
case 2:$q="Twenty";break;
case 3:$q="Thirty";break;
case 4:$q="Fourty";break;
case 5:$q="Fifty";break;
case 6:$q="Sixty";break;
case 7:$q="Seventy";break;
case 8:$q="Eigthy";break;
case 9:$q="Ninety";break;
}

switch($s){
case 1:$t="One";break;
case 2:$t="Two";break;
case 3:$t="Three";break;
case 4:$t="Four";break;
case 5:$t="Five";break;
case 6:$t="Six";break;
case 7:$t="Seven";break;
case 8:$t="Eight";break;
case 9:$t="Nine";break;

}
$f=$q." ".$t;
}
else
{
switch($n){
case 10:$u="Ten";break;
case 11:$u="Eleven";break;
case 12:$u="Twelve";break;
case 13:$u="Thirteen";break;
case 14:$u="Fourteen";break;
case 15:$u="Fifteen";break;
case 16:$u="Sixteen";break;
case 17:$u="Seventeen";break;
case 18:$u="Eighteen";break;
case 19:$u="Nineteen";break;
}
$f=$u;
}
$e=$p." ".$f;
return $e;
}
?>
