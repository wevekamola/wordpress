<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <title><?php echo bloginfo('name'); ?></title>
    <?php wp_head(); ?>
		<nav class=" navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">				
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		  <a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.png" width="180" height="45" alt="" />
          </a>
		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a role="button" class="btn btn-outline-secondary" href="<?php echo get_permalink( get_page_by_title( 'Home page' ) );?>">
						Home
					</a>
					<a role="button" class="btn btn-outline-secondary" href="<?php echo get_permalink( get_page_by_title( 'Events' ) );?>">
						All Events
					</a>
                    <a role="button" class="btn btn-outline-secondary" href="<?php echo wp_login_url(); ?>">
						Admin
					</a>
					
				</li>
			</ul>
		</div>
	</nav>
</head>

