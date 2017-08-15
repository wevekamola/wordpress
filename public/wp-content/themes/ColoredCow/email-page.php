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
<br>
<div class="" style="margin:20px 20px 20px 20px; color:white;">
<h1><p style="">Hello, </p><h1><h2><p>Now and then we spend our entire time to make our life but how much do we spend to enjoy it. So me and my ColoredCow team are taking out some time to enjoy it, to discover it and to share it and you are kindly invited to be the part of this journey where we will be sharing our time, happiness and some meaningful conversation with each other. We hope you will arrive and made the occasion more memorable one.</p></h2>
<center>
<h2><p style=""><i>Please join us for:</i></p></h2>
<h2><p style="">Professor`s Club Meet</p>
<p>11/08/17</p>
<p>THDC-IHET Tehri</p></h2>


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
                'email' => 'shubhamnautiyal6894@gmail.com',
                'name' => 'shubham',
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