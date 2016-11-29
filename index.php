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
  <?php

    @ session_start();

    header("Content-Security-Policy:default-src 'self'; script-src 'self' 'unsafe-inline'; font-src 'self' fonts.gstatic.com; style-src 'self' 'unsafe-inline'; img-src 'self'");

    #写入验证码
    $captcha=substr(md5(rand(100000,999999)),0,4);
    $_SESSION['captcha']=$captcha;

  ?>

    <br>
    <h2 class="form-signin-heading">Welcome to my guestbook!</h2><br>
    <form class="form-signin" action="send.php" method="POST">
       	<textarea name="message" class="form-control" cols="8" rows="4" placeholder="input message" required></textarea>
        substr(md5($code),0,4) =='<?php echo $captcha?>'<input type="text" class="form-control code" name="code" />
      	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Send">
    </form>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/LoRexxar.js"></script>
  </body>
</html>