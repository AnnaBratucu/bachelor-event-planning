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

session_start();

$_SESSION[ 'inv' ] = $_POST[ 'img' ];


?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
        <form id="regForm" autocomplete="off" action="invitations3.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>" method="POST" enctype='multipart/form-data'>
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Choose the invitation info</h1><br><br>
</div>
        <div class='div'>
					<span class='blocking-span'>
						<input type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;height:55px;margin: 5px 0 18px 0;border: none;" class="inputText" name="her_name" id="her_name" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Bride's Name <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;height:55px;margin: 5px 0 18px 0;border: none;" type="text" name="his_name" id="his_name" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Groom's Name <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<textarea class="input js-example-placeholder-single js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;border-radius:4px;" rows="4" cols="57" name="story" id="story" required></textarea>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Your story <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
				  <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
						<input id="upload" type="file" name="file" onchange="validateFileType()" class="form-control border-0" accept="image/*" required>
						<i class="fa fa-cloud-upload mr-2 text-muted" id="iclass"></i><label id="upload-label" for="upload" class="font-weight-light text-muted">Import your picture</label>
					</div>
				</div>


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