<?php
$GLOBALS['header_project_name'] ="EVS Software | Himadi Solutions";
error_reporting(0);
class DatabaseConn {
    public function getConnection() {
        ///// DEVELOPMENT

        $dbuser = "root";
        $dbpass = "";
        $dbname = "evs_new_db";
        
        $mycon = mysqli_connect("localhost", $dbuser, $dbpass, $dbname);

       // $apiBaseURL = "/api/";

        if (!$mycon) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $mycon;
    }
}

?>