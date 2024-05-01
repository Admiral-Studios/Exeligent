$(function () {
    $(document).on('click', 'a.show-tool', showTool)
    $(document).on('click', 'a.hide-tool', hideTool)

    checkViewUrl();
})

function showTool(e) {
    e.preventDefault();

    let $parentDiv = $(this).parents('div.content-item');
    $parentDiv.find('.leadership-list').hide();
    $parentDiv.find('.leadership-show').show().css('visibility', 'hidden');

    let $infoBlock = $parentDiv.find('.leadership-show');

    let url = this.href,
        slug = this.dataset.slug;

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            _token: $('input[name="_token"]').val(),
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            if (response) {
                $infoBlock.find('.title').text(response.title)
                $infoBlock.find('.description').html(response.description)
                $infoBlock.find('.tool-link').attr('href', response.link)
                if (response.img) {
                    $infoBlock.find('img').attr('src', response.img)
                } else {
                    $infoBlock.find('img')
                }
                if (response.author) {
                    $infoBlock.find('.author').text(response.author).show()
                } else {
                    $infoBlock.find('.author').hide()
                }

                history.pushState(null, null, url);
            }
        },
        complete: function () {
            $infoBlock.css('visibility', 'visible');
        }
    })
}

function hideTool(e) {
    let $parentDiv = $(this).parents('div.content-item');
    $parentDiv.find('.leadership-list').show();
    $parentDiv.find('.leadership-show').hide();

    let url = $('.section-key-features').data('main-url');

    history.pushState(null, null, url);
}

function checkViewUrl() {
    let urlParams = location.pathname.replace(/^\/|\/$/g, '').split('/');

    if (urlParams.length > 1) {
        let $toolEl = $('.show-tool[data-slug="'+urlParams[1]+'"]'),
            tabId = $toolEl.parents('.tab').data('id');

        $('.tab-a[data-id="'+tabId+'"').click()
        $toolEl.click()
    }
}
