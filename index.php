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
	<title>Sharing Portal</title>
	<!-- php error return -->
	
	<style>
	 body {
    display:flex;
    min-height:100vh;
    flex-direction:column;
		}
	.main {
			flex:1 ;
		  }
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
    <body onload="session1()" >
	<div class="main">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  
	  <nav class="fixed top pinned black">
		<div class="nav-wrapper">
		  <a href="index.php" class="brand-logo">&nbsp&nbspSharing Portal</a>
		  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
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
		<form action="login.php" method="POST" onsubmit="return loginbtn()">
			<div class="modal-content">
				<h3 align="Center">Login</h3>
				<div class="row">
					<div class="col s6 push-s3">
						<a class="waves-effect waves-light btn center" href="fbconfig.php">Login/Signup with facebook</a>
					</div>
					<div class="input-field col  s8 push-s2">
					  <i class="material-icons prefix">account_circle</i>
					  <input  id="username" name="username" type="text" class="validate">
					  <label for="username">Email</label>
					</div>
				
					<div class="input-field col s8 push-s2">
					  <i class="material-icons prefix">fingerprint</i>
					  <input  id="password" name="password" type="password" class="validate" >
					  <label for="password">PASSWORD</label>
					  <a><i class="material-icons right " id="vis" onclick="passwordvis()">visibility</i></a>
					</div>
				</div>
			<div class="modal-footer">
			  <button class="btn waves-effect waves-light" type="submit" name="action" 	  id="loginbut">Login
				<i class="material-icons right" id="hov">send</i>
			  </button>
			</div>
		</form>
	  </div>
	  </div>
	  <div id="signup" class="modal modal-fixed-footer">
		<form action="signup.php" method="POST" onsubmit="return valsignup()">
			<div class="modal-content" >
				<h3 align="Center">Signup</h3>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <i class="material-icons prefix">account_circle</i>
					  <input  id="uname" name="uname" type="text" class="validate">
					  <label for="uname">USERNAME</label>
					  
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					<i class="material-icons prefix">mail</i>
					  <input  id="mail" name="mail" type="email" class="validate" onchange="ajaxmail()">
					  <label for="mail">EMAIL</label>
					</div>
					<div class="input-field col s3 " id="mailconf">
					  
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <i class="material-icons prefix">phone</i>
					  <input  id="phone" name="tel" type="text" class="validate" onblur="return valphone()">
					  <label for="phone">PHONE</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <i class="material-icons prefix">fingerprint</i>
					  <input  id="pass1" name="pass" type="password" class="validate">
					  <label for="pass1">PASSWORD</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 ">
					</div>
					<div class="input-field col s6 ">
					  <i class="material-icons prefix">fingerprint</i>
					  <input  id="pass" name="pass" type="password" class="validate">
					  <label for="pass">RE-PASSWORD</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			  <button class="btn waves-effect waves-light" type="submit" name="action" id="signupbut" >Signup
				<i class="material-icons right" id="hov">near_me</i>
			  </button>
			</div>
		</form>
	  
	  </div>
	  </br>
	  <div class="selectee ">
		<div class="row container" id="selector">
			<div class="input-field col s4" id="booksdiv">
				<select  name="books" id="search1" onchange="valsearch1()">
					<option value="" data-icon="images/book.ico" disabled selected>Books</option>
					<option value="CSE">CSE</option>
					<option value="ECE">ECE</option>
					<option value="EEE">EEE</option>
					<option value="Mech">Mech</option>
					<option value="Civil">Civil</option>
				</select>
				<label>Select the category<i class="material-icons left">book</i></label>
			</div>
			<div class="input-field col s4" id="electronicsdiv">
				<select name="electronics" id="search2" onchange="valsearch2()"  >
					<option value="" data-icon="images/technology.png" disabled selected>electronics</option>
					<option value="calc">calculator</option>
					<option value="phone">phones</option>
					<option value="laptop">laptops</option>
				</select>
				<label>Select the category<i class="material-icons left">phonelink</i></label>
			</div>
			<div class="input-field col s4" id="stationarydiv">
				<select name="stationary" id="search3" onchange="valsearch3()"> 
				  <option value="" data-icon="images/stationary.png" disabled selected>To cab</option>
					<option value="CC">Chennai Central</option>
					<option value="CA">Chennai Airport</option>
					<option value="CBT">CMBT</option>
				</select>
				<label>Select the category<i class="material-icons left">directions_car</i></label>
			</div>
			
		</div>
		</div>
		
		
		<div class="searchresults" id="searchresults">
		
		<?php
		include("conn.php");
				// this is for the user id session1
				if(isset($_SESSION['uname'])){
				
				$klfja = $_SESSION['uname'];
				$kjdab = $_SESSION['mail'];
				$klahdf = "SELECT * from users WHERE uname='$klfja' and mail='$kjdab'";
				$dlkbfk = mysql_query($klahdf,$conn);
				$atedec = mysql_fetch_array($dlkbfk);
				
				$_SESSION['password'] = $atedec['pass'];
				$_SESSION['id'] = $atedec['ID'];
				}
				
				// ends here
			
				  $result = mysql_query("SELECT count(*) FROM items  ");
				  $row = mysql_fetch_row($result);
				  $user_count = $row[0];
				  $_SESSION['usedData'] = $user_count;
				  
				  if(isset($_POST['sel'])){
					  $sel = $_POST['sel'];
					  echo $sel;
				  }
				  echo '<div class="row ">';
				  if(isset($_SESSION['id'])){
					$a = $_SESSION['id'];
					$all_search = "SELECT * FROM items WHERE userid!=$a";
				}
				else{
					$all_search = "SELECT * FROM items";
				}
				  
				  $access = mysql_query($all_search,$conn);
	
					while ($row = mysql_fetch_assoc($access)) {
							echo'
								<form action="viewproduct.php" method="GET">
								<div class="col s3  " id="cards" >
											<div class="card medium z-depth-3">
												<div class="card-image waves-effect waves-block waves-light">
												  <img class="activator" src="itemimages/'.$row['image_name'].'"/>
												  <input type="hidden" value="'.$row['itemId'].'" name="itemid"/>
												</div>
												<div class="card-content">
												  <span class="card-title activator grey-text text-darken-4">'.$row['Item_name'].'<i class="material-icons right">more_vert</i></span>
												  
												</div>
												<div class="card-reveal">
												  <span class="card-title grey-text text-darken-4" align="center">'.$row['Item_name'].'<i class="material-icons right">close</i></span>
												  <p>'.$row['description'].'</p>
												   <center>
												   <button class="btn waves-effect waves-light" type="submit" name="action">More Details
														<i class="material-icons right">details</i>
												   </button>
												 </center>
												</div>
												<div class="card-action">
												  <a href="#" class="activator">View Details</a>
												  <a class="" href="#" onclick="fav('.$row['itemId'].')"><i id="'.$row['itemId'].'" class="material-icons right" style="color:red">favorite_border</i></a>
												</div>
											</div>
								 </div>
								 </form>
								 ' ;}
						
					
				  
		/*	 for($i=0;$i<$_SESSION['usedData'];$i++){
				echo'<div class="col s3 container " id="cards" >
						<div class="card medium z-depth-3">
							<div class="card-image waves-effect waves-block waves-light">
							  <img class="activator" src="itemimages/13405094_1055765481180643_1667540312_o.jpg"/>
							</div>
							<div class="card-content">
							  <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
							  <p><a href="#">This is a link</a></p>
							</div>
							<div class="card-reveal">
							  <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
							  <p>Here is some more information about this product that is only revealed once clicked on.</p>
							</div>
						</div>
			 </div>';}
		*/
		
	  echo'</div>';
	  ?>
	  </div>
	  <div class="loader center-align" hidden>
			
			<img src="images/Preloader_3.gif" alt="loading" style="padding-top:30px;" align="center" />
	  </div>
	  <div class="msg" >
	  </div>
	  </div>
	  <?php
	  include("footer.php");
	  ?>
	  </body>
	  <script>

		function ajaxmail(){
			jQuery.ajax({
				url: "mailsearch.php",
				data:'mail='+$("#mail").val(),
				type: "POST",
				success:function(data){
					$("#mailconf").html(data);
				},
				error:function (){}
				});
		}
		function valsignup(){
			var a  = document.getElementById("uname").value;
			var b  = document.getElementById("mail").value;
			var c  = document.getElementById("phone").value;
			var pas1  = document.getElementById("pass1").value;
			var pas  = document.getElementById("pass").value;
			if(a == "" || b == "" || c == "" || pas1 == "" || pas == ""){
				Materialize.toast("All feilds required",1500);
				return false;
			}
			if(pas1 != pas ){
				Materialize.toast("Password Incorrect",1500);
				return false;
			}
		}
		function valsearch1(){
			$( "#search2" ).prop( "disabled", true );
			$(".loader").show();
			$(".searchresults").show();
			jQuery.ajax({
				url: "searchmodify.php",
				data:'search1='+$("#search1").val(),
				type: "POST",
				success:function(data){
					$("#searchresults").html(data);
					$(".loader").hide();
				},
				error:function (){}
				});
		}
		function valsearch2(){
			$(".searchresults").show();
			a = $("#search2").val();
			jQuery.ajax({
				url: "searchmodify.php",
				data:'search2='+$("#search2").val(),
				type: "POST",
				success:function(data){
					$("#searchresults").html(data);
					$(".loader").hide();
				},
				error:function (){}
				});
		}
		function valsearch3(){
			$(".loader").show();
			$(".searchresults").show();
			jQuery.ajax({
				url: "searchmodify.php",
				data:'search3='+$("#search3").val(),
				type: "POST",
				success:function(data){
					$("#searchresults").html(data);
					$(".loader").hide();
				},
				error:function (){}
				});
		}
	    function loginbtn(){
			a = document.getElementById("username").value;
			b = document.getElementById("password").value;
			if(a == "" || b == ""){
				Materialize.toast("All feilds required",1000);
				return false;
			}
		}
	    function updatesearch(){
				jQuery.ajax({
				url: "searchmodify.php",
				data:'books='+$("#books")+'electronics'+("#electronics")+'stationary'+("#stationary").val(),
				type: "POST",
				success:function(data){
					$("footer").html(data);
				},
				error:function (){}
				});
		}
		function fav(x){
			
			a = document.getElementById(x).innerHTML;
			if(a == "favorite_border"){
				jQuery.ajax({
				url: "wishlist.php",
				data:'wish='+x,
				type: "POST",
				success:function(data){
					$(".msg").html(data);
					document.getElementById(x).innerHTML = "favorite";
					document.getElementById(x).style.color = "red";
				},
				error:function (){}
				});
			}
			if(a == "favorite"){
				jQuery.ajax({
				url: "wishlist.php",
				data:'del='+x,
				type: "POST",
				success:function(data){
					$(".msg").html(data);
					document.getElementById(x).innerHTML = "favorite_border";
				},
				error:function (){}
				});
				
			}
		}
		function valphone(){
			
			var a = document.getElementById("phone").value;
			len = a.length;
			if(len < 10 || isNaN(a)){
				Materialize.toast('PhoneNumber Invalid', 2000);
				return false;
			}
		}
		/*
		function valpass(){
			e = document.getElementById("uname").value;
			c = document.getElementById("mail").value;
			d = document.getElementById("phone").value;
			ex = e.length;
			cx = c.length;
			dx = d.length;
			var a = document.getElementById("pass1").value;
			var b = document.getElementById("pass").value;
			if(a != b ){
				document.getElementById("pass").onfocus;
				Materialize.toast('Password incorrect', 2000);
			}
			if(ex>0 && cx >0 && dx >0){
				document.getElementById("signupbut").disabled=false;
			}
		}
		*/
		function passwordvis(){
			var a = document.getElementById("vis").innerHTML;
				if(a == "visibility"){
					document.getElementById("vis").innerHTML = "visibility_off";
					document.getElementById("password").type="text";
					Materialize.toast('Password visible', 2000);
				}
				if(a == "visibility_off"){
					document.getElementById("vis").innerHTML = "visibility";
					document.getElementById("password").type="password";
					Materialize.toast('Password hidden', 2000);
				}
		}
		$('.modal-trigger').leanModal({
			  dismissible: true, // Modal can be dismissed by clicking outside of the modal
			  opacity: .9, // Opacity of modal background
			  in_duration: 300, // Transition in duration
			  out_duration: 200, // Transition out duration
			}
		  );
		    $(document).ready(function() {
			$('select').material_select();
		  });
		  $(window).scroll(function () {
				if ($(window).scrollTop() > 100) {
					$('#selector').css('top', $(window).scrollTop());
				}
			}
			);
		$(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });
	  </script>
	  
    
  </html>