<?php
/**
 * Template Name: Events
 */
 get_header();
?>
<body class="body">
	<div class="container">
		<div class="row">

			<?php
			  	$args = array(
			    'post_type' => 'events',
			    'post_status' => 'publish',
			    'posts_per_page' => '10'
				);
			  	$products_loop = new WP_Query( $args );
			  	if ( $products_loop->have_posts() ) :
			    	while ( $products_loop->have_posts() ) : $products_loop->the_post();
				    // Set variables
				    $title = get_the_title();
				    $description = get_the_content();
				    $theme_name = get_field('theme_name');
				    $date = get_field('date');
				    $venue = get_field('venue');
				    // Output
				    ?>

			  <div class="col-lg-6 col-md-4 col-sm-4 col-4">
			  <div class="container e">
<br>
				  	<br>
				
<p class="about-event">
	

            Occasion: <?php echo $title; ?><br>
            Theme: <?php echo $theme_name;?><br> 
            Date: <?php echo $date; ?> <br>
            Venue: <?php echo $venue; ?><br>
              
            </p>
				  	  	<hr>
					  	    <p class="sub-heading">Wanna join the party?
					  	    </p>
			  	    		<button type="button" class="btn btn-outline-warning btn-block custom-font" data-toggle="modal" data-target="#requestModal" data-whatever="@mdo">Request Invite
			  	    		</button>	
			    	</div>
			    	</div>
			      	
     
      <?php
      endwhile;
    wp_reset_postdata();
  endif;?>


		</div>
		<div class="container">
            <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
              	<div class="modal-dialog" role="document">
                	<div class="modal-content">
                      	<div class="modal-header">
                        	<div class="modal-title" id="requestModalLabel">New Invite Request</div>
                        	<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>
                      	</div>
                      	<div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">
                                    Enter Your Name:
                                </label>
                                    <input type="text" class="form-control" name="request_name"  id="request_name" maxlength="30" required="required">
                             </div>
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">
                                    Enter Your Email:
                                </label>
                                    <input type="email" class="form-control" name="request_emailid" id="request_emailid" maxlength="30" required="required">
                            </div>
                            <div class="form-group">
                                <label for="recipient-number" class="form-control-label">
                                    Enter Mobile Number:
                                </label>
                                    <input type="tel" class="form-control" name="request_number" id="request_number"  required="required">
                            </div>  
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">
                                    Select Your Gender : 
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="request_gender" value="Male" type="radio" class="custom-control-input" required="required">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Male</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="request_gender" value="Female" type="radio" class="custom-control-input" required="required">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Female</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="request_gender" value="Others" type="radio" class="custom-control-input" required="required">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Others</span>
                                </label>
                            </div>
                      	</div>
                       	<div class="modal-footer">
                        	<button type="button" class="btn btn-primary btn-block custom-font" name="action " id="action">Send Your Request</button>
                       	</div>  
              		</div>
            	</div>
            </div>
        </div>
	</div>