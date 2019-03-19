<?php

 $a = $_POST['itemid'];
 echo $a;
 session_Start();
 unset($_SESSION['test']);
include("conn.php");

	$query = "DELETE FROM items WHERE itemId=$a";
	mysql_query($query,$conn)or die(mysql_error());
	header( "refresh:0; url=homepage.php" );

?>