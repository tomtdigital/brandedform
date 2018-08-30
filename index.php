<?php include './config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contact Us</title>
	<!--Addition of thrird party Bootstrap theme-->
	<link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./style.css" />
	<meta property="og:title" content="tDigital PHP Form" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://tdavies.co.uk/form/index.php" />
    <meta property="og:image" content="http://tdavies.co.uk/img/projects/project5.jpg" />
    <meta property="og:description" content="Contact tDigital with PHP!" />

</head>
<body id="override">
	<!--Basic Navbar-->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<div class="navbar-header">
			<p class="nav-text">Contact tDigital</p>
			</div>
			<a href="http://tdavies.co.uk/work.html" target="blank"><img src="http://tdavies.co.uk/cutmyurl//img/tDigital%20Logo.svg" class="logo w-10 d-block mx-auto" /></a>
		</div>
	</nav>
	<br>

	<!--Form-->
	<div class="container">
		<!--If there isn't a message already displayed-->
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class= "form-group">
				<label>Name</label>
				<!--value- shorthand for- if the name field had information submitted, keep it. If it didn't, display nothing. (all in case of errors and the form re-setting--> 
				<input type="text" name="name" class="form-control" id="name" value="<?php echo isset($_POST['name']) ? /*true*/$name : /*false*/''; ?>">
			</div>
			<div class="form-group">
				<label>Email</label>
					<input type="text" name="email" class="form-control" id="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
			</div>
			<div class="form-group">
					<label>Message</label>
						<!--We don't use values for text-boxes, so the message memory has to be in the text area itself-->
						<textarea name="message" class="form-control" id="message"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
			</div>
			<br>
			<!-- name= "submit" helps us clarify a submission in the php-->
			<button type="submit" name="submit" class="btn btn-grey">Submit</button>
		</form>
	</div>
</body>
</html>