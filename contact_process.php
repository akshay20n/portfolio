<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $to = "akshaynavale5915@gmail.com";
    $from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_REQUEST['name']);
    $subject = htmlspecialchars($_REQUEST['subject']);
    $cmessage = htmlspecialchars($_REQUEST['message']);

    // Validate email
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Validate required fields
    if (empty($name) || empty($subject) || empty($cmessage)) {
        echo "All fields are required.";
        exit;
    }

    // Email headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Email subject
    $email_subject = "You have a message from your Bitmap Photography.";

    // Email body
    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt='Logo'></a><br><br>";
    $body .= "</td></tr></thead><tbody>";
    $body .= "<tr><td style='border:none;'><strong>Name:</strong> {$name}</td></tr>";
    $body .= "<tr><td style='border:none;'><strong>Email:</strong> {$from}</td></tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // Send email
    $send = mail($to, $email_subject, $body, $headers);

    if ($send) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}

?>
