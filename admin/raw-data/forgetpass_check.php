<?php

require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$email = $_GET['email'];


$to = $email;
$subject = "Reset Password";
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Dear $email,</p>
<p>Thank you for creating a account. Please visit the link below and sign into your account to verify your email address and complete your registration.</p>
<br/>
<a href='http://seabirdlogisolutions.co/index_forget.php?email=$email'>Click to verify</a>
<br/>
<p>You are receiving this email because you recently created an account . If you did not do this, please contact us.
</p>
<b>Seabird Logisolutions PVT. LTD.
</b>
<br/>
<b>http://seabirdlogisolutions.co/</b>
<br/>
<b>visit our website | log in to your account | get support
</b>
<br/>
<b>
Copyright © Seabird Logisolutions PVT. LTD.
</b>
<br/>
<b>All rights reserved.
</b>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to, $subject, $message, $headers);
?>
