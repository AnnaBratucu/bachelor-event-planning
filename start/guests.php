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
    $input_guest_name = $_POST["guest_name"];
    $input_guest_email = $_POST["guest_email"];

	
	if(!filter_var($input_guest_email, FILTER_VALIDATE_EMAIL) && $input_guest_email != ''){
		$guest_email_err = "Please enter a valid Email.";
	} else{
		$email = $input_guest_email;
	}
    if(empty($guest_email_err) ){
		$sql = "INSERT INTO guests (event_id, guest_name, guest_email, guest_plus, guest_send, guest_status) VALUES (:event_id, :guest_name, :guest_email, :guest_plus, :guest_send, :guest_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_event_id);
			$stmt->bindParam(":guest_name", $param_name);
      $stmt->bindParam(":guest_email", $param_email);
      $stmt->bindParam(":guest_plus", $param_plus);
      $stmt->bindParam(":guest_send", $param_send);
			$stmt->bindParam(":guest_status", $param_status);
            
            // Set parameters
            $param_event_id = $_GET[ 'event_id' ];
			$param_name = $input_guest_name;
      $param_email = $email;
      $param_plus = '';
      $param_send = 'no';
			$param_status = 'pending';
            
            // Attempt to execute the prepared statement
            if(!$stmt->execute()){
                echo "Something went wrong. Please try again later.";
            } 
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

<div class="modal hide fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" style="width: 800px;margin-left: 180px;height:900px;">
    <div class="modal-content" style="width: 800px;margin-left: 180px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      <form action="edit_guest.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>" method="post" class="form-container" enctype='multipart/form-data'>
			<!-- <div class="fetched-data" style="color:black;"></div>  -->
				<h1 style = "color:black;">Edit guest</h1><br>
				
				<div class="container">
  <div class="row text-center">
    <div class="col border-right" style="color:black;">
	  
	
				<input type="text" hidden name="id" id="id">
				<div class='div'>
					<span class='blocking-span'>
						<span style = "color:grey;margin-left:-600px;">Guest Name <span style="color:red"> *</span></span>
						<input type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;width:350px;height:55px;margin: 5px 0 18px 0;border: none;" class="inputText" name="name" id="name" required>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<span style = "color:grey;margin-left:-600px;">Guest Email <span style="color:red"> *</span></span>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;width:350px;height:55px;margin: 5px 0 18px 0;border: none;" type="text" name="email" id="email" required>
					</span>
				</div>
				

    </div>
  </div>
</div>
				<?php //echo $_GET[ 'name' ]; ?>
				<button type="submit" class="btn" style="width:100px;margin-left:15px;height:60px;">Edit</button>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






            <div style="background-image:url('../images/guests.jpg');background-size:cover;margin-top:-680px;margin-left:-40px;height:300px;">
            <div style="height:70px;"></div>
        <h1 style="color:white;">Invite your friends</h1><br><br>
</div>

<div class="form-v4">
	<div class="page-content" style="background-color:#edc9af;">
		<div class="form-v4-content" style="margin-right:-150px;width:1260px;-webkit-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
-moz-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);">
			<div class="form-left">
				<h2>ADD GUEST</h2>
        <form class="form-detail" autocomplete="off" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="post" id="myform">
            	
				<div class="form-row">
					<label for="guest_name" style="color:white;">Guest Name</label> <label class="required"></label>
          <input type="text" name="guest_name" id="guest_name" class="input-text" required>
				</div>
				<div class="form-row">
          <label for="guest_email" style="color:white;">Guest Email</label> <label class="required"></label>
          <input type="text" name="guest_email" id="guest_email" class="input-text" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
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
		<td><div style="margin-left:-20px;margin-right:15px;"><input type="checkbox" id="checkAll" style="margin-left:20px;transform: scale(1);"></div></td>
        <th><span>No.</span></th>
        <th><span>Name</span></th>
        <th><span>Email</span></th>
		<th><span>Attends?</span></th>
		<th><span>Plus one?</span></th>
		<th><span>Sent?</span></th>
		<th><span>&nbsp</span></th>
		<th><span>&nbsp</span></th>
		<th><span>&nbsp</span></th>
      </tr>
    </thead>
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
      
          $count = 1;
        while ($row = $stmt->fetch()) { 
          
			?>
	<tr id='tr_<?= $row[ 'guest_id' ]; ?>'>
		
		<td><div style="margin-right:-13px;margin-right:5px;"><input type='checkbox' id='del_<?php echo $row[ 'guest_id' ]; ?>' ></div></td>
        <td><?php echo $count ?></td>
        <td><?php echo $row[ 'guest_name' ]; ?></td>
        <td><?php echo $row[ 'guest_email' ]; ?></td>
        <td><?php if( $row[ 'guest_status' ] == 'pending' ) echo "N/A";
                                                      else if ( $row[ 'guest_status' ] == 'accepted' ) echo "Invitation Accepted";
													  else if ( $row[ 'guest_status' ] == 'denied' ) echo "Invitation rejected"; ?></td>
		<td><?php if( $row[ 'guest_plus' ] == 'no' ) echo "No";
                                                      else if ( $row[ 'guest_plus' ] == 'yes' ) echo "Yes";
                                                      else if ( $row[ 'guest_plus' ] == '' ) echo "N/A"; ?></td>
		<td><?php if( $row[ 'guest_send' ] == 'no' ) echo "No";
                                                      else if ( $row[ 'guest_send' ] == 'yes' ) echo "Yes"; ?></td>
		<td><a class="active" href="send_mail.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&guest_id=<?php echo $row[ 'guest_id' ]; ?>&guest_email=<?php echo $row[ 'guest_email' ]; ?>" onclick="if (!confirm('Are you sure you want to send invitation?')) { return false; }"><i class="fa fa-envelope" style="color:black;" data-toggle="tooltip" title="Send invitation!" data-placement="top"></i></a></td>
		<td><a class="active" href="#" data-toggle="modal" data-target="#modal1" data-id="<?php echo $row[ 'guest_id' ] ?>"><i class="fa fa-edit" style="color:black;" data-toggle="tooltip" title="Edit guest!" data-placement="top"></i></a></td>
		<td><a class="active" href="delete_guest.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&guest_id=<?php echo $row[ 'guest_id' ]; ?>" onclick="if (!confirm('Are you sure you want to delete guest?')) { return false; }"><i class="fa fa-times" style="color:black;" data-toggle="tooltip" title="Delete guest!" data-placement="top"></i></a></td>
      </tr>
	  <?php $count++; } } else{ ?> <tr>&nbsp</tr><tr><td>No guests added yet.</td></tr> <?php } }  ?>
    </tbody>
  </table>
  
 </div> 
		</div>
		<div>
			<!-- <input type='button' value='Send All' id='send' style="width:200px;margin-left:-600px;margin-top:600px;"> -->
			<button class="btn btn-success btn-sm" id="myBtn" value="<?= $_GET[ 'event_id' ] ?>" onclick="myFunction()" style="width:200px;margin-left:-600px;margin-top:600px;">Send All</button>
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
            url: 'ajaxfile.php',
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