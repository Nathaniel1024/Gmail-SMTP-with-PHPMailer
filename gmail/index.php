<?php
    $msg = ""; // Message variable

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Get email from form

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['submit'])){
        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //User the Gmail SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'testgmail@gmail.com';                     //SMTP username which is your gmail account
            $mail->Password   = 'your app key';                               //SMTP password which is your app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Use SSL encryption which is ENCRYPTION_SMTPS for Gmail SMTP
            $mail->Port       = 465;                                    //TCP port to connect to; use 465 for Gmail SMTP

            //Recipients
            $mail->setFrom($email, 'Mailer');         //Set who the message is to be sent from
            $mail->addAddress($email); // Add a recipient email address

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b> and this is Haewon from NMIXX <img src="cid:haewon" alt="picture of haewon">';
            $mail->addEmbeddedImage('img/haewon.jpg', 'haewon');
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $msg = "Check you inbox for the email";
        } catch (Exception $e) {
            $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Aligned Responsive Form</title>
</head>
<body>
    <div class="form-container">
        <h2>Google SMTP Demo</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
            <div class="social-links">
                <a href="https://github.com/nathaniel1024" target="_blank" class="github-icon">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <p> <?php echo htmlspecialchars($msg) ?></p>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>