<?php
    $script = <<<JS
function nuller()
{
    $("#anular").val(1);
	$("form").submit();
}
JS;
    $this->registerJs($script, \yii\web\View::POS_END);