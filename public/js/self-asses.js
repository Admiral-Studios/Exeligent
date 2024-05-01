document.addEventListener('DOMContentLoaded', () => {
    const selfItems = document.querySelectorAll('.section-add-self .item');
    const selfItemAdds = document.querySelectorAll('.section-add-self .item-add');
    const inputAddValues = document.querySelectorAll('.section-add-self .input-add-value');
    const selfItemsList = document.querySelectorAll('.section-add-self .list');

    if (selfItems) {
        selfItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
                if (!item.classList.contains('item-add'))
                    item.querySelector('input').checked = item.classList.contains('active')
                else
                    setTimeout(() => item.nextElementSibling.focus(), 100)
            });
        });

        selfItemAdds.forEach((itemAdd, index) => {
            itemAdd.addEventListener('click', () => {
                inputAddValues[index].style.display = "block";
                itemAdd.style.display = "none";
            });

            inputAddValues[index].addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault()

                    if (inputAddValues[index].value.length < 1)
                        return;

                    const newItem = document.createElement('div');
                    newItem.classList.add('item', 'add', 'active');
                    newItem.innerHTML = `
    <input type="checkbox" name="${inputAddValues[index].dataset.name}" value="${inputAddValues[index].value}" checked style="display:none;">
    ${inputAddValues[index].value}
    <svg class="delete-item" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
        <path opacity="0.6" d="M1 9L5 5L9 9M9 1L4.99924 5L1 1" stroke="#0066CC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
`;
                    selfItemsList[index].appendChild(newItem);

                    inputAddValues[index].value = '';

                    inputAddValues[index].classList.remove('active');

                    itemAdd.style.display = "block";
                    inputAddValues[index].style.display = "none";
                }
            });

            document.addEventListener('click', (event) => {
                const targetElement = event.target;

                if (targetElement.classList.contains('delete-item') || targetElement.closest('.delete-item')) {
                    targetElement.closest('.item').remove();
                } else if (!inputAddValues[index].contains(targetElement) && targetElement !== directionAdds[index]) {
                    inputAddValues[index].style.display = "none";
                    directionAdds[index].style.display = "block";
                }
            });
        });

        const changeTextContainers = document.querySelectorAll('.story-change-text');

        if (changeTextContainers) {
            changeTextContainers.forEach(container => {
                const label = container.querySelector('.a-form__item__label');
                const input = container.querySelector('.a-input');
                const changeBtn = container.querySelector('.change-btn');

                changeBtn.addEventListener('click', () => {
                    input.style.display = 'block';
                    label.style.display = 'none';
                    changeBtn.style.display = 'none';

                    input.focus();
                    input.value = '';
                    input.value = label.innerText;
                });

                input.addEventListener('keyup', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault()

                        input.style.display = 'none';
                        label.style.display = 'block';
                        changeBtn.style.display = 'block';

                        label.innerText = input.value;

                        return false;
                    }
                });
            });
        }
    }


    getTabsSelf();
})

function getTabsSelf() {
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
