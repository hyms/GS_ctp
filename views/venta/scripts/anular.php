<?php
    $script = <<<JS
function nullResend(val)
{
    $("#anular").val(val);
    $("#form").submit();
}
JS;
    $this->registerJs($script, \yii\web\View::POS_END);