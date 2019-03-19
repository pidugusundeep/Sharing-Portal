<?php
session_Start();
include("conn.php");
$item_name = $_POST['iname'];
$item_cat = $_POST['itemcat'];
$cost = $_POST['cost'];
$item_des = $_POST['description'];
$userid = $_SESSION['id'];
if( $_POST['travellers'] != "" && $_POST['cabsel'] != "" ){
	$cabsel = $_POST['cabsel'];
	
		if($cabsel == "fasttrack"){
			$imagename = "fasttrack.png";
		}
		if($cabsel == "ola"){
			$imagename = "ola.jpg";
		}
		if($cabsel == "taxtfs"){
			$imagename = "taxifs.png";
		}
		
	if($_POST['travellers'] != ""){
	$nooftrav = $_POST['travellers'];
	$date = $_POST['date'];
	echo "date is :".$date;
	}
}

	
	else{
		$file_name = $_FILES["image"]['name'];
		$file_tmp_name = $_FILES['image']['tmp_name'];
		$imagename = $file_name;
		$image_path = "itemimages/".$file_name;
	}
	 
	 
	 
	 if($_POST['travellers'] != "" && $_POST['cabsel'] != "")
	 {
		 echo 'travellers : '.$_POST['travellers'];
		  echo 'cab sel  : '.$_POST['cabsel'];
		 
			 $query_upload = "INSERT into cabs(Item_name,category,image_name,description,userid,cost,nooftrav,cabtype,date) values('".$item_name."','".$item_cat."','".$imagename."','".$item_des."','".$userid."','".$cost."','".$nooftrav."','".$cabsel."','".$date."')";
			 $r = mysql_query($query_upload,$conn)or die(mysql_error());
			 if($r){
				 $qw = "Select * from cabs where description = '$item_des' AND userid = '$userid' ";
				 $v = mysql_query($qw,$conn)or die(mysql_error());
				 $res = mysql_fetch_array($v);
				 $_SESSION['cabid'] = $res['id'];
				 if(isset($_SESSION['cabid'])){
					 $cabid = $_SESSION['cabid'];
					 $uname = $_SESSION['uname'];
					 $ph = $_SESSION['phone'];
					 $qweq = "INSERT into cab_details(cabid,numofpass,name,phone) values('".$cabid."','".$nooftrav."','".$uname."','".$ph."')" ;
					 $qq = mysql_query($qweq,$conn) or die(mysql_error()); 
				 }
			 }
			 
			 
	 }
	 else{
		 if(move_uploaded_file($file_tmp_name,$image_path)){
		 $query_upload = "INSERT into items(Item_name,category,image_name,description,userid,cost) values('".$item_name."','".$item_cat."','".$imagename."','".$item_des."','".$userid."','".$cost."')";
		 mysql_query($query_upload,$conn)or die(mysql_error());
		 
		 $_SESSION['errorlogin'] = "Uploaded !";
		}
		else{
		$_SESSION['errorlogin'] = "Try uploading again(problem with photo) !";
		 }
	 }
 header( "refresh:2; url=index" );

?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>
