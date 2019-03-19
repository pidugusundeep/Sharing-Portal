<?php
include("conn.php");
session_Start();
if(isset($_SESSION['id'])){
	
$userid = $_SESSION['id'];

if(isset($_POST["wish"])){
	
$itemid =$_POST["wish"];


$sql1="SELECT * from wishlist WHERE itemid=$itemid and userid=$userid";
$result=mysql_query($sql1,$conn) or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
		 
		 
      }
else {
         $sql="INSERT INTO wishlist (itemid,userid) VALUES ('$itemid','$userid')";
			$wish = mysql_query($sql,$conn);
			if(isset($wish))
				echo'<script>Materialize.toast("Added to wishlist",1000);
			
							
			</script>';
			else
				echo'<script>Materialize.toast("Please try again",1000);</script>';
      }
}
if(isset($_POST["del"])){
		$itemid =$_POST["del"];
         $sql="DELETE FROM wishlist WHERE itemid=$itemid and userid=$userid";
			$wish = mysql_query($sql,$conn);
			if(isset($wish)){
				echo'<script>Materialize.toast("Removed From wishlist",1000);
					
				</script>';
			}
			else
			{
				echo'<script>Materialize.toast("Please try again",1000);</script>';
			}
}
}
else{
	echo'<script>Materialize.toast("Please Login",1000);</script>';
}

?>