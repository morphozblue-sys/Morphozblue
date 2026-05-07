<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
/* Prefill modal when editing an existing row */
function add_edit(code, name) {
  var parts      = name.split('|?|');
  $('#bus_fee_type1').val(parts[0]   || '');
  $('#bus_fee_type_hindi').val(parts[1] || '');
  $('#bus_fee_code_hidden').val(code);
  $('#si_bus_modal_title').text(parts[0] ? 'Edit Bus Fee Category' : 'Add Bus Fee Category');

  /* Fill per-class amount fields */
  var classCodes  = $('#all_class_codes').val().split('|?|').filter(Boolean);
  for (var i = 0; i < classCodes.length; i++) {
    $('#' + classCodes[i] + '_amount').val(parts[i + 2] || '');
  }
}

/* "Same fee for all classes" checkbox */
function for_same(val) {
  if ($('#same_fee').prop('checked')) {
    $('.bus_fee').each(function () { $(this).val(val); });
  }
}

$(document).ready(function () {
  $("#my_form").off('submit').on('submit', function (e) {
    e.preventDefault();
    var catName = $.trim($('#bus_fee_type1').val());
    if (!catName) { alert_new('Bus fee category name is required.', 'red'); return; }
    var $btn = $(this).find('[type=submit]');
    $btn.prop('disabled', true);
    var formdata = new FormData(this);
    $.ajax({
      url: access_link + "school_info/add_bus_fee_category_api.php",
      type: "POST",
      data: formdata,
      mimeTypes: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success: function (detail) {
        $btn.prop('disabled', false);
        var res = detail.split("|?|");
        if (res[1] === 'success') {
          alert_new('Bus fee category saved successfully!', 'green');
          $('#myModal').one('hidden.bs.modal', function () {
            get_content('school_info/add_bus_fee_category');
          });
          $('#myModal').modal('hide');
        } else {
          alert_new('Could not save. Please try again.', 'red');
        }
      },
      error: function () {
        $btn.prop('disabled', false);
        alert_new('Connection error. Please try again.', 'red');
      }
    });
  });
});
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Bus Fee Category</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">

  <div class="si-card">
    <div class="si-card-header">
      <div class="si-hdr-ico"><i class="fa fa-bus"></i></div>
      <h4>Bus Fee Category Management</h4>
    </div>
    <div class="si-card-body">

      <?php
      /* Collect class list once for both table headers and modal fields */
      $que1      = "select * from school_info_class_info where class_name!=''";
      $run1      = mysqli_query($conn73, $que1) or die(mysqli_error($conn73));
      $class_sno = 0; $class_code = []; $class_name1 = []; $class_code2 = '';
      while ($row1 = mysqli_fetch_assoc($run1)) {
          $class_name1[$class_sno] = $row1['class_name'];
          $class_code[$class_sno]  = $row1['class_code'];
          $class_code2             .= '|?|' . $row1['class_code'];
          $class_sno++;
      }

      /* Fetch bus fee categories */
      $que  = "select * from bus_fee_category";
      $run  = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
      $serial_no = 0; $add_more_button = 0;
      $fee_code_blank = ''; $last_name_str = '';
      $rows = [];
      while ($row = mysqli_fetch_assoc($run)) {
          $name_str = $row['bus_fee_category_name'] . '|?|' . $row['bus_fee_category_name_hindi'];
          for ($i = 0; $i < $class_sno; $i++) {
              $name_str .= '|?|' . ($row[$class_code[$i] . '_amount'] ?? '');
          }
          if ($row['bus_fee_category_name'] !== '' || $row['bus_fee_category_name_hindi'] !== '') {
              $row['_name_str'] = $name_str;
              $rows[]            = $row;
              $serial_no++;
          } else {
              if ($add_more_button === 0) { $fee_code_blank = $row['bus_fee_category_code']; $last_name_str = $name_str; }
              $add_more_button++;
          }
      }
      ?>

      <input type="hidden" id="all_class_codes" value="<?php echo htmlspecialchars($class_code2); ?>">

      <div class="si-tbl-wrap">
        <table class="si-tbl">
          <thead>
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Category (Hindi)</th>
              <?php for ($i = 0; $i < $class_sno; $i++): ?>
              <th><?php echo htmlspecialchars($class_name1[$i]); ?></th>
              <?php endfor; ?>
              <th class="cen">Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $idx => $r): ?>
            <tr>
              <td><span class="si-sno"><?php echo $idx + 1; ?></span></td>
              <td><?php echo htmlspecialchars($r['bus_fee_category_name']); ?></td>
              <td><?php echo htmlspecialchars($r['bus_fee_category_name_hindi']); ?></td>
              <?php for ($j = 0; $j < $class_sno; $j++): ?>
              <td>
                <?php
                $amt = $r[$class_code[$j] . '_amount'] ?? '';
                if ($amt !== '') echo '<span class="si-badge si-badge-pri">₹' . htmlspecialchars($amt) . '</span>';
                else echo '<span style="color:#cbd5e1;">—</span>';
                ?>
              </td>
              <?php endfor; ?>
              <td class="cen">
                <button type="button"
                  class="si-btn si-btn-ok"
                  style="padding:5px 12px;font-size:12px;"
                  id="<?php echo htmlspecialchars($r['bus_fee_category_code']); ?>"
                  name="<?php echo htmlspecialchars($r['_name_str']); ?>"
                  onclick="add_edit(this.id,this.name)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-pencil"></i> Edit
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php if ($add_more_button > 0): ?>
            <tr>
              <td colspan="<?php echo 4 + $class_sno; ?>" class="cen" style="padding:12px;">
                <button type="button"
                  class="si-btn si-btn-pri"
                  id="<?php echo htmlspecialchars($fee_code_blank); ?>"
                  name="<?php echo htmlspecialchars($last_name_str); ?>"
                  onclick="add_edit(this.id,this.name)"
                  data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i> Add More
                </button>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>
</section>

<!-- ══ Add / Edit Bus Fee Category Modal ══ -->
<div class="modal fade si-modal" id="myModal" role="dialog">
  <form role="form" method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" id="myModal_close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="si_bus_modal_title">Add / Edit Bus Fee Category</h4>
        </div>

        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="si-fg">
                <label>Category Name <span class="req">*</span></label>
                <div class="si-iw">
                  <i class="fa fa-bus ico"></i>
                  <input type="text" name="bus_fee_type1" id="bus_fee_type1" class="si-ctrl"
                    placeholder="Bus fee category (English)" required>
                  <input type="hidden" name="bus_fee_code_hidden" id="bus_fee_code_hidden">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="si-fg">
                <label>Category Name Hindi</label>
                <div class="si-iw">
                  <i class="fa fa-font ico"></i>
                  <input type="text" name="bus_fee_type_hindi" id="bus_fee_type_hindi" class="si-ctrl"
                    placeholder="श्रेणी नाम (हिंदी)">
                </div>
              </div>
            </div>
          </div>

          <!-- Same-fee checkbox -->
          <div style="margin-bottom:14px;padding:10px 14px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
            <div class="si-chk">
              <input type="checkbox" id="same_fee">
              <label for="same_fee">Apply the same fee amount to all classes</label>
            </div>
          </div>

          <!-- Per-class amount grid -->
          <div class="si-sec">Class-wise Fee Amount</div>
          <div class="row">
            <?php for ($k = 0; $k < $class_sno; $k++): ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
              <div class="si-fg">
                <label><?php echo htmlspecialchars($class_name1[$k]); ?></label>
                <div class="si-iw">
                  <i class="fa fa-inr ico"></i>
                  <input type="number" min="0"
                    name="classwise_amount[]"
                    id="<?php echo htmlspecialchars($class_code[$k]); ?>_amount"
                    class="si-ctrl bus_fee"
                    placeholder="0"
                    oninput="for_same(this.value);">
                  <input type="hidden" name="class_code_hidden[]"
                    value="<?php echo htmlspecialchars($class_code[$k]); ?>">
                </div>
              </div>
            </div>
            <?php endfor; ?>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" name="finish" class="si-btn si-btn-ok">
            <i class="fa fa-check"></i> Save
          </button>
          <button type="button" class="si-btn si-btn-ghost" data-dismiss="modal">
            <i class="fa fa-times"></i> Close
          </button>
        </div>

      </div>
    </div>
  </form>
</div>
