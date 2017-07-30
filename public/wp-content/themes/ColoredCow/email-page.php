<?php
/**
 * Template Name: Emails
   Author:Vivek Amola
 */
?>

<?php
require_once 'mandrill-api-php/src/Mandrill.php'; //Not required with Composer



try {
    $mandrill = new Mandrill('MHV4oKQ8pB1J8crX3YGU9w');
    $message = array(
        'html' => '
<div class="" style="background-image: url(
https://cdn.shopify.com/s/files/1/0405/8713/products/lapislazuli_a4_4cd75a4a-76f3-4cbf-9bbe-7b1116716dcf_grande.jpg?v=1406361928);">
<br>
<br>
<div class="" style="margin:20px 20px 20px 20px; color:white;">
<h1><p style="">Hello, Vivek Kumar Gupta</p><h1><h2><p>Now and then we spend our entire time to make our life but how much do we spend to enjoy it. So me and my ColoredCow team are taking out some time to enjoy it, to discover it and to share it and you are kindly invited to be the part of this journey where we will be sharing our time, happiness and some meaningful conversation with each other. We hope you will arrive and made the occasion more memorable one.</p></h2>
<center>
<h2><p style=""><i>Please join us for:</i></p></h2>
<h2><p style="">Professor`s Club Meet</p>
<p>11/08/17</p>
<p>THDC-IHET Tehri</p></h2>

<p>We all will be happy to have you among us. Kindly let us know if you`ll be able to make it.</p><a href="http://ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public/">
<button style="background-color:#00BFFF; 
    border: none;
    color: white;
    padding: 11px 28px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    border-radius:21px;
    cursor: pointer;">Confirm Your Rsvp</button></a>
<a href="">
    <button style="background-color:#4CAF50; 
    border: none;
    color: white;
    padding: 11px 28px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    border-radius:21px;
    cursor: pointer;">Any doubt?</button></a>
    </a>

    </center>
<br>
<br>
</div>
</div>

',

        'text' => 'You are kindly invited to the party!',
        
        'subject' => 'RSVP Invitation',
        
        'from_email' => 'vivek.amola@coloredcow.com',
        
        'from_name' => 'Vivek Amola',
        
        'to' => array(
            array(
                'email' => 'vivekhrd330@gmail.com',
                'name' => 'Vivek Kumar Gupta',
                'type' => 'to'
            )
        ),


        'headers' => array('Reply-To' => 'message.reply@example.com'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => 'message.bcc_address@example.com',
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'merge1',
                'content' => 'merge1 content'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => 'recipient.email@example.com',
                'vars' => array(
                    array(
                        'name' => 'merge2',
                        'content' => 'merge2 content'
                    )
                )
            )
        )
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = 'example send_at';
    $result = $mandrill->messages->send($message, $async, $ip_pool);
    print_r($result);
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
?>