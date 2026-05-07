<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<script>
function rfid_submit() {
    var rfid = $.trim($('#rfid_no').val());
    if (rfid === '') { alert_new('RFID card number is required.', 'red'); return; }
    var $btn = $('#rfid_add_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/rfid_card_add_api.php',
        data: { rfid_no: rfid },
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('RFID card added successfully!', 'green');
                $('#rfid_no').val('').focus();
                fetch_list();
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

function rfid_delete(s_no) {
    if (!confirm('Delete this RFID card?\nThis cannot be undone.')) return;
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/rfid_delete.php?id=' + s_no,
        cache: false,
        success: function (detail) {
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('RFID card deleted.', 'green');
                fetch_list();
            } else {
                alert_new('Could not delete. Please try again.', 'red');
            }
        }
    });
}

function fetch_list() {
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/rfid_list_fatch.php',
        cache: false,
        success: function (detail) { $('#rfid_data').html(detail); }
    });
}
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Add RFID Card</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="row">

    <!-- ── Left: Add RFID ── -->
    <div class="col-md-4">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-credit-card"></i></div>
          <h4>Add RFID Card</h4>
        </div>
        <div class="si-card-body">
          <div class="si-fg">
            <label>RFID Card Number <span class="req">*</span></label>
            <div class="si-iw">
              <i class="fa fa-credit-card ico"></i>
              <input type="text" id="rfid_no" class="si-ctrl" placeholder="Scan or enter RFID number" autofocus
                onkeypress="if(event.keyCode==13) rfid_submit();">
            </div>
          </div>
          <button type="button" id="rfid_add_btn" onclick="rfid_submit();" class="si-btn si-btn-ok" style="width:100%;">
            <i class="fa fa-plus"></i> Add RFID Card
          </button>
        </div>
      </div>
    </div>

    <!-- ── Right: RFID List ── -->
    <div class="col-md-8">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-list"></i></div>
          <h4>RFID Card List</h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th>RFID Card No</th>
                  <th class="cen"><?php echo $language['Delete']; ?></th>
                </tr>
              </thead>
              <tbody id="rfid_data">
                <?php
                $que = "select * from school_info_rfid_card order by s_no DESC";
                $run = mysqli_query($conn73, $que) or die(mysqli_error($conn73));
                $total = mysqli_num_rows($run);
                $sno   = $total;
                while ($row = mysqli_fetch_assoc($run)):
                ?>
                <tr>
                  <td><span class="si-sno"><?php echo $sno--; ?></span></td>
                  <td><strong><?php echo htmlspecialchars($row['rfid_no']); ?></strong></td>
                  <td class="cen">
                    <button type="button" class="si-btn si-btn-del" style="padding:5px 14px;font-size:12px;"
                      onclick="rfid_delete('<?php echo htmlspecialchars($row['s_no']); ?>')">
                      <i class="fa fa-trash"></i> <?php echo $language['Delete']; ?>
                    </button>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>
