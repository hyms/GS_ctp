<?php
    $script= <<< JS
function newRow(almacen,url,type,form) {
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
        data: 'index=' + index + '&al=' + almacen + '&tipo=' + type+'&form='+form,
        dataType: 'html',
        success: function (html) {
            input.append(html);
            input.siblings('.tabular-header').show();
            $('#cantidad').val( parseInt($('#cantidad').val())+1);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error!');
        }
    });
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);