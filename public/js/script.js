$(function () {

    initSearchableInputs()

    // Career Direction
    let chooseBlocks = document.querySelectorAll('.preferred-list .choose-block'),
        maxSelections = 1;

    chooseBlocks.forEach(function (block) {
        if ($(block).parent().data('limit'))
            maxSelections = $(block).parent().data('limit');

        block.addEventListener('click', function () {
            let selectedBlocks = $(block).parent().find('.active');

            if (block.classList.contains('active')) {
                block.classList.remove('active');
            } else if (selectedBlocks.length < maxSelections) {
                block.classList.add('active');
            }
            block.querySelector('input').checked = block.classList.contains('active')
        });
    });

    let chooseSections = document.querySelectorAll('.choose-section');

    chooseSections.forEach(function (section) {
        let chooseOneBlocks = section.querySelectorAll('.one-select-list .choose-block');

        chooseOneBlocks.forEach(function (block) {
            block.addEventListener('click', function () {
                chooseOneBlocks.forEach(function (otherBlock) {
                    if (otherBlock !== block) {
                        otherBlock.classList.remove('active');
                        otherBlock.querySelector('input').checked = false
                    }
                });

                if (block.classList.contains('active')) {
                    block.classList.remove('active');
                } else {
                    block.classList.add('active');
                }
                block.querySelector('input').checked = block.classList.contains('active')
            });
        });
    });

    let directionItems = document.querySelectorAll('.culture-list .choose-block'),
        directionAdds = document.querySelectorAll('.culture-list .item-add'),
        inputAddValues = document.querySelectorAll('.culture-list .input-add-value'),
        directionList = document.querySelectorAll('.culture-list .choose-block-list'),
        emojiSelectorIcon = document.getElementById('emojiSelectorIcon'),
        emojiSelector = document.getElementById('emojiSelector'),
        emojiSearch = document.getElementById('emojiSearch'),
        emojiContainer = document.querySelector('.utility-container'),
        contentEmoji = '';

    if (emojiSelectorIcon) {
        emojiSelectorIcon.addEventListener('click', () => {
            emojiSelector.classList.toggle('active');
        });

        fetch('https://emoji-api.com/emojis?access_key=de45eeea811566778205fa632991f8eabc7ec4aa')
            .then(res => res.json())
            .then(data => loadEmoji(data))

        function loadEmoji(data) {
            data.forEach(emoji => {
                let li = document.createElement('li');
                li.setAttribute('emoji-name', emoji.slug);
                li.textContent = emoji.character;
                emojiList.appendChild(li);
            });

            let emoji = document.querySelectorAll('#emojiList li');

            emoji.forEach(item => {
                item.addEventListener('click', () => {
                    let activeEmoji = document.querySelector('#emojiList li.active');
                    if (activeEmoji) {
                        activeEmoji.classList.remove('active');
                    }

                    item.classList.add('active');
                    contentEmoji = item.innerHTML;

                    emojiSelector.classList.remove('active');

                    $('input.input-add-value:visible').focus()
                });
            })
        }

        emojiSearch.addEventListener('keyup', (e) => {
            let value = e.target.value;
            let emojis = document.querySelectorAll('#emojiList li');
            emojis.forEach(emoji => {
                if (emoji.getAttribute('emoji-name').toLowerCase().includes(value)) {
                    emoji.style.display = "flex";
                } else {
                    emoji.style.display = "none";
                }
            })
        })
    }


    if (directionItems && emojiContainer) {
        emojiContainer.style.display = "none";

        directionItems.forEach(item => {
            item.addEventListener('click', () => {
                emojiContainer.style.display = "none";

                item.classList.toggle('active');
                if (!item.classList.contains('item-add')) {
                    item.querySelector('input').checked = item.classList.contains('active')
                    if (item.querySelector('span.icon'))
                        item.querySelector('span.icon input').checked = item.classList.contains('active')
                } else {
                    setTimeout(() => item.nextElementSibling.focus(), 100)
                }
            });
        });

        directionAdds.forEach((itemAdd, index) => {
            itemAdd.addEventListener('click', () => {
                emojiContainer.style.display = "block";
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            emojiSelectorIcon.addEventListener('click', (event) => {
                event.stopPropagation();
                emojiContainer.style.display = "block";
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            emojiSelector.addEventListener('click', (event) => {
                event.stopPropagation();
                emojiContainer.style.display = "block";
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            inputAddValues[index].addEventListener('click', (event) => {
                event.stopPropagation();
                emojiSelector.classList.remove('active');
                emojiContainer.style.display = "block";
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            inputAddValues[index].addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault()

                    if (inputAddValues[index].value.length < 1)
                        return;

                    let name = inputAddValues[index].dataset.name,
                        iconName = inputAddValues[index].dataset.iconName;
                    if (inputAddValues[index].dataset.block) {
                        name = name.replace('%i%', $(`${inputAddValues[index].dataset.block}`).length)
                        iconName = iconName.replace('%i%', $(`${inputAddValues[index].dataset.block}`).length)
                    }

                    const newItem = document.createElement('li');
                    newItem.classList.add('choose-block', 'add', 'active');
                    newItem.innerHTML = `
    <input type="checkbox" name="${name}" value="${inputAddValues[index].value}" checked style="display:none;">
    <span class="icon"><input type="checkbox" name="${iconName}" value="${contentEmoji}" checked style="display:none;">${contentEmoji}</span>
    ${inputAddValues[index].value}
    <div class="btn-delete">
     <svg class="delete-item" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
        <path opacity="0.6" d="M1 9L5 5L9 9M9 1L4.99924 5L1 1" stroke="#0066CC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
     </svg>
    </div>
`;
                    directionList[index].appendChild(newItem);

                    inputAddValues[index].value = '';

                    inputAddValues[index].classList.remove('active');

                    itemAdd.style.display = "block";
                    inputAddValues[index].style.display = "none";
                    emojiContainer.style.display = "none";
                    contentEmoji = '';
                }
            });

            document.addEventListener('click', (event) => {
                const targetElement = event.target;

                const directionItemsArray = Array.from(directionItems);

                if (!emojiContainer.contains(targetElement) && !emojiSelector.contains(targetElement) && !emojiSearch.contains(targetElement) && !directionItemsArray.some(item => item.contains(targetElement))) {
                    emojiContainer.style.display = "none";
                    emojiSelector.classList.remove('active');
                    inputAddValues.forEach(input => input.style.display = "none");
                }

                if (targetElement.classList.contains('btn-delete') || targetElement.closest('.btn-delete')) {
                    targetElement.closest('.choose-block').remove();
                } else if (!inputAddValues[index].contains(targetElement) && targetElement !== directionAdds[index]) {
                    inputAddValues[index].style.display = "none";
                    directionAdds[index].style.display = "block";
                }
            });
        });
    } else if (directionItems) {
        directionItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
                if (!item.classList.contains('item-add'))
                    item.querySelector('input').checked = item.classList.contains('active')
                else
                    setTimeout(() => item.nextElementSibling.focus(), 100)
            });
        });

        directionAdds.forEach((itemAdd, index) => {
            itemAdd.addEventListener('click', () => {
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            inputAddValues[index].addEventListener('click', (event) => {
                event.stopPropagation();
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            inputAddValues[index].addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault()

                    if (inputAddValues[index].value.length < 1)
                        return;

                    const newItem = document.createElement('li');
                    newItem.classList.add('choose-block', 'big', 'add', 'active');
                    newItem.innerHTML = `
    <input type="checkbox" name="${inputAddValues[index].dataset.name}" value="${inputAddValues[index].value}" checked style="display:none;">
    <span class="icon">${contentEmoji}</span>
    ${inputAddValues[index].value}
    <div class="btn-delete">
     <svg class="delete-item" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
        <path opacity="0.6" d="M1 9L5 5L9 9M9 1L4.99924 5L1 1" stroke="#0066CC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
     </svg>
    </div>
`;
                    directionList[index].appendChild(newItem);

                    inputAddValues[index].value = '';

                    inputAddValues[index].classList.remove('active');

                    itemAdd.style.display = "block";
                    inputAddValues[index].style.display = "none";
                    contentEmoji = '';
                }
            });

            document.addEventListener('click', (event) => {
                const targetElement = event.target;

                const directionItemsArray = Array.from(directionItems);

                if (targetElement.classList.contains('btn-delete') || targetElement.closest('.btn-delete')) {
                    targetElement.closest('.choose-block').remove();
                } else if (!inputAddValues[index].contains(targetElement) && targetElement !== directionAdds[index]) {
                    inputAddValues[index].style.display = "none";
                    directionAdds[index].style.display = "block";
                }
            });
        });
    }

    getTabsDirection();


    $(document).on('click', '.pagination li', function (e) {
        $(this).find('a:first')[0]?.click()
    })

})



function initSearchableInputs() {
    if ($('input[placeholder*="Region"], input.search-location').length > 0) {

        $.getJSON('/data/zip.json').then(response => {
            $('input[placeholder*="Region"], input.search-location').each(function (i, item) {
                let onlyFields = this.dataset.only,
                    data = response.map(item => {
                        if (onlyFields.length > 0) {
                            let output = '';
                            onlyFields.split(',').forEach(function (field, i) {
                                output = output.concat(`${item[field]}, `)
                            })
                            return output.replace(/, *$/, '')
                        }

                        return `${item.Region}, ${item.City}, ${item.County}, ${item.State}, ${item['Zip Code']}`;
                    });

                $(item).typeahead({
                        highlight: true
                    },
                    {
                        name: 'regions',
                        source: substringMatcher([...new Set(data)])
                    });
            })
        });
    }
}


let substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        let matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};


function getTabsDirection() {
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
