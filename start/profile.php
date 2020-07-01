<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.wiz{
  margin-top:-320px;
  /* background-color:#C0C0C0; */
}


.btn-glyphicon { padding:8px; background:#ffffff; margin-right:4px; }
.icon-btn { padding: 1px 15px 3px 2px; border-radius:50px;}



.inforide {
  box-shadow: 1px 2px 8px 0px #f1f1f1;
  background-color: white;
  border-radius: 8px;
  height: 125px;
}

.rideone img {
  width: 80%;
}

.ridetwo img {
  width: 80%;
}

.ridethree img {
  width: 80%;
}

.rideone {
  background-color: #6CC785;
  padding-top: 25px;
  border-radius: 8px 0px 0px 8px;
  text-align: center;
  height: 125px;
  margin-left: 15px;
}

.ridetwo {
  background-color: #9A75FE;
  padding-top: 30px;
  border-radius: 8px 0px 0px 8px;
  text-align: center;
  height: 125px;
  margin-left: 15px;
}

.ridethree {
  background-color: #4EBCE5;
  padding-top: 35px;
  border-radius: 8px 0px 0px 8px;
  text-align: center;
  height: 125px;
  margin-left: 15px;
}

.fontsty {
  margin-right: -15px;
}

.fontsty h2{
  color: #6E6E6E;
  font-size: 35px;
  margin-top: 15px;
  text-align: right;
  margin-right: 30px;
}

.fontsty h4{
  color: #6E6E6E;
  font-size: 25px;
  margin-top: 20px;
  text-align: right;
  margin-right: 30px;
}




table{
   overflow-y:scroll;
   height:300px;
   display:block;
}
</style>

</head>
<body>

<div class="wiz">
<?php include '../head.php'; 
require_once "../config.php";

require_once '../menu.php'; 
?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<?php $sql = "SELECT * FROM users_profile WHERE event_id = :event_id AND user_id = :user_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_id);
            $stmt->bindParam(":user_id", $param_user);
			
			// Set parameters
            $param_id = $_GET[ 'event_id' ];
            $param_user = $_SESSION[ 'id' ];
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $profile = $stmt->fetch();
        $venue = $profile[ 'venue_id' ];
        $ceremony = $profile[ 'ceremony_id' ];
  }
?>

<div style="background-image:url('../images/profile.jpg');background-size:cover;margin-top:-680px;margin-left:-40px;height:300px;">
            <div style="height:70px;"></div>
        <h1 style="color:black;font-size:30px;">See event statistics.</h1><br><br>
</div>
<?php $event_id = $_GET[ 'event_id' ]; ?>
<div class="container" style="margin-top:50px;">
	<div class="row">
      <div class="col-lg-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-newspaper-o fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading">Generated</p>
                <p class="announcement-text">Invitation</p>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
              <?php


              $cerem=false;
              $ven=false;
              $sql = "SELECT * FROM users_profile WHERE event_id = :event_id";
                      
                  if($stmt = $pdo->prepare($sql)){
                  // Bind variables to the prepared statement as parameters
                  $stmt->execute(['event_id' => $_GET[ 'event_id' ]]); 
                  $profile = $stmt->fetch();

                  if($stmt->rowCount() != 0 && $profile[ 'ceremony_id' ] != 0 ){
                      $cerem = true;
                  } 

                  if($stmt->rowCount() != 0 && $profile[ 'venue_id' ] != 0){
                    $ven = true;
                } 

                  }


              
              $file = 'http://localhost/git/bachelor/start/invitations/index_'. $event_id .'.html';
              $file_headers = @get_headers($file);
              if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                  $exists = false;
              }
              else {
                  $exists = true;
              }
              
              ?>
                <div class="col-xs-6">
                  <?php if( $exists == true ){ ?>
                      <a target="_blank" href="invitations/index_<?= $event_id ?>.html"><p class="announcement-text">See</p></a>
                  <?php } else{ ?>
                      <a target="_blank" href="invitations/index_<?= $event_id ?>.html"><p class="announcement-text" onclick="alert( 'You do not have a generated invitation.' ); return false;">See</p></a>
                  <?php } ?>
                </div>
                <div class="col-xs-6 text-right">
                    <?php if( $exists == true ){ ?>
                        <a target="_blank" href="invitations/index_<?= $event_id ?>.html"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;"></i></a>
                    <?php } else{ ?>
                      <a target="_blank" href="invitations/index_<?= $event_id ?>.html"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;" onclick="alert( 'You do not have a generated invitation.' ); return false;"></i></a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fas fa-hotel fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading">Venue</p>
                <p class="announcement-text">Chosen</p>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                    <?php if( $ven == true ){ ?>
                      <a href="see_venue.php?venue_id=<?= $venue ?>&event_id=<?= $event_id ?>"><p class="announcement-text">See</p></a>
                    <?php } else{ ?>
                      <a href="see_venue.php?venue_id=<?= $venue ?>&event_id=<?= $event_id ?>"><p class="announcement-text" onclick="alert( 'You have not booked an afterparty venue.' ); return false;">See</p></a>
                    <?php } ?>
                </div>
                <div class="col-xs-6 text-right">
                    <?php if( $ven == true ){ ?>
                      <a href="see_venue.php?venue_id=<?= $venue ?>&event_id=<?= $event_id ?>"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;"></i></a>
                    <?php } else{ ?>
                      <a href="see_venue.php?venue_id=<?= $venue ?>&event_id=<?= $event_id ?>"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;" onclick="alert( 'You have not booked an afterparty venue.' ); return false;"></i></a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fas fa-place-of-worship fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading">Ceremony</p>
                <p class="announcement-text">Venue</p>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                    <?php if( $ven == true ){ ?>
                      <a href="see_ceremony.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><p class="announcement-text">See</p></a>
                    <?php } else{ ?>
                      <a href="see_ceremony.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><p class="announcement-text" onclick="alert( 'You have not booked a ceremony venue.' ); return false;">See</p></a>
                    <?php } ?>
                </div>
                <div class="col-xs-6 text-right">
                    <?php if( $ven == true ){ ?>
                      <a href="see_ceremony.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;"></i></a>
                    <?php } else{ ?>
                      <a href="see_ceremony.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;" onclick="alert( 'You have not booked a ceremony venue.' ); return false;"></i></a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fas fa-utensils fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading">Menu</p>
                <p class="announcement-text">Chosen!</p>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                    <a href="menu.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><p class="announcement-text">See</p></a>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="menu.php?ceremony_id=<?= $venue ?>&event_id=<?= $event_id ?>"><i class="fa fa-arrow-circle-right" style="font-size:20px;color:#4682B4;"></i></a>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div><!-- /.row -->

<?php

$sql = "SELECT * FROM budget WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $budget = $stmt->fetch();
        $budget_first = $budget[ 'budget_value_first' ];
        $emergency_first = $budget[ 'budget_emergency_first' ];
        $budget1 = $budget[ 'budget_value' ];
        $emergency = $budget[ 'budget_emergency' ];
  }

  $sql = "SELECT * FROM events WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $event = $stmt->fetch();
        $event_stage = $event[ 'event_stage' ];
        $event_date = $event[ 'event_date' ];
  }

  if( $event_date != '0000-00-00 00:00:00' ){
    $date = substr( $event_date,0,10 );
    $mkt_diff   = strtotime($date) - time();
    $final_date = floor( $mkt_diff/60/60/24 );
    if( $final_date < 0 ){
        $final_date = 0;
    }
  }else{
    $final_date = 0;
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $count = $stmt->rowCount();
        
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = 'accepted'";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      
      $all_guests = $stmt->rowCount();
      while ($all = $stmt->fetch()) { 
        if( $all[ 'guest_plus' ] == 'yes' ){
            $all_guests++;
        }
      }
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = :guest_status";
    
  if($stmt = $pdo->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":event_id", $param_id);
      $stmt->bindParam(":guest_status", $param_status);
      
      // Set parameters
      $param_id = $event_id;
      $param_status = 'accepted';
      
      // Attempt to execute the prepared statement
        $stmt->execute();
        $guests_send_no = $stmt->fetch();
        $yes_count = $stmt->rowCount();
  
}

$sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_send = :guest_send";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			$stmt->bindParam(":guest_send", $param_send);
			
			// Set parameters
			$param_id = $event_id;
			$param_send = 'yes';
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $yes_count = $stmt->rowCount();
        
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_send = :guest_send";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			$stmt->bindParam(":guest_send", $param_send);
			
			// Set parameters
			$param_id = $event_id;
			$param_send = 'no';
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $no_count = $stmt->rowCount();
        
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = :guest_status";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			$stmt->bindParam(":guest_status", $param_status);
			
			// Set parameters
			$param_id = $event_id;
			$param_status = 'pending';
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $pend_count = $stmt->rowCount();
        
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = :guest_status";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			$stmt->bindParam(":guest_status", $param_status);
			
			// Set parameters
			$param_id = $event_id;
			$param_status = 'accepted';
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $accept_count = $stmt->rowCount();
        
  }

  $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = 'accepted' OR guest_status = 'denied'";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $guests_send_no = $stmt->fetch();
      $answer_count = $stmt->rowCount();
        
  }
 
 if( $budget_first != 0 ){
  $p = (($budget_first-$budget1)/$budget_first)*100;
  $p = (int) $p;
 }else{ $p = 0; }
 if( $emergency_first != 0 ){
  $pe = (($emergency_first-$emergency)/$emergency_first)*100;
  $pe = (int) $pe;
 }else{ $pe = 0; }

 if( $count != 0 ){
    $gnc = ($no_count/ $count)*100;
    $gnc = (int) $gnc;
   }else{ $gnc = 0; }

   if( $pend_count != 0 ){
    $gnp = ($yes_count/ $pend_count)*100;
    $gnp = (int) $gnp;
   }else{ $gnp = 0; }

   if( $accept_count != 0 ){
    $ga = ($answer_count/ $accept_count)*100;
    $ga = (int) $ga;
   }else{ $ga = 0; }
   


 if( $event_stage == 'budget' ){
     $s = 0;
     $to = 9;
 }else if( $event_stage == 'guests' ){
     $s = 12;
     $to = 8;
 }else if( $event_stage == 'ceremony' ){
    $s = 23;
    $to = 7;
}else if( $event_stage == 'venue' ){
    $s = 35;
    $to = 6;
}else if( $event_stage == 'invitation' ){
  $s = 48;
  $to = 5;
}else if( $event_stage == 'send' ){
  $s = 58;
  $to = 4;
}else if( $event_stage == 'table_arrangement' ){
    $s = 70;
    $to = 3;
}else if( $event_stage == 'food' ){
    $s = 80;
    $to = 2;
}else if( $event_stage == 'music' ){
  $s = 90;
  $to = 1;
}else if( $event_stage == 'completed' ){
    $s = 100;
    $to = 0;
}

?>
                
				<div class="container-fluid">
					
					<div class="col col-md-9">
						<div class="row">
							<div class="col col-md-5">
								<h4>Review Stats:</h4>
										Budget<span class="pull-right strong"><?= $budget_first-$budget1 ?> out of <?= $budget_first ?></span>
										 <div class="progress" style="height:20px;">
                                            <?php if( $p >= 80 ){ ?>
											    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="15"aria-valuemin="0" aria-valuemax="100" style="width:<?= $p ?>%;height:20px;color:black;background-color:red;"><?= $p ?>%</div>
                                            <?php } else{ ?>
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="15"aria-valuemin="0" aria-valuemax="100" style="width:<?= $p ?>%;height:20px;color:black;"><?= $p ?>%</div>
                                            <?php } ?>
										</div>
									
										Emergency Budget<span class="pull-right strong"><?= $emergency_first-$emergency ?> out of <?= $emergency_first ?></span>
										 <div class="progress" style="height:20px;">
                                            <?php if( $pe >= 80 ){ ?>
											    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30"aria-valuemin="0" aria-valuemax="100" style="width:<?= $pe ?>%;height:20px;color:black;background-color:red;"><?= $pe ?>%</div>
                                            <?php } else{ ?>
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30"aria-valuemin="0" aria-valuemax="100" style="width:<?= $pe ?>%;height:20px;color:black;"><?= $pe ?>%</div>
                                            <?php } ?>
                                        </div>
									
										Event completion<span class="pull-right strong"><?= $to ?> stages to complete</span>
										 <div class="progress" style="height:20px;">
                                            <?php if( $s >= 40 && $to < 70 ){ ?>
											    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="8"aria-valuemin="0" aria-valuemax="100" style="width:<?= $s ?>%;height:20px;color:black;background-color:yellow;"><?= $s ?>%</div>
                                            <?php } else if( $s >= 70 ){ ?>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="8"aria-valuemin="0" aria-valuemax="100" style="width:<?= $s ?>%;height:20px;color:black;background-color:green;"><?= $s ?>%</div>
                                            <?php }else{ ?>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="8"aria-valuemin="0" aria-valuemax="100" style="width:<?= $s ?>%;height:20px;color:black;"><?= $s ?>%</div>
                                            <?php } ?>
										</div>
							</div>
							<div class="col col-md-5">
								<h4>Guest Stats:</h4>
										Remaining to send invitation<span class="pull-right strong"><?= $no_count ?> out of <?= $count ?></span>
										 <div class="progress" style="height:20px;">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45"aria-valuemin="0" aria-valuemax="100" style="width:<?= $gnc ?>%;height:20px;color:black;"><?= $gnc ?>%</div>
										</div>
									
										Remaining to answer invitation<span class="pull-right strong"><?= $yes_count ?> out of <?= $pend_count ?></span>
										 <div class="progress" style="height:20px;">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="57"aria-valuemin="0" aria-valuemax="100" style="width:<?= $gnp ?>%;height:20px;color:black;"><?= $gnp ?>%</div>
										</div>
									
										Accepted invitation<span class="pull-right strong"><?= $accept_count ?> out of <?= $answer_count ?></span>
										 <div class="progress" style="height:20px;">
                                            <?php if( $ga >= 80 ){ ?>
											    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="25"aria-valuemin="0" aria-valuemax="100" style="width:<?= $ga ?>%;height:20px;color:black;background-color:green;"><?= $ga ?>%</div>
                                            <?php }else{ ?>
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="25"aria-valuemin="0" aria-valuemax="100" style="width:<?= $ga ?>%;height:20px;color:black;"><?= $ga ?>%</div>
                                            <?php } ?>
										</div>
							</div>
						</div>
					</div>
				</div>


                <div class="container" style="background-color:#D1D1E2;height:100px;text-align:center;">
<a style="height:50px;font-size:14px;margin-bottom:-90px;" class="btn icon-btn btn-info" href="arrange.php?event_id=<?= $event_id ?>"><span class="glyphicon btn-glyphicon glyphicon-save img-circle text-muted"></span>See guest arrangements</a>
<a style="height:50px;font-size:14px;margin-bottom:-90px;" class="btn icon-btn btn-warning" href="postpone.php?event_id=<?= $event_id ?>" onclick="if (!confirm('Are you sure you want to postpone the event?')) { return false; }"><span class="glyphicon btn-glyphicon glyphicon-minus img-circle text-warning"></span>Postpone Event</a>
<a style="height:50px;font-size:14px;margin-bottom:-90px;" class="btn icon-btn btn-danger" href="deleteEv.php?event_id=<?= $event_id ?>" onclick="if (!confirm('Are you sure you want to delete the event? \n\nKeep in mind that this action will not guarantee money refund of paid goods!')) { return false; }"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span>Delete Event</a>
</div>

<div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">

      <!-- Icon Cards-->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                    <img src="https://cdn4.iconfinder.com/data/icons/characters-3/512/1-16-512.png">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Total Guests</h4>
                    <h2><?= $all_guests ?></h2>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                    <img src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Money-Increase-512.png">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Budget: <?= $budget1 ?></h4>
                    <h4>Emergency: <?= $emergency ?></h4>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                    <img src="https://cdn0.iconfinder.com/data/icons/love-and-valentine-6/512/valentine_date_love_-512.png">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Time left</h4>
                    <h2><?= $final_date ?> days</h2>
                </div>
              </div>
            </div>
        </div>

    </div>
  </div>
</div>



<div class="container my-5">
<div class="card-body text-center">
    <h4 class="card-title">Notification centre</h4>
  </div>
    <div class="card">
        
        <table class="table table-hover">
            <thead>
              <tr>
                
                <th scope="col" style="width:200px;">From</th>
                <th scope="col" style="width:700px;">Message</th>
                <th scope="col" style="width:200px;">Date</th>
                <th scope="col" style="width:200px;">Operations </th>
                
              </tr>
            </thead>
            <tbody>


            <?php $sql = "SELECT * FROM notifications WHERE event_id = :event_id";
    
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":event_id", $param_id);
                    
                    // Set parameters
                    $param_id = $event_id;
                    
                    // Attempt to execute the prepared statement
            $stmt->execute();
            $c = $stmt->rowCount();
            if( $c>0 ){
            while ($notif = $stmt->fetch()) { 
              
?>


            <tr <?php if( $notif[ 'notification_status' ] == 'not_seen' ){ ?> style="background-color:#6495ED;" <?php } ?>>
                
                <td><?= $notif[ 'notification_name' ] ?></td>
                <td><?= $notif[ 'notification_message' ] ?></td>
                <td><?= $notif[ 'notification_stamp' ] ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" style="width:60px;height:30px;" href="read_notif.php?event_id=<?= $event_id ?>&notif_id=<?= $notif[ 'notification_id' ] ?>"><i class="far fa-eye"></i> Mark as <br> read</a>
                    <a class="btn btn-sm btn-danger" style="width:60px;height:30px;" href="delete_notif.php?event_id=<?= $event_id ?>&notif_id=<?= $notif[ 'notification_id' ] ?>"><i class="fas fa-trash-alt" style="font-size:20px;margin-left:-20px;margin-right:-20px;margin-top:-45px;"></i> </a>    
                </td>
                
              </tr>
              

        <?php }} else{ echo '<td>No notifications.</td>'; } } ?>
            </tbody>
          </table>
    </div>
    </div>


    </div>


<?php include '../footer.php';  ?>
</body>
</html> 