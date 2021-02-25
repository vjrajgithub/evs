<?php
require_once '../../init.php';
require_once 'function.php';

function get_all_no_of_rows($mycon, $srcitem, $srcfrom, $file_refNum) {
  $sql_query = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $srcitem . " " . $srcfrom . " " . $file_refNum . " order by id DESC";
  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
  //return $sql_query;
}

function get_total_no_of_rows($mycon, $srcitem, $srcfrom, $file_refNum) {
  $sql_query = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $file_refNum . "";
  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
  //return $sql_query;
}

$item_per_page = 20;
//continue only if $_POST is set and it is a Ajax request
if (isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

  if (isset($_POST["page"])) {
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if (!is_numeric($page_number)) {
      die('Invalid page number!');
    } //incase of invalid page number
  } else {
    $page_number = 1; //if there's no page number, set it to 1
  }

  if ($_GET["file_refNum"] != '') {
    $file_refNum = "AND file_ref_num = " . $_GET["file_refNum"];
  } else {
    $file_refNum = '';
  }

  if ($_POST["colunmData"] == 0) {
    $colunmData = '';
  } else {
    $colunmData = $_POST["colunmData"];
  }
  if ($_POST["item"] == 0) {
    $item = '';
  } else {
    $item = $_POST["item"];
  }
  if ($_POST["fromdt"] == 0) {
    $fromdt = '';
  } else {
    $fromdt = $_POST["fromdt"];
  }
  if ($_POST["todt"] == 0) {
    $todt = '';
  } else {
    $todt = $_POST["todt"];
  }

//Advance Search
  $startHour = "00:00:00";
  $endHour = "23:55:55";

  if ($item == 1) {
    $srcitem = " AND delivery = '" . trim($colunmData) . "'";
    $searchitem = 'Delivery';
  } else if ($item == 2) {
    $srcitem = " AND plant = '" . trim($colunmData) . "'";
    $searchitem = 'Plant';
  } else if ($item == 3) {
    $srcitem = " AND int_hu_no = '" . trim($colunmData) . "'";
    $searchitem = 'Int. HU No.';
  } else if ($item == 4) {
    $srcitem = " AND part_number = '" . trim($colunmData) . "'";
    $searchitem = 'Part Number';
  } else if ($item == 5) {
    $srcitem = " AND shipment = '" . trim($colunmData) . "'";
    $searchitem = 'Shipment';
  } else if ($item == 6) {
    $srcitem = " AND vun = '" . trim($colunmData) . "'";
    $searchitem = 'VUN';
  } else if ($item == 7) {
    $srcitem = " AND packMatls = '" . trim($colunmData) . "'";
    $searchitem = 'Pack Matls';
  } else if ($item == 8) {
    $srcitem = "";
    $searchitem = 'All';
  }

  if ($todt != '' || $fromdt != '') {
    $srcfrom = "AND created_at BETWEEN '" . $fromdt . " $startHour' AND '" . $todt . " $endHour'";
  } else {
    $srcfrom = '';
  }
//echo "colunmData--".$colunmData."<br/>fromdt--".$fromdt."<br/>todt--".$todt."<br/>item--".$item;
  ?>
  <p class="details_table">
  <?php
  if ($item == '') {
    $is_defaultshowEntries = get_total_no_of_rows($mycon, $srcitem, $srcfrom, $file_refNum);
    if ($is_defaultshowEntries > 20) {
      $defaultshowEntries = 20;
    } else {
      $defaultshowEntries = $is_defaultshowEntries;
    }
    ?>
      <span><b>Searched values : </b> Default Search</span> | <span>Showing <?php echo $defaultshowEntries; ?> by default of </span><span> <?php echo $is_defaultshowEntries; ?></span> <b> entries</b>
  <?php } else { ?>
      <span><b>Searched values : </b> <?php echo $searchitem . " - " . $colunmData; ?></span> | <span><?php echo get_all_no_of_rows($mycon, $srcitem, $srcfrom, $file_refNum); ?></span>| <span><b>Total No. of data :</b> <?php echo get_total_no_of_rows($mycon, $srcitem, $srcfrom, $file_refNum); ?></span>
  <?php } ?>
  </p>
  <table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
      <tr class="poke">
        <th>ShTy</th>
        <th>Delivery</th>
        <th>GoodsSt</th>
        <th>Plant</th>
        <th>Int. HU No.</th>
        <th>Part Code</th>
        <th>WUn</th>
        <th>Total volume</th>
        <th>Shipment</th>
        <th>VUn</th>
        <th>PackMatls</th>
        <th>Createdon</th>
        <th>Total weight</th>
        <th>HU qty</th>
        <th>Customer Code</th>
        <th>Concatenate</th>
        <th>file_ref_num</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      //get total number of records from database for pagination
      if ($item != '') {
        $sql_query = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $srcitem . " " . $srcfrom . " " . $file_refNum . " order by id DESC";
      } else {
        $sql_query = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $file_refNum . " order by id DESC";
      }
      $result = mysqli_query($mycon, $sql_query);
      $get_total_rows = mysqli_num_rows($result);
      $total_pages = ceil($get_total_rows / $item_per_page);
//$get_total_rows = $results->fetch_row(); //hold total records in variable
//break records into pages
//$total_pages = ceil($get_total_rows[0]/$item_per_page);
//get starting position to fetch the records
      $page_position = (($page_number - 1) * $item_per_page);

      if ($item != '') {
        $sql_query_fetch = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $srcitem . " " . $srcfrom . " " . $file_refNum . " order by id DESC LIMIT $page_position, $item_per_page";
      } else {
        $sql_query_fetch = "SELECT * FROM `prepack_stock` WHERE created_at !='' " . $file_refNum . " order by id DESC LIMIT $page_position, $item_per_page";
      }
      $result_fetch = mysqli_query($mycon, $sql_query_fetch);
      //echo '<br/>'.$sql_query_fetch;
      //echo '<br/>'.$sql_query;
      if (mysqli_num_rows($result_fetch) > 0) {
        while ($rowdata = mysqli_fetch_assoc($result_fetch)) {
          ?>
          <tr>
            <td><?php echo $rowdata['shty']; ?></td>
            <td><?php echo $rowdata['delivery']; ?></td>
            <td><?php echo $rowdata['goods_st']; ?></td>
            <td><?php echo $rowdata['plant']; ?></td>
            <td><?php echo $rowdata['int_hu_no']; ?></td>
            <td><?php echo $rowdata['part_number']; ?></td>
            <td><?php echo $rowdata['wun']; ?></td>
            <td><?php echo $rowdata['total_volume']; ?></td>
            <td><?php echo $rowdata['shipment']; ?></td>
            <td><?php echo $rowdata['vun']; ?></td>
            <td><?php echo $rowdata['packMatls']; ?></td>
            <td><?php echo $rowdata['created_on']; ?></td>
            <td><?php echo $rowdata['total_weight']; ?></td>
            <td><?php echo $rowdata['hu_qty']; ?></td>
            <td><?php echo $rowdata['customer_code']; ?></td>
            <td><?php echo $rowdata['concatenate']; ?></td>
            <td><?php echo $rowdata['file_ref_num']; ?></td>
            <td><a onclick="return confirm('Are you sure?')" href="prepack-material-uploaded-data.php?delete=<?php echo $rowdata['id']; ?>&file_refNum=<?php echo $file_refNum; ?>"><span data-tooltip="" title="" class="cursor" data-tooltip-id="0"><i class="fa fa-trash" aria-hidden="true" style="color:orange; font-size:17px; margin-left: 12px; font-weight:bold;"></i></span></a></td>
          </tr>
      <?php
    }
  }
} else {
  ?>
      <tr>
        <td><?php echo 'No Record Found'; ?></td>
      </tr>
<?php } ?>
  </tbody>
</table>
<?php
echo '<div align="center">';
/* We call the pagination function here to generate Pagination link for us.
  As you can see I have passed several parameters to the function. */
echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
echo '</div>';
?>
</div>

