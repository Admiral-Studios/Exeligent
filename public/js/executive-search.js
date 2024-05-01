$(function () {

    initFilters()

    $(document).on('click', '#executiveFilters .choose', function (e) {
        let name = this.dataset.name,
            values = JSON.parse(this.dataset.values),
            $filter = $(`input[name="${name}"]`),
            filterValues = JSON.parse($filter.val()),
            isBtnActive = $(this).hasClass('active');

        if (Array.isArray(values)) {
            values.forEach(function (filter, i) {
                if (isBtnActive) {
                    filterValues.splice(filterValues.indexOf(filter), 1)
                } else {
                    if (!filterValues.includes(filter))
                        filterValues.push(filter)
                }
            })
        }

        $filter.val(JSON.stringify(filterValues)).parents('form').submit()
    })


    // Show filters form
    $(document).on('click', '#goToFilters', () => {
        $('#mainBlock').fadeOut(200, () => { $('#filterBlock').fadeIn() })
        $("html, body").animate({ scrollTop: 0 }, "slow");
    })

    // Hide form
    $(document).on('click', '#goToMain', () => {
        $('#filterBlock').fadeOut(200, () => { $('#mainBlock').fadeIn() })
        $("html, body").animate({ scrollTop: 0 }, "slow");
    })


    $(document).on('click', 'li.filters-item svg.close', function(e) {
        let property = $(this).parent().data('property'),
            items = $(this).parent().data('items').toString(),
            el;

        console.log(items)

        if (items.includes(','))
            items = items.split(',')
        else
            items = [items]

        items.forEach(function(item, i) {
            el = document.getElementById(`property-${property}-${item}`)
            el.checked = false
            el.dispatchEvent(new Event('change'))
        })

        $(el).parents('form').submit()
    })

    $(document).on('click', '.show-executive', function (e) {
        e.preventDefault();
        let url = this.href;

        $('#showBlock').load(url, function () {
            $('#mainBlock').fadeOut(200, () => {
                $('#showBlock').fadeIn(200, () => {
                    let height = $('#showBlock').offset().top;
                    $("html, body").animate({scrollTop: height}, "slow");
                })
            })

        })

        $('#showBlock').data('scroll-top', $(window).scrollTop());
    })

    $(document).on('click', '.close-executive', function(e) {
        e.preventDefault();

        $('#showBlock').fadeOut(200, () => {
            $('#showBlock').html('')
            $('#mainBlock').fadeIn(200, () => {
                $("html, body").animate({
                        scrollTop: $('#showBlock').data('scroll-top') || $('#mainBlock').offset().top
                    }, "slow");
            })
        })
    })

})

function initFilters() {
    $('#executiveFilters .choose').each(function (i, item) {
        let appliedFilters = JSON.parse($(`input[name="${this.dataset.name}"]`).val()),
            isMeetsReqs = true,
            filters = JSON.parse(this.dataset.values);

        filters.forEach(function (filter, i) {
            if (!appliedFilters.includes(filter))
                isMeetsReqs = false;
        })

        if (isMeetsReqs)
            $(this).addClass('active')
    })
}
