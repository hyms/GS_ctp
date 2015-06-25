<?php
    $script = <<<JS
$("#nuller").click(function(){
	$("#anular").val(1);
	$("#form").submit();});
JS;
    $this->registerJs($script, \yii\web\View::POS_END);