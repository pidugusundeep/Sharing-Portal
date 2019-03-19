<?php

if(true){

    // please use your own login details
$conn = mysql_connect("**","**","**","**");
	mysql_select_db("database name");
	if($conn == false){
		die(mysql_error());
	}
}
else{

    // if using local host
	$conn = mysql_connect("localhost","root","","sharingportal");
	mysql_select_db("sharingportal");
	if($conn == false){
		die(mysql_error());
	}
}
	
?>