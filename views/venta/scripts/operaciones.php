<?php
    $script = <<<JS
function suma(a, b) {
    return ((a * 1) + (b * 1));
}
function resta(a, b) {
    return ((a * 1) - (b * 1));
}
function redondeo(num) {
    return (Math.round(num * 10) / 10);
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);