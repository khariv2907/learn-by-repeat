$(function() {

    $('body').on('click', '.js-add-one-more-card', function () {
        var formCardGroup = $(this).parents('form').find('.js-form-cards-group'),
            countCards = parseInt(formCardGroup.find('.js-card-title-input').length),
            input = '<div class="mb-2"><input class="form-control js-card-title-input" placeholder="Card Title #' + (++countCards) + '" name="cards[][title]" type="text"></div>';

        formCardGroup.append(input);
    });
});
