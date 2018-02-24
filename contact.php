<?php
    define('TITLE', "Angelo's Pizza - Contact Us");
    include('includes/header.php');
?>

    <div id="contact">
        <hr>
        <h1>Get in touch with us!</h1>

        <?php
            function has_header_injection($str) {
                return preg_match("/[\r\n]/", $str);
            }

            if (isset ($_POST['contact_submit'])) {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $msg = $_POST['message'];

                if (has_header_injection($name) or has_header_injection($email)) {
                    die();
                }

                if (!$name or !$email or !$msg) {
                    echo '<h4 class="error">All fields required.</h4><a href="contact.php" class="button block">Go back and try again</a>';
                    exit;
                }

                $to = 'test@test.com';
                $subject = '$name sent you a message via your contact form';

                $message = 'Name: $name\r\n';
                $message .= 'Email: $email\r\n';
                $message .= 'Message:\r\n$msg';

                if (isset($_POST['subscribe']) and $_POST['subscribe'] == 'Subscribe') {
                    $message .= '\r\n\r\nPlease add $email to the mailing list.\r\n';
                }

                $message = wordwrap($message, 72);

                $headers = 'MIME-Version: 1.0\r\n';
                $headers .= 'Content-type: text/plain; charset=iso-8859-1\r\n';
                $headers .= 'From: $name <$email>\r\n';
                $headers .= 'X-Priority: 1\r\n';
                $headers .= 'X-MSMail-Priority: High\r\n\r\n';

                mail($to, $subject, $message, $headers);
        ?>

            <h5>Thanks for contacting Franklin's!</h5>
            <p>Please allow 24 hours for a response.</p>
            <p><a href="/final" class="button block">&laquo; Go to Home Page</a></p>

        <?php } else { ?>

            <form method="post" action="" id="contact-form">
                <label for="name">Your name</label>
                <input type="text" id="name" name="name" />

                <label for="email">Your email</label>
                <input type="email" id="email" name="email" />

                <label for="message">And your message</label>
                <textarea id="message" name="message"></textarea>

                <input type="checkbox" id="subscribe" name="subscribe" value="Subscribe" />
                <label for="subscribe">Subscribe to newsletter</label>

                <input type="submit" class="button next" name="contact_submit" value="Send Message" />
            </form>

        <?php } ?>
        <hr>
    </div>

<?php
    include('includes/footer.php');
?>
