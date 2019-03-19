<?php
session_Start();


$msg = $_POST['message'];
$sid = $_SESSION['id'];
$toid = $_SESSION['toid'];

if($msg != ""){
	
$smgs = "INSERT INTO msg(sendid,toid,msg) VALUES($sid,$toid,'$msg')";
$qumsg = mysql_query($smgs,$conn)or die(mysql_error());
if(isset($qumsg)){
	echo "
	<script>
	Materialize.toast('Message sent !',1000);
	</script>
	";
	
}
else{
	echo "
	<script>
	Materialize.toast('Message not sent !',1000);
	</script>
	";
}
}
else{
	echo "
	<script>
	Materialize.toast('Empty message cannot be sent!',1000);
	</script>
	";
}




?>