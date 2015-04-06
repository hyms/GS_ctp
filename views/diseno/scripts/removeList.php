<?php
    $script = <<<JS
$(document).on('click','#ywventa .tabular-input-remove', function(event) {
    event.preventDefault();
    $(this).parents('.tabular-input:first').remove();
    $('.tabular-input-container').filter(function () {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    }).siblings('.tabular-header').hide();
});
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);
