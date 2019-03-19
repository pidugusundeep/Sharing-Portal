<?php
	include("conn.php");
	$uname = $_POST["uname"];
	$pass = $_POST['pass'];
	$tel = $_POST['tel'];
	$mailid = $_POST['mail'];

	$result = mysql_query("SELECT count(*) FROM items  ");
				  $row = mysql_fetch_row($result);
				  $user_count = $row[0];
	
	
	$query2 = "SELECT count(*) from users WHERE mail='$mailid'";
	$mailcheck = mysql_query($query2,$conn);
	
	$row = mysql_fetch_row($mailcheck);
	$user_count = $row[0];
	
	if($user_count > 0){
		session_Start();
		$_SESSION['errorlogin'] = "MAIL ID already registered";
		header( "refresh:0; url=index.php" );
	}
	else{
		$query1 = "INSERT INTO users (uname,tel,pass,mail) VALUES ('$uname','$tel','$pass','$mailid')";
		$register = mysql_query($query1,$conn);
		if(isset($register)){
		session_start();
		$_SESSION['uname'] = $uname;
		$_SESSION['mail'] = $mailid;
		header( "refresh:0; url=index.php" );
		unset($_SESSION['errorlogin']);
		$_SESSION['welcome_msg'] = $uname;
	}
	else{
		
	}
	}
	
	mysql_close($conn);

?>