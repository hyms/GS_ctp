<?php
$script = <<<JS
function factura(tipo,url,idVenta,tipoCliente) {
    jsonObj = [];
    $('#ywventa > tbody  > tr').each(function (index, value) {
        id = $(this).find('#idProductoStock').val();
        //index = $(this).find('#indexs').val();
        item = {};
        item ['idProductoStock'] = id;
        item ['index'] = index;
        jsonObj.push(item);
    });
    $.ajax({
        type: 'POST',
        url: url,
        data: {detalle: jsonObj, tipo: tipo, id: idVenta, tipoCliente:tipoCliente},
        dataType: 'json',
        encode: true
    })
        .done(function (data) {
            $('#codigo').text(data['codigo']);
            var key;
            for (key in data) {
                if (data.hasOwnProperty(key)) {
                    $('#costo_' + key).val(data[key]['costo']);
                    $('#costoTotal_' + key).val(redondeo(data[key]['total']));
                }
            }
            calcular_total();
        });
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);