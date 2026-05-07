<?php
$query181 = "select * from school_info_class_info";
$run181   = mysqli_query($conn73, $query181) or die(mysqli_error($conn73));
while ($row1 = mysqli_fetch_assoc($run181)) {
    $wyyw = "update student_admission_info set class_code_no='" . $row1['class_code_no'] . "' where student_class='" . $row1['class_name'] . "'";
    mysqli_query($conn73, $wyyw);
}
?>
<script>
function for_list() {
    var gender   = document.querySelector('input[name="student_gender"]:checked')  ? document.querySelector('input[name="student_gender"]:checked').value  : 'Both';
    var religion = document.querySelector('input[name="student_religion"]:checked') ? document.querySelector('input[name="student_religion"]:checked').value : 'All';
    var caste    = document.querySelector('input[name="student_category"]:checked') ? document.querySelector('input[name="student_category"]:checked').value : 'All';
    var age                  = document.getElementById('a').value;
    var scheme               = document.getElementById('student_admission_scheme').value;
    var type                 = document.getElementById('student_admission_type').value;
    var student_class        = document.getElementById('student_class').value;
    var student_class_stream = document.getElementById('student_class_stream').value;
    var student_class_group  = document.getElementById('student_class_group').value;
    var student_class_section= document.getElementById('student_class_section').value;
    var bus_fee_category_name= document.getElementById('bus_fee_category_name').value;
    var sort_by              = document.getElementById('sort_by').value;
    $('#example1').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: access_link + "student/student_admission_list_fatch.php?gender=" + gender +
                 "&student_class_group=" + student_class_group +
                 "&student_class_stream=" + student_class_stream +
                 "&religion=" + religion +
                 "&caste=" + caste +
                 "&age=" + age +
                 "&scheme=" + scheme +
                 "&type=" + type +
                 "&student_class=" + student_class +
                 "&student_class_section=" + student_class_section +
                 "&bus_fee_category_name=" + bus_fee_category_name +
                 "&sort_by=" + encodeURIComponent(sort_by),
            type: "post"
        }
    });
}

function for_stream(value2) {
    if (value2 === "11TH" || value2 === "12TH" || value2 === "13TH") {
        $("#student_class_stream_div, #student_class_group_div").show();
    } else {
        $("#student_class_stream_div, #student_class_group_div").hide();
    }
}

function get_group(value1) {
    if (value1 !== 'All') {
        $('#student_class_group').html("<option value=''>Loading....</option>");
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_stream_group_all.php?stream_name=" + value1,
            cache: false,
            success: function(d) { $("#student_class_group").html(d); }
        });
    } else {
        $("#student_class_group").html('<option value="All">All</option>');
    }
}

function for_section(value) {
    $('#student_class_section').html("<option value=''>Loading....</option>");
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_class_section_all.php?class_name=" + value,
        cache: false,
        success: function(d) { $("#student_class_section").html(d); }
    });
}
</script>

<div class="al-filter-row">

  <!-- Sort By -->
  <div class="al-filter-group">
    <label><i class="fa fa-sort"></i> Sort By</label>
    <select name="sort_by" id="sort_by" class="form-control" onchange="for_list();">
      <option value=" ORDER BY s_no DESC">Default</option>
      <option value=" ORDER BY student_name ASC">Name</option>
      <option value=" ORDER BY CAST(class_code_no AS UNSIGNED) ASC">Class</option>
      <option value=" ORDER BY student_class_section ASC">Section</option>
      <option value=" ORDER BY student_father_name ASC">Father</option>
      <option value=" ORDER BY school_roll_no ASC">Roll No.</option>
      <option value=" ORDER BY CAST(student_date_of_admission AS UNSIGNED) ASC">Admission Date</option>
      <option value=" ORDER BY student_class, CAST(school_roll_no AS UNSIGNED) ASC">Roll No. &amp; Class</option>
    </select>
  </div>

  <!-- Class -->
  <div class="al-filter-group">
    <label><i class="fa fa-graduation-cap"></i> Class</label>
    <select name="student_class" id="student_class" class="form-control"
            onchange="for_section(this.value); for_list(); for_stream(this.value);">
      <option value="All">All</option>
      <?php
      $class37  = $_SESSION['class_name37'];
      $class371 = explode('|?|', $class37);
      $total_class = $_SESSION['class_total37'];
      for ($q = 0; $q < $total_class; $q++) {
          $cn = $class371[$q];
          echo '<option value="' . htmlspecialchars($cn) . '">' . htmlspecialchars($cn) . '</option>';
      }
      ?>
    </select>
  </div>

  <!-- Stream (hidden unless 11th/12th) -->
  <div class="al-filter-group" id="student_class_stream_div" style="display:none;">
    <label><i class="fa fa-random"></i> Stream</label>
    <select class="form-control" name="student_class_stream" id="student_class_stream"
            onchange="get_group(this.value); for_list();">
      <option value="All">All</option>
      <?php
      $que = "select stream_name from school_info_stream_info where stream_name!=''";
      $run = mysqli_query($conn73, $que);
      while ($row = mysqli_fetch_assoc($run)) {
          echo '<option value="' . htmlspecialchars($row['stream_name']) . '">' . htmlspecialchars($row['stream_name']) . '</option>';
      }
      ?>
    </select>
  </div>

  <!-- Group (hidden unless stream selected) -->
  <div class="al-filter-group" id="student_class_group_div" style="display:none;">
    <label><i class="fa fa-object-group"></i> Group</label>
    <select class="form-control" name="student_class_group" id="student_class_group" onchange="for_list();">
      <option value="All">All</option>
    </select>
  </div>

  <!-- Section -->
  <div class="al-filter-group">
    <label><i class="fa fa-object-group"></i> Section</label>
    <select class="form-control" name="student_class_section" id="student_class_section" onchange="for_list();">
      <option value="All">All</option>
    </select>
  </div>

  <!-- Scheme -->
  <div class="al-filter-group">
    <label><i class="fa fa-tag"></i> Scheme</label>
    <select class="form-control" name="student_admission_scheme" id="student_admission_scheme" onchange="for_list();">
      <option value="All">All</option>
      <option value="NON-RTE">NON-RTE</option>
      <option value="RTE">RTE</option>
    </select>
  </div>

  <!-- Admission Type -->
  <div class="al-filter-group">
    <label><i class="fa fa-list"></i> Admission Type</label>
    <select class="form-control" name="student_admission_type" id="student_admission_type" onchange="for_list();">
      <option value="All">All</option>
      <option value="Regular">Regular</option>
      <option value="Private">Private</option>
    </select>
  </div>

  <!-- Bus Category -->
  <div class="al-filter-group">
    <label><i class="fa fa-bus"></i> Bus Category</label>
    <select class="form-control" name="bus_fee_category_name" id="bus_fee_category_name" onchange="for_list();">
      <option value="All">All</option>
      <?php
      $query18 = "select bus_fee_category_name, bus_fee_category_code from bus_fee_category where bus_fee_category_name!=''";
      $run18   = mysqli_query($conn73, $query18) or die(mysqli_error($conn73));
      while ($row = mysqli_fetch_assoc($run18)) {
          echo '<option value="' . htmlspecialchars($row['bus_fee_category_code']) . '">'
               . htmlspecialchars($row['bus_fee_category_name']) . '</option>';
      }
      ?>
    </select>
  </div>

  <!-- Age -->
  <div class="al-filter-group">
    <label><i class="fa fa-calendar"></i> Age (In Years) — <span id="age_display" style="color:#0f3460;font-weight:800;">0</span></label>
    <input type="range" name="student_date_of_birth" id="a" value="0" min="0" max="25"
           class="form-control" style="height:auto;padding:6px 0;"
           oninput="document.getElementById('age_display').textContent=this.value; for_list();">
  </div>

</div><!-- /.al-filter-row -->

<!-- Gender -->
<div class="al-filter-row" style="margin-top:12px;">
  <div class="al-filter-group" style="min-width:100%;flex:none;">
    <label><i class="fa fa-venus-mars"></i> Gender</label>
    <div class="al-radio-group">
      <label><input type="radio" name="student_gender" value="Both"   checked onclick="for_list();"> Both</label>
      <label><input type="radio" name="student_gender" value="Male"          onclick="for_list();"> Male</label>
      <label><input type="radio" name="student_gender" value="Female"        onclick="for_list();"> Female</label>
      <label><input type="radio" name="student_gender" value="Other"         onclick="for_list();"> Other</label>
    </div>
  </div>
</div>

<!-- Religion -->
<div class="al-filter-row" style="margin-top:10px;">
  <div class="al-filter-group" style="min-width:100%;flex:none;">
    <label><i class="fa fa-star-o"></i> Religion</label>
    <div class="al-radio-group">
      <label><input type="radio" name="student_religion" value="All"       checked onclick="for_list();"> All</label>
      <label><input type="radio" name="student_religion" value="Hindu"            onclick="for_list();"> Hindu</label>
      <label><input type="radio" name="student_religion" value="Muslim"           onclick="for_list();"> Muslim</label>
      <label><input type="radio" name="student_religion" value="Sikh"             onclick="for_list();"> Sikh</label>
      <label><input type="radio" name="student_religion" value="Christian"        onclick="for_list();"> Christian</label>
      <label><input type="radio" name="student_religion" value="Jain"             onclick="for_list();"> Jain</label>
      <label><input type="radio" name="student_religion" value="Buddh"            onclick="for_list();"> Buddh</label>
      <label><input type="radio" name="student_religion" value="Other"            onclick="for_list();"> Other</label>
    </div>
  </div>
</div>

<!-- Category -->
<div class="al-filter-row" style="margin-top:10px;">
  <div class="al-filter-group" style="min-width:100%;flex:none;">
    <label><i class="fa fa-users"></i> Category</label>
    <div class="al-radio-group">
      <label><input type="radio" name="student_category" value="All"     checked onclick="for_list();"> All</label>
      <label><input type="radio" name="student_category" value="General"        onclick="for_list();"> General</label>
      <label><input type="radio" name="student_category" value="OBC"            onclick="for_list();"> OBC</label>
      <label><input type="radio" name="student_category" value="SC"             onclick="for_list();"> SC</label>
      <label><input type="radio" name="student_category" value="ST"             onclick="for_list();"> ST</label>
      <label><input type="radio" name="student_category" value="Other"          onclick="for_list();"> Other</label>
    </div>
  </div>
</div>
