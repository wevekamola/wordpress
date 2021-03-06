<?php
/**
 * Template Name: Events
   Author:Vivek Amola
 */
 get_header();
 get_template_part('template/modal','template');
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
    ?>
	        <div class="col-lg-6 col-md-4 col-sm-4 col-4">
	            <div class="container">
	               <p class="about-event-page">
	                    Occasion: <?php echo $title = get_the_title(); ?><br>
			            Theme:    <?php echo $theme_name = get_field('theme_name');?><br> 
			            Date:     <?php echo  $date = get_field('date');?> <br>
			            Venue:    <?php echo $venue = get_field('venue'); ?><br>
		            </p>
	  	        <hr>
				  	<p class="sub-heading">Wanna join the party?
				  	</p>
			  	    <button type="button" class="btn btn-outline-warning btn-block custom-font button-request" data-toggle="modal" data-target="#requestModal" data-whatever="@mdo" data-id="<?php echo $id ?>">Request Invite
					</button>		
		        </div>
	        </div>
	        <?php
                endwhile;
                wp_reset_postdata();
                endif;
            ?>
	    </div>
    </div>
</body>
<?php 
    get_footer(); 
?>
	