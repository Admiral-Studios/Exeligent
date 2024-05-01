$(function () {

    $(document).on('click', '.pagination li.page-item:not(.disabled,.active)', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let status = $(this).parents('div.pagination-wrapper:first').data('status') ?? null,
            page_num = this.dataset.page,
            $this = $(this)

        $.ajax({
            data: {
                name: 'page',
                status: status,
                page: page_num
            },
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if (response.html) {
                    $this.parents('div.items-container:first').html(response.html)
                }
            }
        })

        return false;
    })

    $(document).on('click', '.show-contact', function (e) {
        e.preventDefault();
        let url = this.href;

        $('#showBlock').load(url, function () {
            $('#mainBlock, #editBlock').fadeOut(200, () => {
                $('#showBlock').fadeIn()
            })
            $("html, body").animate({scrollTop: 0}, "slow");
        })

        $('#showBlock').data('scroll-top', $(window).scrollTop());
    })

    $(document).on('click', '.close-contact', function(e) {
        e.preventDefault();

        $('#showBlock').fadeOut(200, () => {
            $('#showBlock').html('')
            $('#mainBlock').fadeIn()
            $("html, body").animate({scrollTop: $('#showBlock').data('scroll-top') || 0}, "slow");
        })
    })

    $(document).on('click', '.edit-contact', function(e) {
        e.preventDefault();
        let url = this.href;

        $('#editBlock').load(url, function () {
            initializeDropdowns($('#editBlock').find('.dropdown'));
            $('#showBlock').fadeOut(200, () => {
                $('#editBlock').fadeIn()
            })
            $("html, body").animate({scrollTop: 0}, "slow");
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

    $(document).on('change input', 'input, textarea', function (e) {
        this.classList.remove('is-invalid')
    })


    $(document).on('click', 'li.filters-item svg.close', function (e) {
        let items = $(this).parent().data('items').split(','),
            el;

        items.forEach(function (item, i) {
            console.log(item)
            el = document.getElementById(item)
            el.checked = false
            el.dispatchEvent(new Event('change'))
        })

        $(el).parents('form').submit()
    })


})

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
