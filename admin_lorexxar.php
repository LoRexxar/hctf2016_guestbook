<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sercet guestbook</title>

    <link href="css/signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/LoRexxar.css">
  <body>

	<ul class='list-group'>
    <?php
    header("Content-Security-Policy:default-src 'self'; script-src 'self' 'unsafe-inline'; font-src 'self' fonts.gstatic.com; style-src 'self' 'unsafe-inline'; img-src 'self'");

    if(@$_COOKIE['admin'] != 'hctf2o16com30nag0gog0')
    {
        exit('mb, you are not admin!!!');
    }

    @ $db = new mysqli('localhost','web200','m3nxvrDSHq3cWYqP','web200');

    if($db->connect_errno)
    {
        echo "Error: Could not connect to database.Please try again later.";
        exit;
    }


    $query="select message from records";
    $result=$db->query($query);
    @ $num_results = $result->num_rows;

    for($i=0;$i < $num_results; $i++)
    {
        $row = $result->fetch_assoc();
        echo " <li class=\"list-group-item\">".$row['message']."</li>";
    }

    @$result->free();
    $db->close();

    ?>		

	</ul>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/LoRexxar.js"></script>
  </body>
</html>