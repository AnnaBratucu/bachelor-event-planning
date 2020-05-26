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
  margin-top:-150px;
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
				<h1 style = "color:black;">Edit guest</h1>
				
				<div class="container">
  <div class="row text-center">
    <div class="col border-right" style="color:black;">
	  
	
				<input type="text" hidden name="id" id="id">
				<div class='div'>
					<span class='blocking-span'>
						<input type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;height:55px;margin: 5px 0 18px 0;border: none;" class="inputText" name="name" id="name" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Guest Name <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;height:55px;margin: 5px 0 18px 0;border: none;" type="text" name="email" id="email" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Guest Email <span style="color:red"> *</span></span>
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
						<table id='recordsTable'>
							<thead>
								<tr>
                  <th><input type="checkbox" id="checkAll" style="margin-left:20px;transform: scale(1);"></th>
									<th class="cell100 column1">No.</th>
									<th class="cell100 column1">Name</th>
									<th class="cell100 column4">Email</th>
									<th class="cell100 column3">Attends?</th>
                  <th class="cell100 column1">Plus one?</th>
                  <th class="cell100 column1">Sent?</th>
                  <th class="cell100 column4"></th>
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
      
          $count = 1;
        while ($row = $stmt->fetch()) { 
          
            ?>
								<tr class="row100 body" id='tr_<?= $row[ 'guest_id' ]; ?>'>
                  <td><input type='checkbox' id='del_<?php echo $row[ 'guest_id' ]; ?>' style="margin-left:20px;"></td>
									<td class="cell100 column1"><?php echo $row[ 'guest_id' ]; ?></td>
									<td class="cell100 column1"><?php echo $row[ 'guest_name' ]; ?></td>
                  <td class="cell100 column4"><?php echo $row[ 'guest_email' ]; ?></td>
                  <td class="cell100 column3"><?php if( $row[ 'guest_status' ] == 'pending' ) echo "N/A";
                                                      else if ( $row[ 'guest_status' ] == 'accepted' ) echo "Invitation Accepted";
                                                      else if ( $row[ 'guest_status' ] == 'denied' ) echo "Invitation rejected"; ?></td>
                  <td class="cell100 column1"><?php if( $row[ 'guest_plus' ] == 'no' ) echo "No";
                                                      else if ( $row[ 'guest_plus' ] == 'yes' ) echo "Yes";
                                                      else if ( $row[ 'guest_plus' ] == '' ) echo "N/A"; ?></td>
                  <td class="cell100 column1"><?php if( $row[ 'guest_send' ] == 'no' ) echo "No";
                                                      else if ( $row[ 'guest_send' ] == 'yes' ) echo "Yes"; ?></td>
                  <td class="cell100 column4">
                    <a class="active" href="send_mail.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&guest_id=<?php echo $row[ 'guest_id' ]; ?>&guest_email=<?php echo $row[ 'guest_email' ]; ?>" onclick="if (!confirm('Are you sure you want to send invitation?')) { return false; }"><i class="fa fa-envelope" style="color:black;" data-toggle="tooltip" title="Send invitation!" data-placement="top"></i></a>
                  </td>  
                  <td class="cell100 column4">
                    <a class="active" href="#" data-toggle="modal" data-target="#modal1" data-id="<?php echo $row[ 'guest_id' ] ?>"><i class="fa fa-edit" style="color:black;" data-toggle="tooltip" title="Edit guest!" data-placement="top"></i></a>
                  </td>
                  <td class="cell100 column4">
                    <a class="active" href="delete_guest.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&guest_id=<?php echo $row[ 'guest_id' ]; ?>" onclick="if (!confirm('Are you sure you want to delete guest?')) { return false; }"><i class="fa fa-times" style="color:black;" data-toggle="tooltip" title="Delete guest!" data-placement="top"></i></a>
                  </td>

                </tr>
        <?php $count++; } } else{ ?> <tr>&nbsp</tr><tr><td>No guests added yet.</td></tr> <?php } }  ?>
							</tbody>
						</table>
					</div>
				</div>
				<input type='button' value='Delete' id='delete' style="width:200px;">
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

<script>

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


$('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
</script> 

</body>
</html>