<?php
session_start();
error_reporting(0);
?>
<?php
if(isset($_POST['submit'])){
	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"></meta>
	<title>Contact Us</title>
	<link href="css/nav.css" rel="stylesheet" type="text/css"></link>
	<link href="css/style.css" rel="stylesheet" type="text/css"></link>
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
	<script type="text/javascript"></script>
  </head>
  <body>
	<div id="nav_back">
	<nav>
	  <ul class="nav">
		<li><a href="http://lasu.edu.ng">LASU HOME PAGE</a></li>
		<li><a href="index.php">HOME</a></li>
		<li><a href="contact.php">CONTACT US</a></li>
		<li><a href="about.php">ABOUT US</a></li>
	  </ul>
	</nav>
	</div>
	
	
  <div class="email" style="background-color:white; width:40%; margin-left:30%; margin-top:30px; box-shadow:2px 2px 2px 2px black;">
	
  <h2 style="margin-left:10px; padding-top:20px;"><span>Contact</span> Form</h2>
	
	<form class="form-horizontal" style="margin-left:360px;" method="POST" action="contact_query.php">
<h2>
	Feedback Form with Captcha
</h2>
	<p class="full_name">
		<input type="text" name="full_name" id="full_name" placeholder="Enter your full name . . . ." autofocus="autofocus" required/>
		<label for="full_name" style="color:blue; font-size:18px; font-family:cursive; margin-top:10px;">Your Name</label>
	</p>
		
	<p class="email">
		<input type="email" name="email" id="email" placeholder="Enter your email . . . ." required/>
		<label for="email" style="color:blue; font-size:18px; font-family:cursive; margin-top:10px;">Your Email Address</label>
	</p>	
	
	<p class="message">
		<textarea name="message" placeholder="Enter your feedback . . . ." required></textarea>
		<label for="message" style="color:blue; font-size:18px; font-family:cursive; margin-top:10px;">Your Feedback</label>
	</p>
	
<div class="control-group" style="float:left; margin-left:-185px;">
	<div class="controls">
	
	<img src="generatecaptcha.php?rand=<?php echo rand(); ?>" name="captcha_img" id='image_captcha' > 
	<a href='javascript: refreshing_Captcha();'><i class="icon-refresh icon-large"></i></a> 
	<script language='JavaScript' type='text/javascript'>
		function refreshing_Captcha()
		{
			var img = document.images['image_captcha'];
			img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
		}
	</script>
	</div>
</div>

<br />
<br />
<br />

<div class="control-group" style="margin-left:-181px;">
	<div class="controls">
		<input id="code" name="code_confirmation" type="text" placeholder="Enter the code above . . . ." required></td>
	</div>
</div>
<div class="control-group" style="margin-left:-181px;">
	<div class="controls">
		<button type="submit" name="send_message" class="btn btn-primary"><i class="icon-ok icon-large"></i> Submit</button>
	</div>
</div>

</form>
	
	<!--
	
	
	
	
	
  <form class="form-horizontal" method="POST" action="/other_func/captcha/contact_query.php" style="margin-left:10px;">
		
		<p class="full_name">
			<label for="full_name">Name (required)</label>
			<input type="text" name="full_name" id="full_name" placeholder="FULL NAME" autofocus="autofocus" style="width:200px; height:20px;" />
			
		</p>
		
		<p class="email">
			<label for="email">Email Address (required)</label>
			<input type="text" name="email" id="email" placeholder="EMAIL ADDRESS" style="width:200px; height:20px;"/>
			
		</p>	
	
		<p class="message">
			<label for="message">Your Message</label>
			<textarea name="message" placeholder="YOUR MESSAGE" /></textarea>
			
		</p>
		
		<p class="button_submit">
			<input type="submit" name="send_message" value="Send" style="width:200px; height:40px; background-color:green; cursor:pointer; "/>
		</p>
	</form>-->
	
	
	<br/><br/>
	<!--
	
	
	
	
	
	
	
	
	
	<form action="#" method="post" id="sendemail" style="margin-left:10px;">
		<table>
			<tr>
				<td>
					<label for="name">Name (required)</label>
				</td>
				<td>
					<input type="text" id="name" name="name" style="width:200px; height:20px;"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">Email Address (required)</label>
				</td>
				<td>
					<input type="email" id="email" name="email" style="width:200px; height:20px;"/>
				</td>
			</tr>
			<tr>
				<td>
				  <label for="message">Your Message</label>
				</td>
				<td>
				  <textarea id="message" name="message" rows="8" cols="50" style="resize:none;"></textarea>
				</td>
			</tr>
		</table><br/><br/>
    <input type="submit" name="submit" value="SEND" class="details" style="width:80px; background-color:green; cursor:pointer; " />
		<input type="reset" name="reset" value="RESET" class="details" style="width:80px; background-color:red; cursor:pointer; margin-left:3px;" />
		<br/><br/>
	</form> -->
	</div>
  </body>
	<?php include('footer.php'); ?>
	
</html>
 