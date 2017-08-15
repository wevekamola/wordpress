<?php
/**
 * Template Name: Attandance
 */

?>
<body class="plugin">



<div class="btn-group">
  <button type="button" class="btn btn-danger">Action</button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>

	<select id="select-event">	
	<option>Select Your Event </option>
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
	            		$title = get_the_title();
	            		$id = get_the_ID();
	        ?> 
		<option value="<?php echo $id;?>"><?php echo $id;?> <?php echo $title;?></option>
		<?php
	      		endwhile;
	    wp_reset_postdata();
	  		endif;
	  	?>
	</select>
	 <br>
 <br>

	 <br>
 <br>
	<caption>Approved Guests For Events</caption>
  	
	<table class="table table-bordered">
  		<tr>
	    	<th>Name</th>
	    	<th>Emailid</th>
	    	<th>Gender</th>
	    	<th>Status</th>
	    	<th>Category</th>
  		</tr>
			<?php
			  	$args = array(
			    'post_type' => 'guests',
			    'post_status' => 'publish',
			    'posts_per_page' => '30',
			    'category_name' => 'approved'
			    
				);
			  	$guests_loop = new WP_Query( $args );
			  	if ( $guests_loop->have_posts() ) :
			    	while ( $guests_loop->have_posts() ) : $guests_loop->the_post();
					    $title = get_the_title();
					    $email_id = get_field('email_id');
					    $mb = get_field('mobile_number');
					    $status = get_field('status');
					    $gender = get_field('gender');
		   	?>
  		<tr>
		    <td><?php echo $title;?></td>
		    <td><?php echo $email_id;?></td>
		    <td><?php echo $gender;?></td>
		    <td><?php echo $status;?></td>
		    <td><?php the_category(', '); ?></td>
	  	</tr>
  
  			<?php
      				endwhile;
    				wp_reset_postdata();
  				endif;
  			?>
  			
</table>
<br>
<br>
<caption>Waiting Guests For Events</caption>
         <table style="width: 98%">
            <tr>
                 <th width="18%">Name</th>
                 <th width="18%">Emailid</th>
                 <th width="18%">Gender</th>
                 <th width="18%">Status</th>
                 <th width="8%">Category</th> 
                 <th width="18%">Action</th>
            </tr>
</table>
<form method="POST" action="update.php">
  	<div id="request_guest"></div>	
</form>
</body>