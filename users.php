<?php

function userExists($username) {
  // global keywords is used to access a global variable from within a function
  global $mycon;

  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($mycon, $sql);
  /* if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)){ } } */

  if (mysqli_num_rows($result) == 1) {
    return true;
  } else {
    return false;
  }


  // close the database myconion
}

function userExistsupdate($username) {
  // global keywords is used to access a global variable from within a function
  global $mycon;

  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($mycon, $sql);
  /* if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)){ } } */

  if (mysqli_num_rows($result) > 1) {
    return true;
  } else {
    return false;
  }


  // close the database myconion
}

function salt($length) {
  return mcrypt_create_iv($length);
}

function makePassword($password, $salt) {
  return hash('sha256', $password . $salt);
}

function userdata($username) {
  global $mycon;
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result1 = mysqli_query($mycon, $sql);

  $result = mysqli_fetch_assoc($result1);
  if (mysqli_num_rows($result1) > 0) {
    return $result;
  } else {
    return false;
  }


  // close the database myconion
}

function departmentdata($roleid) {
  global $mycon;
  $sql = "SELECT role FROM tbl_roles WHERE roleId = '$roleid'";
  $result1 = mysqli_query($mycon, $sql);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $department = $row1['role'];
    }
    return $department;
  } else {
    return false;
  }
}

function login($username, $password) {
  global $mycon;
  $userdata = userdata($username);

  if ($userdata) {
    $makePassword = md5($password);
    echo $sql = "SELECT * FROM users WHERE username = '$username' ";
//    echo $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$makePassword'";
    $result1 = mysqli_query($mycon, $sql);

    if (mysqli_num_rows($result1) > 0) {
      return true;
    } else {
      return false;
    }
  }


  // close the database myconion
}

function is_login_somewhere($username, $password) {
  global $mycon;
  $userdata = userdata($username);

  if ($userdata) {
    $makePassword = md5($password);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$makePassword' AND is_login = 1 AND role != 1";
    $result1 = mysqli_query($mycon, $sql);

    if (mysqli_num_rows($result1) > 0) {
      $is_login_value = mysqli_num_rows($result1);
    } else {
      $is_login_value = 0;
    }
  }

  return $is_login_value;
  // close the database myconion
}

function getUserDataByUserId($id) {
  global $mycon;

  $sql = "SELECT * FROM users WHERE id = $id";
  //die;
  $result1 = mysqli_query($mycon, $sql);

  $result = mysqli_fetch_assoc($result1);
  return $result;
}

function getcustomerById($id) {
  global $mycon;
  $sql = "SELECT * FROM customer_master WHERE customer_id = $id";
  $result1 = mysqli_query($mycon, $sql);
  $result = mysqli_fetch_assoc($result1);
  return $result;
}

function get_himadiData($customer_code) {
  global $mycon;
  $sql = "SELECT * FROM customer_master WHERE customer_code = '$customer_code'";
  $result1 = mysqli_query($mycon, $sql);
  $result = mysqli_fetch_assoc($result1);
  return $result;
}

function users_exists_by_id($id, $username) {
  global $mycon;

  $sql = "SELECT * FROM users WHERE username = '$username' AND id != $id";
  $result1 = mysqli_query($mycon, $sql);
  if (mysqli_num_rows($result1) > 0) {
    return true;
  } else {
    return false;
  }
}

function updateInfo($id) {
  global $mycon;

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];

  $sql = "UPDATE users SET username = '$username', first_name = '$fname', last_name = '$lname', contact = '$contact', email = '$email' WHERE id = $id";
  $query = mysqli_query($mycon, $sql);
  if ($query) {
    return true;
  } else {
    return false;
  }
}

function logged_in() {
  if (isset($_SESSION['id'])) {
    return true;
  } else {
    return false;
  }
}

function not_logged_in() {
  if (isset($_SESSION['id']) === FALSE) {
    return true;
  } else {
    return false;
  }
}

function logout($id, $mycon) {
  if (logged_in() === TRUE) {

    $queryupdate = "update users set is_login = 0 WHERE id='" . $id . "'";
    $resultupdate = mysqli_query($mycon, $queryupdate);
    if ($resultupdate) {
      // remove all session variable
      session_unset();

      // destroy the session
      session_destroy();

      header('location: index.php');
    }
  }
}

function passwordMatch($id, $password) {
  global $mycon;

  $userdata = getUserDataByUserId($id);

  $makePassword = md5($password);

  if ($makePassword == $userdata['password']) {
    return true;
  } else {
    return false;
  }

  // close myconion
}

function changePassword($id, $password) {
  global $mycon;

  //$salt = salt(32);
  $makePassword = md5($password);

  $sql = "UPDATE users SET password = '$makePassword' WHERE id = $id";
  $query = mysqli_query($mycon, $sql);

  if ($query) {
    return true;
  } else {
    return false;
  }
}
