<style>
    body {background-color:#f6f6f5;}
</style>


<?php
		$settings = $this->common_model->select_where("terms, price", "settings", array('id'=>1))->row();
        $dues = $settings->price;
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $curl_data = "entityId=8ac7a4c983d5eca50183e132946d36ee" .
                    "&amount=".$dues .
                    "&currency=SAR" .
                    "&testMode=EXTERNAL" .
                    "&merchantTransactionId=".$_GET['user_id'] .
					"&customer.email=".$_GET['email'] .
                    "&paymentType=DB" .
                    "&standingInstruction.mode=INITIAL" .
                    "&standingInstruction.source=CIT" .
                    "&standingInstruction.type=RECURRING" .
                    "&createRegistration=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Yzk4M2Q1ZWNhNTAxODNlMTMyMDA2YjM2ZWF8NEtuWWZUM0JrVA=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
                <img class="img-circle" id="img_logo" height="auto" width="200" src="<?=base_url()?>assets/images/azoozyblack.png">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <div id="div-forms">
                <div class="modal-body" align="center">
                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right">
                        <span id="text-login-msg">Subscribe to job database</span>
                        <span style="font-size:17px;color:black"><?php echo $dues .' ﷼' ?></span>
                    </div>
                    <br>
                    <form action="<?php echo base_url('welcome/payment_status_api/').$dues.'/'.$_GET['user_id'];?>" class="paymentWidgets" data-brands="MADA APPLEPAY VISA MASTER"></form> 
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $checkout_id; ?>"></script>
<script type="text/javascript">
    var langVar = <?php echo json_encode($_GET['language']) ?>;
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
            checkAvailability: "canMakePaymentsWithActiveCard"
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
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
		$("#subscription-modal").modal('show');
	});
</script>