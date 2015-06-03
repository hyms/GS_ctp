<?php
$script = <<<JS
function formaPago(value) {
    $('#fechaPlazo').prop('disabled', value);
    $('#autorizado').prop('disabled', value);
}

function descuentoP(descuento) {
    if (descuento.indexOf('%') > 0) {
        var tmp = parseInt(descuento.substring(0, descuento.length - 1));
        var descuento = parseFloat(tmp/100) * $('#total').val();
        $('#descuento').val(redondeo(descuento));
    }
    calcular_total();
    total = redondeo(resta($('#total').val(), descuento));
    return total;
}

$('#Descuento_0').change(function() {
    var value;
    if ($('#Descuento_0').is(':checked')) {
        value = false;
        $('#total').val(descuentoP($('#descuento').val()));
        cambio();
    }
    else {
        value = true;
        calcular_total()
    }
    $('#descuento').prop('disabled', value);
    $('#autorizado').prop('disabled', value);
});

$('#descuento').keydown(function(e) {
    if (e.keyCode == 13 || e.keyCode == 9) {
        $('#total').val(descuentoP($('#descuento').val()));
        cambio();
        $('#cambio').focus();
        return true;
    }
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);