$(function(e) {
    $("#city").select2({
        width: '100%',
        tags: true,
        placeholder: 'Enter city',
        minimumInputLength: 2,
        ajax: {
            url: '/profile/search-city',
            data: function (params) {
                return {
                    q: params.term,
                    country: $('#country').val()
                };
            },
            dataType: 'json',
            type: "POST",
            headers: {
                "X-CSRF-Token": document.querySelector('input[name="_token"]').value
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.city,
                        }
                    })
                };
            }
        }
    })
    $('.select2-selection').addClass('a-input a-input-brand')
})
