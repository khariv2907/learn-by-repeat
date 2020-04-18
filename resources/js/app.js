$(function() {

    $('body').on('click', '.js-add-one-more-card', function () {
        var formCardGroup = $(this).parents('form').find('.js-form-cards-group'),
            countCards = parseInt(formCardGroup.find('.js-card-title-input').length),
            input = '<div class="mb-2"><input class="form-control js-card-title-input" placeholder="Card Title #' + (++countCards) + '" name="cards[][title]" type="text"></div>';

        formCardGroup.append(input);
    });

    $('body').on('click', '.js-view-history', function (event) {
        event.preventDefault();
        var cardId = $(this).data('id');

        $.ajax({
            url: '/cards/ajax-view-history',
            data: {
                id:cardId
            },
            dataType: 'html',
            success: function (response) {
                $('.js-modal-block').html(response);
                $('#cardHistoryModal').modal();
            },
            error: function () {
                alert('Server Error');
            },
        });
    })
});
