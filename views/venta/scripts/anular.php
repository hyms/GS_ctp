<?php
    $script = <<<JS
$("#nuller").click(function(){
$("#anular").val('1');
$("form").submit();
});
$("#reenviar").click(function(){
$("#anular").val('2');
$("form").submit();
});
JS;
    $this->registerJs($script, \yii\web\View::POS_END);