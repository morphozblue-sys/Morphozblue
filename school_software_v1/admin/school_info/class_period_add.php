<?php include("../attachment/session.php"); ?>
<?php include("si_form_ui.php"); ?>
<style>
.period-row { display:flex; gap:10px; align-items:center; margin-bottom:10px; }
.period-row .si-ctrl { flex:1; }
.period-row .time-ctrl { width:130px; flex-shrink:0; }
.period-row .rm-btn { flex-shrink:0; }
</style>
<script>
function add_period_row() {
    var row = document.createElement('div');
    row.className = 'period-row';
    row.innerHTML =
        '<input type="text"  name="period_name[]"       class="si-ctrl"      placeholder="Period name (e.g. period1)" required>' +
        '<input type="time"  name="period_start_time[]" class="si-ctrl time-ctrl" required>' +
        '<input type="time"  name="period_end_time[]"   class="si-ctrl time-ctrl" required>' +
        '<button type="button" class="si-btn si-btn-del rm-btn" onclick="this.parentNode.remove()"><i class="fa fa-minus"></i></button>';
    document.getElementById('period_rows').appendChild(row);
}

function period_submit() {
    var $btn = $('#period_save_btn');
    if ($btn.prop('disabled')) return;
    $btn.prop('disabled', true);
    var formdata = new FormData(document.getElementById('period_form'));
    $.ajax({
        type: 'POST',
        url: access_link + 'school_info/class_period_add_api.php',
        data: formdata,
        mimeTypes: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (detail) {
            $btn.prop('disabled', false);
            var res = detail.split('|?|');
            if (res[1] === 'success') {
                alert_new('Periods added successfully!', 'green');
                get_content('school_info/class_period_add');
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
</script>

<section class="content-header">
  <h1><?php echo $language['School Information Management']; ?> <small><?php echo $language['Control Panel']; ?></small></h1>
  <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-graduation-cap"></i> <?php echo $language['School Info']; ?></a></li>
    <li class="active">Add Class Period</li>
  </ol>
</section>

<section class="content">
<div style="padding:0 10px 30px;">
  <div class="row">

    <!-- ── Left: Add Form ── -->
    <div class="col-md-6">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-clock-o"></i></div>
          <h4>Add Periods</h4>
        </div>
        <div class="si-card-body">
          <div style="display:flex;gap:10px;margin-bottom:6px;font-size:11px;font-weight:700;text-transform:uppercase;color:#64748b;letter-spacing:.5px;">
            <div style="flex:1;">Period Name</div>
            <div style="width:130px;">Start Time</div>
            <div style="width:130px;">End Time</div>
            <div style="width:36px;"></div>
          </div>
          <form id="period_form">
            <div id="period_rows">
              <div class="period-row">
                <input type="text" name="period_name[]"       class="si-ctrl"           placeholder="e.g. period1" required>
                <input type="time" name="period_start_time[]" class="si-ctrl time-ctrl"  required>
                <input type="time" name="period_end_time[]"   class="si-ctrl time-ctrl"  required>
                <button type="button" class="si-btn si-btn-del rm-btn" onclick="this.parentNode.remove()"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div style="display:flex;gap:10px;margin-top:14px;">
              <button type="button" onclick="add_period_row();" class="si-btn si-btn-ghost">
                <i class="fa fa-plus"></i> Add Row
              </button>
              <button type="button" id="period_save_btn" onclick="period_submit();" class="si-btn si-btn-ok">
                <i class="fa fa-check"></i> Save Periods
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- ── Right: Existing Periods ── -->
    <div class="col-md-6">
      <div class="si-card">
        <div class="si-card-header">
          <div class="si-hdr-ico"><i class="fa fa-list"></i></div>
          <h4>Period List</h4>
        </div>
        <div class="si-card-body" style="padding-top:16px;">
          <div class="si-tbl-wrap">
            <table class="si-tbl">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Period Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $que = "select * from school_info_class_period";
                $run = mysqli_query($conn73, $que);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($run)):
                    $sno++;
                ?>
                <tr>
                  <td><span class="si-sno"><?php echo $sno; ?></span></td>
                  <td><strong><?php echo htmlspecialchars($row['period_name']); ?></strong></td>
                  <td><?php echo htmlspecialchars($row['period_start_time']); ?></td>
                  <td><?php echo htmlspecialchars($row['period_end_time']); ?></td>
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
