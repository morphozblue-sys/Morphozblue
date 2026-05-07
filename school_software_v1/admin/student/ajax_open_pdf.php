<?php
 
                  $path=$_GET['path2'];

?>


<script>
$('#myModal').modal('show'); 
</script>



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" width="100%" style="margin-right:400px;">
    
      <!-- Modal content-->
      <div class="modal-content" >
	   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
         <object data="<?php echo $path; ?>" type="application/pdf" width="100%" height="500px">
<iframe src="<?php echo $path; ?>" width="100%" height="500px" style="border: none;">
This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $path; ?>">Download PDF</a>
</iframe>
</object>
</object>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
