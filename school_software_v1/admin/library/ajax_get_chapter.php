<?php
include("../attachment/session.php");
                    $book=$_GET['book_name'];
					$link=explode("=",$book);
					$book_link=$link[0];
					$total_chapter=$link[1];
						$book_download=$book_link."dd.zip";
					for($i=1;$i<=$total_chapter;$i++)
					{
					
					if($i<10){
					$i="0".$i;
					}
						if($i=="00"){
						$book_link_final=$book_link."ps.pdf";
						$chapter="Prelims";
					}else{
					$book_link_final=$book_link.$i.".pdf";
					$chapter="Chapter-".$i;
					}
			 $path="http://ncert.nic.in/textbook/pdf/".$book_link_final; 

?>
<tr>
<th><?php echo "Chapter-".$i; ?></th>
<th><button type="button" class="btn btn-default " value="<?php echo $path ?>" onclick="get_pdf(this.value)">open</button></th>
</tr>
					
 <?php } ?>
 <tr>
<th>Complete Book</th>
<th><a href='http://ncert.nic.in/textbook/pdf/<?php echo $book_download; ?> 'target="_blank"><button type="button" class="btn btn-default ">Download</th>
</tr>
