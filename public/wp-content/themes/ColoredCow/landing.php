<?php

/**
 * Template Name: Landing
 */
    get_header();
?>
<body>
	<div class="container">
		<div class="row">
		    <div class="col-lg-6 col-sm-12">
			 	<div class="heading">Soiree
			 	</div>
					<p class="about-content">ColoredCow celebrates every first Saturday of the month with family and friends. This custom has been started 		to take a little time off from work and enjoy some moments in life. we believe in sharing moments and learning with each other. Come 	and join us over music, food, drinks and some moments full of laughter and joy.
			  	 	</p>
			  	 	<hr>
			  		<center>
			  		<div class="col-md-12 col-xs-12">
				  	    <div class="heading-request">Wanna join the party?
				  	    </div>
			  	  		<div class="col-md-6 col-xs-12">
			  	    		<button type="button" class="btn btn-outline-warning btn-block custom-font" data-toggle="modal" data-target="#requestModal" data-whatever="@mdo">Request Invite
			  	    		</button>		
				  		</div>	
			    	</div>
					</center>
		    </div>	
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
</body>

<?php 
    get_footer(); 
?>