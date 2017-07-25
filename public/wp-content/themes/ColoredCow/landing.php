<?php
/**
 * Template Name: Landing
 */
	get_header();
	get_template_part('template/modal','template');
?>
<?php
	$args = array(
  	'post_type' => 'events',
    'post_status' => 'publish',
    'posts_per_page' => '1'
    );
    
    $events_loop = new WP_Query( $args );
    if ( $events_loop->have_posts() ) :
        while ( $events_loop->have_posts() ) : $events_loop->the_post();
            $title = get_the_title();
            $description = get_the_content();
            $theme_name = get_field('theme_name');
            $date = get_field('date');
            $venue = get_field('venue');
            $id = get_the_ID();
?>

<body class="body">
	<div class="container">
		<div class="row">
		    <div class="col-lg-6 col-sm-12">
			 	<p class="heading">Soiree</p>
				<p class="about-content">ColoredCow celebrates every first Saturday of the month with family and friends. This custom has been started 	to take a little time off from work and enjoy some moments in life. we believe in sharing moments and learning with each other. Come 	and join us over music, food, drinks and some moments full of laughter and joy.
		  	 	</p>
		  	 	<hr>
		  		<div class="col-md-12 col-xs-12">
			  	    <p class="sub-heading">Wanna join the party?
			  	    </p>
		  	  		<div class="col-md-6 col-xs-12 middle">

                <button type="button" class="btn btn-outline-warning btn-block custom-font button-request" data-toggle="modal" data-target="#requestModal" data-whatever="@mdo" data-id="<?php echo $id ?>">Request Invite
		  	    		</button>		
			  		</div>	
		    	</div>
			    </div>
          	<div class="col-lg-6 col-sm-12">
			 	<p class="heading-comingevent">Coming Up</p>
					<p class="about-event">
			            Occasion: <?php echo $title; ?><br>
			            Theme: <?php echo $theme_name;?><br> 
			            Date: <?php echo $date; ?> <br>
			            Venue: <?php echo $venue; ?><br>
			            ID:<?php echo $id; ?><br>   
		            </p>
<?php
      	endwhile;
    	wp_reset_postdata();
  	endif;
?>

        	</div>
		</div>
	</div>		
	<hr>
	<p class="event"><i class="fa fa-camera-retro fa-1x"></i>&nbsp;Event&nbsp;Gallery</p>				
	<div class="container middle">
 		<div class="col-lg-8 col-sm-8 middle">
			<div id="eventimagecarousel" class="carousel slide" data-ride="carousel">
  				<ol class="carousel-indicators">
    				<li data-target="#eventimagecarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#eventimagecarousel" data-slide-to="1"></li>
				    <li data-target="#eventimagecarousel" data-slide-to="2"></li>
				</ol>
  				<div class="carousel-inner" role="listbox">
				    <div class="carousel-item active">
				      <img class="d-block img-fluid images_carousel" src="<?php echo get_template_directory_uri(); ?>/dist/images/1.jpg" alt="First slide">
				    </div>
				    <div class="carousel-item">
				    	<img class="d-block img-fluid images_carousel" src="<?php echo get_template_directory_uri(); ?>/dist/images/2.jpg" alt="Second slide">
				    </div>
				    <div class="carousel-item">
				    	<img class="d-block img-fluid images_carousel" src="<?php echo get_template_directory_uri(); ?>/dist/images/3.jpg" alt="Third slide">
				    </div>
  				</div>
				<a class="carousel-control-prev" href="#eventimagecarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				</a>
			  	<a class="carousel-control-next" href="#eventimagecarousel" role="button" data-slide="next">
			    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Next</span>
			  	</a>
			</div>
		</div>
	</div>
</body>
<?php 
    get_footer(); 
?>
