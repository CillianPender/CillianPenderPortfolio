<?php
        $email;$comment;$captcha;
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }

        //What happens if the form is submitted incorrectly

        if(!$captcha){
          header("Location:contact-fail.php");
        }

        $secretKey = "6LcUTzIUAAAAADlQBZ2t4Lga71plobtHFjyIE__0";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(intval($responseKeys["success"]) !== 1) {
           header("Location:404.html");
        }

        else {

        //What happens if the form is submitted correctly

          $fullname = $_POST['fullname'];
          $email = $_POST['email'];
          $phonenum = $_POST['phonenum'];
          $message = $_POST['message'];
          $formcontent="From: $fullname \n\n Senders Email: $email
                        \n Phone Number: $phonenum \n\n Message:\n\n $message";
          $recipient = "cillianp91@gmail.com";
          $subject = "Message From  Website - $fullname";
          $mailheader = "From: $email \r\n";
          mail($recipient, $subject, $formcontent, $mailheader);
           header("Location:thank-you.html");
        }

?>
