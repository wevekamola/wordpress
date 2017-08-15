<?php
/**
 * Template Name: Attandance
   Author:Vivek Amola
 */

?>
<body id="plugin-body"><br>
	Select Event
	<select id="select-event">	
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
		<option value="<?php echo $id ;?>"><?php echo $title = get_the_title();?></option>
			<?php
		      		endwhile;
		    wp_reset_postdata();
		  		endif;
		  	?>
	</select>
	<hr>
	<div class="heading-box">Approved Guests For the Event</div>
	<div id="approve_guest">
  		<table class="table table-striped">
  			<thead>	
  				<tr>
			    	<th>Name</th>
			    	<th>Emailid</th>
			    	<th>Gender</th>
			    	<th>Status</th>
  				</tr>
  			</thead>
		</table>
	</div>
	<hr>
	<div class="nw heading-box">Waiting Guests For the Event</div>         
  	<div id="request_guest">
	  	<table class="table table-striped">
	        <thead>	   
	           	<tr>
		            <th>Name</th>
		            <th>Emailid</th>
		            <th>Gender</th>
		            <th>Status</th>
		            <th>Action</th>
	        	</tr>
	        </thead>
	   </table>
   		No requested Guest
	</div>	
</body>