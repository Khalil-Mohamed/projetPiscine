<?php
include 'function.php';
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "khalilmohamed23@gmail.com";
    $mail->Password = 'negasonic';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("khalilmohamed23@gmail.com");
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;
    header('Content-Type: application/json');
    if ($name === ''){
    print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
    exit();
    }
    if ($email === ''){
    print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
    exit();
    } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
    exit();
    }
    }
    if ($subject === ''){
    print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
    exit();
    }
    if ($body === ''){
    print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
    exit();
    }
    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
        print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }
    $pdo = pdo_connect_mysql();
    $requete = " INSERT INTO clients (Nom,Email,Objet,Demande) VALUES ('$name','$email','$subject','$body')";
    $stmt = $pdo -> query($requete);
    /*mysqli_query($conn, " INSERT INTO clients (Nom,Email,Objet,Demande) VALUES ('" . $name. "', '" . $email. "','" . $subject. "','" . $body. "')");
    mysqli_query($con,"insert into contact_us(name,email,mobile,comment) values('$name','$email','$mobile','$comment')");*/
    $insert_id = mysqli_insert_id($conn);
    if(!empty($insert_id)) {
    $message = "Your contact information is saved successfully";
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}
