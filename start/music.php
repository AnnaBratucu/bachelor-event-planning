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
  
   top: 0;
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
  margin-top:-1000px;
}

/* .products{
	background: white;
	
}
.container{
	background: white;
	
} */
.wiz{
	margin-top:-400px;
	position: relative;
}

.required:after { content:" *"; color:red;}
</style>​ 

<?php include '../head.php'; 
require("../PHPMailer/src/Exception.php");
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
require_once "../config.php";

session_start();

$guest_name_err = $guest_email_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_music_title = $_POST["title"];
    $input_music_artist = $_POST["artist"];

	
	
		$sql = "INSERT INTO music (event_id, music_title, music_artist) VALUES (:event_id, :music_title, :music_artist)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_event_id);
			$stmt->bindParam(":music_title", $param_title);
      $stmt->bindParam(":music_artist", $param_artist);
          
            // Set parameters
            $param_event_id = $_GET[ 'event_id' ];
			$param_title = $input_music_title;
      $param_artist = $input_music_artist;
          
            // Attempt to execute the prepared statement
            if(!$stmt->execute()){
                echo "Something went wrong. Please try again later.";
            } 
        }
		
}
?>


?>

<body>
<div class="wiz">


<?php 
require_once '../menu.php'; 
?>

            <div style="background-image:url('../images/music.jpg');background-size:cover;margin-top:-680px;margin-left:-40px;height:300px;">
            <div style="height:70px;"></div>
        <h1 style="color:white;">What music do you want played?</h1><br><br>
</div>

<div class="form-v4" >
	<div class="page-content" style="background-color:#edc9af;">
		<div class="form-v4-content" style="margin-right:-150px;width:1260px;-webkit-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
-moz-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);">
			<div class="form-left">
				<h2>ADD GUEST</h2>
        <form class="form-detail" autocomplete="off" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="post" id="myform">
            	
				<div class="form-row">
					<label for="title" style="color:white;">Song title</label> <label class="required"></label>
          <input type="text" name="title" id="title" class="input-text" required>
				</div>
				<div class="form-row">
          <label for="artist" style="color:white;">Artist</label> <label class="required"></label>
          <input type="text" name="artist" id="artist" class="input-text" required>
        </div>
				<div class="form-row-last">
          <input type="submit" name="account" class="account" value="Add">
				</div>
			</form>
        
			</div>

		<div id="wrapper" style="width:900px;">
<h2>GUEST LIST</h2>
  
  <table id="keywords" cellspacing="0" cellpadding="0" style="overflow-y:scroll;height:380px;display:block;">
    <thead>
      <tr>
		<td><div style="margin-right:15px;margin-left:-15px;"><input type="checkbox" id="checkAll" style="margin-left:20px;transform: scale(1);"></div></td>
        <th><span >No.</span></th>
        <th><span >Title</span></th>
        <th><span >Artist</span></th>
        <th><span>&nbsp</span></th>
      </tr>
    </thead>
    <tbody>
	<?php

$sql = "SELECT * FROM music WHERE event_id = :event_id ORDER BY music_id DESC";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->execute(['event_id' => $_GET[ 'event_id' ]]); 
       if( $stmt->rowCount() > 0 ){
          $count = 1;
        while ($row = $stmt->fetch()) { 
          
			?>
	<tr id='tr_<?= $row[ 'music_id' ]; ?>'>
		
		<td><div style="margin-right:-13px;margin-right:5px;"><input type='checkbox' id='del_<?php echo $row[ 'music_id' ]; ?>' ></div></td>
        <td><?php echo $count ?></td>
        <td><?php echo $row[ 'music_artist' ]; ?></td>
        <td><?php echo $row[ 'music_title' ]; ?></td>
        <td><a class="active" href="delete_music.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&music_id=<?php echo $row[ 'music_id' ]; ?>" onclick="if (!confirm('Are you sure you want to delete the song?')) { return false; }"><i class="fa fa-times" style="color:black;" data-toggle="tooltip" title="Delete song!" data-placement="top"></i></a></td>
     </tr>
	  <?php $count++; } } else{ ?> <tr>&nbsp</tr><tr><td>No songs added yet.</td></tr> <?php } }  ?>
    </tbody>
  </table>
  
 </div> 
		</div>
		<div>
			<input class="btn btn-success btn-sm" type='button' value='Delete All' id='delete' style="width:200px;margin-left:-300px;margin-top:600px;">
		</div>
	</div>
	
</div>
</div>

<?php include '../footer.php';  ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/select2/select2.min.js"></script>
<script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../js/main_guests.js"></script>

			<script type="text/javascript" src="../js/js_table/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
// modal

$(document).ready(function(){
    $('#modal1').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch_record.php', 
            data :  'rowid='+ rowid, 
            success : function(data){
              var myObj = JSON.parse(data);
              $('#id').val(myObj.id);
              $('#name').val(myObj.name);
              $('#email').val(myObj.email);
            }
        });
     });
});
$('#myModal1').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})





$('#delete').click(function(){
  
  var post_arr = [];

  // Get checked checkboxes
  $('input[type=checkbox]').each(function() {
    
    if (jQuery(this).is(":checked")) {
      var id = this.id;
      var splitid = id.split('_');
      var postid = splitid[1];

      post_arr.push(postid);
      
    }
  });
 //alert('aaa ' + post_arr);
  if(post_arr.length > 0){
    
      var isDelete = confirm("Do you really want to delete records?");
      if (isDelete == true) {
         // AJAX Request
         $.ajax({
            url: 'ajaxfile2.php',
            type: 'POST',
            data: { post_id: post_arr},
            success: function(response){
               $.each(post_arr, function( i,l ){
                   $("#tr_"+l).remove();
               });
            }
         });
      } 
  } 
});




// $('#send').click(function(){
// 	var event_id = document.getElementById("send").value;
// 	alert(event_id);
//   var post_arr = [];

//   // Get checked checkboxes
//   $('input[type=checkbox]').each(function() {
    
//     if (jQuery(this).is(":checked")) {
//       var id = this.id;
//       var splitid = id.split('_');
//       var postid = splitid[1];

//       post_arr.push(postid);
      
//     }
//   });
//  //alert('aaa ' + post_arr);
//   if(post_arr.length > 0){
    
//       var isDelete = confirm("Do you really want to send invitations to all guests?");
//       if (isDelete == true) {
//          // AJAX Request
//          $.ajax({
//             url: 'ajaxfile1.php',
//             type: 'POST',
//             data: { post_id: post_arr, event_id: },
//             success: function(response){
//             //    $.each(post_arr, function( i,l ){
//             //        $("#tr_"+l).remove();
//             //    });
//             }
//          });
//       } 
//   } 
// });
function myFunction() {
  var event = document.getElementById("myBtn").value;

  //alert( x );
  
  var post_arr = [];

  // Get checked checkboxes
  $('input[type=checkbox]').each(function() {
    
    if (jQuery(this).is(":checked")) {
      var id = this.id;
      var splitid = id.split('_');
      var postid = splitid[1];

      post_arr.push(postid);
      
    }
  });
 //alert('aaa ' + post_arr);
  if(post_arr.length > 0){
    
      var isDelete = confirm("Do you really want to send invitations to all guests?");
      if (isDelete == true) {
         // AJAX Request
         $.ajax({
            url: 'ajaxfile1.php',
            type: 'POST',
            data: { post_id: post_arr, event_id: event},
            success: function(response){
            //    $.each(post_arr, function( i,l ){
            //        $("#tr_"+l).remove();
            //    });
				location.reload();
            }
         });
      } 
  } 
}



$('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });


  $('#keywords').tablesorter(); 


//for form resubmition
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script> 
        
</body>
</html>