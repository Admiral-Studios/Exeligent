document.addEventListener('DOMContentLoaded', function () {
    const togglePasswords = document.querySelectorAll('.toggle-password');
    const burgerHeaderDashboard = document.querySelector('.header-burger-dashboard');
    const sidebar = document.querySelector('.sidebar');
    const body = document.querySelector('body');
    const overlay = document.querySelector('.overlay');

    if (togglePasswords) {
        togglePasswords.forEach(function (togglePassword) {
            togglePassword.addEventListener('click', function (e) {
                const password = this.parentNode.querySelector('.a-input-password');
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });
    }

    if (burgerHeaderDashboard) {
        burgerHeaderDashboard.addEventListener('click', () => {
            burgerHeaderDashboard.classList.toggle('active');
            body.classList.toggle('active');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            body.classList.remove('active');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    // ============= For DASHBOARD Page =============

    const extractLabel = document.querySelector(".extract-button-label");
    const modalSuccess = document.querySelector('.modal-success');

    overlay?.addEventListener('click', () => {
        if (modalSuccess) {
            modalSuccess.classList.remove('active');
        }
    });

    if (extractLabel) {
        const extractFileInput = document.getElementById("extractFile");

        extractFileInput.addEventListener("change", function () {
            if (extractFileInput.files.length > 0) {
                if (extractFileInput.files[0].type === 'text/csv') {
                    extractLabel.style.backgroundColor = "rgba(114, 143, 245, 0.8)";
                    extractLabel.style.pointerEvents = "none";
                    const span = extractLabel.querySelector('span');
                    span.textContent = "Uploaded!"

                    const modalSuccessClose = document.querySelector(".close-modal");
                    modalSuccess.classList.add('active');
                    overlay.classList.add('active');
                    body.classList.add('active');

                    modalSuccessClose.addEventListener("click", function () {
                        modalSuccess.classList.remove('active');
                        overlay.classList.remove('active');
                        body.classList.remove('active');
                    });
                } else {
                    extractFileInput.classList.add('is-invalid')
                    $(extractFileInput).next().html('<strong>The Import Connections must be a file of type: csv.</strong>')
                    $(extractFileInput).effect("shake")
                }
            }
        });
    }

    // ============= For MY PROFILE Page =============

    $(function () {
        if ($('#since').length) {
            let chosenRange = $('#since').val().split('-')

            let options = {
                autoUpdateInput: false, locale: {
                    format: 'DD.MM.YYYY', cancelLabel: 'Clear'
                }
            }

            if (Array.isArray(chosenRange) && chosenRange.length > 1) {
                options.startDate = chosenRange[0] ?? ''
                options.endDate = chosenRange[1] ?? ''
            }


            if ($.isFunction($.fn.daterangepicker)) {
                $('#since').daterangepicker(options);
            }

            $('#since').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
                $(this).parents('form').trigger('change')
            });

            $('#since').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
                $(this).parents('form').trigger('change')
            });
        }

        insertUploadedFiles();
    });

    // Enable submit button on form change
    $(document).on('change', 'form.submit-disabled', function () {
        if (getFilledFieldsCount(this) > 0) $(this).find('button[type="submit"]').prop('disabled', false)
    })

    // Count and set up progress bar on change
    $(document).on('change', 'form.progress-tracking', function () {
        if ($(this).data('sub-forms')) {
            $(this).data('sub-forms').split(',').forEach(function (item, i) {
                handleProgressChanging(document.getElementById(item))
            })
        } else {
            handleProgressChanging(this)
        }
    })

    $('form.progress-tracking').trigger('change') // first init for progress bar

    $(document).on('click', '.multiple-input-deletable span.delete', function (e) {
        let form = $(this).parents('form')
        let $deletable = $(this).parent('div.multiple-input-deletable')
        if ($deletable.hasClass('upper-level')) {
            $deletable.parent().remove()
        } else {
            $deletable.remove()
        }

        form.trigger('change') // trigger change for progressbar updating
    })

    // Remove is-invalid class on input
    document.querySelectorAll('input,textarea').forEach(function (el, i) {
        el.addEventListener('input', function () {
            this.classList.remove('is-invalid', 'is-success')
            removeInvalidClassFromTab(this)
        })
    });

    // And also remove is-invalid class from button on changing input
    $(document).on('click', '.dropdown__list-item', function (e) {
        $(this).parents('div.dropdown:first').find('button.dropdown__button').removeClass('is-invalid')
        removeInvalidClassFromTab(this)
    })

    document.querySelectorAll('[data-role="country-selector"]').forEach(function (item, i) {
        let selectElement = item;
        let spanElement = selectElement.nextElementSibling;
        if (selectElement) {
            selectElement.addEventListener('change', function () {
                if (selectElement.value !== '') {
                    spanElement.style.display = 'none';
                } else {
                    spanElement.style.display = 'block';
                }
            });
        }
    })

    const leadershipTitleBox = document.querySelector('.leadership-title-box');
    const leadershipList = document.querySelector('.leadership-list-section');

    if (leadershipTitleBox || leadershipList) {
        // const leadershipTitles = leadershipTitleBox.querySelectorAll('.title');
        // const secondLeadershipTitle = leadershipTitles[1];
        // const emptySearch = document.querySelector('.empty-search');
        // const leadershipItem = leadershipList.querySelectorAll('li');
        //
        // if (leadershipItem.length === 0) {
        //     if (emptySearch) {
        //         emptySearch.style.display = "block";
        //     }
        //     secondLeadershipTitle.style.display = "none";
        // } else if (leadershipItem.length <= 1) {
        //     secondLeadershipTitle.style.display = "none";
        //     if (emptySearch) {
        //         emptySearch.style.display = "none";
        //     }
        // } else {
        //     secondLeadershipTitle.style.display = "block";
        //     if (emptySearch) {
        //         emptySearch.style.display = "none";
        //     }
        // }
    }

    // Hide notification block
    let notification = document.querySelector('.notification-section');
    if (notification) {
        setTimeout(() => {
            $(notification).fadeOut(300, () => {
                $(notification).remove();
            })
        }, 10000)
    }

    $(document).on('keyup change', '.mirror', function (e) {
        $('[name="' + this.dataset.name + '"]').val(this.value)

        if (e.keyCode === 13) {
            $('#filterForm').submit()
        }
    })

    // For table
    const eTable = document.querySelector('.e-table');

    if (eTable) {
        const thead = document.querySelector('.e-table thead tr');
        const thCount = thead.querySelectorAll('th').length;
        if (thCount === 2) {
            eTable.classList.add('two-th');
        } else if (thCount === 3) {
            eTable.classList.add('more-than-three-th');
        }
    }

    adjustGoalsLayout();
    getNetPreparationMob();

    if (window.innerWidth >= 769) {
        resetAccordion()
        getTabs();
    }

    if (window.innerWidth <= 768) {
        getMobileTabs();
        initializedDropdowns();
    }

    // JS For Funnel Networking Page =========

    const tabFunnel = document.querySelectorAll('.tab-funnel:not(.linkable)');
    const tabFunnelBox = document.querySelectorAll('.tab-funnel-box');

    if (tabFunnel) {
        tabFunnel.forEach(function (tabF, index) {
            tabF.addEventListener('click', function (event) {
                event.preventDefault();

                let dataId = this.getAttribute('data-funnel');
                let tabs = document.querySelectorAll('.tab-funnel-box');

                tabs.forEach(function (tab) {
                    if (tab.getAttribute('data-funnel') === dataId) {
                        tab.style.opacity = '1';
                        tab.style.pointerEvents = 'auto';
                        tab.style.height = 'auto';
                        tab.style.overflow = 'visible';
                    } else {
                        tab.style.opacity = '0';
                        tab.style.pointerEvents = 'none';
                        tab.style.height = '0';
                        tab.style.overflow = 'hidden';
                    }
                });

                tabFunnel.forEach(function (tabF) {
                    tabF.classList.remove('active');
                });

                this.classList.add('active');

                localStorage.setItem('activeTab_' + window.location.pathname + $(this).parent().attr('id'), dataId);
            });

            if (index !== 0) {
                let tab = document.querySelector('.tab-funnel-box[data-funnel="' + tabF.getAttribute('data-funnel') + '"]');
                tab.style.opacity = '0';
                tab.style.pointerEvents = 'none';
                tab.style.height = '0';
                tab.style.overflow = 'hidden';
            }

            let activeTab = localStorage.getItem('activeTab_' + window.location.pathname + $(tabF).parent().attr('id'));
            if (activeTab && tabF.getAttribute('data-funnel') === activeTab) {
                tabF.click();
            }
        });
    }

    if (tabFunnelBox) {
        tabFunnelBox.forEach(item => {
            const leadershipTitleBox = item.querySelector('.leadership-title-box');
            const leadershipList = item.querySelector('.leadership-list-section');
            const leadershipTitles = leadershipTitleBox.querySelectorAll('.title');
            const secondLeadershipTitle = leadershipTitles[1];
            const emptySearch = item.querySelector('.empty-search');

            if (leadershipList) {
                const leadershipItem = leadershipList.querySelectorAll('li');
                if (leadershipItem.length === 0) {
                    emptySearch.style.display = "block";
                    secondLeadershipTitle.style.display = "none";
                } else if (leadershipItem.length <= 1) {
                    secondLeadershipTitle.style.display = "none";
                    emptySearch.style.display = "none";
                } else {
                    secondLeadershipTitle.style.display = "block";
                    emptySearch.style.display = "none";
                }
            }
        })
    }

    // End JS For Funnel Networking Page =========

    // JS For Dashboard 02.10.23 =========
    const accordionItemDashboards = document.querySelectorAll(".js-accordion");

    if (accordionItemDashboards) {
        accordionItemDashboards.forEach(accordionItemDashboard => {
            const accordionItemBody = accordionItemDashboard.nextElementSibling;
            accordionItemBody.style.maxHeight = 0;
            accordionItemBody.style.padding = '0 24px';
            accordionItemDashboard.style.borderBottom = 'unset';
            accordionItemBody.style.height = 'auto';

            accordionItemDashboard.addEventListener("click", event => {
                accordionItemDashboard.classList.toggle("active");
                if (accordionItemDashboard.classList.contains("active")) {
                    accordionItemBody.style.display = 'block';
                    accordionItemBody.style.maxHeight = '2000px';
                    accordionItemBody.style.padding = '24px 24px 44px 24px';
                    accordionItemDashboard.style.borderBottom = '1px solid #EDEDED';
                } else {
                    accordionItemBody.style.maxHeight = 0;
                    accordionItemBody.style.padding = '0 24px';
                    accordionItemDashboard.style.borderBottom = 'unset';
                }
            });
        });
    }

    // End JS For Dashboard 02.10.23 =========
});

window.addEventListener('resize', () => {
    adjustGoalsLayout();
    getNetPreparationMob();

    if (window.innerWidth >= 769) {
        resetAccordion();
        getTabs();
    }

    if (window.innerWidth <= 768) {
        getMobileTabs();
        initializedDropdowns();
    }
});

function getNetPreparationMob() {
    const netPreparationTitle = document.querySelectorAll('.js-section-dashboard-title');
    const netPreparationForm = document.querySelectorAll('.networking-preparation-form > .tab');

    function handleWindowResize() {
        if (window.innerWidth <= 768) {
            if (netPreparationForm) {
                netPreparationForm.forEach(item => {
                    item.classList.add('active');
                })
            }

            const extractTop = document.querySelector('.extract-top');
            const extractWrapper = document.querySelector('.extract-wrapper');
            const extractCloseBtn = document.querySelector('.extract-mobile-close');

            if (extractTop) {
                extractTop.addEventListener('click', () => {
                    extractWrapper.classList.add('active');
                })

                extractCloseBtn.addEventListener('click', () => {
                    extractWrapper.classList.remove('active');
                })
            }

            if (netPreparationTitle) {
                netPreparationTitle.forEach(titleSection => {
                    titleSection.addEventListener('click', () => {
                        titleSection.classList.toggle('active-title-box');
                    })
                })
            }
        }

        if (window.innerWidth >= 769) {
            if (netPreparationForm) {
                netPreparationForm.forEach(item => {
                    item.classList.remove('active');
                })
            }
        }
    }

    window.addEventListener('load', handleWindowResize);
    window.addEventListener('resize', handleWindowResize);



    // Registration > Choose Plan
    $(document).on('click', '.subscription-choice__item', function (e) {
        $(this).find('input:radio').prop('checked', true)
    })


}

// ============= Logic For Accordion Mobile Interview Preparation =============

function initializedDropdowns() {
    const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

    if (accordionItemHeaders) {
        accordionItemHeaders.forEach(accordionItemHeader => {
            const accordionItemBody = accordionItemHeader.nextElementSibling;
            accordionItemBody.style.maxHeight = 0;

            accordionItemHeader.addEventListener("click", event => {
                accordionItemHeader.classList.toggle("active");
                if (accordionItemHeader.classList.contains("active")) {
                    accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
                } else {
                    accordionItemBody.style.maxHeight = 0;
                }
            });
        });
    }
}

function resetAccordion() {
    const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

    if (accordionItemHeaders) {
        accordionItemHeaders.forEach(accordionItemHeader => {
            accordionItemHeader.classList.remove("active");
            const accordionItemBody = accordionItemHeader.nextElementSibling;
            accordionItemBody.style.maxHeight = 100 + '%';
        });
    }
}

function adjustGoalsLayout() {
    const goalsMobileContainer = document.querySelector('.goals-mobile');
    const goals = document.querySelector('.goals');
    const goalsContainer = document.querySelector('.section-dashboard-content');

    if (goals) {
        if (window.innerWidth <= 768) {
            goalsMobileContainer.appendChild(goals);
        } else if (window.innerWidth >= 769 && goals.parentElement !== goalsContainer) {
            goalsContainer.prepend(goals);
        }
    }
}

// End JS For Animation Percent In Main Page =========

function getFormElements(formEl) {
    return formEl.querySelectorAll('input:not([type="hidden"], [type="radio"], [type="checkbox"]), select, textarea');
}

function getFormCheckboxUniqueNames(formEl) {
    let arr = [];

    $(formEl).find('input:checkbox').each(function (i, el) {
        if ($.inArray(el.name, arr) < 0) {
            arr.push(el.name);
        }
    })

    return arr;
}

function getTotalFieldsCount(formEl) {
    let count = getFormElements(formEl).length ?? 0;
    count += getFormCheckboxUniqueNames(formEl).length ?? 0;

    return count;
}

function getFilledFieldsCount(formEl) {
    return getTotalFieldsCount(formEl) - getEmptyFieldsCount(formEl);
}

function getEmptyFieldsCount(formEl) {
    let formElements = getFormElements(formEl), formCheckboxNames = getFormCheckboxUniqueNames(formEl),
        emptyFieldsCount = 0;

    formElements.forEach(function (el, i) {
        if (el.value === '' || el.value === null || el.value === undefined) {
            emptyFieldsCount++;
        }
    })

    formCheckboxNames.forEach(function (name, i) { // calculate also checkboxes
        if ($(`input:checkbox[name="${name}"]:checked`).length < 1) {
            emptyFieldsCount++;
        }
    })

    return emptyFieldsCount;
}

function updateProgressBar(formId, percentDone) {
    let bar = $('.a-progress-bar[data-form="' + formId + '"]');

    bar.find('.count').text(percentDone);
    bar.find('.bar').css('width', percentDone + '%');

    if (percentDone > 0) $(bar).parent().find('.not-started').hide()
}

function handleProgressChanging(el) {
    let totalFieldsCount = getTotalFieldsCount(el), filledFieldsCount = getFilledFieldsCount(el);

    let percentDone = parseInt((filledFieldsCount / totalFieldsCount) * 100)

    if (isNaN(percentDone)) percentDone = 0

    updateProgressBar(el.id, percentDone)
}

function removeInvalidClassFromTab(el) {
    let $tab = $(el).parents('div.tab')
    if ($tab) {
        $('.tab-a[data-id="' + $tab.data('id') + '"]')?.removeClass('is-invalid-text')
    }
}

function getTabs() {
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

function getMobileTabs() {
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

function dropNotification(type, text) {
    let message = `<div class="notification-section ${type}">` +
        `<p>${text}</p>` +
        `</div>`

    let $message = $(message).appendTo('html')
    setTimeout(() => {
        $message.fadeOut(200, () => {
            $message.remove()
        })
    }, 5000)
}


// File Upload CV =======================================

const selectedFileNames = [];
const fileListTitle = document.querySelector('#selectedFiles h5');
const uploadedFiles = $('#uploadFile').data('files');
if (fileListTitle) {
    fileListTitle.style.display = "none";
}

function openFileInput() {
    document.getElementById('fileInput').click();
}

function handleFileChange(event) {
    const fileList = event.target.files;

    // Clear previous files
    selectedFileNames.length = 0;

    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];

        if (isValidCVFile(file.name)) {
            selectedFileNames.push({
                name: file.name,
                size: file.size
            });

            fileListTitle.style.display = "block";
        } else {
            alert('Invalid file format. Only .pdf, .docx, and .doc files are allowed.');
            fileListTitle.style.display = "none"; // Hide the title if there are no selected files
            break;
        }
    }

    updateSelectedFiles();
}

function isValidCVFile(fileName) {
    const validExtensions = ['.pdf', '.docx', '.doc'];
    const fileExtension = fileName.slice(((fileName.lastIndexOf(".") - 1) >>> 0) + 1);

    return validExtensions.includes(fileExtension.toLowerCase());
}

function formatFileSize(size) {
    const units = ["B", "KB", "MB", "GB"];
    let index = 0;

    while (size >= 1024 && index < units.length - 1) {
        size /= 1024;
        index++;
    }

    return `${size.toFixed(2)} ${units[index]}`;
}

function removeFile(index) {
    const dt = new DataTransfer()
    const input = document.getElementById('fileInput')
    const { files } = input

    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (index !== i)
            dt.items.add(file)
    }

    input.files = dt.files

    selectedFileNames.splice(index, 1);
    updateSelectedFiles();
    fileListTitle.style.display = "none";
}

function viewFile(url) {
    // const file = selectedFileNames[index];

    // let fileContentEndpoint = $('#uploadFile').data('show-url').replace('0', file.name)

    const newWindow = window.open(url, '_blank');

    if (newWindow) {
        newWindow.focus();
    } else {
        alert('Unable to open the file. Please check your popup blocker settings.');
    }
}

function updateSelectedFiles() {
    const selectedFilesElement = document.getElementById('selectedFiles');
    const fileListElement = selectedFilesElement.querySelector('.file-list');

    fileListElement.innerHTML = '';

    selectedFileNames.forEach((f, index) => {
        let fileShow = '',
            uploadedFileUrl = '',
            isFileUploaded = false;

        uploadedFiles.forEach(function (uploadedFile) {
            if (f.name === uploadedFile.title) {
                uploadedFileUrl = uploadedFile.url;
                isFileUploaded = true;
            }
        });

        if (isFileUploaded) {
            fileShow = `<div class="view" onclick="viewFile('${uploadedFileUrl}')"><i class="fas fa-eye"></i></div>`
        }

        const li = document.createElement('li');
        li.className = 'item';
        li.innerHTML = `
          <span class="name">
            ${f.name} (${formatFileSize(f.size)})
          </span>
            <div class="icons">
            ${fileShow}
            <div class="remove" onclick="removeFile(${index})">
              <i class="fas fa-trash-can"></i>
            </div>
          </div>
        `;
        fileListElement.appendChild(li);
    });

    selectedFilesElement.style.height = selectedFileNames.length ? 'auto' : 'max-height:220px';
}



async function insertUploadedFiles() {
    let files = await getFiles();

    let dataTransfer = new DataTransfer(),
        fileInput = document.querySelector('#fileInput');
    files.forEach(item => {
        dataTransfer.items.add(item);
    });

    if (fileInput) {
        fileInput.files = dataTransfer.files;

        $('#fileInput').trigger('change')
    }
}

async function getFiles() {
    let filesToInsert = $('#uploadFile').data('files'),
        files = [];

    if (Array.isArray(filesToInsert) && filesToInsert.length > 0) {
        for (let rawFileToInsert of filesToInsert) {
            const response = await fetch(rawFileToInsert.url);
            const blob = await response.blob();
            let file = new File([blob], rawFileToInsert.title, {type: blob.type});
            file.url = rawFileToInsert.url;
            files.push(file);
        }
    }

    return files;
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

document.getElementById('backToTop')?.addEventListener('click', scrollToTop);
