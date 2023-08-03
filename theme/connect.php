<?php
$username = filter_input(INPUT_POST, 'user_name');
$useremail = filter_input(INPUT_POST, 'user_email');
$usermessage = filter_input(INPUT_POST, 'user_message');
if (!empty($username)) {
    if (!empty($useremail)) {

        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "royal_fitness_db";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()) {
            die('Connect error: (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO recieved_msg ( username, useremail, usermessage) value ('$username', '$useremail', '$usermessage') ";
            if ($conn->query($sql)) {
                // mail
                echo "Hey $username, Thank you for communicating!";
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // $name = $_POST["name"];
                    // $email = $_POST["email"];
                    // $message = $_POST["message"];

                    // Set up the email headers
                    $to = "en20123128@git-india.edu.in";
                    $subject = "Contact Form Submission from $username";
                    $headers = "From: $useremail" . "\r\n" .
                        "Reply-To: $useremail" . "\r\n" .
                        "X-Mailer: PHP/" . phpversion();

                    // Send the email
                    $sent = mail($to, $subject, $usermessage, $headers);

                    if ($sent) {
                        echo "Thank you for contacting us. Your message has been sent successfully!";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        echo ("Email cannot be empty!!");
        die();
    }
} else {
    echo ("Name cannot be empty!!");
    die();
}


?>