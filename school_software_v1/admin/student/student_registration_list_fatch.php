<?php
error_reporting(0);
include("../attachment/session.php");

$request       = $_REQUEST;
$student_class = $_GET['student_class'] ?? 'All';

$condition1 = ($student_class !== 'All')
    ? " AND student_class='" . mysqli_real_escape_string($conn73, $student_class) . "'"
    : '';

$base_where = "registration_final='no' AND student_status='Deactive' AND session_value='$session1'$filter37$condition1";

/* ── Total count (unfiltered) ── */
$total_sql = "SELECT s_no FROM student_admission_info WHERE $base_where";
$total_res  = mysqli_query($conn73, $total_sql);
$totalData  = mysqli_num_rows($total_res);

/* ── Build SELECT with optional search ── */
$select_cols = "s_no, student_name, student_father_name, student_class, student_roll_no,
                student_father_contact_number, student_date_of_admission, student_remark_1,
                student_registration_number, student_registration_fee, update_change, last_updated_date";

$sql = "SELECT $select_cols FROM student_admission_info WHERE $base_where";

$search_val = trim($request['search']['value'] ?? '');
if ($search_val !== '') {
    $sv = mysqli_real_escape_string($conn73, $search_val);
    $sql .= " AND (student_name LIKE '%$sv%'
               OR student_father_name LIKE '%$sv%'
               OR student_class LIKE '%$sv%'
               OR student_registration_number LIKE '%$sv%'
               OR student_father_contact_number LIKE '%$sv%'
               OR student_date_of_admission LIKE '%$sv%'
               OR student_remark_1 LIKE '%$sv%'
               OR update_change LIKE '%$sv%')";
}

$count_res   = mysqli_query($conn73, $sql);
$totalFilter = mysqli_num_rows($count_res);

$start  = (int)($request['start']  ?? 0);
$length = (int)($request['length'] ?? 10);
$sql   .= " ORDER BY s_no DESC LIMIT $start, $length";
$query  = mysqli_query($conn73, $sql);

/* ── PDF paths ── */
$registration_form_pdf = '';
$reg_fee_reciept       = '';
$pdf_run = mysqli_query($conn73, "SELECT registration_form_pdf, reg_fee_reciept FROM school_info_pdf_info");
if ($pdf_row = mysqli_fetch_assoc($pdf_run)) {
    $registration_form_pdf = $pdf_row['registration_form_pdf'];
    $reg_fee_reciept       = $pdf_row['reg_fee_reciept'];
}

/* ── Build rows ── */
$data      = [];
$serial_no = $start;

while ($row = mysqli_fetch_assoc($query)) {
    $serial_no++;

    $s_roll     = htmlspecialchars($row['student_roll_no']);
    $s_name     = htmlspecialchars($row['student_name']);
    $s_father   = htmlspecialchars($row['student_father_name']);
    $s_class    = htmlspecialchars($row['student_class']);
    $s_contact  = htmlspecialchars($row['student_father_contact_number']);
    $s_doa      = htmlspecialchars($row['student_date_of_admission']);
    $s_reg_no   = htmlspecialchars($row['student_registration_number']);
    $s_reg_fee  = htmlspecialchars($row['student_registration_fee']);
    $s_updated  = htmlspecialchars($row['update_change']);
    $s_upd_date = ($row['last_updated_date'] !== '0000-00-00')
                    ? date('d-m-Y', strtotime($row['last_updated_date']))
                    : '—';

    $pdf_link  = $pdf_path . "registration_form/" . $registration_form_pdf . "?id=" . $s_roll;
    $pdf_link1 = $pdf_path . "reg_fee_reciept/"   . $reg_fee_reciept       . "?id=" . $s_roll;

    $btn_admit  = "<button type='button' onclick=\"post_content('student/student_admission','student_roll_no=$s_roll')\" class='rl-act rl-act-admit'><i class='fa fa-check'></i> " . $language['Make Admission'] . "</button>";
    $btn_print  = "<a href='$pdf_link' target='_blank'><button type='button' class='rl-act rl-act-print'><i class='fa fa-print'></i> " . $language['Print'] . "</button></a>";
    $btn_fee    = "<a href='$pdf_link1' target='_blank'><button type='button' class='rl-act rl-act-fee'><i class='fa fa-file-text'></i> Fee Receipt</button></a>";
    $btn_delete = "<button type='button' class='rl-act rl-act-delete' onclick=\"valid('$s_roll','$s_doa','$s_reg_fee')\"><i class='fa fa-trash'></i> " . $language['Delete'] . "</button>";

    $name_cell  = "<span class='rl-name'>$s_name</span>";
    $class_cell = "<span class='rl-class-badge'>$s_class</span>";

    $data[] = [
        $serial_no,
        $name_cell,
        $s_father,
        $class_cell,
        $s_contact,
        $s_doa,
        $s_reg_no,
        $s_updated,
        $s_upd_date,
        $btn_admit,
        $btn_print,
        $btn_fee,
        $btn_delete,
    ];
}

echo json_encode([
    "draw"            => intval($request['draw'] ?? 1),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data"            => $data,
]);
?>
