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
  margin-top:-540px;
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



ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 320px;
  width: 270px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
</style>​  
<?php include '../head.php'; 

require_once "../config.php";

//session_start();




?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
        
            <div style="background-image:url('../images/invit.jpg');background-size:cover;margin-botton:-300px;margin-left:-40px;height:350px;">
              <div style="height:120px;"></div>
              <h1 style="color:white;">Choose an invitation template</h1><br><br>
            </div>



<div class="form-v4" >
	<div class="page-content" style="background-color:#996515;">
    <div class="form-v4-content" style="width:1200px;margin-left:100px;height:650px;-webkit-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
-moz-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);">

        <form class="form-detail" id="regForm" autocomplete="off" action="invitations2.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>" method="POST" style="width:1200px;">
          <ul style="margin-top:-70px;margin-left:10px;">
            <li>
              <label class="container2">
                <input type="radio" id="myCheckbox1" name="img" value="img1" required />
                <label for="myCheckbox1"><img src="img/img1.png" /></label>
              </label>
            </li>
            <li>
              <label class="container2" style="margin-left:-40px;">
                <input type="radio" id="myCheckbox2" name="img" value="img2" required/>
                <label for="myCheckbox2"><img src="img/img2.png" /></label>
              </label>
            </li>
            <li>
              <label class="container2" style="margin-left:-40px;">
                <input type="radio" id="myCheckbox3" name="img" value="img3" required/>
                <label for="myCheckbox3"><img src="img/img3.png" /></label>
              </label>
            </li>
          </ul>
          <ul style="margin-bottom:70px;">
            <li style="margin-left:150px;"><a href="invits/index.html" target="_blank" style="color:black;">DEMO</a></li>
            <li style="margin-left:320px;"><a href="web1/index.html" target="_blank" style="color:black;">DEMO</a></li>
            <li style="margin-left:300px;"><a href="web/index.html" target="_blank" style="color:black;">DEMO</a></li>
          </ul>
          <div class="form-row-last" style="margin-left:500px;">
            <input type="submit" name="register" class="register" value="Next">
          </div>
        </form>

      </div>
    </div>
</div>

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