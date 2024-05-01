document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('file-input').addEventListener('change', handleFileSelect);

    function openModal(btnId, modalId) {
        const modal = document.getElementById(modalId);
        const btn = document.getElementById(btnId);
        const overlay = document.querySelector('.overlay');

        if (btn && modal) {
            const closeModal = modal.querySelector('.modal-close');

            btn.addEventListener('click', () => {
                modal.classList.add('active');
                overlay.classList.add('active');
            });

            closeModal.addEventListener('click', () => {
                modal.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    }

    initChooses();

    openModal('btnOpenLinkedIn', 'modalLinkedIn');
    openModal('btnOpenLinkedInFunnel', 'modalLinkedIn');
    openModal('btnOpenLinkedInContacts', 'modalLinkedIn');

    getTabsFunnel();



    $(document).on('change', '#filterFunnelForm', function (e) {
        $(this).submit()
    })
    $(document).on('keyup', '#filterFunnelForm input', delay(function (e) {
            $(this).parents('form:first').submit()
        }, 4000)
    )

    $(document).on('click', '.funnel-filter-status', function (e) {
        let name = $(this).data('name'),
            value = $(this).data('value');
        $(`#filterFunnelForm input[name="${name}"]`).val(value).trigger('change')
    })



    $(document).on('change', '#filterContactsForm', function (e) {
        $(this).submit()
    })
    $(document).on('keyup', '#filterContactsForm input', delay(function (e) {
            $(this).parents('form:first').submit()
        }, 4000)
    )



    // Contact editing
    $(document).on('click', '.edit-contact', function(e) {
        e.preventDefault();
        let url = this.href;

        $('#editBlock').load(url, function () {
            initChooses();
            openModal('btnDeleteAccount', 'modalDeleteAccount');
            initSearchableInputs()

            $('#mainBlock').fadeOut(200, () => {
                $('#editBlock').fadeIn()
            })
            $("html, body").animate({scrollTop: 0}, "slow");
        })
        $('#editBlock').data('scroll-top', $(window).scrollTop());
    })

    $(document).on('click', '.close-contact', function(e) {
        e.preventDefault();

        $('#editBlock').fadeOut(200, () => {
            $('#editBlock').html('')
            $('#mainBlock').fadeIn()
            $("html, body").animate({scrollTop: $('#editBlock').data('scroll-top') || 0}, "slow");
        })
    })

    $(document).on('submit', '#editContactForm', function(e) {
        e.preventDefault();

        $.ajax({
            url: this.action,
            type: 'PUT',
            dataType: 'json',
            data: $(this).serialize(),
            success: function (response) {
                $('#editBlock').find('.show-contact').click()
                dropNotification('success', 'Contact has successfully updated')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (textStatus === 'error') {
                    let errors = jqXHR.responseJSON.errors
                    showErrors(errors)
                    $("html, body").animate({scrollTop: 0}, "slow");

                }
            }
        })
    })


    $(document).on('submit', '#editNetworkingContact', handleContactUpdate)


    $(document).on('change input', 'input, textarea', function (e) {
        this.classList.remove('is-invalid')
    })


});


function initChooses() {
    let chooseLists = document.querySelectorAll('.choose-block-list');

    chooseLists.forEach(function (list) {
        let chooseBlocks = list.querySelectorAll('.choose-block');

        chooseBlocks.forEach(function (block) {
            block.addEventListener('click', function () {
                chooseBlocks.forEach(function (innerBlock) {
                    innerBlock.classList.remove('active');
                });

                block.classList.add('active');

                let radioInput = block.querySelector('input[type="radio"]');
                radioInput.checked = true;

                let selectedValue = radioInput.value;
                console.log(selectedValue);
            });
        });
    });
}


function showErrors(errors) {
    $.each(errors, function (name, error) {
        let i;
        if (name.includes('.')) {
            i = name.split('.')[1];
            name = name.split('.')[0];
        }

        let $target = $(`input[name="${name}"`)
        if (i)
            $target = $($(`input[name="${name}[]"`)[i])

        if ($target) {
            $target.addClass('is-invalid')
            $target.parents('.a-form__item-box:first').find('span.invalid-feedback').text(error)
        }
    })
}


function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function handleFileSelect(event) {
    const fileInput = event.target;
    const fileInfoDiv = document.getElementById('file-info');
    const importConnectionsButton = document.getElementById('importConnections');

    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        const allowedExtensions = ['.xls', '.csv'];
        const fileExtension = fileName.slice((fileName.lastIndexOf(".") - 1 >>> 0) + 2);

        if (allowedExtensions.includes(`.${fileExtension}`)) {
            fileInfoDiv.innerHTML = `
<div class="file-item">
<p>${fileName}</p>
<svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" fill="none" onclick="clearFile()">
  <path opacity="0.6" d="M1 9.5L5 5.5L9 9.5M9 1.5L4.99924 5.5L1 1.5" stroke="#0066CC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
`;
            fileInfoDiv.style.display = 'flex';
            importConnectionsButton.disabled = false;
        } else {
            alert('Please select a file with the extension .xls or .csv.');
            clearFile();
        }
    }
}

function clearFile() {
    const fileInput = document.getElementById('file-input');
    const fileInfoDiv = document.getElementById('file-info');
    const importConnectionsButton = document.getElementById('importConnections');

    fileInput.value = '';
    fileInfoDiv.style.display = 'none';
    importConnectionsButton.disabled = true;
}

function getTabsFunnel() {
    let tabAs = document.querySelectorAll('.tab-a:not(.linkable)');

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

                document.querySelectorAll(`div.tab-menu .tab-a[data-id="${dataId}"]`)
                    .forEach(function (item, i) {
                        item.classList.add('active-a')
                    })

                localStorage.setItem('activeTab_' + window.location.pathname, dataId);
            });

            if (index !== 0) {
                let tab = document.querySelector('.tab[data-id="' + tabA.getAttribute('data-id') + '"]');
                if (tab) {
                    tab.style.opacity = '0';
                    tab.style.pointerEvents = 'none';
                    tab.style.height = '0';
                    tab.style.overflow = 'hidden';
                }
            }

            let activeTab = localStorage.getItem('activeTab_' + window.location.pathname);
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('tab'))
                activeTab = urlParams.get('tab')

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

function handleContactUpdate(e) {
    e.preventDefault();
    let success = false,
        $form = $(this);

    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: $form.serialize(),
        dataType: 'json',
        success: function (response) {
            success = response.result
        },
        complete: function () {
            if (success)
                dropNotification('success', 'Contact successfully updated')
            else
                dropNotification('error', 'Failed to update contact')
        }
    })
}
