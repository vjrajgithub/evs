<?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}

        $tname = $_GET['username'];
        $passs = $_GET['passs'];
	    
	$txtPassword = hash("sha256", $passs);
		
		 	  $query="select * from client_users where username ='".strtolower($tname)."' and user_password='".$txtPassword."' and is_deleted=2";

 			$result = mysqli_query($mycon, $query);
 	   
			$total=mysqli_num_rows($result);
			
			if($total==1)
			{
				$state_id=array();
				if ($row = mysqli_fetch_array($result))
				{
					
						session_start();
						$user_db_id=$row['user_id'];
						$user_db_name=$row['username'];
						
						$_SESSION['RWSSP_USER_KEY'] = session_id();
						$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
						$_SESSION['RWSSP_USER_NAME']=$user_db_name;
						$_SESSION['RWSSP_USER_ID']=$user_db_id;
					
						$_SESSION['Level']=1;
						echo "1";
				}
				else
				{
				echo "0";
   
				}
			}else
				{
				echo "0";
   
				}
			


?>
