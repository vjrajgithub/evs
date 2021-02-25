
<script type="text/javascript">

  /**
   Demo script to session expired
   **/
  //var warningTimeoutminutes = 1; //Minutes
  //var timoutNowminutes = 2; //Minutes
  var warningTimeout = 840000; // Display warning in 14 Mins. 840000
  var timoutNow = 900000; // Timeout in 15 mins would be 900000.
  var warningTimerID, timeoutTimerID;
  var logoutUrl = '../logout.php';

  var timeout = timoutNow;

  function startTimer() {
      // window.setTimeout returns an Id that can be used to start and stop a timer
      warningTimerID = window.setTimeout(warningInactive, warningTimeout);

  }

  function SessionExpireAlert(timoutNow) {
      var seconds = timoutNow / 1000;
      setInterval(function () {
          seconds--;
          //document.getElementById("seconds").innerHTML = seconds;
          //document.getElementById("secondsIdle").innerHTML = seconds;
          var minutes = Math.floor(seconds / 60);
          var measuredTime = new Date(null);
          measuredTime.setSeconds(seconds); // specify value of SECONDS
          var MHSTime = measuredTime.toISOString().substr(11, 8);
          // Hours, minutes and seconds

          //var finalTime = str_pad_left(minutes,'0',2)+':'+str_pad_left(seconds,'0',2);
          document.getElementById('secondsIdle').innerHTML = MHSTime;
          //unset(MHSTime);
          //console.log(seconds);
      }, 1000);
  }
  ;

//console.log(timeoflogout);
//document.getElementById('secondsIdle').innerHTML=timeoflogout;
//console.log(warningTimerID);

  function warningInactive() {
      window.clearTimeout(warningTimerID);
      timeoutTimerID = window.setTimeout(IdleTimeout, timoutNow);
      $('#modalAutoLogout').modal('show');
      //document.getElementById("settimeshow").style.display = "block";
      // SessionExpireAlert(timoutNow);
  }

  function resetTimer() {
      window.clearTimeout(timeoutTimerID);
      window.clearTimeout(warningTimerID);
      startTimer();
  }

// Logout the user.
  function IdleTimeout() {
      window.location = logoutUrl;
  }

  $(document).on('click', '#logout-form', function () {
      window.location = logoutUrl;
  });






  function setupTimers() {
      document.addEventListener("mousemove", resetTimer, false);
      document.addEventListener("mousedown", resetTimer, false);
      document.addEventListener("keypress", resetTimer, false);
      document.addEventListener("touchmove", resetTimer, false);
      document.addEventListener("onscroll", resetTimer, false);
      startTimer();
  }

  $(document).on('click', '#btnStayLoggedIn', function () {
      resetTimer();
      document.location.reload();
      $('#modalAutoLogout').modal('hide');
      //document.getElementById("settimehide").style.display = "none";
  });


  $(document).ready(function () {
      setupTimers();
      SessionExpireAlert(timoutNow);
      //console.log(warningTimerID);
  });

</script>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAutoLogout">Open Modal</button> -->

<!-- Modal -->

<!-- small modal -->
<div class="modal fade" id="modalAutoLogout" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" >
            <!-- <div class="modal-header"> -->
            <!-- <h4 class="modal-title" id="myModalLabel">Small Modal</h4> -->
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
              <!-- <span aria-hidden="true">&times;</span> -->
            <!-- </button> -->
            <!-- </div> -->
            <div class="modal-body">
                <h3>Your Session is about to expire.</h3>
            </div>
            <div class="modal-footer">
                <button type="button"  id="logout-form" class="btn btn-danger">Login Again</button>
                <button type="button" id="btnStayLoggedIn" class="btn btn-primary">Stay Connected</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
      $("#modalAutoLogout").modal({
          show: false,
          backdrop: 'static'
      });
  })
</script>

  <footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 footer_copy_logo">
                <div style=" margin-top: 22px; color: #fff;">
                    2019 © Seabird Logisolutions Limited
                </div>

            </div>
        </div>
    </div>
</footer>



