<?php
    $script = <<<JS
var isProcessing = false;
function save()
{
    if(isProcessing){ return; }
        isProcessing = true;
    $("form").submit();
    return false;
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);