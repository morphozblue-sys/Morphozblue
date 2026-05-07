<?php
$class_name = $_GET['class_name'];

include("../../con73/con37.php");
$query="select * from school_info_class_info where class_name='$class_name'";
$result=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($result)){
			$section = $row['section'];
                if($section=='1'){			
				echo "<option value=A>A</option>";
				}elseif($section=='2'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
			    }elseif($section=='3'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
			    }elseif($section=='4'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				}elseif($section=='5'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
			    }elseif($section=='6'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
				echo "<option value=F>F</option>";
			    }elseif($section=='7'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
				echo "<option value=F>F</option>";
				echo "<option value=G>G</option>";
			    }elseif($section=='8'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
				echo "<option value=F>F</option>";
				echo "<option value=G>G</option>";
				echo "<option value=H>H</option>";
			    }elseif($section=='9'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
				echo "<option value=F>F</option>";
				echo "<option value=G>G</option>";
				echo "<option value=H>H</option>";
				echo "<option value=I>I</option>";
			    }elseif($section=='10'){
			    echo "<option value=A>A</option>";
			    echo "<option value=B>B</option>";
				echo "<option value=C>C</option>";
				echo "<option value=D>D</option>";
				echo "<option value=E>E</option>";
				echo "<option value=F>F</option>";
				echo "<option value=G>G</option>";
				echo "<option value=H>H</option>";
				echo "<option value=I>I</option>";
				echo "<option value=J>J</option>";
			    }
			
			
			
			
			
			}
?>
