<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php
   $WAIT_TIME = $_GET["time"];
   sleep($WAIT_TIME);
   echo "<p>Hello World</p>";
 ?> 
 </body>
</html>