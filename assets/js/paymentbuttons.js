document.addEventListener('DOMContentLoaded', async() => {
    const stripe = Stripe('pk_test_51IJKtGDOIouC0Oh38vUMj6plbaWxYFK0hMKy4LFQuuvUvp8P3GqPJ0FTjQxwK5IFR2juQ0U3kPo0TNwcJYrokru700QyLv2KlK');
    const paymentRequest = stripe.paymentRequest({
        country: 'US',
        currency: 'usd',
        total: {
            label: 'Demo total',
            amount: 100 * 100,
        },
        requestPayerName: true,
        requestPayerEmail: true,
    });
    const elements = stripe.elements();
    const prButton = elements.create('paymentRequestButton', {
        paymentRequest: paymentRequest,
    });

    // Check the availability of the Payment Request API first.
    paymentRequest.canMakePayment().then(function(result) {
        console.log(result);
        if (result) {
            prButton.mount('#googlepay-container');
        } else {
            $('#googlepay-container').html('GooglePay is Unavailable');

        }
    });


    paymentRequest.on('paymentmethod', function(ev) {
        // Confirm the PaymentIntent without handling potential next actions (yet).
        stripe.confirmCardPayment(
            clientSecret, { payment_method: ev.paymentMethod.id }, { handleActions: false }
        ).then(function(confirmResult) {
            if (confirmResult.error) {
                // Report to the browser that the payment failed, prompting it to
                // re-show the payment interface, or show an error message and close
                // the payment interface.
                ev.complete('fail');
            } else {
                // Report to the browser that the confirmation was successful, prompting
                // it to close the browser payment method collection interface.
                ev.complete('success');
                // Check if the PaymentIntent requires any actions and if so let Stripe.js
                // handle the flow. If using an API version older than "2019-02-11"
                // instead check for: `paymentIntent.status === "requires_source_action"`.
                if (confirmResult.paymentIntent.status === "requires_action") {
                    // Let Stripe.js handle the rest of the payment flow.
                    stripe.confirmCardPayment(clientSecret).then(function(result) {
                        if (result.error) {
                            toastr.error(result.error);
                        } else {
                            $.post("<?php echo base_url() ?>/welcome/googlepay_update", { payment_method: 'PayPal' }, function(status) {
                                console.log(status);
                            });

                        }
                    });
                } else {
                    $.post("<?php echo base_url() ?>/welcome/googlepay_update", { payment_method: 'PayPal' }, function(status) {
                        console.log(status);
                    });
                }
            }
        });
    });
})