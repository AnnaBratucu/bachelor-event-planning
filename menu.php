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
            <li>
                <a href="http://startific.com">
                    <i class="fa fa-heart-o fa-lg"></i>                
                    <span class="share"> 
                        <div class="addthis_default_style addthis_32x32_style">
                            <div style="position:absolute;margin-left: 56px;top:3px;"> 
                                <a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank" class="share-popup"><img src="http://icons.iconarchive.com/icons/danleech/simple/512/facebook-icon.png" width="30px" height="30px"></a>
                                <a href="https://twitter.com/share" target="_blank" class="share-popup"><img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/512/Twitter_alt.png" width="30px" height="30px"></a>
                        </div>              
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ff17589278d8b3a"></script>  
                    </span>
                    <span class="twitter"></span>
                    <span class="fb-like">  
                        <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fstartific&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
                    </span>
                    <span class="nav-text"></span>
                </a>
            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'budget.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:#ffcccc;">
                <a href="../start/budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-money"></i>
                    <span class="nav-text">Budget</span>
                </a>
            </li>
            <?php 
                }else{
            ?>
            <li class="darkerli">
                <a href="../start/budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fa fa-money"></i>
                    <span class="nav-text">Budget</span>
                </a>
            </li>
            <?php }} ?>



            <?php 
                if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
                if( basename($_SERVER['PHP_SELF']) == 'guests.php' ){
            ?>
            <li class="darkerlishadow" style="background-color:#ffcccc;">
                <a href="../start/guests.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">Guests</span>
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
            <li class="darkerlishadow" style="background-color:#ffcccc;">
                <a href="../start_admin/wizard_admin.php">
                    <i class="fas fa-hotel"></i>
                    <span class="nav-text">Venue</span>
                </a>
            </li>
            <?php 
                }else if( ( basename($_SERVER['PHP_SELF']) == 'wizard.php' || basename($_SERVER['PHP_SELF']) == 'wizard_admin.php' ) && $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
            ?>
            <li class="darkerlishadow" style="background-color:#ffcccc;">
                <a href="../start/wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
                    <i class="fas fa-hotel"></i>
                    <span class="nav-text">Venue</span>
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