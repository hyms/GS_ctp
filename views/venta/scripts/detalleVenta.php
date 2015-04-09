<?php
$script = <<<JS
function pagado()
{
    $('#cambio').val(redondeo(resta($('#pagado').val(), $('#total').val())));
    var a = parseInt($('#pagado').val());
    var b = parseInt($('#total').val());
    if(a<b) {
        $('#ServicioVenta_tipoPago_1').prop('checked', 'checked');
    }
    else{
        $('#ServicioVenta_tipoPago_0').prop('checked', 'checked');
    }
    formaPago(!(a<b));
}
$('#pagado').blur(function(e) {
    pagado();
    return true;
});
$('#pagado').keydown(function(e) {
    if (e.keyCode == 13 || e.keyCode == 9) {
        pagado();
        $('#cambio').focus();
    return true;
    }
});
JS;
$this->registerJs($script, \yii\web\View::POS_READY);