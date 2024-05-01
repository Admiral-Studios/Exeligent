const stripe = Stripe($('#stripeKey').val());
const elements = stripe.elements();
const cardElement = elements.create('card');


const form = document.getElementById('subscriptionForm')
const submitBtn = document.getElementById('signUpButton')
const addressState = document.getElementById('card-address-state')
const addressCity = document.getElementById('card-address-city')
const addressAddress = document.getElementById('card-address-address-1')
const cardHolderName = document.getElementById('card-holder-name')


$(function () {

    cardElement.mount('#card-element');

    $(document).on('keyup', 'input[name="voucher_code"]', delay(function (e) {
        let $input = $(this),
            url = $input.data('url'),
            value = $input.val();

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                voucher_code: value
            },
            dataType: 'json',
            success: function (response) {
                if (response.available) {
                    $input.addClass('is-success').parent().find('span.invalid-feedback').text(response.message)
                    $('#subscriptionForm')
                        .find('.billing,.billing-details')
                        .hide()
                    $('#subscriptionForm')
                        .find('input:required')
                        .removeAttr('required')
                    intentProcessed = true;
                } else {
                    $input.addClass('is-invalid').parent().find('span.invalid-feedback').text(response.message)
                    $('#subscriptionForm')
                        .find('.billing,.billing-details')
                        .show()
                    $('#subscriptionForm')
                        .find('input.required')
                        .attr('required', true)
                    intentProcessed = false;
                }
            },
            error: function (jqXHR, exception) {
                $('#subscriptionForm')
                    .find('.billing,.billing-details').show()

                let response = jqXHR.responseJSON;

                if (response.errors) {
                    showErrors(response.errors)
                }
            }
        })
    }, 500))


    if ($('input[name="voucher_code"]').val().length > 0) {
        $('input[name="voucher_code"]').trigger('keyup')
    }

})

let intentProcessed = false;

$(document).on('submit', '#subscriptionForm', async function (e) {
    submitBtn.disabled = true

    if (!intentProcessed) {
        e.preventDefault();

        console.log('ghealaw')
        const {setupIntent, error} = await stripe.confirmCardSetup(
            $('#intent_secret').val(), {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value,
                        address: {
                            state: addressState.value,
                            city: addressCity.value,
                            line1: addressAddress.value,
                        }
                    }
                }
            }
        )


        if (error) {
            console.log(error)
            dropNotification('error', error.message ?? 'An error occurred while trying to process a payment')
            submitBtn.disabled = false
            return false;
        } else {
            intentProcessed = true
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)

            form.submit()
        }
    }
})


function showErrors(errors) {
    for (let name in errors) {
        $(`[name=${name}]`).addClass('is-invalid')[0];
        $(`span.invalid-feedback[data-name=${name}]`).text(errors[name].join(' | '))
    }

    document.querySelector('input.is-invalid').scrollIntoView({behavior: 'smooth'})
}



document.addEventListener('DOMContentLoaded', () => {
    let currentDate = new Date();

    let monthNames = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

    let month = monthNames[currentDate.getMonth()];
    let day = currentDate.getDate();
    let year = currentDate.getFullYear();

    if (document.getElementById("currentDate"))
        document.getElementById("currentDate").innerText = month + " " + day + ", " + year;


    let subscriptionItems = document.querySelectorAll('.subscription-choice__item');

    subscriptionItems.forEach(function (item) {
        item.addEventListener('click', function () {
            document.getElementById('totalSummaryBlock').style.display = 'block';
            document.getElementById('signUpButton').disabled = false;

            subscriptionItems.forEach(function (item) {
                item.classList.remove('active');
            });

            item.classList.add('active');

            let radio = item.querySelector('input[type="radio"]');
            radio.checked = true;

            let price = item.querySelector('.price').textContent;

            let registerPaymentInfoPrice = document.querySelector('.register-payment-info .price');
            registerPaymentInfoPrice.textContent = price;

            let registerPaymentInfoPlan = document.querySelector('.register-payment-info .info .plan');
            registerPaymentInfoPlan.textContent = item.querySelector('.period label').textContent;
        });
    });
})


function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
