<?php
/*
Plugin Name: Attendance Plugin
Description: Plugin for displaying event wise guests
Author: Vivek Amola
Author URI: vivek.amola@coloredcow.in
Version: 0.1
*/

add_action('admin_menu', 'my_menu_pages');
function my_menu_pages(){
    add_menu_page('Event and Guest Management', 'Event and Guest Management', 'manage_options', 'attendance', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Add a Event', 'manage_options', 'attendance' );
    
    add_submenu_page('attendance', 'Event and Guest Management', 'Event List', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Add a guest', 'manage_options', 'attendance' );
    
    add_submenu_page('attendance', 'Event and Guest Management', 'Guest List', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Send Invites', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Attendance', 'manage_options', 'attendance' );
    // add_submenu_page('attendance', 'Send', 'Send', 'manage_options', 'send', 'send' );
}



function send(){
include('send-page.php');
}


function attendance(){
include('attendance-page.php');
}

function plugin_scripts() {
    wp_enqueue_script('cc-bootstrap', get_template_directory_uri().'/dist/lib/js/bootstrap.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('cc-bootstrap_min', get_template_directory_uri().'/dist/lib/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery', 'cc-bootstrap'), '1.0.0', true);
    wp_enqueue_script('cc-google-jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_localize_script( 'main', 'PARAMS', array('ajaxurl' => admin_url('admin-ajax.php')) );
    wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery', 'cc-bootstrap'), '1.0.0', true);
}

add_action('admin_enqueue_scripts','plugin_scripts');

function plugin_styles() {  
    wp_enqueue_style('cc-bootstrap_min', get_template_directory_uri().'/dist/lib/css/bootstrap.min.css');
    wp_enqueue_style('cc-bootstrap', get_template_directory_uri().'/dist/lib/css/bootstrap.css');
    wp_enqueue_style('cc-bootstrap_gird', get_template_directory_uri().'/dist/lib/css/bootstrap-grid.css');
    wp_enqueue_style('cc-bootstrap_gird_min', get_template_directory_uri().'/dist/lib/css/bootstrap-grid.min.css');
    wp_enqueue_style('cc-bootstrap_reboot', get_template_directory_uri().'/dist/lib/css/bootstrap-reboot.css');
    wp_enqueue_style('cc-bootstrap_reboot_min', get_template_directory_uri().'/dist/lib/css/bootstrap-reboot.min.css');
    wp_enqueue_style('style', plugins_url("Attandance/css/style.css"));             
    wp_enqueue_style('cc-custom-font','https://fonts.googleapis.com/css?family=Marcellus+SC|Kanit:200');
    wp_enqueue_style('cc-custom-fonts','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}    
       
add_action('admin_enqueue_scripts','plugin_styles');


function add_guest_request(){
    if(isset($_POST['request_name'])){
        $event_id=$_POST['event_id'];
        $request_name=$_POST['request_name'];
        $request_email=$_POST['request_emailid'];
        $request_phone=$_POST['request_number'];
        $request_gender=$_POST['request_gender'];
        

        $this_post = array(
          'post_title'    => $request_name,
          'post_status'   => 'publish',
          'post_type'     => 'guests',
          'post_category' => array(1),


         );
        $post_id = wp_insert_post( $this_post );
        if( !$post_id ){
            wp_send_json_error();
        }
        add_post_meta($post_id, 'Name', $request_name);
        add_post_meta($post_id, 'email_id', $request_email);
        add_post_meta($post_id, 'mobile_number', $request_phone);
        add_post_meta($post_id, 'gender', $request_gender);
        add_post_meta($post_id, 'status', 'Requested');
        add_post_meta($post_id, 'event_id', $event_id);

        
    }
}

add_action('wp_ajax_add_guest_request','add_guest_request');
add_action('wp_ajax_nopriv_add_guest_request','add_guest_request');

function show_requested_guest(){
    if(isset($_POST['event_id'])){
       $event_id=$_POST['event_id'];
        $args = array(
            'post_type' => 'guests',
            'post_status' => 'publish',
            'posts_per_page' => '30',
            'category_name' => 'waiting',
            'meta_value' => $event_id
            );
        $output='';
        $output .='<table class="table table-striped">
            <thead>	    
            	<tr>
	                <th>Name</th>
	                <th>Emailid</th>
	                <th>Gender</th>
	                <th>Status</th>
	                <th>Action</th>
            	</tr>
            </thead>
         ';

        $guests_loop = new WP_Query( $args );
          	if ( $guests_loop->have_posts() ) :
	            while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
	                $id = get_the_ID();
	                $title = get_the_title();
	                $email_id = get_field('email_id');
	                $mb = get_field('mobile_number');
	                $status = get_field('status');
	                $gender = get_field('gender');
                    $output .='
			            <tr><td>'.$title.'</td>
			                 <td>'.$email_id.'</td>
			                 <td>'.$gender.'</td>
			                 <td><div class="'.$status.'">'.$status.'</div></td>
			                 <td><button type="button"  id='.$id.' value='.$event_id.' class="btn btn-success btn-sm accept">Approve</button>
			                 <button type="button"  id='.$id.' value='.$event_id.' class="btn btn-danger btn-sm reject">Reject</button></td>
			            </tr>
			            ';
            	endwhile;
            	wp_reset_postdata();
            endif;
            
            $output .='</table>';
            echo $output;
            die();
    
        }

    }

add_action('wp_ajax_show_requested_guest','show_requested_guest');
add_action('wp_ajax_nopriv_show_requested_guest','show_requested_guest');


function update_guest(){
  	if(isset($_POST['event_id'])&&isset($_POST['guest_id'])){
       $event_id=$_POST['event_id'];
       $guest_id=$_POST['guest_id'];
    	
        $this_post = array(
      	'ID' => $guest_id,
      	'post_type' => 'guests',
      	'post_status' => 'publish',
      	'post_category' => array(6),
      	'status' => 'Confirmed'  
  		);


        wp_update_post( $this_post );
        update_post_meta($guest_id, 'status', 'Confirmed');

             $eargs = array(
            'post_type' => 'events',
            'posts_per_page' => '800',
            'page_id' => $event_id
            );

$args = array(
            'post_type' => 'guests',
            'posts_per_page' => '800',
            'page_id' => $guest_id
            );
             


    $events_loop = new WP_Query( $eargs );
        if ( $events_loop->have_posts() ) :
            while ( $events_loop->have_posts() ) : $events_loop->the_post();
                $eid = get_the_ID();
                $etitle = get_the_title();
                $theme_name = get_field('theme_name'); 
                $date = get_field('date');
                $venue = get_field('venue');


            endwhile;
            wp_reset_postdata();
            endif;


    $guests_loop = new WP_Query( $args );
        if ( $guests_loop->have_posts() ) :
            while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $email_id = get_field('email_id');
                $mb = get_field('mobile_number');
                $status = get_field('status');
                $gender = get_field('gender');
            



            endwhile;
            wp_reset_postdata();
            endif;
            

   require_once 'C:/xampp/htdocs/wordpress/public/wp-content/themes/ColoredCow/mandrill-api-php/src/Mandrill.php'; //Not required with Composer


try {

    $mandrill = new Mandrill('MHV4oKQ8pB1J8crX3YGU9w');
    $message = array(
        'html' => 'Hello '.$title.', We have acceptes your request for the event. See you Soon! <br><br> <i>Event Details<i>
                '.$etitle.'
                '.$theme_name.'  
                '.$date.'
                '.$venue.'
        ',

        'text' => 'You are kindly invited to the party!',
        
        'subject' => 'RSVP',
        
        'from_email' => 'vivek.amola@coloredcow.com',
        
        'from_name' => 'Vivek Amola',
        
        'to' => array(
            array(
                'email' => ''.$email_id.'',
                'name' => ''.$title.'',
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


		
	}

}

add_action('wp_ajax_update_guest','update_guest');
add_action('wp_ajax_nopriv_update_guest','update_guest');


function show_approved_guest(){
    $args = array(
            'post_type' => 'guests',
            'post_status' => 'publish',
            'posts_per_page' => '30',
            'category_name' => 'approved'
            );
    $output='';
    $output .='<table class="table table-striped">
    	<thead>	   
           <tr>
             <th>Name</th>
             <th>Emailid</th>
             <th>Gender</th>
             <th>Status</th>
        </tr>
        </thead>
       ';

    $guests_loop = new WP_Query( $args );
      	if ( $guests_loop->have_posts() ) :
        	while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $email_id = get_field('email_id');
                $mb = get_field('mobile_number');
                $status = get_field('status');
                $gender = get_field('gender');
            
         $output .='
            <tr><td>'.$title.'</td>
                 <td>'.$email_id.'</td>
                 <td>'.$gender.'</td>
                 <td><div class="'.$status.'">'.$status.'</div></td>
            </tr>
            ';
           
            endwhile;
            wp_reset_postdata();
            endif;
            
            $output .='</table>';
            echo $output;
            die();
    
        }

add_action('wp_ajax_show_approved_guest','show_approved_guest');
add_action('wp_ajax_nopriv_show_approved_guest','show_approved_guest');


//***** Description: show approve guest list to send invite*****

function show_guest_list(){
    if(isset($_POST['event_id'])){
       $event_id=$_POST['event_id'];
        $args = array(
            'post_type' => 'guests',
            'post_status' => 'publish',
            'posts_per_page' => '50',
            'category_name' => 'approved'
            );
        $output='';
        $output .='<table class="table table-striped">
            <thead>	    
            	<tr>
	                <th>Name</th>
	                <th>Emailid</th>
	                <th>Gender</th>
	                <th>Action</th>
            	</tr>
            </thead>
         ';

        $guests_loop = new WP_Query( $args );
          	if ( $guests_loop->have_posts() ) :
	            while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
	                $id = get_the_ID();
	                $title = get_the_title();
	                $email_id = get_field('email_id');
	                $mb = get_field('mobile_number');
	                $gender = get_field('gender');
                    $output .='
			            <tr><td>'.$title.'</td>
			                 <td>'.$email_id.'</td>
			                 <td>'.$gender.'</td>
			                 <td><button type="button"  id='.$id.' value='.$event_id.' class="btn btn-success btn-sm send">Send Invite</button>
			                 </td>
			            </tr>
			            ';
            	endwhile;
            	wp_reset_postdata();
            endif;
            
            $output .='</table>';
            echo $output;
            die();
    
        }

    }

add_action('wp_ajax_show_guest_list','show_guest_list');
add_action('wp_ajax_nopriv_show_guest_list','show_guest_list');


//***** Description: add guest to a particular event this send message to selected guest*****


function send_message(){
    if(isset($_POST['event_id'])&&isset($_POST['guest_id'])){
       $event_id=$_POST['event_id'];
       $guest_id=$_POST['guest_id'];
       

$args = array(
            'post_type' => 'guests',
            'posts_per_page' => '800',
            'category_name' => 'approved',
            'page_id' => $guest_id
            );
    
$eargs = array(
            'post_type' => 'events',
            'posts_per_page' => '800',
            'page_id' => $event_id
            );

             


    $events_loop = new WP_Query( $eargs );
      	if ( $events_loop->have_posts() ) :
        	while ( $events_loop->have_posts() ) : $events_loop->the_post();
                $eid = get_the_ID();
                $etitle = get_the_title();
                $theme_name = get_field('theme_name'); 
			    $date = get_field('date');
			    $venue = get_field('venue');


            endwhile;
            wp_reset_postdata();
            endif;


    $guests_loop = new WP_Query( $args );
      	if ( $guests_loop->have_posts() ) :
        	while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $email_id = get_field('email_id');
                $mb = get_field('mobile_number');
                $status = get_field('status');
                $gender = get_field('gender');
            



            endwhile;
            wp_reset_postdata();
            endif;


 ;
  

$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
 
function my_encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-ECB'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'AES-128-ECB', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}
 
function my_decrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'AES-128-ECB', $encryption_key, 0, $iv);
}



				$encrypted_title=my_encrypt($title, $key);
				$encrypted_guest_id=my_encrypt($id, $key);
				$encrypted_event_id=my_encrypt($eid, $key);
				
				
				




require_once 'C:/xampp/htdocs/wordpress/public/wp-content/themes/ColoredCow/mandrill-api-php/src/Mandrill.php'; //Not required with Composer




try {
    $mandrill = new Mandrill('MHV4oKQ8pB1J8crX3YGU9w');
    $message = array(
        'html' => '
        <div class="b" style="background-image: url(https://s-media-cache-ak0.pinimg.com/736x/fb/d6/31/fbd6310bcaa69c9d3e3fefbb3f94a720--navy-blue-sort.jpg);">
<div class="a" style="padding:10px; color: white;">
<h1><p style="color: white;">Hello, '.$title.'</p></h1><h2><p style="color: white;">Now and then we spend our entire time to make our life but how much do we spend to enjoy it. So me and my ColoredCow team are taking out some time to enjoy it, to discover it and to share it and you are kindly invited to be the part of this journey where we will be sharing our time, happiness and some meaningful conversation with each other. We hope you will arrive and made the occasion more memorable one.</p></h2>
<center>
<h2><p style="color: white;"><i>Please join us for:</i></p></h2>
<h2><p style="color: white;">'.$etitle.'</p>
<p>'.$date.'</p>
<p>'.$venue.'</p></h2>

<p style="color: white;">We all will be happy to have you among us. Kindly let us know if you`ll be able to make it.</p><a href="http://ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public/wp-content/themes/ColoredCow/confirmation.php?id='.$encrypted_title.'&token='.$encrypted_guest_id.'&code='.$encrypted_event_id.'">

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
    <a href="ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public/">
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
    </a></center>
</div>
</div>
',

        'text' => 'You are kindly invited to the party!',
        
        'subject' => 'RSVP',
        
        'from_email' => 'vivek.amola@coloredcow.com',
        
        'from_name' => 'Vivek Amola',
        
        'to' => array(
            array(
                'email' => ''.$email_id.'',
                'name' => ''.$title.'',
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


  global $wpdb;

  $table_name = $wpdb->prefix . 'event_guest';
  $wpdb->insert( $table_name, array(
    'event_id' => $event_id,
    'guest_id' => $guest_id,
    'status' => 'Pending'
  ) );




            die();

   }

}


add_action('wp_ajax_send_message','send_message');
add_action('wp_ajax_nopriv_send_message','send_message');


