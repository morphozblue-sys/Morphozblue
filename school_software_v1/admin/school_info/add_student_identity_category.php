<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function identity_add() {
  var nm = $.trim($('#identity_category_name').val());
  if (nm === '') { alert_new('Category name is required.', 'red'); return; }
  var $btn = $('#identity_add_btn');
  if ($btn.prop('disabled')) return;
  $btn.prop('disabled', true);
  $.ajax({
    type: "POST",
    url: access_link + "school_info/add_student_identity_category_api.php",
    data: { identity_category_name: nm },
    success: function (detail) {
      $btn.prop('disabled', false);
      var res = detail.split("|?|");
      if (res[1] === 'success') {
        alert_new('Category added successfully!', 'green');
        $('#identity_category_name').val('');
        get_content('school_info/add_student_identity_category');
      } else {
        alert_new('Could not save. Please try again.', 'red');
      }
    },
    error: function () {
      $btn.prop('disabled', false);
      alert_new('Connection error. Please try again.', 'red');
    }
  });
}

function identity_delete(id) {
  if (!confirm('Delete this identity category?\nThis cannot be undone.')) return;
  post_content('school_info/student_identity_category_delete', 'id=' + id);
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Student Identity Category</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="row">

    <!-- ── Left: Add Category ── -->
    <div class="col-md-4">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-id-card"></i></div>
          <h4>Add Identity Category</h4>
        </div>
        <div class="si-card-body">
          <div class="si-fg">
            <label>Category Name <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-id-card ico"></i>
              <input type="text" id="identity_category_name" class="si-ctrl" placeholder="e.g. Aadhar Card">
            </div>
          </div>
          <button type="button" id="identity_add_btn" onclick="identity_add();" class="si-btn si-btn-ok" style="width:100%;">
            <i class="fa fa-plus"></i> <?php echo $language['Add Group']; ?>
          </button>
        </div>
      </div>
    </div>

    <!-- ── Right: Current Categories ── -->
    <div class="col-md-8">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-list"></i></div>
          <h4>Current Identity Categories</h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Identity Category Name</th>
                  <th class="cen"><?php echo $language['Delete']; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $que = "select * from school_info_identity_category";
                $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
                $serial_no = 0;
                while ($row = mysqli_fetch_assoc($run)) {
                    $serial_no++;
                    ?>
                <tr>
                  <td><span class="si-sno"><?php echo $serial_no; ?></span></td>
                  <td><strong><?php echo htmlspecialchars($row['identity_category_name']); ?></strong></td>
                  <td class="cen">
                    <button type="button" class="si-btn si-btn-del" style="padding:5px 14px;font-size:12px;"
                      onclick="identity_delete('<?php echo htmlspecialchars($row['s_no']); ?>')">
                      <i class="fa fa-trash"></i> <?php echo $language['Delete']; ?>
                    </button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>
