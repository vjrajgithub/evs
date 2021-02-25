<?php
$dataAbout = "Employee with 100% Knowledge in Dispatch Document Checking process";

function get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
  $sql_query = "SELECT tu . *, tm.emp_id, tm.cust_code, tm.loc_code  FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
    tm.dispatch_document_checking_process = 100
    " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tu.name";

  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
}

function get_total_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
  $sql_query = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm . emp_id AND
          tm . binning_system_process = 100 ";
  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
}

include_once 'include/head.php';
?>
<!-- <h3>Download report in excel</h3> -->
<form action="report-dispatch-document-checking-process.php" onsubmit="submitForm()" method="POST" style="display: flex;justify-content: center;text-align: center;">
    <?php include_once 'include/downloadform.php'; ?>
</form>

<?php
include_once 'include/datatablehead.php';
if ($_POST['item'] != '') {
  $sql_query = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
                                                    tm.dispatch_document_checking_process = 100
                                                    " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";
} else {
  $sql_query = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
                                                    tm.dispatch_document_checking_process = 100
                                                    " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id LIMIT 0, 20";
}
// echo $sql_query."<br />srcitem---".$srcitem."<br />srcfrom---".$srcfrom."<br />item--".$_POST['item']."<br />colunmData--".$_POST['colunmData'];
$result = mysqli_query($mycon, $sql_query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    $loc_name = get_loc_name($mycon, $row['loc_code']);
    $customer = get_Customer($mycon, $row['cust_code']);
    ?>
    <tr style="display: table-row;" role="row" class="odd">
        <td tabindex="0" class="sorting_1"><?php echo $row['emp_code']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['designation']; ?></td>
        <td><?php echo $row['main_department']; ?></td>
        <td><?php echo $row['doj']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $loc_name; ?></td>
        <td><?php echo $customer; ?></td>
    </tr>
    <?php
  }
}
include_once 'include/datatablefooter.php';
?>

</html>