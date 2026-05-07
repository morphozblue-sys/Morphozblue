<?php
include("../../../admin/attachment/session.php");
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_school_district = $row['school_info_school_district'];
	    $school_info_school_name = strtoupper($school_info_school_name);
		$school_info_school_district = strtoupper($school_info_school_district);
		$school_info_logo = $row['school_info_logo_name'];

}

$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$logo_image=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);

}
$class_name=$_GET['class'];		 
$class_code=$_GET['class_code'];		 
$section=$_GET['section'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Time Table</title>
<style type="text/css">
	@media print{@page {size: landscape;}}
	.border{
		border:3px solid #800080;
	}
	.header{
		color: #DC0000;
		font-weight: bold;
		font-size: 25px;
		text-align: center;
	}
	.header2{
		color: #DC0000;
		font-weight: bold;
		font-size: 20px;
		text-align: center;
	}
	.header3{
		color: #CC2D80;
		font-weight: bold;
		font-size: 16px;
		text-align: center;	
	}
	table{
		text-align: center;
		width: 100%;
	}
	.logo td{
         margin-top: -50px;
	}
	.logo img{
        width: 100px;
        height: 100px;
	}
	.student_detail{
		text-align: center;
		font-size: 18px;
		font-weight: bold;
	}
	.student_detail td{
		padding: 0 50px;
	}
	.time_table{
		text-align: center;
		font-size: 12px;
		font-weight: bold;
		border-spacing: 0px;
		margin-top: 30px;
	}
	.time_table tr td{
		border:1px solid #000000;
	}
	.time_header{
		height: 10px;
		font-size: 12px;
	}
	.time_table .time_header td:first-child,
 td:nth-child(2),td:nth-child(3), {
   border-top: 1px solid !important;
   border-right: 1px solid !important;
   border-left: 1px solid !important;
   border-bottom:0px !important;
}
	.time_header2{
		height: 10px;
		font-size: 11px;
		color: #8A0000;
	}
	.time_header td{
		color: #8A0000;
		border:1px solid #000000;
	}

	.singnature{
		margin-top: 50px;
		font-size: 20px;
		font-weight: bold;
	}
</style>
</head>
<body>
	<div class="border">
		<table>
			<tr class="header">
				<td colspan="5"><?php echo $school_info_school_name; ?></td>
			</tr>
			<tr class="header2">
				<td colspan="5">DIST. - <?php echo $school_info_school_district; ?></td>
			</tr>
			<tr class="header3">
				<td>Class - <span style="color:#640064"><?php echo $class_name; ?></span></td>
				<td>Section - <span style="color:#640064"><?php echo $section; ?></span></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr class="logo">
			<td colspan="5" style="float: left">
			    <?php 
			    if($school_info_logo!=''){
			    ?>
			    <img src="<?php echo $logo_image; ?>">
			    <?php } else{ ?>
			    <img src="../blank.jpg">
			    <?php } ?>
			    </td>
			</tr>
		</table>
		<table class="time_table">
			<tr class="time_header">
				<td style="width: 8.3%;border-bottom: 0px;">Period</td>
				<td style="width: 8.3%;border-bottom: 0px;">Time</td>
				<td style="width: 8.3%;border-bottom: 0px;">Time</td>
				<td style="width: 12.5%">Monday</td>
				<td style="width: 12.5%">Tuesday</td>
				<td style="width: 12.5%">Wednesday</td>
				<td style="width: 12.5%">Thursday</td>
				<td style="width: 12.5%">Friday</td>
				<td style="width: 12.5%">Saturday</td>
			</tr>
			<tr class="time_header2">
				<td style="width: 8.3%;border-top: 0px;">Name</td>
				<td style="width: 8.3%;border-top: 0px;">From</td>
				<td style="width: 8.3%;border-top: 0px;">To</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
				<td style="width: 12.5%">Subject & Teacher Name</td>
			</tr>
			<?php 
				$que="select * from school_info_class_period where class_code=''";
					$run=mysqli_query($conn73,$que);
					$numberofperid=1;
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
					$period_code1=$row['period_code'];
	                $period_start_time1 = $row['period_start_time'];
					$period_end_time1 = $row['period_end_time'];
					if($period_name1!=''){
					$period_coloum_subject_monday=$period_code1."_subject_monday";
					$period_coloum_teacher_monday=$period_code1."_teacher_monday";
					$period_coloum_subject_tuesday=$period_code1."_subject_tuesday";
					$period_coloum_teacher_tuesday=$period_code1."_teacher_tuesday";
					$period_coloum_subject_wednesday=$period_code1."_subject_wednesday";
					$period_coloum_teacher_wednesday=$period_code1."_teacher_wednesday";
					$period_coloum_subject_thursday=$period_code1."_subject_thursday";
					$period_coloum_teacher_thursday=$period_code1."_teacher_thursday";
					$period_coloum_subject_friday=$period_code1."_subject_friday";
					$period_coloum_teacher_friday=$period_code1."_teacher_friday";
					$period_coloum_subject_saturday=$period_code1."_subject_saturday";
					$period_coloum_teacher_saturday=$period_code1."_teacher_saturday";
				    $que1="select * from class_time_table where class_code='$class_code' and section='$section'  and group_name='$student_class_group' and stream_code='$student_class_stream'";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					$period_coloum_subject_monday1=$row1[$period_coloum_subject_monday];
					$period_coloum_teacher_monday1=$row1[$period_coloum_teacher_monday];
					$period_coloum_subject_tuesday1=$row1[$period_coloum_subject_tuesday];
					$period_coloum_teacher_tuesday1=$row1[$period_coloum_teacher_tuesday];
					$period_coloum_subject_wednesday1=$row1[$period_coloum_subject_wednesday];
					$period_coloum_teacher_wednesday1=$row1[$period_coloum_teacher_wednesday];
					$period_coloum_subject_thursday1=$row1[$period_coloum_subject_thursday];
					$period_coloum_teacher_thursday1=$row1[$period_coloum_teacher_thursday];
					$period_coloum_subject_friday1=$row1[$period_coloum_subject_friday];
					$period_coloum_teacher_friday1=$row1[$period_coloum_teacher_friday];
					$period_coloum_subject_saturday1=$row1[$period_coloum_subject_saturday];
					$period_coloum_teacher_saturday1=$row1[$period_coloum_teacher_saturday];
					}
					$serial_no++;
				
			?>
			<tr class="time_body">
				<td style="width: 8.3%"><?php echo strtoupper($period_name1); ?></td>
				<td style="width: 8.3%"><?php echo $period_start_time1; ?></td>
				<td style="width: 8.3%"><?php echo $period_end_time1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_monday1.'<br>'.$period_coloum_teacher_monday1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_tuesday1.'<br>'.$period_coloum_teacher_tuesday1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_wednesday1.'<br>'.$period_coloum_teacher_wednesday1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_thursday1.'<br>'.$period_coloum_teacher_thursday1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_friday1.'<br>'.$period_coloum_teacher_friday1; ?></td>
				<td style="width: 12.5%"><?php echo $period_coloum_subject_saturday1.'<br>'.$period_coloum_teacher_saturday1; ?></td>
			</tr>
		<?php $numberofperid++; } } ?>
		</table>
		<style>
		    	.time_body{
            		height: <?php echo 400/$numberofperid.'px';?>
            	}
		</style>
		<table class="singnature">
			<tr>
                <td style="width:80%"></td>
                <td style="text-align:right">Signature</td>
                <td>___________________________</td>
			</tr>
		</table>
	</div>

<script type="text/javascript">
	print_r();
	function print_r() {
		window.print();
	}
</script>
</body>
</html>