$(function () {

    $('.sortable').each(function (i, container) {
        new Sortable(container, {
            animation: 200,
            handle: '.handle',
            draggable: '.input-sortable',
        });
    })

})
