<!DOCTYPE html>
<html>
    <head>
        <title>Rating</title>

        <!-- Add the plugin's CSS (make sure of path) -->
        <link rel="stylesheet" type="text/css" href="src/css/star-rating-svg.css">
    </head>
    <body>

    <!-- Display the stars on page -->
    <div class="my-rating"></div>

    <!-- Add jquery.min.js -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <!-- Add plugin's required JS (make sure of paths) -->
    <script src="src/jquery.star-rating-svg.js"></script>

    <!-- Initiate the plugin -->
    <script>
        $(".my-rating").starRating({
            starSize: 25,
            callback: function(currentRating, $el){

                $.post('submit_rating.php', {rating: currentRating});

            }
        });
    </script>
    </body>
</html>