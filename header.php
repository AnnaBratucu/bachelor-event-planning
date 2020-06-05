<?php echo '<div class="header_up">
				<div class="logo">
					<a href="plan.php"><img src="log/images/logo4.png"></a>
				</div>
				<div class="menu">';
					$page_name = basename($_SERVER['PHP_SELF']);
					if( $page_name == 'plan.php' )
					echo '<a class="active" href="plan.php"><i class="fa fa-home"></i> Home</a>
					<a href="contact.php"><i class="fa fa-address-book"></i> Contact</a>
					<a href="about.php"><i class="fa fa-users"></i> About us</a>
					<a href="log/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
				</div>
			</div>'; 
					if( $page_name == 'home.php' )
					echo '<a class="active" href="home.php"><i class="fa fa-home"></i> Home</a>
					<a href="contact.php"><i class="fa fa-address-book"></i> Contact</a>
					<a href="about.php"><i class="fa fa-users"></i> About us</a>
					<a href="log/login.php"><i class="fa fa-sign-in"></i> Login</a>
				</div>
			</div>';
					else if( $page_name == 'contact.php' )
					echo '<a href="plan.php"><i class="fa fa-home"></i> Home</a>
					<a class="active" href="contact.php"><i class="fa fa-address-book"></i> Contact</a>
					<a href="about.php"><i class="fa fa-users"></i> About us</a>
					<a href="log/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
				</div>
			</div>'; 
					else if( $page_name == 'about.php' )
					echo '<a href="plan.php"><i class="fa fa-home"></i> Home</a>
					<a href="contact.php"><i class="fa fa-address-book"></i> Contact</a>
					<a class="active" href="about.php"><i class="fa fa-users"></i> About us</a>
					<a href="log/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
				</div>
			</div>'; 	
					else if( $page_name == 'logout.php' )
					echo '<a href="plan.php"><i class="fa fa-home"></i> Home</a>
					<a href="contact.php"><i class="fa fa-address-book"></i> Contact</a>
					<a href="about.php"><i class="fa fa-users"></i> About us</a>
					<a class="active" href="log/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
				</div>
			</div>'; 		
?>