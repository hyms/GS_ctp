<?php
    $script = <<<JS
function previous()
{
    parent.history.back();
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);