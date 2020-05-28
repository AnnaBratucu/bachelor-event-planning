<?php session_start(); ?>
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
            <li>                                 
                <a href="../contact.php">
                    <i class="fa fa-envelope-o fa-lg"></i>
                    <span class="nav-text">Contact</span>
                </a>
            </li>   
            
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
                if( ( basename($_SERVER['PHP_SELF']) == 'wizard.php' || basename($_SERVER['PHP_SELF']) == 'wizard_admin.php' ) && $_SESSION[ 'username' ] == 'admin@yahoo.com' ){
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



            
            <li class="darkerli">
                <a href="food.php">
                    <i class="fas fa-utensils"></i>
                    <span class="nav-text">Food</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-plane fa-lg"></i>
                    <span class="nav-text">Travel</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-text">Shopping</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-microphone fa-lg"></i>
                    <span class="nav-text">Film & Music</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-flask fa-lg"></i>
                    <span class="nav-text">Web Tools</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-picture-o fa-lg"></i>
                    <span class="nav-text">Art & Design</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-align-left fa-lg"></i>
                    <span class="nav-text">Magazines</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-gamepad fa-lg"></i>
                    <span class="nav-text">Games</span>
                </a>
            </li>
            <li class="darkerli">
                <a href="http://startific.com">
                    <i class="fa fa-glass fa-lg"></i>
                    <span class="nav-text">Life & Style</span>
                </a>
            </li>
            <li class="darkerlishadowdown">
                <a href="http://startific.com">
                    <i class="fa fa-rocket fa-lg"></i>
                    <span class="nav-text">Fun</span>
                </a>
            </li>
        </ul>
        <li>                              
            <a href="http://startific.com">
                <i class="fa fa-question-circle fa-lg"></i>
                <span class="nav-text">Help</span>
            </a>
        </li>   
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