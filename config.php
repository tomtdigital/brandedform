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
