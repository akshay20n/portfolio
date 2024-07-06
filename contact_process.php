<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$to = "akshaynavale5915@gmail.com";
$from = isset($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) : '';
$name = isset($_REQUEST['name']) ? sanitize_input($_REQUEST['name']) : '';
$subject_from_user = isset($_REQUEST['subject']) ? sanitize_input($_REQUEST['subject']) : '';
$number = isset($_REQUEST['number']) ? sanitize_input($_REQUEST['number']) : '';
$cmessage = isset($_REQUEST['message']) ? sanitize_input($_REQUEST['message']) : '';

if ($from && $name && $subject_from_user && $cmessage) {
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $subject = "You have a message from your Bitmap Photography.";

    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt='Logo'></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject_from_user}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    $send = mail($to, $subject, $body, $headers);

    if ($send) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid input.";
}
?>
