<?php
$script = <<<JS
function newwindow(url)
{
    window.open(url);
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);