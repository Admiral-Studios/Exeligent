window.addEventListener('DOMContentLoaded', () => {
    const burgerHeader = document.querySelector('.header-burger');
    const headerMenu = document.querySelector('.header-menu');
    const body = document.querySelector('body');

    if (burgerHeader) {
        burgerHeader.addEventListener('click', () => {
            burgerHeader.classList.toggle('active');
            body.classList.toggle('active');
            headerMenu.classList.toggle('active');
        })
    }

    // JS For Animation Percent In Main Page =========

    function isElementInViewport(el) {
        let rect = el.getBoundingClientRect();
        return (rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth));
    }

    function animateNumbersWhenVisible() {
        let progressBars = document.querySelectorAll(".percent");

        if (progressBars) {
            progressBars.forEach(function (progressBar, i) {
                if (progressBar) {
                    let number = 0;
                    let animated = false;
                    let interval;

                    function animateNumbers() {
                        if (number >= progressBar.dataset.percent) {
                            clearInterval(interval);
                        } else {
                            number++;
                            progressBar.innerHTML = number + "%";
                        }
                    }

                    function checkVisibility() {
                        if (!animated && isElementInViewport(progressBar)) {
                            animated = true;
                            progressBar.style.opacity = 1;
                            interval = setInterval(animateNumbers, 15);
                        }
                    }
                }

                window.addEventListener("scroll", checkVisibility);
            })
        }
    }

    const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

    accordionItemHeaders.forEach(accordionItemHeader => {
        accordionItemHeader.addEventListener("click", event => {

            accordionItemHeader.classList.toggle("active");
            const accordionItemBody = accordionItemHeader.nextElementSibling;
            if(accordionItemHeader.classList.contains("active")) {
                accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
            }
            else {
                accordionItemBody.style.maxHeight = 0;
            }

        });
    });

    animateNumbersWhenVisible();

    // End JS For Animation Percent In Main Page =========

    if (window.innerWidth >= 769) {
        getTabsFront();
    }

    if (window.innerWidth <= 768) {
        getMobileTabsFront();
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth >= 769) {
        getTabsFront();
    }

    if (window.innerWidth <= 768) {
        getMobileTabsFront();
    }
});

function getTabsFront() {
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
                if (tabA.getAttribute('data-id') === activeTab) {
                    tabA.click();
                }
            } else if (index === 0) {
                tabA.click();
            }
        });
    }
}

function getMobileTabsFront() {
    const mobileStartPage = document.querySelector('.dashboard-mobile-start-page');
    const tabsMobileList = document.querySelector('.tabs-mobile-list');
    const btnBack = document.querySelectorAll('.btn-back-tabs');
    const tabPage = document.querySelector('.tab-page');

    function handleTabItemClick(event) {
        const selectedTab = event.currentTarget.dataset.tabMobile;
        const targetTab = document.querySelector(`.tab[data-id="${selectedTab}"]`);

        if (window.innerWidth <= 768) {
            const isActive = targetTab.classList.contains('active');
            if (!isActive) {
                targetTab.classList.add('active');
            }
        }

        targetTab.style.opacity = '0';
        targetTab.style.display = 'block';
        targetTab.style.transition = 'opacity 0.3s';

        btnBack.forEach(btn => {
            btn.style.display = "flex";
        })

        setTimeout(() => {
            targetTab.style.opacity = '1';
        }, 10);

        mobileStartPage.style.opacity = '1';
        mobileStartPage.style.display = 'none';
        mobileStartPage.style.transition = 'opacity 0.3s';

        setTimeout(() => {
            mobileStartPage.style.opacity = '0';
        }, 10);
    }

    function handleBtnBackClick() {
        const tabElements = document.querySelectorAll('[data-id]');
        tabElements.forEach((tab) => {
            tab.style.display = 'none';
        });

        mobileStartPage.style.opacity = '1';
        mobileStartPage.style.display = 'block';
        mobileStartPage.style.transition = 'opacity 0.3s';
        mobileStartPage.style.pointerEvents = 'auto';

        btnBack.forEach(btn => {
            btn.style.display = "none";
        })
    }

    if (tabsMobileList) {
        const tabItems = tabsMobileList.querySelectorAll('li[data-tab-mobile], a[data-tab-mobile]');

        tabItems.forEach((tabItem) => {
            tabItem.addEventListener('click', handleTabItemClick);
        });
    }

    if (btnBack) {
        btnBack.forEach(btn => {
            btn.addEventListener('click', handleBtnBackClick);
        })
    }
}
