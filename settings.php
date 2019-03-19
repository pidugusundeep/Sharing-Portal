<?php
session_start();
	$_SESSION['usedData'] = 50;
	
		if(isset($_SESSION['errorlogin'])){
			echo '<script>
					function session1(){
					Materialize.toast("'.$_SESSION['errorlogin'].'", 1500);
					}
				  </script>';
		}
		if(isset($_SESSION['welcome_msg'])){
			echo '<script>
					function session1(){
					Materialize.toast("Welcome '.$_SESSION['welcome_msg'].'", 3000);
					}
				  </script>';
		}
		unset($_SESSION['welcome_msg']);
		unset($_SESSION['errorlogin'])
?>
<html>
    <head>
		<?php
		if(isset($_SESSION['id'])){
			
		}
		else{
			$_SESSION['er'] = 'true';
			echo 'Error';
			$_SESSION['errorlogin'] = 'Please login to continue';
			echo '<meta http-equiv="refresh" content="0; url=./index.php" />';
		}
		?>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	
	<!-- php error return -->
	
	<style>
	</style>
    <body onload="session1()">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	    <div class="navbar-fixed">
	  <nav class="black">
		<div class="nav-wrapper">
		  <a href="index.php" class="brand-logo">&nbsp&nbspSharing Portal</a>
		  <ul class="right hide-on-med-and-down">
			<li><a href="#">About</a></li>
	<?php
		if(isset($_SESSION['uname'])){
			echo '
			<li><a class="dropdown-button" href="#!" data-activates="dropdown1">'.strtoupper($_SESSION["uname"]).'<i class="material-icons right">arrow_drop_down</i></a></li>
			<ul id="dropdown1" class="dropdown-content">
			  <li><i class="material-icons " align="Center">face</i></li>
			  <li><a href="#!">settings</a></li>
			  <li><a href="upload.php">upload</a></li>
			  <li class="divider"></li>
			  <li><a href="logout.php">logout</a></li>
			</ul>
			';
		}
		else{
			echo'
			<li><a href="#signup" class="waves-effect waves-light btn modal-trigger">Signup</a></li>
			<li><a href="#login" class="waves-effect waves-light btn modal-trigger">Login</a></li>
			';
		}
		?>
		</ul>
		</div>
	  </nav>
	  </div>
	<h3 align="Center">Profile</h3>
	<div class="container"> <blockquote><label>Personal details</label></blockquote></div>
	<div class="row container">
		
		<div class="col s3">
			<div class="input-field	">
				  <input id="uname" type="text" class="validate" value="<?php echo $_SESSION["uname"]; ?>"  >
				  <label for="uname">Username</label>
			</div>
		</div>
		<div class="col s3">
			<div class="input-field	">
				  <input id="mail" type="text" class="validate" value="<?php echo $_SESSION["mail"]; ?>"  >
				  <label for="mail">Mail</label>
			</div>
		</div>
		<div class="col s3">
			<a class="waves-effect  btn-large modal-trigger" href="#passchange">change password</a>
		</div>
		<div class="col s3">
			<button class="btn-large waves-effect waves-light" type="submit" name="action">Update profile
				<i class="material-icons right">send</i>
			</button>
		</div>
	</div></br>
	<div class="container col s4  "> <blockquote><label>Wishlist</label></blockquote>
	<?php
			include("conn.php");
			
			$noofuploads = mysql_query('SELECT count(*) FROM wishlist where userid='.$_SESSION['id'].'');
			
			$row = mysql_fetch_row($noofuploads);
			$no = $row[0];
			if($no == 0){
					echo '	
							<div class="row ">
								<div class="col s4 ">
									<a class="btn-floating btn-large tooltipped waves-effect waves-light red " data-position="right" data-delay="50" data-tooltip="Start uploading" href="upload.php"><i class="material-icons">file_upload</i></a>
								</div>
							</div>
						';
			}
			else{
				echo '<table class="highlight">
						<thead >
						  <tr>
							  <th data-field="id">Item Name</th>
							  <th data-field="name">Photo</th>
							  <th data-field="name">Description</th>
						  </tr>
						</thead>
						<tbody>';
			
			
				$query = 'SELECT * FROM  wishlist WHERE userid='.$_SESSION['id'].'';
				$access = mysql_query($query,$conn);
	
					while ($row = mysql_fetch_assoc($access)) {
						$ret = 'SELECT * FROM items WHERE itemId='.$row['itemid'].'';
						$retval = mysql_query($ret,$conn);
							while ($row1 = mysql_fetch_assoc($retval)){
								echo '
									<tr><form action="removeitem.php" method="POST">
										<td>'.$row1['Item_name'].'</td><input type="hidden" name="itemid" value="'.$row1["itemId"].'"/>
										<td><img class="activator" height="100" width="100" src="itemimages/'.$row1['image_name'].'"/></td>
										<td >'.$row1['description'].'</td>
										</form>
									</tr>
								';
							}
					}
            }
			
		?>
        </tbody>
      </table>
	</div>
	<div class="container"> <blockquote><label>Your Uploads</label></blockquote>
		
		<?php
			$noofuploads = mysql_query('SELECT count(*) FROM items where userid='.$_SESSION['id'].'');
			
			$row = mysql_fetch_row($noofuploads);
			$no = $row[0];
			if($no == 0){
					echo '	
							<div class="row ">
								<div class="col s4 ">
									<a class="btn-floating btn-large tooltipped waves-effect waves-light red " data-position="right" data-delay="50" data-tooltip="Start uploading" href="upload.php"><i class="material-icons">file_upload</i></a>
								</div>
							</div>
						';
			}
			else{
				echo '<table class="highlight">
						<thead >
						  <tr>
							  <th data-field="id">Item Name</th>
							  <th data-field="name">Photo</th>
							  <th data-field="name">Description</th>
							  <th data-field="name"></th>
						  </tr>
						</thead>
						<tbody>';
			
			
			$query = 'SELECT * FROM items where userid='.$_SESSION['id'].'';
			$access = mysql_query($query,$conn);
	
					while ($row = mysql_fetch_assoc($access)) {
						echo '
							<tr><form action="removeitem.php" method="POST">
								<td>'.$row['Item_name'].'</td><input type="hidden" name="itemid" value="'.$row["itemId"].'"/>
								<td><img class="activator" height="100" width="100" src="itemimages/'.$row['image_name'].'"/></td>
								<td >'.$row['description'].'</td>
								<td>
									<button class="btn waves-effect waves-light" type="submit" name="action">Delete
										<i class="material-icons right">delete</i>
									  </button>
								</td></form>
							</tr>
						';
					}
					
			
}			
		?>
        </tbody>
      </table>
	 </div></br>
  <!-- password change -->
  <div id="passchange" class="modal bottom-sheet">
    <div class="modal-content container">
      <h4><blockquote>Change Password</blockquote></h4></br>
	  
	  <div class="row " id="cp">
	  <form action="cpass.php" method="POST" onsubmit="return changepass()">
		  <div class="input-field col s4">
					  <input id="pass" type="password" class="validate" name="pass"  >
					  <label for="pass1">Password</label>
					  <a><i class="material-icons right " id="vis1" onclick="passwordvis1()">visibility</i></a>
		  </div>
		  <div class="input-field col s4">
					  <input id="pass1" type="password" class="validate" name="pass1" >
					  <label for="pass1">Confirm Password</label>
					  <a><i class="material-icons right " id="vis2" onclick="passwordvis2()">visibility</i></a>
		  </div>
		  <div class="input-field col s4">
			<button class="btn-large waves-effect waves-light" type="submit" name="action" >Change password
				<i class="material-icons right">send</i>
			</button>
		  </div>
		  </form>
	  </div>
	
    </div>
    
  </div>
	 </div>
	<?php
	  include("footer.php");
	  ?>
	<script>
		function changepass(){
			
			p1 = document.getElementById("pass").value;
			p2 = document.getElementById("pass1").value;
			
			
			if(p1 == p2){
				return true;
				
			}
			else{
				Materialize.toast("Passwords doesnt match",1000);
				return false;
				
			}
			
		}
		function remo(){
			confirm("do u want to remove");
		}
		function passwordvis1(){
			var a = document.getElementById("vis1").innerHTML;
				if(a == "visibility"){
					document.getElementById("vis1").innerHTML = "visibility_off";
					document.getElementById("pass").type="text";
					Materialize.toast('Password visible', 2000);
				}
				if(a == "visibility_off"){
					document.getElementById("vis1").innerHTML = "visibility";
					document.getElementById("pass").type="password";
					Materialize.toast('Password hidden', 2000);
				}
		}
		function passwordvis2(){
			var a = document.getElementById("vis2").innerHTML;
				if(a == "visibility"){
					document.getElementById("vis2").innerHTML = "visibility_off";
					document.getElementById("pass1").type="text";
					Materialize.toast('Password visible', 2000);
				}
				if(a == "visibility_off"){
					document.getElementById("vis2").innerHTML = "visibility";
					document.getElementById("pass1").type="password";
					Materialize.toast('Password hidden', 2000);
				}
		}
		function test(){
		}
		function subcat(){
			alert("iam in");
			var a = document.getElementById("cat").value;
			alert(a);
			if(a != ""){
				document.getElementById("subcat").disabled = false;
			}
		}
		$(document).ready(function() {
			$('select').material_select();
		  });
		  $('.modal-trigger').leanModal({
			  dismissible: true, // Modal can be dismissed by clicking outside of the modal
			  opacity: .5, // Opacity of modal background
			  in_duration: 300, // Transition in duration
			  out_duration: 200, // Transition out duration
			}
		  );
	</script>
    </body>
  </html>