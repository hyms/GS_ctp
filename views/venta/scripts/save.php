<?php
$script = <<<JS
$("#save").click(function(){ $("form").submit();});
JS;
$this->registerJs($script, \yii\web\View::POS_END);