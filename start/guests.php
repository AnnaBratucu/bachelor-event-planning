<!DOCTYPE html>
<!--<html class="menu">-->
<html>

<?php  
include '../head.php'; 

require_once "../config.php";

session_start();

$guest_name_err = $guest_email_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_guest_name = $_POST["guest_name"];
    $input_guest_email = $_POST["guest_email"];

	
	if(!filter_var($input_guest_email, FILTER_VALIDATE_EMAIL)){
		$guest_email_err = "Please enter a valid Email.";
	} else{
		$email = $input_guest_email;
	}
    if(empty($guest_email_err) ){
		$sql = "INSERT INTO guests (event_id, guest_name, guest_email, guest_status) VALUES (:event_id, :guest_name, :guest_email, :guest_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_event_id);
			$stmt->bindParam(":guest_name", $param_name);
			$stmt->bindParam(":guest_email", $param_email);
			$stmt->bindParam(":guest_status", $param_status);
            
            // Set parameters
            $param_event_id = $_GET[ 'event_id' ];
			$param_name = $input_guest_name;
			$param_email = $email;
			$param_status = 'pending';
            
            // Attempt to execute the prepared statement
            if(!$stmt->execute()){
				
                echo "Something went wrong. Please try again later.";
            }else{
                
            }
        }
         
		// Close statement
		
       
    } 
    
}


function translate( $data ){
    
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


        <form id="regForm1" style="margin-top:-700px;" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            
</div>
<div class="row" style="margin-left:180px;">
  <div class="column1bis">
    <input type="text" name="guest_name" id="guest_name" required placeholder="Guest Name" ><i class="fas fa-user-plus" style="color:black;top:-30px;right:-180px;"></i>
    <div style="color:red;"><?php echo $guest_name_err; ?></div>
  </div>
  <div class="column1bis">
    <input type="text" name="guest_email" id="guest_email" required placeholder="Guest Email" ><i class="fas fa-envelope" style="color:black;top:-30px;right:-180px;"></i>
    <div style="color:red;"><?php echo $guest_email_err; ?></div>
  </div>
  <div class="column1bis">
    <input type="submit" value="Add" class="nextBtn" id="nextBtn" style="color:white;width:200px;cursor:pointer;">
  </div>
</div>
<div style="height:130px;"></div>
  
</form>
       
<div style="height:50px"></div>
        <div class="limiter" style="margin-top:-270px;margin-left:140px;height:600px;">
		<div class="container-table100" style="background-color:transparent;">
			<div class="wrap-table100" style="background-color:transparent;">
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr>
									<th class="cell100 column1">No.</th>
									<th class="cell100 column2">Name</th>
									<th class="cell100 column3">Email</th>
									<th class="cell100 column4">Attends?</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body1" style="max-height:400px;overflow:auto;">
						<table>
							<tbody>
                            <?php

$sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = 'pending' ORDER BY guest_id DESC";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->execute(['event_id' => $_GET[ 'event_id' ]]); 
        if($stmt->rowCount() > 0){
        while ($row = $stmt->fetch()) { 

            ?>
								<tr class="row100 body">
									<td class="cell100 column1"><?php echo $row[ 'guest_id' ]; ?></td>
									<td class="cell100 column2"><?php echo $row[ 'guest_name' ]; ?></td>
                                    <td class="cell100 column3"><?php echo $row[ 'guest_email' ]; ?></td>
                                    <td class="cell100 column4"><?php if( $row[ 'guest_status' ] == 'pending' ) echo "Waiting to be answered";
                                                                        else if ( $row[ 'guest_status' ] == 'accepted' ) echo "Invitation Accepted";
                                                                        else if ( $row[ 'guest_status' ] == 'denied' ) echo "Invitation rejected"; ?></td>
               
									
                                </tr>
                                <?php } } else{ echo "No guests added yet"; } }  ?>
							</tbody>
						</table>
					</div>
				</div>
				
				</div>
			</div>
		</div>
    </div>
    <div style="overflow:auto;">
    <div >
      <button type="button" id="prevBtn">Previous</button>
      <a href="pages.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:1160px;cursor:pointer;">Next</button></a>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
	<script src="../js/main_guests.js"></script>

        
</body>
</html>