<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $cell = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);
        $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $formErrors = array();

        if (strlen($user) <= 3) {

            $formErrors[] = 'Username must be larger than <strong>3</strong> characters';

        }

        if (strlen($msg) < 10) {

            $formErrors[] = "Message can't be less than <strong>10</strong> chractres";

        }

        $headers = "From: " . $mail . "\r\n";
        $myEmail = 'amralmasri2001@gmail.com';
        $subject = "Contact form";

        if (empty($formErrors)) {

            mail($myEmail, $subject, $msg, $headers);

        }

    }


?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <mata charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Elzero Contact Form</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' rel='stylesheet'/>
        <link rel="stylesheet" href="css/contact.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,300;1,500&display=swap">
    </head>
    <body>

        <!-- Start Form -->

        <div class="container">
            <h1 class="text-center">Contact Me</h1>
            <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <?php if (! empty($formErrors)) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        <?php
                            foreach($formErrors as $error) {
                                echo $error . "<br>";
                            }
                            ?>
                            </div>
                        <?php    } ?>
                <div class="form-group">
                    <input
                        class="username form-control" 
                        type="text" 
                        name="username" 
                        placeholder="Teyp Your Username"
                        value="<?php if (isset($user)) { echo $user; } ?>">
                    <i class="fa fa-user fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custom-alert">
                        Username must be larger than <strong>3</strong> characters
                    </div>
                </div>
                <div class="form-group">
                    <input 
                        class="email form-control" 
                        type="email" 
                        name="email" 
                        placeholder="Please Teyp a Valid Email"
                        value="<?php if (isset($mail)) { echo $mail; } ?>">
                    <i class="fa fa-envelope fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custom-alert">
                        Email can't be <strong>empty</strong>
                    </div>
                </div>
                <input 
                    class="form-control" 
                    type="text" 
                    name="cellphone" 
                    placeholder="Teyp Your cell phone"
                    value="<?php if (isset($cell)) { echo $cell; } ?>">
                <i class="fa fa-phone fa-fw"></i>
                <textarea 
                    class="message form-control" 
                    name="message" 
                    placeholder="Your Message!"><?php if (isset($msg)) { echo $msg; } ?></textarea>
                    <div class="alert alert-danger custom-alert">
                        Message can't be less than <strong>10</strong> chractres
                    </div>
                <input class="btn btn-success" type="submit" value="Send Message">
                <i class="fa fa-paper-plane fa-fw send-icon"></i>  
            </form>
        </div>

        <!-- End Form -->


        <script src="js/jquery-3.5.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>