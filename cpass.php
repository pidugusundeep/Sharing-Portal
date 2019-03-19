<?php
session_Start();
$pass = $_POST['pass'];
$id = $_SESSION['id'];

include("conn.php");
	$cp = "UPDATE users SET pass='$pass' WHERE ID='$id' ";
	$x = mysql_query($cp,$conn)or die(mysql_error());
	if(isset($x)){
		$_SESSION['errorlogin'] = 'password changed';
		header( "refresh:0; url=settings.php" );
	}
	else{
		$_SESSION['errorlogin'] = 'password not changed';
		header( "refresh:0; url=settings.php" );
	}
	
?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>