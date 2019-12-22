<!DOCTYPE html>
<html lang="en">
<?php include '../head.php'; 

require_once "../config.php";

session_start();

?>
<body>

    <div class="container-login100" style="background-image: url('https://static.tumblr.com/94eb957a00fd03c0c2f7d26decd71578/u1rhacw/osAmyyh1q/tumblr_static_tumblr_static_gaussian_blur_gradient_desktop_1680x943_wallpaper-393751.jpg');">
        <a href="eventType.php?status=new"><div class="card card-1"><span class="login100-form-title p-b-37 box">Start new event<span></div></a>

        <?php

        $sql = "SELECT * FROM events WHERE user_id = :user_id AND ( event_status = 'preparing' OR event_status = 'postponed') ";
    
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->execute(['user_id' => $_SESSION[ 'id' ]]); 
                while ($row = $stmt->fetch()) { 

                    ?>
                   <a href="pages.php?event_id=<?php echo $row[ 'event_id' ] ?>"><div class="card card-1"><span class="login100-form-title p-b-37 box1">Continue planning your <?php echo $row[ 'event_type' ] ?> event<span></div></a>
               <?php } } ?>
              
    </div>
    
</body>
</html>