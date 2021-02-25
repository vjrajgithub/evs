<?php

include_once 'dbconn.php';

class UserLogin {
  
    var $user;
    var $pass;
    var $bay;

    function __construct($u, $p) {
        $this->user = $u;
        $this->pass = $p;
     
    }
    
    public function checkLogin() {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        $pp = md5($this->pass);
        $rr = "";
        $sql = "select * from client_users where username='".$this->user."' and user_password='".$pp."'";

        $result = mysqli_query($mycon, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"] . " - Name: " . $row["fullname"];
                $user[] = $row;
                
            }
        }
        mysqli_close($mycon);
        return $user;
    }
    
    function logOutUser($user) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        
        $sql = "update client_users set last_updated_at=NOW() where username='" . $user["username"]. "'";
        if (mysqli_query($mycon, $sql)) {
           
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        //return $json;
    }

}

?>