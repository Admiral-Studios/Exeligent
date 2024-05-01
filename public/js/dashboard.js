document.addEventListener('DOMContentLoaded', function () {
    let btnSeeFullOverview = document.getElementById('btnSeeFullOverview'),
        dashboardFirstPart = document.querySelector('.dashboard-first'),
        dashboardSecondPart = document.querySelector('.dashboard-second'),
        backBtn = document.querySelector('.back-button'),
        dropItemContents = document.querySelectorAll('.dropdown-item-content'),
        dropItemHeads = document.querySelectorAll('.dropdown-item-head:not(.not-started)');

    if (btnSeeFullOverview) {
        btnSeeFullOverview.addEventListener('click', () => {
            dashboardFirstPart.classList.add('hide');
            dashboardSecondPart.classList.remove('hide');
        })

        backBtn.addEventListener('click', () => {
            dashboardFirstPart.classList.remove('hide');
            dashboardSecondPart.classList.add('hide');
        })

        dropItemHeads.forEach((dropItemHead, index) => {
            let dropItemContent = dropItemContents[index];

            dropItemHead.addEventListener('click', () => {
                dropItemHeads.forEach((otherHead, otherIndex) => {
                    if (otherIndex !== index) {
                        let otherContent = dropItemContents[otherIndex];
                        otherContent.classList.remove('open');
                        otherHead.classList.remove('open');
                    }
                });

                dropItemContent.classList.toggle('open');
                dropItemHead.classList.toggle('open');
            });
        });
    }

    $(document).on('click', '.copy-button', function () {
        copyToClipboard($(this).data('text'))
    })

    window.addEventListener('DOMContentLoaded', getStepsAccordion);

    window.addEventListener('resize', getStepsAccordion);
});

function getStepsAccordion() {
    let welcomeModalSteps = document.querySelectorAll('.welcome-modal-step'),
        buttonBlue = document.querySelector('.welcome-modal .button-blue'),
        buttonClear = document.querySelector('.welcome-modal .button-clear');

    if (welcomeModalSteps) {
        welcomeModalSteps.forEach(step => {
            let description = step.querySelector('.description');

            step.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    welcomeModalSteps.forEach(otherStep => {
                        if (otherStep !== step) {
                            otherStep.querySelector('.description').classList.remove('active');
                        }
                    });
                    description.classList.toggle('active');
                }
            });
        });
        if (window.innerWidth <= 768) {
            buttonBlue.textContent = 'Got it';
            buttonClear.style.display = 'none';
        } else {
            buttonBlue.textContent = 'Let’s start';
            buttonClear.style.display = 'flex';
        }
    }
}

function copyToClipboard(text) {
    let $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}
