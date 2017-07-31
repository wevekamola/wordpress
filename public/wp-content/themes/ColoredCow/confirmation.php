<?php
/**
 * Template Name: Confirmation
   Author:Vivek Amola
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <title>testrsvp</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
            <!-- Bootstrap CSS -->
            <link href="https://fonts.googleapis.com/css?family=La+Belle+Aurore" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="style.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

         <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </head>
  <body>
  <nav class=" navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">				
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		  <a class="navbar-brand" href="#"><img src="dist/images/logo.png" width="180" height="45" alt="" />
          </a>
		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a role="button" class="btn btn-outline-secondary" href="ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public">
						Home
					</a>
					<a role="button" class="btn btn-outline-secondary" href="ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public/events/">
						All Events
					</a>
                    <a role="button" class="btn btn-outline-secondary" href="ec2-13-59-131-255.us-east-2.compute.amazonaws.com/phase2/public/wp/wp-admin/">
						Admin
					</a>
				</li>
			</ul>
		</div>
	</nav>
</head>

<body>
<?php
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
 
   $id_en = $_GET['id'];
   $token_en = $_GET['token'];
   $code_en = $_GET['code'];

   $id_de = my_decrypt($id_en, $key);
   $token_de = my_decrypt($token_en, $key);
   $code_de = my_decrypt($code_en, $key);
    
    ?>	
 <div class="container"
   <div class="row" style="height:450px;width: 450px;background-color: pink;color: black;border-radius: 15px;font-size: 30px; background-image: url(https://image.freepik.com/free-vector/soft-background-with-a-cute-blue-watercolor-stain_1048-5169.jpg); background-size: 450px 450px;padding: 80px;font-family: 'La Belle Aurore', cursive;margin-top:110px;">
			Thank You! <?php echo $id_de; ?>, For accepting the invite.<br><br>
			Looking forward to see you at the event.
   </div>
 </div>

<br>
    	<div class="footer">
		    <p>Copyright &copy; ColoredCow 2017</p>
		</div>
	</body>
	
</html>