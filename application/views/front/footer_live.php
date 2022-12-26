<style>
    .wpwl-container.wpwl-container-card {
        padding-top: 15px;
    }
    #div-login-msg{
        border: none !important;
    }
    .wpwl-apple-pay-button.wpwl-apple-pay-button-black{
        display: inline-block;
        -webkit-appearance: -apple-pay-button;
        -apple-pay-button-type: plain;
        -apple-pay-button-style: black;
        border-radius: 5pt;
    }
</style>
<footer >

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">

                <div class="follow-link">
                    <!-- <a class="text-light" data-toggle="modal" data-target="#subscription-modal"><img width="100" height="40" src="<?php echo base_url()?>images/hyperpay-logo.jpg" alt="Hyper Pay"></a> -->

                    <a class="text-light" href=""><img class="pay" src="<?php echo base_url()?>images/apple-pay(1).png" alt=""></a>
                    <a class="text-light" href=""><img class="apple-pay" src="<?php echo base_url()?>images/maestro.png" alt=""></a>
                    <a class="text-light" href=""><img class="paypal" src="<?php echo base_url()?>images/paypal.png" alt=""></a>
                    <a class="text-light" href=""><img class="visa" src="<?php echo base_url()?>images/visa.png" alt=""></i></a>
                    <a class="text-light" href=""><img class="master-card" src="<?php echo base_url()?>images/master-card(1).png" alt=""></a>
                    <a class="text-light" href=""><img class="mada" src="<?php echo base_url()?>images/mada.png" alt=""></i></a>

                </div>

            </div>

            <div class="col-md-6">

                <p class="footer-text"><?php echo $this->lang->line('all_rights_reserved'); ?> © 2022 Azoozy.com </p>

            </div>

        </div>

    </div>

</footer>

    </div>

    </div>
  <!-- END # BOOTSNIP INFO -->
  <?php $settings = $this->common_model->select_where("terms, price,arabic_terms, privacy_policy, arabic_privacy, aboutus, aboutus_arabic", "settings", array('id'=>1))->row(); ?>
  <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
            <div id="div-contact-msg">
                        <div id="icon-contact-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-contact-msg"></span>
                    </div>
                <form  method="post">
                    <div class="form-group">
                        <label for="name"><?php echo $this->lang->line('name'); ?></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $this->lang->line('enter_name'); ?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo $this->lang->line('email'); ?></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $this->lang->line('enter_email'); ?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo $this->lang->line('message'); ?></label>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div> 
                    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                <?php echo $this->lang->line('cancel'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ========Cancel Subscription modal========= -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php echo $this->lang->line('cancel_subscription_msg'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            <a href="<?php echo base_url()?>welcome/cancel_subscription" class="btn btn-primary"><?php echo $this->lang->line('cancel_subscription'); ?></a>
        </div>
        </div>
    </div>
</div>

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <!-- Begin # DIV Form -->
            <div class="container">
            <div id="div-forms">
                <!-- Begin # Login Form -->
                <form id="login-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg"><?php echo $this->lang->line('type_username_password'); ?> </span>
                        </div>
                        <input id="login_username" class="form-control" name="" <?php if($this->input->cookie('frontuser')!='') { ?> value="<?php echo $this->input->cookie('frontuser')?>" <?php } ?> type="text" placeholder="<?php echo $this->lang->line('email'); ?>" required>
                        <input id="login_password" class="form-control" name="" <?php if($this->input->cookie('frontpass')!='') { ?> value="<?php echo $this->input->cookie('frontpass')?>" <?php } ?> type="password" placeholder="<?php echo $this->lang->line('password'); ?>" required>
                        <div class="checkbox">
                            <label>
                            <input id="rememberme" type="checkbox" name="rememberme" <?php if($this->input->cookie('user_remember')!='') { ?> checked <?php } ?>> <?php echo $this->lang->line('remember_me'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('login'); ?></button>
                        </div>
                        <div>
                            <button id="login_lost_btn" type="button" class="btn btn-link"><?php echo $this->lang->line('forgot_password'); ?></button>
                            <button id="login_register_btn" type="button" class="btn btn-link"><?php echo $this->lang->line('register'); ?></button>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->
                <!-- Begin | Lost Password Form -->
                <form id="lost-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-lost-msg">
                            <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-lost-msg"><?php echo $this->lang->line('type_your_email'); ?></span>
                        </div>
                        <input id="lost_email" class="form-control" type="email" name="email" placeholder="<?php echo $this->lang->line('type_your_email'); ?>" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('submit'); ?></button>
                        </div>
                        <div>
                            <button id="lost_login_btn" type="button" class="btn btn-link"><?php echo $this->lang->line('login'); ?></button>
                            <button id="lost_register_btn" type="button" class="btn btn-link"><?php echo $this->lang->line('register'); ?></button>
                        </div>
                    </div>
                </form>
                <!-- End | Lost Password Form -->
                <!-- Begin | Register Form -->
                <form id="register-form" method="post" action="<?php echo base_url();?>welcome/add_user">
                    <div class="modal-body">
                        <div id="div-register-msg">
                            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-register-msg"><?php echo $this->lang->line('account_registration'); ?></span>
                        </div>
                        <input id="register_username" class="form-control" name="name" type="text" placeholder="<?php echo $this->lang->line('enter_name'); ?>" required>
                        <input id="register_email" class="form-control" name="email" type="email" placeholder="<?php echo $this->lang->line('enter_email'); ?>" required>
                        <input id="register_password" class="form-control" name="password" type="password" placeholder="<?php echo $this->lang->line('password'); ?>" required> 
                        <input id="register_city" class="form-control" name="city" type="text" placeholder="<?php echo $this->lang->line('write_city_name'); ?>" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('register'); ?></button>
                        </div>
                        <div>
                            <button id="register_login_btn" type="button" class="btn btn-link"> <?php echo $this->lang->line('login'); ?></button>
                            <button id="register_lost_btn" type="button" class="btn btn-link"> <?php echo $this->lang->line('forgot_password'); ?></button>
                        </div>
                    </div>
                </form>
                <!-- End | Register Form -->
            </div>
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>

<!-- ========JobsDetail modal========= -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog dialog-modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="container">
            
                <?php echo ($this->session->userdata('language') =='arb')? $settings->arabic_terms : $settings->terms ; ?>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ========ABout modal========= -->
<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog dialog-modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="container">
            
                <?php echo ($this->session->userdata('language') =='arb')? $settings->aboutus_arabic : $settings->aboutus ; ?>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ========JobsDetail modal========= -->
<div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog dialog-modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="container">
            
                <?php echo ($this->session->userdata('language') =='arb')? $settings->arabic_privacy : $settings->privacy_policy ; ?>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN # MODAL Change password -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <!-- Begin # DIV Form -->
            <form id="change_password_form">
                <div class="modal-body">
                    <div id="div-change-msg">
                        <div id="icon-change-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-change-msg"><?php echo $this->lang->line('enter_old_password'); ?> </span>
                    </div>
                    <input id="old_password" class="form-control" name="old_password" value="" type="text" placeholder="<?php echo $this->lang->line('old_password'); ?>" required>
                    <input id="new_password" class="form-control" name="new_password" value="" type="password" placeholder="<?php echo $this->lang->line('new_password'); ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?php echo $this->lang->line('password_strength_msg')?>" required>
                    
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('submit'); ?></button>
                    </div>
                    
                </div>
            </form>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- ========JobsDetail modal========= -->
<div class="modal fade" id="jobdetailmodal" tabindex="-1" role="dialog" aria-labelledby="jobdetailmodal" aria-hidden="true">
    <div class="modal-dialog dialog-modal">
        <div class="modal-content" id="jobdetailcontent">
        
        
        </div>
    </div>
</div>

<!-- ========Payment modal========= -->
<!-- <div class="modal fade" id="subscription-modal" tabindex="-1" role="dialog" aria-labelledby="subscription-modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <div id="div-forms">
                <div class="modal-body">
                    <div id="div-login-msg">
                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-login-msg"><?php echo $this->lang->line('subscribe_to_following_package'); ?> </span>
                    </div>
                    <div id="googlepay-container">
                    </div>
                    <form role="form" action="<?php echo base_url()?>welcome/stripePost" method="post" class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                        id="payment-form">
                        <div class="form-group required"> 
                            <label for="username"><h6>Card Owner</h6></label> 
                            <input type="text" name="username" placeholder="Card Owner Name" required class="form-control " size='4'> </div>
                        <div class="form-group"> 
                            <label for="cardNumber"><h6>Card number</h6></label>
                            <div class="input-group"> 
                                <input autocomplete='off' class='form-control card-number' size='20'>
                                <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group"> 
                                    <label><span class="hidden-xs"><h6>Expiration Date</h6> </span></label>
                                    <div class="input-group">  
                                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'> 
                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                    </label>  <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                    </div>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
                        <div class="card-footer"> <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Pay (<?php echo $settings->price; ?>) </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php
        // echo "<pre>"; print_r($_SESSION);
		$settings = $this->common_model->select_where("terms, price", "settings", array('id'=>1))->row();
        $dues = $settings->price;
        $url = "https://eu-prod.oppwa.com/v1/checkouts";
        $curl_data = "entityId=8acda4cc84ae19930184b8809b3b789c" .
                    "&amount=".$dues .
                    "&currency=SAR" .
                    // "&testMode=EXTERNAL" .
                    "&merchantTransactionId=".$this->session->userdata('userid') .
                    "&customer.email=".$this->session->userdata('useremail') .
                    "&paymentType=DB" .
                    "&standingInstruction.mode=INITIAL" .
                    "&standingInstruction.source=CIT" .
                    "&standingInstruction.type=RECURRING" .
                    "&createRegistration=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjZGE0Y2M4NGFlMTk5MzAxODRiODdlZjY5ZDc4OTZ8Mmd6a21OU0tXTQ=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            echo curl_error($ch);
        }
        curl_close($ch);
        $response_data = json_decode($responseData);
        $checkout_id = $response_data->id;
?>

<div class="modal fade" id="subscription-modal" tabindex="-1" role="dialog" aria-labelledby="subscription-modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <div id="div-forms">
                <div class="modal-body">
                    <div id="div-login-msg">
                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-login-msg"><?php echo $this->lang->line('subscribe_to_job_database') ; ?> </span>
                        <span style="font-size:17px;color:black"><?php echo $dues .' ﷼' ?></span>
                    </div>
                    <form action="<?php echo base_url('welcome/payment_status/').$dues;?>" class="paymentWidgets" data-brands="MADA APPLEPAY VISA MASTER"></form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>


<script async defer src="https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $checkout_id; ?>"></script>
<script type="text/javascript">
    var langVar = <?php echo json_encode($_SESSION['language']) ?>;
    if(langVar == 'arb'){
        var lang = 'ar';
    }
    else{
        var lang = 'en';
    }
    var wpwlOptions = {
        style: "plain",
        locale: lang,
        applePay: {
            version: 1,
            displayName: "Azoozy Job Portal",
            currencyCode: "SAR",
            style: "black",
            total: {label: "Azoozy Job Portal"},
            checkAvailability: "canMakePaymentsWithActiveCard",
            // requiredBillingContactFields: ["email", "name", "phone", "postalAddress", "phoneticName"],
        },
        billingAddress: {},
        mandatoryBillingFields:{
            country: true,
            state: true,
            city: true,
            postcode: true,
            street1: true,
            street2: false
        },
        onReady: function() {
            ready = true;
            // $('.wpwl-container').each(function() {
            //     var id = $(this).attr("id");
            //     wrapElement(this).hide().before("<h4 class='payHead'>" + methodMapping[id.substring(0, id.lastIndexOf("_"))] + "</h4>");
            // });
            // $("h4").click(function() {
            //     $(this).next().slideToggle();
            // });
        },
        onChangeBrand: function() {
            console.log(this.value);
            document.cookie = "activeBrand = " + this.value;
        }
    }
    wpwlOptions.applePay.onClick = function() {
        alert('transaction authorized');
    };
    wpwlOptions.applePay.onPaymentAuthorized = function() {
        alert('transaction authorized');
    };
    wpwlOptions.applePay.onCancel = function() {
        alert('transaction canceled');
    };
</script>

<script async defer src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>

<script async defer src="<?php echo base_url() . 'assets/toastr/toastr.min.js'; ?>"></script>



<script>

$('#loader').bind('ajaxStart', function(){

  $(this).show();

}).bind('ajaxStop', function(){

  $(this).hide();

});



$(function() {



    var $formLogin = $('#login-form');

    var $formLost = $('#lost-form');

    var $formRegister = $('#register-form');

    var $divForms = $('#div-forms');

    var $modalAnimateTime = 300;

    var $msgAnimateTime = 150;

    var $msgShowTime = 2000;



    $("form").submit(function() {

        switch (this.id) {

            case "login-form":

                var rememberme = '';

                if($('#rememberme').is(":checked")){

                    var rememberme = 'on';

                }

                var lg_username = $('#login_username').val();

                var lg_password = $('#login_password').val();

                $.ajax({

                    url: "<?=base_url();?>welcome/login/",

                    method: "POST",

                    data: {username:lg_username, password: lg_password, rememberme:rememberme},

                    success: function(response) {

                        if (response == "inactive") {

                            msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('account_disable') ?>");

                            

                        } else if (response == "error") {

                            msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('wrong_credentials') ?>");

                        } 

                        else{

                            location.reload();

                        }

                    }

                });

                return false;

                break;

            case "lost-form":

                var ls_email = $('#lost_email').val();

                $.ajax({

                    url: "<?=base_url();?>welcome/send_mail/",

                    method: "POST",

                    data: {email:ls_email},

                    success: function(response) {

                        if (response == "invalid") {

                            msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('email_not_exists') ?>");

                        } else if('sent') {

                            msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "<?php echo $this->lang->line('check_your_email') ?>");

                        }

                        else{

                            msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('error_try_again') ?>");

                        }

                    }

                });

                

                return false;

                break;

                

            case "register-form":

                var rg_username = $('#register_username').val();

                var rg_email = $('#register_email').val();

                var rg_password = $('#register_password').val();

                var rg_city = $('#register_city').val();

                $.ajax({

                    url: "<?=base_url();?>welcome/add_user/",

                    method: "POST",

                    data: {username:rg_username, useremail: rg_email, userpassword: rg_password, usercity:rg_city},

                    success: function(response) {

                        if (response == "exists") {

                            msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('email_exists') ?>");

                            

                            } else if (response == "error") {

                            msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('error_try_again') ?>");

                        } else {

                            msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "<?php echo $this->lang->line('registration_successfull') ?>");

                            $( '#register-form' ).each(function(){

                                this.reset();

                            });
                            $.post("<?php echo base_url() ?>/welcome/login", { username: rg_email, password: rg_password }, function(status) {
                                $('#login-modal').modal('toggle');
                                $('#subscription-modal').modal('toggle');
                                $('#subscription-modal').on('hidden.bs.modal', function () {
                                    location.reload();
                                }); 
                                
                            });
                        }

                    }

                });

                

                return false;

                break;

            default:

                return false;

        }

        return false;

    });

    $("#contact-form").on("submit", function(){

        $.ajax({

            url: "<?=base_url();?>welcome/contact_email/",

            type: 'post',

            data: $('form#contact-form').serialize(),

            success: function(data) {

            

                if (data=='sent') {

                    $( '#contact-form' ).each(function(){

                        this.reset();

                    });

                    msgChange($('#div-contact-msg'), $('#icon-contact-msg'), $('#text-contact-msg'), "success", "glyphicon-remove", "<?php echo $this->lang->line('email_snd_success') ?>");

                

                } 

                else{

                    msgChange($('#div-contact-msg'), $('#icon-contact-msg'), $('#text-contact-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('error_try_again') ?>");

                }

            }

        });

    });

    //change password form
    $("#change_password_form").on("submit", function(){
        $.ajax({
            url: "<?=base_url();?>welcome/change_password/",
            type: 'post',
            data: $('form#change_password_form').serialize(),
            success: function(data) {
            
                if (data=='ok') {
                    $( '#change_password_form' ).each(function(){
                        this.reset();
                    });
                    msgChange($('#div-change-msg'), $('#icon-change-msg'), $('#text-change-msg'), "success", "glyphicon-remove", "<?php echo $this->lang->line('pass_chng_success') ?>");
                } 
                else{
                    msgChange($('#div-change-msg'), $('#icon-change-msg'), $('#text-change-msg'), "error", "glyphicon-remove", "<?php echo $this->lang->line('wrong_old_password') ?>");
                }
            }
        });
    });

    $('#login_register_btn').click(function() {

        modalAnimate($formLogin, $formRegister)

    });

    $('#register_login_btn').click(function() {

        modalAnimate($formRegister, $formLogin);

    });

    $('#login_lost_btn').click(function() {

        modalAnimate($formLogin, $formLost);

    });

    $('#lost_login_btn').click(function() {

        modalAnimate($formLost, $formLogin);

    });

    $('#lost_register_btn').click(function() {

        modalAnimate($formLost, $formRegister);

    });

    $('#register_lost_btn').click(function() {

        modalAnimate($formRegister, $formLost);

    });



    function modalAnimate($oldForm, $newForm) {

        var $oldH = $oldForm.height();

        var $newH = $newForm.height();

        $divForms.css("height", $oldH);

        $oldForm.fadeToggle($modalAnimateTime, function() {

            $divForms.animate({

                height: $newH

            }, $modalAnimateTime, function() {

                $newForm.fadeToggle($modalAnimateTime);

            });

        });

    }



    function msgFade($msgId, $msgText) {

        $msgId.fadeOut($msgAnimateTime, function() {

            $(this).text($msgText).fadeIn($msgAnimateTime);

        });

    }



    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {

        var $msgOld = $divTag.text();

        msgFade($textTag, $msgText);

        $divTag.addClass($divClass);

        $iconTag.removeClass("glyphicon-chevron-right");

        $iconTag.addClass($iconClass + " " + $divClass);

        setTimeout(function() {

            msgFade($textTag, $msgOld);

            $divTag.removeClass($divClass);

            $iconTag.addClass("glyphicon-chevron-right");

            $iconTag.removeClass($iconClass + " " + $divClass);

        }, $msgShowTime);

    }

});

function change_lang(lang){

    $.ajax({

        url: "<?=base_url();?>welcome/set_session/"+lang,

        method: "GET",

        success: function(response) {

            window.location.href = '<?=base_url();?>welcome?'+lang;

        }

    });

   

}



function open_jobdetail(id){

    $.ajax({

        url: "<?=base_url();?>welcome/job_detail/"+id,

        method: "GET",

        success: function(response) {

            $('#jobdetailcontent').html(response);

            $('#jobdetailmodal').modal('toggle');

        }

    })

   

}

// payment scripts



$(function() {

    var $form         = $(".require-validation");

  $('form.require-validation').bind('submit', function(e) {

    var $form         = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',

                         'input[type=text]', 'input[type=file]',

                         'textarea'].join(', '),

        $inputs       = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid         = true;

        $errorMessage.addClass('hide');

 

        $('.has-error').removeClass('has-error');

    $inputs.each(function(i, el) {

      var $input = $(el);

      if ($input.val() === '') {

        $input.parent().addClass('has-error');

        $errorMessage.removeClass('hide');

        e.preventDefault();

      }

    });

     

    if (!$form.data('cc-on-file')) {

      e.preventDefault();

      Stripe.setPublishableKey($form.data('stripe-publishable-key'));

      Stripe.createToken({

        number: $('.card-number').val(),

        cvc: $('.card-cvc').val(),

        exp_month: $('.card-expiry-month').val(),

        exp_year: $('.card-expiry-year').val()

      }, stripeResponseHandler);

    }

    

  });

      

  function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            var token = response['id'];

            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }

     

});



// $(document).ready(function(){

//     paypal_sdk.Buttons({

//     createOrder: function(data, actions) {

//     // This function sets up the details of the transaction, including the amount and line item details.

//         return actions.order.create({

//         purchase_units: [{

//             amount: {

//             value: 200

//             }

//         }]

//         });

//     },

//     onApprove: function(data, actions) {

//         return actions.order.capture().then(function(details) {

//         if(details.status="COMPLETED"){

//         alert('Transaction completed by ' + details.payer.name.given_name);

//         $.post("<?php echo base_url() ?>/welcome/paypal_update", { payment_method:'PayPal' }, function(status) {

//             location.reload();

//         });



//         }

//         else{

//         alert('There is an error. Please try again.');

//         }

//         // This function shows a transaction success message to your buyer.

        

//         });

//     },

//     onError: (err) => {

//         alert(err);

//     console.error('error from the onError callback', err);

//   }

//     }).render('#paypal-button-container');

// });

</script>



<script async defer src="<?=base_url()?>assets/js/paymentbuttons.js"></script>



 <!-- SHOW TOASTR NOTIFIVATION -->

<?php if ($this->session->flashdata('flash_message') != "") : ?>

    <script type="text/javascript">

        toastr.success('<?php echo $this->session->flashdata("flash_message"); ?>');

    </script>

<?php unset($_SESSION['flash_message']); endif; ?>

<?php if ($this->session->flashdata('error_message') != "") : ?>

    <script type="text/javascript">

        toastr.error('<?php echo $this->session->flashdata("error_message"); ?>');

    </script>

<?php unset($_SESSION['error_message']); endif; ?>

<?php if ($this->session->flashdata('info_message') != "") : ?>

    <script type="text/javascript">

       //toastr.info('<?php echo $this->session->flashdata("info_message"); ?>');

    </script>

<?php unset($_SESSION['info_message']); endif; ?>

</html>