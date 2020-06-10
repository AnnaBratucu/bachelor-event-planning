<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>

<nav class="main-menu">
    <div class="settings"></div>
    <div class="scrollbar" id="style-1">  
        <ul>
            <li>                                   
                <a href="../plan.php">
                    <i class="fa fa-home fa-lg"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>     
            
            
            <?php 
require_once "../config.php";
if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
$sql = "SELECT * FROM notificatins WHERE event_id = :event_id AND notification_status='not_seen'";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $_GET[ 'event_id' ];
			
			// Attempt to execute the prepared statement
      //$stmt->execute();
      $notif = $stmt->rowCount();
        
  }
}


                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){

                if( basename($_SERVER['PHP_SELF']) == 'profile.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/profile.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-chart-bar" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Profile <?php if( $notif > 0 ){ ?> <i data-toggle="tooltip" title="You have new notifications" class="fas fa-exclamation" style="color:red;"></i> <?php } ?></span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li>
                <a href="../start/profile.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Profile <?php if( $notif > 0 ){ ?> <i data-toggle="tooltip" title="You have new notifications" class="fas fa-exclamation" style="color:red;"></i> <?php } ?></span>
                </a>
            </li>
            <?php }} ?>


            
            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'list_favourites.php' ){
            ?>
            <li style="background-color:	#606060">
                <a href="../start/list_favourites.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-heart-o fa-lg" style="color:#F5F5F5;"></i>   
                    <span class="nav-text" style="color:white;">Favourites</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li>
                <a href="../start/list_favourites.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-heart-o fa-lg"></i>   
                    <span class="nav-text">Favourites</span>
                </a>
            </li>
            <?php }} ?>

            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'budget.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060;">
                <a href="../start/budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-money" style="font-size:20px;color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Budget</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-money" style="font-size:20px"></i>
                    <span class="nav-text">Budget</span>
                </a>
            </li>
            <?php }} ?>



            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'guests.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/guests.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-user-tie" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Guests</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/guests.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">Guests</span>
                </a>
            </li>
            <?php }} ?>



            <?php 
                if( $_SESSION[ 'username' ] == 'admin@yahoo.com' && basename($_SERVER['PHP_SELF']) != 'ceremony_admin.php' ){
            ?>
                    <li class="darkerli">
                    <a href="ceremony_admin.php">
                        <i class="fas fa-place-of-worship"></i>
                        <span class="nav-text">Ceremony Venue</span>
                    </a>
            </li>
            <?php }  
                else if( ( basename($_SERVER['PHP_SELF']) == 'ceremony.php' || basename($_SERVER['PHP_SELF']) == 'ceremony_admin.php' ) && $_SESSION[ 'username' ] == 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start_admin/ceremony_admin.php">
                    <i class="fas fa-place-of-worship" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Ceremony Venue</span>
                </a>
            </li>
            <?php 
                }else if( ( basename($_SERVER['PHP_SELF']) == 'ceremony.php' || basename($_SERVER['PHP_SELF']) == 'ceremony_admin.php' || basename($_SERVER['PHP_SELF']) == 'see_ceremony.php' ) && $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/ceremony.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-place-of-worship" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Ceremony Venue</span>
                </a>
            </li>
            <?php }else{ ?>
                <li class="darkerli">
                <a href="../start/ceremony.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-place-of-worship"></i>
                    <span class="nav-text">Ceremony Venue</span>
                </a>
            </li>
            <?php } ?>



            <?php 
                if( $_SESSION[ 'username' ] == 'admin@yahoo.com' && basename($_SERVER['PHP_SELF']) != 'wizard_admin.php' ){
            ?>
                    <li class="darkerli">
                    <a href="wizard_admin.php">
                        <i class="fas fa-hotel"></i>
                        <span class="nav-text">Venue</span>
                    </a>
            </li>
            <?php }  
                else if( ( basename($_SERVER['PHP_SELF']) == 'wizard.php' || basename($_SERVER['PHP_SELF']) == 'wizard_admin.php' ) && $_SESSION[ 'username' ] == 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start_admin/wizard_admin.php">
                    <i class="fas fa-hotel" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Venue</span>
                </a>
            </li>
            <?php 
                }else if( ( basename($_SERVER['PHP_SELF']) == 'wizard.php' || basename($_SERVER['PHP_SELF']) == 'wizard_admin.php' || basename($_SERVER['PHP_SELF']) == 'see_venue.php' || basename($_SERVER['PHP_SELF']) == 'all_reviews.php' ) && $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-hotel" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Venue</span>
                </a>
            </li>
            <?php }else{ ?>
                <li class="darkerli">
                <a href="../start/wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-hotel"></i>
                    <span class="nav-text">Venue</span>
                </a>
            </li>
            <?php } ?>



            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'invitations.php' || basename($_SERVER['PHP_SELF']) == 'invitations2.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/invitations.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-newspaper-o" style="font-size:20px;color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Invitations</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/invitations.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-newspaper-o" style="font-size:20px"></i>
                    <span class="nav-text">Invitations</span>
                </a>
            </li>
            <?php }} ?>



            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'arrange.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/arrange.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-object-ungroup" style="color:#F5F5F5;font-size:22px;"></i>
                    <span class="nav-text" style="color:white;">Guest Arrangement</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/arrange.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-object-ungroup" style="font-size:22px;"></i>
                    <span class="nav-text">Guest Arrangement</span>
                </a>
            </li>
            <?php }} ?>




            <?php 
                if( $_SESSION[ 'username' ] == 'admin@yahoo.com' && basename($_SERVER['PHP_SELF']) != 'food_admin.php' ){
            ?>
                    <li class="darkerli">
                    <a href="food_admin.php">
                        <i class="fas fa-utensils"></i>
                        <span class="nav-text">Menu</span>
                    </a>
            </li>
            <?php }  
                else if( ( basename($_SERVER['PHP_SELF']) == 'food_admin.php' ) && $_SESSION[ 'username' ] == 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start_admin/food_admin.php">
                    <i class="fas fa-utensils" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Menu</span>
                </a>
            </li>
            <?php 
                }else if( ( basename($_SERVER['PHP_SELF']) == 'food_admin.php' || basename($_SERVER['PHP_SELF']) == 'see_food.php' ) && $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start_admin/food_admin.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-utensils" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Menu</span>
                </a>
            </li>
            <?php }else{ ?>
                <li class="darkerli">
                <a href="../start_admin/food_admin.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-utensils"></i>
                    <span class="nav-text">Menu</span>
                </a>
            </li>
            <?php } ?>


            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'music.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:	#606060">
                <a href="../start/music.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-music" style="color:#F5F5F5;"></i>
                    <span class="nav-text" style="color:white;">Music</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/music.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-music"></i>
                    <span class="nav-text">Music</span>
                </a>
            </li>
            <?php }} ?>


            
        <ul class="logout">
            <li>
                <a href="../log/logout.php">
                        <i class="fa fa-sign-out fa-lg"></i>
                    <span class="nav-text">
                        LOGOUT 
                    </span>
                    
                </a>
            </li>  
        </ul>
</nav>