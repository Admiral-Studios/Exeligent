document.addEventListener('DOMContentLoaded', function () {
    let chooseBlocks = document.querySelectorAll('.preferred-list .choose-block'),
        maxSelections = 1;

    chooseBlocks.forEach(function (block) {
        if (block.dataset.limit)
            maxSelections = block.dataset.limit;

        block.addEventListener('click', function () {
            let selectedBlocks = document.querySelectorAll('.active');

            if (block.classList.contains('active')) {
                block.classList.remove('active');
            } else if (selectedBlocks.length < maxSelections) {
                block.classList.add('active');
            }
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
                    }
                });

                if (block.classList.contains('active')) {
                    block.classList.remove('active');
                } else {
                    block.classList.add('active');
                }
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

    if (directionItems) {
        emojiContainer.style.display = "none";

        directionItems.forEach(item => {
            item.addEventListener('click', () => {
                emojiContainer.style.display = "none";

                item.classList.toggle('active');
                if (!item.classList.contains('item-add'))
                    item.querySelector('input').checked = item.classList.contains('active')
                else
                    setTimeout(() => item.nextElementSibling.focus(), 100)
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

                    const newItem = document.createElement('div');
                    newItem.classList.add('choose-block', 'add', 'active');
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
    }

    getTabsDirection();

});


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
