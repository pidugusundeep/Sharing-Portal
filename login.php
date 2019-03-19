<?php
	include("conn.php");
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query1 = "SELECT * from users WHERE mail='$username' and pass='$password'";
	
	$login = mysql_query($query1,$conn)or die(mysql_error());
	$res = mysql_fetch_array($login);
	if($res){
		session_start();
		$_SESSION['uname'] = $res['uname'];
		$_SESSION['mail'] = $res['mail'];
		header( "refresh:0; url=index.php" );
		unset($_SESSION['errorlogin']);
		$_SESSION['welcome_msg'] = $res['uname'];
		$_SESSION['password'] = $res['pass'];
		$_SESSION['id'] = $res['ID'];
		$_SESSION['phone'] = $res['tel'];
	}
	else{
		
		session_start();
		$_SESSION['errorlogin'] = "INCORRECT LOGIN DETAILS";
		header( "refresh:2; url=index.php" );
	}
	mysql_close($conn);

?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>