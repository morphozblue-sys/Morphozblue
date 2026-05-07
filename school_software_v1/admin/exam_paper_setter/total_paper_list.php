<?php include("../attachment/session.php")?>
    <section class="content-header">
      <h1>
        <?php echo $language['Paper Setter']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
			 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	 <li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-dashboard"></i> <?php echo $language['Paper Setter']; ?></a></li>
        <li class="active"><?php echo $language['Paper List']; ?></li>
      </ol>
    </section>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th>#</th>
				  <th><?php echo $language['Language']; ?></th>
				  <th><?php echo $language['Paper Id']; ?></th>
				  <th><?php echo $language['Exam Type']; ?></th>
				  <th><?php echo $language['Class']; ?></th>
				  <th><?php echo $language['Subject']; ?></th>
				  <th><?php echo $language['Exam Date']; ?></th>
				  <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
                
				<?php				
				$que="select * from question_paper_set GROUP BY paper_unique_id";
				$run=mysqli_query($conn73,$que);
				$serial=0;
				while($row=mysqli_fetch_assoc($run)){
				$language=$row['language'];	
				$paper_unique_id=$row['paper_unique_id'];	
				$exam_type=$row['exam_type'];	
				$question_class=$row['question_class'];	
				$question_subject=$row['question_subject'];
				$exam_date=$row['exam_date'];
				$serial++;
                ?>

                <tr>
                  <td><?php echo $serial; ?></td>
                  <td><?php echo $language; ?></td>
				  <td><?php echo $paper_unique_id; ?></td>
                  <td><?php echo $exam_type; ?></td>
				  <td><?php echo $question_class; ?></td>
				  <td><?php echo $question_subject; ?></td>
				  <td><?php echo $exam_date; ?></td>
				  <td><a href="javascript:post_content('exam_paper_setter/paper_list','id=<?php echo $paper_unique_id; ?>&language=<?php echo $language; ?>')"><button type="button" class="btn btn-success">View Paper</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:post_content('exam_paper_setter/paper_edit','id=<?php echo $paper_unique_id; ?>&language=<?php echo $language; ?>')"><button type="button" class="btn btn-success">Edit Paper</button></a></td>
                </tr>
                <?php } ?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
   