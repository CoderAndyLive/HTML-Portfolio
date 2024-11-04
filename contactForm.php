<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = '6LcnRm8qAAAAAIJZiZvZHehScmcuvW596MD81zCx';
    $recaptchaResponse = $_POST['recaptcha_response'];

    // Verify the reCAPTCHA response
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"] && $responseKeys["score"] >= 0.5) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        
        $to = "andy.nguyen@twofold.swiss";
        $subject = "Someone has tried to contact you!";
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";
        
        if (mail($to, $subject, $body, $headers)) {
            echo "<div class='success-message'>Message sent successfully!</div>";
        } else {
            echo "<div class='error-message'>Failed to send message. Please try again later.</div>";
        }
    } else {
        echo "<div class='error-message'>reCAPTCHA verification failed. Please try again.</div>";
    }
}
?>