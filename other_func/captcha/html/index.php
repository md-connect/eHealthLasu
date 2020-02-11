<!DOCTYPE html>

<html>

<head>
	<title>CSS Contact Form</title>
	
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>

<body>

	<h2>Contact Form</h2>
	
	<form class="form" method="POST" action="contact_query.php">
		
		<p class="full_name">
			<input type="text" name="full_name" id="full_name" placeholder="" autofocus="autofocus" />
			<label for="full_name">Your Name</label>
		</p>
		
		<p class="email">
			<input type="text" name="email" id="email" placeholder="" />
			<label for="email">Your Email Address</label>
		</p>	
	
		<p class="message">
			<textarea name="message" placeholder="" /></textarea>
			<label for="message">Your Message</label>
		</p>
		
		<p class="button_submit">
			<input type="submit" name="send_message" value="Send" />
		</p>
	</form>

</body>

</html>

