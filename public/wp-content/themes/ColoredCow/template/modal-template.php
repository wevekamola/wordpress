<!-- Description: Template for Request Modal Form
Author: Vivek Amola
Version: 0.1
 -->

<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="requestModalLabel">New Invite Request</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="guest_request_form">
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
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block custom-font" id="submit_request">Send Your Request
               </button>
           </div>  
       </div>
   </div>
</div>