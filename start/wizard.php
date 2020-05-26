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
  margin-top:-500px;
}


/* .products{
	background: white;
	
	
}
.container{
	background: white;
	
} */

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
<?php include '../head.php'; 

require_once "../config.php";

session_start();

$date_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_date_min = $_POST["date_min"];
    $input_date_max = $_POST["date_max"];
    $input_date_min_time = strtotime($_POST["date_min"]);
    $input_date_max_time = strtotime($_POST["date_max"]);
    $today_time = strtotime( date("m/d/Y") );
    if($input_date_min_time > $input_date_max_time){
		$date_err = "Date Min can't be bigger than Date Max";
    } else if( $input_date_min_time < $today_time || $input_date_max_time < $today_time ){
        $date_err = "Date Min or Date Max can't be in the past" ;
    }else{
        $_SESSION[ 'date_min' ] = $input_date_min;
        $_SESSION[ 'date_max' ] = $input_date_max;
        if(isset($_GET[ 'event_id' ])){
            $id = $_GET[ 'event_id' ];
            header("location: ../start_admin/wizard_admin.php?event_id=$id");
            exit();
        }else{
            header("location: ../start_admin/wizard_admin.php");
            exit();
        }
    }
}


?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
        <form id="regForm" autocomplete="off" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Choose the date interval in which you want your event to take place</h1><br><br>
</div>
<div class="row" style="margin-left:80px;">
  <div class="column">
    <p style="color:black;">Date Min: <input type="text" name="date_min" id="datepicker" required placeholder="mm/dd/yyyy" value="<?php if( isset($_SESSION[ 'date_max' ]) && $date_err == '' ) echo $_SESSION[ 'date_min' ] ?>"><i class="fas fa-calendar-day" style="color:black;top:0px;left:-50px;"></i></p>
  </div>
  <div class="column">
    <p style="color:black;">Date Max: <input type="text" name="date_max" id="datepicker1" required placeholder="mm/dd/yyyy" value="<?php if(isset($_SESSION[ 'date_max' ]) && $date_err == '' ) echo $_SESSION[ 'date_max' ] ?>"><i class="fas fa-calendar-day" style="color:black;top:0px;left:-50px;"></i></p>
  </div>
</div>
<div style="color:red;"><?php echo $date_err; ?></div>


  <div style="overflow:auto;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <input type="submit" value="Next" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:390px;cursor:pointer;">
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

<?php include '../footer.php';  ?> 
</body>
</html>