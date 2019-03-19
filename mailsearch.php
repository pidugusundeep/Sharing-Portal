<?php
$a  = $_POST['mail'];
include("conn.php");
$query2 = "SELECT count(*) from users WHERE mail='$a'";
	$mailcheck = mysql_query($query2,$conn);
	
	$row = mysql_fetch_row($mailcheck);
	$user_count = $row[0];
	
	if($user_count > 0){
		echo "<div style='color:red;'>Mail registered</div>";
	}
	else{
		echo "<div style='color:green;'>Mail Accepted</div>";
	}
	
?>