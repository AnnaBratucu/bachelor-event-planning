<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <head>
        
    </head>
	<body>
		<div class='fade'>
            <div class="container_transition">
            <div id="background" class="row">
            <div class="jumbotron">
            <h1>Start planning your journey until the big day!</h1>
            </div>
            </div>
            </div>
		</div>
	</body>
</html> 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js">
</script>
<script>
//invoke background fadein on page load
$(window).ready(function() {
   $('#background').fadeIn(3700, function() {
   //wait 1 seconds and redirect to new URL
   $(this).delay(1000).fadeOut(2000, function() { window.location = 'eventType.php'; });
   });
});
</script>

</script>