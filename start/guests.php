<!DOCTYPE html>
<!--<html class="menu">-->
<html>
<style type="text/css">
body::before {
  /* content: "";
  display: block; */
  /* position: absolute; */
  /* z-index: -1; */
  width: 100%;
  
  left: 0; 
  background: white;
  /* background: rgba(93,84,240,0.5);
  background: -webkit-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: -o-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: -moz-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));  */
  pointer-events: none;
}


.wiz{
  margin-top:-100px;
}


.products{
	background: white;
	
	
}
.container{
	background: white;
	
}

.div {
  position: relative; 
  padding-top: 10px;  
}
.inputText {
  font-size: 14px;
  width: 200px;
  height: 25px;
}
.floating-label {
  position: absolute;
  pointer-events: none;
  left: 15px;
  top: 18px;
  transition: 0.2s ease all;
}
input:focus ~ .floating-label,
input:not(:focus):valid ~ .floating-label {
  top: -18px;
}
.input:focus ~ .floating-label,
.input:not(:focus):valid ~ .floating-label {
  top: -20px;
}
input[type=text] {
	color:black;
  background-color:pink;
}
input[type=number] {
	color:black;
}

</style>​ 
<?php  
include '../head.php'; 
require("../PHPMailer/src/Exception.php");
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
require_once "../config.php";

session_start();

$guest_name_err = $guest_email_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_guest_name = $_POST["guest_name"];
    $input_guest_email = $_POST["guest_email"];

	
	if(!filter_var($input_guest_email, FILTER_VALIDATE_EMAIL) && $input_guest_email != ''){
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
            } else{
              $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
      
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        //$mail->Host = "smtp.gmail.com";
        $mail->Host = "ssl://smtp.gmail.com"; 
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ana7bratucu@gmail.com";
        $mail->Password = "gotony1997";
        $mail->SetFrom("ana7bratucu@gmail.com");
        $mail->Subject = "Event Invitation";
        $mail->Body = "Hello, <br><br> You are on invited to an event. Would you like to give her your opinion regarding what you expect from it?<br>Click on the link below to answer a few questions: <br> <a href=\"http://localhost/git/bachelor/start/survey_for_guests.php?eventid=". $_GET[ 'event_id' ] . "\">Take Survey</a> ";
        $mail->AddAddress($email);
        
        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        }
            }
        }
         
		// Close statement
		
       
    } 
    
}
?>

<body>
<div class="wiz">
<?php 
require_once '../menu.php'; 
?>
<div class="products" >
			<div class="container">

        <form id="regForm1" style="margin-top:-900px;" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            
</div>
<div class="row" style="margin-left:180px;">
  <div class="column1bis">
    <input type="text" name="guest_name" id="guest_name" required placeholder="Guest Name" ><i class="fas fa-user-plus" style="color:black;top:-30px;right:-180px;"></i>
    <div style="color:red;"><?php echo $guest_name_err; ?></div>
  </div>
  <div class="column1bis">
    <input type="text" name="guest_email" id="guest_email" placeholder="Guest Email" ><i class="fas fa-envelope" style="color:black;top:-30px;right:-180px;"></i>
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

          $sql1 = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
          if( $stmt1 = $pdo->prepare($sql1)  ){
              // Bind variables to the prepared statement as parameters
              $stmt1->bindParam(":event_stage", $param_event_stage);
              $stmt1->bindParam(":event_id", $param_event_id);
              $event_id = $_GET[ 'event_id' ];
              // Set parameters
              $param_event_id = $event_id;
              $param_event_stage = 'surveys';
              
              // Attempt to execute the prepared statement
              if(!$stmt1->execute()){
                  echo "Something went wrong. Please try again later.";
              }
          }
      

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
	
	</div>
		</div>
	
      <a href="budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button class="nextBtn" type="button" id="prevBtn" style="color:white;width:200px;margin-right:-500px;margin-left:550px;cursor:pointer;background-color:#4d4d4d;">Previous</button></a>
      <a href="pages.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:590px;cursor:pointer;">Next</button></a>
    </div>
  </div>
<div style="height:200px;"></div>
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

  <?php include '../footer.php';  ?>   
</body>
</html>