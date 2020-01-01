<!DOCTYPE html>
<!--<html class="menu">-->
<html>

<?php include '../head.php'; 
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
require_once "../config.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $sql = "SELECT guests.*,events.*,users.* FROM guests LEFT JOIN events on guests.event_id = events.event_id LEFT JOIN users on events.user_id = users.user_id WHERE guests.event_id = :event_id";
        
  if($stmt = $pdo->prepare($sql)){
    $event_id = $_GET[ 'event_id' ];
      // Bind variables to the prepared statement as parameters
      $stmt->execute(['event_id' => $event_id]); 
      while ($user = $stmt->fetch()) { 
      
      // Attempt to execute the prepared statement
      
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
      
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ana.bratucu@gmail.com";
        $mail->Password = "gotony1997";
        $mail->SetFrom("ana.bratucu@gmail.com");
        $mail->Subject = "Event Survey";
        $mail->Body = "Hello, <br><br> You are on " . $user[ 'user_name' ] . "'s guest list for her upcoming " . $user[ 'event_type' ] . " event. Would you like to give her your opinion regarding what you expect from it?<br>Click on the link below to answer a few questions: <br> <a href=\"http://localhost/git/bachelor/start/survey_for_guests.php?eventid=". $user[ 'event_id' ] . "\">Take Survey</a> ";
        $mail->AddAddress($user[ 'guest_email' ]);
          
        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          $sql1 = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
          if( $stmt1 = $pdo->prepare($sql1)  ){
              // Bind variables to the prepared statement as parameters
              $stmt1->bindParam(":event_stage", $param_event_stage);
              $stmt1->bindParam(":event_id", $param_event_id);
              // Set parameters
              $param_event_id = $event_id;
              $param_event_stage = 'venue';
              
              // Attempt to execute the prepared statement
              if(!$stmt1->execute()){
                echo "Something went wrong. Please try again later.";
              } 
          }
        }
          } 
          header("location: pages.php?event_id=$event_id");
                exit();
      }
}


?>

<body>



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
<a href="../profile.php">
<i class="fa fa-user fa-lg"></i>
<span class="nav-text">Your profile</span>
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
  
<div style="position:absolute;
margin-left: 56px;top:3px;"> 
   
  

  
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
                        <span class="nav-text">
                        </span>
                        
                    </a>

</li>
                            

  
  
</li>
<li class="darkerlishadow" style="background-color:#ffcccc;">
<a href="wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
<i class="fas fa-hotel"></i>
<span class="nav-text">Venue</span>
</a>
</li>
  
<li class="darkerli">
<a href="food.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
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
<span class="nav-text">Magazines
</span>
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
<span class="nav-text">Life & Style
</span>
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
       

        <div class="wiz">
        
        <form id="regForm" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Do you want to send surveys to your guests to find out what they expect from the event?</h1><br><br>
</div>
<div style="height:50px;"></div>
  <div style="overflow:auto;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <input type="submit" value="Send" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:390px;cursor:pointer;">
    </div>
  </div>
  
</form>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>

        
</body>
</html>