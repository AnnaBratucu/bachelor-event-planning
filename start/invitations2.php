<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>
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
  margin-top:-537px;
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
.required:after { content:" *"; color:red;}
</style>​  
<?php include '../head.php'; 

require_once "../config.php";

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  

$_SESSION[ 'inv' ] = $_POST[ 'img' ];


?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
            <div style="background-image:url('../images/invit.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;height:300px;">
              <div style="height:70px;"></div>
              <h1 style="color:white;">Choose the invitation info</h1><br><br>
            </div>



            <div class="form-v4">
	<div class="page-content" style="background-color:#996515;">
		<div class="form-v4-content" style="-webkit-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
-moz-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);">
			
			<form class="form-detail" autocomplete="off" action="invitations3.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>" method="post" id="myform" enctype='multipart/form-data'>
            	<h2>REGISTER CARD INFO</h2>
				<div class="form-row">
					<label for="her_name">Bride's Name</label> <label class="required" style="margin-left:-25px;"></label>
          <input type="text" name="her_name" id="her_name" class="input-text" style="width:450px;margin-left:10px;" required>
				</div>
				<div class="form-row">
          <label for="his_name">Groom's Name</label><label class="required" style="margin-left:-25px;"></label>
          <input type="text" name="his_name" id="his_name" class="input-text" style="width:450px;" required>
        </div>
        <div class="form-row">
          <label for="story">Your story</label><label class="required" style="margin-left:-25px;"></label>
          <input type="text" name="story" id="story" class="input-text" required style="height:150px;width:450px;margin-left:32px;">
				</div>
        <div class="form-row">
          <label for="story">Upload a picture of you</label><label class="required" style="margin-left:-25px;"></label>
          <input id="upload" type="file" name="file" onchange="readURL(this);" class="input-text" required style="width:355px;margin-left:32px;">
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Save">
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


  function validateFileType(){
        var fileName = document.getElementById("upload").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
            $("#upload").val(null);
        }   
    }
    
  </script>

<?php include '../footer.php';  ?> 
</body>
</html>