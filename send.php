<?php
	//创建会话
	@ session_start();
    header("Content-Security-Policy:default-src 'self'; script-src 'self' 'unsafe-inline'; font-src 'self' fonts.gstatic.com; style-src 'self' 'unsafe-inline'; img-src 'self'");

	if(empty($_POST['message']) && empty($_POST['code']))
	{
		echo "<script>alert('something error');	";
		echo "location.href='index.php';</script>";
		exit;
	}

	$message = $_POST['message'];
	$captcha=$_SESSION['captcha'];
	@$code = trim($_POST['code']);

	//过滤$message敏感字符
	function filter($string)
	{
			$escape = array('\'','\\\\');
			$escape = '/' . implode('|', $escape) . '/';
			$string = preg_replace($escape, '_', $string);

			$safe = array('select', 'insert', 'update', 'delete', 'where');
		 	$safe = '/' . implode('|', $safe) . '/i';
		 	$string = preg_replace($safe, 'hacker', $string);

			$xsssafe = array('img','script','on','svg','link');
			$xsssafe = '/' . implode('|', $xsssafe) . '/i';
			return preg_replace($xsssafe, '', $string);
	}
	function GetIP(){
	 if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif(!empty($_SERVER["REMOTE_ADDR"])){
			$cip = $_SERVER["REMOTE_ADDR"];
		}
		else{
			$cip = "NULL";
		}
		 return $cip;
	}

	if($captcha === substr(md5($code),0,4))
    {
		$message = filter($message);

		@ $db = new mysqli('localhost','web200','m3nxvrDSHq3cWYqP','web200');

		if($db->connect_errno)
		{
			echo "Error: Could not connect to database.Please try again later.";
			exit;
		}

		$query = "INSERT INTO records VALUES
				  (NULL, '$message');";

		$result2 = $db->query($query);

		$file  = 'it51zlog.log';
		$content = sprintf("ip: %s , message: %s \r\n", GetIP(), $message);

		$f  = file_put_contents($file, $content,FILE_APPEND);

		echo "<script>alert('send successfully :)');</script>";
	}
    else{
        echo "<script>alert('the code is wrong :)');";
		echo "location.href='index.php';</script>";
    }
?>
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
  </head>
  <body>

  	<div class="container back">
  		<h2 class="form-signin-heading">awaiting for the admin's approval</h2><br>

		<ul class='list-group' style='background-color: #333'>
			<li class="list-group-item"><?php echo $message;?>
			</li>
		</ul>
	</div>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/LoRexxar.js"></script>
  </body>
</html>