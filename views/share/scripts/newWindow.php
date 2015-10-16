<?php
$script = <<<JS
function newwindow(url)
{
    window.open(url);
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);

$script = <<<JS
function onwindow(url)
{
    location.assign(url);
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);

$script = <<<JS
function onDiv(url)
{
$("#content").html('<object type="text/html" data="'+url+'" ></object>');

}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);