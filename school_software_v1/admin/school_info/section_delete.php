<?php include("../attachment/session.php");

$id=$_GET['id'];
$section=$_GET['section'];
if($section>1){
$section12334=$section-1;
$query="update school_info_class_info set section='$section12334',$update_by_update_sql  where class_name='$id'";
if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
	
		
$que121="select class,section from user_rights where designation='admin'";
$run122=mysqli_query($conn73,$que121);
while($row122=mysqli_fetch_assoc($run122)){
	$class=$row122['class'];
	$section123=$row122['section'];
	$class1=explode('|?|',$class);
	$section1=explode('|?|',$section123);
	$count=count($class1);
	$section12='';
	for($i=0;$i<$count;$i++){
		$new_section=$section1[$i];
		if($class1[$i]==$id){
			if($section12334==1){
				$new_section='A';
			}elseif($section12334==2){
				$new_section='A_B';
			}elseif($section12334==3){
				$new_section='A_B_C';
			}elseif($section12334==4){
				$new_section='A_B_C_D';
			}elseif($section12334==5){
				$new_section='A_B_C_D_E';
			}elseif($section12334==6){
				$new_section='A_B_C_D_E_F';
			}elseif($section12334==7){
				$new_section='A_B_C_D_E_F_G';
			}elseif($section12334==8){
				$new_section='A_B_C_D_E_F_G_H';
			}elseif($section12334==9){
				$new_section='A_B_C_D_E_F_G_H_I';
			}elseif($section12334==10){
				$new_section='A_B_C_D_E_F_G_H_I_J';
			}
     
		}
		if($i==0){
		$section12=$new_section;
		}else{
		$section12=$section12."|?|".$new_section;
		}
	}
	
}	
$quejk234="update user_rights set section='$section12',$update_by_update_sql  where designation='admin'";
mysqli_query($conn73,$quejk234);
	
}
}else{

	echo "|?|error|?|";
}

?>