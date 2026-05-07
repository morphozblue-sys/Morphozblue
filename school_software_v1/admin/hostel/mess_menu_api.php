<?php include("../attachment/session.php");

	$sun_breakfast = $_POST['sun_breakfast'];
	$mon_breakfast = $_POST['mon_breakfast'];
	$tue_breakfast = $_POST['tue_breakfast'];
	$wed_breakfast = $_POST['wed_breakfast'];
	$thu_breakfast = $_POST['thu_breakfast'];
	$fri_breakfast = $_POST['fri_breakfast'];
	$sat_breakfast = $_POST['sat_breakfast'];
	$sun_lunch = $_POST['sun_lunch'];
	$mon_lunch = $_POST['mon_lunch'];
	$tue_lunch = $_POST['tue_lunch'];
	$wed_lunch = $_POST['wed_lunch'];
	$thu_lunch = $_POST['thu_lunch'];
	$fri_lunch = $_POST['fri_lunch'];
	$sat_lunch = $_POST['sat_lunch'];
	$sun_dinner = $_POST['sun_dinner'];
	$mon_dinner = $_POST['mon_dinner'];
	$tue_dinner = $_POST['tue_dinner'];
	$wed_dinner = $_POST['wed_dinner'];
	$thu_dinner = $_POST['thu_dinner'];
	$fri_dinner = $_POST['fri_dinner'];
	$sat_dinner = $_POST['sat_dinner'];
	
$quer="update hostel_mess_menu set sun_breakfast='$sun_breakfast',mon_breakfast='$mon_breakfast',tue_breakfast='$tue_breakfast',wed_breakfast='$wed_breakfast',thu_breakfast='$thu_breakfast',fri_breakfast='$fri_breakfast',sat_breakfast='$sat_breakfast',sun_lunch='$sun_lunch',mon_lunch='$mon_lunch',tue_lunch='$tue_lunch',wed_lunch='$wed_lunch',thu_lunch='$thu_lunch',fri_lunch='$fri_lunch',sat_lunch='$sat_lunch',sun_dinner='$sun_dinner',mon_dinner='$mon_dinner',tue_dinner='$tue_dinner',wed_dinner='$wed_dinner',thu_dinner='$thu_dinner',fri_dinner='$fri_dinner',sat_dinner='$sat_dinner'";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>