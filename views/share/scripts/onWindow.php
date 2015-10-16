<?php
$script = <<<JS
function onwindow(url)
{
    location.assign(url);
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);