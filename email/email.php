<?php 
require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

require_once 'vendor/autoload.php';

echo($_POST['cf-name']);
echo($_POST['cf-email']);
echo($_POST['cf-message']);
$body = `<table border=1>
            <tr><td>Name: </td><td>`.$_POST['cf-name'].`</td></tr>
            <tr><td>Email: </td><td>`.$_POST['cf-email'].`</td></tr>
            <tr><td>Message: </td><td>`.$_POST['cf-message'].`</td></tr>
          </table>`;
 
try {
    // Create the SMTP Transport
    $transport = (new Swift_SmtpTransport('smtpout.secureserver.net', 465, 'ssl'))
        ->setUsername('care@brightlinkhairfixing.com')
        ->setPassword('care@bright1');
 // composer require swiftmailer/swiftmailer                           ''cmd to install swiftmailer
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
 
    // Create a message
    $message = new Swift_Message();
 
    // Set a "subject"
    $message->setSubject('BrightLinkHairFixing.com: Please contact.');
 
    // Set the "From address"
    $message->setFrom(['care@brightlinkhairfixing.com' => 'BrightLinkHairFixing.com']);
 
    // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
    $message->addTo('care@brightlinkhairfixing.com','Deepak Singh');
 
    // Add "CC" address [Use setCc method for multiple recipients, argument should be array]
    $message->addCc('digvijay.sharma183@gmail.com', 'recipient name');
 
    // Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
    // $message->addBcc('recipient@gmail.com', 'recipient name');
 
    // Add an "Attachment" (Also, the dynamic data can be attached)
    // $attachment = Swift_Attachment::fromPath('example.xls');
    // $attachment->setFilename('report.xls');
    // $message->attach($attachment);
 
    // Add inline "Image"
    // $inline_attachment = Swift_Image::fromPath('nature.jpg');
    // $cid = $message->embed($inline_attachment);
 
    // Set the plain-text "Body"
    $message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");
 
    // Set a "Body"
    $body = "<table>";
    $body .= "<tr><td>Name: </td><td>".$_POST['cf-name']."<td></tr>";
    $body .= "<tr><td>Contact: </td><td>".$_POST['cf-email']."<td></tr>";
    $body .= "<tr><td>Summary: </td><td>".$_POST['cf-message']."<td></tr>";
    $body .= "</table>";
    echo $body;
    $message->addPart( $body, 'text/html');
 
    // Send the message
    $result = $mailer->send($message);
} catch (Exception $e) {
  echo $e->getMessage();
}

?>