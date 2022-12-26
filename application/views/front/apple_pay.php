<!-- 
<button style="-webkit-appearance: -apple-pay-button;" onclick="applePayButtonClicked()"></button>

<script src="">
    const applePayMethod = {
        supportedMethods: "https://apple.com/apple-pay",
        data: {
            version: 3,
            merchantIdentifier: "merchant.com.example",
            merchantCapabilities: ["supports3DS", "supportsCredit", "supportsDebit"],
            supportedNetworks: ["amex", "discover", "masterCard", "visa"],
            countryCode: "US",
        },
    };
    const paymentDetails = {
        total: {
            label: "My Merchant",
            amount: { value: "27.50", currency: "USD" },
        },
        displayItems: [{
            label: "Tax",
            amount: { value: "2.50", currency: "USD" },
        }, {
            label: "Ground Shipping",
            amount: { value: "5.00", currency: "USD" },
        }],
        shippingOptions: [{
            id: "ground",
            label: "Ground Shipping",
            amount: { value: "5.00", currency: "USD" },
            selected: true,
        }, {
            id: "express",
            label: "Express Shipping",
            amount: { value: "10.00", currency: "USD" },
        }],
    };
    const paymentOptions = {
        requestPayerName: true,
        requestPayerEmail: true,
        requestPayerPhone: true,
        requestShipping: true,
        shippingType: "shipping",
    };
    function applePayButtonClicked()
    {
        // Consider falling back to Apple Pay JS if Payment Request is not available.
        if (!window.PaymentRequest)
            return;

        try {
            const request = new PaymentRequest([applePayMethod], paymentDetails, paymentOptions);

            request.onmerchantvalidation = function (event) {
                alert('here is a payment request');
                // Have your server fetch a payment session from event.validationURL.
                const sessionPromise = fetchPaymentSession(event.validationURL);
                event.complete(sessionPromise);
            };

            request.onshippingoptionchange = function (event) {
                // Compute new payment details based on the selected shipping option.
                const detailsUpdatePromise = computeDetails();
                event.updateWith(detailsUpdatePromise);
            };

            request.onshippingaddresschange = function (event) {
                // Compute new payment details based on the selected shipping address.
                const detailsUpdatePromise = computeDetails();
                event.updateWith(detailsUpdatePromise);
            };

            const response = await request.show();
            const status = processResponse(response);
            response.complete(status);
        } catch (e) {
            // Handle errors
        }
    }
</script> -->

<style>
    body {background-color:#f6f6f5;}
</style>


<!-- <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js"></script> -->
<script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId=41B88BD3A2455AB762FED01E3EF586D0.uat01-vm-tx03"></script>
<form action="#" class="paymentWidgets" data-brands="APPLEPAY"></form>

<script src="text/javascript">
    var wpwlOptions = {
        applePay: {
            displayName: "MyStore",
            total: { label: "COMPANY, INC." }
        }
    }
    wpwlOptions.createCheckout = function() {
        return $.post("<?=base_url('welcome/curl_request');?>")
        .then(function(response) {
            alert('here you');
            alert(response.checkoutId);
            // return response.checkoutId;
        });
    };
</script>