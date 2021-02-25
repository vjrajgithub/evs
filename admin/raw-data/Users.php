<?php

include_once 'dbconn.php';

class Users {

    var $user;
    var $pass;

    function getAllUsers() {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        $sql = "SELECT username, fullname, password, role, email, phone, last_updated_at, active, pin, last_seen FROM client_users order by last_updated_at";

        $result = mysqli_query($mycon, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        mysqli_close($mycon);
        return $users;
    }
    
    function logOutUser($username) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        
        

        $sql = "update client_users set last_seen=NOW() where username='" . $username. "'";
        
        if (mysqli_query($mycon, $sql)) {
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        //return $json;
    }
    
    function getUsersByType($userType) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        $sql = "SELECT username, fullname, password, role, email, phone, last_updated_at, active "
                . "FROM client_users where role='".$userType."' order by last_updated_at";

        $result = mysqli_query($mycon, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        mysqli_close($mycon);
        return $users;
    }
    
    function loginUser($username, $pass, $userType) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();
        $password = hash("sha256", $pass);
        $sql = "SELECT username, fullname, role, email, phone, last_updated_at, active "
                . "FROM client_users where username='".$username."' and password='".$password."' and role='".$userType."' order by last_updated_at";

        //echo $sql;
        $result = mysqli_query($mycon, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        mysqli_close($mycon);
        return $users;
    }

    function addUser($user) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();

        $password = hash("sha256", "wih1234");
        $sql = "INSERT INTO client_users(username, fullname, password, role, email, phone, "
                . "last_updated_at, active) "
                . "VALUES ('" . $user["username"] . "','" . $user["fullname"] . "', '" . $password . "', '" . $user["role"] . "', "
                . "'" . $user["email"] . "', '" . $user["phone"] . "', NOW(),'" . $user["active"] . "') "
                . " ON DUPLICATE KEY UPDATE fullname='" . $user["fullname"] . "', role='" . $user["role"] . "', "
                . "email='" . $user["email"] . "', "
                . "phone='" . $user["phone"] . "', last_updated_at=NOW(), active='" . $user["active"] . "'";

        
        if (mysqli_query($mycon, $sql)) {
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        return $json;
    }
    
    function resetPass ($user) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();

        $password = hash("sha256", "wih1234");
        $sql = "update client_users set password='" . $password . "' where username='" . $user["username"] . "'";
        
        if (mysqli_query($mycon, $sql)) {
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        return $json;
    }
    
    function resetPIN ($user) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();

        $password = hash("sha256", "wih1234");
        $sql = "update client_users set pin='0000' where username='" . $user["username"] . "'";
        
        if (mysqli_query($mycon, $sql)) {
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        return $json;
    }
    
    function changePass ($user) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();

        $password = hash("sha256", $user["password"]);
        $sql = "update client_users set password='" . $password . "' where username='" . $user["username"] . "'";
        
        if (mysqli_query($mycon, $sql)) {
            $json = array("status" => 1, "msg" => "Done");
        } else {
            $json = array("status" => 0, "msg" => "Server Error");
        }
        mysqli_close($mycon);
        return $json;
    }
    
    function changeUserPass($username, $oldpass, $newpass) {
        $dbConn = new DatabaseConn();
        $mycon = $dbConn->getConnection();

        $np = hash("sha256", $newpass);
        $op = hash("sha256", $oldpass);
        $sql = "update client_users set password='" . $np . "' where username='" . $username . "' and password='".$op."'";
        
        if (mysqli_query($mycon, $sql)) {
            $json = "1";
        } else {
            $json = "0";
        }
        mysqli_close($mycon);
        return $json;
    }

}

//$ul = new Users();
//$tt = json_decode("{\"username\":\"admin\",\"fullname\":\"Admin User\",\"password\":\"30837144b30d70c64d7d15017b6eb410a15c593a07a715a39e6d825a2ba64266\",\"role\":\"admin\",\"email\":\"\",\"phone\":\"\",\"last_updated_at\":\"2017-04-16 17:07:22\",\"active\":\"1\"}", true);
//echo $ttt;
//echo json_encode($ul->resetPass($tt));
?>