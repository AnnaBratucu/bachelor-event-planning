
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



 

<style>
.wiz{
  margin-top:-370px;
  background-color:#C0C0C0;
}
  .draggable {
      width: 200px;
      height: 200px;
      padding: 0.5em;
      float: left;
      margin: 0 10px 10px 0;
      border-color:white;
  }
  .draggable1 {
      width: 100px;
      height: 35px;
      padding: 0.5em;
      float: left;
      
	  border:0;
  }
  #draggable, #draggable2 {
      margin-bottom:20px;
  }
  #draggable {
      cursor: n-resize;
  }
  #draggable3 {
      cursor: move;
  }
  #containment-wrapper {
      width: 1200px;
      height:1500px;
      border:1px solid #000;
      padding: 5px;
      background-color:white;
  }
  h3 {
      clear: left;
  }
</style>

</head>
<body>
<div class="wiz">
<?php include '../head.php'; 
require_once "../config.php";

require_once '../menu.php'; 

?>

<div style="background-image:url('../images/table.jpg');background-size:cover;margin-top:-680px;margin-left:-40px;height:300px;">
            <div style="height:70px;"></div>
        <h1 style="color:white;">Arrange the tables and guests.</h1><br><br>
</div>

<div id="containment-wrapper" style="margin-left:250px;">

<?php 
$event_id = $_GET[ 'event_id' ];
$sql = "SELECT * FROM users_profile WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $event = $stmt->fetch();
    $venue_id = $event[ 'venue_id' ];
  }

  $sql = "SELECT * FROM venues WHERE venue_id = :venue_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
			$param_id = $venue_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $venue = $stmt->fetch();
        $capacity = $venue[ 'venue_capacity' ];
  }

  if( $capacity <= 50 ){
      $a = 11;
  }else if( $capacity > 50 && $capacity <=  150 ){
      $a = 29;
  }else{
      $a = 50;
  }
      for( $i = 3; $i < $a; $i++ ){
?>

	
    <div id="draggable<?= $i ?>" class="draggable ui-widget-content" style="border:0;">
	
	<img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<!-- <div id="draggable4" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable5" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable6" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable7" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable8" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable9" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div>
<div id="draggable10" class="draggable ui-widget-content" style="border:0;"><img id="img1" src="images/table1.png" height:"200" width="200"></img>
    </div> -->

  <?php } ?>
	
	<?php
$event_id = $_GET[ 'event_id' ];
$sql = "SELECT * FROM guests WHERE guest_status = :guest_status AND event_id=:event_id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->execute(['guest_status' => 'accepted', 'event_id' => $event_id]); 
        if($stmt->rowCount() > 0){

         
          $count = 1;
        while ($row = $stmt->fetch()) { 
          
			?>



	
     
        <ul>
            <li style="background-color:green;" class="draggable1 ui-widget-content" id="<?= $count ?>"><?= $row[ 'guest_name' ] ?></li>
        </ul>

        <?php $count++; } } }  ?>
</div>

<script>
var sPositions = localStorage.positions || "{}",
    positions = JSON.parse(sPositions);
$.each(positions, function (id, pos) {
    $("#" + id).css(pos)
});

for( var i = 3; i < 301; i++ ){
    $("#draggable" + i).draggable({
        containment: "#containment-wrapper",
        scroll: false,
        stop: function (event, ui) {
            positions[this.id] = ui.position
            localStorage.positions = JSON.stringify(positions)
        }   
    });
}
// $("#draggable4").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable5").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable6").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable7").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable8").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable9").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });

// $("#draggable10").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });


for( var i = 1; i < 301; i++ ){
    $("#" + i).draggable({
        containment: "#containment-wrapper",
        scroll: false,
        stop: function (event, ui) {
            positions[this.id] = ui.position
            localStorage.positions = JSON.stringify(positions)
        }   
    });
}
// $("#2").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });
// $("#3").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });
// $("#4").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });
// $("#5").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });
// $("#6").draggable({
//     containment: "#containment-wrapper",
//     scroll: false,
//     stop: function (event, ui) {
//         positions[this.id] = ui.position
//         localStorage.positions = JSON.stringify(positions)
//     }   
// });



</script>
<?php include '../footer.php';  ?>
</body>
</html>
