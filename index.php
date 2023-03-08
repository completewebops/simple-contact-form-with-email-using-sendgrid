<?php
require 'vendor/autoload.php';

$sendgrid_api_key = "Your SendGrid Key";
//Get form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $email_body = "Name: $name\nEmail: $email\nMessage: $message";

  $email = new \SendGrid\Mail\Mail();
  $email->setFrom("your-email-here", "Your Name Here");//<-destination email
  $email->setSubject("New contact form submission");
  $email->addTo("your-email-here", "Your Name Here");//<-destination email
  $email->addContent("text/plain", $email_body);

  $sendgrid = new \SendGrid($sendgrid_api_key);

  try {
      $response = $sendgrid->send($email);
      echo '<p style="text-align:center;">Email sent successfully!</p>'; 
  } catch (Exception $e) {
      echo 'Failed to send email: ' . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Form</title>
  <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
  <div class="contact-form">
    <h2>Contact Us</h2>
    <form action="#" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit">Submit</button>
    </form>
    
  </div>
</body>
</html>
