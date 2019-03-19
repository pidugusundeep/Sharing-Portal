<?php
session_start();
if(isset($_SESSION["id"])){
	$uid = $_SESSION["id"];
}
if (isset($_POST['search1'])){
	$a = $_POST['search1'];
}
else if(isset($_POST['search2'])){
	$a = $_POST['search2'];
}
else if(isset($_POST['search3'])){
	$a = $_POST['search3'];
	$_SESSION['cabsea'] = $a;	
}
else{	
	$a = $_SESSION['cabsea'];
	$from = $_POST['from'];
	$to = $_POST['to'];
}
			include("conn.php");
			if($a == "CC" || $a == "CA" || $a == "CBT"){
				echo '<div class="container">
					 <ul class="collapsible popout" data-collapsible="accordion">' ;
				
				if((isset($from)) && (isset($to)) && isset($_SESSION["id"])){
					$all_search = "SELECT * FROM cabs WHERE category='$a' AND userid!=$uid AND date BETWEEN '$from' AND '$to'";
				}
				else if((isset($from)) && (isset($to))){
					$all_search = "SELECT * FROM cabs WHERE category='$a' AND date BETWEEN '$from' AND '$to'";
				}
				else if(isset($_SESSION['id'])){
					$all_search = "SELECT * FROM cabs WHERE category='$a' AND userid!=$uid ";
				} 
				else{
					$all_search = "SELECT * FROM cabs WHERE category='$a'";
				}
				
				echo '
				
				<div id="br">
					<br><br><br> 
					</div>
					<script>
					$(".selectee").hide();
					
					function showhidesearch(){
							
							iconname = document.getElementById("iconname").innerHTML;
							btnname = document.getElementById("btnname").innerHTML;
							
							
							console.log(iconname);
							console.log(btnname);
							if(iconname == "arrow_downward"){
								document.getElementById("iconname").innerHTML = "arrow_upward";
								document.getElementById("btnname").innerHTML = "Hide search";
								$(".selectee").show();
							    $("#br").hide();
							}
							if(iconname == "arrow_upward"){
								document.getElementById("iconname").innerHTML = "arrow_downward";
								document.getElementById("btnname").innerHTML = "Show search";
								$(".selectee").hide();
							    $("#br").show();
							}
						}
					</script>
					 <div class="row">
						<div class="col s3 center">
							<a class="waves-effect waves-light btn-large" onclick="showhidesearch()" ><i class="material-icons right" id="iconname">arrow_downward</i><span id="btnname" >Show search</span></a>
						</div>
						
						<div class="col s3">
							<input type="date" id="from" name="from" min="'. date("Y-m-d") .'" max="'.date('Y-m-d', strtotime("+30 days")).'">
						</div>
						<div class="col s3">
							<input type="date" id="to" name="to" min="'. date("Y-m-d") .'" max="'.date('Y-m-d', strtotime("+30 days")).'">
						</div>
						<div class="col s3">
							<button class="btn-large waves-effect waves-light" type="submit" onclick="datesear()" name="action">Submit
								<i class="material-icons right">send</i>
							  </button>
						</div>
						
					 </div>
					 
				
				';
				
				
				if((isset($from)) && (isset($to))){
					echo '
						<div class="row">
							<blockquote>
							  <center>FROM : '.$from.' &nbsp TO : '.$to.' </center>
							</blockquote>
						</div>
					';
				}
				
				$cabs = mysql_query($all_search,$conn)or die(mysql_error());
				while ($rescab = mysql_fetch_assoc($cabs)) {
					
					
					
					$cabid = $rescab['id'];
					$iop = $rescab['userid'];
					$q = "select * from users WHERE ID = $iop  ";
					$r = mysql_query($q,$conn)or die(mysql_error());
					$w = mysql_fetch_array($r);
					
					$nameofb = $w['uname'];
					
					echo'
					
					 
						<li>
							<div class="collapsible-header"><i class="material-icons">directions_car</i><b>'.strtoupper($rescab['cabtype']).'<span style=" color:#5122dd;" class="right">Date: '.$rescab['date'].' </span></b></div>
							<div class="collapsible-body">
								<div class="row">
									<div class="col s4">
									<img src="images/'.$rescab['image_name'].'" height="250" width="250" style="padding: 30px 30px 30px 30px ; "/>									<Center><b >Cost:'.$rescab['cost'].'</b></center>
									</div>
									<div class="col s7">
										<h5 class="center-align">Booked By :'.$nameofb.' </h5>
										<div id="people">
										<table class="bordered highlight centered">
											<thead>
											  <tr>
												  <th data-field="name">Name</th>
												  <th data-field="phone">Phone Number</th>
											  </tr>
											</thead>
											
											';
								
								$people_Search = "SELECT * FROM cab_details where cabid=$cabid ";
								$ret = mysql_query($people_Search,$conn)or die(mysql_error());
								while ($ret1 = mysql_fetch_assoc($ret)){
									echo'	<tbody>
												
												  <tr>
													<td>'.$ret1['name'].'</td>
													<td>'.$ret1['phone'].'</td>
												  </tr>
												
											</tbody>';
											
									}
									
									echo'</div>	</table>';
									$nus = mysql_query("SELECT numofpass FROM cab_details where cabid=$cabid",$conn)or die(mysql_error());
									$nuss1 = mysql_fetch_row($nus);
									$user_count = $nuss1[0];
									
									$use = "SELECT count(*) from cab_details WHERE cabid=$cabid";
									$totalreg = mysql_query($use,$conn)or die(mysql_error());
									$rr = mysql_fetch_row($totalreg);
									$reg_count = $rr[0];
									
									if($user_count > $reg_count){
										echo '
										</br>
										<div class="row">
											<div class="col s4 push-s4">
												<input type="hidden" value="'.$cabid.'" id="sendcabid"/>
												 <button class="btn waves-effect waves-light" value="added" type="submit" name="action" id="sub" onclick="addme()">Join
													<i class="material-icons right">add</i>
												  </button>
											</div>
										</div>
										';
									
									}
									else{
										echo '
										</br>
											<div class="row">
											<div class="col s6 push-s3">
												<b><div style="color:red;">SORRY, All the seats are booked</div></b>
											</div>
										</div>
										';
									}
									echo'
									</div>
								</div>
							</div>
						</li>
						
					  
				';
				}
			echo '
					</ul>
					</div>
					<script>
						$(document).ready(function(){
							$(".collapsible").collapsible({
							  accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
							});
						  });
					</script>
				';
			}
			else{	  
				echo '<div class="row">';
				  $all_search = "SELECT * FROM items where category='$a'";
				  $access = mysql_query($all_search,$conn)or die(mysql_error());
	
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
						
			}
		
		
	 

?>
<script>
function datesear(){
	p = document.getElementById("from").value;
	p1 = document.getElementById("to").value;
	if(p == ""){
		Materialize.toast("Please select the from date",1500);
	}
	if(p1 ==""){
		Materialize.toast("Please select the to date",1500);
	}
	if(p != "" || p1 != ""){
		jQuery.ajax({
				url: "searchmodify.php",
				data: { from: p, to: p1 },
				type: "POST",
				success:function(data){
					$("#searchresults").html(data);
					$(".loader").hide();
				},
				error:function (){}
				});
	}
}
	function addme(){
		x = confirm("Do you want to join");
		if(x == true){
			
			jQuery.ajax({
				url: "join.php",
				data:'sendcabid='+$("#sendcabid").val(),
				type: "POST",
				success:function(data){
					$("#people").html(data);
				},
				error:function (){}
				});
		}
		else{
			Materialize.toast("You did not Join",1500);
		}
	}

</script>