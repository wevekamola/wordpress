<?php
/**
 * Template Name: Send
   Author:Vivek Amola
 */

?>
<body id="plugin-body"><br>

	In order to send invite you have select an event first<br>
	Select Event
	<select id="select-event-guest">	
		<option>--None--</option>
			<hr>
			<?php
	           	$args = array(
		          	'post_type' => 'events',
		          	'post_status' => 'publish',
		          	'posts_per_page' => '30'
	        	);

	          	$events_loop = new WP_Query( $args );
	          	if ( $events_loop->have_posts() ) :
	            	while ( $events_loop->have_posts() ) : $events_loop->the_post();
	            	$id = get_the_ID();	
	        ?> 
		<option value="<?php echo $id;?>"><?php echo $title = get_the_title();?></option>
			<?php
		      		endwhile;
		    wp_reset_postdata();
		  		endif;
		  	?>
	</select>
	<hr>
	<div class="heading-box">Approved Guests List</div>
	<div id="guest_list">
  		<table class="table table-striped">
  			<thead>	
  				<tr>
			    	<th>Name</th>
			    	<th>Emailid</th>
			    	<th>Gender</th>
			    	<th>Action</th>
  				</tr>
  			</thead>
		</table>
	</div>
	<hr>
   		
	</div>	
</body>
