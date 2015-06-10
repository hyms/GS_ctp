<?php
    $script = <<<JS
function calcular_total() {
    importe_total = 0
    $('.costo*').each(
        function (index, value) {
            importe_total = importe_total + parseFloat($(this).val() * 1);
        }
    );
    $('#total').val(redondeo(importe_total));
    cambio();
}
function cambio() {
    $('#cambio').val(redondeo(resta($('#pagado').val(), $('#total').val())));
}
JS;
    $this->registerJs($script, \yii\web\View::POS_END);