<?php
$script = <<<JS
function onDiv(url)
{
$("#content").html('<object type="text/html" data="'+url+'" ></object>');

}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);