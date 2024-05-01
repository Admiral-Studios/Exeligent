const stripe = Stripe($('#stripeKey').val());
const elements = stripe.elements();
const cardElement = elements.create('card');
const expressElement = elements.create('expressCheckout');

const form = document.getElementById('subscriptionForm')
const submitBtn = document.getElementById('card-button')
// const addressCountry = document.getElementById('card-address-country')
const addressState = document.getElementById('card-address-state')
const addressCity = document.getElementById('card-address-city')
const addressAddress = document.getElementById('card-address-address-1')
const addressAddress2 = document.getElementById('card-address-address-2')
const cardHolderName = document.getElementById('card-holder-name')

const cardInfoBlock = document.getElementById('card-info');

$(document).on('change', 'input[name="payment_method_id"]', function (e) {
    console.log(this.value)
    if (this.value.length > 0) {
        $('#card-holder-name').prop('required', false)
        // $(addressCountry).prop('required', false);
        $(addressState).prop('required', false);
        $(addressCity).prop('required', false);
        $(addressAddress).prop('required', false);
        $(cardHolderName).prop('required', false);

        $('#card-element').html('')

        cardInfoBlock.style.opacity = '1';
        cardInfoBlock.style.display = 'none';

        const fadeEffect = setInterval(function () {
            if (cardInfoBlock.style.opacity > 0) {
                cardInfoBlock.style.opacity = parseFloat(cardInfoBlock.style.opacity) - 0.1;
            } else {
                cardInfoBlock.style.display = 'none';
                clearInterval(fadeEffect);
            }
        }, 50);
    } else {
        $('#card-holder-name').prop('required', true)
        cardElement.mount('#card-element');
        expressElement.mount('#expless-element');

        cardInfoBlock.style.opacity = '0';
        cardInfoBlock.style.display = 'block';

        // $(addressCountry).prop('required', true);
        $(addressState).prop('required', true);
        $(addressCity).prop('required', true);
        $(addressAddress).prop('required', true);
        $(cardHolderName).prop('required', true);

        const fadeEffect = setInterval(function () {
            if (cardInfoBlock.style.opacity < 1) {
                cardInfoBlock.style.opacity = parseFloat(cardInfoBlock.style.opacity) + 0.1;
            } else {
                clearInterval(fadeEffect);
            }
        }, 50);
    }
})

form.addEventListener('submit', async (e) => {
    submitBtn.disabled = true

    if ($('input[name="payment_method_id"]:checked').val().length < 1) {
        e.preventDefault()

        const { setupIntent, error } = await stripe.confirmCardSetup(
            submitBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value,
                        address: {
                            // country: addressCountry.value,
                            state: addressState.value,
                            city: addressCity.value,
                            line1: addressAddress.value,
                            line2: addressAddress2.value,
                        }
                    }
                }
            }
        )

        if(error) {
            submitBtn.disabled = false
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    }
})
