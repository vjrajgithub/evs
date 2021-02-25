<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

//echo $locationuserid; die;
?>
<html>
    <head>
        <title>EDM Software | Seabird Logisolution</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            body
            {
                margin:0;
                padding:0;
                background-color:#f1f1f1;
            }
            .box
            {
                width: 100%;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
                min-width: 1900px;
            }
            table.table.table-bordered th {
                background-color: #5cb85cbf;
                color: #fff;
                letter-spacing: 0.4px;
            }
        </style>
        <style>
            .overlay {
                height: 0%;
                width: 100%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0, 0.9);
                overflow-y: hidden;
                transition: 0.5s;
            }

            .overlay-content {
                position: relative;
                top: 25%;
                width: 100%;
                text-align: center;
                margin-top: 30px;
            }

            .overlay a {
                padding: 8px;
                text-decoration: none;
                font-size: 36px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .overlay a:hover, .overlay a:focus {
                color: #f1f1f1;
            }

            .overlay .closebtn {
                position: absolute;
                top: 20px;
                right: 45px;
                font-size: 60px;
            }

            @media screen and (max-height: 450px) {
                .overlay {overflow-y: auto;}
                .overlay a {font-size: 20px}
                .overlay .closebtn {
                    font-size: 40px;
                    top: 15px;
                    right: 35px;
                }
            }
        </style>
        <script>
          function openNav() {
              document.getElementById("myNav").style.height = "100%";
          }

          function closeNav() {
              document.getElementById("myNav").style.height = "0%";
          }
        </script>
    </head>
    <body>
        <div id="myNav" class="overlay">
            <!--<a style="display:none;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>-->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                <h1 style="color:white;">
                    Loading Complete
                    <a href="javascript:void(0)" onclick="closeNav()">&times;</a>
                </h1>

            </div>
        </div>
        <div class="container box">
            <h3 align="center">Upload Matrix Data</h3>
            <br /><br />
            <br /><br />
            <a href="matrix-uploaded-file.php" class="btn btn-success">Back</a><br/><br/>
            <form mehtod="post" id="export_excel">
                <div>
                    <label for="location">File Reference Number: </label>
                    <input type="text" name="fileref" style="border:none;" value="<?php echo time(); ?>" readonly />
                    <br /><span>(*File Reference Number for future uses)</span>
                </div>
                <br />
                <div>
                    <label for="location">Warehouse Location: </label>
                    <select name="location" class="form-control" style="max-width:50%" required>

                        <?php
                        $locationquery = "SELECT * FROM tbl_location WHERE isDeleted != '1' AND loc_id='" . $locationuserid . "'";
                        echo $locationquery;
                        $locationResult = mysqli_query($mycon, $locationquery);
                        if (mysqli_num_rows($locationResult) > 0) {

                          while ($rowlocationResult = mysqli_fetch_assoc($locationResult)) {
                            ?>
                            <option value="<?php echo $rowlocationResult['loc_id']; ?>"><?php echo $rowlocationResult['loc_name']; ?></option>
                            <?php
                          }
                        }
                        ?>
                    </select>
                </div>
                <br />

                <div>

                    <label for="customer_name">Customer Name: </label>
                    <select class="form-control" name="customer_name"  style="max-width:50%" id="client_id" required>
                        <?php
                        $locationquery2 = "SELECT * FROM  tbl_clients WHERE 1=1 " . $access_location . "";
                        //echo $locationquery2;
                        $locationResult2 = mysqli_query($mycon, $locationquery2);
                        if (mysqli_num_rows($locationResult2) > 0) {

                          while ($rowlcustomer = mysqli_fetch_assoc($locationResult2)) {
                            ?>
                            <option value="<?php echo $rowlcustomer['id']; ?>"><?php echo $rowlcustomer['client']; ?></option>
                            <?php
                          }
                        }
                        ?>

                    </select>
                </div>
                <br/>
                <div>
                    <label>Select Excel</label>
                    <input type="file" name="excel_file" id="excel_file" required accept=".xls, .xlsx" />
                </div>
            </form>
            <br />
            <br />
            <div id="result">
            </div>
        </div>
    </body>
</html>
<script>
  $(document).ready(function () {
      $('#excel_file').change(function () {
          $('#export_excel').submit();
          openNav();
      });
      $('#export_excel').on('submit', function (event) {
          event.preventDefault();
          $.ajax({
              url: "export-matrix-data.php",
              method: "POST",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function (data) {
                  $('#result').html(data);
                  $('#excel_file').val('');
                  closeNav();
              }
          });
      });
  });
</script>

<!-- advance_search -->
<script type="text/javascript">
  var divs = ["Div1", "Div2"];
  var visibleDivId = null;
  function divVisibility(divId) {
      if (visibleDivId === divId) {
          visibleDivId = null;
      } else {
          visibleDivId = divId;
      }
      hideNonVisibleDivs();
  }
  function hideNonVisibleDivs() {
      var i, divId, div;
      for (i = 0; i < divs.length; i++) {
          divId = divs[i];
          div = document.getElementById(divId);
          if (visibleDivId === divId) {
              div.style.display = "block";
          } else {
              div.style.display = "none";
          }
      }
  }
</script>


<script type="text/javascript">
  var element = document.getElementsByClassName("nav-list li")[0];
  element.addEventListener("click", myFunction);
  // alert('test...')
  function myFunction(e) {
      var elems = document.querySelector(".active");
      if (elems != null) {
          elems.classList.remove("active");
      }
      e.target.className = "active";
  }
</script>
<!-- advance_search -->