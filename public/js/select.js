function initializeDropdowns() {
    document.querySelectorAll('.dropdown:not(.initialized)').forEach(function (dropdownWrapper) {
        dropdownWrapper.classList.add('initialized');
        const dropdownBtn = dropdownWrapper.querySelector('.dropdown__button');
        const dropdownList = dropdownWrapper.querySelector('.dropdown__list');
        const dropdownItems = dropdownList.querySelectorAll('.dropdown__list-item');
        const dropdownInput = dropdownWrapper.querySelector('.dropdown__input_hidden')

        dropdownBtn.addEventListener('click', function () {
            dropdownList.classList.toggle('dropdown__list_visible');
            this.classList.toggle('dropdown__button_active');
        });

        dropdownItems.forEach(function (listItem) {
            listItem.addEventListener('click', function (e) {
                dropdownItems.forEach(function (el) {
                    el.classList.remove('dropdown__list-item_active');
                })
                e.target.classList.add('dropdown__list-item_active');
                dropdownBtn.innerText = this.innerText;
                dropdownInput.value = this.dataset.value;
                $(dropdownInput).trigger('change');
                dropdownList.classList.remove('dropdown__list_visible');
                dropdownBtn.classList.add('select-active');
            })
        })

        document.addEventListener('click', function (e) {
            if (e.target !== dropdownBtn) {
                dropdownBtn.classList.remove('dropdown__button_active');
                dropdownList.classList.remove('dropdown__list_visible');
            }
        })

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Tab' || e.key === 'Escape') {
                dropdownBtn.classList.remove('dropdown__button_active');
                dropdownList.classList.remove('dropdown__list_visible');
            }
        })
    })
}

initializeDropdowns();

// Add New Value
$(document).on('click', 'button.add-input', function (e) {
    let name = $(this).data('name'),
        button = this,
        $template = $(this).next();

    if ($template.prop('tagName') !== 'TEMPLATE') {
        $template = $(`#${$(this).data('template-selector')}`);
        if ($template.length < 1 || $template.prop('tagName') !== 'TEMPLATE')
            throw new Error('There is no template')
    }

    let $div = $($template.html())

    let totalCountOfElements = $('[name^="' + name + '"]').length
    if ($(this).hasClass('countable')) {
        $div.find('span.number').text(totalCountOfElements + 1)
    }

    if (!$(button).hasClass('no-need-new-index')) {
        let newIndex = totalCountOfElements;
        do {
            newIndex++  // getting a unique index
        } while ($('[name="' + name + '[' + newIndex + ']"]').length > 0)

        let $input = $div.find('input')
        $input.each(function (i, input) {
            if ($(button).hasClass('input-has-name'))
                name = $(input).attr('name');

            $(input).attr('name', name + '[' + newIndex + ']');
        })
    }

    let afterParentSelector = $(this).data('after-parent-selector');
    if (afterParentSelector) {
        $(this).parents(afterParentSelector).after($div)
        $div.find('input:first').focus()
    } else {
        $(this).before($div);
        $div.find('input:first').focus()
    }

    $(this).parents('form').trigger('change')

    initializeDropdowns($div.find('.dropdown'));
});


$(document).on('keydown', '.addable', function (e) {
    if (e.keyCode === 13) {
        e.preventDefault()
        $(this).parents('div:not(.multiple-input-deletable):first').find('.add-input').click()
    } else if (e.keyCode === 46) {
        e.preventDefault()
        $(this).parents('div.multiple-input-deletable:first').find('span.delete').click()
    }
})

window.addEventListener('resize', () => {
    const filtersGroup = document.querySelector('.filters-group');

    if (filtersGroup) {
        const dropdownChk = filtersGroup.querySelectorAll('.dropdown_with-chk');
        if (window.innerWidth < 769) {
            dropdownChk.forEach(item => {
                const btn = item.querySelector('.dropdown_with-chk__button');
                const list = item.querySelector('.dropdown_with-chk__list');
                btn.addEventListener('click', () => {
                    list.classList.add('dropdown_with-chk__list_visible');
                })
            })
        }
    }
})

document.querySelectorAll('.dropdown_with-chk').forEach(function (dropdownWrapper) {
    const dropdownBtn = dropdownWrapper.querySelector('.dropdown_with-chk__button');
    const dropdownList = dropdownWrapper.querySelector('.dropdown_with-chk__list');
    const dropdownItems = dropdownList.querySelectorAll('.dropdown_with-chk__list-item');

    dropdownBtn.addEventListener('click', function () {
        dropdownList.classList.toggle('dropdown_with-chk__list_visible');
        this.classList.toggle('dropdown_with-chk__button_active');
    });

    dropdownItems.forEach(function (item) {
        const checkbox = item.querySelector('input[type="checkbox"]');

        item.addEventListener('click', function (event) {
            event.stopPropagation();

            const isActive = item.classList.contains('dropdown_with-chk__list-item_active');

            if (isActive) {
                checkbox.checked = false;
                item.classList.remove('dropdown_with-chk__list-item_active');
            } else {
                checkbox.checked = true;
                item.classList.add('dropdown_with-chk__list-item_active');
            }

            $(checkbox).trigger('change')
        });
    });

    dropdownList.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function (event) {
        const target = event.target;
        if (!dropdownWrapper.contains(target)) {
            dropdownList.classList.remove('dropdown_with-chk__list_visible');
            dropdownBtn.classList.remove('dropdown_with-chk__button_active');
        }
    });
});
