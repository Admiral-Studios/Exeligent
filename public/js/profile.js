document.addEventListener('DOMContentLoaded', () => {
    let subscriptionItems = document.querySelectorAll('.subscription-choice__item');

    subscriptionItems.forEach(function (item) {
        item.addEventListener('click', function () {
            subscriptionItems.forEach(function (item) {
                item.classList.remove('active');
            });

            item.classList.add('active');

            let radio = item.querySelector('input[type="radio"]');
            radio.checked = true;

            let price = item.querySelector('.price').textContent;

            let registerPaymentInfoPrice = document.querySelector('.register-payment-info .price');
            registerPaymentInfoPrice.textContent = price;
        });
    });

    let btnModalSubscription = document.querySelector('#btnChangeSubscription');
    let modalSubscription = document.querySelector('#modalSubscription');
    if (btnModalSubscription) {
        toggleModal(btnModalSubscription, modalSubscription);
    }

    let btnModalDeleteAccount = document.querySelector('#btnModalDeleteAccount');
    let modalDeleteAccount = document.querySelector('#modalDeleteAccount');
    if (btnModalDeleteAccount) {
        toggleModal(btnModalDeleteAccount, modalDeleteAccount);
    }

    let btnModalCancelSubscription = document.querySelector('#btnModalCanselSubscription');
    let modalCancelSubscription = document.querySelector('#modalCanselSubscription');
    if (btnModalCancelSubscription) {
        toggleModal(btnModalCancelSubscription, modalCancelSubscription);
    }

    let btnModalPaymentMethods = document.querySelector('#btnPaymentMethods');
    let modalPaymentMethods = document.querySelector('#modalPaymentMethods');
    if (btnModalPaymentMethods) {
        toggleModal(btnModalPaymentMethods, modalPaymentMethods);
    }

    getTabsProfile();
})

function toggleModal(btn, modal) {
    let overlay = document.querySelector('.overlay-modal');
    let body = document.body;

    btn.addEventListener('click', () => {
        modal.classList.toggle('active');
        overlay.classList.toggle('active');
        body.classList.toggle('active');
    });

    modal.addEventListener('click', () => {
        modal.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('active');
    });

    modal.querySelector('.modal-close').addEventListener('click', () => {
        modal.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('active');
    });

    modal.querySelector('.a-modal__wrapper').addEventListener('click', (e) => {
        e.stopPropagation();
    });
}

function getTabsProfile() {
    const tabAs = document.querySelectorAll('.tab-a:not(.linkable)');

    if (tabAs) {
        tabAs.forEach(function (tabA, index) {
            tabA.addEventListener('click', function (event) {
                event.preventDefault();

                let dataId = this.getAttribute('data-id');
                let tabs = document.querySelectorAll('.tab');

                tabs.forEach(function (tab) {
                    if (tab.getAttribute('data-id') === dataId) {
                        tab.style.opacity = '1';
                        tab.style.pointerEvents = 'auto';
                        tab.style.height = 'auto';
                        tab.style.overflow = 'visible';
                        tab.style.display = 'block';
                    } else {
                        tab.style.opacity = '0';
                        tab.style.pointerEvents = 'none';
                        tab.style.height = '0';
                        tab.style.overflow = 'hidden';
                        tab.style.display = 'none';
                    }
                });

                tabAs.forEach(function (tabA) {
                    tabA.classList.remove('active-a');
                });

                this.parentNode.querySelectorAll('.tab-a').forEach(function (tabA) {
                    tabA.classList.add('active-a');
                });

                localStorage.setItem('activeTab_' + window.location.pathname, dataId);
            });

            if (index !== 0) {
                let tab = document.querySelector('.tab[data-id="' + tabA.getAttribute('data-id') + '"]');
                tab.style.opacity = '0';
                tab.style.pointerEvents = 'none';
                tab.style.height = '0';
                tab.style.overflow = 'hidden';
            }

            // Получаем сохраненное состояние активного таба из localStorage
            let activeTab = localStorage.getItem('activeTab_' + window.location.pathname);
            if (activeTab) {
                if (document.querySelector(`[data-id="${activeTab}"]`)) {
                    if (tabA.getAttribute('data-id') === activeTab) {
                        tabA.click();
                    }
                } else if (index === 0) {
                    tabA.click();
                }
            } else if (index === 0) {
                tabA.click();
            }
        });
    }
}
