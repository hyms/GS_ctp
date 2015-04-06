<?php
    $script= <<< JS
function newRow(almacen,url,type) {
    var input = $("#ywventa tbody");
    var index = 0;
    if (input.find(".tabular-input-index").length > 0) {
        $(".tabular-input-index").each(function () {
            index = Math.max(index, parseInt(this.value)) + 1;
        });
    }
    $.ajax({
        type: 'GET',
        url: url,
        data: 'index=' + index + '&al=' + almacen + '&costo=' + type,
        dataType: 'html',
        success: function (html) {
            input.append(html);
            input.siblings('.tabular-header').show();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error!');
        }
    });
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);