<?php 

if ( ! function_exists( 'cc_scripts' ) ) {
    function cc_scripts() {

        
        wp_enqueue_script('cc-bootstrap', get_template_directory_uri().'/dist/lib/js/bootstrap.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('cc-bootstrap_min', get_template_directory_uri().'/dist/lib/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery', 'cc-bootstrap'), '1.0.0', true);
        wp_enqueue_script('cc-google-jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
        wp_localize_script( 'main', 'PARAMS', array('ajaxurl' => admin_url('admin-ajax.php')) );
        wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery', 'cc-bootstrap'), '1.0.0', true);


    }
    add_action('wp_enqueue_scripts','cc_scripts');
}

if ( ! function_exists( 'cc_styles' ) ) {
    function cc_styles() {  
             
             wp_enqueue_style('cc-bootstrap_min', get_template_directory_uri().'/dist/lib/css/bootstrap.min.css');
             wp_enqueue_style('cc-bootstrap', get_template_directory_uri().'/dist/lib/css/bootstrap.css');
             wp_enqueue_style('cc-bootstrap_gird', get_template_directory_uri().'/dist/lib/css/bootstrap-grid.css');
             wp_enqueue_style('cc-bootstrap_gird_min', get_template_directory_uri().'/dist/lib/css/bootstrap-grid.min.css');
             wp_enqueue_style('cc-bootstrap_reboot', get_template_directory_uri().'/dist/lib/css/bootstrap-reboot.css');
             wp_enqueue_style('cc-bootstrap_reboot_min', get_template_directory_uri().'/dist/lib/css/bootstrap-reboot.min.css');
             wp_enqueue_style('style', get_template_directory_uri().'/style.css');
             wp_enqueue_style('cc-custom-font','https://fonts.googleapis.com/css?family=Marcellus+SC|Kanit:200');

             wp_enqueue_style('cc-custom-fonts','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
             
      
    }
    add_action('wp_enqueue_scripts','cc_styles');
}

//add filter to remove margin above html
add_filter('show_admin_bar','__return_false');

