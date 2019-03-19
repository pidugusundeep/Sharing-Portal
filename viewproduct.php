	<?php
session_start();
	
	
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
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	
	<!-- php error return -->
	
	<style>
	nav {
		z-index:100;
		}
		.selectee{
		padding-top:6%;
		z-index:99;
		width:100%;
		background-color:white;
		}
	</style>
    <body >
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  
	  <nav class="fixed top pinned black">
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
			  <li><a href="settings.php">settings</a></li>
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
	  <div id="login" class="modal">
		<form action="login.php" method="POST">
			<div class="modal-content">
				<h3 align="Center">Login</h3>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <input  id="username" name="username" type="text" class="validate">
					  <label for="username">USERNAME</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <input  id="password" name="password" type="password" class="validate">
					  <label for="password">PASSWORD</label>
					  <a><i class="material-icons right " id="vis" onclick="passwordvis()">visibility</i></a>
					</div>
				</div>
			<div class="modal-footer">
			  <button class="btn waves-effect waves-light" type="submit" name="action" >Login
				<i class="material-icons right" id="hov">send</i>
			  </button>
			</div>
		
	  </div>
	  </form>
	  </div>
	  <div id="signup" class="modal ">
		<form action="signup.php" method="POST">
			<div class="modal-content">
				<h3 align="Center">Signup</h3>
					<div class="row">
						<div class="input-field col s3 ">
						</div>
						<div class="input-field col s6 ">
						  <input  id="uname" name="uname" type="text" class="validate">
						  <label for="uname">USERNAME</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s3 ">
						</div>
						<div class="input-field col s6 ">
						  <input  id="mail" name="mail" type="email" class="validate">
						  <label for="mail">EMAIL</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s3 ">
						</div>
						<div class="input-field col s6 ">
						  <input  id="phone" name="tel" type="text" class="validate" onblur="return valphone()">
						  <label for="phone">PHONE</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s3 ">
						</div>
						<div class="input-field col s6 ">
						  <input  id="pass1" name="pass" type="password" class="validate">
						  <label for="pass1">PASSWORD</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s3 ">
						</div>
						<div class="input-field col s6 ">
						  <input  id="pass" name="pass" type="password" class="validate" onblur="valpass()">
						  <label for="pass">RE-PASSWORD</label>
						</div>
					</div>
				<div class="modal-footer">
				  <button class="btn waves-effect waves-light" type="submit" name="action"  >Signup
					<i class="material-icons right" id="hov">near_me</i>
				  </button>
				</div>
		
			</div>
		</form>
	  </div>
	  </br></br></br></br>
	  <div class="viewdetails container">
		<div class="row">
			<?php
			
				include("conn.php");
				 $itemid = $_GET['itemid'];
				 
				 $query = "SELECT * FROM items WHERE itemid =$itemid";
				 $access = mysql_query($query,$conn);
				 
				 while ($row = mysql_fetch_assoc($access)) {
					 $_SESSION['toid'] = $row['userid'];
				echo ' 
				  <div class="col s5">
					<img class="materialboxed z-depth-3" width="380" height="400" src="itemimages/'.$row['image_name'].'"/>	
				  </div>
				  <div class="col s7 ">
					<div class="card-panel teal z-depth-3">
						<h3 align="center" class="white-text">'.$row['Item_name'].'</h3>	
						<p> '.$row['description'].'</p>

						<div class="col s3 push-s2">
							<div class="chip " align="Center">
								<img src="images/rupee.ico" alt="Contact Person">
								'.$row['cost'].'
							  </div>
						</div>
						<div class="col s8 push-s3">
							<a class="waves-effect waves-light btn modal-trigger center-right" href="#modal1">Send a message</a>
						</div>	</br>
						 *check the sent messages in your profile
					</div>
				  </div>
				  
				  <div id="modal1" class="modal bottom-sheet">
					<div class="modal-content"><div class="col s10 push-s2">
					  <h4><blockquote>Send Message</blockquote></h4></div>
					  <div class="row">
						  <div class="input-field col s8 push-s2">
							<textarea id="message" class="materialize-textarea" name="message" length="500"></textarea>
							<label for="message">Message</label>
						  </div>
						  <div class="col s2 push-s2">
							<a class="btn-floating btn-large modal-close	 waves-effect waves-light red"><i class="material-icons" onclick="sendmsg()">send</i></a>
						  </div>
					  </div>
					</div>
				  </div>
				  
				  
				  ' ;
				 }
				   
			?>
		</div>
	  </div>
	  <?php
	  include("footer.php");
	  ?>
	  <script>
			function sendmsg(){
				jQuery.ajax({
				url: "sendmsg.php",
				data:'message='+$("#message").val(),
				type: "POST",
				success:function(data){
					$("#message").html(data);
				},
				error:function (){}
				});
			}
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