<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
define('SENDER', 'sender@example.com');        

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
define('RECIPIENT', 'recipient@example.com');  
                                                      
// Replace smtp_username with your Amazon SES SMTP user name.
define('USERNAME','smtp_username');  

// Replace smtp_password with your Amazon SES SMTP password.
define('PASSWORD','smtp_password');  

// If you're using Amazon SES in a region other than US West (Oregon), 
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP  
// endpoint in the appropriate region.
define('HOST', 'email-smtp.us-west-2.amazonaws.com');  

 // The port you will connect to on the Amazon SES SMTP endpoint.
define('PORT', '587');     

// Other message information                                               
define('SUBJECT','Amazon SES test (SMTP interface accessed using PHP)');
define('BODY','This email was sent through the Amazon SES SMTP interface by using PHP.');

require_once 'Mail.php';

$headers = array (
  'From' => SENDER,
  'To' => RECIPIENT,
  'Subject' => SUBJECT);

$smtpParams = array (
  'host' => HOST,
  'port' => PORT,
  'auth' => true,
  'username' => USERNAME,
  'password' => PASSWORD
);

 // Create an SMTP client.
$mail = Mail::factory('smtp', $smtpParams);

// Send the email.
$result = $mail->send(RECIPIENT, $headers, BODY);

if (PEAR::isError($result)) {
  echo("Email not sent. " .$result->getMessage() ."\n");
} else {
  echo("Email sent!"."\n");
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
// Create the email and send the message
$to = 'joseppascualbadia@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>
