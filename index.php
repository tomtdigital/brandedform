<?php 
	//Message variables. These will be edited according to pass/fails
	$msg = '';
	$msgClass = ''; //different colours for different statuses.

	//Check for submit
	if(filter_has_var(INPUT_POST, 'submit')){
		
		//Get form data. html special chars is used, as we'll be echoing them in the html document.
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		//Check required fields. empty() or not !empty() used to see if completed
		//If these areas are NOT empty
		if(!empty($email) && !empty($name) && !empty('message')){
			//Passed- if this is the case, we then have to apply filters
			//Check email
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				//Failed
			$msg = 'Please enter a valid email address';
			$msgClass = 'alert-danger';	
			} else {
				//Passed
				//These are required in the later mail() function.
				$toEmail = 'tom.tdigital@gmail.com';
				$subject = 'Message from '.$name;
				$body = '<h2>Message</h2>
				<h4>Name: </h4><p>'.$name.'</p>
				<h4>Email: </h4><p>'.$email.'</p>
				<h4>Message: </h4><p>'.$message.'</p>';

				// Email Headers \r\n means return and new line
				$headers = "MIME-Version: 1.0" ."\r\n";
				//.= means append (it doesn't replace $headers, it adds to it)
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
				// Additional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				//This mail function actually sends the message. We set the parameter variables earlier.
				if(mail($toEmail, $subject, $body, $headers)){
					//Email Sent
					$msg = 'Your email has been sent';
					$msgClass = 'alert-success';	
				} else {
					//Failed
					$msg = 'Your email was not sent';
					$msgClass = 'alert-danger';	
				}
			}
		} else{
			//Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contact Us</title>
	<!--Addition of thrird party Bootstrap theme-->
	<link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./style.css" />

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