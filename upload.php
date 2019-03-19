<?php
session_start();
	$_SESSION['usedData'] = 50;
	
		if(isset($_SESSION['errorlogin'])){
			echo '<script>
					function session1(){
					document.getElementById("subcat").disabled = true;
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
	
	<style src="js/bootstrap-material-datetimepicker.js"></style>
    <body onload="session1()">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	   <div class="navbar-fixed">
	  <nav>
		<div class="nav-wrapper black">
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
	  </div>
	  <h3 class="center-align">New Item</h3>
	<div class="container ">
		<form action="uploaditem.php" method="POST" enctype="multipart/form-data">
		<div class="row" >
			<div class="input-field col s4 push-s2">
			  <input  id="Item_name" name="iname" type="text" class="validate " >
			  <label for="Item_name">Name</label>
			</div>
			<div class="input-field col s3 push-s3">
			  <select   id="cat" name="itemcat" onchange="cabcheck()">
				<optgroup label="books">
					  <option value="CSE">CSE</option>
					  <option value="ECE">ECE</option>
					  <option value="EEE">EEE</option>
					  <option value="Mech">Mech</option>
					  <option value="Civil">Civil</option>
				</optgroup>
				<optgroup label="Electronics">
					  <option value="calc">calculator</option>
					  <option value="phone">phones</option>
					  <option value="laptop">laptops</option>
				</optgroup>
				<optgroup label="cab">
					  <option value="CC">Chennai Central</option>
					  <option value="CA">Chennai Airport</option>
					  <option value="CBT">CMBT</option>
				</optgroup>
			  </select>
				<label>Category</label>
			</div>
		</div>
		<div class="row appe">
			<div class="file-field input-field col s4 push-s2 ">
				<div id="image">
			  <div class="btn">
				<span>Photo</span>
				<input type="file" name="image" id="photo" class="image" value="" >
			  </div>
			  <div class="file-path-wrapper"> 	
				<input class="file-path validate" type="text" id="filewrap" class="image">
			  </div>
			  </div>	
			</div>
			<div class="input-field col s3 push-s3 cost" >
				<input  id="cost" name="cost" type="number" class="validate "  min="0" max="99999">
			    <label for='cost'>Cost</label>
			</div>
			<div class="input-field col s8 push-s2">
				<textarea id="Description" class="materialize-textarea" name="description" length="500" onblur="validate()"></textarea>
				<label for="Description">Description</label>
			 </div></br>
			 
			
		</div>
		<div class="row">
			<div class="input-field col s3 push-s2" id="trav" >
				<input  id="travellers" name="travellers" type="number" class="validate " min="1" max="10">
			    <label for='travellers'>Max no of travellers</label>
			</div>
			<div class="input-field col s3 push-s2" id="cabsel">
				<select class="icons" name="cabsel" onchange="imgsel()" id="cabselection">
				  <option value="" disabled selected>Choose</option>
				  <option value="fasttrack" data-icon="images/fasttrack.png" class="left circle">Fast track</option>
				  <option value="ola" data-icon="images/ola.jpg" class="left circle">Ola</option>
				  <option value="taxtfs" data-icon="images/taxifs.png" class="left circle">Taxi for sure</option>
				</select>
				<label>Cab Name</label>
			</div>
			<div class="input-field col s3 push-s2" onmousedown="validate()" id="sub">
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="subbut" >Submit<i class="material-icons right">send</i></button>
			</div>
				</form>
		</div>
	</div>	
	<?php
	  include("footer.php");
	  ?>
	<script>
		function validate(){
		/*	name = document.getElementById("Item_name").value;
			cat = document.getElementById("cat").value;
			cost = document.getElementById("cost").value;
			Description = document.getElementById("Description").value;
			deslen = Description.length;
			namlen = name.length;
			imagelen = image.length;
			cos = cost.length;
			if(deslen >0 && namlen >0 && imagelen > 0 && cos >0){
				document.getElementById("subbut").disabled = false;
				
			}
			
			*/
		}
		
		function cabcheck(){
			a = document.getElementById("cat").value;
			if( a == "CA" || a == "CC" || a == "CBT"){
				$( ".image" ).prop( "disabled", true );
				document.getElementById("filewrap").value="Please leave this blank";
				document.getElementById("filewrap").style.color = "red";
				$("#trav").show(1000);
				$("#cabsel").show(1000);
				$("#sub").attr('class', 'input-field col s3 push-s2');
				$( "#image" ).replaceWith('<input type="date" id="date" name="date" min="2017-01-02" placeholder="Date">');
			}
			else{
				$( ".image" ).prop( "disabled", false );
				document.getElementById("filewrap").value="File name";
				document.getElementById("filewrap").style.color = "black";
				$("#trav").hide(1000);
				$("#cabsel").hide(1000);
				$("#sub").attr('class', 'input-field col s3 push-s8');
			}
			
		}  
		$(document).ready(function() {
			$('select').material_select();
		  });
	</script>
    </body>
  </html>