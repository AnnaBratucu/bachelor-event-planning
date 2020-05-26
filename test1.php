<?php $myFile = "filename.html"; // or .php   
$fh = fopen($myFile, 'w'); // or die("error");  
$stringData = "

<html>
<head>
<title>hi</title>
</head>
<body>
<h1>test</h1>
<p>hope</p>
</body>
<html>

";   
fwrite($fh, $stringData);
fclose($fh);
?>