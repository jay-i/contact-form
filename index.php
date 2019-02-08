<?php
	$msg = "";
	$msgClass = "";

// Check for submit 
	if(filter_has_var(INPUT_POST, 'submit')){
		// Get form Data
		$name = htmlspecialchars($_POST['name']);
		$email =htmlspecialchars($_POST['email']);
		$message =htmlspecialchars($_POST['message']);
		
		// Check required fields
		if(!empty($name) && !empty($email) && !empty($message)){
			// Passed
			// Check Email
			 if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				 // Failed
				 $msg = 'Please Enter a Valid Email';
				 $msgClass = 'alert-danger';
			 }else{
				 // Passed
				
				 // Recipient Email
				 $toEmail = 'support@jtech.com';
				 $subject = 'Contact Request From '.$name;
				 $body = '<h2>Contact Request</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Message</h4><p>'.$message.'</p>
				 ';
				
				// Email Headers
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
				
				// Additional Headers
				$headers .= "From: " .$name. "<" .$email.">". "\r\n";
				
				// Using mail function
				if(mail($toEmail, $subject, $body, $headers)){
				// Email Sent
					$msg = 'Your Email has been Sent';
					$msgClass = 'alert-success';
				}else{
					$msg = 'Your Email was not Sent';
					$msgClass = 'alert-danger';
				}
			 }
		}else{
			// Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container">
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">My Website</a>
			</div>
		</div>
	<nav>
		<div class="container">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
				</div>
				<br>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</nav>
	</div>
</body>
</html>