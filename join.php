<?php
$a = $_POST['sendcabid'];
session_Start();
include("conn.php");
	$name = $_SESSION['uname'];
	$ph = $_SESSION['phone'];
	$nus = mysql_query("SELECT numofpass FROM cab_details where cabid=$a");
	$nuss1 = mysql_fetch_row($nus);
	$user_count = $nuss1[0];
	$qu = "INSERT INTO cab_details (cabid,numofpass,name,phone) values($a,$user_count,'$name','$ph')";
	$qq = mysql_query($qu,$conn)or die(mysql_error());
	if(isset($qq)){
		echo '
								<table class="bordered highlight centered">
											<thead>
											  <tr>
												  <th data-field="name">Name</th>
												  <th data-field="phone">Phone Number</th>
											  </tr>
											</thead>
											
											';
								
								$number = 0;
								$people_Search = "SELECT * FROM cab_details where cabid=$a ";
								$ret = mysql_query($people_Search,$conn );
								while ($ret1 = mysql_fetch_assoc($ret)){
									echo'	<tbody>
												
												  <tr>
													<td>'.$ret1['name'].'</td>
													<td>'.$ret1['phone'].'</td>
												  </tr>
												
											</tbody>';
									}
									
									echo'</div>	</table></div>';
									$nus = mysql_query("SELECT numofpass FROM cab_details where cabid=$a");
									$nuss1 = mysql_fetch_row($nus);
									$user_count = $nuss1[0];
									$_SESSION['usercount_test'] = $user_count;
									
									$use = "SELECT count(*) from cab_details WHERE cabid=$a";
									$totalreg = mysql_query($use,$conn);
									$rr = mysql_fetch_row($totalreg);
									$reg_count = $rr[0];
									$_SESSION['reg_count'] = $reg_count;
									
									if($user_count > $reg_count){
										echo '
										</br>
										<div class="row">
											<div class="col s4 push-s4">
												<input type="hidden" value="'.$a.'" id="sendcabid"/>
												 <button class="btn waves-effect waves-light" value="added" type="submit" name="action" id="sub" onclick="addme()">Join
													<i class="material-icons right">add</i>
												  </button>
											</div>
										</div>
										';
									
									}
									
	}
	else{
		
	}
	
?>