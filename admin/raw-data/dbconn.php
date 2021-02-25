<?php
$GLOBALS['header_project_name'] ="Seabird Employee Development Matrix Software";
error_reporting(0);
class DatabaseConn {
    public function getConnection() {
        ///// DEVELOPMENT
        
        /*$dbuser = "root";
        $dbpass = "";
        $dbname = "jkfinerm_mjportro_pro";*/
        
        $dbuser = "root";
        $dbpass = "";
        $dbname = "hydmjlsl_vikas";
        
      
        $mycon = mysqli_connect("localhost", $dbuser, $dbpass, $dbname);

       // $apiBaseURL = "/api/";

        if (!$mycon) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $mycon;
    }
}

?>